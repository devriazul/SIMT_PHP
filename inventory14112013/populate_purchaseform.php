<?php ob_start();
session_start();
require_once('dbClass.php');
include("config.php"); 
if($myDb->connect($host,$user,$pwd,$db,true))
{ 
  if($_SESSION['userid']){
  $chka="SELECT*FROM  tbl_accdtl WHERE flname='requisition_list.php' AND userid='$_SESSION[userid]'";
  $caq=$myDb->select($chka);
  $car=$myDb->get_row($caq,'MYSQL_ASSOC');
  if($car['ins']=="y"){
  
  if(isset($_GET['supid'])){ $supid=$_GET['supid']; }else{ $supid=''; }


  $id=mysql_real_escape_string($_GET['id']);
  $req=$myDb->select("select*from tbl_buyproduct where id='$id'");
  $reqf=$myDb->get_row($req,'MYSQL_ASSOC');
  
  
  $pro=$myDb->select("select*from tbl_product where id='$reqf[pid]'");
  $prof=$myDb->get_row($pro,'MYSQL_ASSOC');

  $sup=$myDb->select("select*from tbl_supplier where id='$_GET[supid]'");
  $supf=$myDb->get_row($sup,'MYSQL_ASSOC');
  
  
  $stq=$myDb->select("SELECT*FROM tbl_staffinfo WHERE id='$reqf[empid]'");
  $stf=$myDb->get_row($stq,'MYSQL_ASSOC');
?>
<script language="javascript">
  $(document).ready(function(){
   $('#aqty').focus();

 $('#price').focus(function(){
		 var qty=$('#qty').val();
		 var rate=$('#prate').val();
		 var total=qty*rate;
	     $('#price').val(total);
	   });	 
	   
	   $('#pid').keyup(function(){
	      var p=$('#pid').val();
	      $.get('pick_purchaseproduct.php?p='+p,function(rec){
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
	    $('#appdate').keypress(function(e){
			   if(e.which==13){
			     $('#pqty').focus();

			   }	  
			 
		}); 
	    $('#aqty').keypress(function(e){
			   if(e.which==13){
			     $('#appdate').focus();

			   }	  
			 
		}); 
		
	    $('#pdate').keypress(function(e){
			   if(e.which==13){
			     $('#save').focus();

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
			 
	$('#pname').blur(function(){
	  var arr=$('#frm').serializeArray();
	  var id=$('#id').val();
	  var supid=$('#supid').val();
	  //$.post('populate_appform.php',arr,function(dta){
		 $('#populate').load('populate_purchaseform.php?id='+id+'&supid='+supid);
	  //});
	
	});	
		
		
		
	 $('#save').live('click',function(){
	       var arr=$('#sfrm').serializeArray();
			var tbl = $('.tbl_repeat').length;

				$.post('ins_purchase.php?tbl='+tbl, arr, function(data) {
					/*if (tbl==1) {
						$('#table_wrapper').html(
							$(data.row).hide().fadeIn(300)
							
						);
					} else {
					 
					*/
					  $('#table_wrapper').html(data);	
					  $('#id').focus();
					//}
				});						  
				//document.sfrm.reset();


				
	 });	
	 
	 $('#conf').click(function(){
	    $('#osc').hide().show();
	    $('#osc').load('update_purorder.php');	    
		$('#osc').html('<img src="indicator.gif"/>').fadeIn('slow');

	 });
  });
</script>
<script type="text/javascript" src="jquery.dateentry.js"></script>
<script language="javascript">
		$(function (){ var rid=$('#appdate').val();
		
			$('#appdate').dateEntry({spinnerImage: 'img/calendar_icon.png'});
			$('#expdate').dateEntry({spinnerImage: 'img/calendar_icon.png'});
			$('#pdate').dateEntry({spinnerImage: 'img/calendar_icon.png'});
		});


</script>

<form name="sfrm" id="sfrm" method="post">
		  
		  <table width="800" border="0" cellspacing="0" cellpadding="0" class="form-table" style="padding:5px;">
  <tr>
    <td colspan="6">Edit Approve 
      <div style="padding:5px;" id="osc"></div><div style="float:right;"><input type="button" name="conf" id="conf" value="CONFIRM ORDER" style=" font-family:Verdana, Arial, Helvetica, sans-serif; font-size:12px;border:1px solid #00CCFF; background-color:#D1EBEF; width:130px; height:30px;" /></div></td>
  </tr>
  
</tr>
  
    <tr>
    <td width="124">
      </td>
    <td width="6"></td>
    <td width="171"><input type="hidden" name="id" id="id" onKeyPress="return handleEnter(this, event)" value="<?php echo $reqf['id']; ?>" /></td>
    <td width="116">&nbsp;</td>
    <td width="5"></td>
    <td width="178"><label></label></td>
  </tr>
  </tr>
    <tr>
      <td>Supplier ID</td>
      <td>:</td>
      <td><input type="text" name="supid" id="supid" onKeyPress="return handleEnter(this, event)" value="<?php echo $supf['id']; ?>" /></td>
      <td>Supplier Name </td>
      <td>:</td>
      <td><input type="text" name="sname" id="sname" onKeyPress="return handleEnter(this, event)" readonly="true"  value="<?php echo $supf['sname']; ?>"/></td>
    </tr>
    <tr>
    <td width="124">Product ID</td>
    <td width="6">:</td>
    <td width="171"><input type="text" name="pid" id="pid" onKeyPress="return handleEnter(this, event)" value="<?php echo $prof['id']; ?>" /></td>
    <td width="116">Name</td>
    <td width="5">:</td>
    <td width="178"><label>
      <input type="text" name="pname" id="pname" onKeyPress="return handleEnter(this, event)" readonly="true"  value="<?php echo $prof['pname']; ?>"/>
    </label></td>
  </tr>
  
    <tr>
    <td width="124">Employee ID</td>
    <td width="6">:</td>
    <td width="171"><input type="text" name="empid" id="empid" onKeyPress="return handleEnter(this, event)" value="<?php echo $stf['id']; ?>" readonly="true" /></td>
    <td width="116">Employee Name</td>
    <td width="5">:</td>
    <td width="178"><label>
      <input type="text" name="ename" id="ename" onKeyPress="return handleEnter(this, event)" readonly="true" value="<?php echo $stf['name']; ?>" />
    </label></td>
  </tr>
  </tr>
    
   <tr>
    <td width="124">Requesition Qty</td>
    <td width="6">:</td>
    <td width="171"><input type="text" name="rqty" id="rqty" onKeyPress="return handleEnter(this, event)" value="<?php echo $reqf['rqty']; ?>" readonly="true" ></td>
    <td width="116">Approve Qty</td>
    <td width="5">:</td>
    <td width="178"><label>
      <input type="text" name="aqty" id="aqty" onKeyPress="return handleEnter(this, event)" value="<?php echo $reqf['aqty']; ?>">
    </label></td>
  </tr>
  <tr>
    <td width="124">Expected Date </td>
    <td width="6">:</td>
    <td><label>
      <input name="expdate" type="text" class="style4" id="expdate" size="30" onKeyPress="return handleEnter(this, event)" value="<?php echo $reqf['expdate']; ?>" />
      
      </label></td>
    <td>Approve Date</td>
    <td>:</td>
    <td><input name="appdate" type="text" class="style4" id="appdate" size="30" onKeyPress="return handleEnter(this, event)" value="<?php echo $reqf['appdate']; ?>" /></td>
  </tr>
   <tr>
    <td width="124">Purchase Qty</td>
    <td width="6">:</td>
    <td width="171"><input type="text" name="pqty" id="pqty" onKeyPress="return handleEnter(this, event)" value="<?php echo $reqf['pqty']; ?>"></td>
    <td width="116">Product Price </td>
    <td width="5">:</td>
    <td width="178"><input type="text" name="pprice" id="pprice" onkeypress="return handleEnter(this, event)" value="<?php echo $reqf['pprice']; ?>"/></td>
  </tr>
  
   <tr>
     <td>&nbsp;</td>
     <td>&nbsp;</td>
     <td>&nbsp;</td>
     <td>Purchase Date</td>
     <td>&nbsp;</td>
     <td><input name="pdate" type="text" class="style4" id="pdate" size="30" onkeypress="return handleEnter(this, event)" value="<?php echo $reqf['pdate']; ?>" /></td>
   </tr>
   <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td><input type="button" name="save" id="save" value="ADD PRODUCT" style=" margin:5px;font-family:Verdana, Arial, Helvetica, sans-serif; font-size:12px;border:1px solid #00CCFF; background-color:#D1EBEF; width:130px; height:30px;" /></td>
    <td>&nbsp;</td>
    <td><label>
      
    </label></td>
  </tr>
</table>

</form>

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