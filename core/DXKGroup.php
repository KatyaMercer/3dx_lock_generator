<?php
namespace KatyaMercer;
/**
 * Main object what will save to file
 *
 * Class DXKGroup
 *
 * @package KatyaMercer
 */
class DXKGroup
{
    private $group;

    /**
     * DXKScene constructor.
     */
    public function __construct()
    {
            $this->group = json_decode('{"n":"group","objects":[]}');
    }

    /**
     * add object to group
     *
     * @param DXKObject $object
     */
    public function addObject(DXKObject $object)
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
