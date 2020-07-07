<?php
namespace companies\Luna; // это твой неймспейс
use KatyaMercer\SvScene;// я подключаю класс SvScene, потому что он в другом неймспейсе

/**
 * вот так дергать этот класс из папки examples это namespace+имя класса
 * runner companies\Luna\LunaRunner
 *
 * Class LunaRunner
 * @package companies\KatyaMercer
 */
class LunaRunner //имя класса
{
    public function run() // чтоб дергать классы из своей папки у них обязательно должна быть функция run без параметров. И она же будет дергаться
    {
        $scene = new SvScene();// создаю сцену
        $dr = new \companies\KatyaMercer\DefRespawn(); // создаю мою стандартную платформу. Обрати внимание, что я пишу название класса вместе с неймспейсом. Можно было объявить сверху
        $dr->setPos(0,-0.2,-100);// координаты какие то
        $dr->setSize(170);// размер
        $dr->setHeight(10);// высота склонов
        $dr->generate();//генерирую
        $dr->drawOnScene($scene, true);//вывожу на сцену

        $circle = new CircleExample();//создаю круг кроватей (посмотри этот класс
        $circle->setPos(0,0,0);//центр круга
        $circle->setSize(30);//внезапно это радиус круга))
        $circle->generate(20);//генерирую, указываю количество кроватей в параметрах
        $circle->drawOnScene($scene);// на сцену

        file_put_contents('luni77868.world', $scene->dump());//сцену в файл
    }
}