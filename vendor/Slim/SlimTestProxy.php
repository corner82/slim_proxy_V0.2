<?php

namespace Slim;

class SlimTestProxy extends \Proxy\Proxy {
    
    public function __construct() {
        parent::__construct();
    }
    
    public function redirect() {
        $execFunction = $this->resolveRedirectMap();
        $this->setEndPointByClosure();  
        echo $this->$execFunction();
    }
    
    protected function setEndPointByClosure(Array $EndPointClosure=null) {
        $endPointFunction = $this->getEndPointFunction();
        if (substr($endPointFunction, -5) == '_test') {
            //$this->setEndPointUrl("http://localhost/slim2_test/index.php/");
            $this->setEndPointUrl($this->getRestApiBaseUrl());
        }else {
            //$this->setEndPointUrl("http://localhost/slim2_test/".$this->getInvalidCallUrl()."/");
            $this->setEndPointUrl("".$this->getRestApiBaseUrl()."/".$this->getInvalidCallUrl()."/");
            $this->setEndPointFunction($this->getInvalidCallFunc());
        }
        
        
    }
    
}

