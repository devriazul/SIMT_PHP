<?php ob_start();
session_start();
include("../config.php");
require_once('class/ReturnStatus.class.php');
if($myDb->connectDefaultServer())
{ 
  if($_SESSION['userid']){
  $chka="SELECT*FROM  tbl_accdtl WHERE flname='book_entry.php' AND userid='$_SESSION[userid]'";
  $caq=$myDb->select($chka);
  $car=$myDb->get_row($caq,'MYSQL_ASSOC');
  if(($car['ins']=="y")||($_SESSION['userid']=="administrator")){
    $prs=new ReturnStatus();
	
$stdid=!empty($_GET['stdid'])?mysql_real_escape_string($_GET['stdid']):'';
$stdid=urlencode($stdid);
$stdid=str_replace("+"," ",$stdid);
$fdate=!empty($_GET['fdate'])?mysql_real_escape_string($_GET['fdate']):'';
$tdate=!empty($_GET['tdate'])?mysql_real_escape_string($_GET['tdate']):'';
	

?>
<style type="text/css">

@import url("../library.css");
@import url("main.css");
.style12 {font-size: 10px}
.style15 {
	font-size: 12px;
	font-family: Verdana, Arial, Helvetica, sans-serif;
}
.style16 {font-size: 12px}
.irstatus{
 box-shadow: 10px 10px 5px #888888;
} 
</style>

<script language="javascript">
$(document).ready(function(){
			  $('a[class=clss]').click(function(e){		          

				$('#shwprt').fadeOut("slow");
			  }); 

});

</script>

<div style="width:700px; padding:10px;margin:0 auto; color:#333333; " >
<div style="width:100px; float:right; " >
  <input type="button" name="print" value="Print" id="submit-btn1" class="button-class" />

  <a href="#" class="clss">[X]</a>
</div>
<?php 
  foreach($_GET as $key=>$value){
   
	  switch($key){
		case "name":
		  $prs->setFieldName($key);
		  $prs->getFieldName()."</br>";
		  $prs->setFieldValue($value);
		  $prs->getFieldValue();
		  $Msql="SELECT code 'Department Code',name FROM tbl_department WHERE {$prs->getFieldName()} like'{$prs->getFieldValue()}%'";
		  $prs->MainCategory($Msql);
		  
		  $did=$prs->select("SELECT id FROM tbl_department WHERE {$prs->getFieldName()} like '{$prs->getFieldValue()}%'
		                     AND id in(SELECT deptid FROM tbl_bookissue)
						  ");
		  $didf=$prs->get_row($did,'MYSQL_ASSOC');
		  $sql="select c.coursecode 'Course Code',c.coursename,s.stdid,s.stdname,b.issuedate 'Issue Date',b.returndate 'Return Date'
								from tbl_bookissue b
								inner join tbl_courses c
								on c.id=b.courseid
								inner join tbl_department d
								on d.id=b.deptid
								inner join tbl_stdinfo s
								on s.stdid=b.stdid
								where b.irstatus<>'RETURN'
								and b.deptid='$didf[id]'
								
								UNION ALL
								select c.coursecode 'Course Code',c.coursename,s.facultyid stdid,s.name stdname,b.issuedate 'Issue Date',b.returndate 'Return Date'
								from tbl_bookissue b
								inner join tbl_courses c
								on c.id=b.courseid
								inner join tbl_department d
								on d.id=b.deptid
								inner join tbl_faculty s
								on s.facultyid=b.stdid
								where b.irstatus<>'RETURN'
								and b.deptid='$didf[id]'								
								";
			$prs->CurrentDateReturn($sql,'');		  
		?>
<script language="javascript">
  $(document).ready(function(){
	 $('#submit-btn1').click(function(){
		var thePopup = window.open("reports/std-faculty-book-return-status.php?name=<?php echo urlencode($_GET['name']); ?>","Book Issue & Return Information","location=0,titlebar=0,menubar=0,addressbar=no,height=700,width=900","fullscreen=yes" );
			//thePopup.print();
		  
		});
 });


</script>

		<?php  
		  break;
		case "courseid":  
		  $prs->setFieldName($key='id');
		  $prs->getFieldName()."</br>";
		  $prs->setFieldValue($value);
		  $prs->getFieldValue();
		  $Msql="SELECT coursecode,coursename FROM tbl_courses WHERE {$prs->getFieldName()}='{$prs->getFieldValue()}'";
		  $prs->MainCategory($Msql);
		  
		  $did=$prs->select("SELECT id FROM tbl_courses WHERE {$prs->getFieldName()} like '{$prs->getFieldValue()}%'
		                      AND id in(SELECT courseid FROM tbl_bookissue)
						  
						  ");
		  $didf=$prs->get_row($did,'MYSQL_ASSOC');
		  $sql="select d.name,s.stdid,s.stdname,b.issuedate 'Issue Date',b.returndate 'Return Date'
								from tbl_bookissue b
								inner join tbl_courses c
								on c.id=b.courseid
								inner join tbl_department d
								on d.id=b.deptid
								inner join tbl_stdinfo s
								on s.stdid=b.stdid
								where b.irstatus<>'RETURN'
								and b.courseid in('$didf[id]')
								
								UNION ALL
								select d.name,s.facultyid stdid,s.name stdname,b.issuedate 'Issue Date',b.returndate 'Return Date'
								from tbl_bookissue b
								inner join tbl_courses c
								on c.id=b.courseid
								inner join tbl_department d
								on d.id=b.deptid
								inner join tbl_faculty s
								on s.facultyid=b.stdid
								where b.irstatus<>'RETURN'
								and b.courseid in('$didf[id]')
								";
			$prs->CurrentDateReturn($sql,'');			  
		?>
<script language="javascript">
  $(document).ready(function(){
	 $('#submit-btn1').click(function(){
		var thePopup = window.open("reports/std-faculty-book-return-status.php?courseid=<?php echo urlencode($_GET['courseid']); ?>&fdate=<?php echo $_GET['fdate']; ?>&tdate=<?php echo $_GET['tdate']; ?>","Book Issue & Return Information","location=0,titlebar=0,menubar=0,addressbar=no,height=700,width=900","fullscreen=yes" );
			//thePopup.print();
		  
		});
 });


</script>
		<?php   
		  
		  break;
		case "coursename":
		  $prs->setFieldName($key);
		  $prs->getFieldName()."</br>";
		  $prs->setFieldValue($value);
		  $prs->getFieldValue();
		  $Msql="SELECT coursecode,coursename FROM tbl_courses WHERE {$prs->getFieldName()}='{$prs->getFieldValue()}'";
		  $prs->MainCategory($Msql);
		  
		  $did=$prs->select("SELECT id FROM tbl_courses WHERE {$prs->getFieldName()} like '{$prs->getFieldValue()}%'
		                       AND id in(SELECT courseid FROM tbl_bookissue)
						  ");
		  $didf=$prs->get_row($did,'MYSQL_ASSOC');
		  $sql="select d.name,s.stdid,s.stdname,b.issuedate 'Issue Date',b.returndate 'Return Date'
								from tbl_bookissue b
								inner join tbl_courses c
								on c.id=b.courseid
								inner join tbl_department d
								on d.id=b.deptid
								inner join tbl_stdinfo s
								on s.stdid=b.stdid
								where b.irstatus<>'RETURN'
								and b.courseid in('$didf[id]')
								
								UNION ALL
								select d.name,s.facultyid stdid,s.name stdname,b.issuedate 'Issue Date',b.returndate 'Return Date'
								from tbl_bookissue b
								inner join tbl_courses c
								on c.id=b.courseid
								inner join tbl_department d
								on d.id=b.deptid
								inner join tbl_faculty s
								on s.facultyid=b.stdid
								where b.irstatus<>'RETURN'
								and b.courseid in('$didf[id]')
								";
			$prs->CurrentDateReturn($sql,'');			
	  ?>
<script language="javascript">
  $(document).ready(function(){
	 $('#submit-btn1').click(function(){
		var thePopup = window.open("reports/allTypeRtnRpt.php?coursename=<?php echo urlencode($_GET['coursename']); ?>","Book Issue & Return Information","location=0,titlebar=0,menubar=0,addressbar=no,height=700,width=900","fullscreen=yes" );
			//thePopup.print();
		  
		});
 });


</script>
	  
	  <?php 		  
		  break;
		case "stdid":
		  $prs->setFieldName($key);
		  $prs->getFieldName()."</br>";
		  $prs->setFieldValue($value);
		  $prs->getFieldValue();
		  $istdid='facultyid';
		  $Msql="SELECT stdid 'Student ID',stdname 'Student Name' 
		  			FROM tbl_stdinfo 
					WHERE stdid='{$prs->getFieldValue()}'
					UNION ALL
					SELECT facultyid 'Student ID',name 'Student Name' 
		  			FROM tbl_faculty 
					WHERE facultyid='{$prs->getFieldValue()}'";
		  $prs->MainCategory($Msql);
		  
		  $did=$prs->select("SELECT stdid FROM tbl_stdinfo WHERE stdid like '{$prs->getFieldValue()}%'
		                       AND stdid in(SELECT stdid FROM tbl_bookissue)
							   
							   UNION ALL
							   SELECT facultyid stdid FROM tbl_faculty WHERE facultyid like '{$prs->getFieldValue()}%'
		                       AND facultyid in(SELECT stdid FROM tbl_bookissue)
						  ");
		  $didf=$prs->get_row($did,'MYSQL_ASSOC');
		  $sql="select d.name 'Department Name',c.coursecode 'Course Code',c.coursename,b.issuedate 'Issue Date',b.returndate 'Return Date'
								from tbl_bookissue b
								inner join tbl_courses c
								on c.id=b.courseid
								inner join tbl_department d
								on d.id=b.deptid
								inner join tbl_stdinfo s
								on s.stdid=b.stdid
								where b.irstatus<>'RETURN'
								and b.stdid in('$didf[stdid]')
								
								UNION ALL
								select d.name 'Department Name',c.coursecode 'Course Code',c.coursename,b.issuedate 'Issue Date',b.returndate 'Return Date'
								from tbl_bookissue b
								inner join tbl_courses c
								on c.id=b.courseid
								inner join tbl_department d
								on d.id=b.deptid
								inner join tbl_faculty s
								on s.facultyid=b.stdid
								where b.irstatus<>'RETURN'
								and b.stdid in('$didf[stdid]')								";
			$prs->CurrentDateReturn($sql,'');					  
	  ?>
<script language="javascript">
  $(document).ready(function(){
	 $('#submit-btn1').click(function(){
		var thePopup = window.open("reports/std-faculty-book-return-status.php?stdid=<?php echo urlencode($_GET['stdid']); ?>&fdate=<?php echo $_GET['fdate']; ?>&tdate=<?php echo $_GET['tdate']; ?>","Book Issue & Return Information","location=0,titlebar=0,menubar=0,addressbar=no,height=700,width=900","fullscreen=yes" );
			//thePopup.print();
		  
		});
 });


</script>
	  
	  <?php 	  
		  break;
	  
	  }
  }
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