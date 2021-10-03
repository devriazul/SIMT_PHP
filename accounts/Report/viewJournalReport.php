<?php ob_start();
session_start();
require_once('../dbClass.php');
include('../inword2.php');
include("../config.php"); 
if($myDb->connect($host,$user,$pwd,$db,true))
{ 
  if($_SESSION['userid']){
  $chka="SELECT*FROM  tbl_accdtl WHERE flname='manage_voucher.php' AND userid='$_SESSION[userid]'";
  $caq=$myDb->select($chka);
  $car=$myDb->get_row($caq,'MYSQL_ASSOC');
  if($car['ins']=="y"){
  if(isset($_GET['voucherid'])){
    $voucherid=mysql_real_escape_string(!empty($_GET['voucherid'])?$_GET['voucherid']:'');
  }else{
    $voucherid=mysql_real_escape_string(!empty($_POST['searchid'])?$_POST['searchid']:'');
  }
  //$fdate=mysql_real_escape_string($_POST['fdate']);
  //$tdate=mysql_real_escape_string($_POST['tdate']);
	  $prdq=$myDb->select("select*from tbl_masterjournal where opby='$_SESSION[userid]' and voucherid='$voucherid'  order by accountno asc");
	  $prdr=mysql_num_rows($prdq);
	  if(empty($page)){
	    $page=1;
	  }	
	  $page -=1;
	  $perpage=2;
	  $totalPage=ceil($prdr/$perpage);
?>

<title><?php include("title.php");?></title>
<style type="text/css">
@import url("../main.css");
 .pagebreak{
     page-break-before:always;
}	 

</style>

<style type="text/css" media="screen">
  #header{
  font: normal 13px "Lucida Grande", "Trebuchet MS", Verdana, Helvetica, sans-serif;
  }	
  #sub-header{
  font: normal 13px "Lucida Grande", "Trebuchet MS", Verdana, Helvetica, sans-serif;
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
	  font: normal 13px "Lucida Grande", "Trebuchet MS", Verdana, Helvetica, sans-serif;

     padding-left:5px;
  }
  #right-most{
  font: normal 13px "Lucida Grande", "Trebuchet MS", Verdana, Helvetica, sans-serif;

     padding-left:15px;
  }
  .heading{
  font: normal 13px "Lucida Grande", "Trebuchet MS", Verdana, Helvetica, sans-serif;
   }
   table td{
     padding:5px;
   }	 
