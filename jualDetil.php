<?php 
	class JualDetil {
        private $jadi;
        private $faktur;
		private $tanggal;
		private $kd_cus = '';
		private $kd_aplikasi = '';
		private $kd_promo = '';
		private $kd_brg = '';
		private $banyak = '';
		private $harga = '';
		private $diskon = '';
		private $jumlah = '';
		private $faktur_refund = '';
		private $penyajian = '';
		private $harga_dasar = '';

		private $tbName = "daily_techno_jualdetil";   

		private $dbConn;

        function setJadi($jadi){$this->jadi = $jadi;}
		function getJadi() { return $this->jadi; }       
		function setFaktur($faktur){$this->faktur = $faktur;}
		function getFaktur() { return $this->faktur; }
		function setTanggal($tanggal){$this->tanggal = $tanggal;}
		function getTanggal() { return $this->tanggal; }
		function setKdCus($kd_cus){$this->kd_cus = $kd_cus;}
		function getKdCus() { return $this->kd_cus; }
		function setKdAplikasi($kd_aplikasi){$this->kd_aplikasi = $kd_aplikasi;}
		function getKdAplikasi() { return $this->kd_aplikasi; } 
		function setKdPromo($kd_promo){$this->kd_promo = $kd_promo;}
		function getKdPromo() { return $this->kd_promo; }
		function setKdBrg($kd_brg){$this->kd_brg = $kd_brg;}
		function getKdBrg() { return $this->kd_brg; }
		function setBanyak($banyak){$this->banyak = $banyak;}
		function getBanyak() { return $this->banyak; }
		function setHarga($harga){$this->harga = $harga;}
		function getHarga() { return $this->harga; }
		function setDiskon($diskon){$this->diskon = $diskon;}
		function getDiskon() { return $this->diskon; }
		function setJumlah($jumlah){$this->jumlah = $jumlah;}
		function getJumlah() { return $this->jumlah; }
		function setFakturRefund($faktur_refund){$this->faktur_refund = $faktur_refund;}
		function getFakturRefund() { return $this->faktur_refund; }
		function setPenyajian($penyajian){$this->penyajian = $penyajian;}
		function getPenyajian() { return $this->penyajian; }
		function setHargaDasar($harga_dasar){$this->harga_dasar = $harga_dasar;}
		function getHargaDasar() { return $this->harga_dasar; }
		

		public function __construct() {
			$db = new DbConnect();
			$this->dbConn = $db->connect();
		}

		public function getAllItemsDailyTechnoPenjualan() {

            $sql = "SELECT * FROM " . $this->tbName . " WHERE jadi = :jadi";

			$stmt = $this->dbConn->prepare($sql);
			$stmt->bindParam(':jadi', $this->jadi);
			$stmt->execute();
			$alatBayar = $stmt->fetchAll(PDO::FETCH_ASSOC);
			return $alatBayar;
		}

		public function insert() {
			
			$sql = 'INSERT INTO ' . $this->tbName . 
			'(jadi, faktur, tanggal, kd_cus, kd_aplikasi, kd_promo,
            kd_brg, banyak, harga, diskon, jumlah, faktur_refund,
            penyajian, harga_dasar)
			VALUES(:jadi, :faktur, :tanggal, :kd_cus, :kd_aplikasi, :kd_promo,
            :kd_brg, :banyak, :harga, :diskon, :jumlah, :faktur_refund,
            :penyajian, :harga_dasar)';

			$stmt = $this->dbConn->prepare($sql);
			$stmt->bindParam(':jadi', $this->jadi);
			$stmt->bindParam(':faktur', $this->faktur);
			$stmt->bindParam(':tanggal', $this->tanggal);
			$stmt->bindParam(':kd_cus', $this->kd_cus);
			$stmt->bindParam(':kd_aplikasi', $this->kd_aplikasi);
			$stmt->bindParam(':kd_promo', $this->kd_promo);
			$stmt->bindParam(':kd_brg', $this->kd_brg);
			$stmt->bindParam(':banyak', $this->banyak);
			$stmt->bindParam(':harga', $this->harga);
			$stmt->bindParam(':diskon', $this->diskon);
			$stmt->bindParam(':jumlah', $this->jumlah);
			$stmt->bindParam(':faktur_refund', $this->faktur_refund);
			$stmt->bindParam(':penyajian', $this->penyajian);
			$stmt->bindParam(':harga_dasar', $this->harga_dasar);

			if($stmt->execute()) {
				return true;
			} else {
				return false;
			}
		}
		
	}
 ?>