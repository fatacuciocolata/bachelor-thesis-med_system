<?php
include 'inc/init.php';

$meta = array(
    'title' => 'Login - Sistem Administrare Pacienti'
);

if(isset($_POST['submit'])){
    $username = mysqli_real_escape_string($link, $_POST['user']);
    $parola = md5($_POST['parola']);
    $user = get_user($username, $parola);

    if (isset($user['id'])) {
        setcookie("user", $username, time() + COOKIE_EXPIRE_TIME);
        setcookie("parola", $parola, time() + COOKIE_EXPIRE_TIME);
        header('location: pacienti.php');
    } else {
        $error_happened = 'user sau parola incorecte!';
    }
}
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Login Sistem Administrare Pacienti</title>
        <script src="https://kit.fontawesome.com/e36e6e1086.js" crossorigin="anonymous"></script>

        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
        <link rel="stylesheet" href="style.css">

    </head>
 
    <body>
        <div class="container">
            <div class="col-md-6 login">
                <div class="heading">
                    <h3>Login SYSMed</h3>
                </div>
                <div class="body">
                <form  method="POST" action="login.php">
                    <div class="form-group">
                        <input name="user" type="text" class="form-control" placeholder="user" required>
                        <input name="parola" type="password" id="inputPassword" class="form-control" placeholder="parola" required>

                    </div>
                    
                    <div class="submit">
                        <input type="submit" class="btn btn-primary btn-login" name="submit" value="Login"/>
                    </div>
                    <small>user: urdea<br/>
                    parola: doctor</small>

                </form>
        
                <?php if(isset($error_happened)): ?>
                <div class="login-error"><?=$error_happened?> </div>
                <?php endif; ?>
                
                <?php if(isset($_GET['logout_success'])): ?>
                    <div class="logout-message">Te-ai delogat cu succes!</div>
                <?php endif; ?>
                </div>
        </div>
</html>
            
        