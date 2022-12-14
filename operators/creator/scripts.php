<script>
  var z = 0
  function addRow(){
    var change = document.getElementById('next')
    var next = change.cloneNode(true);
    var selectionQ = document.getElementById('nextQ');
    var selectionA = document.getElementById('nextA');
    var valueQ = selectionQ.options[selectionQ.selectedIndex].value;
    var valueA = selectionA.options[selectionA.selectedIndex].value;
    Qeditor(change, valueA, 'tr#thead', valueQ);
    change.className = 'question';
    change.id = z;
    document.getElementById('form').appendChild(next);
  }
  function Qeditor(change, valueA, Aposition, valueQ){
    switch(valueA){
      case "radio":
        change.innerHTML = '<?php
            $page = file_get_contents("menues/answers/radio.html");  
            $page = str_replace(["\n"],"",$page);
            echo $page;
          ?>';
        change.querySelector('tr#radio.repeatable input#answer.Input').required = true;
        change.querySelector('tr#radio.repeatable input#answer.Input').setAttribute("name",'Selection' + z);        
        change.querySelector('td#repeat input').click();
        break;
      case "text":
        change.innerHTML = '<?php
            $page = file_get_contents("menues/answers/text.html");  
            $page = str_replace(["\n"],"",$page);
            echo $page;
          ?>';
        change.querySelector("input#answer.Answer").name += y;
        y++;
        break;
      case "selection":
        change.innerHTML = '<?php
            $page = file_get_contents("menues/answers/selection.html");  
            $page = str_replace(["\n"],"",$page);
            echo $page;
          ?>';
        change.querySelector('td#repeat input').click();
        $labels = change.querySelectorAll('input#answer.label');
        $labels.forEach(function(item){item.setAttribute("name","selection label" + y); y++;});
        break;
    }
    change.querySelector('tr#explanation input#explanation.Answer').setAttribute("name",'Explanation' + z);
    var thead = change.querySelector(Aposition);
    change.querySelector("tr#typer input").name += z;
    var $elementPath = "";
    switch(valueQ){
      case "textQ":
        thead.innerHTML = '<?php
            $page = file_get_contents("menues/questions/text.html");  
            $page = str_replace(["\n"],"",$page);
            echo $page;
          ?>';
        $elementPath = "td input.Input"
        break;
      case "photo":
        thead.innerHTML = '<?php
            $page = file_get_contents("menues/questions/photo.html");  
            $page = str_replace(["\n"],"",$page);
            echo $page;
          ?>';
        $elementPath = "td input"
        break;
      case "video":
        thead.innerHTML = '<?php
            $page = file_get_contents("menues/questions/video.html");  
            $page = str_replace(["\n"],"",$page);
            echo $page;
            
          ?>';
        $elementPath = "td input#myURL"
        break;
      case "section":
        change.innerHTML = '<?php
            $page = file_get_contents("menues/questions/section.html");  
            $page = str_replace(["\n"],"",$page);
            echo $page;

          ?>';
        $elementPath = "td input.Input"
        break;
      }
    change.querySelector($elementPath).setAttribute("name",valueQ + z);
    z++;
  }
  
  var y = 0
  function repeat(x){
    var tbody = x.parentElement.parentElement.parentElement.parentElement.getElementsByTagName('tbody')[0];
    var elements = tbody.getElementsByClassName("repeatable");
    var len = elements.length
    if (elements[0].id=='selection'){
      for(var i = 0; i < len; i++) {
        const clone = elements[i].cloneNode(true);
        var answers = clone.querySelectorAll('input#answer.Answer');
        console.log(answers.length)
        for (var $i = 0; $i < answers.length; $i++){
          answers[$i].name += y;
          y++;
        }
        var hiddens = clone.querySelectorAll('input.hiddenInput');
        var inputs = clone.querySelectorAll('input#answer.Input');
        for (var $i = 0; $i < inputs.length; $i++){
          hiddens[$i].setAttribute("name",'Input' + y);
          inputs[$i].setAttribute("name",'Input' + y);
          y++;
        }
        clone.classList.remove("repeatable");
        tbody.appendChild(clone);
      }      
    }
    else{
        for(var i = 0; i < len; i++) {
        const clone = elements[i].cloneNode(true);
        const answer = clone.querySelectorAll('input#answer.Answer')[0];
        clone.classList.remove("repeatable");
        answer.name += y;
        y++;
        tbody.appendChild(clone);
      }
    }
  }
  
  function remove(el){
    var rmEl = el.parentElement.parentElement.parentElement.parentElement.parentElement.parentElement;
    rmEl.remove();
  }
  id = 0
  function edit(el){
    on()    
    const selections = document.getElementById("QEditor");
    table = el.parentElement.parentElement.parentElement.parentElement.parentElement.parentElement;
    console.log(table.id);
    selections.querySelector("#nextA").value = table.id.toString();
    for (let Atype of ["photo","text","section","video"]) {
      if (el.parentElement.parentElement.parentElement.parentElement.id == Atype){
        console.log(Atype);
        selections.querySelector("#nextQ").value = Atype;
        break;
      }
    }
    selections.querySelector("input#QChanger").onclick = function () { editQ(table, selections.querySelector("#nextA").value, selections.querySelector("#nextQ").value); }
  }
  function on() {
    document.getElementById("overlay").style.display = "block";
  }
  
  function off() {
    document.getElementById("overlay").style.display = "none";
  }
  function editQ(el, valueA, valueQ) {
    Qeditor(el.parentElement, valueA, 'tr#thead', valueQ);
    off()
  }
  function addColumn(element){
    j = 0 
    $rows = element.parentElement.parentElement.parentElement.querySelectorAll('tr#selection');
    console.log($rows);
    $rows.forEach(function(item){if(item==$rows[0]){item.innerHTML += '<td><input name="selection" type="hidden" value="0" class="hiddenInput"><input name="selection" value="1" type="checkbox" class="Input" id="answer">'; y++;}else{item.innerHTML += '<td><input name="Input' + y + '" type="hidden" value="0" class="hiddenInput"><input name="Input' + y + '" value="1" type="checkbox" class="Input" id="answer"></td>'; y++;}});
    $labels = element.parentElement.parentElement.querySelectorAll('input#answer.label');
    $labels.forEach(function(item){j++;});
    if (j<5){
      const clone = element.parentElement.cloneNode(true);
      element.parentElement.parentElement.appendChild(clone);
    }
    element.parentElement.innerHTML = '<input name="selection label'+y+'" type="text" class="label" id="answer">'    
    y++;
  }
</script>