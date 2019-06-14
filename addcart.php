<?php 


	require_once __DIR__. "/autoload/autoload.php";


	//id sản phẩm 
	$id=intval(getInput('id'));

	//chi tiết sản phẩm
	$product = $db->fetchID("product",$id);


	//kiểm tra nếu tồn tại giỏ hàng thì cập nhật giỏ hàng
	//
	//ngược lại thì tạo mới
	if(!isset($_SESSION['cart'][$id]))
	{
		//tạo mới giỏ hàng
		$_SESSION['cart'][$id]['name']	    =$product['name'];
		$_SESSION['cart'][$id]['thunbar']   =$product['thunbar'];
		$_SESSION['cart'][$id]['price']	    =((100-$product['sale'])*$product['price'])/100;
		$_SESSION['cart'][$id]['qty']=1;
	}
	else
	{
		//cập nhật giỏ hàng
		$_SESSION['cart'][$id]['qty']+=1;
	}

	echo "<script>alert('Them vao gio hang thanh cong!'); location.href='giohang.php'</script>";
 ?>