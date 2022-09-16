<?php
$Qnumber = $_GET['Qnumber'];
$i = 0;

$questions = array();
$Qsection = array();
foreach ($_GET as $key => $value) {
  if($key != 'Qnumber'){
    if(stripos($key,'textQ') !== false){
      echo ('textQ <br>');
        if($Qsection != array()){$questions[count($questions)] = $Qsection;$Qsection = array();}
      $Qsection['type'] = 'text';
      $Qsection['Qvalue'] = $value;
    }
    else if(strpos($key,'photo') !== false){
      echo ('photo <br>');
        if($Qsection != array()){$questions[count($questions)] = $Qsection;$Qsection = array();}
      $Qsection['type'] = 'photo';
      $Qsection['Qvalue'] = $value;
    }
    else if(strpos($key,'video') !== false){
      echo ('video <br>');
        if($Qsection != array()){$questions[count($questions)] = $Qsection;$Qsection = array();}
      $Qsection['type'] = 'video';
      $Qsection['Qvalue'] = $value;
    }
    else if(strpos($key,'section') !== false){
      echo ('section <br>');
        if($Qsection != array()){$questions[count($questions)] = $Qsection;$Qsection = array();}
      $Qsection['type'] = 'section';
      $Qsection['Qvalue'] = $value;
    }
    else if($key != 'Answer'){
      $Qsection[$key] = $value;
    }
  }
}

$questions[count($questions)] = $Qsection;;
unset($Qsection);
echo json_encode($questions)."\n";
file_put_contents('../Storage/OC/M/Martin/'.$Qnumber.'.json', json_encode($questions, JSON_PRETTY_PRINT));


if (!file_exists('../Storage/OC/M/Martin')) {
    mkdir('../Storage/OC/M/Martin', 0777, true);
    if (!file_exists('../Storage/OC/M/Martin/'.$Qnumber.'.json')) {
      
  }
}

?>
