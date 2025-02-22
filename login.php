<?php
include './db/connection.php';
session_start();

if (isset($_POST['login'])) {
    $username = htmlspecialchars($_POST['username']);
    $password = htmlspecialchars($_POST['password']);
    $_SESSION['admin'] = false;

    if (empty($username) || empty($password)) {
        echo "<script>alert('Please fill in all the fields')</script>";
    } else {
        $admin = "SELECT full_name, username, password FROM admin WHERE adminID = 1";
        $result = mysqli_query($conn, $admin);
        $row = mysqli_fetch_assoc($result);

        // Check if username and password match
        if ($username == $row['username'] && $password == $row['password']) {
            $_SESSION['admin'] = true;
            $_SESSION['username'] = $username;
            $_SESSION['full_name'] = $row['full_name'];
            header("Location: dashboard.php");
        } else {
            echo "<script>alert('Username or password is incorrect')</script>";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <link rel="apple-touch-icon" sizes="180x180" href="res/img/apple-touch-icon.png">
<link rel="icon" type="image/png" sizes="32x32" href="res/img/favicon-32x32.png">
<link rel="icon" type="image/png" sizes="16x16" href="res/img/favicon-16x16.png">
<link rel="manifest" href="res/img/site.webmanifest">
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
   
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.7.1/chart.min.js"></script>
    <title>Login</title>
</head>
<style>
   body {
  font-family: 'Arial', sans-serif;
  background-color: #f2f2f2;
  margin: 0;
  display: flex;
  justify-content: center;
  align-items: center;
  height: 100vh;
}

.container {
  width: 100%;
  max-width: 400px;
  padding: 20px;
  box-sizing: border-box;
}

.login-card {
  background-color: #fff;
  box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
  border-radius: 5px;
  overflow: hidden;
}

.login-card-header {
  background-color: #00215E;
  color: #fff;
  text-align: center;
  padding: 15px;
}

.login-card-body {
  padding: 20px;
}

.form-group {
  margin-bottom: 15px;
}

label {
  display: block;
  margin-bottom: 5px;
  color: #333;
}

input {
  width: 100%;
  padding: 8px;
  box-sizing: border-box;
  border: 1px solid #ccc;
  border-radius: 3px;
}

.login-btn {
  width: 100%;
  padding: 10px;
  box-sizing: border-box;
  background-color: #00215E;
  color: #fff;
  border: none;
  border-radius: 3px;
  cursor: pointer;
}

.login-btn:hover {
  background-color: #002C7D;
}
</style>
<body>




<div class="container">
  <div class="login-card">
    <div class="login-card-header">
      <h2>SPCPTA | LOGIN</h2>
    </div>
    <div class="login-card-body">
      <form action="login.php" method="POST">
        <div class="form-group">
          <label for="username">Username:</label>
          <input class="input-field" type="text"  name="username">
        </div>
        <div class="form-group">
          <label for="password">Password:</label>
         <input class="input-field" type="password" name="password">
        </div>
        <button type="submit" class="login-btn" name="login" >Login</button>
      </form>
    </div>
  </div>
</div>



<script>
    var closeBtn = document.querySelector(".closebtn");
    closeBtn.onclick = function () {
        var div = this.parentElement;
        div.style.opacity = "0";
        setTimeout(function () {
            div.style.display = "none";
        }, 600);
    }
</script>

<script>
    // for loading page
    const header = document.querySelector("header");
    const container = document.querySelector(".container");
    const loading = document.querySelector(".loading");

    header.style.display = 'none';
    container.style.display = 'none';

    setTimeout(function () {
        loading.style.display = 'none';
        header.style.display = 'block';
        container.style.display = 'flex';
    }, 2000);

</script>
</body>
</html>