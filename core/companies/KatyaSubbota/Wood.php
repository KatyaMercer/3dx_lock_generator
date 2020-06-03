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
            SvTypes::TREE1,
            SvTypes::TREE2,
            SvTypes::TREE3,
            SvTypes::TREE4,
            SvTypes::TREE5,
            SvTypes::TREE6,
            SvTypes::TREE7,
            SvTypes::BUSH1,
            SvTypes::BUSH1,
            SvTypes::BUSH2,
        ];
        for($i = 0;$i<$ovjCount;$i++) {
            $object = new SvObject();
            $object->setType($array[array_rand($array)]);
            $object->setRotate(270, rand(1,360), 0);
            $width = rand(1,2);
            $object->setWidth($width, $width, rand(0.5,2));
            $x = $positionCenterX+rand(1, $size);
            $y = $positionCenterZ+rand(1, $size);
            $object->setXyz($x, $positionCenterY, $y);
            $this->objects[] = $object;

            $object = new SvObject();
            $object->setType(SvTypes::GRASS1);
            $object->setRotate(270, rand(1,360), 0);
            $object->setWidth(rand(2,10), rand(2,10), rand(1,5));
            $object->setXyz($x, $positionCenterY, $y);
            $this->objects[] = $object;
        }
    }
    
}