<?php 
	class Customer {
		private $kdCus;
		private $tableName = 'pelanggan';
		private $dbConn;

		function setKdCus($id) { $this->kdCus = $id; }
		function getKdCus() { return $this->kdCus; }

		public function __construct() {
			$db = new DbConnect();
			$this->dbConn = $db->connect();
		}

	
		public function getCustomerByKdCus() {

			$sql = "SELECT * FROM ". $this->tableName. "  
					WHERE kd_cus = :kd_cus";

			$stmt = $this->dbConn->prepare($sql);
			$stmt->bindParam(':kd_cus', $this->kdCus);
			$stmt->execute();
			$customer = $stmt->fetch(PDO::FETCH_ASSOC);
			return $customer;
		}


	}
 ?>