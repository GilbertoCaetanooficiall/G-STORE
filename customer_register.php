<?php
$active="my_account"; 
include('includes/header.php') ?>


   <div id="content">
        <div class="container">
            <div class="col-md-12">

                <ul class="breadcrumb">
                    <li><a href="index.php">HOME</a>
                    </li>
                    <li>
                     Register
                    </li>
                </ul>

            </div>
             <div class="col-md-12">
                    <div class="box">
                        <div class="box-header">
                            <center>
                                <h2> Registra-te</h2>
                                <p class="text-muted">
                                    Torna-te membro e aproveite os nossos maiores descontos da nossa loja.
                                </p>
                            </center>
                            <form action="customer_register.php" method="post" enctype="multipart/form-data">
                                <div class="form-group">
                                    <label>Nome</label>
                                    <input type="text" name="name" class="form-control" required>
                                </div>
                                <div class="form-group">
                                    <label>Email</label>
                                    <input type="email" name="email" class="form-control" required>
                                </div>
                                <div class="form-group">
                                    <label>Contacto</label>
                                    <input type="tel" name="phone" class="form-control" required>
                                </div>
                                <div class="form-group">
                                    <label>Seu país</label>
                                    <input type="text" name="country" class="form-control" required>
                                </div>
                                <div class="form-group">
                                    <label>Sua Cidade</label>
                                    <input type="text" name="city" class="form-control" required>
                                </div>
                                <div class="form-group">
                                    <label>Endereço</label>
                                    <input type="text" name="addres" id="" class="form-control" required>
                                </div>
                                <div class="form-group">
                                    <label>Password</label>
                                    <input type="password" name="password" class="form-control" required>
                                </div>
                                <div class="form-group">
                                    <label>Insere a foto</label>
                                    <input type="file" name="image_1" class="form-control">
                                </div>
                                <div class="text-center">
                                    <button type="submit" name="submit" class="btn btn-primary">
                                        <i class="fa fa-user"> cadastrar</i>
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
        </div>
   </div>
   
        <?php include ("includes/footer.php");?>
        <script src="js/jquery-331.min.js"></script>
        <script src="js/bootstrap-337.min.js"></script>
</body>
</html>

