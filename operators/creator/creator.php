<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="creator.css" media="screen">
  <title>Creator</title>
  <?php require("scripts.php");?>
</head>

<body>
  <form action="saver.php" method="post" id="form" name="form" enctype="multipart/form-data">
    <div>
      <label for="Qnumber">číslo odpovědi:</label>
      <input name="Qnumber" id="answer" type="number" min="1"max="50" value="1">
      <input type="submit">
    </div>
    <div id="next">
    </div>
  </form>
<?php
  require("QtypeSelector.html");
?>
<div id="overlay">
  <div id="QEditor"><?php
  require("questionEditor.html");
?></div>
</div>
</body>

</html>