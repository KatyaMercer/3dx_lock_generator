<?php
namespace companies\KatyaMercer;
use \KatyaMercer\SvMaterials;
use \KatyaMercer\SvObject;
use \KatyaMercer\SvTypes;
class FotoBuilder extends AbstractLocation
{
    /**
     * image is filename
     *
     * @param $image
     */
    public function generate($image, $dx = 50, $dz = 300, $coef = 1) {
        $resource = imagecreatefrombmp($image);
        $width = imagesx($resource);
        $height = imagesy($resource);
//        $coef=1;

        for($x = 0; $x < $width; $x+=1) {
            for($y = 0; $y < $height; $y+=1) {
                // pixel color at (x, y)
                $rgb = imagecolorat($resource, $x, $y);
                $colors = imagecolorsforindex($resource, $rgb);
                $r = $colors['red'];
                $g = $colors['green'];
                $b = $colors['blue'];
                $object = new SvObject();
//                $object->setType(SvTypes::BOX);
//                $object->setWidth($coef,$coef,$coef);

                $object->setType(SvTypes::SPHERE);
                $object->setWidth($coef*2,$coef*2,$coef*2);

                $object->delMaterial();
                $object->setColor(round($r/256,2), round($g/256, 2), round($b/256,2) );
                $object->setXyz($dx-$coef*($width-$x),$coef*($height-$y),$dz);
                $this->objects[] = $object;
            }
        }
    }

}