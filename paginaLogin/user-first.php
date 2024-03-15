<?php require_once "../controlador/usuario.php"; ?>
<?php
$email = $_SESSION['email'];
if($email == false){
  header('Location: ../index.php');
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Verificación de Primeros Usuarios</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-md-4 offset-md-4 form">
                <form action="user-first.php" method="POST" autocomplete="off">
                    <h2 class="text-center">Primeros Usuarios</h2>
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
                        <input class="form-control" type="text" name="name" placeholder="Verifica usuario" required value="<?php echo $name ?>">
                    </div>
                    <div class="form-group">
                        <input class="form-control" type="text" name="mascota" placeholder="Registra nombre de tu mascota" required value="<?php echo $mascota ?>">
                    </div>
                    <div class="form-group">
                        <input class="form-control" type="text" name="lugar" placeholder="Registra tu lugar favorito" required value="<?php echo $lugar ?>">
                    </div>
                    <div class="form-group">
                        <input class="form-control button" type="submit" name="check_1" value="Registrar Preguntas">
                    </div>
                </form>
            </div>
        </div>
    </div>

</body>
</html>
