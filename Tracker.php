<html>
<head>
<meta http-equiv="Content-type" content="text/html; charset=UTF-8"/>

<?php       
	//require ($_SERVER["DOCUMENT_ROOT"]."/config.php");
	//header("Content-Type: text/html; charset=UTF-8");
	$connection= @mysql_connect("localhost", "Zendoris", "password") or die ("Eroare de conectare la server.");
	mysql_select_db("forum", $connection);

	$this_page = $_SERVER["PHP_SELF"];
	$IP=$_SERVER["REMOTE_ADDR"];
	$data=time();

	$query="INSERT INTO trackerul (pagina, IP, data) values ('$this_page', '$IP', '$data')";
	mysql_query($query, $connection);
	
	$query = "SELECT count(*) FROM trackerul WHERE pagina = '$this_page'";
	$result = mysql_query($query, $connection);
	$views = mysql_result($result, 0, "count(*)");

	echo "<br> Pagina a fost văzută de ".($views)." de ori.";

?>

</head>
</html>