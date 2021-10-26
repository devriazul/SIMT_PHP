<?php ob_start();
session_start();
require_once('dbClass.php');
include("config.php"); 
if($myDb->connectDefaultServer())
{ 
  if($_SESSION['userid']){
  $chka="SELECT*FROM  tbl_accdtl WHERE flname='semesterwisesubject_search.php' AND userid='$_SESSION[userid]'";
  $caq=$myDb->select($chka);
  $car=$myDb->get_row($caq,'MYSQL_ASSOC');
  if(($car['ins']=="y")||($_SESSION['userid']=="administrator")){
  
  
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
 
 
 function showSelected(){
  document.myForm<?php echo $count; ?>.year.value = document.myForm<?php echo $count; ?>.select[document.myForm<?php echo $count; ?>.select.selectedIndex].value;
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
	     $('#aTag'+r).html('CLOSE &#9658');
     }
     else {                    
	 
	     $('#aTag'+r).html('VIEW &#9660');

     }
}


</script>
<script type="text/javascript" src="jquery-latest.js"></script>
  <script type="text/javascript" src="jquery.form.js"></script>
  <script type="text/javascript">
  $(document).ready(function() {
    $('#myForm').ajaxForm({
      target: '#showdata',
      success: function() {
	    $('#ani').show();
	    $('#ani').fadeIn(100).html('<img src="loader.gif" align="absmiddle">');
		$('#ani').hide();
        $('#showdata').show('slow');
      }
    });
  });
  </script>
  
  
<script src="semesterwisesubjectassaign.js" type="text/javascript"></script>

  

</head>

<body>
<table width="1047" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td width="1047" height="152" valign="top" background="images/1.jpg"><span class="style17"><?php include("topdefault.php");?>    </span></span></td>
  </tr>
  <tr>
    <td><table width="100%" border="0" cellspacing="0" cellpadding="0" id="tblleft">
      <tr>
        <td height="28" colspan="2" bgcolor="#0C6ED1"><div align="center" class="style1"><?php include("company.php"); ?></div></td>
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
<p align="center" id="msgerr" ><font face="Arial, Helvetica, sans-serif" size="2"><?php if(isset($_GET['msg'])){ echo $_GET['msg']; }?></font></p>

          <table width="99%" border="0" align="center" cellpadding="0" cellspacing="0" style="border-bottom:1px solid #999999;">
            <tr>
              <td class="formhead">SEMESTER WISE DEPARTMENT SUBJECT ASSAIGN </td>
            </tr>
          </table></br>
          <table width="700" border="0" align="center" cellpadding="0" cellspacing="0" class="gridTbl">
            <tr>
              <td width="53" height="25" bgcolor="#0C6ED1" class="style15 style18 gridTblHead">ID</td>
              <td width="214" height="25" bgcolor="#0C6ED1" class="style15 style18 gridTblHead">Name</td>
              <td width="243" height="25" bgcolor="#0C6ED1" class="style15 style18 gridTblHead">Description</td>
              <td height="25" align="center" bgcolor="#0C6ED1" class="style15 style18 gridTblHead">Action</td>
            </tr>
			<?php $std="SELECT id,name,description FROM tbl_semester WHERE storedstatus<>'D' order by id asc";
			      $stdq=$myDb->select($std);
				  $count=0;
				  while($stdr=$myDb->get_row($stdq,'MYSQL_ASSOC')){
			?>
            <tr>
              <td height="25" class="style4 gridTblValue"><?php echo $stdr['id']; ?></td>
              <td height="25" class="style4 gridTblValue"><?php echo $stdr['name']; ?></td>
              <td height="25" class="style4 gridTblValue"><?php echo $stdr['description']; ?></td>
              <td width="237" align="center" class="style4 gridTblValue"><a onclick="#" id="aTag<?php echo $count; ?>" href="javascript:toggleAndChangeText(<?php echo $count; ?>);" >CLOSE &#9658</a> </td>
            </tr>
      <tr bgcolor="" id="tbl">
       <td colspan="8">
	   <div id="myDiv<?php echo $count; ?>" style="display: none;width:800px;" align="center">
          <?php include("showin.php"); ?>
       </div>
	   </td>
      </tr>					<?php 
			  $count++;
			  $count=$count+1;
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
  header("Location:index.php");
}
}