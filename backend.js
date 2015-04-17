/*
######################################################################################################################
#
#	PURPOSE OF THIS FILE:
#	Provides external Javascript Routines for the use in the module backend (modify.php, tool.php)
#
#	INVOKED BY:
#	With WB 2.6.6 a new function was implemented which automatically links an external module backend.js
#	file to the <head></head> section of a page. The backend.js is optional. If you want make use
#	of this option, simply place a backend.js file with the Javascript routines into the module directory.
#
#	Website Baker versions below 2.6.6 will ignore this file!!!
# 	The backend.js file is automatically invoked by Website Baker when login into the backend
#	
#	NOTE:
#	All Javascript functions have to stick to the following naming conventions:
#	mod_MODULE_DIRECTORY_XXXX_b
#
#	mod:	shows that the Javascript routine is defined within a module
#	MODULE_DIRECTORY:	unique identifier to prevent that Javascript routines are overwritten by other modules
#	XXXX:	your function name
#	b:	identifier for the backend
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

function mod_helloworld_show_message_b($msg) {
  alert($msg);
}