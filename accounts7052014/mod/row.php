<?php ob_start();
session_start();
include("config.php"); 
if($myDb->connectDefaultServer())
{ 
  if($_SESSION['userid']){
  $chka="SELECT*FROM  tbl_accdtl WHERE flname='voucherEntry.php' AND userid='$_SESSION[userid]'";
  $caq=$myDb->select($chka);
  $car=$myDb->get_row($caq,'MYSQL_ASSOC');
  if($car['ins']=="y"){
				//$timezone = "Asia/Dhaka";
                //if(function_exists('date_default_timezone_set')) date_default_timezone_set($timezone);  
$_SESSION['vdate']=$_POST['voucherdate'];
$_SESSION['vouchertype']=$_POST['vouchertype'];
$tbl = !empty($_GET['tbl']) ? $_GET['tbl'] : 0;
$di = !empty($_GET['di']) ? $_GET['di'] : 0;

$accname=!empty($_POST['accname']) ? $_POST['accname'] : '&nbsp;';
$accname_m=!empty($_POST['accname_m']) ? $_POST['accname_m'] : '&nbsp;';


$vouchertype=!empty($_POST['vouchertype']) ? $_POST['vouchertype'] : '&nbsp;';
$paytype=!empty($_POST['paytype']) ? $_POST['paytype'] : '&nbsp;';
@$_SESSION['pytype']=$paytype;
$amountdr=!empty($_POST['amountdr']) ? $_POST['amountdr'] : '&nbsp;';
$acctype=!empty($_POST['acctype']) ? $_POST['acctype'] : '&nbsp;';
$amountcr=!empty($_POST['amountcr']) ? $_POST['amountcr'] : '0';
$voucherdate=!empty($_POST['voucherdate']) ? $_POST['voucherdate'] : '&nbsp;';
$err=!empty($_POST['err']) ? $_POST['err'] : '&nbsp;';
$index = !empty($_SESSION['products']) ? count($_SESSION['products']) + 1 : 1;

//SET VOUCHER GROUP FOR REPORT
$chk_m=$myDb->select("SELECT*FROM tbl_tmpjurnal where masteraccno=0");
$chk_mf=$myDb->get_row($chk_m,'MYSQL_ASSOC');
if($vouchertype=="J"){
	if(!empty($chk_mf['accname'])){
		$voucher_group=substr($chk_mf['accname'],0,7);
		$_SESSION['voucher_group']=$voucher_group;
		$voucher_group=$_SESSION['voucher_group'];
	}else{
		$voucher_group=substr($accname,0,7);
		$_SESSION['voucher_group']=$voucher_group;
		$voucher_group=$_SESSION['voucher_group'];
	}	
}else{
	if(!empty($chk_mf['accname'])){
		$voucher_group=substr($chk_mf['accname'],0,7);
		$_SESSION['voucher_group']=$voucher_group;
		$voucher_group=$_SESSION['voucher_group'];
	}else{
		$voucher_group=substr($accname_m,0,7);
		$_SESSION['voucher_group']=$voucher_group;
		$voucher_group=$_SESSION['voucher_group'];
	}	
}


//check voucher type if not same then raise error
	$chktmp=$myDb->select("select*from tbl_tmpjurnal where masteraccno=0 and opby='$_SESSION[userid]'");
	$chktmpf=$myDb->get_row($chktmp,'MYSQL_ASSOC');
	if($chktmpf['vouchertype']=="J"){
	  $vchrtype="Journal";
	}else if($chktmpf['vouchertype']=="R"){
	  $vchrtype="Receuve";
	}else if($chktmpf['vouchertype']=="P"){
	  $vchrtype="Payment";
	}  
	
if(!empty($chktmpf['vouchertype'])){

	if($chktmpf['vouchertype']!=$vouchertype){
	$err="Voucher entry running type now ".$vchrtype." please first save ".$vchrtype." type voucher then try another.";
					$_SESSION['prod'][$index] = array(
													   
														 'err'=>$err
														  );
															$row  = '<tr>';
															$row .= '<td class="ta_r" colspan="5" width="100%">'.$err.'</td>';
															$row .= '</tr>';		  
															
															  //if (empty($tblrep)) {
														
																$out  = '<table cellpadding="0" cellspacing="0" width="100%" ';
																$out .= 'border="0" class="tbl_rep" width="100%">';
																$out .= '<tr>';
																$out .= '<th class="col_1 ta_r" colspan="5">Error</th>';
																$out .= '</tr>';
																$out .= $row;
																$out .= '</table>';
																$row = $out;
														
															 //}   
															 echo json_encode(array('row' => $row));	
				   exit;
	}		
}


/*----------------------------------------------------------- Debit section start here --------------------------------------------------------------------------------*/
    $cnt_j=0; 
	if($vouchertype=="J"){
			$accChk=$myDb->select("select accname from tbl_accchart where accname='$accname'");
			$accChkf=$myDb->get_row($accChk,'MYSQL_ASSOC');
			
			if(empty($accChkf['accname'])){
				$err="Account name ".$accname." not found in database";
				$_SESSION['prod'][$index] = array(
												   
													 'err'=>$err
													  );
														$row  = '<tr>';
														$row .= '<td class="ta_r" colspan="5" width="100%">'.$err.'</td>';
														$row .= '</tr>';		  
														
														  //if (empty($tblrep)) {
													
															$out  = '<table cellpadding="0" cellspacing="0" width="100%" ';
															$out .= 'border="0" class="tbl_rep" width="100%">';
															$out .= '<tr>';
															$out .= '<th class="col_1 ta_r" colspan="5">Error</th>';
															$out .= '</tr>';
															$out .= $row;
															$out .= '</table>';
															$row = $out;
													
														 //}   
														 echo json_encode(array('row' => $row));	
			   exit;
			}	
			
		/*$chkVal=$myDb->select("select accname,sum(amountdr)-sum(amountcr) vtot from tbl_tmpjurnal where opby='$_SESSION[userid]' group by accname");
			$chkValf=$myDb->get_row($chkVal,'MYSQL_ASSOC');	 
			//if(($chkValf['vtot']==0)&&!empty($chkValf['accname'])){
			if($chkValf['vtot']<$amountdr){
				$err="Debit balance is ".$chkValf['vtot']." credit balance can not grater than debit balance";
				$_SESSION['prod'][$index] = array(
												   
													 'err'=>$err
													  );
														$row  = '<tr>';
														$row .= '<td class="ta_r" colspan="4" width="100%">'.$err.'</td>';
														$row .= '</tr>';		  
														
														  if (empty($tblrep)) {
													
															$out  = '<table cellpadding="0" cellspacing="0" width="100%" ';
															$out .= 'border="0" class="tbl_rep" width="100%">';
															$out .= '<tr>';
															$out .= '<th class="col_1 ta_r" colspan="4">Error</th>';
															$out .= '</tr>';
															$out .= $row;
															$out .= '</table>';
															$row = $out;
													
														 }   
														 echo json_encode(array('row' => $row));	
			   exit;
			}			
	*/		
	if($amountdr==0||$amountdr<0){
			$err="Amount can not be zero or minus";
			$_SESSION['prod'][$index] = array(
												   
													 'err'=>$err
													  );
														$row  = '<tr>';
														$row .= '<td class="ta_r" colspan="5" width="100%">'.$err.'</td>';
														$row .= '</tr>';		  
														
														  if (empty($tblrep)) {
													
															$out  = '<table cellpadding="0" cellspacing="0" width="100%" ';
															$out .= 'border="0" class="tbl_rep" width="100%">';
															$out .= '<tr>';
															$out .= '<th class="col_1 ta_r" colspan="5">Error</th>';
															$out .= '</tr>';
															$out .= $row;
															$out .= '</table>';
															$row = $out;
													
														 }   
														 echo json_encode(array('row' => $row));	
			   exit;
			}				
			if($acctype=="DR"){
						 
						 /* ----------------------------------- check debit head which masteraccno is 0 and can not debit head entry agin unit corresponding credit entry ------------ */
						 $udr=$myDb->select("
												select*
												from tbl_tmpjurnal
												where accno not in(select masteraccno
															 from tbl_tmpjurnal
															 where opby='$_SESSION[userid]'
															 and vdate='".$_SESSION['vdate']."'
															)
												and masteraccno=0
												and amountcr=0
												and opby='$_SESSION[userid]'
												and vdate='".$_SESSION['vdate']."'             
										  ");
						 $udrf=$myDb->get_row($udr,'MYSQL_ASSOC');	
						 
						 
						/*------------------- check sum of debit and sum of credit is equal or not ----------------------------------------*/
						
						$csdc=$myDb->select("select*, (
			
															SELECT sum( amountdr )
															FROM tbl_tmpjurnal
															WHERE accno IN (
																					SELECT masteraccno
																					FROM tbl_tmpjurnal
																					WHERE opby='$_SESSION[userid]'
																					AND amountdr=0
																					AND masteraccno<>0
																					AND vdate='".$_SESSION['vdate']."'
																					
																				 )
															AND amountcr=0 
															AND masteraccno=0
															AND opby='$_SESSION[userid]'
															AND vdate='".$_SESSION['vdate']."'
																				 
															
														  )total_dr,(
			
															SELECT sum( amountcr )
															FROM tbl_tmpjurnal
															WHERE masteraccno IN (
																					SELECT accno
																					FROM tbl_tmpjurnal
																					WHERE opby='$_SESSION[userid]'
																					AND amountcr=0
																					AND masteraccno=0
																					AND vdate='".$_SESSION['vdate']."'
																					
																				 )
															AND amountdr=0 
															AND masteraccno<>0
															AND opby='$_SESSION[userid]'
															AND vdate='".$_SESSION['vdate']."'
																				 
															
														  )total_cr
												from tbl_tmpjurnal
												where accno in(select masteraccno
															 from tbl_tmpjurnal
															 where opby='$_SESSION[userid]'
															 AND amountdr=0
															 AND vdate='".$_SESSION['vdate']."'
															
															)
												and masteraccno=0
												and amountcr=0
												and opby='$_SESSION[userid]'
												and vdate='".$_SESSION['vdate']."'
									");
						  $csdcf=$myDb->get_row($csdc,'MYSQL_ASSOC');			
				 
						  $acn=mysql_query("SELECT*FROM  tbl_accchart WHERE accname='$_POST[accname]'") or die(mysql_error());
						  $acf=mysql_fetch_array($acn);
					
						  $chkdr=$myDb->select("SELECT*FROM tbl_tmpjurnal WHERE accno='$acf[id]' and vdate='".$_SESSION['vdate']."' and amountcr=0 and opby='$_SESSION[userid]'");
						  $drf=$myDb->get_row($chkdr,'MYSQL_ASSOC');
						  
						  /* if($drf['accname']){
										 $err=$drf['accname']." Already debited,you can not debit/credit it agin until save the voucher";
										  $_SESSION['prod'][$index] = array(
									   
										 'err'=>$err
										  );
											$row  = '<tr>';
											$row .= '<td class="ta_r" colspan="4" width="100%">'.$err.'</td>';
											$row .= '</tr>';		  
											
											  if (empty($tblrep)) {
										
												$out  = '<table cellpadding="0" cellspacing="0" width="100%" ';
												$out .= 'border="0" class="tbl_rep" width="100%">';
												$out .= '<tr>';
												$out .= '<th class="col_1 ta_r" colspan="4">Error</th>';
												$out .= '</tr>';
												$out .= $row;
												$out .= '</table>';
												$row = $out;
										
											 }
											echo json_encode(array('row' => $row));			
											
											exit;
						   }else{*/	  
										  if (empty($_SESSION['prod'])) {
											  unset($_SESSION['prod']);
										  }
										  
										  
											$chkdr=$myDb->select("SELECT*FROM tbl_tmpjurnal WHERE accno='$acf[id]' and vdate='".$_SESSION['vdate']."' and amountdr=0 and opby='$_SESSION[userid]'");
											$drf=$myDb->get_row($chkdr,'MYSQL_ASSOC');								  
												/*if($drf['accname']){
															 $err=$drf['accname']." Already credited you can not debit/credit it until save the voucher";
															  $_SESSION['prod'][$index] = array(
														   
															 'err'=>$err
															  );
																$row  = '<tr>';
																$row .= '<td class="ta_r" colspan="4" width="100%">'.$err.'</td>';
																$row .= '</tr>';		  
																
																  if (empty($tblrep)) {
															
																	$out  = '<table cellpadding="0" cellspacing="0" width="100%" ';
																	$out .= 'border="0" class="tbl_rep" width="100%">';
																	$out .= '<tr>';
																	$out .= '<th class="col_1 ta_r" colspan="4">Error</th>';
																	$out .= '</tr>';
																	$out .= $row;
																	$out .= '</table>';
																	$row = $out;
															
																 }
																echo json_encode(array('row' => $row));			
																
																exit;
											   }else{*/								 
														  $_SESSION['products'][$index] = array(
																'accname' => $accname,
																'vouchertype' => $vouchertype,
																'acctype'=>$acctype,
																'amountdr' => $amountdr,
																'amountcr'=>$amountcr,
																'voucherdate'=>$voucherdate
														  );
														 
																	$maccno=mysql_query("SELECT id,accno FROM tbl_tmpjurnal
																						 WHERE id=(select max(id) from tbl_tmpjurnal where  opby='$_SESSION[userid]' 
																								   and masteraccno=0) 
																						 and opby='$_SESSION[userid]' 
																						 and masteraccno=0") or die(mysql_error());
																	$macf=mysql_fetch_array($maccno);
																	//if voucher is multi debit and multi credit
																	if($_SESSION["drcrtype"]=="mcmd"){
																	    $multi_single='multi';
																		$sumamount=$myDb->select("SELECT SUM(amountcr) amountcr,(SELECT SUM(amountdr) 
																							  FROM tbl_tmpjurnal WHERE opby='$_SESSION[userid]') amountdr
																							  FROM tbl_tmpjurnal
																							  WHERE opby='$_SESSION[userid]'");
																	
																	}else{
																	    $multi_single='single';
																		$sumamount=$myDb->select("SELECT SUM(amountcr) amountcr,(SELECT SUM(amountdr) 
																							  FROM tbl_tmpjurnal WHERE masteraccno='$macf[accno]'
																							  AND opby='$_SESSION[userid]') amountdr
																							  FROM tbl_tmpjurnal
																							  WHERE id='$macf[id]'
																							  AND accno='$macf[accno]'
																							  AND opby='$_SESSION[userid]'");
																	}						  
																	
																	$amountf=$myDb->get_row($sumamount,'MYSQL_ASSOC');
																	if($amountf['amountcr']==$amountf['amountdr']){													 
																		mysql_query("INSERT INTO tbl_tmpjurnal(accname,vouchertype,paytype,
																		                                       amountdr,vdate,opby,accno,drcr,parentid,groupname,
																											   multi_single,voucher_group)
																		values('$accname','$vouchertype','$paytype','$amountdr','$voucherdate',
																			   '$_SESSION[userid]','$acf[id]','$acctype','$acf[parentid]','$acf[groupname]',
																			   '$multi_single','$voucher_group')") 
																			   or die(mysql_error());
																	}else{
																		mysql_query("INSERT INTO tbl_tmpjurnal(accname,vouchertype,paytype,
																		             amountdr,vdate,opby,accno,masteraccno,drcr,parentid,groupname,
																					 multi_single,voucher_group)
																		values('$accname','$vouchertype','$paytype','$amountdr','$voucherdate',
																			   '$_SESSION[userid]','$acf[id]','$macf[accno]','$acctype','$acf[parentid]',
																			   '$acf[groupname]','$multi_single','$voucher_group')") or die(mysql_error());
																	
																	}		   
														
														  $row  = '<tr>';
														  $row .= '<td >'.$accname.'</td>';
														  $row .= '<td class="ta_r">'.$acctype.'</td>';
														  $row .= '<td class="ta_r">'.$amountdr.'</td>';
														  $row .= '<td class="ta_r">'.$amountcr.'</td>';
														  $row .= '<td class="ta_r"><a href="#" class="remove" rel="'.mysql_insert_id();
														  $row .= '">Remove</a></td>';
														  $row .= '</tr>';
											
											
														
														if (empty($tbl)) {
													
															$out  = '<table cellpadding="0" cellspacing="0" ';
															$out .= 'border="0" class="tbl_repeat">';
															$out .= '<tr>';
															$out .= '<th class="col_1 ta_r">Acc name</th>';
															$out .= '<th class="col_1 ta_r">Acc Type</th>';
															$out .= '<th class="col_1 ta_r">Amountdr</th>';
															$out .= '<th class="col_1 ta_r">Amountcr</th>';
															$out .= '<th class="col_1 ta_r">Action</th>';
															$out .= '</tr>';
															$out .= $row;
															$out .= '</table>';
															$row = $out;
													
														  }
														  echo json_encode(array('row' => $row));
											//}		  
								//}
								
			 }else{
			 
			 //------------------------------------------------------------ Credit Part ----------------------------------------------------------------//
			 
						if (empty($_SESSION['prod'])) {
							unset($_SESSION['prod']);
						}	   
						$amountcr=$amountdr;
						$amountdr=0;
				   /* ----------------------------------- check credit head which masteraccno is 0 and can not credit head entry agin unit corresponding debit entry ------------ */
			
						$udr=$myDb->select("
												select*
												from tbl_tmpjurnal
												where accno not in(select masteraccno
															 from tbl_tmpjurnal
															 where opby='$_SESSION[userid]'
															 and vdate='".$_SESSION['vdate']."'
															)
												and masteraccno=0
												and amountdr=0
												and opby='$_SESSION[userid]'
												and vdate='".date("Y-m-d")."'             
										  ");
						 $udrf=$myDb->get_row($udr,'MYSQL_ASSOC');	
				
			 /*------------------- check sum of debit and sum of credit is equal or not ---------------------------------------- */
						
						  $csdc=$myDb->select("select*, (
			
															SELECT sum( amountcr )
															FROM tbl_tmpjurnal
															WHERE accno IN (
																					SELECT masteraccno
																					FROM tbl_tmpjurnal
																					WHERE opby='$_SESSION[userid]'
																					AND amountcr=0
																					AND masteraccno<>0
																					AND vdate='".$_SESSION['vdate']."'
																					
																				 )
															AND amountdr=0 
															AND masteraccno=0
															AND opby='$_SESSION[userid]'
															AND vdate='".$_SESSION['vdate']."'
																				 
															
														  )total_cr,(
			
															SELECT sum( amountdr )
															FROM tbl_tmpjurnal
															WHERE masteraccno IN (
																					SELECT accno
																					FROM tbl_tmpjurnal
																					WHERE opby='$_SESSION[userid]'
																					AND amountdr=0
																					AND masteraccno=0
																					AND vdate='".$_SESSION['vdate']."'
																					
																				 )
															AND amountcr=0 
															AND masteraccno<>0
															AND opby='$_SESSION[userid]'
															AND vdate='".$_SESSION['vdate']."'
																				 
															
														  )total_dr
												from tbl_tmpjurnal
												where accno in(select masteraccno
															 from tbl_tmpjurnal
															 where opby='$_SESSION[userid]'
															 AND amountcr=0
															 AND vdate='".$_SESSION['vdate']."'
															
															)
												and masteraccno=0
												and amountdr=0
												and opby='$_SESSION[userid]'
												and vdate='".$_SESSION['vdate']."'
									");
						  $csdcf=$myDb->get_row($csdc,'MYSQL_ASSOC');			
						 
						  $acn=mysql_query("SELECT*FROM  tbl_accchart WHERE accname='$_POST[accname]'") or die(mysql_error());
						  $acf=mysql_fetch_array($acn);
							
						  $chkdr=$myDb->select("SELECT*FROM tbl_tmpjurnal WHERE accno='$acf[id]' and vdate='".$_SESSION['vdate']."' and amountdr=0 and opby='$_SESSION[userid]'");
						  $drf=$myDb->get_row($chkdr,'MYSQL_ASSOC');	
				 
						   /*if($drf['accname']){
										  $err=$drf['accname']." Already credited you can not debit it until save the voucher";
											 $_SESSION['prod'][$index] = array(
									   
											 'err'=>$err
										  );
											$row  = '<tr>';
											$row .= '<td class="ta_r" colspan="4" width="100%">'.$err.'</td>';
											$row .= '</tr>';		  
											
											  if (empty($tblrep)) {
										
												$out  = '<table cellpadding="0" cellspacing="0" width="100%"';
												$out .= 'border="0" class="tbl_rep" width="100%">';
												$out .= '<tr>';
												$out .= '<th class="col_1 ta_r" colspan="4">Error</th>';
												$out .= '</tr>';
												$out .= $row;
												$out .= '</table>';
												$row = $out;
										
											 }
											echo json_encode(array('row' => $row));			
											
											exit;
							 }else{*/
							 
											
											
											
											
											$acn=mysql_query("SELECT*FROM  tbl_accchart WHERE accname='$_POST[accname]'") or die(mysql_error());
											$acf=mysql_fetch_array($acn);
												
											$chkdr=$myDb->select("SELECT*FROM tbl_tmpjurnal WHERE accno='$acf[id]' and vdate='".$_SESSION['vdate']."' and amountcr=0 and opby='$_SESSION[userid]'");
											$drf=$myDb->get_row($chkdr,'MYSQL_ASSOC');	
											
										  /*if($drf['accname']){
											 $err=$drf['accname']." Already debited you can not credit it until save the voucher";
											 $_SESSION['prod'][$index] = array(
									   
											 'err'=>$err
										  );
											$row  = '<tr>';
											$row .= '<td class="ta_r" colspan="4" width="100%">'.$err.'</td>';
											$row .= '</tr>';		  
											
											  if (empty($tblrep)) {
										
												$out  = '<table cellpadding="0" cellspacing="0" width="100%"';
												$out .= 'border="0" class="tbl_rep" width="100%">';
												$out .= '<tr>';
												$out .= '<th class="col_1 ta_r" colspan="4">Error</th>';
												$out .= '</tr>';
												$out .= $row;
												$out .= '</table>';
												$row = $out;
										
											 }
											echo json_encode(array('row' => $row));			
											
											exit;
							 }else{	*/							
											$_SESSION['products'][$index] = array(
											'accname' => $accname,
											'vouchertype' => $vouchertype,
											'acctype'=>$acctype,
											'amountdr'=>$amountdr,
											'amountcr' => $amountcr,
											'voucherdate'=>$voucherdate
											);	    
											$maccno=mysql_query("SELECT id,accno FROM tbl_tmpjurnal WHERE id=(select max(id) from tbl_tmpjurnal where opby='$_SESSION[userid]' 
																											  and masteraccno=0) 
															 and opby='$_SESSION[userid]' and masteraccno=0") or die(mysql_error());
											$macf=mysql_fetch_array($maccno);
											//if voucher is multi debit and multi credit
											if($_SESSION["drcrtype"]=="mcmd"){
												$multi_single='multi';
												$sumamount=$myDb->select("SELECT SUM(amountdr) amountdr,(SELECT SUM(amountcr) FROM tbl_tmpjurnal WHERE opby='$_SESSION[userid]') amountcr
																		  FROM tbl_tmpjurnal
																		  WHERE opby='$_SESSION[userid]'");
											}else{
												$multi_single='single';

												$sumamount=$myDb->select("SELECT SUM(amountdr) amountdr,(SELECT SUM(amountcr) FROM tbl_tmpjurnal WHERE masteraccno='$macf[accno]'
																										 AND opby='$_SESSION[userid]') amountcr
																		  FROM tbl_tmpjurnal
																		  WHERE id='$macf[id]'
																		  AND accno='$macf[accno]'
																		  AND opby='$_SESSION[userid]'");
											}						  
											$amountf=$myDb->get_row($sumamount,'MYSQL_ASSOC');
											if($amountf['amountdr']==$amountf['amountcr']){
										 
											   mysql_query("INSERT INTO tbl_tmpjurnal(accname,vouchertype,paytype,amountdr,
											                                          amountcr,vdate,opby,accno,drcr,parentid,groupname,
																					  multi_single,voucher_group)
															values('$accname','$vouchertype','$paytype','$amountdr','$amountcr',
														   '$voucherdate','$_SESSION[userid]','$acf[id]','$acctype','$acf[parentid]','$acf[groupname]',
														   '$multi_single','$voucher_group')") or die(mysql_error());
											}else{
											
											   mysql_query("INSERT INTO tbl_tmpjurnal(accname,vouchertype,paytype,amountdr,
											                                          amountcr,vdate,opby,masteraccno,accno,drcr,parentid,groupname,
																					  multi_single,voucher_group)
															values('$accname','$vouchertype','$paytype','$amountdr','$amountcr',
														   '$voucherdate','$_SESSION[userid]','$macf[accno]','$acf[id]','$acctype','$acf[parentid]',
														   '$acf[groupname]','$multi_single','$voucher_group')") or die(mysql_error());
											}			   
										
											$row  = '<tr>';
											$row .= '<td>'.$accname.'</td>';
											$row .= '<td class="ta_r">'.$acctype.'</td>';
											$row .= '<td class="ta_r">'.$amountdr.'</td>';
											$row .= '<td class="ta_r">'.$amountcr.'</td>';
											$row .= '<td class="ta_r"><a href="#" class="remove" rel="'.mysql_insert_id();
											$row .= '">Remove</a></td>';
											$row .= '</tr>';
										
										
										
											if (empty($tbl)) {
										
												$out  = '<table cellpadding="0" cellspacing="0" ';
												$out .= 'border="0" class="tbl_repeat">';
												$out .= '<tr>';
												$out .= '<th>Acc name</th>';
												$out .= '<th class="col_1 ta_r">Acc Type</th>';
												$out .= '<th class="col_1 ta_r">Amountdr</th>';
												$out .= '<th class="col_1 ta_r">Amountcr</th>';
												$out .= '<th class="col_1 ta_r">Action</th>';
												$out .= '</tr>';
												$out .= $row;
												$out .= '</table>';
												$row = $out;
										
											 }
										
											 echo json_encode(array('row' => $row));
								//}
							//}				
			
				  }
         }
		 
		 /// without journal ------------------>receive and payment section here ///
		 $cnt_rp=0;
         if($vouchertype!="J"){ 
		 
			$accChk=$myDb->select("select accname from tbl_accchart where accname='$accname'");
			$accChkf=$myDb->get_row($accChk,'MYSQL_ASSOC');
			
			$accChk_2=$myDb->select("select accname from tbl_accchart where accname=(select distinct accname from tbl_2ndjournal where accname='$accname_m')");
			$accChkf_2=$myDb->get_row($accChk_2,'MYSQL_ASSOC');
			
			/*if(empty($accChkf['accname'])||empty($accChkf_2['accname'])){
				$err="Account name ".$accname." OR ".$accname_m." not found in database";
				$_SESSION['prod'][$index] = array(
												   
													 'err'=>$err
													  );
														$row  = '<tr>';
														$row .= '<td class="ta_r" colspan="5" width="100%">'.$err.'</td>';
														$row .= '</tr>';		  
														
														  //if (empty($tblrep)) {
													
															$out  = '<table cellpadding="0" cellspacing="0" width="100%" ';
															$out .= 'border="0" class="tbl_rep" width="100%">';
															$out .= '<tr>';
															$out .= '<th class="col_1 ta_r" colspan="5">Error</th>';
															$out .= '</tr>';
															$out .= $row;
															$out .= '</table>';
															$row = $out;
													
														 //}   
														 echo json_encode(array('row' => $row));	
			   exit;
			}*/	
			
			$chkVal=$myDb->select("select accname,sum(amountdr)-sum(amountcr) vtot from tbl_2ndjournal where accname='$accname_m' group by accname");
			$chkValf=$myDb->get_row($chkVal,'MYSQL_ASSOC');	 
			if($vouchertype=="P"){
				if(($chkValf['vtot']==0)&&!empty($chkValf['accname'])){
					$err="Account name ".$accname_m." have no balance";
					$_SESSION['prod'][$index] = array(
													   
														 'err'=>$err
														  );
															$row  = '<tr>';
															$row .= '<td class="ta_r" colspan="5" width="100%">'.$err.'</td>';
															$row .= '</tr>';		  
															
															  if (empty($tblrep)) {
														
																$out  = '<table cellpadding="0" cellspacing="0" width="100%" ';
																$out .= 'border="0" class="tbl_rep" width="100%">';
																$out .= '<tr>';
																$out .= '<th class="col_1 ta_r" colspan="5">Error</th>';
																$out .= '</tr>';
																$out .= $row;
																$out .= '</table>';
																$row = $out;
														
															 }   
															 echo json_encode(array('row' => $row));	
				   exit;
				}	
				
				if(($chkValf['vtot']<0)&&!empty($chkValf['accname'])){
				$err="Account name ".$accname_m." have no balance";
				$_SESSION['prod'][$index] = array(
													   
														 'err'=>$err
														  );
															$row  = '<tr>';
															$row .= '<td class="ta_r" colspan="5" width="100%">'.$err.'</td>';
															$row .= '</tr>';		  
															
															  if (empty($tblrep)) {
														
																$out  = '<table cellpadding="0" cellspacing="0" width="100%" ';
																$out .= 'border="0" class="tbl_rep" width="100%">';
																$out .= '<tr>';
																$out .= '<th class="col_1 ta_r" colspan="5">Error</th>';
																$out .= '</tr>';
																$out .= $row;
																$out .= '</table>';
																$row = $out;
														
															 }   
															 echo json_encode(array('row' => $row));	
				   exit;
				}			
				
				if(($chkValf['vtot']<$amountdr)&&!empty($chkValf['accname'])){
				$err="Account name ".$accname_m." current balance is ".$chkValf['vtot'];
				$_SESSION['prod'][$index] = array(
													   
														 'err'=>$err
														  );
															$row  = '<tr>';
															$row .= '<td class="ta_r" colspan="5" width="100%">'.$err.'</td>';
															$row .= '</tr>';		  
															
															  if (empty($tblrep)) {
														
																$out  = '<table cellpadding="0" cellspacing="0" width="100%" ';
																$out .= 'border="0" class="tbl_rep" width="100%">';
																$out .= '<tr>';
																$out .= '<th class="col_1 ta_r" colspan="5">Error</th>';
																$out .= '</tr>';
																$out .= $row;
																$out .= '</table>';
																$row = $out;
														
															 }   
															 echo json_encode(array('row' => $row));	
				   exit;
				}		
			}
			if($amountdr==0||$amountdr<0){
			$err="Amount can not be zero or minus";
			$_SESSION['prod'][$index] = array(
												   
													 'err'=>$err
													  );
														$row  = '<tr>';
														$row .= '<td class="ta_r" colspan="5" width="100%">'.$err.'</td>';
														$row .= '</tr>';		  
														
														  if (empty($tblrep)) {
													
															$out  = '<table cellpadding="0" cellspacing="0" width="100%" ';
															$out .= 'border="0" class="tbl_rep" width="100%">';
															$out .= '<tr>';
															$out .= '<th class="col_1 ta_r" colspan="5">Error</th>';
															$out .= '</tr>';
															$out .= $row;
															$out .= '</table>';
															$row = $out;
													
														 }   
														 echo json_encode(array('row' => $row));	
			   exit;
			}			
				
		   if($acctype=="DR"){
             
			 /* ----------------------------------- check debit head which masteraccno is 0 and can not debit head entry agin unit corresponding credit entry ------------ */
			 $udr=$myDb->select("
									select*
									from tbl_tmpjurnal
									where accno not in(select masteraccno
												 from tbl_tmpjurnal
												 where opby='$_SESSION[userid]'
												 and vdate='".$_SESSION['vdate']."'
												)
									and masteraccno=0
									and amountcr=0
									and opby='$_SESSION[userid]'
									and vdate='".$_SESSION['vdate']."'             
                              ");
			 $udrf=$myDb->get_row($udr,'MYSQL_ASSOC');	
			 
			 
	        /*------------------- check sum of debit and sum of credit is equal or not ----------------------------------------*/
			
			$csdc=$myDb->select("select*, (

												SELECT sum( amountdr )
												FROM tbl_tmpjurnal
												WHERE accno IN (
																		SELECT masteraccno
																		FROM tbl_tmpjurnal
																		WHERE opby='$_SESSION[userid]'
																		AND amountdr=0
																		AND masteraccno<>0
																		AND vdate='".$_SESSION['vdate']."'
																		
																	 )
												AND amountcr=0 
												AND masteraccno=0
												AND opby='$_SESSION[userid]'
												AND vdate='".$_SESSION['vdate']."'
																	 
												
											  )total_dr,(

												SELECT sum( amountcr )
												FROM tbl_tmpjurnal
												WHERE masteraccno IN (
																		SELECT accno
																		FROM tbl_tmpjurnal
																		WHERE opby='$_SESSION[userid]'
																		AND amountcr=0
																		AND masteraccno=0
																		AND vdate='".$_SESSION['vdate']."'
																		
																	 )
												AND amountdr=0 
												AND masteraccno<>0
												AND opby='$_SESSION[userid]'
												AND vdate='".$_SESSION['vdate']."'
																	 
												
											  )total_cr
									from tbl_tmpjurnal
									where accno in(select masteraccno
												 from tbl_tmpjurnal
												 where opby='$_SESSION[userid]'
												 AND amountdr=0
												 AND vdate='".$_SESSION['vdate']."'
												
												)
									and masteraccno=0
									and amountcr=0
									and opby='$_SESSION[userid]'
									and vdate='".$_SESSION['vdate']."'
						");
			  $csdcf=$myDb->get_row($csdc,'MYSQL_ASSOC');			
			 
              if($csdcf['total_dr']!=$csdcf['total_cr']){
							 $err="Debit and credit not equal "."Debit:".$csdcf['total_dr']." and"." Credit:".$csdcf['total_cr']." ,please equal it first";
							  $_SESSION['prod'][$index] = array(
						   
							 'err'=>$err
							  );
								$row  = '<tr>';
								$row .= '<td class="ta_r" colspan="5" width="100%">'.$err.'</td>';
								$row .= '</tr>';		  
								
								  if (empty($tblrep)) {
							
									$out  = '<table cellpadding="0" cellspacing="0"';
									$out .= 'border="0" class="tbl_rep" width="100%">';
									$out .= '<tr>';
									$out .= '<th class="col_1 ta_r" colspan="5">Error</th>';
									$out .= '</tr>';
									$out .= $row;
									$out .= '</table>';
									$row = $out;
							
								 }
								echo json_encode(array('row' => $row));			
								
								exit;
			   }	  
			 
			 
			  /*if($udrf['accname']){
							 $err="Already you have a master debit ".$udrf['accname']." complete it first";
							  $_SESSION['prod'][$index] = array(
						   
							 'err'=>$err
							  );
								$row  = '<tr>';
								$row .= '<td class="ta_r" colspan="4" width="100%">'.$err.'</td>';
								$row .= '</tr>';		  
								
								  if (empty($tblrep)) {
							
									$out  = '<table cellpadding="0" cellspacing="0" width="100%" ';
									$out .= 'border="0" class="tbl_rep" width="100%">';
									$out .= '<tr>';
									$out .= '<th class="col_1 ta_r" colspan="4">Error</th>';
									$out .= '</tr>';
									$out .= $row;
									$out .= '</table>';
									$row = $out;
							
								 }
								echo json_encode(array('row' => $row));			
								
								exit;
			   }	*/  
			 
			 
			 
			 
			 
			 
			 			  

             $acn=mysql_query("SELECT*FROM  tbl_accchart WHERE accname='$_POST[accname_m]'") or die(mysql_error());
			 $acf=mysql_fetch_array($acn);			 
			 
			 
			 $acnc=mysql_query("SELECT*FROM  tbl_accchart WHERE accname='$_POST[accname]'") or die(mysql_error());
			 $acfc=mysql_fetch_array($acnc);
		
			 $chkdr=$myDb->select("SELECT*FROM tbl_tmpjurnal WHERE accno='$acf[id]' and vdate='".$_SESSION['vdate']."' and amountcr=0 and opby='$_SESSION[userid]'");
			 $drf=$myDb->get_row($chkdr,'MYSQL_ASSOC');
			  
			   /*if($drf['accname']){
							 $err=$drf['accname']." Already debited,you can not credit it agin until save the voucher";
							  $_SESSION['prod'][$index] = array(
						   
							 'err'=>$err
							  );
								$row  = '<tr>';
								$row .= '<td class="ta_r" colspan="4" width="100%">'.$err.'</td>';
								$row .= '</tr>';		  
								
								  if (empty($tblrep)) {
							
									$out  = '<table cellpadding="0" cellspacing="0" width="100%" ';
									$out .= 'border="0" class="tbl_rep" width="100%">';
									$out .= '<tr>';
									$out .= '<th class="col_1 ta_r" colspan="4">Error</th>';
									$out .= '</tr>';
									$out .= $row;
									$out .= '</table>';
									$row = $out;
							
								 }
								echo json_encode(array('row' => $row));			
								
								exit;
			   }else{*/	  
							  if (empty($_SESSION['prod'])) {
								  unset($_SESSION['prod']);
							  }
							  
							  
								$chkdr=$myDb->select("SELECT*FROM tbl_tmpjurnal WHERE accno='$acf[id]' and vdate='".$_SESSION['vdate']."' and amountdr=0 and opby='$_SESSION[userid]'");
								$drf=$myDb->get_row($chkdr,'MYSQL_ASSOC');								  
									/*if($drf['accname']){
												 $err=$drf['accname']." Already credited you can not debit it until save the voucher";
												  $_SESSION['prod'][$index] = array(
											   
												 'err'=>$err
												  );
													$row  = '<tr>';
													$row .= '<td class="ta_r" colspan="4" width="100%">'.$err.'</td>';
													$row .= '</tr>';		  
													
													  if (empty($tblrep)) {
												
														$out  = '<table cellpadding="0" cellspacing="0" width="100%" ';
														$out .= 'border="0" class="tbl_rep" width="100%">';
														$out .= '<tr>';
														$out .= '<th class="col_1 ta_r" colspan="4">Error</th>';
														$out .= '</tr>';
														$out .= $row;
														$out .= '</table>';
														$row = $out;
												
													 }
													echo json_encode(array('row' => $row));			
													
													exit;
								   }else{	*/							 
											  $_SESSION['products'][$index] = array(
													'accname' => $accname,
													'vouchertype' => $vouchertype,
													'acctype'=>$acctype,
													'amountdr' => $amountdr,
													'amountcr'=>$amountcr,
													'voucherdate'=>$voucherdate
											  );
											 
											            $maccno=mysql_query("SELECT id,accno FROM tbl_tmpjurnal
														                     WHERE id=(select max(id) from tbl_tmpjurnal where  opby='$_SESSION[userid]' and amountdr=0 
																			           and masteraccno=0) 
												                             and opby='$_SESSION[userid]' and amountdr=0
																			 and masteraccno=0") or die(mysql_error());
								                        $macf=mysql_fetch_array($maccno);
														
                                                        $sumamount=$myDb->select("SELECT SUM(amountcr) amountcr,(SELECT SUM(amountdr) 
														                          FROM tbl_tmpjurnal WHERE masteraccno='$macf[accno]'
								                                                  AND opby='$_SESSION[userid]') amountdr
																				  FROM tbl_tmpjurnal
																				  WHERE id='$macf[id]'
																				  AND accno='$macf[accno]'
																				  AND opby='$_SESSION[userid]'");
							                            $amountf=$myDb->get_row($sumamount,'MYSQL_ASSOC');
														
														    $chkmac=mysql_query("SELECT*FROM tbl_tmpjurnal where accno='$acf[id]' and opby='$_SESSION[userid]'") or die(mysql_error());
															$chkmacf=mysql_fetch_array($chkmac);
															$acval=($chkmacf['amountcr']+$amountdr);
															if(!$chkmacf['accname']){ 
																mysql_query("INSERT INTO tbl_tmpjurnal(accname,vouchertype,paytype,
																									   amountcr,vdate,opby,accno,drcr,parentid,groupname,voucher_group)
																values('$accname_m','$vouchertype','$paytype','$amountdr','$voucherdate',
																	   '$_SESSION[userid]','$acf[id]','$acctype','$acf[parentid]','$acf[groupname]','$voucher_group')") or die(mysql_error());
															}else{
															    
															    mysql_query("UPDATE tbl_tmpjurnal SET amountcr='$acval' where accno='$acf[id]'") or die(mysql_error());
															
															}	   
															
															$mastr=$myDb->select("SELECT * FROM tbl_tmpjurnal WHERE id=(SELECT MAX(id) FROM tbl_tmpjurnal where opby='$_SESSION[userid]')");
															$mastrf=$myDb->get_row($mastr,'MYSQL_ASSOC');
															
															mysql_query("INSERT INTO tbl_tmpjurnal(accname,vouchertype,paytype,
															                                       amountdr,vdate,opby,accno,masteraccno,drcr,parentid,groupname,voucher_group)
											                values('$accname','$vouchertype','$paytype','$amountdr','$voucherdate',
															       '$_SESSION[userid]','$acfc[id]','$acf[id]','CR','$acfc[parentid]','$acfc[groupname]','$voucher_group')") 
																   or die(mysql_error());
														     
											
											  $row  = '<tr>';
											  $row .= '<td >'.$accname.'</td>';
											  $row .= '<td class="ta_r">'.$acctype.'</td>';
											  $row .= '<td class="ta_r">'.$amountdr.'</td>';
											  $row .= '<td class="ta_r">'.$amountcr.'</td>';
											  $row .= '<td class="ta_r"><a href="#" class="remove" rel="'.mysql_insert_id();
											  $row .= '">Remove</a></td>';
											  $row .= '</tr>';
								
								
								
											if (empty($tbl)) {
										
												$out  = '<table cellpadding="0" cellspacing="0" ';
												$out .= 'border="0" class="tbl_repeat">';
												$out .= '<tr>';
												$out .= '<th class="col_1 ta_r">Acc name</th>';
												$out .= '<th class="col_1 ta_r">Acc Type</th>';
												$out .= '<th class="col_1 ta_r">Amountdr</th>';
												$out .= '<th class="col_1 ta_r">Amountcr</th>';
												$out .= '<th class="col_1 ta_r">Action</th>';
												$out .= '</tr>';
												$out .= $row;
												$out .= '</table>';
												$row = $out;
										
											  }
											  echo json_encode(array('row' => $row));
								//}		  
					//}
					
 }else{
 
 //------------------------------------------------------------ Credit Part ----------------------------------------------------------------//
 
			if (empty($_SESSION['prod'])) {
				unset($_SESSION['prod']);
			}	   
			$amountcr=$amountdr;
			$amountdr=0;
	   /* ----------------------------------- check credit head which masteraccno is 0 and can not credit head entry agin unit corresponding debit entry ------------ */

            $udr=$myDb->select("
									select*
									from tbl_tmpjurnal
									where accno not in(select masteraccno
												 from tbl_tmpjurnal
												 where opby='$_SESSION[userid]'
												 and vdate='".$_SESSION['vdate']."'
												)
									and masteraccno=0
									and amountdr=0
									and opby='$_SESSION[userid]'
									and vdate='".$_SESSION['vdate']."'             
                              ");
			 $udrf=$myDb->get_row($udr,'MYSQL_ASSOC');	
	
 /*------------------- check sum of debit and sum of credit is equal or not ---------------------------------------- */
			
			  $csdc=$myDb->select("select*, (

												SELECT sum( amountcr )
												FROM tbl_tmpjurnal
												WHERE accno IN (
																		SELECT masteraccno
																		FROM tbl_tmpjurnal
																		WHERE opby='$_SESSION[userid]'
																		AND amountcr=0
																		AND masteraccno<>0
																		AND vdate='".$_SESSION['vdate']."'
																		
																	 )
												AND amountdr=0 
												AND masteraccno=0
												AND opby='$_SESSION[userid]'
												AND vdate='".$_SESSION['vdate']."'
																	 
												
											  )total_cr,(

												SELECT sum( amountdr )
												FROM tbl_tmpjurnal
												WHERE masteraccno IN (
																		SELECT accno
																		FROM tbl_tmpjurnal
																		WHERE opby='$_SESSION[userid]'
																		AND amountdr=0
																		AND masteraccno=0
																		AND vdate='".$_SESSION['vdate']."'
																		
																	 )
												AND amountcr=0 
												AND masteraccno<>0
												AND opby='$_SESSION[userid]'
												AND vdate='".$_SESSION['vdate']."'
																	 
												
											  )total_dr
									from tbl_tmpjurnal
									where accno in(select masteraccno
												 from tbl_tmpjurnal
												 where opby='$_SESSION[userid]'
												 AND amountcr=0
												 AND vdate='".$_SESSION['vdate']."'
												
												)
									and masteraccno=0
									and amountdr=0
									and opby='$_SESSION[userid]'
									and vdate='".$_SESSION['vdate']."'
						");
			  $csdcf=$myDb->get_row($csdc,'MYSQL_ASSOC');			
			 
              if($csdcf['total_cr']!=$csdcf['total_dr']){
							 $err="Debit and credit not equal "."Cebit:".$csdcf['total_cr']." and"." Dredit:".$csdcf['total_dr']." ,please equal it first";
							  $_SESSION['prod'][$index] = array(
						   
							 'err'=>$err
							  );
								$row  = '<tr>';
								$row .= '<td class="ta_r" colspan="5" width="100%">'.$err.'</td>';
								$row .= '</tr>';		  
								
								  if (empty($tblrep)) {
							
									$out  = '<table cellpadding="0" cellspacing="0" width="100%" ';
									$out .= 'border="0" class="tbl_rep" width="100%">';
									$out .= '<tr>';
									$out .= '<th class="col_1 ta_r" colspan="5">Error</th>';
									$out .= '</tr>';
									$out .= $row;
									$out .= '</table>';
									$row = $out;
							
								 }
								echo json_encode(array('row' => $row));			
								
								exit;
			   }	  
	
	
			 
			 /* if($udrf['accname']){
							 $err="Already you have a master credit ".$udrf['accname']." complete it first";
							  $_SESSION['prod'][$index] = array(
						   
							 'err'=>$err
							  );
								$row  = '<tr>';
								$row .= '<td class="ta_r" colspan="4" width="100%">'.$err.'</td>';
								$row .= '</tr>';		  
								
								  if (empty($tblrep)) {
							
									$out  = '<table cellpadding="0" cellspacing="0" width="100%"';
									$out .= 'border="0" class="tbl_rep" width="100%">';
									$out .= '<tr>';
									$out .= '<th class="col_1 ta_r" colspan="4">Error</th>';
									$out .= '</tr>';
									$out .= $row;
									$out .= '</table>';
									$row = $out;
							
								 }
								echo json_encode(array('row' => $row));			
								
								exit;
			   }	*/  	
     
	 
	 
            $acn=mysql_query("SELECT*FROM  tbl_accchart WHERE accname='$_POST[accname_m]'") or die(mysql_error());
			$acf=mysql_fetch_array($acn);			 
			 
			 
			$acnc=mysql_query("SELECT*FROM  tbl_accchart WHERE accname='$_POST[accname]'") or die(mysql_error());
			$acfc=mysql_fetch_array($acnc);

			$chkdr=$myDb->select("SELECT*FROM tbl_tmpjurnal WHERE accno='$acf[id]' and vdate='".$_SESSION['vdate']."' and amountdr=0 and opby='$_SESSION[userid]'");
			$drf=$myDb->get_row($chkdr,'MYSQL_ASSOC');	
	 
			  /* if($drf['accname']){
							  $err=$drf['accname']." Already credited you can not debit it until save the voucher";
								 $_SESSION['prod'][$index] = array(
						   
								 'err'=>$err
							  );
								$row  = '<tr>';
								$row .= '<td class="ta_r" colspan="4" width="100%">'.$err.'</td>';
								$row .= '</tr>';		  
								
								  if (empty($tblrep)) {
							
									$out  = '<table cellpadding="0" cellspacing="0" width="100%"';
									$out .= 'border="0" class="tbl_rep" width="100%">';
									$out .= '<tr>';
									$out .= '<th class="col_1 ta_r" colspan="4">Error</th>';
									$out .= '</tr>';
									$out .= $row;
									$out .= '</table>';
									$row = $out;
							
								 }
								echo json_encode(array('row' => $row));			
								
								exit;
				 }else{*/
				 
								
								
								
								
								$acn=mysql_query("SELECT*FROM  tbl_accchart WHERE accname='$_POST[accname_m]'") or die(mysql_error());
								$acf=mysql_fetch_array($acn);			 
								 
								 
								$acnc=mysql_query("SELECT*FROM  tbl_accchart WHERE accname='$_POST[accname]'") or die(mysql_error());
								$acfc=mysql_fetch_array($acnc);
									
								$chkdr=$myDb->select("SELECT*FROM tbl_tmpjurnal WHERE accno='$acf[id]' and vdate='".date("Y-m-d")."' and amountcr=0 and opby='$_SESSION[userid]'");
								$drf=$myDb->get_row($chkdr,'MYSQL_ASSOC');	
								
							 /* if($drf['accname']){
							     $err=$drf['accname']." Already debited you can not credit it until save the voucher";
								 $_SESSION['prod'][$index] = array(
						   
								 'err'=>$err
							  );
								$row  = '<tr>';
								$row .= '<td class="ta_r" colspan="4" width="100%">'.$err.'</td>';
								$row .= '</tr>';		  
								
								  if (empty($tblrep)) {
							
									$out  = '<table cellpadding="0" cellspacing="0" width="100%"';
									$out .= 'border="0" class="tbl_rep" width="100%">';
									$out .= '<tr>';
									$out .= '<th class="col_1 ta_r" colspan="4">Error</th>';
									$out .= '</tr>';
									$out .= $row;
									$out .= '</table>';
									$row = $out;
							
								 }
								echo json_encode(array('row' => $row));			
								
								exit;
				 }else{		*/						
								$_SESSION['products'][$index] = array(
								'accname' => $accname,
								'vouchertype' => $vouchertype,
								'acctype'=>$acctype,
								'amountdr'=>$amountdr,
								'amountcr' => $amountcr,
								'voucherdate'=>$voucherdate
								);
								
								
								$acn=mysql_query("SELECT*FROM  tbl_accchart WHERE accname='$_POST[accname_m]'") or die(mysql_error());
								$acf=mysql_fetch_array($acn);			 
								 
								 
								$acnc=mysql_query("SELECT*FROM  tbl_accchart WHERE accname='$_POST[accname]'") or die(mysql_error());
								$acfc=mysql_fetch_array($acnc);
								
									    
								$maccno=mysql_query("SELECT id,accno FROM tbl_tmpjurnal WHERE id=(select max(id) from tbl_tmpjurnal where opby='$_SESSION[userid]' and amountcr=0
								                                                                  and masteraccno=0) 
												 and opby='$_SESSION[userid]' and amountcr=0 and masteraccno=0") or die(mysql_error());
								$macf=mysql_fetch_array($maccno);
								
								$sumamount=$myDb->select("SELECT SUM(amountdr) amountdr,(SELECT SUM(amountcr) FROM tbl_tmpjurnal WHERE masteraccno='$macf[accno]'
								                                                         AND opby='$_SESSION[userid]') amountcr
								                          FROM tbl_tmpjurnal
														  WHERE id='$macf[id]'
														  AND accno='$macf[accno]'
														  AND opby='$_SESSION[userid]'");
							    $amountf=$myDb->get_row($sumamount,'MYSQL_ASSOC');
														    $chkmac=mysql_query("SELECT*FROM tbl_tmpjurnal where accno='$acf[id]' and opby='$_SESSION[userid]'") or die(mysql_error());
															$chkmacf=mysql_fetch_array($chkmac);
															$acval=($chkmacf['amountcr']+$amountcr);
															if(!$chkmacf['accname']){
																mysql_query("INSERT INTO tbl_tmpjurnal(accname,vouchertype,paytype,
																									   amountcr,vdate,opby,accno,drcr,parentid,groupname,voucher_group)
																values('$accname_m','$vouchertype','$paytype','$amountcr','$voucherdate',
																	   '$_SESSION[userid]','$acf[id]','$acctype','$acf[parentid]','$acf[groupname]','$voucher_group')") or die(mysql_error());
															}else{
															    mysql_query("UPDATE tbl_tmpjurnal SET amountcr='$acval' where accno='$acf[id]'") or die(mysql_error());
															
															}		   
															
															$mastr=$myDb->select("SELECT * FROM tbl_tmpjurnal WHERE id=(SELECT MAX(id) FROM tbl_tmpjurnal)");
															$mastrf=$myDb->get_row($mastr,'MYSQL_ASSOC');
															
															mysql_query("INSERT INTO tbl_tmpjurnal(accname,vouchertype,paytype,
															                                       amountdr,vdate,opby,accno,masteraccno,drcr,parentid,groupname,voucher_group)
											                values('$accname','$vouchertype','$paytype','$amountcr','$voucherdate',
															       '$_SESSION[userid]','$acfc[id]','$acf[id]','DR','$acfc[parentid]','$acfc[groupname]','$voucher_group')") or die(mysql_error());								   
								   
							
								$row  = '<tr>';
								$row .= '<td>'.$accname.'</td>';
								$row .= '<td class="ta_r">'.$acctype.'</td>';
								$row .= '<td class="ta_r">'.$amountdr.'</td>';
								$row .= '<td class="ta_r">'.$amountcr.'</td>';
								$row .= '<td class="ta_r"><a href="#" class="remove" rel="'.mysql_insert_id();
								$row .= '">Remove</a></td>';
								$row .= '</tr>';
							
							
							
								if (empty($tbl)) {
							
									$out  = '<table cellpadding="0" cellspacing="0" ';
									$out .= 'border="0" class="tbl_repeat">';
									$out .= '<tr>';
									$out .= '<th>Acc name</th>';
									$out .= '<th class="col_1 ta_r">Acc Type</th>';
									$out .= '<th class="col_1 ta_r">Amountdr</th>';
									$out .= '<th class="col_1 ta_r">Amountcr</th>';
									$out .= '<th class="col_1 ta_r">Action</th>';
									$out .= '</tr>';
									$out .= $row;
									$out .= '</table>';
									$row = $out;
							
								 }
							
								 echo json_encode(array('row' => $row));
					//}
				//}				

      }
		 
		 
		 
  }	  


   }else{
     $msg="Sorry,you are not authorized to access this page";
	 header("Location:acchome.php?msg=$msg");
   }	 

}else{
  header("Location:login.php");
}
}  
?>

