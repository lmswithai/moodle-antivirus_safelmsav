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

/**
 * Class terms of service form.
 *
 * See PHPdocs in the parent class to understand the purpose of each method
 *
 * @package     antivirus_safelmsav
 * @copyright   2024, when2update.com <consultations@when2update.com>
 * @license     http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class termsofserviceform extends \core_form\dynamic_form {

    protected function get_context_for_dynamic_submission(): \context {
        return \context_system::instance();
    }

    protected function check_access_for_dynamic_submission(): void {
        require_capability('moodle/site:config', \context_system::instance());
    }

    protected function get_options(): array {
        $rv = [];
        if (!empty($this->_ajaxformdata['option']) && is_array($this->_ajaxformdata['option'])) {
            foreach (array_values($this->_ajaxformdata['option']) as $idx => $option) {
                $rv["option[$idx]"] = clean_param($option, PARAM_CLEANHTML);
            }
        }
        return $rv;
    }

    public function set_data_for_dynamic_submission(): void {

        $accepttermsofservice = (bool) get_config('antivirus_safelmsav', 'accepttermsofservice');
        $this->set_data([
            'accepttermsofservice' => $accepttermsofservice
        ]);
    }

    public function process_dynamic_submission() {
        if (!empty($this->get_data()->accepttermsofservice)) {
            set_config('accepttermsofservice', 1, 'antivirus_safelmsav');
            set_config('accepttermsofservicetime', time(), 'antivirus_safelmsav');
        };
    }

    public function definition() {
        $mform = $this->_form;

        $mform->addElement('static', 'aboutform', '', get_string('termsofservice', 'antivirus_safelmsav'));
        $mform->addElement('checkbox', 'accepttermsofservice', get_string('accepttermsofservice', 'antivirus_safelmsav'));
        $mform->addRule('accepttermsofservice', null, 'required', null, 'client');
        $mform->setType('accepttermsofservice', PARAM_BOOL);
        $mform->disabledIf('accepttermsofservice', 'accepttermsofservice', 'checked');

    }

    public function validation($data, $files) {
        $errors = [];
        return $errors;
    }

    protected function get_page_url_for_dynamic_submission(): \moodle_url {
        return new \moodle_url('/admin/settings.php?section=antivirussettingssafelmsav');
    }

}
