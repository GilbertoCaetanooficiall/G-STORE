<?php
$host="localhost";
$password="";
$user="root";
$db_name="db_store";
 $con=mysqli_connect($host,$user, $password, $db_name) or die();

    //função getRealIpUser
        function getRealIpUser(){
            global $con;
            if (!isset($_SESSION['customer_email'])) {

                $ip_add=session_id();
                   
            }else {
                $customer_email=$_SESSION['customer_email'];
                $select_cart="SELECT * FROM customer WHERE customer_email='$customer_email'";
                $res2=mysqli_query($con,$select_cart);
                $fetch=mysqli_fetch_array($res2);
            $ip_add=$fetch['customer_ip'];
            $ip=$fetch['customer_id'];
                }
            
                return $ip_add;
                }


    //função mostrar produtos
        function getpro(){
        global $con;
        $sql="SELECT * FROM products ORDER BY RAND() DESC LIMIT 0,8";
        $res=mysqli_query($con,$sql);
        while ($rows=mysqli_fetch_array($res)) {
            $product_id=$rows['id_produto'];
            $product_title=$rows['product_title'];
            $product_image=$rows['product_image'];
            $product_price=$rows['product_price'];
            $product_label=$rows['product_label'];
            $product_sale=$rows['product_sale'];
            if ($product_label=="") {
                # code...
            } else {
                $pro_label="<a href='details.php?id_produto=$product_id' class='label $product_label'>
                <div class='theLabel'>$product_label</div>
                <div class='labelBackground'></div>
                </a>";
            }
            if ($product_sale==0) {
                $pro_sale=$product_price;
            } else {
                $pro_sale="<i style='color:red;'><del>$product_price </del></i>/$product_sale";
            }
            
            echo "<div class='col-sm-4 col-sm-6 single'>
            <div class='product'>
                <a href='details.php?id_produto=$product_id'>
                    <img  class= 'img-responsive' src='admin_worker_area/product_images/product_images_1/$product_image'  alt='Product 1' width='100%'>
                </a>
                    <div class='text'>
                        <h3>
                            <a href='details.php?id_produto=$product_id' style='text-decoration:none;'>
                                $product_title
                            
                        </h3>
                        <p class='price'><strong>$pro_sale KZ</strong></p>
                        </a>
                        <p class='button'>
                            <a href='details.php?id_produto=$product_id' class='btn btn-default'>Detalhes</a>
                            <a href='details.php?id_produto=$product_id' class='btn btn-primary'>
                                <i class='fa fa-shopping-cart'>
                                Add ao carrinho
                                </i>
                            </a>
                        </p>
                    </div>
                    $pro_label
            </div>
            
        </div>";

            }

        } 
    //função mostrar categorias de produtos
       
        function getpcats(){
        global $con;
        $sql="SELECT * FROM products_categories";
        $res=mysqli_query($con,$sql);
            while ($rows=mysqli_fetch_array($res)) {
                $p_cat_id=$rows['p_cat_id'];
                $p_cat_title=$rows['p_cat_title'];
               
            
                echo"
                <li>
                    <a href='shop.php?p_cat_id=$p_cat_id'>
                        <label for=''>
                            <input type='checkbox' name='manufacturer' class='get_manufacturer' value='$p_cat_id'>
                            <span>
                                $p_cat_title
                            </span>
                        </label>
                     </a> 
                </li>
                ";
            
                   
                                                    }
                                    }
    //função mostrar categorias
                function getcats(){
                    global $con;
                $sql="SELECT * FROM categories";
                $res=mysqli_query($con,$sql);
                while ($rows=mysqli_fetch_array($res)) {
                    $cat_id=$rows['id_cat'];
                    $cat_title=$rows['cat_title'];
                    echo"
                    <li >
                        <a href='shop.php?cat_id=$cat_id'><label for=''>
                        <input type='checkbox' name='manufacturer' class='get_manufacturer' value='$cat_id'>
                        <span>
                                $cat_title
                            </span>
                     </label>
                     </a> 
                        </li>
                    ";
                }
                        }


   
   //função quantidade de intems
        function items(){
        global $con;
        $ip_add= getRealIpUser();
        $sql="SELECT * FROM cart Where ip_add='$ip_add'";
        $res=mysqli_query($con,$sql);
        $count=mysqli_num_rows($res);
        echo $count;
    }
   //função preço total de todos os produtos adicionados
        function total(){
            global $con;
            $ip_add=getRealIpUser();
            $total=0;
            $sql="SELECT * FROM cart WHERE ip_add='$ip_add'";
                $res=mysqli_query($con,$sql);
                while ($record=mysqli_fetch_array($res)) {
                    $produto_id=$record['p_id'];
                    $produto_qty=$record['qty'];
                    
                    $sql2="SELECT *FROM products WHERE id_produto='$produto_id'";
                    $res2=mysqli_query($con,$sql2);
                while ( $bring_price=mysqli_fetch_array($res2)) {
                $price=$bring_price['product_price']*$produto_qty;
                $total += $price;
                }
                    
                }
                echo $total;
            }
    

 //função login para os usuários
    function login(){
    global $con;
    if (isset($_POST['submit'])) {
        $customer_email=strip_tags($_POST['email']);
        $customer_password=md5(strip_tags($_POST['password']));
        $customer_ip=getRealIpUser();

        $sql2="SELECT * FROM customer WHERE customer_email=? AND customer_password=?";
       $res2=$con->prepare($sql2);
        $res2->bind_param('ss',$customer_email,$customer_password);
        $res2->execute();
        $resa=$res2->get_result();
       
       if($resa->num_rows==TRUE){
        $customer_rowsa=$resa->fetch_array();
        $id=$customer_rowsa['customer_id'];
        $name=$customer_rowsa['customer_name'];
       
        $sql="SELECT * FROM cart WHERE ip_add=?";
        $res3=$con->prepare($sql);
        $res3->bind_param('s',$customer_ip);
        $res3->execute();
        $check=$res3->get_result();

        if ($resa->num_rows==1 AND $check->num_rows==0) {
        $_SESSION['customer_email']=$customer_email;
        $_SESSION['customer_name']=$name;
        echo "<script>alert('Seja bem-vindo  $name')</script>";
        echo "<script>window.open('customer/my_account.php?my_orders','_self')</script>";
 
          
    }else {
     $Update_cart="UPDATE cart SET customer_id='$id' WHERE ip_add='$customer_ip'";
     $res2=mysqli_query($con,$Update_cart);
        $select_cartas="SELECT * FROM customer WHERE customer_id='$id'";
        $resd3=mysqli_query($con,$select_cartas);
       $fetcha=mysqli_fetch_array($resd3);
       $ida=$fetcha['customer_ip'];
       $Update_cartas="UPDATE cart SET ip_add='$ida' WHERE customer_id='$id'";
       $res2=mysqli_query($con,$Update_cartas); 
       $_SESSION['customer_name']=$name;
        $_SESSION['customer_email']=$customer_email;
        echo "<script>alert('Seja bem-vindo $name')</script>";
                 echo "<script>window.open('cart.php','_self')</script>";
      
        
     
        
             }
       }else {
            echo "<script>alert('Senha ou email errado !')</script>";
            
           
       }
         
        }
    }
