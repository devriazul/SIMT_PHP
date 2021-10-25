<?php ob_start();
session_start();
require_once('dbClass.php');
include("config.php"); 
if($myDb->connectDefaultServer())
{ 
  if($_SESSION['userid']){
		  $chka="SELECT*FROM  tbl_accdtl WHERE flname='manage_student.php' AND userid='$_SESSION[userid]'";
		  $caq=$myDb->select($chka);
		  $car=$myDb->get_row($caq,'MYSQL_ASSOC');
		  if($car['ins']=="y"){
		  $id=mysql_real_escape_string($_GET['id']);

		  
							 $ins_login=$myDb->select("SELECT*,(SELECT stdid FROM tbl_stdinfo WHERE id='$id') stdid,(
							                               SELECT password FROM tbl_stdinfo WHERE id='$id') password 
														      FROM tbl_login WHERE userid=(SELECT stdid FROM tbl_stdinfo WHERE id='$id')");
							 $inslog=$myDb->get_row($ins_login,'MYSQL_ASSOC');
							 
							 if($inslog['userid']==""){
							    $stv=$myDb->select("SELECT stdid,password FROM tbl_stdinfo WHERE id='$id'");
								$stvf=$myDb->get_row($stv,'MYSQL_ASSOC');
								$password=$stvf['password'];
							 
							    $ilog="INSERT INTO tbl_login(userid,password,accid,storedstatus)
								                      VALUES('$stvf[stdid]','".md5($password)."',38,'I')";
							    $uing=$myDb->insert_sql($ilog);
								
								 $chkstd=$myDb->select("select*from tbl_stdinfo where id='$id'");
								 $chkstdf=$myDb->get_row($chkstd,'MYSQL_ASSOC');
								 if($chkstdf['id']!=""){
									$accname=$chkstdf['stdid']." ".$chkstdf['stdname'];
									$tstd=trim($chkstdf['stdid']);
									if($myDb->update_sql("update tbl_accchart set stdid='$chkstdf[id]' WHERE accname like '$tstd%'")){
									}else{
									  echo $myDb->last_error;
									}  
								 }
								 header("Location:Copyofstdinfo.php?id=$id");						 					    

										
							 }else{
							    $stv=$myDb->select("SELECT stdid,password FROM tbl_stdinfo WHERE id='$id'");
								$stvf=$myDb->get_row($stv,'MYSQL_ASSOC');
								$password=$stvf['password'];
								
							    $iupd="UPDATE tbl_login SET password='".md5($password)."'
								                   WHERE userid='$inslog[userid]'";
							    $ulog=$myDb->update_sql($iupd);
								
								 $chkstd=$myDb->select("select*from tbl_stdinfo where id='$id'");
								 $chkstdf=$myDb->get_row($chkstd,'MYSQL_ASSOC');
								 if($chkstdf['id']!=""){
									$accname=$chkstdf['stdid']." ".$chkstdf['stdname'];
									$tstd=trim($chkstdf['stdid']);
									if($myDb->update_sql("update tbl_accchart set stdid='$chkstdf[id]' WHERE accname like '$tstd%'")){
									}else{
									  echo $myDb->last_error;
									}  
								 }
								 header("Location:Copyofstdinfo.php?id=$id");						 					    
							 }
		  
   }else{
     $msg="Sorry,you are not authorized to access this page";
	 header("Location:home.php?msg=$msg");
   }	 

}else{
  header("Location:index.php");
}
}
?>
