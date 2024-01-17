<?php
class Barang
{
	private $kdJenis;
	private $jadi;
	private $kdBarang;
	private $idKat;
	private $kdKota;
	private $tableName = 'barang';
	private $dbConn;

	function setKdJenis($kdJenis)
	{
		$this->kdJenis = $kdJenis;
	}
	function setJadi($jadi)
	{
		$this->jadi = $jadi;
	}
	function setKdBarang($kdBarang)
	{
		$this->kdBarang = $kdBarang;
	}
	function setIdKat($idKat)
	{
		$this->idKat = $idKat;
	}
	function setKdKota($kdKota)
	{
		$this->kdKota = $kdKota;
	}


	public function __construct()
	{
		$db = new DbConnect();
		$this->dbConn = $db->connect();
	}

	public function getAllItems()
	{
		$stmt = $this->dbConn->prepare("SELECT * FROM " . $this->tableName);
		$stmt->execute();
		$customers = $stmt->fetchAll(PDO::FETCH_ASSOC);
		return $customers;
	}

	public function getItemByKdBarang()
	{

		$sql = "SELECT * FROM barang WHERE kd_brg = :kd_brg";

		$stmt = $this->dbConn->prepare($sql);
		$stmt->bindParam(':kd_brg', $this->kdBarang);
		$stmt->execute();
		$barang = $stmt->fetchAll(PDO::FETCH_ASSOC);
		return $barang;
	}

	public function getItemsByKdJenis()
	{

		$sql = "SELECT * FROM barang WHERE kd_jenis = :kd_jenis";

		$stmt = $this->dbConn->prepare($sql);
		$stmt->bindParam(':kd_jenis', $this->kdJenis);
		$stmt->execute();
		$barang = $stmt->fetchAll(PDO::FETCH_ASSOC);
		return $barang;
	}

	public function getItemByKdKota()
	{
		$sql = "SELECT * FROM barang_kota WHERE jadi = :jadi";

		$stmt = $this->dbConn->prepare($sql);
		$stmt->bindParam(':jadi', $this->jadi);
		$stmt->execute();
		$barang = $stmt->fetchAll(PDO::FETCH_ASSOC);
		return $barang;
	}

	public function getItemByKdKotaAndIdKat()
	{

		if ($this->idKat == 1) {

			$sql = "SELECT bk.kd_brg,bk.kd_kota,bk.harga 
				AS harga,b.nama,b.photo 
				FROM barang_kota as bk 
				RIGHT JOIN barang as b ON bk.kd_brg= b.kd_brg
				WHERE 
				bk.kd_brg = :kd_brg AND
				bk.kd_kota=:kd_kota  AND 
				bk.kd_aplikasi = '11' AND
				b.nama!='' AND
				bk.harga!=0 
				ORDER BY b.rating DESC";

			$stmt = $this->dbConn->prepare($sql);
			$stmt->bindParam(':kd_kota', $this->kdKota);
			$stmt->bindParam(':kd_brg', $this->kdBarang);
			$stmt->execute();
			$data = $stmt->fetchAll(PDO::FETCH_ASSOC);
			return $data;
		} elseif ($this->idKat == 2) {

			$sql = "SELECT bk.kd_brg,bk.kd_kota,bk.harga_cafe 
				AS harga,b.nama,b.photo 
				FROM barang_kota as bk 
				RIGHT JOIN barang as b ON bk.kd_brg=b.kd_brg 
				WHERE 
				bk.kd_brg=:kd_brg AND
				bk.kd_kota=:kd_kota  AND 
				bk.kd_aplikasi = '11' AND
				b.nama!='' AND 
				bk.harga_cafe>0 
				ORDER BY b.rating DESC";

			$stmt = $this->dbConn->prepare($sql);
			$stmt->bindParam(':kd_kota', $this->kdKota);
			$stmt->bindParam(':kd_brg', $this->kdBarang);
			$stmt->execute();
			$data = $stmt->fetchAll(PDO::FETCH_ASSOC);
			return $data;
		} elseif ($this->idKat == 3) {

			$sql = "SELECT bk.kd_brg,bk.kd_kota,bk.harga_spot 
				AS harga,b.nama,b.photo 
				FROM barang_kota AS bk 
				RIGHT JOIN barang as b ON bk.kd_brg=b.kd_brg 
				WHERE 
				bk.kd_brg=:kd_brg AND
				bk.kd_kota=:kd_kota  AND 
				bk.kd_aplikasi = '11' AND
				b.nama!='' AND 
				bk.harga_spot>0
				ORDER BY b.rating DESC";

			$stmt = $this->dbConn->prepare($sql);
			$stmt->bindParam(':kd_kota', $this->kdKota);
			$stmt->bindParam(':kd_brg', $this->kdBarang);
			$stmt->execute();
			$data = $stmt->fetchAll(PDO::FETCH_ASSOC);
			return $data;
		} elseif ($this->idKat == 4) {

			$sql = "SELECT bk.kd_brg,bk.kd_kota,bk.harga_express 
				AS harga,b.nama,b.photo 
				FROM barang_kota AS bk 
				RIGHT JOIN barang AS b ON bk.kd_brg=b.kd_brg 
				WHERE 
				bk.kd_brg=:kd_brg AND
				bk.kd_kota=:kd_kota  AND 
				bk.kd_aplikasi = '11' AND
				b.nama!='' AND 
				bk.harga_express>0
				ORDER BY b.rating DESC";

			$stmt = $this->dbConn->prepare($sql);
			$stmt->bindParam(':kd_kota', $this->kdKota);
			$stmt->bindParam(':kd_brg', $this->kdBarang);
			$stmt->execute();
			$data = $stmt->fetchAll(PDO::FETCH_ASSOC);
			return $data;
		}
	}
}
