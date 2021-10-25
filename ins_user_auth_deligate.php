<?php ob_start();
session_start();
require_once('dbClass.php');
include("config.php"); 
if($myDb->connectDefaultServer())
{ 
  if($_SESSION['userid']){
  $chka="SELECT*FROM  tbl_accdtl WHERE flname='macclevel.php' AND userid='$_SESSION[userid]'";
  $caq=$myDb->select($chka);
  $car=$myDb->get_row($caq,'MYSQL_ASSOC');
  if(($car['ins']=="y")||($_SESSION['userid']=="administrator")){
    for($i=0;$i<count($_POST['id']);$i++){
	 
	 		 $accname=$_POST['accname'];
			 $userid=$_POST['userid'];
		/*echo "UPDATE tbl_accdtl_new SET 
									ins='".$_POST['ins'][$i]."',
									upd='".$_POST['upd'][$i]."',
									delt='".$_POST['delt'][$i]."'
		 						WHERE userid='$userid' 
								AND appid='".$_POST['id'][$i]."'
								AND catid='".$_POST['catid'][$i]."'
								AND scatid='".$_POST['scatid'][$i]."'
								";
								exit;	
								*/ 
	 	if(!empty($_POST['ins'][$i])&&!empty($_POST['upd'][$i])&&!empty($_POST['delt'][$i])&&isset($_POST['id_chk'])){
			 
				$accq=$myDb->select("SELECT*FROM tbl_accdtl_new d
										WHERE userid='$userid' 
										AND appid='".$_POST['id'][$i]."'
										AND catid='".$_POST['catid'][$i]."'
										AND scatid='".$_POST['scatid'][$i]."'
									");
				 $accqf=$myDb->get_row($accq,'MYSQL_ASSOC');
			 if(empty($accqf['id'])){
		 
				 $ins_str="INSERT INTO tbl_accdtl_new(userid,accid,catid,scatid,flname,ins,upd,delt,appid)
							VALUES('$userid','$accname','".$_POST['catid'][$i]."',
								   '".$_POST['scatid'][$i]."',
								   '".$_POST['flname'][$i]."',
								   '".$_POST['ins'][$i]."',
								   '".$_POST['upd'][$i]."',
								   '".$_POST['delt'][$i]."',
								   '".$_POST['id'][$i]."')";
					 if($myDb->insert_sql($ins_str)){ 
						//header("Location:user_access_deligates.php");
					   $ref=$_SERVER['HTTP_REFERER'];
						header("Location:$ref");	
					 }else{
						echo $myDb->last_error;
					 }
			}else{ 
			    $myDb->update_sql("UPDATE tbl_accdtl_new SET 
									ins='".$_POST['ins'][$i]."',
									upd='".$_POST['upd'][$i]."',
									delt='".$_POST['delt'][$i]."'
		 						WHERE userid='$userid' 
								AND appid='".$_POST['id'][$i]."'
								AND catid='".$_POST['catid'][$i]."'
								AND scatid='".$_POST['scatid'][$i]."'
								");
				   $ref=$_SERVER['HTTP_REFERER'];
		header("Location:$ref");	

			}	 	
	 }
    } 



   }else{
     $msg="Sorry,you are not authorized to access this page";
	 header("Location:index.php?msg=$msg");
   }	 

}else{
  header("Location:index.php");
}
}			  
