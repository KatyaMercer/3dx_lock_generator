<?php
namespace companies\KatyaMercer;
use \KatyaMercer\SvMaterials;
use \KatyaMercer\SvObject;
use \KatyaMercer\SvTypes;

/**
 *
 * Class DefRespawn
 * @package companies\KatyaMercer
 */
class DefRespawn extends AbstractLocation{

    public function generate($material = SvMaterials::GRASS_1)
    {

        $floor = new SvObject();
        $floor->setXyz($this->positionCenterX, $this->positionCenterY, $this->positionCenterZ);
        $floor->setWidth($this->size, 0.2, $this->size);
        $floor->setMaterial(SvMaterials::GRASS_1);
        $floor->setType(SvTypes::BOX);
        $this->objects[] = $floor;

    }
}