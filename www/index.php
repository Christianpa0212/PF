<?php include("config/db.php"); ?>
<?php
if (isset($_SESSION['user_id'])) {
    header("Location: home.php");
    exit();
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style/index.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>Login</title>
</head>
<body>
  <div class="wrapper">
    <div class="container main">
        <div class="row">
            <div class="col-md-6 side-image">
                <img src="images/1.png" alt="">
                <div class="text">
                    <p>Elite Athletic <i>- E|A</i></p>
                </div>
            </div>

            <div class="col-md-6 right">
                <div class="input-box">
                   <header>Elite Athletic | Login</header>
                   <?php
                   if (isset($_GET['error'])) {
                       echo "<p style='color:red;'>Email o contraseña incorrectos.</p>";
                   }
                   ?>
                   <form action="login.php" method="POST">
                       <div class="input-field">
                            <input type="text" class="input" name="email" id="email" required="" autocomplete="off">
                            <label for="email">Email</label> 
                        </div> 
                       <div class="input-field">
                            <input type="password" class="input" name="password" id="pass" required="">
                            <label for="pass">Password</label>
                        </div> 
                       <div class="input-field">
                            <input type="submit" class="submit" value="Iniciar Sesión">
                       </div> 
                   </form>
                </div>  
            </div>
        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
</body>
</html>
