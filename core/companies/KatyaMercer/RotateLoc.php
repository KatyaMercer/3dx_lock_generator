<?php

namespace companies\KatyaMercer;

use KatyaMercer\DXKMaterials;
use KatyaMercer\DXKObject;
use KatyaMercer\DXKScene;
use KatyaMercer\DXKTypes;
use KatyaMercer\DXKWeathers;

/**
 * @package companies\KatyaMercer
 *
 */
class RotateLoc extends DXKScene
{
    public static function xToY(DXKScene $scene)
    {
//        print_r($scene->scene->objects[0]);
        foreach($scene->scene->objects as &$object) {
//            print_r($object);exit;
            $nul = $object->p[0];
            $object->p[0] = $object->p[2];
            $object->p[2] = $nul;

            $nul = $object->r[0];
            $object->r[0] = $object->r[2];
            $object->r[2] = $nul;

            $nul = $object->s[0];
            $object->s[0] = $object->s[2];
            $object->s[2] = $nul;
        }
//        print_r($scene->scene->objects[0]);
    }
}