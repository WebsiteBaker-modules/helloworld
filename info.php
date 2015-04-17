<?php

######################################################################################################################
#
#	PURPOSE OF THIS FILE:
#	This file provides the module information required by Website Baker and provided information about the choosen
#	module licence and the module author. 
#
#	INVOKED BY:
#	This file is automatically invoked by Website Baker during installation/uninstallation and when a module is
#	shown in the frontend or backend.
#
#	LIST OF VARIABLES AND FUNCTIONS USED IN THIS FILE:
#		MODULE INFORMATION REQUIRED BY WEBSITE BAKER:
#		$module_directory:	must not exist, will be created automatically by the WB installation process
#		$modue name:			module name (added to the module type list in Backend -> Pages -> Add Page -> Type)
#		$module_function:		type of the module (page, tool or snippet)
#		$module_version:		required for information and for the installation/update process
#									 o if no identical module exists -> call install.php script
#									 o if module already exists and new module version < actual module version -> do nothing
#									 o if module already exists and new module version >= actual module version -> call update.php script
#		$module_platform:		the Website Baker version the tool was made for (e.g. 2.6.x)
#
#		MODULE INFORMATION AUTHOR AND LICENCSE:
#		$module_author:		list of people who contributed to the module
#		$module_licence:		licence of the module
#		$module_description:	short description of the modules purpose
#
#	NOTE:
#	It is good working practice to add a module development history to track module changes applied over time!!!
#
######################################################################################################################

/**
  Module developed for the Open Source Content Management System Website Baker (http://websitebaker.org)
  Copyright (C) year, Authors name
  Contact me: author(at)domain.xxx, http://authorwebsite.xxx

  LICENCE TERMS / LIZENZBESTIMMUNGEN:
  This module is free software. You can redistribute it and/or modify it 
  under the terms of the GNU General Public License  - version 2 or later, 
  as published by the Free Software Foundation: http://www.gnu.org/licenses/gpl.html.
  // another good choice may be the Creative Commons Licence, see http://creativecommons.org/ for details

  DISCLAIMER / HAFTUNGSAUSSCHLUSS:
  This module is distributed in the hope that it will be useful, 
  but WITHOUT ANY WARRANTY; without even the implied warranty of 
  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the 
  GNU General Public License for more details.

 -----------------------------------------------------------------------------------------
  Hello world module for Website Baker v2.6.x (http://www.websitebaker.org)
  The hello world module provides the basics for developing own modules
 -----------------------------------------------------------------------------------------
	DEVELOPMENT HISTORY:
	 v0.60  (Christian Sommer; 04 Apr, 2008)
	 + updated module to use the edit CSS functions introduced with the WB 2.7 core (only shows up if WB 2.7 or higher is used)

	 v0.52  (Christian Sommer; 03 Apr, 2008)
	 + updated edit CSS functions to include module backend.css into the <head> instead of <body> section if possible

	 v0.51  (Christian Sommer; 02 Apr, 2008)
	 + some code clean-up

	 v0.50  (Christian Sommer; 30 Mar, 2008)
	 + fixed wrong handling of stripslashes and $wb->strip_slashes(), thanks to thorn
	 + added ` quotes for all DB queries table names and fields to prevent issues with MySQL special chars like -
	 + added support for multi-lingual module description introduced with WB 2.7
	 + changed mechanism to prevent files from beeing accessed directly (redirect instead off displaying an error message)

	 v0.48  (Christian Sommer; 29 Mar, 2008)
	 + fixed issue with optional module files 
	   (it was not possible to edit the module files of module 2-x if more than one module was used on a page)

	 v0.47  (Christian Sommer; 24 Jan, 2008)
	 + re-introduced name and id attributes (but with different values)
	 	 (modified edit_css.php to make the textareas work if codepress framework is not installed)

	 v0.46  (Christian Sommer; 20 Jan, 2008)
	 + fixed issue with Codepress and Internet Explorer 7.0 on WinXP

	 v0.45  (Christian Sommer; 18 Dec, 2007)
	 + added generic solution to edit frontend.css and backend.css module files
	   HOW IT WORKS:
		 a) add files: edit_css.php and css.functions.php to your module
		 b) include css.functions.php in the modify.php of your module
		 c) call function: css_edit() in your modify.php where you want to display the Edit CSS button
		 d) customize the button style via backend.css (div.mod_moduldir_edit_css, div.mod_helloworld_edit_css a)

	 v0.44  (Christian Sommer; 12 Dec, 2007)
	 + added Dutch langauge file provided by Eki (thanks)

   v0.43  (Christian Sommer; 29/09/2007)
	 + fixed typo in comments of install.php (update.php -> upgrade.php); thanks to Ralf(Berlin)

   v0.42  (Christian Sommer; 08/07/2007)
	 + corrected some typos (version released on addons repository; replaces v0.30)

   v0.41  (Christian Sommer; 07/25/2007)
	 + hard coded all hello world DB-table names: mod_$module_directory => mod_helloworld
	   On some servers, the WB installation procedure fails if the modules DB-tables are defined
	   with the variable $module_directory defined in the info.php file. 
		 Also this error occurs only sporadically (most likely depending on server settings), it
		 is highly recommended, to hard code all module DB-tables to ensure compatibility with all
		 known systems!!
	 + added timestamp to display date/time when hello world text was added to DB
	 	 (date and time format can be defined in the language files DE/EN)
	 + added check to view.php/modify.php to include CSS definitions file to the body if the functions
	 	 register_frontend_function/register_backend_function are not available (WB < 2.6.7)

   v0.40  (Christian Sommer; 07/15/2007)
	 + the hello world module was completely rewritten from v0.30 to v0.40
	 + added purpose, loading mechanisms and variable/function description to all files
	 + added individual licence terms and disclaimer to all files
	 + added language support (GERMAN, ENGLISH)
	 + added backend.css and frontend.css introduced with WB v2.6.7
	 + added backend.js and frontend.js introduced with WB v2.6.7
	 + measures to prevent security vulnerabilities (at least pointed to important things)

   v0.30  (Matthias Gallas, MM/DD/YYYY)
    + releases hello world module on the Add-Ons repository

   v0.20  (Travis Huizenga, MM/DD/YYYY)
    + initial release of the hello world module in the WB Community forum
 -----------------------------------------------------------------------------------------
**/

// NOTE: THE VARIABLES DECLARED BELOW ARE OBLIGATORY AND NEEDS TO BE DEFINED FOR ALL MODULES

// variables required for Website Baker internal functions (install, uninstall...)
$module_directory 	= 'helloworld';						// folder where the module will be installed (must not exist!!)
$module_name 				= 'Hello World Module';		// module name (listed in Backend -> Pages -> Add Page -> Type)
$module_function 		= 'page';									// module function (either page, tool, snippet)
$module_version 		= '0.60';									// actual module version (please stick to: X.YY no chars etc.)
$module_platform 		= '2.70';									//	the WB platform you have the module designed for (required since WB 2.6.x)

// basic module information (will be shown in Backend -> Pages -> Add-Ons -> Modules -> Module Details)
$module_author 			= 'Travis Huizenga, Matthias Gallas, Christian Sommer';	//People who contributed to the module
$module_license 		= 'GNU General Public License';									// the license the modul is released
$module_description = 'This module provides the basics for developing own modules. Includes multi-languages support. The module CSS files frontend.css and backend.css can be edited from the backend from WB 2.7 onwards.';	// short description of the modules purpose



// MODULE SPECIFIC VARIABLES MAY BE DECLARED BELOW THIS LINE ....

?>