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

$string['SAFELMSAV_SCAN_RESULT_ERROR'] = 'Błąd.';
$string['SAFELMSAV_SCAN_RESULT_FOUND_AND_DELETE'] = 'Zagrożenie zostało wykryte i usunięte.';
$string['SAFELMSAV_SCAN_RESULT_NOSCAN'] = 'Niektórych plików nie można przeskanować (mogą stanowić zagrożenia).';
$string['SAFELMSAV_SCAN_RESULT_OK'] = 'Nie znaleziono zagrożenia.';
$string['SAFELMSAV_SCAN_RESULT_VIRUS'] = 'Znaleziono zagrożenie.';
$string['SAFELMSAV_NO_ACTIVATE'] = 'Product nie aktywowany.';
$string['accepttermsofservice'] = 'Zgadzam się z warunkami i postanowieniami';
$string['antivirusfailed'] = 'Tutaj występuje obecnie problem ze skanowaniem antywirusowym. Twój plik {$a->item} nie został przesłany. Spróbuj ponownie później.';
$string['antivirusfailedapikey'] = 'Brak lub nieaktywna licencja na skanowanie antywirusowe. Twój plik {$a->item} nie został przesłany. Spróbuj ponownie później.';
$string['esetproducts'] = 'Wybierz nazwę rozwiązania';
$string['esetkey'] = 'Klucz aktywacyjny';
$string['pluginname'] = 'Safe LMS AV';
$string['remote'] = 'Zdalny';
$string['remoteapikey'] = 'Klucz API';
$string['remoteapikeydesc'] = 'Pod klucz API w przypadku wyboru skanowania online.';
$string['remotsafelmsavtings'] = 'Skanowanie zdalne';
$string['remotsafelmsavtings_help'] = 'Jeśli potrzebujesz klucz API skontaktuj się z nami: <a href="mailto:consultations@when2update.com">consultations@when2update.com</a>';
$string['safelmsavfailed'] = 'Nie udało się uruchomić Safe LMS AV.  Zwrócił błąd "{$a}". Tu jest pełna zwrotka:';
$string['safelmsavfailureonupload'] = 'Safe LMS AV niepowodzenie';
$string['safelmsav_apikey_ads'] = '<p>Aby korzystać z wtyczki, wymagane jest posiadanie płatnego klucza licencyjnego. Klucz ten pozwala na aktywację i regularne aktualizacje, zapewniając maksymalny poziom ochrony przed zagrożeniami.
</p>
<p><strong>Jak uzyskać klucz licencyjny?</strong></p>
<p>
Aby uzyskać klucz licencyjny, prosimy o kontakt . Skontaktuj się z nami, a chętnie pomożemy w doborze odpowiedniego planu licencyjnego, dostosowanego do Twoich potrzeb.
</p>
<p>
Dziękujemy za zaufanie i wybór naszego oprogramowania!</p>
<p>Kontakt z nami pod <a href="mailto:consultations@when2update.com">consultations@when2update.com</a> | <a href="{$a}" target="_blank" rel="noopener noreferrer"">when2update.com</a></p>';
$string['notselected'] = 'Nie wybrano';
$string['tries'] = 'Próby skanowania';
$string['tries_desc'] = 'Liczba prób podjętych przez Safe LMS AV, jeśli podczas procesu skanowania wystąpił błąd.';
$string['tries_notice'] = 'Safe LMS AV podjął próbę skanowania {$a->tries} raz {$a->notice}';
$string['virusfound'] = 'Plik "{$a->item}" został przeskanowany i wykryto, że jest zainfekowany!';
$string['valideaccepttermsofservice'] = 'Przed zapisaniem klucza API musisz zaakcepotwać nasz regulamin';
