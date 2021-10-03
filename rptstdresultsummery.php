<?php ob_start();
session_start();
require_once('dbClass.php');
include("config.php"); 
if($myDb->connect($host,$user,$pwd,$db,true))
{ 
	if($_SESSION['userid']){
	
	       
			$dp= "Select d.name as department from tbl_department d where d.id='$_POST[deptid]' ";
			$fdp=$myDb->select($dp);
			$qdp=$myDb->get_row($fdp,'MYSQL_ASSOC');


			$sn= "Select s.name as semestername from tbl_semester s where s.id='$_POST[semesterid]' ";
			$fsn=$myDb->select($sn);
			$qsn=$myDb->get_row($fsn,'MYSQL_ASSOC');

			   
			   
			// Find Passed Students  
  			$crsps="SELECT s.boardrollno, spi.cgpa  FROM tbl_stdinfo s inner join tbl_stdpassinfo spi on s.stdid=spi.stdid WHERE spi.deptid='$_POST[deptid]' and spi.semesterid='$_POST[semesterid]' and spi.session='$_POST[session]' and spi.year='$_POST[year]'";  				  
			$crqps=$myDb->select($crsps); 
			$count=0; $i=1; 
			
			
			
			
			// Find Referred Students  
  			$crsrs="SELECT s.boardrollno, rf.coursecode  FROM tbl_stdinfo s inner join tbl_reffinalforsummery rf on s.stdid=rf.stdid WHERE rf.deptid='$_POST[deptid]' and rf.semesterid='$_POST[semesterid]' and rf.session='$_POST[session]' and rf.year='$_POST[year]' and rf.totalfailed <= 3"; 
			$crqrs=$myDb->select($crsrs); 
			$count1=0; $j=0; 

			// Find Failed Students  
  			$crsfs="SELECT s.boardrollno, rf.coursecode, rf.totalfailed  FROM tbl_stdinfo s inner join tbl_reffinalforsummery rf on s.stdid=rf.stdid WHERE rf.deptid='$_POST[deptid]' and rf.semesterid='$_POST[semesterid]' and rf.session='$_POST[session]' and rf.year='$_POST[year]' and rf.totalfailed > 3";
			$crqfs=$myDb->select($crsfs); 
			$count2=0; $k=1;
  			
				

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title><?php include("title.php");?></title>
<style type="text/css">
<!--
body {

	margin-left: 0px;
	margin-top: 0px;
	margin-right: 0px;
	margin-bottom: 0px;
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
	font-size: 10px;
}
.style4 {
	font-family: Arial, Helvetica, sans-serif;
	font-size: 10px;
}
.style5 {font-weight: bold}
.style17 {font-size: 12px}
.style18 {
	color: #FFFFFF;
	font-weight: bold;
}
.style20 {color: #FFFFFF}
.style21 {
	font-size: 12px;
	font-weight: bold;
}
.style22 {font-size:16px; color: #999999;}
-->
</style></head>

<body>
<table width="90%" border="0" align="center" cellpadding="0" cellspacing="0" id="tblleft">
  <tr>
    <td height="28" bgcolor="#FFFFFF">&nbsp;</td>
  </tr>
  <tr>
    <td height="28" bgcolor="#FFFFFF"><div align="center" class="style5"><?php include("rptheader.php");?></div></td>
  </tr>
  <tr>
    <td><img src="images/spaer.gif" width="1" height="1" /></td>
  </tr>
  <tr>
    <td valign="top">&nbsp;</td>
  </tr>
  <tr>
    <td valign="top"><div align="center"><strong><span style="color:#999999; text-decoration:underline; font-size:18px; ">Student Result Summery: Year- <?php echo $_POST['year'];?></span></strong></div></td>
  </tr>
  <tr>
    <td valign="top"><div align="center" class="style22">Department Name: <?php echo $qdp['department'];?></div></td>
  </tr>
  <tr>
    <td valign="top"><div align="center" class="style22">Semester Name: <?php echo $qsn['semestername']. " (Session: ".$_POST['session'].")" ;?></div></td>
  </tr>
  <tr>
    <td valign="top">&nbsp;</td>
  </tr>
  <tr>
    <td width="79%" valign="top">
	<div align="left"></div>
	<table width="90%" border="1" align="center" cellpadding="2" cellspacing="0">
        <tr bgcolor="#009A00" class="record">
          <td height="30" colspan="6" ><div align="left"><span class="style17 style2"><span class="style18">Passed Students Lists</span></span></div></td>
        </tr>
		<tr bgcolor="#DFF4FF">
            <td>
				<div align="center">
				  <table width="100%" border="0" cellspacing="0" cellpadding="3" style="border:1px solid #e7e7e7; ">
					<tr>
					  <td width="128" valign="top"><span style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:12px; font-weight:bold; color:#666666; " >Board Roll</span></td>
					  <td width="70"><span style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:12px; font-weight:bold; color:#666666; " ></span>                      <span style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:10px; color:#666666;  " >CGPA</span></td>
					</tr>
				  </table>
				</div>
				<div align="center"></div>
			</td>
            <td>
				<div align="center">
				  <table width="100%" border="0" cellspacing="0" cellpadding="3" style="border:1px solid #e7e7e7; ">
					<tr>
					  <td width="128" valign="top"><span style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:12px; font-weight:bold; color:#666666; " >Board Roll</span></td>
					  <td width="70"><span style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:12px; font-weight:bold; color:#666666; " ></span>                      <span style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:10px; color:#666666;  " >CGPA</span></td>
					</tr>
				  </table>
				</div>
				<div align="center"></div>
			</td>
            <td>
				<div align="center">
				  <table width="100%" border="0" cellspacing="0" cellpadding="3" style="border:1px solid #e7e7e7; ">
					<tr>
					  <td width="128" valign="top"><span style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:12px; font-weight:bold; color:#666666; " >Board Roll</span></td>
					  <td width="70"><span style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:12px; font-weight:bold; color:#666666; " ></span>                      <span style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:10px; color:#666666;  " >CGPA</span></td>
					</tr>
				  </table>
				</div>
				<div align="center"></div>
			</td>
            <td>
				<div align="center">
				  <table width="100%" border="0" cellspacing="0" cellpadding="3" style="border:1px solid #e7e7e7; ">
					<tr>
					  <td width="128" valign="top"><span style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:12px; font-weight:bold; color:#666666; " >Board Roll</span></td>
					  <td width="70"><span style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:12px; font-weight:bold; color:#666666; " ></span>                      <span style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:10px; color:#666666;  " >CGPA</span></td>
					</tr>
				  </table>
				</div>
				<div align="center"></div>
			</td>
            <td>
				<div align="center">
				  <table width="100%" border="0" cellspacing="0" cellpadding="3" style="border:1px solid #e7e7e7; ">
					<tr>
					  <td width="128" valign="top"><span style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:12px; font-weight:bold; color:#666666; " >Board Roll</span></td>
					  <td width="70"><span style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:12px; font-weight:bold; color:#666666; " ></span>                      <span style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:10px; color:#666666;  " >CGPA</span></td>
					</tr>
				  </table>
				</div>
				<div align="center"></div>
			</td>			


         </tr>
		 <?php $t=0;
					 //echo "SELECT s.boardrollno, spi.cgpa  FROM tbl_stdinfo s inner join tbl_stdpassinfo spi on s.stdid=spi.stdid WHERE spi.deptid='$_POST[deptid]' and spi.semesterid='$_POST[semesterid]' and spi.session='$_POST[session]' and spi.year='$_POST[year]'";
							$pro=mysql_query("SELECT s.boardrollno, spi.cgpa  FROM tbl_stdinfo s inner join tbl_stdpassinfo spi on s.stdid=spi.stdid WHERE spi.deptid='$_POST[deptid]' and spi.semesterid='$_POST[semesterid]' and spi.session='$_POST[session]' and spi.year='$_POST[year]' group by boardrollno") or die(mysql_error());					  
					  
									$nrow=5;
									$h=0;
									while($pfetch=mysql_fetch_array($pro)){
									if($t==$nrow){
		?>
        <tr class="record">
            <td ><div align="center">
              <table width="100%" border="0" cellspacing="0" cellpadding="3" style="border:1px solid #e7e7e7; ">
                <tr>
                  <td width="128" valign="top"><span style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:11px; font-weight:bold; color:#666666; " ><?php echo $pfetch['boardrollno'];?></span></td>
                  <td width="70"><span style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:11px; font-weight:bold; color:#666666; " ></span>                      <span style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:10px; color:#666666;  " ><?php echo round($pfetch['cgpa'],2);?></span></td>
                </tr>
              </table>
            </div>
              <div align="center"></div>
			</td>
          <?php $t=1; }else{ ?>
          <td><div align="center">
              <table width="100%" border="0" cellspacing="0" cellpadding="3" style="border:1px solid #e7e7e7; ">
                <tr>
                  <td width="115" valign="top"><span style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:11px;  color:#666666;font-weight:bold; " ><?php echo $pfetch['boardrollno'];?></span></td>
                  <td width="71"><span style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:11px;  color:#666666; " ></span>                      <span style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:11px;  color:#666666; " ><?php echo round($pfetch['cgpa'],2);?></span></td>
                </tr>
              </table>
			  
            </div>
              <div align="center"></div></td>
          <?php 
									$t++;
									}
								$h++;}
							?>
        </tr>
		<tr >
           <td colspan="5" style="text-align:left; font-weight:bold; font-family:Verdana, Arial, Helvetica, sans-serif; padding:5px; font-size:12px; border:1; width:100%;">Total No of Passed Students=<?php echo $h; ?></td>
        </tr>

      </table>
      <p>&nbsp;</p>
      <table width="90%" height="88" border="1" align="center" cellpadding="1" cellspacing="0" bordercolor="#666666" id="stdtbl">
         <tr bgcolor="#003366">
           <td height="25" colspan=6" class="style2"><span class="style17 style2 style20"><strong>Referred Students Lists</strong></span></td>
         </tr>
         <tr bgcolor="#DFF4FF">
           <td style="width:11%;" height="25" class="style2"><strong>Board Roll No </strong></td>
           <td style="width:20%;" class="style2"><strong>Ref. Sub </strong></td>
		   <td style="width:11%;" height="25" class="style2"><strong>Board Roll No </strong></td>
           <td style="width:20%;" class="style2"><strong>Ref. Sub </strong></td>
		   <td style="width:11%;" height="25" class="style2"><strong>Board Roll No </strong></td>
           <td style="width:20%;" class="style2"><strong>Ref. Sub </strong></td>


         </tr>
         <tr bgcolor="#FFFFFF">
           <td class="style4" colspan="6">
		   <div style="width:100%; overflow:hidden; ">
		    <?php while($crf=$myDb->get_row($crqrs,'MYSQL_ASSOC')){
			?>
		     <div style="width:11%; float:left; border:1px solid #ccc; padding:3px; "><?php echo $crf['boardrollno'];?></div> 
			 <div style="width:20.5%; float:left; border:1px solid #ccc; padding:3px; "><?php echo $crf['coursecode'];?></div> 
			 <?php $j++;} ?>
		   </div>
		   
		   </td>
        
         </tr>
		 <tr>
		   <td colspan="6" style="text-align:left; font-weight:bold; font-family:Verdana, Arial, Helvetica, sans-serif; padding:5px; font-size:12px;">Total No of Referred Students=<?php echo $j; ?></td>
		   <!--td colspan="2" style="text-align:left; font-weight:bold; font-family:Verdana, Arial, Helvetica, sans-serif; padding:5px; font-size:12px;"><?php echo $j; ?></td-->
		 </tr>
      </table>
	  <p>&nbsp;</p>
       <table width="90%" border="1" align="center" cellpadding="1" cellspacing="0" style="margin:40px auto 20px auto; ">
			  
	   <tr bgcolor="#FF0000" class="record">
          <td height="30" colspan="6" ><div align="left"><span class="style17 style2"><span class="style18">Failed Students Lists</span></span></div></td>
        </tr>
		<tr>
			<td>
				<div align="center">
				  <table width="100%" border="0" cellspacing="0" cellpadding="3" style="border:1px solid #e7e7e7; ">
					<tr>
					  <td valign="top"><div align="center"><span style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:12px; font-weight:bold; color:#666666; " >Board Roll</span></div></td>
					</tr>
				  </table>
				</div>
				<div align="center"></div>
			</td>
			<td>
				<div align="center">
				  <table width="100%" border="0" cellspacing="0" cellpadding="3" style="border:1px solid #e7e7e7; ">
					<tr>
					  <td valign="top"><div align="center"><span style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:12px; font-weight:bold; color:#666666; " >Board Roll</span></div></td>
					</tr>
				  </table>
				</div>
				<div align="center"></div>
			</td>
			<td>
				<div align="center">
				  <table width="100%" border="0" cellspacing="0" cellpadding="3" style="border:1px solid #e7e7e7; ">
					<tr>
					  <td valign="top"><div align="center"><span style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:12px; font-weight:bold; color:#666666; " >Board Roll</span></div></td>
					</tr>
				  </table>
				</div>
				<div align="center"></div>
			</td>
			<td>
				<div align="center">
				  <table width="100%" border="0" cellspacing="0" cellpadding="3" style="border:1px solid #e7e7e7; ">
					<tr>
					  <td valign="top"><div align="center"><span style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:12px; font-weight:bold; color:#666666; " >Board Roll</span></div></td>
					</tr>
				  </table>
				</div>
				<div align="center"></div>
			</td>
			<td>
				<div align="center">
				  <table width="100%" border="0" cellspacing="0" cellpadding="3" style="border:1px solid #e7e7e7; ">
					<tr>
					  <td valign="top"><div align="center"><span style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:12px; font-weight:bold; color:#666666; " >Board Roll</span></div></td>
					</tr>
				  </table>
				</div>
				<div align="center"></div>
			</td>
		</tr>
        <?php $v=0;
					 
							$prov=mysql_query("SELECT s.boardrollno, rf.coursecode, rf.totalfailed  FROM tbl_stdinfo s inner join tbl_reffinalforsummery rf on s.stdid=rf.stdid WHERE rf.deptid='$_POST[deptid]' and rf.semesterid='$_POST[semesterid]' and rf.session='$_POST[session]' and rf.year='$_POST[year]' and rf.totalfailed > 3") or die(mysql_error());					  
					  
					
									$nrowv=5;
									$m=0;
									while($pfetchv=mysql_fetch_array($prov)){
									if($v==$nrowv){
									?>
        <tr class="record">
            <td ><div align="center">
              <table width="100%" border="0" cellspacing="0" cellpadding="3" style="border:1px solid #e7e7e7; ">
                <tr>
                  <td valign="top"><div align="center"><span style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:11px; font-weight:bold; color:#666666; " ><?php echo $pfetchv['boardrollno'];?></span></div>                    </td>
                </tr>
              </table>
            </div>
              <div align="center"></div>
			</td>
          <?php $v=1; }else{ ?>
          <td><div align="center">
              <table width="200" border="0" cellspacing="0" cellpadding="3" style="border:1px solid #e7e7e7; ">
                <tr>
                  <td valign="top"><div align="center"><span style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:11px;  color:#666666;font-weight:bold; " ><?php echo $pfetchv['boardrollno'];?></span></div>                    </td>
                </tr>
              </table>
            </div>
              <div align="center"></div></td>
          <?php 
									$v++;
									}
								$m++;}
							?>
        </tr>
		 <tr>
		   <td colspan="5" style="text-align:left; font-weight:bold; font-family:Verdana, Arial, Helvetica, sans-serif; padding:5px; font-size:12px; border:1;">Total No of Failed Students=<?php echo $m; ?></td>
		 </tr>
      </table>
       <p>&nbsp;</p>
       <p align="center">&nbsp;</p>
      <p align="center" >&nbsp;</p>
      <p align="center" >      <font face="Arial, Helvetica, sans-serif" size="2"> </font></p>
      <br />
      <div id="MyResult" align="center"></div>
    <p></p></td>
  </tr>
  <tr>
    <td height="61" valign="middle" bgcolor="#FFFFFF"><table width="100%"  border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td><div align="center">(S.M Belayet Hossain)</br> 
          Exam Controller </br>
          Saic Institute of Management & Technology</div></td>
        <td><div align="center">(Shohaly Easmin)</br> Director</br> Saic Institute of Management & Technology</div></td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td height="61" valign="middle" bgcolor="#FFFFFF"><?php include("rptbot.php"); ?>
</td>
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
