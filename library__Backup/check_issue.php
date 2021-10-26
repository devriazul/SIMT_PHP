<?php ob_start();
@session_start();
include("../config.php"); 
if($myDb->connectDefaultServer())
{ 
  if($_SESSION['userid']){ 
	if(isset($_GET['stdid'])){
	  $stdid=mysql_real_escape_string($_GET['stdid']);
	}else{
	  $stdid=mysql_real_escape_string($_POST['stdid']);
	}  
	
	//is the valid student
	$stc=$myDb->select("SELECT stdid stdid,stdname,img  FROM tbl_stdinfo WHERE stdid='$stdid'
						UNION ALL
						SELECT facultyid stdid,name stdname,img from tbl_faculty WHERE facultyid='$stdid'");
	$stcf=$myDb->get_row($stc,'MYSQL_ASSOC');
	
?>

<?php 	
	$opby=mysql_real_escape_string($_SESSION['userid']);
	
	$lss=$myDb->select("select*from tbl_libsetting");
	$lssf=$myDb->get_row($lss,'MYSQL_ASSOC');
	
	$tbbq=$myDb->select("select (SELECT ifnull(count(*),0) 
									FROM tbl_bookissue 
									WHERE stdid='$stdid' 
									and irstatus='ISSUE' 
									and `return`<>'R') totalbook,
								courseid from tbl_bookissue 
								WHERE stdid='$stcf[stdid]' 
								and irstatus='ISSUE' 
								and `return`<>'R' 
								group by courseid");
	$tbbf=$myDb->get_row($tbbq,'MYSQL_ASSOC');
	
	$crrs1=$myDb->select("SELECT*FROM tbl_courses WHERE id='$tbbf[courseid]'");
   while($crrsf1=$myDb->get_row($crrs1,'MYSQL_ASSOC')){
	if($tbbf['totalbook']!=$lssf['maxallow']){
			$issb=$myDb->select("SELECT*,DATEDIFF(curdate(),returndate) as dated,curdate()  as currentdate FROM tbl_bookissue 
								WHERE stdid='$stcf[stdid]' and irstatus='ISSUE' 
								and (`return`<>'R' or `return`='R')
								and fine=0
								and returndate<curdate()");
			$sum=0;
			while($issbf=$myDb->get_row($issb,'MYSQL_ASSOC')){

				if(!empty($issbf['id'])){
				   $crrs=$myDb->select("SELECT*FROM tbl_courses WHERE id='$issbf[courseid]'");
				   $crrsf=$myDb->get_row($crrs,'MYSQL_ASSOC');
				   echo "You have to return this book:".$crrsf['coursename']."</br>";
				   echo "Library Book ID: ".$issbf['bookid']."<br/>";
				   echo "Total exceeded day:".$issbf['dated']."</br>";
				   $sum+=(($issbf['dated']*$lssf['fine']));
				   echo "<br/>";
				  //$sum++;
				}
				
			}
			if($sum==0){
			  echo "";
			}else{
			  echo "Total Fine: ".($sum);  
			  exit;
			}  
	}else{
	  echo "You already taken maximum books,another book not issued for you";
	  echo "<br/>";
	  $tkbook=$myDb->select("SELECT p.coursename,c.courseid FROM tbl_courses p
	  						 inner join tbl_bookissue c
							 on p.id=c.courseid 
							 WHERE c.stdid='$stcf[stdid]'");
	  while($tkbf=$myDb->get_row($tkbook,'MYSQL_ASSOC')){
	    echo "-> ".$tkbf['coursename']."<br/>";
	  }
	  exit;
    }	
  }	  
				

}else{
  header("Location:index.php");
}
}