       

<?php 

   require_once __DIR__. "/autoload/autoload.php";

   $sqlHomecate="SELECT name , id FROM category WHERE home =1 ORDER BY update_at";
   $CategoryHome= $db->fetchsql($sqlHomecate);

   if(isset($_GET['p']))
   {
      $p=$_GET['p'];
   }
   else 
   {
      $p=1;
   }

   $data=[];

   foreach ($CategoryHome as $item) {
      $cateId=intval($item['id']);

      $sql ="SELECT * FROM product WHERE category_id=$cateId";
      $sql1= "SELECT product.*,category.name as namecate FROM product LEFT JOIN category on category.id = product.category_id";

      $total = count($db->fetchsql($sql));
      $product=$db->fetchJone("product",$sql1,$p,6,true);
      $sotrang = $product['page'];
      $productHome=$db->fetchsql($sql);
      //Khai báo mảng 2 chiều (sản phẩm ứng với mỗi danh mục )
      $data[$item['name']]=$productHome;
      $path = $_SERVER['SCRIPT_NAME'];
   }
 ?>
    <?php require_once __DIR__. "/layouts/header.php"; ?>
               <div class="col-md-9 col-sm-9 bor">
                  <section id="slide" class="text-center" >
                     <img src="<?php echo base_url() ?>public/frontend/images/banner.jpg"  width="100%">
                  </section>
                  <section class="box-main1">
                     <?php foreach ($data as $key => $value): ?>
                        <h3 class="title-main"><a href=""> <?php echo $key; ?></a> </h3>
                        <div class="showitem" style="margin-top: 10px;margin-bottom: 10px;">
                           <?php foreach($value as $item): ?>
                              <div class="col-md-3 col-sm-3 item-product bor">   
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
                                        <p><a href="addcart.php?id=<?php echo $item['id']?>"><i class="fa fa-shopping-cart"></i></a></p>
                                    </div>
                              </div>
                           <?php endforeach ?>
                        </div>
                    <?php endforeach ?>
                  </section>
               </div>
               <div class="pull-right">
                  <nav aria-label="Page navigation example">
                     <ul class="pagination">
                        <li class="page-item">
                           <a class="page-link" href="#" aria-label="Previous">
                           <span aria-hidden="true">&laquo;</span>
                           <span class="sr-only">Previous</span>
                           </a>
                        </li>

                        <?php for($i = 1; $i<= $sotrang; $i++) : ?>
                        
                        <?php 

                        if(isset($_GET['page']))
                        {

                          $p=$_GET['page']; 
                         
                        }
                        else
                        {
                           $p=1;
                        }
                        ?>
                        <li class="<?php echo($i == $p) ? 'active' : '' ?>">
                           <a href="?page= <?php echo $i;?>"><?php echo $i;?></a>
                        </li>
                        <?php endfor ?>


                        <li class="pagination">
                           <a class="page-link" href="#" aria-label="Next">
                           <span aria-hidden="true">&raquo;</span>
                           <span class="sr-only">Next</span>
                           </a>
                        </li>
                     </ul>
                  </nav>
               </div>
            </div>
     <?php require_once __DIR__. "/layouts/footer.php"; ?>       