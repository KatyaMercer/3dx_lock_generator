<?php
namespace companies\KatyaMercer\Sh;


use companies\KatyaMercer\AbstractLocation;
use KatyaMercer\SvMaterials;
use KatyaMercer\SvObject;
use KatyaMercer\SvTypes;

class StarShip extends AbstractLocation
{
    public $plastinaSize = 2;

    private $radius;

    public function plastinaSize($size)
    {
        $this->plastinaSize = $size;
    }

    public function setRadius($radius)
    {
        $this->radius = $radius;
    }

    public function getRadius()
    {
        return $this->radius;
    }
    public function generate()
    {
        $radius = $this->getRadius();
        $positionCenterX = $this->positionCenterX;
        $positionCenterY = $this->positionCenterY;
        $positionCenterZ = $this->positionCenterZ;
        $leng = $this->size;
        $this->drawKrilo(1);
        $this->drawKrilo(-1);

        for ($alfa = 0; $alfa < 360; $alfa += 5) {
            $x = $radius * sin(deg2rad($alfa));
            $y = $radius * cos(deg2rad($alfa));
            if ($alfa >= 355 || $alfa <=5) {
                $this->drawWhod($alfa, $x, $y, $radius);
                continue;
            }
            if ($alfa > 75 && $alfa < 95) {
                $this->drawIllum($alfa, $x, $y);
                continue;
            }
            if ($alfa > 265 && $alfa < 285) {
                $this->drawIllum($alfa, $x, $y);
                continue;
            }
            $object = new SvObject();
            $object->setType(SvTypes::BOX);
            $object->setXyz($positionCenterX + $x, $positionCenterY + $y, $positionCenterZ);
            $object->setMaterial(SvMaterials::METAL_2);
            $object->setRotate(0, 0, -$alfa);
            $object->setWidth($this->plastinaSize, 0.25, $leng);
            $this->objects[] = $object;
            $x = ($radius-0.25) * sin(deg2rad($alfa));
            $y = ($radius-0.25) * cos(deg2rad($alfa));

            $object = new SvObject();
            $object->setType(SvTypes::BOX);
            $object->setXyz($positionCenterX + $x, $positionCenterY + $y, $positionCenterZ);
            $object->setMaterial(SvMaterials::WALLPAPER_1);
            $object->setRotate(0, 0, -$alfa);
            $object->setWidth($this->plastinaSize, 0.25, $leng);
            $this->objects[] = $object;

            $x = ($radius-0.25) * sin(deg2rad($alfa));
            $y = ($radius-0.25) * cos(deg2rad($alfa));

                $object = new SvObject();
                $object->setType(SvTypes::LIGHTP);
                $object->setXyz($positionCenterX + $x, $positionCenterY + $y, $positionCenterZ+$leng/2);
                $object->setRotate(0, 0, -$alfa);
                $dColor = 3;
                $object->setColor(0.03 , 0.04, 0.04);
//                $object->setColor(0.8, 1, 0.4);
                $object->setWidth($this->plastinaSize, 0.25, $leng*2);
                $this->objects[] = $object;


        }


        $this->hvost();
        $this->paluba1();
        $this->paluba2();
        $this->vint();

        $sub = new SpalnyaSubroom($this);
        $sub->generate(0,12);

        $sub = new RubkaSubroom($this);
        $sub->generate($leng-10,$leng);

        $sub = new TusaSubroom($this);
        $sub->generate($leng-36,$leng-10);

//        $sub = new SpaceSubroom($this);
//        $sub->generate();
    }

    private function vint()
    {
        $radius = $this->getRadius();
        $positionCenterX = $this->positionCenterX;
        $positionCenterY = $this->positionCenterY;
        $positionCenterZ = $this->positionCenterZ;
        $leng = $this->size;

//        $object = new SvObject();
//        $object->setType(SvTypes::FIRE);
//        $object->setXyz($positionCenterX, $positionCenterY, $positionCenterZ-$radius-2);
//        $object->setMaterial(SvMaterials::WALLPAPER_1);
//        $object->setRotate(180, 0, 0);
//        $object->setWidth($radius/2, $radius/2, 10);
//        $this->objects[] = $object;
    }

