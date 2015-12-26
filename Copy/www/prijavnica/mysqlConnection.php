<?php
class mysqlConnection{
	
	public $host;
	public $username;
	public $password;
	public $database;
	public $dbconnection;
	private $isconnected = false;
	
	public function __construct($host, $username, $password, $database){
		$this->host = $host;
		$this->username = $username;
		$this->password = $password;
		$this->database = $database;
	}
	
	public function open(){
	
	try{
				$this->dbconnection = mysql_connect("$this->host", "$this->username", "$this->password");
				mysql_select_db ("$this->database",$this->dbconnection);
				if(!$this->dbconnection){
					throw new Exception('MySQL Connection Database Error: ' . mysql_error());
				}
				else{
						$this->isconnected = true;
				}
		}
		catch (Exception $e){
			echo $e->getMessage();
		}
	
	}
	
	public function close(){
		if($this->isconnected){
			mysql_close($this->dbconnection);
			$this->isconnected = false;
		}
		else{
			return 'Error: No connection has been established to the database. Cannot close connection.';
		}
	
	
	}
	
}
?>