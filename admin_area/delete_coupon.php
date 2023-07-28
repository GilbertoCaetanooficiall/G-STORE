<?php if (!isset($_SESSION['admin_email'])) {
    echo "<script>window.open('login.php','_self')</script>";
}else {
    
    if (isset($_GET['delete_coupon'])) {
        
    $delete_coupon=$_GET['delete_coupon']; 
   
    $delete_c="DELETE FROM coupons WHERE coupon_id='$delete_coupon'";
    $run_delete=mysqli_query($con,$delete_c);
  echo "<script>alert('Coupon apagado com sucesso')</script>";
  echo "<script>window.open('index.php?view_coupon','_self')</script>";
    }
    
}?>