<?php
  $Qindex = $Aindex = 0;
  function create_question($question, $setValue){
    $tHeadIndex = $tBodyIndex = 0;
    $constructor = $Qtype = $Qvalue = '';
    foreach($question as $key => $value){
      switch ($key){
        case "type":
          $Qvalue = $question['Qvalue'];
          
          $Qtype = file_get_contents("../support/menues/questions/$value.html");
          $Qtype = str_replace("[$value]","$Qvalue",$Qtype);
          $constructor = substr_replace($constructor, $Qtype, $tHeadIndex, 0);
          break;
        case "Qvalue":
          break;
        
        default:
          $constructor = file_get_contents("../support/menues/answers/$key.html");
          $tHeadIndex = strpos($constructor, '<thead><tr>');
          $tBodyIndex = strpos($constructor, '<tbody><tr>');
        
          switch ($key){
            case "selection":
              $tBodyIndex += 11;
              $label = "<td></td>";
              $constructor = substr_replace($constructor, $label, $tBodyIndex, 0);
              $tBodyIndex += strlen($label);
              foreach($value["header"] as $header){
                $label = "<td><h4>$header<h4></td>";
                $constructor = substr_replace($constructor, $label, $tBodyIndex, 0);
                $tBodyIndex += strlen($label);
              }
              $tBodyIndex += 5;
              foreach($value["rows"] as $answer => $data){
                $label = "<tr><td>$data[value]</td>";
                foreach($data["data"] as $triggered){
                  $label .= "<td><input name=\"input$Aindex\" type=checkbox></td>";
                  $Aindex ++;
                }
                $label .= "</tr>";
                $constructor = substr_replace($constructor, $label, $tBodyIndex, 0);
                $tBodyIndex += strlen($label);
              }
              break;
            
            case "radio":
              $tBodyIndex += 11;
              foreach($value[0] as $answer => $data){
                $label = "<tr><td><input name=\"input$Aindex\" type=radio>$data[value]</td>";
                $constructor = substr_replace($constructor, $label, $tBodyIndex, 0);
                $tBodyIndex += strlen($label);
              }
              break;
          }
      }
    }
    echo $constructor;
  }
?>