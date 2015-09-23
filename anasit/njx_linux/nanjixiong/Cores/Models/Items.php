<?php

namespace Cores\Models;

class Items{
	protected $iid;
	protected $uid;
	protected $caid;
	protected $order;
	protected $createTime;
	protected $modifyTime;
	protected $isDeleted;
	protected $commentsCount;
	protected $status;
	protected $openComments;
	protected $title;

	function getIid(){return $this->iid;}
	function getUid(){return $this->uid;}
	function getCaid(){return $this->caid;}
	function getOrder(){return $this->order;}
	function getCreateTime(){return $this->createTime;}
	function getModifyTime(){return $this->modifyTime;}
	function isDeleted(){return $this->isDeleted;}
	function getCommentsCount(){return $this->commentsCount;}
	function getStatus(){return $this->status;}
	function openComments(){return $this->openComments;}
	function getTitle(){return $this->title;}
}

?>