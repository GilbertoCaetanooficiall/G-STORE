<?php session_start();
include("includes/db.php"); ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="font-awsome/css/font-awesome.min.css">
    <link rel="stylesheet" href="css/style2.css">
    <link rel="shortcut icon" href="../images/Black_Minimalist_Fashion_Brand_Logo__3_-removebg-preview-_1_.ico" type="image/x-icon">
    <title>Admin Login</title>
</head>

<body>
    <div class="container">
        <div class="content first-content">
            <div class="first-column">
                <h2 class="title title-primary">Bem-vindo <br />Entre como Funcionário</h2>
                <p class="description description-primary">Segue nossas redes sociais</p>
                <p class="description description-primary">e continue com a nossa maravilhosa jornada</p>
                <button id="signin" class="btn btn-primary">Entrar</button>
            </div>
            <div class="second-column">
                <h2 class="title title-second">Login</h2>
                <div class="social-media">
                    <ul class="list-social-media">
                        <a href="#" class="link-social-media">
                            <li class="item-social-media"><i class="fa fa-facebook"></i></li>
                        </a>
                        <a href="#" class="link-social-media">
                            <li class="item-social-media"><i class="fa fa-instagram"></i></li>
                        </a>
                    </ul>
                </div>
                <p class="description description-second">Segue nossas redes sociais</p>
                <form class="form" method="post" enctype="multipart/form-data">
                    <label class="label-input" for="">
                        <i class="fa fa-envelope icon-modify"></i>
                        <input type="email" name="admin_email" placeholder="Email" required>
                    </label>

                    <label class="label-input">
                        <i class="fa fa-lock icon-modify"></i>
                        <input type="password" name=" admin_pass" placeholder="palavra-passe" required>
                    </label>
                    <a href="#" class="password">Esqueceu sua Senha ? </a>
                    <button class="btn btn-second" name="admin">Entrar</button>
                </form>
            </div>
        </div>
        <div class="content second-content">
            <div class="first-column">
                <h2 class="title title-primary">Bem-vindo <br /> Entre como Admin</h2>
                <p class="description description-primary">Segue nossas redes sociais</p>
                <p class="description description-primary">e continue com a nossa maravilhosa jornada</p>
                <button id="signup" class="btn btn-primary">Entrar</button>
            </div>
            <div class="second-column">
                <h2 class="title title-second">Login</h2>
                <div class="social-media">
                    <ul class="list-social-media">
                        <a href="#" class="link-social-media">
                            <li class="item-social-media"><i class="fa fa-facebook"></i></li>
                        </a>
                        <a href="#" class="link-social-media">
                            <li class="item-social-media"><i class="fa fa-instagram"></i></li>
                        </a>
                    </ul>
                </div>
                <p class="description description-second">Ou use seu email para se registrar</p>
                <form class="form" method="post">
                    <label class="label-input" for="">
                        <i class="fa fa-envelope icon-modify"></i>
                        <input type="email" name="worker_email" placeholder="Email" required>
                    </label>

                    <label class="label-input">
                        <i class="fa fa-lock icon-modify"></i>
                        <input type="password" name="worker_pass" placeholder="palavra-passe" required>
                    </label>
                    <a href="#" class="password">Esqueceu sua Senha ? </a>
                    <button class="btn btn-second" name="funcionario">entrar</button>
                </form>
                
            </div>

        </div>
    </div>

    <script src="js/app.js"></script>
</body>

