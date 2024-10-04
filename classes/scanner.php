<?php
// This file is part of Moodle - http://moodle.org/
//
// Moodle is free software: you can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation, either version 3 of the License, or
// (at your option) any later version.
//
// Moodle is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
//
// You should have received a copy of the GNU General Public License
// along with Moodle.  If not, see <http://www.gnu.org/licenses/>.

/**
 * safelmsav antivirus integration.
 *
 * @package    antivirus_safelmsav
 * @copyright  2024, when2update.com <consultations@when2update.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace antivirus_safelmsav;

use curl;

/**
 * safelmsav scanner classs.
 */
class scanner extends \core\antivirus\scanner {

    /**
     * When2Update scanner url.
     *
     * @var string
     */
    private $scannerurl = 'https://scan.when2update.com';

    /** Does not pose a threat. */
    const SAFELMSAV_SCAN_RESULT_OK                  = 0;
    /** A threat has been detected and removed. */
    const SAFELMSAV_SCAN_RESULT_FOUND_AND_DELETE    = 1;
    /** Some files cannot be scanned (may be threats). */
    const SAFELMSAV_SCAN_RESULT_NOSCAN              = 10;
    /** Threat found. */
    const SAFELMSAV_SCAN_RESULT_VIRUS               = 50;
    /** Mistake. */
    const SAFELMSAV_SCAN_RESULT_ERROR               = 100;
    /** No apikey. */
    const SAFELMSAV_SCAN_RESULT_NOAPIKEY            = 150;
    /** No esetkey. */
    const SAFELMSAV_NOESETKEY                       = 300;
    /** No esetkey. */
    const SAFELMSAV_NOESETPRO                       = 301;
    /** No esetkey. */
    const SAFELMSAV_NO_ACTIVATE                     = 999;

    /**
     *  is_configured.
     *  Note: You will likely want a more specific check.
        This example just checks whether configuration exists.
     *
     * @return void
     */
    public function is_configured() {
        return (bool) true;
    }

    /**
     * Scan file.
     *
     * @param  string $file
     * @param  string $filename
     * @return int
     */
    public function scan_file($file, $filename) {

        if (!is_readable($file)) {
            // This should not happen.
            debugging('File is not readable.');
            return;
        }

        // Pre-check is product is activated.
        $activated = get_config('antivirus_safelmsav', 'activated');

        if (!$activated) {
            $activated = $this->activate_product();

            if ($activated == 1) {
                $activated = set_config('activated', 1, 'antivirus_safelmsav');
            } else {
                $activated = set_config('activated', 0, 'antivirus_safelmsav');
                throw new \core\antivirus\scanner_exception('antivirusnoactivate', '', ['item' => $filename],
                null, 'antivirus_safelmsav');
            }
        }

        $maxtries = get_config('antivirus_safelmsav', 'tries');
        $tries = 0;
        do {
            $tries++;
            $return = $this->scan_file_when2update($file, $filename);

            if ($return == self::SAFELMSAV_NO_ACTIVATE) {
                $activated = $this->activate_product();
                if (!$activated) {
                    $activated = set_config('activated', 0, 'antivirus_safelmsav');
                    throw new \core\antivirus\scanner_exception('antivirusnoactivate', '', ['item' => $filename],
                    null, 'antivirus_safelmsav');
                }
            }

        } while (($return == self::SAFELMSAV_SCAN_RESULT_ERROR ||
                $return == self::SAFELMSAV_SCAN_RESULT_NOAPIKEY ||
                $return == self::SAFELMSAV_NO_ACTIVATE) && $tries < $maxtries);

        $notice = get_string('tries_notice', 'antivirus_safelmsav',
        ['tries' => $tries, 'notice' => $this->get_scanning_notice()]);
        $this->set_scanning_notice($notice);

        if ($return == self::SAFELMSAV_SCAN_RESULT_OK) {

            // Perfect, no problem found, file is clean.
            return self::SCAN_RESULT_OK;

        } else if ($return == self::SAFELMSAV_SCAN_RESULT_VIRUS || $return == self::SAFELMSAV_SCAN_RESULT_FOUND_AND_DELETE) {

            $this->message_admins($this->get_scanning_notice());

            return self::SCAN_RESULT_FOUND;

        } else {
            // Unknown problem.
            unlink($file);

            if ($return == self::SAFELMSAV_SCAN_RESULT_NOAPIKEY) {
                throw new \core\antivirus\scanner_exception('antivirusfailedapikey', '', ['item' => $filename],
                null, 'antivirus_safelmsav');
            } else {
                throw new \core\antivirus\scanner_exception('antivirusfailed', '', ['item' => $filename],
                null, 'antivirus_safelmsav');
            }

        }
    }

