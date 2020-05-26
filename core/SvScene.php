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
}