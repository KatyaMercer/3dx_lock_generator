<?php
namespace KatyaMercer;
/**
 * Main object what will save to file
 *
 * Class SvGroup
 *
 * @package KatyaMercer
 */
class SvGroup
{
    private $group;

    /**
     * SvScene constructor.
     */
    public function __construct()
    {
            $this->group = json_decode('{"n":"group","objects":[]}');
    }

    /**
     * add object to group
     *
     * @param SvObject $object
     */
    public function addObject(SvObject $object) 
    {
            $this->group->objects[] = $object->getObject();
    }

    /**
     * return the group
     *
     * @return mixed
     */
    public function getGroup()
    {
        return $this->group;
    }

}
