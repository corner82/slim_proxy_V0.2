<?php

/**
 * Rest Api Proxy Library
 *
 * @author Zeynel Dağlı
 * @version 0.2
 * @todo Nonce parameter will be encrypted and decrypted in http request 'X-NONCE' parameter
 */
namespace vendor\dal;

class Dal {
    public function __construct() {
        
    }
    
    /**
     * create PDO object and connect to database
     * @return boolean|\PDO
     * @author Mustafa Zeynel Dağlı
     * @since 05/01/2016
     */
    private function getPdo() {
        try {
            $pdo = new \PDO('pgsql:dbname=ostim_development;host=10.18.2.179;',
                            'postgres',
                            '1Qaaal123');
            return $pdo;
        } catch (PDOException $e) {
            return false;
        } 
    }
    
    /**
     * get private key due to public key
     * @param string $publicKey
     * @return type
     * @throws \PDOException
     * @author Mustafa Zeynel Dağlı
     * @since 05/01/2016
     */
    public function getPrivateKey($publicKey) {
        try {
            $pdo = $this->getPdo();
            
            $sql = "              
                    SELECT id,pkey,sf_private_key_value FROM (
                            SELECT id, 	
                                CRYPT(sf_private_key_value,CONCAT('_J9..',REPLACE('".$publicKey."','*','/'))) = CONCAT('_J9..',REPLACE('".$publicKey."','*','/')) as pkey,	                                
                                sf_private_key_value
                            FROM info_users) AS logintable
                        WHERE pkey = TRUE

                    "; 
            
            //print_r($sql);
            
            $statement = $pdo->prepare($sql);  
            $statement->execute();
            $result = $statement->fetchAll(\PDO::FETCH_ASSOC);
            //print_r($result);

            $errorInfo = $statement->errorInfo();
            if ($errorInfo[0] != "00000" && $errorInfo[1] != NULL && $errorInfo[2] != NULL)
                throw new \PDOException($errorInfo[0]);
            return array("found" => true, "errorInfo" => $errorInfo, "resultSet" => $result);
        } catch (\PDOException $e /* Exception $e */) {
            $pdo->rollback();
            return array("found" => false, "errorInfo" => $e->getMessage());
        }
    }
    
    
     /**
     * is public key present for the request
     * @author Okan CIRAN
     * @ public key varsa True değeri döndürür.  !!
     * @version v 1.0  06.01.2016
     * @param array | null $args
     * @return array
     * @throws \PDOException
     */
    public function pkIsThere($params = array()) {
        
        try {
            $pdo = $this->getPdo();          
            $sql = "              
                    SELECT a.public_key =  '".$params['pk']."'
                    FROM act_session a                  
                    WHERE a.public_key =   '".$params['pk']."'
                    ";           
            
            $statement = $pdo->prepare($sql);            
            //echo debugPDO($sql, $params);
            $statement->execute();
            $result = $statement->fetchAll(\PDO::FETCH_ASSOC);
            $errorInfo = $statement->errorInfo();
            if ($errorInfo[0] != "00000" && $errorInfo[1] != NULL && $errorInfo[2] != NULL)
                throw new \PDOException($errorInfo[0]);
            return array("found" => true, "errorInfo" => $errorInfo, "resultSet" => $result);
        } catch (\PDOException $e /* Exception $e */) {
            $pdo->rollback();
            return array("found" => false, "errorInfo" => $e->getMessage());
        }
    }
}
