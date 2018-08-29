<?php

namespace  algorithm\LinkList;

class LinkList
{
	public $head;
	public static $tail;
	public function __construct()
	{
		$this -> head = new LinkListNode(null);
		$this -> head -> next = null;
		self :: $tail = $this -> head;
	}

	final public function AddLinkListInHead($data)
	{
		$isfirst = false;
		if ($this -> head -> next == null) {
			$isfirst = true;
		}
		$node = new LinkListNode($data);
		$node -> next = $this -> head -> next;
		$this -> head -> next = $node;
		if ($isfirst == true) {
			self :: $tail = $node;
			$isfirst = false;
		}
		
	} 

	final public function AddLinkListInTail($data)
	{

		$node = new LinkListNode($data);
		$node -> next = self :: $tail -> next;
		self :: $tail -> next = $node;
		self :: $tail = $node;

	}

	final public function ScanLinkList()
	{
		$p = $this -> head -> next;
		$count = 1;
		while ($p !== null) {
			echo "当前结点序号: $count &nbsp;当前结点数据: $p->data <br/>";
			$p = $p -> next;
			$count++;
		}
	}

	final public function ScanLinkListInverted($node)
	{
		if ($node -> next !== null) {
			$this -> ScanLinkListInverted($node -> next);
		}
		echo $node->data."&nbsp;";
		return;
	}

	final public function ScanLinkListInvertedByStack()
	{
        $stack = new \algorithm\Stack\Stack();
        $p = $this->head->next;
        while ($p !== null) {
            $stack->Push($p->data);
            $p = $p->next;
        }
        $stack->Scanstack();
	}

	final public function GetLinkListLength()
	{
		$p = $this -> head;
		$count = 0;
		while ($p -> next !== null) {
			$p = $p -> next;
			$count ++;
		}
		return $count;
	}

	final public function SearchlLinkList($data)
	{
		$p = $this -> head -> next;
		$count = 1;
		while ($p !== null) {
			if ($p -> data == $data) {
				return $count;
			} else {
				$p = $p -> next;
				$count++;
			}
		}
		echo "not found !".PHP_EOL;
		return false;
	}

	final public function FindPreBydata($data)
	{
		$pre = $this -> head;
		$curr = $pre -> next;
		while ($curr !== null) {
			if ($curr -> data == $data) {
				return array('pre' => $pre, 'curr' => $curr);
			} else {
				$pre = $curr;
				$curr = $pre -> next;
			}
		}
		echo "not found !".PHP_EOL;
		return false;
	}

	final public function FindPreBynumber($number)
	{
		$pre = $this -> head;
		$curr = $pre -> next;
		$count = 1;
		while ($curr !== null) {
			if ($count == $number) {
				return array('pre' => $pre, 'curr' => $curr);
			} else {
				$pre = $curr;
				$curr = $pre -> next;
				$count++;
			}
		}
		echo "not found !".PHP_EOL;
		return false;
	}

	final public function DelLinkListBydata($data)
	{
		$array = $this -> FindPreBydata($data);
		if ($array === false) {
			echo "failed to delete !";
			return false;
		} else {
			$pre = $array['pre'];
			$curr = $array['curr'];
			$pre -> next = $curr -> next;
			unset($curr);
		}
	}
	//在第number个结点前加一个数据为$data的结点
	final public function InsertLinkList($data, $number)
	{
		$array = $this -> FindPreBynumber($number);
		if ($array === false) {
			echo "failed to delete !";
			return false;
		} else {
			$newnode = new LinkListNode($data);
			$pre = $array['pre'];
			$curr = $array['curr'];
			$pre -> next = $newnode;
			$newnode -> next = $curr;
		}
	}

 	final public function ReverseLinkList()
 	{
 		$pre = null;
 		$curr = $this -> head -> next;
 		$next = $curr;
 		$this -> head ->next =null;
 		while ($next !== null) {
 			$next = $curr -> next;
 			$curr -> next = $pre;
 			$pre = $curr;
 			$curr = $next;
 		}
 		$this -> head -> next = $pre;
 	}

 	final public function DelDuplicate()
 	{
 		$p = $this -> head -> next;
 		while ($p -> next !== null) {
 			$q = $p; 
 			while ($q -> next !== null) {
 				if ($q -> next -> data == $p -> data) {
 					$r = $q -> next;
 					$q-> next = $r -> next;
 					unset($r);
 				} else {
 					$q = $q -> next;
 				}
 			}
 			$p = $p -> next;
 		}
 	}
 	
}



