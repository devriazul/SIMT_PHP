<?php ob_start();
session_start();
include("config.php"); 
if($myDb->connectDefaultServer())
{ 
  if($_SESSION['userid']){
  $chka="SELECT*FROM  tbl_accdtl WHERE flname='manageexaminformation.php' AND userid='$_SESSION[userid]'";
  $caq=$myDb->select($chka);
  $car=$myDb->get_row($caq,'MYSQL_ASSOC');
  if($car['ins']=="y"){
    $per_page = 100; 

    if($_GET)
    {
       $page=$_GET['page'];
    }



    //get table contents
    $start = ($page-1)*$per_page;
    //$sql = "select * from tbl_courses order by id limit $start,$per_page";
   // $rsd = mysql_query($sql);
  // str_replace (' ', '', $string)
	 $sdq="Select e.id, e.examname as ExamName,e.exammarksper as 'Marks(%)', d.name as DepartmentName, CONCAT( c.coursename, ' (', c.coursecode, ')' ) as SubjectName, s.name as Semester, e.examtype as ExamType, e.session as Session, e.year as Year, e.lastdate as Deadline from tbl_examinitionsettings e inner join tbl_department d on e.deptid=d.id inner join tbl_courses c on e.courseid=c.id inner join tbl_semester s on e.semesterid=s.id  Where e.storedstatus<>'D' order by e.id desc limit $start,$per_page";
	$sdep=$myDb->dump_query($sdq,'edit_examinformation.php','del_examinformation.php',$car['upd'],$car['delt']);
  
   }else{
     $msg="Sorry,you are not authorized to access this page";
	 header("Location:home.php?msg=$msg");
   }	 

}else{
  header("Location:index.php");
}
}  
?>
