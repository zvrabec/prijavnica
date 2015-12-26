<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-1250">
<title>PRIJAVA NA STRUČNI SKUP</title>
<link rel="stylesheet" type="text/css" href="css/style.css" />
<link rel="stylesheet" href="css/jd.gallery.css" type="text/css" media="screen" />
<script type="text/javascript" src="javascript/scripts.js"></script>
<script src="javascript/mootools-1.2.1-core-yc.js" type="text/javascript"></script>
<script src="javascript/mootools-1.2-more.js" type="text/javascript"></script>
<script src="javascript/jd.gallery.js" type="text/javascript"></script>
<script src="javascript/jd.gallery.transitions.js" type="text/javascript"></script>
</head>
<body onload="applyinitialcss();">
	<?PHP include 'handle_data.php';?>
<table width="100%">
	<thead></thead>
	<tbody>
		<tr>
			<td width="520">
				<div id="formContainer" style="border:solid 1px #000000; height:330px;">
				<form name="inputForm" id="inputForm" method="post" action="handle_data.php">
				<table id="tblUnos">
					<thead></thead>
					<tbody>
						<tr><td>Ime:</td><td><input type="text" name="txtIme" id="txtIme" align="middle"/></td></tr>
						<tr><td>Prezime:</td><td><input type="text" name="txtPrezime" id="txtPrezime" /></td></tr>
						<tr><td>Adresa stanovanja:</td><td><input type="text" name="txtAdresa" id="txtAdresa" size="25" /></td></tr>
						<tr><td>Poątanski broj:</td><td><input type="text" name="txtPostNumber" id="txtPostNumber" size="10"/></td></tr>
						<tr><td>Mjesto</td><td><input type="text" name="txtMjesto" id="txtMjesto" /></td></tr>
						<tr><td>Telefon/Mobitel:</td><td><input type="text" name="txtPhone" id="txtPhone" /></td></tr>
						<tr><td>e-mail:</td><td><input type="text" name="txtUser" id="txtUser" />@<input type="text" name="txtDomain" id="txtDomain" /></td></tr>
						<tr><td>©kola:</td><td><input type="text" name="txtSkola" id="txtSkola" size="44" /></td></tr>
						<tr><td colspan="2"><input type="checkbox" name="chkClan" id="chkClan" value="false" /> Član sam udruge <i>Normala</i></td></tr>
						<tr><td colspan="2"><input type="checkbox" name="chkAuto" id="chkAuto" value="false" /> Dolazim vlastitim automobilom</td></tr>
						<tr><td colspan="2"><input type="checkbox" name="chkIzlet" id="chkIzlet" value="false" disabled/> ®elim ići na izlet</td></tr>
						<tr><td><input type="checkbox" name="chkMajica" id="chkMajica" value="false" onchange="enableSelect(this,'selectColor'); enableSelect(this,'selectSize');" /> ®elim kupiti majicu</td><td><select name="selectColor" id="selectColor" disabled="disabled"><option value="1">Boja</option><?PHP fillSelectBox("xml/colors.xml");?></select><select name="selectSize" id="selectSize" disabled="disabled"><option value="1">Veličina</option><?PHP fillSelectBox("xml/sizes.xml");?></select></td></tr>
						<tr><td colspan="2"><div align="center"><input name="tip" value="unos" id="hidUnos" type="hidden" /></div></td></tr>
						<tr><td colspan="2" align="center"><input type="button" 
name="btnUnos" id="btnUnos" value="Prijavi se"  onclick="document.inputForm.submit()"/></td></tr>
					</tbody>
					<tfoot>
						<tr><td></td></tr>
					</tfoot>
				</table>
				</form>
				</div>
			</td>
			<td>
<script type="text/javascript">
function startGallery() {
var myGallery = new gallery($('myGallery'), {
timed: false,
showArrows: true,
showCarousel: false,
embedLinks: false,
useThumbGenerator: true
});
}
window.addEvent('domready', startGallery);
</script>
<div id="myGallery">
<div class="imageElement">
<h3>Crna sprijeda</h3>
<p>Crna majica sprijeda</p>
<a href="mypage1.html" title="open image" class="open"></a>
<img src="images/brugges2006/1.png" class="full" />
</div>
<div class="imageElement">
<h3>Crna straga</h3>
<p>Crna majica straga</p>
<a href="mypage2.html" title="open image" class="open"></a>
<img src="images/brugges2006/2.png" class="full" />
</div>
<div class="imageElement">
<h3>Crvena sprijeda</h3>
<p>Crvena majica straga</p>
<a href="mypage2.html" title="open image" class="open"></a>
<img src="images/brugges2006/3.png" class="full" />
</div>
<div class="imageElement">
<h3>Crvena straga</h3>
<p>Crvena majica straga</p>
<a href="mypage2.html" title="open image" class="open"></a>
<img src="images/brugges2006/4.png" class="full" />
</div>
</div>
Ukoliko ľelite kupiti viąe od jedne majice, poąaljite mail na <a href="mailto:zvrabec@normala.hr">zvrabec@normala.hr</a><br> i navedite boje majica i veličine koje ľelite.
</td>
		</tr>
	</tbody>
	<tfoot>
	<tr><td colspan="2" align="center">
	<form name="loginForm" id="loginForm" method="post" action="handle_data.php">
	<table>
		<tr><td colspan="2" align="center"><div id="loginDiv" style="border:solid 1px #000000;">Korisničko ime:<input type="text" name="txtUserName" id="txtUserName" /> Lozinka:<input type="password" name="txtPassword" id="txtPassword" /><input type="button" value="Pregled prijava" onclick="document.loginForm.submit();" /></div></td></tr>
		<tr><td colspan="2"><div align="center"><input name="tip" value="login" id="hidLogin" type="hidden" /></div></td></tr>
		</table>
	</form>	
	</td></tr>
	</tfoot>
</table>
</body>
</html>
