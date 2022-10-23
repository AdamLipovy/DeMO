 <?php
  $Qindex = 0;
  function create_question($Aindex, $question, $setValue){
    $tHeadIndex = $tBodyIndex = 0;
    $constructor = $Qtype = $Qvalue = '';
    if($setValue == 'test'){}
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
        case "explanation":
          $expl = "<tr><td colspan=\"5\"><input type=hidden value=\"$value\"></td></tr>";
          $tBodyIndex = strpos($constructor, '</tr></tbody>');
          $tBodyIndex += 5;
          $constructor = substr_replace($constructor, $expl, $tBodyIndex, 0);
          break;
        default:
          $constructor = file_get_contents("../support/menues/answers/$key.html");
          $tHeadIndex = strpos($constructor, '<thead><tr>');
          $tBodyIndex = strpos($constructor, '<tbody><tr>');
          $tBodyIndex += 11;
          switch ($key){
            case "selection":
              $label = "<td id=\"rows\"></td>";
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
                foreach($data['data'] as $triggered){
                  if($setValue == 'view'){
                    $checked = '';
                    if ($triggered == '1'){
                      $checked = 'checked';
                    }
                    $label .= "<td><input name=\"input$Aindex\" type=checkbox $checked disabled></td>";
                  }
                  else{
                    $checked = "0";
                    if ($triggered == '1'){
                      $checked = "1";
                    }
                    $label .= "<td><input name=\"input$Aindex\" id=$checked type=checkbox></td>";
                  }
                  $Aindex ++;
                }
                $label .= "</tr>";
                $constructor = substr_replace($constructor, $label, $tBodyIndex, 0);
                $tBodyIndex += strlen($label);
              }
              break;
            
            case "radio":
              foreach($value as $answer => $array){
                $data = $array;
                if($setValue == 'view'){
                  $checked = '';
                  if ($data['triggered'] == true){
                    $checked = ' checked';
                  }
                  $label .= "<tr><td><input name=\"input$Aindex\" type=radio value=$data[value] disabled$checked></td></tr>";
                  
                }
                else{
                  $checked = 'no';
                  if ($data['triggered'] == 1){
                    $checked = 'yes';
                  }
                  $label .= "<tr><td><input name=\"input$Aindex\" value=$data[value] type=radio id=\"$checked\" required>$data[value]</td></tr>";
                }
                $constructor = substr_replace($constructor, $label, $tBodyIndex, 0);
                $tBodyIndex += strlen($label);
                $label = '';
              }
              break;
            case "text":
              if($setValue == 'view'){
                $label = "<tr><td><input name=\"input$Aindex\" value=\"$value[value]\" type=text disabled></td></tr>";
              }
              else{
                $label = "<tr><td><input name=\"input$Aindex\" type=text id=\"$value[value]\"></td></tr>";
              }
              $constructor = substr_replace($constructor, $label, $tBodyIndex, 0);
              $tBodyIndex += strlen($label);
              break;
          }
      }
    }
    echo $constructor;
    return $Aindex;
  }
?>