<?php

namespace vendor\hmac;

class Hmac {
    
    protected $hash;
    
    protected $publicKey;
    
    protected $privateKey;
    
    protected $requestParams = array();


    public function __construct() {
        
    }
    
    public function setHash($hash = null) {
        $this->hash = $hash;
    }
    
    public function getHash() {
        return $this->hash;
    }
    
    public function makeHmac() {
        
    }
    
    public function setPublicKey($publicKey = null) {
        $this->publicKey = $publicKey;
    }
    
    public function getPublicKey() {
        return $this->publicKey;
    }
    
    public function setPrivateKey($privateKey = null) {
        $this->privateKey = $privateKey;
    }
    
    public function getPrivateKey() {
        return $this->privateKey;
    }
    
    public function setRequestParams($requestParams = null) {
        $this->requestParams = $requestParams;
    }
    
    public function getRequestParams() {
        return $this->requestParams;
    }
}

