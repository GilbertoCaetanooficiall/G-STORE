<?php 
$active='Contact Us';
include('includes/header.php'); ?>


   <div id="content">
        <div class="container">
            <div class="col-md-12">

                <ul class="breadcrumb">
                    <li><a href="index.php">HOME</a>
                    </li>
                    <li>
                     Contact Us
                    </li>
                </ul>

            </div>
               <div class="col-md-12">
                    <div class="box">
                        <div class="box-header">
                            <center>
                                <h2> Sinta-se livre de contactar-nos</h2>
                                <p class="text-muted">
                                    Se tu tens alguma questão, não exite em contactar-nos. Nosso apoio ao cliente trabalha <strong>24/7</strong>
                                </p>
                            </center>
                            <form action="contact.php" method="post">
                                <div class="form-group">
                                    <label>Nome</label>
                                    <input type="text" name="name" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label>Email</label>
                                    <input type="email" name="email" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label>Assunto</label>
                                    <input type="text" name="subject" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label>Mensagem</label>
                                    <textarea name="message" class="form-control" cols="30" rows="10"></textarea>
                                </div>
                                <div class="text-center">
                                    <button type="submit" name="submit" class="btn btn-primary">
                                        <i class="fa fa-user-md"> enviar mensagem</i>
                                    </button>
                                </div>
                            </form>
                            <?php
                            if (isset($_POST['submit'])) {
                                //feadback para o admin
                                $sender_name=$_POST['name'];
                                $sender_email="marcelocaetano655@gmail.com";
                                $sender_subject=$_POST['subject'];
                                $sender_message=$_POST['message'];
                                mail($sender_email,$sender_message,$sender_name,$sender_subject);

                                //mensagem automática
                                $email=$_POST['email'];
                                $subject="Seja Bem-vindo à nossa loja";
                                $message="Agradecemos o vosso feadback, responderemos em breve";
                                $from="marcelocaetano655@gmail.com";
                                mail($email,$subject,$message,$from);
                                
                                echo "<h2 align='center'> Mensagem enviada com sucesso </h2>";
                            }
                            ?>
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
<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $telefone = $_POST['telefone'];
    $endereco = $_POST['endereco'];
    $descricao = $_POST['descricao'];

    $para = 'seuemail@empresa.com'; // Defina o endereço de e-mail para onde deseja enviar as informações
    $assunto = 'Nova mensagem do formulário de contato';

    // Crie o corpo do e-mail com as informações do formulário
    $mensagem = "Nome: $nome\n";
    $mensagem .= "Email: $email\n";
    $mensagem .= "Telefone: $telefone\n";
    $mensagem .= "Endereço: $endereco\n";
    $mensagem .= "Descrição: $descricao\n";

    // Defina os cabeçalhos do e-mail
    $headers = "From: $nome <$email>\r\n";
    $headers .= "Reply-To: $email\r\n";

    // Envie o e-mail
    if (mail($para, $assunto, $mensagem, $headers)) {
        echo "Mensagem enviada com sucesso!";
    } else {
        echo "Ocorreu um erro ao enviar a mensagem.";
    }
}
?>