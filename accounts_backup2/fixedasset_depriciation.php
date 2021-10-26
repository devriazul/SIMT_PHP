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
<style type="text/css">
<!--
@import url("main.css");

-->
#main-td{
    font-family:Verdana, Arial, Helvetica, sans-serif;
	font-size:14px;
	color:#333333;
	font-variant:normal;
}
#sub-td{
    font-family:Verdana, Arial, Helvetica, sans-serif;
	font-size:10px;
	font-stretch:normal;
	color:#666666;
}		
</style>

<script type="text/javascript" src="jquery.js"></script>
<script type='text/javascript' src='jquery.autocomplete.js'></script>
<link rel="stylesheet" type="text/css" href="jquery.autocomplete.css" />
	<link href="css/core.css" rel="stylesheet" type="text/css" />

<script type="text/javascript" src="../datepickercontrol.js"></script>
  <script language="JavaScript">
  if (navigator.platform.toString().toLowerCase().indexOf("linux") != -1){
	 	document.write('<link type="text/css" rel="stylesheet" href="../datepickercontrol_lnx.css">');
	 }
	 else{
	 	document.write('<link type="text/css" rel="stylesheet" href="../datepickercontrol.css">');
	 }

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
    	$('a[name=hrff]').click(function(e){       
		 e.preventDefault();
			   var hid=$(this).attr('href');
			   var accno=$(this).attr('alt');
			   var aid=$(this).attr('id');
			   var total=$(this).attr('class');
			var drate=$('#d'+hid).attr('title');
		    var pyear=$('#d'+hid).attr('class');
		    $('#v'+hid).load('depriciation_diminishing.php?i='+hid+'&accno='+accno+'&aid='+aid+'&total='+total+'&drate='+drate+'&pyear='+pyear);
			   $("#v"+hid).html("<img src='loader.gif' />");				   
			   $("#v"+hid).hide().fadeIn('slow');

		});

	
});	
</script>

<script language="javascript">
$(document).ready(function(){ 
    	$('a[name=hrf]').click(function(e){       
		 e.preventDefault();
			   var hid=$(this).attr('href');
			   
			   var accno=$(this).attr('alt');
			   var aid=$(this).attr('id');
			   var total=$(this).attr('class');
			var drate=$('#d'+hid).attr('title');
		    var pyear=$('#d'+hid).attr('class');
		    $('#v'+hid).load('depriciation.php?i='+hid+'&accno='+accno+'&aid='+aid+'&total='+total+'&drate='+drate+'&pyear='+pyear);
			   $("#v"+hid).html("<img src='loader.gif' />");				   
			   $("#v"+hid).hide().fadeIn('slow');

		});

	
});	

</script>

<script language="javascript">
 $(document).ready(function(){
   $('#mtype').change(function(){
      if($('#mtype').val()=='Straight Line'){
	    $('#marea').slideDown('slow');
	  }else{
	    $('#marea').slideUp('slow');
	  
	  } 
	  
	if($('#mtype').val()=='Diminishing'){
	      $('#marea_dimi').slideDown('slow');
		
	  }else{
		$('#marea_dimi').slideUp('slow');
	  
	  }   	    	
   });
 
 });
</script>
</head>

