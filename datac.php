<?php ob_start();
session_start();
require_once('dbClass.php');
include("config.php"); 
if($myDb->connect($host,$user,$pwd,$db,true))
{ 
  if($_SESSION['userid']){
  $chka="SELECT*FROM  tbl_accdtl WHERE flname='managecourseassigntofaculty.php' AND userid='$_SESSION[userid]'";
  $caq=$myDb->select($chka);
  $car=$myDb->get_row($caq,'MYSQL_ASSOC');
  if(($car['ins']=="y")||($_SESSION['userid']=="administrator")){
  
?>  
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Untitled Document</title>
<script type="text/javascript">
function checkArray(form,arrayName)
{
   var retval=new Array();
   for(var i=0;i<form.elements.length;i++){
       var el=form.elements[i];
	   if(el.type=="checkbox"&&el.name==arrayName&&el.checked){
	      retval.push(el.value);
	   }
   }
   return retval;
}
function checkForm4(form)
{
   var itemsChecked=checkArray(form,"crid[]");
   //alert("You selected "+itemsChecked.length+" items");
   if(itemsChecked.length==0){
      alert("You have to select at least one item");
	  //itemsChecked.length.focus();
      return false;
      //alert("The items selected were:\n\t"+itemsChecked);
   }
   return true;
}
</script>
<script language="javascript">
 $(document).ready(function(){
   $('.sbmt').click(function(){
     var fmid=$(this).attr('id');
     var arr=$('#frm'+fmid).serializeArray();
	 
	 $.post('ins_courseassigntofacultynew.php',arr,function(result){
	    $('#shw'+fmid).html(result); 
//$('#MyResult'+fmid).hide();
	 });
	 $('#shw'+fmid).hide().fadeIn('slow');

   });
 });
</script>

</head>

<body></br>
<table width="90%" border="1" cellpadding="0" cellspacing="0" bordercolor="#D9F0FB">
<?php 
  	$department=mysql_real_escape_string($_POST['department']);
    $semester=mysql_real_escape_string($_POST['semester']);
	$session=mysql_real_escape_string(trim($_POST['session']));
  	$year=mysql_real_escape_string($_POST['year']);
  	$section=mysql_real_escape_string($_POST['section']);

	$crs="SELECT p.id crid,p.coursename crsname,af.courseid chid, f.name, af.section
        FROM tbl_courses p
		inner join tbl_assignfaculty af 
		on p.id=af.courseid inner join tbl_faculty f on f.id=af.facultyid
		and af.semesterid='$_POST[semester]'
		and af.deptid='$_POST[department]'
		and af.session='$_POST[session]'
		and af.section='$_POST[section]'
		";
  $crq=$myDb->select($crs);
  $t=0;
  $nrow=4;
  while($crsr=$myDb->get_row($crq,'MYSQL_ASSOC')){
    if($t==$nrow){
?>  
<tr>
  <td colspan="4">Already Assigned Subjects </td>
  </tr>
<tr>
    <td width="3%"><label>
	<?php if($crsr['crid']==$crsr['chid']){ ?>
      <input type="checkbox" name="#" value="<?php echo $crsr['crid']; ?>" checked="checked" disabled="disabled" />
	<?php } ?>	  
    </label></td>
    <td class="style4"><?php echo $crsr['crsname']."(Faculty Name: ".$crsr['name'].")"; ?></td>
                      <?php $t=1; }else{ ?>
    <td width="3%"><label>
	<?php if($crsr['crid']==$crsr['chid']){ ?>
      <input type="checkbox" name="#" value="<?php echo $crsr['crid']; ?>" checked="checked" disabled="disabled" />
	<?php } ?>  
    </label></td>
    <td class="style4"><?php echo $crsr['crsname']."(Faculty Name: ".$crsr['name'].")"; ?></td>
                      <?php $t++; } } ?>
</tr>
</table></br>



<form method="post" id="frm<?php echo $_GET['count']; ?>" action="" >
<table width="90%" border="1" cellpadding="2" cellspacing="0" bordercolor="#D9F0FB">
<input type="hidden" name="department1" id="department1" value="<?php echo mysql_real_escape_string($_POST['department']); ?>" />
<input type="hidden" name="session1" id="session1" value="<?php echo mysql_real_escape_string($_POST['session']); ?>"  />
<input type="hidden" name="year1" id="year1" value="<?php echo mysql_real_escape_string($_POST['year']); ?>"  />
<input type="hidden" name="semester1" id="semester1" value="<?php echo mysql_real_escape_string($_POST['semester']); ?>"  />
<input type="hidden" name="section1" id="section1" value="<?php echo mysql_real_escape_string($_POST['section']); ?>"  />
<input type="hidden" name="facultyid1" id="facultyid1" value="<?php echo mysql_real_escape_string($_POST['facultyid']); ?>"  />
<?php 
  $department=mysql_real_escape_string($_POST['department']);
  $semester=mysql_real_escape_string($_POST['semester']);
  $session=mysql_real_escape_string($_POST['session']);
  

  $crs="SELECT c.* FROM tbl_courses c inner join tbl_semesterwisesubj ss on c.id=ss.courseid WHERE ss.deptid='$department' and ss.semesterid='$semester'";
  $crq=$myDb->select($crs);
  $t=0;
  $nrow=4;
  while($crsrn=$myDb->get_row($crq,'MYSQL_ASSOC')){
    if($t==$nrow){
?>  
<tr bgcolor="#FFFFFF">
    <td width="3%"><label>
      <input type="checkbox" name="crid[]" value="<?php echo $crsrn['id']; ?>" />
    </label></td>
    <td class="style4"><?php echo $crsrn['coursename']."(".$crsrn['coursecode'].")"; ?></td>
                      <?php $t=1; }else{ ?>
    <td width="3%"><label>
      <input type="checkbox" name="crid[]" value="<?php echo $crsrn['id']; ?>" />
    </label></td>
    <td class="style4"><?php echo $crsrn['coursename']."(".$crsrn['coursecode'].")"; ?></td>
                      <?php $t++; } } ?>
</tr>
<tr>
  <td>&nbsp;</td>
  <td class="style4">
    <div align="center">
      <input type="button" value="Click here to Save" name="submit" class="sbmt" id="<?php echo $_GET['count']; ?>" style="color: #999999; font-size: 8pt; font-family: Verdana; border: 1px solid #C0C0C0; background-color: #D9F0FB" />
</div></td><td>&nbsp;</td>
  <td class="style4">&nbsp;</td>
</tr>
</table><div id="shw<?php echo $_GET['count']; ?>" class="formhead"></div>
</form>

</body>
</html>
<?php 
   }else{
     $msg="Sorry,you are not authorized to access this page";
	 header("Location:home.php?msg=$msg");
   }	 

}else{
  header("Location:index.php");
}
}