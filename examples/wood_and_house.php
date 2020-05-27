<?php
use \KatyaMercer\SvLoader;
use \KatyaMercer\SvScene;
use \KatyaMercer\SvObject;
use KatyaMercer\SvMaterials;
use KatyaMercer\SvTypes;
include '../core/SvLoader.php';
$sfApp = new SvLoader();
$scene = new SvScene();

$floor = new SvObject();
$floor->setXyz(0, -0.1, -100);
$floor->setWidth(100, 0.2, 150);
$floor->setMaterial(SvMaterials::GRASS_1);
$floor->setType(SvTypes::BOX);
$scene->addObject($floor);
//bok
$floor = new SvObject();
$floor->setXyz(0, -0.1, -100);
$floor->setWidth(100, 0.2, 3);
$floor->setMaterial(SvMaterials::GRASS_1);
$floor->setRotate(150, 0, 0);
$floor->setType(SvTypes::BOX);
$scene->addObject($floor);
//bok
$floor = new SvObject();
$floor->setXyz(0, -0.1, 50);
$floor->setWidth(100, 0.2, 3);
$floor->setMaterial(SvMaterials::GRASS_1);
$floor->setRotate(30, 0, 0);
$floor->setType(SvTypes::BOX);
$scene->addObject($floor);
//bok
$floor = new SvObject();
$floor->setXyz(-50, -0.1, -25);
$floor->setWidth(150, 0.2, 3);
$floor->setMaterial(SvMaterials::GRASS_1);
$floor->setRotate(150, 90, 0);
$floor->setType(SvTypes::BOX);
$scene->addObject($floor);
//bok
$floor = new SvObject();
$floor->setXyz(50, -0.1, -25);
$floor->setWidth(150, 0.2, 3);
$floor->setMaterial(SvMaterials::GRASS_1);
$floor->setRotate(30, 90, 0);
$floor->setType(SvTypes::BOX);
$scene->addObject($floor);

$house = new \companies\KatyaMercer\SimpleHouse();
$house->setPos(50,0,0);
$house->generate();
$house->drawOnScene($scene);


$bol = new companies\KatyaMercer\Wood();
$bol->setPos(-50,0,-50);
$bol->setSize(80);
$bol->generate(500);
$bol->drawOnScene($scene);


file_put_contents('myLo.world', $scene->dump());
