<?php

require_once 'source/php/App.php';

// If not search display all products
if (!isset($_REQUEST['s']) || empty($_REQUEST['s'])) {
    $products = \KnowitToolsTest\Products::all();
    \KnowitToolsTest\Response::json($products);
    die();
}

// Search
$products = \KnowitToolsTest\Products::search($_REQUEST['s']);
\KnowitToolsTest\Response::json($products);
die();
