<?php require_once "../controlador/usuario.php"; ?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Formulario de registro</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-md-4 offset-md-4 form">
                <form action="signup-user.php" method="POST" autocomplete="">
                    <h2 class="text-center">Formulario de registro</h2>
                    <p class="text-center">Es rápido y fácil.</p>
                    <?php
                    if(count($errors) == 1){
                        ?>
                        <div class="alert alert-danger text-center">
                            <?php
                            foreach($errors as $showerror){
                                echo $showerror;
                            }
                            ?>
                        </div>
                        <?php
                    }elseif(count($errors) > 1){
                        ?>
                        <div class="alert alert-danger">
                            <?php
                            foreach($errors as $showerror){
                                ?>
                                <li><?php echo $showerror; ?></li>
                                <?php
                            }
                            ?>
                        </div>
                        <?php
                    }
                    ?>
                    <div class="form-group">
                        <input class="form-control" type="text" name="name" placeholder="Nombre usuario" required value="<?php echo $name ?>">
                    </div>
                    <div class="form-group">
                        <input class="form-control" type="email" name="email" placeholder="Correo Electrónico" required value="<?php echo $email ?>">
                    </div>
                    <div class="form-group">
                        <input class="form-control" type="password" name="password" placeholder="Contraseña" required>
                    </div>
                    <div class="form-group">
                        <input class="form-control" type="password" name="cpassword" placeholder="Confirmar Contraseña" required>
                    </div>
                    
                    <div class="form-group">
                        <input class="form-control button" type="submit" name="signup" value="Registrarse">
                    </div>
                    <div class="link login-link text-center">¿Ya eres usuario? <a href="../index.php">Entre aquí</a></div>
                </form>
            </div>
        </div>
    </div>

</body>
</html>
