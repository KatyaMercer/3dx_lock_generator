<?php
namespace companies\KatyaMercer;


use KatyaMercer\DXKMaterials;
use KatyaMercer\DXKObject;
use KatyaMercer\DXKTypes;

class Submarine extends AbstractLocation
{
    public function generate($radius)
    {
        $positionCenterX = $this->positionCenterX;
        $positionCenterY = $this->positionCenterY;
        $positionCenterZ = $this->positionCenterZ;
        $leng = $this->size;

        for ($alfa = 0; $alfa < 360; $alfa += 5) {
            $x = $radius * sin(deg2rad($alfa));
            $y = $radius * cos(deg2rad($alfa));
            if ($alfa >= 355 || $alfa <=5) {
                $this->drawWhod($alfa, $x, $y);
                continue;
            }
            if ($alfa > 75 && $alfa < 90) {
                $this->drawIllum($alfa, $x, $y);
                continue;
            }
            if ($alfa > 270 && $alfa < 285) {
                $this->drawIllum($alfa, $x, $y);
                continue;
            }
            $object = new DXKObject();
            $object->setType(DXKTypes::BOX);
            $object->setXyz($positionCenterX + $x, $positionCenterY + $y, $positionCenterZ);
            $object->setMaterial(DXKMaterials::METAL_2);
            $object->setRotate(0, 0, -$alfa);
            $object->setWidth(2, 0.25, $leng);
            $this->objects[] = $object;



        }
        for ($le = 0; $le < $leng;$le+= 10) {
            for ($alfa = 0; $alfa < 360; $alfa += 20) {
                if ($alfa > 75 && $alfa < 90) {
//                    $this->drawIllum($alfa, $x, $y);
                    continue;
                }
                if ($alfa > 270 && $alfa < 285) {
//                    $this->drawIllum($alfa, $x, $y);
                    continue;
                }
                $x = ($radius/2) * sin(deg2rad($alfa));
                $y = ($radius/2) * cos(deg2rad($alfa));
                $object = new DXKObject();
                $object->setType(DXKTypes::LIGHTP);
                $object->setXyz($positionCenterX + $x, $positionCenterY + $y, $positionCenterZ+$le);
                $object->setMaterial(DXKMaterials::METAL_2);
                $object->setRotate(90, 90, $alfa);
                $object->setColor(1, 0.5, 0.5);
                $object->setWidth(1, 1, 1);
                $this->objects[] = $object;
            }
        }

        $this->hvost($radius);
        $this->paluba1($radius);
        $this->paluba2($radius);
        $this->vint($radius);
    }

    private function vint($radius)
    {
        $positionCenterX = $this->positionCenterX;
        $positionCenterY = $this->positionCenterY;
        $positionCenterZ = $this->positionCenterZ;
        $leng = $this->size;

        for ($alfa = 0; $alfa < 360; $alfa += 30) {
            $object = new DXKObject();
            $object->setType(DXKTypes::EGG5);
            $object->setXyz($positionCenterX, $positionCenterY, $positionCenterZ-$radius);
            $object->setMaterial(DXKMaterials::METAL_2);
            $object->setRotate(180, 0, -$alfa);
            $object->setWidth(2*$radius, 0.25, 10);
            $this->objects[] = $object;
        }
    }

    private function drawIllum($alfa, $x, $y)
    {
        $positionCenterX = $this->positionCenterX;
        $positionCenterY = $this->positionCenterY;
        $positionCenterZ = $this->positionCenterZ;
        $leng = $this->size;
        $delta = 4;
        $noWindow = true;
        for ($i = 0; $i < $leng; $i+=$delta)
        {

            $object = new DXKObject();
            $object->setType(DXKTypes::BOX);
            $object->setXyz($positionCenterX + $x, $positionCenterY + $y, $positionCenterZ+$i);
            $object->setMaterial($noWindow ? DXKMaterials::METAL_2 : DXKMaterials::GLASS_2);
            $object->setRotate(0, 0, -$alfa);
            $object->setWidth(2, 0.25, $delta);
            $this->objects[] = $object;

            $noWindow = !$noWindow;

        }
    }

