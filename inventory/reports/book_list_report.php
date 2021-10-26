<?php ob_start();
session_start();
include("../../config.php"); 
if($myDb->connectDefaultServer())
{ 
  if($_SESSION['userid']){
  $chka="SELECT*FROM  tbl_accdtl WHERE flname='semesterwisesubject_search.php' AND userid='$_SESSION[userid]'";
  $caq=$myDb->select($chka);
  $car=$myDb->get_row($caq,'MYSQL_ASSOC');
  if($car['ins']=="y"){
?>  

<?php 	  /*$lib="SELECT courseid,sum(totalbook) 'Total Book'
	            FROM tbl_bookentry
																									WHERE courseid in(SELECT courseid
																									                FROM  tbl_semesterwisesubj
																													)
																													group by deptid
																												
		   																				";*/	
		  $libq=$myDb->select("SELECT id,count(name),name FROM tbl_department group by name");
		  while($libf=$myDb->get_row($libq,'MYSQL_ASSOC')){
		  									  //echo "<label>Department Name:</label> {$libf['name']}";
																					  

		  $sdq=$myDb->select("SELECT b.bookid as id,d.name as 'Department Name',c.coursename 'Course Name',b.author Author,b.edition Edition,b.selfid 'Book Self No',b.rowno 'Row No',b.publisher Publisher,b.totalbook 'Total Book',b.price Price,b.totalbook*b.price 'Total Cost' 
		        from tbl_bookentry b
				INNER JOIN tbl_courses c
				on b.courseid=c.id
				INNER JOIN tbl_department d
				on c.departmentid=d.id
				where b.deptid='$libf[id]'
				order by b.bookid");
           

				  $fp = fopen("crsRpt.txt", "w");		   
				  while($sdqf=$myDb->get_row($sdq,'MYSQL_ASSOC')){
				  
				    //$name = $_POST['name'];
					//$email = $_POST['email'];
					
					$savestring = $sdqf['id'].";".$sdqf['Course Name'].";".$sdqf['Author'].";".$sdqf['Department Name'].";".$sdqf['Book Self No'].";".$sdqf['Row No'].";".$sdqf['Total Book']." \n";
					fwrite($fp, $savestring);
				  
				    //echo $stdr['id'].";".$stdr['stdid'].";".$stdr['stdname'].";".$stdr['hostel'];
				    }
				  fclose($fp);
				  }					
				  
				  
				  header("Location:bookListRpt.php");

			?>	  
  
<?php   
    } 
   }else{
     $msg="Sorry,you are not authorized to access this page";
	 header("Location:home.php?msg=$msg");
   }	 

}else{
  header("Location:login.php");
}
?>
