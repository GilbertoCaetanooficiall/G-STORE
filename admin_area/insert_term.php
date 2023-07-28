<?php if (!isset($_SESSION['admin_email'])) {
    echo "<script>window.open('login.php','_self')</script>";
}else {

    ?>
<div class="row">
    <div class="col-lg-12">
        <ol class="breadcrumb">
            <li class="active">
                <i class="fa fa-dashboard"></i> Dashboard/Actualizar Categorias Produtos
            </li>
        </ol>
    </div>
</div>

<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">
                    <i class="fa fa-pencil"></i> Actualizar Categorias Produtos
                </h3>
            </div>
            <div class="panel-body">
                <form class="form-horizontal" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <label class="col-md-3 control-label">Título</label>
                        <div class="col-md-6">
                            <input type="text" name="term_title" class="form-control" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">ID :</label>
                        <div class="col-md-6">
                            <input type="text"  name="term_link" class="form-control" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">Descrição</label>
                        <div class="col-md-6">
                        <textarea name="term_desc" cols="19" rows="6" class="form-control" required></textarea>
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

   $term_title= $_POST['term_title'];
   $term_link= $_POST['term_link'];
   $term_desc= $_POST['term_desc'];

     

       //2. Create  SQL Query to insert category into databases
       $sql ="INSERT INTO terms SET 
         term_title='$term_title',
         term_desc='$term_desc',
         term_link='$term_link'
         ";

         //3. Execute the Query and Save in database
         $res=mysqli_query($con, $sql);

         //4. Check whether two query executed or not and data added or not
         if($res==true){
            //Query executed and category added
            echo "<script>alert('foi adicionado novo regulamento com sucesso')</script>";
            echo "<script>window.open('index.php?view_term','_self')</script>";
           
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