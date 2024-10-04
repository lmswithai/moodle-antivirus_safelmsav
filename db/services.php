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
 * Antivirus SafeLMSav webservice definitions.
 *
 * @package    antivirus_safelmsav
 * @copyright  2024, when2update.com <consultations@when2update.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$functions = [
    'antivirus_safelmsav_accept_terms_of_service' => [
        'classname'    => 'antivirus_safelmsav\external',
        'methodname'   => 'accept_terms_of_service',
        'classpath'    => '',
        'description'  => 'Load status accept terms of service antivirus safelmsav.',
        'type'         => 'read',
        'capabilities' => 'moodle/site:config',
        'ajax'         => true,
    ]
];

