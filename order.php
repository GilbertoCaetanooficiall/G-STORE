<?php

session_start();

include("functions/function.php");

if (isset($_GET['c_id'])) {
    $customer_id=$_GET['c_id'];
}
 
  $ip_add=getRealIpUser();
  $status="Pendente";
  $invoice_no=mt_rand();
  $select_cart="SELECT SUM(total) as total FROM cart WHERE ip_add='$ip_add'";
  $res=mysqli_query($con,$select_cart);
  while ($resa=mysqli_fetch_array($res)) {
    $re=$resa['total'];
    if ($re==true) {
      $select_cart="SELECT * FROM cart WHERE ip_add='$ip_add'";
    $res=mysqli_query($con,$select_cart);
    $rabo=date('y-m-d h:i:sa');
    $rowa=mysqli_num_rows($res);
    while ($row=mysqli_fetch_array($res)) {
      $p_id=$row['id_produto'];
      $qty=$row['qty'];
      $size=$row['size'];
      $total=$row['total'];
     if ($rowa==3 AND $re>=100000) {
      $ship=750;
      if($total>=50000)
      {  $ship=500;
         $total+=$ship;}
        else if($total>=100000)
      {
         $total+= $ship=0;}
          else {
              $ship;}
     $total+=$ship;
     } else if($rowa!=3 AND $re>=100000) {
      $ship=750;
      if($total>=50000)
      {  $ship=500;
         $total+=$ship;}
        else if($total>=100000)
      {
         $total+= $ship=0;}
          else {
              $ship;}
     $total+=$ship;
     }else {
      $ship=5000/$rowa;
      if($total>=50000)
      {  $ship=500;
         $total+=$ship;}
        else if($total>=100000)
      {
         $total+= $ship=0;}
          else {
              $ship;}
     $total+=$ship;
     }
     
      
  
          
          
          
          $insert="INSERT INTO customer_order SET
          customer_id='$customer_id',
          id_produto='$p_id',
          due_amount='$total',
          invoice_no='$invoice_no',
          qty='$qty',
          size='$size',
          order_date='$rabo',
          order_status='$status'";
          $res3=mysqli_query($con,$insert);
  
          $insert2="INSERT INTO pending_orders SET
          customer_id='$customer_id',
          invoice_no='$invoice_no',
          qty='$qty',
          size='$size',
          id_produto='$p_id',
          order_status='$status'";
          $res4=mysqli_query($con,$insert2);
  
          $delet_cart="DELETE FROM cart WHERE ip_add='$ip_add'";
          $un_delete=mysqli_query($con,$delet_cart);
          echo "<script>alert('Foi submetida novas encomendas, Obrigado!')</script>";
          echo "<script>window.open('customer/my_account.php?my_orders','_self')</script>";
      }
    }else {
      echo "<script>alert('não soma o total ')</script>";
          echo "<script>window.open('cart.php','_self')</script>";
          die();
      
    }
  }
 

?>