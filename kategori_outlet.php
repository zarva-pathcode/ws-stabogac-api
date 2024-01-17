<?php 
	class KategoriOutlet {
		private $id_kat;
		private $nama_kategori;
		private $tableName = 'kategori_outlet';
		private $dbConn;

		function setIdKat($id_kat) { $this->id_kat = $id_kat; }
		function setNamaKategori($nama_kategori) { $this->nama_kategori = $nama_kategori; }
		// function getKdCus() { return $this->kdCus; }

		public function __construct() {
			$db = new DbConnect();
			$this->dbConn = $db->connect();
		}

	
		public function getKategoriOutletByKdIdKat() {

			$sql = "SELECT * FROM ". $this->tableName. "  
					WHERE id_kat = :id_kat";

			$stmt = $this->dbConn->prepare($sql);
			$stmt->bindParam(':id_kat', $this->id_kat);
			$stmt->execute();
			$katOutlet = $stmt->fetch(PDO::FETCH_ASSOC);
			return $katOutlet;
		}


	}
 ?>