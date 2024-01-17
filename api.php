<?php 

    class Api extends Rest{
        public function __construct()
        {
            parent::__construct(); 
        }

        public function generateToken(){
            $email = $this->validateParameter("email",$this->param["email"],STRING);
            $pass = $this->validateParameter("pass",$this->param["pass"],STRING);

            try {

                if ($email !== "stabogactechno@wssteak.co.id" || $pass !== "stabowssteak1234") {
					$this->returnResponse(INVALID_USER_PASS, "Email or Password is incorect");
				}
    
                $payload = [
                    "iat" => time(),
                    "iss" => "localhost",
                    "exp" => time()+(15*60),
                    "email" => $email
                ];
    
                $token = JWT::encode($payload, SECRETE_KEY);
                
                $data = ["token" => $token];
                $this->returnResponse(SUCCESS_RESPONSE, $data);
            } catch (Exception $e) {
                $this->throwError(JWT_PROCESSING_ERROR, $e->getMessage());
            }
        }

        public function getAllItemsBarangKd_brg() {
			$tableName = "barang";

			$stmt = $this->dbConn->prepare("SELECT * FROM " . $tableName);
			$stmt->execute();
			$response = $stmt->fetchAll(PDO::FETCH_ASSOC);
			$this->returnResponse(SUCCESS_RESPONSE, $response);
		}

        public function getItemBarangByKd_brg(){
            $kdBarang = $this->validateParameter("kd_brg",$this->param["kd_brg"],STRING);

            $brg = new Barang;
            $brg->setKdBarang($kdBarang);
            $barang = $brg->getItemByKdBarang();

            if (!is_array($barang)) {
                $this->returnResponse(SUCCESS_RESPONSE,["message"=> "Barang tidak ditemukan"]);
            }

			$this->returnResponse(SUCCESS_RESPONSE, $barang);
            
        }

      
        public function getAllItemsBarang_kota() {
			$tableName = "barang_kota";

			$stmt = $this->dbConn->prepare("SELECT * FROM " . $tableName);
			$stmt->execute();
			$response = $stmt->fetchAll(PDO::FETCH_ASSOC);
			$this->returnResponse(SUCCESS_RESPONSE, $response);
		}

        public function getItemBarang_kotaByJadi(){
            $jadi = $this->validateParameter("jadi",$this->param["jadi"],STRING);

            $brg = new Barang;
            $brg->setJadi($jadi);
            $barang = $brg->getItemByKdKota();

            if (!is_array($barang)) {
                $this->returnResponse(SUCCESS_RESPONSE,["message"=> "Barang Kota tidak ditemukan"]);
            }

			$this->returnResponse(SUCCESS_RESPONSE, $barang);
            
        }

        public function getAllItemsPelanggan() {
			$stmt = $this->dbConn->prepare("SELECT * FROM pelanggan");
			$stmt->execute();
			$customer = $stmt->fetchAll(PDO::FETCH_ASSOC);
			$this->returnResponse(SUCCESS_RESPONSE, $customer);
		}

        public function getItemPelangganByKd_cus(){
            $kd_cus = $this->validateParameter("kd_cus",$this->param["kd_cus"],STRING);

            $cust = new Customer;
            $cust->setKdCus($kd_cus);
            $customer = $cust->getCustomerByKdCus();

            if (!is_array($customer)) {
                $this->returnResponse(SUCCESS_RESPONSE,["message"=> "Data tidak ditemukan"]);
            }

			$this->returnResponse(SUCCESS_RESPONSE, $customer);
            
        }

        public function getAllItemsAlat_bayar() {
			$stmt = $this->dbConn->prepare("SELECT * FROM alat_bayar");
			$stmt->execute();
			$alatBayar = $stmt->fetchAll(PDO::FETCH_ASSOC);
			$this->returnResponse(SUCCESS_RESPONSE, $alatBayar);
		}

        public function getItemAlat_bayarByKd_alat(){
            $kd_alat = $this->validateParameter("kd_alat",$this->param["kd_alat"],STRING);

            $alatByr = new AlatBayar;
            $alatByr->setKdAlatBayar($kd_alat);
            $alatBayar = $alatByr->getItemByKdAlatBayar();

            if (!is_array($alatBayar)) {
                $this->returnResponse(SUCCESS_RESPONSE,["message"=> "Alat Bayar tidak ditemukan"]);
            }

			$this->returnResponse(SUCCESS_RESPONSE, $alatBayar);
            
        }

        public function getAllItemsSubalat_bayarByKdsub_alat() {
			$stmt = $this->dbConn->prepare("SELECT * FROM subalat_bayar");
			$stmt->execute();
			$subAlatBayar = $stmt->fetchAll(PDO::FETCH_ASSOC);
			$this->returnResponse(SUCCESS_RESPONSE, $subAlatBayar);
		}

        public function getItemSubalat_bayarByKdsub_alat(){
            $kdSubAlatBayar= $this->validateParameter("kdsub_alat",$this->param["kdsub_alat"],STRING);

            $subAlatByr = new AlatBayar;
            $subAlatByr->setKdSubAlatBayar($kdSubAlatBayar);
            $subAlatBayar= $subAlatByr->getItemByKdSubalatBayar();

            if (!is_array($subAlatBayar)) {
                $this->returnResponse(SUCCESS_RESPONSE,["message"=> "Sub Alat Bayar tidak ditemukan"]);
            }

			$this->returnResponse(SUCCESS_RESPONSE, $subAlatBayar);
            
        }

		public function getAllItemsArea() {
			$stmt = $this->dbConn->prepare("SELECT * FROM area");
			$stmt->execute();
			$area = $stmt->fetchAll(PDO::FETCH_ASSOC);
			$this->returnResponse(SUCCESS_RESPONSE, $area);
		}

        public function getItemAreaByKode(){
            $kode= $this->validateParameter("kode",$this->param["kode"],STRING);

            $area = new Area;
            $area->setKode($kode);
            $dArea = $area->getAreaByKode();

            if (!is_array($dArea)) {
                $this->returnResponse(SUCCESS_RESPONSE,["message"=> "Area tidak ditemukan"]);
            }
			$this->returnResponse(SUCCESS_RESPONSE, $dArea);
            
        }

		public function getAllItemsKategoriOutlet() {
			$stmt = $this->dbConn->prepare("SELECT * FROM kategori_outlet");
			$stmt->execute();
			$katOutlet = $stmt->fetchAll(PDO::FETCH_ASSOC);
			$this->returnResponse(SUCCESS_RESPONSE, $katOutlet);
		}

        public function getItemKategoriOutletByIdKat(){
            $idKat = $this->validateParameter("id_kat",$this->param["id_kat"],STRING);

            $katOutlet = new KategoriOutlet;
            $katOutlet->setIdKat($idKat);
            $kategoriOutlet = $katOutlet->getKategoriOutletByKdIdKat();

            if (!is_array($kategoriOutlet)) {
                $this->returnResponse(SUCCESS_RESPONSE,["message"=> "Kategori Outlet tidak ditemukan"]);
            }
			$this->returnResponse(SUCCESS_RESPONSE, $kategoriOutlet);
            
        }

		public function getBarangByKategoriAndKota(){
			
			$idKat = $this->validateParameter("id_kat",$this->param["id_kat"],STRING);
			$kdKota = $this->validateParameter("kd_kota",$this->param["kd_kota"],STRING);
			$kdBrg = $this->validateParameter("kd_brg",$this->param["kd_brg"],STRING);

            $barang = new Barang;
            $barang->setIdKat($idKat);
            $barang->setKdKota($kdKota);
            $barang->setKdBarang($kdBrg);
            $data = $barang->getItemByKdKotaAndIdKat();

            if (!is_array($data)) {
                $this->returnResponse(SUCCESS_RESPONSE,["message"=> "Barang tidak ditemukan"]);
            }
			$this->returnResponse(SUCCESS_RESPONSE, $data);
        }

        public function postToJualDetil() {
			$jadi = $this->validateParameter('jadi', $this->param['jadi'], STRING, false);
			$faktur = $this->validateParameter('faktur', $this->param['faktur'], STRING, false);
			$tanggal = $this->validateParameter('tanggal', $this->param['tanggal'], STRING, false);
			$kdCus = $this->validateParameter('kd_cus', $this->param['kd_cus'], STRING, false);
			$kdAplikasi = $this->validateParameter('kd_aplikasi', $this->param['kd_aplikasi'], STRING, false);
			$kdPromo = $this->validateParameter('kd_promo', $this->param['kd_promo'], STRING, false);
			$kdBrg = $this->validateParameter('kd_brg', $this->param['kd_brg'], STRING, false);
			$banyak = $this->validateParameter('banyak', $this->param['banyak'], INTEGER, false);
			$harga = $this->validateParameter('harga', $this->param['harga'], INTEGER, false);
			$diskon = $this->validateParameter('diskon', $this->param['diskon'], INTEGER, false);
            $jumlah = $this->validateParameter('jumlah', $this->param['jumlah'], INTEGER, false);
			$fakturRefund = $this->validateParameter('faktur_refund', $this->param['faktur_refund'], STRING, false);
			$penyajian = $this->validateParameter('penyajian', $this->param['penyajian'], STRING, false);
			$hargaDasar = $this->validateParameter('harga_dasar', $this->param['harga_dasar'], INTEGER, false);

			$jualDetil = new JualDetil;
			$jualDetil->setJadi($jadi);
			$jualDetil->setFaktur($faktur);
			$jualDetil->setTanggal($tanggal);
			$jualDetil->setKdCus($kdCus);
			$jualDetil->setKdAplikasi($kdAplikasi);
			$jualDetil->setKdPromo($kdPromo);
			$jualDetil->setKdBrg($kdBrg);
			$jualDetil->setBanyak($banyak);
			$jualDetil->setJumlah($harga);
			$jualDetil->setHarga($diskon);
			$jualDetil->setDiskon($jumlah);
			$jualDetil->setFakturRefund($fakturRefund);
			$jualDetil->setPenyajian($penyajian);
			$jualDetil->setHargaDasar($hargaDasar);


			if(!$jualDetil->insert()) {
				$message = 'Failed to insert.';
			} else {
				$message = "Inserted successfully.";
			}

			$this->returnResponse(SUCCESS_RESPONSE, $message);
		}

        public function postToPenjualan() {
			$faktur = $this->validateParameter('faktur', $this->param['faktur'], STRING, false);
			$tanggal = $this->validateParameter('tanggal', $this->param['tanggal'], STRING, false);
			$kd_cus = $this->validateParameter('kd_cus', $this->param['kd_cus'], STRING, false);
			$kd_aplikasi = $this->validateParameter('kd_aplikasi', $this->param['kd_aplikasi'], STRING, false);
			$no_meja = $this->validateParameter('no_meja', $this->param['no_meja'], STRING, false);
			$oleh = $this->validateParameter('oleh', $this->param['oleh'], STRING, false);
			$subjumlah = $this->validateParameter('subjumlah', $this->param['subjumlah'], INTEGER, false);
			$ppn = $this->validateParameter('ppn', $this->param['ppn'], INTEGER, false);
			$jumlah = $this->validateParameter('jumlah', $this->param['jumlah'], INTEGER, false);
			$byr_pocer = $this->validateParameter('byr_pocer', $this->param['byr_pocer'], INTEGER, false);
            $byr_tunai = $this->validateParameter('byr_tunai', $this->param['byr_tunai'], INTEGER, false);
			$byr_non_tunai = $this->validateParameter('byr_non_tunai', $this->param['byr_non_tunai'], INTEGER, false);
			$kd_alatbayar = $this->validateParameter('kd_alatbayar', $this->param['kd_alatbayar'], STRING, false);
			$no_urut = $this->validateParameter('no_urut', $this->param['no_urut'], INTEGER, false);
			$tahun = $this->validateParameter('tahun', $this->param['tahun'], STRING, false);
			$bulan = $this->validateParameter('bulan', $this->param['bulan'], STRING, false);
			$jam = $this->validateParameter('jam', $this->param['jam'], STRING, false);
			$kdsub_alatbayar = $this->validateParameter('kdsub_alatbayar', $this->param['kdsub_alatbayar'], STRING, false);
			$subjumlah_offline = $this->validateParameter('subjumlah_offline', $this->param['subjumlah_offline'], INTEGER, false);
			$ket_aplikasi = $this->validateParameter('ket_aplikasi', $this->param['ket_aplikasi'], STRING, false);
			$dasar_fee = $this->validateParameter('dasar_fee', $this->param['dasar_fee'], INTEGER, false);
			$acuan_fee = $this->validateParameter('acuan_fee', $this->param['acuan_fee'], STRING, false);
			$tarif_fee = $this->validateParameter('tarif_fee', $this->param['tarif_fee'], INTEGER, false);
			$b_paking = $this->validateParameter('b_paking', $this->param['b_paking'], INTEGER, false);
			$no_online = $this->validateParameter('no_online', $this->param['no_online'], INTEGER, false);
			$no_offline = $this->validateParameter('no_ofline', $this->param['no_ofline'], INTEGER, false);
			$tarif_pb1 = $this->validateParameter('tarif_pb1', $this->param['tarif_pb1'], INTEGER, false);
			$faktur_refund = $this->validateParameter('faktur_refund', $this->param['faktur_refund'], STRING, false);
			$faktur_refund = $this->validateParameter('dasar_faktur', $this->param['dasar_faktur'], STRING, false);
			$faktur_refund = $this->validateParameter('faktur_void', $this->param['faktur_void'], STRING, false);
			$dibayar = $this->validateParameter('dibayar', $this->param['dibayar'], INTEGER, false);
			$no_ref = $this->validateParameter('no_ref', $this->param['no_ref'], STRING, false);


			$penjualan = new Penjualan;
			$penjualan->setFaktur($faktur);
			$penjualan->setTanggal($tanggal);
			$penjualan->setKdCus($kd_cus);
			$penjualan->setKdAplikasi($kd_aplikasi);
			$penjualan->setNoMeja($no_meja);
			$penjualan->setOleh($oleh);
			$penjualan->setSubjumlah($subjumlah);
			$penjualan->setPPN($ppn);
			$penjualan->setJumlah($jumlah);
			$penjualan->setByrPocer($byr_pocer);
			$penjualan->setByrTunai($byr_tunai);
			$penjualan->setByrNonTunai($byr_non_tunai);
			$penjualan->setKdAlatBayar($kd_alatbayar);
			$penjualan->setNoUrut($no_urut);
			$penjualan->setTahun($tahun);
			$penjualan->setBulan($bulan);
			$penjualan->setJam($jam);
			$penjualan->setKdsubAlatBayar($kdsub_alatbayar);
			$penjualan->setSubjumlahOffline($subjumlah_offline);
			$penjualan->setKetAplikasi($ket_aplikasi);
			$penjualan->setDasarFee($dasar_fee);
			$penjualan->setAcuanFee($acuan_fee);
			$penjualan->setTarifFee($tarif_fee);
			$penjualan->setBpaking($b_paking);
			$penjualan->setNoOnline($no_online);
			$penjualan->setNoOfline($no_offline);
			$penjualan->setTarifpb1($tarif_pb1);
			$penjualan->setTarifpb1($faktur_refund);
			$penjualan->setDibayar($dibayar);
			$penjualan->setNoRef($no_ref);


			if(!$penjualan->insert()) {
				$message = 'Failed to insert.';
			} else {
				$message = "Inserted successfully.";
			}

			$this->returnResponse(SUCCESS_RESPONSE, $message);
		}

        public function postToLogTrans() {
			$id_log = $this->validateParameter('id_log', $this->param['id_log'], STRING, false);
			$tanggal = $this->validateParameter('tanggal', $this->param['tanggal'], STRING, false);
			$jenis_transaksi = $this->validateParameter('jenis_transaksi', $this->param['jenis_transaksi'], STRING, false);
			$no_faktur = $this->validateParameter('no_faktur', $this->param['no_faktur'], STRING, false);
			$kd_cus = $this->validateParameter('kd_cus', $this->param['kd_cus'], STRING, false);
			$id_user = $this->validateParameter('id_user', $this->param['id_user'], STRING, false);

			$logTrans = new LogTrans;
			$logTrans->setIdLog($id_log);
			$logTrans->setTanggal($tanggal);
			$logTrans->setJenisTransaksi($jenis_transaksi);
			$logTrans->setNoFaktur($no_faktur);
			$logTrans->setKdCus($kd_cus);
			$logTrans->setIdUser($id_user);

			if(!$logTrans->insert()) {
				$message = 'Failed to insert.';
			} else {
				$message = "Inserted successfully.";
			}

			$this->returnResponse(SUCCESS_RESPONSE, $message);
		}

       


    }

?>