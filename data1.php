<?php 
ob_start();
session_start();
include("config.php"); 
if($myDb->connectDefaultServer())
{ 
  if($_SESSION['userid']){
  $chka="SELECT*FROM  tbl_accdtl WHERE flname='semesterwisesubject.php' AND userid='$_SESSION[userid]'";
  $caq=$myDb->select($chka);
  $car=$myDb->get_row($caq,'MYSQL_ASSOC');
  if($car['ins']=="y"){
$per_page = 3;

if(isset($_GET['page']))
    $page = $_GET['page'];
$start = ($page-1)*$per_page;

?>


<?php
$sql=" SELECT tbl_semesterwisesubj.id, tbl_semesterwisesubj.year, tbl_semesterwisesubj.session, tbl_semester.name as SemesterName, tbl_department.name as DepartmentName, tbl_courses.coursename as CourseName FROM tbl_semesterwisesubj inner join tbl_semester on tbl_semesterwisesubj.semesterid=tbl_semester.id inner join tbl_department on tbl_semesterwisesubj.deptid=tbl_department.id inner join tbl_courses on tbl_semesterwisesubj.courseid=tbl_courses.id WHERE tbl_semesterwisesubj.storedstatus <>'D' limit $start,$per_page";
$result=$myDb->select($sql);
?>
<?php //if(mysql_num_rows($result1)>=1): ?>
<?php while($row1=$myDb->get_row($result,'MYSQL_ASSOC')): ?>
    <div class="indent1 unline" >
        <h3 class="c3title" style="text-transform: uppercase;"><a style="text-decoration: none;" href="#"><?php echo $row1['DepartmentName']; ?></a></h3><br/>
        <h4>Date:<?php echo $row1['SemesterName']; ?> </h4>
        <p><?php $dis=str_split($row1['CourseName'],100); echo $dis[0]; ?></p>
         
    </div>

<?php endwhile; ?>
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