<?php if(!empty($_POST['yr'])){
   		 $year=date("Y");
         if(($_POST['yr']>=1960)&&($_POST['yr']<=$year)){
		   $yr=$_POST['yr'];
		   echo "<div style='width:200px; font-size:9px;'>".$yr." ok.</div>";
		 }else{
		   echo "<div style='width:200px; font-size:9px;'>Please enter valid year, 1960 and upto current year</div>";
		   exit;
		 }  
	  }
	  	 
		 