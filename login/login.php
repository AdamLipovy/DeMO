<?php 

session_start();

  include("connection.php");
  include("functions.php");
  
  if($_SERVER['REQUEST_METHOD'] == "POST"){
    $user_name = $_POST['user_name'];
    $password = $_POST['password'];
    if(!empty($user_name) && !empty($password)){
      $query = "select * from users where user_name = '$user_name' limit 1";
      
      $result = mysqli_query($con, $query);
  
      if($result){
        if($result && mysqli_num_rows($result)>0){
          
          $user_data = mysqli_fetch_assoc($result);
          
          if(password_verify($password, $user_data['password'])){
            $_SESSION['user_name'] = $user_data['user_name'];
            header("Location: ../index.php");
            die;
          }
        }
      }
      echo "ERROR - zadány nesprávné hodnoty";
    }
    else{
      echo "ERROR - zadány nesprávné hodnoty";
    }
  }

?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="login.css" media="screen">
  </head>
  <body>
 
<form action="" method="post" name="Login_Form">
  <table border="0" align="center" cellpadding="5" cellspacing="1" class="Table">
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
      <td class="button"><a href="signup.php">Vytvoření účtu</td>
    </tr>      
  </table>
</form>
  </body>
</html>