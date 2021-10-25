<?php ob_start();
session_start();
require_once('dbClass.php');
include("config.php"); 
if($myDb->connectDefaultServer())
{ 
  /*if($_SESSION['userid']){
  $chka="SELECT*FROM  tbl_accdtl WHERE flname='managemarksdistribution.php' AND userid='$_SESSION[userid]'";
  $caq=$myDb->select($chka);
  $car=$myDb->get_row($caq,'MYSQL_ASSOC');
  if($car['ins']=="y"){*/
    $per_page = 50; 

    if($_GET)
    {
       $page=$_GET['page'];
    }



    //get table contents
    $start = ($page-1)*$per_page;
    //$sql = "select * from tbl_courses order by id limit $start,$per_page";
   // $rsd = mysql_query($sql);
  // str_replace (' ', '', $string)
	 $sdq="Select m.id, d.name as Department, c.coursename as Subject, m.markstype as MarksType, m.totalmarks as TotalMarks from tbl_marksdistribution m inner join tbl_department d on m.departmentid=d.id inner join tbl_courses c on m.courseid=c.id Where m.storedstatus<>'D' order by id limit $start,$per_page";
	$sdep=$myDb->dump_query($sdq,'','');
  
  /* }else{
     $msg="Sorry,you are not authorized to access this page";
	 header("Location:home.php?msg=$msg");
   }*/	 

}else{
  header("Location:index.php");

}  
?>
