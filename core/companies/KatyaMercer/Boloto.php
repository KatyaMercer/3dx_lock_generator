<?php
namespace companies\KatyaMercer;
use \KatyaMercer\DXKMaterials;
use \KatyaMercer\DXKObject;
use \KatyaMercer\DXKTypes;

/**
 * This class I dedicate to dear Rita
 *
 * Class Boloto
 * @package companies\KatyaMercer
 */
class Boloto extends AbstractLocation{

    public function generate($countTrav, $countStone, $countTree, $mountCount) {
        $px = $this->positionCenterX;
        $py = $this->positionCenterY;
        $pz = $this->positionCenterZ;
        $size = $this->size;
        
        $object = new DXKObject();
        $object->setMaterial(DXKMaterials::SAND_2);
        $object->setType(DXKTypes::BOX);
        $object->setXyz($px, $py-1, $pz);
        $object->setWidth($size, 0.05, $size);
        $this->objects[] = $object;
        
        $object = new DXKObject();
        $object->setMaterial(DXKMaterials::FOLIAGE_3);
        $object->setType(DXKTypes::BOX);
        $object->setXyz($px, $py-0.2, $pz);
        $object->setWidth($size, 0.2, $size);

        $this->objects[] = $object;
        for ($i = 0; $i< $countTrav; $i++) {
            $object = new DXKObject();
            $object->setType(DXKTypes::GRASS1);
            $object->setXyz($px+rand(0,$size-5)-$size/2, $py-1, $pz+rand(0,$size-5));
            $object->setRotate(270, 0, 0);
            $object->setWidth(10, 20, 10);

            $this->objects[] = $object;
        }
        
        for ($i = 0; $i< $countStone; $i++) {
            $object = new DXKObject();
            $object->setType(DXKTypes::STONE_10_G_COLORED);
            $object->setXyz($px+rand(0,$size-5)-$size/2, $py-1, $pz+rand(0,$size-5));
            $object->setRotate(rand(0,270), rand(0,270), rand(0,270));
            $object->setWidth(rand(1000,5000)/1000, rand(1000,5000)/1000, rand(1000,5000)/1000);

            $this->objects[] = $object;
        }
        for ($i = 0; $i< $countTree; $i++) {
            $object = new DXKObject();
            $object->setType(DXKTypes::TREE1);
            $object->setXyz($px+rand(0,$size-5)-$size/2, $py-1, $pz+rand(0,$size-5));
            $object->setRotate(270, rand(0,180), 0);
            $object->setWidth(1, 1, 1);

            $this->objects[] = $object;
        }
        for ($i = 0; $i< $mountCount; $i++) {
            $object = new DXKObject();
            $object->setType(DXKTypes::TERRAIN_GRASS);
            $object->setXyz($px+rand(0,$size-5)-$size/2, $py-1, $pz+rand(0,$size-5));
            $object->setRotate(270, rand(0,180), 0);
            $object->setWidth(rand(1,100)/100, rand(1,100)/100, rand(1,100)/200);

            $this->objects[] = $object;
        }
    }
    

}