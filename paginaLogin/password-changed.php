<?php require_once "../controlador/usuario.php"; ?>
<?php
if($_SESSION['info'] == false){
    header('Location: ../index.php');
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Formulario de inicio de sesión</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-md-4 offset-md-4 form login-form">
            <?php
            if(isset($_SESSION['info'])){
                ?>
                <div class="alert alert-success text-center">
                <?php echo $_SESSION['info']; ?>
                </div>
                <?php
            }
            ?>
                <form action="../index.php" method="POST">
                    <div class="form-group">
                        <input class="form-control button" type="submit" value="Inicia sesión ahora">
                    </div>
                </form>
            </div>
        </div>
    </div>

</body>
</html>
