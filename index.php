<?php session_start(); ?>

 <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
 "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
 <html xmlns="http://www.w3.org/1999/xhtml"> 
 
 <head>
 <meta http-equiv="Content-Type" content="text/html; charset=utf-8" /> 

 </head> 
 <body>

 <?php
       if (!isset($_SESSION['ID']))
          {
           echo '
                <fieldset>
                <LEGEND> Logare </legend>
                
                <form action= "login.php" method="post">
                Nume: <input type="text" name="nume" />&nbsp;
                Parola: <input type="password" name="parola" /> &nbsp;
                <input type="submit" name="submit" value= "La forum" />
                </form>
                </fieldset>
                ';
          }
          else
              {
                echo 'Utilizatorul: '.$_SESSION['nume'].'<a href="logout.php" onClick = "return Logout()"> Iesi </a>';
              }
 ?>

 <script language="javascript">
 function Logout()
          {
            var acord=confirm ("Vreti sa iesiti de pe forum?");
            if acord
            return TRUE
            else
            return FALSE
          }
            </script>
 </body>
 </html>