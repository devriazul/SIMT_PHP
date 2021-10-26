<?php ob_start();
session_start();
define('APPROOT', getcwd());
define('CLASSES',$_SERVER['DOCUMENT_ROOT'].'/simt/library/');
include CLASSES.'config.php';
require_once CLASSES.'/class/ReturnStatus.class.php';
if($myDb->connectDefaultServer())
{ 
  if($_SESSION['userid']){
  $chka="SELECT*FROM  tbl_accdtl WHERE flname='book_entry.php' AND userid='$_SESSION[userid]'";
  $caq=$myDb->select($chka);
  $car=$myDb->get_row($caq,'MYSQL_ASSOC');
  if($car['ins']=="y"){
    $prs=new ReturnStatus();

?>
<style type="text/css">

@import url("../library.css");
@import url("../main.css");
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
			  $('a[id=cls]').click(function(e){		          

			    e.preventDefault();					

				$('#shwprt').fadeOut("slow");
			  }); 

});

</script>
<div align="center">
<h2>SAIC GROUP OF INSTITUTIONS<br />
<h4>House-1,Road-2,Block-B,Section-6</h4>
<h4>Mirpur,Dhaka-1216</h4>
</h2>
</div>

<div style="width:800px;margin:0 auto; color:#333333; " >
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
								where b.returndate<=curdate()
								and b.irstatus<>'RETURN'
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
								where b.returndate<=curdate()
								and b.irstatus<>'RETURN'
								and b.deptid='$didf[id]'
								";
			$prs->CurrentDateReturn($sql,'');		  
		?>
<script language="javascript">
  $(document).ready(function(){
	 $('#submit-btn1').click(function(){
		var thePopup = window.open("issRtnRpt.php?name=<?php echo urlencode($_GET['name']); ?>","Book Issue & Return Information","location=0,titlebar=0,menubar=0,addressbar=no,height=700,width=900","fullscreen=yes" );
			thePopup.print();
		  
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
								where b.returndate<=curdate()
								and b.irstatus<>'RETURN'
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
								where b.returndate<=curdate()
								and b.irstatus<>'RETURN'
								and b.courseid in('$didf[id]')";
			$prs->CurrentDateReturn($sql,'');			  
		?>
<script language="javascript">
  $(document).ready(function(){
	 $('#submit-btn1').click(function(){
		var thePopup = window.open("issRtnRpt.php?courseid=<?php echo urlencode($_GET['courseid']); ?>","Book Issue & Return Information","location=0,titlebar=0,menubar=0,addressbar=no,height=700,width=900","fullscreen=yes" );
			thePopup.print();
		  
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
								where b.returndate<=curdate()
								and b.irstatus<>'RETURN'
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
								where b.returndate<=curdate()
								and b.irstatus<>'RETURN'
								and b.courseid in('$didf[id]')
								";
			$prs->CurrentDateReturn($sql,'');			
	  ?>
<script language="javascript">
  $(document).ready(function(){
	 $('#submit-btn1').click(function(){
		var thePopup = window.open("issRtnRpt.php?coursename=<?php echo urlencode($_GET['coursename']); ?>","Book Issue & Return Information","location=0,titlebar=0,menubar=0,addressbar=no,height=700,width=900","fullscreen=yes" );
			thePopup.print();
		  
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
		  $Msql="SELECT stdid 'Student ID',stdname 'Student Name' 
		  			FROM tbl_stdinfo 
					WHERE {$prs->getFieldName()}='{$prs->getFieldValue()}'
					UNION ALL
					SELECT facultyid 'Student ID',name 'Student Name' 
		  			FROM tbl_faculty 
					WHERE facultyid='{$prs->getFieldValue()}'";
		  $prs->MainCategory($Msql);
		  
		  $did=$prs->select("SELECT stdid FROM tbl_stdinfo WHERE {$prs->getFieldName()} like '{$prs->getFieldValue()}%'
		                       AND stdid in(SELECT stdid FROM tbl_bookissue)
							 UNION ALL
							 SELECT facultyid FROM tbl_faculty WHERE facultyid like '{$prs->getFieldValue()}%'
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
								where b.returndate<=curdate()
								and b.irstatus<>'RETURN'
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
								where b.returndate<=curdate()
								and b.irstatus<>'RETURN'
								and b.stdid in('$didf[stdid]')
								";
			$prs->CurrentDateReturn($sql,'');					  
	  ?>
<script language="javascript">
  $(document).ready(function(){
	 $('#submit-btn1').click(function(){
		var thePopup = window.open("issRtnRpt.php?stdid=<?php echo urlencode($_GET['stdid']); ?>","Book Issue & Return Information","location=0,titlebar=0,menubar=0,addressbar=no,height=700,width=900","fullscreen=yes" );
			thePopup.print();
		  
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
  header("Location:login.php");
}
}  
?>
