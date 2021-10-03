<?php 
  $dob=!empty($_GET['dob'])?$_GET['dob']:'';
  if(strlen($dob)==8){
    $yr=str_replace(substr($dob,-4,8),"-",$dob);
	$mn=substr(str_replace(substr($dob,-8,4),"-",$dob),1,2);
	 $dy=str_replace(substr($dob,-8,6),"-",$dob);
	 echo $yr.$mn.$dy;
	
	}
?>