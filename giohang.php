<?php 

		require_once __DIR__. "/autoload/autoload.php";
/*		_debug($_SESSION['cart']);*/
		if(!isset($_SESSION['cart']) || count($_SESSION['cart'])==0)
		{
			echo "<script>alert('Không có sản phẩm trong giỏ hàng!'); location.href='index.php'</script>";
		}
		if(!isset($_SESSION['name_id']))
		{
			echo "<script>alert('Ban phai dang nhap de thuc hien chuc nang nay!'); location.href='dang-nhap.php'</script>";
		}
?>
<?php require_once __DIR__. "/layouts/header.php"; ?>
               <div class="col-md-9 bor">
                  <section class="box-main1">
                     <h3 class="title-main"><a href="">Giỏ hàng của bạn</a></h3>
                     <?php if(isset($_SESSION['success'])): ?>
                     	<div class="alert alert-success">
						   <?php echo $_SESSION['success']; unset($_SESSION['success']) ?>
						</div>
					<?php endif ?>
					<table class="table table-hover">
						<thead>
							<tr>
								<th><strong>STT</strong></th>
								<th><strong>Tên sản phẩm</strong></th>
								<th><strong>Hình ảnh</strong></th>
								<th><strong>Số lượng</strong></th>
								<th><strong>Giá</strong></th>
								<th><strong>Tổng tiền</strong></th>
								<th></th>
							</tr>
						</thead>
						<tbody>
							<?php $sum=0?>
							<?php $stt=1; foreach ($_SESSION['cart'] as $key => $value):?>
								
								
								<tr>
									<td><?php echo $stt ?></td>
									<td><?php echo $value['name'] ?></td>
									<td>
										<img src="<?php echo uploads() ?>product/<?php echo $value['thunbar']?>" width="80px" height="80px">
									</td> 
									<td><input type="number" name="qty"  value="<?php echo $value['qty'] ?>" class="form-control qty" id="qty" min="0">
									</td>
									<td><?php echo formartprice($value['price']) ?></td>
									<td><?php echo formartprice($value['price']*$value['qty']) ?></td>
									<td>
										<a class="btn btn-xs btn-danger" href="xoasp.php?key=<?php echo $key?>"><i class="fa fa-remove"></i> Xóa</a>
										<a class="btn btn-xs btn-info updatecart" href="" data-key=<?php echo $key ?>><i class="fa fa-refresh"></i> Cập nhật</a>
									</td>
								</tr>
							<?php $sum+=$value['price']*$value['qty'];$_SESSION['tongtien']=$sum ?>

							<?php $stt++; endforeach ?>
						</tbody>
					</table>
					<div class="col-md-5 pull-right">
						<ul class="list-group">
							<li class="list-group-item">
								<h3>Thông tin đơn hàng</h3>
							</li>
							<li class="list-group-item">
								<span class="badge"><?php echo formartprice($_SESSION['tongtien'])  ?></span>
								<strong>Số tiền</strong>
							</li>
							<li class="list-group-item">
								<span class="badge">10%</span>
								<strong>Thuế VAT</strong> 
							</li>
							<li class="list-group-item">
								<span class="badge"><?php $_SESSION['total']=$_SESSION['tongtien']*110/100;echo formartprice($_SESSION['total'])  ?></span>
								<strong>Tổng tiền thanh toán</strong>
							</li>
							<li class="list-group-item">
								<a href="index.php" class="btn  btn-success">Tiếp tục mua hàng</a>
								<a href="thanhtoan.php" class="btn  btn-success">Thanh toán</a>
							</li>
						</ul>
					</div>
                     <!-- noi dung -->
                  </section>
               </div>
     <?php require_once __DIR__. "/layouts/footer.php"; ?>  