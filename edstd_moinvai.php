<?php ob_start();
session_start();
require_once('dbClass.php');
include("config.php"); 
if($myDb->connect($host,$user,$pwd,$db,true))
{ 
  if($_SESSION['userid']){
          mysql_query("SET FOREIGN_KEY_CHECKS=0") or die(mysql_error());
		  $chka="SELECT*FROM  tbl_accdtl WHERE flname='manage_student.php' AND userid='$_SESSION[userid]'";
		  $caq=$myDb->select($chka);
		  $car=$myDb->get_row($caq,'MYSQL_ASSOC');
	    if(($car['ins']=="y")||($_SESSION['userid']=="administrator")){
  
			  $id=mysql_real_escape_string($_GET['id']);
			  $ed="SELECT*FROM tbl_stdinfo WHERE id='$id'";
			  $edq=$myDb->select($ed);
			  $esr=$myDb->get_row($edq,'MYSQL_ASSOC');
			
			  if($_SERVER['REQUEST_METHOD']=="POST"){ 
			          $stdf=mysql_real_escape_string(strtoupper($_POST['exstid']));
					  $password=mysql_real_escape_string($_POST['password']);
					  $sexstatus=mysql_real_escape_string($_POST['sexstatus']);
					  $stdname=mysql_real_escape_string(strtoupper($_POST['stdname']));
					  $dob=mysql_real_escape_string($_POST['dob']);
					  $session=mysql_real_escape_string($_POST['session']);
					  $bgroup=mysql_real_escape_string($_POST['bgroup']);
					  $deptname=mysql_real_escape_string($_POST['deptname']);
					  $batch=mysql_real_escape_string($_POST['batch']);
					  $semester=mysql_real_escape_string($_POST['semester']);
					  $section=mysql_real_escape_string($_POST['section']);
					  $horde=mysql_real_escape_string($_POST['horde']);
					  
					  $fname=mysql_real_escape_string($_POST['fname']);
					  $hostel=mysql_real_escape_string($_POST['hostel']);
					  $mname=mysql_real_escape_string($_POST['mname']);
					  $gname=mysql_real_escape_string($_POST['gname']);
					  $nationality=mysql_real_escape_string($_POST['nationality']);
					  $praddress=mysql_real_escape_string($_POST['praddress']);
					  $peraddress=mysql_real_escape_string($_POST['peraddress']);
					  $religion=mysql_real_escape_string($_POST['religion']);
					  $phone=mysql_real_escape_string($_POST['phone']);
					  $boardregno=mysql_real_escape_string($_POST['boardregno']);
					  $boardrollno=mysql_real_escape_string($_POST['boardrollno']);
					  $stdcursemester=mysql_real_escape_string($_POST['stdcursemester']);
					  $stdstatus=mysql_real_escape_string($_POST['stdstatus']);
					  $remarks=mysql_real_escape_string($_POST['remarks']);
					  $treason=mysql_real_escape_string($_POST['treason']);
					  
					  
					 $hq="SELECT id,code,name FROM tbl_hostel WHERE code='$hostel' order by id desc";
								  $hr=$myDb->select($hq);
								  $hrid=$myDb->get_row($hr,'MYSQL_ASSOC');  
				
			  		 $hostelid=$hrid['id'];		
					 if($stdstatus=="D" || $stdstatus=="F" || $stdstatus=="RF"){ //echo "1st"; exit;
					 			  // if student status D or F than fire here
									 copy($_FILES[img][tmp_name],"uploads/".$esr['img']);			 
									 if(!$_FILES[img][tmp_name]){
									    // if student has image programe process will be fire here
									
										 $ins_login=$myDb->select("SELECT*,(SELECT stdid FROM tbl_stdinfo WHERE id='$id') stdid,
																  (SELECT password FROM tbl_stdinfo WHERE id='$id') password FROM tbl_login 
																		  WHERE userid=(SELECT stdid FROM tbl_stdinfo WHERE id='$id')");
										 $inslog=$myDb->get_row($ins_login,'MYSQL_ASSOC');
										 
										 if($inslog['userid']==""){
											$stv=$myDb->select("SELECT stdid,password FROM tbl_stdinfo WHERE id='$id'");
											$stvf=$myDb->get_row($stv,'MYSQL_ASSOC');
										 
											$ilog="INSERT INTO tbl_login(userid,password,accid,storedstatus)
																  VALUES('$stvf[stdid]','".md5($password)."',38,'I')";
											$uing=$myDb->insert_sql($ilog);
													
										 }else{
											$iupd="UPDATE tbl_login SET password='".md5($password)."'
															   WHERE userid='$inslog[userid]'";
											$ulog=$myDb->update_sql($iupd);
										 }					    
									 
										 $ins="UPDATE tbl_stdinfo SET stdid='$stdf',stdname='$stdname',password='$password',sexstatus='$sexstatus',dob='$dob',
																			   session='$session',bgroup='$bgroup',fname='$fname',
																			   deptname='$deptname',batch='$batch',semester='$semester',section='$section',
																			   horde='$horde',
																			   hostel='$hostel',hostelid='$hostelid',mname='$mname',gname='$gname',nationality='$nationality',
																			   praddress='$praddress',peraddress='$peraddress',
																			   religion='$religion',phone='$phone',opby='$_SESSION[userid]',
																			   opdate='".date("Y-m-d")."',storedstatus='U',
																			   boardregno='$boardregno', boardrollno='$boardrollno',stdcursemester='$stdcursemester',
																			   stdstatus='$stdstatus',remarks='$remarks',stdtyperemarks='$treason'
																			    WHERE id='$id'";						 
													if($myDb->update_sql($ins)){
													  
														
			
													
													}else{
													
													   $msg=$myDb->last_error;//"Student information updated successfully";
													   header("Location:manage_student.php?msg=$msg&id=$id");
													} 	
													
                                                                                                            $dn=$myDb->select("select*from tbl_department where id='$deptname'");
													    $dnf=$myDb->get_row($dn,'MYSQL_ASSOC');
														$stdac=$myDb->select("SELECT*FROM tbl_accchart where parentid in
																   (select id from tbl_accchart where parentid=7) 
																   and dname='$dnf[name]' and session='$session'");
														$stdacf=$myDb->get_row($stdac,'MYSQL_ASSOC');
														if($stdacf['id']!=""){
																   $accname=$stdf." ".$stdname;
																   
																   $chkac=$myDb->select("select*from tbl_accchart where stdid='$id'");
																   $chkacf=$myDb->get_row($chkac,'MYSQL_ASSOC');
																   if($chkacf['id']!=""){
																	   $myDb->update_sql("UPDATE tbl_accchart SET accname='$accname',
																							   parentid='$stdacf[id]',
																							   groupname=6,
																							   type='Trading Account',
																							   orderby=1,
																							   opby='$_SESSION[userid]',
																							   opdate='".date("Y-m-d")."',
																							   storedstatus='U',
																							   session='$session',
																							   dname='$dnf[name]'
																						   WHERE stdid='$id'");
																   
																   }else{
																	   $accin="INSERT INTO tbl_accchart(accname,parentid,groupname,
																	   type,orderby,opby,opdate,storedstatus,session,dname)
																			   VALUES('$accname','$stdacf[id]',6,'Trading Account',
																			   1,'$_SESSION[userid]','".date("Y-m-d")."','I','$session','$dnf[name]')";
																	   $ai=$myDb->insert_sql($accin);
																   }
																										   
			
														}		//exit;								
													$msg="Student information updated successfully";
													header("Location:manage_student.php?msg=$msg&id=$id");
			  
									}else{
									// if student has image programe process will be fire here
									
									
										 $ins_login=$myDb->select("SELECT*,(SELECT stdid FROM tbl_stdinfo WHERE id='$id') stdid,
																		(SELECT password FROM tbl_stdinfo WHERE id='$id') password FROM tbl_login 
																			WHERE userid=(SELECT stdid FROM tbl_stdinfo WHERE id='$id')");
										 $inslog=$myDb->get_row($ins_login,'MYSQL_ASSOC');
										 
										 if($inslog['userid']==""){
											$stv=$myDb->select("SELECT stdid,password FROM tbl_stdinfo WHERE id='$id'");
											$stvf=$myDb->get_row($stv,'MYSQL_ASSOC');
										 
											$ilog="INSERT INTO tbl_login(userid,password,accid,storedstatus)
																  VALUES('$stvf[stdid]','".md5($password)."',38,'I')";
											$uing=$myDb->insert_sql($ilog);
													
										 }else{
											$iupd="UPDATE tbl_login SET password='".md5($password)."'
															   WHERE userid='$inslog[userid]'";
											$ulog=$myDb->update_sql($iupd);
										 }				    
									
										 $ins="UPDATE tbl_stdinfo SET stdid='$stdf',stdname='$stdname',password='$password',sexstatus='$sexstatus',
																	  dob='$dob',session='$session',bgroup='$bgroup',
																	  fname='$fname',deptname='$deptname',batch='$batch',semester='$semester', section='$section',
																			   horde='$horde',hostel='$hostel',mname='$mname',gname='$gname',
																	  nationality='$nationality',praddress='$praddress',peraddress='$peraddress',
																	  religion='$religion',phone='$phone',opby='$_SESSION[userid]',
																	  opdate='".date("Y-m-d")."',storedstatus='U',
																	  boardregno='$boardregno', boardrollno='$boardrollno',
																	  img='$esr[img]',stdcursemester='$stdcursemester',
																	  stdstatus='$stdstatus',remarks='$remarks',stdtyperemarks='$treason'
																	   WHERE id='$id'";						 
													$sin=$myDb->update_sql($ins);
													
													//student chart of account entry//
														$dn=$myDb->select("select*from tbl_department where id='$deptname'");
													   $dnf=$myDb->get_row($dn,'MYSQL_ASSOC');
														$stdac=$myDb->select("SELECT*FROM tbl_accchart where parentid in
																   (select id from tbl_accchart where parentid=7) 
																   and dname='$dnf[name]' and session='$session'");
														$stdacf=$myDb->get_row($stdac,'MYSQL_ASSOC');
														if($stdacf['id']!=""){
																   $accname=$stdf." ".$stdname;
																   $chkac=$myDb->select("select*from tbl_accchart where stdid='$id'");
																   $chkacf=$myDb->get_row($chkac,'MYSQL_ASSOC');
																   if($chkacf['id']!=""){
																	   $myDb->update_sql("UPDATE tbl_accchart SET accname='$accname',
																							   parentid='$stdacf[id]',
																							   groupname=6,
																							   type='Trading Account',
																							   orderby=1,
																							   opby='$_SESSION[userid]',
																							   opdate='".date("Y-m-d")."',
																							   storedstatus='U',
																							   session='$session',
																							   dname='$dnf[name]'
																						   WHERE stdid='$id'");
																   
																   }else{
																	   $accin="INSERT INTO tbl_accchart(accname,parentid,groupname,
																	   type,orderby,opby,opdate,storedstatus,session,dname)
																			   VALUES('$accname','$stdacf[id]',6,'Trading Account',
																			   1,'$_SESSION[userid]','".date("Y-m-d")."','I','$session','$dnf[name]')";
																	   $ai=$myDb->insert_sql($accin);
																   }
													   }		   							 			
													$msg="Student information updated successfully";
													header("Location:manage_student.php?msg=$msg&id=$id");
									}
						
					}else{ //echo "2nd"; 
					 // if student status not D or F than fire here
									 //copy($_FILES[img][tmp_name],"uploads/".$esr['img']);			 
									 if(!$_FILES[img][tmp_name]){ //echo "2nd---if"; exit;
									 // if student has no image programe process will be fire here
									
										 $ins_login=$myDb->select("SELECT*,(SELECT stdid FROM tbl_stdinfo WHERE id='$id') stdid,
																  (SELECT password FROM tbl_stdinfo WHERE id='$id') password FROM tbl_login 
																		  WHERE userid=(SELECT stdid FROM tbl_stdinfo WHERE id='$id')");
										 $inslog=$myDb->get_row($ins_login,'MYSQL_ASSOC');
										 
										 if($inslog['userid']==""){
											$stv=$myDb->select("SELECT stdid,password FROM tbl_stdinfo WHERE id='$id'");
											$stvf=$myDb->get_row($stv,'MYSQL_ASSOC');
										 
											$ilog="INSERT INTO tbl_login(userid,password,accid,storedstatus)
																  VALUES('$stvf[stdid]','".md5($password)."',38,'I')";
											$uing=$myDb->insert_sql($ilog);
													
										 }else{
											$iupd="UPDATE tbl_login SET password='".md5($password)."'
															   WHERE userid='$inslog[userid]'";
											$ulog=$myDb->update_sql($iupd);
										 }					    
									 
										 $ins="UPDATE tbl_stdinfo SET stdid='$stdf',stdname='$stdname',password='$password',sexstatus='$sexstatus',dob='$dob',
																			   session='$session',bgroup='$bgroup',fname='$fname',
																			   deptname='$deptname',batch='$batch',semester='$semester', section='$section',
																			   horde='$horde',
																			   hostel='$hostel',hostelid='$hostelid',mname='$mname',gname='$gname',nationality='$nationality',
																			   praddress='$praddress',peraddress='$peraddress',
																			   religion='$religion',phone='$phone',opby='$_SESSION[userid]',
																			   opdate='".date("Y-m-d")."',storedstatus='U',
																			   boardregno='$boardregno', boardrollno='$boardrollno',stdcursemester='$stdcursemester',
																			   stdstatus='$stdstatus',stdtyperemarks='$treason'
																			    WHERE id='$id'";						 
													if($myDb->update_sql($ins)){
													  
														
			
													
													}else{
													
													   $msg=$myDb->last_error;//"Student information updated successfully";
													   header("Location:manage_student.php?msg=$msg&id=$id");
													} 	
													
													$dn=$myDb->select("select*from tbl_department where id='$deptname'");
													   $dnf=$myDb->get_row($dn,'MYSQL_ASSOC');
														$stdac=$myDb->select("SELECT*FROM tbl_accchart where parentid in
																   (select id from tbl_accchart where parentid=7) 
																   and dname='$dnf[name]' and session='$session'");
														$stdacf=$myDb->get_row($stdac,'MYSQL_ASSOC');
														if($stdacf['id']!=""){
																   $accname=$stdf." ".$stdname;
																   
																   $chkac=$myDb->select("select*from tbl_accchart where stdid='$id'");
																   $chkacf=$myDb->get_row($chkac,'MYSQL_ASSOC');
																   if($chkacf['id']!=""){
																	   $myDb->update_sql("UPDATE tbl_accchart SET accname='$accname',
																							   parentid='$stdacf[id]',
																							   groupname=6,
																							   type='Trading Account',
																							   orderby=1,
																							   opby='$_SESSION[userid]',
																							   opdate='".date("Y-m-d")."',
																							   storedstatus='U',
																							   session='$session',
																							   dname='$dnf[name]'
																						   WHERE stdid='$id'");
																   
																   }else{
																	   $accin="INSERT INTO tbl_accchart(accname,parentid,groupname,type,
																	   orderby,opby,opdate,storedstatus,session,dname)
																			   VALUES('$accname','$stdacf[id]',6,'Trading Account',
																			   1,'$_SESSION[userid]','".date("Y-m-d")."','I','$session','$dnf[name]')";
																	   $ai=$myDb->insert_sql($accin);
																   }
																										   
			
														}		//exit;								
													$msg="Student information updated successfully";
													header("Location:manage_student.php?msg=$msg&id=$id");
			  
									}else{
									//echo "2nd---if-----"; exit;
									     // if student has image programe process will be fire here
									
										 $ins_login=$myDb->select("SELECT*,(SELECT stdid FROM tbl_stdinfo WHERE id='$id') stdid,
																		(SELECT password FROM tbl_stdinfo WHERE id='$id') password FROM tbl_login 
																			WHERE userid=(SELECT stdid FROM tbl_stdinfo WHERE id='$id')");
										 $inslog=$myDb->get_row($ins_login,'MYSQL_ASSOC');
										 
										 if($inslog['userid']==""){
											$stv=$myDb->select("SELECT stdid,password FROM tbl_stdinfo WHERE id='$id'");
											$stvf=$myDb->get_row($stv,'MYSQL_ASSOC');
										 
											$ilog="INSERT INTO tbl_login(userid,password,accid,storedstatus)
																  VALUES('$stvf[stdid]','".md5($password)."',38,'I')";
											$uing=$myDb->insert_sql($ilog);
													
										 }else{
											$iupd="UPDATE tbl_login SET password='".md5($password)."'
															   WHERE userid='$inslog[userid]'";
											$ulog=$myDb->update_sql($iupd);
										 }				    
									     copy($_FILES[img][tmp_name],"uploads/".$esr['img']);	
										 $ins="UPDATE tbl_stdinfo SET stdid='$stdf',stdname='$stdname',password='$password',sexstatus='$sexstatus',
																	  dob='$dob',session='$session',bgroup='$bgroup',
																	  fname='$fname',deptname='$deptname',batch='$batch',semester='$semester', section='$section',
																			   horde='$horde',hostel='$hostel',mname='$mname',gname='$gname',
																	  nationality='$nationality',praddress='$praddress',peraddress='$peraddress',
																	  religion='$religion',phone='$phone',opby='$_SESSION[userid]',
																	  opdate='".date("Y-m-d")."',storedstatus='U',
																	  boardregno='$boardregno', boardrollno='$boardrollno',
																	  img='$esr[img]',stdcursemester='$stdcursemester', 
																	  stdstatus='$stdstatus',stdtyperemarks='$treason'
																	  WHERE id='$id'";						 
													$sin=$myDb->update_sql($ins);
													
													//student chart of account entry//
														$dn=$myDb->select("select*from tbl_department where id='$deptname'");
													    $dnf=$myDb->get_row($dn,'MYSQL_ASSOC');
														$stdac=$myDb->select("SELECT*FROM tbl_accchart where parentid in
																   (select id from tbl_accchart where parentid=7) 
																   and dname='$dnf[name]' and session='$session'");
														$stdacf=$myDb->get_row($stdac,'MYSQL_ASSOC');
														if($stdacf['id']!=""){
																   $accname=$stdf." ".$stdname;
																   $chkac=$myDb->select("select*from tbl_accchart where stdid='$id'");
																   $chkacf=$myDb->get_row($chkac,'MYSQL_ASSOC');
																   if($chkacf['id']!=""){
																	   $myDb->update_sql("UPDATE tbl_accchart SET accname='$accname',
																							   parentid='$stdacf[id]',
																							   groupname=6,
																							   type='Trading Account',
																							   orderby=1,
																							   opby='$_SESSION[userid]',
																							   opdate='".date("Y-m-d")."',
																							   storedstatus='U',
																							   session='$session',
																							   dname='$dnf[name]'
																						   WHERE stdid='$id'");
																   
																   }else{
																	   $accin="INSERT INTO tbl_accchart(accname,parentid,groupname,
																	   type,orderby,opby,opdate,storedstatus,session,dname)
																			   VALUES('$accname','$stdacf[id]',6,'Trading Account',
																			   1,'$_SESSION[userid]','".date("Y-m-d")."','I','$session','$dnf[name]')";
																	   $ai=$myDb->insert_sql($accin);
																   }
													   }		   							 			
													$msg="Student information updated successfully";
													header("Location:manage_student.php?msg=$msg&id=$id");
									}
					
					} //stdstatu checking end here					
				}
				
		

   }else{
     $msg="Sorry,you are not authorized to access this page";
	 header("Location:home.php?msg=$msg");
   }	 

}else{
  header("Location:index.php");
}
}