//função pegar produtos 
    function getptoducts(){
        global $con;
        $aWhere=0;
  //função pegar produtos da categoria de produtos
            if (isset($_GET['p_cat_id'])) {
        
                
                    $aWhere =$_GET['p_cat_id'];
                                }
                            
                    
                
  //função pegar produtos da categorias
       
        if (isset($_GET['cat_id'])) {
            
                    $aWhere =$_GET['cat_id'];
                }
            
        
  //função mostrar mostrar produtos no shop
        $per_page=6;
        if (isset($_GET['page'])) {
            $page=$_GET['page'];
        }else {
            $page=1;
        }
        $start_from= ($page-1)* $per_page;
       
        $start_from=($page-1) * $per_page;
       if ($aWhere!=0 AND isset($_GET['cat_id'])) {
        $sql="SELECT * FROM products WHERE id_cat='$aWhere' ORDER BY 1 DESC LIMIT $start_from,$per_page";
       }elseif ($aWhere!=0 AND isset($_GET['p_cat_id'])) {
        $sql="SELECT * FROM products WHERE p_cat_id='$aWhere' ORDER BY 1 DESC LIMIT $start_from,$per_page";
       } else {
        $sql="SELECT * FROM products ORDER BY 1 DESC LIMIT $start_from,$per_page";
       }
       
        $resultsa =mysqli_query($con,$sql);
        while ($run_prod=mysqli_fetch_array($resultsa)) {
            $id_pro=$run_prod['id_produto'];
            $title_pro=$run_prod['product_title'];
            $price_pro=$run_prod['product_price'];
            $product_sale=$run_prod['product_sale'];
            $image_pro=$run_prod['product_image'];
            $product_label=$run_prod['product_label'];
            if ($product_label=="") {
                # code...
            } else {
                $pro_label="<a href='details.php?id_produto=$id_pro' class='label $product_label'>
                <div class='theLabel'>$product_label</div>
                <div class='labelBackground'></div>
                </a>";
            }
            if ($product_sale==0) {
                $pro_sale=$price_pro;
            } else {
                $pro_sale="<i style='color:red;'><del>$price_pro </del></i>/$product_sale";
            }

            echo "<div class='col-md-4 col-sm-6 center-responsive'>
            <div class='product'>
                <a href='details.php?id_produto=$id_pro'>
                    <img  class= 'img-responsive' src='admin_worker_area/product_images/product_images_1/$image_pro'  alt='Product 1' width='100%'>
                </a>
                    <div class='text'>
                        <h3>
                            <a href='details.php?id_produto=$id_pro' style='text-decoration:none;'>
                                $title_pro
                           
                        </h3>
                        <p class='price'><strong>$pro_sale KZ</strong></p>
                        </a>
                        <p class='button'>
                            <a href='details.php?id_produto=$id_pro' class='btn btn-default'>Detalhes</a>
                            <a href='details.php?id_produto=$id_pro' class='btn btn-primary'>
                                <i class='fa fa-shopping-cart'>
                                Add ao carrinho
                                </i>
                            </a>
                        </p>
                    </div>
                    $pro_label
            </div>
        </div>";
        }
        
        

    }
            

