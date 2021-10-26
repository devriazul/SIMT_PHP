<?php ob_start();
session_start();

include('../config.php'); 
if($myDb->connectDefaultServer())
{  
  $uname=mysql_real_escape_string($_POST['uname']);
  $password=mysql_real_escape_string(md5($_POST['password']));
  


  $query="SELECT*FROM tbl_login WHERE userid='$uname' AND password='$password'";
     $r=$myDb->select($query);
	 echo "<span style='font-family:Verdana, Arial, Helvetica, sans-serif; font-size:14px; color:#FF0000; font-weight:bold;'>User ID & Password not match!<a href='index.php'>tye latter</a></span>";  
	 while($row=$myDb->get_row($r,'MYSQL_ASSOC')){
     if($row['userid']!=""){
        $aq="SELECT*FROM tbl_access WHERE id='$row[accid]'";
        $a=$myDb->select($aq);
	    $arow=$myDb->get_row($a,'MYSQL_ASSOC');


	    if($arow['id']==$row['accid']){
		    switch($arow['accname']){
		    
		       case "Administrator":
                     $_SESSION['userid']=$row['userid'];
                     $_SESSION['al']=$arow['accname'];
		             header("Location:home.php");
				     break;
		       case "Settings":
                     $_SESSION['userid']=$row['userid'];
                     $_SESSION['al']=$arow['accname'];
		             header("Location:home.php");
				     break;
		       case "Examination":
                     $_SESSION['userid']=$row['userid'];
                     $_SESSION['al']=$arow['accname'];
		             header("Location:home.php");
				     break;
		       case "Manage Users":
                     $_SESSION['userid']=$row['userid'];
                     $_SESSION['al']=$arow['accname'];
		             header("Location:home.php");
				     break;
		       case "Human Resource":
                     $_SESSION['userid']=$row['userid'];
                     $_SESSION['al']=$arow['accname'];
		             header("Location:home.php");
				     break;
		       case "Hostel":
                     $_SESSION['userid']=$row['userid'];
                     $_SESSION['al']=$arow['accname'];
		             header("Location:home.php");
				     break;
		       case "Notice Board":
                     $_SESSION['userid']=$row['userid'];
                     $_SESSION['al']=$arow['accname'];
		             header("Location:home.php");
				     break;
		       case "Student Module":
                     $_SESSION['userid']=$row['userid'];
                     $_SESSION['al']=$arow['accname'];
		             header("Location:home.php");
				     break;
		       case "Result Processing":
                     $_SESSION['userid']=$row['userid'];
                     $_SESSION['al']=$arow['accname'];
		             header("Location:home.php");
				     break;
		       case "Accounts":	
                     $_SESSION['userid']=$row['userid'];
                     $_SESSION['al']=$arow['accname'];
		             header("Location:home.php");
				     break;
		       case "Inventroy":	
                     $_SESSION['userid']=$row['userid'];
                     $_SESSION['al']=$arow['accname'];
		             header("Location:home.php");
				     break;
		       case "Library Management":	
                     $_SESSION['userid']=$row['userid'];
                     $_SESSION['al']=$arow['accname'];
		             header("Location:home.php");
				     break;
		       case "EmployeeAccounts":	
                     $_SESSION['userid']=$row['userid'];
                     $_SESSION['al']=$arow['accname'];
		             header("Location:attndsuccess.php");
				     break;
		       case "Teacher":	
                     $_SESSION['userid']=$row['userid'];
                     $_SESSION['al']=$arow['accname'];
		             header("Location:attndsuccess.php");
				     break;
		       case "Academic":	
                     $_SESSION['userid']=$row['userid'];
                     $_SESSION['al']=$arow['accname'];
		             header("Location:academichome.php");
				     break;
		       case "Schedule":	
                     $_SESSION['userid']=$row['userid'];
                     $_SESSION['al']=$arow['accname'];
		             header("Location:schedulehome.php");
				     break;
			   default:
	                 $msg="Your access not matched with user table".$arow['accname']."\t";
	                 header("Location:login.php?msg=$msg");
		     }		
		
          }else{
	         $msg="Your access not matched with user table";
	         header("Location:login.php?msg=$msg");
          }
	 		
	   }
   	   }
}

?>    