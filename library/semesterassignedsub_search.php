<?php 
ob_start();
session_start();
require_once('dbClass.php');
include("config.php"); 
if($myDb->connect($host,$user,$pwd,$db,true))
{ 
  if($_SESSION['userid']){
  $chka="SELECT*FROM  tbl_accdtl WHERE flname='semesterwisesubject_search.php' AND userid='$_SESSION[userid]'";
  $caq=$myDb->select($chka);
  $car=$myDb->get_row($caq,'MYSQL_ASSOC');
  if($car['ins']=="y"){
/*$per_page = 20;

if(isset($_GET['page']))
    $page = $_GET['page'];
$start = ($page-1)*$per_page;
*/

?>
<style type="text/css">
@import url("main.css");
</style>

<div class="indent1 unline" >
<table width="800" border="0" cellpadding="0" cellspacing="0" class="gridTbl" >
<tr>
<td height="35" bgcolor="#0C6ED1" class="gridTblHead"><span class="style1">ID</span></td>
<td height="35" bgcolor="#0C6ED1" class="gridTblHead"><span class="style1">Course Name</span></td>
<td height="35" bgcolor="#0C6ED1" class="gridTblHead"><span class="style1">Department Name</span></td>
<td height="35" bgcolor="#0C6ED1" class="gridTblHead"><span class="style1">Year</span></td>
<td height="35" bgcolor="#0C6ED1" class="gridTblHead"><span class="style1">Session</span></td>
<td height="35" bgcolor="#0C6ED1" class="gridTblHead"><span class="style1">Semester Name</span></td>
<td height="35" bgcolor="#0C6ED1" class="gridTblHead"><span class="style1">Total Book</span></td>
</tr>


<?php 	 											  

		  $sdq=$myDb->select("SELECT tbl_semesterwisesubj.id id, tbl_semesterwisesubj.year, tbl_semesterwisesubj.session, tbl_semester.name as SemesterName, 
		                tbl_department.name as DepartmentName,tbl_courses.id courseid,tbl_courses.coursename as CourseName					 
						FROM tbl_semesterwisesubj 
						inner join tbl_semester on tbl_semesterwisesubj.semesterid=tbl_semester.id 
						inner join tbl_department on tbl_semesterwisesubj.deptid=tbl_department.id 
						inner join tbl_courses on tbl_semesterwisesubj.courseid=tbl_courses.id 
						WHERE tbl_semesterwisesubj.storedstatus <>'D'
						and tbl_semesterwisesubj.semesterid='$_POST[semester]'
						and tbl_semesterwisesubj.deptid='$_POST[department]' 
						
						");
           
		   while($sdqf=$myDb->get_row($sdq,'MYSQL_ASSOC')){
				$lib="SELECT sum(totalbook) 'Total Book'
	                  FROM tbl_bookentry
					   WHERE deptid='$_POST[department]'
						and courseid='$sdqf[courseid]'
						
					 ";
		  $libq=$myDb->select($lib);
		  while($libf=$myDb->get_row($libq,'MYSQL_ASSOC')){		   
		   
?>
<tr>
<td height="30" class="gridTblValue"><span class="style4"><?php echo $sdqf['id']; ?></span></td>
<td height="30" class="gridTblValue"><span class="style4"><?php echo $sdqf['CourseName']; ?></span></td>
<td height="30" class="gridTblValue"><span class="style4"><?php echo $sdqf['DepartmentName']; ?></span></td>
<td height="30" class="gridTblValue"><span class="style4"><?php echo $sdqf['year']; ?></span></td>
<td height="30" class="gridTblValue"><span class="style4"><?php echo $sdqf['session']; ?></span></td>
<td height="30" class="gridTblValue"><span class="style4"><?php echo $sdqf['SemesterName']; ?></span></td>
<td height="30" align="center" class="gridTblValue"><span class="style4"><?php echo $libf['Total Book']; ?></span></td>
</tr>
<?php 
		  }} 		
		  ?>	
</table>		  
</div>		  	          
<?php 
   }else{
     $msg="Sorry,you are not authorized to access this page";
	 header("Location:home.php?msg=$msg");
   }	 

}else{
  header("Location:login.php");
}
}  
?>