//função mostrar paginação   
    function pagination(){
        global $con;
        $aWhere=0;
        if (isset($_GET['p_cat_id'])) {
            $aWhere =$_GET['p_cat_id'];  
            $pag="p_cat_id";
            }
            if (isset($_GET['cat_id'])) {
                $aWhere =$_GET['cat_id'];
                $pag="cat_id";
                    }
                    
                    $per_page=6;
                if (isset($_GET['page'])) {
                   $page = $_GET['page'];
                  
                        }
                   else{
                   $page=1;
                     }
                     if ($aWhere!=0 AND isset($_GET['cat_id'])) {
                        $query="SELECT * FROM products WHERE id_cat='$aWhere'";
                                $results =mysqli_query($con,$query);
                                $total_records= mysqli_num_rows($results);
                                $total_pages=ceil($total_records/ $per_page);
                                $total=($total_pages-1);
                        
                                for ($i=1; $i<=$total ; $i++) {                      # code...
                                if ($i==1) {
                                echo "
                                <li>
                                <a href='shop.php?cat_id=".$aWhere."&page=1'> First Page </a>
                                </li>
                                ";
                                }else {
                                echo "<li>
                                <a href='shop.php?cat_id=".$aWhere."&page=".$i."'>".$i."</a>
                                </li>";
                                }
                            }
                                 if ($total_pages==0) {
                                    
                                   } else {
                                    echo "<li>
                                    <a href='shop.php?cat_id=".$aWhere."&page=".$total_pages."'>Last Page</a>
                                    </li>";
                                   }
                                
                               
                               
                       }elseif ($aWhere!=0 AND isset($_GET['p_cat_id'])) {
                        $query="SELECT * FROM products WHERE p_cat_id='$aWhere'";
                                $results =mysqli_query($con,$query);
                                $total_records= mysqli_num_rows($results);
                                $total_pages=ceil($total_records/ $per_page);
                                $total=($total_pages-1);
                            $total_pages=ceil($total_records/ $per_page);
                                $total=($total_pages-1);
                        
                                for ($i=1; $i<=$total ; $i++) {                      # code...
                                if ($i==1) {
                                echo "
                                <li>
                                <a href='shop.php?p_cat_id=".$aWhere."&page=1'> First Page </a>
                                </li>
                                ";
                                }else {
                                echo "<li>
                                <a href='shop.php?p_cat_id=".$aWhere."&page=".$i."'>".$i."</a>
                                </li>";
                                }
                                }
                                if ($total_pages==0) {
                                    
                                   } else {
                                    echo "<li>
                                    <a href='shop.php?p_cat_id=".$aWhere."&page=".$total_pages."'>Last Page</a>
                                    </li>";
                                   }
                       } else {
                        $query="SELECT * FROM products";
                                $results =mysqli_query($con,$query);
                                $total_records= mysqli_num_rows($results);
                                $total_pages=ceil($total_records/ $per_page);
                                $total=($total_pages-1);
                        
                                for ($i=1; $i<=$total ; $i++) {                      # code...
                                if ($i==1) {
                                echo "
                                <li>
                                <a href='shop.php?page=1'> First Page </a>
                                </li>
                                ";
                                }else {
                                echo "<li>
                                <a href='shop.php?page=".$i."'>".$i."</a>
                                </li>";
                                }
                                }if ($total_pages==0) {
                                    
                                } else {
                                    echo "<li>
                                    <a href='shop.php?page=".$total_pages."'>Last Page</a>
                                    </li>";
                                }
                               
                       }
                      
    }
    
            
        
