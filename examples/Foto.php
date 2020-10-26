<?php
ini_set('memory_limit', '1000000M');
use \KatyaMercer\SvLoader;
use \KatyaMercer\SvScene;
use \KatyaMercer\SvObject;
use \KatyaMercer\SvMaterials;
use \KatyaMercer\SvTypes;
use \KatyaMercer\SvWeathers;
include '../core/SvLoader.php';
$sfApp = new SvLoader();
$scene = new SvScene();

$image = '2.bmp';
$obj = new \companies\KatyaMercer\FotoBuilder();
$obj->generate($image);
$obj->drawOnScene($scene, true);
$scene->setWeather(SvWeathers::DAY);

//$image = '1.bmp';
//$obj = new \companies\KatyaMercer\FotoBuilder();
//$obj->generate($image, 150,300, 1);
//$obj->drawOnScene($scene, true);
//$scene->setWeather(SvWeathers::DAY);
////$scene->setAmbient(0,0,0,0,0);
file_put_contents('ira.world', $scene->dump());