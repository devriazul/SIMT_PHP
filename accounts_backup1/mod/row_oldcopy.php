<?php ob_start();
session_start();
include("config.php"); 
if($myDb->connectDefaultServer())
{ 
  if($_SESSION['userid']){
  $chka="SELECT*FROM  tbl_accdtl WHERE flname='add_jurnal.php' AND userid='$_SESSION[userid]'";
  $caq=$myDb->select($chka);
  $car=$myDb->get_row($caq,'MYSQL_ASSOC');
  if($car['ins']=="y"){
				$timezone = "Asia/Dhaka";
                if(function_exists('date_default_timezone_set')) date_default_timezone_set($timezone);  
$_SESSION['sdate']=$_POST['voucherdate'];
$_SESSION['vouchertype']=$_POST['vouchertype'];
$tbl = !empty($_GET['tbl']) ? $_GET['tbl'] : 0;
$di = !empty($_GET['di']) ? $_GET['di'] : 0;

$accname=!empty($_POST['accname']) ? $_POST['accname'] : '&nbsp;';
$accname_m=!empty($_POST['accname_m']) ? $_POST['accname_m'] : '&nbsp;';

$vouchertype=!empty($_POST['vouchertype']) ? $_POST['vouchertype'] : '&nbsp;';
$paytype=!empty($_POST['paytype']) ? $_POST['paytype'] : '&nbsp;';
$amountdr=!empty($_POST['amountdr']) ? $_POST['amountdr'] : '&nbsp;';
$acctype=!empty($_POST['acctype']) ? $_POST['acctype'] : '&nbsp;';
$amountcr=!empty($_POST['amountcr']) ? $_POST['amountcr'] : '0';
$voucherdate=!empty($_POST['voucherdate']) ? $_POST['voucherdate'] : '&nbsp;';
$err=!empty($_POST['err']) ? $_POST['err'] : '&nbsp;';
$index = !empty($_SESSION['products']) ? count($_SESSION['products']) + 1 : 1;

/*----------------------------------------------------------- Debit section start here --------------------------------------------------------------------------------*/
    if($vouchertype=="J"){
			if($acctype=="DR"){
						 
						 /* ----------------------------------- check debit head which masteraccno is 0 and can not debit head entry agin unit corresponding credit entry ------------ */
						 $udr=$myDb->select("
												select*
												from tbl_tmpjurnal
												where accno not in(select masteraccno
															 from tbl_tmpjurnal
															 where opby='$_SESSION[userid]'
															 and vdate='".date("Y-m-d")."'
															)
												and masteraccno=0
												and amountcr=0
												and opby='$_SESSION[userid]'
												and vdate='".date("Y-m-d")."'             
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
																					AND vdate='".date("Y-m-d")."'
																					
																				 )
															AND amountcr=0 
															AND masteraccno=0
															AND opby='$_SESSION[userid]'
															AND vdate='".date("Y-m-d")."'
																				 
															
														  )total_dr,(
			
															SELECT sum( amountcr )
															FROM tbl_tmpjurnal
															WHERE masteraccno IN (
																					SELECT accno
																					FROM tbl_tmpjurnal
																					WHERE opby='$_SESSION[userid]'
																					AND amountcr=0
																					AND masteraccno=0
																					AND vdate='".date("Y-m-d")."'
																					
																				 )
															AND amountdr=0 
															AND masteraccno<>0
															AND opby='$_SESSION[userid]'
															AND vdate='".date("Y-m-d")."'
																				 
															
														  )total_cr
												from tbl_tmpjurnal
												where accno in(select masteraccno
															 from tbl_tmpjurnal
															 where opby='$_SESSION[userid]'
															 AND amountdr=0
															 AND vdate='".date("Y-m-d")."'
															
															)
												and masteraccno=0
												and amountcr=0
												and opby='$_SESSION[userid]'
												and vdate='".date("Y-m-d")."'
									");
						  $csdcf=$myDb->get_row($csdc,'MYSQL_ASSOC');			
						 
						 if($csdcf['total_dr']!=$csdcf['total_cr']){
										 $err="Debit and credit not equal "."Debit:".$csdcf['total_dr']." and"." Credit:".$csdcf['total_cr']." ,please equal it first";
										  $_SESSION['prod'][$index] = array(
									   
										 'err'=>$err
										  );
											$row  = '<tr>';
											$row .= '<td class="ta_r" colspan="4" width="100%">'.$err.'</td>';
											$row .= '</tr>';		  
											
											  if (empty($tblrep)) {
										
												$out  = '<table cellpadding="0" cellspacing="0"';
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
						
						  if($udrf['accname']){
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
						   }	  
						 
						
						 
						 
						 
						 
									  
			
				 
						 $acn=mysql_query("SELECT*FROM  tbl_accchart WHERE accname='$_POST[accname]'") or die(mysql_error());
						 $acf=mysql_fetch_array($acn);
					
						 $chkdr=$myDb->select("SELECT*FROM tbl_tmpjurnal WHERE accno='$acf[id]' and vdate='".date("Y-m-d")."' and amountcr=0 and opby='$_SESSION[userid]'");
						 $drf=$myDb->get_row($chkdr,'MYSQL_ASSOC');
						  
						   if($drf['accname']){
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
						   }else{	  
										  if (empty($_SESSION['prod'])) {
											  unset($_SESSION['prod']);
										  }
										  
										  
											$chkdr=$myDb->select("SELECT*FROM tbl_tmpjurnal WHERE accno='$acf[id]' and vdate='".date("Y-m-d")."' and amountdr=0 and opby='$_SESSION[userid]'");
											$drf=$myDb->get_row($chkdr,'MYSQL_ASSOC');								  
												if($drf['accname']){
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
											   }else{								 
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
																	if($amountf['amountcr']==$amountf['amountdr']){													 
																		mysql_query("INSERT INTO tbl_tmpjurnal(accname,vouchertype,paytype,
																		                                       amountdr,vdate,opby,accno,drcr,parentid,groupname)
																		values('$accname','$vouchertype','$paytype','$amountdr','$voucherdate',
																			   '$_SESSION[userid]','$acf[id]','$acctype','$acf[parentid]','$acf[groupname]')") 
																			   or die(mysql_error());
																	}else{
																		mysql_query("INSERT INTO tbl_tmpjurnal(accname,vouchertype,paytype,
																		             amountdr,vdate,opby,accno,masteraccno,drcr,parentid,groupname)
																		values('$accname','$vouchertype','$paytype','$amountdr','$voucherdate',
																			   '$_SESSION[userid]','$acf[id]','$macf[accno]','$acctype','$acf[parentid]',
																			   '$acf[groupname]')") or die(mysql_error());
																	
																	}		   
														
														  $row  = '<tr>';
														  $row .= '<td >'.$accname.'</td>';
														  $row .= '<td class="ta_r">'.$acctype.'</td>';
														  $row .= '<td class="ta_r">'.$amountdr.'</td>';
														  $row .= '<td class="ta_r">'.$amountcr.'</td>';
														  $row .= '</tr>';
											
											
											
														if (empty($tbl)) {
													
															$out  = '<table cellpadding="0" cellspacing="0" ';
															$out .= 'border="0" class="tbl_repeat">';
															$out .= '<tr>';
															$out .= '<th class="col_1 ta_r">Acc name</th>';
															$out .= '<th class="col_1 ta_r">Acc Type</th>';
															$out .= '<th class="col_1 ta_r">Amountdr</th>';
															$out .= '<th class="col_1 ta_r">Amountcr</th>';
															$out .= '</tr>';
															$out .= $row;
															$out .= '</table>';
															$row = $out;
													
														  }
														  echo json_encode(array('row' => $row));
											}		  
								}
								
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
															 and vdate='".date("Y-m-d")."'
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
																					AND vdate='".date("Y-m-d")."'
																					
																				 )
															AND amountdr=0 
															AND masteraccno=0
															AND opby='$_SESSION[userid]'
															AND vdate='".date("Y-m-d")."'
																				 
															
														  )total_cr,(
			
															SELECT sum( amountdr )
															FROM tbl_tmpjurnal
															WHERE masteraccno IN (
																					SELECT accno
																					FROM tbl_tmpjurnal
																					WHERE opby='$_SESSION[userid]'
																					AND amountdr=0
																					AND masteraccno=0
																					AND vdate='".date("Y-m-d")."'
																					
																				 )
															AND amountcr=0 
															AND masteraccno<>0
															AND opby='$_SESSION[userid]'
															AND vdate='".date("Y-m-d")."'
																				 
															
														  )total_dr
												from tbl_tmpjurnal
												where accno in(select masteraccno
															 from tbl_tmpjurnal
															 where opby='$_SESSION[userid]'
															 AND amountcr=0
															 AND vdate='".date("Y-m-d")."'
															
															)
												and masteraccno=0
												and amountdr=0
												and opby='$_SESSION[userid]'
												and vdate='".date("Y-m-d")."'
									");
						  $csdcf=$myDb->get_row($csdc,'MYSQL_ASSOC');			
						 
						
						  if($csdcf['total_cr']!=$csdcf['total_dr']){
										 $err="Debit and credit not equal "."Cebit:".$csdcf['total_cr']." and"." Dredit:".$csdcf['total_dr']." ,please equal it first";
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
				
				   	 
						  if($udrf['accname']){
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
						   }	  	
				       
				
						$acn=mysql_query("SELECT*FROM  tbl_accchart WHERE accname='$_POST[accname]'") or die(mysql_error());
						$acf=mysql_fetch_array($acn);
							
						$chkdr=$myDb->select("SELECT*FROM tbl_tmpjurnal WHERE accno='$acf[id]' and vdate='".date("Y-m-d")."' and amountdr=0 and opby='$_SESSION[userid]'");
						$drf=$myDb->get_row($chkdr,'MYSQL_ASSOC');	
				 
						   if($drf['accname']){
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
							 }else{
							 
											
											
											
											
											$acn=mysql_query("SELECT*FROM  tbl_accchart WHERE accname='$_POST[accname]'") or die(mysql_error());
											$acf=mysql_fetch_array($acn);
												
											$chkdr=$myDb->select("SELECT*FROM tbl_tmpjurnal WHERE accno='$acf[id]' and vdate='".date("Y-m-d")."' and amountcr=0 and opby='$_SESSION[userid]'");
											$drf=$myDb->get_row($chkdr,'MYSQL_ASSOC');	
											
										  if($drf['accname']){
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
							 }else{								
											$_SESSION['products'][$index] = array(
											'accname' => $accname,
											'vouchertype' => $vouchertype,
											'acctype'=>$acctype,
											'amountdr'=>$amountdr,
											'amountcr' => $amountcr,
											'voucherdate'=>$voucherdate
											);	    
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
											if($amountf['amountdr']==$amountf['amountcr']){
										 
											   mysql_query("INSERT INTO tbl_tmpjurnal(accname,vouchertype,paytype,amountdr,
											                                          amountcr,vdate,opby,accno,drcr,parentid,groupname)
															values('$accname','$vouchertype','$paytype','$amountdr','$amountcr',
														   '$voucherdate','$_SESSION[userid]','$acf[id]','$acctype','$acf[parentid]','$acf[groupname]')") or die(mysql_error());
											}else{
											
											   mysql_query("INSERT INTO tbl_tmpjurnal(accname,vouchertype,paytype,amountdr,
											                                          amountcr,vdate,opby,masteraccno,accno,drcr,parentid,groupname)
															values('$accname','$vouchertype','$paytype','$amountdr','$amountcr',
														   '$voucherdate','$_SESSION[userid]','$macf[accno]','$acf[id]','$acctype','$acf[parentid]',
														   '$acf[groupname]')") or die(mysql_error());
											}			   
										
											$row  = '<tr>';
											$row .= '<td>'.$accname.'</td>';
											$row .= '<td class="ta_r">'.$acctype.'</td>';
											$row .= '<td class="ta_r">'.$amountdr.'</td>';
											$row .= '<td class="ta_r">'.$amountcr.'</td>';
											$row .= '</tr>';
										
										
										
											if (empty($tbl)) {
										
												$out  = '<table cellpadding="0" cellspacing="0" ';
												$out .= 'border="0" class="tbl_repeat">';
												$out .= '<tr>';
												$out .= '<th>Acc name</th>';
												$out .= '<th class="col_1 ta_r">Acc Type</th>';
												$out .= '<th class="col_1 ta_r">Amountdr</th>';
												$out .= '<th class="col_1 ta_r">Amountcr</th>';
												$out .= '</tr>';
												$out .= $row;
												$out .= '</table>';
												$row = $out;
										
											 }
										
											 echo json_encode(array('row' => $row));
								}
							}				
			
				  }
         }
		 
		 /// without journal ------------------>receive and payment section here ///
         if($vouchertype!="J"){ 
		   if($acctype=="DR"){
             
			 /* ----------------------------------- check debit head which masteraccno is 0 and can not debit head entry agin unit corresponding credit entry ------------ */
			 $udr=$myDb->select("
									select*
									from tbl_tmpjurnal
									where accno not in(select masteraccno
												 from tbl_tmpjurnal
												 where opby='$_SESSION[userid]'
												 and vdate='".date("Y-m-d")."'
												)
									and masteraccno=0
									and amountcr=0
									and opby='$_SESSION[userid]'
									and vdate='".date("Y-m-d")."'             
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
																		AND vdate='".date("Y-m-d")."'
																		
																	 )
												AND amountcr=0 
												AND masteraccno=0
												AND opby='$_SESSION[userid]'
												AND vdate='".date("Y-m-d")."'
																	 
												
											  )total_dr,(

												SELECT sum( amountcr )
												FROM tbl_tmpjurnal
												WHERE masteraccno IN (
																		SELECT accno
																		FROM tbl_tmpjurnal
																		WHERE opby='$_SESSION[userid]'
																		AND amountcr=0
																		AND masteraccno=0
																		AND vdate='".date("Y-m-d")."'
																		
																	 )
												AND amountdr=0 
												AND masteraccno<>0
												AND opby='$_SESSION[userid]'
												AND vdate='".date("Y-m-d")."'
																	 
												
											  )total_cr
									from tbl_tmpjurnal
									where accno in(select masteraccno
												 from tbl_tmpjurnal
												 where opby='$_SESSION[userid]'
												 AND amountdr=0
												 AND vdate='".date("Y-m-d")."'
												
												)
									and masteraccno=0
									and amountcr=0
									and opby='$_SESSION[userid]'
									and vdate='".date("Y-m-d")."'
						");
			  $csdcf=$myDb->get_row($csdc,'MYSQL_ASSOC');			
			 
              if($csdcf['total_dr']!=$csdcf['total_cr']){
							 $err="Debit and credit not equal "."Debit:".$csdcf['total_dr']." and"." Credit:".$csdcf['total_cr']." ,please equal it first";
							  $_SESSION['prod'][$index] = array(
						   
							 'err'=>$err
							  );
								$row  = '<tr>';
								$row .= '<td class="ta_r" colspan="4" width="100%">'.$err.'</td>';
								$row .= '</tr>';		  
								
								  if (empty($tblrep)) {
							
									$out  = '<table cellpadding="0" cellspacing="0"';
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
			 
			 
			  if($udrf['accname']){
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
			   }	  
			 
			 
			 
			 
			 
			 
			 			  

             $acn=mysql_query("SELECT*FROM  tbl_accchart WHERE accname='$_POST[accname_m]'") or die(mysql_error());
			 $acf=mysql_fetch_array($acn);			 
			 
			 
			 $acnc=mysql_query("SELECT*FROM  tbl_accchart WHERE accname='$_POST[accname]'") or die(mysql_error());
			 $acfc=mysql_fetch_array($acnc);
		
			 $chkdr=$myDb->select("SELECT*FROM tbl_tmpjurnal WHERE accno='$acf[id]' and vdate='".date("Y-m-d")."' and amountcr=0 and opby='$_SESSION[userid]'");
			 $drf=$myDb->get_row($chkdr,'MYSQL_ASSOC');
			  
			   if($drf['accname']){
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
			   }else{	  
							  if (empty($_SESSION['prod'])) {
								  unset($_SESSION['prod']);
							  }
							  
							  
								$chkdr=$myDb->select("SELECT*FROM tbl_tmpjurnal WHERE accno='$acf[id]' and vdate='".date("Y-m-d")."' and amountdr=0 and opby='$_SESSION[userid]'");
								$drf=$myDb->get_row($chkdr,'MYSQL_ASSOC');								  
									if($drf['accname']){
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
								   }else{								 
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
														/* if($amountf['amountcr']==$amountf['amountdr']){		
													----- if sum of dr and sum of cr equal then new voucher entry start which maccno is 0  */
											 
												           /* mysql_query("INSERT INTO tbl_tmpjurnal(id,accname,vouchertype,paytype,amountdr,vdate,opby,accno)
											                values('$index','$accname','$vouchertype','$paytype','$amountdr','$voucherdate',
															       '$_SESSION[userid]','$acf[id]')") or die(mysql_error());
																   
														   */
														   
														    mysql_query("INSERT INTO tbl_tmpjurnal(accname,vouchertype,paytype,
															                                       amountcr,vdate,opby,accno,drcr,parentid,groupname)
											                values('$accname_m','$vouchertype','$paytype','$amountdr','$voucherdate',
															       '$_SESSION[userid]','$acf[id]','$acctype','$acf[parentid]','$acf[groupname]')") or die(mysql_error());
															
															$mastr=$myDb->select("SELECT * FROM tbl_tmpjurnal WHERE id=(SELECT MAX(id) FROM tbl_tmpjurnal)");
															$mastrf=$myDb->get_row($mastr,'MYSQL_ASSOC');
															
															mysql_query("INSERT INTO tbl_tmpjurnal(accname,vouchertype,paytype,
															                                       amountdr,vdate,opby,accno,masteraccno,drcr,parentid,groupname)
											                values('$accname','$vouchertype','$paytype','$amountdr','$voucherdate',
															       '$_SESSION[userid]','$acfc[id]','$mastrf[accno]','CR','$acfc[parentid]','$acfc[groupname]')") 
																   or die(mysql_error());
														   
														   
														   
														   
														
														/*}else{
														   echo "News master entry start";
															
															
															mysql_query("INSERT INTO tbl_tmpjurnal(id,accname,vouchertype,paytype,amountdr,vdate,opby,accno,masteraccno)
											                values('$index','$accname','$vouchertype','$paytype','$amountdr','$voucherdate',
															       '$_SESSION[userid]','$acf[id]','$macf[accno]')") or die(mysql_error());
														
														    
														
														}	*/	   
											
											  $row  = '<tr>';
											  $row .= '<td >'.$accname.'</td>';
											  $row .= '<td class="ta_r">'.$acctype.'</td>';
											  $row .= '<td class="ta_r">'.$amountdr.'</td>';
											  $row .= '<td class="ta_r">'.$amountcr.'</td>';
											  $row .= '</tr>';
								
								
								
											if (empty($tbl)) {
										
												$out  = '<table cellpadding="0" cellspacing="0" ';
												$out .= 'border="0" class="tbl_repeat">';
												$out .= '<tr>';
												$out .= '<th class="col_1 ta_r">Acc name</th>';
												$out .= '<th class="col_1 ta_r">Acc Type</th>';
												$out .= '<th class="col_1 ta_r">Amountdr</th>';
												$out .= '<th class="col_1 ta_r">Amountcr</th>';
												$out .= '</tr>';
												$out .= $row;
												$out .= '</table>';
												$row = $out;
										
											  }
											  echo json_encode(array('row' => $row));
								}		  
					}
					
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
												 and vdate='".date("Y-m-d")."'
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
																		AND vdate='".date("Y-m-d")."'
																		
																	 )
												AND amountdr=0 
												AND masteraccno=0
												AND opby='$_SESSION[userid]'
												AND vdate='".date("Y-m-d")."'
																	 
												
											  )total_cr,(

												SELECT sum( amountdr )
												FROM tbl_tmpjurnal
												WHERE masteraccno IN (
																		SELECT accno
																		FROM tbl_tmpjurnal
																		WHERE opby='$_SESSION[userid]'
																		AND amountdr=0
																		AND masteraccno=0
																		AND vdate='".date("Y-m-d")."'
																		
																	 )
												AND amountcr=0 
												AND masteraccno<>0
												AND opby='$_SESSION[userid]'
												AND vdate='".date("Y-m-d")."'
																	 
												
											  )total_dr
									from tbl_tmpjurnal
									where accno in(select masteraccno
												 from tbl_tmpjurnal
												 where opby='$_SESSION[userid]'
												 AND amountcr=0
												 AND vdate='".date("Y-m-d")."'
												
												)
									and masteraccno=0
									and amountdr=0
									and opby='$_SESSION[userid]'
									and vdate='".date("Y-m-d")."'
						");
			  $csdcf=$myDb->get_row($csdc,'MYSQL_ASSOC');			
			 
              if($csdcf['total_cr']!=$csdcf['total_dr']){
							 $err="Debit and credit not equal "."Cebit:".$csdcf['total_cr']." and"." Dredit:".$csdcf['total_dr']." ,please equal it first";
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
	
	
			 
			  if($udrf['accname']){
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
			   }	  	
     
	 
	 
            $acn=mysql_query("SELECT*FROM  tbl_accchart WHERE accname='$_POST[accname_m]'") or die(mysql_error());
			$acf=mysql_fetch_array($acn);			 
			 
			 
			$acnc=mysql_query("SELECT*FROM  tbl_accchart WHERE accname='$_POST[accname]'") or die(mysql_error());
			$acfc=mysql_fetch_array($acnc);

			$chkdr=$myDb->select("SELECT*FROM tbl_tmpjurnal WHERE accno='$acf[id]' and vdate='".date("Y-m-d")."' and amountdr=0 and opby='$_SESSION[userid]'");
			$drf=$myDb->get_row($chkdr,'MYSQL_ASSOC');	
	 
			   if($drf['accname']){
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
				 }else{
				 
								
								
								
								
								$acn=mysql_query("SELECT*FROM  tbl_accchart WHERE accname='$_POST[accname_m]'") or die(mysql_error());
								$acf=mysql_fetch_array($acn);			 
								 
								 
								$acnc=mysql_query("SELECT*FROM  tbl_accchart WHERE accname='$_POST[accname]'") or die(mysql_error());
								$acfc=mysql_fetch_array($acnc);
									
								$chkdr=$myDb->select("SELECT*FROM tbl_tmpjurnal WHERE accno='$acf[id]' and vdate='".date("Y-m-d")."' and amountcr=0 and opby='$_SESSION[userid]'");
								$drf=$myDb->get_row($chkdr,'MYSQL_ASSOC');	
								
							  if($drf['accname']){
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
				 }else{								
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
								   
                                                            mysql_query("INSERT INTO tbl_tmpjurnal(accname,vouchertype,paytype,
															                                       amountdr,vdate,opby,accno,drcr,parentid,groupname)
											                values('$accname_m','$vouchertype','$paytype','$amountcr','$voucherdate',
															       '$_SESSION[userid]','$acf[id]','$acctype','$acf[parentid]','$acf[groupname]')") or die(mysql_error());
															
															$mastr=$myDb->select("SELECT * FROM tbl_tmpjurnal WHERE id=(SELECT MAX(id) FROM tbl_tmpjurnal)");
															$mastrf=$myDb->get_row($mastr,'MYSQL_ASSOC');
															
															mysql_query("INSERT INTO tbl_tmpjurnal(accname,vouchertype,paytype,
															                                       amountcr,vdate,opby,accno,masteraccno,drcr,parentid,groupname)
											                values('$accname','$vouchertype','$paytype','$amountcr','$voucherdate',
															       '$_SESSION[userid]','$acfc[id]','$mastrf[accno]','DR','$acfc[parentid]','$acfc[groupname]')") or die(mysql_error());								   
								   
							
								$row  = '<tr>';
								$row .= '<td>'.$accname.'</td>';
								$row .= '<td class="ta_r">'.$acctype.'</td>';
								$row .= '<td class="ta_r">'.$amountdr.'</td>';
								$row .= '<td class="ta_r">'.$amountcr.'</td>';
								$row .= '</tr>';
							
							
							
								if (empty($tbl)) {
							
									$out  = '<table cellpadding="0" cellspacing="0" ';
									$out .= 'border="0" class="tbl_repeat">';
									$out .= '<tr>';
									$out .= '<th>Acc name</th>';
									$out .= '<th class="col_1 ta_r">Acc Type</th>';
									$out .= '<th class="col_1 ta_r">Amountdr</th>';
									$out .= '<th class="col_1 ta_r">Amountcr</th>';
									$out .= '</tr>';
									$out .= $row;
									$out .= '</table>';
									$row = $out;
							
								 }
							
								 echo json_encode(array('row' => $row));
					}
				}				

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

