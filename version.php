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
 * Version details
 *
 * @originalauthor Martin Dougiamas
 * @author Erlend Strømsvik - Ny Media AS 
 * @author Piers Harding - made quite a number of changes
 * @author David Bezemer - Added options to deny auto-povisioning
 * @version 2.4
 * @license http://www.gnu.org/copyleft/gpl.html GNU Public License
 * @package auth_saml
 *
 **/

defined('MOODLE_INTERNAL') || die;

$plugin->version   = 2014031300;				// The current plugin version (Date: YYYYMMDDXX)
$plugin->requires  = 2012120300;				// Requires this Moodle version, Moodle 2.4
$plugin->component = 'auth_saml';				// Full name of the plugin (used for diagnostics)
$plugin->maturity = MATURITY_STABLE;            // this version's maturity level.
$plugin->release = '2.4 (Build: 20140313)';
$plugin->dependencies = array();