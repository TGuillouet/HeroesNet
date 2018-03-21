<?php
require _MODELS.'/PDOModel.php';
class RequestsModel {
    private $pdo;

    /**
     * Init section
     */
    public function __construct ($host, $dbName, $login, $password) {
        $this->pdo = new PDOModel($host, $dbName, $login, $password);
    }

    private function fetch ($query) {
        return $this->pdo->request($query);
    }

    /**
     * Query section (Methods are always public)
     */

    /**
     * SQL Select
     */
    public function auth($username) {
        $q = 'SELECT username, password, salt, iv, CONCAT(first_name, " ", last_name) AS full_name FROM users WHERE username = "' . $username . '"';
        return $this->fetch($q);
    }   

    public function userExist($username) {
        $q = 'SELECT username FROM users WHERE username = "' . $username . '"';
        return $this->fetch($q);
    }   

    /**
     * SQl Insert
     */
    public function createUser($userObject, $encryptedPassArray) {
        $q = 'INSERT INTO users(username, 
                                first_name, 
                                last_name, 
                                password, 
                                salt, 
                                iv) 
              VALUES ("'. $userObject->username .'", 
                      "'. $userObject->first_name .'", 
                      "'. $userObject->last_name .'", 
                      "'. $encryptedPassArray['encrypted_string'] .'", 
                      "'. $encryptedPassArray['salt'] .'", 
                      "'. $encryptedPassArray['iv'] .'")';
                      
        $this->pdo->insert($q);
    }
}