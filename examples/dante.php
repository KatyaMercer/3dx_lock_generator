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
$dr = new \companies\KatyaMercer\DefRespawn();
$dr->setPos(0,0,-500);
$dr->setSize(1000);
$dr->generate();
$dr->drawOnScene($scene);

$wood = new \companies\KatyaMercer\Wood();
$wood->setSize(1000);
$wood->setPos(-500,0,-500);
$wood->generate(10000);
$wood->drawOnScene($scene);

file_put_contents('dante.world', $scene->dump());