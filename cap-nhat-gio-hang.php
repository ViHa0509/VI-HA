<?php 

	require_once __DIR__. "/autoload/autoload.php";

   	$key=intval(getInPut("key"));// id của sản phẩm
   	$qty=intval(getInPut("qty"));


   	//kiểm tra số lượng người dùng mua có lớn hơn số lượng sản phẩm đấy trong giỏ hàng
	$_SESSION['cart'][$key]['qty']=$qty;

	echo 1;


 ?>