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
  <script>
    function check() {
      var mistakes = questions = 0
      hiddens = document.querySelectorAll("input[type=\"hidden\"]");
      for (let i = 0; i < hiddens.length; i++) {
        hiddens[i].type = "text";
        hiddens[i].readOnly = true;
        hiddens[i].className = "explanation";
      }
      elements = document.querySelectorAll("[name^=input]");
      for (let i = 0; i < elements.length; i++) {
        if(elements[i].type == 'radio'){
          if((elements[i].checked && elements[i].id == "yes")){
            
            elements[i].parentElement.style.backgroundColor = "rgba(69, 255, 18, 0.55)";
            questions++;
          }
          else if (!elements[i].checked && elements[i].id == "yes") {
            elements[i].parentElement.style.backgroundColor = "rgba(255, 18, 18, 0.55)";
            questions++;
            mistakes++;
          }
          else if (elements[i].checked && elements[i].id == "no") {
            elements[i].parentElement.style.backgroundColor = "rgba(255, 18, 18, 0.55)";
          }
        }
        if(elements[i].type == 'text'){
          if(elements[i].value == elements[i].id){
            elements[i].parentElement.style.backgroundColor = "rgba(69, 255, 18, 0.55)";
            questions++;
          }
          else{
            console.log(elements[i].value + " - " + elements[i].id + " - FALSE");
            elements[i].parentElement.style.backgroundColor = "rgba(255, 18, 18, 0.55)";
            questions++;
            mistakes++;
          }
        }
        if(elements[i].type == 'checkbox'){
          if((elements[i].checked && elements[i].id == "1")||(!elements[i].checked && elements[i].id == "0")){
            elements[i].parentElement.style.backgroundColor = "rgba(69, 255, 18, 0.55)";
            questions++;
          }
          else{
            elements[i].parentElement.style.backgroundColor = "rgba(255, 18, 18, 0.55)";
            questions++;
            mistakes++;
          }
        }
      }
      alert("otázek = " + questions + "\nšpatně zodpovězeno = " + mistakes + "\núspěšnost  = " + (questions-mistakes)*100/questions + "%");
    }
  </script>
  <title>Tester</title>
  <?php
  require("../support/choser.php");
  ?>
</head>

<body>
    <div>
      <label for="Qnumber">číslo odpovědi:</label>
      <input name="Qnumber" id="Qnumber" type="number" min="1"max="50" value="<?=$_POST['number']?>" disabled>
    </div>
<?php
$Aindex = 0;
foreach ($json as $question){  
  $Aindex = create_question($Aindex, $question, 'test') + 1;
}
$_POST = array();
?>
<button onclick="check()">submit</button>
</body>

</html>