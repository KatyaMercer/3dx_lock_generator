<?php
namespace companies\KatyaMercer;
use \KatyaMercer\DXKMaterials;
use \KatyaMercer\DXKObject;
use \KatyaMercer\DXKTypes;
class Wood extends AbstractLocation{

    public function addRocks($ovjCount)
    {
        $positionCenterX = $this->positionCenterX;
        $positionCenterY = $this->positionCenterY;
        $positionCenterZ = $this->positionCenterZ;
        $size = $this->size;
        $array = [
            DXKTypes::STONE_33_G_COLORED,
            DXKTypes::STONE_33_SN_COLORED,
            DXKTypes::STONE_33_SA_COLORED,
            DXKTypes::STONE_10_G_COLORED,
            DXKTypes::STONE_10_SA_COLORED,
            DXKTypes::STONE_33_COLORED,
        ];
        for($i = 0;$i<$ovjCount;$i++) {
            $object = new DXKObject();
            $object->setType($array[array_rand($array)]);
            $object->setRotate(rand(1, 360), rand(1, 360), rand(1, 360));
            $width = rand(1, 2);
            $object->setWidth(rand(50, 300)/100, rand(50, 300)/100, rand(50, 300)/100);
            $x = $positionCenterX + rand(1, $size);
            $y = $positionCenterZ + rand(1, $size);
            $object->setXyz($x, $positionCenterY, $y);
            $this->objects[] = $object;
        }
    }
    public function generate($objectCount, $sizeKoef = 1) {
        $positionCenterX = $this->positionCenterX;
        $positionCenterY = $this->positionCenterY;
        $positionCenterZ = $this->positionCenterZ;
        $size = $this->size;
        $array = [
            DXKTypes::TREE1,
            DXKTypes::TREE2,
            DXKTypes::TREE3,
            DXKTypes::TREE4,
            DXKTypes::TREE5,
//            DXKTypes::TREE6,
            DXKTypes::TREE7,
            DXKTypes::BUSH1,
            DXKTypes::BUSH1,
            DXKTypes::BUSH2,
        ];
        for($i = 0; $i<$objectCount; $i++) {
            $object = new DXKObject();
            $type = $array[array_rand($array)];
            $object->setType($type);
            $object->setRotate(270, rand(1,360), 0);
            $width = rand(1,2);
            if (0 === strpos($type, 'Bush')) {
                $object->setWidth($width, $width, rand(50, 200) / 100);
            } else {
                $object->setWidth($sizeKoef*$width, $sizeKoef*$width, $sizeKoef*rand(50, 200) / 100);
            }

            $x = $positionCenterX+rand(1, $size);
            $y = $positionCenterZ+rand(1, $size);
            $object->setXyz($x, $positionCenterY, $y);
            $this->objects[] = $object;

            $object = new DXKObject();
            $object->setType(DXKTypes::GRASS1);
            $object->setRotate(270, rand(1,360), 0);
            $object->setWidth(rand(2,10), rand(2,10), rand(1,5));
            $object->setXyz($x, $positionCenterY, $y);
            $this->objects[] = $object;
        }
    }
    
}