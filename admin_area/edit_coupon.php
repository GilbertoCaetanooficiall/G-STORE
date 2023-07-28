<?php if (!isset($_SESSION['admin_email'])) {
    echo "<script>window.open('login.php','_self')</script>";
}else {

    if (isset($_GET['edit_coupon'])) {
        $edit_coupon=$_GET['edit_coupon'];
    $coupon ="SELECT * FROM coupons WHERE coupon_id='$edit_coupon'";
    $res3=mysqli_query($con,$coupon);
    while ($coupon_fetch=mysqli_fetch_array($res3)) {
        $edit_coupon_title=$coupon_fetch['coupon_title'];
        $edit_id_cat=$coupon_fetch['id_cat'];
    $edit_coupon_code=$coupon_fetch['coupon_code'];
    $edit_coupon_price=$coupon_fetch['coupon_price'];
    $coupon_used=$coupon_fetch['coupon_used'];
        $edit_coupon_limite=$coupon_fetch['coupon_limit'];
    }
    if($edit_coupon_price==0.95) {
       $edit_coupon_price="5%";
    }elseif($edit_coupon_price==0.90) {
       $edit_coupon_price="10%";
    }elseif($edit_coupon_price==0.85) {
       $edit_coupon_price="15%";
    }elseif($edit_coupon_price==0.80) {
       $edit_coupon_price="20%";
    }elseif($edit_coupon_price==0.75) {
       $edit_coupon_price="25%";
    }elseif($edit_coupon_price==0.70) {
       $edit_coupon_price="30%";
    }elseif($edit_coupon_price==0.65) {
       $edit_coupon_price="35%";
    }elseif($edit_coupon_price==0.60) {
       $edit_coupon_price="40%";
    }elseif($edit_coupon_price==0.55) {
       $edit_coupon_price="45%";
    } elseif($edit_coupon_price==0.5) {
       $edit_coupon_price="50%";
    }else {
       $edit_coupon_price="Sem desconto";
    }
    $gets_categories="SELECT * FROM categories WHERE id_cat='$edit_id_cat'";
    $res=mysqli_query($con,$gets_categories);
    while ($row=mysqli_fetch_array($res)) {
       
        $cat_title1=$row['cat_title'];
    }
}  
    ?>
<div class="row">
    <div class="col-lg-12">
        <ol class="breadcrumb">
            <li class="active">
                <i class="fa fa-dashboard"></i> Dashboard/Inserir Coupons
            </li>
        </ol>
    </div>
</div>

<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">
                    <i class="fa fa-ticket"></i> Inserir Coupons
                </h3>
            </div>
            <div class="panel-body">
                <form class="form-horizontal" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <label class="col-md-3 control-label">Título</label>
                        <div class="col-md-6">
                            <input type="text" name="coupon_title" value="<?php echo $edit_coupon_title ;?>" class="form-control" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">Codigo</label>
                        <div class="col-md-6">
                            <input type="text" name="coupon_code" value="<?php echo $edit_coupon_code ;?>"  class="form-control" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">Desconto :</label>
                        <div class="col-md-3">
                            <select name="coupon_desconto" class="form-control" required>
                            <option selected><?php echo $edit_coupon_price ;?></option>
                                <option>1%</option>
                                <option>5%</option>
                                <option>10%</option>
                                <option>15%</option>
                                <option>20%</option>
                                <option>25%</option>
                                <option>30%</option>
                                <option>35%</option>
                                <option>40%</option>
                                <option>45%</option>
                                <option>50%</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">Limite</label>
                        <div class="col-md-3">
                        <input type="number" name="coupon_limite" value="<?php echo $edit_coupon_limite ;?>"  class="form-control" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">Produtos</label>
                        <div class="col-md-3">
                            <select name="coupon_cat" class="form-control" required>
                                <option value="<?php echo $edit_id_cat ;?>"><?php echo $cat_title1 ;?></option>
                                 <?php $gets_cats="SELECT * FROM categories WHERE id_cat!='$edit_id_cat'";
                                     $res=mysqli_query($con,$gets_cats);
                                    while ($row=mysqli_fetch_array($res)) {
                                        $cats_id=$row['id_cat'];
                                         $cats_title=$row['cat_title'];
                                
                                         echo " 
                                             <option value='$cats_id'>$cats_title</option>
                                                 ";
                                     } 
                                 ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label"></label>
                        <div class="col-md-6">
                       ma     <input type="submit" value="inserir producto" name="insert" class="btn btn-primary form-control">
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script src="js/tinymce/js/tinymce/tinymce.min.js"></script>
<script>tinymce.init({selector:'textarea'});</script>

<?php
if (isset($_POST['insert'])) {

   $coupon_title= $_POST['coupon_title'];
   $coupon_code= $_POST['coupon_code'];
   $coupon_limite= $_POST['coupon_limite'];
   $coupon_desconto= $_POST['coupon_desconto'];
   $coupon_cat= $_POST['coupon_cat'];

   if ($coupon_desconto=="5%") {
    $coupon_desconto=0.95;
 }elseif ($coupon_desconto=="10%") {
    $coupon_desconto=0.90;
 }elseif ($coupon_desconto=="15%") {
    $coupon_desconto=0.85;
 }elseif ($coupon_desconto=="20%") {
    $coupon_desconto=0.80;
 }elseif ($coupon_desconto=="25%") {
    $coupon_desconto=0.75;
 }elseif ($coupon_desconto=="30%") {
    $coupon_desconto=0.70;
 }elseif ($coupon_desconto=="35%") {
    $coupon_desconto=0.65;
 }elseif ($coupon_desconto=="40%") {
    $coupon_desconto=0.60;
 }elseif ($coupon_desconto=="45%") {
    $coupon_desconto=0.55;
 }elseif ($coupon_desconto=="50%") {
    $coupon_desconto=0.5;
}else {
    $coupon_desconto=1;
    echo "<script>alert('precisa inserir um desconto')</script>";
    die();
 }
 if ($coupon_limite<=$coupon_used) {
            echo "<script>alert('Limite não pode ser inferior aos coupons usados')</script>";
            die();
 }
     

       //2. Create  SQL Query to insert productegory into databases
       $sql ="UPDATE coupons SET 
         coupon_title='$coupon_title',
         coupon_code='$coupon_code',
         coupon_limit='$coupon_limite',
         coupon_price='$coupon_desconto',
            id_cat='$coupon_cat'
         WHERE coupon_id='$edit_coupon'
         ";

         //3. Execute the Query and Save in database
         $res=mysqli_query($con, $sql);

         //4. Check whether two query executed or not and data added or not
         if($res==true){
            //Query executed and category added
            echo "<script>alert('foi adicionado novo Coupon com sucesso')</script>";
            echo "<script>window.open('index.php?view_coupon','_self')</script>";
           
            //Redirect to manage category page
            
        }
        else {
            
                //echo("Desculpe, verifique a query");
                //Create a ssession variable to display message
               echo " <script>alert('Falhou em adicionar uma novo regulamento.')</script>";
               
        }
}
}
?>