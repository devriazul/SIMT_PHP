<?php ob_start();
session_start();
include("../config.php"); 
if($myDb->connectDefaultServer())
{ 
  if($_SESSION['userid']){
  $chka="SELECT*FROM  tbl_accdtl WHERE flname='add_jurnal.php' AND userid='$_SESSION[userid]'";
  $caq=$myDb->select($chka);
  $car=$myDb->get_row($caq,'MYSQL_ASSOC');
  if($car['ins']=="y"){
               
				
				
				$total_drcr=$myDb->select("SELECT SUM(amountdr) total_dr,SUM(amountcr) total_cr
				                           FROM tbl_tmpjurnal
										   WHERE opby='$_SESSION[userid]'
										   AND vdate='".date("Y-m-d")."'
										 ");
				$total_drcrf=$myDb->get_row($total_drcr,'MYSQL_ASSOC');	
				
				
				$vtype=$myDb->select("SELECT vouchertype FROM tbl_tmpjurnal WHERE opby='$_SESSION[userid]' AND vdate='".date("Y-m-d")."'")
				while($vtypef=$myDb->get_row($vtype,'MYSQL_ASSOC')){					   


						   switch($vtypef['vouchertype']){
							  case "R":
									 $total_r=$myDb->select("SELECT*FROM tbl_tmpjurnal WHERE vouchertype='R' 
																					   AND opby='$_SESSION[userid]' 
																					   AND vdate='".date("Y-m-d")."'");
									 $total_rf=$myDb->get_row($total_r,'MYSQL_ASSOC');
									 $trow=$myDb->row_count;
									 
									 
									 
									 
									 $vid=$myDb->select("SELECT ifnull(max(id),0) mvid FROM tbl_masterjournal WHERE vouchertype='R'");
									 $vidf=$myDb->get_row($vid,'MYSQL_ASSOC');
									 if($total_drcrf['total_dr']!=$total_drcrf['total_cr']){
										 echo "Debit and credit not same,you can not save data";
									 }else{
										 
										 $total_mst=$myDb->select("SELECT *FROM tbl_tmpjurnal
																	WHERE accno
																				IN (
																				
																						SELECT masteraccno
																						FROM tbl_tmpjurnal
																						WHERE opby='$_SESSION[userid]'
																						AND vdate='".date("Y-m-d")."'
																						AND vouchertype='R'
																				)
																	AND opby='$_SESSION[userid]'
																	AND vdate='".date("Y-m-d")."'
																	AND vouchertype='R'
																  ");
										 $total_mstrow=$myDb->row_count;								
										
										
										 $i=0;
										 while($total_mstf=$myDb->get_row($total_mst,'MYSQL_ASSOC')){
													 $maxvid=$vidf['mvid']+$i+1;
													 $mvidf="VT/R-"."000".$maxvid;
													 $ins="INSERT INTO tbl_masterjournal(voucherid,voucherdate,vouchertype,preparedby,
																									  paytype,opby,opdate,storedstatus,accountno)
																					VALUES('$mvidf','$total_mstf[vdate]','$total_mstf[vouchertype]',
																						   '$_SESSION[userid]','$total_mstf[paytype]','$_SESSION[userid]',
																						   '$total_mstf[vdate]','I','$total_mstf[accno]')
																	  ";
													 $ins2nd="INSERT INTO tbl_2ndjournal(accno,accname,amountdr,amountcr,voucherid,
																							vouchertype,paytype,vdate,masteraccno,
																							storedstatus,opby)
																					VALUES('$total_mstf[accno]','$total_mstf[accname]','$total_mstf[amountdr]',
																						   '$total_mstf[amountcr]','$mvidf','R','$total_mstf[paytype]',
																						   '$total_mstf[vdate]','$total_mstf[masteraccno]','I','$_SESSION[userid]')";
													 $myDb->insert_sql($ins2nd);									   
																	  
													 if($myDb->insert_sql($ins)){
													 
														 
														 $total_cht=$myDb->select("SELECT *FROM tbl_tmpjurnal
																	WHERE masteraccno
																				IN (
																				
																						SELECT accno
																						FROM tbl_tmpjurnal
																						WHERE opby='$_SESSION[userid]'
																						AND vdate='".date("Y-m-d")."'
																						AND vouchertype='$_SESSION[vouchertype]'
																				)
																	AND opby='$_SESSION[userid]'
																	AND vdate='".date("Y-m-d")."'
																	AND vouchertype='$_SESSION[vouchertype]'
																  ");
														$total_chtrow=$myDb->row_count;											    
														while($total_chtf=$myDb->get_row($total_cht,'MYSQL_ASSOC')){
															  
															  $vid=$myDb->select("SELECT voucherid FROM tbl_masterjournal WHERE accountno IN('$total_chtf[masteraccno]')");
															  while($vidf=$myDb->get_row($vid,'MYSQL_ASSOC')){
															  
																	  $ins2nd="INSERT INTO tbl_2ndjournal(accno,accname,amountdr,amountcr,voucherid,
																									vouchertype,paytype,vdate,masteraccno,
																									storedstatus,opby)
																							VALUES('$total_chtf[accno]','$total_chtf[accname]','$total_chtf[amountdr]',
																								   '$total_chtf[amountcr]','$vidf[voucherid]',
																								   '$_SESSION[vouchertype]','$total_chtf[paytype]',
																								   '$total_chtf[vdate]','$total_chtf[masteraccno]','I','$_SESSION[userid]')";
														
																	  if($myDb->insert_sql($ins2nd)){
																		 echo "done";
																		 
																		 $delcht=$myDb->update_sql("DELETE FROM tbl_tmpjurnal
																									WHERE accno='$total_chtf[accno]'
																						
																		 ");
																		 
																		 $delmst=$myDb->update_sql("DELETE FROM tbl_tmpjurnal
																						   WHERE accno='$total_mstf[accno]'
																						
																		 ");	
																	  }else{
																	  
																		 echo $myDb->last_error;
																	  }	
															   }		   
														
														}							
														
																			   
														echo "Successfull record save...";
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

   }else{
     $msg="Sorry,you are not authorized to access this page";
	 header("Location:home.php?msg=$msg");
   }	 

}else{
  header("Location:login.php");
}
}  
?>
  
  
  
  
