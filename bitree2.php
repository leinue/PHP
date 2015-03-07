<?php

/**
* 采用三叉链表结构
*/
class biTreeNode{

	private $lchild;
	private $data;
	private $rchild;

	function __construct(biTreeNode $l,$d,biTreeNode $r){
		$this->lchild=$l;
		$this->data=$d;
		$this->rchild=$r;		
	}

	function getLChild(){
		return $this->lchild;
	}

	function getData(){
		return $this->data;
	}

	function getRChild(){
		retun $this->rchild;
	}

	function setRChild(biTreeNode $r){
		$this->rchild=$r;
	}

	function setLChild(biTreeNode $l){
		$this->lchild=$l;
	}

	function setData($d){
		$this->data=$d;
	}
}

?>