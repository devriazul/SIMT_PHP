<?php ob_start();
session_start();
require_once('dbClass.php');
include("config.php"); 
include('inwordfinal.php');

if($myDb->connect($host,$user,$pwd,$db,true))
{ 
  if($_SESSION['userid']){
	
	
  	$vs="SELECT *  FROM tbl_stdtestimonial WHERE stdid='$_GET[stdid]' and storedstatus<>'D'";
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
      border-top:1px dashed #CCCCCC;
  }	
  #td-line-bottom{
      border-bottom:1px dashed #CCCCCC;
  }
  #td-line-left{
        border-top:1px dashed #CCCCCC;

      border-left:1px dashed #CCCCCC;
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
body {
	margin-left: 0px;
	margin-top: 0px;
	margin-right: 0px;
	margin-bottom: 0px;
}
.style10 {
	font-family: "Certificate Script";
	font-size:25px;
	font-weight:bold;
}

.style14 {
	font-family: "Certificate Script";
	font-size:20px;
}

.style12 {
	font-family: "Certificate Script";
	font-size:25px;
	font-weight:bold;
}


.style11 {color:#FFFFFF}
</style>
</head>

<body>
<div style="margin-left:50px;padding-left:100px; width:70%">
<table width="831" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td height="30" colspan="2" align="center" >  
  </tr>
  <tr>
    <td height="25" colspan="2" align="center" >  
  </tr>
  <tr>
    <td height="25" colspan="2" align="center" >  
  </tr>
  <tr>
    <td height="30" colspan="2" align="center" >  
  </tr>
  <tr>
    <td height="99" colspan="2" align="center" valign="middle" >  
      <div align="left"> 
        <p><span class="style11">..........</span><?php echo $row['slno'];?></p>
        <table width="582" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td width="582" height="32" valign="bottom"><div align="right"></div></td>
          </tr>
        </table>
      </div>    </tr>
  <tr>
    <td colspan="2" align="center"><div align="left">
      <table width="100%" border="0" cellspacing="0" cellpadding="1">
        <tr valign="top">
          <td height="33" colspan="2"><span class="style10"></span></td>
          <td colspan="4"><span class="style10"><?php echo $row['stdname'];?></span></td>
          <td colspan="2"><span class="style10"><?php echo $row['fname'];?></span></td>
        </tr>
        <tr valign="top">
          <td height="32" colspan="2"><span class="style10"></span></td>
          <td colspan="2"><span class="style10"><?php echo $row['mname'];?></span></td>
          <td colspan="2"><span class="style10"></span></td>
          <td width="3%"></td>
          <td width="33%"><span class="style10"><?php echo $row['department'];?></span></td>
        </tr>
        <tr valign="top">
          <td colspan="2"><span class="style10"></span></td>
          <td width="8%"></td>
          <td width="23%"><div align="left" class="style10"></div>            
            <span class="style10"><?php echo $row['session'];?></span></td>
          <td colspan="2"><span class="style10"></span></td>
          <td></td>
          <td><div align="left" class="style10"><?php echo $row['department'];?></div></td>
        </tr>
        <tr valign="top">
          <td colspan="2"><span class="style10"></span></td>
          <td colspan="2"><span class="style10"></span></td>
          <td width="3%"></td>
          <td width="13%"><div align="left" class="style10"></div>            
            <span class="style10"><?php echo $row['rollno'];?></span></td>
          <td colspan="2"><div align="center" class="style10"><?php echo $row['regino'];?></div></td>
        </tr>
        <tr valign="top">
          <td width="5%" height="31"></td>
          <td width="12%"><div align="left" class="style14"><?php echo $row['session'];?></div></td>
          <td colspan="2"><div align="right"><span class="style12"><?php echo $row['cgpa'];?></span></div></td>
          <td colspan="2"><div align="left" class="style10"></div></td>
          <td colspan="2"><span class="style10"></span></td>
        </tr>
        <tr valign="top">
          <td colspan="2"><span class="style10"></span></td>
          <td colspan="2"><div align="right"> <span class="style14"><?php echo $row['dob'];?></span></div></td>
          <td colspan="2"></td>
          <td colspan="2"><span class="style10"></span></td>
        </tr>
        <tr valign="top">
          <td colspan="2"><span class="style10"></span></td>
          <td colspan="2"><span class="style10"></span></td>
          <td colspan="2"><span class="style10"></span></td>
          <td colspan="2"><span class="style10"></span></td>
        </tr>
        <tr valign="top">
          <td height="53" colspan="8"><span class="style10"></span></td>
          </tr>
        <tr valign="top">
          <td colspan="2"><span class="style10"></span></td>
          <td></td>
          <td><div align="left"><span class="style10"><?php echo $row['department'];?></span></div></td>
          <td colspan="2"><span class="style10"></span></td>
          <td colspan="2"><span class="style10"></span></td>
        </tr>
        <tr>
          <td colspan="2">&nbsp;</td>
          <td colspan="2">&nbsp;</td>
          <td colspan="2">&nbsp;</td>
          <td colspan="2">&nbsp;</td>
        </tr>
      </table>
    </div></td>
  </tr>
  <tr>
    <td colspan="2" align="left">&nbsp;	</td>
  </tr>
  <tr>
    <td colspan="2" align="center">&nbsp;</td>
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
