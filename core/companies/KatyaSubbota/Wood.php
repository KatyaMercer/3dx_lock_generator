<?php
namespace companies\KatyaMercer;
use \KatyaMercer\SvMaterials;
use \KatyaMercer\SvObject;
use \KatyaMercer\SvTypes;
class Wood extends AbstractLocation{
     
    public function generate($ovjCount) {
        $positionCenterX = $this->positionCenterX;
        $positionCenterY = $this->positionCenterY;
        $positionCenterZ = $this->positionCenterZ;
        $size = $this->size;
        $array = [
            SvTypes::GRASS1,
            SvTypes::GRASS1,
            SvTypes::GRASS1,
            SvTypes::GRASS1,
            SvTypes::GRASS1,
            SvTypes::TREE2,
            SvTypes::TREE3,
            SvTypes::BUSH1,
            SvTypes::BUSH1,
            SvTypes::BUSH2,
        ];
        for($i = 0;$i<$ovjCount;$i++) {
            $object = new SvObject();
            $object->setType($array[array_rand($array)]);
            $object->setRotate(270, rand(1,360), 0);
            $object->setWidth(1, rand(1,2), 1);
            $object->setXyz($positionCenterX+rand(1, $size), $positionCenterY, $positionCenterZ+rand(1, $size));
            $this->objects[] = $object;
        }
    }
    
}