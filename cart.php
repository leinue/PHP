<?php
class CART{
	public function add($good,$num,$price){
		$cart=$this->read_cookie();
		$key=$this->in_cart($good,$cart);
		if($key>0){
			$cart[$key-1][1]+=$num;
		}
		else{
			$cart[]=array($good,$num,$price );
		}
		$this->save_cookie($cart);
	}
	public function delete($good,$num){
		$cart=$this->read_cookie();
		$key=$this->in_cart($good,$cart);
		if($key>0){
			if($cart[$key-1][1]>=$num){
				$cart[$key-1][1]-=$sum;
				$this->save_cookie($cart);
				return true;
			}
			else{
				return false;
			}
		}
		else{
			return false;
		}
	}
	public function read_cookie(){
		$cart=array();
		if(isset($_COOKIE['cart'])){
			$array=explode("||", $_COOKIE['cart']);
			foreach ($array as $text) {
				# code...
				$cart[]=explode("||", $text);
			}
		}
		return $cart;
	}
	public function save_cookie($cart){
		$array=array();
		foreach ($cart as $good) {
			# code...
			if($good[1]>0){
				$array[]=implode(",", $good);
			}
		}
		if(count($array)>0){
			setcookie("cart",implode("||", $array));
		}
		else{
			setcookie("cart",'',time()-3600);
		}
	}
	private function in_cart($good,$cart){
		foreach ($cart as $key => $value) {
			# code...
			if(in_array($good, $value)){
				return $key+1;
			}
		}
		return 0;
	}
}

//
?>