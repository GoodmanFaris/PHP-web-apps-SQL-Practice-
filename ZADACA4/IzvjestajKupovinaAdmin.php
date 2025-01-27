<?php

require_once 'test.php';

$Trgovina = new Trgovina($dbHost, $dbUser, $dbPass, $dbName);
$Narudzbe = $Trgovina->SveNarudzbe();


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
    <h3>Izvjestaj o narudzbama|<a href="Admin.php"><h5>Izvještaj produkata</h5></a></h3>
    <br>
  </div>
    <div class="container">
        
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Korisnik ID</th>
                    <th>Datum i vrijeme kreiranja</th>
                    <th>Status</th>
                    <th>Ukupna cijena</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($Narudzbe)): ?>
                    <?php foreach ($Narudzbe as $Narudzba): ?>
                        <tr>
                            <td><?= htmlspecialchars($Narudzba['ID']) ?></td>
                            <td><?= htmlspecialchars($Narudzba['KorisnikID']) ?></td>
                            <td><?= htmlspecialchars($Narudzba['DatumKreiranja']) ?></td>
                            <td><?= htmlspecialchars($Narudzba['Status']) ?></td>
                            <td><?= htmlspecialchars($Narudzba['cijena_narudzbe(ID)']) ?></td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="5">Nema narudzbi.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
        <h5><a href="index.php">Povratak na pocetnu stranicu</a></h5>
    </div>

</body>
</html>
