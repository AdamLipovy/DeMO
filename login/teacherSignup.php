<?php 
session_start();
  include("connection.php");
  include("functions.php");  

if($_SERVER['REQUEST_METHOD'] == "POST"){
  if($_POST['password'] == $_POST['password2']){
    $user_name = $_POST['user_name'];
    $name = $_POST['name'];
    $password = password_hash($_POST['password'],PASSWORD_DEFAULT);
    if(!empty($user_name) && !empty($password)){
      $query = "insert into users (user_name, name, password) values('$user_name', '$name', '$password')";
      mysqli_query($con, $query);

      header("Location: login.php");
      die;
    }
    else{
      echo "ERROR - zadány nesprávné hodnoty";
    }
  }
  else{
    echo 'ERROR - špatné heslo';
  }
}
?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Teacher Signup</title>
    <link rel="stylesheet" href="login.css" media="screen">
  </head>
  <body>
 
    <form action="" method="post" name="Login_Form">
      <table width="400" border="0" align="center" cellpadding="5" cellspacing="1" class="Table">
        <tr>
          <td colspan="2" align="left" valign="top"><h3>Vytváření účtu</h3></td>
          <td colspan="2"><a href="signup.php">Vytváření účtu pro žáky</td>
        </tr>
        <tr>
          <td align="right" valign="top" class="tooltip"><span class="tooltiptext">jméno které bude vyžadováno pro přihlášení</span>Uživateské jméno: </td>
          <td colspan="2"><input id="text" name="user_name" type="text" class="Input"></td>
        </tr>
        <tr>
          <td align="right" valign="top">Jméno uživatele: </td>
          <td colspan="2"><input colspan="2" id="text" name="user_name" type="text" class="Input"></td>
        </tr>
        <tr>
          <td align="right">Heslo: </td>
          <td colspan="2"><input id="text" name="password" type="password" class="Input"></td>
        </tr>
        <tr>
          <td align="right">Potvrzení hesla: </td>
          <td colspan="2"><input id="text" name="password2" type="password" class="Input"></td>
        </tr>
        <tr>
          <td class="tooltip"><span class="tooltiptext">zkratky předmětů rozdělte mezerou</span>Vyučované předměty: </td>
          <td><input id="text" name="Subjects" type="password" class="Input"></td>
        </tr>
        <tr>
          <td>Vyučované třídy: </td>
        </tr>
        <tr>
          <td><input type="checkbox" id="OA" name="OA">
<label for="OA">OA</label></td>
          <td><input type="checkbox" id="OB" name="OB">
<label for="OB">OB</label></td>
          <td><input type="checkbox" id="OC" name="OC">
<label for="OC">OC</label></td>
          <td><input type="checkbox" id="4D" name="4D">
<label for="4D">4D</label></td>
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