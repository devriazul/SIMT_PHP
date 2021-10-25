<?php ob_start();
session_start();
require_once('dbClass.php');
include("config.php"); 
if($myDb->connectDefaultServer())
{ 
  if($_SESSION['userid']){

  $dp="SELECT*FROM  tbl_department WHERE id='$_POST[deptid]'";
  $dpq=$myDb->select($dp);
  $cardp=$myDb->get_row($dpq,'MYSQL_ASSOC');

  $cr="SELECT*FROM  tbl_courses WHERE id='$_POST[courseid]'";
  $crq=$myDb->select($cr);
  $carcr=$myDb->get_row($crq,'MYSQL_ASSOC');

  $sm="SELECT*FROM  tbl_semester WHERE id='$_POST[semesterid]'";
  $csm=$myDb->select($sm);
  $carsm=$myDb->get_row($csm,'MYSQL_ASSOC');


	$iv="SELECT distinct exammarksper FROM tbl_examinitionsettings WHERE deptid='$_POST[deptid]' and courseid= '$_POST[courseid]' and semesterid='$_POST[semesterid]' and session='$_POST[sess]' and year='$_POST[year]' and examtype='$_POST[examtype]'";
  	$ivq=$myDb->select($iv);
  	$ivrs=$myDb->get_row($ivq,'MYSQL_ASSOC');


	
?>
<style type="text/css">
@import url("main.css");
</style>
<div align="center">
<h2><?php include("rptheader.php");?><br />

Student Result Report</h2>
<table width="38%"  border="0" cellspacing="0" cellpadding="2">
  <tr>
    <td width="41%"><strong class="style16">Department Name</strong></td>
    <td width="4%">:</td>
    <td width="55%"><?php echo $cardp['name'];?></td>
  </tr>
  <tr>
    <td><strong class="style16">Course Name</strong></td>
    <td>:</td>
    <td><?php echo $carcr['coursename']." (".$carcr['coursecode'].")";?></td>
  </tr>
  <tr>
    <td><strong class="style16">Session</strong></td>
    <td>:</td>
    <td><?php echo $_POST['sess'];?></td>
  </tr>
  <tr>
    <td><strong class="style16">Semester</strong></td>
    <td>:</td>
    <td><?php echo $carsm['name'];?></td>
  </tr>
  <tr>
    <td><span class="style16"><strong>Exam Name</strong></span></td>
    <td>:</td>
    <td><?php echo $_POST['examtype']." (Total Marks:". $ivrs['exammarksper'].")";?></td>
  </tr>
</table>
<p>&nbsp;</p>
</div>
<?php 
   /* $prdtype=mysql_real_escape_string($_GET['prdtype']);
	if(!empty($prdtype))
	{
    	echo "&nbsp;&nbsp;Product Type: ".$prdtype."<br/><br/>";
     	$sdq="SELECT id,pname 'Product Name',packsize 'Pack Size',qty 'OB Qty', prtype 'Product Type' FROM tbl_product where prtype='$prdtype' order by id desc";
	 	$sdep=$myDb->dump_query($sdq,'edit_product.php','del_product.php','','');
    }*/
					if(($_POST['examtype']=="Theory Final Exam")) 
				  	{ 
				  		$result="SELECT distinct concat(s.stdid, ' (',s.boardrollno,')') as 'Student ID', s.stdname as 'Student Name', m.classtestmarks as Marks FROM `tbl_marksentryfinal` m inner join tbl_stdinfo s on m.stdid=s.stdid WHERE m.deptid='$_POST[deptid]' and m.session='$_POST[sess]' and m.courseid='$_POST[courseid]' and m.semesterid='$_POST[semesterid]'  order by m.id";
					 	$sdep=$myDb->dump_query($result,'edit_product.php','del_product.php','','');

				  	}
					else if(($_POST['examtype']=="Practical Final Exam")) 
				  	{ 
				  		$result="SELECT distinct concat(s.stdid, ' (',s.boardrollno,')') as 'Student ID', s.stdname as 'Student Name', m.classtestmarks as Marks FROM `tbl_marksentryfinal` m inner join tbl_stdinfo s on m.stdid=s.stdid WHERE m.deptid='$_POST[deptid]' and m.session='$_POST[sess]' and m.courseid='$_POST[courseid]' and m.semesterid='$_POST[semesterid]'  order by m.id";
					 	$sdep=$myDb->dump_query($result,'edit_product.php','del_product.php','','');
				  	} 
					else if(($_POST['examtype']=="Class Test")) 
					{
				  		$result="SELECT distinct concat(s.stdid, ' (',s.boardrollno,')') as 'Student ID', s.stdname as 'Student Name', m.classtestmarks as Marks FROM `tbl_marksentryfinal` m inner join tbl_stdinfo s on m.stdid=s.stdid WHERE m.deptid='$_POST[deptid]' and m.session='$_POST[sess]' and m.courseid='$_POST[courseid]' and m.semesterid='$_POST[semesterid]'  order by m.id";
					 	$sdep=$myDb->dump_query($result,'edit_product.php','del_product.php','','');
			      	}
					else if(($_POST['examtype']=="Quiz Test")) 
					{
				  		$result="SELECT distinct concat(s.stdid, ' (',s.boardrollno,')') as 'Student ID', s.stdname as 'Student Name', m.classtestmarks as Marks FROM `tbl_marksentryfinal` m inner join tbl_stdinfo s on m.stdid=s.stdid WHERE m.deptid='$_POST[deptid]' and m.session='$_POST[sess]' and m.courseid='$_POST[courseid]' and m.semesterid='$_POST[semesterid]'  order by m.id";
					 	$sdep=$myDb->dump_query($result,'edit_product.php','del_product.php','','');
			      	}
					else if(($_POST['examtype']=="Job/Experiment")) 
					{
				  		$result="SELECT distinct concat(s.stdid, ' (',s.boardrollno,')') as 'Student ID', s.stdname as 'Student Name', m.classtestmarks as Marks FROM `tbl_marksentryfinal` m inner join tbl_stdinfo s on m.stdid=s.stdid WHERE m.deptid='$_POST[deptid]' and m.session='$_POST[sess]' and m.courseid='$_POST[courseid]' and m.semesterid='$_POST[semesterid]'  order by m.id";
					 	$sdep=$myDb->dump_query($result,'edit_product.php','del_product.php','','');
			      	}
					else if(($_POST['examtype']=="Job/Experiment Final")) 
					{
				  		$result="SELECT distinct concat(s.stdid, ' (',s.boardrollno,')') as 'Student ID', s.stdname as 'Student Name', m.classtestmarks as Marks FROM `tbl_marksentryfinal` m inner join tbl_stdinfo s on m.stdid=s.stdid WHERE m.deptid='$_POST[deptid]' and m.session='$_POST[sess]' and m.courseid='$_POST[courseid]' and m.semesterid='$_POST[semesterid]'  order by m.id";
					 	$sdep=$myDb->dump_query($result,'edit_product.php','del_product.php','','');
			      	}
					else if(($_POST['examtype']=="Home Work")) 
					{
				  		$result="SELECT distinct concat(s.stdid, ' (',s.boardrollno,')') as 'Student ID', s.stdname as 'Student Name', m.classtestmarks as Marks FROM `tbl_marksentryfinal` m inner join tbl_stdinfo s on m.stdid=s.stdid WHERE m.deptid='$_POST[deptid]' and m.session='$_POST[sess]' and m.courseid='$_POST[courseid]' and m.semesterid='$_POST[semesterid]'  order by m.id";
					 	$sdep=$myDb->dump_query($result,'edit_product.php','del_product.php','','');
			      	}
					else if(($_POST['examtype']=="Job/Experiment Report")) 
					{
				  		$result="SELECT distinct concat(s.stdid, ' (',s.boardrollno,')') as 'Student ID', s.stdname as 'Student Name', m.classtestmarks as Marks FROM `tbl_marksentryfinal` m inner join tbl_stdinfo s on m.stdid=s.stdid WHERE m.deptid='$_POST[deptid]' and m.session='$_POST[sess]' and m.courseid='$_POST[courseid]' and m.semesterid='$_POST[semesterid]'  order by m.id";
					 	$sdep=$myDb->dump_query($result,'edit_product.php','del_product.php','','');
			      	}
					else if(($_POST['examtype']=="Job/Experiment Report Final")) 
					{
				  		$result="SELECT distinct concat(s.stdid, ' (',s.boardrollno,')') as 'Student ID', s.stdname as 'Student Name', m.classtestmarks as Marks FROM `tbl_marksentryfinal` m inner join tbl_stdinfo s on m.stdid=s.stdid WHERE m.deptid='$_POST[deptid]' and m.session='$_POST[sess]' and m.courseid='$_POST[courseid]' and m.semesterid='$_POST[semesterid]'  order by m.id";
					 	$sdep=$myDb->dump_query($result,'edit_product.php','del_product.php','','');
			      	}
					else if(($_POST['examtype']=="Job/Experiment Viva")) 
					{
				  		$result="SELECT distinct concat(s.stdid, ' (',s.boardrollno,')') as 'Student ID', s.stdname as 'Student Name', m.classtestmarks as Marks FROM `tbl_marksentryfinal` m inner join tbl_stdinfo s on m.stdid=s.stdid WHERE m.deptid='$_POST[deptid]' and m.session='$_POST[sess]' and m.courseid='$_POST[courseid]' and m.semesterid='$_POST[semesterid]'  order by m.id";
					 	$sdep=$myDb->dump_query($result,'edit_product.php','del_product.php','','');
			      	}
					else if(($_POST['examtype']=="Job/Experiment Viva Final")) 
					{
				  		$result="SELECT distinct concat(s.stdid, ' (',s.boardrollno,')') as 'Student ID', s.stdname as 'Student Name', m.classtestmarks as Marks FROM `tbl_marksentryfinal` m inner join tbl_stdinfo s on m.stdid=s.stdid WHERE m.deptid='$_POST[deptid]' and m.session='$_POST[sess]' and m.courseid='$_POST[courseid]' and m.semesterid='$_POST[semesterid]'  order by m.id";
					 	$sdep=$myDb->dump_query($result,'edit_product.php','del_product.php','','');
			      	}
					else if(($_POST['examtype']=="Attendance Marks")) 
					{
				  		$result="SELECT distinct concat(s.stdid, ' (',s.boardrollno,')') as 'Student ID', s.stdname as 'Student Name', m.classtestmarks as Marks FROM `tbl_marksentryfinal` m inner join tbl_stdinfo s on m.stdid=s.stdid WHERE m.deptid='$_POST[deptid]' and m.session='$_POST[sess]' and m.courseid='$_POST[courseid]' and m.semesterid='$_POST[semesterid]'  order by m.id";
					 	$sdep=$myDb->dump_query($result,'edit_product.php','del_product.php','','');
			      	}
					else if(($_POST['examtype']=="Behavior")) 
					{
				  		$result="SELECT distinct concat(s.stdid, ' (',s.boardrollno,')') as 'Student ID', s.stdname as 'Student Name', m.classtestmarks as Marks FROM `tbl_marksentryfinal` m inner join tbl_stdinfo s on m.stdid=s.stdid WHERE m.deptid='$_POST[deptid]' and m.session='$_POST[sess]' and m.courseid='$_POST[courseid]' and m.semesterid='$_POST[semesterid]'  order by m.id";
					 	$sdep=$myDb->dump_query($result,'edit_product.php','del_product.php','','');
			      	}

	/*else{
	 
		  $prtq=$myDb->select("SELECT distinct prtype FROM tbl_product");
		  while($prtf=$myDb->get_row($prtq,'MYSQL_ASSOC')){
				 echo "<br/>";
				 echo "&nbsp;&nbsp;Product Type: ".$prtf['prtype']."<br/><br/>";

				 $sdq="SELECT id,pname 'Product Name',packsize 'Pack Size',qty 'OB Qty', prtype 'Product Type' FROM tbl_product where prtype='$prtf[prtype]' order by id desc";
				 $sdep=$myDb->dump_query($sdq,'edit_product.php','del_product.php','','');
		  }
	 
	 }*/
?>
  <div align="center">
<h2><?php include("rptbot.php");?><br />
</h2>
</div>

<?php
}else{
  header("Location:login.php");
}
}  
?>