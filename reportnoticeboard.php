<?php ob_start();
session_start();
require_once('dbClass.php');
include("config.php"); 
if($myDb->connectDefaultServer())
{ 
  if($_SESSION['userid']){
	$id=$_GET['id'];
  	$vs="SELECT * FROM `tbl_noticeboard` WHERE storedstatus<>'D' AND id='$id'";
  	$r=$myDb->select($vs);
  	$row=$myDb->get_row($r,'MYSQL_ASSOC'); 
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title><?php include("title.php");?></title>
<style type="text/css">
  #header{
        font-family:"Courier New", Courier, monospace,Verdana;
		font-size:25px;
		font-weight:bold;
  }	
  #sub-header{
        font-family:"Courier New", Courier, monospace,Verdana;
		font-size:15px;
		font-weight:bold;
  }
  #td-line-top{
      border-top:1px solid #CCCCCC;
  }	
  #td-line-bottom{
      border-bottom:1px solid #CCCCCC;
  }
  #td-line-left{
        border-top:1px solid #CCCCCC;

      border-left:1px solid #CCCCCC;
  }
  #sub-header,#align-right{
     font-family:"Courier New", Courier, monospace,Verdana;
	 font-size:15px;
	 font-weight:bold;

     padding-left:5px;
  }
  #right-most{
     font-family:"Courier New", Courier, monospace,Verdana;
	 font-size:13px;

     padding-left:15px;
  }
  .heading{
     font-family:"Courier New", Courier, monospace,Verdana;
	 font-size:15px;
   }	 
.style4 {font-family: Arial, Helvetica, sans-serif; font-size:18px;}
.style5 {
	font-size: 18px;
	font-weight: bold;
}
.style6 {
	font-family: Arial;
	font-size: 12px;
	font-weight: bold;
}
.style7 {
	font-family: Arial;
	font-size: 12px;
}

body {
	margin-top: 0px;
	margin-bottom: 0px;
	margin-left: 0px;
	margin-right: 0px;
}
</style>
</head>

<body>
<div style="margin-left:50px;padding-left:100px; width:70%">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
      <tr>
        <td width="13%" height="86">&nbsp;</td>
        <td width="87%"><p align="center">&nbsp;</p>
          </td>
      </tr>
    </table>    </tr>
  <tr>
    <td height="14" colspan="2" align="center" >    <p>&nbsp;</p>
      <p>&nbsp;</p>    </tr>
  <tr>
    <td colspan="2" align="right"><?php echo $row['description'];?></td>
  </tr>
</table>
</div>
</body>
</html>
<?php 

}else{
  header("Location:login.php");
}
}  
?>
