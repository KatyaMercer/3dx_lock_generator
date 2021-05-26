<?php
namespace companies\KatyaMercer\Sh;


use companies\KatyaMercer\AbstractLocation;
use KatyaMercer\DXKMaterials;
use KatyaMercer\DXKObject;
use KatyaMercer\DXKTypes;

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
            $object = new DXKObject();
            $object->setType(DXKTypes::BOX);
            $object->setXyz($positionCenterX + $x, $positionCenterY + $y, $positionCenterZ);
            $object->setMaterial(DXKMaterials::WALLPAPER_2);
            $object->setRotate(0, 0, -$alfa);
            $object->setWidth($this->plastinaSize, 0.25, $leng);
            $this->objects[] = $object;
            $x = ($radius-0.25) * sin(deg2rad($alfa));
            $y = ($radius-0.25) * cos(deg2rad($alfa));

            $object = new DXKObject();
            $object->setType(DXKTypes::BOX);
            $object->setXyz($positionCenterX + $x, $positionCenterY + $y, $positionCenterZ);
            $object->setMaterial(DXKMaterials::WALLPAPER_1);
            $object->setRotate(0, 0, -$alfa);
            $object->setWidth($this->plastinaSize, 0.25, $leng);
            $this->objects[] = $object;

            $x = ($radius-0.25) * sin(deg2rad($alfa));
            $y = ($radius-0.25) * cos(deg2rad($alfa));

//                $object = new DXKObject();
//                $object->setType(DXKTypes::LIGHTP);
//                $object->setXyz($positionCenterX + $x, $positionCenterY + $y, $positionCenterZ+$leng/2);
//                $object->setRotate(0, 0, -$alfa);
//                $dColor = 3;
//                $object->setColor(0.03 , 0.04, 0.04);
////                $object->setColor(0.8, 1, 0.4);
//                $object->setWidth($this->plastinaSize, 0.25, $leng*2);
//                $this->objects[] = $object;


        }


        $this->hvost();
        $this->paluba1();
        $this->paluba2();
        $this->vint();

        $sub = new SpalnyaSubroom($this);
        $sub->generate(0,12);

        $sub = new SpalnyaSubroom($this);
        $sub->generate(12,24);

        $sub = new RubkaSubroom($this);
        $sub->generate($leng-10,$leng);

        $sub = new TusaSubroom($this);
        $sub->generate($leng*3/4-$radius*1.5, $leng*3/4+11);

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

