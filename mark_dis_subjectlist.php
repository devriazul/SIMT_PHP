<?php ob_start();
session_start();
require_once('dbClass.php');
include("config.php"); 
if($myDb->connect($host,$user,$pwd,$db,true))
{ 
  if($_SESSION['userid']){
  $chka="SELECT*FROM  tbl_accdtl WHERE flname='dep_sub_mark_distribution.php' AND userid='$_SESSION[userid]'";
  $caq=$myDb->select($chka);
  $car=$myDb->get_row($caq,'MYSQL_ASSOC');
  if($car['ins']=="y"){
  
  
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Untitled Document</title>
<style type="text/css">
 #sep{
      margin-right:25px;
}

.td-head{
    padding:5px;
	font-family:Verdana, Arial, Helvetica, sans-serif;
	font-size:14px;	
}
.tr-head{
  background-color:#D9F0FB;
  font-family:Verdana, Arial, Helvetica, sans-serif;
  border-bottom:1px solid #666666;
  color:#666666;
}
.tr-recor-border{
  margin:3px;
  font-family:Verdana, Arial, Helvetica, sans-serif;
  font-size:10px;
  border-bottom:1px solid #666666;
 }   	  
</style>
<script language type="text/javascript"> 
function handleEnter (field, event) {
		var keyCode = event.keyCode ? event.keyCode : event.which ? event.which : event.charCode;
		if (keyCode == 13) {
			var i;
			for (i = 0; i < field.form.elements.length; i++)
				if (field == field.form.elements[i])
					break;
			i = (i + 1) % field.form.elements.length;
			field.form.elements[i].focus();
			return false;
		} 
		else
		return true;
	}      
 

</script>
<script src="dep_sub_mark_val.js" type="text/javascript"></script>



</head>


<body>
<div align="center">
<form name="MyForm12" action="mark_dis_subjectlist.php" method="post" onsubmit="xmlhttpPost1('dep_sub_val.php', 'MyForm12', 'MyResult12', '<img src=\'loader.gif\'>'); return false;">
  <table width="800" border="0" cellspacing="0" cellpadding="0" style="border:1px solid #999999; margin:3px;">
    <tr class="tr-head">
      <td width="3%" rowspan="3" class="td-head" style="border-bottom:1px solid #666666; border-right:1px solid #666666;">SL</td>
      <td width="29%" rowspan="3" class="td-head" style="border-bottom:1px solid #666666; border-right:1px solid #666666;">Name of the subject </td>
      <td colspan="3" rowspan="3" style="border-bottom:1px solid #666666; border-right:1px solid #666666;"><div align="center"><span id="sep">T</span><span id="sep">P</span><span id="sep">C</span></div>
      <label>        </label></td>
      <td colspan="4" ><div align="center" class="td-head" style="border-bottom:1px solid #666666; border-right:1px solid #666666;">MARKS</div></td>
    </tr>
    <tr>
      <td colspan="2" class="tr-head"><div align="center" class="td-head" style="border-bottom:1px solid #666666; border-right:1px solid #666666;">Theory</div></td>
      <td colspan="2" class="tr-head"><div align="center" class="td-head" style="border-bottom:1px solid #666666; border-right:1px solid #666666;">Practical</div></td>
      </tr>
    <tr>
      <td width="11%" class="tr-head" style="border-bottom:1px solid #666666; border-right:1px solid #666666;">Cont. assess </td>
      <td width="10%" class="tr-head" style="border-bottom:1px solid #666666; border-right:1px solid #666666;">Final Exam </td>
      <td width="11%" class="tr-head" style="border-bottom:1px solid #666666; border-right:1px solid #666666;">Cont. assess </td>
      <td width="11%" class="tr-head" style="border-bottom:1px solid #666666; border-right:1px solid #666666;">Final Exam </td>
    </tr>
				
	 <?php $sds="SELECT c.id crid,d.id depid, c.coursecode AS CourseCode, c.coursename AS CourseName, d.name AS DepartmentName, c.credit AS Credit, c.theory AS T, c.practical AS P, c.description AS Description FROM tbl_courses c, tbl_department d,tbl_semester s,tbl_semesterwisesubj sw
	 WHERE sw.deptid = d.id 
	 AND sw.semesterid=s.id
	 AND sw.courseid=c.id
	 AND sw.year='$_POST[year]'
	 AND sw.session='$_POST[session]'
	 AND sw.semesterid='$_POST[semester]'
	 AND sw.deptid='$_POST[department]'
	 AND sw.storedstatus <>'D'";
		$sdq=mysql_query($sds);
		$count=1;
	while($mds=mysql_fetch_array($sdq)){		   
		  ?>  
    <tr >
      <td class="tr-recor-border"><div align="center"><?php echo $count; ?></div></td>
      <td class="tr-recor-border">
	  <input type="hidden" name="deptidv" id="deptidv" value="<?php echo $_POST['department']; ?>" />
	  <input type="hidden" name="yearv" id="yearv" value="<?php echo $_POST['year']; ?>" />
	  <input type="hidden" name="sessionv" id="sessionv" value="<?php echo $_POST['session']; ?>" />
	  <input type="hidden" name="semesterv" id="semesterv" value="<?php echo $_POST['semester']; ?>"  />
	  <input type="hidden" name="crid[]" id="crid[]" value="<?php echo $mds['crid']; ?>" />
	  <input type="hidden" name="crcode[]" id="crcode[]" value="<?php echo $mds['CourseCode']; ?>" />
	  
	  <?php echo $mds['CourseName']; ?></td>
      <td width="5%" class="tr-recor-border"><div align="center"><input name="t[]" id="t[]" type="hidden" size="5" value="<?php echo $mds['T']; ?>" onkeypress="return handleEnter(this, event)" />
        <?php echo $mds['T']; ?>
      </div></td>
      <td width="5%" class="tr-recor-border"><div align="center"><input name="p1[]" id="p1[]" type="hidden" size="5" value="<?php echo $mds['P']; ?>" onkeypress="return handleEnter(this, event)" />
       <?php echo $mds['P']; ?>
      </div></td>
      <td width="5%" class="tr-recor-border"><div align="center">
        <input name="c[]" id="c[]" type="hidden" size="5" value="<?php echo $mds['Credit']; ?>" onkeypress="return handleEnter(this, event)" /><?php echo $mds['Credit']; ?>
      </div></td>
      <td class="td-head" style="border-bottom:1px solid #666666;"><label>
        <div align="center">
          <input name="cont_assess_t[]" type="text" id="cont_assess_t[]" onkeypress="return handleEnter(this, event)" value="0" size="5" align="middle" onchange="MyCal()" />
        </div>
      </label></td>
      <td class="td-head" style="border-bottom:1px solid #666666;"><div align="center">
        <input name="f_exam_t[]" type="text" id="f_exam_t[]" onkeypress="return handleEnter(this, event)" value="0" size="5" onchange="MyCal()" />
      </div></td>
      <td class="td-head" style="border-bottom:1px solid #666666;"><div align="center">
        <input name="cont_assess_p[]" type="text" id="cont_assess_p[]"  onkeypress="return handleEnter(this, event)" value="0" size="5" onchange="MyCal()"/>
      </div></td>
      <td class="td-head" style="border-bottom:1px solid #666666;"><div align="center">
        <input name="f_exam_p[]" type="text" id="f_exam_p[]" onkeypress="return handleEnter(this, event)" value="0" size="5" onchange="MyCal()" />
      </div></td>
      </tr>
   
	<?php
	$count++;
	}
	?>
	 <tr >
	   <td colspan="9" class="tr-recor-border"><div id="MyResult12" align="center"></div></td>
      </tr>
	 <tr >
      <td class="tr-recor-border">&nbsp;</td>
      <td class="tr-recor-border">&nbsp;</td>
      <td class="tr-recor-border">&nbsp;</td>
      <td class="tr-recor-border">&nbsp;</td>
      <td class="tr-recor-border">&nbsp;</td>
      <td class="td-head" style="border-bottom:1px solid #666666;"><label>
        <input type="submit" name="Submit" value="Submit" />
      </label></td>
      <td class="td-head" style="border-bottom:1px solid #666666;">&nbsp;</td>
      <td colspan="2" class="td-head" style="border-bottom:1px solid #666666;">	</td>
    </tr>
  </table>
</form>
</div>
</body>
</html>
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