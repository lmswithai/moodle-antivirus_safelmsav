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
 * Additional form in settings.
 *
 * @package    antivirus_safelmsav
 * @copyright  2024, when2update.com <consultations@when2update.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

/**
 * @package    antivirus_safelmsav
 * @copyright  2024, when2update.com <consultations@when2update.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 *
 */

class safelmsav_setting_apikey extends admin_setting_configtext {

    /** @var int default field size */
    public $size;
    /** @var array List of arbitrary data attributes */
    protected $datavalues = [];

    /**
     * Config text constructor
     *
     * @param string $name unique ascii name, either 'mysetting' for settings that in config, or 'myplugin/mysetting' for ones in config_plugins.
     * @param string $visiblename localised
     * @param string $description long localised info
     * @param string $defaultsetting
     * @param mixed $paramtype int means PARAM_XXX type, string is a allowed format in regex
     * @param int $size default field size
     */
    public function __construct($name, $visiblename, $description, $defaultsetting, $paramtype=PARAM_RAW, $size=null) {
        global $PAGE;

        $this->paramtype = $paramtype;
        if (!is_null($size)) {
            $this->size  = $size;
        } else {
            $this->size  = ($paramtype === PARAM_INT) ? 5 : 30;
        }

        $acceptterms = get_config('antivirus_safelmsav', 'accepttermsofservice');

        if (empty($acceptterms)) {
            $this->set_data_attribute('action', 'opentermsofservice');

            $PAGE->requires->js_call_amd('antivirus_safelmsav/displaytermsofservice','termsofserviceform');
        }

        parent::__construct($name, $visiblename, $description, $defaultsetting);
    }

    /**
     * Get whether this should be displayed in LTR mode.
     *
     * Try to guess from the PARAM type unless specifically set.
     */
    public function get_force_ltr() {
        $forceltr = parent::get_force_ltr();
        if ($forceltr === null) {
            return !is_rtl_compatible($this->paramtype);
        }
        return $forceltr;
    }

    /**
     * Return the setting
     *
     * @return mixed returns config if successful else null
     */
    public function get_setting() {
        return $this->config_read($this->name);
    }

    public function write_setting($data) {
        if ($this->paramtype === PARAM_INT and $data === '') {
        // do not complain if '' used instead of 0
            $data = 0;
        }
        // $data is a string
        $validated = $this->validate($data);
        if ($validated !== true) {
            return $validated;
        }
        return ($this->config_write($this->name, $data) ? '' : get_string('errorsetting', 'admin'));
    }

    /**
     * Validate data before storage
     * @param string data
     * @return mixed true if ok string if error found
     */
    public function validate($data) {


        $acceptterms = get_config('antivirus_safelmsav', 'accepttermsofservice');

        if (!empty($data) && empty($acceptterms)) {
            return get_string('valideaccepttermsofservice', 'antivirus_safelmsav');
        }

        // allow paramtype to be a custom regex if it is the form of /pattern/
        if (preg_match('#^/.*/$#', $this->paramtype)) {
            if (preg_match($this->paramtype, $data)) {
                return true;
            } else {
                return get_string('validateerror', 'admin');
            }

        } else if ($this->paramtype === PARAM_RAW) {
            return true;

        } else {
            $cleaned = clean_param($data, $this->paramtype);
            if ("$data" === "$cleaned") { // implicit conversion to string is needed to do exact comparison
                return true;
            } else {
                return get_string('validateerror', 'admin');
            }
        }
    }

    /**
     * Set arbitrary data attributes for template.
     *
     * @param string $key Attribute key for template.
     * @param string $value Attribute value for template.
     */
    public function set_data_attribute(string $key, string $value): void {
        $this->datavalues[] = [
            'key' => $key,
            'value' => $value,
        ];
    }

    /**
     * Return an XHTML string for the setting
     * @return string Returns an XHTML string
     */
    public function output_html($data, $query = '') {
        global $OUTPUT;

        $default = $this->get_defaultsetting();
        $context = (object) [
            'size' => $this->size,
            'id' => $this->get_id(),
            'name' => $this->get_full_name(),
            'value' => $data,
            'forceltr' => $this->get_force_ltr(),
            'readonly' => $this->is_readonly(),
            'data' => $this->datavalues,
            'maxcharacter' => array_key_exists('validation-max-length', $this->datavalues),
        ];
        $element = $OUTPUT->render_from_template('antivirus_safelmsav/setting_apike', $context);

        return format_admin_setting($this, $this->visiblename, $element, $this->description, true, '', $default, $query);
    }
}