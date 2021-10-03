<?php ob_start();
session_start();
require_once('../dbClass.php');
include("../config.php"); 
include('../inword2.php');

if($myDb->connect($host,$user,$pwd,$db,true))
{ 
  if($_SESSION['userid']){
  $chka="SELECT*FROM  tbl_accdtl WHERE flname='voucherEntry.php' AND userid='$_SESSION[userid]'";
  $caq=$myDb->select($chka);
  $car=$myDb->get_row($caq,'MYSQL_ASSOC');
  if($car['ins']=="y"){
  $vchid=mysql_real_escape_string($_GET['vchid']);
  $fdate=mysql_real_escape_string($_GET['fdate']);
  $tdate=mysql_real_escape_string($_GET['tdate']);
  $accno=mysql_real_escape_string($_GET['accno']);
  $scount=mysql_real_escape_string($_GET['scount']);
  $mvch=$myDb->select("select*from tbl_masterjournal where voucherid='$vchid'");
  $mvchf=$myDb->get_row($mvch,'MYSQL_ASSOC');

?>  
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title><?php include('title.php'); ?></title>
<style type="text/css">
<!--
@import url("../main.css");

-->
</style>
	<link href="../css/core.css" rel="stylesheet" type="text/css" />
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
   .logo{
    background-image:url(logo.png);
	background-position:right;
	background-repeat:no-repeat;
	height:70px;
	width:100px;
	height:88px;
	top:120px;
	left:100px;
	position:relative;
}	
  table td{
      padding:5px;
  }
	 
	
.style17 {color: #333333}
.style20 {color: #FFFFFF; font-style: italic; }
</style>
<script language type="text/javascript"> 
function handleEnter (field, event) {
		var keyCode = event.keyCode ? event.keyCode : event.which ? event.which : event.charCode;
		if (keyCode == 13) {
			var i;
			for (i = 0; i < field.form.elements.length; i++)
				if (field == field.form.elements[i])
					break;
			i = (i + 1) % field.form.elements.length;
			field.form.elements[i].focus();
			return false;
		} 
		else
		return true;
	}      
 
		 
</script>

<script language="javascript" src="../jquery.js"></script>

 <script language="javascript">
   $(document).ready(function(){
     
	 
   
   });
  
  </script>	 
  	<script language="javascript">
	 $(document).ready(function(){
	    var crval=0;
		var sumcr<?php echo $scount; ?>=0;
        $('.crv<?php echo $scount; ?>').each(function(){
		  sumcr<?php echo $scount; ?>+=parseInt(($(this).val()));
		
		});
		

		$('#sbt<?php echo $scount; ?>').focus(function(){		
			var voucherdate=$('#voucherdate').val();
			$('#supd<?php echo $scount; ?>').show();
			var drval=$('#dr<?php echo $scount; ?>').val();
			var crval=0;
			var sumcr<?php echo $scount; ?>=0;
			$('.crv<?php echo $scount; ?>').each(function(){
			  sumcr<?php echo $scount; ?>+=parseInt(($(this).val()));
			
			});
			  $.trime($('#dr<?php echo $scount; ?>').val(sumcr<?php echo $scount; ?>));
			  if(parseInt(sumcr<?php echo $scount; ?>)!=parseInt(drval)){
				alert("Debit and credit not equal");
				$('#dr<?php echo $scount; ?>').focus();
				return false;
			  
			  }
		  
		 }); 
		 
		$('#sbt<?php echo $scount; ?>').click(function(){		
			var arr=$('#jfrm<?php echo $scount; ?>').serializeArray();
			var voucherdate=$('#voucherdate<?php echo $scount; ?>').val();
			$('#supd<?php echo $scount; ?>').show();
			$.post("update_voucher.php?voucherdate="+voucherdate,arr,function(r){
			  $('#supd<?php echo $scount; ?>').html(r);
			});
		  
		 }); 
	 });
	
	</script>

</head>
<body>
<div id="1stfrm" style="width:700px; ">
<br/>
<br/>
<br/>
            <form id="jfrm<?php echo $scount; ?>" name="jfrm" method="post">
<table width="500" border="0" cellspacing="0" cellpadding="0" align="center">
  <tr>
    <td height="30" style="border-bottom:1px solid #999999; ">&nbsp;</td>
    <td height="30" colspan="2" style="border-bottom:1px solid #999999; " align="left">		
	   <input type="hidden" name="frdate" id="frdate<?php echo $scount; ?>" value="<?php echo $fdate; ?>"/>
	   <input type="hidden" name="todate" id="todate<?php echo $scount; ?>" value="<?php echo $tdate; ?>"/>
	   <input type="hidden" name="raccno" id="raccno<?php echo $scount; ?>" value="<?php echo $accno; ?>"/>
	   <input type="hidden" name="rvchid" id="rvchid<?php echo $scount; ?>" value="<?php echo $vchid; ?>"/>

	  Date: <input type="date" name="voucherdate" id="voucherdate<?php echo $scount; ?>" size="30" value="<?php echo $mvchf['voucherdate']; ?>" onkeypress="return handleEnter(this, event)" class="field field_medium" >
</td>
    </tr>
  <tr>
    <td height="30" style="border-bottom:1px solid #999999; ">Particulars</td>
    <td height="30" style="border-bottom:1px solid #999999; ">Debit</td>
    <td height="30" style="border-bottom:1px solid #999999; ">Credit</td>
  </tr>
  <?php $chead=$myDb->select("SELECT *,(select distinct voucherexpl from tbl_masterjournal where voucherid='$vchid') voucherexpl 
								FROM  `tbl_2ndjournal` 
								WHERE voucherid='$vchid' order by amountdr desc");
		$icount=0;$voucherexpl='';						
		while($cheadf=$myDb->get_row($chead,'MYSQL_ASSOC')){
		$voucherexpl=$cheadf['voucherexpl'];
  ?>			
  <tr><?php if($cheadf['amountdr']>0){ ?>
    <td> 
    <?php echo $cheadf['accname'];  ?> </td>
    <td>
	<input type="hidden" name="evid" id="evid<?php echo $scount; ?>" value="<?php echo $vchid; ?>" />	
	<input type="text" name="dr<?php echo $cheadf['accno']; ?>" id="dr<?php echo $scount; ?>" value="<?php echo $cheadf['amountdr']; ?>" onkeypress="return handleEnter(this, event)"></td>
    <?php } ?>
	<td></td>
  </tr>

  					
  <tr><?php if($cheadf['amountcr']>0){ ?>
    <td><?php echo $cheadf['accname']; ?></td>
    <td>&nbsp;</td>
    <td><input type="text" value="<?php echo $cheadf['amountcr']; ?>" name="cr<?php echo $cheadf['accno']; ?>" id="cr<?php echo $scount; ?>" class="crv<?php echo $scount; ?>" onkeypress="return handleEnter(this, event)"></td>
    <?php } ?>
  </tr>
  <?php $icount++;} ?>
  <tr>
    <td colspan="3"><textarea name="vexpl" id="vexpl<?php echo $scount; ?>" style="width:450px; "><?php echo $voucherexpl; ?></textarea></td>
    </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td><input type="button" name="Submit" value="Submit" class="submit-btn" id="sbt<?php echo $scount; ?>"></td>
  </tr>
</table>
</form>  
<div id="supd<?php echo $scount; ?>" style="margin:0 auto;display:none; width:400px; text-align:center; height:20px; padding:5px; background-color:#CCCCCC;"></div>

</div>

    	<?php  
	    //$posi=strpos($accno,'->');
		//$getacc=substr($accno,0,$posi);
		
		$ts1=mysql_query("select * from tbl_2ndjournal where accno='$accno'") or die(mysql_error());
		$tsf1=mysql_fetch_array($ts1);
		
	   ?>

<div style="margin:0 auto; width:700px;">
<div align="center" >
<table width="70%" border="0" cellspacing="0" cellpadding="0" style="padding:5px; ">
    


  <tr>
    <td style="padding-left:5px;padding-top:5px;">&nbsp;</td>
    <td height="30" colspan="2" style="padding-left:5px;padding-top:5px;">&nbsp;</td>
    <td height="30" style="padding-left:5px;padding-top:5px;">&nbsp;</td>
    <td height="30" style="padding-left:5px;padding-top:5px;">&nbsp;</td>
    <td style="padding-left:5px;padding-top:5px;"></td>
  </tr>
  <tr>
    <td bgcolor="#0066FF" style="padding-left:5px;padding-top:5px;"><span class="style20">Particulars</span></td>
    <td height="30" colspan="2" bgcolor="#0066FF" style="padding-left:5px;padding-top:5px;"><span class="style20">Voucherid</span></td>
    <td width="12%" height="30" bgcolor="#0066FF" style="padding-left:5px;padding-top:5px;"><span class="style20">Dr</span></td>
    <td width="8%" height="30" bgcolor="#0066FF" style="padding-left:5px;padding-top:5px;"><span class="style20">Cr</span></td>
    <td width="14%" bgcolor="#0066FF" style="padding-left:5px;padding-top:5px;"><span class="style20">Balance</span></td>
  </tr>	<?php  
	 
	    
		$ts=mysql_query("select * from tbl_accchart 
						 where id='$accno'") or die(mysql_error());
		$tsf=mysql_fetch_array($ts);
	?>
	<?php $sum1=0;$sum2=0;$ob1=0;$ob2=0;
		/*$cht=mysql_query("select ifnull(sum(c.amountdr),0) amountdr,ifnull(sum(c.amountcr),0) amountcr
		                    from tbl_masterjournal p
							inner join tbl_2ndjournal c
							on p.voucherid=c.voucherid
							and c.accno<>'$tsf[id]'
							and c.voucherid='$vchid'
							and c.vdate<'$fdate'
							
							") or die(mysql_error());
		*/
		
		$cht=mysql_query("select ifnull(sum(c.amountdr),0) amountdr,ifnull(sum(c.amountcr),0) amountcr
		                    from tbl_masterjournal p
							inner join tbl_2ndjournal c
							on p.voucherid=c.voucherid
							and c.accno='$tsf[id]'
							and c.voucherid='$vchid'
							and c.vdate<'$fdate'
							
							") or die(mysql_error());
		while($chtf=mysql_fetch_array($cht)){
		  // $ob1=$ob1+$tsf['ob'];
		 
		   $sum1=$sum1+$chtf['amountdr'];
		   $sum2=$sum2+$chtf['amountcr'];
		  
		
		} 
		$opvalue=(($sum1-$sum2));
	   ?>
	   
  <tr>
    <td><em>Opening Balance</em></td>
    <td width="14%"></td>
    <td width="11%"></td>
    <td></td>
    <td></td>
    <td><em>
      <?php if($opvalue<0){ echo (-($opvalue)); }else{ echo $opvalue; }  ?>
    </em></td>
  </tr>
	<?php 
        $vch=mysql_query("select distinct voucherid,vdate
		                  from tbl_2ndjournal
						  where accno='$tsf[id]'
						  and voucherid='$vchid'
						  and vdate between '$fdate' and '$tdate'
						  order by voucherid
							") or die(mysql_error());
		while($vchf=mysql_fetch_array($vch)){
	?>
  <tr bgcolor="#FBFBFB">
    <td><span class="style17">Date:<?php echo $vchf['vdate'];  ?></span></td>
    <td colspan="2"><span class="style17">VoucherID</span></td>
    <td colspan="3"><span class="style17"></span><span class="style17"></span><span class="style17"><?php echo $vchf['voucherid'];  ?></span></td>
    </tr>
	
	<?php 	$amountd=0;$amountc=0;
		$chs=mysql_query("
						  select c.accname accname,sum(c.amountdr) amountdr,sum(c.amountcr)amountcr
		                  from tbl_masterjournal p
						  inner join tbl_2ndjournal c
						  on p.voucherid=c.voucherid
						  and c.voucherid='$vchf[voucherid]'
						  and c.accno='$tsf[id]'
						  and c.vdate between '$fdate' and '$tdate'
						  group by c.accname

						  
						  UNION ALL
						  
						  select c.accname accname,sum(c.amountdr) amountdr,sum(c.amountcr)amountcr
		                  from tbl_masterjournal p
						  inner join tbl_2ndjournal c
						  on p.voucherid=c.voucherid
						  and c.voucherid='$vchf[voucherid]'
						  and c.accno<>'$tsf[id]'
						  and c.vdate between '$fdate' and '$tdate'
						  group by c.accname
							") or die(mysql_error());
		while($chsf=mysql_fetch_array($chs)){
	   ?>
  <tr>
    <td><?php if($tsf['accname']==$chsf['accname']){echo "<span style='padding-left:35px'>As per details</span></br>"; }
	if($tsf['accname']!=$chsf['accname']){echo "<span style='padding-left:35px'>".$chsf['accname']."</span></br>"; }?> 
	<?php ?>	</td>
    <td>&nbsp;</td>
    <td><?php if($tsf['accname']!=$chsf['accname']){ ?>
      <?php if($chsf['amountdr']>0){ echo "Dr.".$chsf['amountdr']; } ?>
      <?php if($chsf['amountcr']>0){ echo "Cr.".$chsf['amountcr']; } ?>
      <?php } ?></td>
    <td><?php if($tsf['accname']==$chsf['accname']){ ?>
      <?php if($chsf['amountdr']>0){ echo "Dr.".$chsf['amountdr']; } ?>
     
      <?php } ?></td>
    <td><?php if($tsf['accname']==$chsf['accname']){ ?>
      
      <?php if($chsf['amountcr']>0){ echo "Cr.".$chsf['amountcr']; } ?>
      <?php } ?></td>
    <td></td>
  </tr>
  <?php 
	
		
		}
	  
     ?>	
	<?php } ?>
<tr>
   <td align="right">&nbsp;</td>
    <td align="right">&nbsp;</td>
    <td align="right"><div align="right"></div></td>
    <td></td>
    <td></td>
    <td></td>
 </tr>
	<?php
	
	 $sum11=0;$sum22=0;$ob11=0;$ob22=0;
		$cht1=mysql_query("select ifnull(sum(c.amountdr),0) amountdr,ifnull(sum(c.amountcr),0) amountcr
		                    from tbl_masterjournal p
							inner join tbl_2ndjournal c
							on p.voucherid=c.voucherid
							and c.accno='$tsf[id]'
							and c.voucherid='$vchid'
							and c.vdate between '$fdate' and '$tdate'
        ") or die(mysql_error());
		while($chtf1=mysql_fetch_array($cht1)){
		  // $ob1=$ob1+$tsf['ob'];
		 
		   $sum11=$sum11+$chtf1['amountdr'];
		   $sum22=$sum22+$chtf1['amountcr'];
		  
		
		} 
		$opvalue1=($opvalue+($sum11-$sum22));
	   ?>   
	 
  <tr>
    <td><em>Closing Balance</em></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td></td>
    <td></td>
    <td style="border-top:3px double #999999; "><em>
      <?php if($opvalue1<=0){ echo "Dr ".(-($opvalue1)); }else{ echo "Cr ".$opvalue1; }  ?>
    </em></td>
  </tr>

 
 <tr>
   <td height="40" colspan="6" valign="middle">&nbsp;</td>
   </tr>
</table>
	   	  	
</div>
<div style="color:#999999; font-size:9px;">Developed By DesktopBd</div>

</div>
</body>
</html>


<?php 
   }else{
     $msg="Sorry,you are not authorized to access this page";
	 header("Location:acchome.php?msg=$msg");
   }	 

}else{
  header("Location:login.php");
}
}  
?>