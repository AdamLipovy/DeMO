<?php
session_start();

  include("login/connection.php");
  include("login/functions.php");

  $user_data = check_login($con);
  die;
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="css/index.css" media="screen">
  <script src="index.js"></script>
  <title>Document</title>
  <script>
    function send(el, $number, $name, $subject, $class){
      var button = document.getElementById("selector");
      console.log($number);
      var form = document.querySelector("form.hiddenSender");
      form.innerHTML = "<input type='hidden' name='number' value='"+$number+"'><input type='hidden' name='name' value='"+$name+"'><input type='hidden' name='subject' value='"+$subject+"'><input type='hidden' name='class' value='"+$class+"'>";
      form.submit()
    }
    function view(el){
      var form = document.querySelector("form.hiddenSender");
      if(el.innerHTML == "zapnuto testování"){el.innerHTML = "zapnuto zobrazování"; form.action = "operators/reader/reader.php"}
      else{el.innerHTML = "zapnuto testování"; form.action = "operators/tester/tester.php"}
      
    }
  </script>
</head>

<body>
  <div id="fullImg"></div>
  <div id="all">
    <div id="header">
      <a href="operators/creator/creator.php"><button>click</button></a>
    </div>
    <button id="selector" onclick="view(this)">zapnuto testování</button>
  </div>
  <form class="hiddenSender" style="opacity:0" action="operators/tester/tester.php" method="post"></form>
  <table id="myTable">
    <thead>
      <td><input type="text" id="myInput" onkeyup="sort(this, 'number')" placeholder="Search for names.."></td>
      <td><input type="text" id="myInput" onkeyup="sort(this, 'name')" placeholder="Search for names.."></td>
      <td><input type="text" id="myInput" onkeyup="sort(this, 'subject')" placeholder="Search for names.."></td>
      <td><input type="text" id="myInput" onkeyup="sort(this, 'class')" placeholder="Search for names.."></td>
    </thead>
    <tbody>
      <tr class="header">
        <th style="width:20%;">číslo otázky</th>
        <th style="width:40%;">jméno</th>
        <th style="width:20%;">předmět</th>
        <th style="width:20%;">třída</th>
      </tr>
      <?php
        $storage = 'Storage';
        $classes = array_diff(scandir($storage), array('..', '.'));
        foreach($classes as $class){
          $subjects = $storage.'/'.$class;
          $subjects = array_diff(scandir($subjects), array('..', '.'));
          foreach($subjects as $subject){
            $names = $storage.'/'.$class.'/'.$subject;
            $names = array_diff(scandir($names), array('..', '.'));
            foreach($names as $name){

              $files = $storage.'/'.$class.'/'.$subject.'/'.$name;
              $files = array_diff(scandir($files), array('..', '.'));
              foreach ($files as $file){
              ?>
              <tr onclick="send(this,'<?=str_replace('.json','',$file)?>', '<?=$name?>', '<?=$subject?>', '<?=$class?>')">
                <td><?=str_replace('.json','',$file)?></td>
                <td><?=$name?></td>
                <td><?=$subject?></td>
                <td><?=$class?></td>
              </tr>
              <?php
              }
            }
          }
        }
      ?>
    </tbody>
  </table>
</body>

</html>