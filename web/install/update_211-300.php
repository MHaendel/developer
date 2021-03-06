﻿<?php
/**
 * File: update_211-300.php.
 * Author: Ulrich Block
 *
 * Contact: <ulrich.block@easy-wi.com>
 *
 * This file is part of Easy-WI.
 *
 * Easy-WI is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * Easy-WI is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with Easy-WI.  If not, see <http://www.gnu.org/licenses/>.
 *
 * Diese Datei ist Teil von Easy-WI.
 *
 * Easy-WI ist Freie Software: Sie koennen es unter den Bedingungen
 * der GNU General Public License, wie von der Free Software Foundation,
 * Version 3 der Lizenz oder (nach Ihrer Wahl) jeder spaeteren
 * veroeffentlichten Version, weiterverbreiten und/oder modifizieren.
 *
 * Easy-WI wird in der Hoffnung, dass es nuetzlich sein wird, aber
 * OHNE JEDE GEWAEHELEISTUNG, bereitgestellt; sogar ohne die implizite
 * Gewaehrleistung der MARKTFAEHIGKEIT oder EIGNUNG FUER EINEN BESTIMMTEN ZWECK.
 * Siehe die GNU General Public License fuer weitere Details.
 *
 * Sie sollten eine Kopie der GNU General Public License zusammen mit diesem
 * Programm erhalten haben. Wenn nicht, siehe <http://www.gnu.org/licenses/>.
 */

if (isset($include) and $include==true) {
$insert_easywi_version=$sql->prepare("UPDATE `easywi_version` SET `version`='3.00', `de`='<div align=\"right\">13.05.2012</div>
<b>Neuerungen und &Auml;nderungen:</b><br/>
<ul>
<li>CMS wurde hinzugef&uuml;gt.</li>
<li>Die Protectionanzeige, das Verleihmodul und das Impressum kann sowohl losgel&ouml;st, als auch im CMS genutzt werden.</li>
<li>Neues Layout f&uuml;r die Adminoberfl&auml;che.</li>
<li>Umfangreichere Sortier- und Dataminingfunktionen.</li>
<li>Neues dynamisches Menu.</li>
<li>Minecraft Serverquery hinzugef&uuml;gt (getestet mit Minecraft und Bukkit).</li>
<li>Der Startbefehl f&uuml;r Gameserver  wurde um die Platzhalter %user% und %folder% f&uuml;r etwaige Pfadangaben erweitert.</li>
<li>Das Verwenden von POST f&uuml;r die Seiten Navigation wurde durch GET ersetzt.</li>
<li>IP Bans k&ouml;nnen nun eingesehen und entfernt werden.</li>
<li>Die Rechteverwaltung geschieht nun &uuml;ber Gruppen.</li>
<li>An Stelle von \"su username -> command -> password\" wird nun \"su -c command username -> password\" verwendet.</li>
<li>&Uuml;bersichten wurden um mehr Details und Sortierfunktionen erweitert.</li>
<li>Beim Userswitch hat der Switchende nun die selben Rechten wie der Zieluser.</li>
<li>Beim Importieren von TS3 Servern wird die tsdns_settings.ini nicht mehr &uuml;berschrieben, sondern nur fehlende Eintr&auml;ge erg&auml;nzt.</li>
</ul>
<br />
<b>Bugfixes:</b><br/>
<ul>
<li>Problem behoben, dass bei einer FTP Passwort&auml;nderung eines Users mit mehreren Servern nur f&uuml;r einen Server das Passwort ge&auml;ndert wird.</li>
<li>&Uuml;berfl&uuml;ssige Fehleranzeige, dass keine Datenbank mit dem Gameserver angelegt werden konnte, wurde beim Gameserveredit entfernt.</li>
<li>PHP Notice Meldung im Restartplaner f&uuml;r Server ohne die M&ouml;glichkeit von VAC entfernt.</li>
<li>Zu Servern von deaktivierten Usern werden keine Backups mehr erstellt.</li>
<li>Im Gameserverbackup Modul wurde ein False Positive entfernt, der auch dann einen Fehler anzeigte, wenn das backup erfolgreich eingespielt, oder erstellt wurde.</li>
<li>Die Headerinformation, dass es sich um XML handelt, wird nun bei den APIs mitgesendet.</li>
<li>Regex f&uuml;r Startparameter l&auml;sst nun Unreal Turnament basierende Server zu.</li>
<li>Wenn der TS3 Masterserver offline ist, dann werden die einzelnen Voiceserver auf dem Masterserver auch als offline angezeigt.</li>
</ul>', en='<div align=\"right\">05.13.2012</div>
<b>Changes and new functions:</b><br/>
<ul>
<li>Added CMS.</li>
<li>The protectioncheck, lend module and imprint can now be used with the cms and standalone.</li>
<li>New Layout for the adminpanel.</li>
<li>Increased and improved sort and datamining functions.</li>
<li>New more dynamic menu.</li>
<li>Added Minecraft Serverquery (testet with Minecraft and Bukkit).</li>
<li>Added the placeholders %user% and %folder% to the startcommand for gameservers for paths and similar.</li>
<li>Replaced POST with GET for page navigation.</li>
<li>IP bans can be seen and removed now.</li>
<li>Permissions are handeld with usergroups.</li>
<li>Previous command execution \"su username -> command -> password\" is replaced with \"su -c command username\"</li>
<li>Overviews are extended with more details and ways to sort the displayed data.</li>
<li>If the userswitch is used the permissions of the user you switch to are being used.</li>
<li>When importing a TS3 server the old tsdns_settings.ini will be only extended not completely overwritten.</li>
</ul>
<br />
<b>Bugfixes:</b><br/>
<ul>
<li>Solved the issue that a user with multiple gameservers changed only the ftp accessdata for one gameserver instead of all.</li>
<li>Not needed error reporting at gameserver edit which tells that a database could not been added even if this action has not been choosen removed.</li>
<li>Removed PHP notice at the restartplaner for gameservers without VAC.</li>
<li>Backups for servers that belong to deactivated users are no longer created.</li>
<li>Fixed false positive at the gameserver backup module which caused to display always an error even if the useraction was succesful.</li>
<li>Headerinformation \"this is XML\" is now being send with the APIs responses.</li>
<li>Regex reagrding startcommand edited so that Unreal Turnament based server can be added.</li>
<li>If an TS3 masterserver is offline the installed virtual server are shown as offline too.</li>
</ul>' WHERE `version`='2.11'");
$insert_easywi_version->execute();
$response->add('Action: insert_easywi_version done: ');
$error=$insert_easywi_version->errorinfo();
$insert_easywi_version->closecursor();
if (isset($error[2]) and $error[2] != '' and $error[2] != null and !isinteger($error[2])) $response->add($error[2].'<br />');
else $response->add('OK<br />');

} else {
	echo "Error: this file needs to be included by the updater!<br />";
}
?>