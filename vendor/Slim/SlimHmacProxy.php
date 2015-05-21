<?php

namespace vendor\Slim;

class SlimHmacProxy extends \vendor\Proxy\Proxy {
    
     /**
     * a mapping array for related functions and proxy calls
     * to be executed
     * @var array()
     */
    protected $redirectMap = array('getReports_test' => 'restApiDefaultCall');
    
    /**
     * hmac object
     * @var \vendor\hmac\Hmac
     */
    protected $hmacObj;
    
    
    public function __construct() {
        parent::__construct();
        $this->hmacObj = new \vendor\hmac\Hmac();
    }
    
    public function redirect() {
        $execFunction = $this->resolveRedirectMap();
        $this->setEndPointByClosure();  
        echo $this->$execFunction();
    }
    
     /**
     * Rest api 'GET' call (Curl lib)
     * function overriden
     * @author Mustafa Zeynel Dağlı
     * @version 0.2
     */
    public function restApiDefaultCall() {
        $encrypt = new \vendor\Encrypt\EncryptManual('test');
        $encrypt->encrypt_times(4, 'kullanici:sifre');
        $params = null;
        $params = $this->getRequestParams();
        $this->hmacObj->setPublicKey($params['pk']);
        $this->hmacObj->setPrivateKey('e249c439ed7697df2a4b045d97d4b9b7e1854c3ff8dd668c779013653913572e');
        $this->hmacObj->setRequestParams($this->getRequestParamsWithoutPublicKey());
        $this->hmacObj->makeHmac();
        //print_r($this->hmacObj);
        
        $preparedParams = $this->prepareGetParams();
        //$preparedParams = $this->prepareGetParams('', array('pk'));
        if (($ch = @curl_init()) == false) {
            header("HTTP/1.1 500", true, 500);
            die("Cannot initialize CURL session. Is CURL enabled for your PHP installation?");
        }
        //print_r($this->restApiFullPathUrl.'?'.$preparedParams);
        //print_r($this->endPointUrl.$this->getEndPointFunction().'?'.$preparedParams);
        curl_setopt($ch, CURLOPT_URL, $this->restApiFullPathUrl.'?'.$preparedParams ); //Url together with parameters
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); //Return data instead printing directly in Browser
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT , $this->getCallTimeOut()); //Timeout (Default 7 seconds)
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'X-Public: '.$this->hmacObj->getPublicKey().'',
            'X-Hash: '.$this->hmacObj->getHash().'',
            'X-Nonce:' .$this->hmacObj->getNonce()
        ));
        curl_setopt($ch, CURLOPT_HEADER, 0); // we don’t want also to get the header information that we receive.
 
        $response = curl_exec($ch);
        $http_code = curl_getinfo($ch ,CURLINFO_HTTP_CODE);
        if ($response == false) {
            die("curl_exec() failed. Error: " . curl_error($ch));
        }
 
        return $response;
    }
    
    public function setEndPointByClosure(Array $EndPointClosure=null) {
        $endPointFunction = $this->getRestApiEndPointFunction();
        if (substr($endPointFunction, -5) == '_test') {
            //$this->setEndPointUrl("http://localhost/slim2_test/index.php/");
            $this->setRestApiFullPathUrl($this->restApiBaseUrl.$this->restApiEndPoint.$this->restApiEndPointFunction);
        }else {
            //$this->setEndPointUrl("http://localhost/slim2_test/".$this->getInvalidCallUrl()."/");
            //$this->setEndPointUrl("".$this->getRestApiBaseUrl()."/".$this->getInvalidCallUrl()."/");
            //$this->setEndPointFunction($this->getInvalidCallFunc());
        }
    }
    
    /**
     * set Hmac object for HMAC security
     * @param \vendor\hmac\Hmac $hmacObj
     * @version 0.2
     * @author Mustafa Zeynel Dağlı
     */
    public function setHmacObj(\vendor\hmac\Hmac $hmacObj) {
        $this->hmacObj = $hmacObj;
    }
    
    /**
     * get Hmac object for HMAC security
     * @return \vendor\hmac\Hmac $hmacObj
     * @version 0.2
     * @author Mustafa Zeynel Dağlı
     */
    public function getHmacObj() {
        return $this->hmacObj;
    }
    
}

