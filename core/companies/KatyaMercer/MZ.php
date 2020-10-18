<?php
namespace companies\KatyaMercer;

use companies\KatyaMercer\AbstractLocation;
use KatyaMercer\SvMaterials;
use KatyaMercer\SvObject;
use KatyaMercer\SvScene;
use KatyaMercer\SvTypes;

/**
 * runner companies\KatyaMercer\MZ
 *
 * Class MZ
 * @package companies\KatyaMercer
 */
class MZ extends AbstractLocation
{
    private $n = 20;
    private $arr = [];
    public function full()
    {
        for ($i = 1; $i <= $this->n;$i++) {
            for ($j= 1; $j <= $this->n;$j++) {
                $this->arr[$i][$j] = 1;
            }
        }
    }
    public function check2($arr)
    {
        foreach ($arr as $arrI) {
            foreach ($arrI as $arrJ) {
                if ($arrJ == 1) {
                    return true;
                }
            }
        }
        return false;
    }

    public function fill2($arr)
    {
        for ($i = 1; $i <= $this->n;$i++) {
            for ($j= 1; $j <= $this->n;$j++) {
                if ($arr[$i][$j] == 2) {
                    if ($i > 1) {
                        if ($arr[$i-1][$j] == 1) {
                            $arr[$i-1][$j] = 2;
                        }
                    }
                    if ($j > 1) {
                        if ($arr[$i][$j-1] == 1) {
                            $arr[$i][$j-1] = 2;
                        }
                    }
                    if ($i < $this->n) {
                        if ($arr[$i+1][$j] == 1) {
                            $arr[$i+1][$j] = 2;
                        }
                    }
                    if ($j < $this->n) {
                        if ($arr[$i][$j+1] == 1) {
                            $arr[$i][$j+1] = 2;
                        }
                    }
                }
            }
        }
        return $arr;
    }

    public function ramka()
    {
        $all = [];
        for ($i=1;$i<=$this->n+2;$i++) {
            for ($j=1;$j<=$this->n+2;$j++) {
                if ($i == 1 || $j == 1 || $i == $this->n+2 || $j === $this->n+2) {
                    $all[$i][$j] = 0;
                } else {
                    $all[$i][$j] = $this->arr[$i-1][$j-1];
                }
            }
        }
        $all[1][2] = 1;
        $all[$this->n+2][$this->n+1] = 1;
        $this->arr = $all;
    }

    public function tryMake()
    {
        $i = rand(1, $this->n);
        $j = rand(1, $this->n);
        if ($i == 1 && $j == 1) {
            return false;
        }
        if ($i == $this->n && $j == $this->n) {
            return false;
        }

        if ($this->arr[$i][$j] != 0) {
            $copy = $this->arr;
            $copy[$i][$j] = 0;
            $copy[1][1] = 2;
            $count = $this->n * $this->n;
            while($this->check2($copy)) {
                $copy = $this->fill2($copy);
//                $this->arr = $copy;$this->drawHtml();exit;
                $count--;
                if ($count == 0) {
                    return false;
                }
            }
            $this->arr[$i][$j] = 0;
        } else {
            return false;
        }
    }
    public function drawHtml() {
        $matrix = $this->arr;
        $r = '';
        foreach ($matrix as $i => $submatrix) {
            foreach ($submatrix as $j => $element) {
                if ($element == 1) {
                    $r.= '<div style="position:absolute;font-size:8px;height:40px;width:40px;top:' . 40*$i . 'px;left: ' . 40*$j . 'px;background-color:red;"></div>';
                } else {
                    $r.= '<div style="position:absolute;font-size:8px;height:40px;width:40px;top:' . 40*$i . 'px;left: ' . 40*$j . 'px;background-color:green;"></div>';
                }
            }
        }
        return $r;
    }
    public function draw3dx(SvScene $scene)
    {
//        $obj = new SvObject();
//        $obj->setType(SvTypes::BOX);
//        $obj->setWidth($this->n*10+40,0.4,$this->n*10+40);
//        $obj->setXyz($this->n*10/2+20, 20, 0);
//        $obj->setColor(0,1,rand(1,100)/100);
//        $scene->addObject($obj);

        $obj = new SvObject();
        $obj->setType(SvTypes::TREE1);
        $obj->setWidth(1,1,1);
        $obj->setXyz($this->n*10+40, 0, $this->n*10+20);
        $obj->setRotate(270,0,0);
        $scene->addObject($obj);

        $matrix = $this->arr;
        $r = '';
        foreach ($matrix as $i => $submatrix) {
            foreach ($submatrix as $j => $element) {
                if ($element == 0) {
                    $obj = new SvObject();
                    $obj->setType(SvTypes::BOX);
                    $obj->setWidth(10,4,10);
                    $obj->setXyz($i*10, 0, $j*10);
                    $obj->setColor(rand(1,100)/100,rand(1,100)/100,rand(1,100)/100);
                    $scene->addObject($obj);
                } else {
                    $obj = new SvObject();
                    $obj->setType(SvTypes::LIGHTP);
                    $obj->setWidth(1,4,1);
                    $obj->setXyz($i*10, 10, $j*10);
                    $obj->setRotate(270,0,0);
                    $obj->setColor(rand(1,100)/100,rand(1,100)/100,rand(1,100)/100);
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

        $m = new MZ();
        $m->full();
        for ($i = 1; $i < 800; $i++) {
            $m->tryMake();
        }
        $m->ramka();
        file_put_contents('1.html', $m->drawHtml());
        $m->draw3dx($scene);
        file_put_contents('game.world', $scene->dump());
    }
}

