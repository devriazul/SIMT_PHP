<?php //ob_start();
//session_start();
if(!empty($_GET['accid']))
{
	$_SESSION['accid']=$_GET['accid'];
}
//echo $_SESSION['accid']; exit; 
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title></title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link href="main.css" rel="stylesheet" type="text/css">
<style type="text/css">
<!--
.style6 {
	font-family: SolaimanLipi;
	font-size: 20px;
}
-->
</style>
</head>

<body>
<?php 
			//--------Original----------
			//$clat=mysql_query("SELECT id, name,user FROM `tbl_menucat` WHERE id in(select cid from tbl_menuscat) and status='Active' and section='Administrator'") or die(mysql_error());
			//echo $clat="SELECT distinct mn.id, mn.name FROM tbl_menuscat m INNER JOIN tbl_accdtl a ON m.url = a.flname INNER JOIN tbl_menucat mn ON m.cid = mn.id inner join tbl_access acc on mn.section=acc.accname WHERE mn.id in(select cid from tbl_menuscat) and mn.status='Active' and acc.id='$_SESSION[accid]' and a.userid='$_SESSION[userid]'"; exit;
			if($_SESSION['accid']=='41')
			{
				$clat=mysql_query("SELECT distinct mn.id, mn.name FROM tbl_menuscat m INNER JOIN tbl_accdtl a ON m.url = a.flname INNER JOIN tbl_menucat mn ON m.cid = mn.id inner join tbl_access acc on mn.section=acc.accname WHERE mn.id in(select cid from tbl_menuscat) and mn.status='Active' and acc.id='$_SESSION[accid]' ") or die(mysql_error());
			}
			else
			{
				$clat=mysql_query("SELECT distinct mn.id, mn.name FROM tbl_menuscat m INNER JOIN tbl_accdtl a ON m.url = a.flname INNER JOIN tbl_menucat mn ON m.cid = mn.id inner join tbl_access acc on mn.section=acc.accname WHERE mn.id in(select cid from tbl_menuscat) and mn.status='Active' and acc.id='$_SESSION[accid]' and a.userid='$_SESSION[userid]'") or die(mysql_error());
			}
			//------prev-------                                        
			//$clat=mysql_query("SELECT distinct mn.id, mn.name FROM tbl_menuscat m INNER JOIN tbl_accdtl a ON m.url = a.flname INNER JOIN tbl_menucat mn ON m.cid = mn.id WHERE mn.id in(select cid from tbl_menuscat) and mn.status='Active' and mn.section='Administrator' and a.userid='$_SESSION[userid]'") or die(mysql_error());
			
			while($clfetch=mysql_fetch_array($clat)){
			//if($_SESSION[userid]=='administrator'){
			?>
<table width="100" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td height="21"><span class="style2"><?php echo $clfetch['name']; ?></span></span></td>
  </tr>
  <tr>
    <td><img src="images/leftdivi.jpg" width="252" height="3" /></td>
  </tr>
  <tr>
    <td><?php 
			//--------Original---------
			//$s1cat=mysql_query("select * from tbl_menuscat where cid='$clfetch[id]' AND status='Active' Order by morder") or die(mysql_error());
			//echo $s1cat="select m.* From tbl_menuscat m inner join tbl_accdtl a on m.url=a.flname inner join tbl_menucat mn on m.cid=mn.id where m.cid='$clfetch[id]' AND m.status='Active' AND a.userid='$_SESSION[userid]' Order by morder"; exit;
			
			if($_SESSION['accid']=='41')
			{
				$s1cat=mysql_query("select distinct m.*,acc.id as accid From tbl_menuscat m inner join tbl_accdtl a on m.url=a.flname inner join tbl_menucat mn on m.cid=mn.id inner join tbl_access acc on mn.section=acc.accname where m.cid='$clfetch[id]' AND m.status='Active' Order by morder") or die(mysql_error());
			}
			else
			{
				$s1cat=mysql_query("select m.*,acc.id as accid From tbl_menuscat m inner join tbl_accdtl a on m.url=a.flname inner join tbl_menucat mn on m.cid=mn.id inner join tbl_access acc on mn.section=acc.accname where m.cid='$clfetch[id]' AND m.status='Active' AND a.userid='$_SESSION[userid]' Order by morder") or die(mysql_error());
			}
			
			
			while($s1fetch=mysql_fetch_array($s1cat)){
		  	?>      <table width="94%" border="0" align="center" cellpadding="0" cellspacing="0">
        <tr>
          <td width="10%"><div align="center">&raquo;</div></td>
          <td width="90%"><span class="style4"><?php if($s1fetch['accid']=='39'){?><a href="library/<?php echo $s1fetch['url'];?>"><?php echo $s1fetch['name'];?></a><?php }else if($_SESSION['accid']=='40'){?><a href="inventory/<?php echo $s1fetch['url'];?>"><?php echo $s1fetch['name'];?></a><?php }else if($_SESSION['accid']=='2'){?><a href="accounts/<?php echo $s1fetch['url'];?>"><?php echo $s1fetch['name'];?></a><?php }else if($_SESSION['accid']=='37'){?><a href="teacher/<?php echo $s1fetch['url'];?>"><?php echo $s1fetch['name'];?></a><?php }else if($_SESSION['accid']=='51'){?><a href="schedule/<?php echo $s1fetch['url'];?>"><?php echo $s1fetch['name'];?></a><?php }else if($_SESSION['accid']=='38'){?><a href="students/<?php echo $s1fetch['url'];?>"><?php echo $s1fetch['name'];?></a><?php }else{?><a href="<?php echo $s1fetch['url'];?>"><?php echo $s1fetch['name'];?></a><?php }?> </span></td>
        </tr>
    </table>
    <?php } ?></td>
  </tr>
</table>
<?php }  ?>
</body>
</html>
