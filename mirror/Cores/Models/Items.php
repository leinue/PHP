<?php

namespace Cores\Models;

class Items{
	protected $iid;
	protected $cata;
	protected $order;
	protected $createTime;
	protected $modifyTime;
	protected $isDeleted;
	protected $commentsCount;

	function getIid(){return $this->iid;}
	function getCata(){return $this->cata;}
	function getOrder(){return $this->order;}
	function getCreateTime(){return $this->createTime;}
	function getModifyTime(){return $this->modifyTime;}
	function isDeleted(){return $this->isDeleted;}
	function getCommentsCount(){return $this->commentsCount;}
}

?>