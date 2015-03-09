<?php

print_r("<meta charset=\"utf-8\"></meta>");

/**
* 采用三叉链表结构
*/
class biTreeNode{

	private $lchild=null;
	private $data=null;
	private $rchild=null;

	function __construct($d,$l=null,$r=null){
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

	function setRChild($r){
		$this->rchild=$r;
	}

	function setLChild($l){
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

//验证通过,可用
*/

/**
* biTree
*/
class biTree{
	
	private $root;//根结点
	private $data=null;//要导入的数据

	//初始化二叉树(使用先根递归遍历)
	//接收data的值
	function __construct($data){
		is_array($data) || $this->data=str_split($data);
		$this->root=$this->createBiTree();
	}

	function createBiTree($node=null){
		if($this->data==null){return null;}
		$first=array_shift($this->data);
		if($first==null){
			return null;
		}else{
			$node=new biTreeNode($first);
			//echo 'root getData = '.$this->root->getData().'<br>';
			if(ord($first)%2==0){
				$node->setRChild($this->createBiTree($node));
			}else{
				$node->setLChild($this->createBiTree($node));
			}
			return $node;
		}
	}

	function getRoot(){
		return $this->root;
	}

	function setRoot($r){
		$this->root=$r;
	}

	//后根遍历
	function LRD($node){
		if($node){
			$this->DLR($node->getLchild());
			$this->DLR($node->getRchild());
			print("DLR:".$node->getData()."<br>");
		}else{
			return '';
		}
	}

	//先根遍历
	function DLR($node){
		//echo '<br>Enter DLR:<br><br>';
		//print_r($this->root);
		if($node){
			print("DLR:".$node->getData()."<br>");
			$this->DLR($node->getLchild());
			$this->DLR($node->getRchild());
		}else{
			return '';
		}
	}

	//中根遍历
	function LDR($node){
		if($node){
			$this->DLR($node->getLchild());
			print("DLR:".$node->getData()."<br>");
			$this->DLR($node->getRchild());
		}else{
			return '';
		}
	}

	//清空二叉树
	function clear(){
		$this->root=null;
	}

	//检测二叉树是否为空
	function isEmpty(){
		return !$this->root==null;
	}

	//获得二叉树的深度
	function getDepth($node){
		if($node){
			return ceil(log($this->countNode($this->root),2)+1)-1;
		}else{
			return 0;
		}
	}

	//计算结点数量
	function countNode($node){
		$count=0;
		if($node){
			++$count;
			$count=$count+$this->countNode($node->getLchild());
			$count=$count+$this->countNode($node->getRchild());
			return $count;
		}else{
			return 0;
		}
	}

	function leftChild($e){
		return $e->getLChild();
	}

	function isEqual(){

	}
}

echo '初始化二叉树数据:1234567890<br>';
$data="1234567890";

echo '------------初始化二叉树------------<br>';
$bt=new biTree($data);
echo '-------------初始化完毕-------------<br>';

if($bt->isEmpty()){
	echo 'isEmpty函数测试结果:二叉树非空<br>';
}else{
	echo 'isEmpty函数测试结果:二叉树为空<br>';
}

echo 'DLR先根遍历:<br>';
$bt->DLR($bt->getRoot());

echo 'LRD后根遍历:<br>';
$bt->LRD($bt->getRoot());

echo 'LDR中根遍历:<br>';
$bt->LDR($bt->getRoot());

echo '二叉树深度为:'.$bt->getDepth($bt->getRoot()).'<br>';
echo '二叉树结点数量为:'.$bt->countNode($bt->getRoot()).'<br>';

echo '二叉树对象DUMP:<br>';
print_r($bt);

echo '<br>';

echo '清空二叉树<br>';
$bt->clear();

if($bt->isEmpty()){
	echo '清空二叉树之后的非空测试结果:二叉树非空<br>';
}else{
	echo '清空二叉树之后的非空测试结果:二叉树为空<br>';
}

//echo $bt->leftChild();

?>