<?php
/**
 * @author Erlend Strømsvik - Ny Media AS
 * @license http://www.gnu.org/copyleft/gpl.html GNU Public License
 * @package auth/saml
 * @version 1.0
 * 
 * Authentication Plugin: SAML based SSO Authentication
 *
 * Authentication using SAML2 with SimpleSAMLphp. 
 *
 * Based on plugins made by Sergio Gómez (moodle_ssp) and Martin Dougiamas (Shibboleth).
 *
 * 2008-10  Created
 * 2009-07  added new configuration options.  Tightened up the session handling
**/

if (!defined('MOODLE_INTERNAL')) {
    die('Direct access to this script is forbidden.');    ///  It must be included from a Moodle page
}

require_once($CFG->libdir.'/authlib.php');

/**
 * SimpleSAML authentication plugin.
**/
class auth_plugin_saml extends auth_plugin_base {
    
    /**
    * Constructor.
    */
    function auth_plugin_saml() {
        $this->authtype = 'saml';
        $this->config = get_config('auth/saml');
    }
    
    /**
    * Returns true if the username and password work and false if they are
    * wrong or don't exist.
    *
    * @param string $username The username (with system magic quotes)
    * @param string $password The password (with system magic quotes)
    * @return bool Authentication success or failure.
    */
    function user_login($username, $password) {
        // if true, user_login was initiated by saml/index.php
        if($GLOBALS['saml_login']) {
            unset($GLOBALS['saml_login']);
            return TRUE;
        }
        
        return FALSE;
    }
    
    
    /**
    * Returns the user information for 'external' users. In this case the
    * attributes provided by Identity Provider
    *
    * @return array $result Associative array of user data
    */
    function get_userinfo($username) {
        if($login_attributes = $GLOBALS['saml_login_attributes']) {
            $attributemap = $this->get_attributes();
            $country_codes = $this->country_codes();
            $attributemap['memberof'] = $this->config->memberattribute;
            $result = array();

            foreach ($attributemap as $key => $value) {
                if(isset($login_attributes[$value]) && $attribute = $login_attributes[$value][0]) {
                    if ($key == 'country') {
                        if (isset($country_codes['bycode'][$attribute])) {
                            $result[$key] = clean_param($attribute, PARAM_TEXT);
                        }
                        else {
                            if (isset($country_codes['bynames'][$attribute])) {
                                $result[$key] = clean_param($country_codes['bynames'][$attribute], PARAM_TEXT);
                            }
                            // else we don't know what this country is so ignore it
                        }
                    }
                    else {
                        $result[$key] = clean_param($attribute, PARAM_TEXT);
                    }
                } else {
                    $result[$key] = clean_param($value, PARAM_TEXT); // allows user to set a hardcode default
                }
            }
            return $result;
        }
        
        return FALSE;
    }

    
    /**
    * Returns the list of country codes
    *
    * @return array $names of country codes indexed both ways
    */
    function country_codes() {
        global $CFG, $SESSION;

        $string = array();

        $lang = (isset($SESSION->lang) ? $SESSION->lang : $CFG->lang);
        include($CFG->dirroot.'/lang/'.$lang.'/countries.php');

        $names = array('bynames' => array(), 'bycode' => array());
        foreach ($string as $k => $v) {
            $names['bynames'][$v] = $k;
        }
        $names['bycode'] = $string;

        return $names;
    }
    

    /*
    * Returns array containg attribute mappings between Moodle and Identity Provider.
    */
    function get_attributes() {
        $configarray = (array) $this->config;
        
        $fields = array("firstname", "lastname", "email", "phone1", "phone2",
            "department", "address", "city", "country", "description",
            "idnumber", "lang", "guid");
        
        $moodleattributes = array();
        foreach ($fields as $field) {
            if (isset($configarray["field_map_$field"])) {
                $moodleattributes[$field] = $configarray["field_map_$field"];
            }
        }
        return $moodleattributes;
    }
    
    /**
    * Returns true if this authentication plugin is 'internal'.
    *
    * @return bool
    */
    function is_internal() {
        return false;
    }
    
    /**
    * Returns true if this authentication plugin can change the user's
    * password.
    *
    * @return bool
    */
    function can_change_password() {
        return false;
    }
    
    function loginpage_hook() {
        // Prevent username from being shown on login page after logout
        $GLOBALS['CFG']->nolastloggedin = true;
        
        return;
    }

