<center>
    <h1>Minhas encomendas</h1>
    <p class="lead">Suas encomendas num único lugar</p>
    <p class="text-muted">Se tens alguma questão, não exite em <a href="../contact.php">contactar-nos</a>. Nosso apoio ao cliente trabalha <strong>24/7</strong></p>
</center>

<hr>

<div class="table-responsive">
    <table class="table table-bordered table-hover">
        <thead>
            <tr>
                <th>ON: </th>
                <th>Produto: </th>
                <th>Montante: </th>
                <th>voucher No: </th>
                <th>Quantidade: </th>
                <th>Data: </th>
                <th>Pago/Actualizado: </th>
                <th>Estado</th>
                
            </tr>
        </thead>
        <tbody>
        <?php 
        $customer_email=$_SESSION['customer_email'];
        $select_customer="SELECT * FROM customer WHERE customer_email='$customer_email'";
        $run_customer=mysqli_query($con,$select_customer);
        $row=mysqli_fetch_array($run_customer);
        $customer_id=$row['customer_id']; 
        $select_customer_order="SELECT * FROM customer_order WHERE customer_id='$customer_id'";
        $run_customer_order=mysqli_query($con,$select_customer_order);
        $i=0;
        while ($rows=mysqli_fetch_array($run_customer_order)) {
            $order_id=$rows['order_id'];
            $id_produto=$rows['id_produto'];
            $select_products="SELECT product_title FROM products WHERE id_produto='$id_produto'";
            $run_select_products=mysqli_query($con,$select_products);
            $busca2=mysqli_fetch_array($run_select_products);
            $products=$busca2['product_title'];
            $due_amout=$rows['due_amount'];
            $invoice_no=$rows['invoice_no'];
            $size=$rows['size'];
            $qty=$rows['qty'];
            $order_date=$rows['order_date'];
            $order_status=$rows['order_status'];
            $i++;

            if ($order_status=="Pendente") {
                $order_status="Não pago";
            } elseif ($order_status=="Cancelado"){
                $order_status;
            } 
            else {
                $order_status="Pago";
            }
        ?>
        <tr>
            <th>#<?php echo $i ;?></th>
            <td><?php echo $products;?></td>
            <td><?php echo $due_amout;?> KZ</td>
            <td><?php echo $invoice_no;?></td>
            <td><?php echo $qty;?></td>
            <td><?php echo $order_date;?></td>
            <td><?php echo $order_status;?></td>
            <td>
            <?php if ($order_status=="Pago" || $order_status=="Cancelado") {
            ?> <a href="#" disabled  class="btn btn-primary btn-sm">confirmar</a>
          <?php  }else { ?> 
             <a href="confirm.php?order_id=<?php echo $order_id;?>" class="btn btn-primary btn-sm" target="_blank" >confirmar</a>
              
          <?php  }?>
            </td>
        </tr>
        <?php   
        }
    ?> 
        </tbody>        
        
    </table>
</div>