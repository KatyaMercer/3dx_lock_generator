<?php
ini_set('memory_limit', '1000000M');

use companies\KatyaMercer\RitaWorld;
use \KatyaMercer\DXKLoader;
use \KatyaMercer\DXKScene;
use \KatyaMercer\DXKObject;
use \KatyaMercer\DXKMaterials;
use \KatyaMercer\DXKTypes;
use \KatyaMercer\DXKWeathers;
include '../core/DXKLoader.php';
$sfApp = new DXKLoader();
$scene = new DXKScene();
$sq = 50;
$dr = new \companies\KatyaMercer\DefRespawn();
$dr->setPos(-$sq,-0.2,-$sq*3);
$dr->setSize(2*($sq+60));
$dr->setHeight(10);
$dr->generate();
$dr->drawOnScene($scene);

$rw = new RitaWorld();
$rw->setPos(0,0,-250);
$rw->setSize(130);
$rw->generate();
$rw->drawOnScene($scene);

$scene->setWeather(DXKWeathers::DAY);

file_put_contents('aa.world', $scene->dump());