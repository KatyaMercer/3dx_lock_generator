<?php

namespace companies\KatyaMercer;

use KatyaMercer\SvGroupOperations;
use KatyaMercer\SvMaterials;
use KatyaMercer\SvObject;
use KatyaMercer\SvScene;
use KatyaMercer\SvTypes;
use KatyaMercer\SvWeathers;

/**
 * runner companies\KatyaMercer\TestLocation
 * Class MyWorldLocation
 * @package companies\KatyaMercer
 */
class TestLocation
{
    public function run2()
    {
        $s1 = new SvScene();
        $s1->setOceanlevel(-100);
        $o = new SvObject();
        $o->setXyz(0,0,0);
        $o->setType(SvTypes::SPHERE);
        $o->setWidth(1,1,1);
        $o->setRotate(0,0,0);
        $o->setMaterial(SvMaterials::STONES_8);
        $s1->addObject($o);

//        $z = new SimpleHouse();
//        $z->setPos(10,10,10);
//        $z->korobka();
//        $z->drawOnScene($s1);
//        $z->setRotate(20,0,0);
//        $z->drawOnScene($s1);
        $o = new SvObject();
        $o->setXyz(2,2,2);
        $o->setType(SvTypes::BOX);
        $o->setWidth(1,2,3);
        $o->setRotate(0,0,0);
        $o->setMaterial(SvMaterials::STONES_8);
        $s1->addObject($o);

        $w = new SvObject();
        $w->setXyz(2,2,2);
        $w->setType(SvTypes::BOX);
        $w->setWidth(3,2,1);
        $w->setRotate(0,0,0);
        $w->setMaterial(SvMaterials::STONES_8);
        $s1->addObject($w);

        $o1 = clone $o;
        $w1 = clone $w;
        $o1->setMaterial(SvMaterials::WOOD_13);
        $w1->setMaterial(SvMaterials::WOOD_13);

        $r = SvGroupOperations::createByArrayOfObjects([$o1, $w1]);
        $r->rotateAroundCoordinates(80,0,0);
        $s1->addObject($o1);
        $s1->addObject($w1);

        $o1 = clone $o;
        $w1 = clone $w;
        $o1->setMaterial(SvMaterials::SAND_3);
        $w1->setMaterial(SvMaterials::SAND_3);

        $r = SvGroupOperations::createByArrayOfObjects([$o1, $w1]);
        $r->rotateAroundCoordinates(0,70,0);
        $s1->addObject($o1);
        $s1->addObject($w1);

        file_put_contents('z3.world', $s1->dump());
    }

    public function run()
    {
        $s1 = new SvScene();
        $s1->setOceanlevel(-100);

        $z = new SimpleHouse();
        $z->setPos(0,0,0);
        $z->korobka();
        $z->drawOnScene($s1);
        $z->setRotate(20,40,12);
        $z->drawOnScene($s1);
        file_put_contents('z3.world', $s1->dump());
    }
}