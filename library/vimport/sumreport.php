<? session_start();
if(!$_SESSION[bpaddsesid]){
				include("adminlogin.php");
				}else{
				include("config.php");
				
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
                    <td bgcolor="#FFFFFF"><div align="center"><strong><font color="#006699" size="4">CALL SUMMERY REPORT </font></strong></div></td>
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
              <td colspan="8"> <form method="post" action="sumreport.php"> 
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
              <td width="20%" colspan="2">&nbsp;</td>
              <td colspan="4">&nbsp;</td>
            </tr>
			<?php if(isset($_POST['submit'])){ ?>
            <tr >
              <td bgcolor="#999999" class="style17" style="border:1px solid #999999;"><span class="style26">Total no of Calls: </span></td>
              <td align="left" bgcolor="#CCCCCC" style="border:1px solid #999999;">
			    <span class="style29">
			    <?php $a='"';
			        $totcall=mysql_query("SELECT count(*) as totalrow from expun WHERE DATE(replace(col1,'$a','')) between '$_POST[fdate]' and '$_POST[tdate]'");
			        $trf=mysql_fetch_array($totcall);
					echo $trf['totalrow'];
			  ?>
			    </span> </td>
              <td>&nbsp;</td>
              <td bgcolor="#999999" style="border:1px solid #999999;"><span class="style26">Successfull Calls:</span></td>
              <td  align="left" bgcolor="#CCCCCC" style="border:1px solid #999999;"> <span class="style29">
                <?php $totscall=mysql_query("SELECT count(*) as totalrow from expun where DATE(replace(col1,'$a','')) between '$_POST[fdate]' and '$_POST[tdate]' AND col6<>0");
			        $scf=mysql_fetch_array($totscall);
					echo $scf['totalrow'];
			  ?>
              </span></td>
              <td width="9%">&nbsp;</td>
              <td bgcolor="#999999" class="style24" style="border:1px solid #999999;"><span class="style26">Total Duration:</span></td>
              <td  align="left" bgcolor="#CCCCCC" style="border:1px solid #999999;"><span class="style29">
                <?php 	
          $sdq1="SELECT SUM(TIMEDIFF(FROM_UNIXTIME(`col7`),FROM_UNIXTIME(`col6`) ))/60 AS duration,SUM(TIMEDIFF(FROM_UNIXTIME(`col7`),FROM_UNIXTIME(`col6`) ))/60 AS acduration  FROM expun WHERE DATE(replace(col1,'$a','')) between '$_POST[fdate]' and '$_POST[tdate]' AND col6<>0 ";
 		  $totdu=mysql_query($sdq1);
				$todr=mysql_fetch_array($totdu);;
				echo round($todr['duration'],2);
		  ?>
              </span></td>
            </tr>
			
            <tr>
              <td style="border-bottom:1px solid #999999;">&nbsp;</td>
              <td style="border-bottom:1px solid #999999;">&nbsp;</td>
              <td colspan="2" style="border-bottom:1px solid #999999;">&nbsp;</td>
              <td style="border-bottom:1px solid #999999;">&nbsp;</td>
              <td colspan="2" style="border-bottom:1px solid #999999;">&nbsp;</td>
              <td style="border-bottom:1px solid #999999;">&nbsp;</td>
            </tr>
            <tr>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
              <td colspan="2">&nbsp;</td>
              <td>&nbsp;</td>
              <td colspan="2">&nbsp;</td>
              <td>&nbsp;</td>
            </tr>
            <tr>
              <td><span class="style18"></span></td>
              <td><span class="style18"></span></td>
              <td colspan="2"><span class="style18"></span></td>
              <td><span class="style18"></span></td>
              <td colspan="2"><span class="style18"></span></td>
              <td><span class="style18"></span></td>
            </tr>
            <tr>
              <td bgcolor="#999999" class="style24" style="border:1px solid #999999;"><span class="style26">ASR:</span></td>
              <td align="left" bgcolor="#CCCCCC" style="border:1px solid #999999;"><span class="style29">
                <?php $as=($scf['totalrow']*100/$trf['totalrow']); echo round($as,2)."%"; ?>
              </span></td>
              <td>&nbsp;</td>
              <td bgcolor="#999999" style="border:1px solid #999999;"><span class="style26" >ACD:</span></td>
              <td align="left" bgcolor="#CCCCCC" style="border:1px solid #999999;"><span class="style29">
                <?php $du=($todr['acduration']/$scf['totalrow']); echo round($du,2)."%"; ?>
              </span></td>
              <td colspan="2"><span class="style18"></span></td>
              <td><span class="style18"></span></td>
            </tr>
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
<? } ?>