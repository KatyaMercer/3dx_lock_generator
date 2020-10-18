<?php
namespace companies\KatyaMercer;
use \KatyaMercer\SvMaterials;
use \KatyaMercer\SvObject;
use \KatyaMercer\SvTypes;

/**
 * This class I dedicate to dear Rita
 *
 * Class River
 * @package companies\KatyaMercer
 */
class River extends AbstractLocation
{

    private function getRandStone()
    {
        $a = [
            SvTypes::STONE_10_SA_COLORED,
            SvTypes::STONE_10_G_COLORED,
            SvTypes::STONE_10_COLORED,
            SvTypes::STONE_33_SA_COLORED,
            SvTypes::STONE_33_SN_COLORED,
            SvTypes::STONE_33_G_COLORED
        ];
        return $a[array_rand($a)];
    }

    public function generate() {

        $positionCenterX = $this->positionCenterX;
        $positionCenterY = $this->positionCenterY + 1;
        $positionCenterZ = $this->positionCenterZ;

        $obj = new SvObject();
        $obj->setType($this->getRandStone());
        $obj->setXyz($positionCenterX,$positionCenterY,$positionCenterZ-20);
        $obj->setRotate(270, 0,0); // rand(0,360)
        $obj->setWidth(1,15,1);
        $this->objects[] = $obj;
        $obj = new SvObject();
        $obj->setType($this->getRandStone());
        $obj->setXyz($positionCenterX+$this->size,$positionCenterY,$positionCenterZ-20);
        $obj->setRotate(270, 0,0); // rand(0,360)
        $obj->setWidth(1,15,1);
        $this->objects[] = $obj;

        $lxtop = 0;
        $lztop = 0;
        $lxdown = 0;
        $lzdown = 0;
        for ($dx = 1;$dx < $this->size;$dx++) {
//            $s1 = rand(1,4)/10;
//            $s2 = rand(1,2)/10;
//            $c1 = rand(1,3)/10;
//            $c2 = rand(1,2)/10;
//            $dz = 10*sin($s1*$dx) * cos($c1*$dx-$s1*10) ;
//            $dzdown = 8*sin($s2*$dx) * cos($c2*$dx-$s1*10);
            $dz = 10*sin(3*$dx/10) * cos($dx/10-5) ;
            $dzdown = 8*sin($dx/10) * cos(2*$dx/10-1);


            if (0 != $dz-$lztop) {
                $ugol = rad2deg(atan(($dx-$lxtop)/($dz-$lztop)));
            }
            if (0 != $dz-$lzdown) {
                $ugoldown = rad2deg(atan(($dx-$lxdown)/($dzdown-$lzdown)));
            }

            $dist = pow(pow($dx-$lxtop,2) + pow($dz-$lztop,2), 0.5);
            $distdown = pow(pow($dx-$lxdown,2) + pow($dzdown-$lzdown,2), 0.5);

            $lxtop = $dx;
            $lztop = $dz;

            $lxdown = $dx;
            $lzdown = $dzdown;

            $obj = new SvObject();
            $obj->setType($this->getRandStone());
            $obj->setXyz($positionCenterX+$dx,$positionCenterY,$positionCenterZ+$dz);
            $obj->setRotate(270, $ugol,0); // rand(0,360)
            $obj->setWidth(2,$dist/2,1);
            $this->objects[] = $obj;

            $obj = clone $obj;
            $obj->setXyz($positionCenterX+$dx,$positionCenterY,$positionCenterZ+$dz-5);
            $obj->setType(SvTypes::GRASS1);
            $obj->setWidth(2,2,7);
            $obj->setRotate(270, 0,0); // rand(0,360)
            $this->objects[] = $obj;
            $width = 50;

            $obj = new SvObject();
            $obj->setType($this->getRandStone());
            $obj->setXyz($positionCenterX+$dx,$positionCenterY,$positionCenterZ+$dzdown-$width);
            $obj->setRotate(270, $ugoldown,0); // rand(0,360)
            $obj->setWidth(2,$distdown/2,1);
            $this->objects[] = $obj;

            $obj = clone $obj;
            $obj->setXyz($positionCenterX+$dx,$positionCenterY,$positionCenterZ+$dzdown-$width+5);
            $obj->setType(SvTypes::GRASS1);
            $obj->setWidth(2,2,7);
            $obj->setRotate(270, 0,0); // rand(0,360)
            $this->objects[] = $obj;

            $obj = new SvObject();
            $obj->setMaterial(SvMaterials::WATER);
            $obj->setType(SvTypes::BOX);
            $obj->setXyz($positionCenterX+$dx,$positionCenterY,$positionCenterZ+$dzdown-$width);
            $obj->setRotate(0, 1,0); // rand(0,360)
            $obj->setWidth(1.2,1,$width+$dz-$dzdown);
            $this->objects[] = $obj;

            $obj = clone $obj;
            $obj->setXyz($positionCenterX+$dx,$positionCenterY-0.1,$positionCenterZ+$dzdown-$width);
            $obj->setMaterial(SvMaterials::SAND);
            $obj->setWidth(1.2,0.1,$width+$dz-$dzdown);
            $this->objects[] = $obj;
        }
    }

}