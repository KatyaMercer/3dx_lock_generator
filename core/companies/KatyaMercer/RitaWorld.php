<?php
namespace companies\KatyaMercer;
use \KatyaMercer\SvMaterials;
use \KatyaMercer\SvObject;
use \KatyaMercer\SvTypes;

/**
 * This class I dedicate to dear Rita
 *
 * Class RitaWorld
 * @package companies\KatyaMercer
 */
class RitaWorld extends AbstractLocation{

    private function getRandStone()
    {
        $a = [
            SvTypes::STONE_10_SA_COLORED,
            SvTypes::STONE_10_G_COLORED,
            SvTypes::STONE_10_COLORED,
            SvTypes::STONE_33_SA_COLORED,
            SvTypes::STONE_33_SN_COLORED,
            SvTypes::STONE_33_G_COLORED
            ];
        return $a[array_rand($a)];
    }

    public function generateTree($x, $y, $z, $tree = SvTypes::TREE3)
    {
        $obj = new SvObject();
        $obj->setType($tree);
        $obj->setXyz($x,$y,$z);
        $obj->setRotate(-90,180,0);
        $obj->setWidth(1,1,1);
        $this->objects[] = $obj;

        $obj = new SvObject();
        $obj->setType(SvTypes::CYLINDER);
        $obj->setMaterial(SvMaterials::GRASS_1);
        $obj->setXyz($x,$y,$z);
        $obj->setRotate(-90,180,0);
        $obj->setWidth(1.3,1.3,1.3);
        $this->objects[] = $obj;

        $obj= clone $obj;
        $obj->setType(SvTypes::TUBE);
        $obj->setMaterial(SvMaterials::BRICK_3);
        $obj->setWidth(1.4,1.4,1.4);

        $this->objects[] = $obj;
    }

    public function generate($light = false, $fromRadius = 40, $toRadius = 41, $needDrawDown = false) {
        $positionCenterX = $this->positionCenterX;
        $positionCenterY = $this->positionCenterY;
        $positionCenterZ = $this->positionCenterZ;

        $leng = $this->size;

        for ($le = 0; $le <= $leng; $le+=5) {
            for ($alf1 = -10; $alf1 < 190; $alf1+=40) {
                $alf = $alf1-90;
                if ($le> 10 and $le < $leng-10) {
                    $x = $fromRadius/2*sin(deg2rad($alf));
                    $y = $fromRadius/2*cos(deg2rad($alf));
                    $object = new SvObject();
                    $object->setType(SvTypes::LIGHTP);
                    $object->setXyz($positionCenterX+$x,$positionCenterY+$y,$positionCenterZ+$le);
                    $object->setRotate(0, 0, 180);
                    $object->setWidth(2, 2, 2);
                    $object->setColor(0.55, 0.76, 0.75);
                    $this->objects[] = $object;
                }
            }
            for ($alf1 = -10; $alf1 < 190; $alf1+=10) {
                $alf = $alf1-90;
                $fradT = $fromRadius;
                if ($le == $leng) {

                    $fradT = 15;
                }
                if ($le == 0) {

                    $fradT = 9;
                }
                for ($rad = $fradT; $rad < $toRadius; $rad++) {
                    $x = $rad*sin(deg2rad($alf));
                    $y = $rad*cos(deg2rad($alf));
                    $obj = new SvObject();
                    $obj->setType($this->getRandStone());
                    $obj->setXyz($positionCenterX+$x,$positionCenterY+$y,$positionCenterZ+$le);
                    $obj->setRotate(rand(0,360),rand(0,360),rand(0,360));
                    $obj->setWidth(5,5,5);
                    $this->objects[] = $obj;
                }
            }

            if ($le < $leng-20 && $le > 10 ) {


                $object = new SvObject();
                $object->setType(SvTypes::LIGHTP);
                $object->setXyz($positionCenterX + rand(-$toRadius / 3, $toRadius / 3), $positionCenterY + $fromRadius / 4, $positionCenterZ + $le);
                $object->setRotate(0, 0, 180);
                $object->setWidth(2, 2, 2);
                $object->setColor(0.55, 0.76, 0.75);
                $this->objects[] = $object;
            }

            if ($needDrawDown) {
                for ($x = -$fromRadius; $x < $fromRadius; $x += 5) {
                    $obj = new SvObject();
                    $obj->setType($this->getRandStone());
                    $obj->setXyz($positionCenterX + $x + rand(-5, 5), $positionCenterY, $positionCenterZ + $le + rand(-5, 5));
                    $obj->setRotate(rand(0, 360), rand(0, 360), rand(0, 360));
                    $obj->setWidth(1, 1, 1);
                    $this->objects[] = $obj;
                }
            }
        }


        if ($needDrawDown) {
            $obj = new SvObject();
            $obj->setType(SvTypes::BOX);
            $obj->setMaterial(SvMaterials::STONES_3);
            $obj->setXyz($positionCenterX,$positionCenterY,$positionCenterZ);
            $obj->setRotate(0,0,0);
            $obj->setWidth($fromRadius*2,0.1,$leng);
            $this->objects[] = $obj;
        }

    }

