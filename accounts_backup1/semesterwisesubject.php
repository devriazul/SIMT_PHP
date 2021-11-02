<?php 
ob_start();
session_start();
include("config.php"); 
if($myDb->connectDefaultServer())
{ 
  if($_SESSION['userid']){
  $chka="SELECT*FROM  tbl_accdtl WHERE flname='semesterwisesubject.php' AND userid='$_SESSION[userid]'";
  $caq=$myDb->select($chka);
  $car=$myDb->get_row($caq,'MYSQL_ASSOC');
  if($car['ins']=="y"){
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title><?php include("title.php");?></title>
<style type="text/css">
<!--
@import url("main.css");
.style15 {
	font-size: 12px;
	font-family: Verdana, Arial, Helvetica, sans-serif;
}
.style16 {font-size: 12px}

-->
</style>
<script language="javascript" src="sub_catagory.js"></script>
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

 <link rel="stylesheet" href="libs/style.css"/>
 <script src='libs/jquery.js' type="text/javascript"></script>

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
<p align="center" ><font face="Arial, Helvetica, sans-serif" size="2"><?php if($_GET['t']==1){ echo "<span style='color:#00CC00; font-weight:bold;'>".$_GET['msg']."</span>"; ?><?php } if($_GET['t']==0){ echo "<span style='color:#FF9900; font-weight:bold;'>".$_GET['msg']."</span>"; } ?></font></p>
 <div class="search-background1">
			<label><img src="load.gif" alt="" /></label>
	</div>
 <div id="news" class="tabcon">
	<h2 class="c2title">SEMESTER WISE ASSIGNED SUBJECT</h2><br/>
	
	<div id="resn"></div>
	<?php
	$sql1="select * from tbl_semesterwisesubj LIMIT 20";
	$result1=$myDb->select($sql1);
	?>
	
	<div id="pagesn">

		<?php
		 $query="select count(*) as tot from tbl_semesterwisesubj";
		  $countset=$myDb->select($query);
		  $count=$myDb->get_row($countset,'MYSQL_ASSOC');
		  $tot=$count['tot'];
		  $page=1;
		  $ipp=20;//items per page
		  $totalpages=ceil($tot/$ipp);
		  echo"<ul class='pages'>";
		  for($i=1;$i<=$totalpages; $i++)
		  {
			  echo"<li class='$i'>$i</li>";
		  }
		  echo"</ul>";
		?>


          <p align="center"><script type="text/javascript" src="ajax1.js"></script>

</p>
<p></p>	
</div>
</div>

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