    function logoutpage_hook() {
        global $SESSION;
        unset($SESSION->SAMLSessionControlled);
        if($this->config->dologout) {
            set_moodle_cookie('nobody');
            require_logout();
            redirect($GLOBALS['CFG']->wwwroot.'/auth/saml/index.php?logout=1');
        }
    }
    
    /**
    * Prints a form for configuring this authentication plugin.
    *
    * This function is called from admin/auth.php, and outputs a full page with
    * a form for configuring this plugin.
    *
    * @param array $page An object containing all the data for this page.
    */

    function config_form($config, $err, $user_fields) {
        include "config.html";
    }

    /**
     * A chance to validate form data, and last chance to
     * do stuff before it is inserted in config_plugin
     */
     function validate_form($form, &$err) {
        require_once('config.php');
        if (empty($SIMPLESAMLPHP_LIB) || !file_exists($SIMPLESAMLPHP_LIB.'/lib/_autoload.php')) {
            $err['samllib'] = get_string('errorbadlib', 'auth_saml', $SIMPLESAMLPHP_LIB);
        }
        if (!isset ($SIMPLESAMLPHP_CONFIG) || !file_exists($SIMPLESAMLPHP_CONFIG.'/config.php')) {
            $err['samlconfig'] = get_string('errorbadconfig', 'auth_saml', $SIMPLESAMLPHP_CONFIG);
        }
     }
    
    /**
    * Processes and stores configuration data for this authentication plugin.
    *
    *
    * @param object $config Configuration object
    */
    function process_config($config) {
        // set to defaults if undefined
        if (!isset ($config->username)) {
            $config->username = 'mail';
        }
        if (!isset ($config->userfield)) {
            $config->userfield = 'username';
        }
        if (!isset ($config->dologout)) {
            $config->dologout = '';
        }
        if (!isset ($config->createusers)) {
            $config->createusers = '';
        }
        if (!isset ($config->notshowusername)) {
            $config->notshowusername = '';
        }
        if (!isset ($config->duallogin)) {
            $config->duallogin = '';
        }
        if (!isset ($config->memberattribute)) {
            $config->memberattribute = '';
        }
        if (!isset ($config->attrcreators)) {
            $config->attrcreators = '';
        }
        if (!isset ($config->unassigncreators)) {
            $config->unassigncreators = '';
        }

        // save settings
        set_config('username',        $config->username,        'auth/saml');
        set_config('userfield',       $config->userfield,       'auth/saml');
        set_config('dologout',        $config->dologout,        'auth/saml');
        set_config('createusers',     $config->createusers,     'auth/saml');
        set_config('notshowusername', $config->notshowusername, 'auth/saml');
        set_config('duallogin',       $config->duallogin,       'auth/saml');
        set_config('memberattribute', $config->memberattribute, 'auth/saml');
        set_config('attrcreators',    $config->attrcreators,    'auth/saml');
        set_config('unassigncreators',$config->unassigncreators,'auth/saml');
        
        return true;
    }
    
    /**
    * Cleans and returns first of potential many values (multi-valued attributes)
    *
    * @param string $string Possibly multi-valued attribute from Identity Provider
    */
    function get_first_string($string) {
        $list = split( ';', $string);
        $clean_string = trim($list[0]);
        
        return $clean_string;
    }

    
    /**
    * Sync roles
    *
    * @param object $user Moodle user record
    */
    function sync_roles($user) {
        $login_attributes = $GLOBALS['saml_login_attributes'];
        $iscreator = $this->iscreator($login_attributes);
        if ($iscreator === null) {
        	return; //nothing to sync
        }
        if ($roles = get_roles_with_capability('moodle/legacy:coursecreator', CAP_ALLOW)) {
            $creatorrole = array_shift($roles);
            $systemcontext = get_context_instance(CONTEXT_SYSTEM);
            if ($iscreator) {
            	role_assign($creatorrole->id, $user->id, 0, $systemcontext->id, 0, 0, 0, 'saml');
            }
            else {
                if($this->config->unassigncreators){
                    role_unassign($creatorrole->id, $user->id, 0, $systemcontext->id, 'saml');
                }
            }
        }
    }

    
    /**
    * isCreator test
    *
    * @param array $login_attributes login attributes mapping
    */
    function iscreator($login_attributes) {
        if (isset($this->config->memberattribute) && isset($login_attributes[$this->config->memberattribute])) {
            $memberof = $login_attributes[$this->config->memberattribute];
            $attrs = explode(";", $this->config->attrcreators);
            foreach ($attrs as $attr) {
                foreach ($memberof as $m) {
                    if($m === $attr) {
                        return true;
                    }
                }
            }
        }
        return false;
    }
}

?>
