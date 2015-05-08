<?php
/**
 * Rest Api Proxy Library
 *
 * @author Zeynel Dağlı
 * @version 0.1
 */

namespace Proxy;

/**
 * abstract base class for proxy wrappers
 */
abstract class AbstractProxy{
    /**
     * Rest service request type
     * @var string
     * @since 0.1
     */
    private $requestType;
    
    /**
     * Rest service request params
     * @var string
     * @since 0.1
     */
    private $requestParams;
    
    /**
     * Proxy helper class 
     * deprecated now if needed will be used again
     * @var \Proxy\Proxy\AbstractProxyHelper
     * @since 0.1
     * @deprecated since version 0.2
     */
    private $proxyHelperObj;
    
    /**
     * rest service end point url
     * @var string
     * @since 0.2
     */
    protected $endPointUrl;
    
    /**
     * Redict map according to rest api
     * function or another criteria which
     * will be deployed
     * @var array
     * @since 0.2
     */
    protected $redirectMap;
    
    /**
     * 
     * @var string
     * @since 0.2
     */
    protected $endpointFunction ;
    
    /**
     * rest api call time out
     * @var int
     * @since 0.2
     */
    protected $callTimeOut = 7;
    
    /**
     * rest api call base url
     * @var string
     * @since 0.2
     */
    protected $restApiBaseUrl ;
    
    /**
     * get proxy helper function name form redirect map array
     * @return string proxy helper function
     * @author Zeynel Dağlı 
     * @since 0.1
     */
    protected function resolveRedirectMap() {
        $this->getEndPointFunction();
        return $this->redirectMap[$this->endpointFunction];
        
    }
    
    /**
     * set end point function for rest api
     * will be implemented in sub class
     * @author Zeynel Dağlı 
     * @since 0.1
     */
    abstract protected function setEndPointFunction($endpointFunction = '');
    
    /**
     * get end point function for rest api
     * will be implemented in sub class
     * @author Zeynel Dağlı 
     * @since 0.1
     */
    abstract protected function getEndPointFunction();
    
    /**
     * redirect method for proxy helper
     * will be implemented in sub class
     * @author Zeynel Dağlı 
     * @since 0.1
     */
    abstract public function redirect();
    
    /**
     * request params are getting ready for rest api call
     * will be implemented in sub class
     * @author Zeynel Dağlı 
     * @since 0.1
     */
    abstract protected function prepareGetParams(Array $paramsArray=null, Array $ignoreParamList=null);
    
    /**
     * add mapping object for rest api and proxy helper function rrelatin
     * will be implemented in sub class
     * @author Zeynel Dağlı 
     * @since 0.1
     */
    abstract public function addRedirectMapFunction(Array $redirectFunctionMapping=null);
    
    /**
     * to make 'POST' rest api call
     * @author Zeynel Dağlı 
     * @since 0.2
     */
    abstract public function restApiPostCall();
    
    /**
     * to make 'POST' rest api call
     * @author Zeynel Dağlı 
     * @since 0.2
     */
    abstract public function restApiGetCall();
    
    /**
     * to make rest api call
     * @author Zeynel Dağlı 
     * @since 0.2
     */
    abstract public function restApiDefaultCall();
    
    
    /**
     * to set endpoint function by any closure
     * @author Zeynel Dağlı 
     * @since 0.1
     */
    abstract public function setEndPointByClosure();

    /**
     * get map array for request calls and proxy helper function
     * @return array
     * @author Zeynel Dağlı 
     * @since 0.2
     */
    public function getRedirectMap() {
        return $this->redirectMap;
    }

    /**
     * set mapper for request call and proxy helper function
     * @param array $redirectMap
     * @author Zeynel Dağlı 
     * @since 0.2
     */
    public function setRedirectMap(Array $redirectMap=null) {
        $this->redirectMap = $redirectMap;
    }
    
    
    /**
     * set Uri for request call
     * @param String $endPointUrl
     * @author Zeynel Dağlı 
     * @since 0.1
     */
    public function setEndPointUrl($endPointUrl) {
        $this->endPointUrl = $endPointUrl;
    }

    /**
     * get uri for request call
     * @return String | null
     * @author Zeynel Dağlı 
     * @since 0.2
     */
    public function getEndPointUrl() {
        return $this->endPointUrl;
    }
    
    /**
     * get request type
     * @return string request type
     * @author Zeynel Dağlı 
     * @version 0.2
     */
    protected function getRequestType() {
        isset($this->requestType) ? true : $this->setRequestType() ;
        return $this->requestType;
    }
    
    /**
     * set request type
     * @author Zeynel Dağlı
     * @version 0.1
     */
    protected function setRequestType() {
        $this->requestType = $_SERVER['REQUEST_METHOD'];
    }

    /**
     * set request parameters due to request type
     * @author Zeynel Dağlı
     * @since 0.1
     */
    public function setRequestParams () {
        switch (strtolower(trim($this->getRequestType()))) {
            case 'get':
                $this->requestParams = $_GET;
                break;
            case 'post':
                $this->requestParams = $_POST;
                break;
            case 'put':
                $this->requestParams = $_PUT;
                break;
            case 'delete':
                $this->requestParams = $_DELETE;
                break;
            default:
                $this->requestParams = $_POST;
                break;
        }
    }
    
    /**
     * get request parameters set due to request type
     * @return array | null
     * @author Zeynel Dağlı 
     * @version 0.1
     */
    public function getRequestParams() {
        $this->requestParams==null ? $this->setRequestParams() : true ;
        return $this->requestParams;
    }
    
    /**
     * set proxy helper class
     * @param \Proxy\Proxy\AbstractProxyHelper $proxyHelper
     * @author Zeynel Dağlı 
     * @version 0.1
     * @deprecated since version 0.2
     */
    protected function setProxyHelper(\Proxy\Proxy\AbstractProxyHelper $proxyHelper) {
        $this->proxyHelperObj = $proxyHelper;
    }
    
    /**
     * get proxy helper class
     * @return \Proxy\Proxy\AbstractProxyHelper
     * @author Zeynel Dağlı 
     * @version 0.1
     * @deprecated since version 0.2
     */
    protected function getProxyHelper() {
        return $this->proxyHelperObj;
    }
    
    /**
     * set time out parameter for request call
     * @param String $endPointUrl
     * @author Zeynel Dağlı 
     * @since 0.2
     */
    public function setCallTimeOut($callTimeOut) {
        $this->callTimeOut = $callTimeOut;
    }

    /**
     * get time out parameter for request call
     * @return String | null
     * @author Zeynel Dağlı 
     * @since 0.2
     */
    public function getCallTimeOut() {
        return $this->callTimeOut;
    }
    
    /**
     * set base url parameter for request call
     * @param String $restApiBaseUrl
     * @author Zeynel Dağlı 
     * @since 0.2
     */
    public function setRestApiBaseUrl($restApiBaseUrl) {
        $this->restApiBaseUrl = $restApiBaseUrl;
    }

    /**
     * get base url  parameter for request call
     * @return String | null
     * @author Zeynel Dağlı 
     * @since 0.2
     */
    public function getRestApiBaseUrl() {
        return $this->restApiBaseUrl;
    }
}
