<?php require_once "../controlador/usuario.php"; ?>
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
                <form action="forgot-password.php" method="POST" autocomplete="">
                    <h2 class="text-center">Has olvidado tu contraseña</h2>
                    <p class="text-center">Ingrese su dirección de correo electrónico</p>
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
                        <input class="form-control" type="email" name="email" placeholder="Coloque su correo" required value="<?php echo $email ?>">
                    </div>
                  
                        <input class="form-control button" type="submit" name="check-user" value="Continuar">
                </form>
                <div class="form-group">
                  <div class="link forget-pass text-left"><a href="../index.php">Atras</a></div>
            </div>
        </div>
    </div>

</body>
</html>
