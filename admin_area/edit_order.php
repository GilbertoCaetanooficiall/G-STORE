<?php if (!isset($_SESSION['admin_email'])) {
    echo "<script>window.open('login.php','_self')</script>";
}else {

    if (isset($_GET['order_id']) && isset($_GET['customer_id'])) {
        $edit_order_id=$_GET['order_id'];
         $edit_customer_id=$_GET['customer_id'];
    $term ="SELECT * FROM pending_orders WHERE order_id='$edit_order_id'";
    $res3=mysqli_query($con,$term);
    while ($term_fetch=mysqli_fetch_array($res3)) {
        $edit_order=$term_fetch['order_status'];
        $invoice_no=$term_fetch['invoice_no'];
        
        $get_customer_orders="SELECT * FROM customer_order WHERE order_id='$edit_order_id'";
        $run_customer_orders=mysqli_query($con,$get_customer_orders);
                                
        $count_c_o=mysqli_fetch_array($run_customer_orders);
         $due_amount=$count_c_o['due_amount'];
         $id_produto=$count_c_o['id_produto'];
         $payments_date=date('y-m-d h:i:sa');
         $payment_mode="OFFLINE";
         $ref_no="OFFLINE";
         $code="OFFLINE";
    }
         }
    ?>
<div class="row">
    <div class="col-lg-12">
        <ol class="breadcrumb">
            <li class="active">
                <i class="fa fa-dashboard"></i> Dashboard/Actualizar Encomendas
            </li>
        </ol>
    </div>
</div>

<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">
                    <i class="fa fa-shopping-cart"></i> Actualizar Encomendas
                </h3>
            </div>
            <div class="panel-body">
                <form class="form-horizontal" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <label class="col-md-3 control-label">Título</label>
                        <div class="col-md-6">
                           <select name="money" id="" class="form-control">
                           <option><?php echo $edit_order; ?></option>
                            <option>completo</option>
                            <option>Cancelado</option>
                           </select>
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

   $order= $_POST['money'];

     

       //2. Create  SQL Query to insert category into databases
       $sql ="UPDATE pending_orders SET 
         order_status='$order'
          WHERE order_id='$edit_order_id'";

        $sql2 ="UPDATE customer_order SET 
        order_status='$order'
        WHERE order_id='$edit_order_id'";

        $payments_date=date('y-m-d h:i:sa');
        $payment_mode="OFFLINE";
        $ref_no="OFFLINE";
        $code="OFFLINE";
        $insert_payments="INSERT INTO payments SET
        invoice_no='$invoice_no',
        due_amount=' $due_amount',
        payment_mode=' $payment_mode',
        customer_id='$edit_customer_id',
        id_produto='$id_produto',
        ref_no=' $ref_no',
        code=' $code',
        payments_date=' $payments_date'";

         //3. Execute the Query and Save in database
         $res=mysqli_query($con, $sql);
         $res2=mysqli_query($con, $sql2);
         $res3=mysqli_query($con, $insert_payments);

         //4. Check whether two query executed or not and data added or not
         if($res==true){
            //Query executed and category added
            echo "<script>alert('encomenda actualizada com sucesso')</script>";
            echo "<script>window.open('index.php?view_order','_self')</script>";
           
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