    private function paluba2($radius)
    {
        $positionCenterX = $this->positionCenterX;
        $positionCenterY = $this->positionCenterY;
        $positionCenterZ = $this->positionCenterZ;
        $leng = $this->size;
        $d = sqrt(($radius*$radius)-pow($this->positionCenterY,2));
        $object = new DXKObject();
        $object->setType(DXKTypes::BOX);
        $object->setXyz($positionCenterX, 0, $positionCenterZ);
        $object->setMaterial(DXKMaterials::METAL_2);
        $object->setRotate(0, 0, 0);
        $object->setWidth($d*2, 0.25, $leng);
        $this->objects[] = $object;

        for ($i = 0;$i<=1;$i++) {
            $delta = $i*$d ;
            $deltaA = $i*180;

            $object = new DXKObject();
            $object->setType(DXKTypes::SEMIARCH1);
            $object->setXyz($positionCenterX + $d / 2 - $delta, 0, $positionCenterZ + $leng);
            $object->setMaterial(DXKMaterials::METAL_2);
            $object->setRotate(0, 0, 0+$deltaA);
            $object->setWidth($d, 0.25, $d);
            $this->objects[] = $object;

            $object = new DXKObject();
            $object->setType(DXKTypes::SEMIARCH1);
            $object->setXyz($positionCenterX , 0, $positionCenterZ - $d / 2);
            $object->setMaterial(DXKMaterials::METAL_2);
            $object->setRotate(0+$deltaA, 90, 0);
            $object->setWidth($d, 0.25, $d);
            $this->objects[] = $object;
        }
    }

    private function paluba1($radius)
    {
        $positionCenterX = $this->positionCenterX;
        $positionCenterY = $this->positionCenterY;
        $positionCenterZ = $this->positionCenterZ;
        $leng = $this->size;
        for ($i = 0;$i<=1;$i++) {
            $delta = $i*$radius ;
            $deltaA = $i*180;
            $object = new DXKObject();
            $object->setType(DXKTypes::BOX);
            $object->setXyz($positionCenterX + $radius / 2 + 0.75 - $delta - 1.5*$i, $positionCenterY - 0.125, $positionCenterZ);
            $object->setMaterial(DXKMaterials::METAL_2);
            $object->setRotate(0, 0, 0+$deltaA);
            $object->setWidth($radius - 1.25, 0.25, $leng);
            $this->objects[] = $object;

            $object = new DXKObject();
            $object->setType(DXKTypes::SEMIARCH1);
            $object->setXyz($positionCenterX + $radius / 2 - $delta, $positionCenterY - 0.125, $positionCenterZ + $leng);
            $object->setMaterial(DXKMaterials::METAL_2);
            $object->setRotate(0, 0, 0+$deltaA);
            $object->setWidth($radius, 0.25, $radius);
            $this->objects[] = $object;

            $object = new DXKObject();
            $object->setType(DXKTypes::SEMIARCH1);
            $object->setXyz($positionCenterX , $positionCenterY - 0.125, $positionCenterZ - $radius / 2);
            $object->setMaterial(DXKMaterials::METAL_2);
            $object->setRotate(0+$deltaA, 90, 0);
            $object->setWidth($radius, 0.25, $radius);
            $this->objects[] = $object;
        }
    }

    private function hvost($radius)
    {
        $positionCenterX = $this->positionCenterX;
        $positionCenterY = $this->positionCenterY;
        $positionCenterZ = $this->positionCenterZ;
        $leng = $this->size;

        $d = 2.03;
        $object = new DXKObject();
        $object->setType(DXKTypes::EGG1);
        $object->setXyz($positionCenterX, $positionCenterY, $positionCenterZ+$leng);
        $object->setMaterial(DXKMaterials::METAL_2);
        $object->setRotate(0, 0, 0);
        $object->setWidth($radius*$d, $radius*$d, $radius*$d);
        $this->objects[] = $object;

        $object = clone $object;
        $object->setRotate(0,-90,0);
        $this->objects[] = $object;

        $object = clone $object;
        $object->setRotate(0,0,90);
        $object->setMaterial(DXKMaterials::GLASS_2);
        $this->objects[] = $object;

        $object = clone $object;
        $object->setRotate(0,-90,90);
        $this->objects[] = $object;
        // зад
        $object = new DXKObject();
        $object->setType(DXKTypes::EGG1);
        $object->setXyz($positionCenterX, $positionCenterY, $positionCenterZ);
        $object->setMaterial(DXKMaterials::METAL_2);
        $object->setRotate(0, 90, 0);
        $object->setWidth($radius*$d, $radius*$d, $radius*$d);
        $this->objects[] = $object;

        $object = clone $object;
        $object->setRotate(0,180,0);
        $this->objects[] = $object;

        $object = clone $object;
        $object->setRotate(0,90,90);
        $this->objects[] = $object;

        $object = clone $object;
        $object->setRotate(0,180,90);
        $this->objects[] = $object;
    }

