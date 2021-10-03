<?php ob_start();
session_start();
require_once('dbClass.php');
include("config.php"); 
if($myDb->connect($host,$user,$pwd,$db,true))
{ 
  if($_SESSION['userid']){
  $chka="SELECT*FROM  tbl_accdtl WHERE flname='managestaffinfo.php' AND userid='$_SESSION[userid]'";
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
	$sdq="Select s.id, s.name as StaffName, s.sid as StaffID, s.cellno as CellNo, s.etype as Type,  d.name as Designation, p.name as Payscale From tbl_staffinfo s inner join tbl_designation d on s.designationid=d.id inner join tbl_payscale p on s.payscaleid=p.id and s.storedstatus<>'D' order by s.id limit $start,$per_page";
	$sdep=$myDb->dump_query($sdq,'edit_staffinfo.php','del_staffinfo.php',$car['upd'],$car['delt']);
  
   }else{
     $msg="Sorry,you are not authorized to access this page";
	 header("Location:home.php?msg=$msg");
   }	 

}else{
  header("Location:login.php");
}
}  
?>
