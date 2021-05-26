<?php
namespace companies\KatyaMercer;
use \KatyaMercer\DXKMaterials;
use \KatyaMercer\DXKObject;
use \KatyaMercer\DXKTypes;
class Zamok extends AbstractLocation{

    private $height = 20;
    private $width = 50;
    private $widthDown = 3;

    public function mainRoomBox($stenaMaterial = DXKMaterials::STONES_17, $florMaterial = DXKMaterials::STONES_10)
    {
        $positionCenterX = $this->positionCenterX;
        $positionCenterY = $this->positionCenterY;
        $positionCenterZ = $this->positionCenterZ;

        $height = $this->height;
        $width = $this->width;
        $widthDown = $this->widthDown;

        $object = new DXKObject();
        // пол
        $object->setMaterial(DXKMaterials::SAND);
        $object->setType(DXKTypes::BOX);
//        $object->setColor(0.19,0.68,0.34);
        $object->setXyz($positionCenterX, $positionCenterZ-$widthDown/2+2, $positionCenterY);
        $object->setWidth($width, $widthDown, 0.5);
        $this->objects[] = $object;

        $object = new DXKObject();
        // пол
        $object->setMaterial($florMaterial);
        $object->setType(DXKTypes::BOX);
//        $object->setColor(0.19,0.68,0.34);
        $object->setXyz($positionCenterX, $positionCenterZ-$widthDown/2, $positionCenterY);
        $object->setWidth($width, $widthDown, $width);
        $this->objects[] = $object;
        //потолок
        $object->setMaterial($stenaMaterial);
        $object = clone $object;
        $object->setXyz($positionCenterX, $positionCenterZ+$height, $positionCenterY);
        $object->setWidth($width, 1, $width);
        $this->objects[] = $object;

        $heightForWindows = 1;
        $heightWindows = 4;

        // верхняя часть стен
        $delta = $heightForWindows+$heightWindows;
        $object = clone $object;
        $object->setXyz($positionCenterX, $positionCenterZ+$height/2+$delta/2, $positionCenterY);
        $object->setWidth($width, $height-$delta, 1);
        $this->objects[] = $object;
        $object = clone $object;
        $object->setXyz($positionCenterX-$width/2, $positionCenterZ+$height/2+$delta/2, $positionCenterY);
        $object->setWidth(1, $height-$delta, $width);
        $this->objects[] = $object;
        $object = clone $object;
        $object->setXyz($positionCenterX, $positionCenterZ+$height/2+$delta/2, $positionCenterY+$width);
        $object->setWidth($width, $height-$delta, 1);
        $this->objects[] = $object;

        // нижняя часть стен
        $object = clone $object;
        $object->setXyz($positionCenterX, $positionCenterZ+$heightForWindows/2, $positionCenterY);
        $object->setWidth($width, $heightForWindows, 1);
        $this->objects[] = $object;
        $object = clone $object;
        $object->setXyz($positionCenterX-$width/2, $positionCenterZ+$heightForWindows/2, $positionCenterY);
        $object->setWidth(1, $heightForWindows, $width);
        $this->objects[] = $object;
        $object = clone $object;
        $object->setXyz($positionCenterX, $positionCenterZ+$heightForWindows/2, $positionCenterY+$width);
        $object->setWidth($width, $heightForWindows, 1);
        $this->objects[] = $object;

        //окна
        $okno = new DXKObject();
        $okno->setMaterial(DXKMaterials::GLASS_3);
        $okno->setType(DXKTypes::BOX);
        $okno->setXyz($positionCenterX, $positionCenterZ+$heightWindows-$heightForWindows, $positionCenterY);
        $okno->setWidth($width, $heightWindows, 0.5);
        $this->objects[] = $okno;
        $okno = clone $okno;
        $okno->setXyz($positionCenterX-$width/2, $positionCenterZ+$heightWindows-$heightForWindows, $positionCenterY);
        $okno->setWidth(0.5, $heightWindows, $width);
        $this->objects[] = $okno;
        $okno = clone $okno;
        $okno->setXyz($positionCenterX, $positionCenterZ+$heightWindows-$heightForWindows, $positionCenterY+$width);
        $okno->setWidth($width, $heightWindows, 0.5);
        $this->objects[] = $okno;

        $doorHeight = 5;
        $doorX = 4;

        //стена над дверью
        $object = clone $object;
        $object->setXyz($positionCenterX+$width/2, $positionCenterZ+$height/2+$doorHeight/2, $positionCenterY);
        $object->setWidth(1, $height-$doorHeight, $width);
        $this->objects[] = $object;

        //стена рядом с дверью
        $object = clone $object;
        $object->setXyz($positionCenterX+$width/2, $positionCenterZ+$heightForWindows/2, $positionCenterY+$width/2+$doorX);
        $object->setWidth(1, $heightForWindows, $width/2-$doorX);
        $this->objects[] = $object;

        $object = clone $object;
        $object->setXyz($positionCenterX+$width/2, $positionCenterZ+$heightForWindows/2, $positionCenterY);
        $object->setWidth(1, $heightForWindows, $width/2-$doorX);
        $this->objects[] = $object;
        // на уровне окон возле двери
        $object = clone $object;
        $object->setXyz($positionCenterX+$width/2, $positionCenterZ+$heightForWindows+$heightWindows/2, $positionCenterY+$width/2+$doorX);
        $object->setWidth(1, $heightWindows, $doorX);
        $this->objects[] = $object;

        $object = clone $object;
        $object->setXyz($positionCenterX+$width/2, $positionCenterZ+$heightForWindows+$heightWindows/2, $positionCenterY+$width/2-2*$doorX);
        $object->setWidth(1, $heightWindows, $doorX);
        $this->objects[] = $object;

        // двери
        $object = new DXKObject();
        $object->setType(DXKTypes::DOOR1);
        $object->setMaterial(DXKMaterials::WOOD_11);
        $object->setRotate(270,90,0);
        $object->setXyz($positionCenterX+$width/2, $positionCenterZ+$doorHeight/2, $positionCenterY+$width/2-$doorX);
        $object->setWidth($doorX, 2, $doorHeight);
        $object->setColor(15,15,15);
        $this->objects[] = $object;

        $object = new DXKObject();
        $object->setType(DXKTypes::DOOR1);
        $object->setMaterial(DXKMaterials::WOOD_11);
        $object->setRotate(270,270,0);
        $object->setXyz($positionCenterX+$width/2, $positionCenterZ+$doorHeight/2, $positionCenterY+$width/2+$doorX);
        $object->setWidth($doorX, 2, $doorHeight);
        $object->setColor(15,15,15);
        $this->objects[] = $object;

        //лесница
        for ($x = 2; $x < $widthDown/2+4;$x+=2) {
            $object = new DXKObject();
            $object->setMaterial(DXKMaterials::STONES_10);
            $object->setType(DXKTypes::STAIR2);
            $object->setRotate(270,270,0);
            $object->setXyz($positionCenterX+$width/2+$x, $positionCenterZ-$x, $positionCenterY+$width/2);
            $object->setWidth($width, 1, 1);
            $this->objects[] = $object;
        }


        // башни $doorHeight как высота над
        $object = new DXKObject();
        $object->setMaterial($stenaMaterial);
        $object->setType(DXKTypes::CYLINDER);
        $object->setRotate(270,270,0);
        $object->setXyz($positionCenterX-$width/2, $positionCenterZ-$widthDown, $positionCenterY);
        $object->setWidth(3, 3, $height+$widthDown+$doorHeight);
        $this->objects[] = $object;

        $object = clone $object;
        $object->setXyz($positionCenterX+$width/2, $positionCenterZ-$widthDown, $positionCenterY);
        $this->objects[] = $object;

        $object = clone $object;
        $object->setXyz($positionCenterX+$width/2, $positionCenterZ-$widthDown, $positionCenterY+$width);
        $this->objects[] = $object;

        $object = clone $object;
        $object->setXyz($positionCenterX-$width/2, $positionCenterZ-$widthDown, $positionCenterY+$width);
        $this->objects[] = $object;

    }

