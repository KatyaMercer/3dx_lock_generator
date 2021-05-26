<?php
use \KatyaMercer\DXKLoader;
use \KatyaMercer\DXKScene;
use \KatyaMercer\DXKObject;
use \KatyaMercer\DXKMaterials;
use \KatyaMercer\DXKTypes;
use \KatyaMercer\DXKWeathers;
include '../core/DXKLoader.php';
$sfApp = new DXKLoader();
$scene = new DXKScene();

//$scene->setOceanlevel(-10);
//$scene->setRespawn(-20,0,-20);
//$scene->setWeather(DXKWeathers::NIGHT);


$floor = new DXKObject();
$floor->setXyz(0, -0.1, -100);
$floor->setWidth(100, 0.2, 150);
$floor->setMaterial(DXKMaterials::GRASS_1);
$floor->setType(DXKTypes::BOX);
$scene->addObject($floor);
//bok
$floor = new DXKObject();
$floor->setXyz(0, -0.1, -100);
$floor->setWidth(100, 0.2, 3);
$floor->setMaterial(DXKMaterials::GRASS_1);
$floor->setRotate(150, 0, 0);
$floor->setType(DXKTypes::BOX);
$scene->addObject($floor);
//bok
$floor = new DXKObject();
$floor->setXyz(0, -0.1, 50);
$floor->setWidth(100, 0.2, 3);
$floor->setMaterial(DXKMaterials::GRASS_1);
$floor->setRotate(30, 0, 0);
$floor->setType(DXKTypes::BOX);
$scene->addObject($floor);
//bok
$floor = new DXKObject();
$floor->setXyz(-50, -0.1, -25);
$floor->setWidth(150, 0.2, 3);
$floor->setMaterial(DXKMaterials::GRASS_1);
$floor->setRotate(150, 90, 0);
$floor->setType(DXKTypes::BOX);
$scene->addObject($floor);
//bok
$floor = new DXKObject();
$floor->setXyz(50, -0.1, -25);
$floor->setWidth(150, 0.2, 3);
$floor->setMaterial(DXKMaterials::GRASS_1);
$floor->setRotate(30, 90, 0);
$floor->setType(DXKTypes::BOX);
$scene->addObject($floor);


$maze = new companies\KatyaMercer\Maze();
$maze->setPos(0,0,0);
$maze->setSize(15);
$maze->generate();
$maze->drawOnScene($scene);

$house = new \companies\KatyaMercer\SimpleHouse();
$house->setPos(50,0,0);
$house->korobka();
$house->defaultRoom();
$house->drawOnScene($scene);


file_put_contents('myLo.world', $scene->dump());
