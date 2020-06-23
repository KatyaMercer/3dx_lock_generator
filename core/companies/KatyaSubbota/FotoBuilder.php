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
    public function generate($image) {
        $resource = imagecreatefrombmp($image);
        $width = imagesx($resource);
        $height = imagesy($resource);
        $coef=0.01;

        for($x = 0; $x < $width; $x+=1) {
            for($y = 0; $y < $height; $y+=1) {
                // pixel color at (x, y)
                $rgb = imagecolorat($resource, $x, $y);
                $colors = imagecolorsforindex($resource, $rgb);
                $r = $colors['red'];
                $g = $colors['green'];
                $b = $colors['blue'];
                $object = new SvObject();
                $object->setType(SvTypes::BOX);
                $object->setWidth($coef,$coef,$coef);
//        $object->setMaterial(SvMaterials::CONCRETE_1);
                $object->delMaterial();
                $object->setColor(round($r/256,2), round($g/256, 2), round($b/256,2) );
                $object->setXyz(50-$coef*($width-$x),$coef*($height-$y),300);
                $this->objects[] = $object;
            }
        }
    }

}