<?php
namespace companies\Luna;
use companies\KatyaMercer\AbstractLocation;
use \KatyaMercer\SvMaterials;
use \KatyaMercer\SvObject;
use \KatyaMercer\SvTypes;

/**
 * runner companies\Luna\LunaWood
 * Class LunaWood
 * @package companies\Luna
 */
class LunaWood extends AbstractLocation{

    public function addRocks($ovjCount)
    {
        $positionCenterX = $this->positionCenterX;
        $positionCenterY = $this->positionCenterY;
        $positionCenterZ = $this->positionCenterZ;
        $size = $this->size;
        $array = [
            SvTypes::STONE_33_G_COLORED,
            SvTypes::STONE_33_SN_COLORED,
            SvTypes::STONE_33_SA_COLORED,
            SvTypes::STONE_10_G_COLORED,
            SvTypes::STONE_10_SA_COLORED,
            SvTypes::STONE_33_COLORED,
        ];
        for($i = 0;$i<$ovjCount;$i++) {
            $object = new SvObject();
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
    public function generate($ovjCount) {
        $positionCenterX = $this->positionCenterX;
        $positionCenterY = $this->positionCenterY;
        $positionCenterZ = $this->positionCenterZ;
        $size = $this->size;
        $array = [
//            SvTypes::TREE1, //Ива
//            SvTypes::TREE2, //Пальма
            SvTypes::TREE3, //Берёза
            SvTypes::TREE4, //Ель
//            SvTypes::TREE5, //Ёлочки
//            SvTypes::TREE6, //Кактусы
//            SvTypes::TREE7, //Дуб
            SvTypes::BUSH1,
            SvTypes::BUSH1,
            SvTypes::BUSH2,
        ];
        for($i = 0;$i<$ovjCount;$i++) {
            $object = new SvObject();
            $object->setType($array[array_rand($array)]);
            $object->setRotate(270, rand(1,360), 0);
            $width = rand(1,2);
            $more = rand(1,5);
            $object->setWidth($more, $more,$more * rand(50,150)/100);
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