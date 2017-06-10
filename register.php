<?php
/*
nom
prenom
numero de telephone
adresse
sexe
wilaya
*/
session_start();
if (isset($_SESSION['user_id'])) {// if user already have a session
    header('location:index.php');
}
if (isset($_POST['submitted'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];
    $password2 = $_POST['password2'];
    if ($password == $password2) {// == verifie la valeur de chacun === vefirie la valeur + le type
        $connect = mysqli_connect("localhost", "root", "", "gdglearning");
        $query = "INSERT INTO `users`(`user_id`, `user_email`, `user_pass`) VALUES (NULL,'$email','$password')
;";
        $result = mysqli_query($connect, $query);
        if ($result) {
            echo 'user successfully registered';
        }
    }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Home Page</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
</head>
<body>

<div class="container">
    <div class="jumbotron col-md-6 col-md-offset-3" style="padding-top: O; padding-bottom: 0;">
        <h2>WebApp Registration Page</h2>
    </div>
    <form action="register.php" method="post">
        <div class="form-group col-md-6 col-md-offset-3">
            <label for="email">Email Address</label>
            <input type="email" name="email" class="form-control" placeholder="Email Address" id="email" required>
        </div>
        <div class="form-group col-md-6 col-md-offset-3">
            <label for="password">Password</label>
            <input type="password" name="password" class="form-control" placeholder="Password" id="password" required>
        </div>
        <div class="form-group col-md-6 col-md-offset-3">
            <label for="password2">Confirm Password</label>
            <input type="password" name="password2" class="form-control" placeholder="Confirm Password" id="password2"
                   required onblur="checkPassword();">
            <p id="passwordError" style="color: red;"></p>
        </div>

        <div class="checkbox col-md-6 col-md-offset-3">
            <label><a href="login.php">Sign In</a></label>
        </div>
        <div class="col-md-6 col-md-offset-3">
            <input type="hidden" name="submitted" value="TRUE">
            <button type="submit" class="btn btn-lg btn-primary btn-block">Sign Up</button>
        </div>
    </form>
</div>
</body>
<script>
    function checkPassword() {
        var password = document.getElementById('password').value;
        var password2 = document.getElementById('password2').value;
        if (password !== password2) {
            document.getElementById('passwordError').innerHTML = "Passwords not match";
        }
    }
</script>
</html>
