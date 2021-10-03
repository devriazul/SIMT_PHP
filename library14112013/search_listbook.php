<?php ob_start();
session_start();
require_once('dbClass.php');
include("config.php"); 
if($myDb->connect($host,$user,$pwd,$db,true))
{ 
  if($_SESSION['userid']){
  $chka="SELECT*FROM  tbl_accdtl WHERE flname='book_entry.php' AND userid='$_SESSION[userid]'";
  $caq=$myDb->select($chka);
  $car=$myDb->get_row($caq,'MYSQL_ASSOC');
  if($car['ins']=="y"){
    
?>
<script language="javascript">
$(document).ready(function(){  
  $('a[name=isbook]').click(function(e){
	  e.preventDefault();
	  var id=$(this).attr('id');
	  var deptid=$(this).attr('alt');
	  $('#return'+id).css({'display':'none'});
	  var isid=$('#issue'+id).attr('id');
	  $('#issue'+id).toggle('slow');
	 $('#issue'+id).load('book_issue.php?rowid='+id+'&deptid='+deptid);
	  
	 
    });	  
	
	 $('a[name=isreturn]').click(function(e){
	  e.preventDefault();
	 
	  var id=$(this).attr('id'); 
	  var deptid=$(this).attr('alt');
	  $('#issue'+id).css({'display':'none'});
	  var isid=$('#return'+id).attr('id');
	  $('#return'+id).toggle('slow');
	  $('#return'+id).load('book_return.php?rowid='+id+'&deptid='+deptid);
	  
	 
    });	  

});
</script>


<div style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:10px; padding-left:10px; width:300px; float:right; ">[Esc->List View || Shift+F1->Book Entery Form]</div><br/>

<?php 
         switch($_POST['listb']){
		   case 'department':
				  $sdq="SELECT b.bookid as id,d.name as 'Department Name',b.deptid,c.coursename 'Course Name',b.author Author,b.edition Edition,b.totalbook 'Total Book',b.selfid 'Book Self No',b.rowno 'Row No' 
						from tbl_bookentry b
						INNER JOIN tbl_courses c
						on b.courseid=c.id
						INNER JOIN tbl_department d
						on c.departmentid=d.id
						where d.name like '$_POST[crsname]%'
						order by c.coursename
						
				  ";
						$sdep=$myDb->dump_searchbookquery($sdq,'','','','');
		         break;	
			case 'author':
				  $sdq="SELECT b.bookid as id,d.name as 'Department Name',b.deptid,c.coursename 'Course Name',b.author Author,b.edition Edition,b.totalbook 'Total Book',b.selfid 'Book Self No',b.rowno 'Row No' 
						from tbl_bookentry b
						INNER JOIN tbl_courses c
						on b.courseid=c.id
						INNER JOIN tbl_department d
						on c.departmentid=d.id
						where b.author like '$_POST[crsname]%'
						order by c.coursename
						
				  ";
						$sdep=$myDb->dump_searchbookquery($sdq,'','','','');
		         break;	
			case 'course':
				  $sdq="SELECT b.bookid as id,d.name as 'Department Name',b.deptid,c.coursename 'Course Name',b.author Author,b.edition Edition,b.totalbook 'Total Book',b.selfid 'Book Self No',b.rowno 'Row No' 
						from tbl_bookentry b
						INNER JOIN tbl_courses c
						on b.courseid=c.id
						INNER JOIN tbl_department d
						on c.departmentid=d.id
						where c.coursename like '$_POST[crsname]%'
						order by c.coursename
						
				  ";
						$sdep=$myDb->dump_searchbookquery($sdq,'','','','');
		         break;	
		    default:
				  $sdq="SELECT b.bookid as id,d.name as 'Department Name',b.deptid,c.coursename 'Course Name',b.author Author,b.edition Edition,b.totalbook 'Total Book',b.selfid 'Book Self No',b.rowno 'Row No' 
						from tbl_bookentry b
						INNER JOIN tbl_courses c
						on b.courseid=c.id
						INNER JOIN tbl_department d
						on c.departmentid=d.id
						order by c.coursename
						
				  ";
						$sdep=$myDb->dump_searchbookquery($sdq,'','','','');
		 }


?>


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
