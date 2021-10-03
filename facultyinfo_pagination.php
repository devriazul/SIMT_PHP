<?php ob_start();
session_start();
require_once('dbClass.php');
include("config.php"); 
if($myDb->connect($host,$user,$pwd,$db,true))
{ 
  if($_SESSION['userid']){
  $chka="SELECT*FROM  tbl_accdtl WHERE flname='managefacultyinfo.php' AND userid='$_SESSION[userid]'";
  $caq=$myDb->select($chka);
  $car=$myDb->get_row($caq,'MYSQL_ASSOC');
  if($car['ins']=="y"){
    $per_page = 20; 

    if($_GET)
    {
       $page=$_GET['page'];
    }



    //get table contents
    $start = ($page-1)*$per_page;
    //$sql = "select * from tbl_courses order by id limit $start,$per_page";
   // $rsd = mysql_query($sql);
  // str_replace (' ', '', $string)
	$sdq="SELECT f.id, f.facultyid, f.password, f.name, f.designationid, f.joiningdate, f.deptid, f.payscaleid FROM `tbl_faculty` f inner join tbl_designation d on f.designationid=d.id inner join tbl_department dp on f.deptid=dp.id inner join tbl_payscale p on f.payscaleid=p.id WHERE f.storedstatus<>'D' order by f.id limit $start,$per_page";
	$sdep=$myDb->dump_query($sdq,'edit_facultyinfo.php','del_facultyinfo.php',$car['upd'],$car['delt']);
  
   }else{
     $msg="Sorry,you are not authorized to access this page";
	 header("Location:home.php?msg=$msg");
   }	 

}else{
  header("Location:login.php");
}
}  
?>
