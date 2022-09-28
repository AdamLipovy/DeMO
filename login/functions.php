<?php
function check_login($con)
{
  
  if(isset($_SESSION['user_name']))
  {
    
    $userName = $_SESSION['user_name'];
    $query = "select * from users where user_name = '$userName' limit 1";

    $result = mysqli_query($con, $query);
    if($result && mysqli_num_rows($result) > 0)
    {
      
      $user_data = mysqli_fetch_assoc($result);
      return $user_data;
    }
  }
  else{
    header("Location: /login/login.php");
    die;
  }
}
?>