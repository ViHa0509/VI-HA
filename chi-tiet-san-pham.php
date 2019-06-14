<?php 


		require_once __DIR__. "/autoload/autoload.php";
		$id=intval(getInput('id'));
		//chi tiết sản phẩm

		$product = $db->fetchID("product",$id);

		$cateid = $product['category_id'];
		$sql="SELECT * FROM product  WHERE category_id=$cateid ORDER BY ID DESC LIMIT 4";
		$sanphamhientheo = $db->fetchsql($sql);
		/*_debug($sanphamhientheo);*/

?>
<?php require_once __DIR__. "/layouts/header.php"; ?>
    <div class="col-md-9 bor">
        <section class="box-main1" >
                            <div class="col-md-6 text-center zoomin" style="margin-top: 20px">
                                <img src="<?php echo uploads()?>product/<?php echo $product['thunbar']?>" >
                            </div>
                            <div class="col-md-6 bor" style="margin-top: 20px;padding: 30px;">
                               <ul id="right">
                                    <li><h3><?php echo $product['name'] ?></h3></li>
                                    <li><p> Nhà sản xuât: HCV <br>Tình trạng: còn hàng <br>Trọng lượng vàng: 5.00 </p></li>
                                    <li><p><b class="price">Giá: <?php echo formartpricesale($product['price'],$product['sale']) ?></b</li>
                                    <li><a href="addcart.php?id=<?php echo $product['id']?>" class="btn btn-default"> <i class="fa fa-shopping-cart"></i>Thêm vào giỏ hàng</a></li>
                               </ul>
                            </div>

		</section>

        <div class="col-md-12" id="tabdetail">
            <div class="row">
                                    
                                <ul class="nav nav-tabs">
                                    <li class="active"><a data-toggle="tab" href="#home">Mô tả sản phẩm </a></li>
                                    <li><a data-toggle="tab" href="#menu1">Thông tin khác </a></li>
                                </ul>
                                <div class="tab-content">
                                    <div id="home" class="tab-pane fade in active">
                                        <h3>Nội dung</h3>
                                        <p><?php echo $product['content'] ?></p>
                                    </div>
                                    <div id="menu1" class="tab-pane fade">
                                        <h3> Thông tin khác </h3>
                                        <p>Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
                                </div>
            </div>
		</div>
        <h3>Sản phẩm liên quan</h3>
		<div class="col-md-12">	
			<div class="showitem" style="margin-top: 10px;margin-bottom: 10px;">
               <?php foreach($sanphamhientheo as $item): ?>
                  <div class="col-md-3 item-product bor">   
                     <a href="chi-tiet-san-pham.php?id=<?php echo $item['id']?>">
                        <img src="<?php echo uploads()?>product/<?php echo $item['thunbar']?>" class="" width="100%" height="180">
                     </a>
                     <div class="info-item">
                        <a href="chi-tiet-san-pham.php?id=<?php echo $item['id']?>"><?php echo $item['name'] ?></a>
                        <p><strike class="sale"><?php echo formartPrice($item['price']) ?></strike> <b class="price"><?php echo formartpricesale($item['price'],$item['sale']) ?></b></p>
                     </div>
                     <!--  -->
                     <div class="hidenitem">
                        <p><a href="chi-tiet-san-pham.php?id= <?php echo $item['id']?>"><i class="fa fa-search"></i></a></p>
                        <p><a href=""><i class="fa fa-heart"></i></a></p>
                        <p><a href=""><i class="fa fa-shopping-basket"></i></a></p>
                     </div>
                  </div>
               <?php endforeach ?>
            </div>
		</div>
     </div>
               </div>
<?php require_once __DIR__. "/layouts/footer.php"; ?>