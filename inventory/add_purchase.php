<?php ob_start();
session_start();
include("../config.php"); 
if($myDb->connectDefaultServer())
{ 
  if($_SESSION['userid']){
  $chka="SELECT*FROM  tbl_accdtl WHERE flname='requisition_list.php' AND userid='$_SESSION[userid]'";
  $caq=$myDb->select($chka);
  $car=$myDb->get_row($caq,'MYSQL_ASSOC');
  if($car['ins']=="y"){
  
  
  //check purchase orderid status:INU means INUSE ,FIN means FINSH
  $chkpo=$myDb->select("SELECT*FROM tbl_purorder WHERE opby='$_SESSION[userid]' and usestatus!='FINP'");
  $chkpof=$myDb->get_row($chkpo,'MYSQL_ASSOC');
  
	  if(empty($chkpof['usestatus'])){
	  
	  
			  $pord=$myDb->select("SELECT ifnull(max(id),0) mpord from tbl_purorder");
			  $pordf=$myDb->get_row($pord,'MYSQL_ASSOC');
			  
			  if($pordf['mpord']==0){
				 $ordid="PO-".($pordf['mpord']+1)."/".date("d");
				 $poins="INSERT INTO tbl_purorder(porderid,usestatus,opby)VALUES('$ordid','INU','$_SESSION[userid]')";
				 $myDb->insert_sql($poins);
			  }else{	 
				 $ordid="PO-".($pordf['mpord']+1)."/".date("d");
				 $poins="INSERT INTO tbl_purorder(porderid,usestatus,opby)VALUES('$ordid','INU','$_SESSION[userid]')";
				 $myDb->insert_sql($poins);
		      }	  
	  }

  


?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title><?php include("title.php");?></title>
<style type="text/css">
<!--
@import url("main.css");
.style12 {font-size: 10px}
.style15 {
	font-size: 12px;
	font-family: Verdana, Arial, Helvetica, sans-serif;
}
.style16 {font-size: 12px}

-->
.form-table{
   margin:5px;
   padding-left:10px;
   font-family:Verdana, Arial, Helvetica, sans-serif;
   font-size:12px;
}
.form-table,td{
   border-bottom:1px dotted #999999;
}      
</style>
<script language="javascript" src="jquery-1.4.2.js"></script>

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


<script language="javascript">
  $(document).ready(function(){
     $('#pid').focus();
	 	  var id='';
		  var supid='';
	  //$.post('populate_appform.php',arr,function(dta){
	     $('#phide').hide();
		 $('#populate').load('populate_purchaseform.php?id='+id+'&supid='+supid);

     $('#submit').css({'margin-left':'5px','margin-top':'5px','margin-bottom':'5px','border':'1px solid #999999'});
	 $('#submit').click(function(){
	   var arr=$('#sfrm').serializeArray();
	   if($('#pid').val()==""){
	     alert("Product ID can not left empty");
		 $('#pid').focus();
		 return false;
	   }
	   if($('#supid').val()==""){
	     alert("Supplier ID can not left empty");
		 $('#supid').focus();
		 return false;
	   }	 
	   if(($('#aqty').val()=="")||($('#aqty').val()=="0")){
	     alert("Approve Qty can not left empty");
		 $('#aqty').focus();
		 return false;
	   }
	   if(($('#pqty').val()=="")||($('#pqty').val()=="0")){
	     alert("Purchase Qty can not left empty");
		 $('#pqty').focus();
		 return false;
	   }
	   if($('#appdate').val()==""){
	     alert("Approve Date can not left empty");
		 $('#appdate').focus();
		 return false;
	   }
	   if($('#aqty').val()>$('#rqty').val()){
	     alert("Approve Qty can not grater than Requesition Qty");
		 $('#aqty').focus();
		 return false;
	   }
	   if($('#appdate').val()==""){
	     alert("Approve Date can not left empty");
		 $('#appdate').focus();
		 return false;
	   }
	   $.post('ins_approve.php',arr,function(res){
	      $('#insup').html(res).hide().fadeIn('slow');
		  document.sfrm.reset();
		  $('#aqty').attr("disabled", true)
		  $('#aqty').focus();
	   }); 
	 
	 });
	  $('#price').focus(function(){
		 var qty=$('#qty').val();
		 var rate=$('#prate').val();
		 var total=qty*rate;
	     $('#price').val(total);
	   });	 
	   
	   $('#pid').keyup(function(){
	      var p=$('#pid').val();
	      $.get('pick_reqproduct.php?p='+p,function(rec){
		  		    $('#mask').show().fadeIn('slow');

		    $('#showpick').show();
		    $('#showpick').html(rec);
		  });	   
		  		    $('#mask').show().fadeIn('slow');

		  $('#showpick').fadeIn('slow');
		  $('#showpick').html("<img src='bigLoader.gif' />");

	   });

	   
	    $('#pid').keypress(function(e){
			   if(e.which==13){
			   		    $('#mask').show().fadeIn('slow');

			      $('#selectmenu').focus();
			   }	  
			 
		}); 
			 
	   $('#supid').keyup(function(){
	      var p=$('#supid').val();
	      $.get('pick_supplier.php?p='+p,function(rec){
		    $('#showpick').show();
		    $('#showpick').html(rec);
		  });	   
		  $('#showpick').fadeIn('slow');
		  $('#showpick').html("<img src='bigLoader.gif' />");

	   });

	   
	    $('#supid').keypress(function(e){
			   if(e.which==13){
			      $('#selectmenu').focus();
			   }	  
			 
		}); 
			 
		
		
	$('#pname').blur(function(e){
		  e.preventDefault();

	  var arr=$('#frm').serializeArray();
	  var id=$('#id').val();
	  var supid=$('#supid').val();
	  //$.post('populate_appform.php',arr,function(dta){
		 $('#populate').load('populate_purchaseform.php?id='+id+'&supid='+supid);
	  //});
	
	});	
		
		
	 
		
	   
  });
</script>

<script type="text/javascript" src="jquery.js"></script>
<script type='text/javascript' src='jquery.autocomplete.js'></script>
<link rel="stylesheet" type="text/css" href="jquery.autocomplete.css" />




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
        <td background="images/leftbg.jpg">&nbsp;</td>
        <td><div align="center"><font face="Arial, Helvetica, sans-serif" size="2">
		<div id="insup"></div>
		
		<?php if(isset($_GET['t'])==0){ ?><span style="color:#FF6600; font-weight:bold;"><?php if(isset($_GET['msg'])){ echo $_GET['msg']; }?></span><?php } ?></font></div></td>
      </tr>
	  
      <tr>
        <td width="21%" valign="top" background="images/leftbg.jpg"><?php include("left.php");?><br />
		
          <p>&nbsp;</p>
          <p>&nbsp;</p></td><td valign="top">
		  
		

   <div id="showpick" style=" position:absolute;width:400px; height:500px; float:right; height:auto;margin-top:-50px; left:650px;"></div>
<div id="populate"></div>
	<div id="table_wrapper" align="center"></div>

		  </td></tr>
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