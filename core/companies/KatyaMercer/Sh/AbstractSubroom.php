<?php
namespace companies\KatyaMercer\Sh;

use KatyaMercer\DXKMaterials;
use KatyaMercer\DXKObject;
use KatyaMercer\DXKTypes;

abstract class AbstractSubroom extends \companies\KatyaMercer\AbstractLocation
{
    /**
     * @var StarShip
     */
    protected $starShip;

    public function __construct(\companies\KatyaMercer\Sh\StarShip $starShip)
    {
        $this->starShip = $starShip;
    }

    protected function karkas1($l1, $l2, $rotates = 1)
    {
        $radius = $this->starShip->getRadius();
        $positionCenterX = $this->starShip->positionCenterX;
        $positionCenterY = $this->starShip->positionCenterY;
        $positionCenterZ = $this->starShip->positionCenterZ;
        $leng = $this->starShip->size;

        $object = new DXKObject();
        $object->setType(DXKTypes::SEMIARCH1);
        $object->setXyz($positionCenterX + $radius/2, $positionCenterY, $positionCenterZ + $l1);
        $object->setMaterial(DXKMaterials::WALLPAPER_1);
        $object->setRotate(-90, 0, 0);
        $object->setWidth($radius, 0.25, $radius);
        $this->starShip->objects[] = $object;

        $object = new DXKObject();
        $object->setType(DXKTypes::SEMIARCH1);
        $object->setXyz($positionCenterX + $radius/2, $positionCenterY, $positionCenterZ + $l2);
        $object->setMaterial(DXKMaterials::WALLPAPER_1);
        $object->setRotate(-90, 0, 0);
        $object->setWidth($radius, 0.25, $radius);
        $this->starShip->objects[] = $object;

        $object = new DXKObject();
        $object->setType(DXKTypes::BOX);
        $object->setXyz($positionCenterX, $positionCenterY + $radius/2 + $this->starShip->plastinaSize/2, $positionCenterZ + $l1);
        $object->setMaterial(DXKMaterials::WALLPAPER_1);
        $object->setRotate(0, 0, 0);
        $object->setWidth(0.25, $radius - $this->starShip->plastinaSize, $l2-$l1);
        $this->starShip->objects[] = $object;

        $object = new DXKObject();
        $object->setType(DXKTypes::BOX);
        $object->setXyz($positionCenterX, $positionCenterY+ $this->starShip->plastinaSize/2, $positionCenterZ + $l1);
        $object->setMaterial(DXKMaterials::WATER);
        $object->setRotate(0, 0, 0);
        $object->setColor(0.01, 0.01, 0.01);
        $object->setWidth(0.25, $this->starShip->plastinaSize, $l2-$l1);
        $this->starShip->objects[] = $object;
        return $this;
    }
    protected function karkas2($l1, $l2, $options = [])
    {
        $radius = $this->starShip->getRadius();
        $positionCenterX = $this->starShip->positionCenterX;
        $positionCenterY = $this->starShip->positionCenterY;
        $positionCenterZ = $this->starShip->positionCenterZ;
        $leng = $this->starShip->size;

        $params = [
            [
                'rotate' => [-90, 180, 0],
                'position' => [$positionCenterX - $radius/2-$radius/4 , $positionCenterY, $positionCenterZ],
                'width' => [$radius/2, 0.25, $radius/2],
            ],
            [
                'rotate' => [-90, 0, 0],
                'position' => [$positionCenterX + $radius/2+$radius/4 , $positionCenterY, $positionCenterZ],
                'width' => [$radius/2, 0.25, $radius/2],
            ],
            [
                'rotate' => [-90, 0, 0],
                'position' => [$positionCenterX + ($radius/2+$radius/4)/2 , $positionCenterY, $positionCenterZ],
                'width' => [$radius/4, 0.25, $radius/4],
            ],
            [
                'rotate' => [-90, 180, 0],
                'position' => [$positionCenterX - ($radius/2+$radius/4)/2 , $positionCenterY, $positionCenterZ],
                'width' => [$radius/4, 0.25, $radius/4],
            ],
        ];
        foreach ([$l1, $l2] as $l) {
            foreach ($params as $param) {
                $object = new DXKObject();
                $object->setType(DXKTypes::SEMIARCH2);
                $object->setXyz($param['position'][0], $param['position'][1], $param['position'][2] + $l);
                $object->setMaterial(DXKMaterials::WALLPAPER_1);
                $object->setRotate($param['rotate'][0], $param['rotate'][1], $param['rotate'][2]);
                $object->setWidth($param['width'][0], $param['width'][1], $param['width'][2]);
                $this->starShip->objects[] = $object;
            }
        }

        if (!isset($options['withoutDoor'])) {
            $object = new DXKObject();
            $object->setType(DXKTypes::EGG2);
            $object->setXyz($positionCenterX, $positionCenterY, $positionCenterZ + $l1 + ($l2-$l1)/2);
            $object->setMaterial(DXKMaterials::WATER);
            $object->setRotate(-90, -90, 0);
            $object->setWidth(($l2-$l1) * 2, $radius/2, $radius/2);
            $object->setColor(0.01,0.01,0.01);
            $this->starShip->objects[] = $object;
            $object = clone $object;
            $object->setRotate(-90, -270, 0);
            $this->starShip->objects[] = $object;
        }

        return $this;
    }

    protected function shineCenter($l1,$l2, $dx = 0, $color = null)
    {
        $radius = $this->starShip->getRadius();
        $positionCenterX = $this->starShip->positionCenterX;
        $positionCenterY = $this->starShip->positionCenterY;
        $positionCenterZ = $this->starShip->positionCenterZ;
        $leng = $this->starShip->size;
        $center = ($l2-$l1)/2;

        $object = new DXKObject();
        $object->setType(DXKTypes::LIGHTP);
        $object->setXyz($positionCenterX+$dx, $positionCenterY+$radius/2, $positionCenterZ+$l1+$center);
        $object->setRotate(0, 0, 0);
        if ($color) {
            $object->setColor($color['r'], $color['r'], $color['b']);
        } else {
            $object->setColor(0.4,0.3, 0.3);
        }

        $object->setWidth($radius, 0.25, ($l2-$l1)/2);
        $this->starShip->objects[] = $object;

    }
}