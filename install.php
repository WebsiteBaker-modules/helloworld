<?php

######################################################################################################################
#
#	PURPOSE OF THIS FILE:
#	This file creates the module DB-tables and adds the entries to the Website Baker search table, if you want
#	that users can search information stored in the module DB-tables.
#
#	INVOKED BY:
#	Website Baker checks if a previous installation of that module exists. Only if no previous installation exist,
#	the install.php file is executed. Otherwise the upgrade.php file is called. Make sure that the $module_version
#	variable of the new module is set correct. The install.php file is automatically invoked by Website Baker, 
#	if you install this module via the Website Baker Backend: Add-Ons -> Modules -> Install Module
#
#	LIST OF VARIABLES AND FUNCTIONS USED IN THIS FILE:
#		CONSTANTS AND VARIABLES USED:
#		WB_PATH:					only defined if config.php was included before
#		TABLE_PREFIX:			optional prefix for all database tables defined during Installation; stored in config.php
#		$database:				provides database functions (instance of class database defined in framework/class.database.php)
#		$search_info:			information required for the WB search table (automatically added)
#		$page_id:				ID of the current displayed page (automatically set by Website Baker)
#		$section_id:			ID of the currents page section (automatically set by Website Baker)
#
#		FUNCTIONS USED:
#		$database->query		function to create a database query
#
#		PLEASE NOTE: 
#		Module tables have to stick to the following naming convention: TABLE_PREFIX_mod_MODULE_DIRECTORY 
#		Don´t use $module_directory! Use the string defined via $module_directory in info.php instead (here: helloworld)
#
#	ADD SEARCH FUNCTIONALITY TO YOUR MODULES:
#	If you want that users can search for information stored in your module DB-tables, you need to add the four rows to
#	the Website Baker search table. The required information to be added to the search table is shown below.
#
#		Field:	(name, 				value, 				extra)
#		Row 1: 	("module", 			"helloworld", 		$search_info)
#		Row 2: 	("query_start", 	$search_info,		"helloworld")
#		Row 3: 	("query_body", 	$search_info, 		"helloworld" 
#		Row 4: 	("query_end", 		$search_info, 		"helloworld" 
#
#	Don´t care if the lines makes no sense to you. Just follow the instructions shown in lines 77-82 :-)
#
######################################################################################################################

/**
  Module developed for the Open Source Content Management System Website Baker (http://websitebaker.org)
  Copyright (C) year, Authors name
  Contact me: author(at)domain.xxx, http://authorwebsite.xxx

  This module is free software. You can redistribute it and/or modify it 
  under the terms of the GNU General Public License  - version 2 or later, 
  as published by the Free Software Foundation: http://www.gnu.org/licenses/gpl.html.

  This module is distributed in the hope that it will be useful, 
  but WITHOUT ANY WARRANTY; without even the implied warranty of 
  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the 
  GNU General Public License for more details.
**/

// prevent this file from being accessed directly
if(!defined('WB_PATH')) die(header('Location: index.php'));  

// delete existing module DB-table (start with a clean database)
$database->query("DROP TABLE IF EXISTS `" .TABLE_PREFIX ."mod_helloworld`");

// create a new, clean module DB-table (you need to change the fields added according your needs!!!)
$mod_create_table = 'CREATE TABLE `' .TABLE_PREFIX .'mod_helloworld` ( '
	. '`section_id` INT NOT NULL DEFAULT \'0\','
	. '`page_id` INT NOT NULl DEFAULT \'0\','
	. '`simple_output` VARCHAR(255) NOT NULL DEFAULT \'\','
	. '`modified_when` INT(11) NOT NULL DEFAULT \'0\','
	. 'PRIMARY KEY (section_id)'
	. ' )';
$database->query($mod_create_table);

/**
*	ADD THE CODE BELOW TO YOUR install.php FILE IF YOU WANT THAT USERS CAN SEARCH INFORMATION STORED
*	IN YOUR MODUL DB-TABLES. IF YOUR MODULE DB-TABLES DO NOT CONTAIN ANY INFORMATION YOU WANT BE FOUND
*	BY THE WB SEARCH FUNCTION, SIMLY DELETE THE LINES BELOW. 
*  NOTE: DO NOT DELETE THE VERY LAST LINE CONTAINING THE CLOSING PHP TAG ?>
*/
# ADD 1st MODULE SEARCH ROW TO THE DATABASE
$search_info = array(
	'page_id'				=>	'page_id',
	'title'					=>	'page_title',
	'link'					=>	'link',
	'description'		=>	'description',
	'modified_when'	=>	'modified_when',
	'modfified_by'	=>	'modified_by'
	);
$search_info = serialize($search_info);
$database->query("INSERT INTO `" .TABLE_PREFIX ."search` (`name`,`value`,`extra`) 
	VALUES ('module', 'helloworld', '$search_info')");

# ADD 2nd MODULE SEARCH ROW TO THE DATABASE
$search_info = "SELECT [TP]pages.page_id, [TP]pages.page_title,	[TP]pages.link, [TP]pages.description, 
	[TP]pages.modified_when, [TP]pages.modified_by	FROM [TP]mod_helloworld, [TP]pages WHERE ";
$database->query("INSERT INTO `" .TABLE_PREFIX ."search` (`name`,`value`,`extra`) 
	VALUES ('query_start', '$search_info', 'helloworld')");

# ADD 3rd MODULE SEARCH ROW TO THE DATABASE
$search_info = " [TP]pages.page_id = [TP]mod_helloworld.page_id AND [TP]mod_helloworld.simple_output [O] \'[W][STRING][W]\' AND [TP]pages.searching = \'1\'";	
$database->query("INSERT INTO `".TABLE_PREFIX."search` (`name`,`value`,`extra`) 
	VALUES ('query_body', '$search_info', 'helloworld')");

# ADD 4th MODULE SEARCH ROW TO THE DATABASE
$search_info = "";
$database->query("INSERT INTO `".TABLE_PREFIX."search` (`name`,`value`,`extra`) 
	VALUES ('query_end', '$search_info', 'helloworld')");
	
// insert blank row to the module table (there needs to be at least on row for the search to work)
$database->query("INSERT INTO `".TABLE_PREFIX."mod_helloworld` (`page_id`,`section_id`) VALUES ('0','0')");

?>