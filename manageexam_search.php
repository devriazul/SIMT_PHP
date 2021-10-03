<?php 
ob_start();
session_start();
require_once('dbClass.php');
include("config.php"); 
if($myDb->connect($host,$user,$pwd,$db,true))
{ 
  if($_SESSION['userid']){
  $chka="SELECT*FROM  tbl_accdtl WHERE flname='manageexam.php' AND userid='$_SESSION[userid]'";
  $caq=$myDb->select($chka);
  $car=$myDb->get_row($caq,'MYSQL_ASSOC');
  if(($car['ins']=="y")||($_SESSION['userid']=="administrator")){
/*$per_page = 20;

if(isset($_GET['page']))
    $page = $_GET['page'];
$start = ($page-1)*$per_page;
*/
//echo $_GET['courseid']; exit;
?>
<div class="indent1 unline" >
<?php 		  
		    $sdq=" Select e.id, e.examname as ExamName, e.exammarksper as 'Marks(%)', e.examtype as ExamType, e.session as Session, e.year as Year from tbl_examinitionsettings e inner join tbl_department d on e.deptid=d.id inner join tbl_courses c on e.courseid=c.id inner join tbl_semester s on e.semesterid=s.id Where e.storedstatus <>'D'	and e.year='$_POST[year]' and e.session='$_POST[session]' and e.semesterid='$_POST[semester]' and e.deptid='$_POST[department]' and e.courseid='$_GET[courseid]' order by e.id desc";
			$sdep=$myDb->dump_query($sdq,'edit_examinformation.php','del_examinformation.php',$car['upd'],$car['delt']);
		  ?>	
</div>		  	          
<?php 
   }else{
     $msg="Sorry,you are not authorized to access this page";
	 header("Location:home.php?msg=$msg");
   }	 

}else{
  header("Location:index.php");
}
}