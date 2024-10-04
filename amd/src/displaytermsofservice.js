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
 * Dynamic forms termsofservice.
 *
 * @module     antivirus_safelmsav
 * @copyright  2024, when2update.com <consultations@when2update.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

import ModalForm from 'core_form/modalform';
import {acceptTermsOfService} from './repository';
import {get_string as getString} from 'core/str';

export const termsofserviceform = async() => {

    const openTermsButton = document.querySelector('[data-action=opentermsofservice]');

    if (openTermsButton) {

        document.querySelector('[data-action=opentermsofservice]').addEventListener('click', async(e) => {

            const button = e.currentTarget;

            const response = await acceptTermsOfService();

            if (response.accepttermsofservice) {
                return;
            } else {
                button.disabled = true;
                e.preventDefault();
                const form = new ModalForm({
                    formClass: '\\antivirus_safelmsav\\termsofserviceform',
                    modalConfig: {
                        title: getString('titletermsofservice', 'antivirus_safelmsav'),
                    },
                    returnFocus: e.currentTarget
                });
                form.show();

                form.addEventListener(form.events.LOADED, () => {
                    button.disabled = false;
                });


            }

        });
    }

};