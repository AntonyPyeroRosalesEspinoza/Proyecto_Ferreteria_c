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
    <title>Crear una nueva contraseña</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/contraseña.css">
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-md-4 offset-md-4 form">
                <form action="new-password.php" method="POST" autocomplete="off">
                    <h2 class="text-center">Nueva Contraseña</h2>
                    <?php
                    if(isset($_SESSION['info'])){
                        ?>
                        <div class="alert alert-success text-center">
                            <?php echo $_SESSION['info']; ?>
                        </div>
                        <?php
                    }
                    ?>
                    <?php
                    if(count($errors) > 0){
                        ?>
                        <div class="alert alert-danger text-center">
                            <?php
                            foreach($errors as $showerror){
                                echo $showerror;
                            }
                            ?>
                        </div>
                        <?php
                    }
                    ?>
                    <div class="form-group">
                        <input class="form-control" type="password" name="password" id="inputPassword" oninput="strengthChecker()" placeholder="Crea nueva contraseña" required>
                        <div id="strength-bar"></div>
                        <p id="msg"></p>
                      </div>
                    <div class="form-group">
                        <input class="form-control" type="password" name="cpassword" placeholder="Confirma la contraseña" required>
                    </div>
                    <div class="form-group">
                        <input class="form-control button" type="submit" name="change-password" value="Cambiar">
                    </div>

                </form>
            </div>
        </div>
    </div>
    <script src="../js/contraseña.js"></script>
    <script src="js/scripts.js"></script>
</body>
</html>
