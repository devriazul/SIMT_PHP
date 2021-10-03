<?php ob_start();
session_start();
require_once('dbClass.php');
include("config.php"); 
if($myDb->connect($host,$user,$pwd,$db,true))
{ 
  if($_SESSION['userid']){
  $chka="SELECT*FROM  tbl_accdtl WHERE flname='manage_voucher.php' AND userid='$_SESSION[userid]'";
  $caq=$myDb->select($chka);
  $car=$myDb->get_row($caq,'MYSQL_ASSOC');
  if($car['ins']=="y"){
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Untitled Document</title>
<style type="text/css">

  td{
     border-bottom:1px dashed #999999;
  }	 
.style8 {color: #333333; font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 12px;padding:5px;padding-top:4px;
	    }
.rep-table{

  padding-left:150px;
  margin-left:10px;
}  
.style10 {font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 10px; }
</style>
</head>

<body>
<table width="900" border="0" cellspacing="0" cellpadding="0" class="rep-table">
  <tr>    <td bgcolor="#CCCCCC"><div align="left"><strong><span class="style8"> Name</span></strong></div></td>

    <td bgcolor="#CCCCCC" class="style8"><div align="center"><strong><span class="style8">Written Down <br />
      Value at the<br /> 
      Begining of <br />
    The Year </span></strong></div></td>
    <td bgcolor="#CCCCCC"><div align="center"><strong><span class="style8">Addition During <br />
    The year </span></strong></div></td>
    <td bgcolor="#CCCCCC"><div align="center"><strong><span class="style8">Balance<br />
    The year </span></strong></div></td>
    <td bgcolor="#CCCCCC"><div align="center"><strong><span class="style8">Total</span></strong></div></td>
    <td bgcolor="#CCCCCC"><div align="center"><strong><span class="style8">Rate</span></strong></div></td>
    <td bgcolor="#CCCCCC"><div align="center"><strong><span class="style8">Depriciation <br />
    For this year</span></strong></div></td>
    <td bgcolor="#CCCCCC" class="style8"><div align="center"><strong><span class="style8">Written Down <br />
      Value end<br /> 
      Of the Year <br />
    The Year </span></strong></div></td>
  </tr>
  <?php $tmp=$myDb->select("select distinct groupname from tbl_2ndjournal where groupname
							  IN (SELECT id
								  FROM tbl_accchart
								  WHERE parentid IN (SELECT id
													 FROM tbl_accchart
													 
													 WHERE accname = 'Fixed Assets'
								))
						  ");
	  while($tmpf=$myDb->get_row($tmp,'MYSQL_ASSOC')){
	  
	  
       
	  
	  
	  $fv=$myDb->select("SELECT (select accname from tbl_accchart where id='$tmpf[groupname]') 'Account Name',
	                            (select ifnull(sum(amountcr),0) 
								 from tbl_2ndjournal 
								 where vdate<'2013-04-15'
								 and groupname='$tmpf[groupname]'
								 ) 'balance previous',(select ifnull(sum(amountcr),0) 
								 from tbl_2ndjournal 
								 where vdate between '2013-04-15' and '2013-06-15'
								 and groupname='$tmpf[groupname]'
								 ) 'Addition'
	                            
											FROM tbl_2ndjournal      
											WHERE groupname='$tmpf[groupname]'
											
				");
$fvf=$myDb->get_row($fv,'MYSQL_ASSOC');
  ?>				  		
  <tr>    <td height="30"><div align="left" class="style10"><?php echo $fvf['Account Name']; ?></div></td>

    <td height="30"><div align="center" class="style10"><?php echo $fvf['balance previous']; ?></div></td>
    <td height="30"><div align="center" class="style10"><?php echo $fvf['Addition']; ?></div></td>
    <td height="30"><div align="center" class="style10"></div></td>
    <td height="30"><div align="center" class="style10"></div></td>
    <td height="30"><div align="center" class="style10"></div></td>
	<td height="30"><div align="center" class="style10"></div></td>
    <td height="30"><div align="center" class="style10"></div></td>
  </tr>
  <?php } ?>
</table>
</body>
</html>
<?php 
   }else{
     $msg="Sorry,you are not authorized to access this page";
	 header("Location:home.php?msg=$msg");
   }	 

}else{
  header("Location:login.php");
}
}  
?>