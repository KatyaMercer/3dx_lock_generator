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

    protected $height;

    public function setHeight($height)
    {
        $this->height = $height;
    }

    public function generate($material = SvMaterials::GRASS_1)
    {

        $floor = new SvObject();
        $floor->setXyz($this->positionCenterX, $this->positionCenterY, $this->positionCenterZ);
        $floor->setWidth($this->size, 0.2, $this->size);
        $floor->setMaterial(SvMaterials::GRASS_1);
        $floor->setType(SvTypes::BOX);
        $this->objects[] = $floor;

        $floor = new SvObject();
        $floor->setXyz($this->positionCenterX, $this->positionCenterY, $this->positionCenterZ);
        $floor->setWidth($this->size, 0.2, $this->height);
        $floor->setMaterial(SvMaterials::GRASS_1);
        $floor->setRotate(150, 0, 0);
        $floor->setType(SvTypes::BOX);
        $this->objects[] = $floor;

        $floor = new SvObject();
        $floor->setXyz($this->positionCenterX-$this->size/2, $this->positionCenterY, $this->positionCenterZ+$this->size/2);
        $floor->setWidth($this->size, 0.2, $this->height);
        $floor->setMaterial(SvMaterials::GRASS_1);
        $floor->setRotate(150, 90, 0);
        $floor->setType(SvTypes::BOX);
        $this->objects[] = $floor;

        $floor = new SvObject();
        $floor->setXyz($this->positionCenterX, $this->positionCenterY, $this->positionCenterZ+$this->size);
        $floor->setWidth($this->size, 0.2, $this->height);
        $floor->setMaterial(SvMaterials::GRASS_1);
        $floor->setRotate(30, 0, 0);
        $floor->setType(SvTypes::BOX);
        $this->objects[] = $floor;

        $floor = new SvObject();
        $floor->setXyz($this->positionCenterX+$this->size/2, $this->positionCenterY, $this->positionCenterZ+$this->size/2);
        $floor->setWidth($this->size, 0.2, $this->height);
        $floor->setMaterial(SvMaterials::GRASS_1);
        $floor->setRotate(30, 90, 0);
        $floor->setType(SvTypes::BOX);
        $this->objects[] = $floor;

    }
}