<?php
session_start();
require_once 'test.php';

$Trgovina = new Trgovina($dbHost, $dbUser, $dbPass, $dbName);
$products = $Trgovina->SviProdukti();

$userEmail = $_SESSION['Email'];
echo "<h1>Dobrodosli, $userEmail!</h1>";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $naziv = $_POST['naziv'] ?? '';
  $kolicina = filter_var($_POST['kolicina'] ?? '', FILTER_VALIDATE_INT);
  $Trgovina->UnosNarudzbe($userEmail, $naziv, $kolicina);
  $Trgovina->AzurirajZalihe($naziv, $kolicina);
  header("Location: User.php");
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
<div class="container">
        <h4>Katalog: </h4>
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Naziv</th>
                    <th>Cijena</th>
                    <th>Zaliha</th>
                    <th>Popust</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($products)): ?>
                    <?php foreach ($products as $product): ?>
                        <tr>
                            <td><?= htmlspecialchars($product['ID']) ?></td>
                            <td><?= htmlspecialchars($product['Naziv']) ?></td>
                            <td><?= htmlspecialchars($product['Cijena']) ?> KM</td>
                            <td><?= htmlspecialchars($product['Zaliha']) ?></td>
                            <td><?= htmlspecialchars($product['Popust']) ?>%</td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="5">Nema proizvoda.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
        <h4>Napravite narudzbu:</h4>
        <form class="form-horizontal" method="POST" action="User.php">
        <input type="hidden" name="action" value="insert">
          <div class="form-group">
          <label for="naziv">Proizvod:</label>
          <select class="form-control" id="naziv" name="naziv">
            <?php if (!empty($products)): ?>
                <?php foreach ($products as $product): ?>
                    <option value="<?= htmlspecialchars($product['Naziv']) ?>">
                        <?= htmlspecialchars($product['Naziv']) ?>
                    </option>
                <?php endforeach; ?>
            <?php else: ?>
                <option value="">Nema proizvoda</option>
            <?php endif; ?>
        </select>
    </div>
    <div class="form-group">
        <label for="zalihe">Kolicina:</label>
        <input type="number" class="form-control" id="kolicina" name="kolicina" placeholder="Kolicina">
    </div>
    <button type="submit" class="btn btn-success">Naruci</button>
</form>
    </div>
    <br>
    <div class="container"><h5><a href ="Narudzba.php"> Pregled svih narudzbi</a></h5>
    <h5><a href="index.php">Povratak na pocetnu stranicu</a></h5></div>
</body>
</html>