    public function kovri()
    {
        $positionCenterX = $this->positionCenterX;
        $positionCenterY = $this->positionCenterY;
        $positionCenterZ = $this->positionCenterZ;

        $height = $this->height;
        $width = $this->width;
        $widthDown = $this->widthDown;

        $object = new DXKObject();
        // пол
        $object->setMaterial(DXKMaterials::WALLPAPER_16);
        $object->setType(DXKTypes::BOXCH);
//        $object->setColor(0.19,0.68,0.34);
        $object->setXyz($positionCenterX, $positionCenterZ-$widthDown/2+1.5, $positionCenterY);
        $object->setWidth(5, 0.2, 5);
        $this->objects[] = $object;
    }

    public function sotona()
    {
        $positionCenterX = $this->positionCenterX;
        $positionCenterY = $this->positionCenterY;
        $positionCenterZ = $this->positionCenterZ;

        $height = $this->height;
        $width = $this->width;
        $widthDown = $this->widthDown;

        $object = new DXKObject();
        $object->setMaterial(DXKMaterials::WALLPAPER_4);
        $object->setColor(15,0,0);
        $object->setType(DXKTypes::PRISM);
        $object->setRotate(270,270,0);
        $object->setXyz($positionCenterX+$width/2, $positionCenterZ-$widthDown+$height/2+3, $positionCenterY+$width/2);
        $object->setWidth(1, 2, 3);
        $this->objects[] = $object;

        $object = clone $object;
        $object->setXyz($positionCenterX+$width/2, $positionCenterZ-$widthDown+$height/2+3+3, $positionCenterY+$width/2+3);
        $object->setRotate(0,180,270);
        $this->objects[] = $object;
        $object = clone $object;
        $object->setXyz($positionCenterX+$width/2, $positionCenterZ-$widthDown+$height/2+3+3, $positionCenterY+$width/2-3);
        $object->setRotate(0,0,270);
        $this->objects[] = $object;

        $object = clone $object;
        $object->setXyz($positionCenterX+$width/2, $positionCenterZ-$widthDown+$height/2+3+6, $positionCenterY+$width/2);
        $object->setRotate(90,270,0);
        $this->objects[] = $object;

        $object = new DXKObject();
        $object->setMaterial(DXKMaterials::WALLPAPER_4);
        $object->setColor(15,15,15);
        $object->setType(DXKTypes::CYLINDER);
        $object->setRotate(0,90,270);
        $object->setXyz($positionCenterX+$width/2-0.6, $positionCenterZ-$widthDown+$height/2+6, $positionCenterY+$width/2);
        $object->setWidth(7, 7, 1.2);
        $this->objects[] = $object;
    }

