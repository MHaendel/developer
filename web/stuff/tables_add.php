<?php
/**
 * File: tables_add.php.
 * Author: Ulrich Block
 * Date: 07.05.12
 * Time: 20:27
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


if (!isset($admin_id) or !isset($reseller_id) or $main!=1 or $reseller_id != 0) {
    header('Location: admin.php');
    die('No Acces');
}

$query="CREATE TABLE IF NOT EXISTS `addons` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `active` enum('Y','N') NOT NULL DEFAULT 'N',
  `paddon` enum('Y','N') DEFAULT 'N',
  `shorten` varchar(20) NOT NULL,
  `addon` varchar(15) NOT NULL,
  `type` enum('tool','map') DEFAULT 'tool',
  `folder` varchar(255) DEFAULT NULL,
  `menudescription` varchar(30) CHARACTER SET utf8 NOT NULL,
  `configs` text DEFAULT NULL,
  `cmd` text DEFAULT NULL,
  `rmcmd` text DEFAULT NULL,
  `depending` int(10) unsigned DEFAULT 0,
  `resellerid` int(10) unsigned DEFAULT 0,
  PRIMARY KEY (`id`),KEY(`resellerid`)
) ENGINE=InnoDB";
$add=$sql->prepare($query);
$add->execute();

$query="CREATE TABLE IF NOT EXISTS `addons_installed` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `userid` int(10) unsigned NOT NULL,
  `addonid` int(10) unsigned NOT NULL,
  `serverid` int(10) unsigned NOT NULL,
  `servertemplate` smallint(1) unsigned DEFAULT '1',
  `paddon` enum('Y','N') DEFAULT 'N',
  `resellerid` int(10) unsigned DEFAULT 0,
  PRIMARY KEY (`id`),KEY(`userid`),KEY(`addonid`),KEY(`serverid`),KEY(`resellerid`)
) ENGINE=InnoDB";
$add=$sql->prepare($query);
$add->execute();

$query="CREATE TABLE IF NOT EXISTS `api_ips` (
  `ip` varchar(15) NOT NULL,
  `resellerID` int(10) unsigned DEFAULT 0,
  PRIMARY KEY (`ip`,`resellerID`)
) ENGINE=InnoDB";
$add=$sql->prepare($query);
$add->execute();

$query="CREATE TABLE IF NOT EXISTS `api_settings` (
  `active` enum('Y','N') NOT NULL DEFAULT 'N',
  `user` varchar(255) NOT NULL,
  `pwd` BLOB,
  `salt` BLOB,
  `userID` int(10) unsigned DEFAULT NULL,
  `resellerID` int(10) unsigned DEFAULT 0,
  PRIMARY KEY (`resellerID`),KEY(`userID`)
) ENGINE=InnoDB";
$add=$sql->prepare($query);
$add->execute();

$query="CREATE TABLE IF NOT EXISTS `api_external_auth` (
  `active` enum('Y','N') NOT NULL DEFAULT 'N',
  `ssl` enum('Y','N') NOT NULL DEFAULT 'N',
  `user` varchar(255) NOT NULL,
  `pwd` BLOB,
  `domain` varchar(255) NOT NULL,
  `file` varchar(255) NOT NULL,
  `resellerID` int(10) unsigned DEFAULT 0,
  PRIMARY KEY (`domain`),KEY(`resellerID`)
) ENGINE=InnoDB";
$add=$sql->prepare($query);
$add->execute();

$query="CREATE TABLE IF NOT EXISTS `api_import` (
  `importID` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `active` enum('Y','N') NOT NULL DEFAULT 'Y',
  `fetchUpdates` enum('Y','N') NOT NULL DEFAULT 'Y',
  `token` varchar(255) NOT NULL,
  `chunkSize` int(11) NOT NULL DEFAULT '100',
  `ssl` enum('Y','N') NOT NULL DEFAULT 'N',
  `domain` varchar(255) NOT NULL,
  `file` varchar(255) NOT NULL,
  `groupID` int(10) unsigned,
  `lastID` varchar(255),
  `lastCheck` datetime,
  `resellerID` int(10) unsigned DEFAULT 0,
  PRIMARY KEY (`importID`),KEY(`groupID`),KEY(`resellerID`)
) ENGINE=InnoDB";
$add=$sql->prepare($query);
$add->execute();

$query="CREATE TABLE IF NOT EXISTS `badips` (
  `id` bigint(19) unsigned NOT NULL AUTO_INCREMENT,
  `badip` varchar(15) NOT NULL,
  `bantime` datetime NOT NULL,
  `failcount` smallint(2) unsigned DEFAULT '0',
  `reason` varchar(15) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB";
$add=$sql->prepare($query);
$add->execute();

$query="CREATE TABLE IF NOT EXISTS `custom_columns` (
  `customID` int(10) unsigned NOT NULL,
  `itemID` int(10) unsigned NOT NULL,
  `var` VARCHAR(255) NOT NULL,
  PRIMARY KEY (`customID`),KEY (`itemID`)
) ENGINE=InnoDB";
$add=$sql->prepare($query);
$add->execute();

$query="CREATE TABLE IF NOT EXISTS `custom_columns_settings` (
  `customID` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `active` enum('Y','N') NOT NULL DEFAULT 'Y',
  `item` enum('D','G','S','T','U','V') NOT NULL,
  `type` enum('I','V') NOT NULL,
  `length` int(10) unsigned,
  `name` VARCHAR(255) NOT NULL,
  PRIMARY KEY (`customID`),KEY(`item`)
) ENGINE=InnoDB";
$add=$sql->prepare($query);
$add->execute();

$query="CREATE TABLE IF NOT EXISTS `eac` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `active` enum('Y','N') DEFAULT 'N',
  `ip` varchar(15) DEFAULT NULL,
  `port` blob,
  `user` blob,
  `pass` blob,
  `publickey` enum('Y','N') DEFAULT NULL,
  `keyname` varchar(15) DEFAULT NULL,
  `cfgdir` varchar(255) DEFAULT NULL,
  `normal_3` enum('Y','N') DEFAULT 'Y',
  `normal_4` enum('Y','N') DEFAULT 'Y',
  `hlds_3` enum('Y','N') DEFAULT 'Y',
  `hlds_4` enum('Y','N') DEFAULT 'Y',
  `hlds_5` enum('Y','N') DEFAULT 'Y',
  `hlds_6` enum('Y','N') DEFAULT 'Y',
  `notified` int(11) unsigned DEFAULT '0',
  `resellerid` int(10) unsigned DEFAULT 0,
  PRIMARY KEY (`id`),KEY(`resellerid`)
) ENGINE=InnoDB";
$add=$sql->prepare($query);
$add->execute();

$query="CREATE TABLE IF NOT EXISTS `easywi_version` (
  `id` smallint(1) unsigned NOT NULL AUTO_INCREMENT,
  `version` decimal(4,2) NOT NULL DEFAULT '3.30',
  `de` text COLLATE utf8_unicode_ci,
  `en` text COLLATE utf8_unicode_ci,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB";
$add=$sql->prepare($query);
$add->execute();

$query="CREATE TABLE IF NOT EXISTS `feeds_news` (
  `newsID` bigint(19) unsigned NOT NULL AUTO_INCREMENT,
  `feedID` int(10) unsigned NOT NULL,
  `active` enum('Y','N') DEFAULT 'Y',
  `title` varchar(255) NOT NULL,
  `link` text,
  `pubDate` datetime,
  `description` TEXT,
  `content` TEXT,
  `author` varchar(255) NOT NULL,
  `resellerID` int(10) unsigned DEFAULT 0,
  PRIMARY KEY (`newsID`),KEY(`feedID`),KEY(`resellerID`)
) ENGINE=InnoDB";
$add=$sql->prepare($query);
$add->execute();

$query="CREATE TABLE IF NOT EXISTS `feeds_settings` (
  `settingsID` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `active` enum('Y','N') DEFAULT 'Y',
  `merge` enum('Y','N') DEFAULT 'Y',
  `displayContent` enum('Y','N') DEFAULT 'N',
  `orderBy` enum('I','D') DEFAULT 'D',
  `limitDisplay` enum('Y','N') DEFAULT 'Y',
  `useLocal` enum('Y','N') DEFAULT 'Y',
  `steamFeeds` enum('Y','N') DEFAULT 'Y',
  `maxChars` int(6) unsigned DEFAULT '300',
  `newsAmount` smallint(3) unsigned DEFAULT '4',
  `updateMinutes` int(10) unsigned DEFAULT '15',
  `lastUpdate` datetime,
  `maxKeep` int(11) unsigned DEFAULT '200',
  `resellerID` int(10) unsigned DEFAULT 0,
  PRIMARY KEY (`settingsID`),KEY(`resellerID`)
) ENGINE=InnoDB";
$add=$sql->prepare($query);
$add->execute();

$query="CREATE TABLE IF NOT EXISTS `feeds_url` (
  `feedID` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `active` enum('Y','N') DEFAULT 'Y',
  `twitter` enum('Y','N') DEFAULT 'N',
  `feedUrl` varchar(255),
  `loginName` varchar(255),
  `modified` datetime,
  `resellerID` int(10) unsigned DEFAULT 0,
  PRIMARY KEY (`feedID`),KEY(`resellerID`)
) ENGINE=InnoDB";
$add=$sql->prepare($query);
$add->execute();

$query="CREATE TABLE IF NOT EXISTS `gserver_restarts` (
  `id` bigint(19) unsigned NOT NULL AUTO_INCREMENT,
  `template` smallint(1) unsigned NOT NULL,
  `anticheat` smallint(1) unsigned DEFAULT '1',
  `protected` enum('Y','N') DEFAULT 'N',
  `backup` enum('Y','N') DEFAULT 'N',
  `upload` enum('Y','N') DEFAULT 'N',
  `worldsafe` enum('Y','N') DEFAULT 'N',
  `restart` enum('Y','N') DEFAULT 'Y',
  `restarttime` varchar(6) DEFAULT NULL,
  `switchID` int(10) unsigned DEFAULT NULL,
  `gsswitch` varchar(255) DEFAULT NULL,
  `map` varchar(30) DEFAULT NULL,
  `mapGroup` varchar(255) DEFAULT NULL,
  `userid` int(10) unsigned DEFAULT NULL,
  `resellerid` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),KEY(`switchID`),KEY(`userid`),KEY(`resellerid`)
) ENGINE=InnoDB";
$add=$sql->prepare($query);
$add->execute();

$query="CREATE TABLE IF NOT EXISTS `gsswitch` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `active` enum('Y','N') NOT NULL DEFAULT 'Y',
  `autoRestart` enum('Y','N') DEFAULT 'Y',
  `userid` int(10) unsigned NOT NULL,
  `rootID` int(10) unsigned NOT NULL,
  `serverid` int(10) unsigned NOT NULL,
  `lendserver` enum('Y','N') NOT NULL DEFAULT 'N',
  `backup` enum('Y','N') DEFAULT NULL,
  `stopped` enum('Y','N') DEFAULT 'N',
  `running` enum('Y','N') NOT NULL DEFAULT 'Y',
  `pallowed` enum('Y','N') NOT NULL DEFAULT 'N',
  `eacallowed` enum('Y','N') NOT NULL DEFAULT 'N',
  `protected` enum('Y','N') NOT NULL DEFAULT 'N',
  `brandname` enum('Y','N') DEFAULT 'N',
  `tvenable` enum('Y','N') NOT NULL DEFAULT 'N',
  `war` enum('Y','N') NOT NULL DEFAULT 'Y',
  `ftppassword` blob,
  `ppassword` blob,
  `psince` datetime DEFAULT NULL,
  `serverip` varchar(15) NOT NULL,
  `port` smallint(5) unsigned DEFAULT NULL,
  `port2` smallint(5) unsigned DEFAULT NULL,
  `port3` smallint(5) unsigned DEFAULT NULL,
  `port4` smallint(5) unsigned DEFAULT NULL,
  `port5` smallint(5) unsigned DEFAULT NULL,
  `minram` int(10) unsigned DEFAULT NULL,
  `maxram` int(10) unsigned DEFAULT NULL,
  `slots` smallint(4) unsigned DEFAULT NULL,
  `masterfdl` enum('Y','N') NOT NULL DEFAULT 'Y',
  `mfdldata` varchar(255) DEFAULT NULL,
  `taskset` enum('Y','N') DEFAULT 'N',
  `cores` varchar(255) DEFAULT NULL,
  `notified` int(11) unsigned DEFAULT '0',
  `secnotified` enum('Y','N') DEFAULT 'N',
  `newlayout` enum('Y','N') DEFAULT 'Y',
  `queryName` varchar(255) NOT NULL,
  `queryNumplayers` smallint(3) unsigned NOT NULL,
  `queryMaxplayers` smallint(3) unsigned NOT NULL,
  `queryMap` varchar(40) NOT NULL,
  `queryPassword` enum('Y','N') NOT NULL,
  `queryUpdatetime` datetime DEFAULT NULL,
  `externalID` varchar(255) DEFAULT NULL,
  `jobPending` enum('Y','N') DEFAULT 'N',
  `resellerid` int(10) unsigned DEFAULT 0,
  PRIMARY KEY (`id`),KEY(`userid`),KEY(`rootID`),KEY(`serverid`),KEY(`resellerid`)
) ENGINE=InnoDB";
$add=$sql->prepare($query);
$add->execute();

$query="CREATE TABLE IF NOT EXISTS `imprints` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `language` varchar(2) NOT NULL,
  `imprint` text COLLATE utf8_unicode_ci,
  `resellerid` int(10) unsigned DEFAULT 0,
  PRIMARY KEY (`id`),KEY(`resellerid`)
) ENGINE=InnoDB";
$add=$sql->prepare($query);
$add->execute();

$query="CREATE TABLE IF NOT EXISTS `jobs` (
  `jobID` bigint(19) unsigned NOT NULL AUTO_INCREMENT,
  `hostID` int(10) unsigned NULL,
  `affectedID` int(10) unsigned NULL,
  `userID` int(10) unsigned NULL,
  `invoicedByID` int(10) unsigned NULL,
  `api` enum('A','U','S') NOT NULL DEFAULT 'A',
  `type` varchar(2) NOT NULL,
  `name` varchar(255) NULL,
  `status` smallint(1) unsigned DEFAULT NULL,
  `action` varchar(2) NOT NULL,
  `date` datetime,
  `extraData` text,
  `resellerID` int(10) unsigned DEFAULT 0,
  PRIMARY KEY (`jobID`),KEY(`hostID`),KEY(`affectedID`),KEY(`userID`),KEY(`invoicedByID`),KEY(`resellerID`)
) ENGINE=InnoDB";
$add=$sql->prepare($query);
$add->execute();

$query="CREATE TABLE IF NOT EXISTS `lendedserver` (
  `id` bigint(19) unsigned NOT NULL AUTO_INCREMENT,
  `serverid` int(10) unsigned NOT NULL,
  `servertype` varchar(1) NOT NULL DEFAULT 'g',
  `rcon` varchar(60) DEFAULT NULL,
  `password` varchar(20) DEFAULT NULL,
  `slots` smallint(3) unsigned DEFAULT NULL,
  `started` datetime NOT NULL,
  `lendtime` smallint(4) unsigned NOT NULL,
  `lenderip` varchar(15) DEFAULT NULL,
  `ftpuploadpath` blob,
  `resellerid` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),KEY(`serverid`),KEY(`resellerid`)
) ENGINE=InnoDB";
$add=$sql->prepare($query);
$add->execute();

$query="CREATE TABLE IF NOT EXISTS `lendsettings` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `active` enum('Y','N') NOT NULL DEFAULT 'N',
  `userGame` enum('A','B','R') NOT NULL DEFAULT 'B',
  `gameVoice` enum('A','B','R') NOT NULL DEFAULT 'B',
  `mintime` smallint(3) NOT NULL DEFAULT '20',
  `maxtime` smallint(4) NOT NULL DEFAULT '120',
  `timesteps` smallint(3) NOT NULL DEFAULT '20',
  `minplayer` smallint(3) NOT NULL DEFAULT '2',
  `maxplayer` smallint(3) NOT NULL DEFAULT '12',
  `playersteps` smallint(3) NOT NULL DEFAULT '2',
  `mintimeRegistered` smallint(3) NOT NULL DEFAULT '20',
  `maxtimeRegistered` smallint(4) NOT NULL DEFAULT '120',
  `timestepsRegistered` smallint(3) NOT NULL DEFAULT '20',
  `minplayerRegistered` smallint(3) NOT NULL DEFAULT '2',
  `maxplayerRegistered` smallint(3) NOT NULL DEFAULT '12',
  `playerstepsRegistered` smallint(3) NOT NULL DEFAULT '2',
  `vomintime` smallint(3) unsigned NOT NULL DEFAULT '20',
  `vomaxtime` smallint(4) unsigned NOT NULL DEFAULT '120',
  `votimesteps` smallint(3) unsigned NOT NULL DEFAULT '20',
  `vominplayer` smallint(3) unsigned NOT NULL DEFAULT '2',
  `vomaxplayer` smallint(3) unsigned NOT NULL DEFAULT '12',
  `voplayersteps` smallint(3) unsigned NOT NULL DEFAULT '2',
  `vomintimeRegistered` smallint(3) unsigned NOT NULL DEFAULT '20',
  `vomaxtimeRegistered` smallint(4) unsigned NOT NULL DEFAULT '120',
  `votimestepsRegistered` smallint(3) unsigned NOT NULL DEFAULT '20',
  `vominplayerRegistered` smallint(3) unsigned NOT NULL DEFAULT '2',
  `vomaxplayerRegistered` smallint(3) unsigned NOT NULL DEFAULT '12',
  `voplayerstepsRegistered` smallint(3) unsigned NOT NULL DEFAULT '2',
  `shutdownempty` enum('Y','N') NOT NULL DEFAULT 'Y',
  `shutdownemptytime` smallint(3) NOT NULL DEFAULT '5',
  `ftpupload` enum('A','R','Y','N') NOT NULL DEFAULT 'Y',
  `ftpuploadpath` blob,
  `lendaccess` smallint(1) NOT NULL DEFAULT '1',
  `resellerid` bigint(19) NOT NULL,
  `lastcheck` datetime NOT NULL,
  `oldcheck` datetime NOT NULL,
  PRIMARY KEY (`id`),KEY(`resellerid`)
) ENGINE=InnoDB";
$add=$sql->prepare($query);
$add->execute();

$query="CREATE TABLE IF NOT EXISTS `lendstats` (
  `lendDate` datetime NOT NULL,
  `serverID` int(10) unsigned NOT NULL,
  `serverType` enum('v','g') NOT NULL,
  `lendtime` smallint(3) unsigned NOT NULL,
  `slots` smallint(3) unsigned NOT NULL,
  `resellerID` int(10) unsigned NOT NULL,
  PRIMARY KEY (`lendDate`,`serverID`,`serverType`),KEY(`resellerID`)
) ENGINE=InnoDB";
$add=$sql->prepare($query);
$add->execute();

$query="CREATE TABLE IF NOT EXISTS `mail_log` (
  `id` bigint(19) unsigned NOT NULL AUTO_INCREMENT,
  `uid` int(10) unsigned DEFAULT NULL,
  `topic` varchar(255) NOT NULL,
  `date` datetime NOT NULL,
  `resellerid` int(10) unsigned DEFAULT 0,
  PRIMARY KEY (`id`),KEY(`uid`),KEY(`resellerid`)
) ENGINE=InnoDB";
$add=$sql->prepare($query);
$add->execute();

#https://github.com/easy-wi/developer/issues/61 add module management
$query="CREATE TABLE IF NOT EXISTS `modules` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `get` varchar(255) NOT NULL,
  `file` varchar(255) NOT NULL,
  `sub` varchar(2) NOT NULL,
  `active` enum('Y','N') DEFAULT 'Y',
  `type` enum('A','C','P','U') DEFAULT 'A',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1001;";
$add=$sql->prepare($query);
$add->execute();

#https://github.com/easy-wi/developer/issues/42 column description added
$query="CREATE TABLE IF NOT EXISTS `mysql_external_dbs` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `active` enum('Y','N') DEFAULT 'Y',
  `sid` int(10) unsigned NOT NULL,
  `uid` int(10) unsigned NOT NULL,
  `gsid` int(10) unsigned DEFAULT 0,
  `dbname` varchar(255) NOT NULL,
  `column` varchar(255) DEFAULT '',
  `password` blob,
  `ips` text COLLATE utf8_unicode_ci,
  `max_databases` bigint(19) unsigned DEFAULT '100',
  `max_queries_per_hour` bigint(19) unsigned DEFAULT '0',
  `max_updates_per_hour` bigint(19) unsigned DEFAULT '0',
  `max_connections_per_hour` bigint(19) unsigned DEFAULT '0',
  `max_userconnections_per_hour` bigint(19) unsigned DEFAULT '0',
  `externalID` varchar(255) DEFAULT NULL,
  `jobPending` enum('Y','N') DEFAULT 'N',
  `resellerid` int(10) unsigned DEFAULT 0,
  PRIMARY KEY (`id`),KEY(`sid`),KEY(`uid`),KEY(`gsid`),KEY(`resellerid`)
) ENGINE=InnoDB";
$add=$sql->prepare($query);
$add->execute();

$query="CREATE TABLE IF NOT EXISTS `mysql_external_servers` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `active` enum('Y','N') DEFAULT 'Y',
  `ip` varchar(15) NOT NULL,
  `port` smallint(5) unsigned DEFAULT '3306',
  `user` varchar(255) NOT NULL,
  `password` blob,
  `max_databases` bigint(19) unsigned DEFAULT '100',
  `interface` varchar(255) DEFAULT NULL,
  `max_queries_per_hour` bigint(19) unsigned DEFAULT '0',
  `max_updates_per_hour` bigint(19) unsigned DEFAULT '0',
  `max_connections_per_hour` bigint(19) unsigned DEFAULT '0',
  `max_userconnections_per_hour` bigint(19) unsigned DEFAULT '0',
  `resellerid` int(10) unsigned DEFAULT 0,
  PRIMARY KEY (`id`),KEY(`resellerid`)
) ENGINE=InnoDB";
$add=$sql->prepare($query);
$add->execute();

$query="CREATE TABLE IF NOT EXISTS `page_comments` (
  `commentID` bigint(19) unsigned NOT NULL AUTO_INCREMENT,
  `pageTextID` int(10) unsigned NOT NULL,
  `replyTo` bigint(19) unsigned DEFAULT NULL,
  `date` datetime NOT NULL,
  `comment` text,
  `authorname` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `homepage` varchar(255) DEFAULT NULL,
  `ip` varchar(15) DEFAULT NULL,
  `dns` varchar(255) DEFAULT NULL,
  `markedSpam` enum('Y','N') DEFAULT 'N',
  `spamReason` varchar(255) DEFAULT NULL,
  `moderateAccepted` enum('Y','N') DEFAULT 'Y',
  `resellerID` int(10) unsigned DEFAULT 0,
  PRIMARY KEY (`commentID`),KEY(`pageTextID`),KEY(`replyTo`),KEY(`resellerID`)
) ENGINE=InnoDB";
$add=$sql->prepare($query);
$add->execute();

$query="CREATE TABLE IF NOT EXISTS `page_downloads` (
  `fileID` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `show` enum('A','R','N','E') DEFAULT 'E',
  `order` int(10) unsigned,
  `count` int(10) unsigned,
  `description` varchar(255) DEFAULT NULL,
  `fileExtension` varchar(255) DEFAULT NULL,
  `fileName` varchar(255) DEFAULT NULL,
  `date` datetime NOT NULL,
  `resellerID` int(10) unsigned DEFAULT 0,
  PRIMARY KEY (`fileID`),KEY(`resellerID`)
) ENGINE=InnoDB";
$add=$sql->prepare($query);
$add->execute();

$query="CREATE TABLE IF NOT EXISTS `page_downloads_log` (
  `fileID` int(10) unsigned NOT NULL,
  `date` datetime NOT NULL,
  `ip` varchar(15) NOT NULL,
  `hostname` varchar(255) NOT NULL,
  `resellerID` int(10) unsigned DEFAULT 0,
  KEY (`fileID`),KEY(`resellerID`)
) ENGINE=InnoDB";
$add=$sql->prepare($query);
$add->execute();

$query="CREATE TABLE IF NOT EXISTS `page_pages` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `subpage` int(10) unsigned DEFAULT NULL,
  `released` smallint(1) unsigned DEFAULT '1',
  `sort` int(10) unsigned DEFAULT NULL,
  `authorid` int(10) unsigned DEFAULT NULL,
  `authorname` varchar(255) DEFAULT NULL,
  `date` datetime NOT NULL,
  `type` varchar(10) DEFAULT NULL,
  `img` varchar(255) DEFAULT NULL,
  `comments` enum('Y','N') DEFAULT 'N',
  `naviDisplay` enum('Y','N') DEFAULT 'Y',
  `resellerid` int(10) unsigned DEFAULT 0,
  PRIMARY KEY (`id`),KEY(`subpage`),KEY(`authorid`),KEY(`resellerid`)
) ENGINE=InnoDB";
$add=$sql->prepare($query);
$add->execute();

$query="CREATE TABLE IF NOT EXISTS `page_pages_text` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `pageid` int(10) unsigned NOT NULL,
  `language` varchar(2) CHARACTER SET utf8 NOT NULL,
  `title` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `shortlink` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `text` text CHARACTER SET utf8,
  `resellerid` int(10) unsigned DEFAULT 0,
  PRIMARY KEY (`id`),KEY(`pageid`),KEY(`resellerid`)
) ENGINE=InnoDB";
$add=$sql->prepare($query);
$add->execute();

$query="CREATE TABLE IF NOT EXISTS `page_register_questions` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `question` varchar(255) DEFAULT NULL,
  `answer` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB";
$add=$sql->prepare($query);
$add->execute();

$query="CREATE TABLE IF NOT EXISTS `page_settings` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `active` enum('Y','N') DEFAULT 'Y',
  `seo` enum('Y','N') DEFAULT 'N',
  `rssfeed` enum('Y','N') DEFAULT 'Y',
  `rssfeed_fulltext` enum('Y','N') DEFAULT 'Y',
  `rssfeed_textlength` int(11) unsigned DEFAULT 200,
  `maxnews` int(11) unsigned DEFAULT 10,
  `maxnews_sidebar` int(11) unsigned DEFAULT 3,
  `newssidebar_textlength` int(11) unsigned DEFAULT 200,
  `resellerid` int(10) unsigned DEFAULT 0,
  `defaultpage` varchar(255) DEFAULT 'home',
  `pageurl` varchar(255) DEFAULT '',
  `commentMinLength` int(11) unsigned DEFAULT 10,
  `protectioncheck` enum('Y','N') DEFAULT 'N',
  `spamFilter` enum('Y','N') DEFAULT 'Y',
  `languageFilter` enum('Y','N') DEFAULT 'Y',
  `blockLinks` enum('Y','N') DEFAULT 'Y',
  `mailRequired` enum('Y','N') DEFAULT 'Y',
  `commentsModerated` enum('Y','N') DEFAULT 'Y',
  `blockWords` text,
  `honeyPotKey` varchar(255) DEFAULT '',
  `registration` enum('N','A','M','D') DEFAULT 'N',
  `registrationQuestion` enum('Y','N') DEFAULT 'Y',
  `registrationBadEmail` text,
  `registrationBadIP` text,
  `dnsbl` enum('Y','N') DEFAULT 'Y',
  PRIMARY KEY (`id`),KEY(`resellerid`)
) ENGINE=InnoDB";
$add=$sql->prepare($query);
$add->execute();

$query="CREATE TABLE IF NOT EXISTS `page_terms` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `language` varchar(2) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `search_name` varchar(255) DEFAULT NULL,
  `type` varchar(255) DEFAULT NULL,
  `sub` int(10) unsigned DEFAULT NULL,
  `count` int(10) unsigned DEFAULT NULL,
  `resellerid` int(10) unsigned DEFAULT 0,
  PRIMARY KEY (`id`),KEY(`resellerid`)
) ENGINE=InnoDB";
$add=$sql->prepare($query);
$add->execute();

$query="CREATE TABLE IF NOT EXISTS `page_terms_used` (
  `page_id` int(10) unsigned NOT NULL DEFAULT '0',
  `term_id` int(10) unsigned NOT NULL DEFAULT '0',
  `language_id` int(10) unsigned NOT NULL DEFAULT '0',
  `resellerid` int(10) unsigned DEFAULT 0,
  PRIMARY KEY (`page_id`,`term_id`,`language_id`),KEY(`resellerid`)
) ENGINE=InnoDB";
$add=$sql->prepare($query);
$add->execute();

$query="CREATE TABLE IF NOT EXISTS `qstatshorten` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `qstat` varchar(15) NOT NULL,
  `description` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB";
$add=$sql->prepare($query);
$add->execute();

$query="CREATE TABLE IF NOT EXISTS `resellerdata` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `useractive` enum('Y','N') NOT NULL DEFAULT 'Y',
  `ips` text,
  `maxuser` int(10) unsigned DEFAULT NULL,
  `maxgserver` int(10) unsigned DEFAULT NULL,
  `maxdedis` int(10) unsigned DEFAULT NULL,
  `maxvoserver` int(10) unsigned DEFAULT NULL,
  `maxvserver` int(10) unsigned DEFAULT NULL,
  `maxuserram` int(10) DEFAULT NULL,
  `maxusermhz` int(10) unsigned DEFAULT NULL,
  `resellerid` int(10) unsigned NOT NULL,
  `resellersid` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),KEY(`resellerid`),KEY(`resellersid`)
) ENGINE=InnoDB";
$add=$sql->prepare($query);
$add->execute();

$query="CREATE TABLE IF NOT EXISTS `resellerimages` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `active` enum('Y','N') NOT NULL DEFAULT 'Y',
  `distro` varchar(50) NOT NULL,
  `description` varchar(255) NOT NULL,
  `bitversion` smallint(2) unsigned NOT NULL,
  `pxelinux` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB";
$add=$sql->prepare($query);
$add->execute();

$query="CREATE TABLE IF NOT EXISTS `rserverdata` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `active` enum('Y','N') NOT NULL DEFAULT 'Y',
  `hyperthreading` enum('Y','N') DEFAULT 'N',
  `cores` smallint(3) unsigned DEFAULT '4',
  `hostid` int(10) unsigned DEFAULT 0,
  `ip` varchar(15) NOT NULL,
  `altips` text CHARACTER SET utf8,
  `port` blob NOT NULL,
  `user` blob NOT NULL,
  `pass` blob,
  `steamAccount` BLOB,
  `steamPassword` BLOB,
  `os` varchar(255) NOT NULL,
  `bitversion` varchar(255) NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  `ftpport` smallint(5) unsigned NOT NULL DEFAULT '21',
  `publickey` enum('Y','N') NOT NULL,
  `keyname` varchar(15) DEFAULT NULL,
  `maxslots` smallint(5) unsigned DEFAULT NULL,
  `maxserver` smallint(4) unsigned DEFAULT NULL,
  `updates` smallint(1) unsigned DEFAULT '1',
  `updateMinute` smallint(2) unsigned DEFAULT NULL,
  `alreadyStartedAt` smallint(2) unsigned DEFAULT '0',
  `notified` int(11) unsigned DEFAULT '0',
  `userID` int(10) unsigned DEFAULT 0,
  `externalID` varchar(255) DEFAULT NULL,
  `resellerid` int(10) unsigned DEFAULT 0,
  PRIMARY KEY (`id`),KEY(`hostid`),KEY(`externalID`),KEY(`userID`),KEY(`resellerid`)
) ENGINE=InnoDB";
$add=$sql->prepare($query);
$add->execute();

$query="CREATE TABLE IF NOT EXISTS `rservermasterg` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `serverid` varchar(11) NOT NULL,
  `servertypeid` int(10) unsigned DEFAULT NULL,
  `localVersion` varchar(255) NULL,
  `installing` enum('Y','N') DEFAULT 'N',
  `updating` enum('Y','N') DEFAULT 'N',
  `installstarted` datetime NOT NULL,
  `resellerid` int(10) unsigned DEFAULT 0,
  PRIMARY KEY (`id`),KEY(`servertypeid`),KEY(`resellerid`)
) ENGINE=InnoDB";
$add=$sql->prepare($query);
$add->execute();

$query="CREATE TABLE IF NOT EXISTS `rootsDedicated` (
  `dedicatedID` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `active` enum('Y','N') DEFAULT 'Y',
  `status` smallint(1) unsigned NULL,
  `userID` int(10) unsigned NULL,
  `imageID` int(10) unsigned NULL,
  `pxeID` int(10) unsigned DEFAULT NULL,
  `resellerImageID` int(10) NULL,
  `description` text CHARACTER SET utf8,
  `ip` varchar(15) DEFAULT NULL,
  `ips` text,
  `initialPass` blob,
  `restart` enum('N','A','T') DEFAULT 'N',
  `useDHCP` enum('Y','N') DEFAULT 'N',
  `usePXE` enum('Y','N') DEFAULT 'N',
  `apiRequestType` enum('G','P') DEFAULT 'G',
  `apiRequestRestart` TEXT,
  `apiRequestStop` TEXT,
  `apiURL` TEXT,
  `https` enum('Y','N') DEFAULT 'N',
  `mac` varchar(17) DEFAULT NULL,
  `externalID` varchar(255) DEFAULT NULL,
  `jobPending` enum('Y','N') DEFAULT 'N',
  `notified` int(11) unsigned DEFAULT '0',
  `resellerID` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`dedicatedID`),KEY(`userID`),KEY(`externalID`),KEY(`resellerID`)
) ENGINE=InnoDB";
$add=$sql->prepare($query);
$add->execute();

$query="CREATE TABLE IF NOT EXISTS `rootsDHCP` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `active` enum('Y','N') DEFAULT 'Y',
  `ip` varchar(15) DEFAULT NULL,
  `port` blob,
  `user` blob,
  `pass` blob,
  `publickey` enum('Y','N') DEFAULT NULL,
  `keyname` varchar(15) DEFAULT NULL,
  `ips` text CHARACTER SET utf8,
  `netmask` varchar(15) DEFAULT '255.255.255.0',
  `startCmd` text,
  `dhcpFile` text,
  `subnetOptions` text,
  `description` text,
  `notified` int(11) unsigned DEFAULT '0',
  `resellerid` int(10) unsigned DEFAULT 0,
  PRIMARY KEY (`id`),KEY(`resellerid`)
) ENGINE=InnoDB";
$add=$sql->prepare($query);
$add->execute();

$query="CREATE TABLE IF NOT EXISTS `rootsPXE` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `active` enum('Y','N') DEFAULT 'Y',
  `ip` varchar(15) DEFAULT NULL,
  `port` blob,
  `user` blob,
  `pass` blob,
  `publickey` enum('Y','N') DEFAULT NULL,
  `keyname` varchar(15) DEFAULT NULL,
  `startCmd` text,
  `PXEFolder` text,
  `description` text,
  `notified` int(11) unsigned DEFAULT '0',
  `resellerid` int(10) unsigned DEFAULT 0,
  PRIMARY KEY (`id`),KEY(`resellerid`)
) ENGINE=InnoDB";
$add=$sql->prepare($query);
$add->execute();

$query="CREATE TABLE IF NOT EXISTS `serverlist` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `switchID` int(10) unsigned NOT NULL,
  `servertype` int(10) unsigned NOT NULL,
  `anticheat` smallint(1) unsigned DEFAULT '1',
  `servertemplate` smallint(1) unsigned DEFAULT '1',
  `fps` varchar(5) DEFAULT NULL,
  `map` varchar(255) DEFAULT NULL,
  `mapGroup` varchar(255) DEFAULT NULL,
  `workshopCollection` int(10) unsigned NULL,
  `webapiAuthkey` blob,
  `cmd` text NOT NULL,
  `modcmd` text NULL,
  `tic` varchar(5) DEFAULT NULL,
  `gamemod` enum('Y','N') NOT NULL DEFAULT 'N',
  `gamemod2` varchar(15) DEFAULT NULL,
  `owncmd` enum('Y','N') NOT NULL DEFAULT 'N',
  `userfps` enum('Y','N') NOT NULL DEFAULT 'N',
  `usertick` enum('Y','N') NOT NULL DEFAULT 'N',
  `usermap` enum('Y','N') NOT NULL DEFAULT 'Y',
  `userconfig` enum('Y','N') NOT NULL DEFAULT 'Y',
  `user_uploaddir` enum('Y','N') DEFAULT 'N',
  `upload` smallint(1) unsigned DEFAULT '0',
  `uploaddir` blob,
  `resellerid` int(10) unsigned DEFAULT 0,
  PRIMARY KEY (`id`),KEY(`switchID`),KEY(`servertype`),KEY(`resellerid`)
) ENGINE=InnoDB";
$add=$sql->prepare($query);
$add->execute();

$query="CREATE TABLE IF NOT EXISTS `servertypes` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `steamgame` enum('Y','N','S') NOT NULL DEFAULT 'Y',
  `appID` int(10) unsigned,
  `steamVersion` varchar(20) NULL,
  `updates` smallint(1) unsigned DEFAULT '1',
  `shorten` varchar(20) NOT NULL,
  `description` varchar(255) NULL,
  `type` varchar(12) NOT NULL,
  `gamebinary` varchar(20) NOT NULL,
  `binarydir` varchar(255) DEFAULT NULL,
  `modfolder` varchar(255) DEFAULT NULL,
  `fps` varchar(5) DEFAULT NULL,
  `slots` int(10) unsigned NOT NULL,
  `map` varchar(255) DEFAULT NULL,
  `mapGroup` varchar(255) DEFAULT NULL,
  `cmd` text NOT NULL,
  `modcmds` text,
  `tic` varchar(5) DEFAULT NULL,
  `qstat` varchar(30) DEFAULT NULL,
  `gamemod` enum('Y','N') NOT NULL DEFAULT 'N',
  `gamemod2` varchar(15) DEFAULT NULL,
  `configs` text,
  `configedit` text COLLATE utf8_unicode_ci,
  `iptables` text,
  `protectedSaveCFGs` text,
  `qstatpassparam` varchar(20) DEFAULT NULL,
  `portStep` smallint(4) unsigned NOT NULL DEFAULT 100,
  `portMax` smallint(1) unsigned NOT NULL DEFAULT 4,
  `portOne` smallint(5) unsigned NOT NULL DEFAULT 27015,
  `portTwo` smallint(5) unsigned DEFAULT 27016,
  `portThree` smallint(5) unsigned DEFAULT 27017,
  `portFour` smallint(5) unsigned DEFAULT 27018,
  `portFive` smallint(5) unsigned DEFAULT 27019,
  `protected` enum('Y','N') NOT NULL DEFAULT 'Y',
  `downloadPath` text,
  `resellerid` int(10) unsigned DEFAULT 0,
  PRIMARY KEY (`id`),KEY(`appID`),KEY(`resellerid`)
) ENGINE=InnoDB";
$add=$sql->prepare($query);
$add->execute();

$query="CREATE TABLE IF NOT EXISTS `settings` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `version` decimal(4,2) DEFAULT '3.30',
  `releasenotesDE` INT(11) unsigned NULL,
  `releasenotesEN` INT(11) unsigned NULL,
  `language` varchar(2) NOT NULL,
  `template` varchar(50) DEFAULT 'default',
  `imageserver` blob,
  `licence` text,
  `master` enum('Y','N') NOT NULL DEFAULT 'N',
  `voice_autobackup` enum('Y','N') DEFAULT 'Y',
  `voice_autobackup_intervall` smallint(5) unsigned DEFAULT '5',
  `voice_maxbackup` smallint(5) unsigned DEFAULT '5',
  `prefix1` enum('Y','N') NOT NULL DEFAULT 'Y',
  `prefix2` varchar(15) NOT NULL,
  `faillogins` smallint(2) unsigned NOT NULL DEFAULT '5',
  `resellerid` int(10) unsigned DEFAULT 0,
  `brandname` varchar(50) DEFAULT NULL,
  `timezone` varchar(3) DEFAULT '0',
  `email` varchar(50) NOT NULL,
  `email_settings_host` varchar(255),
  `email_settings_password` blob,
  `email_settings_port` int(5) DEFAULT '143',
  `email_settings_ssl` enum('N','S','T') DEFAULT 'N',
  `email_settings_type` enum('P','S','D') DEFAULT 'P',
  `email_settings_user` varchar(255),
  `emailregards` text COLLATE utf8_unicode_ci,
  `emailfooter` text COLLATE utf8_unicode_ci,
  `emailbackup` blob,
  `emailbackuprestore` blob,
  `emaildown` blob,
  `emaildownrestart` blob,
  `emailgserverupdate` blob,
  `emailpwrecovery` blob,
  `emailregister` blob,
  `emailsecuritybreach` blob,
  `emailnewticket` blob,
  `emailuseradd` blob,
  `emailvinstall` blob,
  `emailvrescue` blob,
  `supportnumber` varchar(50) DEFAULT NULL,
  `noservertag` smallint(1) unsigned NOT NULL DEFAULT '1',
  `nopassword` smallint(1) unsigned NOT NULL DEFAULT '1',
  `tohighslots` smallint(1) unsigned NOT NULL DEFAULT '1',
  `paneldomain` varchar(255) DEFAULT NULL,
  `down_checks` smallint(1) unsigned DEFAULT '2',
  `lastUpdateRun` smallint(2) unsigned,
  `lastCronStatus` int(11) unsigned DEFAULT NULL,
  `lastCronWarnStatus` enum('Y','N') NOT NULL DEFAULT 'Y',
  `lastCronReboot` int(11) unsigned DEFAULT NULL,
  `lastCronWarnReboot` enum('Y','N') NOT NULL DEFAULT 'Y',
  `lastCronUpdates` int(11) unsigned DEFAULT NULL,
  `lastCronWarnUpdates` enum('Y','N') NOT NULL DEFAULT 'Y',
  `lastCronJobs` int(11) unsigned DEFAULT NULL,
  `lastCronWarnJobs` enum('Y','N') NOT NULL DEFAULT 'Y',
  `lastCronCloud` int(11) unsigned DEFAULT NULL,
  `lastCronWarnCloud` enum('Y','N') NOT NULL DEFAULT 'Y',
  PRIMARY KEY (`id`),KEY(`resellerid`)
) ENGINE=InnoDB";
$add=$sql->prepare($query);
$add->execute();

$query="CREATE TABLE IF NOT EXISTS `tickets` (
  `id` bigint(19) unsigned NOT NULL AUTO_INCREMENT,
  `writedate` datetime DEFAULT NULL,
  `topic` varchar(30) DEFAULT NULL,
  `userid` int(10) unsigned NOT NULL,
  `rating` smallint(1) unsigned DEFAULT NULL,
  `comment` text,
  `priority` smallint(1) unsigned DEFAULT NULL,
  `userPriority` smallint(1) unsigned DEFAULT NULL,
  `supporter` int(10) unsigned DEFAULT NULL,
  `state` enum('A','C','D','N','P','R') DEFAULT 'N',
  `resellerid` int(10) unsigned DEFAULT 0,
  PRIMARY KEY (`id`),KEY(`supporter`),KEY(`resellerid`)
) ENGINE=InnoDB";
$add=$sql->prepare($query);
$add->execute();

$query="CREATE TABLE IF NOT EXISTS `tickets_text` (
  `ticketID` bigint(19) unsigned DEFAULT NULL,
  `userID` int(10) unsigned NOT NULL,
  `writeDate` datetime DEFAULT NULL,
  `message` text,
  `resellerID` int(10) unsigned DEFAULT 0,
  KEY(`ticketID`),KEY(`userID`),KEY(`resellerID`)
) ENGINE=InnoDB";
$add=$sql->prepare($query);
$add->execute();

$query="CREATE TABLE IF NOT EXISTS `ticket_topics` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `topic` varchar(30) NOT NULL,
  `maintopic` int(10) unsigned DEFAULT NULL,
  `priority` smallint(1) unsigned DEFAULT NULL,
  `resellerid` int(10) unsigned DEFAULT 0,
  PRIMARY KEY (`id`),KEY(`resellerid`)
) ENGINE=InnoDB";
$add=$sql->prepare($query);
$add->execute();

$query="CREATE TABLE IF NOT EXISTS `traffic_data` (
  `id` bigint(19) unsigned NOT NULL AUTO_INCREMENT,
  `serverid` bigint(19) unsigned DEFAULT NULL,
  `ip` varchar(15) DEFAULT NULL,
  `in` bigint(19) unsigned DEFAULT '0',
  `out` bigint(19) unsigned DEFAULT '0',
  `day` datetime DEFAULT NULL,
  `userid` bigint(19) unsigned DEFAULT NULL,
  `resellerid` bigint(19) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),KEY(`serverid`),KEY(`userid`),KEY(`resellerid`)
) ENGINE=InnoDB";
$add=$sql->prepare($query);
$add->execute();

$query="CREATE TABLE IF NOT EXISTS `traffic_data_day` (
  `id` bigint(19) unsigned NOT NULL AUTO_INCREMENT,
  `serverid` bigint(19) unsigned DEFAULT NULL,
  `ip` varchar(15) DEFAULT NULL,
  `in` bigint(19) unsigned DEFAULT '0',
  `out` bigint(19) unsigned DEFAULT '0',
  `day` datetime DEFAULT NULL,
  `userid` bigint(19) unsigned DEFAULT NULL,
  `resellerid` bigint(19) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),KEY(`serverid`),KEY(`userid`),KEY(`resellerid`)
) ENGINE=InnoDB";
$add=$sql->prepare($query);
$add->execute();

$query="CREATE TABLE IF NOT EXISTS `traffic_settings` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `type` varchar(30) NOT NULL DEFAULT 'mysql',
  `statip` varchar(50) DEFAULT NULL,
  `dbname` blob,
  `dbuser` blob,
  `dbpassword` blob,
  `multiplier` int(10) unsigned DEFAULT '10',
  `table_name` varchar(30) DEFAULT NULL,
  `column_sourceip` varchar(30) DEFAULT NULL,
  `column_destip` varchar(30) DEFAULT NULL,
  `column_byte` varchar(30) DEFAULT NULL,
  `column_date` varchar(30) DEFAULT NULL,
  `text_colour_1` smallint(3) unsigned DEFAULT '0',
  `text_colour_2` smallint(3) unsigned DEFAULT '0',
  `text_colour_3` smallint(3) unsigned DEFAULT '0',
  `barin_colour_1` smallint(3) unsigned DEFAULT '0',
  `barin_colour_2` smallint(3) unsigned DEFAULT '206',
  `barin_colour_3` smallint(3) unsigned DEFAULT '209',
  `barout_colour_1` smallint(3) unsigned DEFAULT '0',
  `barout_colour_2` smallint(3) unsigned DEFAULT '191',
  `barout_colour_3` smallint(3) unsigned DEFAULT '255',
  `bartotal_colour_1` smallint(3) unsigned DEFAULT '30',
  `bartotal_colour_2` smallint(3) unsigned DEFAULT '144',
  `bartotal_colour_3` smallint(3) unsigned DEFAULT '255',
  `bg_colour_1` smallint(3) unsigned DEFAULT '240',
  `bg_colour_2` smallint(3) unsigned DEFAULT '240',
  `bg_colour_3` smallint(3) unsigned DEFAULT '255',
  `border_colour_1` smallint(3) unsigned DEFAULT '200',
  `border_colour_2` smallint(3) unsigned DEFAULT '200',
  `border_colour_3` smallint(3) unsigned DEFAULT '200',
  `line_colour_1` smallint(3) unsigned DEFAULT '220',
  `line_colour_2` smallint(3) unsigned DEFAULT '220',
  `line_colour_3` smallint(3) unsigned DEFAULT '220',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB";
$add=$sql->prepare($query);
$add->execute();

$query="CREATE TABLE IF NOT EXISTS `translations` (
  `type` varchar(2) NOT NULL,
  `lang` varchar(2) NOT NULL,
  `transID` varchar(255) NOT NULL,
  `resellerID` int(10) unsigned NOT NULL DEFAULT '0',
  `text` text,
  PRIMARY KEY (`type`,`lang`,`transID`,`resellerID`)
) ENGINE=InnoDB";
$add=$sql->prepare($query);
$add->execute();

$query="CREATE TABLE IF NOT EXISTS `userdata` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `creationTime` datetime,
  `updateTime` datetime,
  `active` enum('Y','N','R') NOT NULL DEFAULT 'Y',
  `salutation` smallint(1),
  `cname` varchar(255) NOT NULL,
  `security` blob NOT NULL,
  `salt` varchar(32) DEFAULT NULL,
  `token` varchar(32) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `vname` varchar(255) DEFAULT NULL,
  `mail` varchar(50) NOT NULL,
  `birthday` datetime,
  `country` varchar(2),
  `fax` varchar(50),
  `phone` varchar(50) DEFAULT NULL,
  `handy` varchar(50) DEFAULT NULL,
  `city` varchar(50) DEFAULT NULL,
  `cityn` varchar(6) DEFAULT NULL,
  `street` varchar(50) DEFAULT NULL,
  `streetn` varchar(15) DEFAULT NULL,
  `fdlpath` varchar(255) DEFAULT NULL,
  `ftpbackup` blob,
  `language` varchar(2) DEFAULT NULL,
  `lastlogin` datetime NOT NULL,
  `logintime` datetime DEFAULT NULL,
  `accounttype` varchar(1) DEFAULT NULL,
  `mail_backup` enum('Y','N') DEFAULT 'Y',
  `mail_gsupdate` enum('Y','N') DEFAULT 'Y',
  `mail_securitybreach` enum('Y','N') DEFAULT 'Y',
  `mail_serverdown` enum('Y','N') DEFAULT 'Y',
  `mail_ticket` enum('Y','N') DEFAULT 'Y',
  `mail_vserver` enum('Y','N') DEFAULT 'Y',
  `externalID` varchar(255) DEFAULT NULL,
  `jobPending` enum('Y','N') DEFAULT 'N',
  `sourceSystemID` varchar(255) NULL,
  `resellerid` int(10) unsigned DEFAULT 0,
  PRIMARY KEY (`id`),KEY(`resellerid`)
) ENGINE=InnoDB";
$add=$sql->prepare($query);
$add->execute();

#https://github.com/easy-wi/developer/issues/5
$query="CREATE TABLE IF NOT EXISTS `userdata_value_log` (
  `userID` int(10) unsigned NOT NULL,
  `date` datetime NOT NULL,
  `json` text NOT NULL,
  `resellerID` int(10) unsigned DEFAULT 0,
  KEY (`userID`),KEY(`resellerID`)
) ENGINE=InnoDB";
$add=$sql->prepare($query);
$add->execute();

#https://github.com/easy-wi/developer/issues/2
$query="CREATE TABLE IF NOT EXISTS `userdata_substitutes` (
  `sID` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `userID` int(10) unsigned NOT NULL,
  `active` enum('Y','N') NOT NULL DEFAULT 'Y',
  `loginName` varchar(255) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `vname` varchar(255) DEFAULT NULL,
  `salt` varchar(32) NOT NULL,
  `passwordHashed` blob,
  `language` varchar(2) DEFAULT NULL,
  `lastlogin` datetime NOT NULL,
  `logintime` datetime DEFAULT NULL,
  `resellerID` int(10) unsigned DEFAULT 0,
  PRIMARY KEY (`sID`),KEY(`userID`),KEY(`resellerID`),KEY(`loginName`)
) ENGINE=InnoDB";
$add=$sql->prepare($query);
$add->execute();

$query="CREATE TABLE IF NOT EXISTS `userdata_substitutes_servers` (
  `sID` int(10) unsigned NOT NULL,
  `oType` varchar(2) NOT NULL,
  `oID` int(10) unsigned NOT NULL,
  `resellerID` int(10) unsigned DEFAULT 0,
  PRIMARY KEY (`sID`,`oType`,`oID`),KEY(`resellerID`)
) ENGINE=InnoDB";
$add=$sql->prepare($query);
$add->execute();

$query="CREATE TABLE IF NOT EXISTS `userdata_groups` (
  `userID` int(10) unsigned NOT NULL,
  `groupID` int(10) unsigned NOT NULL,
  `resellerID` int(10) unsigned DEFAULT 0,
  PRIMARY KEY (`userID`,`groupID`),KEY(`resellerID`)
) ENGINE=InnoDB";
$add=$sql->prepare($query);
$add->execute();

$query="CREATE TABLE IF NOT EXISTS `usergroups` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `defaultgroup` enum('Y','N') DEFAULT 'N',
  `active` enum('Y','N') DEFAULT 'Y',
  `name` varchar(255) DEFAULT NULL,
  `grouptype` ENUM('a','r','u') DEFAULT 'u',
  `root` enum('Y','N') DEFAULT 'N',
  `miniroot` enum('Y','N') DEFAULT 'N',
  `settings` enum('Y','N') DEFAULT 'N',
  `log` enum('Y','N') DEFAULT 'N',
  `ipBans` enum('Y','N') DEFAULT 'N',
  `updateEW` enum('Y','N') DEFAULT 'N',
  `feeds` enum('Y','N') DEFAULT 'N',
  `jobs` enum('Y','N') DEFAULT 'N',
  `apiSettings` enum('Y','N') DEFAULT 'N',
  `cms_settings` enum('Y','N') DEFAULT 'N',
  `cms_pages` enum('Y','N') DEFAULT 'N',
  `cms_news` enum('Y','N') DEFAULT 'N',
  `cms_comments` enum('Y','N') DEFAULT 'N',
  `mysql_settings` enum('Y','N') DEFAULT 'N',
  `mysql` enum('Y','N') DEFAULT 'N',
  `user` enum('Y','N') DEFAULT 'N',
  `user_users` enum('Y','N') DEFAULT 'N',
  `userGroups` enum('Y','N') DEFAULT 'N',
  `userPassword` enum('Y','N') DEFAULT 'N',
  `roots` enum('Y','N') DEFAULT 'N',
  `masterServer` enum('Y','N') DEFAULT 'N',
  `gserver` enum('Y','N') DEFAULT 'N',
  `eac` enum('Y','N') DEFAULT 'N',
  `gimages` enum('Y','N') DEFAULT 'N',
  `addons` enum('Y','N') DEFAULT 'N',
  `restart` enum('Y','N') DEFAULT 'N',
  `gsResetting` enum('Y','N') DEFAULT 'N',
  `modfastdl` enum('Y','N') DEFAULT 'N',
  `fastdl` enum('Y','N') DEFAULT 'Y',
  `useraddons` enum('Y','N') DEFAULT 'N',
  `usersettings` enum('Y','N') DEFAULT 'N',
  `ftpaccess` enum('Y','N') DEFAULT 'N',
  `tickets` enum('Y','N') DEFAULT 'N',
  `usertickets` enum('Y','N') DEFAULT 'N',
  `addvserver` enum('Y','N') DEFAULT 'N',
  `modvserver` enum('Y','N') DEFAULT 'N',
  `delvserver` enum('Y','N') DEFAULT 'N',
  `usevserver` enum('Y','N') DEFAULT 'N',
  `vserversettings` enum('Y','N') DEFAULT 'N',
  `dhcpServer` enum('Y','N') DEFAULT 'N',
  `pxeServer` enum('Y','N') DEFAULT 'N',
  `dedicatedServer` enum('Y','N') DEFAULT 'N',
  `resellertemplates` enum('Y','N') DEFAULT 'N',
  `vserverhost` enum('Y','N') DEFAULT 'N',
  `lendserver` enum('Y','N') DEFAULT 'N',
  `lendserverSettings` enum('Y','N') DEFAULT 'N',
  `voicemasterserver` enum('Y','N') DEFAULT 'N',
  `voiceserver` enum('Y','N') DEFAULT 'N',
  `voiceserverStats` enum('Y','N') DEFAULT 'N',
  `voiceserverSettings` enum('Y','N') DEFAULT 'N',
  `ftpbackup` enum('Y','N') DEFAULT 'N',
  `traffic` enum('Y','N') DEFAULT 'N',
  `trafficsettings` enum('Y','N') DEFAULT 'N',
  `resellerid` int(10) unsigned DEFAULT 0,
  PRIMARY KEY (`id`),KEY(`resellerid`)
)";
$add=$sql->prepare($query);
$add->execute();

$query="CREATE TABLE IF NOT EXISTS `userlog` (
  `id` bigint(19) unsigned NOT NULL AUTO_INCREMENT,
  `userid` int(10) unsigned NOT NULL,
  `subuser` int(10) unsigned DEFAULT 0,
  `reseller` int(10) unsigned DEFAULT 0,
  `username` varchar(255) NOT NULL,
  `usertype` varchar(12) NOT NULL,
  `useraction` varchar(255) NOT NULL,
  `ip` varchar(15) NOT NULL,
  `hostname` varchar(255) NOT NULL,
  `logdate` datetime NOT NULL,
  `resellerid` int(10) unsigned DEFAULT 0,
  PRIMARY KEY (`id`),KEY(`userid`),KEY(`subuser`),KEY(`reseller`),KEY(`resellerid`)
) ENGINE=InnoDB";
$add=$sql->prepare($query);
$add->execute();

$query="CREATE TABLE IF NOT EXISTS `userpermissions` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `root` enum('Y','N') NOT NULL DEFAULT 'N',
  `log` enum('Y','N') DEFAULT 'N',
  `addons` enum('Y','N') DEFAULT 'N',
  `cms_settings` enum('Y','N') DEFAULT 'N',
  `cms_pages` enum('Y','N') DEFAULT 'N',
  `cms_news` enum('Y','N') DEFAULT 'N',
  `cms_comments` enum('Y','N') DEFAULT 'N',
  `gimages` enum('Y','N') DEFAULT 'N',
  `settings` enum('Y','N') NOT NULL DEFAULT 'N',
  `gserver` enum('Y','N') NOT NULL DEFAULT 'N',
  `restart` enum('Y','N') DEFAULT 'N',
  `reseting` enum('Y','N') DEFAULT 'N',
  `miniroot` enum('Y','N') NOT NULL DEFAULT 'N',
  `user_users` enum('N','Y') DEFAULT 'N',
  `userid` int(10) unsigned NOT NULL,
  `user` enum('Y','N') DEFAULT 'N',
  `roots` enum('Y','N') NOT NULL DEFAULT 'N',
  `modfastdl` enum('Y','N') NOT NULL DEFAULT 'N',
  `fastdl` enum('Y','N') DEFAULT 'N',
  `useraddons` enum('Y','N') NOT NULL DEFAULT 'N',
  `usersettings` enum('Y','N') DEFAULT 'N',
  `ftpaccess` enum('Y','N') DEFAULT 'N',
  `tickets` enum('Y','N') DEFAULT 'N',
  `usertickets` enum('Y','N') DEFAULT 'N',
  `resellerid` int(10) unsigned DEFAULT 0,
  `addvserver` enum('Y','N') DEFAULT 'N',
  `modvserver` enum('Y','N') DEFAULT 'N',
  `delvserver` enum('Y','N') DEFAULT 'N',
  `usevserver` enum('Y','N') DEFAULT 'N',
  `vserversettings` enum('Y','N') DEFAULT 'N',
  `vserverhost` enum('Y','N') DEFAULT 'N',
  `voicemasterserver` enum('Y','N') DEFAULT 'N',
  `voiceserver` enum('Y','N') DEFAULT 'N',
  `resellertemplates` enum('Y','N') DEFAULT 'N',
  `ftpbackup` enum('Y','N') DEFAULT 'N',
  `traffic` enum('Y','N') DEFAULT 'N',
  `trafficsettings` enum('Y','N') DEFAULT 'N',
  `lendserver` enum('Y','N') DEFAULT 'N',
  PRIMARY KEY (`id`),KEY(`userid`),KEY(`resellerid`)
) ENGINE=InnoDB";
$add=$sql->prepare($query);
$add->execute();

$query="CREATE TABLE IF NOT EXISTS `virtualcontainer` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `imageid` int(10) unsigned DEFAULT NULL,
  `userid` int(10) unsigned DEFAULT NULL,
  `hostid` int(10) unsigned DEFAULT NULL,
  `pxeID` int(10) unsigned DEFAULT NULL,
  `active` enum('Y','N') NOT NULL DEFAULT 'Y',
  `ip` varchar(15) NOT NULL,
  `ips` text,
  `mac` varchar(17) DEFAULT NULL,
  `port` blob NOT NULL,
  `pass` blob,
  `cores` smallint(3) unsigned NOT NULL,
  `minmhz` smallint(5) unsigned NOT NULL,
  `maxmhz` smallint(5) unsigned DEFAULT NULL,
  `hddsize` smallint(4) unsigned NOT NULL,
  `mountpoint` varchar(255) NOT NULL,
  `ram` varchar(5) NOT NULL,
  `minram` smallint(6) DEFAULT NULL,
  `maxram` smallint(6) DEFAULT NULL,
  `status` smallint(1) unsigned DEFAULT NULL,
  `notified` int(11) unsigned DEFAULT '0',
  `externalID` varchar(255) DEFAULT NULL,
  `initialInstallPending` enum('Y','N') DEFAULT 'Y',
  `jobPending` enum('Y','N') DEFAULT 'N',
  `resellerid` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),KEY(`imageid`),KEY(`userid`),KEY(`hostid`),KEY(`resellerid`)
) ENGINE=InnoDB";
$add=$sql->prepare($query);
$add->execute();

$query="CREATE TABLE IF NOT EXISTS `virtualhosts` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `active` enum('Y','N') NOT NULL DEFAULT 'Y',
  `esxi` enum('Y','N') DEFAULT 'N',
  `ip` varchar(15) NOT NULL,
  `port` blob NOT NULL,
  `user` blob NOT NULL,
  `pass` blob,
  `os` varchar(255) NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  `publickey` enum('Y','N') DEFAULT 'Y',
  `keyname` varchar(30) DEFAULT NULL,
  `cpu` varchar(30) NOT NULL,
  `cores` smallint(3) unsigned NOT NULL,
  `mhz` smallint(5) unsigned NOT NULL,
  `hdd` text NOT NULL,
  `ram` varchar(5) NOT NULL,
  `maxserver` smallint(3) unsigned DEFAULT NULL,
  `thin` enum('Y','N') DEFAULT 'N',
  `thinquota` smallint(2) unsigned DEFAULT '50',
  `notified` int(11) unsigned DEFAULT '0',
  `resellerid` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),KEY(`resellerid`)
) ENGINE=InnoDB";
$add=$sql->prepare($query);
$add->execute();

$query="CREATE TABLE IF NOT EXISTS `voice_dns` (
  `dnsID` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `active` enum('Y','N') DEFAULT 'Y',
  `dns` varchar(255) DEFAULT NULL,
  `ip` varchar(15) NOT NULL,
  `port` smallint(5) unsigned DEFAULT NULL,
  `tsdnsID` int(10) unsigned NOT NULL,
  `userID` int(10) unsigned NOT NULL,
  `externalID` varchar(255) DEFAULT NULL,
  `jobPending` enum('Y','N') DEFAULT 'N',
  `resellerID` int(10) unsigned DEFAULT 0,
  PRIMARY KEY (`dnsID`),KEY(`tsdnsID`),KEY(`userID`),KEY(`resellerID`)
) ENGINE=InnoDB";
$add=$sql->prepare($query);
$add->execute();

// https://github.com/easy-wi/developer/issues/36 managedByUser, managedForID added
$query="CREATE TABLE IF NOT EXISTS `voice_masterserver` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `active` enum('Y','N') DEFAULT 'Y',
  `type` varchar(30) NOT NULL DEFAULT 'ts3',
  `usedns` enum('Y','N') DEFAULT 'Y',
  `tsdnsServerID` int(10) unsigned DEFAULT NULL,
  `externalDefaultDNS` enum('Y','N') DEFAULT 'N',
  `defaultdns` varchar(255) DEFAULT NULL,
  `defaultname` varchar(255) DEFAULT NULL,
  `defaultwelcome` varchar(255) DEFAULT NULL,
  `defaulthostbanner_url` varchar(255) DEFAULT NULL,
  `defaulthostbanner_gfx_url` varchar(255) DEFAULT NULL,
  `defaulthostbutton_tooltip` varchar(255) DEFAULT NULL,
  `defaulthostbutton_url` varchar(255) DEFAULT NULL,
  `defaulthostbutton_gfx_url` varchar(255) DEFAULT NULL,
  `defaultFlexSlotsFree` int(11) DEFAULT '5',
  `defaultFlexSlotsPercent` smallint(3) DEFAULT '80',
  `queryport` smallint(5) unsigned DEFAULT NULL,
  `querypassword` blob,
  `filetransferport` smallint(5) unsigned DEFAULT NULL,
  `maxserver` int(10) unsigned DEFAULT NULL,
  `maxslots` int(10) unsigned DEFAULT NULL,
  `rootid` int(10) unsigned DEFAULT NULL,
  `addedby` smallint(1) unsigned NOT NULL DEFAULT '1',
  `publickey` enum('Y','N') DEFAULT 'Y',
  `ssh2ip` varchar(15) DEFAULT NULL,
  `ips` text COLLATE utf8_unicode_ci,
  `ssh2port` blob,
  `ssh2user` blob,
  `ssh2password` blob,
  `bitversion` smallint(2) unsigned NOT NULL,
  `serverdir` varchar(255) DEFAULT NULL,
  `keyname` varchar(50) DEFAULT NULL,
  `notified` int(11) unsigned DEFAULT '0',
  `autorestart` enum('Y','N') DEFAULT 'Y',
  `externalID` varchar(255) DEFAULT NULL,
  `managedServer` enum('Y','N') DEFAULT 'Y',
  `managedForID` int(10) unsigned DEFAULT NULL,
  `resellerid` int(10) unsigned DEFAULT 0,
  PRIMARY KEY (`id`),KEY(`tsdnsServerID`),KEY(`rootid`),KEY(`resellerid`),KEY(`externalID`)
) ENGINE=InnoDB";
$add=$sql->prepare($query);
$add->execute();

$query="CREATE TABLE IF NOT EXISTS `voice_server` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `active` enum('Y','N') DEFAULT 'Y',
  `autoRestart` enum('Y','N') DEFAULT 'Y',
  `backup` enum('Y','N') DEFAULT 'Y',
  `lendserver` enum('Y','N') NOT NULL DEFAULT 'N',
  `userid` int(10) unsigned NOT NULL,
  `masterserver` int(10) unsigned NOT NULL,
  `ip` varchar(15) NOT NULL,
  `port` smallint(5) unsigned DEFAULT NULL,
  `slots` int(10) unsigned NOT NULL DEFAULT '50',
  `initialpassword` varchar(255) DEFAULT NULL,
  `password` enum('Y','N') DEFAULT 'Y',
  `forcebanner` enum('Y','N') DEFAULT 'Y',
  `forcebutton` enum('Y','N') DEFAULT 'Y',
  `forceservertag` enum('Y','N') DEFAULT 'Y',
  `forcewelcome` enum('Y','N') DEFAULT 'Y',
  `flexSlots` enum('Y','N') DEFAULT 'N',
  `flexSlotsFree` int(11) unsigned DEFAULT '10',
  `flexSlotsPercent` smallint(3) unsigned DEFAULT '80',
  `flexSlotsCurrent` int(19) unsigned DEFAULT '0',
  `max_download_total_bandwidth` bigint(19) DEFAULT '65536',
  `max_upload_total_bandwidth` bigint(19) DEFAULT '65536',
  `localserverid` int(10) unsigned,
  `dns` varchar(255) DEFAULT NULL,
  `usedslots` int(10) unsigned DEFAULT NULL,
  `uptime` bigint(19) unsigned DEFAULT NULL,
  `maxtraffic` bigint(19) DEFAULT '2048',
  `filetraffic` bigint(19) unsigned DEFAULT NULL,
  `lastfiletraffic` bigint(19) unsigned DEFAULT NULL,
  `serverCreated` date DEFAULT NULL,
  `queryName` varchar(255) NOT NULL,
  `queryNumplayers` smallint(3) unsigned NOT NULL,
  `queryMaxplayers` smallint(3) unsigned NOT NULL,
  `queryPassword` enum('Y','N') NOT NULL,
  `queryUpdatetime` datetime DEFAULT NULL,
  `notified` int(11) unsigned DEFAULT '0',
  `externalID` varchar(255) DEFAULT NULL,
  `jobPending` enum('Y','N') DEFAULT 'N',
  `resellerid` int(10) unsigned DEFAULT 0,
  PRIMARY KEY (`id`),KEY(`userid`),KEY(`masterserver`),KEY(`localserverid`),KEY(`resellerid`)
) ENGINE=InnoDB";
$add=$sql->prepare($query);
$add->execute();

$query="CREATE TABLE IF NOT EXISTS `voice_server_backup` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `sid` int(10) unsigned NOT NULL,
  `uid` int(10) unsigned DEFAULT NULL,
  `name` varchar(50) DEFAULT NULL,
  `snapshot` blob,
  `channels` text,
  `date` datetime DEFAULT NULL,
  `resellerid` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),KEY(`sid`),KEY(`uid`),KEY(`resellerid`)
) ENGINE=InnoDB";
$add=$sql->prepare($query);
$add->execute();

$query="CREATE TABLE IF NOT EXISTS `voice_server_stats` (
  `sid` int(10) unsigned NOT NULL,
  `mid` int(10) unsigned NOT NULL,
  `installed` decimal(6,2) unsigned NOT NULL,
  `used` decimal(6,2) unsigned NOT NULL,
  `date` datetime DEFAULT NULL,
  `uid` int(10) unsigned DEFAULT NULL,
  `count` bigint(19) unsigned DEFAULT 0,
  `resellerid` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`sid`,`date`),KEY(`mid`),KEY(`uid`),KEY(`resellerid`)
) ENGINE=InnoDB";
$add=$sql->prepare($query);
$add->execute();

$query="CREATE TABLE IF NOT EXISTS `voice_server_stats_hours` (
  `sid` int(10) unsigned NOT NULL,
  `mid` int(10) unsigned NOT NULL,
  `installed` decimal(6,2) unsigned NOT NULL,
  `used` decimal(6,2) unsigned NOT NULL,
  `date` datetime DEFAULT NULL,
  `uid` int(10) unsigned DEFAULT NULL,
  `count` bigint(19) unsigned DEFAULT 0,
  `resellerid` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`sid`,`date`),KEY(`mid`),KEY(`uid`),KEY(`resellerid`)
) ENGINE=InnoDB";
$add=$sql->prepare($query);
$add->execute();

$query="CREATE TABLE IF NOT EXISTS `voice_stats_settings` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `text_colour_1` smallint(3) unsigned DEFAULT '0',
  `text_colour_2` smallint(3) unsigned DEFAULT '0',
  `text_colour_3` smallint(3) unsigned DEFAULT '0',
  `barin_colour_1` smallint(3) unsigned DEFAULT '0',
  `barin_colour_2` smallint(3) unsigned DEFAULT '206',
  `barin_colour_3` smallint(3) unsigned DEFAULT '209',
  `barout_colour_1` smallint(3) unsigned DEFAULT '0',
  `barout_colour_2` smallint(3) unsigned DEFAULT '191',
  `barout_colour_3` smallint(3) unsigned DEFAULT '255',
  `bg_colour_1` smallint(3) unsigned DEFAULT '240',
  `bg_colour_2` smallint(3) unsigned DEFAULT '240',
  `bg_colour_3` smallint(3) unsigned DEFAULT '255',
  `border_colour_1` smallint(3) unsigned DEFAULT '200',
  `border_colour_2` smallint(3) unsigned DEFAULT '200',
  `border_colour_3` smallint(3) unsigned DEFAULT '200',
  `line_colour_1` smallint(3) unsigned DEFAULT '220',
  `line_colour_2` smallint(3) unsigned DEFAULT '220',
  `line_colour_3` smallint(3) unsigned DEFAULT '220',
  `resellerid` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),KEY(`resellerid`)
) ENGINE=InnoDB";
$add=$sql->prepare($query);
$add->execute();

$query="CREATE TABLE IF NOT EXISTS `voice_tsdns` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `active` enum('Y','N') DEFAULT 'Y',
  `defaultdns` varchar(255) DEFAULT NULL,
  `rootid` int(10) unsigned DEFAULT NULL,
  `publickey` enum('Y','N') DEFAULT 'Y',
  `ssh2ip` varchar(15) DEFAULT NULL,
  `ssh2port` blob,
  `ssh2user` blob,
  `ssh2password` blob,
  `bitversion` smallint(2) unsigned NOT NULL,
  `serverdir` varchar(255) DEFAULT NULL,
  `keyname` varchar(50) DEFAULT NULL,
  `notified` int(11) unsigned DEFAULT '0',
  `autorestart` enum('Y','N') DEFAULT 'Y',
  `description` TEXT,
  `resellerid` int(10) unsigned DEFAULT 0,
  PRIMARY KEY (`id`),KEY(`rootid`),KEY(`resellerid`)
) ENGINE=InnoDB";
$add=$sql->prepare($query);
$add->execute();