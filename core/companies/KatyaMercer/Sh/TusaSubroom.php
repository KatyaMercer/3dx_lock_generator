<?php
namespace companies\KatyaMercer\Sh;

use KatyaMercer\DXKMaterials;
use KatyaMercer\DXKObject;
use KatyaMercer\DXKTypes;

class TusaSubroom extends AbstractSubroom
{
    public function generate($l1, $l2)
    {
        $this->karkas2($l1, $l2, ['withoutDoor' => true]);
        $radius = $this->starShip->getRadius();
        $positionCenterX = $this->starShip->positionCenterX;
        $positionCenterY = $this->starShip->positionCenterY;
        $positionCenterZ = $this->starShip->positionCenterZ;
        $leng = $this->starShip->size;
        $center = ($l2-$l1)/2;

        $this->shineCenter($l1, $l2);

        $object = new DXKObject();
        $object->setType(DXKTypes::BOX);
        $object->setXyz($positionCenterX, $positionCenterY-0.1, $positionCenterZ+$l1);
        $object->setRotate(0, 0, 0);
        $object->setColor(0.2,0.6, 0.6);
        $object->setMaterial(DXKMaterials::WALLPAPER_13);
        $object->setWidth($radius * 2, 0.25, $l2-$l1);
        $this->starShip->objects[] = $object;

        $object = new DXKObject();
        $object->setType(DXKTypes::BOX);
        $object->setXyz($positionCenterX, $positionCenterY-0.1, $positionCenterZ+$l1);
        $object->setRotate(0, 0, 0);
        $object->setColor(0.2,0.6, 0.6);
        $object->setMaterial(DXKMaterials::WALLPAPER_13);
        $object->setWidth($radius * 2, 0.25, $l2-$l1);
        $this->starShip->objects[] = $object;

        $object = new DXKObject();
        $object->setType(DXKTypes::PRISM);
        $object->setXyz($positionCenterX+$radius*5/8, $positionCenterY+0.1, $positionCenterZ+$l2-$radius*3/8+0.25);
        $object->setRotate(0, 45, 0);
        $object->setColor(0.6,0.3, 0.4);
        $object->setMaterial(DXKMaterials::WOOD_1);
        $object->setWidth($radius, 0.3, 0.5*$radius);
        $this->starShip->objects[] = $object;

        $object = new DXKObject();
        $object->setType(DXKTypes::MICROPHONE);
        $object->setXyz($positionCenterX+$radius*5/8+1, $positionCenterY+0.3, $positionCenterZ+$l2-$radius*3/8+0.25);
        $object->setRotate(270, 225, 0);
        $this->starShip->objects[] = $object;

        $object = new DXKObject();
        $object->setType(DXKTypes::GUITAR);
        $object->setXyz($positionCenterX+$radius*5/8+3, $positionCenterY+0.3, $positionCenterZ+$l2-$radius*3/8+0.25-2);
        $object->setRotate(0, 225, 0);
        $this->starShip->objects[] = $object;

        $object = new DXKObject();
        $object->setType(DXKTypes::DRUM);
        $object->setXyz($positionCenterX+$radius*5/8+2, $positionCenterY+0.3, $positionCenterZ+$l2-$radius*3/8+0.25+4);
        $object->setRotate(0, 45, 0);
        $this->starShip->objects[] = $object;

        $this->starShip->stolik($positionCenterX-10, $positionCenterZ+$l2-5);

    }
}