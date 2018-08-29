<?php
/*
二叉树遍历的应用
 */

class QueueNode
{
	public $data;
	public $next;
	public function __construct($data)
	{
		$this->data = $data;
		$this->next = null;
	}
}
class Queue 
{
	public $head;
	public $tail;
	public function __construct()
	{
		$this->head = null;
		$this->tail = null;
	}
	public function EnterQueue($data)
	{
		if ($this->IsEmpty()) {
			$this->head = new QueueNode($data);
			$this->tail = $this->head;
		} else {
			$newNode = new QueueNode($data);
			$this->tail->next = $newNode;
			$this->tail = $newNode;
		}
	}
	public function LeaveQueue()
	{
		if (!$this->IsEmpty()) {
			$this->head = $this->head->next;
			if ($this->head === null) {
				$this->tail = null;
			}
		} 

	}
	public function ScanQueue()
	{
		$p = $this->head;
		
		while ($p) {
			echo $p->data."<br>";
			$p = $p->next;
		}
	}
	public function QueueHead()
	{
		if (!$this->IsEmpty()) {
		return $this->head;
		} else {
			return false;
		}
	}

	public function IsEmpty()
	{
		if ($this->head === null && $this->tail === null) {
			return true;
		} else {
			return false;
		}
	}
}
class BiTreeNode
{
	public $data;
	public $LChild;
	public $RChild;
	public function __construct($data = null) 
	{
		$this->data = $data;
		$this->LChild = null;
		$this->RChild = null;
	}
}

 class BiTree
 {
 	public  $root = null;
 	public  static $queue = null;
 	public  function MakeBiTree($data)
 	{
 		if ($this->root === null) {
 			$newNode = new BiTreeNode($data);
 			$this->root = $newNode;
 			self::$queue = new Queue();
 			self::$queue->EnterQueue($newNode);
 		} else {
 			$newNode = new BiTreeNode($data);
 			$curr = self::$queue->QueueHead()->data;
 			if ($curr !== false) {
 				if ($curr->LChild === null) {
 					$curr->LChild = $newNode;
 				} else {
 					$curr->RChild = $newNode;
 					self::$queue->LeaveQueue();
 					self::$queue->EnterQueue($curr->LChild);
 					self::$queue->EnterQueue($curr->RChild);
 				}
 			}
 		}
 	}

 }

//获取二叉树的结点个数
function GetNodeCount($root) : int
{
	static $nodeCount = 0;  
	if ($root) {
		$nodeCount++;
		GetNodeCount($root->LChild);
		GetNodeCount($root->RChild);
	}
	return $nodeCount;
}
//中序遍历输出叶子结点
function GetLeafNode($root)
{

	if ($root) {
		GetLeafNode($root->LChild);
		if ($root->LChild === null && $root->RChild === null) {
			print($root->data."\n");
		}
		
		GetLeafNode($root->RChild);
	}
 }


//后序遍历输出叶子结点个数(静态变量)
function GetLeafCountA($root)
{
	static $count = 0;
	if ($root) {
		GetLeafCountA($root->LChild);
		GetLeafCountA($root->RChild);
		if ($root->LChild === null && $root->RChild === null) {
			$count++;
		}
	}
	return $count;
}

//后序遍历输出叶子结点个数 
function GetLeafCountB($root)
{
	if ($root === null) {
		return 0;
	}
	if ($root->LChild === null && $root->RChild === null) {
		return 1;
	}
	return GetLeafCountB($root->LChild) + GetLeafCountB($root->RChild);
}

//求树的高度(静态变量)
function GetTreeHeightA($root, $height = 1)
{
	static $max = 0;
	if ($root) {
		if ($max < $height) {
			$max = $height;
		}
		GetTreeHeightA($root->LChild, $height+1);
		GetTreeHeightA($root->RChild, $height+1);
	}
	return $max;
}

//求树的高度
function GetTreeHeightB($root)
{
	if ($root == null) {
		return 0;
	} else {
		$hL = GetTreeHeightB($root->LChild);
		$hR = GetTreeHeightB($root->RChild);
		$h = ($hL > $hR ? $hL : $hR)+1;
		return $h;
	}
	 
}
//得到某结点的双亲结点
function GetParent($root, $data)
{
	if (!$root) {
		return false;
	}
	if (($root->LChild !== null && $root->LChild->data == $data) ||
		($root->RChild !== null &&  $root->RChild->data == $data)) {
		return $root->data;
	}
	$p = GetParent($root->LChild, $data);
	if ($p) {
		return $p;
	} else {
		return GetParent($root->RChild, $data);
	}
}

//相似性判定
function Like($rootA, $rootB) 
{
	if ($rootA === null && $rootB === null) {
		return 1;
	} elseif ($rootA === null || $rootB === null) {
		return 0;
	} else {
		$likeL = Like($rootA->LChild, $rootB->LChild);
		$likeR = Like($rootA->RChild, $rootB->RChild);
		return ($likeL && $likeR);
	}

}

//桉树状打印二叉树
function PrintTree($root, $height = 0)
{
	if (!$root) {
		return false;
	}
	PrintTree($root->RChild, $height+1);
	for ($i = 0; $i < $height; ++$i) {
		print("&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;");
	}
	print($root->data."<br>");
	PrintTree($root->LChild, $height+1);
}
$biTree = new BiTree();
for ($i = 1; $i<= 10; ++$i) {
	$biTree->MakeBiTree($i);
}


