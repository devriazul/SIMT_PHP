<?php ob_start();
session_start();
require_once('dbClass.php');
include("config.php"); 
if($myDb->connect($host,$user,$pwd,$db,true))
{ 
  if($_SESSION['userid']){
  $chka="SELECT*FROM  tbl_accdtl WHERE flname='add_jurnal.php' AND userid='$_SESSION[userid]'";
  $caq=$myDb->select($chka);
  $car=$myDb->get_row($caq,'MYSQL_ASSOC');
  if($car['ins']=="y"){
$_SESSION['sdate']=$_POST['voucherdate'];
$tbl = !empty($_GET['tbl']) ? $_GET['tbl'] : 0;
$di = !empty($_GET['di']) ? $_GET['di'] : 0;
//$name = !empty($_POST['name']) ? $_POST['name'] : '&nbsp;';
//$price = !empty($_POST['price']) ? $_POST['price'] : '&nbsp;';
//$qty = !empty($_POST['qty']) ? $_POST['qty'] : '&nbsp;';

$accname=!empty($_POST['accname']) ? $_POST['accname'] : '&nbsp;';
$vouchertype=!empty($_POST['vouchertype']) ? $_POST['vouchertype'] : '&nbsp;';
$paytype=!empty($_POST['paytype']) ? $_POST['paytype'] : '&nbsp;';
$amountdr=!empty($_POST['amountdr']) ? $_POST['amountdr'] : '&nbsp;';
$acctype=!empty($_POST['acctype']) ? $_POST['acctype'] : '&nbsp;';
$amountcr=!empty($_POST['amountcr']) ? $_POST['amountcr'] : '&nbsp;';
$voucherdate=!empty($_POST['voucherdate']) ? $_POST['voucherdate'] : '&nbsp;';
$err=!empty($_POST['err']) ? $_POST['err'] : '&nbsp;';
$index = !empty($_SESSION['products']) ? count($_SESSION['products']) + 1 : 1;


/*SELECT id drid,(select id from tbl_tmpjurnal where amountdr=0 and opby='admin' and vdate='2013-01-17') crid,
       accno draccno,(select accno from tbl_tmpjurnal where amountdr=0 and opby='admin' and vdate='2013-01-17') craccno 
FROM tbl_tmpjurnal 
WHERE id=(select max(id) from tbl_tmpjurnal where opby='admin' and amountcr=0) 
												 
and opby='admin' and amountcr=0

*/

if($acctype=="DR"){

     
			 $acn=mysql_query("SELECT*FROM  tbl_accchart WHERE accname='$_POST[accname]'") or die(mysql_error());
			 $acf=mysql_fetch_array($acn);
		
			 $chkdr=$myDb->select("SELECT*FROM tbl_tmpjurnal WHERE accno='$acf[id]' and vdate='".date("Y-m-d")."' and amountcr=0 and opby='$_SESSION[userid]'");
			 $drf=$myDb->get_row($chkdr,'MYSQL_ASSOC');
			  
			   if($drf['accname']){
							 $err=$drf['accname']." Already debited in the database";
							  $_SESSION['prod'][$index] = array(
						   
							 'err'=>$err
							  );
								$row  = '<tr>';
								$row .= '<td class="ta_r" colspan="4">'.$err.'</td>';
								$row .= '</tr>';		  
								
								  if (empty($tblrep)) {
							
									$out  = '<table cellpadding="0" cellspacing="0" ';
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
												 $err=$drf['accname']." Already credited you can not debit this head";
												  $_SESSION['prod'][$index] = array(
											   
												 'err'=>$err
												  );
													$row  = '<tr>';
													$row .= '<td class="ta_r" colspan="4">'.$err.'</td>';
													$row .= '</tr>';		  
													
													  if (empty($tblrep)) {
												
														$out  = '<table cellpadding="0" cellspacing="0" ';
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
												            mysql_query("INSERT INTO tbl_tmpjurnal(id,accname,vouchertype,paytype,amountdr,vdate,opby,accno)
											                values('$index','$accname','$vouchertype','$paytype','$amountdr','$voucherdate',
															       '$_SESSION[userid]','$acf[id]')") or die(mysql_error());
														}else{
												            mysql_query("INSERT INTO tbl_tmpjurnal(id,accname,vouchertype,paytype,amountdr,vdate,opby,accno,masteraccno)
											                values('$index','$accname','$vouchertype','$paytype','$amountdr','$voucherdate',
															       '$_SESSION[userid]','$acf[id]','$macf[accno]')") or die(mysql_error());
														
														}		   
											
											  $row  = '<tr>';
											  $row .= '<td >'.$accname.'</td>';
											  $row .= '<td class="ta_r">'.$acctype.'</td>';
											  $row .= '<td class="ta_r">'.$amountdr.'</td>';
											  $row .= '<td class="ta_r">'.$amountcr.'</td>';
											  $row .= '<td class="ta_r"><a href="#" class="remove" rel="'.$index;
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
												$out .= '<th class="col_1 ta_r">Remove</th>';
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
	    
	
	
     
	
			$acn=mysql_query("SELECT*FROM  tbl_accchart WHERE accname='$_POST[accname]'") or die(mysql_error());
			$acf=mysql_fetch_array($acn);
				
			$chkdr=$myDb->select("SELECT*FROM tbl_tmpjurnal WHERE accno='$acf[id]' and vdate='".date("Y-m-d")."' and amountdr=0 and opby='$_SESSION[userid]'");
			$drf=$myDb->get_row($chkdr,'MYSQL_ASSOC');	
	 
			   if($drf['accname']){
							  $err=$drf['accname']." Already credited in the database";
								 $_SESSION['prod'][$index] = array(
						   
								 'err'=>$err
							  );
								$row  = '<tr>';
								$row .= '<td class="ta_r" colspan="4">'.$err.'</td>';
								$row .= '</tr>';		  
								
								  if (empty($tblrep)) {
							
									$out  = '<table cellpadding="0" cellspacing="0" ';
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
							     $err=$drf['accname']." Already debited you can not credit this head in the database";
								 $_SESSION['prod'][$index] = array(
						   
								 'err'=>$err
							  );
								$row  = '<tr>';
								$row .= '<td class="ta_r" colspan="4">'.$err.'</td>';
								$row .= '</tr>';		  
								
								  if (empty($tblrep)) {
							
									$out  = '<table cellpadding="0" cellspacing="0" ';
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
							 
								   mysql_query("INSERT INTO tbl_tmpjurnal(id,accname,vouchertype,paytype,amountdr,amountcr,vdate,opby,accno )
										        values('$index','$accname','$vouchertype','$paytype','$amountdr','$amountcr',
										       '$voucherdate','$_SESSION[userid]','$acf[id]')") or die(mysql_error());
								}else{
								
								   mysql_query("INSERT INTO tbl_tmpjurnal(id,accname,vouchertype,paytype,amountdr,amountcr,vdate,opby,masteraccno,accno )
										        values('$index','$accname','$vouchertype','$paytype','$amountdr','$amountcr',
										       '$voucherdate','$_SESSION[userid]','$macf[accno]','$acf[id]')") or die(mysql_error());
								}			   
							
								$row  = '<tr>';
								$row .= '<td>'.$accname.'</td>';
								$row .= '<td class="ta_r">'.$acctype.'</td>';
								$row .= '<td class="ta_r">'.$amountdr.'</td>';
								$row .= '<td class="ta_r">'.$amountcr.'</td>';
								$row .= '<td class="ta_r"><a href="#" class="remove" rel="'.$index;
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
									$out .= '<th class="col_1 ta_r">Remove</th>';
									$out .= '</tr>';
									$out .= $row;
									$out .= '</table>';
									$row = $out;
							
								 }
							
								 echo json_encode(array('row' => $row));
					}
				}				

      }


   }else{
     $msg="Sorry,you are not authorized to access this page";
	 header("Location:acchome.html?msg=$msg");
   }	 

}else{
  header("Location:login.html");
}
}  
?>

