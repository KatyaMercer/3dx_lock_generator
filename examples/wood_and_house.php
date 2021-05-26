<?php
use \KatyaMercer\DXKLoader;
use \KatyaMercer\DXKScene;
use \KatyaMercer\DXKObject;
use KatyaMercer\DXKMaterials;
use KatyaMercer\DXKTypes;
include '../core/DXKLoader.php';
$sfApp = new DXKLoader();
$scene = new DXKScene();

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

$house = new \companies\KatyaMercer\SimpleHouse();
$house->setPos(50,0,0);
$house->korobka();
$house->defaultRoom();
$house->drawOnScene($scene);


$bol = new companies\KatyaMercer\Wood();
$bol->setPos(-50,0,-50);
$bol->setSize(80);
$bol->generate(500);
$bol->drawOnScene($scene);


file_put_contents('myLo.world', $scene->dump());
