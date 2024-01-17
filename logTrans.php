<?php 
	class LogTrans {
        private $id_log;
		private $tanggal;
		private $jenis_transaksi;
		private $no_faktur;
		private $kd_cus;
		private $id_user;

		private $tbName = "daily_techno_log_trans";   

		private $dbConn;

        function setIdLog($id_log){$this->id_log = $id_log;}
		function getIdLog() { return $this->id_log; }
		function setTanggal($tanggal){$this->tanggal = $tanggal;}
		function getTanggal() { return $this->tanggal; }
		function setJenisTransaksi($jenis_transaksi){$this->jenis_transaksi = $jenis_transaksi;}
		function getJenisTransaksi() { return $this->jenis_transaksi; }
		function setNoFaktur($no_faktur){$this->no_faktur = $no_faktur;}
		function getNoFaktur() { return $this->no_faktur; }
		function setKdCus($kd_cus){$this->kd_cus = $kd_cus;}
		function getKdCus() { return $this->kd_cus; }
		function setIdUser($id_user){$this->id_user = $id_user;}
		function getIdUser() { return $this->id_user; }
		

		public function __construct() {
			$db = new DbConnect();
			$this->dbConn = $db->connect();
		}

		public function getAllItemsDailyTechnoPenjualan() {

            $sql = "SELECT * FROM " . $this->tbName . " WHERE id_log = :id_log";

			$stmt = $this->dbConn->prepare($sql);
			$stmt->bindParam(':id_log', $this->id_log);
			$stmt->execute();
			$alatBayar = $stmt->fetchAll(PDO::FETCH_ASSOC);
			return $alatBayar;
		}

		public function insert() {
			
			$sql = 'INSERT INTO ' . $this->tbName . 
			'(id_log, tanggal, jenis_transaksi, no_faktur, kd_cus, id_user) 
			VALUES(:id_log, :tanggal, :jenis_transaksi, :no_faktur, :kd_cus, :id_user)';

			$stmt = $this->dbConn->prepare($sql);
			$stmt->bindParam(':id_log', $this->id_log);
			$stmt->bindParam(':tanggal', $this->tanggal);
			$stmt->bindParam(':jenis_transaksi', $this->jenis_transaksi);
			$stmt->bindParam(':no_faktur', $this->no_faktur);
			$stmt->bindParam(':kd_cus', $this->kd_cus);
			$stmt->bindParam(':id_user', $this->id_user);

			if($stmt->execute()) {
				return true;
			} else {
				return false;
			}
		}
		
	}
 ?>