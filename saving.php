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

                if ($email !== "stabogactechno@wssteak.co.id" && $pass !== "stabowssteak1234") {
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

        public function getAllItems() {
			$tableName = "barang";

			$stmt = $this->dbConn->prepare("SELECT * FROM " . $tableName);
			$stmt->execute();
			$response = $stmt->fetchAll(PDO::FETCH_ASSOC);
			$this->returnResponse(SUCCESS_RESPONSE, $response);
		}

        public function getItemByKdBarang(){
            $kdBarang = $this->validateParameter("kd_brg",$this->param["kd_brg"],STRING);

            $brg = new Barang;
            $brg->setKdBarang($kdBarang);
            $barang = $brg->getItemByKdBarang();

            if (!is_array($barang)) {
                $this->returnResponse(SUCCESS_RESPONSE,["message"=> "Barang tidak ditemukan"]);
            }

			$this->returnResponse(SUCCESS_RESPONSE, $barang);
            
        }

        public function getAllItemsByKdJenis(){
            $kdJenis = $this->validateParameter("kd_jenis",$this->param["kd_jenis"],STRING);

            $brg = new Barang;
            $brg->setKdJenis($kdJenis);
            $barang = $brg->getItemsByKdJenis();

            if (!is_array($barang)) {
                $this->returnResponse(SUCCESS_RESPONSE,["message"=> "Barang tidak ditemukan"]);
            }

			$this->returnResponse(SUCCESS_RESPONSE, $barang);
            
        }

        public function getAllItemsByKota(){
            $jadi = $this->validateParameter("jadi",$this->param["jadi"],STRING);

            $brg = new Barang;
            $brg->setJadi($jadi);
            $barang = $brg->getItemByKdKota();

            if (!is_array($barang)) {
                $this->returnResponse(SUCCESS_RESPONSE,["message"=> "Barang tidak ditemukan"]);
            }

			$this->returnResponse(SUCCESS_RESPONSE, $barang);
            
        }

        public function getAllCustomers() {
			$stmt = $this->dbConn->prepare("SELECT * FROM pelanggan");
			$stmt->execute();
			$customers = $stmt->fetchAll(PDO::FETCH_ASSOC);
			$this->returnResponse(SUCCESS_RESPONSE, $customers);
		}

    

    }


    
        // public function getItemByKota(){
        //     $sql = "SELECT bk.kd_brg,bk.kd_kota,
        //     bk.harga,bk.kd_aplikasi,b.nama,b.harga as harga_asli,b.kd_subgrup,
        //     b.kd_grup,b.photo 
        //     FROM barang_kota as bk RIGHT JOIN barang as b ON bk.kd_brg=b.kd_brg WHERE 
        //                  bk.kd_kota=:kdKota AND
        //                  ORDER BY bk.kd_brg";
            
        //     $stmt = $this->dbConn->prepare($sql);
		// 	$stmt->bindParam(':kdKota', $this->kdKota);
		// 	$stmt->execute();
		// 	$barang = $stmt->fetchAll(PDO::FETCH_ASSOC);
		// 	return $barang;
        // }

?>