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
  
    
	$fid=mysql_real_escape_string(ucfirst($_POST['fid']));
	//$pass=mysql_real_escape_string(ucfirst($_POST['pass']));
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
	$bankaccno=mysql_real_escape_string($_POST['bankaccno']);
	$bg=mysql_real_escape_string($_POST['bg']);
	$smob=mysql_real_escape_string(ucfirst($_POST['smob']));
	$pfob=mysql_real_escape_string(ucfirst($_POST['pfob']));
	$jobstatus=mysql_real_escape_string(ucfirst($_POST['jobstatus']));

	
	$opdate=date("Y-m-d");
	
	$id=mysql_real_escape_string($_GET['id']);
	$a=$id.".jpg";
	
	if($_FILES['img']['tmp_name']=="")
	{
		if(($_POST['cl']!="") && ($_POST['sl']!="") && ($_POST['al']!=""))
		{	   
			$qup="UPDATE tbl_faculty SET `facultyid`='$fid',`name`='$name',`fname`='$fname',`mname`='$mname',`sex`='$sex',`dob`='$dob',`mstatus`='$mstatus',`bloodgroup`='$bg',`address`='$paddress',`deptid`='$deptid',`designationid`='$desigid',`joiningdate`='$jdate',`expartincourse`='$expsub',`eduqualification`='$eduq',`expyear`='$eyear',`expmonth`='$emonth',`contactno`='$contactno',`type`='$emptype',`payscaleid`='$payscaleid',`storedstatus`='U',opby='$_SESSION[userid]', alstatus='1', clstatus='1', slstatus='1', `bankaccno`='$bankaccno' , smob='$smob', pfob='$pfob', `smstatus`='$_POST[secmoney]', `pfstatus`='$_POST[profund]', `jobstatus`='$jobstatus' WHERE `id`='$id'";
		} 
		else if(($_POST['cl']!="") && ($_POST['sl']!=""))
		{	   
			$qup="UPDATE tbl_faculty SET `facultyid`='$fid',`name`='$name',`fname`='$fname',`mname`='$mname',`sex`='$sex',`dob`='$dob',`mstatus`='$mstatus',`bloodgroup`='$bg',`address`='$paddress',`deptid`='$deptid',`designationid`='$desigid',`joiningdate`='$jdate',`expartincourse`='$expsub',`eduqualification`='$eduq',`expyear`='$eyear',`expmonth`='$emonth',`contactno`='$contactno',`type`='$emptype',`payscaleid`='$payscaleid',`storedstatus`='U',opby='$_SESSION[userid]', alstatus='0', clstatus='1', slstatus='1', `bankaccno`='$bankaccno' , smob='$smob', pfob='$pfob', `smstatus`='$_POST[secmoney]', `pfstatus`='$_POST[profund]', `jobstatus`='$jobstatus' WHERE `id`='$id'";
		} 
		else if(($_POST['cl']!="") && ($_POST['al']!=""))
		{	   
			$qup="UPDATE tbl_faculty SET `facultyid`='$fid',`name`='$name',`fname`='$fname',`mname`='$mname',`sex`='$sex',`dob`='$dob',`mstatus`='$mstatus',`bloodgroup`='$bg',`address`='$paddress',`deptid`='$deptid',`designationid`='$desigid',`joiningdate`='$jdate',`expartincourse`='$expsub',`eduqualification`='$eduq',`expyear`='$eyear',`expmonth`='$emonth',`contactno`='$contactno',`type`='$emptype',`payscaleid`='$payscaleid',`storedstatus`='U',opby='$_SESSION[userid]', alstatus='1', clstatus='1', slstatus='0', `bankaccno`='$bankaccno' , smob='$smob', pfob='$pfob', `smstatus`='$_POST[secmoney]', `pfstatus`='$_POST[profund]', `jobstatus`='$jobstatus' WHERE `id`='$id'";
		} 
		else if(($_POST['sl']!="") && ($_POST['al']!=""))
		{	   
			$qup="UPDATE tbl_faculty SET `facultyid`='$fid',`name`='$name',`fname`='$fname',`mname`='$mname',`sex`='$sex',`dob`='$dob',`mstatus`='$mstatus',`bloodgroup`='$bg',`address`='$paddress',`deptid`='$deptid',`designationid`='$desigid',`joiningdate`='$jdate',`expartincourse`='$expsub',`eduqualification`='$eduq',`expyear`='$eyear',`expmonth`='$emonth',`contactno`='$contactno',`type`='$emptype',`payscaleid`='$payscaleid',`storedstatus`='U',opby='$_SESSION[userid]', alstatus='1', clstatus='0', slstatus='1', `bankaccno`='$bankaccno', smob='$smob', pfob='$pfob', `smstatus`='$_POST[secmoney]', `pfstatus`='$_POST[profund]', `jobstatus`='$jobstatus' WHERE `id`='$id'";
		} 

		else if($_POST['cl']!="")
		{	 //echo   "cl=".$_POST['cl']; exit;
			$qup="UPDATE tbl_faculty SET `facultyid`='$fid',`name`='$name',`fname`='$fname',`mname`='$mname',`sex`='$sex',`dob`='$dob',`mstatus`='$mstatus',`bloodgroup`='$bg',`address`='$paddress',`deptid`='$deptid',`designationid`='$desigid',`joiningdate`='$jdate',`expartincourse`='$expsub',`eduqualification`='$eduq',`expyear`='$eyear',`expmonth`='$emonth',`contactno`='$contactno',`type`='$emptype',`payscaleid`='$payscaleid',`storedstatus`='U',opby='$_SESSION[userid]', alstatus='0', clstatus='1', slstatus='0', `bankaccno`='$bankaccno', smob='$smob', pfob='$pfob', `smstatus`='$_POST[secmoney]', `pfstatus`='$_POST[profund]', `jobstatus`='$jobstatus' WHERE `id`='$id'";
		} 
		else if($_POST['sl']!="")
		{	   
			$qup="UPDATE tbl_faculty SET `facultyid`='$fid',`name`='$name',`fname`='$fname',`mname`='$mname',`sex`='$sex',`dob`='$dob',`mstatus`='$mstatus',`bloodgroup`='$bg',`address`='$paddress',`deptid`='$deptid',`designationid`='$desigid',`joiningdate`='$jdate',`expartincourse`='$expsub',`eduqualification`='$eduq',`expyear`='$eyear',`expmonth`='$emonth',`contactno`='$contactno',`type`='$emptype',`payscaleid`='$payscaleid',`storedstatus`='U',opby='$_SESSION[userid]', alstatus='0', clstatus='0', slstatus='1', `bankaccno`='$bankaccno', smob='$smob', pfob='$pfob', `smstatus`='$_POST[secmoney]', `pfstatus`='$_POST[profund]', `jobstatus`='$jobstatus' WHERE `id`='$id'";
		} 
		else if($_POST['al']!="")
		{	   
			$qup="UPDATE tbl_faculty SET `facultyid`='$fid',`name`='$name',`fname`='$fname',`mname`='$mname',`sex`='$sex',`dob`='$dob',`mstatus`='$mstatus',`bloodgroup`='$bg',`address`='$paddress',`deptid`='$deptid',`designationid`='$desigid',`joiningdate`='$jdate',`expartincourse`='$expsub',`eduqualification`='$eduq',`expyear`='$eyear',`expmonth`='$emonth',`contactno`='$contactno',`type`='$emptype',`payscaleid`='$payscaleid',`storedstatus`='U',opby='$_SESSION[userid]', alstatus='1', clstatus='0', slstatus='0', `bankaccno`='$bankaccno', smob='$smob', pfob='$pfob', `smstatus`='$_POST[secmoney]', `pfstatus`='$_POST[profund]', `jobstatus`='$jobstatus' WHERE `id`='$id'";
		} 
		else
		{	   
			//echo 	"final else"; exit;
			$qup="UPDATE tbl_faculty SET `facultyid`='$fid',`name`='$name',`fname`='$fname',`mname`='$mname',`sex`='$sex',`dob`='$dob',`mstatus`='$mstatus',`bloodgroup`='$bg',`address`='$paddress',`deptid`='$deptid',`designationid`='$desigid',`joiningdate`='$jdate',`expartincourse`='$expsub',`eduqualification`='$eduq',`expyear`='$eyear',`expmonth`='$emonth',`contactno`='$contactno',`type`='$emptype',`payscaleid`='$payscaleid',`storedstatus`='U',opby='$_SESSION[userid]', alstatus='0', clstatus='0', slstatus='0', `bankaccno`='$bankaccno', smob='$smob', pfob='$pfob', `smstatus`='$_POST[secmoney]', `pfstatus`='$_POST[profund]', `jobstatus`='$jobstatus' WHERE `id`='$id'";
		} 
	}
	else
	{	
		copy($_FILES['img']['tmp_name'],"facultyphoto/".$a);		
		if(($_POST['cl']!="") && ($_POST['sl']!="") && ($_POST['al']!=""))
		{	   
			$qup="UPDATE tbl_faculty SET `facultyid`='$fid',`name`='$name',`fname`='$fname',`mname`='$mname',`sex`='$sex',`dob`='$dob',`mstatus`='$mstatus',`bloodgroup`='$bg',`address`='$paddress',`deptid`='$deptid',`designationid`='$desigid',`joiningdate`='$jdate',`expartincourse`='$expsub',`eduqualification`='$eduq',`expyear`='$eyear',`expmonth`='$emonth',`contactno`='$contactno',`type`='$emptype',`payscaleid`='$payscaleid',`storedstatus`='U', `img`='$a', opby='$_SESSION[userid]', alstatus='1', clstatus='1', slstatus='1', `bankaccno`='$bankaccno', smob='$smob', pfob='$pfob', `smstatus`='$_POST[secmoney]', `pfstatus`='$_POST[profund]', `jobstatus`='$jobstatus' WHERE `id`='$id'";
		} 
		else if(($_POST['cl']!="") && ($_POST['sl']!=""))
		{	   
			$qup="UPDATE tbl_faculty SET `facultyid`='$fid',`name`='$name',`fname`='$fname',`mname`='$mname',`sex`='$sex',`dob`='$dob',`mstatus`='$mstatus',`bloodgroup`='$bg',`address`='$paddress',`deptid`='$deptid',`designationid`='$desigid',`joiningdate`='$jdate',`expartincourse`='$expsub',`eduqualification`='$eduq',`expyear`='$eyear',`expmonth`='$emonth',`contactno`='$contactno',`type`='$emptype',`payscaleid`='$payscaleid',`storedstatus`='U', `img`='$a', opby='$_SESSION[userid]', alstatus='0', clstatus='1', slstatus='1', `bankaccno`='$bankaccno', smob='$smob', pfob='$pfob', `smstatus`='$_POST[secmoney]', `pfstatus`='$_POST[profund]', `jobstatus`='$jobstatus' WHERE `id`='$id'";
		} 
		else if(($_POST['cl']!="") && ($_POST['al']!=""))
		{	   
			$qup="UPDATE tbl_faculty SET `facultyid`='$fid',`name`='$name',`fname`='$fname',`mname`='$mname',`sex`='$sex',`dob`='$dob',`mstatus`='$mstatus',`bloodgroup`='$bg',`address`='$paddress',`deptid`='$deptid',`designationid`='$desigid',`joiningdate`='$jdate',`expartincourse`='$expsub',`eduqualification`='$eduq',`expyear`='$eyear',`expmonth`='$emonth',`contactno`='$contactno',`type`='$emptype',`payscaleid`='$payscaleid',`storedstatus`='U', `img`='$a', opby='$_SESSION[userid]', alstatus='1', clstatus='1', slstatus='0', `bankaccno`='$bankaccno', smob='$smob', pfob='$pfob', `smstatus`='$_POST[secmoney]', `pfstatus`='$_POST[profund]', `jobstatus`='$jobstatus' WHERE `id`='$id'";
		} 
		else if(($_POST['sl']!="") && ($_POST['al']!=""))
		{	   
			$qup="UPDATE tbl_faculty SET `facultyid`='$fid',`name`='$name',`fname`='$fname',`mname`='$mname',`sex`='$sex',`dob`='$dob',`mstatus`='$mstatus',`bloodgroup`='$bg',`address`='$paddress',`deptid`='$deptid',`designationid`='$desigid',`joiningdate`='$jdate',`expartincourse`='$expsub',`eduqualification`='$eduq',`expyear`='$eyear',`expmonth`='$emonth',`contactno`='$contactno',`type`='$emptype',`payscaleid`='$payscaleid',`storedstatus`='U', `img`='$a', opby='$_SESSION[userid]', alstatus='1', clstatus='0', slstatus='1', `bankaccno`='$bankaccno', smob='$smob', pfob='$pfob', `smstatus`='$_POST[secmoney]', `pfstatus`='$_POST[profund]', `jobstatus`='$jobstatus' WHERE `id`='$id'";
		} 

		else if($_POST['cl']!="")
		{	 //echo   "cl=".$_POST['cl']; exit;
			$qup="UPDATE tbl_faculty SET `facultyid`='$fid',`name`='$name',`fname`='$fname',`mname`='$mname',`sex`='$sex',`dob`='$dob',`mstatus`='$mstatus',`bloodgroup`='$bg',`address`='$paddress',`deptid`='$deptid',`designationid`='$desigid',`joiningdate`='$jdate',`expartincourse`='$expsub',`eduqualification`='$eduq',`expyear`='$eyear',`expmonth`='$emonth',`contactno`='$contactno',`type`='$emptype',`payscaleid`='$payscaleid',`storedstatus`='U', `img`='$a', opby='$_SESSION[userid]', alstatus='0', clstatus='1', slstatus='0', `bankaccno`='$bankaccno', smob='$smob', pfob='$pfob', `smstatus`='$_POST[secmoney]', `pfstatus`='$_POST[profund]', `jobstatus`='$jobstatus' WHERE `id`='$id'";
		} 
		else if($_POST['sl']!="")
		{	   
			$qup="UPDATE tbl_faculty SET `facultyid`='$fid',`name`='$name',`fname`='$fname',`mname`='$mname',`sex`='$sex',`dob`='$dob',`mstatus`='$mstatus',`bloodgroup`='$bg',`address`='$paddress',`deptid`='$deptid',`designationid`='$desigid',`joiningdate`='$jdate',`expartincourse`='$expsub',`eduqualification`='$eduq',`expyear`='$eyear',`expmonth`='$emonth',`contactno`='$contactno',`type`='$emptype',`payscaleid`='$payscaleid',`storedstatus`='U', `img`='$a', opby='$_SESSION[userid]', alstatus='0', clstatus='0', slstatus='1', `bankaccno`='$bankaccno', smob='$smob', pfob='$pfob', `smstatus`='$_POST[secmoney]', `pfstatus`='$_POST[profund]', `jobstatus`='$jobstatus' WHERE `id`='$id'";
		} 
		else if($_POST['al']!="")
		{	   
			$qup="UPDATE tbl_faculty SET `facultyid`='$fid',`name`='$name',`fname`='$fname',`mname`='$mname',`sex`='$sex',`dob`='$dob',`mstatus`='$mstatus',`bloodgroup`='$bg',`address`='$paddress',`deptid`='$deptid',`designationid`='$desigid',`joiningdate`='$jdate',`expartincourse`='$expsub',`eduqualification`='$eduq',`expyear`='$eyear',`expmonth`='$emonth',`contactno`='$contactno',`type`='$emptype',`payscaleid`='$payscaleid',`storedstatus`='U', `img`='$a', opby='$_SESSION[userid]', alstatus='1', clstatus='0', slstatus='0', `bankaccno`='$bankaccno', smob='$smob', pfob='$pfob', `smstatus`='$_POST[secmoney]', `pfstatus`='$_POST[profund]', `jobstatus`='$jobstatus' WHERE `id`='$id'";
		} 
		else
		{	   
			//echo 	"final else"; exit;
			$qup="UPDATE tbl_faculty SET `facultyid`='$fid',`name`='$name',`fname`='$fname',`mname`='$mname',`sex`='$sex',`dob`='$dob',`mstatus`='$mstatus',`bloodgroup`='$bg',`address`='$paddress',`deptid`='$deptid',`designationid`='$desigid',`joiningdate`='$jdate',`expartincourse`='$expsub',`eduqualification`='$eduq',`expyear`='$eyear',`expmonth`='$emonth',`contactno`='$contactno',`type`='$emptype',`payscaleid`='$payscaleid',`storedstatus`='U', `img`='$a', opby='$_SESSION[userid]', alstatus='0', clstatus='0', slstatus='0', `bankaccno`='$bankaccno', smob='$smob', pfob='$pfob', `smstatus`='$_POST[secmoney]', `pfstatus`='$_POST[profund]', `jobstatus`='$jobstatus' WHERE `id`='$id'";
		} 

	}


			if(isset($_POST['profund'])!="")
			{
					$apar=$myDb->select("SELECT*FROM tbl_accchart WHERE parentid IN(SELECT id FROM tbl_accchart WHERE parentid=0 AND  accname='Current Liabilities') 
										 AND accname='Employees Provident Fund'");
					while($aparf=$myDb->get_row($apar,'MYSQL_ASSOC'))
					{
							$chkchart=$myDb->select("SELECT*FROM tbl_accchart WHERE empid='$fid' and pro='Y'");
							$chartf=$myDb->get_row($chkchart,'MYSQL_ASSOC');
							$ename="FPro ".$name;
							//$secname="FSec ".$name;			
							if($chartf['empid']==$_POST['fid'])
							{
							   $upc=$myDb->update_sql("UPDATE tbl_accchart SET accname='$ename',
							                                                  pro='$_POST[profund]', 
																			  groupname=(SELECT id FROM tbl_accchart WHERE accname='Employees Provident Fund')
													   WHERE empid='$fid' and pro='Y'");
							}
							else
							{
							  $inschart=$myDb->insert_sql("INSERT INTO tbl_accchart(accname,parentid,groupname,type,opby,opdate,storedstatus,empid,pro,groupalias)
														   VALUES('$ename','$aparf[id]','$aparf[id]',
														          'Trading Account','$_SESSION[userid]',
																  '".date("Y-m-d")."','I','$fid','$_POST[profund]','FPro')");
							
							}
				 	}			
			}
					   
			if(isset($_POST['secmoney'])!="")
			{
					$apar=$myDb->select("SELECT*FROM tbl_accchart WHERE parentid IN(SELECT id FROM tbl_accchart WHERE parentid=0 AND  accname='Current Liabilities') 
										 AND accname='Employee Security Money'");
					while($aparf=$myDb->get_row($apar,'MYSQL_ASSOC'))
					{					
							$chkchart=$myDb->select("SELECT*FROM tbl_accchart WHERE empid='$fid' and sec='Y'");
							$chartf=$myDb->get_row($chkchart,'MYSQL_ASSOC');
							//$ename="FPro ".$name;
							$secname="FSec ".$name;			
							if($chartf['empid']==$_POST['fid'])
							{
							   $upc=$myDb->update_sql("UPDATE tbl_accchart SET accname='$secname'
							                                                  ,sec='$_POST[secmoney]'
																			  , groupname=(SELECT id FROM tbl_accchart WHERE accname='Employee Security Money')
													   WHERE empid='$fid' and sec='Y'");
							
							
							}
							else
							{
							
							  $inschart=$myDb->insert_sql("INSERT INTO tbl_accchart(accname,parentid,groupname,type,opby,opdate,storedstatus,empid,sec,groupalias)
														   VALUES('$secname','$aparf[id]','$aparf[id]','Trading Account',
														   '$_SESSION[userid]','".date("Y-m-d")."','I','$fid','$_POST[secmoney]','FSec')");
							
							}
					}
					
					//--------For Security Money Receivable------------
					$apars=$myDb->select("SELECT*FROM tbl_accchart WHERE parentid IN(SELECT id FROM tbl_accchart WHERE accname='Sundry Debtors') 
												 AND accname='Employees Security Money (Rcv)'");
					while($aparfs=$myDb->get_row($apars,'MYSQL_ASSOC'))
					{	
							$secnameR="FSecRcv ".$name;	
							$chkchart=$myDb->select("SELECT*FROM tbl_accchart WHERE empid='$fid' and secr='Y'");
							$chartf=$myDb->get_row($chkchart,'MYSQL_ASSOC');
							//$ename="FPro ".$name;
							//$secname="FSec ".$name;			
							if($chartf['empid']==$_POST['fid'])
							{
							   $upc=$myDb->update_sql("UPDATE tbl_accchart SET accname='$secnameR'
							                                                  ,sec='$_POST[secmoney]'
																			  , groupname=(SELECT id FROM tbl_accchart WHERE accname='Employees Security Money (Rcv)')
													   WHERE empid='$fid' and secr='Y'");
							
							
							}
							else
							{
								$inschart=$myDb->insert_sql("INSERT INTO tbl_accchart(accname,parentid,groupname,type,opby,opdate,storedstatus,empid,secr,groupalias)
																   VALUES('$secnameR','$aparfs[id]','$aparfs[id]','Trading Account',
																   '$_SESSION[userid]','".date("Y-m-d")."','I','$fid','$_POST[secmoney]','FSecRcv')");
									
							}
					}
					
			}
							//--------For Employee Salary Payable------------
							$aparp=$myDb->select("SELECT*FROM tbl_accchart WHERE parentid IN(SELECT id FROM tbl_accchart WHERE parentid=0 AND  accname='Current Liabilities') 
												 AND accname='Employee Salary Payable'");
							while($aparfp=$myDb->get_row($aparp,'MYSQL_ASSOC'))
							{					
									$salpay="FSalPay ".$name;
									$chkchart=$myDb->select("SELECT*FROM tbl_accchart WHERE empid='".$chkf['sid']."' and salpay='Y'");
									$chartf=$myDb->get_row($chkchart,'MYSQL_ASSOC');
									//$secname="ESalPay ".$name;			
									if($chartf['accname']==$salpay)
									{
									   	$upc=$myDb->update_sql("UPDATE tbl_accchart SET accname='$salpay'
																					  , groupname=(SELECT id FROM tbl_accchart WHERE accname='Employee Salary Payable')
															   WHERE accname='$chartf[accname]' and salpay='Y'");
									}
									else
									{
									  	$inschart=$myDb->insert_sql("INSERT INTO tbl_accchart(accname,parentid,groupname,type,opby,opdate,storedstatus,empid,salpay,groupalias)
																   VALUES('$salpay','$aparfp[id]','$aparfp[id]','Trading Account',
																   '$_SESSION[userid]','".date("Y-m-d")."','I','$sid','Y','FSalPay')");
									}
							}




	if($upd=$myDb->update_sql($qup))
	{
		$msg="Data Updated Successfully";
		//echo $msg;
    	header("Location:managefacultyinfonew.php?msg=$msg");
	}
	else
	{
		$msg=$myDb->last_error;
   		header("Location:managefacultyinfonew.php?msg=$msg");
	}
   }else{
     $msg="Sorry,you are not authorized to access this page";
	 echo $msg;
	 //header("Location:home.html?msg=$msg");
   }	 



}else{
  header("Location:index.php");
}
}