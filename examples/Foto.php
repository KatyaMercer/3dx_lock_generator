<?php
ini_set('memory_limit', '1000000M');
use \KatyaMercer\DXKLoader;
use \KatyaMercer\DXKScene;
use \KatyaMercer\DXKObject;
use \KatyaMercer\DXKMaterials;
use \KatyaMercer\DXKTypes;
use \KatyaMercer\DXKWeathers;
include '../core/DXKLoader.php';
$sfApp = new DXKLoader();
$scene = new DXKScene();

$image = '1.bmp';
//$obj = new \companies\KatyaMercer\FotoBuilder();
$obj = new \companies\KatyaMercer\FotoBuilderExtended();
$obj->generate($image, 50, 200);
$obj->drawOnScene($scene, true);
$scene->setWeather(DXKWeathers::DAY);

//$image = '1.bmp';
//$obj = new \companies\KatyaMercer\FotoBuilder();
//$obj->generate($image, 150,300, 1);
//$obj->drawOnScene($scene, true);
//$scene->setWeather(DXKWeathers::DAY);
////$scene->setAmbient(0,0,0,0,0);
file_put_contents('ira2.world', $scene->dump());