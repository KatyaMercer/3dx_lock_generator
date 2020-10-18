<?php
namespace companies\KatyaMercer\Sh;

use KatyaMercer\SvMaterials;
use KatyaMercer\SvObject;
use KatyaMercer\SvTypes;

class SpaceSubroom extends AbstractSubroom
{
    public function generate()
    {
        $radius = $this->starShip->getRadius();
        $positionCenterX = $this->starShip->positionCenterX;
        $positionCenterY = $this->starShip->positionCenterY;
        $positionCenterZ = $this->starShip->positionCenterZ;
        $leng = $this->starShip->size;
        $rad1 = 1000;
        for ($i = 1; $i < 400; $i++) {
            $ax = rand(-$rad1,$rad1);
            $ay = rand(-$rad1,$rad1);
            $kvadrat = ($rad1*$rad1-($ax*$ax + $ay*$ay));

            while ($kvadrat < 0) {
                $ax = rand(-$rad1,$rad1);
                $ay = rand(-$rad1,$rad1);
                $kvadrat = ($rad1*$rad1-($ax*$ax + $ay*$ay));
            }
            $az = pow($kvadrat, 0.5);

            $color = [rand(1000,255000)/255,rand(1000,255000)/255, rand(1000,255000)/255];
            $width = rand(1,5);

            $object = new SvObject();

            $object->setType(SvTypes::SPHERE);
            $object->setXyz($positionCenterX+$ax, $positionCenterY+$ay, $positionCenterZ+$az);
            $object->setColor($color[0], $color[0], $color[0]);
            $object->setMaterial(SvMaterials::WALLPAPER_1);
            $object->setWidth($width, $width, $width);
            $this->starShip->objects[] = $object;

            $object = clone $object;
            $object->setXyz($positionCenterX+$ax, $positionCenterY+$ay, $positionCenterZ-$az);
            $this->starShip->objects[] = $object;
        }


    }
}