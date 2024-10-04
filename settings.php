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
 * safelmsav admin settings.
 *
 * @package    antivirus_safelmsav
 * @copyright  2024, when2update.com <consultations@when2update.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

require_once(__DIR__ . '/libs/safelmsav_setting_apikey.php');


if ($ADMIN->fulltree) {
        require_once(__DIR__ . '/classes/scanner.php');

        $notify = new \core\output\notification(
                get_string('safelmsav_apikey_ads', 'antivirus_safelmsav',
                (new moodle_url('https://when2update.com/antivirus_safe_lms_av/'))->out()),
                \core\output\notification::NOTIFY_WARNING);

        $options = [1 => 1, 2 => 2, 3 => 3];
        $settings->add(new admin_setting_configselect('antivirus_safelmsav/tries',
                new lang_string('tries', 'antivirus_safelmsav'),
                new lang_string('tries_desc', 'antivirus_safelmsav'), 3, $options));

        $name = new lang_string('remotsafelmsavtings', 'antivirus_safelmsav');
        $description = $OUTPUT->render($notify);
        $settings->add(new admin_setting_heading('antivirus_safelmsav/remotsafelmsavtings', $name, $description));

        $default = '';
        $settings->add(new safelmsav_setting_apikey('antivirus_safelmsav/remoteapikey',
                new lang_string('remoteapikey', 'antivirus_safelmsav'),
                new lang_string('remoteapikeydesc', 'antivirus_safelmsav'), $default, PARAM_ALPHANUM));

        $products = [
                'none' => get_string('notselected', 'antivirus_safelmsav'),
                'essential' => 'ESET PROTECT ESSENTIAL',
                'entry' => 'ESET PROTECT ENTRY',
                'advanced' => 'ESET PROTECT ADVANCED',
                'complete' => 'ESET PROTECT COMPLETE',
                'enterprise' => 'ESET PROTECT ENTERPRISE',
                'elite' => 'ESET PROTECT ELITE'
                ];
        $settings->add(new admin_setting_configselect('antivirus_safelmsav/esetproduct',
                new lang_string('esetproducts', 'antivirus_safelmsav'), '', 'none', $products));

        $settings->add(new admin_setting_configtext('antivirus_safelmsav/esetkey',
                new lang_string('esetkey', 'antivirus_safelmsav'), '', $default, PARAM_TEXT));

        $name = new lang_string('titletermsofservice', 'antivirus_safelmsav');
        $description = new lang_string('termsofservice', 'antivirus_safelmsav');

        $acceptterms = get_config('antivirus_safelmsav', 'accepttermsofservice');
        $accepttermstime = get_config('antivirus_safelmsav', 'accepttermsofservicetime');

        if (!empty($acceptterms) || !empty($accepttermstime)) {

                $description .= '<div class="mb-5"><i class="fa fa-check text-success" aria-hidden="true"></i> ';
                $description .= new lang_string('accepttermsofservice', 'antivirus_safelmsav');
                $description .= '<small classes="text-muted"> (';
                $description .= userdate($accepttermstime);
                $description .= ')</small></div>';
        }

        $settings->add(new admin_setting_heading('antivirus_safelmsav/titletermsofservice', $name, ''));
        $settings->add(new admin_setting_description('antivirus_safelmsav/desctermsofservice', '', $description));

}
