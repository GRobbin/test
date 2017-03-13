<?php

/**
 * This is the bootstrap of the app
 *
 * 1. Defines root path of the app
 * 2. Requires and initializes autoloader
 */

define('KNOWIT_TOOLS_TEST_PATH', dirname(__FILE__) . '/');
define('PRODUCTS_JSON', dirname(dirname(dirname(__FILE__))) . '/products.json');

require_once KNOWIT_TOOLS_TEST_PATH . 'Vendor/Psr4ClassLoader.php';
require_once KNOWIT_TOOLS_TEST_PATH . '/search.php';

// Instantiate and register the autoloader
$loader = new KnowitToolsTest\Vendor\Psr4ClassLoader();
$loader->addPrefix('KnowitToolsTest', KNOWIT_TOOLS_TEST_PATH);
$loader->addPrefix('KnowitToolsTest', KNOWIT_TOOLS_TEST_PATH . 'source/php/');
$loader->register();
