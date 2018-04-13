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