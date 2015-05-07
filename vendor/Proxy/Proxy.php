<?php

namespace Proxy;

class Proxy extends Proxy\AbstractProxy {
    
    protected function getEndPointFunction() {
        
    }

    protected function prepareGetParams(array $paramsArray = null,
            array $ignoreParamList = null) {
        $params = null;
        $paramsArray = $this->getRequestParams();
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
     * set end point function for rest api
     * framework
     * @param string $endpointFunction
     * @author Zeynel Dağlı
     * @version 0.0.1
     */
    protected function setEndPointFunction($endpointFunction = '') {
        $requestParams = $this->getRequestParams();
        //print_r($requestParams);
        $this->endpointFunction = $requestParams['url'];
    }
    
    /**
     * this implementation will be implemented
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

}

