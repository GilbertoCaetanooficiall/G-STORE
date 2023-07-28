<?php 
        session_start();
    include ("includes/db.php");
   include("functions/function.php");
        
   ?>

<?php
if (isset($_GET['id_produto'])) {
    $produto_id=$_GET['id_produto'];
    $sql="SELECT * FROM products WHERE id_produto='$produto_id'";
    $res=mysqli_query($con,$sql);
    $rows=mysqli_fetch_array($res);
    $p_cat_id=$rows['p_cat_id'];
    $product_title=$rows['product_title'];
    $product_desc=$rows['product_desc'];
    $product_price=$rows['product_price'];
    $product_label=$rows['product_label'];
    $product_sale=$rows['product_sale'];
    $product_image=$rows['product_image'];
    $product_img2=$rows['product_img2'];
    $product_img3=$rows['product_img3'];
    $id_cat=$rows['id_cat'];
    $p_cat_id=$rows['p_cat_id'];
    
    $sql2="SELECT * FROM products_categories WHERE p_cat_id='$p_cat_id'";
    $res2=mysqli_query($con,$sql2);
    $row=mysqli_fetch_array($res2);
    $p_cat_title=$row['p_cat_title'];

    if ($product_label=="") {
        # code...
    } else {
        $pro_label="<a href='details.php?id_produto=$produto_id' class='label $product_label'>
        <div class='theLabel'>$product_label</div>
        <div class='labelBackground'></div>
        </a>";
    }

    if ($product_sale==0) {
        $pro_sale=$product_price;
    } else {
        $pro_sale="Preço Real:<i style='color:red;'><del>$product_price </del></i></br>Em promoção: $product_sale";
    }
}

?>

<!DOCTYPE html>
<html lang="pt-ao">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>G-STORE</title>
    <link rel="stylesheet" href="styles/bootstrap-337.min.css">
    <link rel="stylesheet" href="font-awsome/css/font-awesome.min.css">
    <link rel="stylesheet" href="styles/style.css">
    <link rel="shortcut icon" href="images/Black_Minimalist_Fashion_Brand_Logo__3_-removebg-preview-_1_.ico" type="image/x-icon">
