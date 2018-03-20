<?php 
class Autoloader{

    static function register(){
        spl_autoload_register(array(__CLASS__, 'autoload'));
    }

    static function autoload($class){
    	$adresse = $_SERVER['PHP_SELF'];
		$a = explode('/', $adresse);
		$i = sizeof($a);
		if($a[$i-1] == 'index.php'){
			require 'class/' . $class . '.class.php';
		}else{
			require '../class/' . $class . '.class.php';
		}
    }

}
?> 
