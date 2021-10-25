<?php 
ob_start();
session_start();
require_once('dbClass.php');
include("config1.php"); 
if($myDb->connectDefaultServer())
{ 

if($_SESSION[bpaddsesid]){
include("config1.php");
				

?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<title>###</title>
<link href="bpdc.css" rel="stylesheet" type="text/css">
<style type="text/css">
<!--
.style17 {font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 12; font-weight:bold; }
.style18 {font-size: 12}
.style24 {font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 12px; font-weight: bold; }
.style26 {font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 12px; font-weight: bold; color: #FFFFFF; }
.style29 {font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 12; font-weight: bold; color: #000000; }
-->
</style>
<script type="text/javascript" src="datepickercontrol.js"></script>

<script type="text/javascript" src="datepicker.js"></script>
<script type="text/javascript" src="datepicker_dev.js"></script>
  <script language="JavaScript">
  if (navigator.platform.toString().toLowerCase().indexOf("linux") != -1){
	 	document.write('<link type="text/css" rel="stylesheet" href="datepickercontrol_lnx.css">');
	 }
	 else{
	 	document.write('<link type="text/css" rel="stylesheet" href="datepickercontrol.css">');
	 }

</script>
</head>

<body>

<div align="center" > 
<? include("top.php")?>  <table width="100%"  border="0" cellspacing="0" cellpadding="0">
    <tr>
      <td width="24%" valign="top"><? include("left.php")?></td>
      <td width="2%">&nbsp;</td>
      <td width="74%" valign="top">
<table width="850"  border="0" cellspacing="0" cellpadding="00">
        <tr>
          <td><div align="center">
                <table width="100%" border="0" cellspacing="1" cellpadding="1">
                  <tr> 
                    <td bgcolor="#FFFFFF"><div align="center"><strong><font color="#006699" size="4">OPERATOR WISE CALL SUMMERY REPORT </font></strong></div></td>
                  </tr>
                  <tr> 
                    <td bgcolor="#FFFFFF"> <div align="center"><font color="#000000"><br>
                        </font></div></td>
                  </tr>
                </table>
              </div></td>
        </tr>
        <tr>
          <td><table width="99%" border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td colspan="8"> <form method="post" action="operatorsummeryreport.php"> 
		<table width="99%" border="0" cellspacing="0" cellpadding="0" style="border:1px solid #999999;">
          <tr>
            <td width="29%" height="30" align="right">FROM DATE: </td>
            <td width="23%"><label>
              <input type="text" name="fdate" id="DPC_fdate_YYYY-MM-DD"/>
            </label></td>
            <td width="13%" align="right">TO DATE: </td>
            <td width="35%"><label>
              <input type="text" name="tdate" id="DPC_tdate_YYYY-MM-DD" />
              <input type="submit" name="submit" value="Submit">
            </label></td>
          </tr>
        </table>
		</form></td>
              </tr>
            <tr>
              <td width="14%">&nbsp;</td>
              <td width="16%">&nbsp;</td>
              <td width="20" colspan="2">&nbsp;</td>
              <td width="9" colspan="4">&nbsp;</td>
            </tr>
            <tr>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
              <td colspan="2">&nbsp;</td>
              <td colspan="4">&nbsp;</td>
            </tr>
			<?php if(isset($_POST['submit'])){ 
			$a='"';
			$opt="Select '017' as Operator, (SELECT COUNT(col11) as TotalCalls from expun Where col11 like '017%') TotalCalls, (SELECT COUNT(col11) as TotalCalls from expun Where col11 like '017%' and col6 <> '0') as TotalSuccessfullCalls, ifnull(ROUND((SELECT SUM( TIMEDIFF( FROM_UNIXTIME(`col7`) , FROM_UNIXTIME(`col6`) ) )/60  FROM expun WHERE col6 <>  '0' AND col11 LIKE  '017%'),2),0) AS TotalDuration, ROUND(((SELECT COUNT(col11) as TotalCalls from expun Where col11 like '017%' and col6 <> '0')* 100)/(SELECT COUNT(col11) as TotalCalls from expun Where col11 like '017%'),2) as ASR, ifnull(ROUND((SELECT SUM( TIMEDIFF( FROM_UNIXTIME(`col7`) , FROM_UNIXTIME(`col6`) ) )/60  FROM expun WHERE col6 <>  '0' AND col11 LIKE  '017%')/(SELECT COUNT(col11) as TotalCalls from expun Where col11 like '017%' and col6 <> '0'),2),0) as ACD From expun WHERE DATE(replace(col1,'$a','')) between '$_POST[fdate]' and '$_POST[tdate]'  Group By Operator
UNION
Select '018' as Operator, (SELECT COUNT(col11) as TotalCalls from expun Where col11 like '018%') TotalCalls, (SELECT COUNT(col11) as TotalCalls from expun Where col11 like '018%' and col6 <> '0') as TotalSuccessfullCalls, ifnull(ROUND((SELECT SUM( TIMEDIFF( FROM_UNIXTIME(`col7`) , FROM_UNIXTIME(`col6`) ) )/60  FROM expun WHERE col6 <>  '0' AND col11 LIKE  '018%'),2),0) AS TotalDuration, ROUND(((SELECT COUNT(col11) as TotalCalls from expun Where col11 like '018%' and col6 <> '0')* 100)/(SELECT COUNT(col11) as TotalCalls from expun Where col11 like '018%'),2) as ASR, ifnull(ROUND((SELECT SUM( TIMEDIFF( FROM_UNIXTIME(`col7`) , FROM_UNIXTIME(`col6`) ) )/60  FROM expun WHERE col6 <>  '0' AND col11 LIKE  '018%')/(SELECT COUNT(col11) as TotalCalls from expun Where col11 like '018%' and col6 <> '0'),2),0) as ACD From expun WHERE DATE(replace(col1,'$a','')) between '$_POST[fdate]' and '$_POST[tdate]' Group By Operator
UNION
Select '016' as Operator, (SELECT COUNT(col11) as TotalCalls from expun Where col11 like '016%') TotalCalls, (SELECT COUNT(col11) as TotalCalls from expun Where col11 like '016%' and col6 <> '0') as TotalSuccessfullCalls, ifnull(ROUND((SELECT SUM( TIMEDIFF( FROM_UNIXTIME(`col7`) , FROM_UNIXTIME(`col6`) ) )/60  FROM expun WHERE col6 <>  '0' AND col11 LIKE  '016%'),2),0) AS TotalDuration, ROUND(((SELECT COUNT(col11) as TotalCalls from expun Where col11 like '016%' and col6 <> '0')* 100)/(SELECT COUNT(col11) as TotalCalls from expun Where col11 like '016%'),2) as ASR, ifnull(ROUND((SELECT SUM( TIMEDIFF( FROM_UNIXTIME(`col7`) , FROM_UNIXTIME(`col6`) ) )/60  FROM expun WHERE col6 <>  '0' AND col11 LIKE  '016%')/(SELECT COUNT(col11) as TotalCalls from expun Where col11 like '016%' and col6 <> '0'),2),0) as ACD From expun WHERE DATE(replace(col1,'$a','')) between '$_POST[fdate]' and '$_POST[tdate]'  Group By Operator
UNION
Select '019' as Operator, (SELECT COUNT(col11) as TotalCalls from expun Where col11 like '019%') TotalCalls, (SELECT COUNT(col11) as TotalCalls from expun Where col11 like '019%' and col6 <> '0') as TotalSuccessfullCalls, ifnull(ROUND((SELECT SUM( TIMEDIFF( FROM_UNIXTIME(`col7`) , FROM_UNIXTIME(`col6`) ) )/60  FROM expun WHERE col6 <>  '0' AND col11 LIKE  '019%'),2),0) AS TotalDuration, ROUND(((SELECT COUNT(col11) as TotalCalls from expun Where col11 like '019%' and col6 <> '0')* 100)/(SELECT COUNT(col11) as TotalCalls from expun Where col11 like '019%'),2) as ASR, ifnull(ROUND((SELECT SUM( TIMEDIFF( FROM_UNIXTIME(`col7`) , FROM_UNIXTIME(`col6`) ) )/60  FROM expun WHERE col6 <>  '0' AND col11 LIKE  '019%')/(SELECT COUNT(col11) as TotalCalls from expun Where col11 like '019%' and col6 <> '0'),2),0) as ACD From expun WHERE DATE(replace(col1,'$a','')) between '$_POST[fdate]' and '$_POST[tdate]' Group By Operator
UNION
Select '015' as Operator, (SELECT COUNT(col11) as TotalCalls from expun Where col11 like '015%') TotalCalls, (SELECT COUNT(col11) as TotalCalls from expun Where col11 like '015%' and col6 <> '0') as TotalSuccessfullCalls, ifnull(ROUND((SELECT SUM( TIMEDIFF( FROM_UNIXTIME(`col7`) , FROM_UNIXTIME(`col6`) ) )/60  FROM expun WHERE col6 <>  '0' AND col11 LIKE  '015%'),2) ,0)AS TotalDuration, ROUND(((SELECT COUNT(col11) as TotalCalls from expun Where col11 like '015%' and col6 <> '0')* 100)/(SELECT COUNT(col11) as TotalCalls from expun Where col11 like '015%'),2) as ASR, ifnull(ROUND((SELECT SUM( TIMEDIFF( FROM_UNIXTIME(`col7`) , FROM_UNIXTIME(`col6`) ) )/60  FROM expun WHERE col6 <>  '0' AND col11 LIKE  '015%')/(SELECT COUNT(col11) as TotalCalls from expun Where col11 like '015%' and col6 <> '0'),2),0) as ACD From expun WHERE DATE(replace(col1,'$a','')) between '$_POST[fdate]' and '$_POST[tdate]' Group By Operator
UNION
Select '011' as Operator, (SELECT COUNT(col11) as TotalCalls from expun Where col11 like '011%') TotalCalls, (SELECT COUNT(col11) as TotalCalls from expun Where col11 like '011%' and col6 <> '0') as TotalSuccessfullCalls, ifnull(ROUND((SELECT SUM( TIMEDIFF( FROM_UNIXTIME(`col7`) , FROM_UNIXTIME(`col6`) ) )/60  FROM expun WHERE col6 <>  '0' AND col11 LIKE  '011%'),2),0) AS TotalDuration, ROUND(((SELECT COUNT(col11) as TotalCalls from expun Where col11 like '011%' and col6 <> '0')* 100)/(SELECT COUNT(col11) as TotalCalls from expun Where col11 like '011%'),2) as ASR, ifnull(ROUND((SELECT SUM( TIMEDIFF( FROM_UNIXTIME(`col7`) , FROM_UNIXTIME(`col6`) ) )/60  FROM expun WHERE col6 <>  '0' AND col11 LIKE  '011%')/(SELECT COUNT(col11) as TotalCalls from expun Where col11 like '011%' and col6 <> '0'),2),0) as ACD From expun WHERE DATE(replace(col1,'$a','')) between '$_POST[fdate]' and '$_POST[tdate]' Group By Operator
";
 $sdep=$myDb->dump_query($opt,'','','','');			
			?>
			
			
			<?php } ?>
          </table></td>
        </tr>
      </table></td>
    </tr>
  </table>
  <? include("bottom.php")?>
  <div align="left">  
    <div align="center">      </div>
  </div>
  <p align="left">&nbsp;    </p>
</div>
</body>
</html>
<?php

}else{
  header("Location:adminlogin.php");
}
}  
?>