.style18 {color: #FFFFFF; font-style: italic; }
.style20 {font: normal 13px "Lucida Grande", "Trebuchet MS", Verdana, Helvetica, sans-serif; font-style: italic; }
</style>
<?php	  
/*$i=1;
while($i<=$totalPage){
  $x=$i-1;
  $start=$x*$perpage;		
  if($i>=0){
*/
?>
<div class="pagebreak">

<div style="margin:0 auto;width:70%">
<span style="text-align:center;"><?php include("report_head.php"); ?></span>
<h2 align="center"><span style="text-align:center;">Voucher Report</span></h2>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  
  <tr>
    <td align="center"><?php 
	                                    //echo "From:".mysql_real_escape_string($_POST['fdate'])."   "."To:".mysql_real_escape_string($_POST['tdate']);					
										 
	                              ?></td>
  </tr>
  <tr>
    <td align="center">
	
<table width="98%" border="0" cellspacing="0" cellpadding="0">
      
      <tr>
        <td width="72%" height="30" bgcolor="#0033FF" id="td-line-top"><span class="style18" id="sub-header">Particulars</span></td>
    <?php $vrec=$myDb->select("SELECT*,
	                                (SELECT SUM(amountdr) 
									 FROM tbl_2ndjournal 
									 WHERE voucherid='$voucherid' 
									 AND opby='$_SESSION[userid]'
									 and groupname!=4270
									 )totaldr,
                                    (SELECT SUM(amountcr) 
									 FROM tbl_2ndjournal 
									 WHERE voucherid='$voucherid' 
									 AND opby='$_SESSION[userid]'
									 and groupname!=4270
									 )totalcr 			
	                             FROM tbl_2ndjournal 
								 WHERE voucherid='$voucherid'  
								 and masteraccno=0
								 and groupname!=4270");
	      $vrecf=$myDb->get_row($vrec,'MYSQL_ASSOC');
	  ?>			
	 	
		<td width="14%" height="30" bgcolor="#0033FF" id="td-line-left"><span class="style18" id="sub-header">Dr</span></td>
        <td width="14%" bgcolor="#0033FF" id="td-line-left"><span class="style18" id="sub-header">Cr</span></td>
	  </tr>
	  <?php $ms=$myDb->select("select*from tbl_masterjournal where opby='$_SESSION[userid]' and voucherid='$voucherid'  order by accountno asc");
	  while($msf=$myDb->get_row($ms,'MYSQL_ASSOC')){
	  ?>
      <tr>
        <td height="30" bgcolor="#CCCCFF" id="td-line-top"><span class="style20">
          Date:<?php echo $msf['voucherdate']; ?>/VoucherID:<?php echo $msf['voucherid'];  ?></span></td>
        <td height="30" bgcolor="#CCCCFF" id="td-line-left">&nbsp;</td>
        <td height="30" bgcolor="#CCCCFF" id="td-line-left">&nbsp;</td>
      </tr>
	 	
     
	  <?php $trec=$myDb->select("SELECT*					  
								  FROM tbl_2ndjournal 
								  WHERE voucherid='$voucherid'  
								  
								  and opby='$_SESSION[userid]'
								  and voucherid='$msf[voucherid]'
								  and groupname!=4270
								 
								  ");
	     
		   
           while($trecf=$myDb->get_row($trec,'MYSQL_ASSOC')){		  
               
	  ?>
		<td height="30" id="td-line-top"><?php  echo "<span id='right-most'>".$trecf['accname']."</span>"; ?></td>
        <td height="30" valign="top" id="td-line-left"><span id="align-right"><?php echo $trecf['amountdr']; 											   
														  ?></span></td>
        <td height="30" valign="top" id="td-line-left"><span id="align-right"><?php echo $trecf['amountcr']; 											   
														  ?></span></td>
	  </tr>
	  <?php } ?>
	  <tr>
	    <td id="td-line-top"><div style='margin-left:30px;margin-bottom:10px;font: italic 13px "Lucida Grande", "Trebuchet MS", Verdana, Helvetica, sans-serif;'><?php echo $msf['voucherexpl']; ?></div></td>
	    <td id="td-line-top">&nbsp;</td>
	    <td id="td-line-top">&nbsp;</td>
	  </tr>
	  <?php } ?>
<tr>
  <td height="30" id="td-line-top">&nbsp;</td>
  <td height="30" id="td-line-left" style="border-top:1px solid #999999; border-bottom:4px double #999999; "><strong><em>Dr</em></strong></td>
  <td height="30" id="td-line-left" style="border-top:1px solid #999999;border-bottom:4px double #999999; "><strong><em>Cr</em></strong></td>
</tr>
<tr>
        <td height="30" id="td-line-top">&nbsp;</td>
        <td height="30" id="td-line-left" style="border-top:1px solid #999999; border-bottom:4px double #999999; "><span id="align-right"><?php 
											   echo $vrecf['totaldr'];
											 
		?></span></td>
        <td height="30" id="td-line-left" style="border-top:1px solid #999999;border-bottom:4px double #999999; "><span id="align-right"><?php 
											   echo $vrecf['totalcr'];
											 
		?></span></td>
  </tr>
	        <tr>
	          <td colspan="3" id="td-line-top" style='font: normal 15px "Lucida Grande", "Trebuchet MS", Verdana, Helvetica, sans-serif;
'><em><?php echo "Taka ".convert_number($vrecf['totalcr']); ?></em></td>
          </tr>
	        <tr>
	          <td id="td-line-top">&nbsp;</td>
	          <td colspan="2" id="td-line-top">&nbsp;</td>
</tr>	  
    </table>    </td>
  </tr>
</table>
<!--</div> 
<?php	//All page Heading(only first and last not here)	
 // }
?>





</div>-->

<?php 		

		//$i++;
	  //}	
		
?>
<!-- 
<table width="500" border="0" align="center" cellpadding="0" cellspacing="0">
<tr>
  <td height="30" id="td-line-top">&nbsp;</td>
  <td height="30" id="td-line-left" style="border-top:1px solid #999999; border-bottom:4px double #999999; "><strong><em>Dr</em></strong></td>
  <td height="30" id="td-line-left" style="border-top:1px solid #999999;border-bottom:4px double #999999; "><strong><em>Cr</em></strong></td>
</tr>
<tr>
        <td height="30" id="td-line-top">&nbsp;</td>
        <td height="30" id="td-line-left" style="border-top:1px solid #999999; border-bottom:4px double #999999; "><span id="align-right"><?php 
											   echo $vrecf['totaldr'];
											 
		?></span></td>
        <td height="30" id="td-line-left" style="border-top:1px solid #999999;border-bottom:4px double #999999; "><span id="align-right"><?php 
											   echo $vrecf['totalcr'];
											 
		?></span></td>
  </tr>
	        <tr>
	          <td colspan="3" id="td-line-top" style='font: normal 15px "Lucida Grande", "Trebuchet MS", Verdana, Helvetica, sans-serif;
'><em><?php echo "Taka ".convert_number($vrecf['totalcr']); ?></em></td>
          </tr>
	        <tr>
	          <td id="td-line-top">&nbsp;</td>
	          <td colspan="2" id="td-line-top">&nbsp;</td>
</tr></table>
-->
<?php		echo "<div align='center' style='width:800px; margin-top:80px;font-size:9px; color:#999999'>Develop By Desktop BD Ltd.12 Kawran Bazar,BDBL Bhaban(6th floor).Dhaka - 1215</div>";
?>
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
