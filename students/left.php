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
	//$clat=mysql_query("SELECT cat.id as catid, cat.name as catname, scat.id as scatid, scat.name as scatname FROM `cat`,`scat` WHERE cat.id=scat.cid and cat.status='Active' and cat.position='Left' ") or die(mysql_error());
	$clat=mysql_query("SELECT id, name FROM `tbl_menucat` WHERE id in(select cid from tbl_menuscat) and status='Active' and section='Students Portal' order by position ASC") or die(mysql_error());
	while($clfetch=mysql_fetch_array($clat)){
	?>
<table width="251" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td height="21"><span style="font:Calibri; color:#FF0000; font-size:14px; font-weight:bold; "><?php echo $clfetch['name']; ?></span></span></td>
  </tr>
  <tr>
    <td><?php $s1cat=mysql_query("select * from tbl_menuscat where cid='$clfetch[id]' AND status='Active' order by morder") or die(mysql_error());
												while($s1fetch=mysql_fetch_array($s1cat)){
		  										?>
      <table width="94%" height="26" border="0" align="center" cellpadding="0" cellspacing="0">
        <tr>
          <td><div align="left"></div>
              <span style="font:Calibri; color:#FF0000; font-size:12px; font-weight:bold; "><a href="<?php echo $s1fetch['url'];?>"><?php echo $s1fetch['name'];?></a></span></td>
        </tr>
      </table>      <?php } ?></td>
  </tr>
</table>
<?php }  ?>
</body>
</html>
