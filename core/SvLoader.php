<?php

namespace KatyaMercer;
/**
 * Loader of all project
 * include '../core/SvLoader.php';
 * $sfApp = new SvLoader();
 * and you will include all needed things
 *
 * Class SvLoader
 * @package KatyaMercer
 */
class SvLoader {

    public function __construct() {
        define('DIR_SV', __DIR__);
        require_once DIR_SV . '/SvMaterials.php';
        require_once DIR_SV . '/SvTypes.php';
        require_once DIR_SV . '/SvScene.php';
        require_once DIR_SV . '/SvObject.php';
        require_once DIR_SV . '/SvWeathers.php';
        
        foreach (glob(DIR_SV . "/companies/*/*.php") as $filename)
        {
            include $filename;
        }
    }
}
