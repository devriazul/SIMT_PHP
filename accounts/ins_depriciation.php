<?php ob_start();
session_start();
include("../config.php"); 
if($myDb->connectDefaultServer())
{ 
  if($_SESSION['userid']){
  $chka="SELECT*FROM  tbl_accdtl WHERE flname='manage_voucher.php' AND userid='$_SESSION[userid]'";
  $caq=$myDb->select($chka);
  $car=$myDb->get_row($caq,'MYSQL_ASSOC');
  if($car['ins']=="y"){
  $mtype=mysql_real_escape_string($_POST['mtype']);
  if($mtype=="Straight Line"){
	  $accno=mysql_real_escape_string($_POST['accno']);
	  $drate=mysql_real_escape_string($_POST['drate']);
	  $aid=mysql_real_escape_string($_POST['aid']);
	  $pyear=mysql_real_escape_string($_POST['pyear']);
	  $mtype=mysql_real_escape_string($_POST['mtype']);

		$fds="SELECT ifnull(year(ddate),0) depyear from fixed_dep where year(ddate)=(select year(curdate()) ) and accno='$accno' and aid='$aid' and methodtype='$mtype'";
		$fdq=$myDb->select($fds);
		$fdqf=$myDb->get_row($fdq,'MYSQL_ASSOC');
		
		$cds="SELECT year(curdate()) currentyear,curdate() currentdate";
		$cdq=$myDb->select($cds);
		$cdqf=$myDb->get_row($cdq,'MYSQL_ASSOC');
		
		if($fdqf['depyear']==$cdqf['currentyear']){
			if($myDb->update_sql("update fixed_dep set pyear='$pyear',drate='$drate',methodtype='$mtype' where accno='$accno' and aid='$aid' and methodtype='$mtype'")){
				echo "You can not change depriciation rate in current year,allready it has been changed";
			}else{
			   echo $myDb->last_error;
			}   
		}else{   
			$fd="INSERT INTO fixed_dep(aid,pyear,accno,drate,ddate,methodtype)VALUES('$aid','$pyear','$accno','$drate','$cdqf[currentdate]','$mtype')";
			if($myDb->insert_sql($fd)){
			   echo "Insert record successful";
			}else{
			
			   echo $myDb->last_error;
			}   
		}
}else{	

	  $accno=mysql_real_escape_string($_POST['accno']);
	  $drate=mysql_real_escape_string($_POST['drate']);
	  $aid=mysql_real_escape_string($_POST['aid']);
	  $mtype=mysql_real_escape_string($_POST['mtype']);

		$fds="SELECT ifnull(year(ddate),0) depyear from fixed_dep where year(ddate)=(select year(curdate()) ) and accno='$accno' and aid='$aid' and methodtype='$mtype'";
		$fdq=$myDb->select($fds);
		$fdqf=$myDb->get_row($fdq,'MYSQL_ASSOC');
		
		$cds="SELECT year(curdate()) currentyear,curdate() currentdate";
		$cdq=$myDb->select($cds);
		$cdqf=$myDb->get_row($cdq,'MYSQL_ASSOC');
		
		if($fdqf['depyear']==$cdqf['currentyear']){
			if($myDb->update_sql("update fixed_dep set drate='$drate',methodtype='$mtype' where accno='$accno' and aid='$aid' and methodtype='$mtype'")){
				echo "You can not change depriciation rate in current year,allready it has been changed";
			}else{
			   echo $myDb->last_error;
			}   
		}else{   
			$fd="INSERT INTO fixed_dep(aid,accno,drate,ddate,methodtype)VALUES('$aid','$accno','$drate','$cdqf[currentdate]','$mtype')";
			if($myDb->insert_sql($fd)){
			   echo "Insert record successful";
			}else{
			
			   echo $myDb->last_error;
			}   
		}
}		

   }else{
     $msg="Sorry,you are not authorized to access this page";
	 header("Location:home.php?msg=$msg");
   }	 

}else{
  header("Location:login.php");
}
}  
?>
