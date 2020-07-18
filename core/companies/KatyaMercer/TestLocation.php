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
    public function runf()
    {
        $s1 = new SvScene();
        $s1->setOceanlevel(-100);

        $x = 0;$y=0;$z=0;
        $dx = 10;
        $dy = 20;
        $dz = 30;

        $o = new SvObject();
        $o->setXyz($x,$y,$z);
        $o->setType(SvTypes::BOX);
        $o->setWidth(1,2,3);
        $o->setRotate($dx,$dy,$dz);
        $o->setMaterial(SvMaterials::STONES_8);
        $s1->addObject($o);


        $o = new SvObject();
        $o->setXyz($x,$y,$z);
        $o->setType(SvTypes::BOX);
        $o->setWidth(1,2,3);
        $o->setRotate($dx,$dy,$dz);
        $o->setMaterial(SvMaterials::STONES_8);
        $s1->addObject($o);

        file_put_contents('z3.world', $s1->dump());
    }
    public function runаы()
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

        $o = new SvObject();
        $o->setXyz(10,10,10);
        $o->setType(SvTypes::BOX);
        $o->setWidth(1,2,3);
        $o->setRotate(0,0,0);
        $o->setMaterial(SvMaterials::STONES_8);
        $s1->addObject($o);

        for ($i = 0; $i < 360; $i+=20) {
            $o1 = clone $o;

            $o1->setMaterial(SvMaterials::WOOD_13);

            $r = SvGroupOperations::createByArrayOfObjects([$o1]);
            $r->rotateAroundCoordinates($i,0,0);
            foreach ($r->objects as $object) {
                $s1->addObject($object);
            }
        }

        file_put_contents('z3.world', $s1->dump());
    }

    public function run()
    {
        $s1 = new SvScene();
        $s1->setOceanlevel(-100);

        $z = new SimpleHouse();
        $z->setPos(0,0,0);
        $z->korobka();
        $z->defaultRoom();
        $z->drawOnScene($s1);
        $z->setRotate(20,0,0);
        $z->setRotate(20,0,0);
//        $z->setRotate(0,30,0);
//        $z->setRotate(0,0,100);
        $z->drawOnScene($s1);
        file_put_contents('z3.world', $s1->dump());
    }
}