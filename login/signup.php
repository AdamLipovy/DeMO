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
    <title>Signup</title>
    <link rel="stylesheet" href="login.css" media="screen">
  </head>
  <body>
 
<form action="" method="post" name="Login_Form">
  <table border="0" align="center" cellpadding="5" cellspacing="1" class="Table">
    <tr>
      <td colspan="2" align="left" valign="top"><h3>Vytváření účtu</h3></td>
      <td class="button"><a href="teacherSignup.php">Vytváření účtu pro učitele</td>
    </tr>
    <tr>
      <td align="right" valign="top" class="tooltip"><span class="tooltiptext">jméno které bude vyžadováno pro přihlášení</span>Uživateské jméno: </td>
      <td><input id="text" name="user_name" type="text" class="Input"></td>
    </tr>
    <tr>
      <td align="right" valign="top">Jméno uživatele: </td>
      <td><input id="text" name="name" type="text" class="Input"></td>
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
      <td></td>
      <td><input name="Submit" type="submit" value="Odeslat" class="Button3"></td>
      <td class="button"><a href="login.php">Přihlášení</td>
    </tr>
  </table>
</form>
  </body>
</html>