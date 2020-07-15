<?php

namespace KatyaMercer;

/**
 * Object: red sofa or green tree with size, rotate, position ...
 *
 * Class SvObject
 * @package KatyaMercer
 */
class SvGroupOperations
{
    private $objects = [];

    public static function createByArrayOfObjects($objects)
    {
        $new = new self();
        $new->objects = $objects;

        return $new;
    }

    private function distance($pos1, $pos2)
    {
        return pow(pow($pos1->x - $pos2->x , 2) + pow($pos1->y - $pos2->y , 2) + pow($pos1->z - $pos2->z, 2), 0.5);
    }

    private function matrixX($alfa)
    {
        return [
            [1, 0, 0],
            [0, cos($alfa), -sin($alfa)],
            [0, sin($alfa), cos($alfa)],
        ];
    }

    private function matrixY($alfa)
    {
        return [
            [cos($alfa), 0, sin($alfa)],
            [0, 1, 0],
            [-sin($alfa), 0, cos($alfa)],
        ];
    }

    private function matrixZ($alfa)
    {
        return [
            [cos($alfa), -sin($alfa), 0],
            [sin($alfa), cos($alfa), 0],
            [0, 0, 1],
        ];
    }

    public function rotateAroundCoordinates($degX, $degY, $degZ, $aroundX = 0, $aroundY = 0, $aroundZ = 0)
    {
        $radX = deg2rad($degX);
        $radY = deg2rad($degY);
        $radZ = deg2rad($degZ);
        foreach ($this->objects as $object)
        {
            /**
             * @var SvObject $object
             */
            $position = $object->getXyz();
//            $position->x = $position->x-$aroundX;
//            $position->y = $position->y-$aroundY;
//            $position->z = $position->z-$aroundZ;

            // я готовлю специальную искусственную точку
            $notRealPoint = clone $position;
            $notRealPoint->x = 10;
            $notRealPoint->y = 10;
            $notRealPoint->z = 10;
            $rotate = $object->getRotate();
            $notRealPoint = $this->multiMatrix($notRealPoint, $this->matrixX(deg2rad($rotate->x)));
            $notRealPoint = $this->multiMatrix($notRealPoint, $this->matrixY(deg2rad($rotate->y)));
            $notRealPoint = $this->multiMatrix($notRealPoint, $this->matrixZ(deg2rad($rotate->z)));
            $notRealPoint->x = $notRealPoint->x + $position->x;
            $notRealPoint->y = $notRealPoint->y + $position->y;
            $notRealPoint->z = $notRealPoint->z + $position->z;

            $position = $this->multiMatrix($position, $this->matrixX($radX));
            $position = $this->multiMatrix($position, $this->matrixY($radY));
            $position = $this->multiMatrix($position, $this->matrixZ($radZ));

            $notRealPoint = $this->multiMatrix($notRealPoint, $this->matrixX($radX));
            $notRealPoint = $this->multiMatrix($notRealPoint, $this->matrixY($radY));
            $notRealPoint = $this->multiMatrix($notRealPoint, $this->matrixZ($radZ));
            $distance = $this->distance($position, $notRealPoint);
            $rotX = rad2deg(acos((-$position->x+$notRealPoint->x)/$distance));
            $rotY = rad2deg(acos((-$position->y+$notRealPoint->y)/$distance));
            $rotZ = rad2deg(acos((-$position->z+$notRealPoint->z)/$distance));
            $object->setRotate(
                $rotX,
                $rotY,
                $rotZ
            );

//            $position->x = $position->x+$aroundX;
//            $position->y = $position->y+$aroundY;
//            $position->z = $position->z+$aroundZ;

            $object->setXyz($position->x, $position->y, $position->z);
        }
    }

    private function multiMatrix($coord, $rotate)
    {
        return (object)[
            'x' => $coord->x * $rotate[0][0] + $coord->y * $rotate[1][0] + $coord->z * $rotate[2][0],
            'y' => $coord->x * $rotate[0][1] + $coord->y * $rotate[1][1] + $coord->z * $rotate[2][1],
            'z' => $coord->x * $rotate[0][2] + $coord->y * $rotate[1][2] + $coord->z * $rotate[2][2],
        ];
    }
}