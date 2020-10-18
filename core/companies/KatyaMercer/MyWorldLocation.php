<?php

namespace companies\KatyaMercer;

use KatyaMercer\SvMaterials;
use KatyaMercer\SvObject;
use KatyaMercer\SvScene;
use KatyaMercer\SvTypes;
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
        $dr->setSize((150));
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
        $boloto->setSize(100);
        $boloto->setPos(-100,0,30);
        $boloto->generate(1000,30,30,30);
        $boloto->drawOnScene($scene);

        $tuman = new Tuman();
        $tuman->setSize(100);
        $tuman->setPos(-200,0,50);
        $tuman->generate(100);
        $tuman->drawOnScene($scene);

        $rw = new RitaWorld();
        $rw->setPos(0,0,-200);
        $rw->setSize(130);
        $rw->generate();
        $rw->generPlatform();
        $rw->drawOnScene($scene, true);

        $dr = new \companies\KatyaMercer\DefRespawn();
        $dr->setPos(0,-0.2,-200);
        $dr->setSize((130));
        $dr->setHeight(10);
        $dr->generate();
        $dr->drawOnScene($scene, true);

        $dr = new \companies\KatyaMercer\DefRespawn();
        $dr->setPos(-120,-0.2,-170);
        $dr->setSize((130));
        $dr->setHeight(10);
        $dr->generate();
        $dr->drawOnScene($scene, true);

//        $scene->clean();

        $river = new River();
        $river->setPos(-180,-1,-70);
        $river->setSize(130);
        $river->generate();
        $river->drawOnScene($scene);

        $scene->setWeather(SvWeathers::NIGHT);
        $scene->setAmbient(1,1,1,5,1);

        //spawn
        $scene->setRespawn(-80,3.2,-10);
        $object = new SvObject();
        $object->setType(SvTypes::ELECTRICITY);
        $object->setRotate(270,270,0);
        $object->setXyz(-80, 4,-10);
        $object->setWidth(3, 3, 3);
        $scene->addObject($object);

        $object = new SvObject();
        $object->setType(SvTypes::CYLINDER);
        $object->setColor(5,0,0);
        $object->setMaterial(SvMaterials::FOLIAGE_3);
        $object->setRotate(270,90,0);
        $object->setXyz(-80, 1,-10);
        $object->setWidth(4, 4, 2.2);
        $scene->addObject($object);
        //spawn

        $scene->setOceanlevel(0);

        $zamok = new Zamok();
        $zamok->setPos(-90,-50,3);
        $zamok->mainRoomBox();
        $zamok->sotona();
        $zamok->setShine([
            'r' => 0.8,
            'g' => 0.5,
            'b' => 0.5
        ]);
        $zamok->subRoomRitaAndKatya();
        $zamok->kovri();
        $zamok->drawOnScene($scene);

//        $dr = new \companies\KatyaMercer\DefRespawn();
//        $dr->setPos(0,-0.2,-100);
//        $dr->setSize((130));
//        $dr->setHeight(10);
//        $dr->generate();
//        $dr->drawOnScene($scene, true);

        file_put_contents('zz.world', $scene->dump());
    }
}