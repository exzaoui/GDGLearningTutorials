<?php
session_start();//init the session
if (isset($_SESSION['user_id'])) {// if user already have a session
    header('location:index.php');//redirect the user to the home page (index)
}
if (isset($_POST['submitted'])) { // check if the form is submitted
    $email = $_POST['email'];// get the email from the form
    $password = $_POST['password'];// get the password from the form

    $connect = mysqli_connect('localhost', 'root', '', 'gdglearning');//connexion a la base de donnée
    $query = "SELECT * FROM `users` WHERE user_email='$email' AND user_pass='$password' limit 1;";
    $result = mysqli_query($connect, $query);
    if ($result) {
        $num = mysqli_num_rows($result); //caluculer le nombre des utilisateurs trouvés
        if ($num > 0) {//check if the informations are correct
            $user_info = mysqli_fetch_assoc($result);// get the user informations into a variable(arrray)
            $_SESSION['user_id'] = $user_info['user_id'];
            $_SESSION['user_email'] = $user_info['user_email'];
            $_SESSION['user_name'] = $user_info['user_name'];
            header('location: index.php');
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
    <div class="jumbotron col-md-6 col-md-offset-3" style="padding-top: O; padding-bottom:  0;">
        <h2>WebApp Login Page</h2>
    </div>
    <form action="login.php" method="post">

        <div class="form-group col-md-6 col-md-offset-3">
            <label for="email">Email Address</label>
            <input type="email" name="email" class="form-control" placeholder="Email Address" id="email" required>
        </div>

        <div class="form-group col-md-6 col-md-offset-3">
            <label for="password">Password</label>
            <input type="password" name="password" class="form-control" placeholder="Password" id="password" required>
        </div>
        <div class="checkbox col-md-6 col-md-offset-3">
            <label><a href="register.html">Sign Up</a></label>
        </div>
        <div class="col-md-6 col-md-offset-3">
            <input type="hidden" name="submitted" value="TRUE">
            <button type="submit" class="btn btn-lg btn-primary btn-block">Sign In</button>
        </div>
    </form>
</div>
</body>
</html>
