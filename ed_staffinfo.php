<?php ob_start();
session_start();
require_once('dbClass.php');
include("config.php"); 
if($myDb->connect($host,$user,$pwd,$db,true))
{ 
  if($_SESSION['userid']){
  
  $chka="SELECT*FROM  tbl_accdtl WHERE flname='managestaffinfonew.php' AND userid='$_SESSION[userid]'";
  $caq=$myDb->select($chka);
  $car=$myDb->get_row($caq,'MYSQL_ASSOC');
  if(($car['ins']=="y")||($_SESSION['userid']=="administrator")){
  
    
	$name=mysql_real_escape_string(ucfirst($_POST['name']));
	$sid=mysql_real_escape_string($_POST['sid']);
	//$pass=mysql_real_escape_string(ucfirst($_POST['pass']));
	$paddress=mysql_real_escape_string(ucfirst($_POST['paddress']));
	$cellno=mysql_real_escape_string(ucfirst($_POST['cellno']));
	$desigid=mysql_real_escape_string(ucfirst($_POST['desigid']));
	$emptype=mysql_real_escape_string(ucfirst($_POST['emptype']));
	$jdate=mysql_real_escape_string(ucfirst($_POST['jdate']));
	$payscaleid=mysql_real_escape_string(ucfirst($_POST['payscaleid']));
	
	$sex=mysql_real_escape_string(ucfirst($_POST['sex']));
	$jobstatus=mysql_real_escape_string(ucfirst($_POST['jobstatus']));
	$fname=mysql_real_escape_string(ucfirst($_POST['fname']));
	$mname=mysql_real_escape_string(ucfirst($_POST['mname']));
	$dob=mysql_real_escape_string(ucfirst($_POST['dob']));
	$mstatus=mysql_real_escape_string(ucfirst($_POST['mstatus']));
	$religion=mysql_real_escape_string(ucfirst($_POST['religion']));
	$bloodgroup=mysql_real_escape_string(ucfirst($_POST['bg']));
	$smob=mysql_real_escape_string(ucfirst($_POST['smob']));
	$pfob=mysql_real_escape_string(ucfirst($_POST['pfob']));
	$edq=mysql_real_escape_string(ucfirst($_POST['edq']));

	$remarks=mysql_real_escape_string($_POST['remarks']);
	$bankaccno=mysql_real_escape_string($_POST['bankaccno']);
	$id=mysql_real_escape_string($_GET['id']);
	$a=$id.".jpg";
	
	
	$chkfac=$myDb->select("SELECT*FROM tbl_staffinfo WHERE id='$id'");
	$chkf=$myDb->get_row($chkfac,'MYSQL_ASSOC');
	
	
	//$qup="UPDATE tbl_staffinfo SET `name`='$name',`sid`='$sid',`paddress`='$paddress',`sex`='$sex',`cellno`='$cellno',`designationid`='$desigid',`etype`='$emptype',`joindate`='$jdate',`payscaleid`='$payscaleid',`fname`='$fname',`mname`='$mname',`dob`='$dob',`maritalstatus`='$mstatus',`religion`='$religion',`bloodgroup`='$bloodgroup',`remarks`='$remarks',`storedstatus`='U' WHERE `id`='$id'";
	
	if($_FILES['img']['tmp_name']=="")
	{
		if(($_POST['cl']!="") && ($_POST['sl']!="") && ($_POST['al']!=""))
		{	   
			$qup="UPDATE tbl_staffinfo SET `name`='$name',`sid`='$sid',`paddress`='$paddress',`sex`='$sex',`cellno`='$cellno',`designationid`='$desigid',`etype`='$emptype',`joindate`='$jdate',`payscaleid`='$payscaleid',`fname`='$fname',`mname`='$mname',`dob`='$dob',`maritalstatus`='$mstatus',`religion`='$religion',`bloodgroup`='$bloodgroup',`remarks`='$remarks', `bankaccno`='$bankaccno' ,`storedstatus`='U',opby='$_SESSION[userid]', clstatus='1', slstatus='1', alstatus='1', smob='$smob', pfob='$pfob', `edq`='$edq', `smstatus`='$_POST[secmoney]', `pfstatus`='$_POST[profund]', `jobstatus`='$jobstatus'  WHERE `id`='$id'";
		} 
		else if(($_POST['cl']!="") && ($_POST['sl']!=""))
		{	   
			$qup="UPDATE tbl_staffinfo SET `name`='$name',`sid`='$sid',`paddress`='$paddress',`sex`='$sex',`cellno`='$cellno',`designationid`='$desigid',`etype`='$emptype',`joindate`='$jdate',`payscaleid`='$payscaleid',`fname`='$fname',`mname`='$mname',`dob`='$dob',`maritalstatus`='$mstatus',`religion`='$religion',`bloodgroup`='$bloodgroup',`remarks`='$remarks', `bankaccno`='$bankaccno',`storedstatus`='U',opby='$_SESSION[userid]', clstatus='1', slstatus='1', alstatus='0', smob='$smob', pfob='$pfob', `edq`='$edq', `smstatus`='$_POST[secmoney]', `pfstatus`='$_POST[profund]' , `jobstatus`='$jobstatus'  WHERE `id`='$id'";
		} 
		else if(($_POST['cl']!="") && ($_POST['al']!=""))
		{	   
			$qup="UPDATE tbl_staffinfo SET `name`='$name',`sid`='$sid',`paddress`='$paddress',`sex`='$sex',`cellno`='$cellno',`designationid`='$desigid',`etype`='$emptype',`joindate`='$jdate',`payscaleid`='$payscaleid',`fname`='$fname',`mname`='$mname',`dob`='$dob',`maritalstatus`='$mstatus',`religion`='$religion',`bloodgroup`='$bloodgroup',`remarks`='$remarks', `bankaccno`='$bankaccno',`storedstatus`='U',opby='$_SESSION[userid]', clstatus='1', alstatus='1', slstatus='0', smob='$smob', pfob='$pfob', `edq`='$edq', `smstatus`='$_POST[secmoney]', `pfstatus`='$_POST[profund]', `jobstatus`='$jobstatus'  WHERE `id`='$id'";
		} 
		else if(($_POST['sl']!="") && ($_POST['al']!=""))
		{	   
			$qup="UPDATE tbl_staffinfo SET `name`='$name',`sid`='$sid',`paddress`='$paddress',`sex`='$sex',`cellno`='$cellno',`designationid`='$desigid',`etype`='$emptype',`joindate`='$jdate',`payscaleid`='$payscaleid',`fname`='$fname',`mname`='$mname',`dob`='$dob',`maritalstatus`='$mstatus',`religion`='$religion',`bloodgroup`='$bloodgroup',`remarks`='$remarks', `bankaccno`='$bankaccno',`storedstatus`='U',opby='$_SESSION[userid]', slstatus='1', alstatus='1' , clstatus='0', smob='$smob', pfob='$pfob', `edq`='$edq', `smstatus`='$_POST[secmoney]', `pfstatus`='$_POST[profund]', `jobstatus`='$jobstatus'  WHERE `id`='$id'";
		} 

		else if($_POST['cl']!="")
		{	 //echo   "cl=".$_POST['cl']; exit;
			$qup="UPDATE tbl_staffinfo SET `name`='$name',`sid`='$sid',`paddress`='$paddress',`sex`='$sex',`cellno`='$cellno',`designationid`='$desigid',`etype`='$emptype',`joindate`='$jdate',`payscaleid`='$payscaleid',`fname`='$fname',`mname`='$mname',`dob`='$dob',`maritalstatus`='$mstatus',`religion`='$religion',`bloodgroup`='$bloodgroup',`remarks`='$remarks', `bankaccno`='$bankaccno',`storedstatus`='U',opby='$_SESSION[userid]', clstatus='1', alstatus='0' , slstatus='0', smob='$smob', pfob='$pfob', `edq`='$edq', `smstatus`='$_POST[secmoney]', `pfstatus`='$_POST[profund]', `jobstatus`='$jobstatus'  WHERE `id`='$id'";
		} 
		else if($_POST['sl']!="")
		{	   
			$qup="UPDATE tbl_staffinfo SET `name`='$name',`sid`='$sid',`paddress`='$paddress',`sex`='$sex',`cellno`='$cellno',`designationid`='$desigid',`etype`='$emptype',`joindate`='$jdate',`payscaleid`='$payscaleid',`fname`='$fname',`mname`='$mname',`dob`='$dob',`maritalstatus`='$mstatus',`religion`='$religion',`bloodgroup`='$bloodgroup',`remarks`='$remarks', `bankaccno`='$bankaccno',`storedstatus`='U',opby='$_SESSION[userid]', slstatus='1', alstatus='0' , clstatus='0', smob='$smob', pfob='$pfob', `edq`='$edq', `smstatus`='$_POST[secmoney]', `pfstatus`='$_POST[profund]', `jobstatus`='$jobstatus'  WHERE `id`='$id'";
		} 
		else if($_POST['al']!="")
		{	   
			$qup="UPDATE tbl_staffinfo SET `name`='$name',`sid`='$sid',`paddress`='$paddress',`sex`='$sex',`cellno`='$cellno',`designationid`='$desigid',`etype`='$emptype',`joindate`='$jdate',`payscaleid`='$payscaleid',`fname`='$fname',`mname`='$mname',`dob`='$dob',`maritalstatus`='$mstatus',`religion`='$religion',`bloodgroup`='$bloodgroup',`remarks`='$remarks', `bankaccno`='$bankaccno',`storedstatus`='U',opby='$_SESSION[userid]', alstatus='1' , clstatus='0' , slstatus='0', smob='$smob', pfob='$pfob', `edq`='$edq', `smstatus`='$_POST[secmoney]', `pfstatus`='$_POST[profund]', `jobstatus`='$jobstatus'  WHERE `id`='$id'";
		} 
		else
		{	   
			//echo 	"final else"; exit;
			$qup="UPDATE tbl_staffinfo SET `name`='$name',`sid`='$sid',`paddress`='$paddress',`sex`='$sex',`cellno`='$cellno',`designationid`='$desigid',`etype`='$emptype',`joindate`='$jdate',`payscaleid`='$payscaleid',`fname`='$fname',`mname`='$mname',`dob`='$dob',`maritalstatus`='$mstatus',`religion`='$religion',`bloodgroup`='$bloodgroup',`remarks`='$remarks', `bankaccno`='$bankaccno',`storedstatus`='U',opby='$_SESSION[userid]' , alstatus='0' , clstatus='0' , slstatus='0', smob='$smob', pfob='$pfob', `edq`='$edq', `smstatus`='$_POST[secmoney]', `pfstatus`='$_POST[profund]', `jobstatus`='$jobstatus' WHERE `id`='$id'";
		} 

		
		
		if($_POST['profund']!="")
		{
					$apar=$myDb->select("SELECT*FROM tbl_accchart WHERE parentid IN(SELECT id FROM tbl_accchart WHERE parentid=0 AND  accname='Current Liabilities') 
										 AND accname='Employees Provident Fund'");
					while($aparf=$myDb->get_row($apar,'MYSQL_ASSOC'))
					{
					   
							$chkchart=$myDb->select("SELECT*FROM tbl_accchart WHERE empid='".$chkf['sid']."' and pro='Y'");
							$chartf=$myDb->get_row($chkchart,'MYSQL_ASSOC');
							$ename="EPro ".$name;
							$secname="ESec ".$name;			
							if($chartf['empid']==$chkf['sid'])
							{
							//echo "Success first pro"; exit;

							   $upc=$myDb->update_sql("UPDATE tbl_accchart SET accname='$ename',
							                                                  pro='$_POST[profund]', 
																			  groupname=(SELECT id FROM tbl_accchart WHERE accname='Employees Provident Fund')
													   WHERE empid='".$chkf['sid']."' and pro='Y'");
							
							}
							else
							{
								//echo "Success first pro else"; exit;
							  $inschart=$myDb->insert_sql("INSERT INTO tbl_accchart(accname,parentid,groupname,type,opby,opdate,storedstatus,empid,pro,groupalias)
														   VALUES('$ename','$aparf[id]','$aparf[id]',
														          'Trading Account','$_SESSION[userid]',
																  '".date("Y-m-d")."','I','$chkf[sid]','$_POST[profund]','EPro')");
							 
							}
							
							
							
				 	}			
		}
					   



			if($_POST['secmoney']!="")
			{
					$chkfac=$myDb->select("SELECT*FROM tbl_staffinfo WHERE id='$id'");
					$chkf=$myDb->get_row($chkfac,'MYSQL_ASSOC');
					//echo "Security employee id is:".$chkf['sid']; exit;

					$apar=$myDb->select("SELECT*FROM tbl_accchart WHERE parentid IN(SELECT id FROM tbl_accchart WHERE parentid=0 AND  accname='Current Liabilities') 
										 AND accname='Employee Security Money'");
					while($aparf=$myDb->get_row($apar,'MYSQL_ASSOC'))
					{					
							$chkchart=$myDb->select("SELECT*FROM tbl_accchart WHERE empid='".$chkf['sid']."' and sec='Y'");
							$chartf=$myDb->get_row($chkchart,'MYSQL_ASSOC');
								//echo "Security employee id is:".$chartf['empid']; exit;

							//$ename="EPro ".$name;
							$secname="ESec ".$name;			
							if($chartf['empid']==$chkf['sid'])
							{
							//echo "Success first sec"; exit;

							   	$upc=$myDb->update_sql("UPDATE tbl_accchart SET accname='$secname'
							                                                  ,sec='$_POST[secmoney]'
																			  , groupname=(SELECT id FROM tbl_accchart WHERE accname='Employee Security Money')
													   WHERE empid='".$chkf['sid']."' and sec='Y'");
													   
							
							}
							else
							{
								//echo "Success first sec else"; exit;
							  	$inschart=$myDb->insert_sql("INSERT INTO tbl_accchart(accname,parentid,groupname,type,opby,opdate,storedstatus,empid,sec,groupalias)
														   VALUES('$secname','$aparf[id]','$aparf[id]','Trading Account',
														   '$_SESSION[userid]','".date("Y-m-d")."','I','$chkf[sid]','$_POST[secmoney]','ESec')");
							  
							
							}
							
					}
					//--------For Security Money Receivable------------
							$apars=$myDb->select("SELECT*FROM tbl_accchart WHERE parentid IN(SELECT id FROM tbl_accchart WHERE accname='Sundry Debtors') 
												 AND accname='Employees Security Money (Rcv)'");
							while($aparfs=$myDb->get_row($apars,'MYSQL_ASSOC'))
							{					
									$secnameR="ESecRcv ".$name;	
									$chkchartm=$myDb->select("SELECT*FROM tbl_accchart WHERE empid='".$chkf['sid']."' and secr='Y'");
									$chartfm=$myDb->get_row($chkchartm,'MYSQL_ASSOC');
									//$secname="ESecRcv ".$name;			
									if($chartfm['empid']==$_POST['sid']){
									   $upc=$myDb->update_sql("UPDATE tbl_accchart SET accname='$secnameR'
																					  ,sec='$_POST[secmoney]'
																					  , groupname=(SELECT id FROM tbl_accchart WHERE accname='Employees Security Money (Rcv)')
															   WHERE empid='$sid' and secr='Y'");
									
									
									}else{
									
									  $inschart=$myDb->insert_sql("INSERT INTO tbl_accchart(accname,parentid,groupname,type,opby,opdate,storedstatus,empid,secr,groupalias)
																   VALUES('$secnameR','$aparfs[id]','$aparfs[id]','Trading Account',
																   '$_SESSION[userid]','".date("Y-m-d")."','I','$sid','$_POST[secmoney]','ESecRcv')");
									
									}
							 }					
					
			}			
		
							//--------For Employee Salary Payable------------
							$aparp=$myDb->select("SELECT*FROM tbl_accchart WHERE parentid IN(SELECT id FROM tbl_accchart WHERE parentid=0 AND  accname='Current Liabilities') 
												 AND accname='Employee Salary Payable'");
							while($aparfp=$myDb->get_row($aparp,'MYSQL_ASSOC'))
							{					
									$salpay="ESalPay ".$name;
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
																   '$_SESSION[userid]','".date("Y-m-d")."','I','$sid','Y','ESalPay')");
									}
							}

		
	}
	else
	{	
		copy($_FILES['img']['tmp_name'],"staffphoto/".$a);		
		if(($_POST['cl']!="") && ($_POST['sl']!="") && ($_POST['al']!=""))
		{	   
			$qup="UPDATE tbl_staffinfo SET `name`='$name',`sid`='$sid',`paddress`='$paddress',`sex`='$sex',`cellno`='$cellno',`designationid`='$desigid',`etype`='$emptype',`joindate`='$jdate',`payscaleid`='$payscaleid',`fname`='$fname',`mname`='$mname',`dob`='$dob',`maritalstatus`='$mstatus',`religion`='$religion',`bloodgroup`='$bloodgroup',`img`='$a', `remarks`='$remarks', `bankaccno`='$bankaccno',`storedstatus`='U',opby='$_SESSION[userid]', clstatus='1', slstatus='1', alstatus='1', smob='$smob', pfob='$pfob', `edq`='$edq', `smstatus`='$_POST[secmoney]', `pfstatus`='$_POST[profund]', `jobstatus`='$jobstatus' WHERE `id`='$id'";
		} 
		else if(($_POST['cl']!="") && ($_POST['sl']!=""))
		{	   
			$qup="UPDATE tbl_staffinfo SET `name`='$name',`sid`='$sid',`paddress`='$paddress',`sex`='$sex',`cellno`='$cellno',`designationid`='$desigid',`etype`='$emptype',`joindate`='$jdate',`payscaleid`='$payscaleid',`fname`='$fname',`mname`='$mname',`dob`='$dob',`maritalstatus`='$mstatus',`religion`='$religion',`bloodgroup`='$bloodgroup',`img`='$a',`remarks`='$remarks', `bankaccno`='$bankaccno',`storedstatus`='U',opby='$_SESSION[userid]', clstatus='1', slstatus='1', alstatus='0', smob='$smob', pfob='$pfob', `edq`='$edq', `smstatus`='$_POST[secmoney]', `pfstatus`='$_POST[profund]', `jobstatus`='$jobstatus'  WHERE `id`='$id'";
		} 
		else if(($_POST['cl']!="") && ($_POST['al']!=""))
		{	   
			$qup="UPDATE tbl_staffinfo SET `name`='$name',`sid`='$sid',`paddress`='$paddress',`sex`='$sex',`cellno`='$cellno',`designationid`='$desigid',`etype`='$emptype',`joindate`='$jdate',`payscaleid`='$payscaleid',`fname`='$fname',`mname`='$mname',`dob`='$dob',`maritalstatus`='$mstatus',`religion`='$religion',`bloodgroup`='$bloodgroup',`img`='$a',`remarks`='$remarks', `bankaccno`='$bankaccno',`storedstatus`='U',opby='$_SESSION[userid]', clstatus='1', alstatus='1', slstatus='0', smob='$smob', pfob='$pfob', `edq`='$edq', `smstatus`='$_POST[secmoney]', `pfstatus`='$_POST[profund]', `jobstatus`='$jobstatus'  WHERE `id`='$id'";
		} 
		else if(($_POST['sl']!="") && ($_POST['al']!=""))
		{	   
			$qup="UPDATE tbl_staffinfo SET `name`='$name',`sid`='$sid',`paddress`='$paddress',`sex`='$sex',`cellno`='$cellno',`designationid`='$desigid',`etype`='$emptype',`joindate`='$jdate',`payscaleid`='$payscaleid',`fname`='$fname',`mname`='$mname',`dob`='$dob',`maritalstatus`='$mstatus',`religion`='$religion',`bloodgroup`='$bloodgroup',`img`='$a',`remarks`='$remarks', `bankaccno`='$bankaccno',`storedstatus`='U',opby='$_SESSION[userid]', slstatus='1', alstatus='1' , clstatus='0', smob='$smob', pfob='$pfob', `edq`='$edq', `smstatus`='$_POST[secmoney]', `pfstatus`='$_POST[profund]', `jobstatus`='$jobstatus'  WHERE `id`='$id'";
		} 

		else if($_POST['cl']!="")
		{	 //echo   "cl=".$_POST['cl']; exit;
			$qup="UPDATE tbl_staffinfo SET `name`='$name',`sid`='$sid',`paddress`='$paddress',`sex`='$sex',`cellno`='$cellno',`designationid`='$desigid',`etype`='$emptype',`joindate`='$jdate',`payscaleid`='$payscaleid',`fname`='$fname',`mname`='$mname',`dob`='$dob',`maritalstatus`='$mstatus',`religion`='$religion',`bloodgroup`='$bloodgroup',`img`='$a',`remarks`='$remarks', `bankaccno`='$bankaccno',`storedstatus`='U',opby='$_SESSION[userid]', clstatus='1', alstatus='0' , slstatus='0', smob='$smob', pfob='$pfob', `edq`='$edq', `smstatus`='$_POST[secmoney]', `pfstatus`='$_POST[profund]', `jobstatus`='$jobstatus'  WHERE `id`='$id'";
		} 
		else if($_POST['sl']!="")
		{	   
			$qup="UPDATE tbl_staffinfo SET `name`='$name',`sid`='$sid',`paddress`='$paddress',`sex`='$sex',`cellno`='$cellno',`designationid`='$desigid',`etype`='$emptype',`joindate`='$jdate',`payscaleid`='$payscaleid',`fname`='$fname',`mname`='$mname',`dob`='$dob',`maritalstatus`='$mstatus',`religion`='$religion',`bloodgroup`='$bloodgroup',`img`='$a',`remarks`='$remarks', `bankaccno`='$bankaccno',`storedstatus`='U',opby='$_SESSION[userid]', slstatus='1', alstatus='0' , clstatus='0', smob='$smob', pfob='$pfob', `edq`='$edq', `smstatus`='$_POST[secmoney]', `pfstatus`='$_POST[profund]', `jobstatus`='$jobstatus'  WHERE `id`='$id'";
		} 
		else if($_POST['al']!="")
		{	   
			$qup="UPDATE tbl_staffinfo SET `name`='$name',`sid`='$sid',`paddress`='$paddress',`sex`='$sex',`cellno`='$cellno',`designationid`='$desigid',`etype`='$emptype',`joindate`='$jdate',`payscaleid`='$payscaleid',`fname`='$fname',`mname`='$mname',`dob`='$dob',`maritalstatus`='$mstatus',`religion`='$religion',`bloodgroup`='$bloodgroup',`img`='$a',`remarks`='$remarks', `bankaccno`='$bankaccno',`storedstatus`='U',opby='$_SESSION[userid]', alstatus='1' , clstatus='0' , slstatus='0', smob='$smob', pfob='$pfob', `edq`='$edq', `smstatus`='$_POST[secmoney]', `pfstatus`='$_POST[profund]', `jobstatus`='$jobstatus'  WHERE `id`='$id'";
		} 
		else
		{	   
			//echo 	"final else"; exit;
			$qup="UPDATE tbl_staffinfo SET `name`='$name',`sid`='$sid',`paddress`='$paddress',`sex`='$sex',`cellno`='$cellno',`designationid`='$desigid',`etype`='$emptype',`joindate`='$jdate',`payscaleid`='$payscaleid',`fname`='$fname',`mname`='$mname',`dob`='$dob',`maritalstatus`='$mstatus',`religion`='$religion',`bloodgroup`='$bloodgroup',`img`='$a',`remarks`='$remarks', `bankaccno`='$bankaccno',`storedstatus`='U',opby='$_SESSION[userid]' , alstatus='0' , clstatus='0' , slstatus='0', smob='$smob', pfob='$pfob', `edq`='$edq', `smstatus`='$_POST[secmoney]', `pfstatus`='$_POST[profund]', `jobstatus`='$jobstatus'  WHERE `id`='$id'";
		} 
		
		
		
		$chkfac=$myDb->select("SELECT*FROM tbl_staffinfo WHERE id='$id'");
		$chkf=$myDb->get_row($chkfac,'MYSQL_ASSOC');
		
		if($_POST['profund']!="")
		{
					$apar=$myDb->select("SELECT*FROM tbl_accchart WHERE parentid IN(SELECT id FROM tbl_accchart WHERE parentid=0 AND  accname='Current Liabilities') 
										 AND accname='Employees Provident Fund'");
					while($aparf=$myDb->get_row($apar,'MYSQL_ASSOC'))
					{
					   
							$chkchart=$myDb->select("SELECT*FROM tbl_accchart WHERE empid='".$chkf['sid']."' and pro='Y'");
							$chartf=$myDb->get_row($chkchart,'MYSQL_ASSOC');
							$ename="EPro ".$name;
							$secname="ESec ".$name;			
							if($chartf['empid']==$chkf['sid'])
							{
							//echo "Success first pro"; exit;

							   $upc=$myDb->update_sql("UPDATE tbl_accchart SET accname='$ename',
							                                                  pro='$_POST[profund]', 
																			  groupname=(SELECT id FROM tbl_accchart WHERE accname='Employees Provident Fund')
													   WHERE empid='".$chkf['sid']."' and pro='Y'");
							
							}
							else
							{
								//echo "Success first pro else"; exit;
							  $inschart=$myDb->insert_sql("INSERT INTO tbl_accchart(accname,parentid,groupname,type,opby,opdate,storedstatus,empid,pro,groupalias)
														   VALUES('$ename','$aparf[id]','$aparf[id]',
														          'Trading Account','$_SESSION[userid]',
																  '".date("Y-m-d")."','I','$chkf[sid]','$_POST[profund]','EPro')");
							 
							}
							
							
							
				 	}			
		}
					   
		
			if($_POST['secmoney']!="")
			{
					$chkfac=$myDb->select("SELECT*FROM tbl_staffinfo WHERE id='$id'");
					$chkf=$myDb->get_row($chkfac,'MYSQL_ASSOC');
					//echo "Security employee id is:".$chkf['sid']; exit;

					$apar=$myDb->select("SELECT*FROM tbl_accchart WHERE parentid IN(SELECT id FROM tbl_accchart WHERE parentid=0 AND  accname='Current Liabilities') 
										 AND accname='Employee Security Money'");
					while($aparf=$myDb->get_row($apar,'MYSQL_ASSOC'))
					{					
							$chkchart=$myDb->select("SELECT*FROM tbl_accchart WHERE empid='".$chkf['sid']."' and sec='Y'");
							$chartf=$myDb->get_row($chkchart,'MYSQL_ASSOC');
								//echo "Security employee id is:".$chartf['empid']; exit;

							//$ename="EPro ".$name;
							$secname="ESec ".$name;			
							if($chartf['empid']==$chkf['sid'])
							{
							//echo "Success first sec"; exit;

							   	$upc=$myDb->update_sql("UPDATE tbl_accchart SET accname='$secname'
							                                                  ,sec='$_POST[secmoney]'
																			  , groupname=(SELECT id FROM tbl_accchart WHERE accname='Employee Security Money')
													   WHERE empid='".$chkf['sid']."' and sec='Y'");
													   
							
							}
							else
							{
								//echo "Success first sec else"; exit;
							  	$inschart=$myDb->insert_sql("INSERT INTO tbl_accchart(accname,parentid,groupname,type,opby,opdate,storedstatus,empid,sec,groupalias)
														   VALUES('$secname','$aparf[id]','$aparf[id]','Trading Account',
														   '$_SESSION[userid]','".date("Y-m-d")."','I','$chkf[sid]','$_POST[secmoney]','ESec')");
							  
							
							}
							
					}
					//--------For Security Money Receivable------------
							$apars=$myDb->select("SELECT*FROM tbl_accchart WHERE parentid IN(SELECT id FROM tbl_accchart WHERE accname='Sundry Debtors') 
												 AND accname='Employees Security Money (Rcv)'");
							while($aparfs=$myDb->get_row($apars,'MYSQL_ASSOC'))
							{					
									$secnameR="ESecRcv ".$name;	
									$chkchartm=$myDb->select("SELECT*FROM tbl_accchart WHERE empid='".$chkf['sid']."' and secr='Y'");
									$chartfm=$myDb->get_row($chkchartm,'MYSQL_ASSOC');
									//$secname="ESecRcv ".$name;			
									if($chartfm['empid']==$_POST['sid']){ 
									   $upc=$myDb->update_sql("UPDATE tbl_accchart SET accname='$secnameR'
																					  ,sec='$_POST[secmoney]'
																					  , groupname=(SELECT id FROM tbl_accchart WHERE accname='Employees Security Money (Rcv)')
															   WHERE empid='$sid' and secr='Y'");
									
									
									}else{ 
									
									  $inschart=$myDb->insert_sql("INSERT INTO tbl_accchart(accname,parentid,groupname,type,opby,opdate,storedstatus,empid,secr,groupalias)
																   VALUES('$secnameR','$aparfs[id]','$aparfs[id]','Trading Account',
																   '$_SESSION[userid]','".date("Y-m-d")."','I','$sid','$_POST[secmoney]','ESecRcv')");
									
									}
							 }					
					
			}	
							//--------For Employee Salary Payable------------
							$aparp=$myDb->select("SELECT*FROM tbl_accchart WHERE parentid IN(SELECT id FROM tbl_accchart WHERE parentid=0 AND  accname='Current Liabilities') 
												 AND accname='Employee Salary Payable'");
							while($aparfp=$myDb->get_row($aparp,'MYSQL_ASSOC'))
							{					
									$salpay="ESalPay ".$name;
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
																   '$_SESSION[userid]','".date("Y-m-d")."','I','$sid','Y','ESalPay')");
									}
							}
					
		
	}

	if($upd=$myDb->update_sql($qup))
	{
		$msg="Data Updated Successfully";
		//echo $msg;
    	header("Location:managestaffinfonew.php?msg=$msg");
	}
	else
	{
		$msg=$myDb->last_error;
   		header("Location:managestaffinfonew.php?msg=$msg");
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