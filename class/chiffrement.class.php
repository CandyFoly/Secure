<?php
class Chiffrement {
    private static $cipher  = MCRYPT_RIJNDAEL_128;          // Algorithme utilisé pour le cryptage des blocs
    private static $key     = 'Ventadour Anna-Maeva et Boucard Mathilde LPMI 2017-2018';    // Clé de cryptage
    private static $mode    = 'cbc';                        // Mode opératoire (traitement des blocs)
 
    public static function crypt($data){
        $keyHash = md5(self::$key);
        $key = substr($keyHash, 0,   mcrypt_get_key_size(self::$cipher, self::$mode) );
        $iv  = substr($keyHash, 0, mcrypt_get_block_size(self::$cipher, self::$mode) );
 
        $data = mcrypt_encrypt(self::$cipher, $key, $data, self::$mode, $iv);
        return base64_encode($data);
    }
 
    public static function decrypt($data){
        $keyHash = md5(self::$key);
        $key = substr($keyHash, 0,   mcrypt_get_key_size(self::$cipher, self::$mode) );
        $iv  = substr($keyHash, 0, mcrypt_get_block_size(self::$cipher, self::$mode) );
 
        $data = base64_decode($data);
        $data = mcrypt_decrypt(self::$cipher, $key, $data, self::$mode, $iv);
        return rtrim($data);
    }

    public static function genereationMDP(){
        $tab = array("a","b","c","d","e","f","g","h","i","j","k","l","m","n","o","p","q","r","s","t","u","v","w","x","y","z","A","B","C","D","E","F","G","H","I","J","K","L","M","N","O","P","Q","R","S","T","U","V","W","X","Y","Z",1,2,3,4,5,6,7,8,9);
        $mdp = '';
        for($i=0;$i<16;$i++){
            $ch = rand(0,60);
            $mdp .= $tab[$ch]; 
        }
        return $mdp;
    }
}
?>