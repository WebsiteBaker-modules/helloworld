<?php

######################################################################################################################
#
#	PURPOSE OF THIS FILE:
#	This file contains the functionality you want to offer the users in the backend. 
#	The required functionality is driven by the purpose of your module.
#
#	INVOKED BY:
# 	This file is invoked when a user clicks on the edit page link in the Website Baker backend:
#	Pages -> Page of your module type -> Click on Page Title link
#
#	LIST OF VARIABLES AND FUNCTIONS USED IN THIS FILE:
#		CONSTANTS AND VARIABLES USED:
#		WB_PATH:					path to the WB root directory (set during installation; stored in config.php)
#		WB_URL:					URL to the WB root directory (set during installation; stored in config.php)
#		ADMIN_URL:				URL to the WB backend (set during installation; stored in config.php)
#		TABLE_PREFIX:			optional prefix for all database tables defined during Installation (stored in config.php)
#		LANGUAGE:				language code defined by the user (e.g. DE, EN; defined in frameworks/initialize.php)
#		$database:				provides database functions (instance of class database defined in framework/class.database.php)
#		$page_id:				ID of the current displayed page (automatically set by Website Baker)
#		$section_id:			ID of the currents page section (automatically set by Website Baker)
#		$sql_result:			contains the object ID of a database query
#		$sql_row:				contains all data fields (columns) of one dataset (row)
#		$_SESSION['DISPLAY_NAME']:	contains the display name of the actual user (automatically set by WB)
#
#		VARIABLES DEFINED IN LANGUAGE FILES:
#		$MOD_HELLOWORLD['TXT_HEADING_B']:		text of the header (defined in /modules/helloworl/languages/XX.php)
#		$MOD_HELLOWORLD['TXT_INPUT_DESC_B']:	description of input data (defined in /modules/helloworl/languages/XX.php)
#		$MOD_HELLOWORLD['TXT_LINK_B']:			link message for the Javascript link (defined in /modules/helloworl/languages/XX.php)
#		$TEXT['SAVE']:									caption of the SAVE button (defined in /languages/XX.php)
#		$TEXT['CANCEL']:								caption of the CANCEL button (defined in /languages/XX.php)
#
#		FUNCTIONS USED (ONLY NON PHP FUNCTIONS ARE LISTED HERE)
#		->query():				function to create a database query
#		->fetchRow():			function to get array with all table fields of one dataset (row)
#
#		PLEASE NOTE: 
#		Module tables have to stick to the following naming convention: TABLE_PREFIX_mod_MODULE_DIRECTORY 
#		Don�t use $module_directory! Use the string defined via $module_directory in info.php instead (here: helloworld)
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

// include core functions of WB 2.7 to edit the optional module CSS files (frontend.css, backend.css)
@include_once(WB_PATH .'/framework/module.functions.php');

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
*	THE FUNCTIONS AND SETTINGS OF YOUR MODULE IN THE WB BACKEND ARE DEFINED BELOW THIS LINE HERE
*
*	The code below makes extracts the output text of the current displayed page from the module
*	DB-table. If the value is empty, the default text: Hello world is used as default.
*	A HTML form is added to the modify.php file. The form provides some text read from the module
*	language file, a text field which stores the Hello world output string and two buttons: 
*	SAVE and CANCEL. In addition, two hidden fields are used to pass over the PAGE_ID and
*	SECTION_ID of the current page to the save.php page, which is invoked when the SAVE button is pressed.
*	The caption of the buttons SAVE and CANCEL is taken from the global WB lanuage file /languages/XX.php.
*	This allows that the text is shown in the language the user has choosen.
*
*	Some CSS defininitions are used to demonstrate the usage of the external backend.css file.
*	A dummy Javascript function call is added at the end of the script. The function itself is defined in
*	the modules backend.js file loaded automatically by Website Baker.
*
*	NOTE: A CANCEL BUTTON SHOULD ALWAYS BE PROVIDED, WHICH REDIRECTS THE USER TO THE BACKEND->PAGES PANEL
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
$sql_result = $database->query("SELECT * FROM `" .TABLE_PREFIX ."mod_helloworld` WHERE `section_id` = '$section_id'");

// store all results (fields) in the array $sql_row
$sql_row = $sql_result->fetchRow();

// check if the DB-Field simple_output contains a value, if not use Hello world as default value.
if ($sql_row['simple_output'] == '') {
	$sql_row['simple_output'] = 'Hello world'; 
} else {
	// Note: before displaying a string in a text field, one needs to convert special characters into entities.
	// Characters like " do not show up in text fields if not converted to entities.
	// This also prevents that embedded Javascript/PHP/HTML tags are parsed by the browser.
	$sql_row['simple_output'] = htmlspecialchars($sql_row['simple_output']);
}
	// write out heading
	echo '<h2>' .$MOD_HELLOWORLD['TXT_HEADING_B'] .'</h2>';

	// include the button to edit the optional module CSS files (function added with WB 2.7)
	// Note: CSS styles for the button are defined in backend.css (div class="mod_moduledirectory_edit_css")
	// Remember to replace the string helloworld below with the module directory of your module
	// Place this call outside of any <form></form> construct!!!
	if(function_exists('edit_module_css')) {
		edit_module_css('helloworld');
	}

	// create the form with text outputs and buttons below using mixed HTML and PHP code
	?>
	<form name="edit" action="<?php echo WB_URL; ?>/modules/helloworld/save.php" method="post" style="margin: 0;">
		<input type="hidden" name="page_id" value="<?php echo $page_id; ?>">
		<input type="hidden" name="section_id" value="<?php echo $section_id; ?>">

		<table class="mod_helloworld_table_b" cellpadding="0" cellspacing="0" border="0" width="100%">
			<tr><td>&nbsp;</td></tr>
			<tr>
				<td width="40%" valign="top">
					<?php echo $MOD_HELLOWORLD['TXT_INPUT_DESC_B']; ?>:
					<input name="simple_output" type="text" value="<?php echo $sql_row['simple_output']; ?>" style="width: 200px;">
				</td>
			</tr>
			<tr><td>&nbsp;</td></tr>
		</table>

		<table cellpadding="0" cellspacing="0" border="0" width="100%">
		<tr>
			<td align="left">
				<input name="save" type="submit" value="<?php echo $TEXT['SAVE']; ?>" style="width: 100px; margin-top: 5px;"></form>
			</td>
			<td align="right">
				<input type="button" value="<?php echo $TEXT['CANCEL']; ?>" onclick="javascript: window.location = '<?php echo ADMIN_URL; ?>/pages/index.php'; return false;" style="width: 100px; margin-top: 5px;" />
			</td>
		</tr>
	</table>

<p>
	<!-- invoke Javascript function defined in backend.js. Function outputs the display name as alert -->
	<a href="#" onClick="mod_helloworld_show_message_b('Hi, <?php echo $_SESSION['DISPLAY_NAME']; ?>')"><?php echo $MOD_HELLOWORLD['TXT_LINK_B']; ?></a>
</p>