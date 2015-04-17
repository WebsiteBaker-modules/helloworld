<?php

######################################################################################################################
#
#	PURPOSE OF THIS FILE:
#	The view.php file contains the functionality you want to offer the users in the frontend. The functionality is 
#	driven by the purpose of the module itself.
#
#	INVOKED BY:
# 	This file is automatically invoked by Website Baker, if the module page/section is displayed on the Frontend.
#	Website Baker Frontend: Menu -> your module type
#
#	LIST OF VARIABLES AND FUNCTIONS USED IN THIS FILE:
#		CONSTANTS AND VARIABLES USED:
#		WB_PATH:					path to the WB root directory (set during installation; stored in config.php)
#		TABLE_PREFIX:			optional prefix for all database tables defined during Installation (stored in config.php)
#		LANGUAGE:				language code defined by the user (e.g. DE, EN; defined in frameworks/initialize.php)
#		$database:				provides database functions (instance of class database defined in framework/class.database.php)
#		$section_id:			ID of the currents page section (automatically set by Website Baker)
#		$sql_result:			contains the object ID of a database query
#		$sql_row:				contains all data fields (columns) of one dataset (row)
#		$simple_output:		contains the text stored in the database
#
#		VARIABLES DEFINED IN LANGUAGE FILES:
#		$MOD_HELLOWORLD['TXT_HEADING_F']:		text of the header (defined in /modules/helloworld/languages/XX.php)
#		$MOD_HELLOWORLD['TXT_DESC_F']:			some description text (defined in /modules/helloworld/languages/XX.php)
#		$MOD_HELLOWORLD['TXT_ERROR_F']:			text shown if database query is empty (defined in /modules/helloworld/languages/XX.php)
#
#		FUNCTIONS USED:
#		->query():				function to create a database query	(defined in framework/class.database.php)
#		->numRows():			returns the number of matches found (defined in framework/class.database.php)
#		->fetchRow():			function to get array with all table fields of one dataset (row); (defined in framework/class.wb.php)
#		->strip_slashes():	removes slashes from database results (defined in framework/class.wb.php)
#
#		PLEASE NOTE: 
#		Module tables have to stick to the following naming convention: TABLE_PREFIX_mod_MODULE_DIRECTORY 
#		Don´t use $module_directory! Use the string defined via $module_directory in info.php instead (here: helloworld)
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

/**
*	MODULE LANGUAGE SUPPORT IS INTRODUCED WITH THE LINES BELOW
*	NOTE: IF YOU ADD LANGUAGE SUPPORT TO YOUR MODULE, MAKE SURE THAT THE DEFAULT LANGUAGE
*	EN.. ENGLISH IS AVAILABLE IN ANY CASE
*/
// check if module language file exists for the language set by the user (e.g. DE, EN)
if(!file_exists(WB_PATH .'/modules/helloworld/languages/' .LANGUAGE .'.php')) {
	// no module language file exists for the language set by the user, include default module language file EN.php
	require_once(WB_PATH .'/modules/helloworld/languages/EN.php');
} else {
	// a module language file exists for the language defined by the user, load it
		require_once(WB_PATH .'/modules/helloworld/languages/' .LANGUAGE .'.php');
}

/**
*	INLCUDE FRONTEND.CSS INTO THE HTML BODY OF THE PAGE IF WB < 2.6.7 OR REGISTER_MODFILES FUNCTION
* IN THE INDEX.PHP OF YOUR TEMPLATE IS NOT USED
*	NOTE: THIS WAY MODULES BECOME DOWNWARD COMPATIBLE WITH OLDER WB RELEASES
*/
// check if frontend.css file needs to be included into the <body></body> of view.php
if((!function_exists('register_frontend_modfiles') || !defined('MOD_FRONTEND_CSS_REGISTERED')) && 
	file_exists(WB_PATH .'/modules/helloworld/frontend.css')) {
	echo '<style type="text/css">';
  include(WB_PATH .'/modules/helloworld/frontend.css');
  echo "\n</style>\n";
} 

/**
*	THE FUNCTIONS AND SETTINGS OF YOUR MODULE IN THE WB FRONTED ARE DEFINED BELOW THIS LINE HERE
*
*	The code below extracts the text stored in the database, removes the contained slashes and
*	outputs the clean text to the view.php. In addition the modification data/time is written out.
*	The modification date is stored as timestamp and converted into human readable format via the
*	language file. This way all outputs can be customised depending on the language.
*
*	Some CSS defininitions are used to demonstrate the usage of the external frontend.css file.
*	A dummy Javascript function call is added at the end of the script. The function itself is defined in
*	the modules frontend.js file loaded automatically by Website Baker.
*
*	KEEP IN MIND:
*	All user inputs should be treated as dangerous. You need to apply the required measures to
*	prevent that harmful code is added to the MySQL database or executed by PHP. 
*	Always think about filtering HTML/CSS/Javascript code from the user input. 
*
*	Some aspects on security:
*	Tags like <strong> can be used to deface your layout (<strong style="font-size:200px">some text</strong>)
*	Text fields can also be used for Javascript hacks: <script language="javascript">alert("You can be hacked!!")</script>
* To prevent SQL-injection, escape special characters before writting to the database. Use WB function add_slashes() 
* when dealing with data from POST, GET, COOKIES to prevent double quoting if magic_quotes is enabled in your php.ini.
*
*	Make use of: strip_tags, add_slashes, or htmlspecialchars to prevent such kind of things
*/

// obtain data from module DB-table of the current displayed page (unique page defined via section_id)
$sql_result = $database->query("SELECT * FROM `".TABLE_PREFIX."mod_helloworld` WHERE `section_id` = '$section_id'");

// check if query was sucessfull
if($sql_result->numRows() > 0) {
	// store all results (fields) in the array $sql_row
	$sql_row = $sql_result->fetchRow();

	// NOTE: if you do not want that PHP/Javascript code is parsed in the frontend, make use of strip_tags, htmlspecialchars
	// strip_tags not really required here, as tags were already removed in save.php
	$simple_output = htmlspecialchars(strip_tags($sql_row['simple_output']));

	// extract modification date/time (convert timestamp into human readable format using format string in language file)
	$last_modified = date($MOD_HELLOWORLD['DATE_FORMAT_F'], $sql_row['modified_when']);
} else {
	$simple_output = '';
	$last_modified = '';
}

// output the page heading defined in the language file
echo '<h2>'	.$MOD_HELLOWORLD['TXT_HEADING_F'] .'</h2>';

if($simple_output != '') {
	// output the hello world text from the database and the text defined in the language file
	echo '<p>' .$MOD_HELLOWORLD['TXT_DESC_F'] .': <span class="mod_helloworld_emphasise_f">' .$simple_output .'</span></p>';
	// write out modification time
	if($last_modified != "") {
		echo $MOD_HELLOWORLD['TXT_MODIFIED_F'] .$last_modified;
	}

} else { 
	// no database entry found show a warning
	echo '<p class="mod_helloworld_warning_f">' .$MOD_HELLOWORLD['TXT_ERROR_F'] .'</p>'; 
}

// use a Javascript function defined in the frontend.js (loaded to the <head> if this option is activate in the template)
echo '<p><a href="#" onClick="mod_helloworld_show_message_f(\'' .htmlspecialchars($simple_output) .'\')">' .$MOD_HELLOWORLD['TXT_LINK_F'] .'</a></p>';

?>