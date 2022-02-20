<?php
$title = "login";
include "includes/header.php";
include "./confing.php";
?>

<?php

$error = ["username" => '', "password" => ''];

if (isset($_POST["login"])) {

    $username = htmlspecialchars($_POST['username']);
    $password = htmlspecialchars($_POST['password']);

    if (empty($username)) {
        $error["username"] = "username is required";
    }

    if (empty($password)) {
        $error["password"] = "password is required";
    } else if (strlen($password) < 8) {
        $error["password"] = "password should be greater than 8 chars";
    } else {
        $query = mysqli_query($db, "SELECT * FROM `admin` WHERE `username`='$username' AND `password`='$password'");
        if (mysqli_num_rows($query)) {
            while ($row = mysqli_fetch_assoc($query)) {
                session_start();
                $_SESSION['login'] = true;
            }
            header("Location:index.php");
        } else {
            header("Location:login.php");
        }
    }
}

?>

<div class="container">

    <div class="row my-5 justify-content-center">
        <div class="col-md-4">
            <div class="card bg-dark opacity-75 text-white p-4 rounded-lg" class="opacity:0.5;">
                <h3 class="mb-4 text-center">Login</h3>
                <form action="<?php echo $_SERVER["PHP_SELF"] ?>" method="POST">
                    <div class="mb-3">
                        <label for="username">UserName</label>
                        <input type="text" name="username" id="username" class="form-control" required>
                        <small class="form-text text-danger"><?php echo $error["username"] ?></small>

                    </div>
                    <div class="mb-3">
                        <label for="password">Password</label>
                        <input type="password" name="password" id="password" class="form-control" min="8" required>
                        <small class="form-text text-danger"><?php echo $error["password"] ?></small>
                    </div>
                    <button type="submit" name="login" class="btn btn-outline-secondary btn-block">Login</button>
                </form>
            </div>
        </div>
    </div>
</div>

<?php include "includes/bottom.php" ?>