<body>
<table width="1047" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td width="1047" height="152" valign="top" background="images/1.jpg">
      <span class="style17"><?php include("topdefault.php");?>    </span></span></td>
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
		   <div class="input1">
			 
			 <label>
			 <select name="mtype" id="mtype">
			   <option value="">Select Method type</option>
			   <option value="Straight Line">Straight Line Method</option>
			   <option value="Diminishing">Diminishing Method</option>
			 </select>
			 </label>
			 <label>Depriciation Method</label>

			 <label>
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
	
    <table width="800px">
	<tr><Td>
	<div id="marea" style="display:none;">
	<table align="center" width="700" border="0" cellspacing="0" cellpadding="0">
	 <?php  $i=1; $mst=mysql_query("select*from tbl_accchart where parentid=0 and accname='Fixed Assets'") or die(mysql_error());
	 while($mstf=mysql_fetch_array($mst)){
	 
	   
						
	 ?>
	   	  		 

      <tr>
        <td colspan="2" id="main-td" height="25"><?php  echo $mstf['accname']."<br/>"; ?></td>
        <td width="45%">&nbsp;</td>
      </tr>
	  
	  <?php
	  $cht=mysql_query("SELECT distinct m.id mid,m.accname
							FROM tbl_accchart m
							inner join tbl_2ndjournal d
							on m.id=d.groupname
                            and d.groupname in(
							               select id from tbl_accchart where parentid='$mstf[id]' and groupname=0)
										  ");
		 while($chtf=mysql_fetch_array($cht)){
		 
		 
		 $chk=$myDb->select("select*from tbl_2ndjournal where groupname='$chtf[mid]'");
		 $chkf=$myDb->get_row($chk,'MYSQL_ASSOC');
		 if($chkf['amountcr']!=0){
		 
		 $val=$myDb->select("select (select ifnull(sum(amountcr),0) from tbl_2ndjournal where groupname='$chtf[mid]') total
		                     from tbl_2ndjournal
							 where groupname='$chtf[mid]'");
		 $valf=$myDb->get_row($val,'MYSQL_ASSOC');			
		 
		 $rsv=$myDb->select("select pyear,drate from fixed_dep where aid='$chtf[mid]' and methodtype='Straight Line'");
		 $rsvf=$myDb->get_row($rsv,'MYSQL_ASSOC');		 
		   
		 
		 ?>
		 <script language="javascript">
		 $(document).ready(function(){ 

          
		       var hid='h<?php echo $i; ?>';
			   var accno=<?php echo $chtf['mid']; ?>;
			   var aid=<?php echo $chtf['mid']; ?>;
			   var drate=<?php echo $rsvf['drate']; ?>;
			   var pyear=<?php echo $rsvf['pyear']; ?>;
			   var total=<?php echo $valf['total']; ?>;
		   $('#vh<?php echo $i; ?>').each(function(){
			   $('#vh<?php echo $i; ?>').load('depriciation.php?i='+hid+'&accno='+accno+'&aid='+aid+'&total='+total+'&drate='+drate+'&pyear='+pyear);
		   
		   
			   $('#vh<?php echo $i; ?>').html("<img src='loader.gif' />");				   
			   $('#vh<?php echo $i; ?>').hide().fadeIn('slow');
			});   
		});	   

       </script>
	   <div id="<?php echo 'dh'.$i; ?>" title="<?php echo $rsvf['drate']; ?>" class="<?php echo $rsvf['pyear']; ?>"></div>
      <tr>
        <td width="4%" id="sub-td"><a name="hrf" href="<?php echo 'h'.$i; ?>" alt="<?php echo $chtf['mid']; ?>" id="<?php echo $chtf['mid']; ?>" class="<?php echo $valf['total']; ?>">Edit</a></td>
        <td width="51%" id="sub-td" height="20"><?php echo "<span style='padding-left:10px;'>".$chtf['accname']."</span>"."</br>"; ?></td>
        <td valign="middle"><div id="<?php echo 'vh'.$i; ?>"></div></td>
      </tr>
	  	  
	  <?php } ?>	  
	  	
	    
	  <?php  
	    $i++;
	  ?>

	  <?php 
	  }}?>
    </table>
	</div>
	
	<div id="marea_dimi" style="display:none;">
	
<table align="center" width="700" border="0" cellspacing="0" cellpadding="0">
	 <?php  $i=1; $mst=mysql_query("select*from tbl_accchart where parentid=0 and accname='Fixed Assets'") or die(mysql_error());
	 while($mstf=mysql_fetch_array($mst)){
	 
	   
						
	 ?>
	   	  		 

      <tr>
        <td colspan="2" id="main-td" height="25"><?php  echo $mstf['accname']."<br/>"; ?></td>
        <td width="45%">&nbsp;</td>
      </tr>
	  
	   <?php
	  $cht=mysql_query("SELECT distinct m.id mid,m.accname
							FROM tbl_accchart m
							inner join tbl_2ndjournal d
							on m.id=d.groupname
                            and d.groupname in(
							               select id from tbl_accchart where parentid='$mstf[id]' and groupname=0)
										  ");
		 while($chtf=mysql_fetch_array($cht)){
		 
		 
		 $chk=$myDb->select("select*from tbl_2ndjournal where groupname='$chtf[mid]'");
		 $chkf=$myDb->get_row($chk,'MYSQL_ASSOC');
		 if($chkf['amountcr']!=0){
		 
		 $val=$myDb->select("select (select ifnull(sum(amountcr),0) from tbl_2ndjournal where groupname='$chtf[mid]') total
		                     from tbl_2ndjournal
							 where groupname='$chtf[mid]'");
		 $valf=$myDb->get_row($val,'MYSQL_ASSOC');			
		 
		 $rsv=$myDb->select("select pyear,drate from fixed_dep where aid='$chtf[mid]' and methodtype='Diminishing'");
		 $rsvf=$myDb->get_row($rsv,'MYSQL_ASSOC');		 
		   
		 
		 ?>
		 <script language="javascript">
		 $(document).ready(function(){ 

          
		       var hid='hh<?php echo $i; ?>';
			   var accno=<?php echo $chtf['mid']; ?>;
			   var aid=<?php echo $chtf['mid']; ?>;
			   var drate=<?php echo $rsvf['drate']; ?>;
			   var pyear=<?php echo $rsvf['pyear']; ?>;
			   var total=<?php echo $valf['total']; ?>;
		   $('#vhh<?php echo $i; ?>').each(function(){
			   $('#vhh<?php echo $i; ?>').load('depriciation_diminishing.php?i='+hid+'&accno='+accno+'&aid='+aid+'&total='+total+'&drate='+drate+'&pyear='+pyear);
		   
		   
			   $('#vhh<?php echo $i; ?>').html("<img src='loader.gif' />");				   
			   $('#vhh<?php echo $i; ?>').hide().fadeIn('slow');
			});   
		});	   

       </script>
	   <div id="<?php echo 'dhh'.$i; ?>" title="<?php echo $rsvf['drate']; ?>" class="<?php echo $rsvf['pyear']; ?>"></div>
      <tr>
        <td width="4%" id="sub-td"><a name="hrff" href="<?php echo 'hh'.$i; ?>" alt="<?php echo $chtf['mid']; ?>" id="<?php echo $chtf['mid']; ?>" class="<?php echo $valf['total']; ?>">Edit</a></td>
        <td width="51%" id="sub-td" height="20"><?php echo "<span style='padding-left:10px;'>".$chtf['accname']."</span>"."</br>"; ?></td>
        <td valign="middle"><div id="<?php echo 'vhh'.$i; ?>"></div></td>
      </tr>
	  
	  
	  <?php } ?>	  
	  	
	    
	  <?php  
	    $i++;
	  ?>

	  <?php 
	  }}?>
    </table>	
	
	</div>
	
			
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
	 header("Location:home.php?msg=$msg");
   }	 

}else{
  header("Location:login.php");
}
}  
?>
