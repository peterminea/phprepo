<?php

include_once("Conn.php");
     echo "MODULUS";
     

if (!isset($_POST['submit']))
{
    echo 
    "<fieldset>
    <legend> Inregistrarea unui utilizator </legend>   ";
    echo '
    <table border="0" cellspacing="2">
    ';
    
    echo '

    <form method= "post" action= "reg.php">
    <tr> <td colspan="2" Formular de Inregistrare </td> </tr> 
    ';
    
    echo '
    <tr> <td> Nume </td> <td> <input type="text" name= "nume"> </td> </tr>
    <tr> <td> Parola </td> <td> <input type="password" name="password"> </td> </tr>
    <tr> <td> Email </td> <td> <input type="text" name= "email"/> </td> </tr>
    <tr> <td colspan=2"> <input type="submit" name="submit" value= "Inregistrare"/> </td> </tr>
    
    </form>
    </table>
    </fieldset>
    '
;
}

if (isset ($_POST['submit'])
   {
    $username = protect($_POST['nume']);
    $password = protect($_POST['password']);
    $email = protect($_POST['email']);
    
    $Erori = array();
    
    if (!$username)
       $Erori = 'Numele nu a fost dat';

    if (!$password)
       $Erori = 'Parola nu a fost scrisa';

    if (!$email)
       $Erori = 'Email lipsa';

   }

?>