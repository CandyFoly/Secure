<?php 
class connexion{
	private  $db_name;
	private  $db_user;
	private  $db_pass;
	private  $db_host;
	private  $pdo;
	//login : medecin_patient; mdp = 8PGHNwDRALDrBdMv;
	public function __construct($db_name = "hopital", $db_user = "root", $db_pass = "root", $db_host = "127.0.0.1"){
		$this->db_name = $db_name;
		$this->db_user = $db_user;
		$this->db_pass = $db_pass;
		$this->db_host = $db_host;
	}
	
	public function getPDO()
	{
		if($this->pdo ===null){
			
			$pdo = new PDO('mysql:dbname=hopital;host=127.0.0.1', 'root', 'root');
			$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$this->pdo = $pdo;
		}
		return $this->pdo;
	}
	
	public function query($statement){
		$req = $this->getPDO()->query($statement);
		$data = $req->fetchAll(PDO::FETCH_CLASS);
		return $data;
	}
	
	public function prepare($statement, $attributes){
		$req = $this->getPDO()->prepare($statement);
		foreach($attributes as $key => $value){
			if($value == ""){
				$value = NULL;
			}
			$req->bindParam($key, $value);
		}
		
		if ($req->execute($attributes) == true)return true;
	}

	public function prepareQuery($statement, $attributes){
		$req = $this->getPDO()->prepare($statement);
		foreach($attributes as $key => $value){
			$req->bindParam($key, $value);
		}
		
		$req->execute($attributes);
		$data = $req->fetchAll(PDO::FETCH_OBJ);
		return $data;
	}
	
	public function uid($statement){
		$req = $this->getPDO()->query($statement);
	}
} 
?>
