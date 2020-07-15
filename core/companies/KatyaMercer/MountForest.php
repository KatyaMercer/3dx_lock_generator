<?php
namespace companies\KatyaMercer;
use \KatyaMercer\SvMaterials;
use \KatyaMercer\SvObject;
use \KatyaMercer\SvTypes;
class MountForest extends AbstractLocation{

    private function getRandTree()
    {
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

        return $array[array_rand($array)];
    }
    public function generate() {
        $positionCenterX = $this->positionCenterX;
        $positionCenterY = $this->positionCenterY;
        $positionCenterZ = $this->positionCenterZ;

        $wX = 1;
        $wY = 1;
        $wZ = 1;
        $mount = new SvObject();
        $mount->setXyz($positionCenterX, $positionCenterY, $positionCenterZ);
        $mount->setWidth($wX, $wY, $wZ);
        $mount->setType(SvTypes::TERRAIN_GRASS);
        $rot = 0;
        $mount->setRotate(270 , $rot, 0);
        $this->objects[] = $mount;

        $count = 50;
        $radius = 30;
        $hight = 12;

        $ugol2 = (($hight)/$radius);

        for($i = 0;$i< $count;$i++) {
            $ugol = rand(0,360);
            $r = rand(0, $radius);

            $object = new SvObject();
//            $type = $this->getRandTree();
            if ($ugol > 180) {
                $type = SvTypes::TREE4;
            } else {
                $type = SvTypes::TREE1;
            }
            $object->setType($type);
            $object->setRotate(270, rand(1,360), 0);
            $width = rand(1,1);
            $object->setWidth($width, $width, rand(50, 200) / 100);
            $x = $positionCenterX+$r*sin(deg2rad($ugol));
            $z = $positionCenterZ+$r*cos(deg2rad($ugol));
            $y = $positionCenterY+$hight-$r*$ugol2;
            $object->setXyz($x, $y, $z);
            $this->objects[] = $object;
        }
    }

}