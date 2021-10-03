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
<title><?php include("title.php");?></title>





	<link type="text/css" href="css/jquery-ui-1.8.5.custom.css" rel="Stylesheet" />
<script type="text/javascript" src="jquery.js"></script>
<script type="text/javascript" src="js/jquery-1.6.2.min.js"></script>

<script type='text/javascript' src='jquery.autocomplete.js'></script>
<link rel="stylesheet" type="text/css" href="jquery.autocomplete.css" />

	<link href="css/core.css" rel="stylesheet" type="text/css" />
	<link href="main.css" rel="stylesheet" type="text/css" />
<script type="text/javascript">
$().ready(function() {
	$("#searchid").autocomplete("search_voucher.php", {
		width: 260,
		matchContains: true,
		//mustMatch: true,
		//minChars: 0,
		//multiple: true,
		//highlight: false,
		//multipleSeparator: ",",
		selectFirst: false
	});
});
</script>

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
<script type="text/javascript" language="javascript"> 
window.onload=function() {
document.forms[0][0].focus();
}
</script>
<script type="text/javascript">
$(document).ready(function(){
    	$('#submit-btn').click(function(){
	       var arr=$('#sfrm').serializeArray();
	       $.post('show_voucher.php',arr,function(data){
           	      
		      $('#v').html(data);
	       });
		    $("#v").html("<img src='loader.gif' />");
	       //$("#v").show().hide().fadeIn('slow');
	
	});
});	
</script>
<script type="text/javascript">
function toggleAndChangeText(r) {
     $('#myDiv'+r).toggle('slow');
     if ($('#myDiv'+r).css('display') == 'none') {
	     $('#aTag'+r).html('CLOSE &#9658');
     }
     else {                    
	 
	     $('#aTag'+r).html('VIEW &#9660');

     }
}


</script>
<script language="javascript" type="text/javascript">
 $(document).keyup(function(e){
	 if(e.keyCode==45){
	    $('#bothead').css({'opocity':'.02px'});
		$('#bothead').fadeTo('slow',0.9);
	  
	  
	  
	  }
	  if(e.keyCode==46){
		$('#bothead').hide();
	  
	  
	  
	  }

 });
</script>
<script language="javascript">
 $(document).keyup(function(e){
    if(e.keyCode==13){
	  return false;
	}
 
 });

</script>
</head>

<body>
<table width="1047" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td width="1047" height="152" valign="top" background="images/1.jpg"><span class="style17"><?php include("topdefault.php");?>    </span></span></td>
  </tr>
  <tr>
    <td><table width="100%" border="0" cellspacing="0" cellpadding="0" id="tblleft">
      <tr>
        <td height="28" colspan="2" bgcolor="#0C6ED1"><div align="center" class="style1">SAIC INSTITUTE OF MANAGEMENT TECHNOLOGY</div></td>
        </tr>
      <tr>
        <td background="images/leftbg.jpg"><img src="images/leftbg.jpg" width="252" height="3" /></td>
        <td><img src="images/spaer.gif" width="1" height="1" /></td>
      </tr>
      <tr>
        <td width="21%" valign="top" background="images/leftbg.jpg"><?php include("left.php"); ?>
                   <br />
          
          <p>&nbsp;</p>
          <p>&nbsp;</p></td>
        <td width="79%" valign="top">
<p align="center" ><font face="Arial, Helvetica, sans-serif" size="2">
  <?php if(isset($_GET['t'])==1){ ?>
  <span style="color:#66CC66; font-weight:bold;"><?php if(isset($_GET['msg'])){ echo $_GET['msg']; }?></span>
  <?php }else{ ?>
  <span style="color:#FF0000; font-weight:bold;"><?php if(isset($_GET['msg'])){ echo $_GET['msg']; }?></span>
  <?php } ?>
</font></p>
		<div id="top-search-div"> 
           <div id="content">
		   <div class="input">
		   <form id="sfrm" method="post" autocomplete="off" action="">
		     <label>V ID</label>
			 <label><input type="text" id="searchid" name="searchid" class="input-small"  /></label>
			 <label>Year</label>
			 <label><input type="text" id="year" name="year" style="width:130px;border:1px solid #999999;" value="<?php echo date("Y"); ?>" /></label>	
			 <label>Month</label>
			 <label><select name="month" id="month" style="width:130px;border:1px solid #999999;">
			   <option value="">Select Month</option>
			   <option value="January">January</option>
			   <option value="February">February</option>
			   <option value="March">March</option>
			   <option value="April">April</option>
			   <option value="May">May</option>
			   <option value="June">June</option>
			   <option value="July">July</option>
			   <option value="August">August</option>
			   <option value="September">September</option>
			   <option value="October">October</option>
			   <option value="November">November</option>
			   <option value="December">December</option>
			 </select>
			 </label>			 
			 <label><input type="button" name="addbtn" id="submit-btn" value="Search" /></label>
		   </form>
		   </div>
		</div>
		</div>
          <br />
                    <div align="center">
		
				
	<div id="loading" align="center"></div>
	<div id="content1" >
	</div>
				
	
	<table width="800px">
	<tr><Td>
  
			<div id="v" align="center"></div>
<div id="bothead" style="position:fixed; background-color:#333; padding:5px; top:10px; color:#FFFFFF; left:300px;float:right;width:800px; height:auto; display:none; font-family:'Courier New', Courier, monospace; font-size:14px;">			 
   VOUCHER TYPE:<br/>
            ----------------<br/><br/>
   <label>Cursor Navigation to the V ID(VOUCHER ID) field type P---- All payments voucherid will suggested</label><br/> 
   <label>Cursor Navigation to the V ID(VOUCHER ID) field type R---- All receive voucherid will suggested</label><br/> 
   <label>Cursor Navigation to the V ID(VOUCHER ID) field type J---- All journal voucherid will suggested</label><br/> 
   <label>Change Month form Month Select Box ---- All voucherid will suggested according to that month</label><br/><br/>
   <label>In the V ID(VOUCHER ID) field type voucher type like->(r,p,j) any one at a time, <br/>Then Change Month form Month Select Box <br/>---- All voucherid will suggested according to that month for specific voucher type </label><br/> <br/>
   
   <label>In the action column click Preview link ---- Voucher report will open in new window</label><br/> <br/>
   <label>In the action column click Correction link ---- Generate a place with whole voucher.<br/>There you see different types of colored record <br/> Your change will be white colored records where is amount>0 not others.</label><br/> 			</div>
	</ul>	
	</Td></tr></table>
	</div></td>
      </tr>
	        <tr>
        <td height="60" colspan="2" valign="middle" bgcolor="#D3F3FE"><?php include("bot.php"); ?></td>
        </tr>

    </table></td>
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
  header("Location:login.php");
}
}  
?>
