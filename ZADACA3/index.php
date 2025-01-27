<?php

require_once 'klase.php';

$ServerName = "DESKTOP-C7RFM5F\SQLEXPRESS";
$database = "FarisLindovZadacaTri";
$uid = "";
$pass = "";

$studentObj = new Student_fax($ServerName, $uid, $pass, $database);
$ima_podataka=false;	

if(!isset($_GET['o'])){ 
	if($podaci=$studentObj->citajStudenta(NULL)){
		$ID=$podaci['id'];$ima_podataka=true;
	}	
}
else{
	switch($_GET['o']){
		case 'F'://prvi slog u tabeli
			//$podaci=$studentObj->citajStudenta(NULL);
			if($podaci=$studentObj->citajPrvogStudenta()){
				$ID=$podaci['id'];$ima_podataka=true;
			}
			
			break;
			
		case 'L'://posljednji slog u tabeli
			if($podaci=$studentObj->citajPosljednjegStudenta()){
				$ID=$podaci['id'];$ima_podataka=true;
			}
			break;
			
		case 'P'://prethodno slog u tabeli
			if($podaci=$studentObj->citajPrethodnogStudenta($_POST['rbs'])){
				$ID=$podaci['id'];$ima_podataka=true;
			}
			else {//ostani kod trenutnog studenta
				$podaci=$studentObj->citajStudenta($_POST['rbs']);
			    $ID=$podaci['id'];$ima_podataka=true;
			}
			break;
		case 'N'://sljedeci slog u tabeli
			if($podaci=$studentObj->citajSljedecegStudenta($_POST['rbs'])){
				$ID=$podaci['id'];$ima_podataka=true;
			}
			else {//ostani kod trenutnog studenta
				$podaci=$studentObj->citajStudenta($_POST['rbs']);
			    $ID=$podaci['id'];$ima_podataka=true;
			}
			break;
		case 'I'://unos sloga
			$studentObj->unosStudenta($_POST['id'],$_POST['ime'],$_POST['prezime'],$_POST['adresa'],$_POST['indeks'],$_POST['fakultetid']);
			$podaci=$studentObj->citajStudenta($_POST['id']);
			$ID=$_POST['id'];$ima_podataka=true;	
			break;
		case 'U'://azuriranje sloga
			$studentObj->azurirajStudenta($_POST['id'],$_POST['ime'],$_POST['prezime'],$_POST['adresa'],$_POST['indeks'],$_POST['fakultetid']);
			$podaci=$studentObj->citajStudenta($_POST['id']);
			$ID=$_POST['id'];$ima_podataka=true;	
			
			break;
		case 'D'://brisanje sloga
			$studentObj->obrisiStudenta($_POST['rbs']);
			if($studentObj->citajPrvogStudenta()){// nakon brisanja idi na prvi
				$podaci=$studentObj->citajPrvogStudenta();
			    $ID=$podaci['id']; $ima_podataka=true;
			}
			else echo "Nema podataka u tabeli!";
			break;
		}
	}

