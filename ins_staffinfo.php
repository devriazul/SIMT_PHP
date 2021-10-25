<?php ob_start();
session_start();
require_once('dbClass.php');
include("config.php"); 
if($myDb->connectDefaultServer())
{ 
  if($_SESSION['userid'])
  { 
  	$chka="SELECT*FROM  tbl_accdtl WHERE flname='managestaffinfonew.php' AND userid='$_SESSION[userid]'";
  	$caq=$myDb->select($chka);
  	$car=$myDb->get_row($caq,'MYSQL_ASSOC');
  	if(($car['ins']=="y")||($_SESSION['userid']=="administrator")){
	
	
	
			$name=mysql_real_escape_string(ucfirst($_POST['name']));
			$sid=mysql_real_escape_string(ucfirst($_POST['sid']));
			$pass=mysql_real_escape_string(md5("123456"));
			$paddress=mysql_real_escape_string(ucfirst($_POST['paddress']));
			$sex=mysql_real_escape_string(ucfirst($_POST['sex']));
			$cellno=mysql_real_escape_string(ucfirst($_POST['cellno']));
			$desigid=mysql_real_escape_string(ucfirst($_POST['desigid']));
			$emptype=mysql_real_escape_string(ucfirst($_POST['emptype']));
			$jdate=mysql_real_escape_string(ucfirst($_POST['jdate']));
			$payscaleid=mysql_real_escape_string(ucfirst($_POST['payscaleid']));
			$fname=mysql_real_escape_string(ucfirst($_POST['fname']));
			$mname=mysql_real_escape_string(ucfirst($_POST['mname']));
			$dob=mysql_real_escape_string(ucfirst($_POST['dob']));
			$mstatus=mysql_real_escape_string(ucfirst($_POST['mstatus']));
			$religion=mysql_real_escape_string(ucfirst($_POST['religion']));
			$bloodgroup=mysql_real_escape_string(ucfirst($_POST['bg']));
			$edq=mysql_real_escape_string(ucfirst($_POST['edq']));
			$remarks=mysql_real_escape_string($_POST['remarks']);
			$bankaccno=mysql_real_escape_string($_POST['bankaccno']);
			$opdate=date("Y-m-d");
			$smob=mysql_real_escape_string($_POST['smob']);
			$pfob=mysql_real_escape_string($_POST['pfob']);
		
			$midx=mysql_query("select max(id) from tbl_staffinfo") or die(mysql_error());
			$mfetch=mysql_fetch_array($midx);
			$maxid=$mfetch["max(id)"];
			$maxid=$maxid+1;
			$a=$maxid.".jpg";
			if($_FILES['img']['tmp_name']=="")
			{
				if(($_POST['cl']!="") && ($_POST['sl']!="") && ($_POST['al']!=""))
				{	   
					$query="INSERT INTO   tbl_staffinfo(`name`,`sid`,`paddress`,`sex`,`cellno`,`designationid`,`etype`,`joindate`,`payscaleid`,`fname`,`mname`,`dob`,`maritalstatus`,`religion`,`bloodgroup`,`remarks`, `bankaccno`,`clstatus`,`slstatus`,`alstatus`,`opby`,`opdate`,`storedstatus`,`smob`,`pfob`,`edq`,`smstatus`,`pfstatus`) VALUES('$name','$sid','$paddress','$sex','$cellno','$desigid','$emptype','$jdate','$payscaleid','$fname','$mname','$dob','$mstatus','$religion','$bloodgroup','$remarks','$bankaccno','1','1','1','$_SESSION[userid]','$opdate','I','$smob','$pfob','$edq','$_POST[secmoney]','$_POST[profund]')";
					$query1="INSERT INTO   tbl_login(`userid`,`password`,`accid`,`storedstatus`) VALUES('$sid','$pass','41','I')";
				} 
				else if(($_POST['cl']!="") && ($_POST['sl']!=""))
				{	   
					$query="INSERT INTO   tbl_staffinfo(`name`,`sid`,`paddress`,`sex`,`cellno`,`designationid`,`etype`,`joindate`,`payscaleid`,`fname`,`mname`,`dob`,`maritalstatus`,`religion`,`bloodgroup`,`remarks`, `bankaccno`,`clstatus`,`slstatus`,`opby`,`opdate`,`storedstatus`,`smob`,`pfob`,`edq`,`smstatus`,`pfstatus`) VALUES('$name','$sid','$paddress','$sex','$cellno','$desigid','$emptype','$jdate','$payscaleid','$fname','$mname','$dob','$mstatus','$religion','$bloodgroup','$remarks','$bankaccno','1','1','$_SESSION[userid]','$opdate','I','$smob','$pfob','$edq','$_POST[secmoney]','$_POST[profund]')";
					$query1="INSERT INTO   tbl_login(`userid`,`password`,`accid`,`storedstatus`) VALUES('$sid','$pass','41','I')";
				} 
				else if(($_POST['cl']!="") && ($_POST['al']!=""))
				{	   
					$query="INSERT INTO   tbl_staffinfo(`name`,`sid`,`paddress`,`sex`,`cellno`,`designationid`,`etype`,`joindate`,`payscaleid`,`fname`,`mname`,`dob`,`maritalstatus`,`religion`,`bloodgroup`,`remarks`, `bankaccno`,`clstatus`,`alstatus`,`opby`,`opdate`,`storedstatus`,`smob`,`pfob`,`edq`,`smstatus`,`pfstatus`) VALUES('$name','$sid','$paddress','$sex','$cellno','$desigid','$emptype','$jdate','$payscaleid','$fname','$mname','$dob','$mstatus','$religion','$bloodgroup','$remarks','$bankaccno','1','1','$_SESSION[userid]','$opdate','I','$smob','$pfob','$edq','$_POST[secmoney]','$_POST[profund]')";
					$query1="INSERT INTO   tbl_login(`userid`,`password`,`accid`,`storedstatus`) VALUES('$sid','$pass','41','I')";
				} 
				else if(($_POST['sl']!="") && ($_POST['al']!=""))
				{	   
					$query="INSERT INTO   tbl_staffinfo(`name`,`sid`,`paddress`,`sex`,`cellno`,`designationid`,`etype`,`joindate`,`payscaleid`,`fname`,`mname`,`dob`,`maritalstatus`,`religion`,`bloodgroup`,`remarks`, `bankaccno`,`slstatus`,`alstatus`,`opby`,`opdate`,`storedstatus`,`smob`,`pfob`,`edq`,`smstatus`,`pfstatus`) VALUES('$name','$sid','$paddress','$sex','$cellno','$desigid','$emptype','$jdate','$payscaleid','$fname','$mname','$dob','$mstatus','$religion','$bloodgroup','$remarks','$bankaccno','1','1','$_SESSION[userid]','$opdate','I','$smob','$pfob','$edq','$_POST[secmoney]','$_POST[profund]')";
					$query1="INSERT INTO   tbl_login(`userid`,`password`,`accid`,`storedstatus`) VALUES('$sid','$pass','41','I')";
				} 
		
				else if($_POST['cl']!="")
				{	   
					$query="INSERT INTO   tbl_staffinfo(`name`,`sid`,`paddress`,`sex`,`cellno`,`designationid`,`etype`,`joindate`,`payscaleid`,`fname`,`mname`,`dob`,`maritalstatus`,`religion`,`bloodgroup`,`remarks`, `bankaccno`,`clstatus`,`opby`,`opdate`,`storedstatus`,`smob`,`pfob`,`edq`,`smstatus`,`pfstatus`) VALUES('$name','$sid','$paddress','$sex','$cellno','$desigid','$emptype','$jdate','$payscaleid','$fname','$mname','$dob','$mstatus','$religion','$bloodgroup','$remarks','$bankaccno','1','$_SESSION[userid]','$opdate','I','$smob','$pfob','$edq','$_POST[secmoney]','$_POST[profund]')";
					$query1="INSERT INTO   tbl_login(`userid`,`password`,`accid`,`storedstatus`) VALUES('$sid','$pass','41','I')";
				} 
				else if($_POST['sl']!="")
				{	   
					$query="INSERT INTO   tbl_staffinfo(`name`,`sid`,`paddress`,`sex`,`cellno`,`designationid`,`etype`,`joindate`,`payscaleid`,`fname`,`mname`,`dob`,`maritalstatus`,`religion`,`bloodgroup`,`remarks`, `bankaccno`,`slstatus`,`opby`,`opdate`,`storedstatus`,`smob`,`pfob`,`edq`,`smstatus`,`pfstatus`) VALUES('$name','$sid','$paddress','$sex','$cellno','$desigid','$emptype','$jdate','$payscaleid','$fname','$mname','$dob','$mstatus','$religion','$bloodgroup','$remarks','$bankaccno','1','$_SESSION[userid]','$opdate','I','$smob','$pfob','$edq','$_POST[secmoney]','$_POST[profund]')";
					$query1="INSERT INTO   tbl_login(`userid`,`password`,`accid`,`storedstatus`) VALUES('$sid','$pass','41','I')";
				} 
				else if($_POST['al']!="")
				{	   
					$query="INSERT INTO   tbl_staffinfo(`name`,`sid`,`paddress`,`sex`,`cellno`,`designationid`,`etype`,`joindate`,`payscaleid`,`fname`,`mname`,`dob`,`maritalstatus`,`religion`,`bloodgroup`,`remarks`, `bankaccno`,`alstatus`,`opby`,`opdate`,`storedstatus`,`smob`,`pfob`,`edq,`smstatus`,`pfstatus``) VALUES('$name','$sid','$paddress','$sex','$cellno','$desigid','$emptype','$jdate','$payscaleid','$fname','$mname','$dob','$mstatus','$religion','$bloodgroup','$remarks','$bankaccno','1','$_SESSION[userid]','$opdate','I','$smob','$pfob','$edq','$_POST[secmoney]','$_POST[profund]')";
					$query1="INSERT INTO   tbl_login(`userid`,`password`,`accid`,`storedstatus`) VALUES('$sid','$pass','41','I')";
				} 
				else
				{	   
					$query="INSERT INTO   tbl_staffinfo(`name`,`sid`,`paddress`,`sex`,`cellno`,`designationid`,`etype`,`joindate`,`payscaleid`,`fname`,`mname`,`dob`,`maritalstatus`,`religion`,`bloodgroup`,`remarks`, `bankaccno`,`opby`,`opdate`,`storedstatus`,`smob`,`pfob`,`edq`,`smstatus`,`pfstatus`) VALUES('$name','$sid','$paddress','$sex','$cellno','$desigid','$emptype','$jdate','$payscaleid','$fname','$mname','$dob','$mstatus','$religion','$bloodgroup','$remarks','$bankaccno','$_SESSION[userid]','$opdate','I','$smob','$pfob','$edq','$_POST[secmoney]','$_POST[profund]')";
					$query1="INSERT INTO   tbl_login(`userid`,`password`,`accid`,`storedstatus`) VALUES('$sid','$pass','41','I')";
				} 
		
			
					if($_POST['profund']!="")
					{
							$apar=$myDb->select("SELECT*FROM tbl_accchart WHERE parentid IN(SELECT id FROM tbl_accchart WHERE parentid=0 AND  accname='Current Liabilities') 
												 AND accname='Employees Provident Fund'");
							while($aparf=$myDb->get_row($apar,'MYSQL_ASSOC'))
							{
							   
									$chkchart=$myDb->select("SELECT*FROM tbl_accchart WHERE empid='$sid'");
									$chartf=$myDb->get_row($chkchart,'MYSQL_ASSOC');
									$ename="EPro ".$name;
									//$secname="ESec ".$name;			
									/*if($chartf['empid']==$_POST['sid'])
									{
									   $upc=$myDb->update_sql("UPDATE tbl_accchar SET accname='$ename',
																					  pro='$_POST[profund]', 
																					  groupname=(SELECT id FROM tbl_accchart WHERE accname='Employees Provident Fund')
															   WHERE empid='$sid'");
									
									
									}else{
									*/
									  $inschart=$myDb->insert_sql("INSERT INTO tbl_accchart(accname,parentid,groupname,type,opby,opdate,storedstatus,empid,pro,groupalias)
																   VALUES('$ename','$aparf[id]','$aparf[id]',
																		  'Trading Account','$_SESSION[userid]',
																		  '".date("Y-m-d")."','I','$sid','$_POST[profund]','EPro')");
									
									//}
						 	}			
					}
							   
					if($_POST['secmoney']!="")
					{
							$apar=$myDb->select("SELECT*FROM tbl_accchart WHERE parentid IN(SELECT id FROM tbl_accchart WHERE parentid=0 AND  accname='Current Liabilities') 
												 AND accname='Employee Security Money'");
							while($aparf=$myDb->get_row($apar,'MYSQL_ASSOC')){					
							$chkchart=$myDb->select("SELECT*FROM tbl_accchart WHERE empid='$sid'");
									$chartf=$myDb->get_row($chkchart,'MYSQL_ASSOC');
									//$ename="EPro ".$name;
									$secname="ESec ".$name;			
									/*if($chartf['empid']==$_POST['sid']){ echo "ache"; echo "UPDATE tbl_accchar SET accname='$secname'
																					  ,sec='$_POST[secmoney]'
																					  , groupname=(SELECT id FROM tbl_accchart WHERE accname='Employee Security Money')
															   WHERE empid='$sid'"; exit;
									   $upc=$myDb->update_sql("UPDATE tbl_accchar SET accname='$secname'
																					  ,sec='$_POST[secmoney]'
																					  , groupname=(SELECT id FROM tbl_accchart WHERE accname='Employee Security Money')
															   WHERE empid='$sid'");
									
									
									}else{ echo "nei";
									echo "INSERT INTO tbl_accchart(accname,parentid,groupname,type,opby,opdate,storedstatus,empid,sec)
																   VALUES('$secname','$aparf[id]','$aparf[id]','Expense Account',
																   '$_SESSION[userid]','".date("Y-m-d")."','I','$sid','$_POST[secmoney]')"; exit;*/
																   
									  $inschart=$myDb->insert_sql("INSERT INTO tbl_accchart(accname,parentid,groupname,type,opby,opdate,storedstatus,empid,sec,groupalias)
																   VALUES('$secname','$aparf[id]','$aparf[id]','Trading Account',
																   '$_SESSION[userid]','".date("Y-m-d")."','I','$sid','$_POST[secmoney]','ESec')");
									
									//}
							   }
							   
							//--------For Security Money Receivable------------
							$apars=$myDb->select("SELECT*FROM tbl_accchart WHERE parentid IN(SELECT id FROM tbl_accchart WHERE accname='Sundry Debtors') 
												 AND accname='Employees Security Money (Rcv)'");
							while($aparfs=$myDb->get_row($apars,'MYSQL_ASSOC'))
							{					
								$secnameR="ESecRcv ".$name;	
								/*$chkchart=$myDb->select("SELECT*FROM tbl_accchart WHERE empid='$sid'");
									$chartf=$myDb->get_row($chkchart,'MYSQL_ASSOC');
									$secname="ESecRcv ".$name;			
									if($chartf['empid']==$_POST['sid']){
									   $upc=$myDb->update_sql("UPDATE tbl_accchar SET accname='$secname'
																					  ,sec='$_POST[secmoney]'
																					  , groupname=(SELECT id FROM tbl_accchart WHERE accname='Employees Security Money (Rcv)')
															   WHERE empid='$sid'");
									
									
									}else{
									*/
									  $inschart=$myDb->insert_sql("INSERT INTO tbl_accchart(accname,parentid,groupname,type,opby,opdate,storedstatus,empid,secr,groupalias)
																   VALUES('$secnameR','$aparfs[id]','$aparfs[id]','Trading Account',
																   '$_SESSION[userid]','".date("Y-m-d")."','I','$sid','$_POST[secmoney]','ESecRcv')");
									
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
							while($aparfp=$myDb->get_row($aparp,'MYSQL_ASSOC')){					$secname="ESalPay ".$name;
							/*$chkchart=$myDb->select("SELECT*FROM tbl_accchart WHERE empid='$sid'");
									$chartf=$myDb->get_row($chkchart,'MYSQL_ASSOC');
									//$ename="EPro ".$name;
									$secname="ESalPay ".$name;			
									if($chartf['empid']==$_POST['sid']){
									   $upc=$myDb->update_sql("UPDATE tbl_accchar SET accname='$secname'
																					  ,sec='$_POST[secmoney]'
																					  , groupname=(SELECT id FROM tbl_accchart WHERE accname='Employee Salary Payable')
															   WHERE empid='$sid'");
									
									
									}else{
									*/
									  $inschart=$myDb->insert_sql("INSERT INTO tbl_accchart(accname,parentid,groupname,type,opby,opdate,storedstatus,empid,salpay,groupalias)
																   VALUES('$secname','$aparfp[id]','$aparfp[id]','Trading Account',
																   '$_SESSION[userid]','".date("Y-m-d")."','I','$sid','Y','ESalPay')");
									
									//}
							   }
			   
			   
					
			
			}
			else
			{	
				copy($_FILES['img']['tmp_name'],"staffphoto/".$a);		
				if(($_POST['cl']!="") && ($_POST['sl']!="") && ($_POST['al']!=""))
				{	   
					$query="INSERT INTO   tbl_staffinfo(`name`,`sid`,`paddress`,`sex`,`cellno`,`designationid`,`etype`,`joindate`,`payscaleid`,`fname`,`mname`,`dob`,`maritalstatus`,`religion`,`bloodgroup`,`img`,`remarks`, `bankaccno`,`clstatus`,`slstatus`,`alstatus`,`opby`,`opdate`,`storedstatus`,`smob`,`pfob`,`edq`,`smstatus`,`pfstatus`) VALUES('$name','$sid','$paddress','$sex','$cellno','$desigid','$emptype','$jdate','$payscaleid','$fname','$mname','$dob','$mstatus','$religion','$bloodgroup','$a','$remarks','$bankaccno','1','1','1','$_SESSION[userid]','$opdate','I','$smob','$pfob','$edq','$_POST[secmoney]','$_POST[profund]')";
					$query1="INSERT INTO   tbl_login(`userid`,`password`,`accid`,`storedstatus`) VALUES('$sid','$pass','41','I')";
				} 
				else if(($_POST['cl']!="") && ($_POST['sl']!=""))
				{	   
					$query="INSERT INTO   tbl_staffinfo(`name`,`sid`,`paddress`,`sex`,`cellno`,`designationid`,`etype`,`joindate`,`payscaleid`,`fname`,`mname`,`dob`,`maritalstatus`,`religion`,`bloodgroup`,`img`,`remarks`, `bankaccno`,`clstatus`,`slstatus`,`opby`,`opdate`,`storedstatus`,`smob`,`pfob`,`edq`,`smstatus`,`pfstatus`) VALUES('$name','$sid','$paddress','$sex','$cellno','$desigid','$emptype','$jdate','$payscaleid','$fname','$mname','$dob','$mstatus','$religion','$bloodgroup','$a','$remarks','$bankaccno','1','1','$_SESSION[userid]','$opdate','I','$smob','$pfob','$edq','$_POST[secmoney]','$_POST[profund]')";
					$query1="INSERT INTO   tbl_login(`userid`,`password`,`accid`,`storedstatus`) VALUES('$sid','$pass','41','I')";
				} 
				else if(($_POST['cl']!="") && ($_POST['al']!=""))
				{	   
					$query="INSERT INTO   tbl_staffinfo(`name`,`sid`,`paddress`,`sex`,`cellno`,`designationid`,`etype`,`joindate`,`payscaleid`,`fname`,`mname`,`dob`,`maritalstatus`,`religion`,`bloodgroup`,`img`,`remarks`, `bankaccno`,`clstatus`,`alstatus`,`opby`,`opdate`,`storedstatus`,`smob`,`pfob`,`edq`,`smstatus`,`pfstatus`) VALUES('$name','$sid','$paddress','$sex','$cellno','$desigid','$emptype','$jdate','$payscaleid','$fname','$mname','$dob','$mstatus','$religion','$bloodgroup','$a','$remarks','$bankaccno','1','1','$_SESSION[userid]','$opdate','I','$smob','$pfob','$edq','$_POST[secmoney]','$_POST[profund]')";
					$query1="INSERT INTO   tbl_login(`userid`,`password`,`accid`,`storedstatus`) VALUES('$sid','$pass','41','I')";
				} 
				else if(($_POST['sl']!="") && ($_POST['al']!=""))
				{	   
					$query="INSERT INTO   tbl_staffinfo(`name`,`sid`,`paddress`,`sex`,`cellno`,`designationid`,`etype`,`joindate`,`payscaleid`,`fname`,`mname`,`dob`,`maritalstatus`,`religion`,`bloodgroup`,`img`,`remarks`, `bankaccno`,`slstatus`,`alstatus`,`opby`,`opdate`,`storedstatus`,`smob`,`pfob`,`edq`,`smstatus`,`pfstatus`) VALUES('$name','$sid','$paddress','$sex','$cellno','$desigid','$emptype','$jdate','$payscaleid','$fname','$mname','$dob','$mstatus','$religion','$bloodgroup','$a','$remarks','$bankaccno','1','1','$_SESSION[userid]','$opdate','I','$smob','$pfob','$edq','$_POST[secmoney]','$_POST[profund]')";
					$query1="INSERT INTO   tbl_login(`userid`,`password`,`accid`,`storedstatus`) VALUES('$sid','$pass','41','I')";
				} 
		
				else if($_POST['cl']!="")
				{	   
					$query="INSERT INTO   tbl_staffinfo(`name`,`sid`,`paddress`,`sex`,`cellno`,`designationid`,`etype`,`joindate`,`payscaleid`,`fname`,`mname`,`dob`,`maritalstatus`,`religion`,`bloodgroup`,`img`,`remarks`, `bankaccno`,`clstatus`,`opby`,`opdate`,`storedstatus`,`smob`,`pfob`,`edq`,`smstatus`,`pfstatus`) VALUES('$name','$sid','$paddress','$sex','$cellno','$desigid','$emptype','$jdate','$payscaleid','$fname','$mname','$dob','$mstatus','$religion','$bloodgroup','$a','$remarks','$bankaccno','1','$_SESSION[userid]','$opdate','I','$smob','$pfob','$edq','$_POST[secmoney]','$_POST[profund]')";
					$query1="INSERT INTO   tbl_login(`userid`,`password`,`accid`,`storedstatus`) VALUES('$sid','$pass','41','I')";
				} 
				else if($_POST['sl']!="")
				{	   
					$query="INSERT INTO   tbl_staffinfo(`name`,`sid`,`paddress`,`sex`,`cellno`,`designationid`,`etype`,`joindate`,`payscaleid`,`fname`,`mname`,`dob`,`maritalstatus`,`religion`,`bloodgroup`,`img`,`remarks`, `bankaccno`,`slstatus`,`opby`,`opdate`,`storedstatus`,`smob`,`pfob`,`edq`,`smstatus`,`pfstatus`) VALUES('$name','$sid','$paddress','$sex','$cellno','$desigid','$emptype','$jdate','$payscaleid','$fname','$mname','$dob','$mstatus','$religion','$bloodgroup','$a','$remarks','$bankaccno','1','$_SESSION[userid]','$opdate','I','$smob','$pfob','$edq','$_POST[secmoney]','$_POST[profund]')";
					$query1="INSERT INTO   tbl_login(`userid`,`password`,`accid`,`storedstatus`) VALUES('$sid','$pass','41','I')";
				} 
				else if($_POST['al']!="")
				{	   
					$query="INSERT INTO   tbl_staffinfo(`name`,`sid`,`paddress`,`sex`,`cellno`,`designationid`,`etype`,`joindate`,`payscaleid`,`fname`,`mname`,`dob`,`maritalstatus`,`religion`,`bloodgroup`,`img`,`remarks`, `bankaccno`,`alstatus`,`opby`,`opdate`,`storedstatus`,`smob`,`pfob`,`edq`,`smstatus`,`pfstatus`) VALUES('$name','$sid','$paddress','$sex','$cellno','$desigid','$emptype','$jdate','$payscaleid','$fname','$mname','$dob','$mstatus','$religion','$bloodgroup','$a','$remarks','$bankaccno','1','$_SESSION[userid]','$opdate','I','$smob','$pfob','$edq','$_POST[secmoney]','$_POST[profund]')";
					$query1="INSERT INTO   tbl_login(`userid`,`password`,`accid`,`storedstatus`) VALUES('$sid','$pass','41','I')";
				} 
				else
				{	   
					$query="INSERT INTO   tbl_staffinfo(`name`,`sid`,`paddress`,`sex`,`cellno`,`designationid`,`etype`,`joindate`,`payscaleid`,`fname`,`mname`,`dob`,`maritalstatus`,`religion`,`bloodgroup`,`img`,`remarks`, `bankaccno`,`opby`,`opdate`,`storedstatus`,`smob`,`pfob`,`edq`,`smstatus`,`pfstatus`) VALUES('$name','$sid','$paddress','$sex','$cellno','$desigid','$emptype','$jdate','$payscaleid','$fname','$mname','$dob','$mstatus','$religion','$bloodgroup','$a','$remarks','$bankaccno','$_SESSION[userid]','$opdate','I','$smob','$pfob','$edq','$_POST[secmoney]','$_POST[profund]')";
					$query1="INSERT INTO   tbl_login(`userid`,`password`,`accid`,`storedstatus`) VALUES('$sid','$pass','41','I')";
				} 
				
					if($_POST['profund']!=""){
							$apar=$myDb->select("SELECT*FROM tbl_accchart WHERE parentid IN(SELECT id FROM tbl_accchart WHERE parentid=0 AND  accname='Current Liabilities') 
												 AND accname='Employees Provident Fund'");
							while($aparf=$myDb->get_row($apar,'MYSQL_ASSOC')){
							   
									$chkchart=$myDb->select("SELECT*FROM tbl_accchart WHERE empid='$sid'");
									$chartf=$myDb->get_row($chkchart,'MYSQL_ASSOC');
									$ename="EPro ".$name;
									//$secname="ESec ".$name;			
									/*if($chartf['empid']==$_POST['sid']){
									   $upc=$myDb->update_sql("UPDATE tbl_accchar SET accname='$ename',
																					  pro='$_POST[profund]', 
																					  groupname=(SELECT id FROM tbl_accchart WHERE accname='Employees Provident Fund')
															   WHERE empid='$sid'");
									
									
									}else{
									*/
									  $inschart=$myDb->insert_sql("INSERT INTO tbl_accchart(accname,parentid,groupname,type,opby,opdate,storedstatus,empid,pro,groupalias)
																   VALUES('$ename','$aparf[id]','$aparf[id]',
																		  'Trading Account','$_SESSION[userid]',
																		  '".date("Y-m-d")."','I','$sid','$_POST[profund]','EPro')");
									
									//}
						 }			
					}
							   
					if($_POST['secmoney']!="")
					{
							$apar=$myDb->select("SELECT*FROM tbl_accchart WHERE parentid IN(SELECT id FROM tbl_accchart WHERE parentid=0 AND  accname='Current Liabilities') 
												 AND accname='Employee Security Money'");
							while($aparf=$myDb->get_row($apar,'MYSQL_ASSOC'))
							{					
									$chkchart=$myDb->select("SELECT*FROM tbl_accchart WHERE empid='$sid'");
									$chartf=$myDb->get_row($chkchart,'MYSQL_ASSOC');
									//$ename="EPro ".$name;
									$secname="ESec ".$name;			
									/*if($chartf['empid']==$_POST['sid'])
									{
									   $upc=$myDb->update_sql("UPDATE tbl_accchar SET accname='$secname'
																					  ,sec='$_POST[secmoney]'
																					  , groupname=(SELECT id FROM tbl_accchart WHERE accname='Employee Security Money')
															   WHERE empid='$sid'");
									
									
									}else{
									*/
									  $inschart=$myDb->insert_sql("INSERT INTO tbl_accchart(accname,parentid,groupname,type,opby,opdate,storedstatus,empid,sec,groupalias)
																   VALUES('$secname','$aparf[id]','$aparf[id]','Trading Account',
																   '$_SESSION[userid]','".date("Y-m-d")."','I','$sid','$_POST[secmoney]','ESec')");
									
									//}
							   }
							   
							//--------For Security Money Receivable------------
							$apars=$myDb->select("SELECT*FROM tbl_accchart WHERE parentid IN(SELECT id FROM tbl_accchart WHERE accname='Sundry Debtors') 
												 AND accname='Employees Security Money (Rcv)'");
							while($aparfs=$myDb->get_row($apars,'MYSQL_ASSOC')){					$secnameR="ESecRcv ".$name;	
							/*$chkchart=$myDb->select("SELECT*FROM tbl_accchart WHERE empid='$sid'");
									$chartf=$myDb->get_row($chkchart,'MYSQL_ASSOC');
									$secname="ESecRcv ".$name;			
									if($chartf['empid']==$_POST['sid']){
									   $upc=$myDb->update_sql("UPDATE tbl_accchar SET accname='$secname'
																					  ,sec='$_POST[secmoney]'
																					  , groupname=(SELECT id FROM tbl_accchart WHERE accname='Employees Security Money (Rcv)')
															   WHERE empid='$sid'");
									
									
									}else{
									*/
									  $inschart=$myDb->insert_sql("INSERT INTO tbl_accchart(accname,parentid,groupname,type,opby,opdate,storedstatus,empid,secr,groupalias)
																   VALUES('$secnameR','$aparfs[id]','$aparfs[id]','Trading Account',
																   '$_SESSION[userid]','".date("Y-m-d")."','I','$sid','$_POST[secmoney]','ESecRcv')");
									
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
							while($aparfp=$myDb->get_row($aparp,'MYSQL_ASSOC')){					$secname="ESalPay ".$name;
							/*$chkchart=$myDb->select("SELECT*FROM tbl_accchart WHERE empid='$sid'");
									$chartf=$myDb->get_row($chkchart,'MYSQL_ASSOC');
									//$ename="EPro ".$name;
									$secname="ESalPay ".$name;			
									if($chartf['empid']==$_POST['sid']){
									   $upc=$myDb->update_sql("UPDATE tbl_accchar SET accname='$secname'
																					  ,sec='$_POST[secmoney]'
																					  , groupname=(SELECT id FROM tbl_accchart WHERE accname='Employee Salary Payable')
															   WHERE empid='$sid'");
									
									
									}else{
									*/
									  $inschart=$myDb->insert_sql("INSERT INTO tbl_accchart(accname,parentid,groupname,type,opby,opdate,storedstatus,empid,salpay,groupalias)
																   VALUES('$secname','$aparfp[id]','$aparfp[id]','Trading Account',
																   '$_SESSION[userid]','".date("Y-m-d")."','I','$sid','Y','ESalPay')");
									
									//}
							   }
			   
			
				
			}
			if($myDb->insert_sql($query) && $myDb->insert_sql($query1))
			{
				$msg="Data inserted successfully";
				header("Location:add_staffinfo.php?msg=$msg");
		
			}
			else
			{
				$msg=$myDb->last_error;
				header("Location:add_staffinfo.php?msg=$msg");
				//echo $msg;
			}   
		  }
			//header("Location:add_hostelname.html?msg=$msg");
	}else{
		 $msg="Sorry,you are not authorized to access this page";
		 header("Location:home.php?msg=$msg");
	}	 
}else{
  header("Location:index.php");
}