<?php
$dbHost = 'localhost';
$dbUser = 'root';
$dbPass = '1134';
$dbName = 'Online_Trgovina';

class Trgovina {
  
	private $konekcija;

    public function __construct($dbHost, $dbKorisnik, $dbLozinka, $dbIme) {
        $this->konekcija = new mysqli($dbHost, $dbKorisnik, $dbLozinka, $dbIme);
        if ($this->konekcija->connect_error) {
            die("Konekcija nije uspjela: " . $this->konekcija->connect_error);
        }
    }

    public function UnosKorisnika($username, $email, $password) {
        $stmt = $this->konekcija->prepare("CALL unesi_korinika(?, ?, ?)");
        $stmt->bind_param("sss", $username, $email, $password);
        $stmt->execute();
        $stmt->close();
    }

    public function korisnikPostoji($email, $password) {
        $stmt = $this->konekcija->prepare("SELECT COUNT(*) FROM KORISNIK WHERE Email = ? AND Lozinka = ?");
        $stmt->bind_param("ss", $email, $password);
        $stmt->execute();
        $stmt->bind_result($count);
        $stmt->fetch();
        $stmt->close();
    
        return $count > 0;
    }

    public function ALogIn($email){
        $stmt = $this->konekcija->prepare("SELECT Lozinka FROM KORISNIK WHERE Email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();
        $stmt->close();

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            return $row['Lozinka'];
        } else {
            return null;
        }

    }


    public function LogIn($email, $password) {
        $stmt = $this->konekcija->prepare("SELECT COUNT(*) FROM KORISNIK WHERE Email = ? AND Lozinka = ?");
        $stmt->bind_param("ss", $email, $password);
        $stmt->execute();
        $stmt->bind_result($count);
        $stmt->fetch();
        $stmt->close();
    
        return $count > 0;
    }

    public function SviProdukti() {
        $stmt = $this->konekcija->prepare("SELECT * FROM PROIZVOD");
        $stmt->execute();
        $result = $stmt->get_result(); 
        $stmt->close();
        return $result->fetch_all(MYSQLI_ASSOC); 
    }
    
    public function UnosProizvoda($naziv, $cijena, $zalihe) {
        $stmt = $this->konekcija->prepare("CALL unesi_proizvod(?, ?, ?)");
        $stmt->bind_param("sdi", $naziv, $cijena, $zalihe); 
        $stmt->execute();
        $stmt->close();
    }

    public function AzurirajProizvod($id, $naziv, $cijena, $zalihe) {
        $stmt = $this->konekcija->prepare("CALL azuriraj_proizvod(?, ?, ?, ?)");
        $stmt->bind_param("isdi", $id, $naziv, $cijena, $zalihe); 
        $stmt->execute();
        $stmt->close();
    }

    public function ObrisiProizvod($id) {
        $stmt = $this->konekcija->prepare("CALL obrisi_proizvod(?)");
        $stmt->bind_param("i", $id); 
        $stmt->execute();
        $stmt->close();
    }

    public function SveNarudzbe() {
        $stmt = $this->konekcija->prepare("CALL Narudzbe_admin()");
        $stmt->execute();
        $result = $stmt->get_result(); 
        $stmt->close();
        return $result->fetch_all(MYSQLI_ASSOC); 
    }

    public function UnosNarudzbe($userEmail, $naziv, $kolicina) {
        $stmt = $this->konekcija->prepare("CALL Narudzba_proizvodi(?, ?, ?)");
        $stmt->bind_param("ssi", $userEmail, $naziv, $kolicina); 
        $stmt->execute();
        $stmt->close();
    }

    public function AzurirajZalihe($naziv, $kolicina) {
        $stmt = $this->konekcija->prepare("CALL azuriraj_zalih(?, ?)");
        $stmt->bind_param("si",$naziv, $kolicina); 
        $stmt->execute();
        $stmt->close();
    }

    public function IzvjestajNarudzbi($userEmail) {
        $stmt = $this->konekcija->prepare("CALL Izvjestaj_narudzbe(?)");
        $stmt->bind_param("s", $userEmail); 
        $stmt->execute();
        $result = $stmt->get_result();
        
        $data = $result->fetch_all(MYSQLI_ASSOC);
        $stmt->close();
        return $data; 
    }
    

    
}
?>