<?php if (isset($_POST['submit'])) {
    $customer_name=strip_tags($_POST['name']);
    $customer_email=strip_tags($_POST['email']);
    $customer_phone=strip_tags($_POST['phone']);
    $customer_country=strip_tags($_POST['country']);
    $customer_city=strip_tags($_POST['city']);
    $customer_addres=strip_tags($_POST['addres']);
    $customer_image=$_FILES['image_1']['name'];
    $customer_password=strip_tags(md5($_POST['password']));
    $customer_ip=getRealIpUser();
    $customer_pa=session_create_id();
   
    
   
    if (isset($_SESSION['customer_email'])) {
        echo "<script>alert('Já tem uma conta logada')</script>";
        echo "<script>window.open('index.php','_self')</script>";
        die();
    }else {
        $verify="SELECT * FROM customer WHERE customer_email=? OR customer_password=?";
        $verify_check=$con->prepare($verify);
        $verify_check->bind_param('ss',$customer_email,$customer_password);
        $verify_check->execute();
        $row=$verify_check->get_result();
        $rowa=$row->fetch_array();
            $cust=$rowa['customer_email'];
            $pass=$rowa['customer_password'];
            

            if ($customer_email==$cust || $customer_password==$pass) {
                echo "<script>alert('Esse email ou senha já está a ser utilizado')</script>";
                echo "<script>window.open('customer_register.php','_self')</script>";
              die(); 
            }else {
                if (isset($_FILES['image_1']['name'])) {
                    //upload image
                    //to upload image we need  image name, source path and destination path
                    $customer_image=$_FILES['image_1']['name'];
                    
                   
                   //Get the extesion of our image(jpg,png, gift etc)
                   $sext = explode(".", $customer_image);
                    $file_ext = end($sext);
            
            
            
                   //rename the image
                   $customer_image ="fotos_de_cliente_cadastrados".rand(000,999).".".$file_ext;
                  
            
                   $src=$_FILES['image_1']['tmp_name'];
                   $dst="customer/customer_images/".$customer_image;
                  
                  
                   //finally uploaded the image 
                   $upload =move_uploaded_file($src, $dst);
                   
                    //Check Whether the image is uploaded or not
                    //and if the image is not uploaded then we will stop the process and redirect with erro message
                   
                   
                   
                    if ($upload == false) {
                    //set message
                    echo " falhou ao carregar a imagem";
                    //redirect to add category page
                    //stop the process
                    die();
                   }
                    $sql=$conn->prepare("INSERT INTO customer(customer_name,customer_email,customer_contact,customer_city,
                    customer_country,customer_address,customer_image,customer_ip,customer_password) VALUES(:NAME,:EMAIL,
                    :CONTACT,:CITY,:COUNTRY,:ADDRESS,:IMAGE,:IP,:PASSWORD)");
                    $sql->bindparam(":NAME",$customer_name);
                    $sql->bindparam(":EMAIL",$customer_email);
                    $sql->bindparam(":CONTACT",$customer_phone);
                    $sql->bindparam(":CITY",$customer_city);
                    $sql->bindparam(":COUNTRY",$customer_country);
                    $sql->bindparam(":ADDRESS",$customer_addres);
                    $sql->bindparam(":IMAGE",$customer_image);
                    $sql->bindparam(":PASSWORD",$customer_password);
                    $sql->bindparam(":IP",$customer_pa);
                    $sql->execute();
                
                   if ($sql==true) {
                    $select_cuz="SELECT * FROM customer WHERE customer_email=?";
                    $se_cuz=$con->prepare($select_cuz);
                    $se_cuz->bind_param('s',$customer_email);
                    $se_cuz->execute();
                    $res2=$se_cuz->get_result();
                    $fetch=$res2->fetch_array();
                    $id=$fetch['customer_id'];
                    $name=$fetch['customer_name'];
                    $Update_cart=("UPDATE cart SET customer_id='$id' WHERE ip_add='$customer_ip'");
                    $res2=mysqli_query($con,$Update_cart);
            
                    $SELECT_cart="SELECT * FROM cart  WHERE ip_add=?";
                    $c=$con->prepare($SELECT_cart);
                    $c->bind_param('s',$customer_ip);
                    $c->execute();
                    $go=$c->get_result();
                    if ($go->num_rows>0) {
                        $select_cuz=$con->prepare("SELECT * FROM customer WHERE customer_email=?");
                        $select_cuz->bind_param('s',$customer_email);
                        $select_cuz->execute();
                        $res2=$select_cuz->get_result();
                        $fetcha=$res2->fetch_array();
                        $ida=$fetcha['customer_ip'];
                        $Update_cartas=$conn->prepare("UPDATE cart SET ip_add=:IP WHERE customer_id=:ID");
                       $Update_cartas->bindparam(":IP",$ida);
                       $Update_cartas->bindparam(":ID",$id);
                       $Update_cartas->execute(); 
                        $_SESSION['customer_email']=$customer_email;
                        $_SESSION['customer_name']=$customer_name;
                        $Delete_cart="DELETE FROM cart WHERE customer_id=0";
                        $run=mysqli_query($con,$Delete_cart);
                        echo "<script>alert('Registro feito com sucesso')</script>";
                        echo "<script>alert('Seja Bem-vindo $customer_name')</script>";
                            echo "<script>window.open('cart.php','_self')</script>";
                         
                    }else {
                        $_SESSION['customer_email']=$customer_email;
                        $_SESSION['customer_name']=$name;
                        $Delete_cart="DELETE FROM cart WHERE customer_id=0";
                        $run=mysqli_query($con,$Delete_cart);
                        echo "<script>alert('Registro feito com sucesso')</script>";
                        echo "<script>alert('Seja Bem-vindo $customer_name')</script>";
                            echo "<script>window.open('index.php','_self')</script>";
                    }
                }else {
                    echo "<script>alert('Por favor, define correto suas credenciais')</script>";
                        echo "<script>window.open('customer_register.php','_self')</script>";
                }
               
            }
            }
                
            
        
        
    }
        
   

    
    }
?>