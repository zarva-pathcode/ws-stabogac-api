<?php 
	class AlatBayar {
        private $kdAlatBayar;
		private $kdSubAlatBayar;
		private $tbAlatBayar = 'alat_bayar';
		private $tbSubAlatBayar= 'subalat_bayar';

		private $dbConn;

        function setKdAlatBayar($kdAlatBayar){$this->kdAlatBayar = $kdAlatBayar;}
        function setKdSubAlatBayar($kdSubAlatBayar){$this->kdSubAlatBayar = $kdSubAlatBayar;}


		public function __construct() {
			$db = new DbConnect();
			$this->dbConn = $db->connect();
		}

		public function getItemByKdAlatBayar() {

            $sql = "SELECT * FROM " . $this->tbAlatBayar . " WHERE kd_alat = :kd_alat";

			$stmt = $this->dbConn->prepare($sql);
			$stmt->bindParam(':kd_alat', $this->kdAlatBayar);
			$stmt->execute();
			$alatBayar = $stmt->fetchAll(PDO::FETCH_ASSOC);
			return $alatBayar;
		}

		public function getItemByKdSubalatBayar() {

            $sql = "SELECT * FROM ". $this->tbSubAlatBayar ." WHERE kdsub_alat = :kdsub_alat";

			$stmt = $this->dbConn->prepare($sql);
			$stmt->bindParam(':kdsub_alat', $this->kdSubAlatBayar);
			$stmt->execute();
			$subalatBayar = $stmt->fetchAll(PDO::FETCH_ASSOC);
			return $subalatBayar;
		}

		
	}
 ?>