<?php

ini_set('display_errors', 'On');
error_reporting(E_ALL);

require_once 'source/php/App.php';
$products = \KnowitToolsTest\Products::search('digital');
\KnowitToolsTest\Response::json($products);

