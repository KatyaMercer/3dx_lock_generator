<?php
namespace companies\KatyaMercer;
use KatyaMercer\SvMaterials;
use KatyaMercer\SvObject;
use KatyaMercer\SvScene;
use KatyaMercer\SvTypes;

/**
 * runner companies\KatyaMercer\KMG
 *
 * Class KMG
 * @package companies\KatyaMercer
 */
class KMG extends AbstractLocation
{
    /**
     * Перед игрой нужно зайти в редактор и надеть на себя как можно больше одежды.
     * Ибо получение ранения это снять одну вещь, восстановление здоровья - надеть назад.
     *
     * По очереди выбираете клетку и выбираете роль.
     * Выбираешь 2 цвета. По клеткам только этих цветов ты можешь двигаться.
     * Стул получает + 2 к броскам кубиков при атаке
     * Стол получает + 3 к броскам кубиков при защите
     * Шест позволяет после любого броска 1 раз бесплатно перебросить кубики. Пишешь "/me переброс" и перебрасываешь.
     * Мопед, позволяет передвигаться (но не заканчивать ход) на клетках чужого цвета
     * Очков у всех 0.
     *
     * Ход
     * Пишешь роль
     * /me цвет очки цвет1, цвет2
     * /me Стул 2 СинеЗеленый
     * Кидаешь кубик
     * /me новая роль, на случай, если она изменилась
     * /me кончил ход
     *
     * Двигаешься на выпавшее количество клеток, не наступая дважды на один квадрат
     * Задействуешь объект, находящийся на последней клетке пути
     * Если ты пересекаешь клетку или приходишь в клетку с другим игроком:
     * Оппонент(ы) кидает(ют) кубики.
     * Ты кидаешь кубики.
     * Тот у кого меньше выпало, с учетом всех бонусов, получает повреждение на разницу. Если разница = 0, никто не получает повреждений
     * Если на клетке стоит 2 оппонента, они тоже кидают кубики и с ними тоже меряешься повреждениями (со своего одного броска)
     * Если несколько раз пересекаешь клетку с врагами, опять кидаешь кубики
     * Если побежденный не хочет получать повреждения, может отдать 1 очко победителю (нельзя уходить меньше 0) /me отдаю очко
     * Если ты не можешь\не хочешь перемещатся на этот бросок, можешь потерять 1 очко жизни и перебросить кубик (сколько угодно раз)
     * Если ты играешь за шест и 1 раз бесплатно пербросил кубик, теряешь 1 очко жизни и можешь вновь 2 раза перебросить кубик.
     *
     * Объекты.
     * Шар другого цвета - выбираешь какой из своих цветов ты хочешь (должен) заменить (цветов должно быть 2)
     * Стул, стол, мопед, шест - смена роли.
     * Дерево - +2 при защите на этой клетке
     * Куст - восстановить здоровье броском кубиков
     * Пульт - мгновенно перемещаешься на любую по желанию клетку. При перемещении на клетку противника инициируешь бой.
     * Ведро получаешь очко
     *
     * Цель всех убить или собрать 10 очков.
     *
     *
     * @return array
     */
    public function generateKvadr()
    {
        $colors = [
            'red' => 0,
            'green' => 0,
            'blue' => 0,
            'white' => 0,
//            'black' => 0,
//            'yellow' => 0,
        ];
        $objects = [
            'chair_Giovannetti_black', 'table_4_decor', 'Chopper', 'pole', 'christmas_tree', 'mafon', 'vedro',
            'BUSH1', 'BUSH1', 'BUSH1', 'none', 'none', 'none',
            'none', 'none', 'none', 'none', 'none', 'none',
            'none', 'none', 'none', 'none', 'none', 'none',
            'redCube', 'greenCube', 'blueCube', 'whiteCube', 'none', 'none',
            'redCube', 'greenCube', 'blueCube', 'whiteCube', 'none', 'none',
        ];

        $matrix = [];
        for ($i = 1; $i <= 6; $i++) {
            for ($j = 1; $j <= 6; $j++) {
                $color = '';
                while (!isset($colors[$color]) || $colors[$color] > 9) {
                    $color = array_rand($colors);
                }
                $pos = -1;
                while (!isset($objects[$pos])) {
                    $pos = array_rand($objects);
                    if (isset($objects[$pos]) && strpos($objects[$pos], 'Cube')) {
                        $col = str_replace('Cube', '', $objects[$pos]);
                        if ($col === $color) {
                            $pos = -1;
                        }
                    }
                }

                $colors[$color]++;
                $matrix[$i][$j] = [
                    'color' => $color,
                    'object' => $objects[$pos] !== 'none' ? $objects[$pos] : '',
                    'concat' => 'none'
                ];
                if ($i == 6 && $j == 1) {
                    $matrix[$i][$j]['concat'] = 'left';
                }
                if ($i == 1 && $j == 6) {
                    $matrix[$i][$j]['concat'] = 'bottom';
                }
                unset($objects[$pos]);
            }
        }
        return $matrix;
    }

