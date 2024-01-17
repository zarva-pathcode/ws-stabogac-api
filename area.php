<?php 

class Area{
    private $kode;
    private $nama;
    private $employee_number;
    private $tableName = "area";
    private $dbConn;

    function setKode($kode){$this->kode = $kode;}
    function setJadi($nama){$this->nama = $nama;}
    // function setKode($kode){$this->kode = $kode;}

    public function __construct() {
        $db = new DbConnect();
        $this->dbConn = $db->connect();
    }

    public function getAllArea() {
        $stmt = $this->dbConn->prepare("SELECT * FROM " . $this->tableName);
        $stmt->execute();
        $areas = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $areas;
    }

    public function getAreaByKode() {
        $sql = "SELECT * FROM ". $this->tableName. "  
                WHERE kode = :kode";

        $stmt = $this->dbConn->prepare($sql);
        $stmt->bindParam(':kode', $this->kode);
        $stmt->execute();
        $area = $stmt->fetch(PDO::FETCH_ASSOC);
        return $area;
    }
}

?>