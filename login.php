<?php
session_start();
include_once "Conn.php";

if (isset($_POST["nume"]))
   {
     $username = $_POST["nume"];
     $password = $_POST["parola"];
     $query = "SELECT * FROM utilizatori WHERE nume='".$username."' AND parola='".$password."' LIMIT 1";
     $rez = mysql_query($query) or exit("Error");

     if(mysql_num_rows($rez)==1)
                       {
                         $row = mysql_fetch_assoc($rez);
                         $_SESSION["ID"] = $row["id"];
                         $_SESSION["nume"] = $row["nume"];
                         header("Location: index.php");
                         echo "Logat ca: ".$username;
                       }
else
{
  echo 'A esuat autentificarea';
  exit();
}

}
else echo 'Null';
?>