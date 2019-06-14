<?php 

	require_once __DIR__. "/autoload/autoload.php";

   	$key=intval(getInPut('key'));
	unset($_SESSION['cart'][$key]);
	$_SESSION['success']="Xóa sản phẩm thành công!";
	header("location:giohang.php");

 ?>