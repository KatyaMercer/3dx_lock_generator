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
$sq = 250;
$dr = new \companies\KatyaMercer\DefRespawn();
$dr->setPos(0,0,-$sq);
$dr->setSize(2*$sq);
$dr->setHeight(5);
$dr->generate();
$dr->drawOnScene($scene);

$wood = new \companies\KatyaMercer\Wood();
$wood->setSize($sq*2-60);
$wood->setPos(-$sq+30,0,-$sq+30);
$wood->generate($sq*7);
$wood->drawOnScene($scene);

$mount = new \companies\KatyaMercer\LineMountain();
$mount->setSize(10);
$sqMount = $sq+30;
$mount->generate(['x' => -$sqMount, 'y' => 0, 'z' => -$sqMount], ['x' => -$sqMount, 'y' => 0, 'z' => $sqMount]);

$mount->generate(['x' => -$sqMount, 'y' => 0, 'z' => -$sqMount], ['x' => $sqMount, 'y' => 0, 'z' => -$sqMount]);

$mount->generate( ['x' => $sqMount, 'y' => 0, 'z' => $sqMount],  ['x' => -$sqMount, 'y' => 0, 'z' => $sqMount]);
$mount->generate( ['x' => $sqMount, 'y' => 0, 'z' => $sqMount],  ['x' => $sqMount, 'y' => 0, 'z' => -$sqMount]);
$mount->drawOnScene($scene);

file_put_contents('dante.world', $scene->dump());