<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 18-8-11
 * Time: 下午9:33
 */

require_once "Stack.php";


class maze
{
    public $MaxX = null;
    public $MaxY = null;
    public $map = null;
    public $begin = array('x'=>0, 'y'=>0, 'pass'=>array());
    public $stack = null;

    public function __construct($array)
    {
        $this->map = $array;
        $this->stack = new \algorithm\Stack\Stack();
        $this->stack->Push($this->begin);
        $this->MaxX = count($array);
        $this->MaxY = intval(count($array, 1)/$this->MaxX);
    }

    public function JudgePath($array, $direction)
    {
        switch ($direction) {
            case 1:
                if ($this->map[$array['x']++][$array['y']] == 1) {
                    if (++$array['x'] == $this->MaxX && $array['y'] == $this->MaxY) {
                        return 'find';
                    }
                    return 1;
                }
            case 2:
                if ($this->map[$array['x']][$array['y']++] == 1) {
                    if ($array['x'] == $this->MaxX && ++$array['y'] == $this->MaxY) {
                        return 'find';
                    }
                    return 1;
                }
            case 3:
                if ($this->map[$array['x']--][$array['y']] == 1) {
                    if (--$array['x'] == $this->MaxX && $array['y'] == $this->MaxY) {
                        return 'find';
                    }
                    return 1;
                }
            case 4:
                if ($this->map[$array['x']][$array['y']--] == 1) {
                    if ($array['x'] == $this->MaxX && --$array['y'] == $this->MaxY) {
                        return 'find';
                    }
                    return 1;
                }
            default :
                return 'wrong direction number!';
        }
    }
    public function GetPath()
    {
        $ispush = null;
        while (!$this->stack->IsEmpty()) {

            $curr = $this->stack->toppoint->data;
            for ($i = 1; $i <= 4; $i++) {
                switch ($i) {
                    case 1:
                        if (!in_array($i, $curr['pass'])){
                            if ($this->JudgePath($curr, $i) == 'find') {
                                $this->stack->Push($this->map[$curr['x']++][$curr['y']]);
                                $this->stack->Scanstack();
                                exit();
                            } elseif ($this->JudgePath($curr, $i)) {
                                $this->stack->Push($this->map[$curr['x']++][$curr['y']]);
                                $ispush = 'yes';
                                $curr['pass'][]=$i;
                            }
                        }
                        break;

                    case 2:
                        if (!in_array($i, $curr['pass'])){
                            if ($this->JudgePath($curr, $i) == 'find') {
                                $this->stack->Push($this->map[$curr['x']][$curr['y']++]);
                                $this->stack->Scanstack();
                                exit();
                            } elseif ($this->JudgePath($curr, $i)) {
                                $this->stack->Push($this->map[$curr['x']][$curr['y']++]);
                                $ispush = 'yes';
                                $curr['pass'][]=$i;
                            }
                        }
                        break;

                    case 3:
                        if (!in_array($i, $curr['pass'])){
                            if ($this->JudgePath($curr, $i) == 'find') {
                                $this->stack->Push($this->map[$curr['x']--][$curr['y']]);
                                $this->stack->Scanstack();
                                exit();
                            } elseif ($this->JudgePath($curr, $i)) {
                                $this->stack->Push($this->map[$curr['x']--][$curr['y']]);
                                $ispush = 'yes';
                                $curr['pass'][]=$i;
                            }
                        }
                        break;

                    case 4:
                        if (!in_array($i, $curr['pass'])){
                            if ($this->JudgePath($curr, $i) == 'find') {
                                $this->stack->Push($this->map[$curr['x']][$curr['y']--]);
                                $this->stack->Scanstack();
                                exit();
                            } elseif ($this->JudgePath($curr, $i)) {
                                $this->stack->Push($this->map[$curr['x']][$curr['y']--]);
                                $ispush = 'yes';
                                $curr['pass'][]=$i;
                            }
                        }
                        break;
                }

                if ($ispush === 'yes') {
                    break;
                }
            }

        }
    }
}

$arraymaz[0] = [1, 0, 1, 1, 0];
$arraymaz[1] = [1, 0, 0, 0, 1];
$arraymaz[2] = [1, 1, 1, 1, 0];
$arraymaz[3] = [0, 1, 1, 0, 0];
$arraymaz[4] = [0, 0, 1, 1, 1];



$maz = new maze($arraymaz);
$maz -> GetPath();