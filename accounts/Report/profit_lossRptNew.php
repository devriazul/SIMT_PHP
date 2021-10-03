<?php ob_start();
session_start();
require_once('../dbClass.php');
include("../config.php"); 
include('../inword2.php');

if($myDb->connect($host,$user,$pwd,$db,true))
{ 
  if($_SESSION['userid']){
  $chka="SELECT*FROM  tbl_accdtl WHERE flname='add_jurnal.php' AND userid='$_SESSION[userid]'";
  $caq=$myDb->select($chka);
  $car=$myDb->get_row($caq,'MYSQL_ASSOC');
  if($car['ins']=="y"){
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title>Profit & loss statement</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
 <style type="text/css">
  .profitLoss{
    border: 1px solid #ccc;
	margin:0 auto;
	width:900px;
  }
  .profitLoss .th{
  	font-weight: bold;
  }
  
  .tdbrbl{
    border-right:1px solid #ccc;
	border-left:1px solid #ccc;
  }
  .profitLoss td{
    padding:5px;
  }	
  .bbottom{
    border-bottom:1px solid #ccc;
  }	
  .mid{
    border-left:1px solid #ccc;
	border-right: 1px solid #ccc;
  }
  
  table:last-child{
    border-bottom: none;
  }
  
  td[class="mid"]:last-child{
     border-bottom:1px solid #ccc;
  }
 </style>
</head
><body>
  <table class="profitLoss" cellpadding="0" cellspacing="0">
  	  <tr>
	  	<td class="bbottom th">Particulars</td>
		<td class="bbottom th" colspan="2">SAIC Institue Off</td>
	  </tr>
	  <?php 
	  	$qfex = $myDb->select("SELECT*FROM tbl_accchart WHERE id = 1771");
		while($qfexf = $myDb->get_row($qfex, 'MYSQL_ASSOC')){
	  
	  ?>
	  <tr>
	  	<td class="bbottom"><?php echo $qfexf['accname']; ?></td>
		<td class="bbottom"></td>
		<td class="bbottom"></td>
		<td class="mid">&nbsp;</td>
		<td class="bbottom"></td>
		<td class="bbottom"></td>
		<td class="bbottom"></td>
		
	  </tr>
	  <?php  } ?>
	<tr>
	    <td style="border-bottom: 1px solid #ccc; border-right: 1px solid #ccc; border-left: 1px solid #ccc;" colspan="2">&nbsp;</td>
    </tr>
	  
  </table>

</body>
</html>
<?php 
   }else{
     $msg="Sorry,you are not authorized to access this page";
	 header("Location:acchome.php?msg=$msg");
   }	 

}else{
  header("Location:login.html");
}
}  
?>
