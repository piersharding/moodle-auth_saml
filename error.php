<?php
// This file is part of Moodle - http://moodle.org/
//
// Moodle is free software: you can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation, either version 3 of the License, or
// (at your option) any later version.
//
// Moodle is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
//
// You should have received a copy of the GNU General Public License
// along with Moodle.  If not, see <http://www.gnu.org/licenses/>.

/**
 * error.php - error page for auth/saml based SAML 2.0 login
 *
 * Authentication Plugin: SAML based SSO Authentication
 * Authentication using SAML2 with SimpleSAMLphp. 
 * Based on plugins made by Sergio Gómez (moodle_ssp) and Martin Dougiamas (Shibboleth).
 * 
 * @originalauthor Martin Dougiamas
 * @author Erlend Strømsvik - Ny Media AS 
 * @author Piers Harding - made quite a number of changes
 * @author David Bezemer - Added options to deny auto-povisioning
 * @version 2.4
 * @license http://www.gnu.org/copyleft/gpl.html GNU Public License
 * @package auth/saml
 *
 **/

global $CFG, $USER, $SESSION;
error_log('auth/saml: auth failed due to some internal error - check the SP and IdP');

$USER = new object();
$USER->id = 0;
require_once('../../config.php');
print_error(get_string("loginfailed", "auth_saml"));
