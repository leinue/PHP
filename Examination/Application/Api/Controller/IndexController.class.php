<?php
namespace Api\Controller;
use Think\Controller;
use Applicatio\Commmon\common;

class IndexController extends Controller {
    public function index(){
    	$this->redirect('/Home/',5,'页面跳转中....');
    }  
}