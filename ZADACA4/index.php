<?php
require_once 'test.php';


$Trgovina = new Trgovina($dbHost, $dbUser, $dbPass, $dbName);


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'] ?? '';
    $email = $_POST['email'] ?? '';
    $password = $_POST['pwd'] ?? '';

    if (!empty($username) && !empty($email) && !empty($password)) {
        if ($Trgovina->korisnikPostoji($email, $password)) {
            echo "<script>alert('Korisnik s istim emailom i lozinkom već postoji.');</script>";
        } else {
            $Trgovina->UnosKorisnika($username, $email, $password);
            header("Location: LogIn.php");
        }
    } else {
        echo "Molimo popunite sva polja.";
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
      <h2>Registracija:</h2>
      <form class="form-horizontal" method="POST" action="index.php">
        <div class="form-group">
          <label class="control-label col-sm-2" for="username">Naziv:</label>
          <div class="col-sm-10">
            <input type="text" class="form-control" id="username" placeholder="Unesi naziv" name="username">
          </div>
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
    </div>
    <div class = "container"><p>Vec ste registovani? Idite na <a href ="LogIn.php">LOG IN</a></p></div>
</body>
</html>