    private function drawIllum($alfa, $x, $y)
    {
        $positionCenterX = $this->positionCenterX;
        $positionCenterY = $this->positionCenterY;
        $positionCenterZ = $this->positionCenterZ;
        $leng = $this->size;

        $sublength = 3*$leng/4;

        $radius = $this->getRadius();
        $x = $radius * sin(deg2rad($alfa));
        $y = $radius * cos(deg2rad($alfa));

        $x2 = ($radius-0.25) * sin(deg2rad($alfa));
        $y2 = ($radius-0.25) * cos(deg2rad($alfa));

        $delta = 4;
        $noWindow = true;
        for ($i = 0; $i < $leng; $i+=$delta)
        {
            $krilo = ($i > $sublength-2*$radius && $i+$delta < $sublength);
            if ($krilo) {
                continue;
            }
            if ($noWindow || $alfa === 270 || $alfa === 90) {
                $object = new SvObject();
                $object->setType(SvTypes::BOX);
                $object->setXyz($positionCenterX + $x, $positionCenterY + $y, $positionCenterZ+$i);
                $object->setMaterial(SvMaterials::METAL_2);
                $object->setRotate(0, 0, -$alfa);
                $object->setWidth($this->plastinaSize, 0.25, $delta);
                $this->objects[] = $object;

                $object = new SvObject();
                $object->setType(SvTypes::BOX);
                $object->setXyz($positionCenterX + $x2, $positionCenterY + $y2, $positionCenterZ+$i);
                $object->setMaterial(SvMaterials::WALLPAPER_1);
                $object->setRotate(0, 0, -$alfa);
                $object->setWidth($this->plastinaSize, 0.25, $delta);
                $this->objects[] = $object;
            } else {
                if ($alfa === 280 || $alfa === 85) {
                    $object = new SvObject();
                    $object->setType(SvTypes::BOX);
                    $object->setXyz($positionCenterX + $x, $positionCenterY + $y, $positionCenterZ+$i);
                    $object->setMaterial(SvMaterials::GLASS_2);
                    $object->setRotate(0, 0, -$alfa);
                    $object->setWidth($this->plastinaSize*1.75, 0.25, $delta);
                    $this->objects[] = $object;
                }

            }

            $noWindow = !$noWindow;

        }
    }

    private function paluba2()
    {
        $radius = $this->getRadius();
        $positionCenterX = $this->positionCenterX;
        $positionCenterY = $this->positionCenterY;
        $positionCenterZ = $this->positionCenterZ;
        $leng = $this->size;
        $d = sqrt(($radius*$radius)-pow($this->positionCenterY,2));
        $object = new SvObject();
        $object->setType(SvTypes::BOX);
        $object->setXyz($positionCenterX, 0, $positionCenterZ);
        $object->setMaterial(SvMaterials::GRASS_1);
        $object->setRotate(0, 0, 0);
        $object->setWidth($d*2, 0.25, $leng);
        $this->objects[] = $object;
        $types = [
            [
                'tree' => SvTypes::TREE2,
                'ydelta' => 0,
                'width' => 0.45,
                'count' => 3,
            ],
            [
                'tree' => SvTypes::TREE1,
                'ydelta' => 0,
                'width' => 0.45,
                'count' => 2,
            ],
            [
                'tree' => SvTypes::BUSH2,
                'ydelta' => 0,
                'width' => 1,
                'count' => 5,
            ],
            [
                'tree' => SvTypes::GRASS1,
                'ydelta' => 0,
                'width' => 2,
                'count' => 10,
            ],
            [
                'tree' => SvTypes::TREE4,
                'ydelta' => 0,
                'width' => 0.45,
                'count' => 4,
            ],
        ];

        for($i = 1;$i<$leng;$i++) {
            $type = $types[array_rand($types)];
            for ($j = 1;$j<$type['count'];$j++) {
                $object = new SvObject();
                $object->setType($type['tree']);
                $object->setXyz($positionCenterX+rand(-$radius/2,$radius/2), $type['ydelta'], $positionCenterZ+rand(1,$leng));
                $object->setRotate(270, rand(1,360), 0);
                $object->setWidth($type['width'], $type['width'], $type['width']);
                $this->objects[] = $object;
            }

        }
        for ($i = 1; $i < $leng;$i+= $leng/5) {
            $object = new SvObject();
            $object->setType(SvTypes::SOFA_7);
            $object->setXyz($positionCenterX+$radius/2+3, 0, $positionCenterZ+$i);
            $object->setRotate(270, 180, 0);
            $this->objects[] = $object;
        }

        for ($i = 0;$i<=1;$i++) {
            $delta = $i*$d ;
            $deltaA = $i*180;

            $object = new SvObject();
            $object->setType(SvTypes::SEMIARCH1);
            $object->setXyz($positionCenterX + $d / 2 - $delta, 0, $positionCenterZ + $leng);
            $object->setMaterial(SvMaterials::GRASS_2);
            $object->setRotate(0, 0, 0+$deltaA);
            $object->setWidth($d, 0.25, $d);
            $this->objects[] = $object;

            $object = new SvObject();
            $object->setType(SvTypes::SEMIARCH1);
            $object->setXyz($positionCenterX , 0, $positionCenterZ - $d / 2);
            $object->setMaterial(SvMaterials::GRASS_2);
            $object->setRotate(0+$deltaA, 90, 0);
            $object->setWidth($d, 0.25, $d);
            $this->objects[] = $object;
        }
    }