//função usar coupon 

    function usecoupon(){
        global $con;
        
        if (isset($_POST['submit_c'])) {
            $ip_add=getRealIpUser();
            $code=strip_tags($_POST['code']);
            if ($code=="") {
                # code...
            }else {
                $get_coupons="SELECT * FROM coupons Where coupon_code='$code'";
                $run_coupons=mysqli_query($con,$get_coupons);
                $coupons_count=mysqli_num_rows($run_coupons);
                if ($coupons_count==1) {
                    $rows_coupons=mysqli_fetch_array($run_coupons);
                    $coupon_i=$rows_coupons['coupon_id'];
                    $coupon_title=$rows_coupons['coupon_title'];
                    $coupon_cat=$rows_coupons['id_cat'];
                    $coupon_price=$rows_coupons['coupon_price'];
                    $coupon_limit=$rows_coupons['coupon_limit'];
                    $coupon_used=$rows_coupons['coupon_used'];
                    
                if ($coupon_limit==$coupon_used) {
                    echo "<script>alert('Este Coupon já está expirado')</script>";
                    echo "<script>window.open('cart.php','_self')</script>";
                    die();
                }else {
                    $SELECT_cart="SELECT * FROM cart  WHERE id_cat='$coupon_cat' AND ip_add='$ip_add'";
                    $run_cart2=mysqli_query($con,$SELECT_cart);
                    $verify=mysqli_num_rows($run_cart2);
                    if ($verify==0) {
                        echo "<script>alert('Este Coupon não se aplica para essa categoria')</script>";
                        echo "<script>window.open('cart.php','_self')</script>";
                        exit();
                    }else {
                        $fetch_total=mysqli_fetch_array($run_cart2);
                    $coupon_id=$fetch_total['coupon_id'];
                    if ($coupon_id==0) {
                        while ($fetch_total==true) {
                            $total=$fetch_total['total']*$coupon_price;
                            $product=$fetch_total['product_price']*$coupon_price;
                            $update_cart="UPDATE cart set 
                            total='$total',product_price='$product',coupon_id='$coupon_i'  WHERE id_cat='$coupon_cat' AND ip_add='$ip_add'";

                            $cadate_Cart2=mysqli_query($con,$update_cart);

                            if ($cadate_Cart2==true) {
                            $coupon_used=$coupon_used+1; 
                                $update_carta="UPDATE coupons set 
                            coupon_used='$coupon_used'
                            WHERE coupon_id='$coupon_i'";

                            $cadate_Cart=mysqli_query($con,$update_carta);
                                echo "<script>alert('coupon Valido, veio pelo $coupon_title ')</script>";
                                echo "<script>window.open('cart.php','_self')</script>";
                                exit();
                            }
                        }
                    }else {
                        echo "<script>alert('Este Coupon já foi utilizado')</script>";
                        echo "<script>window.open('cart.php','_self')</script>";
                        exit();
                        
                    }
                    }
                }
                    
                    
                }else {
                    echo "<script>alert('Coupon Invalido')</script>";
                    
                }
            }
        }

            
    }

