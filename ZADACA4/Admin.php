<?php
require_once 'test.php';

$Trgovina = new Trgovina($dbHost, $dbUser, $dbPass, $dbName);
$products = $Trgovina->SviProdukti();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $action = $_POST['action'] ?? '';

  if ($action === 'insert') {
      $naziv = $_POST['naziv'] ?? '';
      $cijena = filter_var($_POST['cijena'] ?? '', FILTER_VALIDATE_FLOAT);
      $zalihe = filter_var($_POST['zalihe'] ?? '', FILTER_VALIDATE_INT);

      if ($naziv && $cijena !== false && $zalihe !== false) {
          $Trgovina->UnosProizvoda($naziv, $cijena, $zalihe);
      }
      header("Location: Admin.php");
    } elseif ($action === 'update') {
    $id = filter_var($_POST['IDU'] ?? '', FILTER_VALIDATE_INT);
    $naziv = $_POST['nazivU'] ?? '';
    $cijena = filter_var($_POST['cijenaU'] ?? '', FILTER_VALIDATE_FLOAT);
    $zalihe = filter_var($_POST['zaliheU'] ?? '', FILTER_VALIDATE_INT);

    if ($id && ($naziv || $cijena !== false || $zalihe !== false)) {
        $Trgovina->AzurirajProizvod($id, $naziv, $cijena, $zalihe);
    }
    header("Location: Admin.php");
  }elseif ($action === 'delete') {
    $id = filter_var($_POST['IDD'] ?? '', FILTER_VALIDATE_INT);

    if ($id) {
        $Trgovina->ObrisiProizvod($id);
    }
    header("Location: Admin.php");
  } 
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin Panel</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>
<body>
<div class="container-fluid bg-info">
    <h1>Dobrodošao Admin</h1>
    <h3>Izvještaj produkata |<a href="IzvjestajKupovinaAdmin.php"><h5>Izvjestaj o narudzbama</h5></a></h3>
    <br>
  </div>
       
        <div class="container">
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
    </div>

    <div class="container" style="border: 1px black solid; border-radius: 10px; padding: 20px;">
        <h4>Unos podatka:</h4>
        <form class="form-horizontal" method="POST" action="Admin.php">
            <input type="hidden" name="action" value="insert">
            <div class="form-group">
                <label for="naziv">Naziv:</label>
                <input type="text" class="form-control" id="naziv" name="naziv" placeholder="Naziv produkta">
            </div>
            <div class="form-group">
                <label for="cijena">Cijena:</label>
                <input type="number" class="form-control" id="cijena" name="cijena" placeholder="Cijena" step="0.01">
            </div>
            <div class="form-group">
                <label for="zalihe">Zalihe:</label>
                <input type="number" class="form-control" id="zalihe" name="zalihe" placeholder="Zaliha">
            </div>
            <button type="submit" class="btn btn-success">Unos</button>
        </form>
    </div>
    <br>
    <div class="container" style="border: 1px black solid; border-radius: 10px; padding: 20px;">
        <h4>Update proizvod:</h4>
        <form class="form-horizontal" method="POST" action="Admin.php">
            <input type="hidden" name="action" value="update">
            <div class="form-group">
                <label for="IDU">ID:</label>
                <input type="text" class="form-control" id="IDU" name="IDU" placeholder="ID produkta">
            </div>
            <div class="form-group">
                <label for="nazivU">Naziv:</label>
                <input type="text" class="form-control" id="nazivU" name="nazivU" placeholder="Product name">
            </div>
            <div class="form-group">
                <label for="cijenaU">Cijena:</label>
                <input type="number" class="form-control" id="cijenaU" name="cijenaU" placeholder="Cijena" step="0.01">
            </div>
            <div class="form-group">
                <label for="zaliheU">Zaliha:</label>
                <input type="number" class="form-control" id="zaliheU" name="zaliheU" placeholder="Zaliha">
            </div>
            <button type="submit" class="btn btn-info">Update</button>
        </form>
    </div>
    <br>
    <div class="container" style="border: 1px black solid; border-radius: 10px; padding: 20px;">
        <h4>Izbrisi proizvod:</h4>
        <form class="form-horizontal" method="POST" action="Admin.php">
            <input type="hidden" name="action" value="delete">
            <div class="form-group">
                <label for="IDD">ID:</label>
                <input type="number" class="form-control" id="IDD" name="IDD" placeholder="ID produkta">
            </div>
            <button type="submit" class="btn btn-danger">Izbrisi</button>
        </form>
    </div>
    <div class = "container"><h5><a href="index.php">Povratak na pocetnu stranicu</a></h5></div>
</body>
</html>
