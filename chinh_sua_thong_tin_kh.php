<?php
   $open="user";
   require_once __DIR__. "/autoload/autoload.php";
   $Edituser = $db->fetchID("user", intval($_SESSION['name_id']));;
   $id=intval($_SESSION['name_id']);
//da
   /*$category = $db->fetchALL("category");*/
      
   if($_SERVER["REQUEST_METHOD"]=="POST")
   {
     
    // nh sach danh muc sp

   	 $data = 
      [
         "name"		=>postInput('name'),
         "email"	=>postInput("email"),
         "phone" 	=> postInput("phone"),
         "address" 	=>postInput("address"),
         
      ];
      $error=[];

      if(postInput("name")=='')
      {
         $error['name']="Mời bạn nhập Họ Và Tên";
      }
      if(postInput("email")=='')
      {
         $error['email']="Mời bạn nhập email";
      }       
      if(postInput("phone")=='')
      {
         $error['phone']="Mời bạn nhập số điện thoại";
      }
       if(postInput("address")=='')
      {
         $error['address']="Mời bạn nhập địa chỉ";
      }

      //error trống có nghĩa không có lỗi
      if(empty($error))
      	{
      		$id_update = $db->update("user",$data,array("id"=>$id));
	      	if ($id_update > 0) 
	      	{            
	        	echo "<script>alert('Chỉnh sửa thông tin thành công!'); location.href='thongtinkhachhang.php'</script>";
	        }
	        else 
	        {
	             echo "<script>alert('Chỉnh sửa thông tin thất bại!'); location.href='thongtinkhachhang.php'</script>";
	        }    	
	        		/*header("location: thong_bao.php");*/
       }
   }



 ?>
<?php require_once __DIR__. "/layouts/header.php"; ?>
               <div class="col-md-9 bor">
                  <section class="box-main1">
                     <h3 class="title-main"><a href="">Chỉnh sửa thông tin</a></h3>
					<form action="" method="POST" class="form-horizontal formcustom" role='form' style="margin-top: 20px">
						<div class="form-group"> 
							<label class="col-md-2 col-md-offset1">Tên </label>
							<div class="col-md-8">
								<input type="text" name="name" placeholder="Hà Chí Vĩ" class="form-control" value="<?php echo $Edituser['name']?>">
							</div>
						</div>

						<div class="form-group"> 
							<label class="col-md-2 col-md-offset1">Email</label>
							<div class="col-md-8">
								<input type="email" name="email" placeholder="Vi0509@gmail.com" class="form-control" value="<?php echo $Edituser['email']?>">
							</div>
						</div>


						<div class="form-group"> 
							<label class="col-md-2 col-md-offset1">Số điện thoại</label>
							<div class="col-md-8">
								<input type="number" name="phone" placeholder="01656019595" class="form-control" value="<?php echo $Edituser['phone']?>">
							</div>
						</div>

						<div class="form-group"> 
							<label class="col-md-2 col-md-offset1">Địa chỉ</label>
							<div class="col-md-8">
								<input type="text" name="address" placeholder="40 Hoàng Văn Thụ, P10, Q11" class="form-control" value="<?php echo $Edituser['address']?>">
							</div>
						</div>
						<input type="submit" name="submit" class="btn btn-success col-md-2 col-md-offset-5" style="margin-bottom: 20px" value="LƯU">
					</form>
                     <!-- noi dung -->
                  </section>
               </div>
     <?php require_once __DIR__. "/layouts/footer.php"; ?>  