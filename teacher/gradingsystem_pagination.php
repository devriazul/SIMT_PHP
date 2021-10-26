<?php ob_start();
session_start();
include("../config.php"); 
if($myDb->connectDefaultServer())
{ 
  if($_SESSION['userid']){
  /*$chka="SELECT*FROM  tbl_accdtl WHERE flname='managegradingsystem.php' AND userid='$_SESSION[userid]'";
  $caq=$myDb->select($chka);
  $car=$myDb->get_row($caq,'MYSQL_ASSOC');
  if($car['ins']=="y"){*/
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
	 $sdq="Select g.id, g.lowermarks as LoweMarks, g.uppermarks as UpperMarks, g.latergrade as LaterGrade, g.gradepoint as GP from tbl_gradesystem g Where storedstatus<>'D' order by id limit $start,$per_page";
	$sdep=$myDb->dump_query($sdq,'#','#');
  
   /*}else{
     $msg="Sorry,you are not authorized to access this page";
	 header("Location:home.php?msg=$msg");
   }	*/ 

}else{
  header("Location:index.php");
}
}  
?>
