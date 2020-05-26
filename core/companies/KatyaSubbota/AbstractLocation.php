<?php
namespace companies\KatyaMercer;

class AbstractLocation
{
    protected $objects = [];
    protected $positionCenterX;
    protected $positionCenterY;
    protected $positionCenterZ;
    protected $size;
    
    public function setPos($positionCenterX, $positionCenterY, $positionCenterZ) {
        $this->positionCenterX = $positionCenterX;
        $this->positionCenterY = $positionCenterY;
        $this->positionCenterZ = $positionCenterZ;
    }
    
    public function setSize($size)
    {
        $this->size = $size;
    }
    
    public function drawOnScene(\KatyaMercer\SvScene $scene) {
        foreach($this->objects as $object) {
            $scene->addObject($object);
        }
    }
}