<?php
session_start();
$active="my_account";
include("../functions/function.php");

if (!isset($_SESSION['customer_email'])) {
    echo "<script>window.open('../checkout.php','_self')</script>";
}else {
 ?>
  
  <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>G-STORE</title>
    <link rel="stylesheet" href="styles/bootstrap-337.min.css">
    <link rel="stylesheet" href="font-awsome/css/font-awesome.min.css">
    <link rel="stylesheet" href="styles/style.css">
</head>
<body>
   
   <div id="top"><!-- Top Begin -->
       
       <div class="container"><!-- container Begin -->
           
           <div class="col-md-6 offer"><!-- col-md-6 offer Begin -->
               
               <a href="#" class="btn btn-success btn-sm"><?php
               
               if (!isset($_SESSION['customer_email'])) {
                echo "Bem-vindo :";
               }else {
                    echo "". $_SESSION['customer_name']."";
                }
               ?></a>
               <a href="../cart.php"><?php items();?> Itens no carrinho </a>
               
           </div><!-- col-md-6 offer Finish -->
           
           <div class="col-md-6"><!-- col-md-6 Begin -->
               
               <ul class="menu"><!-- cmenu Begin -->
                   
                   <li>
                       <a href="../customer_register.php">Registre-se já</a>
                   </li>
                   <li  class="<?php if ($active=='my_account') {echo "active";}?>">
                       <a href="my_account.php">Minha conta</a>
                   </li>
                   <li>
                       <a href="../cart.php">carrinho</a>
                   </li>
                   <li>
                       <a href="../checkout.php"><?php
               
               if (!isset($_SESSION['customer_email'])) {
                echo "<a href='../checkout.php'>Login</a>";
               }else {
                    echo "<a href='../logout.php'>Sair</a>";
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
               
               <a href="../index.php" class="navbar-brand home"><!-- navbar-brand home Begin -->
               <img src="../images/Black_Minimalist_Fashion_Brand_Logo__3_-removebg-preview (1).png"alt="M-dev-Store Logo" class="hidden-xs">
                   <img src="../images/Black_Minimalist_Fashion_Brand_Logo__3_-removebg-preview (1).png" alt="M-dev-Store Logo Mobile" class="visible-xs">
                   
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
                       
                       <li>
                           <a href="../index.php">casa</a>
                       </li>
                       <li >
                           <a href="../shop.php">explore</a>
                       </li>
                       <li class="active">
                       <a href="my_account.php">Minha conta</a>
                       </li>
                       <li>
                           <a href="../cart.php">Carrinho</a>
                       </li>
                       <li>
                           <a href="../contact.php">entre em contacto</a>
                       </li>
                       
                   </ul><!-- nav navbar-nav left Finish -->
                   
               </div><!-- padding-nav Finish -->
               
               <a href="../cart.php" class="btn navbar-btn btn-primary right"><!-- btn navbar-btn btn-primary Begin -->
                   
                   <i class="fa fa-shopping-cart"></i>
                   
                   <span><?php items();?> Itens no carrinho </span>
                   
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
                <li><a href="index.php">HOME</a>
                </li>
                <li>
                     My Account
                 </li>
            </ul>

        </div>
        <div class="col-md-3">
            <?php
             include ("includes/sidebar.php");
             ?>
        </div>

        <div class="col-md-9">
            <div class="box">
                <?php 
                if(isset($_GET['my_orders'])){
                include("my_orders.php");
                }
                ?>
                <?php 
                if(isset($_GET['pay_offline'])){
                include("pay_offline.php");
                }
                ?>
                <?php 
                if(isset($_GET['edit_account'])){
                include("edit_account.php");
                }
                ?>
            <?php 
                if(isset($_GET['change_password'])){
                include("change_password.php");
                }
                ?>
                <?php 
                if(isset($_GET['delete_account'])){
                include("delete_account.php");
                }
                ?> 
                <?php 
                if(isset($_GET['logout'])){
                include("logout.php");
                }
                ?>
            </div>
        </div>
     </div>
    </div>


<?php include ("includes/footer.php");?>
<script src="js/jquery-331.min.js"></script>
    <script src="js/bootstrap-337.min.js"></script>
</body>
</html>

  <?php }?>