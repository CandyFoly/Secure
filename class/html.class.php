<?php
class Html{
	static function redirection(){
		$url = explode('/', $_SERVER['REQUEST_URI']);
		$i = sizeof($url);
		$uri = null;
		if($i>3){
			foreach ($url as $key => $value) {
				if($key>3)$uri .="../"; 
			}
		}
		return $uri;
	}
}
?>