<?php 
session_start();
  include("connection.php");
  include("functions.php");  
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
          <td colspan="2" align="left" valign="top"><h3>Vytváření účtu</h3></td>
          <td><a href="teacherSignup.php">Vytváření účtu pro učitele</td>
        </tr>
        <tr>
          <td align="right" valign="top">Uživateské jméno: </td>
          <td><input id="text" name="user_name" type="text" class="Input"></td>
        </tr>
        <tr>
          <td align="right" valign="top">Jméno uživatele: </td>
          <td><input id="text" name="user_name" type="text" class="Input"></td>
        </tr>
        <tr>
          <td align="right">Heslo: </td>
          <td><input id="text" name="password" type="password" class="Input"></td>
        </tr>
        <tr>
          <td align="right">Potvrzení hesla: </td>
          <td><input id="text" name="password2" type="password" class="Input"></td>
        </tr>
        <tr>
          <td>Vyučované předměty: </td>
          <td><input id="text" name="Subjects" type="password" class="Input"></td>
        </tr>
        <tr>
          <td>Vyučované třídy: </td>
          <td><input id="text" name="Classes" type="password" class="Input"></td>
        </tr>
        <tr>
          <td></td>
          <td><input name="Submit" type="submit" value="Odeslat" class="Button3"></td>
          <td><a href="login.php">Přihlášení</td>
        </tr>
      </table>
    </form>
  </body>
</html>