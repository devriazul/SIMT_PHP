<?php ob_start();
session_start();
require_once('dbClass.php');
include("config.php"); 
if($myDb->connectDefaultServer())
{ 
  if($_SESSION['userid']){
if(isset($_POST['listb'])){
   $_SESSION['listb']=$_POST['listb'];
   echo "The list value is post:".$_POST['listb']."<br/>";  

}
if(isset($_GET['listb'])){
	   $_SESSION['listb']=$_GET['listb'];
echo "The list value is get:".$_GET['listb']."<br/>";  
}   
if(isset($_GET['q'])){ $q = $_GET["q"]; }
if (!isset($q)) return;
         switch($_SESSION['listb']){
		   case 'department':
				  $sql="SELECT distinct d.name as 'Department Name'
				  		from tbl_bookentry b
						INNER JOIN tbl_courses c
						on b.courseid=c.id
						INNER JOIN tbl_department d
						on c.departmentid=d.id
						where d.name like '$q%'
						order by c.coursename
						
				  ";
					$rsd = mysql_query($sql);
					while($rs = mysql_fetch_array($rsd)) {
						$crsname = $rs['Department Name'];
						echo "$crsname\n";
					}
		         break;	
			case 'author':
				  $sql="SELECT b.author Author
						from tbl_bookentry b
						INNER JOIN tbl_courses c
						on b.courseid=c.id
						INNER JOIN tbl_department d
						on c.departmentid=d.id
						where b.author like '$q%'
						order by c.coursename
						
				  ";
					$rsd = mysql_query($sql);
					while($rs = mysql_fetch_array($rsd)) {
						$crsname = $rs['Author'];
						echo "$crsname\n";
					}
		         break;	
			case 'course':
				  $sql="SELECT c.coursename 'Course Name' 
						from tbl_bookentry b
						INNER JOIN tbl_courses c
						on b.courseid=c.id
						INNER JOIN tbl_department d
						on c.departmentid=d.id
						where c.coursename like '$q%'
						order by c.coursename
						
				  ";
						$rsd = mysql_query($sql);
						while($rs = mysql_fetch_array($rsd)) {
							$crsname = $rs['Course Name'];
							echo "$crsname\n";
						}
		         break;	
		    default:
				  $sql="SELECT c.coursename 'Course Name'
						from tbl_bookentry b
						INNER JOIN tbl_courses c
						on b.courseid=c.id
						INNER JOIN tbl_department d
						on c.departmentid=d.id
						order by c.coursename
						
				  ";
					$rsd = mysql_query($sql);
					while($rs = mysql_fetch_array($rsd)) {
						$crsname = $rs['Course Name'];
						echo "$crsname\n";
					}
		 }

}else{
  header("Location:login.php");
}
}  
?>

