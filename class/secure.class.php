<?php
class secure{

	private $liste = array(
		"patient",
		"accueil",
		"connexion&Inscription",
		"rendez-vous",
		"deconnect"
	);

	private $noir = array(
		"robot",
		"robot.txt",
		"admin",
	);

	static private $regex = array(
		"#[^\w\s<]#",
		"#[^\w\s<>]#",
		"#[^\w\s/]#",
		"#[^\w\s</>]#",
		"#[^\w\s<\w\s/>]#",
		"#[^\w\s<\w\s>]#"		
	);

	static private $regex1 = array(
		"#[\w\s]#",
		"#[\w\s][,][\w\s]#"
	);

	function detecteURLBlanche($server, $uri){
		if($server == '127.0.0.1'){
			$url = explode('/', $uri);
			$i = sizeof($url);
			if (in_array($url[$i-1], $this->liste)){
				echo 'je suis la';
			}else{
				header('Location: '.$this->redirectionURL($url).'accueil');
				detecteURLNoir($server, $url);
			}
		}
	}

	function detecteURLNoir($server, $uri){
		if($server == '127.0.0.1'){
			$url = explode('/', $uri);
			$i = sizeof($url);
			if (in_array($url[$i-1], $this->noir)){
				$rep =get_ip();
				echo  $rep;
			}
		}
	}

    /**
     * Récupérer la véritable adresse IP d'un visiteur
     */
    function get_ip() {
    	// IP si internet partagé
    	if (isset($_SERVER['HTTP_CLIENT_IP'])) {
    		return $_SERVER['HTTP_CLIENT_IP'];
    	}
    	// IP derrière un proxy
    	elseif (isset($_SERVER['HTTP_X_FORWARDED_FOR'])) {
    		return $_SERVER['HTTP_X_FORWARDED_FOR'];
    	}
    	// Sinon : IP normale
    	else {
    		return (isset($_SERVER['REMOTE_ADDR']) ? $_SERVER['REMOTE_ADDR'] : '');
    	}
    }

	function redirectionURL($url){
		$uri=null;
		for ($i=4; $i <sizeof($url) ; $i++) { 
			$uri .= "../";
		}
		return $uri;
	}

	static function protectSQL($post){
		foreach (Secure::$regex as $key => $value) {
			if(preg_match($value, $post))return false;
		}
		foreach(Secure::$regex1 as $key => $value){
			if(preg_match($value, $post))return true;
		}return false;
	}
}
?>