<?php ob_start();
session_start();
require_once('dbClass.php');
include("config.php"); 
if($myDb->connect($host,$user,$pwd,$db,true))
{ 
	if($_SESSION['userid']){
  	$vs="SELECT s.id, s.stdname, s.stdid, s.password, s.session, d.name as Department, b.batchname as Batch, sm.name as Semester, s.fname, s.mname, s.nationality, s.praddress, s.peraddress, s.phone, s.sexstatus, s.dob, s.bgroup, s.religion, s.img FROM `tbl_stdinfo` s inner join tbl_department d on s.deptname=d.id inner join tbl_batch b on s.batch=b.id inner join tbl_semester sm on s.semester=sm.id WHERE s.storedstatus<>'D' and s.stdid='$_SESSION[userid]'";
  	$r=$myDb->select($vs);
  	$row=$myDb->get_row($r,'MYSQL_ASSOC');

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title><?php include("title.php");?></title>
<link href="css.css" rel="stylesheet" type="text/css" />
<style type="text/css">
<!--
body {

	margin-left: 0px;
	margin-top: 0px;
	margin-right: 0px;
	margin-bottom: 0px;
}
.style1 {
	color: #999999;
	font-weight: bold;
}
#Layer1 {
	position:absolute;
	left:118px;
	top:70px;
	width:123px;
	height:21px;
	z-index:1;
}
.style2 {
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size: 12px;
}
.style3 {color: #082F5A}
.style4 {
	font-family: Arial, Helvetica, sans-serif;
	font-size: 10px;
}
.style7 {
	color: #FFFFFF;
	font-family: Calibri;
	font-size: x-small;
}
.style14 {
	color: #FFFFFF;
	font-weight: bold;
}
.style16 {color: #FFFFFF}
-->
</style></head>

<body>
<div class="style2" id="Layer1">
  <div align="center" class="style3">Ver : 1.0.0.1 </div>
</div>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="5%" valign="top" background="images/leftinbg.jpg"><table width="100" border="0" cellpadding="0" cellspacing="0">
      <tr>
        <td width="5%"><img src="images/topleft.jpg" width="265" height="113" /></td>
      </tr>
      <tr>
        <td background="images/leftinbg.jpg"><img src="images/leftinbg.jpg" width="265" height="3" /></td>
      </tr>
      <tr>
        <td background="images/leftinbg.jpg" class="Jlink"><table width="254" border="0" align="center" cellpadding="0" cellspacing="0">
            <tr>
              <td><?php include("left.php"); ?></td>
            </tr>
          </table>
          <p>&nbsp;</p>
          <p>&nbsp;</p>
          <p>&nbsp;</p>
          <p>&nbsp;</p>
          <p>&nbsp;</p>
          <p>&nbsp;</p>
          <p>&nbsp;</p>
          <p>&nbsp;</p></td>
      </tr>
    </table></td>
    <td width="95%" valign="top" bgcolor="#FFFFFF" style="background-image: url(images/botbg.jpg); background-repeat: no-repeat; background-position: bottom;"><table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td background="images/topbarbg.jpg"><table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td width="1%"><img src="images/topbarbg.jpg" width="3" height="44" /></td>
            <td width="99%"><div align="center" class="style1" ><font face="verdana" size="5">S t u d e n t &nbsp;W e b &nbsp;P a n e l</font></div></td>
          </tr>
        </table></td>
      </tr>
      <tr>
        <td><table width="99%" border="0" align="center" cellpadding="0" cellspacing="2" id="stdtbl">
            <tr>
              <td height="20" class="style2" style="padding:3px; border-bottom:1px solid #CCCCCC;">BILLING INFORMATION</td>
            </tr>
            <tr>
              <td height="20" class="style2"><table width="100%"  border="0" align="center" cellpadding="2" cellspacing="1" class="Vlink">
                <tr bgcolor="#F0F0FF">
                  <td width="14%" height="26" bgcolor="#DFF4FF"><div align="center" >
                    <div align="left"><font face="Verdana, Arial, Helvetica, sans-serif" size="2">Transaction Date </font></div>
                  </div></td>
                  <td width="20%" bgcolor="#DFF4FF"><div align="center" >
                    <div align="left"><font face="Verdana, Arial, Helvetica, sans-serif" size="2">Particulars</font></div>
                  </div></td>
                  <td width="13%" bgcolor="#DFF4FF"><div align="center" >
                    <div align="right"><font face="Verdana, Arial, Helvetica, sans-serif" size="2">Bill Amount </font></div>
                  </div></td>
                  <td width="12%" bgcolor="#DFF4FF"><div align="center" >
                    <div align="right"><font face="Verdana, Arial, Helvetica, sans-serif" size="2">Paid Amount </font></div>
                  </div></td>
                </tr>
                <?php $us=mysql_query("Select sj.vdate, sj.accname, sj.amountcr, sj.amountdr from tbl_2ndjournal sj inner join tbl_accchart ac on sj.masteraccno=ac.id inner join tbl_stdinfo s on ac.stdid=s.id Where s.stdid= '$_SESSION[userid]' order by sj.id") or die(mysql_error());
			  //Union SELECT t_transcation.id, t_transcation.description, t_transcation.tdate,t_clients.name,t_clients.currencytype,t_transcation.type,t_transcation.rate,t_transcation.amount,t_transcation.totalamount from t_transcation,t_clients where t_transcation.clientid=t_clients.id and t_transcation.clientid='$_POST[client]' and t_transcation.tdate between '$_POST[frmdate]' and '$_POST[todate]' and t_transcation.clientid='$_POST[client]' and t_transcation.type='Receive Load' and t_transcation.cid='$_SESSION[cid]' and t_transcation.uid='$_SESSION[uid]'  order by t_transcation.id") or die(mysql_error());
				
				$count=0;
				while($usfetch=mysql_fetch_array($us)){
				if(($count%2)==0){
				$bgcolor="#ffffff";
				?>
                <tr bgcolor="<?php echo $bgcolor; ?>">
                  <td><div align="left"><font face="Verdana, Arial, Helvetica, sans-serif" size="1"><?php echo $usfetch['vdate']; ?></font></div></td>
                  <td><div align="left"><font face="Verdana, Arial, Helvetica, sans-serif" size="1"><?php echo $usfetch['accname']; ?></font></div></td>
                  <td><div align="right"><font face="Verdana, Arial, Helvetica, sans-serif" size="1"><?php echo number_format($usfetch['amountcr'],2); ?></font></div></td>
                  <td height="21"><div align="right"><font face="Verdana, Arial, Helvetica, sans-serif" size="1"><?php echo number_format($usfetch['amountdr'],2); ?></font></div></td>
                 </tr>
                <?php }else{
				$bgcolor="#F0F0FF";
				?>
                <tr bgcolor="<?php echo $bgcolor; ?>">
                  <td><div align="left"><font face="Verdana, Arial, Helvetica, sans-serif" size="1"><?php echo $usfetch['vdate']; ?></font></div></td>
                  <td><div align="left"><font face="Verdana, Arial, Helvetica, sans-serif" size="1"><?php echo $usfetch['accname']; ?></font></div></td>
                  <td><div align="right"><font face="Verdana, Arial, Helvetica, sans-serif" size="1"><?php echo number_format($usfetch['amountcr'],2); ?></font></div></td>
                  <td height="21"><div align="right"><font face="Verdana, Arial, Helvetica, sans-serif" size="1"><?php echo number_format($usfetch['amountdr'],2); ?></font></div></td>
                </tr>
                <?php }
				$count++;
				}
				?>
                <tr bgcolor="#A3A3A3" >
                  <td>&nbsp;</td>
                  <td><div align="right" class="style16" ><font face="Verdana, Arial, Helvetica, sans-serif" size="2">Total : </font></div></td>
                  <td><div align="right" class="style16" ><font face="Verdana, Arial, Helvetica, sans-serif" size="1"> <font face="Verdana, Arial, Helvetica, sans-serif" size="2"><strong>
                        <?php $nw=mysql_query("Select SUM(sj.amountcr) as TotalCr from tbl_2ndjournal sj inner join tbl_accchart ac on sj.masteraccno=ac.id inner join tbl_stdinfo s on ac.stdid=s.id Where s.stdid= '$_SESSION[userid]'") or die(mysql_error());
					$nwfetch=mysql_fetch_array($nw);
					$totalbill=($nwfetch['TotalCr']);
					echo number_format($totalbill,2);

				?>
                  </strong></font> </font></div></td>
                  <td height="21"><div align="right" class="style16" ><font face="Verdana, Arial, Helvetica, sans-serif" size="2"><strong>
                        <?php $nw=mysql_query("Select SUM(sj.amountdr) as TotalDr from tbl_2ndjournal sj inner join tbl_accchart ac on sj.masteraccno=ac.id inner join tbl_stdinfo s on ac.stdid=s.id Where s.stdid= '$_SESSION[userid]'") or die(mysql_error());
					$nwfetch=mysql_fetch_array($nw);
					$totalreceive=($nwfetch['TotalDr']);
					echo number_format($totalreceive,2); ?>
                  </strong></font></div></td>
                </tr>
                <tr bgcolor="#BFE2E6" >
                  <td bgcolor="#DFF4FF">&nbsp;</td>
                  <td bgcolor="#DFF4FF"><div align="right" ><font face="Verdana, Arial, Helvetica, sans-serif" size="2">Balance :</font></div></td>
                  <td height="21" colspan="2" bgcolor="#DFF4FF"><div align="center"> <font face="Verdana, Arial, Helvetica, sans-serif" size="1" color="#000099"><strong> </strong></font> </div>
                      <strong>
                      <div align="center"><font face="Verdana, Arial, Helvetica, sans-serif" size="2" color="#FF0000"><strong>
                        <?php //echo (number_format($treceive,2)- number_format($BillAmount,2)); 
				//echo number_format($dtreceive-$wtreceive,2);
				echo number_format($totalbill-$totalreceive,2);
				?>
                      </strong></font> </div>
                    </strong></td>
                </tr>
              </table></td>
              </tr>
          </table>
          <p class="style4">&nbsp;</p>
          <p class="style4">&nbsp;</p>
          <p class="style4">&nbsp;</p>
          <p>&nbsp;</p>
          <p>&nbsp;</p>
          <p>&nbsp;</p>
          <p>&nbsp;</p></td>
      </tr>

    </table></td>
  </tr>
  <tr>
    <td colspan="2" background="images/bbg.jpg"><table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td width="1%"><img src="images/bbg.jpg" width="3" height="44" /></td>
        <td width="99%"><div align="center" class="style7">© Copyright All Rights Reserved. Powered By: DesktopBD</div></td>
      </tr>
    </table></td>
  </tr>
</table>
</body>
</html>
<?php 
}else{
  header("Location:index.php");
	echo "sorry! u did mistake. please check corresponding.";
}
}  
?>
