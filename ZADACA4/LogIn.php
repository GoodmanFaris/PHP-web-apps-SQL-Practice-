<?php
session_start();
require_once 'test.php';


$Trgovina = new Trgovina($dbHost, $dbUser, $dbPass, $dbName);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'] ?? '';
    $password = $_POST['pwd'] ?? '';
    if($email == 'admin@pmf.unsa.ba' && $password == $Trgovina->ALogIn($email)){
        header ("Location: Admin.php");
    }
    else if($Trgovina->LogIn($email, $password)){
      $_SESSION['Email'] = $email;
      header("Location: User.php");
    }
    else{
        echo "<script>alert('Pogresno unesnes mail ili password');</script>";
    }
}

?>


<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>naslov</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>
<body>
<div class="container-fluid bg-info">
    <h1>Online trgovina</h1>
    <h3>Zadaca 4 Faris Lindov</h3>
    <br>
  </div>
    <div class="container">
      <h2>Log in:</h2>
      <form class="form-horizontal" method="POST" action="LogIn.php">
        <div class="form-group">
          <label class="control-label col-sm-2" for="email">Email:</label>
          <div class="col-sm-10">
            <input type="email" class="form-control" id="email" placeholder="Unesi email" name="email">
          </div>
        </div>
        <div class="form-group">
          <label class="control-label col-sm-2" for="pwd">Password:</label>
          <div class="col-sm-10">          
            <input type="password" class="form-control" id="pwd" placeholder="Unesi password" name="pwd">
          </div>
        </div>
        <div class="form-group">        
          <div class="col-sm-offset-2 col-sm-10">
            <button type="submit" class="btn btn-default btn-info">Submit</button>
          </div>
        </div>
      </form>
      <div class = "container"><p>Niste registovani? Idite na <a href ="index.php">REGISTRACIJA</a></p></div>
    </div>
</body>
</html>