<?php
/**
 * ECOMAN Rest Api Proxy Library
 *
 * @link      https://github.com/Leadera/ecoman_slim/tree/ecoman_proxy for the canonical source repository
 * @copyright Copyright (c) 2014 - 2015 
 * @license   https://github.com/Leadera/ecoman_slim/blob/slim2/LICENSE
 * @author Zeynel Dağlı
 * @version 0.0.1
 */
require_once 'vendor\SPR0\AutoLoad\spr0Loader.php';

$classLoader = new \SPR0\AutoLoad\spr0Loader("vendor", '');
$classLoader->register();

/*
require_once 'vendor\Proxy\AbstractProxy.php';
require_once 'vendor\Proxy\Proxy.php';   
require_once 'vendor\Slim\SlimTestProxy.php';*/


//$proxyClass = new \vendor\Slim\SlimTestProxy();
$proxyClass = new \vendor\Slim\SlimHmacProxy();
$proxyClass->setRestApiBaseUrl("http://localhost/slim_test/");
$proxyClass->setRestApiEndPoint("index.php/");
//$proxyClass->setEndPointUrl('http://88.249.18.205:8090/slim2_ecoman/index.php/');
//$ecoman->setEndPointUrl('http://88.249.18.205:8090/slim2_ecoman/index.php/');
echo $proxyClass->redirect();