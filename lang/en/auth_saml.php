<?php
global $CFG;

$string['pluginname']         = 'SAML Authentication';
$string['auth_samltitle']         = 'SAML Authentication';
$string['auth_samldescription']   = 'SSO Authentication using SimpleSAML. <br/> Do not forget to edit the configuration file: '.$CFG->dirroot.'/auth/saml/config.php';

$string['auth_saml_dologout'] = 'Log out from Identity Provider';
$string['auth_saml_dologout_description'] = 'Check to have the module log out from Identity Provider when user log out from Moodle';

$string['auth_saml_createusers'] = 'Automatically create users';
$string['auth_saml_createusers_description'] = 'Check to have the module log automatically create users accounts if none exists';

$string['auth_saml_duallogin'] = 'Enable Dual login for users';
$string['auth_saml_duallogin_description'] = 'Enable use of users assigned login auth module and SAML';

$string['auth_saml_notshowusername'] = 'Do not show username';
$string['auth_saml_notshowusername_description'] = 'Check to have Moodle not show the username for users logging in by Identity Provider';

$string['errorbadlib'] = 'SimpleSAMLPHP lib directory $a is not correct.  Please edit the auth/saml/config.php file correctly.';
$string['errorbadconfig'] = 'SimpleSAMLPHP config directory $a is in correct.  Please edit the auth/saml/config.php file correctly.';

$string['auth_saml_username'] = 'SAML username mapping';
$string['auth_saml_username_description'] = 'SAML attribute that is mapped to Moodle username - this defaults to mail';
$string['auth_saml_userfield'] = 'Moodle username mapping';
$string['auth_saml_userfield_description'] = 'Moodle user field that is mapped to SAML username attribute - this defaults to username, but could be idnumber, or email';

$string['auth_saml_memberattribute'] = 'Member attribute';
$string['auth_saml_memberattribute_description'] = 'Optional: Overrides user member attribute, when user belongs to a group. Usually \'member\'';
$string['auth_saml_attrcreators'] = 'Attribute creators';
$string['auth_saml_attrcreators_description'] = 'List of groups or contexts whose members are allowed to create attributes. Separate multiple groups with \';\'. Usually something like \'cn=teachers,ou=staff,o=myorg\'';
$string['auth_saml_unassigncreators'] = 'Unassign creators';
$string['auth_saml_unassigncreators_description'] = 'Unassign creators role if unmatch specified condition.';

$string['retriesexceeded'] = 'Maximum number of retries exceeded ($a) - there must be a problem with the Identity Service';
$string['pluginauthfailed'] = 'The SAML authentication plugin failed - user $a disallowed (no user auto creation?) or dual login disabled';
$string['pluginauthfailedusername'] = 'The SAML authentication plugin failed - user $a disallowed due to invalid username format';
$string['auth_saml_username_error'] = 'IdP returned a set of data that does not contain the SAML username mapping field. This field is required to login';
?>