</head>
<body>
   
   <div id="top"><!-- Top Begin -->
       
       <div class="container"><!-- container Begin -->
           
           <div class="col-md-6 offer"><!-- col-md-6 offer Begin -->
           <?php
               
               if (!isset($_SESSION['customer_email'])) {
                echo "<a href='#' class='btn btn-success btn-sm'>Bem-vindo :</a>";
                echo "<a href='#'> Itens no carrinho </a>";

               }
               else {
                    echo " <a href='#'  class='btn btn-success btn-sm'>".$_SESSION['customer_email']."</a>";
                    echo "<a href='checkout.php'> ".items()." Itens no carrinho  </a>";
                }
                
               ?>
               
              
               
           </div><!-- col-md-6 offer Finish -->
           
           <div class="col-md-6"><!-- col-md-6 Begin -->
               
               <ul class="menu"><!-- cmenu Begin -->
                   
                   <li>
                       <a href="customer_register.php">Registre-se já</a>
                   </li>
                   <li>
                      <?php
                       if (isset($_SESSION['customer_email'])) {
                        echo "<a href='customer/my_account.php'>Minha conta</a>";
                       }else {
                        echo "<a href='checkout.php'>Minha conta</a>";
                       }?>
                   </li>
                   <li>
                       <a href="cart.php">carrinho</a>
                   </li>
                   <li>
                       <a href="checkout.php"><?php
               
               if (!isset($_SESSION['customer_email'])) {
                echo "<a href='checkout.php'>Login</a>";
               }else {
                    echo "<a href='logout.php'>Sair</a>";
                }
               ?></a>
                   </li>
                   
               </ul><!-- menu Finish -->
               
           </div><!-- col-md-6 Finish -->
           
       </div><!-- container Finish -->
       
   </div><!-- Top Finish -->
   
   <div id="navbar" class="navbar navbar-default"><!-- navbar navbar-default Begin -->
       
       <div class="container"><!-- container Begin -->
           
           <div class="navbar-header"><!-- navbar-header Begin -->
               
               <a href="index.php" class="navbar-brand home"><!-- navbar-brand home Begin -->
                   
               <img src="images/Black_Minimalist_Fashion_Brand_Logo__3_-removebg-preview (1).png"alt="M-dev-Store Logo" class="hidden-xs">
                   <img src="images/Black_Minimalist_Fashion_Brand_Logo__3_-removebg-preview (1).png" alt="M-dev-Store Logo Mobile" class="visible-xs">
                   
               </a><!-- navbar-brand home Finish -->
               
               <button class="navbar-toggle" data-toggle="collapse" data-target="#navigation">
                   
                   <span class="sr-only">Toggle Navigation</span>
                   
                   <i class="fa fa-align-justify"></i>
                   
               </button>
               
               <button class="navbar-toggle" data-toggle="collapse" data-target="#search">
                   
                   <span class="sr-only">Toggle Search</span>
                   
                   <i class="fa fa-search"></i>
                   
               </button>
               
           </div><!-- navbar-header Finish -->
           
           <div class="navbar-collapse collapse" id="navigation"><!-- navbar-collapse collapse Begin -->
               
               <div class="padding-nav"><!-- padding-nav Begin -->
                   
                   <ul class="nav navbar-nav left"><!-- nav navbar-nav left Begin -->
                       
                       <li class="<?php if ($active=='Home') {echo 'active';}?>">
                           <a href="index.php">casa</a>
                       </li>
                       <li class="<?php if ($active=='Shop') {echo "active";}?>">
                           <a href="shop.php">Explore</a>
                       </li>
                       <li class="<?php if ($active=='my_account') {echo "active";}?>">
                       <?php
                       if (isset($_SESSION['customer_email'])) {
                        echo "<a href='customer/my_account.php'>Minha conta</a>";
                       }else {
                        echo "<a href='checkout.php'>Minha conta</a>";
                       }?>
                       </li>
                       <li class="<?php if ($active=='Shopping Cart') {echo "active";}?>">
                           <a href="cart.php">Carrinho</a>
                       </li>
                       <li class="<?php if ($active=='Contact Us') {echo "active";}?>">
                           <a href="contact.php">Entre em contacto</a>
                       </li>
                       
                   </ul><!-- nav navbar-nav left Finish -->
                   
               </div><!-- padding-nav Finish -->
               
               <a href="cart.php" class="btn navbar-btn btn-primary right"><!-- btn navbar-btn btn-primary Begin -->
                   
                   <i class="fa fa-shopping-cart"></i>
                   
                   <span><?php items(); ?> Itens no carrinho </span>
                   
               </a><!-- btn navbar-btn btn-primary Finish -->
               
               <div class="navbar-collapse collapse right"><!-- navbar-collapse collapse right Begin -->
                   
                   <button class="btn btn-primary navbar-btn" type="button" data-toggle="collapse" data-target="#search"><!-- btn btn-primary navbar-btn Begin -->
                       
                       <span class="sr-only">Toggle Search</span>
                       
                       <i class="fa fa-search"></i>
                       
                   </button><!-- btn btn-primary navbar-btn Finish -->
                   
               </div><!-- navbar-collapse collapse right Finish -->
               
               <div class="collapse clearfix" id="search"><!-- collapse clearfix Begin -->
                   
                   <form method="get" action="results.php" class="navbar-form"><!-- navbar-form Begin -->
                       
                       <div class="input-group"><!-- input-group Begin -->
                           
                           <input type="text" class="form-control" placeholder="Search" name="user_query" required>
                           
                           <span class="input-group-btn"><!-- input-group-btn Begin -->
                           
                           <button type="submit" name="search" value="Search" class="btn btn-primary"><!-- btn btn-primary Begin -->
                               
                               <i class="fa fa-search"></i>
                               
                           </button><!-- btn btn-primary Finish -->
                           
                           </span><!-- input-group-btn Finish -->
                           
                       </div><!-- input-group Finish -->
                       
                   </form><!-- navbar-form Finish -->
                   
               </div><!-- collapse clearfix Finish -->
               
           </div><!-- navbar-collapse collapse Finish -->
           
       </div><!-- container Finish -->
       
   </div><!-- navbar navbar-default Finish -->


  <div id="content">
        <div class="container">
            <div class="col-md-12">

                <ul class="breadcrumb">
                     <li><a href="index.php">CASA</a></li>
                     <li>Comprando</li>
                     <li>
                    <a href="shop.php?p_cat=<?php echo $p_cat_id; ?>"><?php echo $p_cat_title; ?></a>
                 </li>
                 <li> <?php echo $product_title; ?></li>
                </ul>

           </div>
           <div class="col-md-12">
            <div id="productMain" class="row">
                <div class="col-sm-6">
                    <div id="mainImage">
                        <div id="myCarousel" class="carousel slide" data-ride="carousel">
                            <ol class="carousel-indicators">
                                <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                                <li data-target="#myCarousel" data-slide-to="1"></li>
                                <li data-target="#myCarousel" data-slide-to="2"></li>
                            </ol>
                            <div class="carousel-inner">
                                <div class="item active">
                                    <center><img  src="admin_worker_area/product_images/product_images_1/<?php echo $product_image;?>" alt="product 3-a"height="400px" width="400px"></center>
                                </div>
                                <div class="item">
                                    <center><img src="admin_worker_area/product_images/product_images_2/<?php echo $product_img2;?>" alt="product 3-b" height="400px" width="400px"></center>
                                </div>
                                <div class="item">
                                    <center><img src="admin_worker_area/product_images/product_images_3/<?php echo $product_img3;?>" alt="product 3-c"height="400px" width="400px"></center>
                                </div>
                            </div>
                            <a href="#myCarousel" class="left carousel-control" data-slide="prev">
                                <span class="glyphicon glyphicon-chevron-left"></span>
                                <span class="sr-only">Previous</span>
                            </a>
                            <a href="#myCarousel" class="right carousel-control" data-slide="next">
                                <span class="glyphicon glyphicon-chevron-right"></span>
                                <span class="sr-only">Next</span>
                            </a>
                        </div>
                    </div>
                    <?php echo $pro_label;?>  
                </div>
                
               <div class="col-sm-6">
                 <div class="box">
                    <h1 class="text center"><?php echo $product_title;?> </h1>
                    
                    <form class="form-horizontal" method="POST">
                        <div class="form-group">
                            <label for="" class="col-md-5 control-label">Quantidade de produtos</label>
                            <div class="col-md-5">
                                <input type="number" name="product_qty" class="form-control" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-5 control-label">Tamanho do produto</label>
                            <div class="col-md-5">
                                <select name="product_size" class="form-control" required oninput="SetCustomValidity('')"
                                oninvalid="SetCustomValidity('precisa de ter pelo menos um par selecionado')" >
                                <option value="" disabled selected>selecione o tamanho</option>
                                <option>Pequeno</option>
                                <option>Médio</option>
                                <option>Grande</option>
                                </select>
                            </div>
                        </div>
                        <p class="price"><?php echo $pro_sale;?> KZ</p>
                        <input type="hidden" name="id_cat" value="<?php echo $id_cat?>">
                        <input type="hidden" name="pro_sale" value="<?php  if ($product_sale==0) {
                          echo  $product_price;
                        } else {
                            echo    $product_sale;
                        }
                        ?>">
                        <p class="text-center button">
                            <button  type="submit" name="add_cart"<?php if ($product_label=="esgotado"){echo "disabled";} ?> class="btn btn-primary i fa fa-shopping-cart">
                                 adicionar ao carrinho
                                </button></p>
                    </form>
                    <?php if (isset($_POST['add_cart'])) {
                        if (!isset($_SESSION['customer_email'])) {
                            $ip=0;   
                        }else {
                            $customer_email=$_SESSION['customer_email'];
                            $select_cart="SELECT * FROM customer WHERE customer_email='$customer_email'";
                            $res2=mysqli_query($con,$select_cart);
                            while ($fetch=mysqli_fetch_array($res2)) {
                            $ip=$fetch['customer_id'];
                            }
                            }
                                $ip;
                                $ip_add=getRealIpUser();
                                $p_id=$_GET['id_produto'];
                                $product_qty=$_POST['product_qty'];
                                $pro_sale=$_POST['pro_sale'];
                                $product_size=$_POST['product_size'];
                                $id_cat=$_POST['id_cat'];
                                $total=$pro_sale*$product_qty;
                                $check_products="SELECT * FROM cart WHERE ip_add='$ip_add' AND id_produto='$p_id'";
                                $res=mysqli_query($con,$check_products);
                                if (mysqli_num_rows($res)>0) {
                                    echo "<script>alert('Este produto já foi adicionado ao carrinho')</script>";
                                    echo "<script>window.open('details.php?id_produto=$p_id','_self')</script>";
                        }
                        else {
                            
                            $sql="INSERT INTO cart SET
                            id_produto='$p_id',
                            customer_id='$ip',
                            ip_add='$ip_add',
                            id_cat='$id_cat',
                            qty='$product_qty',
                            product_price='$pro_sale',
                            total='$total',
                            size='$product_size'";
                            $res=mysqli_query($con,$sql);    
                            echo "<script>alert('Seu produto foi adicionado ao carrinho')</script>";
                            echo "<script>window.open('cart.php','_self')</script>";
                        }
                    }?>
                </div>
                    
                <div class="row" id="thumbs">
                    <div class="col-xs-4">
                        <a data-target="#myCarousel" data-slide-to="0" class="thumb">
                            <img  src="admin_worker_area/product_images/product_images_1/<?php echo $product_image;?>" alt="product 3-a" class="img-responsive">
                        </a>
                    </div>
                    <div class="col-xs-4">
                        <a data-target="#myCarousel" data-slide-to="1" class="thumb">
                            <img src="admin_worker_area/product_images/product_images_2/<?php echo $product_img2;?>" alt="product 3-b" class="img-responsive">
                        </a>
                    </div>
                    <div class="col-xs-4">
                        <a data-target="#myCarousel" data-slide-to="2" class="thumb">
                            <img src="admin_worker_area/product_images/product_images_3/<?php echo $product_img3;?>" alt="product 3-c" alt="" class="img-responsive">
                        </a>
                    </div>
                </div>
                
               </div>
            </div>

            <div class="box" id="details">
                     <h4>Detalhes do produto</h4>
                 <p>
                   <?php echo $product_desc;?>
                </p>
                <h4>Tamanho</h4>
                <ul>
                    <li>Pequeno</li>
                    <li>Médio</li>
                    <li>Largo</li>
                    <hr>
                </ul>
            </div>
            <div id="row same-heigth-row">
                <div class="col-md-3 col-sm-6">
                    <div class="box same heigth headline">
                        <h3 class="text-center">Produtos que talvez possas gostar</h3>
                    </div>
                </div>
                <?php 
                 
                    $esc=$_GET['id_produto'];
                    $sql="SELECT * FROM products WHERE id_produto !='$esc' AND p_cat_id='$p_cat_id' ORDER BY RAND() LIMIT 0,3 ";
                    $res=mysqli_query($con,$sql);
                    while ($rows=mysqli_fetch_array($res)) {
                        $product_id=$rows['id_produto'];
                        $product_price=$rows['product_price'];
                        $product_label=$rows['product_label'];
                        $product_sale=$rows['product_sale'];
                        $product_image=$rows['product_image'];
                        $product_title=$rows['product_title'];
                        if ($product_label=="") {
                            $product_label="novo";
                        } else {
                            $pro_label="<a href='details.php?id_produto=$product_id' class='label $product_label'>
                            <div class='theLabel'>$product_label</div>
                            <div class='labelBackground'></div>
                            </a>";
                        } if ($product_sale==0) {
                            $prod_sale=$product_price;
                        } else {
                            $prod_sale="<i style='color:red;'><del>$product_price </del></i>/$product_sale";
                        }
                 
                ?>
                    <div class="col-md-3 col-sm-6 center-resposive">
                    <div class="product same-heigth">
                        
                        <a href="details.php?id_produto=<?php echo $product_id;?>">
                            <img src="admin_worker_area/product_images/product_images_1/<?php echo $product_image;?>" width="100%" class="img-responsive">
                        </a>
                        <div class="text">
                            <h3><a href="details.php?id_produto=<?php echo $product_id;?>" style="text-decoration: none;"><?php echo $product_title; ?></h3>
                            <P class="price"><strong><?php echo $prod_sale;?>KZ</strong> </P>
                            </a>
                        </div>
                    </div>
                    <?php echo $pro_label;?>
                </div>
                <?php
            }    
            
                    ?>
                

            </div>
        </div>
    </div>
  </div>


<?php include ("includes/footer.php");?>
<script src="js/jquery-331.min.js"></script>
    <script src="js/bootstrap-337.min.js"></script>