<?php

######################################################################################################################
#
#	PURPOSE OF THIS FILE:
#	Add a new row to the module DB-table if a new page or section is added via the Website Baker backend.
#
#	INVOKED BY:
# 	This file is automatically invoked by Website Baker, if a new page of this module type is added via the 
#	Website Baker Backend: Pages -> Add Page -> Type: your module type
#
#	LIST OF VARIABLES AND FUNCTIONS USED IN THIS FILE:
#		CONSTANTS AND VARIABLES USED:
#		WB_PATH:					only defined if config.php was included before
#		TABLE_PREFIX:			optional prefix for all database tables defined during Installation; stored in config.php
#		$database:				provides database functions (instance of class database defined in framework/class.database.php)
#		$page_id:				ID of the current displayed page (automatically set by Website Baker)
#		$section_id:			ID of the currents page section (automatically set by Website Baker)
#
#		FUNCTIONS USED:
#		$database->query		function to create a database query (defined in framework/class.database.php)
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
  GNU General Public License for more details
**/

// prevent this file from being accessed directly
if(!defined('WB_PATH')) die(header('Location: index.php'));  

//	add a new row to the module table which contains the actual page_id and section_id 
$database->query("INSERT INTO `" .TABLE_PREFIX ."mod_helloworld` (`page_id`, `section_id`) VALUES ('$page_id', '$section_id')");

?>