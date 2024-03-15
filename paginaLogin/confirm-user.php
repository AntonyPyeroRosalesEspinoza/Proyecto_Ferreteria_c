<?php require_once "../controlador/usuario.php"; ?>
<?php
$email = $_SESSION['email'];
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
                <form action="confirm-user.php" method="POST" autocomplete="">
                    <h2 class="text-center">Confirmar usuario</h2>
                    <p class="text-center">Realize estas sencillas preguntas para continuar</p>
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
                        <input class="form-control" type="text" name="name" placeholder="¿Cual es su usuario?" required value="<?php echo $name ?>">
                    </div>
                    <div class="form-group">
                        <input class="form-control" type="text" name="mascota" placeholder="¿Cual es el nombre de tu mascota?" required value="<?php echo $mascota ?>">
                    </div>
                    <div class="form-group">
                        <input class="form-control" type="text" name="lugar" placeholder="¿Cual es tu lugar favorito?" required value="<?php echo $lugar ?>">
                    </div>
                    <div class="form-group">
                    </div>
                        <input class="form-control button" type="submit" name="check-user1" value="Continuar">
                </form>
            </div>
        </div>
    </div>

</body>
</html>
