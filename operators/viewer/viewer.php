<?php
  $json = json_decode( file_get_contents('../../Storage/OC/ŠJ/Adam_Lipový/1.json'), TRUE);
  
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="../support/style.css" media="screen">
  <title>Viewer</title>
   <?php 
  require("../support/choser.php");
  ?>
</head>

<body>
  <form action="saver.php" method="post" id="form" name="form" enctype="multipart/form-data">
    <div>
      <label for="Qnumber">číslo odpovědi:</label>
      <input name="Qnumber" id="Qnumber" type="number" min="1"max="50" value="<?=$_POST['number']?>" disabled>
    </div>
    <div>
<?php
$Aindex = 0;
foreach ($json as $question){

  create_question($question, 'view');
  $Aindex++;
}
?>
    </div>
  </form>
<?php
  // require("QtypeSelector.html");
?>
<div id="overlay">
  <div id="QEditor"><?php
  // require("questionEditor.html");
?></div>
</div>
</body>

</html>