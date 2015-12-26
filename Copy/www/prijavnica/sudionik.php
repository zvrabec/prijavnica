<?php
require 'mysqlConnection.php';

class sudionik{
	
	public $ime;
	public $prezime;
	public $adresa;
	public $brojPoste;
	public $mjesto;
	public $telefon;
	public $username;
	public $domain;
	public $skola;
	public $clan;
	public $auto;
	public $izlet;
	public $majica;
	public $boja;
	public $velicina;


	public $email;
	private $password;

function __construct($ime, $prezime, $adresa, $brojPoste, $mjesto, $telefon, $username, $domain, $skola, $clan, $auto, $izlet, $majica, $boja, $velicina){

	$this->ime = $ime;
	$this->prezime = $prezime;
	$this->adresa = $adresa;
	$this->brojPoste = $brojPoste;
	$this->mjesto = $mjesto;
	$this->telefon = $telefon;
	$this->username = $username;
	$this->domain = $domain;
	$this->skola = $skola;
	$this->clan = $clan;
	$this->auto = $auto;
	$this->izlet = $izlet;
	$this->majica = $majica;
	$this->boja = $boja;
	$this->velicina = $velicina;
	$this->email = $username."@".$domain;
	$this->password = $this->generatePassword($username);
}

	

	function sendMailToMember(){
	 $to = $this->email;
         $from = "udruga@normala.hr";
         $subject = "Obavijest o prijavi na struèni skup - Osijek 2010.";
         $message = "Po¹tovani! \n Prijavili ste se na struèni skup putem online prijavnice. Kako biste vidjeli listu prijavljenih i, eventualno, se sna¹li za prijevoz \n vratite se na prijavnicu i unesite sljedeæe podatke u polja za prijavu: \n Korisnièko ime: ".$this->username." Lozinka: ".$this->password;
         $sendResult = $this->mymail($from, $to, $subject, $message);
         
         return $sendResult;
                  
	}
	
	function sendNotification(){
	 $to = "udruga@normala.hr";
         $from = "udruga@normala.hr";
         $subject = "Obavijest o prijavi na struèni skup - Osijek 2010.";
         $message = "Nova prijava: ".$this->ime." ".$this->prezime." ".$this->email." ".$this->telefon."\n Za ostale pojedinosti posjetite http://www.normala.hr/prijavnica";
         $sendResult = $this->mymail($from, $to, $subject, $message);
         return $sendResult;
	}
	
	function insertMember($host, $user, $pass, $database, $table) {
		$query="INSERT INTO $table (ime,prezime,adresa,postnum,mjesto,telefon,email,skola,clan,auto,izlet,majica,boja,velicina,user,password) VALUES ('$this->ime', '$this->prezime', '$this->adresa', '$this->brojPoste', '$this->mjesto', '$this->telefon', '$this->email', '$this->skola', '$this->clan', '$this->auto', '$this->izlet', '$this->majica', '$this->boja', '$this->velicina', '$this->username', '".md5($this->password)."')";
					
			try{
					
					$conn = new mysqlConnection($host, $user, $pass, $database);
					$conn->open();
         			mysql_query($query);
         			$success = true;
					$conn->close();
					unset($conn);
					
			}catch (Exception $e){
					echo $e->getMessage();
					$success = false;
			}
			return $success;
	}
	
	function generatePassword(){
	$pass="";
	for($i=0; $i<3; $i++){
    $r = rand(0,1);
    $c = ($r==0)? rand(65,90) : rand(97,122);
    $n = rand(0,9);
    $pass .= chr($c).$n;
	}
	return $pass;
}
/*private function loadXML($xmlFileName){
			$result=array();
			$xml = simplexml_load_file($xmlFileName);
				foreach($xml->children() as $child)
  				{
  					array_push($result,$child);
  				}
  				return $result;
		}
	
		function isAdmin($username){
			if(in_array($username, $this->loadXML("admins.xml"))){
				return true;
			}
			else{
				return false;
			}
	
		}*/

function mymail($from, $to, $subject, $message) {
  $header =
    "From: {$from}\r\n" . "Content-Type: text/plain; charset=ISO-8859-2\r\n";
  $encoding = mb_internal_encoding();
  mb_internal_encoding( 'ISO-8859-2' );
  $result = mail( $to, mb_encode_mimeheader( $subject, 'ISO-8859-2', 'Q' ), $message, $header);
  mb_internal_encoding( $encoding );
  return $result;
}

}
?>
