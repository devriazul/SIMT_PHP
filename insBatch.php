<?php ob_start();
session_start();
require_once('dbClass.php');
include("config.php"); 

if($myDb->connect($host,$user,$pwd,$db,true))
{ 

if($_SESSION['userid']){
  $chka="SELECT*FROM  tbl_accdtl WHERE flname='manage_batch.php' AND userid='$_SESSION[userid]'";
  $caq=$myDb->select($chka);
  $car=$myDb->get_row($caq,'MYSQL_ASSOC');
  if(($car['ins']=="y")||($_SESSION['userid']=="administrator")){
    $batchname=mysql_real_escape_string($_POST['batchname']); 
	$session=mysql_real_escape_string($_POST['session']);
	$depcode=mysql_real_escape_string($_POST['depcode']);
	$opdate=date("Y-m-d");
	
    $bq="SELECT*FROM tbl_batch WHERE batchname='$batchname' AND depcode='$depcode'";
	$bqq=$myDb->select($bq);
	$bqr=$myDb->get_row($bqq,'MYSQL_ASSOC');
	
	if(($bqr['batchname']==$batchname)&&($bqr['depcode']==$depcode)){
	    $dep="SELECT*FROM  tbl_department WHERE code='$depcode'";
		$depq=$myDb->select($dep);
		$depr=$myDb->get_row($depq,'MYSQL_ASSOC');
		
	    $msg="This batch is already registered for this Department:".$depr['name'];
		echo $msg;
	}else{		

	    $query="INSERT INTO tbl_batch(`batchname`,`session`,`depcode`,`opby`,`opdate`,`storedstatus`) VALUES('$batchname','$session','$depcode','$_SESSION[userid]','$opdate','I')";
	    if($r=$myDb->insert_sql($query)){
	       $msg="Data inserted successfully"; echo $msg;
   		//header("Location:batchinfo.php?msg=$msg");
	    }else{
	       $msg=$myDb->last_error;
   		//header("Location:batchinfo.php?msg=$msg");
	    }
     }		       
   }else{
     $msg="Sorry,you are not authorized to access this page";
   }	 

}else{
  header("Location:index.php");
}
}