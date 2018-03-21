<?php
/**
 * @author tguillouet
 */
class PDOModel {
    private $db; 

    /**
     * @param String $host : The host name for your SQL DDB
     * @param String $dbName : The name of the ddb
     * @param String $login : The username used to be connected to the ddb (usually 'root')
     * @param String $password : The password used to be connected to the ddb (usually 'root' or '')
     */
    function __construct ($host, $dbName, $login, $password) {
        try {
            $this->db = new PDO("mysql:host=". trim($host) .";dbname=". trim($dbName), trim($login), trim($password));
        } catch (PDOException $e) {
            echo 'Unable to connect to the database. <br/>';
            echo $e->getMessage() . '<br/>';
        }
    }

    /**
     * @param String $query : The SQL Query string 
     */
    function request ($query) {
        if (isset($this->db) && !empty($this->db)) {
            $q = $this->db->prepare($query);
            $q->execute();
            $q->setFetchMode(PDO::FETCH_ASSOC);

            $res = $q->fetchAll();

            $obj = array();
            for ($i = 0; $i < sizeof($res); $i++) {
                array_push($obj, (object) $res[$i]);
            }
            
            if (isset($res)) {
                $out = new stdClass();
                $out->rows = $obj;
                $out->size = sizeof($res);
            }

            return $out;
        }
        return array('Error', 'The database isn\'t setup');
    }

    /**
     * @param String $query : The SQL Query string
     */
    function insert ($query) {
        $query = $this->db->prepare($query);
        $query->execute();
    }
}