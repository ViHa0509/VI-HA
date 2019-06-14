            
<?php 


		require_once __DIR__. "/autoload/autoload.php";
		$search = addslashes($_GET['search']);
		$id=intval(getInput('id'));
		$sql="SELECT * FROM product  WHERE name LIKE '%$search%' ";
		
        $num = count($db->fetchsql($sql));

        $sanphamhientheo = $db->fetchsql($sql);

        if(isset($_GET['p'])){
			$p=$_GET['p'];
			}
		else {
			$p=1;
		}


		$product=$db->fetchJones("product",$sql,$num,$p,10,true);
		$sotrang = $product['page'];
		unset($product['page']);



?>
<?php require_once __DIR__. "/layouts/header.php"; ?>
               <div class="col-md-9 bor">
                  <section class="box-main1">
                    <h3 class="title-main"><a href="">Kết quả tìm kiếm cho từ khóa '<?php echo $search ?>' </a></h3>
					<div class="showitem clearfix">
						<?php foreach ($sanphamhientheo as $item):?>
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
                                    <p><a href="addcart.php?id=<?php echo $item['id']?>"><i class="fa fa-shopping-basket"></i></a></p>
                                 </div>
	                    	</div>	
						<?php endforeach ;?>
	                    
	                </div>
	                    <nav class="text-center">
	                    	<ul class="pagination">
							   <?php for ($i = 1; $i <= $sotrang ; $i++):?> 
	                    		   <li class="<?php echo isset($_GET['p']) && $_GET['p']== $i ? 'active':''?>>"><a href="<?php echo $search ?>?id=<?php  echo $id?> &&p=<?php echo $i?>"><?php echo $i; ?></a></li>      	
	                    		<?php endfor ;?>
							</ul>
	                    </nav>
					
                     <!-- noi dung -->
                  </section>
               </div>
     <?php require_once __DIR__. "/layouts/footer.php"; ?>  