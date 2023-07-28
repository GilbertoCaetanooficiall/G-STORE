<?php if (!isset($_SESSION['admin_email'])) {
    echo "<script>window.open('login.php','_self')</script>";
}else {
    ?>

<div class="row">
    <div class="col-lg-12">
        <ol class="breadcrumb">
            <li class="active">
            <i class="fa fa-dashboard"></i>Dashboard/ Ver Productos

            </li>
        </ol>
    </div>
</div>

<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">
                    <i class="fa fa-tags"></i> Productos                    
                </h3>

                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>ID:</th>
                                    <th>Nome:</th>
                                    <th>Imagem :</th>
                                    <th>Preço:</th>
                                    <th>Estado:</th>
                                    <th>Vendidos :</th>
                                    <th>Palavra-chave:</th>
                                    <th>Data :</th>
                                    <th>Editar :</th>
                                    <th>Apagar :</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php 
                                  $get_products="SELECT * FROM products ORDER BY 1 DESC ";
                                  $run_products=mysqli_query($con,$get_products);
                                  $n=0;
                                  
                                  while ($fetch=mysqli_fetch_assoc($run_products)) {
                                    $id_products=$fetch['id_produto'];
                                    $name_products=$fetch['product_title'];
                                    $image_products=$fetch['product_image'];
                                    $image_products2=$fetch['product_img2'];
                                    $image_products3=$fetch['product_img3'];
                                    $price_products=$fetch['product_price'];
                                    $price2_products=$fetch['product_label'];
                                    $keywords_products=$fetch['product_keywords'];
                                    $date_products=$fetch['product_date'];
                                    $n++;
                                    ?>

                                    <tr>
                                        <td><?php echo $n;?></td>
                                        <td><?php echo $name_products;?></td>
                                        <td><img src="../admin_worker_area/product_images/product_images_1/<?php echo $image_products;?>" height="60px" width="60px" class="img-responsive"></td>
                                        <td><?php echo  $price_products;?></td>
                                        <?php if ($price2_products=="promoção") {
                                            ?><td style="color:green;"><strong><?php echo  $price2_products;?></strong></td>
                                     <?php    }elseif ($price2_products=="esgotado") {?>
                                        <td style="color:darkred;"><strong><?php echo  $price2_products;?></strong></td>
                                            <?php   } else { ?>
                                                <td style="color:darkcyan;"><strong><?php echo  $price2_products;?></strong></td>
                                            <?php        }
                                        ?>
                                        <td><?php
                                        $ce=0;
                                        $get_pending_ordersa="SELECT SUM(qty) AS qty FROM pending_orders WHERE id_produto = '$id_products' AND order_status ='completo'";
                                        $run_pending_ordersa=mysqli_query($con,$get_pending_ordersa); 
                                        while (  $counta=mysqli_fetch_array($run_pending_ordersa)) {
                                            $ca=$counta['qty'];
                                        }
                                      if ($ca=="") {
                                        $ca=0;
                                        echo $ca;
                                      }else {
                                        echo $ca;
                                      }
                                      
                                        ?></td>
                                        
                                        
                                        <td width="100px"><?php echo $keywords_products;?></td>
                                        <td><a href=""></a><?php echo $date_products;?></td>
                                       <td><a href="index.php?edit_p=<?php echo $id_products;?>"><i class="fa fa-pencil"> Editar</i></a></td>
                                       <td><a href="index.php?delete_p=<?php echo $id_products. "&image1=".$image_products. "&image2=".$image_products2. "&image3=".$image_products3;?>" style="color: red; text-decoration: none;"><i class="fa fa-trash-o"> Apagar</i></a></td>
                                    </tr>

                                 <?php }?>                                
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>

    <?php }?>