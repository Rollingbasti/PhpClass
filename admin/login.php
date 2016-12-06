<?php
require_once('../includes/config.php');

if ( $user->isLoggedIn()){
    header('Location: index.php');
}
?>

<!doctype html>
<html lang="de">
<head>
    <meta charset="utf-8">
    <title>Admin Login</title>
    <link rel="stylesheet" href="../style/normalize.css">
    <link rel="stylesheet" href="../style/main.css">
</head>
<body>

<div id="login">
    <?php
      if(isset($_POST['submit'])){

          $username = trim($_POST['username']);
          $password = trim($_POST['password']);

          if($user->login($username,$password)){
              header('Location: index.php');
              exit;
          } else {
              $message = '<p class="error">Wrong username or password</p>';
          }

      }

      if(isset($message)){
          echo $message;
      }  
    ?>

    <form action="" method="post">
    <p><label>Benutzername</label><input type="text" name="username" value="" /></p>
    <p><label>Passwort</label><input type="password" name="password" value="" /></p>
    <p><label></label><input type="submit" name="submit" value="Login" /></p>
    </form>
</div>
</body>
</html>