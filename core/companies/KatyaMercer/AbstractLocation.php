<?php
namespace companies\KatyaMercer;

use KatyaMercer\SvGroup;
use KatyaMercer\SvGroupOperations;

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
    
    public function drawOnScene(\KatyaMercer\SvScene $scene, $toGroup = false) {
        $group = new SvGroup();
        foreach($this->objects as $object) {
            if ($toGroup) {
                $group->addObject($object);
            } else {
                $scene->addObject($object);
            }
        }
        if ($toGroup) {
            $scene->addGroup($group);
        }
    }

    public function setRotate($x, $y, $z)
    {
        $rot = SvGroupOperations::createByArrayOfObjects($this->objects);
        $rot->rotateAroundCoordinates($x,$y,$z,$this->positionCenterX, $this->positionCenterY, $this->positionCenterZ);
    }
}