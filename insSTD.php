<?php ob_start();
session_start();
require_once('dbClass.php');
include("config.php"); 
if($myDb->connect($host,$user,$pwd,$db,true))
{ 
  if($_SESSION['userid']){
  $chka="SELECT*FROM  tbl_accdtl WHERE flname='manage_student.php' AND userid='$_SESSION[userid]'";
  $caq=$myDb->select($chka);
  $car=$myDb->get_row($caq,'MYSQL_ASSOC');
  if(($car['ins']=="y")||($_SESSION['userid']=="administrator")){

  if($_SERVER['REQUEST_METHOD']=="POST"){ 
  if($_POST['exstid']==""){
			  $password=mysql_real_escape_string($_POST['password']);
			  $sexstatus=mysql_real_escape_string($_POST['sexstatus']);
			  /*$d=mysql_real_escape_string($_POST['d']);
			  $m=mysql_real_escape_string($_POST['m']);
			  $y=mysql_real_escape_string($_POST['y']);
			  */
			  $exstid=mysql_real_escape_string(strtoupper($_POST['exstid']));
                          $_SESSION['exstid'] = $exstid;
			  $stdname=ucwords(mysql_real_escape_string($_POST['stdname']));
			  //$dob=mysql_real_escape_string($_POST['dob']);
			  $dy=mysql_real_escape_string($_POST['dy']);
			  $mn=mysql_real_escape_string($_POST['mn']);
			  $yr=mysql_real_escape_string($_POST['yr']);
			  $dob=$yr."-".$mn."-".$dy;
			  $session=mysql_real_escape_string($_POST['session']);
			  $bgroup=mysql_real_escape_string($_POST['bgroup']);
			  $deptname=mysql_real_escape_string($_POST['deptname']);
			  $section=mysql_real_escape_string($_POST['section']);
			  
			  $dps="SELECT*FROM tbl_department WHERE id='$deptname'";
			  $dpq=$myDb->select($dps);
			  $dpr=$myDb->get_row($dpq,'MYSQL_ASSOC');
			  $deptn=$dpr['code'];
			  
			  $fname=ucwords(mysql_real_escape_string($_POST['fname']));
			  $hostel=mysql_real_escape_string($_POST['hostel']);
			  $boardregno=mysql_real_escape_string($_POST['boardregno']);
			  $boardrollno=mysql_real_escape_string($_POST['boardrollno']);
			  $hq="SELECT id,code,name FROM tbl_hostel WHERE code='$hostel' order by id desc";
								  $hr=$myDb->select($hq);
								  $hrid=$myDb->get_row($hr,'MYSQL_ASSOC');  
				
			  $hostelid=$hrid['id'];					  
			  $mname=ucwords(mysql_real_escape_string($_POST['mname']));
			  $gname=ucwords(mysql_real_escape_string($_POST['gname']));
			  $nationality=mysql_real_escape_string($_POST['nationality']);
			  $praddress=mysql_real_escape_string($_POST['praddress']);
			  $peraddress=mysql_real_escape_string($_POST['peraddress']);
			  $religion=mysql_real_escape_string($_POST['religion']);
			  $phone=mysql_real_escape_string($_POST['phone']);
			  $batch=mysql_real_escape_string($_POST['batch']);
			  $seat=mysql_real_escape_string($_POST['seat']);
			  $semester=mysql_real_escape_string($_POST['semester']);
			  $horde=mysql_real_escape_string($_POST['horde']);
			  $ffighter=mysql_real_escape_string($_POST['ffighter']);
			  
			  $mid=mysql_query("select max(id) from tbl_stdinfo") or die(mysql_error());
			  $mfetch=mysql_fetch_array($mid);
			  $maxid=$mfetch["max(id)"];
			  $maxid=$maxid+1;
			  $a=$maxid.".jpg";
			
			  if($hostel!=""){
				 $mx="SELECT cast( ifnull( max( substr( stdid, 10, 3 ) ) , 0 ) AS signed int ) mid 
				      FROM tbl_stdinfo WHERE hostel!='' AND session='$session' AND deptname='$deptname'";
				 $mr=$myDb->select($mx);
				 $mrw=$myDb->get_row($mr,'MYSQL_ASSOC');
				 $std=substr($hostel,0,2);
				 $dp=substr($deptn,0,3);
				 
				 $ses=$session;
				 //$stdf=$std.$dp.$ses."000".$mrw['mid'];
				 
				 if($mrw['mid']=="0"){
					$len="select length(cast( ifnull( max( substr( stdid, 10, 3 ) ) , 0 ) AS signed int )) len from tbl_stdinfo 
					      WHERE hostel!='' AND session='$session' AND deptname='$deptname'";
					$ql=$myDb->select($len);
					$lrw=$myDb->get_row($ql,'MYSQL_ASSOC');
				 
					switch($lrw['len']){
					  case 1:
						 //$stdf=$std.$dp.$ses."00".$mrw['mid']+1;
						 $mxid=$mrw['mid']+1;
						 $stdf=$std.$dp.$ses."00".$mxid;
                                                 $_SESSION['stdf'] = $stdf;
							if($_FILES[img][tmp_name]==""){
			
			
								$ins="INSERT INTO tbl_stdinfo(stdid,stdname,password,sexstatus,dob,session,bgroup,deptname,
							                                  fname,hostel,hostelid,seat,mname,gname,nationality,praddress,peraddress,
							                                  religion,phone,opby,opdate,storedstatus,batch,semester,section, horde,ffighter,stdcursemester,stdstatus)
							          VALUES('$stdf','$stdname','$password','$sexstatus','$dob','$session','$bgroup','$deptname',
								             '$fname','$hostel','$hostelid','$seat','$mname','$gname','$nationality','$praddress',
											 '$peraddress','$religion','$phone','$_SESSION[userid]','".date("Y-m-d")."','I','$batch','$semester','$section','$horde','$ffighter','$semester','R')";						 
								$sin=$myDb->insert_sql($ins);
                                                                
                                                                $ins_login=$myDb->select("SELECT*,(SELECT stdid FROM tbl_stdinfo WHERE stdid='$_SESSION[stdf]') stdid,
																  (SELECT password FROM tbl_stdinfo WHERE stdid='$_SESSION[stdf]') password FROM tbl_login 
																		  WHERE userid=(SELECT stdid FROM tbl_stdinfo WHERE stdid='$_SESSION[stdf]')");
                                                                $inslog=$myDb->get_row($ins_login,'MYSQL_ASSOC');

                                                                if($inslog['userid']==""){
                                                                       $stv=$myDb->select("SELECT stdid,password FROM tbl_stdinfo WHERE stdid='$_SESSION[stdf]'");
                                                                       $stvf=$myDb->get_row($stv,'MYSQL_ASSOC');

                                                                       $ilog="INSERT INTO tbl_login(userid,password,accid,storedstatus)
                                                                                                                 VALUES('$stvf[stdid]','".md5($password)."',38,'I')";
                                                                       $uing=$myDb->insert_sql($ilog);

                                                                }	
								

                                                                $dn=$myDb->select("select*from tbl_department where id='$deptname'");
                                                                $dnf=$myDb->get_row($dn,'MYSQL_ASSOC');
								$stdac=$myDb->select("SELECT*FROM tbl_accchart where parentid in(select id from tbl_accchart where parentid=7) and dname='$dnf[name]' and session='$session'");
								$stdacf=$myDb->get_row($stdac,'MYSQL_ASSOC');
								if($stdacf['id']!=""){
										   $accname=$stdf." ".$stdname;
										   $accin="INSERT INTO tbl_accchart(accname,parentid,groupname,type,orderby,opby,opdate,storedstatus,session,dname)
												   VALUES('$accname','$stdacf[id]',6,'Trading Account',1,'$_SESSION[userid]','".date("Y-m-d")."','I','$session','$dnf[name]')";
										   $ai=$myDb->insert_sql($accin);
								}		   
								
								$msg="Insert educational qualification please";
								header("Location:add_edq.php?msg=$msg");
							 }else{	
								copy($_FILES[img][tmp_name],"uploads/".$a);			 
								$ins="INSERT INTO tbl_stdinfo(stdid,stdname,password,sexstatus,dob,session,bgroup,deptname,
								      fname,hostel,hostelid,seat,mname,gname,nationality,praddress,peraddress,
								      religion,phone,img,opby,opdate,storedstatus,batch,semester,section,horde,ffighter,stdcursemester,stdstatus)
							          VALUES('$stdf','$stdname','$password','$sexstatus','$dob','$session','$bgroup','$deptname','$fname',
								             '$hostel','$hostelid','$seat','$mname','$gname',
											 '$nationality','$praddress',
											 '$peraddress','$religion',
											 '$phone','$a','$_SESSION[userid]','".date("Y-m-d")."','I',
											 '$batch','$semester','$section','$horde','$ffighter','$semester','R')";						 
								$sin=$myDb->insert_sql($ins);
                                                                
                                                                $ins_login=$myDb->select("SELECT*,(SELECT stdid FROM tbl_stdinfo WHERE stdid='$_SESSION[stdf]') stdid,
																  (SELECT password FROM tbl_stdinfo WHERE stdid='$_SESSION[stdf]') password FROM tbl_login 
																		  WHERE userid=(SELECT stdid FROM tbl_stdinfo WHERE stdid='$_SESSION[stdf]')");
                                                                $inslog=$myDb->get_row($ins_login,'MYSQL_ASSOC');

                                                                if($inslog['userid']==""){
                                                                       $stv=$myDb->select("SELECT stdid,password FROM tbl_stdinfo WHERE stdid='$_SESSION[stdf]'");
                                                                       $stvf=$myDb->get_row($stv,'MYSQL_ASSOC');

                                                                       $ilog="INSERT INTO tbl_login(userid,password,accid,storedstatus)
                                                                                                                 VALUES('$stvf[stdid]','".md5($password)."',38,'I')";
                                                                       $uing=$myDb->insert_sql($ilog);

                                                                }


										   $dn=$myDb->select("select*from tbl_department where id='$deptname'");
										   $dnf=$myDb->get_row($dn,'MYSQL_ASSOC');
								$stdac=$myDb->select("SELECT*FROM tbl_accchart where parentid in(select id from tbl_accchart where parentid=7) and dname='$dnf[name]' and session='$session'");
								$stdacf=$myDb->get_row($stdac,'MYSQL_ASSOC');
								if($stdacf['id']!=""){
										   $accname=$stdf." ".$stdname;
										   $accin="INSERT INTO tbl_accchart(accname,parentid,groupname,type,orderby,opby,opdate,storedstatus,session,dname)
												   VALUES('$accname','$stdacf[id]',6,'Trading Account',1,'$_SESSION[userid]','".date("Y-m-d")."','I','$session','$dnf[name]')";
										   $ai=$myDb->insert_sql($accin);
								}		   
								
								
								$msg="Insert educational qualification please";
								header("Location:add_edq.php?msg=$msg");
							 }	
			
						 break;
					  case 2:
						 $stdf=$std.$dp.$ses."0".$mrw['mid']+1;
                                                 $_SESSION['stdf'] = $stdf;
						 break;
					  default:
						 $stdf=$std.$dp.$ses.$mrw['mid']+1;
                                                 $_SESSION['stdf'] = $stdf;
				   } 	  
				}else{
					$len="select length(cast( ifnull( max( substr( stdid, 10, 3 ) ) , 0 ) AS signed int )) len 
					      from tbl_stdinfo WHERE hostel!='' AND session='$session' AND deptname='$deptname'";
					$ql=$myDb->select($len);
					$lrw=$myDb->get_row($ql,'MYSQL_ASSOC');
				 
					switch($lrw['len']){
					  case 1:
						 $mxid=$mrw['mid']+1;
						 if($mxid==10){
							$stdf=$std.$dp.$ses."0".$mxid;
                                                        $_SESSION['stdf'] = $stdf;
						 }else{
							$stdf=$std.$dp.$ses."00".$mxid;
                                                        $_SESSION['stdf'] = $stdf;
						 }	
							if($_FILES[img][tmp_name]==""){
			
			
								$ins="INSERT INTO tbl_stdinfo(stdid,stdname,password,sexstatus,dob,session,bgroup,deptname,
								                              fname,hostel,hostelid,seat,mname,gname,nationality,praddress,peraddress,
								                              religion,phone,opby,opdate,storedstatus,batch,semester,section,horde,ffighter,stdcursemester,stdstatuss)
							          VALUES('$stdf','$stdname','$password','$sexstatus','$dob','$session','$bgroup','$deptname',
								             '$fname','$hostel','$hostelid','$seat','$mname','$gname','$nationality','$praddress',
											 '$peraddress',
											 '$religion',
											 '$phone','$_SESSION[userid]','".date("Y-m-d")."','I'
											 ,'$batch','$semester','$section','$horde','$ffighter','$semester','R')";						 
								$sin=$myDb->insert_sql($ins);
                                                                
                                                                $ins_login=$myDb->select("SELECT*,(SELECT stdid FROM tbl_stdinfo WHERE stdid='$_SESSION[stdf]') stdid,
																  (SELECT password FROM tbl_stdinfo WHERE stdid='$_SESSION[stdf]') password FROM tbl_login 
																		  WHERE userid=(SELECT stdid FROM tbl_stdinfo WHERE stdid='$_SESSION[stdf]')");
                                                                $inslog=$myDb->get_row($ins_login,'MYSQL_ASSOC');

                                                                if($inslog['userid']==""){
                                                                       $stv=$myDb->select("SELECT stdid,password FROM tbl_stdinfo WHERE stdid='$_SESSION[stdf]'");
                                                                       $stvf=$myDb->get_row($stv,'MYSQL_ASSOC');

                                                                       $ilog="INSERT INTO tbl_login(userid,password,accid,storedstatus)
                                                                                                                 VALUES('$stvf[stdid]','".md5($password)."',38,'I')";
                                                                       $uing=$myDb->insert_sql($ilog);

                                                                }
								


										   $dn=$myDb->select("select*from tbl_department where id='$deptname'");
										   $dnf=$myDb->get_row($dn,'MYSQL_ASSOC');
								$stdac=$myDb->select("SELECT*FROM tbl_accchart where parentid in(select id from tbl_accchart where parentid=7) and dname='$dnf[name]' and session='$session'");
								$stdacf=$myDb->get_row($stdac,'MYSQL_ASSOC');
								if($stdacf['id']!=""){
										   $accname=$stdf." ".$stdname;
										   $accin="INSERT INTO tbl_accchart(accname,parentid,groupname,type,orderby,opby,opdate,storedstatus,session,dname)
												   VALUES('$accname','$stdacf[id]',6,'Trading Account',1,'$_SESSION[userid]','".date("Y-m-d")."','I','$session','$dnf[name]')";
										   $ai=$myDb->insert_sql($accin);
								}		   
								
								
								$msg="Insert educational qualification please";
								header("Location:add_edq.php?msg=$msg");
							 }else{	
								copy($_FILES[img][tmp_name],"uploads/".$a);			 
								$ins="INSERT INTO tbl_stdinfo(stdid,stdname,password,sexstatus,dob,session,bgroup,
							                                  deptname,fname,hostel,hostelid,seat,mname,gname,nationality,praddress,
								                              peraddress,religion,phone,img,opby,opdate,storedstatus,batch,semester,section,horde,ffighter,stdcursemester,stdstatus)
							          VALUES('$stdf','$stdname','$password','$sexstatus','$dob','$session','$bgroup','$deptname',
								             '$fname','$hostel','$hostelid','$seat','$mname','$gname','$nationality','$praddress',
											 '$peraddress',
											 '$religion',
											 '$phone','$a','$_SESSION[userid]','".date("Y-m-d")."','I',
											 '$batch','$semester','$section','$horde','$ffighter','$semester','R')";						 
								$sin=$myDb->insert_sql($ins);
                                                                $ins_login=$myDb->select("SELECT*,(SELECT stdid FROM tbl_stdinfo WHERE stdid='$_SESSION[stdf]') stdid,
																  (SELECT password FROM tbl_stdinfo WHERE stdid='$_SESSION[stdf]') password FROM tbl_login 
																		  WHERE userid=(SELECT stdid FROM tbl_stdinfo WHERE stdid='$_SESSION[stdf]')");
                                                                $inslog=$myDb->get_row($ins_login,'MYSQL_ASSOC');

                                                                if($inslog['userid']==""){
                                                                       $stv=$myDb->select("SELECT stdid,password FROM tbl_stdinfo WHERE stdid='$_SESSION[stdf]'");
                                                                       $stvf=$myDb->get_row($stv,'MYSQL_ASSOC');

                                                                       $ilog="INSERT INTO tbl_login(userid,password,accid,storedstatus)
                                                                                                                 VALUES('$stvf[stdid]','".md5($password)."',38,'I')";
                                                                       $uing=$myDb->insert_sql($ilog);

                                                                }
								

										   $dn=$myDb->select("select*from tbl_department where id='$deptname'");
										   $dnf=$myDb->get_row($dn,'MYSQL_ASSOC');
								$stdac=$myDb->select("SELECT*FROM tbl_accchart where parentid in(select id from tbl_accchart where parentid=7) and dname='$dnf[name]' and session='$session'");
								$stdacf=$myDb->get_row($stdac,'MYSQL_ASSOC');
								if($stdacf['id']!=""){
										   $accname=$stdf." ".$stdname;
										   $accin="INSERT INTO tbl_accchart(accname,parentid,groupname,type,orderby,opby,opdate,storedstatus,session,dname)
												   VALUES('$accname','$stdacf[id]',6,'Trading Account',1,'$_SESSION[userid]','".date("Y-m-d")."','I','$session','$dnf[name]')";
										   $ai=$myDb->insert_sql($accin);
								}		   
								
								
								
								$msg="Insert educational qualification please";
								header("Location:add_edq.php?msg=$msg");
							 }	
						 break;
					  case 2:
						 $mxid=$mrw['mid']+1;
						 if($mxid==100){
							$stdf=$std.$dp.$ses.$mxid;
                                                        $_SESSION['stdf'] = $stdf;
						 }else{
							$stdf=$std.$dp.$ses."0".$mxid;
						 }	$_SESSION['stdf'] = $stdf;
							if($_FILES[img][tmp_name]==""){
			
			
								$ins="INSERT INTO tbl_stdinfo(stdid,stdname,password,sexstatus,dob,session,bgroup,
							                                  deptname,fname,hostel,hostelid,seat,mname,gname,nationality,praddress,
								                              peraddress,religion,phone,opby,opdate,storedstatus,batch,semester,section,horde,ffighter,stdcursemester,stdstatus)
							          VALUES('$stdf','$stdname','$password','$sexstatus','$dob','$session','$bgroup','$deptname',
								             '$fname','$hostel','$hostelid','$seat','$mname','$gname','$nationality','$praddress',
											 '$peraddress',
											 '$religion',
											 '$phone','$_SESSION[userid]','".date("Y-m-d")."','I',
											 '$batch','$semester','$section','$horde','$ffighter','$semester','R')";						 
								$sin=$myDb->insert_sql($ins);
                                                                $ins_login=$myDb->select("SELECT*,(SELECT stdid FROM tbl_stdinfo WHERE stdid='$_SESSION[stdf]') stdid,
																  (SELECT password FROM tbl_stdinfo WHERE stdid='$_SESSION[stdf]') password FROM tbl_login 
																		  WHERE userid=(SELECT stdid FROM tbl_stdinfo WHERE stdid='$_SESSION[stdf]')");
                                                                $inslog=$myDb->get_row($ins_login,'MYSQL_ASSOC');

                                                                if($inslog['userid']==""){
                                                                       $stv=$myDb->select("SELECT stdid,password FROM tbl_stdinfo WHERE stdid='$_SESSION[stdf]'");
                                                                       $stvf=$myDb->get_row($stv,'MYSQL_ASSOC');

                                                                       $ilog="INSERT INTO tbl_login(userid,password,accid,storedstatus)
                                                                                                                 VALUES('$stvf[stdid]','".md5($password)."',38,'I')";
                                                                       $uing=$myDb->insert_sql($ilog);

                                                                }
								
								
										   $dn=$myDb->select("select*from tbl_department where id='$deptname'");
										   $dnf=$myDb->get_row($dn,'MYSQL_ASSOC');
								$stdac=$myDb->select("SELECT*FROM tbl_accchart where parentid in(select id from tbl_accchart where parentid=7) and dname='$dnf[name]' and session='$session'");
								$stdacf=$myDb->get_row($stdac,'MYSQL_ASSOC');
								if($stdacf['id']!=""){
										   $accname=$stdf." ".$stdname;
										   $accin="INSERT INTO tbl_accchart(accname,parentid,groupname,type,orderby,opby,opdate,storedstatus,session,dname)
												   VALUES('$accname','$stdacf[id]',6,'Trading Account',1,'$_SESSION[userid]','".date("Y-m-d")."','I','$session','$dnf[name]')";
										   $ai=$myDb->insert_sql($accin);
								}		   
								
								
								
								$msg="Insert educational qualification please";
								header("Location:add_edq.php?msg=$msg");
							 }else{	
								copy($_FILES[img][tmp_name],"uploads/".$a);			 
								$ins="INSERT INTO tbl_stdinfo(stdid,stdname,password,sexstatus,dob,session,bgroup,deptname,
							                                  fname,hostel,hostelid,seat,mname,gname,nationality,praddress,peraddress,
								                              religion,phone,img,opby,opdate,storedstatus,batch,semester,section,horde,ffighter,stdcursemester,stdstatus)
							          VALUES('$stdf','$stdname','$password','$sexstatus','$dob','$session','$bgroup',
								             '$deptname','$fname','$hostel','$hostelid','$seat','$mname','$gname','$nationality','$praddress',
											 '$peraddress',
											 '$religion',
											 '$phone','$a','$_SESSION[userid]','".date("Y-m-d")."','I',
											 '$batch','$semester','$section','$horde','$ffighter','$semester','R')";						 
								$sin=$myDb->insert_sql($ins);
								$ins_login=$myDb->select("SELECT*,(SELECT stdid FROM tbl_stdinfo WHERE stdid='$_SESSION[stdf]') stdid,
																  (SELECT password FROM tbl_stdinfo WHERE stdid='$_SESSION[stdf]') password FROM tbl_login 
																		  WHERE userid=(SELECT stdid FROM tbl_stdinfo WHERE stdid='$_SESSION[stdf]')");
                                                                $inslog=$myDb->get_row($ins_login,'MYSQL_ASSOC');

                                                                if($inslog['userid']==""){
                                                                       $stv=$myDb->select("SELECT stdid,password FROM tbl_stdinfo WHERE stdid='$_SESSION[stdf]'");
                                                                       $stvf=$myDb->get_row($stv,'MYSQL_ASSOC');

                                                                       $ilog="INSERT INTO tbl_login(userid,password,accid,storedstatus)
                                                                                                                 VALUES('$stvf[stdid]','".md5($password)."',38,'I')";
                                                                       $uing=$myDb->insert_sql($ilog);

                                                                }
								
								
								
										   $dn=$myDb->select("select*from tbl_department where id='$deptname'");
										   $dnf=$myDb->get_row($dn,'MYSQL_ASSOC');
								$stdac=$myDb->select("SELECT*FROM tbl_accchart where parentid in(select id from tbl_accchart where parentid=7) and dname='$dnf[name]' and session='$session'");
								$stdacf=$myDb->get_row($stdac,'MYSQL_ASSOC');
								if($stdacf['id']!=""){
										   $accname=$stdf." ".$stdname;
										   $accin="INSERT INTO tbl_accchart(accname,parentid,groupname,type,orderby,opby,opdate,storedstatus,session,dname)
												   VALUES('$accname','$stdacf[id]',6,'Trading Account',1,'$_SESSION[userid]','".date("Y-m-d")."','I','$session','$dnf[name]')";
										   $ai=$myDb->insert_sql($accin);
								}		   
								
								
								$msg="Insert educational qualification please";
								header("Location:add_edq.php?msg=$msg");
							 }	
						 break;
					  default:
						 $mxid=$mrw['mid']+1;
						 $stdf=$std.$dp.$ses.$mxid;
                                                 $_SESSION['stdf'] = $stdf;
							if($_FILES[img][tmp_name]==""){
			
			
								$ins="INSERT INTO tbl_stdinfo(stdid,stdname,password,sexstatus,dob,session,bgroup,deptname,fname,hostel,
								                              hostelid,seat,mname,gname,nationality,praddress,peraddress,
								                              religion,phone,opby,opdate,storedstatus,batch,semester,section,horde,ffighter,stdcursemester,stdstatus)
							          VALUES('$stdf','$stdname','$password','$sexstatus','$dob','$session','$bgroup',
								             '$deptname','$fname','$hostel','$hostelid','$seat','$mname','$gname','$nationality','$praddress',
											 '$peraddress',
											 '$religion',
											 '$phone','$_SESSION[userid]','".date("Y-m-d")."','I',
											 '$batch','$semester','$section','$horde','$ffighter','$semester','R')";						 
								$sin=$myDb->insert_sql($ins);
								$ins_login=$myDb->select("SELECT*,(SELECT stdid FROM tbl_stdinfo WHERE stdid='$_SESSION[stdf]') stdid,
																  (SELECT password FROM tbl_stdinfo WHERE stdid='$_SESSION[stdf]') password FROM tbl_login 
																		  WHERE userid=(SELECT stdid FROM tbl_stdinfo WHERE stdid='$_SESSION[stdf]')");
                                                                $inslog=$myDb->get_row($ins_login,'MYSQL_ASSOC');

                                                                if($inslog['userid']==""){
                                                                       $stv=$myDb->select("SELECT stdid,password FROM tbl_stdinfo WHERE stdid='$_SESSION[stdf]'");
                                                                       $stvf=$myDb->get_row($stv,'MYSQL_ASSOC');

                                                                       $ilog="INSERT INTO tbl_login(userid,password,accid,storedstatus)
                                                                                                                 VALUES('$stvf[stdid]','".md5($password)."',38,'I')";
                                                                       $uing=$myDb->insert_sql($ilog);

                                                                }
								
								
										   $dn=$myDb->select("select*from tbl_department where id='$deptname'");
										   $dnf=$myDb->get_row($dn,'MYSQL_ASSOC');
								$stdac=$myDb->select("SELECT*FROM tbl_accchart where parentid in(select id from tbl_accchart where parentid=7) and dname='$dnf[name]' and session='$session'");
								$stdacf=$myDb->get_row($stdac,'MYSQL_ASSOC');
								if($stdacf['id']!=""){
										   $accname=$stdf." ".$stdname;
										   $accin="INSERT INTO tbl_accchart(accname,parentid,groupname,type,orderby,opby,opdate,storedstatus,session,dname)
												   VALUES('$accname','$stdacf[id]',6,'Trading Account',1,'$_SESSION[userid]','".date("Y-m-d")."','I','$session','$dnf[name]')";
										   $ai=$myDb->insert_sql($accin);
								}		   
								
								
								
								$msg="Insert educational qualification please";
								header("Location:add_edq.php?msg=$msg");
							 }else{	
								copy($_FILES[img][tmp_name],"uploads/".$a);			 
								$ins="INSERT INTO tbl_stdinfo(stdid,stdname,password,sexstatus,dob,session,bgroup,
							                                  deptname,fname,hostel,hostelid,seat,mname,gname,nationality,praddress,
								                              peraddress,religion,phone,img,opby,opdate,storedstatus,batch,semester,section,horde,ffighter,stdcursemester,stdstatus)
							          VALUES('$stdf','$stdname','$password','$sexstatus','$dob','$session','$bgroup',
								             '$deptname','$fname','$hostel','$hostelid','$seat','$mname','$gname','$nationality','$praddress',
											 '$peraddress',
											 '$religion',
											 '$phone','$a','$_SESSION[userid]','".date("Y-m-d")."','I',
											 '$batch','$semester','$section','$horde','$ffighter','$semester','R')";						 
								$sin=$myDb->insert_sql($ins);
								$ins_login=$myDb->select("SELECT*,(SELECT stdid FROM tbl_stdinfo WHERE stdid='$_SESSION[stdf]') stdid,
																  (SELECT password FROM tbl_stdinfo WHERE stdid='$_SESSION[stdf]') password FROM tbl_login 
																		  WHERE userid=(SELECT stdid FROM tbl_stdinfo WHERE stdid='$_SESSION[stdf]')");
                                                                $inslog=$myDb->get_row($ins_login,'MYSQL_ASSOC');

                                                                if($inslog['userid']==""){
                                                                       $stv=$myDb->select("SELECT stdid,password FROM tbl_stdinfo WHERE stdid='$_SESSION[stdf]'");
                                                                       $stvf=$myDb->get_row($stv,'MYSQL_ASSOC');

                                                                       $ilog="INSERT INTO tbl_login(userid,password,accid,storedstatus)
                                                                                                                 VALUES('$stvf[stdid]','".md5($password)."',38,'I')";
                                                                       $uing=$myDb->insert_sql($ilog);

                                                                }
								
								
								
										   $dn=$myDb->select("select*from tbl_department where id='$deptname'");
										   $dnf=$myDb->get_row($dn,'MYSQL_ASSOC');
								$stdac=$myDb->select("SELECT*FROM tbl_accchart where parentid in(select id from tbl_accchart where parentid=7) and dname='$dnf[name]' and session='$session'");
								$stdacf=$myDb->get_row($stdac,'MYSQL_ASSOC');
								if($stdacf['id']!=""){
										   $accname=$stdf." ".$stdname;
										   $accin="INSERT INTO tbl_accchart(accname,parentid,groupname,type,orderby,opby,opdate,storedstatus,session,dname)
												   VALUES('$accname','$stdacf[id]',6,'Trading Account',1,'$_SESSION[userid]','".date("Y-m-d")."','I','$session','$dnf[name]')";
										   $ai=$myDb->insert_sql($accin);
								}		   
								
								
								$msg="Insert educational qualification please";
								header("Location:add_edq.php?msg=$msg");
							 }	
				   } 	  
				 }	
				
				
				
				  //$query="SELECT * FROM tbl_stdinfo order by id asc";
					//	    $sdep=$myDb->dump_query($query,'edit_stdinfo.php','del_stdinfo.php',$car['upd'],$car['delt']);
				
				
				//////////////////////////////////////////////////////////////HOSTEL NOT NULL HERE////////////////////////////////////////////
				}else{ //hostel null //
					$mx="SELECT cast( ifnull( max( substr( stdid, 8, 3 ) ) , 0 ) AS signed int ) mid 
					     FROM tbl_stdinfo WHERE hostel='' AND session='$session' AND deptname='$deptname'";
				 
				 
					$mr=$myDb->select($mx);
					$mrw=$myDb->get_row($mr,'MYSQL_ASSOC');
					$dp=substr($deptn,0,3);
					$ses=$session;
					//$stdf=$std.$dp.$ses."000".$mrw['mid'];
				 
					if($mrw['mid']=="0"){
					   $len="select length(cast( ifnull( max( substr(stdid, 8, 3 ) ) , 0 ) AS signed int )) len 
					         from tbl_stdinfo WHERE hostel='' AND session='$session' AND deptname='$deptname'";
					   $ql=$myDb->select($len);
					   $lrw=$myDb->get_row($ql,'MYSQL_ASSOC');
				 
					   switch($lrw['len']){
					   case 1:
						 //$stdf=$std.$dp.$ses."00".$mrw['mid']+1;
						 $mxid=$mrw['mid']+1;
						 $stdf=$dp.$ses."00".$mxid;
                                                 $_SESSION['stdf'] = $stdf;
							if($_FILES[img][tmp_name]==""){
			
			
								$ins="INSERT INTO tbl_stdinfo(stdid,stdname,password,sexstatus,dob,session,bgroup,
								                              deptname,fname,mname,gname,nationality,praddress,peraddress,religion,
								                              phone,opby,opdate,storedstatus,batch,semester,section,horde,ffighter,stdcursemester,stdstatus)
							          VALUES('$stdf','$stdname','$password','$sexstatus','$dob','$session','$bgroup',
								             '$deptname','$fname','$mname','$gname','$nationality','$praddress',
											 '$peraddress',
											 '$religion',
											 '$phone','$_SESSION[userid]','".date("Y-m-d")."','I',
											 '$batch','$semester','$section','$horde','$ffighter','$semester','R')";						 
								$sin=$myDb->insert_sql($ins);
								$ins_login=$myDb->select("SELECT*,(SELECT stdid FROM tbl_stdinfo WHERE stdid='$_SESSION[stdf]') stdid,
																  (SELECT password FROM tbl_stdinfo WHERE stdid='$_SESSION[stdf]') password FROM tbl_login 
																		  WHERE userid=(SELECT stdid FROM tbl_stdinfo WHERE stdid='$_SESSION[stdf]')");
                                                                $inslog=$myDb->get_row($ins_login,'MYSQL_ASSOC');

                                                                if($inslog['userid']==""){
                                                                       $stv=$myDb->select("SELECT stdid,password FROM tbl_stdinfo WHERE stdid='$_SESSION[stdf]'");
                                                                       $stvf=$myDb->get_row($stv,'MYSQL_ASSOC');

                                                                       $ilog="INSERT INTO tbl_login(userid,password,accid,storedstatus)
                                                                                                                 VALUES('$stvf[stdid]','".md5($password)."',38,'I')";
                                                                       $uing=$myDb->insert_sql($ilog);

                                                                }
								
								
								
										   $dn=$myDb->select("select*from tbl_department where id='$deptname'");
										   $dnf=$myDb->get_row($dn,'MYSQL_ASSOC');
								$stdac=$myDb->select("SELECT*FROM tbl_accchart where parentid in(select id from tbl_accchart where parentid=7) and dname='$dnf[name]' and session='$session'");
								$stdacf=$myDb->get_row($stdac,'MYSQL_ASSOC');
								if($stdacf['id']!=""){
										   $accname=$stdf." ".$stdname;
										   $accin="INSERT INTO tbl_accchart(accname,parentid,groupname,type,orderby,opby,opdate,storedstatus,session,dname)
												   VALUES('$accname','$stdacf[id]',6,'Trading Account',1,'$_SESSION[userid]','".date("Y-m-d")."','I','$session','$dnf[name]')";
										   $ai=$myDb->insert_sql($accin);
								}		   
								
								
								$msg="Insert educational qualification please";
								header("Location:add_edq.php?msg=$msg");
							 }else{	
								copy($_FILES[img][tmp_name],"uploads/".$a);			 
								$ins="INSERT INTO tbl_stdinfo(stdid,stdname,password,sexstatus,dob,session,
							                                  bgroup,deptname,fname,mname,gname,nationality,praddress,peraddress,
								                              religion,phone,img,opby,opdate,storedstatus,batch,semester,section,horde,ffighter,stdcursemester,stdstatus)
							          VALUES('$stdf','$stdname','$password','$sexstatus','$dob',
								             '$session','$bgroup','$deptname','$fname','$mname','$gname','$nationality','$praddress',
											 '$peraddress',
											 '$religion',
											 '$phone','$a','$_SESSION[userid]','".date("Y-m-d")."','I',
											 '$batch','$semester','$section','$horde','$ffighter','$semester','R')";						 
								$sin=$myDb->insert_sql($ins);
								$ins_login=$myDb->select("SELECT*,(SELECT stdid FROM tbl_stdinfo WHERE stdid='$_SESSION[stdf]') stdid,
																  (SELECT password FROM tbl_stdinfo WHERE stdid='$_SESSION[stdf]') password FROM tbl_login 
																		  WHERE userid=(SELECT stdid FROM tbl_stdinfo WHERE stdid='$_SESSION[stdf]')");
                                                                $inslog=$myDb->get_row($ins_login,'MYSQL_ASSOC');

                                                                if($inslog['userid']==""){
                                                                       $stv=$myDb->select("SELECT stdid,password FROM tbl_stdinfo WHERE stdid='$_SESSION[stdf]'");
                                                                       $stvf=$myDb->get_row($stv,'MYSQL_ASSOC');

                                                                       $ilog="INSERT INTO tbl_login(userid,password,accid,storedstatus)
                                                                                                                 VALUES('$stvf[stdid]','".md5($password)."',38,'I')";
                                                                       $uing=$myDb->insert_sql($ilog);

                                                                }
								
										   $dn=$myDb->select("select*from tbl_department where id='$deptname'");
										   $dnf=$myDb->get_row($dn,'MYSQL_ASSOC');
								$stdac=$myDb->select("SELECT*FROM tbl_accchart where parentid in(select id from tbl_accchart where parentid=7) and dname='$dnf[name]' and session='$session'");
								$stdacf=$myDb->get_row($stdac,'MYSQL_ASSOC');
								if($stdacf['id']!=""){
										   $accname=$stdf." ".$stdname;
										   $accin="INSERT INTO tbl_accchart(accname,parentid,groupname,type,orderby,opby,opdate,storedstatus,session,dname)
												   VALUES('$accname','$stdacf[id]',6,'Trading Account',1,'$_SESSION[userid]','".date("Y-m-d")."','I','$session','$dnf[name]')";
										   $ai=$myDb->insert_sql($accin);
								}		   
								
								
								
								$msg="Insert educational qualification please";
								header("Location:add_edq.php?msg=$msg");
							 }	
			
						 break;
					  case 2:
						 $stdf=$dp.$ses."0".$mrw['mid']+1;
                                                 $_SESSION['stdf'] = $stdf;
						 break;
					  default:
						 $stdf=$dp.$ses.$mrw['mid']+1;
                                                 $_SESSION['stdf'] = $stdf;
					 } 	  
				  }else{
					$len="select length(cast( ifnull( max( substr( stdid, 8, 3 ) ) , 0 ) AS signed int )) len 
					      from tbl_stdinfo WHERE hostel='' AND session='$session' AND deptname='$deptname'";
					$ql=$myDb->select($len);
					$lrw=$myDb->get_row($ql,'MYSQL_ASSOC');
				 
					switch($lrw['len']){
					  case 1:
						 $mxid=$mrw['mid']+1;
						 if($mxid==10){
							$stdf=$dp.$ses."0".$mxid;
                                                        $_SESSION['stdf'] = $stdf;
						 }else{
							$stdf=$dp.$ses."00".$mxid;
                                                        $_SESSION['stdf'] = $stdf;
						 }	
							if($_FILES[img][tmp_name]==""){
			
			
								$ins="INSERT INTO tbl_stdinfo(stdid,stdname,password,sexstatus,dob,session,bgroup,
								                              deptname,fname,mname,gname,nationality,praddress,peraddress,religion,
								                              phone,opby,opdate,storedstatus,batch,semester,section,horde,ffighter,stdcursemester,stdstatus)
							          VALUES('$stdf','$stdname','$password','$sexstatus','$dob','$session','$bgroup',
								             '$deptname','$fname','$mname','$gname','$nationality','$praddress',
											 '$peraddress',
											 '$religion',
											 '$phone','$_SESSION[userid]','".date("Y-m-d")."','I',
											 '$batch','$semester','$section','$horde','$ffighter','$semester','R')";						 
								$sin=$myDb->insert_sql($ins);
								$ins_login=$myDb->select("SELECT*,(SELECT stdid FROM tbl_stdinfo WHERE stdid='$_SESSION[stdf]') stdid,
																  (SELECT password FROM tbl_stdinfo WHERE stdid='$_SESSION[stdf]') password FROM tbl_login 
																		  WHERE userid=(SELECT stdid FROM tbl_stdinfo WHERE stdid='$_SESSION[stdf]')");
                                                                $inslog=$myDb->get_row($ins_login,'MYSQL_ASSOC');

                                                                if($inslog['userid']==""){
                                                                       $stv=$myDb->select("SELECT stdid,password FROM tbl_stdinfo WHERE stdid='$_SESSION[stdf]'");
                                                                       $stvf=$myDb->get_row($stv,'MYSQL_ASSOC');

                                                                       $ilog="INSERT INTO tbl_login(userid,password,accid,storedstatus)
                                                                                                                 VALUES('$stvf[stdid]','".md5($password)."',38,'I')";
                                                                       $uing=$myDb->insert_sql($ilog);

                                                                }
								
										   $dn=$myDb->select("select*from tbl_department where id='$deptname'");
										   $dnf=$myDb->get_row($dn,'MYSQL_ASSOC');
								$stdac=$myDb->select("SELECT*FROM tbl_accchart where parentid in(select id from tbl_accchart where parentid=7) and dname='$dnf[name]' and session='$session'");
								$stdacf=$myDb->get_row($stdac,'MYSQL_ASSOC');
								if($stdacf['id']!=""){
										   $accname=$stdf." ".$stdname;
										   $accin="INSERT INTO tbl_accchart(accname,parentid,groupname,type,orderby,opby,opdate,storedstatus,session,dname)
												   VALUES('$accname','$stdacf[id]',6,'Trading Account',1,'$_SESSION[userid]','".date("Y-m-d")."','I','$session','$dnf[name]')";
										   $ai=$myDb->insert_sql($accin);
								}		   
								
								
								
								
								$msg="Insert educational qualification please";
								header("Location:add_edq.php?msg=$msg");
							 }else{	
								copy($_FILES[img][tmp_name],"uploads/".$a);			 
								$ins="INSERT INTO tbl_stdinfo(stdid,stdname,password,sexstatus,dob,session,bgroup,
							                                  deptname,fname,mname,gname,nationality,praddress,peraddress,religion,
							                                  phone,img,opby,opdate,storedstatus,batch,semester,section,horde,ffighter,stdcursemester,stdstatus)
							          VALUES('$stdf','$stdname','$password','$sexstatus','$dob','$session','$bgroup',
								             '$deptname','$fname','$mname','$gname','$nationality','$praddress',
											 '$peraddress',
											 '$religion',
											 '$phone','$a','$_SESSION[userid]','".date("Y-m-d")."','I',
											 '$batch','$semester','$section','$horde','$ffighter','$semester','R')";						 
								$sin=$myDb->insert_sql($ins);
								$ins_login=$myDb->select("SELECT*,(SELECT stdid FROM tbl_stdinfo WHERE stdid='$_SESSION[stdf]') stdid,
																  (SELECT password FROM tbl_stdinfo WHERE stdid='$_SESSION[stdf]') password FROM tbl_login 
																		  WHERE userid=(SELECT stdid FROM tbl_stdinfo WHERE stdid='$_SESSION[stdf]')");
                                                                $inslog=$myDb->get_row($ins_login,'MYSQL_ASSOC');

                                                                if($inslog['userid']==""){
                                                                       $stv=$myDb->select("SELECT stdid,password FROM tbl_stdinfo WHERE stdid='$_SESSION[stdf]'");
                                                                       $stvf=$myDb->get_row($stv,'MYSQL_ASSOC');

                                                                       $ilog="INSERT INTO tbl_login(userid,password,accid,storedstatus)
                                                                                                                 VALUES('$stvf[stdid]','".md5($password)."',38,'I')";
                                                                       $uing=$myDb->insert_sql($ilog);

                                                                }
								
								
										   $dn=$myDb->select("select*from tbl_department where id='$deptname'");
										   $dnf=$myDb->get_row($dn,'MYSQL_ASSOC');
								$stdac=$myDb->select("SELECT*FROM tbl_accchart where parentid in(select id from tbl_accchart where parentid=7) and dname='$dnf[name]' and session='$session'");
								$stdacf=$myDb->get_row($stdac,'MYSQL_ASSOC');
								if($stdacf['id']!=""){
										   $accname=$stdf." ".$stdname;
										   $accin="INSERT INTO tbl_accchart(accname,parentid,groupname,type,orderby,opby,opdate,storedstatus,session,dname)
												   VALUES('$accname','$stdacf[id]',6,'Trading Account',1,'$_SESSION[userid]','".date("Y-m-d")."','I','$session','$dnf[name]')";
										   $ai=$myDb->insert_sql($accin);
								}		   
								
								
								$msg="Insert educational qualification please";
								header("Location:add_edq.php?msg=$msg");
							 }	
						 break;
					  case 2:
						 $mxid=$mrw['mid']+1;
						 if($mxid==100){
							$stdf=$dp.$ses.$mxid;
                                                        $_SESSION['stdf'] = $stdf;
						 }else{
							$stdf=$dp.$ses."0".$mxid;
                                                        $_SESSION['stdf'] = $stdf;
						 }	
							if($_FILES[img][tmp_name]==""){
			
			
								$ins="INSERT INTO tbl_stdinfo(stdid,stdname,password,sexstatus,dob,session,bgroup,
								                              deptname,fname,mname,gname,nationality,praddress,peraddress,religion,phone,
								                              opby,opdate,storedstatus,batch,semester,section,horde,ffighter,stdcursemester,stdstatus)
							          VALUES('$stdf','$stdname','$password','$sexstatus','$dob','$session',
								             '$bgroup','$deptname','$fname','$mname','$gname','$nationality','$praddress',
											 '$peraddress',
											 '$religion',
											 '$phone','$_SESSION[userid]','".date("Y-m-d")."','I',
											 '$batch','$semester','$section','$horde','$ffighter','$semester','R')";						 
								$sin=$myDb->insert_sql($ins);
								$ins_login=$myDb->select("SELECT*,(SELECT stdid FROM tbl_stdinfo WHERE stdid='$_SESSION[stdf]') stdid,
																  (SELECT password FROM tbl_stdinfo WHERE stdid='$_SESSION[stdf]') password FROM tbl_login 
																		  WHERE userid=(SELECT stdid FROM tbl_stdinfo WHERE stdid='$_SESSION[stdf]')");
                                                                $inslog=$myDb->get_row($ins_login,'MYSQL_ASSOC');

                                                                if($inslog['userid']==""){
                                                                       $stv=$myDb->select("SELECT stdid,password FROM tbl_stdinfo WHERE stdid='$_SESSION[stdf]'");
                                                                       $stvf=$myDb->get_row($stv,'MYSQL_ASSOC');

                                                                       $ilog="INSERT INTO tbl_login(userid,password,accid,storedstatus)
                                                                                                                 VALUES('$stvf[stdid]','".md5($password)."',38,'I')";
                                                                       $uing=$myDb->insert_sql($ilog);

                                                                }
								
                                                                $dn=$myDb->select("select*from tbl_department where id='$deptname'");
                                                                $dnf=$myDb->get_row($dn,'MYSQL_ASSOC');
								$stdac=$myDb->select("SELECT*FROM tbl_accchart where parentid in(select id from tbl_accchart where parentid=7) and dname='$dnf[name]' and session='$session'");
								$stdacf=$myDb->get_row($stdac,'MYSQL_ASSOC');
								if($stdacf['id']!=""){
										   $accname=$stdf." ".$stdname;
										   $accin="INSERT INTO tbl_accchart(accname,parentid,groupname,type,orderby,opby,opdate,storedstatus,session,dname)
												   VALUES('$accname','$stdacf[id]',6,'Trading Account',1,'$_SESSION[userid]','".date("Y-m-d")."','I','$session','$dnf[name]')";
										   $ai=$myDb->insert_sql($accin);
								}		   
								
								$msg="Insert educational qualification please";
								header("Location:add_edq.php?msg=$msg");
							 }else{	
								copy($_FILES[img][tmp_name],"uploads/".$a);			 
								$ins="INSERT INTO tbl_stdinfo(stdid,stdname,password,sexstatus,dob,session,bgroup,
							                                  deptname,fname,mname,gname,nationality,praddress,peraddress,
								                              religion,phone,img,opby,opdate,storedstatus,batch,semester,section,horde,ffighter,stdcursemester,stdstatus)
							          VALUES('$stdf','$stdname','$password','$sexstatus','$dob','$session',
								             '$bgroup','$deptname','$fname','$mname','$gname','$nationality','$praddress',
											 '$peraddress',
											 '$religion',
											 '$phone','$a','$_SESSION[userid]','".date("Y-m-d")."','I',
											 '$batch','$semester','$section','$horde','$ffighter','$semester','R')";						 
								$sin=$myDb->insert_sql($ins);
								$ins_login=$myDb->select("SELECT*,(SELECT stdid FROM tbl_stdinfo WHERE stdid='$_SESSION[stdf]') stdid,
																  (SELECT password FROM tbl_stdinfo WHERE stdid='$_SESSION[stdf]') password FROM tbl_login 
																		  WHERE userid=(SELECT stdid FROM tbl_stdinfo WHERE stdid='$_SESSION[stdf]')");
                                                                $inslog=$myDb->get_row($ins_login,'MYSQL_ASSOC');

                                                                if($inslog['userid']==""){
                                                                       $stv=$myDb->select("SELECT stdid,password FROM tbl_stdinfo WHERE stdid='$_SESSION[stdf]'");
                                                                       $stvf=$myDb->get_row($stv,'MYSQL_ASSOC');

                                                                       $ilog="INSERT INTO tbl_login(userid,password,accid,storedstatus)
                                                                                                                 VALUES('$stvf[stdid]','".md5($password)."',38,'I')";
                                                                       $uing=$myDb->insert_sql($ilog);

                                                                }
								
								
										   $dn=$myDb->select("select*from tbl_department where id='$deptname'");
										   $dnf=$myDb->get_row($dn,'MYSQL_ASSOC');
								$stdac=$myDb->select("SELECT*FROM tbl_accchart where parentid in(select id from tbl_accchart where parentid=7) and dname='$dnf[name]' and session='$session'");
								$stdacf=$myDb->get_row($stdac,'MYSQL_ASSOC');
								if($stdacf['id']!=""){
										   $accname=$stdf." ".$stdname;
										   $accin="INSERT INTO tbl_accchart(accname,parentid,groupname,type,orderby,opby,opdate,storedstatus,session,dname)
												   VALUES('$accname','$stdacf[id]',6,'Trading Account',1,'$_SESSION[userid]','".date("Y-m-d")."','I','$session','$dnf[name]')";
										   $ai=$myDb->insert_sql($accin);
								}		   
								
								
								
								$msg="Insert educational qualification please";
								header("Location:add_edq.php?msg=$msg");
							 }	
						 break;
					  default:
						 $mxid=$mrw['mid']+1;
						 $stdf=$dp.$ses.$mxid;
                                                 $_SESSION['stdf'] = $stdf;
							if($_FILES[img][tmp_name]==""){
			
			
								$ins="INSERT INTO tbl_stdinfo(stdid,stdname,password,sexstatus,dob,session,bgroup,
								                              deptname,fname,mname,gname,nationality,praddress,peraddress,
								                              religion,phone,opby,opdate,storedstatus,batch,semester,section,horde,ffighter,stdcursemester,stdstatus)
							          VALUES('$stdf','$stdname','$password','$sexstatus','$dob','$session',
								             '$bgroup','$deptname','$fname','$mname','$gname','$nationality','$praddress',
											 '$peraddress',
											 '$religion',
											 '$phone','$_SESSION[userid]','".date("Y-m-d")."','I',
											 '$batch','$semester','$section','$horde','$ffighter','$semester','R')";						 
								$sin=$myDb->insert_sql($ins);
								$ins_login=$myDb->select("SELECT*,(SELECT stdid FROM tbl_stdinfo WHERE stdid='$_SESSION[stdf]') stdid,
																  (SELECT password FROM tbl_stdinfo WHERE stdid='$_SESSION[stdf]') password FROM tbl_login 
																		  WHERE userid=(SELECT stdid FROM tbl_stdinfo WHERE stdid='$_SESSION[stdf]')");
                                                                $inslog=$myDb->get_row($ins_login,'MYSQL_ASSOC');

                                                                if($inslog['userid']==""){
                                                                       $stv=$myDb->select("SELECT stdid,password FROM tbl_stdinfo WHERE stdid='$_SESSION[stdf]'");
                                                                       $stvf=$myDb->get_row($stv,'MYSQL_ASSOC');

                                                                       $ilog="INSERT INTO tbl_login(userid,password,accid,storedstatus)
                                                                                                                 VALUES('$stvf[stdid]','".md5($password)."',38,'I')";
                                                                       $uing=$myDb->insert_sql($ilog);

                                                                }
								
								
										   $dn=$myDb->select("select*from tbl_department where id='$deptname'");
										   $dnf=$myDb->get_row($dn,'MYSQL_ASSOC');
								$stdac=$myDb->select("SELECT*FROM tbl_accchart where parentid in(select id from tbl_accchart where parentid=7) and dname='$dnf[name]' and session='$session'");
								$stdacf=$myDb->get_row($stdac,'MYSQL_ASSOC');
								if($stdacf['id']!=""){
										   $accname=$stdf." ".$stdname;
										   $accin="INSERT INTO tbl_accchart(accname,parentid,groupname,type,orderby,opby,opdate,storedstatus,session,dname)
												   VALUES('$accname','$stdacf[id]',6,'Trading Account',1,'$_SESSION[userid]','".date("Y-m-d")."','I','$session','$dnf[name]')";
										   $ai=$myDb->insert_sql($accin);
								}		   
								
								$msg="Insert educational qualification please";
								header("Location:add_edq.php?msg=$msg");
							 }else{	
								copy($_FILES[img][tmp_name],"uploads/".$a);			 
								$ins="INSERT INTO tbl_stdinfo(stdid,stdname,password,sexstatus,dob,session,bgroup,
							                                  deptname,fname,mname,gname,nationality,praddress,peraddress,
								                              religion,phone,img,opby,opdate,storedstatus,batch,semester,section,horde,ffighter,stdcursemester,stdstatus)
							          VALUES('$stdf','$stdname','$password','$sexstatus','$dob','$session','$bgroup',
								             '$deptname','$fname','$mname','$gname','$nationality','$praddress',
											 '$peraddress',
											 '$religion',
											 '$phone','$a','$_SESSION[userid]','".date("Y-m-d")."','I','$batch','$semester','$section','$horde','$ffighter','$semester','R')";						 
								$sin=$myDb->insert_sql($ins);
								$ins_login=$myDb->select("SELECT*,(SELECT stdid FROM tbl_stdinfo WHERE stdid='$_SESSION[stdf]') stdid,
																  (SELECT password FROM tbl_stdinfo WHERE stdid='$_SESSION[stdf]') password FROM tbl_login 
																		  WHERE userid=(SELECT stdid FROM tbl_stdinfo WHERE stdid='$_SESSION[stdf]')");
                                                                $inslog=$myDb->get_row($ins_login,'MYSQL_ASSOC');

                                                                if($inslog['userid']==""){
                                                                       $stv=$myDb->select("SELECT stdid,password FROM tbl_stdinfo WHERE stdid='$_SESSION[stdf]'");
                                                                       $stvf=$myDb->get_row($stv,'MYSQL_ASSOC');

                                                                       $ilog="INSERT INTO tbl_login(userid,password,accid,storedstatus)
                                                                                                                 VALUES('$stvf[stdid]','".md5($password)."',38,'I')";
                                                                       $uing=$myDb->insert_sql($ilog);

                                                                }
								
								
										   $dn=$myDb->select("select*from tbl_department where id='$deptname'");
										   $dnf=$myDb->get_row($dn,'MYSQL_ASSOC');
								$stdac=$myDb->select("SELECT*FROM tbl_accchart where parentid in(select id from tbl_accchart where parentid=7) and dname='$dnf[name]' and session='$session'");
								$stdacf=$myDb->get_row($stdac,'MYSQL_ASSOC');
								if($stdacf['id']!=""){
										   $accname=$stdf." ".$stdname;
										   $accin="INSERT INTO tbl_accchart(accname,parentid,groupname,type,orderby,opby,opdate,storedstatus,session,dname)
												   VALUES('$accname','$stdacf[id]',6,'Trading Account',1,'$_SESSION[userid]','".date("Y-m-d")."','I','$session','$dnf[name]')";
										   $ai=$myDb->insert_sql($accin);
								}		   
								
								
								$msg="Insert educational qualification please";
								header("Location:add_edq.php?msg=$msg");
							 }	
				   } 	  
				 }	
				
				
				
				  //$query="SELECT * FROM tbl_stdinfo order by id asc";
					//	    $sdep=$myDb->dump_query($query,'edit_stdinfo.php','del_stdinfo.php',$car['upd'],$car['delt']);
							
				 /////////////////////////////////////////HOSTEL NULL HERE/////////////////////////////////////////////////////			
				 }	
			 
 
 }else{
              $password=mysql_real_escape_string($_POST['password']);
			  $sexstatus=mysql_real_escape_string($_POST['sexstatus']);
			  /*$d=mysql_real_escape_string($_POST['d']);
			  $m=mysql_real_escape_string($_POST['m']);
			  $y=mysql_real_escape_string($_POST['y']);
			  */
			  $exstid=mysql_real_escape_string($_POST['exstid']);
                          $_SESSION['exstid'] = $exstid;
			  $stdname=ucwords(mysql_real_escape_string($_POST['stdname']));
			  //$dob=mysql_real_escape_string($_POST['dob']);
			  $dy=mysql_real_escape_string($_POST['dy']);
			  $mn=mysql_real_escape_string($_POST['mn']);
			  $yr=mysql_real_escape_string($_POST['yr']);
			  $dob=$yr."-".$mn."-".$dy;
			  $session=mysql_real_escape_string($_POST['session']);
			  $bgroup=mysql_real_escape_string($_POST['bgroup']);
			  $deptname=mysql_real_escape_string($_POST['deptname']);
			  $horde=mysql_real_escape_string($_POST['horde']);
			  $ffighter=mysql_real_escape_string($_POST['ffighter']);
			  $boardregno=mysql_real_escape_string($_POST['boardregno']);
			  $boardrollno=mysql_real_escape_string($_POST['boardrollno']);
  			  $section=mysql_real_escape_string($_POST['section']);


			  $dps="SELECT*FROM tbl_department WHERE id='$deptname'";
			  $dpq=$myDb->select($dps);
			  $dpr=$myDb->get_row($dpq,'MYSQL_ASSOC');
			  $deptn=$dpr['code'];
			  
			  $fname=ucwords(mysql_real_escape_string($_POST['fname']));
			  $hostel=mysql_real_escape_string($_POST['hostel']);
			  
			  $hq="SELECT id,code,name FROM tbl_hostel WHERE code='$hostel' order by id desc";
								  $hr=$myDb->select($hq);
								  $hrid=$myDb->get_row($hr,'MYSQL_ASSOC');  
				
			  $hostelid=$hrid['id'];					  
			  $mname=ucwords(mysql_real_escape_string($_POST['mname']));
			  $gname=ucwords(mysql_real_escape_string($_POST['gname']));
			  $nationality=mysql_real_escape_string($_POST['nationality']);
			  $praddress=mysql_real_escape_string($_POST['praddress']);
			  $peraddress=mysql_real_escape_string($_POST['peraddress']);
			  $religion=mysql_real_escape_string($_POST['religion']);
			  $phone=mysql_real_escape_string($_POST['phone']);
			  $batch=mysql_real_escape_string($_POST['batch']);
			  $seat=mysql_real_escape_string($_POST['seat']);
			  $semester=mysql_real_escape_string($_POST['semester']);
			  
			  $mid=mysql_query("select max(id) from tbl_stdinfo") or die(mysql_error());
			  $mfetch=mysql_fetch_array($mid);
			  $maxid=$mfetch["max(id)"];
			  $maxid=$maxid+1;
			  $a=$maxid.".jpg";
 
 
			    if($_FILES[img][tmp_name]==""){


			        $ins="INSERT INTO tbl_stdinfo(stdid,stdname,password,sexstatus,dob,session,bgroup,
				                                  deptname,fname,hostel,hostelid,seat,mname,gname,nationality,praddress,
					                              peraddress,religion,phone,opby,opdate,storedstatus,batch,semester,section,horde,ffighter,
												  boardregno,stdcursemester,stdstatus,boardrollno)
	                      VALUES('$exstid','$stdname','$password','$sexstatus','$dob','$session',
					             '$bgroup','$deptname','$fname','$hostel','$hostelid','$seat','$mname','$gname','$nationality','$praddress',
								 '$peraddress',
								 '$religion',
								 '$phone','$_SESSION[userid]','".date("Y-m-d")."','I',
								 '$batch','$semester','$horde','$ffighter','$boardregno','$semester','$section','R','$boardrollno')";						 
	                //$sin=$myDb->insert_sql($ins);
	                if($myDb->insert_sql($ins)){
					$ins_login=$myDb->select("SELECT*,(SELECT stdid FROM tbl_stdinfo WHERE stdid='$_SESSION[stdf]') stdid,
																  (SELECT password FROM tbl_stdinfo WHERE stdid='$_SESSION[stdf]') password FROM tbl_login 
																		  WHERE userid=(SELECT stdid FROM tbl_stdinfo WHERE stdid='$_SESSION[stdf]')");
                                                                $inslog=$myDb->get_row($ins_login,'MYSQL_ASSOC');

                                                                if($inslog['userid']==""){
                                                                       $stv=$myDb->select("SELECT stdid,password FROM tbl_stdinfo WHERE stdid='$_SESSION[stdf]'");
                                                                       $stvf=$myDb->get_row($stv,'MYSQL_ASSOC');

                                                                       $ilog="INSERT INTO tbl_login(userid,password,accid,storedstatus)
                                                                                                                 VALUES('$stvf[stdid]','".md5($password)."',38,'I')";
                                                                       $uing=$myDb->insert_sql($ilog);

                                                                }
					
					
                                                                $dn=$myDb->select("select*from tbl_department where id='$deptname'");
                                                                $dnf=$myDb->get_row($dn,'MYSQL_ASSOC');
								$stdac=$myDb->select("SELECT*FROM tbl_accchart where parentid in(select id from tbl_accchart where parentid=7) and dname='$dnf[name]' and session='$session'");
								$stdacf=$myDb->get_row($stdac,'MYSQL_ASSOC');
								if($stdacf['id']!=""){
										   $accname=$exstid." ".$stdname;
										   $accin="INSERT INTO tbl_accchart(accname,parentid,groupname,type,orderby,opby,opdate,storedstatus,session,dname)
												   VALUES('$accname','$stdacf[id]',6,'Trading Account',1,'$_SESSION[userid]','".date("Y-m-d")."','I','$session','$dnf[name]')";
										   $ai=$myDb->insert_sql($accin);
								}		   
					
					
	                   $msg="Insert educational qualification please";
					   header("Location:add_edq.php?msg=$msg");
				    }else{
	                   $msg=$myDb->last_error;//"Insert educational qualification please";
					   header("Location:add_edq.php?msg=$msg");
					}	   
				 }else{	
			        copy($_FILES[img][tmp_name],"uploads/".$a);			 
			        $ins="INSERT INTO tbl_stdinfo(stdid,stdname,password,sexstatus,dob,session,bgroup,
				                                  deptname,fname,hostel,hostelid,seat,mname,gname,nationality,praddress,
					                              peraddress,religion,phone,img,opby,opdate,storedstatus,batch,semester,section,horde,ffighter,boardregno,stdcursemester,stdstatus
												  ,boardrollno)
	                      VALUES('$exstid','$stdname','$password','$sexstatus','$dob','$session',
					             '$bgroup','$deptname','$fname','$hostel','$hostelid','$seat','$mname','$gname','$nationality','$praddress',
								 '$peraddress',
								 '$religion',
								 '$phone','$a','$_SESSION[userid]','".date("Y-m-d")."','I',
								 '$batch','$semester','$section','$horde','$ffighter','$boardregno','$semester','R','$boardrollno')";						 
	                if($myDb->insert_sql($ins)){
					
				$ins_login=$myDb->select("SELECT*,(SELECT stdid FROM tbl_stdinfo WHERE stdid='$_SESSION[stdf]') stdid,
																  (SELECT password FROM tbl_stdinfo WHERE stdid='$_SESSION[stdf]') password FROM tbl_login 
																		  WHERE userid=(SELECT stdid FROM tbl_stdinfo WHERE stdid='$_SESSION[stdf]')");
                                                                $inslog=$myDb->get_row($ins_login,'MYSQL_ASSOC');

                                                                if($inslog['userid']==""){
                                                                       $stv=$myDb->select("SELECT stdid,password FROM tbl_stdinfo WHERE stdid='$_SESSION[stdf]'");
                                                                       $stvf=$myDb->get_row($stv,'MYSQL_ASSOC');

                                                                       $ilog="INSERT INTO tbl_login(userid,password,accid,storedstatus)
                                                                                                                 VALUES('$stvf[stdid]','".md5($password)."',38,'I')";
                                                                       $uing=$myDb->insert_sql($ilog);

                                                                }	
					
										   $dn=$myDb->select("select*from tbl_department where id='$deptname'");
										   $dnf=$myDb->get_row($dn,'MYSQL_ASSOC');
								$stdac=$myDb->select("SELECT*FROM tbl_accchart where parentid in(select id from tbl_accchart where parentid=7) and dname='$dnf[name]' and session='$session'");
								$stdacf=$myDb->get_row($stdac,'MYSQL_ASSOC');
								if($stdacf['id']!=""){
										   $accname=$exstid." ".$stdname;
										   $accin="INSERT INTO tbl_accchart(accname,parentid,groupname,type,orderby,opby,opdate,storedstatus,session,dname)
												   VALUES('$accname','$stdacf[id]',6,'Trading Account',1,'$_SESSION[userid]','".date("Y-m-d")."','I','$session','$dnf[name]')";
										   $ai=$myDb->insert_sql($accin);
								}		   
					
	                   $msg="Insert educational qualification please";
					   header("Location:add_edq.php?msg=$msg");
				    }else{
	                   $msg=$myDb->last_error;//"Insert educational qualification please";
					   header("Location:add_edq.php?msg=$msg");
					}	   
				 }	
					
 }
 
 
 }


   }else{
     $msg="Sorry,you are not authorized to access this page";
	 header("Location:home.php?msg=$msg");
   }	 

}else{
  header("Location:index.php");
}
}