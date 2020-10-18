<?php
namespace companies\KatyaMercer\Sh;

use KatyaMercer\SvMaterials;
use KatyaMercer\SvObject;
use KatyaMercer\SvTypes;

class RubkaSubroom extends AbstractSubroom
{
    public function generate($l1, $l2)
    {
        $this->karkas2($l1, $l2);
        $radius = $this->starShip->getRadius();
        $positionCenterX = $this->starShip->positionCenterX;
        $positionCenterY = $this->starShip->positionCenterY;
        $positionCenterZ = $this->starShip->positionCenterZ;
        $leng = $this->starShip->size;

        $object = new SvObject();
        $object->setType(SvTypes::CYLINDER);
        $object->setXyz($positionCenterX, $positionCenterY, $positionCenterZ+$leng+$radius/2);
        $object->setRotate(270, 0, 0);
        $object->setColor(0.9,0.2, 0.2);
        $object->setMaterial(SvMaterials::WALLPAPER_32);
        $object->setWidth(0.25, 0.25, 1);
        $this->starShip->objects[] = $object;

        for ($alfa = 0; $alfa < 360; $alfa+=25) {
            $object = new SvObject();
            $object->setType(SvTypes::CYLINDER);
            $object->setXyz($positionCenterX, $positionCenterY+1, $positionCenterZ+$leng+$radius/2-0.125);
            $object->setRotate($alfa, 90, 0);
            $object->setColor(0.9,0.2, 0.2);
            $object->setMaterial(SvMaterials::WALLPAPER_32);
            $object->setWidth(0.1, 0.1, 0.5);
            $this->starShip->objects[] = $object;
        }

        $object = new SvObject();
        $object->setType(SvTypes::CHAIR_GIOVANNETTI_RED);
        $object->setXyz($positionCenterX, $positionCenterY, $positionCenterZ+$leng+$radius/2-2);
        $object->setRotate(270, 90, 0);
        $object->setColor(1,1, 1);
        $object->setMaterial(SvMaterials::MAT3DPANEL_7);
        $object->setWidth(1, 1, 2);
        $this->starShip->objects[] = $object;

        for ($i=0;$i<8; $i++) {
            $object = new SvObject();
            $object->setType(SvTypes::SPHERE);
            $object->setXyz($positionCenterX-4-0.4+rand(10,80)/100, $positionCenterY+rand(100,200)/100-0.3, $positionCenterZ+$leng+$radius/2-0.5);
            $object->setRotate(270, 90, 0);
            $object->setColor(1,0.2, 0.2);
            $object->setMaterial(SvMaterials::WALLPAPER_1);
            $object->setWidth(0.1, 0.1, 0.1);
            $this->starShip->objects[] = $object;
        }

        $object = new SvObject();
        $object->setType(SvTypes::CHAIR_GIOVANNETTI_RED);
        $object->setXyz($positionCenterX-4, $positionCenterY, $positionCenterZ+$leng+$radius/2-2);
        $object->setRotate(270, 90, 0);
        $object->setColor(0.9,0.2, 0.2);
        $object->setMaterial(SvMaterials::MAT3DPANEL_7);
        $object->setWidth(1, 1, 2);
        $this->starShip->objects[] = $object;

        $object = new SvObject();
        $object->setType(SvTypes::BOX);
        $object->setXyz($positionCenterX-4, $positionCenterY, $positionCenterZ+$leng+$radius/2);
        $object->setRotate(270, 90, 0);
        $object->setColor(0.1,0.2, 0.2);
        $object->setMaterial(SvMaterials::WALLPAPER_1);
        $object->setWidth(1, 1, 2);
        $this->starShip->objects[] = $object;

        $this->shineCenter($l1, $l2);
    }
}