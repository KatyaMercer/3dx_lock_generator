<?php
ini_set('memory_limit', '1000000M');
use \KatyaMercer\SvLoader;
include '../core/SvLoader.php';
$sfApp = new SvLoader();
$class = $argv[1];
(new $class())->run();
