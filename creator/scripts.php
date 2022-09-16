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
        change.innerHTML = '<?
            $page = file_get_contents("menues/answers/radio.html");  
            $page = str_replace(["\n"],"",$page);
            echo $page;
          ?>';
        change.querySelector('td#repeat input').click();
        break;
      case "text":
        change.innerHTML = '<?
            $page = file_get_contents("menues/answers/text.html");  
            $page = str_replace(["\n"],"",$page);
            echo $page;
          ?>';
        change.querySelector("input#answer.Answer").setAttribute("name",'Answer' + y);
        y++;
        break;
      case "yesno":
        change.innerHTML = '<?
            $page = file_get_contents("menues/answers/yesno.html");  
            $page = str_replace(["\n"],"",$page);
            echo $page;
          ?>';
        change.querySelector('td#repeat input').click();
        break;
    }
    var thead = change.querySelector(Aposition);
    var $elementPath = "";
    switch(valueQ){
      case "textQ":
        thead.innerHTML = '<?
            $page = file_get_contents("menues/questions/text.html");  
            $page = str_replace(["\n"],"",$page);
            echo $page;
          ?>';
        $elementPath = "td input.Input"
        break;
      case "photo":
        thead.innerHTML = '<?
            $page = file_get_contents("menues/questions/photo.html");  
            $page = str_replace(["\n"],"",$page);
            echo $page;
          ?>';
        $elementPath = "td input"
        break;
      case "video":
        thead.innerHTML = '<?
            $page = file_get_contents("menues/questions/video.html");  
            $page = str_replace(["\n"],"",$page);
            echo $page;
            
          ?>';
        $elementPath = "td input#myURL"
        break;
      case "section":
        change.innerHTML = '<?
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
    
    for(var i = 0; i < len; i++) {
      const clone = elements[i].cloneNode(true);
      const answer = clone.querySelectorAll('input#answer.Answer')[0];
      clone.classList.remove("repeatable");
      answer.setAttribute("name",'Answer' + y);
      y++;
      tbody.appendChild(clone);
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
</script>