    /**
     * Scan file using command When2Update server.
     *
     * @param string $file Full path to the file.
     * @param string $filename filename of the file.
     * @return int Scanning result constant.
     */
    public function activate_product() {

        $apikey = trim(get_config('antivirus_safelmsav', 'remoteapikey'));
        $esetproduct = trim(get_config('antivirus_safelmsav', 'esetproduct'));
        $esetkey = trim(get_config('antivirus_safelmsav', 'esetkey'));

        if (empty($apikey)) {
            debugging('Api key not set');
            return self::SAFELMSAV_SCAN_RESULT_NOAPIKEY;
        }

        if (empty($esetkey)) {
            debugging('Eset key not set');
            return self::SAFELMSAV_NOESETKEY;
        }

        if ($esetproduct === 'none') {
            debugging('Eset product not set');
            return self::SAFELMSAV_NOESETPRO;
        }


        $postdata = json_encode([
            'activationkey' => $esetkey,
            'product' => $esetproduct
        ]);

        $options = [
            'CURLOPT_SSL_VERIFYPEER' => true,
            'CURLOPT_SSL_VERIFYHOST' => 2,
            'CURLOPT_FOLLOWLOCATION' => true,
            'CURLOPT_CERTINFO' => 1,
            'CURLOPT_RETURNTRANSFER' => true,
            'CURLOPT_TIMEOUT' => 380,
            'CURLOPT_HTTPHEADER' => [
                'Content-Type: application/json',
                "Authorization: Bearer {$apikey}",
            ],
        ];

        $curl = new curl();
        $result = @json_decode($curl->post($this->scannerurl . '/activate.php', $postdata, $options));

        if (isset($result->activate)) {
            return $result->activate;
        } else {
            return self::SAFELMSAV_NO_ACTIVATE;
        }

    }

    /**
     * Scan file using command When2Update server.
     *
     * @param string $file Full path to the file.
     * @param string $filename filename of the file.
     * @return int Scanning result constant.
     */
    public function scan_file_when2update($file, $filename) {

        $apikey = trim(get_config('antivirus_safelmsav', 'remoteapikey'));

        if (empty($apikey)) {
            debugging('Api key not set');
            return self::SAFELMSAV_SCAN_RESULT_NOAPIKEY;
        }

        $cfile = curl_file_create($file, null, $filename);
        $postdata = ['file' => $cfile];

        $options = [
            'CURLOPT_SSL_VERIFYPEER' => true,
            'CURLOPT_SSL_VERIFYHOST' => 2,
            'CURLOPT_FOLLOWLOCATION' => true,
            'CURLOPT_CERTINFO' => 1,
            'CURLOPT_RETURNTRANSFER' => true,
            'CURLOPT_TIMEOUT' => 380,
            'CURLOPT_HTTPHEADER' => [
                'Content-Type: multipart/form-data',
                "Authorization: Bearer {$apikey}",
            ],
        ];

        $curl = new curl();
        $result = @json_decode($curl->post($this->scannerurl, $postdata, $options));

        if (isset($result->scan)) {
            return $result->scan;
        } else {
            return self::SAFELMSAV_SCAN_RESULT_ERROR;
        }

    }

    /**
     * Getter method for the antivirus message displayed in the exception.
     *
     * @return array array of string and component to pass to exception constructor.
     */
    public function get_virus_found_message() {
        // Base antivirus found string.
        return ['string' => 'virusfound', 'component' => 'antivirus_safelmsav', 'placeholders' => []];
    }
}