    private function drawWhod($alfa, $x, $y)
    {
        $positionCenterX = $this->positionCenterX;
        $positionCenterY = $this->positionCenterY;
        $positionCenterZ = $this->positionCenterZ;

        $leng = $this->size;

        $object = new DXKObject();
        $object->setType(DXKTypes::BOX);
        $object->setXyz($positionCenterX + $x, $positionCenterY + $y, $positionCenterZ);
        $object->setMaterial(DXKMaterials::METAL_2);
        $object->setRotate(0, 0, -$alfa);
        $object->setWidth(2, 0.25, $leng/2-5);
        $this->objects[] = $object;

        $object = new DXKObject();
        $object->setType(DXKTypes::BOX);
        $object->setXyz($positionCenterX + $x, $positionCenterY + $y, $positionCenterZ+$leng/2+7);
        $object->setMaterial(DXKMaterials::METAL_2);
        $object->setRotate(0, 0, -$alfa);
        $object->setWidth(2, 0.25, $leng/2-7);
        $this->objects[] = $object;
        if ($alfa == 0) {
            //труба
            $object = new DXKObject();
            $object->setType(DXKTypes::TUBE);
            $object->setXyz($positionCenterX + $x, $positionCenterY + $y+6, $positionCenterZ+$leng/2+1);
            $object->setMaterial(DXKMaterials::METAL_2);
            $object->setRotate(90, 0, 0);
            $object->setWidth(4.25, 20, 6);
            $this->objects[] = $object;

            //верхушечка
            $object = new DXKObject();
            $object->setType(DXKTypes::SEMIARCH1);
            $object->setXyz($positionCenterX + $x+0.5, $positionCenterY + $y+6-0.125, $positionCenterZ+$leng/2+2.7);
            $object->setMaterial(DXKMaterials::METAL_2);
            $object->setRotate(0, 0, 0);
            $object->setWidth(4.8/2, 0.25, 7);
            $this->objects[] = $object;

            $object = new DXKObject();
            $object->setType(DXKTypes::SEMIARCH1);
            $object->setXyz($positionCenterX + $x-0.5, $positionCenterY + $y+6-0.125, $positionCenterZ+$leng/2+2.7);
            $object->setMaterial(DXKMaterials::METAL_2);
            $object->setRotate(0, 0, 180);
            $object->setWidth(4.8/2, 0.25, 7);
            $this->objects[] = $object;

            $object = new DXKObject();
            $object->setType(DXKTypes::SEMIARCH1);
            $object->setXyz($positionCenterX + $x-0.5, $positionCenterY + $y+6-0.125, $positionCenterZ+$leng/2-2.7);
            $object->setMaterial(DXKMaterials::METAL_2);
            $object->setRotate(0, 180, 0);
            $object->setWidth(4.8/2, 0.25, 5);
            $this->objects[] = $object;

            $object = new DXKObject();
            $object->setType(DXKTypes::SEMIARCH1);
            $object->setXyz($positionCenterX + $x+0.5, $positionCenterY + $y+6-0.125, $positionCenterZ+$leng/2-2.7);
            $object->setMaterial(DXKMaterials::METAL_2);
            $object->setRotate(0, 180, 180);
            $object->setWidth(4.8/2, 0.25, 5);
            $this->objects[] = $object;

            //лестница
            for ($height = 0; $height < 14; $height++) {
                $object = new DXKObject();
                $object->setType(DXKTypes::STAIR2);
                $object->setXyz($positionCenterX + $x, $positionCenterY + $y+6 - $height*2, $positionCenterZ+$leng/2-2.7+ $height*2);
                $object->setMaterial(DXKMaterials::METAL_2);
                $object->setRotate(0, 0, 0);
                $object->setWidth(3.2, 1, 1);
                $this->objects[] = $object;
            }

        }
    }
}
