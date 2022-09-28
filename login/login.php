<?php 
session_start();
  include("connection.php");
  include("functions.php");
        
  $user_data = check_login($con);
?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="style.css" media="screen">
  </head>
  <body>
 
<form action="" method="post" name="Login_Form">
  <table width="400" border="0" align="center" cellpadding="5" cellspacing="1" class="Table">
    <tr>
      <td colspan="2" align="left" valign="top"><h3>Přihlášení</h3></td>
    </tr>
    <tr>
      <td align="right" valign="top">Uživatelské jméno: </td>
      <td><input id="text" name="user_name" type="text" class="Input"></td>
    </tr>
    <tr>
      <td align="right">Heslo: </td>
      <td><input id="text" name="password" type="password" class="Input"></td>
    </tr>
    <tr>
      <td> </td>
      <td><input name="Submit" type="submit" value="Přihlásit" class="Button3"></td>
      <td><a href="signup.php">Vytvoření účtu</td>
    </tr>      
  </table>
</form>
  </body>
</html>