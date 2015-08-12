<?php

namespace Cores\Models;

class Comments{
	protected $rid;
	protected $itemId;
	protected $content;
	protected $createTime;

	function getRid(){return $this->rid;}
	function getItemId(){return $this->itemId;}
	function getContent(){return $this->content;}
	function getCreateTime(){return $this->createTime;}
}

?>