    private function paluba1()
    {
        $radius = $this->getRadius();
        $positionCenterX = $this->positionCenterX;
        $positionCenterY = $this->positionCenterY;
        $positionCenterZ = $this->positionCenterZ;
        $leng = $this->size;
        for ($i = 0;$i<=1;$i++) {
            $delta = $i*$radius ;
            $deltaA = $i*180;
            $object = new SvObject();
            $object->setType(SvTypes::BOX);
            $object->setXyz($positionCenterX + $radius / 2 - $delta, $positionCenterY - 0.125, $positionCenterZ);
            $object->setMaterial(SvMaterials::WALLPAPER_1);
            $object->setRotate(0, 0, 0+$deltaA);
            $object->setWidth($radius, 0.25, $leng);
            $this->objects[] = $object;

            $object = new SvObject();
            $object->setType(SvTypes::SEMIARCH1);
            $object->setXyz($positionCenterX + $radius / 2 - $delta, $positionCenterY - 0.125, $positionCenterZ + $leng);
            $object->setMaterial(SvMaterials::WALLPAPER_1);
            $object->setRotate(0, 0, 0+$deltaA);
            $object->setWidth($radius, 0.25, $radius);
            $this->objects[] = $object;

            if ($i == 1) {
                $object = new SvObject();
                $object->setType(SvTypes::SEMIARCH1);
                $object->setXyz($positionCenterX , $positionCenterY - 0.125, $positionCenterZ - $radius / 2);
                $object->setMaterial(SvMaterials::WALLPAPER_1);
                $object->setRotate(0+$deltaA, 90, 0);
                $object->setWidth($radius, 0.25, $radius);
                $this->objects[] = $object;
            } else {
                $object = new SvObject();
                $object->setType(SvTypes::SEMIARCH1);
                $object->setXyz($positionCenterX , $positionCenterY - 0.125, $positionCenterZ - $radius / 2);
                $object->setMaterial(SvMaterials::GRASS_3);
                $object->setRotate(45, 90, 0);
                $object->setWidth($radius, 0.25, $radius);
                $this->objects[] = $object;
            }

        }
    }

