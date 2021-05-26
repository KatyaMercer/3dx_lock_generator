<?php
namespace companies\KatyaMercer;
use \KatyaMercer\DXKMaterials;
use \KatyaMercer\DXKObject;
use \KatyaMercer\DXKTypes;
class Tuman extends AbstractLocation{
     
    public function generate($ovjCount) {
        $positionCenterX = $this->positionCenterX;
        $positionCenterY = $this->positionCenterY;
        $positionCenterZ = $this->positionCenterZ;
        $size = $this->size;
        for($i = 0;$i<$ovjCount;$i++) {
            $object = new DXKObject();
            $object->setType(DXKTypes::SMOKE1);
            $object->setRotate(0, 180, rand(0,360));
            $width = rand(10,20);
            $object->setWidth($width, $width, $width);
            $x = $positionCenterX+rand(1, $size);
            $y = $positionCenterZ+rand(1, $size);
            $object->setXyz($x, $positionCenterY, $y);
            $this->objects[] = $object;

        }
    }
    
}