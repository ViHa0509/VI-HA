<?php 
		@session_start();
		require_once __DIR__. "/autoload/autoload.php";
		$user = $db->fetchID("user", intval($_SESSION['name_id']));;
		use PHPMailer\PHPMailer\PHPMailer;
		use PHPMailer\PHPMailer\Exception;

		require 'src/Exception.php';
		require 'src/PHPMailer.php';
		require 'src/SMTP.php';


		if($_SERVER["REQUEST_METHOD"]=="POST")
		{
			$data=
			[

				'amount'  	=> $_SESSION['total'],
				'user_id'  	=> $_SESSION['name_id'],
				'note'  => postInput("note")
			];

			$idtran=$db->insert("transaction",$data);
			if($idtran>0)
			{
				foreach ($_SESSION['cart'] as $key => $value)
				{
					$data2=
					[
						'transaction_id' =>$idtran,
						'product_id' 	 =>$key,
						'qty'  			 =>$value['qty'],
						'price' 		 =>$value['price']	
					];	

					$id_insert=$db->insert("orders",$data2);	
				}
				unset($_SESSION['cart']);
				unset($_SESSION['total']);
				$_SESSION['success']="Đặt hàng thành công! chúng tôi sẽ liên hệ với bạn sớm nhất!";
					header("location: thong_bao.php");
				$mail = new PHPMailer(true); 
				$mail -> charSet = "UTF-8";
				$mail->isHTML(true);                               // Passing true enables exceptions
				try {
				    //Server settings
				    $mail->SMTPDebug = 2;                                 // Enable verbose debug output
				    $mail->isSMTP();                                      // Set mailer to use SMTP
				    $mail->SMTPOptions = array(
					    'ssl' => array(
					        'verify_peer' => false,
					        'verify_peer_name' => false,
					        'allow_self_signed' => true
					    )
					);
				    $mail->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers
				    $mail->SMTPAuth = true;                               // Enable SMTP authentication
				    $mail->Username = 'ngocthamjew@gmail.com';                 // SMTP username
				    $mail->Password = 'ngoctham123';                           // SMTP password
				    $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, ssl also accepted
				    $mail->Port = 587;                                    // TCP port to connect to

				    //Recipients
				    $mail->setFrom('ngocthamjew@gmail.com', 'NTJ Company');
				    $mail->addAddress($user['email']);     // Add a recipient
				    //$mail->addAddress('ellen@example.com');               // Name is optional
				    //$mail->addReplyTo('info@example.com', 'Information');
				    //$mail->addCC('cc@example.com');
				    //$mail->addBCC('bcc@example.com');

				    //Attachments
				    //$mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
				    //$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name

				    //Content
				                                // Set email format to HTML
				    $mail->Subject = "Việc gửi hàng của bạn";
				    $mail->Body    = 'Chúng tôi đã nhận được đơn hàng của bạn!</br><b>Cảm ơn bạn đã đặt mua sản phẩm ở cửa hàng chúng tôi,quý khách vui đợi vài ngày để sản phẩm được ship tới!</b>';
				    $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

				    $mail->send();
				    echo 'Message has been sent';
					} catch (Exception $e) {
					    echo 'Message could not be sent. Mailer Error: ', $mail->ErrorInfo;
					}

					
			}	
		}

?>

<?php require_once __DIR__. "/layouts/header.php"; ?>
               <div class="col-md-9 bor">
                  <section class="box-main1">
                     <h3 class="title-main"><a href="">Thanh toán đơn hàng</a></h3>
					<form action="" method="POST" class="form-horizontal formcustom" role='form' style="margin-top: 20px">
						<div class="form-group"> 
							<label class="col-md-2 col-md-offset1">Tên thành viên</label>
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
								<input readonly="" type="number" name="phone" placeholder="69696969" class="form-control" value="<?php echo $user['phone']?>">
							</div>
						</div>

						<div class="form-group"> 
							<label class="col-md-2 col-md-offset1">Địa chỉ</label>
							<div class="col-md-8">
								<input readonly="" type="text" name="address" placeholder="40 Hoàng Văn Thụ, P10, Q11" class="form-control" value="<?php echo $user['address']?>">
							</div>
						</div>

						<div class="form-group"> 
							<label class="col-md-2 col-md-offset1">Số tiền</label>
							<div class="col-md-8">
								<input readonly="" type="text" name="address" placeholder="40 Hoàng Văn Thụ, P10, Q11" class="form-control" value="<?php echo formartprice($_SESSION['total']) ?>">
							</div>
						</div>

						<div class="form-group"> 
							<label class="col-md-2 col-md-offset1">Ghi chú</label>
							<div class="col-md-8">
								<input type="text" name="note" placeholder="Giao hàng tận nơi" class="form-control" value="">
							</div>
						</div>

						<input type="submit" name="submit" class="btn btn-success col-md-2 col-md-offset-5" style="margin-bottom: 20px" value="Thanh toán">
					</form>
                     <!-- noi dung -->
                  </section>
                  <!-- <audio controls autoplay style="display: none">
                  				    <source src="music/Thanks2.mp3" type="audio/mpeg">
                  				  	</audio> -->
               </div>
     <?php require_once __DIR__. "/layouts/footer.php"; ?>  