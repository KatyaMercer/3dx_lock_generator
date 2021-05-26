<?php
namespace KatyaMercer;
/**
 * Main object what will save to file
 *
 * Class DXKScene
 *
 * @package KatyaMercer
 */
class DXKScene
{
    protected $scene;

    /**
     * DXKScene constructor.
     */
    public function __construct()
    {
            $this->scene = json_decode(file_get_contents(DIR_SV . '/default_json/loadfirst.json'));
    }

    /**
     * add object to scene
     *
     * @param DXKObject $object
     */
    public function addObject(DXKObject $object)
    {
            $this->scene->objects[] = $object->getObject();
    }

    public function clean()
    {
        $this->scene->objects = [];
    }

    public function addGroup(DXKGroup $group)
    {
        $this->scene->objects[] = $group->getGroup();
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
     * add map from json
     *
     * @param $json
     */
    public function up($json)
    {
        $this->scene = json_decode($json);
    }

    /**
     * merge 2 scenes (for example from file)
     *
     * @param DXKScene $scene
     */
    public function merge(DXKScene $scene)
    {
        $this->scene->objects = array_merge($this->scene->objects, $scene->scene->objects);
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