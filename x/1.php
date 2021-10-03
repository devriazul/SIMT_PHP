<html>
<head>
  <script type="text/javascript">

  $(document).ready(function(){

var counter = 2;

$("#addButton").click(function () {

if(counter>10){
        alert("Only 10 textboxes allow");
        return false;
}   

var newTextBoxDiv = $(document.createElement('div'))
     .attr("id", 'TextBoxDiv' + counter);

newTextBoxDiv.after().html('<label>Textbox #'+ counter + ' : </label>' +
      '<input type="text" name="textbox' + counter + 
      '" id="textbox' + counter + '" value="" >');

newTextBoxDiv.appendTo("#TextBoxesGroup");


counter++;
 });

    $("#removeButton").click(function () {
if(counter==1){
      alert("No more textbox to remove");
      return false;
   }   
  counter--;          $("#TextBoxDiv" + counter).remove(); });
       $("#getButtonValue").click(function ()
  {
   var msg = '';
  for(i=1; i<counter; i++){
  msg += "\n Textbox #" + i + " : " + $('#textbox' + i).val();
  }

  alert(msg);
    });
    });
     </script>
    </head><body>

 <div id='TextBoxesGroup'>
<div id="TextBoxDiv1">
<?php for(i==1; i<10; i++;){?>
      <label>Textbox #[i] : </label><input type='textbox' name='textbox[]' id='textbox.[i]'>
<?php i++ }?>
</div>
  </div>
  <input type='button' value='Add Button' id='addButton'>
  <input type='button' value='Remove Button' id='removeButton'>
  <input type='button' value='Get TextBox Value' id='getButtonValue'> 
  </body>
</html>