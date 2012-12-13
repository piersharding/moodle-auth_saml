<?php 
/**
 * config.php - config file for auth/saml based SAML 2.0 login
 * 
 * make sure that you define both the SimpleSAMLphp lib directory and config
 * directory for the associated SP and also specify the IdP that it will talk to
 * 
 * 
 * 
 * @originalauthor Martin Dougiamas
 * @author Erlend Strømsvik - Ny Media AS 
 * @author Piers Harding - made quite a number of changes
 * @version 1.0
 * @license http://www.gnu.org/copyleft/gpl.html GNU Public License
 * @package auth/saml
 */


$SIMPLESAMLPHP_LIB = '/var/simplesamlphp';
$SIMPLESAMLPHP_CONFIG = '/var/simplesamlphp/config';
$SIMPLESAMLPHP_SP = 'default-sp';
//$SIMPLESAMLPHP_RETURN_TO = 'http://some.other.target'; // for when you need to override RelayState
$SIMPLESAMLPHP_RETURN_TO = null;
// $SIMPLESAMLPHP_ERROR_URL = 'http://some.other.target'; // for when you need to override login error target
$SIMPLESAMLPHP_ERROR_URL = null;

// change this to something specific if you don't want users to be sent to
// Moodle $CFG->wwwroot when logout is completed
$SIMPLESAMLPHP_LOGOUT_LINK = "";  

// the alternative to the normal redirect for logout from the logout hook
// $SIMPLESAMLPHP_LOGOUT_HOOK = 'https://some.moodle.x/auth/saml/index.php?logout=1';
$SIMPLESAMLPHP_LOGOUT_HOOK = '';

