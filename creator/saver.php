<?php
$Qnumber = $_POST['Qnumber'];
$i = 0;

$questions = array();
$Qsection = array();
foreach ($_POST as $key => $value) {
  if($key != 'Qnumber'){
    if(stripos($key,'textQ') !== false){
        if($Qsection != array()){$questions[count($questions)] = $Qsection;$Qsection = array();}
      $Qsection['type'] = 'text';
      $Qsection['Qvalue'] = $value;
    }
    else if(strpos($key,'photo') !== false){
        if($Qsection != array()){$questions[count($questions)] = $Qsection;$Qsection = array();}
      $Qsection['type'] = 'photo';
      $Qsection['Qvalue'] = $value;
    }
    else if(strpos($key,'video') !== false){
        if($Qsection != array()){$questions[count($questions)] = $Qsection;$Qsection = array();}
      $Qsection['type'] = 'video';
      $Qsection['Qvalue'] = $value;
    }
    else if(strpos($key,'section') !== false){
        if($Qsection != array()){$questions[count($questions)] = $Qsection;$Qsection = array();}
      $Qsection['type'] = 'section';
      $Qsection['Qvalue'] = $value;
    }
    else if($key != 'Answer'){
      $Qsection[$key] = $value;
    }
  }
}

$questions[count($questions)] = $Qsection;
unset($Qsection);

if (!file_exists('../Storage/OC/M/Martin')) {
  mkdir('../Storage/OC/M/Martin', 0777, true);

  
}
file_put_contents('../Storage/OC/M/Martin/'.$Qnumber.'.json', json_encode($questions, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
?>
