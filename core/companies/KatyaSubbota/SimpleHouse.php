<?php
namespace companies\KatyaMercer;
use \KatyaMercer\SvMaterials;
use \KatyaMercer\SvObject;
use \KatyaMercer\SvTypes;
class SimpleHouse extends AbstractLocation{

    public function korobka()
    {
        $positionCenterX = $this->positionCenterX;
        $positionCenterY = $this->positionCenterY;
        $positionCenterZ = $this->positionCenterZ;
        $stenaMaterial = SvMaterials::TILES_2;

        $object = new SvObject();
        $object->setMaterial($stenaMaterial);
        $object->setType(SvTypes::BOX);
        $object->setColor(0,0.9,0.3);;
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
    }

    public function theatre()
    {
        $positionCenterX = $this->positionCenterX;
        $positionCenterY = $this->positionCenterY;
        $positionCenterZ = $this->positionCenterZ;

        $object = new SvObject();
        $object->setType(SvTypes::TV_1);
        $object->setXyz($positionCenterX-1, $positionCenterZ+3, $positionCenterY+0.1);
        $object->setRotate(270, 270,0);
        $object->setWidth(1, 1, 1);
        $this->objects[] = $object;

        for ($dy = 10; $dy < 20; $dy+=3) {
            for($dx = -4;$dx < 4; $dx+=2)
            {
                $object = new SvObject();
                $object->setType(SvTypes::FUTON_SOFA);
                $object->setXyz($positionCenterX+$dx, $positionCenterZ+0.1, $positionCenterY+$dy);
                $object->setRotate(270,90,0);
                $object->setWidth(1, 1, 1);
                $this->objects[] = $object;
            }
        }

        $object = new SvObject();
        $object->setType(SvTypes::VEDRO);
        $object->setXyz($positionCenterX+10, $positionCenterZ+0.1, $positionCenterY+15);
        $object->setRotate(270,180,0);
        $object->setWidth(1, 1, 1);
        $this->objects[] = $object;

        $object = new SvObject();
        $object->setType(SvTypes::MAFON);
        $object->setXyz($positionCenterX+10, $positionCenterZ+0.1, $positionCenterY+13);
        $object->setRotate(270,180,0);
        $object->setWidth(1, 1, 1);
        $this->objects[] = $object;


    }
     
    public function generate($light = false) {
        $positionCenterX = $this->positionCenterX;
        $positionCenterY = $this->positionCenterY;
        $positionCenterZ = $this->positionCenterZ;
        $stenaMaterial = SvMaterials::TILES_1;
        
        $this->korobka();
        
        
        $object = new SvObject();
        $object->setMaterial($stenaMaterial);
        $object->setType(SvTypes::BED6);
        $object->setXyz($positionCenterX+5, $positionCenterZ+0.1, $positionCenterY+5);
        $object->setRotate(270,0,0);
        $object->setWidth(1, 1, 1);
        $this->objects[] = $object;

        // bad 2
        $object = new SvObject();
        $object->setMaterial($stenaMaterial);
        $object->setType(SvTypes::BED4);
        $object->setXyz($positionCenterX+5, $positionCenterZ+0.1, $positionCenterY+20);
        $object->setRotate(270,0,0);
        $object->setWidth(1, 1, 1);
        $this->objects[] = $object;
        // bad 2
        $object = new SvObject();
        $object->setMaterial($stenaMaterial);
        $object->setType(SvTypes::BED1);
        $object->setXyz($positionCenterX+8, $positionCenterZ+0.1, $positionCenterY+20);
        $object->setRotate(270,0,0);
        $object->setWidth(1, 1, 1);
        $this->objects[] = $object;
        
        $object = new SvObject();
        $object->setMaterial($stenaMaterial);
        $object->setType(SvTypes::SOFA_4);
        $object->setXyz($positionCenterX+5, $positionCenterZ+0.1, $positionCenterY+15);
        $object->setRotate(270,180,0);
        $object->setWidth(1, 1, 1);
        $this->objects[] = $object;

        $object = new SvObject();
        $object->setMaterial($stenaMaterial);
        $object->setType(SvTypes::SOFA_3);
        $object->setXyz($positionCenterX-5, $positionCenterZ+0.1, $positionCenterY+20);
        $object->setRotate(270,180,0);
        $object->setWidth(1, 1, 1);
        $this->objects[] = $object;


        $object = new SvObject();
        $object->setMaterial($stenaMaterial);
        $object->setType(SvTypes::WALL_PH);
        $object->setXyz($positionCenterX, $positionCenterZ+9.8, $positionCenterY+15);
        $object->setRotate(90,270,270);
        $object->setWidth(1, 1, 1);
        $this->objects[] = $object;

        $object = new SvObject();
        $object->setMaterial($stenaMaterial);
        $object->setType(SvTypes::WALL_PH);
        $object->setXyz($positionCenterX-12, $positionCenterZ+0.1, $positionCenterY+0.5);
        $object->setRotate(270,90,0);
        $object->setWidth(1, 1, 1);
        $this->objects[] = $object;

        if ($light) {
            $object = new SvObject();
//            $object->setMaterial($stenaMaterial);
            $object->setType(SvTypes::LIGHTP);
            $object->setXyz($positionCenterX+5, $positionCenterZ+5, $positionCenterY+10);
            $object->setRotate(0,0,180);
            $object->setWidth(1.5, 1.5, 1.5);
//            $object->setColor(0.858947456,0.7659354,0.254971772);
//            $object->setColor(0.858947456,0.7659354,0.254971772);
            $object->setColor(0.55,0.76,0.75);
            $this->objects[] = $object;

            $object = new SvObject();
//            $object->setMaterial($stenaMaterial);
            $object->setType(SvTypes::LUSTER);
            $object->setXyz($positionCenterX+5, $positionCenterZ+8, $positionCenterY+10);
            $object->setRotate(270,0,180);
            $object->setWidth(1, 1, 1);
            $this->objects[] = $object;
        }


        
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

        //new table
        $positionCenterX = $positionCenterX - 5;
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