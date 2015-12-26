<?php
require_once 'sudionik.php';
require_once 'mysqlConnection.php';

$dbhostname = "localhost";
$dbname = "strucni_skupovi";
$dbtbl = "osijek2010";
$dbusername = "strucniskup";
$dbpassword = "strucniskup123!!";

$tip = $_REQUEST["tip"];	

switch ($tip){
			
		case "unos":
			
		$ime = $_REQUEST["txtIme"];
		$prezime = $_REQUEST["txtPrezime"];
		$adresa = $_REQUEST["txtAdresa"];
		$broj_poste = $_REQUEST["txtPostNumber"];
		$mjesto = $_REQUEST["txtMjesto"];
		$telefon = $_REQUEST["txtPhone"];
		$user = $_REQUEST["txtUser"];
		$domain = $_REQUEST["txtDomain"];
		$skola = $_REQUEST["txtSkola"];
		if(isset($_POST['chkClan'])){
			$clan="+";
		}
		else{
			$clan="-";
		}		
		
		if(isset($_POST['chkAuto'])){
			$auto="+";
		}
		else{
			$auto="-";
		}		
		
		if(isset($_POST['chkIzlet'])){
			$izlet="+";
		}
		else{
			$izlet="-";
		}		
		if(isset($_POST['chkMajica'])){
			$majica="+";
			$boja = $_REQUEST["selectColor"];
			$velicina = $_REQUEST["selectSize"];
		}
		else{
			$majica="-";
			$boja = NULL;
			$velicina = NULL;
		}		
		
		$sudionik = new sudionik($ime, $prezime, $adresa, $broj_poste, $mjesto, $telefon, $user, $domain, $skola, $clan, $auto, $izlet, $majica, $boja, $velicina);
		if($sudionik->insertMember($dbhostname, $dbusername, $dbpassword, $dbname, $dbtbl) && $sudionik->sendMailToMember() && $sudionik->sendNotification()){
			unset($sudionik);
			echo "<SCRIPT LANGUAGE='javascript'>window.alert ('Prijava uspje¹no izvr¹ena! Na email koji ste unijeli stiæi æe vam ostale upute.'); window.open('index.php','_self');</SCRIPT>";
		}
		else{
			unset($sudionik);
			echo "<SCRIPT LANGUAGE='javascript'>window.alert ('Gre¹ka prilikom prijave!'); window.open('index.php','_self');</SCRIPT>";
		}
		$tip=NULL;
		break;
		case "login":
			$username = $_REQUEST["txtUserName"];
			$password = $_REQUEST["txtPassword"];
			$conn = new mysqlConnection($dbhostname, $dbusername, $dbpassword, $dbname);
			$conn->open();
			
			
				if (!validateLoginData($username, $password, $conn->dbconnection)){
				echo "<SCRIPT LANGUAGE='javascript'>window.alert ('Pogre¹no upisani podaci ili niste prijavljeni na skup!'); window.open('index.php','_self');</SCRIPT>";
				$conn->close();
				unset($conn);
			}
			else{
				if(isAdmin($username)){
					$query="SELECT ime, prezime, adresa, postnum, mjesto, telefon, email, skola, clan, auto, izlet, majica, boja, velicina, user FROM ".$dbtbl;
					$result = mysql_query($query);
					if(mysql_num_rows($result)<=0){
						$conn->close();
						unset($conn);
         				echo "<SCRIPT LANGUAGE='javascript'>window.alert ('Nema zapisa!');window.open('index.php','_self');</SCRIPT>";
					}
         		else{
         			echo'
					<html>
					<head>
					<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
					<link rel="stylesheet" type="text/css" href="css/style.css" />
					<script type="text/javascript" src="javascript/scripts.js"></script>
					</head>
					<body onload="applyinitialcss();">
							<div id="tableContainer" class="tableContainer"><table id="gridTable" border="0" cellpadding="0" cellspacing="0" class="gridTable">
									<tr class="fixedHeader"><td>Rbr.</td><td>Ime</td><td>Prezime</td><td>Adresa</td><td>Po¹t. broj</td><td>Mjesto</td><td>Telefon</td><td>e-mail</td><td>©kola</td><td>Èlan Normale</td><td>Auto</td><td>Izlet</td><td>Majica</td><td>Boja</td><td>Velièina</td><td>Korisnièko ime</td></tr>';
         				$rbr = 1;
         				$brclanova = 0;
         				$brauta = 0;
         				$brizleta = 0;
         				$brmajica = 0;
						while ($all = mysql_fetch_assoc($result)){
							
						    if($all["clan"]=="+"){$brclanova++;}
							if($all["izlet"]=="+"){$brizleta++;}
							if($all["auto"]=="+"){$brauta++;}
							if($all["majica"]=="+"){$brmajica++;}
							
							if($rbr%2!=0){
								echo '<tr class="normalRow"><td>'.$rbr.'.</td><td>'.$all["ime"].'</td><td>'.$all["prezime"].'</td><td>'.$all["adresa"].'</td><td>'.$all["postnum"].'</td><td>'.$all["mjesto"].'</td><td>'.$all["telefon"].'</td><td>'.$all["email"].'</td><td>'.$all["skola"].'</td><td>'.$all["clan"].'</td><td>'.$all["auto"].'</td><td>'.$all["izlet"].'</td><td>'.$all["majica"].'</td><td>'.$all["boja"].'</td><td>'.$all["velicina"].'</td><td>'.$all["user"].'</td></tr>';
							}
							else{
								echo '<tr class="alternateRow"><td>'.$rbr.'.</td><td>'.$all["ime"].'</td><td>'.$all["prezime"].'</td><td>'.$all["adresa"].'</td><td>'.$all["postnum"].'</td><td>'.$all["mjesto"].'</td><td>'.$all["telefon"].'</td><td>'.$all["email"].'</td><td>'.$all["skola"].'</td><td>'.$all["clan"].'</td><td>'.$all["auto"].'</td><td>'.$all["izlet"].'</td><td>'.$all["majica"].'</td><td>'.$all["boja"].'</td><td>'.$all["velicina"].'</td><td>'.$all["user"].'</td></tr>';
							}
								
								$rbr++;
						}
						$rbr--;
		 			echo '
		 			<tr class="fixedFooter"><td colspan="9">Ukupan broj prijavljenih: '.$rbr.'</td><td>Ukupno: '.$brclanova.'</td><td>Ukupno: '.$brauta.'</td><td>Ukupno: '.$brizleta.'</td><td>Ukupno: '.$brmajica.'</td><td colspan="3"></td></tr>
					</table></div>
					</body>
					</html>';
		 			$conn->close();
					unset($conn);
         		
         		}
				
				}
				else{
					$query="SELECT ime,prezime,adresa,postnum,mjesto,telefon,email,auto FROM ".$dbtbl;
					$result = mysql_query($query);
					if(mysql_affected_rows()<=0){
         				echo "<SCRIPT LANGUAGE='javascript'>window.alert ('Nema zapisa!');window.open('index.php','_self');</SCRIPT>";
					}
         		else{
         			echo '
         			<html>
					<head>
					<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
					<link rel="stylesheet" type="text/css" href="css/style.css" />
					<script type="text/javascript" src="javascript/scripts.js"></script>
					</head>
					<body onload="applyinitialcss();">
							<div id="tableContainer" class="tableContainer"><table id="gridTable" border="0" cellpadding="0" cellspacing="0">
									<tr class="fixedHeader"><td>Rbr.</td><td>Ime</td><td>Prezime</td><td>Adresa</td><td>Po¹t. broj</td><td>Mjesto</td><td>Telefon</td><td>e-mail</td><td>Auto</td></tr>';
         				$rbr = 1;
						while ($all = mysql_fetch_assoc($result)){
							if($rbr%2!=0){
								
								echo '<tr class="alternateRow"><td>'.$rbr.'.</td><td>'.$all["ime"].'</td><td>'.$all["prezime"].'</td><td>'.$all["adresa"].'</td><td>'.$all["postnum"].'</td><td>'.$all["mjesto"].'</td><td>'.$all["telefon"].'</td><td>'.$all["email"].'</td><td>'.$all["auto"].'</td></tr>';
							}
							else{
								echo '<tr class="normalRow"><td>'.$rbr.'.</td><td>'.$all["ime"].'</td><td>'.$all["prezime"].'</td><td>'.$all["adresa"].'</td><td>'.$all["postnum"].'</td><td>'.$all["mjesto"].'</td><td>'.$all["telefon"].'</td><td>'.$all["email"].'</td><td>'.$all["auto"].'</td></tr>';
							}
								$rbr++;
						}
		 			echo '
					</table></div>
					</body>
					</html>';
		 			$conn->close();
					unset($conn);
         		}
				}
			}
			break;

}

function validateLoginData($uname, $pass, $dbconn){
		global $dbtbl;
		$query = "SELECT * FROM ".$dbtbl." WHERE user='".$uname."' AND password='".md5($pass)."'";
		$result = mysql_query($query, $dbconn);
       if(mysql_num_rows($result)<=0){
         	$resp=false;
         }
         else{
         	$resp=true;
         }
         return $resp;
}

	function loadXML($xmlFileName){
	$result=array();
	$xml = simplexml_load_file($xmlFileName);
		foreach($xml->children() as $child)
  		{
  			array_push($result,$child);
  		}
  		return $result;
	}
	
	function fillSelectBox($xmlFileName){
	foreach (loadXML($xmlFileName) as $i => $value){
		echo "<option value=".$value.">".$value."</option>";
	}
}
	
	function isAdmin($username){
		if(in_array($username, loadXML("xml/admins.xml"))){
			return true;
		}
		else{
			return false;
		}
	
}
	
?>
