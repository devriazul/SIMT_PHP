<?php if(!empty($_POST['dob'])){
   		 $year=date("Y-m-d");
         if(($_POST['dob']>='1960-01-01')&&($_POST['dob']<=$year)){
		   $yr=$_POST['dob'];
		   echo "<div style='width:200px; font-size:9px;'>".$yr." ok.</div>";
		 }else{
		   echo "<div style='width:200px; font-size:9px;'>Please enter valid year, 1960 and upto current year</div>";
		   exit;
		 }  
	  }
	  	 
		 