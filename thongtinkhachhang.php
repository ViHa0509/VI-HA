<?php 

		require_once __DIR__. "/autoload/autoload.php";
		$user = $db->fetchID("user", intval($_SESSION['name_id']));;

?>
<?php require_once __DIR__. "/layouts/header.php"; ?>
               <div class="col-md-9 bor">
                  <section class="box-main1">
                     <h3 class="title-main"><a href="">Thông tin khách hàng</a></h3>
					<form action="" method="POST" class="form-horizontal formcustom" role='form' style="margin-top: 20px">
						<div class="form-group"> 
							<label class="col-md-2 col-md-offset1">Tên </label>
							<div class="col-md-8">
								<input readonly="" type="text" name="name" placeholder="Hà Chí Vĩ" class="form-control" value="<?php echo $user['name']?>">
							</div>
						</div>

						<div class="form-group"> 
							<label class="col-md-2 col-md-offset1">Email</label>
							<div class="col-md-8">
								<input readonly="" type="email" name="email" placeholder="Vi0509@gmail.com" class="form-control" value="<?php echo $user['email']?>">
							</div>
						</div>


						<div class="form-group"> 
							<label class="col-md-2 col-md-offset1">Số điện thoại</label>
							<div class="col-md-8">
								<input readonly="" type="number" name="phone" placeholder="01656019595" class="form-control" value="<?php echo $user['phone']?>">
							</div>
						</div>

						<div class="form-group"> 
							<label class="col-md-2 col-md-offset1">Địa chỉ</label>
							<div class="col-md-8">
								<input readonly="" type="text" name="address" placeholder="40 Hoàng Văn Thụ, P10, Q11" class="form-control" value="<?php echo $user['address']?>">
							</div>
						</div>
						<a href="chinh_sua_thong_tin_kh.php"><input type="button" class="btn btn-info col-md-2 col-md-offset-5" style="margin-bottom: 20px" value="Sửa thông tin"></a>
					</form>
                     <!-- noi dung -->
                  </section>
               </div>
     <?php require_once __DIR__. "/layouts/footer.php"; ?>  