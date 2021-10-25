<?php ob_start();
session_start();
require_once('dbClass.php');
include("config.php"); 
if($myDb->connectDefaultServer())
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
	  $('#return'+id).css({'display':'none'});
	  var isid=$('#issue'+id).attr('id');
	  $('#issue'+id).toggle('slow');
	 $('#issue'+id).load('book_issue.php?rowid='+id);
	  
	 
    });	  
	
	 $('a[name=isreturn]').click(function(e){
	  e.preventDefault();
	 
	  var id=$(this).attr('id'); 
	  $('#issue'+id).css({'display':'none'});
	  var isid=$('#return'+id).attr('id');
	  $('#return'+id).toggle('slow');
	  $('#return'+id).load('book_return.php?rowid='+id);
	  
	 
    });	  

});
</script>


<?php 
         switch($_POST['listb']){
		   case 'department':
				  $sdq="SELECT b.bookid as id,d.name as 'Department Name',c.coursename 'Course Name',b.author Author,b.edition Edition,b.selfid 'Book Self No',b.rowno 'Row No' 
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
				  $sdq="SELECT b.bookid as id,d.name as 'Department Name',c.coursename 'Course Name',b.author Author,b.edition Edition,b.selfid 'Book Self No',b.rowno 'Row No' 
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
				  $sdq="SELECT b.bookid as id,d.name as 'Department Name',c.coursename 'Course Name',b.author Author,b.edition Edition,b.selfid 'Book Self No',b.rowno 'Row No' 
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
				  $sdq="SELECT b.bookid as id,d.name as 'Department Name',c.coursename 'Course Name',b.author Author,b.edition Edition,b.selfid 'Book Self No',b.rowno 'Row No' 
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
