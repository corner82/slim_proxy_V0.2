<?php

/**
 * Rest Api Proxy Library
 *
 * @author Zeynel Dağlı
 * @version 0.1
 */

namespace vendor\Proxy;

 class Proxy extends \vendor\Proxy\AbstractProxy implements PublicKeyRequiredInterface,
                                                                    PublicKeyNotFoundInterface,
                                                                    PrivateKeyNotFoundInterface,
                                                                    UserNotRegisteredInterface
{
    
    /**
     * determines what will be done if private key not found
     * @author Mustafa Zeynel Dağlı
     * @var boolean
     */
     protected $privateKeyNotFoundRedirection = true;


/**
     * invalid url format redirect url
     * @var string
     * @author Mustafa Zeynel Dağlı
     * @since 0.2
     */
    protected $invalidCallUrl = "invalid.php";
    
    /**
     * invalid url format redirect url function
     * @var string
     * @author Mustafa Zeynel Dağlı
     * @since 0.2
     */
    protected $invalidCallFunc = "invalid";
    
    /**
     * encrypt class obj
     * @var \vendor\Encrypt\AbstractEncrypt
     * @author Mustafa Zeynel Dağlı
     * @since 0.2
     */
    protected $encryptClass;
    
    /**
     * encrypt class key
     * @var string
     * @author Mustafa Zeynel Dağlı
     * @since version 0.2
     */
    protected $encryptKey = 'testKey';
    
    
    /**
     * service pk required or not
     * @var boolean
     * @author Mustafa Zeynel Dağlı
     * @since version 0.3
     */
    protected $isServicePkRequired = null;
    
    /**
     * determine if public key not found
     * @var boolean | null
     * @author Mustafa Zeynel Dağlı
     * @since version 0.3
     */
    protected $isPublicKeyNotFoundRedirect = true;
    
    /**
     * determine if private key not found
     * @var boolean | null
     * @author Mustafa Zeynel Dağlı
     * @since version 0.3
     */
    protected $isPrivateKeyNotFoundRedirect = true;
    
    /**
     * determine if user not registered
     * @var boolean | null
     * @author Mustafa Zeynel Dağlı
     * @since version 0.3
     */
    protected $isUserNotRegisteredRedirect = true;


    public function __construct() {
        //parent::__construct();
    }
    
    /**
     * user not registered process function, will be overridden by
     * inherit classes
     * @author Mustafa Zeynel Dağlı
     * @since version 0.3
     */
    public function userNotRegisteredRedirect() {
        
    }
    
    /**
     * get if to redirect due to user not registered  process
     * @return boolean
     * @author Mustafa Zeynel Dağlı
     * @since version 0.3
     */
    public function getUserNotRegisteredRedirect() {
        return $this->isUserNotRegisteredRedirect;
    }
    
    /**
     * set if to redirect due to user not registered  process
     * @param boolean $boolean
     * @author Mustafa Zeynel Dağlı
     * @since version 0.3
     */
    public function setUserNotRegisteredRedirect($boolean = null) {
        $this->isUserNotRegisteredRedirect = $boolean;
    }

    /**
     * get if to redirect due to private key not found process
     * @return type
     * @author Mustafa Zeynel Dağlı
     * @since version 0.3
     */
    public function getPrivateKeyNotFoundRedirect() {
        return $this->isPrivateKeyNotFoundRedirect;
    }
    
    /**
     * set if to redirect due to private key not found process
     * @param boolean $boolean
     * @author Mustafa Zeynel Dağlı
     * @since version 0.3
     */
    public function setPrivateKeyNotFoundRedirect($boolean = null) {
        $this->isPrivateKeyNotFoundRedirect = $boolean;
    }
    
    /**
     * public key not found process function, will be overridden by
     * inherit classes
     * @author Mustafa Zeynel Dağlı
     * @since version 0.3
     */
    public function privateKeyNotFoundRedirect() {
        
    }

    /**
     * public key not found process function, will be overridden by
     * inherit classes
     * @author Mustafa Zeynel Dağlı
     * @since version 0.3
     */
    public function publicKeyNotFoundRedirect() {
        
    }
    
    /**
     * get if to redirect due to public key not found process
     * @return boolean 
     * @author Mustafa Zeynel Dağlı
     * @since version 0.3
     */
    public function getPublicKeyNotFoundRedirect() {
        return $this->isPublicKeyNotFoundRedirect;
    }
    
    /**
     * set if to redirect due to public key not found process
     * @param boolean | null $boolean 
     * @author Mustafa Zeynel Dağlı
     * @since version 0.3
     */
    public function setPublicKeyNotFoundRedirect($boolean = null) {
        $this->isPublicKeyNotFoundRedirect = $boolean;
    }
    
    
    /**
     * determine if service needs private and public key
     * interragation
     * @author Mustafa Zeynel Dağlı
     * @since version 0.3
     */
     public function servicePkRequired() {
         
     }

    /**
     * set variable for private key not found strategy
     * @param type $boolean
     * @author Mustafa Zeynel Dağlı
     * @since 05/01/2016 
     */
    protected function setPrivateKeyNotFoundRedirection($boolean) {
        $this->privateKeyNotFoundRedirection = $boolean;
    }
    
    /**
     * get variable for private key not found strategy
     * @return boolean
     * @author Mustafa Zeynel Dağlı
     * @since 05/01/2016
     */
    protected function getPrivateKeyNotFoundRedirection() {
        return $this->privateKeyNotFoundRedirection;
    }

    /**
     * set invalid call format redirect function
     * @param type $invalidCallFunc
     * @return string
     * @author Mustafa Zeynel Dağlı
     * @since 0.2
     */
    protected function setInvalidCallFunc($invalidCallFunc) {
        return $this->invalidCallFunc = $invalidCallFunc;
    }
    
    /**
     * get invalid call format redirect function
     * @author Mustafa Zeynel Dağlı
     * @since 0.2
     */
    protected function getInvalidCallFunc() {
        return $this->invalidCallFunc;
    }
    
    /**
     * set invalid call format redirect url
     * @param type $invalidCallUrl
     * @return string
     * @author Mustafa Zeynel Dağlı
     * @since 0.2
     */
    protected function setInvalidCallUrl($invalidCallUrl) {
        return $this->invalidCallUrl = $invalidCallUrl;
    }
    
    /**
     * set encrytion class obj
     * @param \vendor\Encrypt\AbstractEncrypt $encrypyClass
     * @author Mustafa Zeynel Dağlı
     */
    public function setEncryptClass(\vendor\Encrypt\AbstractEncrypt $encryptClass = null) {
        try {
            if($encryptClass == null) {
                $this->encryptClass = new \vendor\Encrypt\EncryptManual($this->encryptKey);
                //print_r($this->encryptClass);
            } else {
                $this->encryptClass = $encryptClass;
            }
            return $this->encryptClass;
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
    }
    
    /**
     * get encrytion class obj
     * @return \vendor\Encrypt\AbstractEncrypt
     * @author Mustafa Zeynel Dağlı
     */
    public function getEncryptClass() {
        if($this->encryptClass == null){
            $this->setEncryptClass();
        }else {
            return $this->encryptClass;
        }
    }
    
    /**
     * get invalid call format redirect url
     * @author Mustafa Zeynel Dağlı
     * @since 0.2
     */
    protected function getInvalidCallUrl() {
        return $this->invalidCallUrl;
    }

    protected function prepareGetParams(array $paramsArray = null,
            array $ignoreParamList = null) {
        $params = null;
        $paramsArray = $this->getRequestParamsWithoutPublicKey();
        if(!empty($ignoreParamList)) {
            foreach($paramsArray as $key=>$value) {
               if(!in_array ($key, $ignoreParamList)) {
                    $params .= $key.'='.urlencode (trim($value)).'&';
                }  
            }         
        } else {
             foreach($paramsArray as $key=>$value) {
                 $params .= $key.'='.urlencode (trim($value)).'&';
            }
        }
        $params = trim($params, '&');
        return $params;
        
    }
    
    /**
     * set full path url for rest api
     * framework
     * @param string $endpointFunction
     * @author Zeynel Dağlı
     * @version 0.0.1
     */
    protected function setRestApiFullPathUrl($restApiFullPathUrl) {
        $this->restApiFullPathUrl = $restApiFullPathUrl;
    }
    
    /**
     * get full path url for rest api
     * @return string
     * @author Mustafa Zeynel Dağlı
     * @since 0.2
     */
    protected function getRestApiFullPathUrl() {
        return $this->restApiFullPathUrl;
    }
    
    
    /**
     * set end point function for rest api
     * framework
     * @param string $endpointFunction
     * @author Zeynel Dağlı
     * @version 0.0.1
     */
    protected function setRestApiEndPointFunction($restApiEndpointFunction = '') {
        $requestParams = $this->getRequestParams();
        //print_r($requestParams);
        $this->restApiEndPointFunction = $requestParams['url'];
    }
    
    /**
     * get rest api end point function
     * @return string
     * @author Mustafa Zeynel Dağlı
     * @since 0.2
     */
    protected function getRestApiEndPointFunction() {
        $this->restApiEndPointFunction == null ? $this->setRestApiEndPointFunction() : true ;
        return $this->restApiEndPointFunction;
    }
    
    /**
     * get proxy helper function name form redirect map array
     * @return string proxy helper function
     * @author Zeynel Dağlı 
     * @since 0.1
     */
    protected function resolveRedirectMap() {
        $this->getRestApiEndPointFunction();
        if(isset($this->redirectMap[$this->restApiEndPointFunction])) {
            return $this->redirectMap[$this->restApiEndPointFunction];
        } else {
            try {
                throw new \Exception('redirect map mapper bulunamadı');
            } catch (\Exception $exc) {
                //echo $exc->getTraceAsString();
                echo $exc->getMessage();
                exit();
                //return false;
            }

            
        }
        
    }
    
    /**
     *  will be implemented
     * in next versions
     * @param array
     * @author Zeynel Dağlı
     * @version 0.2
     */
    public function addRedirectMapFunction(array $redirectFunctionMapping = null) {
        
    }
    
    /**
     * setting redirection process for rest api
     * will be implemented on extended classes
     * @author Zeynel Dağlı
     * @version 0.2
     */
    public function redirect() {
        
    }
    
    /**
     * setting end point for rest api
     * this end point strategy may vary according to
     * rest service implementation
     * will be implemented on extended classes
     * @author Zeynel Dağlı
     * @version 0.2
     */
    public function setEndPointByClosure(array $EndPointClosure = null) {
        
    }
    
    /**
     * Rest api default call (Curl lib)
     * @author Mustafa Zeynel Dağlı
     * @version 0.2
     */
    public function restApiDefaultCall() {
        $params = null;
        $params = $this->getRequestParams();
        $preparedParams = $this->prepareGetParams();
        if (($ch = @curl_init()) == false) {
            header("HTTP/1.1 500", true, 500);
            die("Cannot initialize CURL session. Is CURL enabled for your PHP installation?");
        }
        //print_r($this->restApiFullPathUrl.'?'.$preparedParams);
        //print_r($this->restApiBaseUrl.$this->restApiEndPoint.$this->restApiEndPointFunction.'?'.$preparedParams);
        curl_setopt($ch, CURLOPT_URL, $this->restApiFullPathUrl.'?'.$preparedParams ); //Url together with parameters
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); //Return data instead printing directly in Browser
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT , $this->getCallTimeOut()); //Timeout (Default 7 seconds)
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'X-Public: 0',
            'X-Hash: 143444,12'
        ));
        curl_setopt($ch, CURLOPT_HEADER, 0); // we don’t want also to get the header information that we receive.
 
        $response = curl_exec($ch);
        $http_code = curl_getinfo($ch ,CURLINFO_HTTP_CODE);
        if ($response == false) {
            die("curl_exec() failed. Error: " . curl_error($ch));
        }
 
        return $response;
    }
    
    /**
     * Rest api 'GET' call (Curl lib)
     * @author Mustafa Zeynel Dağlı
     * @version 0.2
     */
    public function restApiGetCall() {
        $params = null;
        $params = $this->getRequestParams();
        $preparedParams = $this->prepareGetParams();
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
            'X-Public: 0',
            'X-Hash: 143444,12'
        ));
        curl_setopt($ch, CURLOPT_HEADER, 0); // we don’t want also to get the header information that we receive.
 
        $response = curl_exec($ch);
        $http_code = curl_getinfo($ch ,CURLINFO_HTTP_CODE);
        if ($response == false) {
            die("curl_exec() failed. Error: " . curl_error($ch));
        }
 
        return $response;
    }
    
    /**
     * Rest api 'POST' call (Curl lib)
     * @author Mustafa Zeynel Dağlı  
     * @version 0.2
     */
    public function restApiPostCall() {
        $params = null;
        $params = $this->getRequestParams();
        $preparedParams = $this->prepareGetParams();
        if (($ch = @curl_init()) == false) {
            header("HTTP/1.1 500", true, 500);
            die("Cannot initialize CURL session. Is CURL enabled for your PHP installation?");
        }
        //print_r($this->restApiFullPathUrl.'?'.$preparedParams);
        //print_r($this->endPointUrl.$this->getEndPointFunction().'?'.$preparedParams);
        curl_setopt($ch, CURLOPT_URL, $this->restApiFullPathUrl ); //Url together with parameters
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS,$params);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); //Return data instead printing directly in Browser
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT , $this->getCallTimeOut()); //Timeout (Default 7 seconds)
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'X-Public: 0',
            'X-Hash: 143444,12'
        ));
        curl_setopt($ch, CURLOPT_HEADER, 0); // we don’t want also to get the header information that we receive.

        $response = curl_exec($ch);
        $http_code = curl_getinfo($ch ,CURLINFO_HTTP_CODE);
        if ($response == false) {
            
            die("curl_exec() failed. Error: " . curl_error($ch));
        }
 
        return $response;
    }

}

