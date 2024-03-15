<?php
session_start();
require "connection.php";
$email = "";
$name = "";
$mascota="";
$lugar="";
$status="";
$errors = array();

//if user signup button
if(isset($_POST['signup'])){
    $name = mysqli_real_escape_string($con, $_POST['name']);
    $email = mysqli_real_escape_string($con, $_POST['email']);
    $password = mysqli_real_escape_string($con, $_POST['password']);
    $cpassword = mysqli_real_escape_string($con, $_POST['cpassword']);
    if($password !== $cpassword){
        $errors['password'] = "¡La contraseña no coincide!";
    }
    $email_check = "SELECT * FROM usertable WHERE email = '$email'";
    $res = mysqli_query($con, $email_check);
    if(mysqli_num_rows($res) > 0){
        $errors['email'] = "El correo electrónico que ha ingresado ya existe!";
    }
    if(count($errors) === 0){
        $encpass = password_hash($password, PASSWORD_BCRYPT);
        $code = 0;
        $status = "NotVerified";
        $insert_data = "INSERT INTO usertable (name, email, password, code, status)
                        values('$name', '$email', '$encpass', '$code', '$status')";
        $data_check = mysqli_query($con, $insert_data);
        if($data_check){
          header('location: ../index.php');
        }else{

            $errors['db-error'] = "¡Error al insertar datos en la base de datos!";
        }
    }

}
    //if user click verification code submit button
    if(isset($_POST['check'])){
        $_SESSION['info'] = "";
        $otp_code = mysqli_real_escape_string($con, $_POST['otp']);
        $check_code = "SELECT * FROM usertable WHERE code = $otp_code";
        $code_res = mysqli_query($con, $check_code);
        if(mysqli_num_rows($code_res) > 0){
            $fetch_data = mysqli_fetch_assoc($code_res);
            $fetch_code = $fetch_data['code'];
            $email = $fetch_data['email'];
            $code = 0;
            $status = 'verified';
            $update_otp = "UPDATE usertable SET code = $code, status = '$status' WHERE code = $fetch_code";
            $update_res = mysqli_query($con, $update_otp);
            if($update_res){
                $_SESSION['name'] = $name;
                $_SESSION['email'] = $email;
                header('location: ../menu/index.php');
                exit();
            }else{
                $errors['otp-error'] = "¡Error al actualizar el código!";
            }
        }else{
            $errors['otp-error'] = "¡Has introducido un código incorrecto!";
        }
    }

    if(isset($_POST['check_1'])){
        $_SESSION['info'] = "";
        $name = mysqli_real_escape_string($con, $_POST['name']);
        $mascota = mysqli_real_escape_string($con, $_POST['mascota']);
        $lugar = mysqli_real_escape_string($con, $_POST['lugar']);
        $check_code = "SELECT * FROM usuario WHERE name = '$name'";
        $code_res = mysqli_query($con, $check_code);
        if(mysqli_num_rows($code_res) > 0){
            $fetch_data = mysqli_fetch_assoc($code_res);
            $status = 'verified';
            $code =0;
            $update_otp = "UPDATE usertable SET code = $code, status = '$status', mascota = '$mascota', favorito = '$lugar'
            WHERE name = '$name'";
            $update_res = mysqli_query($con, $update_otp);
            if($update_res){
                $_SESSION['name'] = $name;
                $_SESSION['email'] = $email;
                header('location: ../menu/index.php');
                exit();
            }else{
                $errors['otp-error'] = "¡Error al actualizar el código!";
            }
        }else{
            $errors['otp-error'] = "¡Has introducido un código incorrecto!";
        }
    }

    //if user click login button
    if(isset($_POST['login'])){
        $email = mysqli_real_escape_string($con, $_POST['email']);
        $password = mysqli_real_escape_string($con, $_POST['password']);
        $check_email = "SELECT * FROM usertable WHERE email = '$email'";
        $res = mysqli_query($con, $check_email);
        if(mysqli_num_rows($res) > 0){
            $fetch = mysqli_fetch_assoc($res);
            $fetch_pass = $fetch['password'];
            $name = $fetch['name'];
            if(password_verify($password, $fetch_pass)){
                $_SESSION['email'] = $email;
                $status = $fetch['status'];
                if($status == 'verified'){
                  $_SESSION['name'] = $name;
                  $_SESSION['email'] = $email;
                  $_SESSION['password'] = $password;
                    header('location: menu/index.php');
                }else{
                    $info = "Parece que aún no has verificado tu correo electrónico - $email";
                    $_SESSION['info'] = $info;
                    $_SESSION['email'] = $email;
                    header('location: paginaLogin/user-first.php');
                }
            }else{
                $errors['email'] = "¡Correo o contraseña incorrectos!";
            }
        }else{
            $errors['email'] = "¡Parece que aún no eres miembro!";
        }
    }


    // Verificando al usuario con preguntas sencillas
    if(isset($_POST['check-user'])){
        $email = mysqli_real_escape_string($con, $_POST['email']);
        $check_user = "SELECT * FROM usertable WHERE email = '$email'";
        $res = mysqli_query($con, $check_user);
        if(mysqli_num_rows($res) > 0){
          $info = "Hemos comprobado que es usted un miembro del sistema";
          $_SESSION['info'] = $info;
          $_SESSION['email'] = $email;
          header('location: ../paginaLogin/confirm-user.php');
          exit();
        }else{
            $errors['email'] = "¡Parece que aún no eres miembro!";
        }
    }

    if(isset($_POST['check-user1'])){
        $name = mysqli_real_escape_string($con, $_POST['name']);
        $mascota = mysqli_real_escape_string($con, $_POST['mascota']);
        $lugar = mysqli_real_escape_string($con, $_POST['lugar']);
        $email = $_SESSION['email'];
        $check_user = "SELECT * FROM usertable WHERE name = '$name' and mascota = '$mascota' and favorito = '$lugar'";
        $res = mysqli_query($con, $check_user);
        if(mysqli_num_rows($res) > 0){
          $info = "Hemos comprobado que es usted nuestro usuario $name, puede continuar";
          $_SESSION['info'] = $info;
          $_SESSION['email'] = $email;
          $_SESSION['name'] = $name;

          header('location: ../paginaLogin/confirm-user1.php');
          exit();
        }else{
            $errors['email'] = "¡Parece que tienes problemas para recordar tus preguntas...acercate a mesa de ayuda para resolverlos!";
        }
    }

    //if user click continue button in forgot password form
    use  PHPMailer\PHPMailer\PHPMailer ;
  	use  PHPMailer\PHPMailer\Exception ;

    if(isset($_POST['check-email'])){
      require_once  '../phpmailer/src/Exception.php' ;
    	require_once  '../phpmailer/src/PHPMailer.php' ;
    	require_once  '../phpmailer/src/SMTP.php' ;
        $email = $_SESSION['email'];
        $check_email = "SELECT * FROM usertable WHERE email='$email'";
        $run_sql = mysqli_query($con, $check_email);
        if(mysqli_num_rows($run_sql) > 0){
            $code = rand(999999, 111111);
            $insert_code = "UPDATE usertable SET code = $code WHERE email = '$email'";
            $run_query =  mysqli_query($con, $insert_code);
            if($run_query){
              $host='mail.leenhcraft.com';
              $user='cabanillas@leenhcraft.com';
              $pass='{K]#@?x4%v1_';
              $port='465';
              $mail = new PHPMailer(true);
              try {
                  //Server settings
                  $mail->SMTPDebug = 1;                      //Enable verbose debug output
                  $mail->isSMTP();                                            //Send using SMTP
                  $mail->Host       = $host;                     //Set the SMTP server to send through
                  $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
                  $mail->Username   = $user;                     //SMTP username
                  $mail->Password   = $pass;                               //SMTP password
                  $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
                  $mail->Port       = $port;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

                  $mail->setFrom($user, 'Cabanillas');
                  $mail->addAddress($email, "Contraseña");
                  //$mail->isHTML(true);                                  //Set email format to HTML
                  $mail->Subject = "Codigo de restablecimiento de passsword";
                  $mail->Body    = "Su código de restablecimiento de contraseña es $code";
                  $mail->AltBody = '';
                  $mail->send();
              		//return	true;
              } catch (Exception $e) {
              	//return false;
              	}
                $info = "Hemos enviado un restablecimiento de contraseña otp a su correo electrónico - $email";
                $_SESSION['info'] = $info;
                $_SESSION['email'] = $email;
                header('location: ../paginaLogin/reset-code.php');
                exit();
              /*  $subject = "Código de restablecimiento de contraseña";
                $message = "Su código de restablecimiento de contraseña es $code";
                $sender = "From: noreply@example.com";
                if(@mail($email, $subject, $message, $sender)){
                    $info = "Hemos enviado un restablecimiento de contraseña otp a su correo electrónico - $email";
                    $_SESSION['info'] = $info;
                    $_SESSION['email'] = $email;
                    header('location: ../paginaLogin/reset-code.php');
                    exit();
                }else{
                    $errors['otp-error'] = "¡Error al enviar el código!";
                }*/
            }else{
                $errors['db-error'] = "!Algo ha salido mal..ups¡";
            }
        }else{
            $errors['email'] = "¡Esta dirección de correo electrónico no existe!";
        }
    }

    //if user click check reset otp button
    if(isset($_POST['check-reset-otp'])){
        $_SESSION['info'] = "";
        $otp_code = mysqli_real_escape_string($con, $_POST['otp']);
        $check_code = "SELECT * FROM usertable WHERE code = $otp_code";
        $code_res = mysqli_query($con, $check_code);
        if(mysqli_num_rows($code_res) > 0){
            $fetch_data = mysqli_fetch_assoc($code_res);
            $email = $fetch_data['email'];
            $_SESSION['email'] = $email;
            $info = "Cree una nueva contraseña que no use en ningún otro sitio.";
            $_SESSION['info'] = $info;
            header('location: ../paginaLogin/new-password.php');
            exit();
        }else{
            $errors['otp-error'] = "¡Has introducido un código incorrecto!";
        }
    }

    //if user click change password button
    if(isset($_POST['change-password'])){
        $_SESSION['info'] = "";
        $password = mysqli_real_escape_string($con, $_POST['password']);
        $cpassword = mysqli_real_escape_string($con, $_POST['cpassword']);
        if($password !== $cpassword){
            $errors['password'] = "Confirmar contraseña no coincidente!";
        }else{
            $code = 0;
            $email = $_SESSION['email']; //getting this email using session
            $encpass = password_hash($password, PASSWORD_BCRYPT);
            $update_pass = "UPDATE usertable SET code = $code, password = '$encpass' WHERE email = '$email'";
            $run_query = mysqli_query($con, $update_pass);
            if($run_query){
                $info = "Su contraseña cambió. Ahora puede iniciar sesión con su nueva contraseña.";
                $_SESSION['info'] = $info;
                header('Location: ../paginaLogin/password-changed.php');
            }else{
                $errors['db-error'] = "¡Error al cambiar su contraseña!";
            }
        }
    }

   //if login now button click
    if(isset($_POST['login-now'])){
        header('Location: ../index.php');
    }
?>
