<?php
namespace companies\KatyaMercer;
use \KatyaMercer\SvMaterials;
use \KatyaMercer\SvObject;
use \KatyaMercer\SvTypes;
class Maze extends AbstractLocation{
     
    public function generate() {
        $positionCenterX = $this->positionCenterX;
        $positionCenterY = $this->positionCenterY;
        $positionCenterZ = $this->positionCenterZ;
        $size = $this->size;
        for($x = -$size;$x<$size;$x++) {
            for($y = -$size;$y<$size;$y++) {
                $object = new SvObject();
                $object->setMaterial(SvMaterials::TILES_1);
                $object->setType(SvTypes::BOXCH);
                $object->setXyz($positionCenterX+$x*2, $positionCenterZ, $positionCenterY+$y*2);
                
                
                if (rand(1,2) == 1) {
                    $object->setWidth(2, 2, 0);
                } else {
                    $object->setWidth(0, 2, 2);
                }
                $this->objects[] = $object;
            }
        }
    }
    
}