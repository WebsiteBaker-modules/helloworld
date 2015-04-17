/*
######################################################################################################################
#
#	PURPOSE OF THIS FILE:
#	Provides external Javascript Routines for the use in the module frontend (view.php)
#
#	INVOKED BY:
#	With WB 2.6.6 a new function was implemented which automatically links an external module frontend.js
#	file to the <head></head> section of a page. The frontend.js is optional. If you want make use
#	of this option, simply place a frontend.js file with the Javascript routiness into the module directory.
#
#	Website Baker versions below 2.6.6 will ignore this file!!!
# 	The frontend.js is invoked from the index.php of your template if you have added the following PHP code
#	lines to the index.php of your template: 
#	<head>
#	...
#	<?php
#	if(function_exists('register_frontend_modfiles')) {
#		register_frontend_modfiles('js');
#	} ?>
#	</head>
#	
#	NOTE:
#	All Javascript functions have to stick to the following naming conventions:
#	mod_MODULE_DIRECTORY_XXXX_f
#
#	mod: shows that the Javascript routine is defined within a module
#	MODULE_DIRECTORY: unique identifier to prevent that CSS styles are overwritten by other modules
#	XXXX: your function name
#	f: identifier for the frontend
#
######################################################################################################################
*/

/*
  Javascript routines for the Website Baker module: Hello world
  Copyright (C) year, Authors name
  Contact me: author(at)domain.xxx, http://authorwebsite.xxx

  The Javascript routines are free software. You can redistribute it and/or modify it 
  under the terms of the GNU General Public License  - version 2 or later, 
  as published by the Free Software Foundation: http://www.gnu.org/licenses/gpl.html.

  The Javascript routines are distributed in the hope that it will be useful, 
  but WITHOUT ANY WARRANTY; without even the implied warranty of 
  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the 
  GNU General Public License for more details.
*/


function mod_helloworld_show_message_f($msg) {
  alert($msg);
}