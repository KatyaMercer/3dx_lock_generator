<?php

namespace companies\Luna;

use companies\KatyaMercer\AbstractLocation;
use KatyaMercer\SvObject;
use KatyaMercer\SvTypes;

/**
 * Class CircleExample
 * @package companies\Luna
 */
class CircleExample extends AbstractLocation // имя для круга кроватей, наследуется от AbstractLocation
{

    public function generate($ovjCount)// параметр количество объектов
    {
        $positionCenterX = $this->positionCenterX;// можешь посмотреть AbstractLocation, в эти переменные setPos кладет значения
        $positionCenterY = $this->positionCenterY;
        $positionCenterZ = $this->positionCenterZ;

        $array = [ // ну ты такое уже видела
            SvTypes::BED1,
            SvTypes::BED2,
            SvTypes::CHAIR_GIOVANNETTI_RED,
            SvTypes::FUTON_SOFA,
            SvTypes::SOFA_4,
            SvTypes::BED6,
        ];

        $radius = $this->size;// радиус, опять таки посмотри в AbstractLocation устройство setSize

        $delta = 360 / $ovjCount; // тут надо понять, представь себе круг 360 градусов. Здесь я считаю сколько градусов будет между двумя кроватями
        for ($alf = 0;$alf<360;$alf+= $delta) { // здесь цикл. Я изменяю переменную $alf от 0 до 360 градусов и на каждом шаге прибавляю переменную $delta
            $bed = new SvObject();// создаю объект
            // тут надо тебе вспомнить математику) я вычисляю сколько надо прибавить по координате X и координатеZ чтоб кровать заняла свое место на круге
            // помнишь формулы прямоугольного треугольника и то что если круг нариосвать с центом в 0 0 системы координат, то каждую точку можно посчитать по
            // одной оси x*sin(alfa), а вторую x*cos(alfa)?
            // в php функции sin, cos работают с радианами, потому я перегоняю угол в градусах в радианы.
            $deltaX = $radius*sin(deg2rad($alf));
            $deltaZ = $radius*cos(deg2rad($alf));
            // устанавливаю координаты
            $bed->setXyz($positionCenterX + $deltaX,$positionCenterY,$positionCenterZ+ $deltaZ);
            // поворот
            $bed->setRotate(270,45,0);
            $type = $array[array_rand($array)]; // выбираю случайный элемент из массива $array
            $bed->setType($type);// и делаю такого типа этот объект
            // не забывай закидывать объекты в массив object он потом отрисовывается в drawOnScene (смотри AbstractLocation)
            $this->objects[] = $bed;
        }
    }
}