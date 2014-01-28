<?php
/**
 * Medix - Media Asset Manager for PHP 5.4+
 * 
 * @package Medix
 * @version 1.0.b - Jan 28, 2014
 * @copyright 2014 Shay Anderson <http://www.shayanderson.com>
 * @license MIT License <http://www.opensource.org/licenses/mit-license.php>
 * @link <http://www.shayanderson.com/projects/medix.htm>
 */

/**
 * Medix bootstrap file
 */

/**
 * =======================================================================
 * Load Medix classes (or use class autoloading here)
 * =======================================================================
 */

// load core
require_once './lib/Medix/Asset.php';
require_once './lib/Medix/Manager.php';

// load group
require_once './lib/Medix/Asset/Group.php';
require_once './lib/Medix/Asset/Group/Css.php';
require_once './lib/Medix/Asset/Group/Js.php';

// load file
require_once './lib/Medix/Asset/File.php';
require_once './lib/Medix/Asset/File/Css.php';
require_once './lib/Medix/Asset/File/Js.php';

// load snippet
require_once './lib/Medix/Asset/Snippet.php';
require_once './lib/Medix/Asset/Snippet/Css.php';
require_once './lib/Medix/Asset/Snippet/Js.php';

// load filters
require_once './lib/Medix/Filter.php';
require_once './lib/Medix/Filter/Minify/Css.php';
require_once './lib/Medix/Filter/Minify/Js.php';

/**
 * =======================================================================
 * Set global settings
 * =======================================================================
 */

// set global cache settings (write directory, base URL, cache expire in seconds)
\Medix\Manager::globalCache('./skin/medix', 'skin/medix', 60);

// turn global minify filter on/off (on by default)
// \Medix\Manager::globalMinify(false);