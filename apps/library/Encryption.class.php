<?php
/* Reference :
 * https://openclassrooms.com/courses/securiser-les-mots-de-passe-des-utilisateurs-avec-php
 */
class Encryption {
    /**
     * @param String $strToEncrypt : The string to encrypt
     * @return Array : the array who contains all informations to decrypt the string
     */
    public function encrypt($strToEncrypt) {
        $ivlen = openssl_cipher_iv_length('blowfish');
        $iv = openssl_random_pseudo_bytes($ivlen);
        $salt = $this->createSalt();
        $encrypted_string = openssl_encrypt($strToEncrypt, 'blowfish', $salt, 0, $iv);
        return array('encrypted_string' => $encrypted_string, 'salt' => $salt, 'iv' => $iv);
    }

    /**
     * @param String $strToDecrypt : The string to decrypt
     * @param String $encryption_key : The salt
     * @param String $iv : The iv
     * @return String : The decrypted String
     */
    public function decrypt($strToDecrypt, $encryption_key, $iv) {
        $decrypted_string = openssl_decrypt($strToDecrypt, 'blowfish', $encryption_key, 0, $iv);
        return $decrypted_string;
    }

    /**
     * Create the salt (encryption key)
     */
    private function createSalt () {
        $salt = rand() . time() . rand();
        return $salt;
    }
}