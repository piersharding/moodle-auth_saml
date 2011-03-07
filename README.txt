SAML Authentication for Moodle
-------------------------------------------------------------------------------
license: http://www.gnu.org/copyleft/gpl.html GNU Public License

Changes:
- 2008-10    : Created by Ny Media AS
- 2008-11-03 : Updated by Ny Media AS
- 2009-07-29 : added configuration options for sslib path and config path
               tightened up the session switching between ss and moodle
               Piers Harding <piers@catalyst.net.nz>

  2009-11-16 : upgraded to the new ssphp saml2 modular authentication from ssphp
               1.5. 

  2010-01-15 : added option for dual login
  2010-01-15 : added course creator role mapping
               Tsukasa Hamano <hamano@osstech.co.jp>
  2010-04-07 : added use of the wantsurl query string parameter
  2011-02-28 : Modified to support Moodle 2.0

Requirements:
- SimpleSAML (http://rnd.feide.no/simplesamlphp). Tested with version 1.4

Notes: 
- Uses IdP attribute "mail" as username by default

Install instructions:
  1. unpack this archive into the /auth/ directory as you would for any Moodle
     auth module (http://docs.moodle.org/en/Installing_contributed_modules_or_plugins).
  2. Login to Moodle as an administrator, and activate the module by navigating
     Users -> Authentication -> Manage authentication and clicking on the enable icon.
  3. Configure the settings for the plugin - it will not work unless you specify
     the saml library path, the saml config path, the SP, and username attribute
     mapping - this is the link between the SAML user identifier, and the Moodle user.
     The configuration exists in two places - in the /auth/saml/config.php file, and 
     the standard User Authentication module configuration screens - please check 
     both!
- 4. If you only want auth/saml as login option, change login page to point to auth/saml/index.php
- 5. If you want to use another authentication method together with auth/saml, 
    in parallel, change the 'Instructions' in the 'Common settings' of the
    'Administrations >> Users >> Authentication Options' to contain a link to the
    auth/saml login page (-- remember to check the href and src paths --):
    <br>Click <a href="auth/saml/index.php">here</a> to login with SSO
- 4 Save the changes for the 'Common settings'

