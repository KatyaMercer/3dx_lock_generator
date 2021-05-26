<?php

namespace KatyaMercer;
/**
 * Loader of all project
 * include '../core/DXKLoader.php';
 * $sfApp = new DXKLoader();
 * and you will include all needed things
 *
 * Class DXKLoader
 * @package KatyaMercer
 */
class DXKLoader {

    public function __construct() {
        define('DIR_SV', __DIR__);
        require_once DIR_SV . '/DXKMaterials.php';
        require_once DIR_SV . '/DXKTypes.php';
        require_once DIR_SV . '/DXKScene.php';
        require_once DIR_SV . '/DXKObject.php';
        require_once DIR_SV . '/DXKWeathers.php';
        require_once DIR_SV . '/DXKGroup.php';
        
//        foreach (glob(DIR_SV . "/companies/*/*.php") as $filename)
//        {
//            include $filename;
//        }
        spl_autoload_register(function($className) {
            $className = str_replace('\\', '/', $className);
            if (file_exists(__DIR__ . '/' . $className . '.php')) {
                require_once __DIR__ . '/' . $className . '.php';
            }
        });
    }
}
