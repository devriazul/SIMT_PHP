<?php ob_start();
session_start();
require_once('dbClass.php');
include("config.php"); 
if($myDb->connect($host,$user,$pwd,$db,true))
{ 
  if($_SESSION['userid']){
  $chka="SELECT*FROM  tbl_accdtl WHERE flname='voucherEntry.php' AND userid='$_SESSION[userid]'";
  $caq=$myDb->select($chka);
  $car=$myDb->get_row($caq,'MYSQL_ASSOC');
  if($car['ins']=="y"){
  $_SESSION['vdate']=$_POST['voucherdate']?$_POST['voucherdate']:date("Y-m-d");
  if(!empty($_POST['msthead'])&&!empty($_POST['dr'])){
	 
     $ms=$myDb->select("select*from tbl_accchart where accname like '$_POST[msthead]%' and id not in(select parentid from tbl_accchart) order by accname");
	 while($msf=$myDb->get_row($ms,'MYSQL_ASSOC')){
		 $jrc=$myDb->select("select*from tbl_2ndjournal where accname='$msf[accname]' and voucher_group='$_POST[msthead]'");
		 $jrcf=$myDb->get_row($jrc,'MYSQL_ASSOC');
	   //if(empty($jrcf['accname'])){
		$vid=$myDb->select("SELECT ifnull(COUNT(id),0) mvid FROM tbl_masterjournal 
						WHERE vouchertype='J'");
																		  
													 $vidf=$myDb->get_row($vid,'MYSQL_ASSOC');
													 $maxvid=$vidf['mvid']+1;
													 $mvidf="JV/-".$_SESSION['vdate']."-"."0".$maxvid;  
	 
		$myDb->insert_sql("INSERT INTO `tbl_masterjournal` (`voucherid`, `voucherdate`, `vouchertype`, 
														`preparedby`, `paytype`, `chequeno`, `chequedate`, `accountno`, 
														`bankname`, `mrno`, `opby`, `opdate`, `storedstatus`, `multi_single`, 
														`voucher_group`) VALUES
						('$mvidf', '".$_SESSION['vdate']."', 'J', '$_SESSION[userid]', '&nbsp;', '', '', '$msf[id]', '', '', '$_SESSION[userid]', '".$_SESSION['vdate']."', 'I', 'single', '$_POST[msthead]')");
	 
	 
		$ins2nd="INSERT INTO tbl_2ndjournal(accno,accname,amountdr,amountcr,voucherid,
											vouchertype,paytype,vdate,masteraccno,
											storedstatus,opby,parentid,groupname,multi_single,voucher_group)
										VALUES('$msf[id]','$msf[accname]','$_POST[dr]',
											   '0','$mvidf','J','&nbsp;',
											   '".$_SESSION['vdate']."','0','I','$_SESSION[userid]',
											   '$msf[parentid]','$msf[groupname]','single',
											   '$_POST[msthead]')";
							$myDb->insert_sql($ins2nd);					
							
							
		$chead=$myDb->select("SELECT * 
								FROM  `tbl_accchart` 
								WHERE accname
								IN (
								'Admission Fee',  'Lab Fees',  'Library Fees',  
								'Registration Fees',  'ID Card Fees',  'Form Sales',  
								'Book Sales',  '1st Semester Fee',  
								'Tution Fee', 'Exam Fee-Mid'
								) order by accname asc");
		while($cheadf=$myDb->get_row($chead,'MYSQL_ASSOC')){				
		    $crv=$_POST["cr$cheadf[id]"];
			if(!empty($cheadf['id'])&&$_POST["cr$cheadf[id]"]>0){							
				$ins2nd="INSERT INTO tbl_2ndjournal(accno,accname,amountdr,amountcr,voucherid,
												vouchertype,paytype,vdate,masteraccno,
												storedstatus,opby,parentid,groupname,multi_single,voucher_group)
											VALUES('$cheadf[id]','$cheadf[accname]','0',
												   '$crv','$mvidf','J','&nbsp;',
												   '".$_SESSION['vdate']."','$msf[id]','I','$_SESSION[userid]',
												   '$cheadf[parentid]','$cheadf[groupname]','single',
												   '$_POST[msthead]')";
								$myDb->insert_sql($ins2nd);					
			}				
		
		}   
	 
	 
	 
	 //}
	} 
  
}

echo "Journal Save successfully";
//header("Location:atatimejournal.php");
   }else{
     $msg="Sorry,you are not authorized to access this page";
	 header("Location:acchome.php?msg=$msg");
   }	 

}else{
  header("Location:login.php");
}
}  
?>