<?php 
/**
 * error.php - error page for auth/saml based SAML 2.0 login
 * 
 * @originalauthor Martin Dougiamas
 * @author Piers Harding - made quite a number of changes
 * @version 1.0
 * @license http://www.gnu.org/copyleft/gpl.html GNU Public License
 * @package auth/saml
 */
global $CFG, $USER, $SESSION;
error_log('auth/saml: auth failed due to some internal error - check the SP and IdP');

$USER = new stdClass();
$USER->id = 0;
require_once('../../config.php');
print_error(get_string("loginfailed", "auth_saml"));
