<?php ob_start();
session_start();
require_once('dbClass.php');
include("config.php"); 
if($myDb->connect($host,$user,$pwd,$db,true))
{ 
  if($_SESSION['userid']){ 

	$monthname=mysql_real_escape_string($_POST['smonth']);
	$yearname=mysql_real_escape_string($_POST['syear']);
	$tworkingdays=mysql_real_escape_string($_POST['workingdays']);
	$efid=mysql_real_escape_string($_POST['efid']);
	$efname=mysql_real_escape_string($_POST['efname']);
	$desig=mysql_real_escape_string($_POST['desig']);
	$payscale=mysql_real_escape_string($_POST['payscale']);
	$lateattnd=mysql_real_escape_string($_POST['lateattnd']);
	$absinoffice=mysql_real_escape_string($_POST['absinoffice']);
	$totabs=mysql_real_escape_string($_POST['totabs']);
	$totleave=mysql_real_escape_string($_POST['totleave']);
	$basicpay=mysql_real_escape_string($_POST['basicpay']);
	$houserent=mysql_real_escape_string($_POST['houserent']);
	$medallow=mysql_real_escape_string($_POST['medallow']);
	$tada=mysql_real_escape_string($_POST['tada']);
	$otherallow=mysql_real_escape_string($_POST['otherallow']);
	$gsalary=mysql_real_escape_string($_POST['gsalary']);
	$increment=mysql_real_escape_string($_POST['increment']);
	$securitymoney=mysql_real_escape_string($_POST['securitymoney']);
	$dedperday=mysql_real_escape_string($_POST['dedperday']);
	$totded=mysql_real_escape_string($_POST['totded']);
	$pfp=mysql_real_escape_string($_POST['pfp']);
	$pfa=mysql_real_escape_string($_POST['pfa']);
	$fb=mysql_real_escape_string($_POST['fb']);
	$bankacc=mysql_real_escape_string($_POST['bankacc']);
	$netpay=mysql_real_escape_string($_POST['netpay']);
	$remarks=mysql_real_escape_string($_POST['remarks']);
	//$opdate=date("Y-m-d");
	$opdate=$_POST['opdate'];
	
	$chkd="SELECT * FROM tbl_employeesalary WHERE empid='$efid' and monthname='$monthname' and yearname='$yearname'";
	$chkdq=$myDb->select($chkd);
	$chkdf=$myDb->get_row($chkdq,'MYSQL_ASSOC');
	if(!empty($chkdf['empid']))
	{
		echo $msg="Sorry! This Record is already inserted.";
		exit;
	} 
	else
	{
    	$query="INSERT INTO `tbl_employeesalary` (`monthname`, `yearname`, `tworkingdays`, `empid`, `empname`, `designation`, `payscale`, `lateattendance`, `absentinoffice`, `totalabsent`, `totalleave`, `basicpay`, `houserent`, `medicalallow`, `tada`, `otherallow`, `grosssalary`, `increment`, `securitymoney`, `dedperday`, `totded`, `pfundpercent`, `pfundamount`, `festivalbouns`, `netpay`, `opby`, `opdate`, `storedstatus`, `remarks`, `bankaccno`) VALUES ('$monthname', '$yearname', '$tworkingdays', '$efid', '$efname', '$desig', '$payscale', '$lateattnd', '$absinoffice', '$totabs', '$totleave', '$basicpay', '$houserent', '$medallow', '$tada', '$otherallow', '$gsalary', '$increment', '$securitymoney', '$dedperday', '$totded', '$pfp', '$pfa', '$fb', '$netpay', '$_SESSION[userid]','$opdate','I', '$remarks', '$bankacc')";
	
	//-------------------Auto Accounts Hit-----------------------------
							$ptype="";
							if(($bankacc=='cash')||($bankacc=='Cash'))
							{
								$ptype="Cash";
							}
							else
							{
								$ptype="Bank";
							}

							
							//-------------Select Basic Salary Head----------
							$bsacc=$myDb->select("Select * from tbl_accchart Where accname='Basic Salary'");
							$bsaccf=$myDb->get_row($bsacc,'MYSQL_ASSOC');
							if($bsaccf['groupname']==0)
		  					{
		    					$groupnameA=$bsaccf['parentid'];
		  					}
							else
							{
		    					$groupnameA=$bsaccf['groupname'];
		  					}

							//-------------Select House Rent Head----------
							$hracc=$myDb->select("Select * from tbl_accchart Where accname='Employee House Rent'");
							$hraccf=$myDb->get_row($hracc,'MYSQL_ASSOC');
							if($hraccf['groupname']==0)
		  					{
		    					$groupnameB=$hraccf['parentid'];
		  					}
							else
							{
		    					$groupnameB=$hraccf['groupname'];
		  					}
							//-------------Select Medical allowance Head----------
							$maacc=$myDb->select("Select * from tbl_accchart Where accname='Medical Allowance'");
							$maaccf=$myDb->get_row($maacc,'MYSQL_ASSOC');
							if($maaccf['groupname']==0)
		  					{
		    					$groupnameC=$maaccf['parentid'];
		  					}
							else
							{
		    					$groupnameC=$maaccf['groupname'];
		  					}
							
							//-------------Select Transport allowance Head----------
							$taacc=$myDb->select("Select * from tbl_accchart Where accname='Transport Allowance'");
							$taaccf=$myDb->get_row($taacc,'MYSQL_ASSOC');
							if($taaccf['groupname']==0)
		  					{
		    					$groupnameD=$taaccf['parentid'];
		  					}
							else
							{
		    					$groupnameD=$taaccf['groupname'];
		  					}
							//-------------Select Other allowance Head----------
							$oaacc=$myDb->select("Select * from tbl_accchart Where accname='Other Allowance'");
							$oaaccf=$myDb->get_row($oaacc,'MYSQL_ASSOC');
							if($oaaccf['groupname']==0)
		  					{
		    					$groupnameE=$oaaccf['parentid'];
		  					}
							else
							{
		    					$groupnameE=$oaaccf['groupname'];
		  					}
							//-------------Select Deduction for Leave & Absent Head-------------
							$dedacc=$myDb->select("Select * from tbl_accchart Where accname='Deduction for Leave & Absent'");
							$dedaccf=$myDb->get_row($dedacc,'MYSQL_ASSOC');
							if($dedaccf['groupname']==0)
		  					{
		    					$groupnameF=$dedaccf['parentid'];
		  					}
							else
							{
		    					$groupnameF=$dedaccf['groupname'];
		  					}
							//-------------Select Employee/ Faculty Salary Payable Head-------------					
							$sp="";
							if(substr($_POST['efid'],0,1)=="E")
							{
								$sp="ESalPay ".$efname;
							}
							elseif(substr($_POST['efid'],0,1)=="F")
							{
								$sp="FSalPay ".$efname;
							}
							$espacc=$myDb->select("Select * from tbl_accchart Where accname='".$sp."'");
							$espaccf=$myDb->get_row($espacc,'MYSQL_ASSOC');
							if($espaccf['groupname']==0)
		  					{
		    					$groupnameG=$espaccf['parentid'];
		  					}
							else
							{
		    					$groupnameG=$espaccf['groupname'];
		  					}
							//-------------Select Employee/ Faculty Provident Fund Head-------------					
							$efpf="";
							if(substr($_POST['efid'],0,1)=="E")
							{
								$efpf="EPro ".$efname;
							}
							elseif(substr($_POST['efid'],0,1)=="F")
							{
								$efpf="FPro ".$efname;
							}
							$eppacc=$myDb->select("Select * from tbl_accchart Where accname='".$efpf."'");
							$eppaccf=$myDb->get_row($eppacc,'MYSQL_ASSOC');
							if($eppaccf['groupname']==0)
		  					{
		    					$groupnameH=$eppaccf['parentid'];
		  					}
							else
							{
		    					$groupnameH=$eppaccf['groupname'];
		  					}
							//-------------Select Employee/ Faculty Security Money Receivable Head-------------					
							$efsd="";
							if(substr($_POST['efid'],0,1)=="E")
							{
								$efsd="ESecRcv ".$efname;
							}
							elseif(substr($_POST['efid'],0,1)=="F")
							{
								$efsd="FSecRcv ".$efname;
							}
							$esdacc=$myDb->select("Select * from tbl_accchart Where accname='".$efsd."'");
							$esdaccf=$myDb->get_row($esdacc,'MYSQL_ASSOC');
							if($esdaccf['groupname']==0)
		  					{
		    					$groupnameI=$esdaccf['parentid'];
		  					}
							else
							{
		    					$groupnameI=$esdaccf['groupname'];
		  					}
							
							
							
							$vid=$myDb->select("SELECT ifnull(count(id),0) mvid FROM tbl_masterjournal WHERE vouchertype='J'");
							$vidf=$myDb->get_row($vid,'MYSQL_ASSOC');
							$maxvid=$vidf['mvid']+1;
							//$opdate=date("Y-m-d");
							$opdate=$_POST['opdate'];
                            $voucherid="JV/-".$opdate."-"."0".$maxvid;													 
							$vexpl="Salary Payable for : ".$efname."(".$efid.") for the month of".$monthname.", ".$yearname;
							$vgroup=substr($bsaccf['accname'],0,7);

							
		  					
							$myDb->insert_sql("INSERT INTO tbl_masterjournal(voucherid,voucherdate,vouchertype,preparedby, paytype,opby,opdate,storedstatus,accountno,voucherexpl, multi_single,voucher_group) VALUES('$voucherid','$opdate','J','$_SESSION[userid]','$ptype','$_SESSION[userid]','$opdate','I','$bsaccf[id]','$vexpl','multi','$vgroup')");
							//--------------Start Debit Entry----------------
							if($basicpay!=0)
							{
								$myDb->insert_sql("INSERT INTO tbl_2ndjournal(accno,groupname, accname,amountdr,amountcr,voucherid, vouchertype,paytype,vdate,parentid, masteraccno, storedstatus,opby,multi_single,voucher_group) VALUES('$bsaccf[id]','$groupnameA','$bsaccf[accname]','$basicpay','0','$voucherid','J','$ptype','$opdate','$bsaccf[parentid]','0','I','$_SESSION[userid]','multi','$vgroup')");
							}
							if($houserent!=0)
							{
								$myDb->insert_sql("INSERT INTO tbl_2ndjournal(accno,groupname, accname,amountdr,amountcr,voucherid, vouchertype,paytype,vdate,parentid, masteraccno, storedstatus,opby,multi_single,voucher_group) VALUES('$hraccf[id]','$groupnameB','$hraccf[accname]','$houserent','0','$voucherid','J','$ptype','$opdate','$hraccf[parentid]','$bsaccf[id]','I','$_SESSION[userid]','multi','$vgroup')");
							}
							if($medallow!=0)
							{
								$myDb->insert_sql("INSERT INTO tbl_2ndjournal(accno,groupname, accname,amountdr,amountcr,voucherid, vouchertype,paytype,vdate,parentid, masteraccno, storedstatus,opby,multi_single,voucher_group) VALUES('$maaccf[id]','$groupnameC','$maaccf[accname]','$medallow','0','$voucherid','J','$ptype','$opdate','$maaccf[parentid]','$bsaccf[id]','I','$_SESSION[userid]','multi','$vgroup')");
							}
							if($tada!=0)
							{
								$myDb->insert_sql("INSERT INTO tbl_2ndjournal(accno,groupname, accname,amountdr,amountcr,voucherid, vouchertype,paytype,vdate,parentid, masteraccno, storedstatus,opby,multi_single,voucher_group) VALUES('$taaccf[id]','$groupnameD','$taaccf[accname]','$tada','0','$voucherid','J','$ptype','$opdate','$taaccf[parentid]','$bsaccf[id]','I','$_SESSION[userid]','multi','$vgroup')");
							}
							if($otherallow!=0)
							{
								$ta = $otherallow + $increment;
								$myDb->insert_sql("INSERT INTO tbl_2ndjournal(accno,groupname, accname,amountdr,amountcr,voucherid, vouchertype,paytype,vdate,parentid, masteraccno, storedstatus,opby,multi_single,voucher_group) VALUES('$oaaccf[id]','$groupnameE','$oaaccf[accname]','$ta','0','$voucherid','J','$ptype','$opdate','$oaaccf[parentid]','$bsaccf[id]','I','$_SESSION[userid]','multi','$vgroup')");
							}

							//--------------Start Credit Entry----------------
							if($netpay!=0)
							{
								$myDb->insert_sql("INSERT INTO tbl_2ndjournal(accno,groupname, accname,amountdr,amountcr,voucherid, vouchertype,paytype,vdate,parentid, masteraccno, storedstatus,opby,multi_single,voucher_group) VALUES('$espaccf[id]','$groupnameG','$espaccf[accname]','0','$netpay','$voucherid','J','$ptype','$opdate','$espaccf[parentid]','$bsaccf[id]','I','$_SESSION[userid]','multi','$vgroup')");
							}
							if($pfa!=0)
							{
								$myDb->insert_sql("INSERT INTO tbl_2ndjournal(accno,groupname, accname,amountdr,amountcr,voucherid, vouchertype,paytype,vdate,parentid, masteraccno, storedstatus,opby,multi_single,voucher_group) VALUES('$eppaccf[id]','$groupnameH','$eppaccf[accname]','0','$pfa','$voucherid','J','$ptype','$opdate','$eppaccf[parentid]','$bsaccf[id]','I','$_SESSION[userid]','multi','$vgroup')");
							}
							if($securitymoney!=0)
							{
								$myDb->insert_sql("INSERT INTO tbl_2ndjournal(accno,groupname, accname,amountdr,amountcr,voucherid, vouchertype,paytype,vdate,parentid, masteraccno, storedstatus,opby,multi_single,voucher_group) VALUES('$esdaccf[id]','$groupnameI','$esdaccf[accname]','0','$securitymoney','$voucherid','J','$ptype','$opdate','$esdaccf[parentid]','$bsaccf[id]','I','$_SESSION[userid]','multi','$vgroup')");
							}
							if($totded!=0)
							{
								$myDb->insert_sql("INSERT INTO tbl_2ndjournal(accno,groupname, accname,amountdr,amountcr,voucherid, vouchertype,paytype,vdate,parentid, masteraccno, storedstatus,opby,multi_single,voucher_group) VALUES('$dedaccf[id]','$groupnameF','$dedaccf[accname]','0','$totded','$voucherid','J','$ptype','$opdate','$dedaccf[parentid]','$bsaccf[id]','I','$_SESSION[userid]','multi','$vgroup')");
							}
	
	
	//-------------------End of Auto Accounts Hit-----------------------------
	
	
	
		if($_POST['increment']!="0")
		{
		
			$ie="INSERT INTO `tbl_increment` (`staffid`, `emonth`, `eyear`, `iamount`, `opby`, `opdate`, `storedstatus`) VALUES ('$efid', '$monthname', '$yearname', '$increment', '$_SESSION[userid]', '$opdate', 'I')";
			$myDb->insert_sql($ie);
	
			$si="SELECT * FROM tbl_payscale WHERE name='$payscale' and storedstatus<>'D'";
			$siq=$myDb->select($si);
			$sif=$myDb->get_row($siq,'MYSQL_ASSOC');
			$psid=$sif['id'];
			$totincrement=$sif['otherallow'] + $increment;
	
			$qup="UPDATE `tbl_payscale` SET `otherallow` = '$totincrement' WHERE `id`='$psid'";
			$myDb->update_sql($qup);
		}
		
		if($myDb->insert_sql($query)){
		
		   echo $msg="Data inserted successfully";
			//header("Location:add_employeesalary.php?msg=$msg");
		}else{
		   echo $msg=$myDb->last_error;
			//header("Location:add_employeesalary.php?msg=$msg");
		}  
	}
}else{
  header("Location:index.php");
}
}  
?>