//________________________
$studentObj1 = new Student_fax($ServerName, $uid, $pass, $database);
$ima_podataka1=false;	
if(!isset($_GET['f'])){ 
	if($podaci1=$studentObj1->citajFakultet(NULL)){
		$IDF=$podaci1['id'];$ima_podataka1=true;
	}	
}
else{
	switch($_GET['f']){
		case 'F':
			if($podaci1=$studentObj1->citajPrvogFakultet()){
				$IDF=$podaci1['id'];$ima_podataka1=true;
			}
			
			break;
		case 'L':
			if($podaci1=$studentObj1->citajPosljednjegFakultet()){
				$IDF=$podaci1['id'];$ima_podataka1=true;
			}
			break;
		case 'P':
			if($podaci1=$studentObj1->citajPrethodnogFakultet($_POST['rbsf'])){
				$IDF=$podaci1['id'];$ima_podataka1=true;
			}
			else {
				$podaci1=$studentObj1->citajFakultet($_POST['rbsf']);
				$IDF=$podaci1['id'];$ima_podataka1=true;
			}
			break;
		case 'N':
			if($podaci1=$studentObj1->citajSljedecegFakultet($_POST['rbsf'])){
				$IDF=$podaci1['id'];$ima_podataka1=true;
			}
			else {
				$podaci1=$studentObj1->citajFakultet($_POST['rbsf']);
				$IDF=$podaci1['id'];$ima_podataka1=true;
			}
			break;
		case 'I':
			$studentObj1->unosFakulteta($_POST['id'],$_POST['naziv'],$_POST['univerzitet'],$_POST['grad']);
			$podaci1=$studentObj1->citajFakultet($_POST['id']);
			$IDF=$_POST['id'];$ima_podataka1=true;	
			break;
		case 'U':
			$studentObj1->azurirajFakultet($_POST['id'],$_POST['naziv'],$_POST['univerzitet'],$_POST['grad']);
			$podaci1=$studentObj1->citajFakultet($_POST['id']);
			$IDF=$_POST['id'];$ima_podataka1=true;	
			
			break;
		case 'D':
			$studentObj1->obrisiFakultet($_POST['rbsf']);
			if($studentObj1->citajPrvogFakultet()){// nakon brisanja idi na prvi
				$podaci1=$studentObj1->citajPrvogFakultet();
				$IDF=$podaci1['id']; $ima_podataka1=true;
			}
			else echo "Nema podataka u tabeli!";
			break;
	}
}
	

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>CRUD Operacije</title>
</head>
<body style = "background-color: lightgray; font-family; arial;">
    <div style="margin-right:auto;margin-left:auto;border:3px navy solid; background-color: lightblue; width:400px; text-align:center; font-family; arial;" >
    <form method="post" action="">
	    <label style="color: darkblue;">ID...........</label><input type="text" name="id" value="<?php if($ima_podataka)echo $podaci['id']; ?>" /><br>
        <label style="color: darkblue;">Ime.........</label><input type="text" name="ime" value="<?php if($ima_podataka)echo $podaci['ime']; ?>"/><br>
        <label style="color: darkblue;">Prezime..</label><input type="text" name="prezime" value="<?php if($ima_podataka)echo $podaci['prezime']; ?>"/><br>
        <label style="color: darkblue;">Adresa....</label><input type="text" name="adresa" value="<?php if($ima_podataka)echo $podaci['adresa']; ?>"/><br>
        <label style="color: darkblue;">Indeks.......</label><input type="text" name="indeks" value="<?php if($ima_podataka)echo $podaci['indeks']; ?>"/><br><br>
        <label style="color: darkblue;">FakultetID...........</label><input type="text" name="fakultetid" value="<?php if($ima_podataka)echo $podaci['fakultetid']; ?>" /><br>


        <input type="hidden" name="rbs" value="<?php echo $ID; ?>" />
<input type="submit" name="prvi" value="Prvi" formaction="index.php?o=F" />
<input type="submit" name="pret" value="Prethodni" formaction="index.php?o=P" />
<input type="submit" name="unos" value="Unos" formaction="index.php?o=I" />
<input type="submit" name="azur" value="Ažuriranje" formaction="index.php?o=U" />
<input type="submit" name="bris" value="Brisanje" formaction="index.php?o=D" />
<input type="submit" name="sljed" value="Sljedeći" formaction="index.php?o=N" />
<input type="submit" name="zadnji" value="Zadnji" formaction="index.php?o=L" />


</div>

</form>
<div style="margin-right:auto;margin-left:auto;border:3px navy solid; background-color: lightblue; width:400px; text-align:center; font-family; arial;" >
    <form method="post" action="">
	    <label style="color: darkblue;">ID...........</label><input type="text" name="id" value="<?php if($ima_podataka)echo $podaci1['id']; ?>" /><br>
        <label style="color: darkblue;">Naziv.........</label><input type="text" name="naziv" value="<?php if($ima_podataka)echo $podaci1['naziv']; ?>"/><br>
        <label style="color: darkblue;">Univerzitet..</label><input type="text" name="univerzitet" value="<?php if($ima_podataka)echo $podaci1['univerzitet']; ?>"/><br>
        <label style="color: darkblue;">Grad....</label><input type="text" name="grad" value="<?php if($ima_podataka)echo $podaci1['grad']; ?>"/><br>
        


        <input type="hidden" name="rbsf" value="<?php echo $IDF; ?>" />
<input type="submit" name="prvi" value="Prvi" formaction="index.php?f=F" />
<input type="submit" name="pret" value="Prethodni" formaction="index.php?f=P" />
<input type="submit" name="unos" value="Unos" formaction="index.php?f=I" />
<input type="submit" name="azur" value="Ažuriranje" formaction="index.php?f=U" />
<input type="submit" name="bris" value="Brisanje" formaction="index.php?f=D" />
<input type="submit" name="sljed" value="Sljedeći" formaction="index.php?f=N" />
<input type="submit" name="zadnji" value="Zadnji" formaction="index.php?f=L" />


</div>

</form>
</body>
</html>