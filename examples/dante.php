<?php
ini_set('memory_limit', '1000000M');
use \KatyaMercer\SvLoader;
use \KatyaMercer\SvScene;

include '../core/SvLoader.php';
$sfApp = new SvLoader();
$scene = new SvScene();//сцена
$sq = 100;//это типа длина стороны квадрата
$dr = new \companies\KatyaMercer\DefRespawn();//создаю платформу (можно посмотреть соответствующий файл)
$dr->setPos(0,0,-$sq);//устанавливаю координаты где рисовать (сама не помню, координаты чего)
$dr->setSize(2*$sq);//ну вообщем квадрат 200х200 будет
$dr->setHeight(5);// высота спуска в воду
$dr->generate();//это надо дернуть
$dr->drawOnScene($scene);//отрисовать на сцене

$wood = new \companies\KatyaMercer\Wood();//лес
$wood->setSize($sq*2-60);//ширина
$wood->setPos(-$sq+30,0,-$sq+30);//координаты откуда рисовать
$wood->addRocks($sq/2);//количество камней (у тебя может быть нет этой строчки, она новая)
$wood->generate($sq*3);//генерировать и количество деревьев и кустов)
$wood->drawOnScene($scene);//отрисовать

$mount = new \companies\KatyaMercer\LineMountain();// дальше потом посмотрим, тут горы рисуются
$mount->setSize(5);
$sqMount = $sq+30;
$mount->generate(['x' => -$sqMount, 'y' => 0, 'z' => -$sqMount], ['x' => -$sqMount, 'y' => 0, 'z' => $sqMount]);

$mount->generate(['x' => -$sqMount, 'y' => 0, 'z' => -$sqMount], ['x' => $sqMount, 'y' => 0, 'z' => -$sqMount]);

$mount->generate( ['x' => $sqMount, 'y' => 0, 'z' => $sqMount],  ['x' => -$sqMount, 'y' => 0, 'z' => $sqMount]);
$mount->generate( ['x' => $sqMount, 'y' => 0, 'z' => $sqMount],  ['x' => $sqMount, 'y' => 0, 'z' => -$sqMount]);
$mount->drawOnScene($scene);

file_put_contents('dante.world', $scene->dump());//в файл сцену