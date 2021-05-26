<?php
namespace companies\KatyaMercer;
use \KatyaMercer\DXKMaterials;
use \KatyaMercer\DXKObject;
use \KatyaMercer\DXKTypes;

/**
 *
 * Class LineMountain
 * @package companies\KatyaMercer
 */
class LineMountain extends AbstractLocation{

    public function generate($fromXYZ, $toXYZ)
    {
        $mounts = [
            DXKTypes::TERRAIN_GRASS,
//            DXKTypes::TERRAIN_DIRT,
//            DXKTypes::TERRAIN_SAND,
//            DXKTypes::TERRAIN_SNOW,
        ];
        $deltaX = (-$fromXYZ['x'] + $toXYZ['x'])/$this->size;
        $deltaY = (-$fromXYZ['y'] + $toXYZ['y'])/$this->size;
        $deltaZ = (-$fromXYZ['z'] + $toXYZ['z'])/$this->size;
        $x = $fromXYZ['x'];
        $y = $fromXYZ['y'];
        $z = $fromXYZ['z'];
//        print_r([$deltaX, $deltaY, $deltaZ]);
        for ($i = 0;$i < $this->size+1;$i++) {
            $x += $deltaX;
            $y += $deltaY;
            $z += $deltaZ;

            $object = new DXKObject();
            $object->setXyz($x, $y, $z);
            $object->setWidth(rand(1,2), rand(1,2), rand(20,30)/10);
            $object->setRotate(270,0,0);
            $object->delMaterial();
            $object->setType($mounts[array_rand($mounts)]);
            $this->objects[] = $object;
        }

    }
}