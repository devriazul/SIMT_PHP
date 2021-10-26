<?php ob_start();
session_start();

include('../config.php');  
if($myDb->connectDefaultServer())
{ 
  if($_SESSION['userid']){
  $chka="SELECT*FROM  tbl_accdtl WHERE flname='add_time_interval.php' AND userid='$_SESSION[userid]'";
  $caq=$myDb->select($chka);
  $car=$myDb->get_row($caq,'MYSQL_ASSOC');
  if(($car['ins']=="y")||($_SESSION['userid']=="administrator")){
	$facultyid=mysql_real_escape_string(!empty($_POST['facultyid'])?$_POST['facultyid']:'');
    if(!empty($facultyid)){
	   $agname=explode('->',$facultyid);
	   $arr=array();
	   $arr=$agname;
	   
	   $spacepos=strpos($facultyid,">");
	   $spacename=substr($facultyid,($spacepos+1),strlen($facultyid));
	   
	   //$dot=strpos($spacename,".");
	   //$dotspacename=substr($spacename,
	   
	   
	   "<br/>";
	
	   $firstltr=array();
	   $firstltr=explode(" ",$spacename);
	   
	   $dotltr=explode(".",$spacename);
	   
	   
	   $firstw=array(); 
	   $frec="";	 
	   if(!empty($firstltr)):
		   foreach($firstltr as $w){
			 if(!empty($w[0])){
			   $frec=$frec.".".$w[0];
			 }  
		   } 
	   endif;
	   $drec="";	 

	   if(!empty($dotltr)):
		   foreach($dotltr as $w){
			 if(!empty($w[0])){
			   $drec=$drec.".".$w[0];
			 }  
		   } 			   
		   $drec=substr($drec,1,strlen($drec));

	   endif;
	   
	   
	   if(!empty($drec)):
		   $frec=substr($frec,2,strlen($frec));
		   echo strtoupper($drec.$frec);
	   else:
		   $frec=substr($frec,1,strlen($frec));
		   echo strtoupper($frec);
	   endif;   
	}else{
	  return 0;
	}   
 }else{
     $msg="Sorry,you are not authorized to access this page";
	 header("Location:home.php?msg=$msg");
 }	 

}else{
  header("Location:index.php");
}
}