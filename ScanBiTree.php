<?php
spl_autoload_register(function($class_name)
{
	 
	$array = explode("\\", $class_name);
	include_once($array[count($array)-1].".php");
});
include ("OperateBiTree.php");
use algorithm\LinkListNode;
use algorithm\Stack;




//先序非递归遍历二叉树
function PreOrder($root) 
{
	$stack = new Stack\Stack();
	while ($root != null || !$stack->IsEmpty()) {
		while ($root != null) {
			print($root->data."&nbsp");
			$stack->Push($root);
			$root = $root->LChild;
		}
		$root = $stack->ReadTop();
		$stack->Pop();
		$root = $root->RChild;
		
	}
}

//中序非递归遍历二叉树
function InOrder($root)
{
	$stack = new Stack\Stack();
	while ($root != null || !$stack->IsEmpty()) {
		while ($root != null) {
			$stack->Push($root);
			$root = $root->LChild;
		}
		
		$root = $stack->ReadTop();
		print($root->data."&nbsp");
		$stack->Pop();
		$root = $root->RChild;
		
	}
}
//后序非递归遍历二叉树
function PostOrder($root)
{
	$stack = new Stack\Stack();
	$LastScan = new BiTree();
	while ($root != null || !$stack->IsEmpty()) {
		while ($root != null) {
			$stack->Push($root);
			$root = $root->LChild;
		}
		$root = $stack->ReadTop();
		if ($root->RChild == null || $LastScan == $root->RChild) {
			$stack->Pop();
			print($root->data."\n");
			$LastScan = $root;
			$root = null;
		} else {
			$root = $root->RChild;
		}
	}
}
PreOrder($biTree->root);
print("<br>");
InOrder($biTree->root);
print("<br>");
PostOrder($biTree->root);