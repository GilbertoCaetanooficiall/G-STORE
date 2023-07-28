<?php if (!isset($_SESSION['admin_email'])) {
    echo "<script>window.open('login.php','_self')</script>";
}else {

    if (isset($_GET['edit_cat'])) {
        $edit_c_id=$_GET['edit_cat'];
    $cat ="SELECT * FROM categories WHERE id_cat='$edit_c_id'";
    $res3=mysqli_query($con,$cat);
    while ($cat_fetch=mysqli_fetch_array($res3)) {
        $edit_cat=$cat_fetch['cat_title'];
    $edit_cat_desc=$cat_fetch['cat_desc'];
    $edit_c_top=$cat_fetch['cat_top'];
    }
         }
    ?>
<div class="row">
    <div class="col-lg-12">
        <ol class="breadcrumb">
            <li class="active">
                <i class="fa fa-dashboard"></i> Dashboard/Actualizar Categorias 
            </li>
        </ol>
    </div>
</div>

<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
              <h3 class="panel-title">
                    <i class="fa fa-pencil"></i> Actualizar Categorias 
                </h3>
            </div>
            <div class="panel-body">
                <form class="form-horizontal" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <label class="col-md-3 control-label">Título</label>
                        <div class="col-md-6">
                            <input type="text" value="<?php echo $edit_cat ;?>" name="cat" class="form-control">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">Disponiblidade :</label>
                        <div class="col-md-6">
                        <?php if ($edit_c_top=='yes') {
                            echo "<input type='radio' name='c_top' value='yes' checked>";
                        } else {
                            echo "<input type='radio' name='c_top' value='yes'";
                        }?>
                            <label for="">Yes</label>
                            <?php if ($edit_c_top=='no') {
                            echo "<input type='radio' name='c_top' value='no' checked>";
                        } else {
                            echo "<input type='radio' name='c_top' value='no'";
                        }?>
                            <label for=""> No</label>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">Descrição</label>
                        <div class="col-md-6">
                        <textarea name="desc" cols="19" rows="6" class="form-control"><?php echo $edit_cat_desc ;?></textarea>
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

   $cats= $_POST['cat'];
   $desc= $_POST['desc'];
   $top= $_POST['c_top'];

     

       //2. Create  SQL Query to insert category into databases
       $sql ="UPDATE categories SET 
         cat_title='$cats',
         cat_desc='$desc',
         cat_top='$top'
          WHERE id_cat='$edit_c_id'";

         //3. Execute the Query and Save in database
         $res=mysqli_query($con, $sql);

         //4. Check whether two query executed or not and data added or not
         if($res==true){
            //Query executed and category added
            echo "<script>alert('categria actualizada com sucesso')</script>";
            echo "<script>window.open('index.php?view_cat','_self')</script>";
           
            //Redirect to manage category page
            
        }
        else {
            
                //echo("Desculpe, verifique a query");
                //Create a ssession variable to display message
               echo " Falhou em adicionar uma nova comida.";
               
        }
}

}
?>