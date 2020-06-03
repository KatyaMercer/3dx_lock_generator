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
                $object->setWidth(1,1,1);
//        $object->setMaterial(SvMaterials::CONCRETE_1);
                $object->delMaterial();
                $object->setColor($r/100, $g/100, $b/100);
                $object->setXyz(50-1*($width-$x),1*($height-$y),300);
                $this->objects[] = $object;
            }
        }
    }

}