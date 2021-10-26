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
  
  if(isset($_GET['storeid'])){ $storeid=$_GET['storeid']; }else{ $storeid=''; }


   $reqid=mysql_real_escape_string($_GET['reqid']);
   $req=$myDb->select("select*from tbl_buyproduct where reqid='$reqid'");
   $reqf=$myDb->get_row($req,'MYSQL_ASSOC');
  
  

  $store=$myDb->select("select*from tbl_store where id='$_GET[storeid]'");
  $storef=$myDb->get_row($store,'MYSQL_ASSOC');
  
  
?>
<script language="javascript">
  $(document).ready(function(){
   $('#aqty').focus();

	   

	   $('#storeid').keyup(function(){
	      var p=$('#storeid').val();
	      $.get('pick_store.php?p='+p,function(rec){
		    $('#showpick').show();
		    $('#showpick').html(rec);
		  });	   
		  $('#showpick').fadeIn('slow');
		  $('#showpick').html("<img src='bigLoader.gif' />");

	   });

	   
	    $('#storeid').keypress(function(e){
			   if(e.which==13){
			      $('#selectmenu').focus();
			   }	  
			 
		}); 
		
	   $('#reqid').keyup(function(){
	      var p=$('#reqid').val();
	      $.get('pick_porderid.php?p='+p,function(rec){
		    $('#showpick').show();
		    $('#showpick').html(rec);
		  });	   
		  $('#showpick').fadeIn('slow');
		  $('#showpick').html("<img src='bigLoader.gif' />");

	   });

	   
	    $('#reqid').keypress(function(e){
			   if(e.which==13){
			      $('#selectmenu').focus();
			   }	  
			 
		}); 
		
		
		
			 
	$('#pid').blur(function(){
	  var arr=$('#frm').serializeArray();
	  var id=$('#id').val();
	  var storeid=$('#storeid').val();
	  //$.post('populate_appform.php',arr,function(dta){
		 $('#populate').load('populate_stockform.php?id='+id+'&storeid='+storeid);
	  //});
	
	});	
		
		
		
	 $('#save').live('click',function(){
	       var arr=$('#sfrm').serializeArray();
			var tbl = $('.tbl_repeat').length;

				$.post('ins_stock.php?tbl='+tbl, arr, function(data) {
					/*if (tbl==1) {
						$('#table_wrapper').html(
							$(data.row).hide().fadeIn(300)
							
						);
					} else {
					 
					*/
					  $('#table_wrapper').html(data);	
					  $('#storename').focus();
					  window.location.reload();
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
			$('#expdate').dateEntry({spinnerImage: 'img/calendar_icon.png'});
			$('#pdate').dateEntry({spinnerImage: 'img/calendar_icon.png'});
		});


</script>

<form name="sfrm" id="sfrm" method="post">
		  
		  <table width="800" border="0" cellspacing="0" cellpadding="0" class="form-table" style="padding:5px;">
  <tr>
    <td colspan="6">Add Stock 
     </td>
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
      <td>Store ID</td>
      <td>:</td>
      <td><input type="text" name="storeid" id="storeid" onKeyPress="return handleEnter(this, event)" value="<?php echo $storef['storeid']; ?>" /></td>
      <td>Store Name </td>
      <td>:</td>
      <td><input type="text" name="storename" id="storename" onKeyPress="return handleEnter(this, event)" readonly="true"  value="<?php echo $storef['storname']; ?>"/></td>
    </tr>
    <tr>
    <td width="124">Requisition ID</td>
    <td width="6">:</td>
    <td width="171"><input type="text" name="reqid" id="reqid" onKeyPress="return handleEnter(this, event)" value="<?php echo $reqf['reqid']; ?>" /></td>
    <td width="116"></td>
    <td width="5">&nbsp;</td>
    <td width="178"><label>
    </label></td>
  </tr>
  
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td><input type="button" name="save" id="save" value="ADD TO STORE" style=" margin:5px;font-family:Verdana, Arial, Helvetica, sans-serif; font-size:12px;border:1px solid #00CCFF; background-color:#D1EBEF; width:130px; height:30px;" /></td>
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