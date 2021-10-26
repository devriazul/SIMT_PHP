<?php ob_start();
session_start();
require_once('../dbClass.php');
include("../config.php"); 
include('../inword2.php');
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
	
</style>
</head>

<body>
<div style="margin-left:50px;padding-left:100px; width:70%">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td align="center"><span id="header">SAIC INSTITUTE OF MANAGEMENT AND TECHNOLOGY</span> </td>
  </tr>
  <tr>
    <td align="center"><span id="sub-header">Road#2, House #1, Block -B, Section-6,<br />
      Mirpur, Dhaka -1216<br />
      E-Mail :simt140@gmail.com</span></td>
  </tr>
  <tr>
    <div align="center"><td height="30" align="center" id="td-line-bottom"><span id="sub-header"><?php 
	                                     $vid=$_GET['vid'];
	                                     $vtpe=$myDb->select("SELECT * FROM tbl_2ndjournal WHERE voucherid='$vid'"); 
	                                     $vtpef=$myDb->get_row($vtpe,'MYSQL_ASSOC');
										 
										 switch($vtpef['vouchertype']){
										     case "P":
											    echo "Payment Voucher";
												break;
										     case "R":
											    echo "Receive Voucher";
												break;
										     default:
											    echo "Journal Voucher";
										}						
										 
	                              ?></span>
	</div>							  
	
	</td>
  </tr>
  <tr>
    <td align="center">&nbsp;</td>
  </tr>
  <tr>
    <td align="center">
	<?php switch($vtpef['vouchertype']){
	          case "P":
    ?>			  
	
	<table width="98%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td height="30"><span id="sub-header">VoucherID:<?php echo $vid; ?></span></td>
        <td height="30" >&nbsp;</td>
      </tr>
      <tr>
        <td width="72%" height="30" id="td-line-top"><span id="sub-header"><span style="padding-left:30px;">Particulars</span></span></td>
        <td width="28%" height="30" id="td-line-left"><span id="sub-header">Amount</span></td>
      </tr>
      <tr>
        <td id="td-line-top"><span class="heading">Account:</span></td>
        <td id="td-line-left">&nbsp;</td>
      </tr>
	  <?php $vrec=$myDb->select("SELECT*FROM tbl_2ndjournal WHERE voucherid='$vid' and amountcr<>0");
	      $vrecf=$myDb->get_row($vrec,'MYSQL_ASSOC');
	  ?>		
      <tr>
        <td id="td-line-top"><span id="right-most"><?php echo $vrecf['accname']; ?></span>
		<div style="margin-top:150px;"></div>
		<?php $trec=$myDb->select("SELECT*FROM tbl_2ndjournal WHERE voucherid='$vid' and amountdr<>0");
	      $trecf=$myDb->get_row($trec,'MYSQL_ASSOC');
		   echo "<span class='heading'>Trough:</span>"."<br/>";
		   echo "<span id='right-most'>".$trecf['accname']."</span>";
		   ?>		</td>
        <td valign="top" id="td-line-left"><span id="align-right"><?php 
											   echo $vrecf['amountcr'];
											   
											   
											  
		?>		</span></td>
      </tr>
	  <tr>
	    <td id="td-line-top">&nbsp;</td>
	    <td id="td-line-top">&nbsp;</td>
	    </tr>
	  <tr>
        <td id="td-line-top">&nbsp;</td>
        <td id="td-line-left"><span id="align-right"><?php 
											   echo $vrecf['amountcr'];
											 
		?></span></td>
      </tr>
	        <tr>
	          <td colspan="2" id="td-line-top">&nbsp;</td>
          </tr>
	        <tr>
	          <td colspan="2" style="font-family:'Courier New', Courier, monospace,Verdana;font-size:12px;
"><?php echo convert_number($vrecf['amountcr']); ?></td>
          </tr>
    </table>
	<?php break;
	  case "R":
	?>  
<table width="98%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td height="30"><span id="sub-header">VoucherID:<?php echo $vid; ?></span></td>
        <td height="30" >&nbsp;</td>
      </tr>

	  <tr>
        <td width="72%" height="30" id="td-line-top"><span id="sub-header"><span style="padding-left:30px;">Particulars</span></span></td>
        <td width="28%" height="30" id="td-line-left"><span id="sub-header">Amount</span></td>
      </tr>
      <tr>
        <td id="td-line-top"><span class="heading">Account:</span></td>
        <td id="td-line-left">&nbsp;</td>
      </tr>
	  <?php $vrec=$myDb->select("SELECT*FROM tbl_2ndjournal WHERE voucherid='$vid' and amountdr<>0");
	      $vrecf=$myDb->get_row($vrec,'MYSQL_ASSOC');
	  ?>		
      <tr>
        <td id="td-line-top"><span id="right-most"><?php echo $vrecf['accname']; ?></span>
		
		<div style="margin-top:150px;"></div>
		<?php $trec=$myDb->select("SELECT*FROM tbl_2ndjournal WHERE voucherid='$vid' and amountcr<>0");
	      $trecf=$myDb->get_row($trec,'MYSQL_ASSOC');
		   echo "<span class='heading'>Trough:</span>"."<br/>";
		   echo "<span id='right-most'>".$trecf['accname']."</span>";
		   ?>		</td>
        <td valign="top" id="td-line-left"><span id="align-right"><?php 
											   echo $vrecf['amountdr'];
											  
		?>		</span></td>
      </tr>
	  <tr>
	    <td id="td-line-top">&nbsp;</td>
	    <td id="td-line-top">&nbsp;</td>
	    </tr>
	  <tr>
        <td id="td-line-top">&nbsp;</td>
        <td id="td-line-left"><span id="align-right"><?php 
											   echo $vrecf['amountdr'];
											 
		?></span></td>
      </tr>
	        <tr>
	          <td colspan="2" id="td-line-top">&nbsp;</td>
          </tr>
	        <tr>
	          <td colspan="2" style="font-family:'Courier New', Courier, monospace,Verdana;font-size:12px;
" ><?php echo convert_number($vrecf['amountdr']); ?></td>
          </tr>
    </table>
	<?php break;
       case "J":
	?>
<table width="98%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td height="30"><span id="sub-header">VoucherID:<?php echo $vid; ?></span></td>
        <td height="30" >&nbsp;</td>
      </tr>
      <tr>
        <td width="72%" height="30" id="td-line-top"><span id="sub-header"><span style="padding-left:30px;">Particulars</span></span></td>
    <?php $vrec=$myDb->select("SELECT*,
	                                (SELECT SUM(amountdr) 
									 FROM tbl_2ndjournal 
									 WHERE voucherid='$vid' 
									 AND opby='$_SESSION[userid]'
									 )totaldr,
                                    (SELECT SUM(amountcr) 
									 FROM tbl_2ndjournal 
									 WHERE voucherid='$vid' 
									 AND opby='$_SESSION[userid]'
									 )totalcr 			
	                             FROM tbl_2ndjournal 
								 WHERE voucherid='$vid'
								 and masteraccno=0 
								 ");
	      $vrecf=$myDb->get_row($vrec,'MYSQL_ASSOC');
	  ?>			
	  <?php if($vrecf['amountdr']!=0){
	  ?>	
		<td width="14%" height="30" id="td-line-left"><span id="sub-header">Dr</span></td>
        <td width="14%" id="td-line-left"><span id="sub-header">Cr</span></td>
      <?php } ?>
	  <?php if($vrecf['amountcr']!=0){
	  ?>	
		<td width="14%" height="30" id="td-line-left"><span id="sub-header">Cr</span></td>
        <td width="14%" id="td-line-left"><span id="sub-header">Dr</span></td>
      <?php } ?>
	  </tr>
      <tr>
        <td id="td-line-top"><span class="heading">Account:</span></td>
        <td id="td-line-left">&nbsp;</td>
        <td id="td-line-left">&nbsp;</td>
      </tr>
	 	
      <tr>
        <td height="30" id="td-line-top"><span id="right-most"><?php  echo $vrecf['accname']; ?></span></td>
        <td height="30" id="td-line-top"><span id="align-right"><?php if($vrecf['amountcr']==0){ echo $vrecf['amountdr']; }
                                                         											   
														  ?></span></td>
	    <td height="30" id="td-line-top"><span id="align-right"><?php 
                                                          if($vrecf['amountdr']==0){ echo $vrecf['amountcr']; }												   
														  ?></span></td>
      </tr>
	  <?php $trec=$myDb->select("SELECT*					  
								  FROM tbl_2ndjournal 
								  WHERE voucherid='$vid' 
								  and masteraccno<>0
								  and opby='$_SESSION[userid]'");
	     
		   
           while($trecf=$myDb->get_row($trec,'MYSQL_ASSOC')){		  
               
	  ?>
	  <tr>		
		<td height="30" id="td-line-top"><?php  echo "<span id='right-most'>".$trecf['accname']."</span>"; ?></td>
        <td height="30" valign="top" id="td-line-left"><span id="align-right"><?php if($trecf['amountcr']==0){ echo $trecf['amountdr']; }
                                                        											   
														  ?></span></td>
        <td height="30" valign="top" id="td-line-left"><span id="align-right"><?php 
                                                          if($trecf['amountdr']==0){ echo $trecf['amountcr']; }												   
														  ?></span></td>
	  </tr>
	  <?php } ?>
	  <tr>
	    <td id="td-line-top">&nbsp;</td>
	    <td id="td-line-top">&nbsp;</td>
	    <td id="td-line-top">&nbsp;</td>
	  </tr>
	  <tr>
        <td height="30" id="td-line-top">&nbsp;</td>
        <td height="30" id="td-line-left"><span id="align-right"><?php 
											   echo $vrecf['totaldr'];
											 
		?></span></td>
        <td height="30" id="td-line-left"><span id="align-right"><?php 
											   echo $vrecf['totalcr'];
											 
		?></span></td>
	  </tr>
	        <tr>
	          <td colspan="3" id="td-line-top">&nbsp;</td>
          </tr>
	        <tr>
	          <td colspan="3" style="font-family:'Courier New', Courier, monospace,Verdana;font-size:12px;
"><?php echo convert_number($vrecf['totalcr']); ?></td>
          </tr>
    </table>
	<?php break;
	}
	?>
    </td>
  </tr>
</table>
</div>
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
