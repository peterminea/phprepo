 <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
 "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd"> 
 <html xmlns="http://www.w3.org/1999/xhtml"> 
 
 <head> 
 <meta http-equiv="Content-Type" content="text/html; charset=utf-8" /> 
 <title> Date de pe forum </title> 
 </head> 
 <body> 

<?php

function Conectare()
	{
	$connect = mysql_connect('localhost', 'Zendoris', 'password');
	if (!$connect)
		return false;
	if (!mysql_select_db('forum', $connect))
		return false;
	
	return $connect;
		
	}

function Selectare()
	{
		$connect=Conectare();
		
		$query = mysql_query("select * from Postari;", $connect);
		echo "Sunt ".mysql_num_rows($query)." de mesaje în forum.";	
	}
	
function DateMembri()
         {
         $conexiune = Conectare();

           $result = mysql_query("SELECT DISTINCT nume FROM Postari", $conexiune);
           echo "Membri activi: ".mysql_num_rows($result).".<br>";

           $result = mysql_query ("SELECT Nume from utilizatori", $conexiune);
           echo "Total de membri: ".mysql_num_rows ($result).".<br>";
         }
	
function Clasament()
	{
		echo '
			<table bgcolor = "#640000" border="2">
                         <tr style= "font-family: arial; size: 3" >

			<th width= "25%" bgcolor="#CABEDA" >
			<b> Loc </b>
                        </th>

			<th width= "50%" bgcolor="#DFFDFF" >
			<b> Nume </b>
                        </th>

			<th width= "40%" bgcolor="#ABECED" >
			<b>Postări </b>
			</th>

			</tr>
		';
		
	$connect = Conectare();
	$query = mysql_query("select nume, count(comentariu) as NumCom 
		from Postari group by nume order by NumCom DESC", $connect);
	$cnt = mysql_num_rows($query);
	
	for($i=0; $i<$cnt; $i++)
		{
		$name = mysql_result($query, $i, "nume");
		$numpost = mysql_result($query, $i, "NumCom");
		
		echo
                   '<tr style= "font-family: times; size: 2; color: yellow" > <td>'
                    .($i+1).
                   '</td> <td>'
                   .$name.
                   '</td> <td>'
                   .$numpost.
                   '</td> </tr>';
		}
	}

        echo '</table>';

DateMembri();
echo '<br>';
Selectare();
echo '<br> <br> <p style="font-family: courier; size: 4;"> Ordonarea după postări: </p> <br>';
Clasament();
?>

</body> 
 </html>