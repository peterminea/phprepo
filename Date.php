<?php

$conex = mysqli_connect("localhost", "Zendoris", "password", "forum");
if(mysqli_connect_errno ($conex) )
	echo "Eroare la conectare";

echo "Exerciții cu data calendaristică: duminică, 28 aprilie 1996.<br>";

$rez = mysqli_query($conex, 'SELECT DataNastere FROM utilizatori WHERE ID=4');
printf ("Avem doar %d rezultat. \n", $rez->num_rows);

$rez = mysqli_query($conex, "select extract(DAY from (select DataNastere from utilizatori where ID=4)) as Zi" );
$zi = mysqli_fetch_object($rez);

$rez = mysqli_query($conex, "select extract(MONTH from (select DataNastere from utilizatori where ID=4)) as Luna" );
$luna = mysqli_fetch_object($rez);

$rez = mysqli_query($conex, "select extract(YEAR from (select DataNastere from utilizatori where ID=4))as An" );
$an = mysqli_fetch_object($rez);

printf("\nData nașterii: %s.%s.%s\n", $zi->Zi, $luna->Luna, $an->An);

$rez = mysqli_query($conex, 'SELECT DataNastere from utilizatori WHERE ID=4');
$data = mysqli_fetch_object($rez);

printf("\n\n Din nou data nașterii: %s\n.", $data->DataNastere);

$dataNoua = $data->DataNastere;
$data = strtotime($dataNoua);
echo date ('Y/M/d', $data);

echo "<br> <br>";

$action = $_GET['action'];

//$action = (string)$action;

$rez = mysqli_query($conex, "select Nume, Functie, Email, DataNastere, DataInregistrare from utilizatori WHERE Nume={$action}");
$data = mysqli_fetch_object($rez);

echo "<p style='color: navy; margin-left: 15px; font-decoration: bold; font-size: 21px;'> DATELE OMULUI</p> <br> <br>";

printf("Numele: %s.", $data->Nume);
echo "<br>";
printf("Născut la: %s.", $data->DataNastere);
echo "<br>";

printf("Email: %s.", $data->Email);
echo "<br>";
printf("Înregistrat pe: %s.", $data->DataInregistrare);
echo "<br>";
printf("Funcție: %s.", $data->Functie);


switch ($action)
	{
	case "'Decebal'":
	echo "<br> <br> <p style='font-family: arial; font-size: 14px; color: blue;'> Acest membru face probleme și s-ar putea să aibă pe viitor funcția 'Banat'. </p> <br>";
	break;

	default:
	break;

	}

mysqli_close($conex);
?>