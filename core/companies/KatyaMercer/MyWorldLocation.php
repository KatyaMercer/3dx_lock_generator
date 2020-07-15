<?php

namespace companies\KatyaMercer;

use KatyaMercer\SvScene;
use KatyaMercer\SvWeathers;

/**
 * runner companies\KatyaMercer\MyWorldLocation
 * Class MyWorldLocation
 * @package companies\KatyaMercer
 */
class MyWorldLocation
{
    public function run()
    {
        $scene = new SvScene();
        $dr = new \companies\KatyaMercer\DefRespawn();
        $dr->setPos(0,-0.2,-100);
        $dr->setSize((130));
        $dr->setHeight(10);
        $dr->generate();
        $dr->drawOnScene($scene, true);

        $forest = new Wood();
        $forest->setSize(100);
        $forest->setPos(-50,0,-50);
        $forest->generate(200);
        $forest->addRocks(10);
        $forest->drawOnScene($scene, true);

        $house = new SimpleHouse();
        $house->setPos(70, -20, 0);
        $house->korobka();
        $house->defaultRoom();
        $house->setLight();
        $house->drawOnScene($scene);

        $house = new SimpleHouse();
        $house->setPos(70, -50, 0);
        $house->korobka();
        $house->defaultRoom();
        $house->drawOnScene($scene);

        $house = new SimpleHouse();
        $house->setPos(70, -80, 0);
        $house->korobka();
        $house->theatre();
        $house->drawOnScene($scene);

        $boloto = new Boloto();
        $boloto->setSize(250);
        $boloto->setPos(-100,0,30);
        $boloto->generate(1000,100,100,100);
        $boloto->drawOnScene($scene);

        $tuman = new Tuman();
        $tuman->setSize(300);
        $tuman->setPos(-200,0,50);
        $tuman->generate(300);
        $tuman->drawOnScene($scene);

        $rw = new RitaWorld();
        $rw->setPos(0,0,-200);
        $rw->setSize(130);
        $rw->generate();
        $rw->drawOnScene($scene, true);

        $dr = new \companies\KatyaMercer\DefRespawn();
        $dr->setPos(0,-0.2,-200);
        $dr->setSize((130));
        $dr->setHeight(10);
        $dr->generate();
        $dr->drawOnScene($scene, true);

        $dr = new \companies\KatyaMercer\DefRespawn();
        $dr->setPos(100,-0.2,-200);
        $dr->setSize((130));
        $dr->setHeight(10);
        $dr->generate();
        $dr->drawOnScene($scene, true);

        $river = new River();
        $river->setPos(20,-1,-100);
        $river->setSize(130);
        $river->generate();
        $river->drawOnScene($scene);

        $scene->setWeather(SvWeathers::CLOUDY);
        $scene->setAmbient(1,1,1,4,1);

//        $scene->setRespawn(200,200,200);

        file_put_contents('zz.world', $scene->dump());
    }
}