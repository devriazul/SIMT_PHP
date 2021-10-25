<?php ob_start();
@session_start();
require_once('dbClass.php');
include("config.php"); 
if($myDb->connectDefaultServer())
{ 
  if($_SESSION['userid']){ 
	if(isset($_GET['stdid'])){
	  $stdid=mysql_real_escape_string($_GET['stdid']);
	}else{
	  $stdid=mysql_real_escape_string($_POST['stdid']);
	}  
	$rowid=mysql_real_escape_string($_GET['rowid']); 
	$crrs=$myDb->select("SELECT*FROM tbl_courses WHERE id in(SELECT courseid from tbl_bookissue WHERE bookid='$rowid')");
	$crrsf=$myDb->get_row($crrs,'MYSQL_ASSOC');
	
	$stc=$myDb->select("SELECT stdid,stdname,img stimg,'' fcimg  FROM tbl_stdinfo WHERE stdid='$stdid'
						UNION ALL
						SELECT facultyid stdid,name stdname,'' stimg,img fcimg from tbl_faculty WHERE facultyid='$stdid'");
	$stcf=$myDb->get_row($stc,'MYSQL_ASSOC');
?>
<div >
  <?php if(!empty($stcf['stimg'])){ ?>
  <img src='../uploads/<?php echo $stcf["stimg"]; ?>' width="60" height="60" >
  <?php } ?>
  
  <?php if(!empty($stcf['fcimg'])){ ?>
  <img src='../facultyphoto/<?php echo $stcf["fcimg"]; ?>' width="60" height="60" >
  <?php } ?>
  <br/>  
  <label><?php echo $stcf['stdname']; ?> </label><BR/>
  <hr>

</div>

<?php 	
	$opby=mysql_real_escape_string($_SESSION['userid']);
	
	$lss=$myDb->select("select*from tbl_libsetting");
	$lssf=$myDb->get_row($lss,'MYSQL_ASSOC');
			$issb=$myDb->select("SELECT*,DATEDIFF(curdate(),returndate) as dated,curdate()  as currentdate FROM tbl_bookissue 
								WHERE stdid='$stdid' and irstatus='ISSUE' 
								and (`return`<>'R' or `return`='R')
								and fine=0
								and returndate<curdate()");
			$sum=0;
			while($issbf=$myDb->get_row($issb,'MYSQL_ASSOC')){
			   
				if(!empty($issbf['id'])){
				   $crrs=$myDb->select("SELECT*FROM tbl_courses WHERE id='$issbf[courseid]'");
				   $crrsf=$myDb->get_row($crrs,'MYSQL_ASSOC');
				   echo "You have to return this book: ".$crrsf['coursename']."</br>";
				   echo "Library Book ID: ".$issbf['bookid']."<br/>";
				   echo "Total exceeded day:".$issbf['dated']."</br>";
				   $sum=($sum+($issbf['dated']*$lssf['fine']));
				  
				   echo "<br/>";
				} 
			 //$sum++; 
			
			}
			if($sum==0){
			  echo "";
			}else{
			  echo "Total Fine: ".($sum);  
			  //exit;
			}  
				
}else{
  header("Location:index.php");
}
}