<?php
	header("Content-Type: text/html; charset=UTF-8");
	$connection = @mysql_connect("localhost", "Zendoris", "password")
	or die ("Eroare de conectare la server.");

	mysql_select_db("forum", $connection) or exit("Eroare de conectare la baza de date.");
	
	$name="";
	if(isset ($_POST["nume"]) )
	         $name= $_POST["nume"];

	$length=strlen($name);
	//Scrie in baza de date numai daca exista un nume

	if($length>0)
		{
		$date= time();
                $ver = mysql_query("SELECT * FROM utilizatori WHERE nume= '$name' ", $connection);
                $cnt = mysql_num_rows($ver);
                
                if($cnt == 0)
                        {
                        echo "Numele nu este recunoscut. ";
                        echo " <a href='http://localhost/Inreg.php'> Utilizator nou </a> <br/>";
                        //header ("Location: http://localhost/Inreg.php?pop=yes");
                        }
                else
                        {
	            	$query= "INSERT INTO postari (ID, nume, comentariu, data)
	             	values (NULL, '$name', '$_POST[comentariu]', '$date') ";
	              	mysql_query($query, $connection) or die (mysql_error() );
	               	echo "Comentariul a fost postat!";      }
                        }

//mysqli_close($connection);
?>

<html>
<head>
	<title> Forumul lui Zendoris </title>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
</head>

<body> <center>

<form action= "Guestbook2.php" method="POST">
	<FONT FACE="arial" size="2" color="brown">
	Nume: <input type="text" name="nume"> &nbsp; <br>
	Text: <br>
	<textarea style="width: 80%" rows="15" name="comentariu"> </textarea>
	<center> <input type="submit" value="Trimite"> </center>
	</font>
</form>

<br> <br>

<table bgcolor= "#ACADAB" border= "1" width="84%" cellspacing="1" cellpadding="2">
<?php

	$result = mysql_query("SELECT * FROM postari ORDER BY data", $connection);
	$cnt= mysql_num_rows($result);
	

	if (!isset ($pagenumber))
	   $pagenumber = 1;
	$pePagina = 25;
	$ult = ceil($cnt / $pePagina);

        $max = 0;
	if ($pagenumber<1)
               $pagenumber = 1;
        elseif ($pagenumber > $ult)
               $pagenumber = $ult;

        if (isset ($_GET ['pagenumber']))
           $pagenumber = $_GET['pagenumber'];
        echo "<p style='color: brown;' > Pagina $pagenumber din $ult. </p>";

        if($pagenumber == 1)
         {
         }
        else
            {
              echo " <a href= '{$_SERVER['PHP_SELF']}?pagenumber=1'> Prima pagină</a> ";
              $prec = $pagenumber-1;
              echo " <a href= '{$_SERVER['PHP_SELF']}?pagenumber=$prec'> Precedenta </a> ";
            }
        
        echo "<br> <br>";

        if ($pagenumber == $ult)
           {
           }
        else
            {
              $urm = $pagenumber+1;
              echo " <a href= '{$_SERVER['PHP_SELF']}?pagenumber=$urm'> Următoarea pagină</a> ";
              echo " <a href= '{$_SERVER['PHP_SELF']}?pagenumber=$ult'> Ultima </a> ";
            }

        $max = 'limit '.($pagenumber - 1) * $pePagina.','.$pePagina;


        $i=0;
        $result = mysql_query("SELECT * FROM postari ORDER BY data $max", $connection);

	while($inf=mysql_fetch_row($result))
		{
		$name = mysql_result($result, $i, "nume");
	        $sql = mysql_query("SELECT nume FROM postari where nume='{$name}'", $connection);
                $nPost = mysql_num_rows($sql);

		$comment = mysql_result($result, $i, "comentariu");
		$length = strlen($comment);
		if (!$length)
                  exit('Textul trebuie scris.');

		$comment = nl2br($comment);
		$data = mysql_result($result, $i, "data");
		$Arata_Data = date("H:i:s m/d/Y", $data);
		
		$j = $i % 3;
		if(!$j)
			$bgColor = "#8D9E0F";
		elseif ($j == 1)
			$bgColor = "#79BDF2";
		else
			$bgColor = "#ABDCEF";
                 $i++;

		echo '
		<tr>
			<td width= "84%" bgcolor= "'.$bgColor.'">
			<font face = "arial" size= "2">';

                        echo '<b> Nume: </b> <a href="Date.php?action=';
                        echo "'$name'";
                        echo '" >'.$name.' </a>';

			echo '
			<br>
			<b> Postări: </b>'.$nPost.' <br>
			<b> Comentariu: <br> </b> '.$comment. '
			</font>

			
			<td>
			<td width= "20%" valign= "top" nowrap bgcolor= "'.$bgColor.'">
			<font>
				<b> Data: </b> '.$Arata_Data.'
				</font>
				</td>
				</tr>
			';
		}


//mysqli_close($connection);
?>

</table>
</center>

<br>
<h3> <a href="Clasament.php" target='_blank'> Date despre forum </a> </h3>

<?php    include ("Tracker.php"); ?>

</body>
</html>