<?php

namespace companies\KatyaMercer;

use companies\KatyaMercer\Sh\StarShip;
use KatyaMercer\SvMaterials;
use KatyaMercer\SvObject;
use KatyaMercer\SvScene;
use KatyaMercer\SvTypes;
use KatyaMercer\SvWeathers;

/**
 * runner companies\KatyaMercer\StarshipLoca
 * Class StarshipLoca
 * @package companies\KatyaMercer
 *
 * генералу https://dropmefiles.com/YfWia
 *
 */
class StarshipLoca
{
    public function run()
    {
        $scene = new SvScene();

        $d = new DefRespawn();
        $d->setPos(0,-500,0);
        $d->setSize(2);
        $d->generate(SvMaterials::WALLPAPER_1);
        $d->drawOnScene($scene);

        $rw = new StarShip();
        $rw->setPos(0,7,50);
        $rw->setSize(150);
        $rw->plastinaSize(2);
        $rw->setRadius(16);
        $rw->generate();
//        $rw->generPlatform();
        $rw->drawOnScene($scene, false);
        $scene->setRespawn(0,7,170);

//        RotateLoc::xToY($scene);
        $scene->setOceanlevel(-1000);
        $scene->setWeather(SvWeathers::NIGHT);

        file_put_contents('astar.world', $scene->dump());
    }


}