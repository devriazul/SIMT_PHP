<?php ob_start();
session_start();
require_once('dbClass.php');
include("config.php"); 
if($myDb->connect($host,$user,$pwd,$db,true))
{ 
  if($_SESSION['userid']){ 
    
  	$chka="SELECT*FROM  tbl_accdtl WHERE flname='managefacultyinfonew.php' AND userid='$_SESSION[userid]'";
  	$caq=$myDb->select($chka);
  	$car=$myDb->get_row($caq,'MYSQL_ASSOC');
  	if(($car['ins']=="y")||($_SESSION['userid']=="administrator")){
			$fid=mysql_real_escape_string($_POST['fid']);
			$pass=mysql_real_escape_string(md5($_POST['pass']));
			$name=mysql_real_escape_string(ucfirst($_POST['name']));
			$sex=mysql_real_escape_string(ucfirst($_POST['sex']));
			$paddress=mysql_real_escape_string(ucfirst($_POST['paddress']));
			$deptid=mysql_real_escape_string(ucfirst($_POST['deptid']));
			$desigid=mysql_real_escape_string(ucfirst($_POST['desigid']));
			$jdate=mysql_real_escape_string(ucfirst($_POST['jdate']));
			$expsub=mysql_real_escape_string(ucfirst($_POST['expsub']));
			$eduq=mysql_real_escape_string(ucfirst($_POST['eduq']));
			$eyear=mysql_real_escape_string(ucfirst($_POST['eyear']));
			$emonth=mysql_real_escape_string(ucfirst($_POST['emonth']));
			$contactno=mysql_real_escape_string(ucfirst($_POST['contactno']));
			$emptype=mysql_real_escape_string(ucfirst($_POST['emptype']));
			$payscaleid=mysql_real_escape_string(ucfirst($_POST['payscaleid']));
			$fname=mysql_real_escape_string(ucfirst($_POST['fname']));
			$mname=mysql_real_escape_string(ucfirst($_POST['mname']));
			$dob=mysql_real_escape_string(ucfirst($_POST['dob']));
			$mstatus=mysql_real_escape_string(ucfirst($_POST['mstatus']));
			$bg=mysql_real_escape_string($_POST['bg']);
			$bankaccno=mysql_real_escape_string($_POST['bankaccno']);
			$opdate=date("Y-m-d");
			$smob=mysql_real_escape_string($_POST['smob']);
			$pfob=mysql_real_escape_string($_POST['pfob']);
		
		
			$midx=mysql_query("select max(id) from tbl_faculty") or die(mysql_error());
			$mfetch=mysql_fetch_array($midx);
			$maxid=$mfetch["max(id)"];
			$maxid=$maxid+1;
			$a=$maxid.".jpg";
			if($_FILES['img']['tmp_name']=="")
			{
		
			
				if(($_POST['cl']!="") && ($_POST['sl']!="") && ($_POST['al']!=""))
				{	   
					$query="INSERT INTO `tbl_faculty` (`facultyid`, `password`, `name`, `fname`, `mname`, `sex`, `dob`, `mstatus`, `bloodgroup`, `address`, `deptid`, `designationid`, `joiningdate`, `expartincourse`, `eduqualification`, `expyear`, `expmonth`, `contactno`, `type`, `payscaleid`, `alstatus`, `clstatus`, `slstatus`, `bankaccno`, `opby`, `opdate`, `storedstatus`, `smob`, `pfob`, `smstatus`, `pfstatus`) VALUES ('$fid', '$pass', '$name', '$fname', '$mname', '$sex', '$dob', '$mstatus', '$bg', '$paddress', '$deptid', '$desigid', '$jdate', '$expsub', '$eduq', '$eyear', '$emonth', '$contactno', '$emptype', '$payscaleid', '1','1','1', '$bankaccno', '$_SESSION[userid]','$opdate','I','$smob','$pfob','$_POST[secmoney]','$_POST[profund]')";
					$query1="INSERT INTO   tbl_login(`userid`,`password`,`accid`) VALUES('$fid','$pass','37')";
				} 
				else if(($_POST['cl']!="") && ($_POST['sl']!=""))
				{	   
					$query="INSERT INTO `tbl_faculty` (`facultyid`, `password`, `name`, `fname`, `mname`, `sex`, `dob`, `mstatus`, `bloodgroup`, `address`, `deptid`, `designationid`, `joiningdate`, `expartincourse`, `eduqualification`, `expyear`, `expmonth`, `contactno`, `type`, `payscaleid`, `clstatus`, `slstatus`, `bankaccno`, `opby`, `opdate`, `storedstatus`, `smob`, `pfob`, `smstatus`, `pfstatus`) VALUES ('$fid', '$pass', '$name', '$fname', '$mname', '$sex', '$dob', '$mstatus', '$bg', '$paddress', '$deptid', '$desigid', '$jdate', '$expsub', '$eduq', '$eyear', '$emonth', '$contactno', '$emptype', '$payscaleid', '1','1', '$bankaccno', '$_SESSION[userid]','$opdate','I','$smob','$pfob','$_POST[secmoney]','$_POST[profund]')";
					$query1="INSERT INTO   tbl_login(`userid`,`password`,`accid`) VALUES('$fid','$pass','37')";
				} 
				else if(($_POST['cl']!="") && ($_POST['al']!=""))
				{	   
					$query="INSERT INTO `tbl_faculty` (`facultyid`, `password`, `name`, `fname`, `mname`, `sex`, `dob`, `mstatus`, `bloodgroup`, `address`, `deptid`, `designationid`, `joiningdate`, `expartincourse`, `eduqualification`, `expyear`, `expmonth`, `contactno`, `type`, `payscaleid`, `alstatus`, `clstatus`, `bankaccno`, `opby`, `opdate`, `storedstatus`, `smob`, `pfob`, `smstatus`, `pfstatus`) VALUES ('$fid', '$pass', '$name', '$fname', '$mname', '$sex', '$dob', '$mstatus', '$bg', '$paddress', '$deptid', '$desigid', '$jdate', '$expsub', '$eduq', '$eyear', '$emonth', '$contactno', '$emptype', '$payscaleid', '1','1', '$bankaccno', '$_SESSION[userid]','$opdate','I','$smob','$pfob','$_POST[secmoney]','$_POST[profund]')";
					$query1="INSERT INTO   tbl_login(`userid`,`password`,`accid`) VALUES('$fid','$pass','37')";
				} 
				else if(($_POST['sl']!="") && ($_POST['al']!=""))
				{	   
					$query="INSERT INTO `tbl_faculty` (`facultyid`, `password`, `name`, `fname`, `mname`, `sex`, `dob`, `mstatus`, `bloodgroup`, `address`, `deptid`, `designationid`, `joiningdate`, `expartincourse`, `eduqualification`, `expyear`, `expmonth`, `contactno`, `type`, `payscaleid`, `alstatus`, `slstatus`, `bankaccno`, `opby`, `opdate`, `storedstatus`, `smob`, `pfob`, `smstatus`, `pfstatus`) VALUES ('$fid', '$pass', '$name', '$fname', '$mname', '$sex', '$dob', '$mstatus', '$bg', '$paddress', '$deptid', '$desigid', '$jdate', '$expsub', '$eduq', '$eyear', '$emonth', '$contactno', '$emptype', '$payscaleid', '1','1', '$bankaccno', '$_SESSION[userid]','$opdate','I','$smob','$pfob','$_POST[secmoney]','$_POST[profund]')";
					$query1="INSERT INTO   tbl_login(`userid`,`password`,`accid`) VALUES('$fid','$pass','37')";
				} 
		
				else if($_POST['cl']!="")
				{	   
					$query="INSERT INTO `tbl_faculty` (`facultyid`, `password`, `name`, `fname`, `mname`, `sex`, `dob`, `mstatus`, `bloodgroup`, `address`, `deptid`, `designationid`, `joiningdate`, `expartincourse`, `eduqualification`, `expyear`, `expmonth`, `contactno`, `type`, `payscaleid`, `clstatus`, `bankaccno`, `opby`, `opdate`, `storedstatus`, `smob`, `pfob`, `smstatus`, `pfstatus`) VALUES ('$fid', '$pass', '$name', '$fname', '$mname', '$sex', '$dob', '$mstatus', '$bg', '$paddress', '$deptid', '$desigid', '$jdate', '$expsub', '$eduq', '$eyear', '$emonth', '$contactno', '$emptype', '$payscaleid', '1', '$bankaccno', '$_SESSION[userid]','$opdate','I','$smob','$pfob','$_POST[secmoney]','$_POST[profund]')";
					$query1="INSERT INTO   tbl_login(`userid`,`password`,`accid`) VALUES('$fid','$pass','37')";
				} 
				else if($_POST['sl']!="")
				{	   
					$query="INSERT INTO `tbl_faculty` (`facultyid`, `password`, `name`, `fname`, `mname`, `sex`, `dob`, `mstatus`, `bloodgroup`, `address`, `deptid`, `designationid`, `joiningdate`, `expartincourse`, `eduqualification`, `expyear`, `expmonth`, `contactno`, `type`, `payscaleid`, `slstatus`, `bankaccno`, `opby`, `opdate`, `storedstatus`, `smob`, `pfob`, `smstatus`, `pfstatus`) VALUES ('$fid', '$pass', '$name', '$fname', '$mname', '$sex', '$dob', '$mstatus', '$bg', '$paddress', '$deptid', '$desigid', '$jdate', '$expsub', '$eduq', '$eyear', '$emonth', '$contactno', '$emptype', '$payscaleid', '1', '$bankaccno', '$_SESSION[userid]','$opdate','I','$smob','$pfob','$_POST[secmoney]','$_POST[profund]')";
					$query1="INSERT INTO   tbl_login(`userid`,`password`,`accid`) VALUES('$fid','$pass','37')";
				} 
				else if($_POST['al']!="")
				{	   
					$query="INSERT INTO `tbl_faculty` (`facultyid`, `password`, `name`, `fname`, `mname`, `sex`, `dob`, `mstatus`, `bloodgroup`, `address`, `deptid`, `designationid`, `joiningdate`, `expartincourse`, `eduqualification`, `expyear`, `expmonth`, `contactno`, `type`, `payscaleid`, `alstatus`, `bankaccno`, `opby`, `opdate`, `storedstatus` , `smob`, `pfob`, `smstatus`, `pfstatus`) VALUES ('$fid', '$pass', '$name', '$fname', '$mname', '$sex', '$dob', '$mstatus', '$bg', '$paddress', '$deptid', '$desigid', '$jdate', '$expsub', '$eduq', '$eyear', '$emonth', '$contactno', '$emptype', '$payscaleid', '1', '$bankaccno', '$_SESSION[userid]','$opdate','I','$smob','$pfob','$_POST[secmoney]','$_POST[profund]')";
					$query1="INSERT INTO   tbl_login(`userid`,`password`,`accid`) VALUES('$fid','$pass','37')";
				} 
				else
				{	   
					$query="INSERT INTO `tbl_faculty` (`facultyid`, `password`, `name`, `fname`, `mname`, `sex`, `dob`, `mstatus`, `bloodgroup`, `address`, `deptid`, `designationid`, `joiningdate`, `expartincourse`, `eduqualification`, `expyear`, `expmonth`, `contactno`, `type`, `payscaleid`, `opby`, `bankaccno`, `opdate`, `storedstatus`, `smob`, `pfob`, `smstatus`, `pfstatus`) VALUES ('$fid', '$pass', '$name', '$fname', '$mname', '$sex', '$dob', '$mstatus', '$bg', '$paddress', '$deptid', '$desigid', '$jdate', '$expsub', '$eduq', '$eyear', '$emonth', '$contactno', '$emptype', '$payscaleid', '$bankaccno', '$_SESSION[userid]','$opdate','I','$smob','$pfob','$_POST[secmoney]','$_POST[profund]')";
					$query1="INSERT INTO   tbl_login(`userid`,`password`,`accid`) VALUES('$fid','$pass','37')";
				} 
		
		
			}
			else
			{	
				copy($_FILES['img']['tmp_name'],"facultyphoto/".$a);		
		
				if(($_POST['cl']!="") && ($_POST['sl']!="") && ($_POST['al']!=""))
				{	   
					$query="INSERT INTO `tbl_faculty` (`facultyid`, `password`, `name`, `fname`, `mname`, `sex`, `dob`, `mstatus`, `bloodgroup`, `address`, `deptid`, `designationid`, `joiningdate`, `expartincourse`, `eduqualification`, `expyear`, `expmonth`, `contactno`, `type`, `payscaleid`, `alstatus`, `clstatus`, `slstatus`, `img`, `bankaccno`, `opby`, `opdate`, `storedstatus`, `smob`, `pfob`, `smstatus`, `pfstatus`) VALUES ('$fid', '$pass', '$name', '$fname', '$mname', '$sex', '$dob', '$mstatus', '$bg', '$paddress', '$deptid', '$desigid', '$jdate', '$expsub', '$eduq', '$eyear', '$emonth', '$contactno', '$emptype', '$payscaleid', '1','1','1',  '$a', '$bankaccno', '$_SESSION[userid]','$opdate','I','$smob','$pfob','$_POST[secmoney]','$_POST[profund]')";
					$query1="INSERT INTO   tbl_login(`userid`,`password`,`accid`) VALUES('$fid','$pass','37')";
				} 
				else if(($_POST['cl']!="") && ($_POST['sl']!=""))
				{	   
					$query="INSERT INTO `tbl_faculty` (`facultyid`, `password`, `name`, `fname`, `mname`, `sex`, `dob`, `mstatus`, `bloodgroup`, `address`, `deptid`, `designationid`, `joiningdate`, `expartincourse`, `eduqualification`, `expyear`, `expmonth`, `contactno`, `type`, `payscaleid`, `clstatus`, `slstatus`,  `img`, `bankaccno`, `opby`, `opdate`, `storedstatus`, `smob`, `pfob`, `smstatus`, `pfstatus`) VALUES ('$fid', '$pass', '$name', '$fname', '$mname', '$sex', '$dob', '$mstatus', '$bg', '$paddress', '$deptid', '$desigid', '$jdate', '$expsub', '$eduq', '$eyear', '$emonth', '$contactno', '$emptype', '$payscaleid', '1','1',  '$a', '$bankaccno', '$_SESSION[userid]','$opdate','I','$smob','$pfob','$_POST[secmoney]','$_POST[profund]')";
					$query1="INSERT INTO   tbl_login(`userid`,`password`,`accid`) VALUES('$fid','$pass','37')";
				} 
				else if(($_POST['cl']!="") && ($_POST['al']!=""))
				{	   
					$query="INSERT INTO `tbl_faculty` (`facultyid`, `password`, `name`, `fname`, `mname`, `sex`, `dob`, `mstatus`, `bloodgroup`, `address`, `deptid`, `designationid`, `joiningdate`, `expartincourse`, `eduqualification`, `expyear`, `expmonth`, `contactno`, `type`, `payscaleid`, `alstatus`, `clstatus`,  `img`, `bankaccno`, `opby`, `opdate`, `storedstatus`, `smob`, `pfob`, `smstatus`, `pfstatus`) VALUES ('$fid', '$pass', '$name', '$fname', '$mname', '$sex', '$dob', '$mstatus', '$bg', '$paddress', '$deptid', '$desigid', '$jdate', '$expsub', '$eduq', '$eyear', '$emonth', '$contactno', '$emptype', '$payscaleid', '1','1',  '$a', '$bankaccno', '$_SESSION[userid]','$opdate','I','$smob','$pfob','$_POST[secmoney]','$_POST[profund]')";
					$query1="INSERT INTO   tbl_login(`userid`,`password`,`accid`) VALUES('$fid','$pass','37')";
				} 
				else if(($_POST['sl']!="") && ($_POST['al']!=""))
				{	   
					$query="INSERT INTO `tbl_faculty` (`facultyid`, `password`, `name`, `fname`, `mname`, `sex`, `dob`, `mstatus`, `bloodgroup`, `address`, `deptid`, `designationid`, `joiningdate`, `expartincourse`, `eduqualification`, `expyear`, `expmonth`, `contactno`, `type`, `payscaleid`, `alstatus`, `slstatus`,  `img`, `bankaccno`, `opby`, `opdate`, `storedstatus`, `smob`, `pfob`, `smstatus`, `pfstatus`) VALUES ('$fid', '$pass', '$name', '$fname', '$mname', '$sex', '$dob', '$mstatus', '$bg', '$paddress', '$deptid', '$desigid', '$jdate', '$expsub', '$eduq', '$eyear', '$emonth', '$contactno', '$emptype', '$payscaleid', '1','1',  '$a', '$bankaccno', '$_SESSION[userid]','$opdate','I','$smob','$pfob','$_POST[secmoney]','$_POST[profund]')";
					$query1="INSERT INTO   tbl_login(`userid`,`password`,`accid`) VALUES('$fid','$pass','37')";
				} 
		
				else if($_POST['cl']!="")
				{	   
					$query="INSERT INTO `tbl_faculty` (`facultyid`, `password`, `name`, `fname`, `mname`, `sex`, `dob`, `mstatus`, `bloodgroup`, `address`, `deptid`, `designationid`, `joiningdate`, `expartincourse`, `eduqualification`, `expyear`, `expmonth`, `contactno`, `type`, `payscaleid`, `clstatus`,  `img`, `bankaccno`, `opby`, `opdate`, `storedstatus`, `smob`, `pfob`, `smstatus`, `pfstatus`) VALUES ('$fid', '$pass', '$name', '$fname', '$mname', '$sex', '$dob', '$mstatus', '$bg', '$paddress', '$deptid', '$desigid', '$jdate', '$expsub', '$eduq', '$eyear', '$emonth', '$contactno', '$emptype', '$payscaleid', '1',  '$a', '$bankaccno', '$_SESSION[userid]','$opdate','I','$smob','$pfob','$_POST[secmoney]','$_POST[profund]')";
					$query1="INSERT INTO   tbl_login(`userid`,`password`,`accid`) VALUES('$fid','$pass','37')";
				} 
				else if($_POST['sl']!="")
				{	   
					$query="INSERT INTO `tbl_faculty` (`facultyid`, `password`, `name`, `fname`, `mname`, `sex`, `dob`, `mstatus`, `bloodgroup`, `address`, `deptid`, `designationid`, `joiningdate`, `expartincourse`, `eduqualification`, `expyear`, `expmonth`, `contactno`, `type`, `payscaleid`, `slstatus`,  `img`, `bankaccno`, `opby`, `opdate`, `storedstatus`, `smob`, `pfob`, `smstatus`, `pfstatus`) VALUES ('$fid', '$pass', '$name', '$fname', '$mname', '$sex', '$dob', '$mstatus', '$bg', '$paddress', '$deptid', '$desigid', '$jdate', '$expsub', '$eduq', '$eyear', '$emonth', '$contactno', '$emptype', '$payscaleid', '1',  '$a', '$bankaccno', '$_SESSION[userid]','$opdate','I','$smob','$pfob','$_POST[secmoney]','$_POST[profund]')";
					$query1="INSERT INTO   tbl_login(`userid`,`password`,`accid`) VALUES('$fid','$pass','37')";
				} 
				else if($_POST['al']!="")
				{	   
					$query="INSERT INTO `tbl_faculty` (`facultyid`, `password`, `name`, `fname`, `mname`, `sex`, `dob`, `mstatus`, `bloodgroup`, `address`, `deptid`, `designationid`, `joiningdate`, `expartincourse`, `eduqualification`, `expyear`, `expmonth`, `contactno`, `type`, `payscaleid`, `alstatus`,  `img`, `bankaccno`, `opby`, `opdate`, `storedstatus`, `smob`, `pfob`, `smstatus`, `pfstatus`) VALUES ('$fid', '$pass', '$name', '$fname', '$mname', '$sex', '$dob', '$mstatus', '$bg', '$paddress', '$deptid', '$desigid', '$jdate', '$expsub', '$eduq', '$eyear', '$emonth', '$contactno', '$emptype', '$payscaleid', '1',  '$a', '$bankaccno', '$_SESSION[userid]','$opdate','I','$smob','$pfob','$_POST[secmoney]','$_POST[profund]')";
					$query1="INSERT INTO   tbl_login(`userid`,`password`,`accid`) VALUES('$fid','$pass','37')";
				} 
				else
				{	   
					$query="INSERT INTO `tbl_faculty` (`facultyid`, `password`, `name`, `fname`, `mname`, `sex`, `dob`, `mstatus`, `bloodgroup`, `address`, `deptid`, `designationid`, `joiningdate`, `expartincourse`, `eduqualification`, `expyear`, `expmonth`, `contactno`, `type`, `payscaleid`,  `img`, `opby`, `bankaccno`, `opdate`, `storedstatus`, `smob`, `pfob`, `smstatus`, `pfstatus`) VALUES ('$fid', '$pass', '$name', '$fname', '$mname', '$sex', '$dob', '$mstatus', '$bg', '$paddress', '$deptid', '$desigid', '$jdate', '$expsub', '$eduq', '$eyear', '$emonth', '$contactno', '$emptype', '$payscaleid', '$a', '$bankaccno', '$_SESSION[userid]','$opdate','I','$smob','$pfob','$_POST[secmoney]','$_POST[profund]')";
					$query1="INSERT INTO   tbl_login(`userid`,`password`,`accid`) VALUES('$fid','$pass','37')";
				} 
			}
		//	$query="INSERT INTO `tbl_faculty` (`facultyid`, `password`, `name`, `fname`, `mname`, `sex`, `dob`, `mstatus`, `bloodgroup`, `address`, `deptid`, `designationid`, `joiningdate`, `expartincourse`, `eduqualification`, `expyear`, `expmonth`, `contactno`, `type`, `payscaleid`, `opby`, `opdate`, `storedstatus`) VALUES ('$fid', '$pass', '$name', '$fname', '$mname', '$sex', '$dob', '$mstatus', '$bg', '$paddress', '$deptid', '$desigid', '$jdate', '$expsub', '$eduq', '$eyear', '$emonth', '$contactno', '$emptype', '$payscaleid', '$_SESSION[userid]','$opdate','I')";
		//	$query1="INSERT INTO   tbl_login(`userid`,`password`,`accid`) VALUES('$fid','$pass','37')";
			
			
			
			
			if(isset($_POST['profund'])!=""){
							$apar=$myDb->select("SELECT*FROM tbl_accchart WHERE parentid IN(SELECT id FROM tbl_accchart WHERE parentid=0 AND  accname='Current Liabilities') 
												 AND accname='Employees Provident Fund'");
							while($aparf=$myDb->get_row($apar,'MYSQL_ASSOC')){
							   
									$chkchart=$myDb->select("SELECT*FROM tbl_accchart WHERE empid='".$_POST['fid']."' and pro='Y'");
									$chartf=$myDb->get_row($chkchart,'MYSQL_ASSOC');
									$ename="FPro ".$name;
									//$secname="FSec ".$name;			
									/*if($chartf['empid']==$_POST['fid']){
									   $upc=$myDb->update_sql("UPDATE tbl_accchar SET accname='$ename',
																					  pro='$_POST[profund]', 
																					  groupname=(SELECT id FROM tbl_accchart WHERE accname='Employees Provident Fund')
															   WHERE empid='$fid' and pro='Y'");
									
									
									}else{
									*/
									  $inschart=$myDb->insert_sql("INSERT INTO tbl_accchart(accname,parentid,groupname,type,opby,opdate,storedstatus,empid,pro,groupalias)
																   VALUES('$ename','$aparf[id]','$aparf[id]',
																		  'Trading Account','$_SESSION[userid]',
																		  '".date("Y-m-d")."','I','$fid','$_POST[profund]','FPro')");
									
									//}
						 }			
					}
							   
					if(isset($_POST['secmoney'])!="")
					{
							$apar=$myDb->select("SELECT*FROM tbl_accchart WHERE parentid IN(SELECT id FROM tbl_accchart WHERE parentid=0 AND  accname='Current Liabilities') 
												 AND accname='Employee Security Money'");
							while($aparf=$myDb->get_row($apar,'MYSQL_ASSOC'))
							{					
									$chkchart=$myDb->select("SELECT*FROM tbl_accchart WHERE empid='".$_POST['fid']."' and sec='Y'");
									$chartf=$myDb->get_row($chkchart,'MYSQL_ASSOC');
									//$ename="FPro ".$name;
									$secname="FSec ".$name;			
									/*if($chartf['empid']==$_POST['fid'])
									{
									   $upc=$myDb->update_sql("UPDATE tbl_accchar SET accname='$secname'
																					  ,sec='$_POST[secmoney]'
																					  , groupname=(SELECT id FROM tbl_accchart WHERE accname='Employee Security Money')
															   WHERE empid='$fid' and sec='Y'");
									
									
									}
									else
									{
									*/   
																   
									  $inschart=$myDb->insert_sql("INSERT INTO tbl_accchart(accname,parentid,groupname,type,opby,opdate,storedstatus,empid,sec,groupalias)
																   VALUES('$secname','$aparf[id]','$aparf[id]',
																		  'Trading Account','$_SESSION[userid]',
																		  '".date("Y-m-d")."','I','$fid','$_POST[secmoney]','FSec')");
									
									//}
							}
							//--------For Security Money Receivable------------
							$apars=$myDb->select("SELECT*FROM tbl_accchart WHERE parentid IN(SELECT id FROM tbl_accchart WHERE accname='Sundry Debtors') 
												 AND accname='Employees Security Money (Rcv)'");
							while($aparfs=$myDb->get_row($apars,'MYSQL_ASSOC'))
							{	
								$secnameR="FSecRcv ".$name;	
								$inschart=$myDb->insert_sql("INSERT INTO tbl_accchart(accname,parentid,groupname,type,opby,opdate,storedstatus,empid,secr,groupalias)
																   VALUES('$secnameR','$aparfs[id]','$aparfs[id]','Trading Account',
																   '$_SESSION[userid]','".date("Y-m-d")."','I','$fid','$_POST[secmoney]','FSecRcv')");
									
									//}
							}
							
							//---------------Auto hit to accounts for security money-----------------
							$accsmrcv=$myDb->select("select*from tbl_accchart where accname='$secnameR'");
							$accsmrcvf=$myDb->get_row($accsmrcv,'MYSQL_ASSOC');
							$accsmcl=$myDb->select("select*from tbl_accchart where accname='$secname'");
							$accsmclf=$myDb->get_row($accsmcl,'MYSQL_ASSOC');
							$vamount=mysql_real_escape_string(ucfirst($_POST['showsal']));
							$vid=$myDb->select("SELECT ifnull(count(id),0) mvid FROM tbl_masterjournal WHERE vouchertype='J'");
							$vidf=$myDb->get_row($vid,'MYSQL_ASSOC');
							$maxvid=$vidf['mvid']+1;
							$opdate=date("Y-m-d");
                            $voucherid="JV/-".$opdate."-"."0".$maxvid;													 
							$vexpl="Receivable for Security Money.";
							$vgroup=substr($accsmrcvf['accname'],0,7);

							
							if($accsmrcvf['groupname']==0)
		  					{
		    					$groupnamep=$accsmrcvf['parentid'];
		  					}else{
		    					$groupnamep=$accsmrcvf['groupname'];
		  					}

							if($accsmclf['groupname']==0)
		  					{
		    					$groupnames=$accsmclf['parentid'];
		  					}else{
		    					$groupnames=$accsmclf['groupname'];
		  					}

		  					
							$myDb->insert_sql("INSERT INTO tbl_masterjournal(voucherid,voucherdate,vouchertype,preparedby, paytype,opby,opdate,storedstatus,accountno,voucherexpl, multi_single,voucher_group)	
													VALUES('$voucherid','$opdate','J','$_SESSION[userid]','','$_SESSION[userid]','$opdate','I','$accsmrcvf[id]','$vexpl','single','$vgroup')");

							$myDb->insert_sql("INSERT INTO tbl_2ndjournal(accno,groupname, accname,amountdr,amountcr,voucherid, vouchertype,paytype,vdate,parentid, masteraccno, storedstatus,opby,multi_single,voucher_group)
									VALUES('$accsmrcvf[id]','$groupnamep','$accsmrcvf[accname]','$vamount','0','$voucherid','J','','$opdate','$accsmrcvf[parentid]','0','I','$_SESSION[userid]','single','$vgroup')");

							$myDb->insert_sql("INSERT INTO tbl_2ndjournal(accno,groupname, accname,amountdr,amountcr,voucherid, vouchertype,paytype,vdate,parentid, masteraccno, storedstatus,opby,multi_single,voucher_group)
									VALUES('$accsmclf[id]','$groupnames','$accsmclf[accname]','0','$vamount','$voucherid','J','','$opdate','$accsmclf[parentid]','$accsmrcvf[id]','I','$_SESSION[userid]','single','$vgroup')");
		  					
							//------------------End of auto hit---------------
							
					}
			
							//--------For Employee Salary Payable------------
							$aparp=$myDb->select("SELECT*FROM tbl_accchart WHERE parentid IN(SELECT id FROM tbl_accchart WHERE parentid=0 AND  accname='Current Liabilities') 
												 AND accname='Employee Salary Payable'");
							while($aparfp=$myDb->get_row($aparp,'MYSQL_ASSOC'))
							{	
									$secname="FSalPay ".$name;
									$inschart=$myDb->insert_sql("INSERT INTO tbl_accchart(accname,parentid,groupname,type,opby,opdate,storedstatus,empid,salpay,groupalias)
																   VALUES('$secname','$aparfp[id]','$aparfp[id]','Trading Account',
																   '$_SESSION[userid]','".date("Y-m-d")."','I','$fid','Y','FSalPay')");
									
							}
			   
			
			
			
			
			if($myDb->insert_sql($query) && $myDb->insert_sql($query1))
			{
				$msg="Data inserted successfully";
				header("Location:add_facultyinfo.php?msg=$msg");
		
			}
			else
			{
				$msg=$myDb->last_error;
				header("Location:add_facultyinfo.php?msg=$msg");
		
			}   
		}
   }else{
     $msg="Sorry,you are not authorized to access this page";
	 header("Location:home.php?msg=$msg");
   }	 
	
}else{
  header("Location:index.php");
}