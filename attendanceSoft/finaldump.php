<?php 
include("../config.php");
if($myDb->connect($host,$user,$pwd,$db,true))
{ 
$attq = mysql_query("select fempid,min(inouttime) 'In',max(inouttime) 'Out',attdate
				from readdevicefile
				group by fempid,attdate") or die(mysql_error());
	while($attqf = mysql_fetch_array($attq)){			
						$query="SELECT*FROM tbl_login WHERE userid='$attqf[fempid]'";
						$r=$myDb->select($query);
						$row=$myDb->get_row($r,'MYSQL_ASSOC');
						$atndstatus='';
						$mg='';
						
						$userid=$row['userid'];
						$accid=$row['accid'];
						$curmonth= date('F',strtotime($attqf['attdate']));
						$curyear= date('Y',strtotime($attqf['attdate']));
						$lateinstatus='';//$_SESSION['lateinstatus'];
						
						$query="INSERT INTO tbl_attendance(`efid`,`edate`,`intime`,`outtime`,`accid`,`monthname`,`yearname`,`instatus`) VALUES('$userid','$attqf[attdate]','$attqf[In]','$attqf[Out]','$accid','$curmonth','$curyear','')";
						$myDb->insert_sql($query);
						
						
						//$result=mysql_query("SELECT at . * FROM  `tbl_attendance` at WHERE at.efid='$userid' ");
						//$resultq=mysql_fetch_array($result);
						
						
						if(strpos($attqf['fempid'],"F") === 0){
							$st="SELECT ats.*, at.intime,TIMEDIFF(at.intime,ats.stdintime) as td, HOUR(TIMEDIFF(at.intime,ats.stdintime)) as hrs,
								 MINUTE(TIMEDIFF(at.intime,ats.stdintime)) as mins FROM `tbl_attendancesettings` ats 
							     inner join tbl_attendance at on ats.accid=at.accid WHERE ats.accid=37 and at.efid='$userid' and at.edate='$attqf[attdate]'";
						}
						if(strpos($attqf['fempid'],"E") === 0){
							$st="SELECT ats.*, at.intime,TIMEDIFF(at.intime,ats.stdintime) as td, HOUR(TIMEDIFF(at.intime,ats.stdintime)) as hrs,
								  MINUTE(TIMEDIFF(at.intime,ats.stdintime)) as mins FROM `tbl_attendancesettings` ats 
								  inner join tbl_attendance at on ats.accid=at.accid WHERE ats.accid=41 and at.efid='$userid' and at.edate='$attqf[attdate]'";
						}
						$stq=$myDb->select($st);
						$str=$myDb->get_row($stq,'MYSQL_ASSOC');
						$totalmins=($str['hrs']*60)+$str['mins'];
						if(strpos($str['td'],"-") === 0)
						{
							$mg='<span style="font-size:12px; color:#006600; font-weight:bold; ">Present</span>';
							$atndstatus="Present";
							$lateinstatus = "Regular In";
						}
						else if($totalmins<$str['minallow'])
						{
							$mg='<span style="font-size:12px; color:#006600; font-weight:bold; ">Present</span>';
							$atndstatus="Present";
							$lateinstatus = "Regular In";
						}
						
						else if(($totalmins>$str['minallow']) && ($totalmins<$str['maxallow']))
						{
							$mg='<span style="font-size:12px; color:#00FF00; font-weight:bold; ">Late Present</span>';
							$atndstatus="Late Present";
							$lateinstatus = "Delay In";

						}
						else if($totalmins>$str['maxallow'])
						{
							$mg='<span style="font-size:12px; color:#FF0000; font-weight:bold; ">Absent</span>';
							$atndstatus="Absent";
							$lateinstatus = "Delay In";
						}
					
						$st="UPDATE tbl_attendance set astatus='$atndstatus',instatus='$lateinstatus' WHERE efid='$userid' and edate='$attqf[attdate]'";
						$updst=$myDb->update_sql($st);
	}
?>
				<span style="font-size:22px; color:#fff; font-weight:bold; ">Your attendance is collected successfully</span>
<?php } ?>