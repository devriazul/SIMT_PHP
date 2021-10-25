<?php ob_start();
session_start();
require_once('dbClass.php');
include("config.php"); 
if($myDb->connectDefaultServer())
{ 
	if($_SESSION['userid'])
	{
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title><?php include("title.php");?></title>
<style type="text/css">
<!--
@import url("main.css");
.style12 {font-size: 10px}
.style15 {
	font-size: 8px;
	font-family: Verdana, Arial, Helvetica, sans-serif;
}
.style16 {font-size: 10px}

-->
</style>
</head>

<body>
<table width="1047" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td width="1047" height="152" valign="top" background="images/1.jpg"><span class="style17"><?php include("topdefault.php");?>    </span></span></td>
  </tr>
  <tr>
    <td><table width="100%" border="0" cellspacing="0" cellpadding="0" id="tblleft">
      <tr>
        <td height="28" bgcolor="#0C6ED1"><div align="center" class="style1"><?php include("company.php"); ?></div></td>
        </tr>
      <tr>
        <td background=""><div align="center"><font face="Arial, Helvetica, sans-serif" size="2"><?php if(isset($_GET['t'])==0){ ?><span style="color:#FF6600; font-weight:bold;"><?php if(isset($_GET['msg'])){ echo $_GET['msg']; }?></span><?php } ?></font></div></td>
        </tr>
      <tr>
        <td valign="top" background="">
          <p style=" margin:0 auto; "><?php include_once("introtitle.php");?></p></br></br>

		    <div style="width:100%;  " align="center">
			 <?php 
				if($_SESSION['userid']=="administrator")
				{
			 		$accs=$myDb->select("select*from tbl_access where orderid!=0 order by orderid asc");
					while($accsf=$myDb->get_row($accs,'MYSQL_ASSOC'))
			 		{ ?>
			  		<div class="dash-grid"><div align="center"><a href="adminhome.php?accid=<?php echo $accsf['id'];?>"><img src="softadmin/dashboardimg/<?php echo $accsf['img']; ?>" width="124" height="116" /></a></div></br>
					<div align="center" ><span style="font:Verdana, Arial, Helvetica, sans-serif; font-size:11px; " ><a href="adminhome.php?accid=<?php echo $accsf['id'];?>"><?php echo $accsf['accname']; ?></a></span><br /></div>			  
					</div>
			  <?php } 
				}
				else
				{				
					$accs=$myDb->select("SELECT distinct a.* FROM `tbl_accdtl` ad inner join tbl_menuscat ms on ad.flname=ms.url inner join tbl_menucat m on ms.cid=m.id inner join tbl_access a on m.section=a.accname WHERE ad.userid='$_SESSION[userid]' and a.orderid!=0");
					while($accsf=$myDb->get_row($accs,'MYSQL_ASSOC'))
			 		{?>
			  		<div class="dash-grid"><div align="center"><a href="adminhome.php?accid=<?php echo $accsf['id'];?>"><img src="softadmin/dashboardimg/<?php echo $accsf['img']; ?>" width="124" height="116" /></a></div></br>
					<div align="center" ><span style="font:Verdana, Arial, Helvetica, sans-serif; font-size:11px; " ><a href="adminhome.php?accid=<?php echo $accsf['id'];?>"><?php echo $accsf['accname']; ?></a></span><br /></div>			  
					</div>
			  <?php } 
				}
			 	?>	
			     
		   
		   
		   
		   </div>
		  
		  
		           <p>&nbsp;</p></td></tr>
      <tr>
        <td height="60" valign="middle" bgcolor="#D3F3FE"><?php include("bot.php"); ?></td>
        </tr>
    </table></td>
  </tr>
</table>
</body>
</html>
<?php 
}else{
  header("Location:login.php");
}
}  
?>
