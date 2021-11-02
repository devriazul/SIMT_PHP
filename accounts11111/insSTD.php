<?php ob_start();
session_start();
include("config.php"); 
if($myDb->connectDefaultServer())
{ 
  if($_SESSION['userid']){
  $chka="SELECT*FROM  tbl_accdtl WHERE flname='stdinfo.php' AND userid='$_SESSION[userid]'";
  $caq=$myDb->select($chka);
  $car=$myDb->get_row($caq,'MYSQL_ASSOC');
  if($car['ins']=="y"){

  if($_SERVER['REQUEST_METHOD']=="POST"){ 
  if($_POST['exstid']==""){
  
  
  $password=mysql_real_escape_string($_POST['password']);
  $sexstatus=mysql_real_escape_string($_POST['sexstatus']);
  /*$d=mysql_real_escape_string($_POST['d']);
  $m=mysql_real_escape_string($_POST['m']);
  $y=mysql_real_escape_string($_POST['y']);
  */
  $exstid=mysql_real_escape_string($_POST['exstid']);
  $stdname=mysql_real_escape_string($_POST['stdname']);
  $dob=mysql_real_escape_string($_POST['dob']);
  $session=mysql_real_escape_string($_POST['session']);
  $bgroup=mysql_real_escape_string($_POST['bgroup']);
  $deptname=mysql_real_escape_string($_POST['deptname']);
  
  $dps="SELECT*FROM tbl_department WHERE id='$deptname'";
  $dpq=$myDb->select($dps);
  $dpr=$myDb->get_row($dpq,'MYSQL_ASSOC');
  $deptn=$dpr['code'];
  
  $fname=mysql_real_escape_string($_POST['fname']);
  $hostel=mysql_real_escape_string($_POST['hostel']);
  
  $hq="SELECT id,code,name FROM tbl_hostel WHERE code='$hostel' order by id desc";
				      $hr=$myDb->select($hq);
					  $hrid=$myDb->get_row($hr,'MYSQL_ASSOC');  
	
  $hostelid=$hrid['id'];					  
  $mname=mysql_real_escape_string($_POST['mname']);
  $gname=mysql_real_escape_string($_POST['gname']);
  $nationality=mysql_real_escape_string($_POST['nationality']);
  $praddress=mysql_real_escape_string($_POST['praddress']);
  $peraddress=mysql_real_escape_string($_POST['peraddress']);
  $religion=mysql_real_escape_string($_POST['religion']);
  $phone=mysql_real_escape_string($_POST['phone']);
  $batch=mysql_real_escape_string($_POST['batch']);
  $semester=mysql_real_escape_string($_POST['semester']);
  
  $mid=mysql_query("select max(id) from tbl_stdinfo") or die(mysql_error());
  $mfetch=mysql_fetch_array($mid);
  $maxid=$mfetch["max(id)"];
  $maxid=$maxid+1;
  $a=$maxid.".jpg";

  if($hostel!=""){
     $mx="SELECT cast( ifnull( max( substr( stdid, 10, 3 ) ) , 0 ) AS signed int ) mid FROM tbl_stdinfo WHERE hostel!='' AND session='$session' AND deptname='$deptname'";
     $mr=$myDb->select($mx);
     $mrw=$myDb->get_row($mr,'MYSQL_ASSOC');
     $std=substr($hostel,0,2);
     $dp=substr($deptn,0,3);
	 
     $ses=$session;
     //$stdf=$std.$dp.$ses."000".$mrw['mid'];
     
	 if($mrw['mid']=="0"){
	    $len="select length(cast( ifnull( max( substr( stdid, 10, 3 ) ) , 0 ) AS signed int )) len from tbl_stdinfo WHERE hostel!='' AND session='$session' AND deptname='$deptname'";
	    $ql=$myDb->select($len);
	    $lrw=$myDb->get_row($ql,'MYSQL_ASSOC');
	 
	    switch($lrw['len']){
	      case 1:
             //$stdf=$std.$dp.$ses."00".$mrw['mid']+1;
			 $mxid=$mrw['mid']+1;
			 $stdf=$std.$dp.$ses."00".$mxid;
			    if($_FILES[img][tmp_name]==""){


			        $ins="INSERT INTO tbl_stdinfo(stdid,stdname,password,sexstatus,dob,session,bgroup,deptname,fname,hostel,hostelid,mname,gname,nationality,praddress,peraddress,religion,phone,opby,opdate,storedstatus,batch,semester)
	                VALUES('$stdf','$stdname','$password','$sexstatus','$dob','$session','$bgroup','$deptname','$fname','$hostel','$hostelid','$mname','$gname','$nationality','$praddress',
								 '$peraddress',
								 '$religion',
								 '$phone','$_SESSION[userid]','".date("Y-m-d")."','I','$batch','$semester')";						 
	                $sin=$myDb->insert_sql($ins);
	                $msg="Insert educational qualification please";
					header("Location:add_edq.php?msg=$msg");
				 }else{	
			        copy($_FILES[img][tmp_name],"uploads/".$a);			 
			        $ins="INSERT INTO tbl_stdinfo(stdid,stdname,password,sexstatus,dob,session,bgroup,deptname,fname,hostel,hostelid,mname,gname,nationality,praddress,peraddress,religion,phone,img,opby,opdate,storedstatus,batch,semester)
	                VALUES('$stdf','$stdname','$password','$sexstatus','$dob','$session','$bgroup','$deptname','$fname','$hostel','$hostelid','$mname','$gname','$nationality','$praddress',
								 '$peraddress',
								 '$religion',
								 '$phone','$a','$_SESSION[userid]','".date("Y-m-d")."','I','$batch','$semester')";						 
	                $sin=$myDb->insert_sql($ins);
	                $msg="Insert educational qualification please";
					header("Location:add_edq.php?msg=$msg");
				 }	

		     break;
	      case 2:
	         $stdf=$std.$dp.$ses."0".$mrw['mid']+1;
             break;
	      default:
	         $stdf=$std.$dp.$ses.$mrw['mid']+1;
	   } 	  
	}else{
	    $len="select length(cast( ifnull( max( substr( stdid, 10, 3 ) ) , 0 ) AS signed int )) len from tbl_stdinfo WHERE hostel!='' AND session='$session' AND deptname='$deptname'";
	    $ql=$myDb->select($len);
	    $lrw=$myDb->get_row($ql,'MYSQL_ASSOC');
	 
	    switch($lrw['len']){
	      case 1:
			 $mxid=$mrw['mid']+1;
			 if($mxid==10){
			    $stdf=$std.$dp.$ses."0".$mxid;
		     }else{
			    $stdf=$std.$dp.$ses."00".$mxid;
			 }	
			    if($_FILES[img][tmp_name]==""){


			        $ins="INSERT INTO tbl_stdinfo(stdid,stdname,password,sexstatus,dob,session,bgroup,deptname,fname,hostel,hostelid,mname,gname,nationality,praddress,peraddress,religion,phone,opby,opdate,storedstatus,batch,semester)
	                VALUES('$stdf','$stdname','$password','$sexstatus','$dob','$session','$bgroup','$deptname','$fname','$hostel','$hostelid','$mname','$gname','$nationality','$praddress',
								 '$peraddress',
								 '$religion',
								 '$phone','$_SESSION[userid]','".date("Y-m-d")."','I','$batch','$semester')";						 
	                $sin=$myDb->insert_sql($ins);
	                $msg="Insert educational qualification please";
					header("Location:add_edq.php?msg=$msg");
				 }else{	
			        copy($_FILES[img][tmp_name],"uploads/".$a);			 
			        $ins="INSERT INTO tbl_stdinfo(stdid,stdname,password,sexstatus,dob,session,bgroup,deptname,fname,hostel,hostelid,mname,gname,nationality,praddress,peraddress,religion,phone,img,opby,opdate,storedstatus,batch,semester)
	                VALUES('$stdf','$stdname','$password','$sexstatus','$dob','$session','$bgroup','$deptname','$fname','$hostel','$hostelid','$mname','$gname','$nationality','$praddress',
								 '$peraddress',
								 '$religion',
								 '$phone','$a','$_SESSION[userid]','".date("Y-m-d")."','I','$batch','$semester')";						 
	                $sin=$myDb->insert_sql($ins);
	                $msg="Insert educational qualification please";
					header("Location:add_edq.php?msg=$msg");
				 }	
	 	     break;
	      case 2:
			 $mxid=$mrw['mid']+1;
			 if($mxid==100){
			    $stdf=$std.$dp.$ses.$mxid;
		     }else{
			    $stdf=$std.$dp.$ses."0".$mxid;
			 }	
			    if($_FILES[img][tmp_name]==""){


			        $ins="INSERT INTO tbl_stdinfo(stdid,stdname,password,sexstatus,dob,session,bgroup,deptname,fname,hostel,hostelid,mname,gname,nationality,praddress,peraddress,religion,phone,opby,opdate,storedstatus,batch,semester)
	                VALUES('$stdf','$stdname','$password','$sexstatus','$dob','$session','$bgroup','$deptname','$fname','$hostel','$hostelid','$mname','$gname','$nationality','$praddress',
								 '$peraddress',
								 '$religion',
								 '$phone','$_SESSION[userid]','".date("Y-m-d")."','I','$batch','$semester')";						 
	                $sin=$myDb->insert_sql($ins);
	                $msg="Insert educational qualification please";
					header("Location:add_edq.php?msg=$msg");
				 }else{	
			        copy($_FILES[img][tmp_name],"uploads/".$a);			 
			        $ins="INSERT INTO tbl_stdinfo(stdid,stdname,password,sexstatus,dob,session,bgroup,deptname,fname,hostel,hostelid,mname,gname,nationality,praddress,peraddress,religion,phone,img,opby,opdate,storedstatus,batch,semester)
	                VALUES('$stdf','$stdname','$password','$sexstatus','$dob','$session','$bgroup','$deptname','$fname','$hostel','$hostelid','$mname','$gname','$nationality','$praddress',
								 '$peraddress',
								 '$religion',
								 '$phone','$a','$_SESSION[userid]','".date("Y-m-d")."','I','$batch','$semester')";						 
	                $sin=$myDb->insert_sql($ins);
	                $msg="Insert educational qualification please";
					header("Location:add_edq.php?msg=$msg");
				 }	
             break;
	      default:
			 $mxid=$mrw['mid']+1;
			 $stdf=$std.$dp.$ses.$mxid;
			    if($_FILES[img][tmp_name]==""){


			        $ins="INSERT INTO tbl_stdinfo(stdid,stdname,password,sexstatus,dob,session,bgroup,deptname,fname,hostel,hostelid,mname,gname,nationality,praddress,peraddress,religion,phone,opby,opdate,storedstatus,batch,semester)
	                VALUES('$stdf','$stdname','$password','$sexstatus','$dob','$session','$bgroup','$deptname','$fname','$hostel','$hostelid','$mname','$gname','$nationality','$praddress',
								 '$peraddress',
								 '$religion',
								 '$phone','$_SESSION[userid]','".date("Y-m-d")."','I','$batch','$semester')";						 
	                $sin=$myDb->insert_sql($ins);
	                $msg="Insert educational qualification please";
					header("Location:add_edq.php?msg=$msg");
				 }else{	
			        copy($_FILES[img][tmp_name],"uploads/".$a);			 
			        $ins="INSERT INTO tbl_stdinfo(stdid,stdname,password,sexstatus,dob,session,bgroup,deptname,fname,hostel,hostelid,mname,gname,nationality,praddress,peraddress,religion,phone,img,opby,opdate,storedstatus,batch,semester)
	                VALUES('$stdf','$stdname','$password','$sexstatus','$dob','$session','$bgroup','$deptname','$fname','$hostel','$hostelid','$mname','$gname','$nationality','$praddress',
								 '$peraddress',
								 '$religion',
								 '$phone','$a','$_SESSION[userid]','".date("Y-m-d")."','I','$batch','$semester')";						 
	                $sin=$myDb->insert_sql($ins);
	                $msg="Insert educational qualification please";
					header("Location:add_edq.php?msg=$msg");
				 }	
	   } 	  
     }	
	
	
	
      //$query="SELECT * FROM tbl_stdinfo order by id asc";
		//	    $sdep=$myDb->dump_query($query,'edit_stdinfo.php','del_stdinfo.php',$car['upd'],$car['delt']);
    
	
	//////////////////////////////////////////////////////////////HOSTEL NOT NULL HERE////////////////////////////////////////////
	}else{
	    $mx="SELECT cast( ifnull( max( substr( stdid, 8, 3 ) ) , 0 ) AS signed int ) mid FROM tbl_stdinfo WHERE hostel='' AND session='$session' AND deptname='$deptname'";
	 
	 
	    $mr=$myDb->select($mx);
        $mrw=$myDb->get_row($mr,'MYSQL_ASSOC');
        $dp=substr($deptn,0,3);
        $ses=$session;
        //$stdf=$std.$dp.$ses."000".$mrw['mid'];
     
	    if($mrw['mid']=="0"){
	       $len="select length(cast( ifnull( max( substr(stdid, 8, 3 ) ) , 0 ) AS signed int )) len from tbl_stdinfo WHERE hostel='' AND session='$session' AND deptname='$deptname'";
	       $ql=$myDb->select($len);
	       $lrw=$myDb->get_row($ql,'MYSQL_ASSOC');
	 
	       switch($lrw['len']){
	       case 1:
             //$stdf=$std.$dp.$ses."00".$mrw['mid']+1;
			 $mxid=$mrw['mid']+1;
			 $stdf=$dp.$ses."00".$mxid;
			    if($_FILES[img][tmp_name]==""){


			        $ins="INSERT INTO tbl_stdinfo(stdid,stdname,password,sexstatus,dob,session,bgroup,deptname,fname,mname,gname,nationality,praddress,peraddress,religion,phone,opby,opdate,storedstatus,batch,semester)
	                VALUES('$stdf','$stdname','$password','$sexstatus','$dob','$session','$bgroup','$deptname','$fname','$mname','$gname','$nationality','$praddress',
								 '$peraddress',
								 '$religion',
								 '$phone','$_SESSION[userid]','".date("Y-m-d")."','I','$batch','$semester')";						 
	                $sin=$myDb->insert_sql($ins);
	                $msg="Insert educational qualification please";
					header("Location:add_edq.php?msg=$msg");
				 }else{	
			        copy($_FILES[img][tmp_name],"uploads/".$a);			 
			        $ins="INSERT INTO tbl_stdinfo(stdid,stdname,password,sexstatus,dob,session,bgroup,deptname,fname,mname,gname,nationality,praddress,peraddress,religion,phone,img,opby,opdate,storedstatus,batch,semester)
	                VALUES('$stdf','$stdname','$password','$sexstatus','$dob','$session','$bgroup','$deptname','$fname','$mname','$gname','$nationality','$praddress',
								 '$peraddress',
								 '$religion',
								 '$phone','$a','$_SESSION[userid]','".date("Y-m-d")."','I','$batch','$semester')";						 
	                $sin=$myDb->insert_sql($ins);
	                $msg="Insert educational qualification please";
					header("Location:add_edq.php?msg=$msg");
				 }	

		     break;
	      case 2:
	         $stdf=$dp.$ses."0".$mrw['mid']+1;
             break;
	      default:
	         $stdf=$dp.$ses.$mrw['mid']+1;
	     } 	  
	  }else{
	    $len="select length(cast( ifnull( max( substr( stdid, 8, 3 ) ) , 0 ) AS signed int )) len from tbl_stdinfo WHERE hostel='' AND session='$session' AND deptname='$deptname'";
	    $ql=$myDb->select($len);
	    $lrw=$myDb->get_row($ql,'MYSQL_ASSOC');
	 
	    switch($lrw['len']){
	      case 1:
			 $mxid=$mrw['mid']+1;
			 if($mxid==10){
			    $stdf=$dp.$ses."0".$mxid;
		     }else{
			    $stdf=$dp.$ses."00".$mxid;
			 }	
			    if($_FILES[img][tmp_name]==""){


			        $ins="INSERT INTO tbl_stdinfo(stdid,stdname,password,sexstatus,dob,session,bgroup,deptname,fname,mname,gname,nationality,praddress,peraddress,religion,phone,opby,opdate,storedstatus,batch,semester)
	                VALUES('$stdf','$stdname','$password','$sexstatus','$dob','$session','$bgroup','$deptname','$fname','$mname','$gname','$nationality','$praddress',
								 '$peraddress',
								 '$religion',
								 '$phone','$_SESSION[userid]','".date("Y-m-d")."','I','$batch','$semester')";						 
	                $sin=$myDb->insert_sql($ins);
	                $msg="Insert educational qualification please";
					header("Location:add_edq.php?msg=$msg");
				 }else{	
			        copy($_FILES[img][tmp_name],"uploads/".$a);			 
			        $ins="INSERT INTO tbl_stdinfo(stdid,stdname,password,sexstatus,dob,session,bgroup,deptname,fname,mname,gname,nationality,praddress,peraddress,religion,phone,img,opby,opdate,storedstatus,batch,semester)
	                VALUES('$stdf','$stdname','$password','$sexstatus','$dob','$session','$bgroup','$deptname','$fname','$mname','$gname','$nationality','$praddress',
								 '$peraddress',
								 '$religion',
								 '$phone','$a','$_SESSION[userid]','".date("Y-m-d")."','I','$batch','$semester')";						 
	                $sin=$myDb->insert_sql($ins);
	                $msg="Insert educational qualification please";
					header("Location:add_edq.php?msg=$msg");
				 }	
	 	     break;
	      case 2:
			 $mxid=$mrw['mid']+1;
			 if($mxid==100){
			    $stdf=$dp.$ses.$mxid;
		     }else{
			    $stdf=$dp.$ses."0".$mxid;
			 }	
			    if($_FILES[img][tmp_name]==""){


			        $ins="INSERT INTO tbl_stdinfo(stdid,stdname,password,sexstatus,dob,session,bgroup,deptname,fname,mname,gname,nationality,praddress,peraddress,religion,phone,opby,opdate,storedstatus,batch,semester)
	                VALUES('$stdf','$stdname','$password','$sexstatus','$dob','$session','$bgroup','$deptname','$fname','$mname','$gname','$nationality','$praddress',
								 '$peraddress',
								 '$religion',
								 '$phone','$_SESSION[userid]','".date("Y-m-d")."','I','$batch','$semester')";						 
	                $sin=$myDb->insert_sql($ins);
	                $msg="Insert educational qualification please";
					header("Location:add_edq.php?msg=$msg");
				 }else{	
			        copy($_FILES[img][tmp_name],"uploads/".$a);			 
			        $ins="INSERT INTO tbl_stdinfo(stdid,stdname,password,sexstatus,dob,session,bgroup,deptname,fname,mname,gname,nationality,praddress,peraddress,religion,phone,img,opby,opdate,storedstatus,batch,semester)
	                VALUES('$stdf','$stdname','$password','$sexstatus','$dob','$session','$bgroup','$deptname','$fname','$mname','$gname','$nationality','$praddress',
								 '$peraddress',
								 '$religion',
								 '$phone','$a','$_SESSION[userid]','".date("Y-m-d")."','I','$batch','$semester')";						 
	                $sin=$myDb->insert_sql($ins);
	                $msg="Insert educational qualification please";
					header("Location:add_edq.php?msg=$msg");
				 }	
             break;
	      default:
			 $mxid=$mrw['mid']+1;
			 $stdf=$dp.$ses.$mxid;
			    if($_FILES[img][tmp_name]==""){


			        $ins="INSERT INTO tbl_stdinfo(stdid,stdname,password,sexstatus,dob,session,bgroup,deptname,fname,mname,gname,nationality,praddress,peraddress,religion,phone,opby,opdate,storedstatus,batch,semester)
	                VALUES('$stdf','$stdname','$password','$sexstatus','$dob','$session','$bgroup','$deptname','$fname','$mname','$gname','$nationality','$praddress',
								 '$peraddress',
								 '$religion',
								 '$phone','$_SESSION[userid]','".date("Y-m-d")."','I','$batch','$semester')";						 
	                $sin=$myDb->insert_sql($ins);
	                $msg="Insert educational qualification please";
					header("Location:add_edq.php?msg=$msg");
				 }else{	
			        copy($_FILES[img][tmp_name],"uploads/".$a);			 
			        $ins="INSERT INTO tbl_stdinfo(stdid,stdname,password,sexstatus,dob,session,bgroup,deptname,fname,mname,gname,nationality,praddress,peraddress,religion,phone,img,opby,opdate,storedstatus,batch,semester)
	                VALUES('$stdf','$stdname','$password','$sexstatus','$dob','$session','$bgroup','$deptname','$fname','$mname','$gname','$nationality','$praddress',
								 '$peraddress',
								 '$religion',
								 '$phone','$a','$_SESSION[userid]','".date("Y-m-d")."','I','$batch','$semester')";						 
	                $sin=$myDb->insert_sql($ins);
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
			        
			    if($_FILES[img][tmp_name]==""){


			        $ins="INSERT INTO tbl_stdinfo(exstid,stdname,password,sexstatus,dob,session,bgroup,deptname,fname,hostel,hostelid,mname,gname,nationality,praddress,peraddress,religion,phone,opby,opdate,storedstatus,batch,semester)
	                VALUES('$exstid','$stdname','$password','$sexstatus','$dob','$session','$bgroup','$deptname','$fname','$hostel','$hostelid','$mname','$gname','$nationality','$praddress',
								 '$peraddress',
								 '$religion',
								 '$phone','$_SESSION[userid]','".date("Y-m-d")."','I','$batch','$semester')";						 
	                $sin=$myDb->insert_sql($ins);
	                $msg="Insert educational qualification please";
					header("Location:add_edq.php?msg=$msg");
				 }else{	
			        copy($_FILES[img][tmp_name],"uploads/".$a);			 
			        $ins="INSERT INTO tbl_stdinfo(exstid,stdname,password,sexstatus,dob,session,bgroup,deptname,fname,hostel,hostelid,mname,gname,nationality,praddress,peraddress,religion,phone,img,opby,opdate,storedstatus,batch,semester)
	                VALUES('$exstid','$stdname','$password','$sexstatus','$dob','$session','$bgroup','$deptname','$fname','$hostel','$hostelid','$mname','$gname','$nationality','$praddress',
								 '$peraddress',
								 '$religion',
								 '$phone','$a','$_SESSION[userid]','".date("Y-m-d")."','I','$batch','$semester')";						 
	                $sin=$myDb->insert_sql($ins);
	                $msg="Insert educational qualification please";
					header("Location:add_edq.php?msg=$msg");
				 }	
					
 }
 
 
 }


   }else{
     $msg="Sorry,you are not authorized to access this page";
	 header("Location:home.php?msg=$msg");
   }	 

}else{
  header("Location:login.php");
}
}  
?>
