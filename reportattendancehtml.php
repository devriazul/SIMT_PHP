<?php ob_start();
session_start();
require_once('dbClass.php');
include("config.php"); 
if($myDb->connect($host,$user,$pwd,$db,true))
{ 
	if($_SESSION['userid']){
	   
			/*     
  			$crs="SELECT * FROM tbl_designation Where storedstatus<>'D' order by torder";
  				  
			$crq=$myDb->select($crs); 
			$count=0;
  			$crsr=$myDb->get_row($crq,'MYSQL_ASSOC');
			*/
			
			if($_POST['emptype']=="E")
			{
		
				$id="SELECT at . * , s.name AS EmpName, REPLACE(a.accname,'Panel','') as accname FROM  `tbl_attendance` at INNER JOIN  `tbl_staffinfo` s ON at.efid = s.sid INNER JOIN  `tbl_access` a ON at.accid = a.id WHERE at.edate BETWEEN  '$_POST[fromdate]' AND  '$_POST[todate]' ";
			
				$qid=$myDb->select($id);
				$fid=$myDb->get_row($qid,'MYSQL_ASSOC');
				
				$stdtime="SELECT * FROM tbl_attendancesettings WHERE accid='41'";	
				$stdqtime=$myDb->select($stdtime);
				$stdrtime=$myDb->get_row($stdqtime,'MYSQL_ASSOC');
			}
			else if($_POST['emptype']=="F")
			{
				$id="SELECT at . * , f.name AS FacName, REPLACE(a.accname,'Panel','') as accname FROM  `tbl_attendance` at INNER JOIN  `tbl_faculty` f ON at.efid = f.facultyid INNER JOIN  `tbl_access` a ON at.accid = a.id WHERE at.edate BETWEEN  '$_POST[fromdate]' AND  '$_POST[todate]'";
				$qid=$myDb->select($id);
				$fid=$myDb->get_row($qid,'MYSQL_ASSOC');
			  
			  
				$stdtime="SELECT * FROM tbl_attendancesettings WHERE accid='37'";	
				$stdqtime=$myDb->select($stdtime);
				$stdrtime=$myDb->get_row($stdqtime,'MYSQL_ASSOC');
			}
			
		
			if($_POST['emptype']=="E")
			{
				//echo $t="SELECT at . * , s.name AS EmpName, REPLACE(a.accname,'Panel','') as accname, LEFT(TIMEDIFF(intime,'".$stdrtime['stdintime']."'),1) as tdiff FROM  `tbl_attendance` at INNER JOIN  `tbl_staffinfo` s ON at.efid = s.sid INNER JOIN  `tbl_access` a ON at.accid = a.id WHERE at.edate BETWEEN  '$_POST[fromdate]' AND  '$_POST[todate]'  UNION SELECT id, sid, '$_POST[fromdate]' as edate, '' as intime, '' as outtime, '41' as accid, '' as earlyoutreason, monthname('$_POST[fromdate]') as monthname , year('$_POST[fromdate]') as yearname, '' as instatus, 'Absent' as astatus, name as EmpName, 'Staff' as accname, '0' as tdiff FROM  `tbl_staffinfo` WHERE sid NOT IN (SELECT efid FROM  `tbl_attendance` WHERE edate BETWEEN  '$_POST[fromdate]' AND  '$_POST[todate]') and jobstatus='Active'"; exit;
				$result=mysql_query("SELECT at . * , s.name AS EmpName, REPLACE(a.accname,'Panel','') as accname, LEFT(TIMEDIFF(intime,'".$stdrtime['stdintime']."'),1) as tdiff FROM  `tbl_attendance` at INNER JOIN  `tbl_staffinfo` s ON at.efid = s.sid INNER JOIN  `tbl_access` a ON at.accid = a.id WHERE at.edate BETWEEN  '$_POST[fromdate]' AND  '$_POST[todate]'  UNION SELECT id, sid, '$_POST[fromdate]' as edate, '' as intime, '' as outtime, '41' as accid, '' as earlyoutreason, monthname('$_POST[fromdate]') as monthname , year('$_POST[fromdate]') as yearname, '' as instatus, 'Absent' as astatus, name as EmpName, 'Staff' as accname, '1' as tdiff FROM  `tbl_staffinfo` WHERE sid NOT IN (SELECT efid FROM  `tbl_attendance` WHERE edate BETWEEN  '$_POST[fromdate]' AND  '$_POST[todate]') and jobstatus='Active'");
			}
			else if($_POST['emptype']=="F")
			{ 
				$result=mysql_query("SELECT at . * , f.name AS EmpName, REPLACE(a.accname,'Panel','') as accname, LEFT(TIMEDIFF(intime,'".$stdrtime['stdintime']."'),1) as tdiff FROM  `tbl_attendance` at INNER JOIN  `tbl_faculty` f ON at.efid = f.facultyid INNER JOIN  `tbl_access` a ON at.accid = a.id WHERE at.edate BETWEEN  '$_POST[fromdate]' AND  '$_POST[todate]' UNION SELECT id, facultyid as sid, '$_POST[fromdate]' as edate, '' as intime, '' as outtime, '37' as accid, '' as earlyoutreason, monthname('$_POST[fromdate]') as monthname , year('$_POST[fromdate]') as yearname, '' as instatus, 'Absent' as astatus, name as EmpName, 'Staff' as accname, '1' as tdiff FROM  `tbl_faculty` WHERE facultyid NOT IN (SELECT efid FROM  `tbl_attendance` WHERE edate BETWEEN  '$_POST[fromdate]' AND  '$_POST[todate]') and jobstatus='Active'");
			}
		
					
		
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
-->
</style></head>

<body>
<table width="90%" border="0" align="center" cellpadding="0" cellspacing="0" id="tblleft">
  <tr>
    <td height="28" bgcolor="#FFFFFF">&nbsp;</td>
  </tr>
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
    <td valign="top"><div align="center"><span style="font-size:24px; font-weight:bold; text-decoration:underline; "><?php if($_POST['emptype']=="E"){echo "Employee";}elseif($_POST['emptype']=="F"){echo "Faculty";} ?> Attandence Report </span></div></td>
  </tr>
  <tr>
    <td valign="top"><div align="center">Date From :<?php echo $_POST['fromdate']." To :".$_POST['todate'];?></div></td>
  </tr>
  <tr>
    <td valign="top">&nbsp;</td>
  </tr>
  <tr>
    <td width="79%" valign="top">
      <table width="100%" height="82" border="1" align="center" cellpadding="2" cellspacing="0" bordercolor="#666666" id="stdtbl">
        <tr bgcolor="#DFF4FF">
          <td width="42" class="style2"><strong>SLNo.</strong></td>
          <td width="62" height="32" class="style2"><strong>Staff ID</strong></td>
          <td width="257" class="style2"><strong>Name</strong></td>
          <td width="65" class="style2"><strong>In Time</strong></td>
          <td width="126" class="style2"><strong>Delay</strong></td>
          <td width="171" class="style2"><strong>Delay Reason </strong></td>
          <td width="81" class="style2"><strong>In Status </strong></td>
          <td width="124" class="style2"><strong>Out Time </strong></td>
          <td width="140" class="style2"><strong>Out Status </strong></td>
        </tr>
		<?php $i=0; while($row = mysql_fetch_array($result)){ $i++;
		
			if($_POST['emptype']=="E")
			{
			  $stdtime="SELECT * FROM tbl_attendancesettings WHERE accid='41'";	
			  $stdqtime=$myDb->select($stdtime);
			  $stdrtime=$myDb->get_row($stdqtime,'MYSQL_ASSOC');
						  
			  $t1= new DateTime($row['intime']);
			  $t2= new DateTime($stdrtime['stdintime']);
			  $interval = $t1->diff($t2);
			  $a=(int)$interval->format('%h');
			  $b=(int)$interval->format('%i'); 
			  $c=($a*60)+$b;
			}
			else if($_POST['emptype']=="F")
			{
			  $stdtime="SELECT * FROM tbl_attendancesettings WHERE accid='37'";	
			  $stdqtime=$myDb->select($stdtime);
			  $stdrtime=$myDb->get_row($stdqtime,'MYSQL_ASSOC');
						  
			  $t1= new DateTime($row['intime']);
			  $t2= new DateTime($stdrtime['stdintime']);
			  $interval = $t1->diff($t2);
			  $a=(int)$interval->format('%h');
			  $b=(int)$interval->format('%i'); 
			  $c=($a*60)+$b;
			}
	 
			$count=0;
			if($count%2==0){
			$bgcolor="#FFFFFF";?>
        <tr bgcolor="<?php echo $bgcolor; ?>">
          <td class="style4" ><?php echo $i; ?></td>
          <td height="18" class="style4" ><?php echo $row['efid'];?></td>
          <td class="style4" ><?php echo $row['EmpName'];?></td>
          <td class="style4" ><?php echo $row['intime'];?></td>
		  <?php 	if(($row['tdiff']=='-'))
					{
						$delay = "------------------";
					}
					else if(($row['tdiff']=='1'))
					{
						$delay = "No Time Found";
					}
					else if(($c<=$stdrtime['minallow']))
					{
						$delay = "------------------";
					}
					else if (($c>$stdrtime['minallow']) && ($c<=$stdrtime['maxallow']))
					{
						$delay = $interval->format('%h Hr %i Mn %s Sec');//$row['tdiff'];
					}
					else if ($c>$stdrtime['maxallow'])
					{
						$delay = $interval->format('%h Hr %i Mn %s Sec');//$row['tdiff'];
					}
					
		 ?>
          <td class="style4" ><?php  echo $delay;?></td>
		  <td class="style4" ><?php if(($row['instatus']<>"Regular In") && ($row['instatus']<>"")) echo $row['instatus'];?></td>
		  <?php
		  	if(($row['tdiff']=='-') )
			{
				
				$status = "Present";
			}
			else if(($row['tdiff']=='1'))
			{
				$status = "<span style='color:#FF0000;'>Absent</span>";
			}
			else if($c<=$stdrtime['minallow'])
			{
				
				$status = "Present";
			}
		
		
			else if (($c>$stdrtime['minallow']) && ($c<=$stdrtime['maxallow']))
			{
				$status = "<span style='color:#FF9900;'>Late</span>";
		
			}
			else if ($c>$stdrtime['maxallow'])
			{
				$status = "<span style='color:#FF0000;'>Absent</span>";
		
			}
			
	

		  ?> 
          <td class="style4" ><?php echo $status;?></td>
          <td class="style4" ><?php echo $row['outtime'];?></td>
          <td class="style4" ><?php echo $row['earlyoutreason'];?></td>
        </tr>
        <?php }else{ $bgcolor="#F7FCFF"; ?>
        <tr bgcolor="<?php echo $bgcolor; ?>">
          <td class="style4" ><?php echo $i; ?></td>
          <td height="18" class="style4" ><?php echo $row['efid'];?></td>
          <td class="style4" ><?php echo $row['EmpName'];?></td>
          <td class="style4" ><?php echo $row['intime'];?></td>
		  <?php 	if(($row['tdiff']=='-'))
					{
						$delay = "------------------";
					}
					else if(($row['tdiff']=='1'))
					{
						$delay = "No Time Found";
					}
					else if(($c<=$stdrtime['minallow']))
					{
						$delay = "------------------";
					}
					else if (($c>$stdrtime['minallow']) && ($c<=$stdrtime['maxallow']))
					{
						$delay = $interval->format('%h Hr %i Mn %s Sec');//$row['tdiff'];
					}
					else if ($c>$stdrtime['maxallow'])
					{
						$delay = $interval->format('%h Hr %i Mn %s Sec');//$row['tdiff'];
					}
					
		 ?>
          <td class="style4" ><?php  echo $delay;?></td>
		  <td class="style4" ><?php if(($row['instatus']<>"Regular In") && ($row['instatus']<>"")) echo $row['instatus'];?></td>
		  <?php
		  	if(($row['tdiff']=='-') )
			{
				
				$status = "Present";
			}
			else if(($row['tdiff']=='1'))
			{
				$status = "<span style='color:#FF0000;'>Absent</span>";
			}
			
			else if($c<=$stdrtime['minallow'])
			{
				
				$status = "Present";
			}
		
		
			else if (($c>$stdrtime['minallow']) && ($c<=$stdrtime['maxallow']))
			{
				$status = "Late";
		
			}
			else if ($c>$stdrtime['maxallow'])
			{
				$status = "Absent";
		
			}
	

		  ?>
          <td class="style4" ><?php echo $status;?></td>
          <td class="style4" ><?php echo $row['outtime'];?></td>
          <td class="style4" ><?php echo $row['earlyoutreason'];?></td>
        </tr>
        <?php }
			  	 	$count++;
			  }
			  
			?>
      </table>
      <p align="center">&nbsp;</p>
      <p align="center" >        <font face="Arial, Helvetica, sans-serif" size="2"> </font></p>
      <br />
      <div id="MyResult" align="center"></div>
      <p></p></td>
  </tr>
  <tr>
    <td height="61" valign="middle" bgcolor="#FFFFFF"><?php include("rptbot.php"); ?>
    <div align="center"></div></td>
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
