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
  //$vdate=mysql_real_escape_string($_GET['vdate']);
  //$_SESSION['vdate']=$vdate;               
			    //$timezone = "Asia/Dhaka";
                //if(function_exists('date_default_timezone_set')) date_default_timezone_set($timezone);
				
				$total_drcr=$myDb->select("SELECT SUM(amountdr) total_dr,SUM(amountcr) total_cr
				                           FROM tbl_tmpjurnal
										   WHERE opby='$_SESSION[userid]'
										   AND vdate='".$_SESSION['vdate']."'
										 ");
				$total_drcrf=$myDb->get_row($total_drcr,'MYSQL_ASSOC');	
				
				$vtype=$myDb->select("SELECT*FROM tbl_tmpjurnal WHERE opby='$_SESSION[userid]' AND vdate='".$_SESSION['vdate']."'");
				while($vtypef=$myDb->get_row($vtype,'MYSQL_ASSOC')){

						   switch($vtypef['vouchertype']){
								case "C":
									 $total_r=$myDb->select("SELECT*FROM tbl_tmpjurnal WHERE vouchertype='$vtypef[vouchertype]' 
																					   AND opby='$_SESSION[userid]' 
																					   AND vdate='".$_SESSION['vdate']."'");
									 $total_rf=$myDb->get_row($total_r,'MYSQL_ASSOC');
									 $trow=$myDb->row_count;
									 
									 									 
									 if($total_drcrf['total_dr']!=$total_drcrf['total_cr']){
										 echo "Debit and credit not same,you can not save data";
										 exit;
									 }else{
										 
										 $total_mst=$myDb->select("SELECT *FROM tbl_tmpjurnal
																	WHERE accno
																				IN (
																				
																						SELECT masteraccno
																						FROM tbl_tmpjurnal
																						WHERE opby='$_SESSION[userid]'
																						AND vdate='".$_SESSION['vdate']."'
																						AND vouchertype='$vtypef[vouchertype]'
																				)
																	AND opby='$_SESSION[userid]'
																	AND vdate='".$_SESSION['vdate']."'
																	AND vouchertype='$vtypef[vouchertype]'
																  ");
										 $total_mstrow=$myDb->row_count;								
										
										
										 $i=0;
										 while($total_mstf=$myDb->get_row($total_mst,'MYSQL_ASSOC')){
													 $vid=$myDb->select("SELECT ifnull(count(id),0) mvid FROM tbl_masterjournal 
												  					  		WHERE vouchertype='$vtypef[vouchertype]'");
													 /*select("SELECT cast( ifnull( max( substr( voucherid, -2, 15 ) ) , 0 ) AS signed int ) mvid
																		  FROM tbl_masterjournal
																		  WHERE vouchertype='$vtypef[vouchertype]'");*/
																		  
													 $vidf=$myDb->get_row($vid,'MYSQL_ASSOC');
													 $maxvid=$vidf['mvid']+1;
													 $mvidf="CN/-".$_SESSION['vdate']."-"."0".$maxvid;
													 //echo $mvidf;
													 //exit;
													 $ins="INSERT INTO tbl_masterjournal(voucherid,voucherdate,vouchertype,preparedby,
																									  paytype,opby,opdate,storedstatus,accountno,voucherexpl,multi_single,
																									  voucher_group)
																					VALUES('$mvidf','$total_mstf[vdate]','$total_mstf[vouchertype]',
																						   '$_SESSION[userid]','$total_mstf[paytype]','$_SESSION[userid]',
																						   '$total_mstf[vdate]','I','$total_mstf[accno]',
																						   '$_POST[description]','$total_mstf[multi_single]',
																						   '$total_mstf[voucher_group]')
																	  ";
													 $ins2nd="INSERT INTO tbl_2ndjournal(accno,accname,amountdr,amountcr,voucherid,
																							vouchertype,paytype,vdate,masteraccno,
																							storedstatus,opby,parentid,groupname,multi_single,voucher_group)
																					VALUES('$total_mstf[accno]','$total_mstf[accname]','$total_mstf[amountdr]',
																						   '$total_mstf[amountcr]','$mvidf','$vtypef[vouchertype]','$total_mstf[paytype]',
																						   '$total_mstf[vdate]','$total_mstf[masteraccno]','I','$_SESSION[userid]',
																						   '$total_mstf[parentid]','$total_mstf[groupname]','$total_mstf[multi_single]',
																						   '$total_mstf[voucher_group]')";
													 $myDb->insert_sql($ins2nd);									   
																	  
													 if($myDb->insert_sql($ins)){
													 
														 
														 $total_cht=$myDb->select("SELECT *FROM tbl_tmpjurnal
																	WHERE masteraccno
																				IN (
																				
																						SELECT accno
																						FROM tbl_tmpjurnal
																						WHERE opby='$_SESSION[userid]'
																						AND vdate='".$_SESSION['vdate']."'
																						AND vouchertype='$vtypef[vouchertype]'
																				)
																	AND opby='$_SESSION[userid]'
																	AND vdate='".$_SESSION['vdate']."'
																	AND vouchertype='$vtypef[vouchertype]'
																  ");
														$total_chtrow=$myDb->row_count;											    
														while($total_chtf=$myDb->get_row($total_cht,'MYSQL_ASSOC')){
															  
															  $vid=$myDb->select("SELECT voucherid FROM tbl_masterjournal 
															                      WHERE accountno='$total_chtf[masteraccno]'
															                      AND voucherid='$mvidf'
																				  AND vouchertype='$vtypef[vouchertype]'");
															  while($vidf=$myDb->get_row($vid,'MYSQL_ASSOC')){
															  
																	  $ins2nd="INSERT INTO tbl_2ndjournal(accno,accname,amountdr,amountcr,voucherid,
																									vouchertype,paytype,vdate,masteraccno,
																									storedstatus,opby,parentid,groupname,multi_single,
																									voucher_group)
																							VALUES('$total_chtf[accno]','$total_chtf[accname]','$total_chtf[amountdr]',
																								   '$total_chtf[amountcr]','$vidf[voucherid]',
																								   '$vtypef[vouchertype]','$total_chtf[paytype]',
																								   '$total_chtf[vdate]','$total_chtf[masteraccno]','I','$_SESSION[userid]',
																								   '$total_chtf[parentid]','$total_chtf[groupname]','$total_chtf[multi_single]',
																								   '$total_chtf[voucher_group]')";
														
																	  if($myDb->insert_sql($ins2nd)){
																		 $delcht=$myDb->update_sql("DELETE FROM tbl_tmpjurnal
																									WHERE accno='$total_chtf[accno]'
																									and masteraccno='$total_chtf[masteraccno]'
																									AND opby='$_SESSION[userid]'
																						
																		 ");
																		 
																		 $delmst=$myDb->update_sql("DELETE FROM tbl_tmpjurnal
																						            WHERE accno='$total_mstf[accno]'
																									AND opby='$_SESSION[userid]'
																						
																		 ");	
																	  }else{
																	  
																		 echo $myDb->last_error;
																	  }	
															   }		   
														
														}							
														
															 unset($_SESSION['product']);				   
														//echo "Successfull record save...";
													 }else{
														echo $myDb->last_error;
													 }
										 $i++;
										 }			
														  
									 }
									 break;								
								case "R":
									 $total_r=$myDb->select("SELECT*FROM tbl_tmpjurnal WHERE vouchertype='$vtypef[vouchertype]' 
																					   AND opby='$_SESSION[userid]' 
																					   AND vdate='".$_SESSION['vdate']."'");
									 $total_rf=$myDb->get_row($total_r,'MYSQL_ASSOC');
									 $trow=$myDb->row_count;
									 
									 									 
									 if($total_drcrf['total_dr']!=$total_drcrf['total_cr']){
										 echo "Debit and credit not same,you can not save data";
										 exit;
									 }else{
										 
										 $total_mst=$myDb->select("SELECT *FROM tbl_tmpjurnal
																	WHERE accno
																				IN (
																				
																						SELECT masteraccno
																						FROM tbl_tmpjurnal
																						WHERE opby='$_SESSION[userid]'
																						AND vdate='".$_SESSION['vdate']."'
																						AND vouchertype='$vtypef[vouchertype]'
																				)
																	AND opby='$_SESSION[userid]'
																	AND vdate='".$_SESSION['vdate']."'
																	AND vouchertype='$vtypef[vouchertype]'
																  ");
										 $total_mstrow=$myDb->row_count;								
										
										
										 $i=0;
										 while($total_mstf=$myDb->get_row($total_mst,'MYSQL_ASSOC')){
													 $vid=$myDb->select("SELECT ifnull(count(id),0) mvid FROM tbl_masterjournal 
												  					  		WHERE vouchertype='$vtypef[vouchertype]'");
													 /*select("SELECT cast( ifnull( max( substr( voucherid, -2, 15 ) ) , 0 ) AS signed int ) mvid
																		  FROM tbl_masterjournal
																		  WHERE vouchertype='$vtypef[vouchertype]'");*/
																		  
													 $vidf=$myDb->get_row($vid,'MYSQL_ASSOC');
													 $maxvid=$vidf['mvid']+1;
													 $mvidf="RV/-".$_SESSION['vdate']."-"."0".$maxvid;
													 //echo $mvidf;
													 //exit;
													 $ins="INSERT INTO tbl_masterjournal(voucherid,voucherdate,vouchertype,preparedby,
																									  paytype,opby,opdate,storedstatus,accountno,voucherexpl,multi_single,
																									  voucher_group)
																					VALUES('$mvidf','$total_mstf[vdate]','$total_mstf[vouchertype]',
																						   '$_SESSION[userid]','$total_mstf[paytype]','$_SESSION[userid]',
																						   '$total_mstf[vdate]','I','$total_mstf[accno]',
																						   '$_POST[description]','$total_mstf[multi_single]',
																						   '$total_mstf[voucher_group]')
																	  ";
													 $ins2nd="INSERT INTO tbl_2ndjournal(accno,accname,amountdr,amountcr,voucherid,
																							vouchertype,paytype,vdate,masteraccno,
																							storedstatus,opby,parentid,groupname,multi_single,voucher_group)
																					VALUES('$total_mstf[accno]','$total_mstf[accname]','$total_mstf[amountdr]',
																						   '$total_mstf[amountcr]','$mvidf','$vtypef[vouchertype]','$total_mstf[paytype]',
																						   '$total_mstf[vdate]','$total_mstf[masteraccno]','I','$_SESSION[userid]',
																						   '$total_mstf[parentid]','$total_mstf[groupname]','$total_mstf[multi_single]',
																						   '$total_mstf[voucher_group]')";
													 $myDb->insert_sql($ins2nd);									   
																	  
													 if($myDb->insert_sql($ins)){
													 
														 
														 $total_cht=$myDb->select("SELECT *FROM tbl_tmpjurnal
																	WHERE masteraccno
																				IN (
																				
																						SELECT accno
																						FROM tbl_tmpjurnal
																						WHERE opby='$_SESSION[userid]'
																						AND vdate='".$_SESSION['vdate']."'
																						AND vouchertype='$vtypef[vouchertype]'
																				)
																	AND opby='$_SESSION[userid]'
																	AND vdate='".$_SESSION['vdate']."'
																	AND vouchertype='$vtypef[vouchertype]'
																  ");
														$total_chtrow=$myDb->row_count;											    
														while($total_chtf=$myDb->get_row($total_cht,'MYSQL_ASSOC')){
															  
															  $vid=$myDb->select("SELECT voucherid FROM tbl_masterjournal 
															                      WHERE accountno='$total_chtf[masteraccno]'
															                      AND voucherid='$mvidf'
																				  AND vouchertype='$vtypef[vouchertype]'");
															  while($vidf=$myDb->get_row($vid,'MYSQL_ASSOC')){
															  
																	  $ins2nd="INSERT INTO tbl_2ndjournal(accno,accname,amountdr,amountcr,voucherid,
																									vouchertype,paytype,vdate,masteraccno,
																									storedstatus,opby,parentid,groupname,multi_single,
																									voucher_group)
																							VALUES('$total_chtf[accno]','$total_chtf[accname]','$total_chtf[amountdr]',
																								   '$total_chtf[amountcr]','$vidf[voucherid]',
																								   '$vtypef[vouchertype]','$total_chtf[paytype]',
																								   '$total_chtf[vdate]','$total_chtf[masteraccno]','I','$_SESSION[userid]',
																								   '$total_chtf[parentid]','$total_chtf[groupname]','$total_chtf[multi_single]',
																								   '$total_chtf[voucher_group]')";
														
																	  if($myDb->insert_sql($ins2nd)){
																		 $delcht=$myDb->update_sql("DELETE FROM tbl_tmpjurnal
																									WHERE accno='$total_chtf[accno]'
																									and masteraccno='$total_chtf[masteraccno]'
																									AND opby='$_SESSION[userid]'
																						
																		 ");
																		 
																		 $delmst=$myDb->update_sql("DELETE FROM tbl_tmpjurnal
																						            WHERE accno='$total_mstf[accno]'
																									AND opby='$_SESSION[userid]'
																						
																		 ");	
																	  }else{
																	  
																		 echo $myDb->last_error;
																	  }	
															   }		   
														
														}							
														
															 unset($_SESSION['product']);				   
														//echo "Successfull record save...";
													 }else{
														echo $myDb->last_error;
													 }
										 $i++;
										 }			
														  
									 }
									 break;
									 
							  case "P":
									 $total_r=$myDb->select("SELECT*FROM tbl_tmpjurnal WHERE vouchertype='$vtypef[vouchertype]' 
																					   AND opby='$_SESSION[userid]' 
																					   AND vdate='".$_SESSION['vdate']."'");
									 $total_rf=$myDb->get_row($total_r,'MYSQL_ASSOC');
									 $trow=$myDb->row_count;
									 
									 
									 if($total_drcrf['total_dr']!=$total_drcrf['total_cr']){
										 echo "Debit and credit not same,you can not save data";
										 exit;
									 }else{
										 
										 $total_mst=$myDb->select("SELECT *FROM tbl_tmpjurnal
																	WHERE accno
																				IN (
																				
																						SELECT masteraccno
																						FROM tbl_tmpjurnal
																						WHERE opby='$_SESSION[userid]'
																						AND vdate='".$_SESSION['vdate']."'
																						AND vouchertype='$vtypef[vouchertype]'
																				)
																	AND opby='$_SESSION[userid]'
																	AND vdate='".$_SESSION['vdate']."'
																	AND vouchertype='$vtypef[vouchertype]'
																  ");
										 $total_mstrow=$myDb->row_count;								
										
										
										 $i=0;
										 while($total_mstf=$myDb->get_row($total_mst,'MYSQL_ASSOC')){
                                                  $vid=$myDb->select("SELECT ifnull(count(id),0) mvid FROM tbl_masterjournal 
												  					  WHERE vouchertype='$vtypef[vouchertype]'");
												  /*select("SELECT cast( ifnull( max( substr( voucherid, -2, 15 ) ) , 0 ) AS signed int ) mvid
																		  FROM tbl_masterjournal
																		  WHERE vouchertype='$vtypef[vouchertype]'");*/									                 
													 $vidf=$myDb->get_row($vid,'MYSQL_ASSOC');
													 $maxvid=$vidf['mvid']+1;
													 $mvidf="PV/-".$_SESSION['vdate']."-"."0".$maxvid;
													 $ins="INSERT INTO tbl_masterjournal(voucherid,voucherdate,vouchertype,preparedby,
																									  paytype,opby,opdate,storedstatus,accountno,voucherexpl,multi_single,
																									  voucher_group)
																					VALUES('$mvidf','$total_mstf[vdate]','$total_mstf[vouchertype]',
																						   '$_SESSION[userid]','$total_mstf[paytype]','$_SESSION[userid]',
																						   '$total_mstf[vdate]','I','$total_mstf[accno]',
																						   '$_POST[description]','$total_mstf[multi_single]',
																						   '$total_mstf[voucher_group]')
																	  ";
													 $ins2nd="INSERT INTO tbl_2ndjournal(accno,accname,amountdr,amountcr,voucherid,
																							vouchertype,paytype,vdate,masteraccno,
																							storedstatus,opby,parentid,groupname,multi_single,voucher_group)
																					VALUES('$total_mstf[accno]','$total_mstf[accname]','$total_mstf[amountdr]',
																						   '$total_mstf[amountcr]','$mvidf','$vtypef[vouchertype]','$total_mstf[paytype]',
																						   '$total_mstf[vdate]','$total_mstf[masteraccno]','I','$_SESSION[userid]',
																						   '$total_mstf[parentid]','$total_mstf[groupname]','$total_mstf[multi_single]',
																						   '$total_mstf[voucher_group]')";
													 $myDb->insert_sql($ins2nd);									   
																	  
													 if($myDb->insert_sql($ins)){
													 
														 
														 $total_cht=$myDb->select("SELECT *FROM tbl_tmpjurnal
																	WHERE masteraccno
																				IN (
																				
																						SELECT accno
																						FROM tbl_tmpjurnal
																						WHERE opby='$_SESSION[userid]'
																						AND vdate='".$_SESSION['vdate']."'
																						AND vouchertype='$vtypef[vouchertype]'
																				)
																	AND opby='$_SESSION[userid]'
																	AND vdate='".$_SESSION['vdate']."'
																	AND vouchertype='$vtypef[vouchertype]'
																  ");
														$total_chtrow=$myDb->row_count;											    
														while($total_chtf=$myDb->get_row($total_cht,'MYSQL_ASSOC')){
															  
															  $vid=$myDb->select("SELECT voucherid FROM tbl_masterjournal 
															                      WHERE accountno='$total_chtf[masteraccno]'
															                      AND voucherid='$mvidf'
																				  AND vouchertype='$vtypef[vouchertype]'");
															  while($vidf=$myDb->get_row($vid,'MYSQL_ASSOC')){
															  
																	  $ins2nd="INSERT INTO tbl_2ndjournal(accno,accname,amountdr,amountcr,voucherid,
																									vouchertype,paytype,vdate,masteraccno,
																									storedstatus,opby,parentid,groupname,multi_single,voucher_group)
																							VALUES('$total_chtf[accno]','$total_chtf[accname]','$total_chtf[amountdr]',
																								   '$total_chtf[amountcr]','$vidf[voucherid]',
																								   '$vtypef[vouchertype]','$total_chtf[paytype]',
																								   '$total_chtf[vdate]','$total_chtf[masteraccno]','I','$_SESSION[userid]',
																								   '$total_chtf[parentid]','$total_chtf[groupname]','$total_chtf[multi_single]',
																								   '$total_chtf[voucher_group]')";
														
																	  if($myDb->insert_sql($ins2nd)){
																		 $delcht=$myDb->update_sql("DELETE FROM tbl_tmpjurnal
																									WHERE accno='$total_chtf[accno]'
																									and masteraccno='$total_chtf[masteraccno]'
																									AND opby='$_SESSION[userid]'
																						
																		 ");
																		 
																		 $delmst=$myDb->update_sql("DELETE FROM tbl_tmpjurnal
																						            WHERE accno='$total_mstf[accno]'
																									AND opby='$_SESSION[userid]'
																						
																		 ");	
																	  }else{
																	  
																		 echo $myDb->last_error;
																	  }	
															   }		   
														
														}							
														 unset($_SESSION['product']);
																			   
														//echo "Successfull record save...";
													 }else{
														echo $myDb->last_error;
													 }
										 $i++;
										 }			
														  
									 }
									 break;
									 
							  case "J":
									 $total_r=$myDb->select("SELECT*FROM tbl_tmpjurnal WHERE vouchertype='$vtypef[vouchertype]' 
																					   AND opby='$_SESSION[userid]' 
																					   AND vdate='".$_SESSION['vdate']."'");
									 $total_rf=$myDb->get_row($total_r,'MYSQL_ASSOC');
									 $trow=$myDb->row_count;
									 
									 
									 if($total_drcrf['total_dr']!=$total_drcrf['total_cr']){
										 echo "Debit and credit not same,you can not save data";
										 exit;
									 }else{
										 
										 $total_mst=$myDb->select("SELECT *FROM tbl_tmpjurnal
																	WHERE accno
																				IN (
																				
																						SELECT masteraccno
																						FROM tbl_tmpjurnal
																						WHERE opby='$_SESSION[userid]'
																						AND vdate='".$_SESSION['vdate']."'
																						AND vouchertype='$vtypef[vouchertype]'
																				)
																	AND opby='$_SESSION[userid]'
																	AND vdate='".$_SESSION['vdate']."'
																	AND vouchertype='$vtypef[vouchertype]'
																  ");
										 $total_mstrow=$myDb->row_count;								
										
										
										 $i=0;
										 while($total_mstf=$myDb->get_row($total_mst,'MYSQL_ASSOC')){
                                                  $vid=$myDb->select("SELECT ifnull(count(id),0) mvid FROM tbl_masterjournal 
												  					  WHERE vouchertype='$vtypef[vouchertype]'");
												  /*select("SELECT cast( ifnull( max( substr( voucherid, -8, 15 ) ) , 0 ) AS signed int ) mvid
																		  FROM tbl_masterjournal
																		  WHERE vouchertype='$vtypef[vouchertype]'");	
												  */						  								                 
													 $vidf=$myDb->get_row($vid,'MYSQL_ASSOC');
													 $maxvid=$vidf['mvid']+1;
                                                     $mvidf="JV/-".$_SESSION['vdate']."-"."0".$maxvid;													 
                                                     $ins="INSERT INTO tbl_masterjournal(voucherid,voucherdate,vouchertype,preparedby,
																									  paytype,opby,opdate,storedstatus,accountno,voucherexpl,
																									  multi_single,voucher_group)
																					VALUES('$mvidf','$total_mstf[vdate]','$total_mstf[vouchertype]',
																						   '$_SESSION[userid]','$total_mstf[paytype]','$_SESSION[userid]',
																						   '$total_mstf[vdate]','I','$total_mstf[accno]',
																						   '$_POST[description]','$total_mstf[multi_single]','$total_mstf[voucher_group]')
																	  ";
													 $ins2nd="INSERT INTO tbl_2ndjournal(accno,accname,amountdr,amountcr,voucherid,
																							vouchertype,paytype,vdate,masteraccno,
																							storedstatus,opby,parentid,groupname,multi_single,voucher_group)
																					VALUES('$total_mstf[accno]','$total_mstf[accname]','$total_mstf[amountdr]',
																						   '$total_mstf[amountcr]','$mvidf','$vtypef[vouchertype]','$total_mstf[paytype]',
																						   '$total_mstf[vdate]','$total_mstf[masteraccno]','I','$_SESSION[userid]',
																						   '$total_mstf[parentid]','$total_mstf[groupname]','$total_mstf[multi_single]',
																						   '$total_mstf[voucher_group]')";
													 $myDb->insert_sql($ins2nd);									   
																	  
													 if($myDb->insert_sql($ins)){
													 
														 
														 $total_cht=$myDb->select("SELECT *FROM tbl_tmpjurnal
																	WHERE masteraccno
																				IN (
																				
																						SELECT accno
																						FROM tbl_tmpjurnal
																						WHERE opby='$_SESSION[userid]'
																						AND vdate='".$_SESSION['vdate']."'
																						AND vouchertype='$vtypef[vouchertype]'
																				)
																	AND opby='$_SESSION[userid]'
																	AND vdate='".$_SESSION['vdate']."'
																	AND vouchertype='$vtypef[vouchertype]'
																  ");
														$total_chtrow=$myDb->row_count;											    
														while($total_chtf=$myDb->get_row($total_cht,'MYSQL_ASSOC')){
															  
															  $vid=$myDb->select("SELECT voucherid FROM tbl_masterjournal 
															                      WHERE accountno='$total_chtf[masteraccno]'
															                      AND voucherid='$mvidf'
																				  AND vouchertype='$vtypef[vouchertype]'");
															  while($vidf=$myDb->get_row($vid,'MYSQL_ASSOC')){
															  
																	  $ins2nd="INSERT INTO tbl_2ndjournal(accno,accname,amountdr,amountcr,voucherid,
																									vouchertype,paytype,vdate,masteraccno,
																									storedstatus,opby,parentid,groupname,multi_single,voucher_group)
																							VALUES('$total_chtf[accno]','$total_chtf[accname]','$total_chtf[amountdr]',
																								   '$total_chtf[amountcr]','$vidf[voucherid]',
																								   '$vtypef[vouchertype]','$total_chtf[paytype]',
																								   '$total_chtf[vdate]','$total_chtf[masteraccno]','I','$_SESSION[userid]',
																								   '$total_chtf[parentid]','$total_chtf[groupname]','$total_chtf[multi_single]',
																								   '$total_chtf[voucher_group]')";
														
																	  if($myDb->insert_sql($ins2nd)){
																		 $delcht=$myDb->update_sql("DELETE FROM tbl_tmpjurnal
																									WHERE accno='$total_chtf[accno]'
																									and masteraccno='$total_chtf[masteraccno]'
																									AND opby='$_SESSION[userid]'
																						
																		 ");
																		 
																		 $delmst=$myDb->update_sql("DELETE FROM tbl_tmpjurnal
																						            WHERE accno='$total_mstf[accno]'
																									AND opby='$_SESSION[userid]'
																						
																		 ");	
																	  }else{
																	  
																		 echo $myDb->last_error;
																	  }	
															   }		   
														
														}							
														
														 unset($_SESSION['product']);
														//echo "Successfull record save...";
													 }else{
														echo $myDb->last_error;
													 }
										 $i++;
										 }			
														  
									 }
									 break;
									 
									 default:
									   echo "no record found";
						  }	
		          }		  
				  
			   unset($_SESSION['products']);		 
			  
			   unset($_SESSION['prod']);
										  

   }else{
     $msg="Sorry,you are not authorized to access this page";
	 header("Location:home.php?msg=$msg");
   }	 

}else{
  header("Location:login.php");
}
}  
?>
  
  
  
  
