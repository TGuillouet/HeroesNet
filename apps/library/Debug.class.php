<?php
/**
 * @author tguillouet
 */
class DebugManager {
    /**
     * @param Mixed $var
     * Show informations of a variable
     */
    public function dump($var) {
        echo '<pre>'.
             ' Debugging variable : <br />' . 
             '  Var name : $' . $this->getVarName($var) . '<br />' .
             '  Type : ' . gettype($var) . '<br />' .
             '  Value(s) : ' . $this->getVarInfos($var) . '<br />' .
             '</pre>';
    }

    /**
     * @param Mixed $var
     * @return $varn : The name of the variable
     * Get the name of the specified var
     */
    private function getVarName($var) {
        foreach ($GLOBALS as $varn => $val) {
            if ($val == $var) {
                return $varn;
            }
        }
    }

    /**
     * @param Mixed $var
     * @return String output : The informations of the variable in string or the error mesage
     * Parse var informations
     */
    private function getVarInfos ($var) {
        if (isset($var)) {
            if (is_array($var)) {
                $outputString = '<br />   Keys : <br />';
                foreach ($var as $k => $v) {
                    $outputString .= '    ' . $k . ' => ' . $v . '<br />';
                }
                return $outputString;
            } else {
                return $var;
            }
        } else {
            return 'This variable isn\'t set or is empty';
        }
    }
}