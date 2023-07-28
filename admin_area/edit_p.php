<?php if (!isset($_SESSION['admin_email'])) {
    echo "<script>window.open('login.php','_self')</script>";
}else {

    if (isset($_GET['edit_p'])) {
        $edit_id=$_GET['edit_p'];
        $edit="SELECT * FROM products WHERE id_produto='$edit_id'";
        $run_edit=mysqli_query($con,$edit);
        while ($fetch_edit=mysqli_fetch_assoc($run_edit)) {
            $edit_title=$fetch_edit['product_title'];
            $edit_price=$fetch_edit['product_price'];
            $edit_price2=$fetch_edit['product_sale'];
            $edit_label=$fetch_edit['product_label'];
            $edit_keyword=$fetch_edit['product_keywords'];
            $edit_desc=$fetch_edit['product_desc'];
            $edit_image=$fetch_edit['product_image'];
            $edit_image2=$fetch_edit['product_img2'];
            $edit_image3=$fetch_edit['product_img3'];
            $p_cat=$fetch_edit['p_cat_id'];
            $cat=$fetch_edit['id_cat'];

            $gets_cats2="SELECT cat_title FROM categories WHERE id_cat='$cat'";
            $res2=mysqli_query($con,$gets_cats2);
            $cat_fetch=mysqli_fetch_array($res2);
            $edit_cat=$cat_fetch['cat_title'];

            $gets_products_cats2="SELECT p_cat_title FROM products_categories WHERE p_cat_id=' $p_cat'";
            $res3=mysqli_query($con,$gets_products_cats2);
            $p_cat_fetch=mysqli_fetch_array($res3);
            $edit_p_cat=$p_cat_fetch['p_cat_title'];
            
        }
    }
    ?>
<div class="row">
    <div class="col-lg-12">
        <ol class="breadcrumb">
            <li class="active">
                <i class="fa fa-dashboard"></i> Dashboard/ Actualizar produtos
            </li>
        </ol>
    </div>
</div>

<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">
                    <i class="fa fa-pencil"></i> Actualizar produtos
                </h3>
            </div>
            <div class="panel-body">
                <form class="form-horizontal" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <label class="col-md-3 control-label"> Título do Produto </label>
                        <div class="col-md-6">
                            <input name="product_title" type="text" value="<?php echo $edit_title;?>" class="form-control" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">Categorias</label>
                        <div class="col-md-6">
                            <select name="cat" class="form-control" required>
                                <option value="<?php echo $cat?>"><?php echo $edit_cat?></option>
                                
                                
                                <?php $gets_cats="SELECT * FROM categories";
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
                        <label class="col-md-3 control-label">Categoria de productos</label>
                        <div class="col-md-6">
                            <select name="product_cat" class="form-control" required>
                                <option value="<?php echo $p_cat?>"><?php echo   $edit_p_cat;?></option>
                                 <?php $gets_products_cats="SELECT * FROM products_categories";
                                     $res=mysqli_query($con,$gets_products_cats);
                                    while ($row=mysqli_fetch_array($res)) {
                                        $products_cats_id=$row['p_cat_id'];
                                         $products_cats_title=$row['p_cat_title'];
                                
                                         echo " 
                                             <option value='$products_cats_id' required>$products_cats_title</option>
                                                 ";
                                     } 
                                 ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">Imagens dos productos 1</label>
                        <div class="col-md-6">
                            <img src="../admin_worker_area/product_images/product_images_1/<?php echo $edit_image?>" class="img-responsive" width="70px" height="70px" alt="">
                            <br>
                            <input name="image_1" type="file" class="form-control" >
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">Imagens dos productos 2</label>
                        <div class="col-md-6">
                        <img src="../admin_worker_area/product_images/product_images_2/<?php echo $edit_image2?>" class="img-responsive" width="70px" height="70px" alt="">
                            <br>
                            <input name="image_2" type="file" class="form-control"  >
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">Imagens dos productos 3</label>
                        <div class="col-md-6">
                        <img src="../admin_worker_area/product_images/product_images_3/<?php echo $edit_image3?>" class="img-responsive" width="70px" height="70px" alt="">
                            <br>
                            <input name="image_3" type="file" class="form-control" >
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">Preço do producto</label>
                        <div class="col-md-6">
                        <input type="number" name="price" value="<?php echo $edit_price;?>" required class="form-control">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">palavra-chave do producto</label>
                        <div class="col-md-6">
                        <input type="text" name="keywords" value="<?php echo $edit_keyword;?>" required class="form-control">
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label class="col-md-3 control-label">Estado</label>
                        <div class="col-md-2">
                            <select name="label" class="form-control" required>
                                <option selected><?php  echo $edit_label;?></option>
                                <option>novo</option>
                                 <option>promoção</option>
                                 <option>esgotado</option>
                            </select>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label class="col-md-3 control-label">Em saldos?(promocional)</label>
                        <div class="col-md-3">
                        <input type="number" name="price2" value="<?php echo $edit_price2;?>" required class="form-control">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">Descrição do producto</label>
                        <div class="col-md-6">
                        <textarea name="product_desc" cols="19" rows="6" class="form-control"><?php echo $edit_desc;?></textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label"></label>
                        <div class="col-md-6">
                            <input type="submit" value="inserir producto" name="insert" class="btn btn-primary form-control">
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

    $product_title= $_POST['product_title'];
   $cats= $_POST['cat'];
   $label= $_POST['label'];
   $product_cat= $_POST['product_cat'];
   $product_price= $_POST['price'];
   $product_price2= $_POST['price2'];
   $product_keywords= $_POST['keywords'];
   $product_desc= $_POST['product_desc'];
   $product_image=$_FILES['image_1']['name'];
   $product_image2=$_FILES['image_2']['name'];
   $product_image3=$_FILES['image_3']['name'];
   $price=$product_price*0.65;
  if ($product_image=="" && $product_image2=="" && $product_image3=="") {
if ($label=="promoção" AND $product_price2==0 || $product_price2=="" || $product_price2>=$product_price) {
    echo "<script>alert('Deve estipular o preço em promoção não maior ou igual ao preço real')</script>";
    echo "<script>window.open('index.php?edit_p=$edit_id','_self')</script>";
       
      die();
}elseif($label=="promoção" AND $product_price2<=$price){
    echo "<script>alert('o valor em promoção não deve ser maior ou igual a 45%')</script>";
    echo "<script>window.open('index.php?edit_p=$edit_id','_self')</script>";
       
      die();
}elseif ($label=="novo" || $label=="esgotado") {
    $product_price2=0;
}

$sql2 ="UPDATE products SET 
product_title='$product_title',
p_cat_id='$product_cat',
id_cat='$cats',
product_label='$label',
product_price='$product_price',
product_sale='$product_price2',
product_sale='$product_price2',
product_desc='$product_desc',
product_keywords='$product_keywords'
WHERE id_produto='$edit_id'
";
$res2=mysqli_query($con, $sql2);

//4. Check whether two query executed or not and data added or not
if($res2==true){
   //Query executed and category added
   echo "<script>alert('foi actualizado um novo producto com sucesso')</script>";
   echo "<script>window.open('index.php?view_products','_self')</script>";
  die();
   //Redirect to manage category page
   
}

   

   
  }

    if (isset($_FILES['image_1']['name']) || isset($_FILES['image_2']['name']) || isset($_FILES['image_3']['name'])) {
        $path ="../admin_worker_area/product_images/product_images_1/".$edit_image;
        $path2 ="../admin_worker_area/product_images/product_images_2/".$edit_image2;
        $path3 ="../admin_worker_area/product_images/product_images_3/".$edit_image3;
     
        
        
        //upload image
        //to upload image we need  image name, source path and destination path
        $product_image=$_FILES['image_1']['name'];
        $product_image2=$_FILES['image_2']['name'];
        $product_image3=$_FILES['image_3']['name'];
       
       //Get the extesion of our image(jpg,png, gift etc)
       $sext = explode(".", $product_image);
        $file_ext = end($sext);
        $sext_2= explode(".", $product_image2);
        $file_ext_2 = end($sext_2);
       $sext_3 = explode(".", $product_image3);
        $file_ext_3 = end($sext_3);


       //rename the image
       $product_image ="1_fotos_de_produtos_".rand(000,999).".".$file_ext;
       $product_image2 ="2_fotos_de_produtos_".rand(000,999).".".$file_ext_2;
       $product_image3 ="3_fotos_de_produtos_".rand(000,999).".".$file_ext_3;

       $src=$_FILES['image_1']['tmp_name'];
       $src2=$_FILES['image_2']['tmp_name'];
       $src3=$_FILES['image_3']['tmp_name'];
       $dst="../admin_worker_area/product_images/product_images_1/".$product_image;
       $dst2="../admin_worker_area/product_images/product_images_2/".$product_image2;
       $dst3="../admin_worker_area/product_images/product_images_3/".$product_image3;
      
       //finally uploaded the image 
       $upload =move_uploaded_file($src, $dst);
       $upload2 =move_uploaded_file( $src2, $dst2);
       $upload3 =move_uploaded_file( $src3, $dst3);
        //Check Whether the image is uploaded or not
        //and if the image is not uploaded then we will stop the process and redirect with erro message
        $novaLargura = 500;
        $novaAltura = 500;
        
        // Obtém as dimensões originais da imagem
       if ($upload==true) {
        list($larguraOriginal, $alturaOriginal) = getimagesize($dst);
        
        // Cria uma nova imagem com as dimensões desejadas
        $new_product_image = imagecreatetruecolor($novaLargura, $novaAltura);
         
        // Carrega a imagem original
       switch ($product_image) {
        case $file_ext=="jpg":
            $imagem = imagecreatefromjpeg($dst);
            break;
            case $file_ext=="png":
                $imagem = imagecreatefrompng($dst);
                break;
                case $file_ext=="webp":
                    $imagem = imagecreatefromwebp($dst);
                    break;
        
        default:
            return false;
            die();
            break;
       }
        
        // Redimensiona a imagem para as novas dimensões
        imagecopyresampled($new_product_image, $imagem, 0, 0, 0, 0, $novaLargura, $novaAltura, $larguraOriginal, $alturaOriginal);
        
        // Salva a nova imagem em um arquivo ou exibe no navegador
        switch ($product_image) {
            case $file_ext=="jpg":
                imagejpeg($new_product_image, '../admin_worker_area/product_images/product_images_1/'.$product_image);
                break;
                case  $file_ext=="png":
                    imagepng($new_product_image, '../admin_worker_area/product_images/product_images_1/'.$product_image);
                    break;
                    case  $file_ext=="webp":
                        imagewebp($new_product_image, '../admin_worker_area/product_images/product_images_1/'.$product_image);
                        break;
            
            default:
                return false;
               
           }
        
        
        // Libera a memória utilizada pelas imagens
        imagedestroy($imagem);
        imagedestroy($new_product_image);
       }
            if ($upload2==true) {
                $dst2="../admin_worker_area/product_images/product_images_2/".$product_image2;
        
                list($larguraOriginal2, $alturaOriginal2) = getimagesize($dst2);
         
                // Cria uma nova imagem com as dimensões desejadas
                $new_product_image2 = imagecreatetruecolor($novaLargura, $novaAltura);
                
                // Carrega a imagem original
                switch ($product_image2) {
                 case $file_ext_2=="jpg":
                     $imagem2 = imagecreatefromjpeg($dst2);
                     break;
                     case $file_ext_2=="png":
                         $imagem2 = imagecreatefrompng($dst2);
                         break;
                         case $file_ext_2=="webp":
                             $imagem2 = imagecreatefromwebp($dst2);
                             break;
                 
                 default:
                     return false;
                     die();
                     break;
                }
                
                // Redimensiona a imagem para as novas dimensões
                imagecopyresampled($new_product_image2, $imagem2, 0, 0, 0, 0, $novaLargura, $novaAltura, $larguraOriginal2, $alturaOriginal2);
                
                // Salva a nova imagem em um arquivo ou exibe no navegador
                switch ($product_image2) {
                 case $file_ext_2=="jpg":
                      imagejpeg($new_product_image2, '../admin_worker_area/product_images/product_images_2/'.$product_image2);
                     break;
                     case  $file_ext_2=="png":
                         imagepng($new_product_image2, '../admin_worker_area/product_images/product_images_2/'.$product_image2);
                         break;
                         case  $file_ext_2=="webp":
                             imagewebp($new_product_image2, '../admin_worker_area/product_images/product_images_2/'.$product_image2);
                             break;
                 
                 default:
                     return false;
                     die();
                     break;
                }
                
                // Libera a memória utilizada pelas imagens
                imagedestroy($imagem2);
                imagedestroy($new_product_image2);
            }
        
             if ($upload3==true) {
                $dst3="../admin_worker_area/product_images/product_images_3/".$product_image3;
        
                list($larguraOriginal3, $alturaOriginal3) = getimagesize($dst3);
         
                // Cria uma nova imagem com as dimensões desejadas
                $new_product_image3 = imagecreatetruecolor($novaLargura, $novaAltura);
                
                // Carrega a imagem original
                switch ($product_image3) {
                 case $file_ext_3=="jpg":
                     $imagem3 = imagecreatefromjpeg($dst3);
                     break;
                     case $file_ext_3=="png":
                         $imagem3 = imagecreatefrompng($dst3);
                         break;
                         case $file_ext_3=="webp":
                             $imagem3 = imagecreatefromwebp($dst3);
                             break;
                 
                 default:
                     return false;
                     die();
                     break;
                }
               
                
                // Redimensiona a imagem para as novas dimensões
                imagecopyresampled($new_product_image3, $imagem3, 0, 0, 0, 0, $novaLargura, $novaAltura, $larguraOriginal3, $alturaOriginal3);
                
                // Salva a nova imagem em um arquivo ou exibe no navegador
                switch ($product_image3) {
                 case $file_ext_3=="jpg":
                     imagejpeg($new_product_image3, '../admin_worker_area/product_images/product_images_3/'.$product_image3);
                     break;
                     case  $file_ext_3=="png":
                         imagepng($new_product_image3, '../admin_worker_area/product_images/product_images_3/'.$product_image3);
                         break;
                         case  $file_ext_3=="webp":
                             imagewebp($new_product_image3, '../admin_worker_area/product_images/product_images_3/'.$product_image3);
                             break;
                 
                       default:
                         return false;
                     die();
                     break;
                }
                
                // Libera a memória utilizada pelas imagens
                imagedestroy($imagem3);
                imagedestroy($new_product_image3);
             }
       
       
       if ($upload==TRUE && $upload2 == false && $upload3 == false) {
         $remove =unlink($path);
    $sql2 ="UPDATE products SET 
    product_title='$product_title',
    p_cat_id='$product_cat',
    id_cat='$cats',
    product_label='$label',
    product_price='$product_price',
    product_sale='$product_price2',
    product_sale='$product_price2',
    product_image='$product_image',
    product_desc='$product_desc',
    product_keywords='$product_keywords'
     WHERE id_produto='$edit_id'
    ";
    $res2=mysqli_query($con, $sql2);

    //4. Check whether two query executed or not and data added or not
    if($res2==true){
       //Query executed and category added
       echo "<script>alert('foi actualizado um novo producto com sucesso')</script>";
       echo "<script>window.open('index.php?view_products','_self')</script>";
      die();
       //Redirect to manage category page
       
   }
} if ($upload2==TRUE && $upload== false && $upload3 == false) {
      $remove2 =unlink($path2);
$sql2 ="UPDATE products SET 
product_title='$product_title',
p_cat_id='$product_cat',
id_cat='$cats',
product_label='$label',
product_price='$product_price',
product_sale='$product_price2',
product_sale='$product_price2',
product_img2='$product_image2',
product_desc='$product_desc',
product_keywords='$product_keywords'
 WHERE id_produto='$edit_id'
";
$res2=mysqli_query($con, $sql2);

//4. Check whether two query executed or not and data added or not
if($res2==true){
   //Query executed and category added
   echo "<script>alert('foi actualizado um novo producto com sucesso')</script>";
   echo "<script>window.open('index.php?view_products','_self')</script>";
  die();
   //Redirect to manage category page
   
}
} if ($upload3==TRUE && $upload2== false && $upload == false) {
      $remove3 =unlink($path3);
$sql2 ="UPDATE products SET 
product_title='$product_title',
p_cat_id='$product_cat',
id_cat='$cats',
product_label='$label',
product_price='$product_price',
product_sale='$product_price2',
product_desc='$product_desc',
product_sale='$product_price2',
product_img3='$product_image3',
product_keywords='$product_keywords'
WHERE id_produto='$edit_id'
";
$res2=mysqli_query($con, $sql2);

//4. Check whether two query executed or not and data added or not
if($res2==true){
//Query executed and category added
echo "<script>alert('foi actualizado um novo producto com sucesso')</script>";
echo "<script>window.open('index.php?view_products','_self')</script>";
die();
//Redirect to manage category page

}
}elseif($upload  == TRUE && $upload2==TRUE && $upload3 == false) {
     $remove =unlink($path);
      $remove2 =unlink($path2);
$sql2 ="UPDATE products SET 
product_title='$product_title',
p_cat_id='$product_cat',
id_cat='$cats',
product_label='$label',
product_price='$product_price',
product_sale='$product_price2',
product_sale='$product_price2',
product_image='$product_image',
product_img2='$product_image2',
product_desc='$product_desc',
product_keywords='$product_keywords'
WHERE id_produto='$edit_id'
";
$res2=mysqli_query($con, $sql2);

//4. Check whether two query executed or not and data added or not
if($res2==true){
   //Query executed and category added
   echo "<script>alert('foi actualizado um novo producto com sucesso')</script>";
   echo "<script>window.open('index.php?view_products','_self')</script>";
  die();
   //Redirect to manage category page
   
}
} if ($upload==false && $upload2  == TRUE && $upload3 == true) {
      $remove2 =unlink($path2);
      $remove3 =unlink($path3);
$sql2 ="UPDATE products SET 
product_title='$product_title',
p_cat_id='$product_cat',
id_cat='$cats',
product_label='$label',
product_price='$product_price',
product_sale='$product_price2',
product_sale='$product_price2',
product_img2='$product_image2',
product_img3='$product_image3',
product_desc='$product_desc',
product_keywords='$product_keywords'
WHERE id_produto='$edit_id'
";
$res2=mysqli_query($con, $sql2);

//4. Check whether two query executed or not and data added or not
if($res2==true){
//Query executed and category added
echo "<script>alert('foi actualizado um novo producto com sucesso')</script>";
echo "<script>window.open('index.php?view_products','_self')</script>";
die();
//Redirect to manage category page
}

}if ($upload  == TRUE && $upload3== true && $upload2== false ) {
     $remove =unlink($path);
      $remove3 =unlink($path3);
$sql2 ="UPDATE products SET 
product_title='$product_title',
p_cat_id='$product_cat',
id_cat='$cats',
product_label='$label',
product_price='$product_price',
product_sale='$product_price2',
product_sale='$product_price2',
product_image='$product_image',
product_img3='$product_image3',
product_desc='$product_desc',
product_keywords='$product_keywords'
WHERE id_produto='$edit_id'
";
$res2=mysqli_query($con, $sql2);

//4. Check whether two query executed or not and data added or not
if($res2==true){
//Query executed and category added
echo "<script>alert('foi actualizado um novo producto com sucesso')</script>";
echo "<script>window.open('index.php?view_products','_self')</script>";
die();
//Redirect to manage category page

}

}
    
      
     
    }
    if ($label=="promoção" AND $product_price2==0 || $product_price2==$product_price || $product_price2=="") {
        echo "<script>alert('Deve estipular o valor em promoção')</script>";
           
          die();
    }elseif ($label=="novo" || $label=="esgotado") {
        $product_price2=0;
    }
          //2. Create  SQL Query to insert category into databases
          $remove =unlink($path);
          $remove2 =unlink($path2);
          $remove3 =unlink($path3);
     $sql2 ="UPDATE products SET 
       product_title='$product_title',
       p_cat_id='$product_cat',
       id_cat='$cats',
       product_label='$label',
       product_price='$product_price',
       product_sale='$product_price2',
       product_image='$product_image',
       product_img2='$product_image2',
       product_img3='$product_image3',
       product_desc='$product_desc',
       product_keywords='$product_keywords'
        WHERE id_produto='$edit_id'
       ";

       //3. Execute the Query and Save in database
       $res2=mysqli_query($con, $sql2);

       //4. Check whether two query executed or not and data added or not
       if($res2==true){
          //Query executed and category added
          echo "<script>alert('foi actualizado um novo producto com sucesso')</script>";
          echo "<script>window.open('index.php?view_products','_self')</script>";
         
          //Redirect to manage category page
          
      }
      else {
          echo "<script>alert(' Falhou em actualizar o produto')</script>";
              //echo("Desculpe, verifique a query");
              //Create a ssession variable to display message
             
             
      }
    
     
}

}

?>