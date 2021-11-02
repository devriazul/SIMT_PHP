<?php ob_start();
session_start();
include("config.php"); 
if($myDb->connectDefaultServer())
{ 
  if($_SESSION['userid']){
  $chka="SELECT*FROM  tbl_accdtl WHERE flname='semesterwisesubject_search.php' AND userid='$_SESSION[userid]'";
  $caq=$myDb->select($chka);
  $car=$myDb->get_row($caq,'MYSQL_ASSOC');
  if($car['ins']=="y"){
  
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

</head>

<body>
<form method="post" action="ins_semesterwisesubject.php" onSubmit="return checkForm4(this);">
<table width="99%" border="0" cellspacing="0" cellpadding="0">
<input type="hidden" name="department1" id="department1" value="<?php echo mysql_real_escape_string($_POST['department']); ?>" />
<input type="hidden" name="year1" id="year1" value="<?php echo mysql_real_escape_string($_POST['year']); ?>"  />
<input type="hidden" name="session1" id="session1" value="<?php echo mysql_real_escape_string($_POST['session']); ?>"  />
<input type="hidden" name="semester1" id="semester1" value="<?php echo mysql_real_escape_string($_POST['semester']); ?>"  />
<?php 
  $department=mysql_real_escape_string($_POST['department']);
  $crs="SELECT*FROM tbl_courses WHERE departmentid='$department'";
  $crq=$myDb->select($crs);
  $t=0;
  $nrow=4;
  while($crsr=$myDb->get_row($crq,'MYSQL_ASSOC')){
    if($t==$nrow){
?>  
<tr>
    <td width="3%"><label>
      <input type="checkbox" name="crid[]" value="<?php echo $crsr['id']; ?>" />
    </label></td>
    <td class="style4"><?php echo $crsr['coursename']; ?></td>
                      <?php $t=1; }else{ ?>
    <td width="3%"><label>
      <input type="checkbox" name="crid[]" value="<?php echo $crsr['id']; ?>" />
    </label></td>
    <td class="style4"><?php echo $crsr['coursename']; ?></td>
                      <?php $t++; } } ?>
</tr>
<tr>
  <td>&nbsp;</td>
  <td class="style4">
    <div align="center">
      <input type="submit" value="Save" name="submit2" style="color: #999999; font-size: 8pt; font-family: Verdana; border: 1px solid #C0C0C0; background-color: #D9F0FB">
      </div></td><td>&nbsp;</td>
  <td class="style4">&nbsp;</td>
</tr>
</table>
</form>
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
