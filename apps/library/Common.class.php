<?php
/**
 * @author tguillouet
 * Used to make operations on file who can be performed in all the code
 */
class CommonUtils {
    /* Ini related attributes */
    private $iniFile;
    private $env;

    /**
     * @param $fileName : The path to the config file
     */
    public function setConfigFile($fileName) {
        $this->iniFile = parse_ini_file($fileName, true);
    }

    /**
     * @param String $fileName : The path to the config ini file 
     * @return Object $finalArray : The object who contains all the informations in the config ini file
     * To parse and use data placed into configuration.ini
     */
    private function parseIni () {
        $ini = $this->iniFile;
        $finalArray = array();
        foreach ($ini as $section => $array) {
            foreach ($array as $k => $v) {
                if ($section == 'ALL' || $section == $this->env) {
                    if(preg_match_all("/\d+/", $v)) { // Check if the value is a digit
                        $finalArray[$k] = (int) $v;
                    } else if (preg_match_all("/\b(true|false)\b/", $v)) { // Check if the value is a boolean
                        $bool = false;
                        if (preg_match("/\b(true)\b/", $v)) 
                            $bool = true;
                        $finalArray[$k] = $bool;
                    }else {
                        $finalArray[$k] = $v;
                    }
                }
            }
        }
        return (object) $finalArray;
    }

    /**
     * @return Array : Sections names
     */
    public function getSections() {
        return array_keys($this->iniFile);
    }

    /**
     * @param String $env : The current env of the app
     * @return Object $finalArray : The object who contains all the informations in the config ini file
     */
    public function getEnv($env) {
        $this->env = $env; // Define the current env

        return $this->parseIni(); // Parse and return as an object the config file
    }
}