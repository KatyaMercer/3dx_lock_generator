<?php
namespace companies\KatyaMercer;
use \KatyaMercer\SvMaterials;
use \KatyaMercer\SvObject;
use \KatyaMercer\SvTypes;
class SimpleHouse extends AbstractLocation{
     
    public function generate() {
        $positionCenterX = $this->positionCenterX;
        $positionCenterY = $this->positionCenterY;
        $positionCenterZ = $this->positionCenterZ;
        $stenaMaterial = SvMaterials::TILES_1;
        
        $object = new SvObject();
        $object->setMaterial($stenaMaterial);
        $object->setType(SvTypes::BOX);
        $object->setXyz($positionCenterX, $positionCenterZ+0.05, $positionCenterY);
        $object->setWidth(25, 0.05, 25);
        $this->objects[] = $object;
        $object = clone $object;
        $object->setXyz($positionCenterX, $positionCenterZ+5, $positionCenterY);
        $object->setWidth(25, 10, 0.05);
        $this->objects[] = $object;
        $object = clone $object;
        $object->setXyz($positionCenterX+12.5, $positionCenterZ+5, $positionCenterY);
        $object->setWidth(0.05, 10, 25);
        $this->objects[] = $object;
        $object = clone $object;
        $object->setXyz($positionCenterX, $positionCenterZ+5, $positionCenterY+25);
        $object->setWidth(25, 10, 0.05);
        $this->objects[] = $object;
        $object = clone $object;
        $object->setXyz($positionCenterX, $positionCenterZ+10, $positionCenterY);
        $object->setWidth(25, 0.05, 25);
        $this->objects[] = $object;
        
        
        $object = new SvObject();
        $object->setMaterial($stenaMaterial);
        $object->setType(SvTypes::BED6);
        $object->setXyz($positionCenterX+5, $positionCenterZ+0.1, $positionCenterY+5);
        $object->setRotate(270,0,0);
        $object->setWidth(1, 1, 1);
        $this->objects[] = $object;
        
        $object = new SvObject();
        $object->setMaterial($stenaMaterial);
        $object->setType(SvTypes::SOFA_3);
        $object->setXyz($positionCenterX+5, $positionCenterZ+0.1, $positionCenterY+15);
        $object->setRotate(270,180,0);
        $object->setWidth(1, 1, 1);
        $this->objects[] = $object;
        
        $object = new SvObject();
        $object->setMaterial($stenaMaterial);
        $object->setType(SvTypes::VEDRO);
        $object->setXyz($positionCenterX, $positionCenterZ+0.1, $positionCenterY+15);
        $object->setRotate(270,180,0);
        $object->setWidth(1, 1, 1);
        $this->objects[] = $object;
        
        $object = new SvObject();
        $object->setMaterial($stenaMaterial);
        $object->setType(SvTypes::MAFON);
        $object->setXyz($positionCenterX, $positionCenterZ+0.1, $positionCenterY+13);
        $object->setRotate(270,180,0);
        $object->setWidth(1, 1, 1);
        $this->objects[] = $object;
        
        $object = new SvObject();
        $object->setMaterial($stenaMaterial);
        $object->setType(SvTypes::TABLE_4);
        $object->setXyz($positionCenterX, $positionCenterZ+0.1, $positionCenterY+10);
        $object->setRotate(270,0,0);
        $object->setWidth(1, 1, 1);
        $this->objects[] = $object;
        
        $object = new SvObject();
        $object->setMaterial($stenaMaterial);
        $object->setType(SvTypes::CHAIR_GIOVANNETTI_BLACK);
        $object->setXyz($positionCenterX+1.5, $positionCenterZ+0.1, $positionCenterY+10);
        $object->setRotate(270,0,0);
        $object->setWidth(1, 1, 1);
        $this->objects[] = $object;
        
        $object = clone $object;
        $object->setXyz($positionCenterX, $positionCenterZ+0.1, $positionCenterY+11.5);
        $object->setRotate(270,270,0);
        $this->objects[] = $object;
        
        $object = clone $object;
        $object->setXyz($positionCenterX, $positionCenterZ+0.1, $positionCenterY+8.5);
        $object->setRotate(270,90,0);
        $this->objects[] = $object;
        
        $object = clone $object;
        $object->setXyz($positionCenterX-1.5, $positionCenterZ+0.1, $positionCenterY+10);
        $object->setRotate(270,180,0);
        $this->objects[] = $object;
    }
    
}