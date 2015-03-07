<?php

/**
* 采用三叉链表结构
*/
class biTreeNode{

	private $lchild;
	private $data;
	private $rchild;

	function __construct($d,biTreeNode $l=null,biTreeNode $r=null){
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
		return $this->rchild;
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

/*
//测试三叉链表是否可用
$btn=new biTreeNode(1);
echo $btn->getData();

$b1=new biTreeNode(2);
$b2=new biTreeNode(3);

$btn->setLChild($b1);
$btn->setRChild($b2);

echo $btn->getRChild()->getData();
echo $btn->getLChild()->getData();
*/



?>