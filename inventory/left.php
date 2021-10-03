<?php 
   $totalReq=0;
   $wreq=$myDb->select("SELECT distinct reqid FROM `tbl_buyproduct` WHERE pstatus='R'");
   while($wrf=$myDb->get_row($wreq,'MYSQL_ASSOC')){
     
	 $totalReq=$totalReq+1;
   }

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

<script language="javascript">
</script>
</head>

<body>
<?php if($_SESSION['userid']=="inventory"){ ?>
<label><h4>No Of Requisition (<?php echo $totalReq; ?>)</h4></label>
<?php } ?>
<?php 
																//$clat=mysql_query("SELECT cat.id as catid, cat.name as catname, scat.id as scatid, scat.name as scatname FROM `cat`,`scat` WHERE cat.id=scat.cid and cat.status='Active' and cat.position='Left' ") or die(mysql_error());
																$clat=mysql_query("SELECT id, name,user FROM `tbl_menucat` WHERE id in(select cid from tbl_menuscat) 
																                   and section='Inventory Management'
																				   and status='Active' ") or die(mysql_error());
																while($clfetch=mysql_fetch_array($clat)){
															?>
<table width="100" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td height="21"><span class="style2"><?php echo $clfetch['name']; ?></span></span></td>
  </tr>
  <tr>
    <td><img src="images/leftdivi.jpg" width="252" height="3" /></td>
  </tr>
  <tr>
    <td><?php $s1cat=mysql_query("SELECT a . *,m.name,m.url 
									FROM  `tbl_accdtl` a
									INNER JOIN tbl_menuscat m
									WHERE a.flname = m.url
									AND a.userid =  '$_SESSION[userid]'
									and m.cid='$clfetch[id]'
								") or die(mysql_error());
												while($s1fetch=mysql_fetch_array($s1cat)){
		  										?>       <table width="94%" border="0" align="center" cellpadding="0" cellspacing="0">
        <tr>
          <td width="10%"><div align="center">&raquo;</div></td>
          <td width="90%"><span class="style4"><a href="<?php echo $s1fetch['url'];?>" name="left"><?php echo $s1fetch['name'];?></a></span></td>
        </tr>
    </table>
    <?php } ?></td>
  </tr>
</table>
<?php }  ?>
</body>
</html>
