<?php 
ob_start();
session_start();
include("config1.php"); 
if($myDb->connectDefaultServer())
{ 

if($_SESSION[bpaddsesid]){
include("config1.php");
				
$fdate=$_POST['fdate'];
	$_SESSION['fdate']=$fdate;
	//$frdate=$_SESSION['fdate'];
	
	
	$tdate=$_POST['tdate'];
	$_SESSION['tdate']=$tdate;
	//$trdate=$_SESSION['tdate'];				
				
?>
 
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<title><?php include("title.php");?></title>
<link href="bpdc.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" href="libs/style.css"/>
 <script src='libs/jquery.js' type="text/javascript"></script>


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
  <style type="text/css">
<!--
.style4 {font-family: Calibri; font-size: small; }
-->
  </style>
</head>

<body>

<div align="center" > 
<? include("top.php")?>  <table width="100%"  border="0" cellspacing="0" cellpadding="0">
    <tr>
      <td width="24%" valign="top"><? include("left.php")?></td>
      <td width="2%">&nbsp;</td>
      <td width="74%" valign="top"><table width="100%" border="0" cellspacing="1" cellpadding="1">
                  <tr> 
                    <td bgcolor="#FFFFFF"><div align="center"><strong><font color="#006699" size="4"><?php echo $_GET['msg']; ?></font></strong></div></td>
                  </tr>
                  <tr> 
                    <td bgcolor="#FFFFFF"> <div align="center"><font color="#000000"><br>
                        </font></div></td>
                  </tr>
                </table>
        <form method="post" action="totalduration.php"> 
		<table width="99%" border="0" cellspacing="0" cellpadding="0" style="border:1px solid #999999; ">
          <tr>
            <td width="24%" height="30" align="right"><span class="style4">FROM DATE: </span></td>
            <td width="22%"><span class="style4">
              <label>
                <input type="text" name="fdate" id="DPC_fdate_YYYY-MM-DD"/>
              </label>
            </span></td>
            <td width="14%" align="right"><span class="style4">TO DATE: </span></td>
            <td width="40%"><span class="style4">
              <label>
                <input type="text" name="tdate" id="DPC_tdate_YYYY-MM-DD" />
                <input type="submit" name="submit" value="Submit">
              </label>
            </span></td>
          </tr>
        </table>
		</form>
        <p></p>
<div class="search-background1">
			<label><img src="load.gif" alt="" /></label>
	</div>
 <div id="news" class="tabcon"> 
	<h2 class="c2title">CDR TOTAL DURATION</h2><br/>
	
	<div id="resn"></div>
	<?php
	if(isset($_POST['submit'])){
	$a='"';
	$sql1="select * from  expun WHERE DATE(replace(col1,'$a','')) between '$_SESSION[fdate]' and '$_SESSION[tdate]' and `col6` <>0 LIMIT 20";
	$result1=$myDb->select($sql1);
	?>
	
	<div id="pagesn"> 

		<?php
		 $query="select count(*) as tot from expun WHERE DATE(replace(col1,'$a','')) between '$_SESSION[fdate]' and '$_SESSION[tdate]' and `col6` <>0";
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

</p>	</div>
</div>
		<?php } ?>	
        <div align="center" style="border:1px solid #666666; position:absolute; left: 953px; top: 650px; width: 268px; background-color: #CCCCCC; layer-background-color: #CCCCCC; font-family: Calibri; font-size: small; font-weight: bold;">Total Duration:<?php 		  
		  $sdq1="SELECT SUM(TIMEDIFF(FROM_UNIXTIME(`col7`),FROM_UNIXTIME(`col6`) ))/60 AS duration  FROM expun WHERE DATE(replace(col1,'$a','')) between '$_SESSION[fdate]' and '$_SESSION[tdate]' and `col6` <>0";
			    $tod=$myDb->select($sdq1);
				$todr=$myDb->get_row($tod,'MYSQL_ASSOC');
				echo round($todr['duration'],2);
		  ?></div>	  </td>
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