    public function concat($to, $donor)
    {
        $points = [];
        foreach ($to as $i => $submatrix) {
            foreach ($submatrix as $j => $element) {
                if ($element['concat'] !== 'none') {
                    $points[] = [
                        'type' => $element['concat'],
                        'i' => $i,
                        'j' => $j,
                    ];
                }
            }
        }
        $randPoint = $points[array_rand($points)];
        if ($randPoint['type'] == 'left') {
            $di = 0;
            $dj = 1;
        }
        if ($randPoint['type'] == 'bottom') {
            $di = 1;
            $dj = 0;
        }
        $to[$randPoint['i']][$randPoint['j']]['concat'] = 'none';
//        print_r($randPoint);
        for ($i = 1; $i <= 6; $i++) {
            for ($j = 1; $j <= 6; $j++) {
                $to[$randPoint['i'] + $i - $di][$randPoint['j'] + $j - $dj] = $donor[$i][$j];
            }
        }
        return $to;
    }

    public function drawHtml($matrix)
    {
        foreach ($matrix as $i => $submatrix) {
            foreach ($submatrix as $j => $element) {
                echo '<div style="position:absolute;font-size:8px;height:40px;width:40px;top:' . 40 * $i . 'px;left: ' . 40 * $j . 'px;background-color:' . $element['color'] . ';">' . $element['object'] . '</div>';
            }
        }
//        for ($i = 1; $i <= 6; $i++) {
//            for ($j = 1; $j <= 6; $j++) {
//                echo '<div style="position:absolute;height:100px;width:100px;top:' . 100*$i . 'px;left: ' . 100*$j . 'px;background-color:' . $matrix[$i][$j]['color'] . ';">' . $matrix[$i][$j]['object'] . '</div>';
//            }
//        }
    }

    public function draw3dx($matrix, SvScene $scene)
    {
        foreach ($matrix as $i => $submatrix) {
            foreach ($submatrix as $j => $element) {
                $obj = new SvObject();
                $obj->setType(SvTypes::BOX);
                $obj->setWidth(5,0.2,5);
                $obj->setXyz($i*5, 0.2, $j*5);
                switch ($element['color']) {
                    case 'red':
                        $obj->setColor(1,0,0);
                        break;
                    case 'green':
                        $obj->setColor(0,1,0);
                        break;
                    case 'blue':
                        $obj->setColor(0,0,1);
                        break;
                    case 'white':
                        $obj->setColor(1,1,1);
                        break;
                }
                $scene->addObject($obj);
                if (in_array($element['object'], ['redCube', 'greenCube', 'blueCube', 'whiteCube'])) {
                    $obj = new SvObject();
                    $obj->setType(SvTypes::SPHERE);
                    $obj->setWidth(1,1,1);
                    $obj->setXyz($i*5, 0.5, $j*5+2.5);
                    switch ($element['object']) {
                        case 'redCube':
                            $obj->setColor(1,0,0);
                            break;
                        case 'greenCube':
                            $obj->setColor(0,1,0);
                            break;
                        case 'blueCube':
                            $obj->setColor(0,0,1);
                            break;
                        case 'whiteCube':
                            $obj->setColor(1,1,1);
                            break;
                    }
                    $scene->addObject($obj);
                } else {
                    $obj = new SvObject();
                    $obj->setType($element['object']);
                    $obj->setWidth(1,1,1);
                    $obj->setXyz($i*5, $element['object'] == 'Chopper'? 0.5: 0.2, $j*5+2.5);
                    $obj->setRotate(270,0,0);
                    $scene->addObject($obj);
                }
            }
        }
    }

    public function run()
    {
        $scene = new \KatyaMercer\SvScene();

        $dr=  new DefRespawn();
        $dr->setPos(0,0,-100);
        $dr->setSize(1000);
        $dr->generate(SvMaterials::SAND);
        $dr->drawOnScene($scene);
        $n = new KMG();
        $start = $n->generateKvadr();
        $start = $n->concat($start, $n->generateKvadr());
        $start = $n->concat($start, $n->generateKvadr());
        $start = $n->concat($start, $n->generateKvadr());
        $start = $n->concat($start, $n->generateKvadr());
        $n->draw3dx($start, $scene);
        file_put_contents('game.world', $scene->dump());
    }
}

