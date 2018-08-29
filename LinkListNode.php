<?php

namespace algorithm\LinkListNode;
class LinkListNode
{
	public $data;
	public $next;
	public function __construct($data)
	{
		$this -> data = $data;
	}
}