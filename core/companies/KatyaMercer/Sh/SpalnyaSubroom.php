<?php
namespace companies\KatyaMercer\Sh;

use KatyaMercer\SvMaterials;
use KatyaMercer\SvObject;
use KatyaMercer\SvTypes;

class SpalnyaSubroom extends AbstractSubroom
{
    public function generate($l1, $l2)
    {
        $this->karkas1($l1, $l2);
        $radius = $this->starShip->getRadius();
        $positionCenterX = $this->starShip->positionCenterX;
        $positionCenterY = $this->starShip->positionCenterY;
        $positionCenterZ = $this->starShip->positionCenterZ;
        $leng = $this->starShip->size;

        $center = ($l2-$l1)/2;

        $object = new SvObject();
        $object->setType(SvTypes::BOXCH);
        $object->setXyz($positionCenterX+5*$radius/8, $positionCenterY+0.1, $positionCenterZ);
        $object->setRotate(0, 0, 0);
        $object->setColor(0.8,0.7, 0.7);
        $object->setMaterial(SvMaterials::WALLPAPER_32);
        $object->setWidth(3*$radius/4, 0.2, $center*2);
        $this->starShip->objects[] = $object;

        $positionCenterY = $positionCenterY + 0.2;

//        $object = new SvObject();
//        $object->setType(SvTypes::LIGHTP);
//        $object->setXyz($positionCenterX + $radius-$radius/2, $positionCenterY+3, $positionCenterZ + $center);
//        $object->setRotate(270, 0, 0);
//        $object->setColor(0.8,0.7, 0.7);
//        $this->starShip->objects[] = $object;

//        $object = clone $object;
//        $object->setType(SvTypes::SPHERE);
//        $object->setMaterial(SvMaterials::WATER);
//        $this->starShip->objects[] = $object;

        $object = new SvObject();
        $object->setType(SvTypes::BED3);
        $object->setXyz($positionCenterX + $radius-2, $positionCenterY, $positionCenterZ + $center);
        $object->setRotate(270, 0, 0);
        $this->starShip->objects[] = $object;

        $object = new SvObject();
        $object->setType(SvTypes::TABLE_4_DECOR);
        $object->setXyz($positionCenterX + $radius-8, $positionCenterY, $positionCenterZ + $center);
        $object->setRotate(270, 0, 0);
        $this->starShip->objects[] = $object;

        $object = new SvObject();
        $object->setType(SvTypes::CHAIR_GIOVANNETTI_BLACK);
        $object->setXyz($positionCenterX + $radius-7, $positionCenterY, $positionCenterZ + $center);
        $object->setRotate(270, 0, 0);
        $this->starShip->objects[] = $object;

        $object = new SvObject();
        $object->setType(SvTypes::CHAIR_GIOVANNETTI_RED);
        $object->setXyz($positionCenterX + $radius-9, $positionCenterY, $positionCenterZ + $center);
        $object->setRotate(270, 180, 0);
        $this->starShip->objects[] = $object;

        $object = new SvObject();
        $object->setType(SvTypes::CHAIR_GIOVANNETTI_WHITE);
        $object->setXyz($positionCenterX + $radius-8, $positionCenterY, $positionCenterZ + $center-1);
        $object->setRotate(270, 90, 0);
        $this->starShip->objects[] = $object;

        $object = new SvObject();
        $object->setType(SvTypes::CHAIR_GIOVANNETTI_WHITE);
        $object->setXyz($positionCenterX + $radius-8, $positionCenterY, $positionCenterZ + $center+1);
        $object->setRotate(270, -90, 0);
        $this->starShip->objects[] = $object;

        $object = new SvObject();
        $object->setType(SvTypes::FUTON_SOFA);
        $object->setXyz($positionCenterX + $radius-8, $positionCenterY, $positionCenterZ + $l1+1);
        $object->setRotate(270, -90, 0);
        $this->starShip->objects[] = $object;

        $object = new SvObject();
        $object->setType(SvTypes::CHAIR_GIOVANNETTI_RED);
        $object->setXyz($positionCenterX + $radius-5, $positionCenterY, $positionCenterZ + $l1+1);
        $object->setRotate(270, 90, 0);
        $this->starShip->objects[] = $object;

        $object = new SvObject();
        $object->setType(SvTypes::MAFON);
        $object->setXyz($positionCenterX + 0.5, $positionCenterY-0.3, $positionCenterZ + $center-4);
        $object->setRotate(270, 90, 0);
        $this->starShip->objects[] = $object;

        $object = new SvObject();
        $object->setType(SvTypes::MONITOR);
        $object->setXyz($positionCenterX + 0.5, $positionCenterY-0.3, $positionCenterZ + $center+4);
        $object->setRotate(270, 0, 0);
        $this->starShip->objects[] = $object;

        $object = new SvObject();
        $object->setType(SvTypes::TV_1);
        $object->setXyz($positionCenterX+0.5, $positionCenterY+4, $positionCenterZ + $center);
        $object->setRotate(270, 0, 0);
        $this->starShip->objects[] = $object;
        $used = [];

        $dz = $center+1+rand(1,4);
        $dx = $radius-rand(1,7);
        for($i = 1; $i < 15; $i++)
        {
            $object = new SvObject();
            $object->setType(SvTypes::PILLOW1);
            while (in_array($dz . ' ' . $dx, $used)) {
                $dz = $center+1+rand(1,4);
                $dx = $radius-rand(1,7);
            }
            $used[] = $dz . ' ' . $dx;

            $object->setXyz($positionCenterX+$dx, $positionCenterY-0.25, $positionCenterZ + $dz);
            $object->setRotate(270, rand(1,360), 0);
            $object->setMaterial(SvMaterials::WALLPAPER_13);
            $this->starShip->objects[] = $object;
        }
        $object = new SvObject();
        $object->setType(SvTypes::BED_PH);
        $object->setXyz($positionCenterX+$radius-3, $positionCenterY-0.25, $positionCenterZ + $center+3);
        $object->setRotate(270, rand(1,360), 0);
        $object->setMaterial(SvMaterials::WALLPAPER_13);
        $this->starShip->objects[] = $object;

        $object = new SvObject();
        $object->setType(SvTypes::WALL_PH);
        $object->setXyz($positionCenterX+8, $positionCenterY, $positionCenterZ + $l2-0.5);
        $object->setRotate(270, -90, 0);
        $this->starShip->objects[] = $object;

        $this->shineCenter($l1, $l2, 3);

    }
}