    public function generPlatform()
    {
        $positionCenterX = $this->positionCenterX;
        $positionCenterY = $this->positionCenterY;
        $positionCenterZ = $this->positionCenterZ;

        $leng = $this->size;

        $def = new DefRespawn();
        $def->setHeight(10);
        $def->setSize(30);
        $def->setPos($positionCenterX,$positionCenterY+4,$positionCenterZ+$leng/4-15);
        $def->generate(SvMaterials::BRICK_3);
        $this->objects = array_merge($this->objects, $def->objects);

        $positionCenterY = $positionCenterY + 0.1;

        $bed = new SvObject();
        $bed->setXyz($positionCenterX,$positionCenterY+4,$positionCenterZ+$leng/4);
        $bed->setRotate(270,45,0);
        $bed->setType(SvTypes::BED3);
        $this->objects[] = $bed;

        $bed = new SvObject();
        $bed->setXyz($positionCenterX-4,$positionCenterY+4,$positionCenterZ+$leng/4);
        $bed->setRotate(270,-45,0);
        $bed->setType(SvTypes::SOFA_4);
        $this->objects[] = $bed;

        $object = new SvObject();
//        $object->setMaterial(SvMaterials::BRICK_3);
        $object->setType(SvTypes::WALL_PH);
        $object->setXyz($positionCenterX-4,$positionCenterY+4,$positionCenterZ+$leng/4-1);
        $object->setRotate(270,-45,0);
//        $object->setWidth(1, 1, 1);
        $this->objects[] = $object;

        $bed = new SvObject();
        $bed->setXyz($positionCenterX-2,$positionCenterY+4,$positionCenterZ+$leng/4+2);
        $bed->setRotate(270,-45,0);
        $bed->setType(SvTypes::POLE);
        $this->objects[] = $bed;

        $bed = new SvObject();
        $bed->setXyz($positionCenterX-3,$positionCenterY+4,$positionCenterZ+$leng/4+5);
        $bed->setRotate(270,90,0);
        $bed->setType(SvTypes::FUTON_SOFA);
        $this->objects[] = $bed;

        $bed = new SvObject();
        $bed->setXyz($positionCenterX,$positionCenterY+4,$positionCenterZ+$leng/4+4);
        $bed->setRotate(270,0,0);
        $bed->setType(SvTypes::CHAIR_GIOVANNETTI_RED);
        $this->objects[] = $bed;

        $object = new SvObject();
        $object->setType(SvTypes::VEDRO);
        $object->setXyz($positionCenterX+12, $positionCenterZ+4, $positionCenterY+$leng/4+2);
        $object->setRotate(270,180,0);
        $object->setWidth(1, 1, 1);
        $this->objects[] = $object;


        $this->generateTree($positionCenterX+14,$positionCenterY+4,$positionCenterZ+$leng/4+7, SvTypes::TREE3);
        $this->generateTree($positionCenterX-14,$positionCenterY+4,$positionCenterZ+$leng/4+7, SvTypes::TREE7);
        $this->generateTree($positionCenterX-11,$positionCenterY+4,$positionCenterZ+$leng/4-11, SvTypes::TREE1);
        $this->generateTree($positionCenterX,$positionCenterY+4,$positionCenterZ+$leng/4-12, SvTypes::TREE4);
    }

}