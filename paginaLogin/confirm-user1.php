<?php require_once "../controlador/usuario.php"; ?>
<?php
$email = $_SESSION['email'];
$name = $_SESSION['name'];
if($email == false){
  header('Location: ../index.php');
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Has olvidado tu contraseña?</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-md-4 offset-md-4 form">
                <form action="confirm-user1.php" method="POST" autocomplete="">
                    <h2 class="text-center">Usuario confirmado</h2>
                    <p class="text-center">Hola usuario, hemos verificado su identidad</p>
                    <?php
                        if(count($errors) > 0){
                            ?>
                            <div class="alert alert-danger text-center">
                                <?php
                                    foreach($errors as $error){
                                        echo $error;
                                    }
                                ?>
                            </div>
                            <?php
                        }
                    ?>
                    <div class="form-group">
                        <img src="../img/<?php echo "$name"; ?>.jpg" class="imgRedonda">
                    </div>
                        <input class="form-control button" type="submit" name="check-email" value="Enviar Código">
                </form>
            </div>
        </div>
    </div>

</body>
</html>
