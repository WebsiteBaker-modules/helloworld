<?php

######################################################################################################################
#
#	PURPOSE OF THIS FILE:
#	This file provides clean-up functions. All database tables which are added by the module should be deleted if 
#	the module is uninstalled. This is a measure for a tidy database and good working praxis. All files contained in
#	the module directory will automatically be deleted by Website Baker itself, you do not need to care about that
#
#	INVOKED BY:
#	This file is automatically invoked by Website Baker, if you uninstall this module via the Website Baker Backend
#	Add-Ons -> Modules -> Uninstall Module
#
#	LIST OF VARIABLES AND FUNCTIONS USED IN THIS FILE:
#		CONSTANTS AND VARIABLES USED:
#		WB_PATH:					only defined if config.php was included before
#		TABLE_PREFIX:			optional prefix for all database tables defined during Installation; stored in config.php
#		$database:				provides database functions (instance of class database defined in framework/class.database.php)
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
  GNU General Public License for more details.
**/

// prevent this file from being accessed directly
if(!defined('WB_PATH')) die(header('Location: index.php'));  

// delete all database search table entries made by this module
$database->query("DELETE FROM `" .TABLE_PREFIX ."search` WHERE `name` = 'module' AND `value` = 'helloworld'");
$database->query("DELETE FROM `" .TABLE_PREFIX ."search` WHERE `extra` = 'helloworld'");

// delete the module database table
$database->query("DROP TABLE `" .TABLE_PREFIX ."mod_helloworld`");

