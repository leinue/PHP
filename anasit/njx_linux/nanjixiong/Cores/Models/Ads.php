<?php

namespace Cores\Models;

class Ads{

	protected $aid;
	protected $content;
	protected $image;
	protected $url;
	protected $display;

	function getAid(){return $this->aid;}
	function getContent(){return $this->content;}
	function getImage(){return $this->image;}
	function getUrl(){return $this->url;}
	function getDisplay(){return $this->display;}

}

?>