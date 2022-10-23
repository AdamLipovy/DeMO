<?php
session_start();

  include("../../login/connection.php");
  include("../../login/functions.php");

  $user_data = check_login($con);

$Qnumber = $_POST['Qnumber'];
$Qsubject = $_POST['subject'];
$i = 0;

$questions = [];
$question = array();
$nextQuestion = '';
$nextSelection = False;
$InnerQ = array();
$rowValue = '';
foreach ($_POST as $key => $value) {
  echo $key.'-'.$value.'<br>';
  switch (true){
    case (strpos($key, 'Explanation') !== false):
      $question['explanation'] = $value;
      break;
    case (strpos($key, 'textQ') !== false):
      $question['type'] = 'text';
      $question['Qvalue'] = $value;
      break;
    case (strpos($key, 'photo') !== false):
      $question['type'] = 'photo';
      $question['Qvalue'] = $value;
      break;
    case (strpos($key, 'video') !== false):
      $question['type'] = 'video';
      $question['Qvalue'] = str_replace("watch?v=", "embed/", $value);
      break;
    case (strpos($key, 'section') !== false):
      if ($question != array()){

        $questions[count($questions)] = $question;
        
        unset($question);
        
        $question = array();
      }
      $question['type'] = 'section';
      $question['Qvalue'] = $value;
      break;
    case (strpos($key, 'selection_label') !== false):
          $question[$nextQuestion]['header'][count($question[$nextQuestion]['header'])] = $value;
          break;
    case (strpos($key, 'radio') !== false):
      if ($question != array()){
        
        $questions[count($questions)] = $question;
        
        unset($question);
        
        $question = array();
      }
      $nextQuestion = 'radio';
      $question[$nextQuestion] = [];
      break;
    case (strpos($key, 'TextA') !== false):
      if ($question != array()){

        $questions[count($questions)] = $question;
        
        unset($question);
        
        $question = array();
      }
      $nextQuestion = 'text';
      $question['text'] = array();
      break;
    case (strpos($key, 'selection') !== false and $key != 'selection'):
      if ($question != array()){
        
        $questions[count($questions)] = $question;
        
        unset($question);        
        $question = array();
      }
      $nextQuestion = 'selection';
      $question[$nextQuestion] = [];
      $question[$nextQuestion]['header'] = [];
      $question[$nextQuestion]['rows'] = [];
      break;
    
    case $key != 'Answer' and $key != 'selection':
      switch (true){
        case (strpos($key, 'Selection') !== false):
          $nextSelection = True;
          break;
        case (strpos($key, 'Answer') !== false):
          echo $nextQuestion."<br>";
          if ($nextQuestion == 'radio'){
            $question[$nextQuestion][count($question[$nextQuestion])] = ['value' => $value, 'triggered' => $nextSelection];
            $nextSelection = False;
            }
          if ($nextQuestion == 'selection'){
            $question[$nextQuestion]['rows'][$key] = ['value' => $value, 'data' => []];
            $rowValue = $key;
            }
        
          if ($nextQuestion == 'text'){
            $question[$nextQuestion][$key] = ['value' => $value, 'data' => []];
            $rowValue = $key;
            }
          
          break;    
        case (strpos($key, 'Input') !== false): 
          array_push($question[$nextQuestion]['rows'][$rowValue]['data'], $value);
          break;
      }
      break;
    }
}
$questions[count($questions)] = $question;

unset($question);

$user_data['name'] = 'Adam Lipový';
$user_data['class'] = 'OC';

$name = str_replace(" ","_",$user_data['name']);

$path = $_SERVER['DOCUMENT_ROOT']."/Storage/".$user_data['class']."/".$Qsubject."/".$name;


if (!file_exists($path)) {
  mkdir($path, 0777, true);
}
file_put_contents($path."/".$Qnumber.'.json', json_encode($questions, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));

header("location:../../index.php");
?>