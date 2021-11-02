<?php ob_start();
session_start();
include("../config.php"); 
if($myDb->connectDefaultServer())
{ 
  if($_SESSION['userid']){
  $chka="SELECT*FROM  tbl_accdtl WHERE flname='manage_student.php' AND userid='$_SESSION[userid]'";
  $caq=$myDb->select($chka);
  $car=$myDb->get_row($caq,'MYSQL_ASSOC');
  if($car['ins']=="y"){
  
  
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title><?php include("title.php");?></title>
	<link type="text/css" href="css/jquery-ui-1.8.5.custom.css" rel="Stylesheet" />

<style type="text/css">
<!--
@import url("main.css");
.style15 {
	font-size: 12px;
	font-family: Verdana, Arial, Helvetica, sans-serif;
}

-->
</style>

<script type="text/javascript" src="jquery.js"></script>
<script type='text/javascript' src='jquery.autocomplete.js'></script>
<link rel="stylesheet" type="text/css" href="jquery.autocomplete.css" />

<script type="text/javascript">
$().ready(function() {
	$("#stdid").autocomplete("search_std.php", {
		width: 260,
		matchContains: true,
		//mustMatch: true,
		//minChars: 0,
		//multiple: true,
		//highlight: false,
		//multipleSeparator: ",",
		selectFirst: false
	});
});
</script>
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
<script type="text/javascript" language="javascript"> 
window.onload=function() {
document.forms[0][0].focus();
}
</script>

<style type="text/css">
<!--
.style17 {color: #000033}
.style18 {color: #FFFFFF}
-->
</style>
<script type="text/javascript">
function loadXMLDoc(p,r)
{
var xmlhttp;
if (window.XMLHttpRequest)
  {// code for IE7+, Firefox, Chrome, Opera, Safari
  xmlhttp=new XMLHttpRequest();
  }
else
  {// code for IE6, IE5
  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
xmlhttp.onreadystatechange=function()
  {	
    if(xmlhttp.readyState == 3)  // Loading Request
	{
	document.getElementById("myDiv"+r).innerHTML = '<img src="loader.gif" align="center" />';
	}  
  if (xmlhttp.readyState==4 && xmlhttp.status==200)
    {
      document.getElementById("myDiv"+r).innerHTML=xmlhttp.responseText;
	//document.getElementById("tr"+r).style.display="none"; 
    //document.getElementById("pid").focus();	
	}
  }
xmlhttp.open("GET","education.php?id="+p+"&count="+r,true);

xmlhttp.send();
}

</script>
<script type="text/javascript">
function toggleAndChangeText(r) {
     $('#myDiv'+r).toggle('slow');
     if ($('#myDiv'+r).css('display') == 'none') {
	     $('#aTag'+r).html('CLOSE EDUCATION &#9658');
     }
     else {                    
	 
	     $('#aTag'+r).html('VIEW EDUCATION &#9660');

     }
}
</script>

</head>

<body>
<table width="1047" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td width="1047" height="152" valign="top" background="images/1.jpg"><span class="style17"><?php include("topdefault.php");?>    </span></span></td>
  </tr>
  <tr>
    <td><table width="100%" border="0" cellspacing="0" cellpadding="0" id="tblleft">
      <tr>
        <td height="28" colspan="2" bgcolor="#0C6ED1"><div align="center" class="style1">SAIC INSTITUTE OF MANAGEMENT TECHNOLOGY</div></td>
        </tr>
      <tr>
        <td background="images/leftbg.jpg"><img src="images/leftbg.jpg" width="252" height="3" /></td>
        <td><img src="images/spaer.gif" width="1" height="1" /></td>
      </tr>
      <tr>
        <td width="21%" valign="top" background="images/leftbg.jpg"><?php include("left.php"); ?>
          <br />
          
          <p>&nbsp;</p>
          <p>&nbsp;</p></td>
        <td width="79%" valign="top">
<p align="center" id="msgerr" ><font face="Arial, Helvetica, sans-serif" size="2"><?php echo $_GET['msg'];?></font></p>
<div id="content">
<form method="post" autocomplete="off" action="manage_student.php">
		<table width="99%"  border="0" align="center" cellpadding="0" cellspacing="0" id="tblborder">
          <tr>
            <td width="44%"><div align="right" class="style2">Student ID </div></td>
            <td width="1%"><div align="right" class="style2">
              <div align="center">: </div>
            </div></td>
            <td width="55%">
	
		
			<input type="text" name="stdid" id="stdid" />
			<!--input type="button" value="Get Value" /-->
		<input type="submit" value="Submit" style="color: #999999; font-size: 8pt; font-family: Verdana; border: 1px solid #C0C0C0; background-color: #D9F0FB"/>
</td>
          </tr>
        </table>
</form>	</div>	<br />
<?php 
// $stdname=mysql_real_escape_string($_GET['stdname']);
  //  $query="SELECT id,stdid,stdname,hostel,gname 'Gardian Name' FROM tbl_stdinfo WHERE stdname like '%$_GET[stdname]%' and storedstatus<>'D' order by id asc";
    //$r=$myDb->select_one($query);
                //$sdq="select * from tbl_accchart where accname='$accname' AND storedstatus='I' OR storedstatus='U' order by id asc";
	//		    $sdep=$myDb->dump_query($query,'edit_stdinfo.php','del_std.php',$car['upd'],$car['delt']);

?>
          <table width="900" border="0" cellspacing="0" cellpadding="0" id="stdtbl">
            <tr>
              <td height="25" bgcolor="#0C6ED1" class="style15 style18">ID</td>
              <td height="25" bgcolor="#0C6ED1" class="style15 style18">Student ID </td>
              <td height="25" bgcolor="#0C6ED1" class="style15 style18">Student Name </td>
              <td height="25" bgcolor="#0C6ED1" class="style15 style18">Hostel</td>
              <td height="25" bgcolor="#0C6ED1" class="style15 style18">Gradian Name </td>
              <td height="25" colspan="3" align="center" bgcolor="#0C6ED1" class="style15 style18">Action</td>
            </tr>
			<?php $std="SELECT id,stdid,stdname,hostel,gname FROM tbl_stdinfo WHERE stdid like '%$_POST[stdid]%' and storedstatus<>'D' order by id asc";
			      $stdq=$myDb->select($std);
				  $count=0;
				  while($stdr=$myDb->get_row($stdq,'MYSQL_ASSOC')){
				  if($count%2==0){
				  $bgcolor="#FFFFFF";
				  ?>
            <tr bgcolor="<?php echo $bgcolor; ?>">
              <td height="25" class="style4"><?php echo $stdr['id']; ?></td>
              <td height="25" class="style4"><?php echo $stdr['stdid']; ?></td>
              <td height="25" class="style4"><?php echo $stdr['stdname']; ?></td>
              <td height="25" class="style4"><?php echo $stdr['hostel']; ?></td>
              <td height="25" class="style4"><?php echo $stdr['gname']; ?></td>
              <td height="25" align="center" class="style4"><a href="edit_stdinfo.php?id=<?php echo $stdr['id']; ?>">EDIT</a></td>
              <td height="25" align="center" class="style4"><a href="del_std.php?id=<?php echo $stdr['id']; ?>" onclick="javascript:return confirm('Do you really want to delete this record')">DELETE</a></td>
              <td align="center" class="style4"><a onclick="loadXMLDoc('<?php echo $stdr['id']; ?>','<?php echo $count; ?>')" id="aTag<?php echo $count; ?>" href="javascript:toggleAndChangeText(<?php echo $count; ?>);" >CLOSE EDUCATION &#9658</a> </td>
            </tr>
      <tr bgcolor="" id="tbl">
       <td colspan="12"><div id="myDiv<?php echo $count; ?>" style="width:800px;" align="center"></div></td>
      </tr>			<?php }else{ $bgcolor="#F7FCFF"; ?>
            <tr bgcolor="<?php echo $bgcolor; ?>">
              <td height="25" class="style4"><?php echo $stdr['id']; ?></td>
              <td height="25" class="style4"><?php echo $stdr['stdid']; ?></td>
              <td height="25" class="style4"><?php echo $stdr['stdname']; ?></td>
              <td height="25" class="style4"><?php echo $stdr['hostel']; ?></td>
              <td height="25" class="style4"><?php echo $stdr['gname']; ?></td>
              <td height="25" align="center" class="style4"><a href="edit_stdinfo.php?id=<?php echo $stdr['id']; ?>">EDIT</a></td>
              <td height="25" align="center" class="style4"><a href="del_std.php?id=<?php echo $stdr['id']; ?>" onclick="javascript:return confirm('Do you really want to delete this record')">DELETE</a></td>
              <td height="25" align="center" class="style4"><a onclick="loadXMLDoc('<?php echo $stdr['id']; ?>','<?php echo $count; ?>')" id="aTag<?php echo $count; ?>" href="javascript:toggleAndChangeText(<?php echo $count; ?>);" >CLOSE EDUCATION &#9658</a></td>
            </tr>
      <tr bgcolor="" id="tbl">
       <td colspan="12"><div id="myDiv<?php echo $count; ?>" style="width:800px;" align="center"></div></td>
      </tr>			<?php }
			  $count++;
			  ?>
			<?php } ?>
          </table>
          <p align="center">&nbsp;
            </p>
<p></p>
</td>
      </tr>
	        <tr>
        <td height="60" colspan="2" valign="middle" bgcolor="#D3F3FE"><?php include("bot.php"); ?></td>
        </tr>

    </table></td>
  </tr>
</table>
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
