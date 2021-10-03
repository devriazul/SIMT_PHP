<?php
  switch($_GET['equip']){
    case "1":
	  if(@ereg("([[:space:]]){1}",$_GET['prtype'])){
		echo "<div style='width:400px; height:20px; padding:5px;background-color:#FFF000; color:#333333; border-bottom:1px solid #333333'> Double space found in product type field</div>";
	  
	  }
	  break;
	case "2":   
	  if(@ereg("([[:space:]]){1}",$_GET['prtype'])){
		echo "<div style='width:400px; height:20px; padding:5px;background-color:#FFF000; color:#333333; border-bottom:1px solid #333333'> Double space found in equipment type field</div>";
	  
	  }
	  break;
	case "3":   
	  if(@ereg("([[:space:]]){1}",$_GET['prtype'])){
		echo "<div style='width:400px; height:20px; padding:5px;background-color:#FFF000; color:#333333; border-bottom:1px solid #333333'> Double space found in product name field</div>";
	  
	  }
	  break;
	  
	  
	  
  }
?>