<?php

// Inicijalizacija konekcije
$ServerName = "DESKTOP-C7RFM5F\SQLEXPRESS";
$database = "FarisLindovZadacaTri";
$uid = "";
$pass = "";



class Student_fax {
  
    private $konekcija;

    public function __construct($ServerName, $uid, $pass, $database) {
        $connectionInfo = array("Database" => $database, "UID" => $uid, "PWD" => $pass);
        $this->konekcija = sqlsrv_connect($ServerName, $connectionInfo);
        
        if (!$this->konekcija) {
            die("Konekcija nije uspjela: " . print_r(sqlsrv_errors(), true));
        }
        
    }

    public function unosStudenta($id, $ime, $prezime, $adresa, $indeks, $idfakulteta) {
        $query = "{CALL UnosStudenta(?, ?, ?, ?, ?, ?)}";
        $params = array($id, $ime, $prezime, $adresa, $indeks, $idfakulteta);
        $stmt = sqlsrv_query($this->konekcija, $query, $params);

        if ($stmt === false) {
            die(print_r(sqlsrv_errors(), true));
        }

        sqlsrv_free_stmt($stmt);
    }

    public function azurirajStudenta($id, $ime, $prezime, $adresa, $indeks, $idfakulteta) {
        $query = "{CALL AzurirajStudenta(?, ?, ?, ?, ?, ?)}";
        $params = array($id, $ime, $prezime, $adresa, $indeks, $idfakulteta);
        $stmt = sqlsrv_query($this->konekcija, $query, $params);

        if ($stmt === false) {
            die(print_r(sqlsrv_errors(), true));
        }

        sqlsrv_free_stmt($stmt);
    }

    public function obrisiStudenta($id) {
        $query = "{CALL ObrisiStudenta(?)}";
        $params = array($id);
        $stmt = sqlsrv_query($this->konekcija, $query, $params);

        if ($stmt === false) {
            die(print_r(sqlsrv_errors(), true));
        }

        sqlsrv_free_stmt($stmt);
    }

    public function citajStudenta($id) {
        $query = "{CALL CitajStudenta(?)}";
        $params = array($id);
        $stmt = sqlsrv_query($this->konekcija, $query, $params);

        if ($stmt === false) {
            die(print_r(sqlsrv_errors(), true));
        }

        $data = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC);
        sqlsrv_free_stmt($stmt);
        return $data;
    }

    public function citajPrvogStudenta() {
        $query = "{CALL CitajStudenta(NULL)}";
        $stmt = sqlsrv_query($this->konekcija, $query);

        if ($stmt === false) {
            die(print_r(sqlsrv_errors(), true));
        }

        $data = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC);
        sqlsrv_free_stmt($stmt);
        return $data;
    }

    public function citajPrethodnogStudenta($id) {
        $query = "{CALL CitajPrethodnogStudenta(?)}";
        $params = array($id);
        $stmt = sqlsrv_query($this->konekcija, $query, $params);

        if ($stmt === false) {
            die(print_r(sqlsrv_errors(), true));
        }

        $data = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC);
        sqlsrv_free_stmt($stmt);
        return $data;
    }

    public function citajSljedecegStudenta($id) {
        $query = "{CALL CitajSljedecegStudenta(?)}";
        $params = array($id);
        $stmt = sqlsrv_query($this->konekcija, $query, $params);

        if ($stmt === false) {
            die(print_r(sqlsrv_errors(), true));
        }

        $data = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC);
        sqlsrv_free_stmt($stmt);
        return $data;
    }

    public function citajPosljednjegStudenta() {
        $query = "{CALL CitajPosljednjegStudenta()}";
        $stmt = sqlsrv_query($this->konekcija, $query);

        if ($stmt === false) {
            die(print_r(sqlsrv_errors(), true));
        }

        $data = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC);
        sqlsrv_free_stmt($stmt);
        return $data;
    }

    //__________________________________________________
    public function unosFakulteta($id, $naziv, $univerzitet, $grad) {
        $query = "{CALL UnosFakulteta(?, ?, ?, ?)}";
        $params = array($id, $naziv, $univerzitet, $grad);
        $stmt = sqlsrv_query($this->konekcija, $query, $params);

        if ($stmt === false) {
            die(print_r(sqlsrv_errors(), true));
        }

        sqlsrv_free_stmt($stmt);
    }

    public function azurirajFakultet($id, $naziv, $univerzitet, $grad) {
        $query = "{CALL AzurirajFakultet(?, ?, ?, ?)}";
        $params = array($id, $naziv, $univerzitet, $grad);
        $stmt = sqlsrv_query($this->konekcija, $query, $params);

        if ($stmt === false) {
            die(print_r(sqlsrv_errors(), true));
        }

        sqlsrv_free_stmt($stmt);
    }

    public function obrisiFakultet($id) {
        $query = "{CALL ObrisiFakultet(?)}";
        $params = array($id);
        $stmt = sqlsrv_query($this->konekcija, $query, $params);

        if ($stmt === false) {
            die(print_r(sqlsrv_errors(), true));
        }

        sqlsrv_free_stmt($stmt);
    }

    public function citajFakultet($id) {
        $query = "{CALL CitajFakultet(?)}";
        $params = array($id);
        $stmt = sqlsrv_query($this->konekcija, $query, $params);

        if ($stmt === false) {
            die(print_r(sqlsrv_errors(), true));
        }

        $data = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC);
        sqlsrv_free_stmt($stmt);
        return $data;
    }

    public function citajPrvogFakultet() {
        $query = "{CALL CitajFakultet(NULL)}";
        $stmt = sqlsrv_query($this->konekcija, $query);

        if ($stmt === false) {
            die(print_r(sqlsrv_errors(), true));
        }

        $data = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC);
        sqlsrv_free_stmt($stmt);
        return $data;
    }

    public function citajPrethodnogFakultet($id) {
        $query = "{CALL CitajPrethodniFakultet(?)}";
        $params = array($id);
        $stmt = sqlsrv_query($this->konekcija, $query, $params);

        if ($stmt === false) {
            die(print_r(sqlsrv_errors(), true));
        }

        $data = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC);
        sqlsrv_free_stmt($stmt);
        return $data;
    }

    public function citajSljedecegFakultet($id) {
        $query = "{CALL CitajSljedeciFakultet(?)}";
        $params = array($id);
        $stmt = sqlsrv_query($this->konekcija, $query, $params);

        if ($stmt === false) {
            die(print_r(sqlsrv_errors(), true));
        }

        $data = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC);
        sqlsrv_free_stmt($stmt);
        return $data;
    }

    public function citajPosljednjegFakultet() {
        $query = "{CALL CitajPosljednjiFakultet()}";
        $stmt = sqlsrv_query($this->konekcija, $query);

        if ($stmt === false) {
            die(print_r(sqlsrv_errors(), true));
        }

        $data = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC);
        sqlsrv_free_stmt($stmt);
        return $data;
    }
}

?>
