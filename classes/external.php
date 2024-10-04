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

namespace antivirus_safelmsav;

require_once($CFG->libdir . '/externallib.php');

use external_api;
use external_function_parameters;
use external_single_structure;
use external_value;

/**
 * This is the external API.
 *
 * @package    antivirus_safelmsav
 * @copyright  2024, when2update.com <consultations@when2update.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class external extends external_api {

    /**
     * Returns description of accept_terms_of_service() parameters.
     *
     * @return external_function_parameters
     */
    public static function accept_terms_of_service_parameters() {
        $params = [];
        return new external_function_parameters($params);
    }

    /**
     * Loads status.
     *
     * @return \stdClass
     */
    public static function accept_terms_of_service() {

        $statusatos = get_config('antivirus_safelmsav', 'accepttermsofservice');

        if (!empty($statusatos)) {
            return ['accepttermsofservice' => true];
        } else {
            return ['accepttermsofservice' => false];
        }
    }

    /**
     * Returns description of accept_terms_of_service() result value.
     *
     * @return external_description
     */
    public static function accept_terms_of_service_returns() {
        return new external_single_structure(array (
            'accepttermsofservice' => new external_value(PARAM_BOOL, 'True if accept terms of service')
        ));
    }

}
