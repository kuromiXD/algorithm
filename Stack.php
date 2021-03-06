<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 18-8-11
 * Time: 下午5:29
 */

namespace  algorithm\Stack;


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
        $node = new \algorithm\LinkListNode\LinkListNode($data);
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

