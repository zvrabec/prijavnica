<?php

	$dbsettings = include 'dbsettings.php';	
	
	$conn=mysql_pconnect($dbsettings->dbhostname,$dbsettings->dbusername,$dbsettings->dbpassword);
	mysql_select_db($dbsettings->dbname, $conn);
	$result = mysql_query("SELECT * FROM ".$dbsettings->dbtbl, $conn);
	echo 'Ukupan broj redova je '. mysql_num_rows($result);

echo 'tu sam';






?>