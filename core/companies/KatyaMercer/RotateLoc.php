<?php

namespace companies\KatyaMercer;

use KatyaMercer\SvMaterials;
use KatyaMercer\SvObject;
use KatyaMercer\SvScene;
use KatyaMercer\SvTypes;
use KatyaMercer\SvWeathers;

/**
 * @package companies\KatyaMercer
 *
 */
class RotateLoc extends SvScene
{
    public static function xToY(SvScene $scene)
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