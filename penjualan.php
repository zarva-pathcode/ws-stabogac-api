<?php 
	class Penjualan {
        private $faktur;
		private $tanggal;
		private $kd_cus = '';
		private $kd_aplikasi = '';
		private $no_meja = '';
		private $oleh = '';
		private $subjumlah = '';
		private $ppn = '';
		private $jumlah = '';
		private $byr_pocer = '';
		private $byr_tunai = '';
		private $byr_non_tunai= '';
		private $kd_alatbayar= '';
		private $no_urut= '';
		private $tahun= '';
		private $bulan= '';
		private $jam= '';
		private $kdsub_alatbayar = '';
		private $subjumlah_offline = '';
		private $ket_aplikasi = '';
		private $dasar_fee = '';
		private $acuan_fee = '';
		private $tarif_fee = '';
		private $b_paking = '';
		private $no_online = '';
		private $no_ofline = '';
		private $tarif_pb1 = '';
		private $faktur_refund = '';
		private $dasar_faktur = '';
		private $faktur_void = '';
		private $dibayar = '';
		private $no_ref = '';
		
		private $tbName = "daily_techno_penjualan";   

		private $dbConn;

        function setFaktur($faktur){$this->faktur = $faktur;}
		function getFaktur() { return $this->faktur; }
		function setTanggal($tanggal){$this->tanggal = $tanggal;}
		function getTanggal() { return $this->tanggal; }
		function setKdCus($kd_cus){$this->kd_cus = $kd_cus;}
		function getKdCus() { return $this->kd_cus; }	
		function setKdAplikasi($kd_aplikasi){$this->kd_aplikasi = $kd_aplikasi;}
		function getKdAplikasi() { return $this->kd_aplikasi; } 
		function setNoMeja($no_meja){$this->no_meja = $no_meja;}
		function getNoMeja() { return $this->no_meja; }
		function setOleh($oleh){$this->oleh = $oleh;}
		function getOleh() { return $this->oleh; }
		function setSubjumlah($subjumlah){$this->subjumlah = $subjumlah;}
		function getSubjumlah() { return $this->subjumlah; }
		function setPPN($ppn){$this->ppn = $ppn;}
		function getPPN() { return $this->ppn; }
		function setJumlah($jumlah){$this->jumlah = $jumlah;}
		function getJumlah() { return $this->jumlah; }
		function setByrPocer($byr_pocer){$this->byr_pocer = $byr_pocer;}
		function getByrPocer() { return $this->byr_pocer; }
		function setByrTunai($byr_tunai){$this->byr_tunai = $byr_tunai;}
		function getByrTunai() { return $this->byr_tunai; }
		function setByrNonTunai($byr_non_tunai){$this->byr_non_tunai = $byr_non_tunai;}
		function getByrNonTunai() { return $this->byr_non_tunai; }
		function setKdAlatBayar($kd_alatbayar){$this->kd_alatbayar = $kd_alatbayar;}
		function getKdAlatBayar() { return $this->kd_alatbayar; }
		function setNoUrut($no_urut){$this->no_urut = $no_urut;}
		function getNoUrut() { return $this->no_urut; }
		function setTahun($tahun){$this->tahun = $tahun;}
		function getTahun() { return $this->tahun; }
		function setBulan($bulan){$this->bulan = $bulan;}
		function getBulan() { return $this->bulan; }
		function setJam($jam){$this->jam = $jam;}
		function getJam() { return $this->jam; }
		function setKdsubAlatBayar($kdsub_alatbayar){$this->kdsub_alatbayar = $kdsub_alatbayar;}
		function getKdsubAlatBayar() { return $this->kdsub_alatbayar; }
		function setSubjumlahOffline($subjumlah_offline){$this->subjumlah_offline = $subjumlah_offline;}
		function getSubjumlahOffline() { return $this->subjumlah_offline; }
		function setSubjumlahOnline($subjumlah_offline){$this->subjumlah_offline = $subjumlah_offline;}
		function getSubjumlahOnline() { return $this->subjumlah_offline; }
		function setKetAplikasi($ket_aplikasi){$this->ket_aplikasi = $ket_aplikasi;}
		function getKetAplikasi() { return $this->ket_aplikasi; }
		function setDasarFee($dasar_fee){$this->dasar_fee = $dasar_fee;}
		function getDasarFee() { return $this->dasar_fee; }
		function setAcuanFee($acuan_fee){$this->acuan_fee = $acuan_fee;}
		function getAcuanFee() { return $this->acuan_fee; }
		function setTarifFee($tarif_fee){$this->tarif_fee = $tarif_fee;}
		function getTarifFee() { return $this->tarif_fee; }
		function setBpaking($b_paking){$this->b_paking = $b_paking;}
		function getBpaking() { return $this->b_paking; }
		function setNoOnline($no_online){$this->no_online = $no_online;}
		function getNoOnline() { return $this->no_online; }
		function setNoOfline($no_ofline){$this->no_ofline = $no_ofline;}
		function getNoOfline() { return $this->no_ofline; }
		function setOfline($no_ofline){$this->no_ofline = $no_ofline;}
		function getOfline() { return $this->no_ofline; }
		function setTarifpb1($tarif_pb1){$this->tarif_pb1 = $tarif_pb1;}
		function getTarifpb1() { return $this->tarif_pb1; }
		function setFakturRefund($faktur_refund){$this->faktur_refund = $faktur_refund;}
		function getFakturRefund() { return $this->faktur_refund; }
		function setDasar($dasar_faktur){$this->dasar_faktur = $dasar_faktur;}
		function getDasar() { return $this->dasar_faktur; }
		function setFakturVoid($faktur_void){$this->faktur_void = $faktur_void;}
		function getFakturVoid() { return $this->faktur_void; }
		function setDibayar($dibayar){$this->dibayar = $dibayar;}
		function getDibayar() { return $this->dibayar; }
		function setNoRef($no_ref){$this->no_ref = $no_ref;}
		function getNoRef() { return $this->no_ref; }

		public function __construct() {
			$db = new DbConnect();
			$this->dbConn = $db->connect();
		}

		public function getAllItemsDailyTechnoPenjualan() {

            $sql = "SELECT * FROM " . $this->tbName . " WHERE faktur = :faktur";

			$stmt = $this->dbConn->prepare($sql);
			$stmt->bindParam(':faktur', $this->faktur);
			$stmt->execute();
			$alatBayar = $stmt->fetchAll(PDO::FETCH_ASSOC);
			return $alatBayar;
		}

		public function insert() {
			
			$sql = 'INSERT INTO ' . $this->tbName . 
			'(faktur, tanggal, kd_cus, kd_aplikasi, no_meja, 
			oleh, subjumlah, ppn, jumlah, byr_pocer, byr_tunai, byr_non_tunai,
			kd_alatbayar, no_urut, tahun, bulan, jam, kdsub_alatbayar,
			subjumlah_offline, ket_aplikasi, dasar_fee, acuan_fee, tarif_fee, 
			b_paking, no_online, no_ofline, tarif_pb1, faktur_refund, 
			dasar_faktur, faktur_void, dibayar, no_ref) 
			VALUES (:faktur, :tanggal, :kd_cus, :kd_aplikasi, :no_meja, 
			:oleh, :subjumlah, :ppn, :jumlah, :byr_pocer, :byr_tunai, :byr_non_tunai,
			:kd_alatbayar, :no_urut, :tahun, :bulan, :jam, :kdsub_alatbayar,
			:subjumlah_offline, :ket_aplikasi, :dasar_fee, :acuan_fee, :tarif_fee, 
			:b_paking, :no_online, :no_ofline, :tarif_pb1, :faktur_refund, 
			:dasar_faktur, :faktur_void, :dibayar, :no_ref)';

			$stmt = $this->dbConn->prepare($sql);
			$stmt->bindParam(':faktur', $this->faktur);
			$stmt->bindParam(':tanggal', $this->tanggal);
			$stmt->bindParam(':kd_cus', $this->kd_cus);
			$stmt->bindParam(':kd_aplikasi', $this->kd_aplikasi);
			$stmt->bindParam(':no_meja', $this->no_meja);
			$stmt->bindParam(':oleh', $this->oleh);
			$stmt->bindParam(':subjumlah', $this->subjumlah);
			$stmt->bindParam(':ppn', $this->ppn);
			$stmt->bindParam(':jumlah', $this->jumlah);
			$stmt->bindParam(':byr_pocer', $this->byr_pocer);
			$stmt->bindParam(':byr_tunai', $this->byr_tunai);
			$stmt->bindParam(':byr_non_tunai', $this->byr_non_tunai);
			$stmt->bindParam(':kd_alatbayar', $this->kd_alatbayar);
			$stmt->bindParam(':no_urut', $this->no_urut);
			$stmt->bindParam(':tahun', $this->tahun);
			$stmt->bindParam(':bulan', $this->bulan);
			$stmt->bindParam(':jam', $this->jam);
			$stmt->bindParam(':kdsub_alatbayar', $this->kdsub_alatbayar);
			$stmt->bindParam(':subjumlah_offline', $this->subjumlah_offline);
			$stmt->bindParam(':ket_aplikasi', $this->ket_aplikasi);
			$stmt->bindParam(':dasar_fee', $this->dasar_fee);
			$stmt->bindParam(':acuan_fee', $this->acuan_fee);
			$stmt->bindParam(':tarif_fee', $this->tarif_fee);
			$stmt->bindParam(':b_paking', $this->b_paking);
			$stmt->bindParam(':no_online', $this->no_online);
			$stmt->bindParam(':no_ofline', $this->no_ofline);
			$stmt->bindParam(':tarif_pb1', $this->tarif_pb1);
			$stmt->bindParam(':faktur_refund', $this->faktur_refund);
			$stmt->bindParam(':dasar_faktur', $this->dasar_faktur);
			$stmt->bindParam(':faktur_void', $this->faktur_void);
			$stmt->bindParam(':dibayar', $this->dibayar);
			$stmt->bindParam(':no_ref', $this->no_ref);
			
			if($stmt->execute()) {
				return true;
			} else {
				return false;
			}
		}
		
	}
 ?>