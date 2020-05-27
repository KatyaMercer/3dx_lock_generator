<?php
namespace KatyaMercer;
/**
 * Main object what will save to file
 *
 * Class SvScene
 *
 * @package KatyaMercer
 */
class SvScene
{
    private $scene;

    /**
     * SvScene constructor.
     */
    public function __construct()
    {
            $this->scene = json_decode(file_get_contents(DIR_SV . '/default_json/loadfirst.json'));
    }

    /**
     * add object to scene
     *
     * @param SvObject $object
     */
    public function addObject(SvObject $object) 
    {
            $this->scene->objects[] = $object->getObject();
    }

    /**
     * prepare json
     * @return false|string
     */
    public function dump()
    {
        return json_encode($this->scene);
    }

    /**
     * set weather
     * @param string $weather
     */
    public function setWeather(string $weather)
    {
        $this->scene->weather = $weather;
    }

    /**
     * Respawn coords
     *
     * @param $x
     * @param $y
     * @param $z
     * @param int $radius do not know
     */
    public function setRespawn($x, $y, $z, $radius = 0)
    {
        $this->scene->respawn->p = [$x, $y, $z];
        $this->scene->respawn->r = $radius;
    }

    /**
     * Do not know what this
     *
     * @param $a
     * @param $b
     * @param $c
     * @param $d
     * @param $e
     */
    public function setAmbient($a,$b,$c,$d,$e)
    {
        $this->scene->ambient = [$a,$b,$c,$d,$e];
    }

    /**
     * set oceanlevel
     *
     * @param int $level
     */
    public function setOceanlevel($level = 1)
    {
        $this->scene->oceanlevel = $level;
    }
}