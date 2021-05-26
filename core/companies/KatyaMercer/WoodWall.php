<?php
namespace companies\KatyaMercer;
use \KatyaMercer\DXKMaterials;
use \KatyaMercer\DXKObject;
use \KatyaMercer\DXKTypes;
class WoodWall
{
    public function fromTo($fx,$fy,$fz, $count, $rad, $len, $rot)
    {
        $objects = [];
        for ($dx = $fx;$dx<$fx+$count*$rad;$dx+=$rad) {
            $object = new DXKObject();
            $object->setMaterial(DXKMaterials::WOOD_1);
            $object->setType(DXKTypes::CYLINDER);
//            $object->setColor(0,0.9,0.3);;
            $object->setXyz($fx+$dx, $fy, $fz);
            $object->setWidth($rad, $rad, $len);
            $object->setRotate($rot['x'],$rot['y'],$rot['z']);
            $objects[] = $object;
        }
        return $objects;
    }

    public function fromToDown($fx,$fy,$fz, $count, $rad, $len, $rot)
    {
        $objects = [];
        for ($dz = $fz;$dz<$fz+$count*2*$rad;$dz+=$rad) {
            $object = new DXKObject();
            $object->setMaterial(DXKMaterials::WOOD_1);
            $object->setType(DXKTypes::CYLINDER);
//            $object->setColor(0,0.9,0.3);;
            $object->setXyz($fx, $fy, $fz+$dz);
            $object->setWidth($rad, $rad, $len);
            $object->setRotate($rot['x'],$rot['y']+90,$rot['z']);
            $objects[] = $object;
        }
        return $objects;
    }
}