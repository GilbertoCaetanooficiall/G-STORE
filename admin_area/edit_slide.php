<?php if (!isset($_SESSION['admin_email'])) {
    echo "<script>window.open('login.php','_self')</script>";
}else {

    if (isset($_GET['edit_slide'])) {
        $edit_s_id=$_GET['edit_slide'];
    $get_slide ="SELECT * FROM slider WHERE slide_id='$edit_s_id'";
    $res3=mysqli_query($con,$get_slide);
    while ($slide_fetch=mysqli_fetch_array($res3)) {
        $edit_slide_name=$slide_fetch['name_slide'];
    $edit_slide_image=$slide_fetch['image_slide'];
    $edit_slide_link=$slide_fetch['link_slide'];
    }
         }
    ?>
<div class="row">
    <div class="col-lg-12">
        <ol class="breadcrumb">
            <li class="active">
                <i class="fa fa-dashboard"></i> Dashboard/Actualizar Slides
            </li>
        </ol>
    </div>
</div>

<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">
                    <i class="fa fa-pencil"></i> Actualizar Slides
                </h3>
            </div>
            <div class="panel-body">
                <form class="form-horizontal" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <label class="col-md-3 control-label">Nome :</label>
                        <div class="col-md-6">
                            <input type="text" name="name_slide" value="<?php echo $edit_slide_name;?>" class="form-control">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">Link :</label>
                        <div class="col-md-6">
                            <input type="text" name="link_slide" value="<?php echo $edit_slide_link;?>" class="form-control">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">Imagem :</label>
                        <div class="col-md-6">
                        <input type="file" name="image_slide" class="form-control">
                        <img src="../admin_worker_area/slides_images/<?php echo $edit_slide_image ;?>" alt="" class="img-responsive">
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

    $name_slide= $_POST['name_slide'];
    $link_slide= $_POST['link_slide'];
   $image_slide=$_FILES['image_slide']['name'];

  if (isset($_FILES['image_slide']['name'])) {
    

    $image_slide=$_FILES['image_slide']['name'];
    $src_slide=$_FILES['image_slide']['tmp_name'];
    $dst_slide="../admin_worker_area/slides_images/".$image_slide;
    $upload =move_uploaded_file($src_slide, $dst_slide);
   
    //3. Execute the Query and Save in database
  

    //4. Check whether two query executed or not and data added or not
   if ($upload==false) {
    $sql ="UPDATE slider SET 
    name_slide='$name_slide',
    link_slide='$link_slide'
     WHERE slide_id='$edit_s_id'";
       $res=mysqli_query($con, $sql);
       if($res==true){
        //Query executed and category added
        echo "<script>alert('slide actualizado com sucesso')</script>";
        echo "<script>window.open('index.php?view_slide','_self')</script>";
       
        //Redirect to manage category page
        
    }else {
        echo "<script>alert('Algo deu errado')</script>";
        echo "<script>window.open('index.php?edit_slide','_self')</script>";
      }
   }
   else {
    
    $path="../admin_worker_area/slides_images/".$edit_slide_image;
    $remove =unlink($path);
      // Novas dimensões desejadas
      $novaLargura = 1100;
      $novaAltura = 490;
      
      // Obtém as dimensões originais da imagem
      list($larguraOriginal, $alturaOriginal) = getimagesize($dst_slide);
      
      // Cria uma nova imagem com as dimensões desejadas
      $new_image_slide = imagecreatetruecolor($novaLargura, $novaAltura);
       
      // Carrega a imagem original
     switch ($image_slide) {
      case $file_sext=="jpg":
          $imagem = imagecreatefromjpeg($dst_slide);
          break;
          case $file_sext=="png":
              $imagem = imagecreatefrompng($dst_slide);
              break;
              case $file_sext=="webp":
                  $imagem = imagecreatefromwebp($dst_slide);
                  break;
      
      default:
          return false;
          die();
          break;
     }
      
      // Redimensiona a imagem para as novas dimensões
      imagecopyresampled($new_image_slide, $imagem, 0, 0, 0, 0, $novaLargura, $novaAltura, $larguraOriginal, $alturaOriginal);
      
      // Salva a nova imagem em um arquivo ou exibe no navegador
      switch ($image_slide) {
          case $file_sext=="jpg":
              imagejpeg($new_image_slide, '../admin_worker_area/slides_images/'.$image_slide);
              break;
              case  $file_sext=="png":
                  imagepng($new_image_slide, '../admin_worker_area/slides_images/'.$image_slide);
                  break;
                  case  $file_sext=="webp":
                      imagewebp($new_image_slide, '../admin_worker_area/slides_images/'.$image_slide);
                      break;
          
          default:
              return false;
              die();
              break;
         }
      
      
      // Libera a memória utilizada pelas imagens
      imagedestroy($imagem);
      imagedestroy($new_image_slide);
    $sql ="UPDATE slider SET 
    name_slide='$name_slide',
    link_slide='$link_slide',
    image_slide='$image_slide'
     WHERE slide_id='$edit_s_id'";
       $res=mysqli_query($con, $sql);
    if($res==true){
        //Query executed and category added
        echo "<script>alert('slide actualizado com sucesso')</script>";
        echo "<script>window.open('index.php?view_slide','_self')</script>";
       
        //Redirect to manage category page
        
    }
          else {
            echo "<script>alert('Algo deu errado')</script>";
            echo "<script>window.open('index.php?edit_slide','_self')</script>";
          }
          
   }

    
  } 
 
  
     

       
}

}
?>