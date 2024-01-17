<?php
    require_once("constants.php");
    class Rest{
        protected $request;
        protected $serviceName;
        protected $param;
        protected $dbConn;
		protected $userId;


        public function __construct()
        {
            if($_SERVER["REQUEST_METHOD"] !== "POST"){
               $this->throwError(REQUEST_METHOD_NOT_VALID,"Request Method is not valid.");
            }
            $handler = fopen("php://input", "r");
            $this->request = stream_get_contents($handler);
            $this->validateRequest();

            $db = new DbConnect;
            $this->dbConn = $db->connect();

            if ("generatetoken" != strtolower($this->serviceName)) {
                $this->validateToken();
            }
        }

        public function validateToken(){
            try {
                $token = $this->getBearerToken();
				$payload = JWT::decode($token, SECRETE_KEY, ['HS256']);

				
                // echo "Validating Token";
            } catch (\Exception $e) {
                $this->throwError(ACCESS_TOKEN_ERRORS, $e->getMessage());
            }
        }

        public function validateRequest()
        {
            if($_SERVER["CONTENT_TYPE"] !== "application/json"){
                $this->throwError(REQUEST_CONTENTTYPE_NOT_VALID,"Request content-type is not valid");
            }

            $data = json_decode($this->request, true);

            if(!isset($data["name"]) || $data["name"] == ""){
                $this->throwError(API_NAME_REQUIRED,"API Name is required");
            }

            $this->serviceName = $data["name"];

            if(!is_array($data["param"])){
                $this->throwError(API_PARAM_REQUIRED,"API Param is required");
            }

            $this->param = $data["param"];

        }
        
        public function validateParameter($fieldName,$value,$dataType,$required=true)
        {
            if($required == true && empty($value) == true){
                $this->throwError(VALIDATE_PARAMETER_REQUIRED, $fieldName . " Parameter is required.");
            }

            switch ($dataType) {
                case BOOLEAN:
                    if (!is_bool($value)) {
                        $this->throwError(VALIDATE_PARAMETER_DATATYPE,"Datatype is not valid for ". $fieldName . ". It should be numeric");
                    }
                    break;
                case INTEGER;
                    if (!is_numeric($value)) {
                    $this->throwError(VALIDATE_PARAMETER_DATATYPE,"Datatype is not valid for ". $fieldName . ". It should be numeric");
                    }
                    break;
                case STRING;
                    if (!is_string($value)) {
                    $this->throwError(VALIDATE_PARAMETER_DATATYPE,"Datatype is not valid for ". $fieldName . ". It should be string");
                    }
                    break;
                default:
                    # code...
                    break;
            }

            return $value;

        }

        public function processApi()
        {
            try {
                $api = new Api;
                $rMethod = new reflectionMethod("API", $this->serviceName);
                if(!method_exists($api, $this->serviceName)){
                    $this->throwError(API_DOST_NOT_EXIST,"API does not exists");
                }
                $rMethod->invoke($api);
            } catch (\Exception $e) {
                $this->throwError(API_DOST_NOT_EXIST,$e->getMessage());
            }
        }
        
        public function throwError($code, $message)
        {
            header("content-type: application/json");
            $errorMessage = json_encode(
                [
                "error"=>[
                "status"=>$code, 
                "message"=>$message,
                ]
            ]);
            echo $errorMessage; exit;
        }

        public function returnResponse($code, $data)
        {
            header("content-type: application/json");
            $response = json_encode([
                "response"=> [
                    "status" => $code, 
                    "result" => $data,
                    ]
                ]);

            echo $response; exit;
        }

        public function getAuthorizationHeader(){
            $headers = null;
            if(isset($_SERVER["Authorization"])){
                $headers = trim($_SERVER["Authorization"]); 
            }else if(isset($_SERVER["HTTP_AUTHORIZATION"])){
                $headers = trim($_SERVER["HTTP_AUTHORIZATION"]);
            }else if(function_exists("apache_request_headers")){
                $requestHeaders = apache_request_headers();

                $requestHeaders = array_combine(array_map("ucwords",array_keys($requestHeaders)),
                array_values($requestHeaders));

                if (isset($requestHeaders["Authorization"])) {
                    $headers = trim($requestHeaders["Authorization"]);
                }
            }
        
            return $headers;
        }

        public function getBearerToken(){
            $headers = $this->getAuthorizationHeader();

            if (!empty($headers)) {
                if (preg_match('/Bearer\s(\S+)/',$headers,$matches)) {
                    return $matches[1];
                }

            }
            $this->throwError(AUTHORIZATION_HEADER_NOT_FOUND, "Access Token Not Found");
        }
    }
?>