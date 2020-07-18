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
    public $objects = [];

    public static function createByArrayOfObjects($objects)
    {
        $new = new self();
        $new->objects = $objects;

        return $new;
    }

    public function distance($pos1, $pos2)
    {
        return pow(pow($pos1->x - $pos2->x , 2) + pow($pos1->y - $pos2->y , 2) + pow($pos1->z - $pos2->z, 2), 0.5);
    }

    public function matrixX($alfa)
    {
        return [
            [1, 0, 0],
            [0, cos($alfa), -sin($alfa)],
            [0, sin($alfa), cos($alfa)],
        ];
    }

    public function matrixY($alfa)
    {
        return [
            [cos($alfa), 0, sin($alfa)],
            [0, 1, 0],
            [-sin($alfa), 0, cos($alfa)],
        ];
    }

    public function matrixZ($alfa)
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
        $debugObjects = [];
        foreach ($this->objects as $object)
        {
            /**
             * @var SvObject $object
             */
            $position = $object->getXyz();

            $rotate = $object->getRotate();

            $position = $this->multiMatrix($position, $this->matrixX($radX));
            $position = $this->multiMatrix($position, $this->matrixY($radY));
            $position = $this->multiMatrix($position, $this->matrixZ($radZ));

            $object->setRotate($rotate->x - $degX, $rotate->y - $degY, $rotate->z - $degZ);

            $object->setXyz($position->x, $position->y, $position->z);
        }
        $this->objects = array_merge($this->objects, $debugObjects);
    }

    public function multiMatrix($coord, $rotate)
    {
        return (object)[
            'x' => $coord->x * $rotate[0][0] + $coord->y * $rotate[1][0] + $coord->z * $rotate[2][0],
            'y' => $coord->x * $rotate[0][1] + $coord->y * $rotate[1][1] + $coord->z * $rotate[2][1],
            'z' => $coord->x * $rotate[0][2] + $coord->y * $rotate[1][2] + $coord->z * $rotate[2][2],
        ];
    }
}