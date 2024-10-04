<?php
// This file is part of Moodle - https://moodle.org/
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
// along with Moodle.  If not, see <https://www.gnu.org/licenses/>.

/**
 * Plugin strings are defined here.
 *
 * @package     antivirus_safelmsav
 * @category    string
 * @copyright   2024, when2update.com <consultations@when2update.com>
 * @license     https://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$string['SAFELMSAV_SCAN_RESULT_ERROR'] = 'Error.';
$string['SAFELMSAV_SCAN_RESULT_FOUND_AND_DELETE'] = 'Threat found and cleaned.';
$string['SAFELMSAV_SCAN_RESULT_NOSCAN'] = 'Some files could not be scanned (may be threats).';
$string['SAFELMSAV_SCAN_RESULT_OK'] = 'No threat found.';
$string['SAFELMSAV_SCAN_RESULT_VIRUS'] = 'Threat found.';
$string['SAFELMSAV_NO_ACTIVATE'] = 'Product not activate.';
$string['accepttermsofservice'] = 'Agree to Terms and Conditions';
$string['antivirusfailed'] = 'There is currently a problem with the antivirus scanning. Your file {$a->item} has not been uploaded. Please try again later.';
$string['antivirusfailedapikey'] = 'No license or inactive license for antivirus scanning. Your file {$a->item} was not uploaded. Please try again later.';
$string['esetproducts'] = 'Select name of the solution';
$string['esetkey'] = 'Activate key';
$string['pluginname'] = 'Safe LMS AV';
$string['remote'] = 'Remote';
$string['remoteapikey'] = 'API key';
$string['remoteapikeydesc'] = 'Enter the API key if online scanning is selected.';
$string['remotsafelmsavtings'] = 'Remote scan type';
$string['remotsafelmsavtings_help'] = 'If you need an API key, contact us at <a href="mailto:consultations@when2update.com">consultations@when2update.com</a>';
$string['safelmsavfailed'] = 'Failed to start Safe LMS AV. Returned error "{$a}". Here is the full return:';
$string['safelmsavfailureonupload'] = 'Safe LMS AV failure';
$string['safelmsav_apikey_ads'] = '<p>A paid license key is required to use the plugin. This key allows activation and regular updates, ensuring the highest level of protection against threats.

</p> <p><strong>How to obtain a license key?</strong></p> <p> To get a license key, please contact us. Reach out to us, and we will gladly help you choose the right licensing plan tailored to your needs. </p>
<p> Thank you for trusting and choosing our software!</p> <p>Contact us at <a href="mailto:consultations@when2update.com">consultations@when2update.com</a> | <a href="{$a}" target="_blank" rel="noopener noreferrer">when2update.com</a></p>';
$string['termsofservice'] = '<strong>1. Introduction</strong>
<p>
    These Terms govern the use of the Safe LMS AV antivirus plugin, provided by Intersieć, located at Karola Godula 36, Ruda Śląska, 41-703, Poland (NIP: PL6262548222). By installing and using the plugin, you agree to these Terms.
</p>

<strong>2. License & Usage</strong>
<ul class="list-unstyled">
    <li>a) You are granted a limited, non-exclusive license to use the plugin solely for its intended purpose.</li>
    <li>b) You may not resell, redistribute, or share your API key.</li>
</ul>

<strong>3. Updates & Support</strong>
<ul class="list-unstyled">
    <li>a) Regular updates may be necessary to maintain optimal performance and protect against new threats.</li>
    <li>b) We do not guarantee uninterrupted operation of the plugin or availability of future updates.</li>
    <li>c) Users are responsible for maintaining system compatibility and ensuring that updates are applied.</li>
</ul>

<strong>4. Data Collection & Privacy</strong>
<ul class="list-unstyled">
    <li>a) The plugin may collect anonymized data related to detected threats to improve overall functionality.</li>
    <li>b) No personal data will be collected, processed, or shared without explicit consent, except as required by law.</li>
    <li>c) The plugin does not transmit any user files or private data externally unless specified.</li>
</ul>

<strong>5. Limitation of Liability</strong>
<ul class="list-unstyled">
    <li>a) The plugin is provided "as is," without any warranties, express or implied, including but not limited to warranties of merchantability, fitness for a particular purpose, or non-infringement.</li>
    <li>b) We are not liable for any direct, indirect, incidental, or consequential damages arising from the use of the plugin, including but not limited to financial losses, data loss, system corruption, or issues resulting from malware infection, despite the use of the plugin.</li>
    <li>c) While we strive to provide comprehensive protection, we cannot guarantee complete security against all threats, given the evolving nature of malicious software.</li>
</ul>

<strong>6. Warranties & Exclusions</strong>
<ul class="list-unstyled">
    <li>a) We make no guarantees regarding the effectiveness of the plugin in detecting or removing all threats.</li>
    <li>b) We are not responsible for any incompatibility with other software or systems.</li>
    <li>c) The plugin may not function correctly on all devices, and no assurances are made regarding availability for certain systems.</li>
</ul>

<strong>7. User Responsibility</strong>
<ul class="list-unstyled">
    <li>a) The user agrees to use the plugin in accordance with these Terms and all applicable laws.</li>
    <li>b) The user is responsible for the backup of their data and maintaining additional security measures.</li>
    <li>c) You agree to indemnify and hold us harmless from any claims, damages, or liabilities arising out of improper use of the plugin or violation of these Terms.</li>
</ul>

<strong>8. Modifications to the Terms</strong>
<p>
    We reserve the right to modify these Terms at any time. Users will be notified of changes via electronic communication or through plugin updates. Continued use of the plugin after any changes to the Terms signifies acceptance of the updated Terms.
</p>

<strong>9. Termination</strong>
<p>
    We reserve the right to terminate your license and access to the plugin in the event of a violation of these Terms. Upon termination, you must cease all use of the plugin immediately.
</p>

<strong>10. Governing Law</strong>
<p>
    These Terms are governed by Polish law. Any disputes arising from these Terms will be settled in the courts of Poland.
</p>';
$string['titletermsofservice'] = 'Terms of service';
$string['tries'] = 'Scan attempts';
$string['tries_desc'] = 'The number of attempts made by Safe LMS AV if an error occurred during the scanning process.';
$string['notselected'] = 'Not selected';
$string['tries_notice'] = 'Safe LMS AV attempted scanning {$a->tries} times.
{$a->notice}';
$string['valideaccepttermsofservice'] = 'You must accept our terms of service before saving the API key';
$string['virusfound'] = 'The file "{$a->item}" has been scanned and found to be infected!';
