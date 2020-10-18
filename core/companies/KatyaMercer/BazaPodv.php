<?php

namespace companies\KatyaMercer;

use KatyaMercer\SvMaterials;
use KatyaMercer\SvObject;
use KatyaMercer\SvScene;
use KatyaMercer\SvTypes;
use KatyaMercer\SvWeathers;

/**
 * runner companies\KatyaMercer\BazaPodv
 * Class BazaPodv
 * @package companies\KatyaMercer
 *
 * генералу https://dropmefiles.com/YfWia
 *
 */
class BazaPodv
{
    public function run()
    {
        $scene = new SvScene();



        $rw = new RitaWorld();
        $rw->setPos(0,0,0);
        $rw->setSize(200);
        $rw->generate(true, 60,63);
//        $rw->generPlatform();
        $rw->drawOnScene($scene, false);

        $rw = new Submarine();
        $rw->setPos(0,7,50);
        $rw->setSize(100);
        $rw->generate(15);
//        $rw->generPlatform();
        $rw->drawOnScene($scene, false);
        $scene->setRespawn(0,30,100);

//        RotateLoc::xToY($scene);

        file_put_contents('baza.world', $scene->dump());
    }


}