<?php

namespace KatyaMercer;

/**
 * Object: red sofa or green tree with size, rotate, position ...
 *
 * Class SvObject
 * @package KatyaMercer
 */
class SvObject
{
    private $object;

    public function __construct()
    {
        $this->object = json_decode(file_get_contents(DIR_SV . '/default_json/bushObject.json'));
    }

    /**
     * set position of object
     *
     * @param $x
     * @param $y
     * @param $z
     */
    public function setXyz($x, $y, $z)
    {
        $this->object->p = [$x, $y, $z];
    }

    /**
     * set width
     *
     * @param $x
     * @param $y
     * @param $z
     */
    public function setWidth($x, $y, $z)
    {
        $this->object->s = [round($x,2), round($y,2), round($z,2)];
    }

    /**
     *  rotate in degrees
     *
     * @param $x
     * @param $y
     * @param $z
     */
    public function setRotate($x, $y, $z)
    {
        $this->object->r = [round($x,2), round($y,2), round($z,2)];
    }

    /**
     * material (look SvMaterials) (wood, stone ...)
     *
     * @param $material
     */
    public function setMaterial($material)
    {
        $this->object->m = $material;
    }


    public function delMaterial()
    {
        unset($this->object->m);
    }

    /**
     * look SvType (if it is sofa or box or bed?)
     * @param $type
     */
    public function setType($type)
    {
        $this->object->n = $type;
    }

    /**
     * return json what i will put to scene
     *
     * @return mixed
     */
    public function getObject()
    {
        return $this->object;

    }
    public function setColor($r, $g, $b)
    {
        $this->object->c = [round($r,2), round($g,2), round($b,2)];
    }

    /**
     * Correct clone of object?
     */
    public function __clone()
    {
        $this->object = clone $this->object;
    }
}