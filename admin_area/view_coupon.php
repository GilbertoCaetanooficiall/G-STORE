<?php if (!isset($_SESSION['admin_email'])) {
    echo "<script>window.open('login.php','_self')</script>";
}else {
    ?>

<div class="row">
    <div class="col-lg-12">
        <ol class="breadcrumb">
            <li class="active">
            <i class="fa fa-dashboard"></i>Dashboard/ Ver Coupons

            </li>
        </ol>
    </div>
</div>

<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">
                    <i class="fa fa-edit"></i> Coupons               
                </h3>

                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>Nº:</th>
                                    <th>Nome:</th>
                                    <th>Desconto :</th>
                                    <th>Codigo :</th>
                                    <th>Limite :</th>
                                    <th>Usados :</th>
                                    <th>Editar :</th>
                                    <th>Apagar :</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php 
                                  $get_coupons="SELECT * FROM coupons";
                                  $run_coupons=mysqli_query($con,$get_coupons);
                                  $n=0;
                                  
                                  while ($fetch=mysqli_fetch_assoc($run_coupons)) {
                                    $coupon_id=$fetch['coupon_id'];
                                    $coupon_title=$fetch['coupon_title'];
                                    $coupon_desconto=$fetch['coupon_price'];
                                    $coupon_code=$fetch['coupon_code'];
                                    $coupon_limit=$fetch['coupon_limit'];
                                    $coupon_used=$fetch['coupon_used'];
                                    
                                    $n++;
                                    ?>

                                    <tr>
                                        <td width="25"><?php echo $n;?></td>
                                        <td><?php echo  $coupon_title;?></td>
                                        <td><?php  if ($coupon_desconto==0.95) {
                                                            $coupon_desconto="5%";
                                                        }elseif ($coupon_desconto==0.90) {
                                                            $coupon_desconto="10%";
                                                        }elseif ($coupon_desconto==0.85) {
                                                            $coupon_desconto="15%";
                                                        }elseif ($coupon_desconto==0.80) {
                                                            $coupon_desconto="20%";
                                                        }elseif ($coupon_desconto==0.75) {
                                                            $coupon_desconto="25%";
                                                        }elseif ($coupon_desconto==0.70) {
                                                            $coupon_desconto="30%";
                                                        }elseif ($coupon_desconto==0.65) {
                                                            $coupon_desconto="35%";
                                                        }elseif ($coupon_desconto==0.60) {
                                                            $coupon_desconto="40%";
                                                        }elseif ($coupon_desconto==0.55) {
                                                            $coupon_desconto="45%";
                                                        } elseif ($coupon_desconto==0.5) {
                                                            $coupon_desconto="50%";
                                                        }else {
                                                            $coupon_desconto="Sem desconto";
                                                        }
                                        echo $coupon_desconto;?></td>
                                        <td><?php echo $coupon_code;?></td>
                                        <td><?php echo $coupon_limit;?></td>
                                        <td><?php echo $coupon_used;?></td>
                                        <td><a href="index.php?edit_coupon=<?php echo $coupon_id;?>"><i class="fa fa-pencil"> Editar</i></a></td>
                                        <td><a href="index.php?delete_coupon=<?php echo $coupon_id;?>" style="color: red; text-decoration: none;"><i class="fa fa-trash-o"> Apagar</i></a></td>
                                    </tr>

                                 <?php }?>                                
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>

    <?php }?>