    public function setShine($shine = null)
    {
        $positionCenterX = $this->positionCenterX;
        $positionCenterY = $this->positionCenterY;
        $positionCenterZ = $this->positionCenterZ;

        $height = $this->height;
        $width = $this->width;
        $widthDown = $this->widthDown;
        for($z = 5; $z<=$height;$z+=5) {
            for ($x = 5;$x<$width;$x+=5) {
                for ($y = 5;$y<$width;$y+=5) {

                    $object = new DXKObject();
                    $object->setMaterial(DXKMaterials::WALLPAPER_4);
//                    $object->setColor(0.9,1,1);
                    if ($shine) {
                        $object->setColor($shine['r'],$shine['g'],$shine['b']);
                    } else {
                        $object->setColor(rand(1,100)/100,rand(1,100)/100,rand(1,100)/100);
                    }

                    $object->setType(DXKTypes::LIGHTP);
                    $object->setRotate(270,0,0);
                    $object->setXyz($positionCenterX+$width/2-$x, $positionCenterZ-$widthDown+$z, $positionCenterY+$y);
                    $object->setWidth(1, 1, 1);
                    $this->objects[] = $object;
                }
            }
        }

    }

    public function subRoomRitaAndKatya()
    {
        $positionCenterX = $this->positionCenterX;
        $positionCenterY = $this->positionCenterY;
        $positionCenterZ = $this->positionCenterZ;

        $height = $this->height;
        $width = $this->width;
        $widthDown = $this->widthDown;

        $object = new DXKObject();
        $object->setMaterial(DXKMaterials::STONES_10);
        $object->setType(DXKTypes::BOX);
        $object->setXyz($positionCenterX-$width/4, $positionCenterZ+$widthDown/2+$height/2, $positionCenterY);
        $object->setWidth($width/2, 1, $width/2);
        $this->objects[] = $object;

        //лесница
        for ($x = 2; $x < $height/2+4;$x+=2) {
            $object = new DXKObject();
            $object->setMaterial(DXKMaterials::STONES_10);
            $object->setType(DXKTypes::STAIR2);
            $object->setRotate(270,270,0);
            $object->setXyz($positionCenterX+$x, $positionCenterZ+$widthDown/2+$height/2-$x+0.5, $positionCenterY+$width/4);
            $object->setWidth($width/4, 1, 1);
            $this->objects[] = $object;
        }

        $object = new DXKObject();
        $object->setType(DXKTypes::BED6);
        $object->setXyz($positionCenterX-$width/4, $positionCenterZ+$widthDown/2+$height/2+0.5, $positionCenterY+5);
        $object->setRotate(270,0,0);
        $this->objects[] = $object;

        $object = new DXKObject();
        $object->setType(DXKTypes::CHAIR_GIOVANNETTI_RED);
        $object->setXyz($positionCenterX-$width/4+5, $positionCenterZ+$widthDown/2+$height/2+0.5, $positionCenterY+5);
        $object->setRotate(270,0,0);
        $this->objects[] = $object;

        $object = new DXKObject();
        $object->setType(DXKTypes::SOFA_2);
        $object->setXyz($positionCenterX-$width/4+5, $positionCenterZ+$widthDown/2+$height/2+0.5, $positionCenterY+8);
        $object->setRotate(270,90,0);
        $this->objects[] = $object;

        $object = new DXKObject();
        $object->setType(DXKTypes::VEDRO);
        $object->setXyz($positionCenterX-$width/4+2, $positionCenterZ+$widthDown/2+$height/2+0.5, $positionCenterY+8);
        $object->setRotate(270,0,0);
        $this->objects[] = $object;

        $object = new DXKObject();
        $object->setType(DXKTypes::MAFON);
        $object->setXyz($positionCenterX-$width/4+2, $positionCenterZ+$widthDown/2+$height/2+0.5, $positionCenterY+6);
        $object->setRotate(270,0,0);
        $this->objects[] = $object;

        $object = new DXKObject();
        $object->setType(DXKTypes::POLE);
        $object->setXyz($positionCenterX-$width/4+6, $positionCenterZ+$widthDown/2+$height/2+0.5, $positionCenterY+12);
        $object->setRotate(270,0,0);
        $this->objects[] = $object;

        $object = new DXKObject();
        $object->setType(DXKTypes::WALL_PH);
        $object->setXyz($positionCenterX-$width/4-2, $positionCenterZ+$widthDown/2+$height/2+0.5, $positionCenterY+1.6);
        $object->setRotate(270,90,0);
        $this->objects[] = $object;

        $object = new DXKObject();
        $object->setType(DXKTypes::BOXCH);
        $object->setXyz($positionCenterX-$width/4-2, $positionCenterZ+$widthDown/2+$height/2+0.5, $positionCenterY+1);
        $object->setRotate(270,90,0);
        $object->setWidth(0.5,2,2);
        $object->setMaterial(DXKMaterials::BRICK_1);
        $this->objects[] = $object;
    }
    
}