//        $object = new DXKObject();
//        $object->setType(DXKTypes::FIRE);
//        $object->setXyz($positionCenterX, $positionCenterY, $positionCenterZ-$radius-2);
//        $object->setMaterial(DXKMaterials::WALLPAPER_1);
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
                $object = new DXKObject();
                $object->setType(DXKTypes::BOX);
                $object->setXyz($positionCenterX + $x, $positionCenterY + $y, $positionCenterZ+$i);
                $object->setMaterial(DXKMaterials::WALLPAPER_2);
                $object->setRotate(0, 0, -$alfa);
                $object->setWidth($this->plastinaSize, 0.25, $delta);
                $this->objects[] = $object;

                $object = new DXKObject();
                $object->setType(DXKTypes::BOX);
                $object->setXyz($positionCenterX + $x2, $positionCenterY + $y2, $positionCenterZ+$i);
                $object->setMaterial(DXKMaterials::WALLPAPER_1);
                $object->setRotate(0, 0, -$alfa);
                $object->setWidth($this->plastinaSize, 0.25, $delta);
                $this->objects[] = $object;
            } else {
                if ($alfa === 280 || $alfa === 85) {
                    $object = new DXKObject();
                    $object->setType(DXKTypes::BOX);
                    $object->setXyz($positionCenterX + $x, $positionCenterY + $y, $positionCenterZ+$i);
                    $object->setMaterial(DXKMaterials::GLASS_2);
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
        $object = new DXKObject();
        $object->setType(DXKTypes::BOX);
        $object->setXyz($positionCenterX, 0, $positionCenterZ);
        $object->setMaterial(DXKMaterials::GRASS_1);
        $object->setRotate(0, 0, 0);
        $object->setWidth($d*2, 0.25, $leng);
        $this->objects[] = $object;
        $types = [
            [
                'tree' => DXKTypes::TREE2,
                'ydelta' => 0,
                'width' => 0.45,
                'count' => 3,
            ],
            [
                'tree' => DXKTypes::TREE1,
                'ydelta' => 0,
                'width' => 0.45,
                'count' => 2,
            ],
            [
                'tree' => DXKTypes::BUSH2,
                'ydelta' => 0,
                'width' => 1,
                'count' => 5,
            ],
            [
                'tree' => DXKTypes::GRASS1,
                'ydelta' => 0,
                'width' => 2,
                'count' => 10,
            ],
            [
                'tree' => DXKTypes::TREE4,
                'ydelta' => 0,
                'width' => 0.45,
                'count' => 4,
            ],
        ];

        for($i = 1;$i<$leng;$i++) {
            $type = $types[array_rand($types)];
            for ($j = 1;$j<$type['count'];$j++) {
                $object = new DXKObject();
                $object->setType($type['tree']);
                $object->setXyz($positionCenterX+rand(-$radius/2,$radius/2), $type['ydelta'], $positionCenterZ+rand(1,$leng));
                $object->setRotate(270, rand(1,360), 0);
                $object->setWidth($type['width'], $type['width'], $type['width']);
                $this->objects[] = $object;
            }

        }
        for ($i = 1; $i < $leng;$i+= $leng/5) {
            $object = new DXKObject();
            $object->setType(DXKTypes::SOFA_7);
            $object->setXyz($positionCenterX+$radius/2+3, 0, $positionCenterZ+$i);
            $object->setRotate(270, 180, 0);
            $this->objects[] = $object;
        }

        for ($i = 0;$i<=1;$i++) {
            $delta = $i*$d ;
            $deltaA = $i*180;

            $object = new DXKObject();
            $object->setType(DXKTypes::SEMIARCH1);
            $object->setXyz($positionCenterX + $d / 2 - $delta, 0, $positionCenterZ + $leng);
            $object->setMaterial(DXKMaterials::GRASS_2);
            $object->setRotate(0, 0, 0+$deltaA);
            $object->setWidth($d, 0.25, $d);
            $this->objects[] = $object;

            $object = new DXKObject();
            $object->setType(DXKTypes::SEMIARCH1);
            $object->setXyz($positionCenterX , 0, $positionCenterZ - $d / 2);
            $object->setMaterial(DXKMaterials::GRASS_2);
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
            $object = new DXKObject();
            $object->setType(DXKTypes::BOX);
            $object->setXyz($positionCenterX + $radius / 2 - $delta, $positionCenterY - 0.125, $positionCenterZ);
            $object->setMaterial(DXKMaterials::WALLPAPER_1);
            $object->setRotate(0, 0, 0+$deltaA);
            $object->setWidth($radius, 0.25, $leng);
            $this->objects[] = $object;

            $object = new DXKObject();
            $object->setType(DXKTypes::SEMIARCH1);
            $object->setXyz($positionCenterX + $radius / 2 - $delta, $positionCenterY - 0.125, $positionCenterZ + $leng);
            $object->setMaterial(DXKMaterials::WALLPAPER_1);
            $object->setRotate(0, 0, 0+$deltaA);
            $object->setWidth($radius, 0.25, $radius);
            $this->objects[] = $object;

            if ($i == 1) {
                $object = new DXKObject();
                $object->setType(DXKTypes::SEMIARCH1);
                $object->setXyz($positionCenterX , $positionCenterY - 0.125, $positionCenterZ - $radius / 2);
                $object->setMaterial(DXKMaterials::WALLPAPER_1);
                $object->setRotate(0+$deltaA, 90, 0);
                $object->setWidth($radius, 0.25, $radius);
                $this->objects[] = $object;
            } else {
                $object = new DXKObject();
                $object->setType(DXKTypes::SEMIARCH1);
                $object->setXyz($positionCenterX , $positionCenterY - 0.125, $positionCenterZ - $radius / 2);
                $object->setMaterial(DXKMaterials::GRASS_3);
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
                'material' => DXKMaterials::WALLPAPER_2,
                'radius' => $radius
            ],[
                'material' => DXKMaterials::WALLPAPER_1,
                'radius' => $radius-0.25
            ],
        ];
        foreach ($sloi as $sloy) {
            $radius = $sloy['radius'];
            $material = $sloy['material'];
            $d = 2.03;
            $object = new DXKObject();
            $object->setType(DXKTypes::EGG1);
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
            $object->setMaterial(DXKMaterials::GLASS_2);
            $this->objects[] = $object;

            $object = clone $object;
            $object->setRotate(0,-90,90);
            $this->objects[] = $object;
            // зад
            $object = new DXKObject();
            $object->setType(DXKTypes::EGG1);
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

        $object = new DXKObject();
        $object->setType(DXKTypes::BOX);
        $object->setXyz($positionCenterX + $x, $positionCenterY + $y, $positionCenterZ);
        $object->setMaterial(DXKMaterials::WALLPAPER_1);
        $object->setRotate(0, 0, -$alfa);
        $object->setWidth($this->plastinaSize, 0.25, $leng/2-5);
        $this->objects[] = $object;

        $object = new DXKObject();
        $object->setType(DXKTypes::BOX);
        $object->setXyz($positionCenterX + $x, $positionCenterY + $y, $positionCenterZ+$leng/2+7);
        $object->setMaterial(DXKMaterials::WALLPAPER_1);
        $object->setRotate(0, 0, -$alfa);
        $object->setWidth($this->plastinaSize, 0.25, $leng/2-7);
        $this->objects[] = $object;

        $x = ($radius) * sin(deg2rad($alfa));
        $y = ($radius) * cos(deg2rad($alfa));

        $object = new DXKObject();
        $object->setType(DXKTypes::BOX);
        $object->setXyz($positionCenterX + $x, $positionCenterY + $y, $positionCenterZ);
        $object->setMaterial(DXKMaterials::WALLPAPER_2);
        $object->setRotate(0, 0, -$alfa);
        $object->setWidth($this->plastinaSize, 0.25, $leng/2-5);
        $this->objects[] = $object;

        $object = new DXKObject();
        $object->setType(DXKTypes::BOX);
        $object->setXyz($positionCenterX + $x, $positionCenterY + $y, $positionCenterZ+$leng/2+7);
        $object->setMaterial(DXKMaterials::WALLPAPER_2);
        $object->setRotate(0, 0, -$alfa);
        $object->setWidth($this->plastinaSize, 0.25, $leng/2-7);
        $this->objects[] = $object;


        $xRazmer = $this->plastinaSize*3;
        if ($alfa == 0) {
            //труба
            $object = new DXKObject();
            $object->setType(DXKTypes::TUBE);
            $object->setXyz($positionCenterX + $x, $positionCenterY + $y+6, $positionCenterZ+$leng/2+1);
            $object->setMaterial(DXKMaterials::GLASS_3);
            $object->setRotate(90, 0, 0);
            $object->setColor(0.4,0.4,0.4);
            $object->setWidth($xRazmer, $this->plastinaSize*10, 6);
            $this->objects[] = $object;

            $object = new DXKObject();
            $object->setType(DXKTypes::CYLINDER);
            $object->setXyz($positionCenterX + $x, $positionCenterY + $y+6.25, $positionCenterZ+$leng/2+1);
            $object->setMaterial(DXKMaterials::GLASS_3);
            $object->setColor(0.4,0.4,0.4);
            $object->setRotate(90, 0, 0);
            $object->setWidth($xRazmer, $this->plastinaSize*10, 0.25);
            $this->objects[] = $object;

//            $object = new DXKObject();
//            $object->setType(DXKTypes::LIGHTP);
//            $object->setXyz($positionCenterX + $x, $positionCenterY + $y+4.25, $positionCenterZ+$leng/2+1);
//            $object->setMaterial(DXKMaterials::GLASS_3);
//            $object->setColor(1.3,1.3,1.3);
//            $object->setRotate(90, 0, 0);
//            $object->setWidth($xRazmer, $xRazmer, 0.25);
//            $this->objects[] = $object;

            //лестница
            for ($height = 0; $height < round($radius/2); $height++) {
                $object = new DXKObject();
                $object->setType(DXKTypes::STAIR2);
                $object->setXyz($positionCenterX + $x, $positionCenterY + $y - $height*2, $positionCenterZ-5+$leng/2+ $height*2);
                $object->setMaterial(DXKMaterials::WALLPAPER_1);
                $object->setRotate(0, 0, 0);
                $object->setWidth($this->plastinaSize*3, 1, 1);
                $this->objects[] = $object;
            }

        }
    }

    private function drawKrilo($rot = 1, $material = DXKMaterials::WALLPAPER_2)
    {
        $radius = $this->getRadius() + ($material === DXKMaterials::WALLPAPER_2 ? 0.25 : 0.1);
        $positionCenterX = $this->positionCenterX;
        $positionCenterY = $this->positionCenterY;
        $positionCenterZ = $this->positionCenterZ;

        $leng = $this->size;
        $sublength = 3*$leng/4;
        // bok
        $ybok = $rot === 1 ? 0 : 90;
        $object = new DXKObject();
        $object->setType(DXKTypes::EGG5);
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
            $object = new DXKObject();
            $object->setType(DXKTypes::EGG2);
            $object->setXyz($positionCenterX + $rot * $radius*(0.5+ $i), $positionCenterY, $positionCenterZ+$sublength-$radius);
            $object->setMaterial(DXKMaterials::GLASS_3);
            $object->setRotate(270, 0, 0);
            $object->setWidth(2*$radius,2* $radius, 2*$radius);
            $this->objects[] = $object;

            $object = clone $object;
            $object->setMaterial($material);
            $object->setRotate(270, 180, 0);
            $this->objects[] = $object;
        }
        //pol
        if ($material !== DXKMaterials::WALLPAPER_2) {
            $object = new DXKObject();
            $object->setType(DXKTypes::BOX);
            $object->setXyz($positionCenterX + $rot * 2 * $radius, $positionCenterY, $positionCenterZ + $sublength - 2 * $radius);
            $object->setMaterial(DXKMaterials::WALLPAPER_10);
            $object->setRotate(0, 0, 0);
            $object->setWidth(2 * $radius, 0.25, 2 * $radius);
            $this->objects[] = $object;
        }

        //konec
        $object = new DXKObject();
        $object->setType(DXKTypes::SEMIARCH1);
        $object->setXyz($positionCenterX + $rot *3* $radius, $positionCenterY+$radius/2, $positionCenterZ+$sublength-$radius);
        $object->setMaterial($material);
        $object->setRotate(0, 0, 90);
        $object->setWidth($radius,0.25, $radius);
        $this->objects[] = $object;

        $object = clone $object;
        $object->setRotate(0, 180, 90);
        $this->objects[] = $object;

        if ($material === DXKMaterials::WALLPAPER_2) {
            $this->drawKrilo($rot, DXKMaterials::WALLPAPER_1);
        }

        //podushki
        if ($rot == -1) {

            for ($i = 1;$i < 60;$i++) {

                $x = rand($rot * 1.5 * $radius, $rot * 3 * $radius-$rot*2);
                $z = rand($sublength - $radius+5, $sublength-2);

                $type = rand(1,2);
                $object = new DXKObject();
                $object->setType($type == 2 ? DXKTypes::PILLOW1 : DXKTypes::BOXCH);
                $object->setXyz($positionCenterX + $x,$positionCenterY , $positionCenterZ + $z);
                $object->setMaterial(DXKMaterials::WALLPAPER_16);

                if ($type == 2) {
                    $object->setWidth(1, 1, 1);
                    $object->setRotate(270+rand(-5,5), rand(1,360), 0);
                } else {
                    $object->setWidth(2, 0.5, 2);
                    $object->setRotate(rand(-5,5), rand(1,360), 0);
                }
                $object->setColor(rand(1,250)/250, rand(1,250)/250, rand(1,250)/250);

                $this->objects[] = $object;
            }
        }
    }

    public function stolik($x, $z, $dy = 0) {
        $radius = $this->getRadius();
        $positionCenterX = $this->positionCenterX;
        $positionCenterY = $this->positionCenterY;
        $positionCenterZ = $this->positionCenterZ;

        $leng = $this->size;

        $stoliki = [
            DXKTypes::TABLE_4_DECOR,
            DXKTypes::TABLE_4,
            DXKTypes::TABLE_2,
        ];
        $stuliya = [
            DXKTypes::CHAIR_GIOVANNETTI_RED,
            DXKTypes::CHAIR_GIOVANNETTI_BLACK,
            DXKTypes::CHAIR_GIOVANNETTI_WHITE,
            DXKTypes::CHAIR_2,
            DXKTypes::CHAIR_3,
            DXKTypes::CHAIR_4,
            DXKTypes::CHAIR_5,
            DXKTypes::CHAIR_6,
        ];
        $object = new DXKObject();
        $object->setType($stoliki[array_rand($stoliki)]);
        $object->setXyz($x, $positionCenterY+$dy, $z);
        $object->setRotate(270, 0, 0);
        $this->objects[] = $object;
        $pos = [
            [
                'alfaY' => 0,
                'x' => 1,
                'z' => 0,
            ],
            [
                'alfaY' => 180,
                'x' => -1,
                'z' => 0,
            ],
            [
                'alfaY' => 90,
                'x' => 0,
                'z' => -1,
            ],
            [
                'alfaY' => 270,
                'x' => 0,
                'z' => 1,
            ],

        ];
        foreach ($pos as $po) {
            $object = new DXKObject();
            $object->setType(DXKTypes::CHAIR_GIOVANNETTI_BLACK);
            $object->setXyz($x+ $po['x'], $positionCenterY+ $dy, $z + $po['z']);
            $object->setRotate(270, $po['alfaY'], 0);
            $this->objects[] = $object;
        }



    }
}