</html>
<?php
    if (isset($_POST['admin'])) {
        $admin_email = $_POST['admin_email'];
        $admin_password = $_POST['admin_pass'];
    
        // Verificar se o usuário está bloqueado
        if ($_SESSION['login_blocked']) {
            $block_duration = 2 * 60 * 60; // 5 horas em segundos
            $block_remaining = $_SESSION['login_block_time'] + $block_duration - time();
            
            if ($block_remaining > 0) {
                echo "<script>alert('Você foi bloqueado devido a muitas tentativas de login. Tente novamente em " . gmdate('H:i:s', $block_remaining) . "')</script>";
                echo "<script>window.open('login.php','_self')</script>";
                exit;
            } else {
                // O tempo de bloqueio expirou, redefinir as variáveis de bloqueio
                $_SESSION['login_blocked'] = false;
                $_SESSION['login_block_time'] = null;
                $_SESSION['login_attempts'] = 0;
            }
        }
    
        // Verificar se o limite de tentativas foi excedido
        if ($_SESSION['login_attempts'] >= 3) {
            // Bloquear o usuário
            $_SESSION['login_blocked'] = true;
            $_SESSION['login_block_time'] = time();
            
            echo "<script>alert('Você excedeu o limite de tentativas de login. Tente novamente em 2 horas.')</script>";
            echo "<script>window.open('login.php','_self')</script>";
            exit;
        }
    
        $select_admin = "SELECT * FROM admin WHERE admin_email=? AND admin_password=?";
        $stmt = $con->prepare($select_admin);
        $stmt->bind_param("ss", $admin_email, $admin_password);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows == 1) {
            // Login bem-sucedido, redefinir o contador de tentativas
            $_SESSION['login_attempts'] = 0;
            $admin = $result->fetch_array();
            $admin_name=$admin['admin_name'];
            $_SESSION['admin_email'] = $admin_email;
            echo "<script>alert('Seja Bem-vindo $admin_name')</script>";
            echo "<script>window.open('../admin_area/index.php?dashboard','_self')</script>";
        } else {
            // Login falhou, incrementar o contador de tentativas
            $_SESSION['login_attempts']++;
    
            echo "<script>alert('Email ou palavra-passe errada')</script>";
            echo "<script>window.open('login.php','_self')</script>";
        }
    }
    
       
    
    if (isset($_POST['funcionario'])) {
        $worker_email = $_POST['worker_email'];
        $worker_password = $_POST['worker_pass'];

        // Verificar se o usuário está bloqueado
    if ($_SESSION['login_blockeda']) {
        $block_duration = 2 * 60 * 60; // 2 horas em segundos
        $block_remaininga = $_SESSION['login_block_timea'] + $block_duration - time();
        
        if ($block_remaininga > 0) {
            echo "<script>alert('Você foi bloqueado devido a muitas tentativas de login. Tente novamente em " . gmdate('H:i:s', $block_remaininga) . "')</script>";
            echo "<script>window.open('login.php','_self')</script>";
            exit;
        } else {
            // O tempo de bloqueio expirou, redefinir as variáveis de bloqueio
            $_SESSION['login_blockeda'] = false;
            $_SESSION['login_block_timea'] = null;
            $_SESSION['login_attemptsa'] = 0;
        }
    }

    // Verificar se o limite de tentativas foi excedido
    if ($_SESSION['login_attemptsa'] >= 3) {
        // Bloquear o usuário
        $_SESSION['login_blockeda'] = true;
        $_SESSION['login_block_timea'] = time();
        
        echo "<script>alert('Você excedeu o limite de tentativas de login. Tente novamente em 2 horas.')</script>";
        echo "<script>window.open('login.php','_self')</script>";
        exit;
    }

        $select_worker = "SELECT * FROM worker WHERE worker_email=? AND worker_password=?";
        $stmt = $con->prepare($select_worker);
        $stmt->bind_param("ss", $admin_email, $admin_password);
        $stmt->execute();
        $result = $stmt->get_result();
        $worker = $result->fetch_array();
        if ($result->num_rows == 1) {
            // Login bem-sucedido, redefinir o contador de tentativas
            $_SESSION['login_attemptsa'] = 0;
            $admin = $result->fetch_array();
            $admin_name=$admin['worker_name'];
            $_SESSION['worker_email'] = $admin_email;
            echo "<script>alert('Seja Bem-vindo $admin_name')</script>";
            echo "<script>window.open('index.php?dashboard','_self')</script>";
        } else {
            // Login falhou, incrementar o contador de tentativas
            $_SESSION['login_attemptsa']++;
    
            echo "<script>alert('Email ou palavra-passe errada')</script>";
            echo "<script>window.open('login.php','_self')</script>";
        }
    }
    ?>