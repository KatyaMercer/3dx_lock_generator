<?php
namespace companies\KatyaMercer;
use \KatyaMercer\DXKMaterials;
use \KatyaMercer\DXKObject;
use \KatyaMercer\DXKTypes;

class ItemGraf
{
    public $element = [];
}
class FotoBuilderExtended extends AbstractLocation
{
    private function findCopy($need, $array)
    {
        foreach ($array as $item) {

        }
    }
    private function needRework($array)
    {
        foreach ($array as $item) {
            if ($this->findCopy($item, $array)) {

            }
        }
    }
    public function generate($image, $dx = 50, $dz = 300, $coef = 1) {
        $resource = imagecreatefrombmp($image);
        $width = imagesx($resource);
        $height = imagesy($resource);
        $array = [];
        for($x = 0; $x < $width; $x+=1) {
            for ($y = 0; $y < $height; $y += 1) {
                // pixel color at (x, y)
                $rgb = imagecolorat($resource, $x, $y);
                $colors = imagecolorsforindex($resource, $rgb);
                $r = $colors['red'];
                $g = $colors['green'];
                $b = $colors['blue'];
                $array[$x][$y] = new ItemGraf();
                $array[$x][$y]->element = [
                    'master' => [
                        'r' => $r,
                        'g' => $g,
                        'b' => $b,
                    ],
                    'fixed' => [
                        'r' => round($r/10) * 10,
                        'g' => round($g/10) * 10,
                        'b' => round($b/10) * 10,
                    ],
                    'x' => $x,
                    'y' => $y,
                    'wx' => 1,
                    'wy' => 1,
                ];
            }
        }
        $array = $this->needRework($array);
        foreach ($array as $item) {
            $x = $item['x'];
            $y = $item['y'];
            $r = $item['fixed']['r'];
            $g = $item['fixed']['g'];
            $b = $item['fixed']['b'];
            $object = new DXKObject();
            $object->setType(DXKTypes::BOX);
            $object->setWidth($coef,$coef,$coef);
            $object->delMaterial();
            $object->setColor(round($r/256,2), round($g/256, 2), round($b/256,2) );
            $object->setXyz($dx-$coef*($width-$x),$coef*($height-$y),$dz);
            $this->objects[] = $object;
        }
    }
}