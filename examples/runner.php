<?php
ini_set('memory_limit', '1000000M');
use \KatyaMercer\DXKLoader;
include '../core/DXKLoader.php';
$sfApp = new DXKLoader();
$class = $argv[1];
(new $class())->run();
