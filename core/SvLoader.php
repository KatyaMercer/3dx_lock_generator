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
        require_once DIR_SV . '/SvGroup.php';
        
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