    private function hvost()
    {
        $radius = $this->getRadius();
        $positionCenterX = $this->positionCenterX;
        $positionCenterY = $this->positionCenterY;
        $positionCenterZ = $this->positionCenterZ;
        $leng = $this->size;
        $sloi = [
            [
                'material' => SvMaterials::METAL_2,
                'radius' => $radius
            ],[
                'material' => SvMaterials::WALLPAPER_1,
                'radius' => $radius-0.25
            ],
        ];
        foreach ($sloi as $sloy) {
            $radius = $sloy['radius'];
            $material = $sloy['material'];
            $d = 2.03;
            $object = new SvObject();
            $object->setType(SvTypes::EGG1);
            $object->setXyz($positionCenterX, $positionCenterY, $positionCenterZ+$leng);
            $object->setMaterial($material);
            $object->setRotate(0, 0, 0);
            $object->setWidth($radius*$d, $radius*$d, $radius*$d);
            $this->objects[] = $object;

            $object = clone $object;
            $object->setRotate(0,-90,0);
            $this->objects[] = $object;

            $object = clone $object;
            $object->setRotate(0,0,90);
            $object->setMaterial(SvMaterials::GLASS_2);
            $this->objects[] = $object;

            $object = clone $object;
            $object->setRotate(0,-90,90);
            $this->objects[] = $object;
            // зад
            $object = new SvObject();
            $object->setType(SvTypes::EGG1);
            $object->setXyz($positionCenterX, $positionCenterY, $positionCenterZ);
            $object->setMaterial($material);
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

    }

    private function drawWhod($alfa, $x, $y)
    {
        $radius = $this->getRadius();
        $positionCenterX = $this->positionCenterX;
        $positionCenterY = $this->positionCenterY;
        $positionCenterZ = $this->positionCenterZ;

        $leng = $this->size;

        $x = ($radius - 0.25) * sin(deg2rad($alfa));
        $y = ($radius - 0.25) * cos(deg2rad($alfa));

        $object = new SvObject();
        $object->setType(SvTypes::BOX);
        $object->setXyz($positionCenterX + $x, $positionCenterY + $y, $positionCenterZ);
        $object->setMaterial(SvMaterials::WALLPAPER_1);
        $object->setRotate(0, 0, -$alfa);
        $object->setWidth($this->plastinaSize, 0.25, $leng/2-5);
        $this->objects[] = $object;

        $object = new SvObject();
        $object->setType(SvTypes::BOX);
        $object->setXyz($positionCenterX + $x, $positionCenterY + $y, $positionCenterZ+$leng/2+7);
        $object->setMaterial(SvMaterials::WALLPAPER_1);
        $object->setRotate(0, 0, -$alfa);
        $object->setWidth($this->plastinaSize, 0.25, $leng/2-7);
        $this->objects[] = $object;

        $x = ($radius) * sin(deg2rad($alfa));
        $y = ($radius) * cos(deg2rad($alfa));

        $object = new SvObject();
        $object->setType(SvTypes::BOX);
        $object->setXyz($positionCenterX + $x, $positionCenterY + $y, $positionCenterZ);
        $object->setMaterial(SvMaterials::METAL_2);
        $object->setRotate(0, 0, -$alfa);
        $object->setWidth($this->plastinaSize, 0.25, $leng/2-5);
        $this->objects[] = $object;

        $object = new SvObject();
        $object->setType(SvTypes::BOX);
        $object->setXyz($positionCenterX + $x, $positionCenterY + $y, $positionCenterZ+$leng/2+7);
        $object->setMaterial(SvMaterials::METAL_2);
        $object->setRotate(0, 0, -$alfa);
        $object->setWidth($this->plastinaSize, 0.25, $leng/2-7);
        $this->objects[] = $object;


        $xRazmer = $this->plastinaSize*3;
        if ($alfa == 0) {
            //труба
            $object = new SvObject();
            $object->setType(SvTypes::TUBE);
            $object->setXyz($positionCenterX + $x, $positionCenterY + $y+6, $positionCenterZ+$leng/2+1);
            $object->setMaterial(SvMaterials::GLASS_3);
            $object->setRotate(90, 0, 0);
            $object->setColor(0.4,0.4,0.4);
            $object->setWidth($xRazmer, $this->plastinaSize*10, 6);
            $this->objects[] = $object;

            $object = new SvObject();
            $object->setType(SvTypes::CYLINDER);
            $object->setXyz($positionCenterX + $x, $positionCenterY + $y+6.25, $positionCenterZ+$leng/2+1);
            $object->setMaterial(SvMaterials::GLASS_3);
            $object->setColor(0.4,0.4,0.4);
            $object->setRotate(90, 0, 0);
            $object->setWidth($xRazmer, $this->plastinaSize*10, 0.25);
            $this->objects[] = $object;

//            $object = new SvObject();
//            $object->setType(SvTypes::LIGHTP);
//            $object->setXyz($positionCenterX + $x, $positionCenterY + $y+4.25, $positionCenterZ+$leng/2+1);
//            $object->setMaterial(SvMaterials::GLASS_3);
//            $object->setColor(1.3,1.3,1.3);
//            $object->setRotate(90, 0, 0);
//            $object->setWidth($xRazmer, $xRazmer, 0.25);
//            $this->objects[] = $object;

            //лестница
            for ($height = 0; $height < round($radius/2); $height++) {
                $object = new SvObject();
                $object->setType(SvTypes::STAIR2);
                $object->setXyz($positionCenterX + $x, $positionCenterY + $y - $height*2, $positionCenterZ-5+$leng/2+ $height*2);
                $object->setMaterial(SvMaterials::WALLPAPER_1);
                $object->setRotate(0, 0, 0);
                $object->setWidth($this->plastinaSize*3, 1, 1);
                $this->objects[] = $object;
            }

        }
    }

    private function drawKrilo($rot = 1, $material = SvMaterials::METAL_2)
    {
        $radius = $this->getRadius() + ($material === SvMaterials::METAL_2 ? 0.25 : 0.1);
        $positionCenterX = $this->positionCenterX;
        $positionCenterY = $this->positionCenterY;
        $positionCenterZ = $this->positionCenterZ;

        $leng = $this->size;
        $sublength = 3*$leng/4;
        // bok
        $ybok = $rot === 1 ? 0 : 90;
        $object = new SvObject();
        $object->setType(SvTypes::EGG5);
        $object->setXyz($positionCenterX + $rot * $radius, $positionCenterY, $positionCenterZ+$sublength);
        $object->setMaterial($material);
        $object->setRotate(270, 0, 3*$ybok);
        $object->setWidth(2*$radius,2* $radius, 2*$radius);
        $this->objects[] = $object;

//        $object = clone $object;
//        $object->setRotate(90, 0, 90+$ybok);
//        $this->objects[] = $object;

        $object = clone $object;
        $object->setXyz($positionCenterX + $rot * $radius, $positionCenterY, $positionCenterZ+$sublength -2*$radius);
        $object->setRotate(270, 0, 90+$ybok);
        $this->objects[] = $object;

//        $object = clone $object;
//        $object->setRotate(90, 0, -$ybok);
//        $this->objects[] = $object;
        //kabina
        $krilLen = 3;
        for ($i = 1; $i< $krilLen; $i++) {
            $object = new SvObject();
            $object->setType(SvTypes::EGG2);
            $object->setXyz($positionCenterX + $rot * $radius*(0.5+ $i), $positionCenterY, $positionCenterZ+$sublength-$radius);
            $object->setMaterial(SvMaterials::GLASS_3);
            $object->setRotate(270, 0, 0);
            $object->setWidth(2*$radius,2* $radius, 2*$radius);
            $this->objects[] = $object;

            $object = clone $object;
            $object->setMaterial($material);
            $object->setRotate(270, 180, 0);
            $this->objects[] = $object;
        }
        //pol
        if ($material !== SvMaterials::METAL_2) {
            $object = new SvObject();
            $object->setType(SvTypes::BOX);
            $object->setXyz($positionCenterX + $rot * 2 * $radius, $positionCenterY, $positionCenterZ + $sublength - 2 * $radius);
            $object->setMaterial($material);
            $object->setRotate(0, 0, 0);
            $object->setWidth(2 * $radius, 0.25, 2 * $radius);
            $this->objects[] = $object;
        }

        //konec
        $object = new SvObject();
        $object->setType(SvTypes::SEMIARCH1);
        $object->setXyz($positionCenterX + $rot *3* $radius, $positionCenterY+$radius/2, $positionCenterZ+$sublength-$radius);
        $object->setMaterial($material);
        $object->setRotate(0, 0, 90);
        $object->setWidth($radius,0.25, $radius);
        $this->objects[] = $object;

        $object = clone $object;
        $object->setRotate(0, 180, 90);
        $this->objects[] = $object;

        if ($material === SvMaterials::METAL_2) {
            $this->drawKrilo($rot, SvMaterials::WALLPAPER_1);
        }

    }
}
