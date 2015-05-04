<?php
namespace Admin\Controller;
use Think\Controller;
class IndexController extends Controller {
    public function index(){
        $this->show('fuckubitch','utf-8');
    }

    public function instance(){
    	$index=A('Home/Index');
    	$index->fuck();
    }
}