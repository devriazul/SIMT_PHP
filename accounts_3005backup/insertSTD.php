<?php ob_start();
session_start();
require_once('dbClass.php');
include("config.php"); 
if($myDb->connect($host,$user,$pwd,$db,true))
{ 
  if($_SESSION['userid']){
  $chka="SELECT*FROM  tbl_accdtl WHERE flname='stdinfo.php' AND userid='$_SESSION[userid]'";
  $caq=$myDb->select($chka);
  $car=$myDb->get_row($caq,'MYSQL_ASSOC');
  if($car['ins']=="y"){
?> 
<style type="text/css">
 #tdiv{
	position:absolute;
	top: -235px;
	 }
</style>
<script src="exjs.js" type="text/javascript"></script>


<table width="500" border="0" align="center" cellpadding="0" cellspacing="0" id="stdtbl">
  <tr>
    <td width="196" height="30"><span class="style11">Educational Qualification </span></td>
    <td width="18" height="30">&nbsp;</td>
    <td width="315">&nbsp;</td>
  </tr>
<form name="MyForm1" action="insertEXE.php" method="post">
  <tr>
    <td height="30" class="style2">Name of Exemination </td>
    <td height="30" class="style2">:</td>
    <td><input name="nexemination" type="text" class="style4" id="nexemination" size="50" /></td>
    </tr>
  <tr>
    <td height="30" class="style2">Group/Trade</td>
    <td height="30" class="style2">:</td>
    <td><input name="group" type="text" class="style4" id="group" size="50" /></td>
  </tr>
  <tr>
    <td height="30" class="style2">Board</td>
    <td height="30" class="style2">:</td>
    <td><input name="board" type="text" class="style4" id="board" size="50" /></td>
  </tr>
  <tr>
    <td height="30" class="style2">Pass Year </td>
    <td height="30" class="style2">:</td>
    <td><input name="passyear" type="text" class="style4" id="passyear" size="20" /></td>
  </tr>
  <tr>
    <td height="30" class="style2">Got CGPA(GM/HM/SC) </td>
    <td height="30" class="style2">:</td>
    <td><input name="cgpas" type="text" class="style4" id="cgpas" /></td>
  </tr>
  <tr>
    <td height="30" class="style2">Total CGPA </td>
    <td height="30" class="style2">:</td>
    <td><input name="tcgpa" type="text" class="style4" id="tcgpa" /></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td><input type="submit" name="Submit" value="Submit" style="color: #999999; font-size: 8pt; font-family: Verdana; border: 1px solid #C0C0C0; background-color: #D9F0FB" /></td>
    </tr>
  </form>
</table>
		  <div id="MyResult1">
</DIV>
<?php 
  if($_SERVER['REQUEST_METHOD']=="POST"){ 
  if($_POST['exstid']==""){
  $password=mysql_real_escape_string($_POST['password']);
  $sexstatus=mysql_real_escape_string($_POST['sexstatus']);
  /*$d=mysql_real_escape_string($_POST['d']);
  $m=mysql_real_escape_string($_POST['m']);
  $y=mysql_real_escape_string($_POST['y']);
  */
  $exstid=mysql_real_escape_string($_POST['exstid']);
  $dob=mysql_real_escape_string($_POST['dob']);
  $session=mysql_real_escape_string($_POST['session']);
  $bgroup=mysql_real_escape_string($_POST['bgroup']);
  $deptname=mysql_real_escape_string($_POST['deptname']);
  $fname=mysql_real_escape_string($_POST['fname']);
  $hostel=mysql_real_escape_string($_POST['hostel']);
  $mname=mysql_real_escape_string($_POST['mname']);
  $gname=mysql_real_escape_string($_POST['gname']);
  $nationality=mysql_real_escape_string($_POST['nationality']);
  $praddress=mysql_real_escape_string($_POST['praddress']);
  $peraddress=mysql_real_escape_string($_POST['peraddress']);
  $religion=mysql_real_escape_string($_POST['religion']);
  $phone=mysql_real_escape_string($_POST['phone']);
  
  if($hostel!=""){
     $mx="SELECT cast( ifnull( max( substr( stdid, 10, 3 ) ) , 0 ) AS signed int ) mid FROM tbl_stdinfo WHERE session='$session' AND deptname='$deptname'";
     $mr=$myDb->select($mx);
     $mrw=$myDb->get_row($mr,'MYSQL_ASSOC');
     $std=substr($hostel,0,2);
     $dp=substr($deptname,0,3);
     $ses=$session;
     //$stdf=$std.$dp.$ses."000".$mrw['mid'];
     
	 if($mrw['mid']=="0"){
	    $len="select length(cast( ifnull( max( substr( stdid, 10, 3 ) ) , 0 ) AS signed int )) len from tbl_stdinfo WHERE session='$session' AND deptname='$deptname'";
	    $ql=$myDb->select($len);
	    $lrw=$myDb->get_row($ql,'MYSQL_ASSOC');
	 
	    switch($lrw['len']){
	      case 1:
             //$stdf=$std.$dp.$ses."00".$mrw['mid']+1;
			 $mxid=$mrw['mid']+1;
			 $stdf=$std.$dp.$ses."00".$mxid;
			 echo "The hostel is:".$stdf;

			        $ins="INSERT INTO tbl_stdinfo(stdid,password,sexstatus,dob,session,bgroup,deptname,fname,hostel,mname,gname,nationality,praddress,peraddress,religion,phone)
	                VALUES('$stdf','$password','$sexstatus','$dob','$session','$bgroup','$deptname','$fname','$hostel','$mname','$gname','$nationality','$praddress',
								 '$peraddress',
								 '$religion',
								 '$phone')";						 
	                $sin=$myDb->insert_sql($ins);
	                $msg="Data inserted successfully";
	                echo $msg;

		     break;
	      case 2:
	         $stdf=$std.$dp.$ses."0".$mrw['mid']+1;
             break;
	      default:
	         $stdf=$std.$dp.$ses.$mrw['mid']+1;
	   } 	  
	}else{
	    $len="select length(cast( ifnull( max( substr( stdid, 10, 3 ) ) , 0 ) AS signed int )) len from tbl_stdinfo WHERE session='$session' AND deptname='$deptname'";
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
			 echo "The hostel is:".$stdf;
			        $ins="INSERT INTO tbl_stdinfo(stdid,password,sexstatus,dob,session,bgroup,deptname,fname,hostel,mname,gname,nationality,praddress,peraddress,religion,phone)
	                VALUES('$stdf','$password','$sexstatus','$dob','$session','$bgroup','$deptname','$fname','$hostel','$mname','$gname','$nationality','$praddress',
								 '$peraddress',
								 '$religion',
								 '$phone')";						 
	                $sin=$myDb->insert_sql($ins);
	                $msg="Data inserted successfully 1ab.";
	                echo $msg;
	 	     break;
	      case 2:
			 $mxid=$mrw['mid']+1;
			 if($mxid==100){
			    $stdf=$std.$dp.$ses.$mxid;
		     }else{
			    $stdf=$std.$dp.$ses."0".$mxid;
			 }	
			 echo "The hostel is:".$stdf;
			        $ins="INSERT INTO tbl_stdinfo(stdid,password,sexstatus,dob,session,bgroup,deptname,fname,hostel,mname,gname,nationality,praddress,peraddress,religion,phone)
	                VALUES('$stdf','$password','$sexstatus','$dob','$session','$bgroup','$deptname','$fname','$hostel','$mname','$gname','$nationality','$praddress',
								 '$peraddress',
								 '$religion',
								 '$phone')";						 
	                $sin=$myDb->insert_sql($ins);
	                $msg="Data inserted successfully 1abc.";
	                echo $msg;
             break;
	      default:
			 $mxid=$mrw['mid']+1;
			 $stdf=$std.$dp.$ses.$mxid;
			 echo "The hostel is:".$stdf;
			        $ins="INSERT INTO tbl_stdinfo(stdid,password,sexstatus,dob,session,bgroup,deptname,fname,hostel,mname,gname,nationality,praddress,peraddress,religion,phone)
	                VALUES('$stdf','$password','$sexstatus','$dob','$session','$bgroup','$deptname','$fname','$hostel','$mname','$gname','$nationality','$praddress',
								 '$peraddress',
								 '$religion',
								 '$phone')";						 
	                $sin=$myDb->insert_sql($ins);
	                $msg="Data inserted successfully 1abcd.";
	                echo $msg;
	   } 	  
     }	
	
	
	
      $query="SELECT * FROM tbl_stdinfo order by id asc";
			    $sdep=$myDb->dump_query($query,'edit_stdinfo.php','del_stdinfo.php',$car['upd'],$car['delt']);
    
	
	//////////////////////////////////////////////////////////////HOSTEL NOT NULL HERE////////////////////////////////////////////
	}else{
	    $mx="SELECT cast( ifnull( max( substr( stdid, 10, 3 ) ) , 0 ) AS signed int ) mid FROM tbl_stdinfo WHERE session='$session' AND deptname='$deptname'";
	 
	 
	    $mr=$myDb->select($mx);
        $mrw=$myDb->get_row($mr,'MYSQL_ASSOC');
        $dp=substr($deptname,0,3);
        $ses=$session;
        //$stdf=$std.$dp.$ses."000".$mrw['mid'];
     
	    if($mrw['mid']=="0"){
	       $len="select length(cast( ifnull( max( substr( stdid, 10, 3 ) ) , 0 ) AS signed int )) len from tbl_stdinfo session='$session' AND deptname='$deptname'";
	       $ql=$myDb->select($len);
	       $lrw=$myDb->get_row($ql,'MYSQL_ASSOC');
	 
	       switch($lrw['len']){
	       case 1:
             //$stdf=$std.$dp.$ses."00".$mrw['mid']+1;
			 $mxid=$mrw['mid']+1;
			 $stdf="NR".$dp.$ses."00".$mxid;
			 echo "The hostel is:".$stdf;

			        $ins="INSERT INTO tbl_stdinfo(stdid,password,sexstatus,dob,session,bgroup,deptname,fname,mname,gname,nationality,praddress,peraddress,religion,phone)
	                VALUES('$stdf','$password','$sexstatus','$dob','$session','$bgroup','$deptname','$fname','$mname','$gname','$nationality','$praddress',
								 '$peraddress',
								 '$religion',
								 '$phone')";						 
	                $sin=$myDb->insert_sql($ins);
	                $msg="Data inserted successfully 1ah.";
	                echo $msg;

		     break;
	      case 2:
	         $stdf="NR".$ses."0".$mrw['mid']+1;
             break;
	      default:
	         $stdf="NR".$ses.$mrw['mid']+1;
	     } 	  
	  }else{
	    $len="select length(cast( ifnull( max( substr( stdid, 10, 3 ) ) , 0 ) AS signed int )) len from tbl_stdinfo WHERE session='$session' AND deptname='$deptname'";
	    $ql=$myDb->select($len);
	    $lrw=$myDb->get_row($ql,'MYSQL_ASSOC');
	 
	    switch($lrw['len']){
	      case 1:
			 $mxid=$mrw['mid']+1;
			 if($mxid==10){
			    $stdf="NR".$dp.$ses."0".$mxid;
		     }else{
			    $stdf="NR".$dp.$ses."00".$mxid;
			 }	
			 echo "The hostel is:".$stdf;
			        $ins="INSERT INTO tbl_stdinfo(stdid,password,sexstatus,dob,session,bgroup,deptname,fname,mname,gname,nationality,praddress,peraddress,religion,phone)
	                VALUES('$stdf','$password','$sexstatus','$dob','$session','$bgroup','$deptname','$fname','$mname','$gname','$nationality','$praddress',
								 '$peraddress',
								 '$religion',
								 '$phone')";						 
	                $sin=$myDb->insert_sql($ins);
	                $msg="Data inserted successfully 1abh.";
	                echo $msg;
	 	     break;
	      case 2:
			 $mxid=$mrw['mid']+1;
			 if($mxid==100){
			    $stdf="NR".$dp.$ses.$mxid;
		     }else{
			    $stdf="NR".$dp.$ses."0".$mxid;
			 }	
			 echo "The hostel is:".$stdf;
			        $ins="INSERT INTO tbl_stdinfo(stdid,password,sexstatus,dob,session,bgroup,deptname,fname,mname,gname,nationality,praddress,peraddress,religion,phone)
	                VALUES('$stdf','$password','$sexstatus','$dob','$session','$bgroup','$deptname','$fname','$mname','$gname','$nationality','$praddress',
								 '$peraddress',
								 '$religion',
								 '$phone')";						 
	                $sin=$myDb->insert_sql($ins);
	                $msg="Data inserted successfully 1abch.";
	                echo $msg;
             break;
	      default:
			 $mxid=$mrw['mid']+1;
			 $stdf="NR".$dp.$ses.$mxid;
			 echo "The hostel is:".$stdf;
			        $ins="INSERT INTO tbl_stdinfo(stdid,password,sexstatus,dob,session,bgroup,deptname,fname,mname,gname,nationality,praddress,peraddress,religion,phone)
	                VALUES('$stdf','$password','$sexstatus','$dob','$session','$bgroup','$deptname','$fname','$mname','$gname','$nationality','$praddress',
								 '$peraddress',
								 '$religion',
								 '$phone')";						 
	                $sin=$myDb->insert_sql($ins);
	                $msg="Data inserted successfully 1abcdh.";
	                echo $msg;
	   } 	  
     }	
	
	
	
      $query="SELECT * FROM tbl_stdinfo order by id asc";
			    $sdep=$myDb->dump_query($query,'edit_stdinfo.php','del_stdinfo.php',$car['upd'],$car['delt']);
				
	 /////////////////////////////////////////HOSTEL NULL HERE/////////////////////////////////////////////////////			
	 }	
 
 
 }else{
			        $ins="INSERT INTO tbl_stdinfo(exstid,password,sexstatus,dob,session,bgroup,deptname,fname,hostel,mname,gname,nationality,praddress,peraddress,religion,phone)
	                VALUES('$exstid','$password','$sexstatus','$dob','$session','$bgroup','$deptname','$fname','$hostel','$mname','$gname','$nationality','$praddress',
								 '$peraddress',
								 '$religion',
								 '$phone')";						 
	                $sin=$myDb->insert_sql($ins);
	                $msg="Data inserted successfully";
	                echo $msg;
 }
 
 
 }
 }else{
     $msg="Sorry,you are not authorized to access this page";
 }	 

}else{
  header("Location:login.php");
}
}  
?>