//função mostrar resultados

   function showresults(){
    global $con;
    $per_page=6;
    if (isset($_GET['user_query'])) {
        $resultado=$_GET['user_query'];
    
    if (isset($_GET['page'])) {
        $page=$_GET['page'];
    }else {
        $page=1;
    }
    $start_from= ($page-1)* $per_page;
   
    $start_from=($page-1) * $per_page;
    $sql="SELECT * FROM products  WHERE product_title LIKE'%$resultado%' OR product_keywords LIKE'%$resultado%' OR product_desc LIKE'%$resultado%' ORDER BY 1 DESC LIMIT $start_from,$per_page";
   
   
    $resultsa =mysqli_query($con,$sql);
    while ($run_prod=mysqli_fetch_array($resultsa)) {
        $id_pro=$run_prod['id_produto'];
        $title_pro=$run_prod['product_title'];
        $price_pro=$run_prod['product_price'];
        $product_sale=$run_prod['product_sale'];
        $image_pro=$run_prod['product_image'];
        $product_label=$run_prod['product_label'];
        if ($product_label=="") {
            # code...
        } else {
            $pro_label="<a href='details.php?id_produto=$id_pro' class='label $product_label'>
            <div class='theLabel'>$product_label</div>
            <div class='labelBackground'></div>
            </a>";
        }
        if ($product_sale==0) {
            $pro_sale=$price_pro;
        } else {
            $pro_sale="<i style='color:red;'><del>$price_pro </del></i>/$product_sale";
        }

        echo "<div class='col-md-4 col-sm-6 center-responsive'>
        <div class='product'>
            <a href='details.php?id_produto=$id_pro'>
                <img  class= 'img-responsive' src='admin_worker_area/product_images/product_images_1/$image_pro'  alt='Product 1' width='100%'>
            </a>
                <div class='text'>
                    <h3>
                        <a href='details.php?id_produto=$id_pro' style='text-decoration:none;'>
                            $title_pro
                       
                    </h3>
                    <p class='price'><strong>$pro_sale KZ</strong></p>
                    </a>
                    <p class='button'>
                        <a href='details.php?id_produto=$id_pro' class='btn btn-default'>Detalhes</a>
                        <a href='details.php?id_produto=$id_pro' class='btn btn-primary'>
                            <i class='fa fa-shopping-cart'>
                            Add ao carrinho
                            </i>
                        </a>
                    </p>
                </div>
                $pro_label
        </div>
    </div>";
    }
   }
    }

//função mostrar paginação dos resultados
    function showpaginator(){
            global $con;
            $per_page=6;
            if (isset($_GET['user_query'])) {
                $resultado=$_GET['user_query'];
            if (isset($_GET['page'])) {
            $page = $_GET['page'];
            
                    }
            else{
            $page=1;
                }
                
                    $query="SELECT * FROM products WHERE product_title LIKE'%$resultado%' OR product_keywords LIKE'%$resultado%' OR product_desc LIKE'%$resultado%'";
                            $results =mysqli_query($con,$query);
                            $total_records= mysqli_num_rows($results);
                            $total_pages=ceil($total_records/ $per_page);
                            $total=($total_pages-1);
                    
                            for ($i=1; $i<=$total ; $i++) {                      # code...
                            if ($i==1) {
                            echo "
                            <li>
                            <a href='results.php?user_query=".$resultado."&page=1'> First Page </a>
                            </li>
                            ";
                            }else {
                            echo "<li>
                            <a href='results.php?user_query=".$resultado."&page=".$i."'>".$i."</a>
                            </li>";
                            }
                            } if ($total_pages==0) {
                                    
                            } else {
                                echo "<li>
                                <a href='results.php?user_query=".$resultado."&page=".$total_pages."'>Last Page</a>
                                </li>";
                            }
                            
                
        }
        }
//função mostrar informação na box resltuts
    function box(){
    global $con;
    $per_page=6;
    if (isset($_GET['user_query'])) {
        $resultado=$_GET['user_query'];
    $sql="SELECT * FROM products  WHERE product_title LIKE'%$resultado%' OR product_keywords LIKE'%$resultado%' OR product_desc LIKE'%$resultado%'";
    $resultsa =mysqli_query($con,$sql);
    $man=mysqli_num_rows($resultsa);
    
    if ($man==TRUE) {
    ?>
        Resltudados por <strong class="text-muted" style="font-size: large; text-transform:uppercase"><?php echo $resultado ; ?></strong>
        <br> Lorem ipsum dolor sit amet consectetur adipisicing elit. 
        Laborum iure rem officiis architecto! Delectus optio inventore sint nulla asperiores dolor cumque, minus exercitationem necessitatibus recusandae saepe dolore accusamus ut reprehenderit!
        <?php }else {
    ?>  sem pesquisas encontradas<?php }
        }
    }
?>
    