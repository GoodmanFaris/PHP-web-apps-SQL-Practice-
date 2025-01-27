<?php
session_start();
require_once 'test.php';

$Trgovina = new Trgovina($dbHost, $dbUser, $dbPass, $dbName);
$userEmail = $_SESSION['Email'];
$narudzbe = $Trgovina->IzvjestajNarudzbi($userEmail);
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
        <h2>Vase narudzbe</h2>
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>Datum</th>
                    <th>Status</th>
                    <th>Naziv</th>
                    <th>Kolicina</th>
                    <th>Ukupna cijena</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($narudzbe)): ?>
                    <?php foreach ($narudzbe as $narudzba): ?>
                        <tr>
                            <td><?= htmlspecialchars($narudzba['DatumKreiranja']) ?></td>
                            <td><?= htmlspecialchars($narudzba['Status']) ?></td>
                            <td><?= htmlspecialchars($narudzba['Naziv']) ?></td>
                            <td><?= htmlspecialchars($narudzba['Kolicina']) ?></td>
                            <td><?= htmlspecialchars($narudzba['cijena_narudzbe(N.ID)']) ?>KM</td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="5">Nema nista.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
        <h5><a href="index.php">Povratak na pocetnu stranicu</a></h5>
    </div>
</body>
</html>