<?php
/*fscanf(STDIN, '%d %d', $countA, $countB);
$dataA = trim(fgets(STDIN));
$dataB = trim(fgets(STDIN));
$arrayA = explode(' ', $dataA);
$arrayB = explode(' ', $dataB);
if ($countA > 1000 || $countB >1000 || count($arrayA) != $countA || count($arrayB) != $countB ) {
    print (-1);
}
$array = array_merge($arrayA, $arrayB);
sort($array);
$array = array_unique($array);
$result = implode('->', $array);
print $result."\n";*/
/*
$data = trim(fgets(STDIN));
$array = explode('.', $data);
for ($i = 0; $i<count($array); ++$i) {
    if ($array[$i]<0) {
        print('False');
        exit();
    }
}
if ($array[0] == 10) {
    if ($array[1] <= 255 && $array[2] <= 255 && $array[3] <= 255) {
        print('True');
    } else {
        print('False');
    }
} elseif ($array[0] == 172) {
    if ($array[1] < 16 || $array[1] > 31) {
        print('False');
    } elseif ($array[2] <= 255 && $array[3] <= 255) {
        print('True');
    } else {
        print('False');
    }
} elseif ($array[1] == 192 && $array[20] == 168) {
    if ($array[2] <= 255 && $array[3] <= 255) {
        print('True');
    } else {
        print('False');
    }
} else {
    print('False');
}
print("\n");*/

spl_autoload_register(function ($class)
{
    $array = explode('\\', $class);
    require_once $array[1] . '.php';
});

use algorithm\LinkList;



//栈工具
class Stack
{
    const MaxSize = 10;
    public $toppoint = null;
    public $top = 0;
    public $errormessage = 'none';
    public function __construct()
    {
        $this->top = 0;
        $this->toppoint = null;
    }

    public function Push($data)
    {
        if ($this->top > Stack::MaxSize) {
            $this->errormessage = '栈满!';
            return $this->errormessage;
        }
        $node = new LinkList\Node($data);
        $node->next =  $this -> toppoint;
        $this->toppoint = $node;
        $this->top++;
    }

    public function Pop()
    {
        if ($this->IsEmpty()) {
            $this->errormessage = '栈空!';
            return $this->errormessage;
        }
        $tmp = $this->toppoint;
        $this->toppoint = $this->toppoint->next;
        unset($tmp);
        $this->top--;
    }

    public function ReadTop()
    {
        if (!$this->IsEmpty()) {
            return $this->toppoint->data;
        }
    }

    public function IsEmpty()
    {
        if ($this->top <= 0) {
            return 1;
        } else {
            return 0;
        }
    }
    public function Scanstack()
    {
        $node = $this->toppoint;
        while ($node !== null) {
            echo $node->data."<br>";
            $node = $node->next;
        }
    }
}

$expression = trim(fgets(STDIN));
$expreArray = str_split($expression);
$stack = new Stack();
$countArray = count($expreArray);
for ($i =0; $i<$countArray; $i++) {
    if (is_numeric($expreArray[$i])) {
        $stack->Push($expreArray[$i]);

    } else {
        $numberA = $stack->ReadTop();
        //echo $numberA;
        $stack->Pop();
        $numberB = $stack->ReadTop();
        //echo $numberB;
        $stack->Pop();
        if ($expreArray[$i] == '+') {
            $result = $numberB + $numberA;
        } elseif ($expreArray[$i] == '-') {
            $result = $numberB - $numberA;
        } elseif ($expreArray[$i] == '*') {
            $result = $numberB * $numberA;
        } elseif ($expreArray[$i] == '/') {
            $result = $numberB/$numberA;
        } else {
            print("False\n");
            exit();
        }
        $stack->Push($result);
    }
}
print($stack->ReadTop()."\n");
