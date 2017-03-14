<?php

/**
 * This is the bootstrap of the app
 *
 * 1. Defines root path of the app
 * 2. Requires and initializes autoloader
 */

define('KNOWIT_TOOLS_TEST_PATH', dirname(__FILE__) . '/');
define('PRODUCTS_JSON', dirname(dirname(dirname(__FILE__))) . '/products.json');

// Instantiate the autoloader 
require_once KNOWIT_TOOLS_TEST_PATH . 'Vendor/autoload.php';

