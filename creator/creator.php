<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="creator.css" media="screen">
  <title>Creator</title>
  <?require("scripts.php");?>
</head>

<body>
  <form action="saver.php" method="get" id="form" name="form">
    <div id="next">
    </div>
  </form>
<?
  require("QtypeSelector.html");
?>
<div id="overlay">
  <div id="QEditor"><?
  require("questionEditor.html");
?></div>
</div>
</body>

</html>