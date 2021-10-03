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


  $id=mysql_real_escape_string($_GET['id']);
  $req=$myDb->select("select*from tbl_buyproduct where id='$id'");
  $reqf=$myDb->get_row($req,'MYSQL_ASSOC');
  
  
  $pro=$myDb->select("select*from tbl_product where id='$reqf[pid]'");
  $prof=$myDb->get_row($pro,'MYSQL_ASSOC');
  
  
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
	    $('#appdate').keypress(function(e){
			   if(e.which==13){
			     $('#save').focus();

			   }	  
			 
		}); 
	    $('#aqty').keypress(function(e){
			   if(e.which==13){
			     $('#appdate').focus();

			   }	  
			 
		}); 
			 
	$('#pname').blur(function(){
	  var arr=$('#frm').serializeArray();
	  var id=$('#id').val();
	  //$.post('populate_appform.php',arr,function(dta){
		 $('#populate').load('populate_appform.php?id='+id).fadeIn('fast');
	  //});
	
	});	
		
		
		
	 $('#save').live('click',function(){
	       var arr=$('#sfrm').serializeArray();
			var tbl = $('.tbl_repeat').length;

				$.post('ins_approve.php?tbl='+tbl, arr, function(data) {
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
  });
</script>
<script type="text/javascript" src="jquery.dateentry.js"></script>
<script language="javascript">
		$(function (){ var rid=$('#appdate').val();
		
			$('#appdate').dateEntry({spinnerImage: 'img/calendar_icon.png'});
		
		});


</script>

<form name="sfrm" id="sfrm" method="post">
		  
		  <table width="800" border="0" cellspacing="0" cellpadding="0" class="form-table" style="padding:5px;">
  <tr>
    <td colspan="6">Edit Requesition </td>
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
      <input name="expdate" type="text" class="style4" id="expdate" size="30" onkeypress="return handleEnter(this, event)" value="<?php echo $reqf['expdate']; ?>" />
      
      </label></td>
    <td>Approve Date</td>
    <td>:</td>
    <td><input name="appdate" type="text" class="style4" id="appdate" size="30" onkeypress="return handleEnter(this, event)" value="<?php echo $reqf['appdate']; ?>" /></td>
  </tr>
   <tr>
    <td width="124">&nbsp;</td>
    <td width="6">&nbsp;</td>
    <td width="171">&nbsp;</td>
    <td width="116">&nbsp;</td>
    <td width="5">&nbsp;</td>
    <td width="178"><label></label></td>
  </tr>
  
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td><input type="button" name="save" id="save" value="SAVE" style="border:1px solid #00CCFF;" /></td>
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