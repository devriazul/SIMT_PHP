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
  
  if(isset($_GET['empid'])){ $empid=$_GET['empid']; }else{ $empid=''; }


   $pid=mysql_real_escape_string($_GET['pid']);
   $req=$myDb->select("select*from tbl_product where id='$pid'");
   $reqf=$myDb->get_row($req,'MYSQL_ASSOC');
  
  

  $store=$myDb->select("select*from tbl_staffinfo where sid='$_GET[empid]'");
  $storef=$myDb->get_row($store,'MYSQL_ASSOC');
  
  
?>
<script language="javascript">
  $(document).ready(function(){
   $('#aqty').focus();

	   

	   $('#empid').keyup(function(){
	      var p=$('#empid').val();
	      $.get('pick_staff_requisition.php?p='+p,function(rec){
		    $('#showpick').show();
		    $('#showpick').html(rec);
		  });	   
		  $('#showpick').fadeIn('slow');
		  $('#showpick').html("<img src='bigLoader.gif' />");

	   });

	   
	    $('#empid').keypress(function(e){
			   if(e.which==13){
			      $('#selectmenu').focus();
			   }	  
			 
		}); 
		
	   $('#pid').keyup(function(){
	      var p=$('#pid').val();
		  var storeid=$('#storeid').val();
	      $.get('pick_issueproduct.php?p='+p+"&storeid="+storeid,function(rec){
		    $('#showpick').show();
		    $('#showpick').html(rec);
		  });	   
		  $('#showpick').fadeIn('slow');
		  $('#showpick').html("<img src='bigLoader.gif' />");

	   });

	   
	    $('#pid').keypress(function(e){
			   if(e.which==13){
			      $('#selectmenu').focus();
			   }	  
			 
		}); 
		
		$('#storeid').keyup(function(){
	      var p=$('#storeid').val();
	      $.get('pick_store_purchase.php?p='+p,function(rec){
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
			 
	/*$('#pid').blur(function(){
	  var arr=$('#frm').serializeArray();
	  var id=$('#id').val();
	  var empid=$('#empid').val();
	  //$.post('populate_appform.php',arr,function(dta){
		 $('#populate').load('populate_issueform.php?id='+id+'&empid='+empid);
	  //});
	
	});	
		
	*/	
		
	 $('#save').live('click',function(){
	       var arr=$('#sfrm').serializeArray();
			var tbl = $('.tbl_repeat').length;
			
			if($('#empid').val()==""){
			   alert("Employess Id can not left empty");
			   $('#empid').focus();
			   return false;
			}   
			if($('#pid').val()==""){
			   alert("Product Id can not left empty");
			   $('#pid').focus();
			   return false;
			}   
				$.post('ins_issue.php?tbl='+tbl, arr, function(data) {
					/*if (tbl==1) {
						$('#table_wrapper').html(
							$(data.row).hide().fadeIn(300)
							
						);
					} else {
					 
					*/
					  $('#table_wrapper').html(data);	
					  //document.sfrm.reset();
					  $('#pid').val('');
					  $('#pname').val('');
					  $('#qty').val('');
					  $('#pid').focus();
					//}
				});						  
				//document.sfrm.reset();


				
	 });	
	 
  });
</script>
<script language="javascript">
   $(document).ready(function(){
 	  $('#addu2').click(function(){
	    var empid=$('#empid').val();
		var issuedate=$('#issuedate').val();
		    var thePopup = window.open("issuProductEmployeePrt.php?empid="+empid+"&issuedate="+issuedate,"Product Information","location=0,titlebar=0,menubar=0,addressbar=no,height=700,width=900","fullscreen=yes" );
			    //$('#popup-content').clone().appendTo( thePopup.document.body );
			thePopup.print();
	  });
   });

</script>

<form name="sfrm" id="sfrm" method="post">
		  
		  <table width="800" border="0" cellspacing="0" cellpadding="0" class="form-table" style="padding:5px;">
  <tr>
    <td colspan="6" style="height:30px; background-color:#CCCCCC; border-bottom:1px solid #333333; ">ISSUE</td>
  </tr>
  
</tr>
  
    <tr>
      <td>Store</td>
      <td></td>
      <td><input name="storeid" type="text" id="storeid" onKeyPress="return handleEnter(this, event)" style="width:70px;" />
	  <input type="text" name="storename" id="storename" onKeyPress="return handleEnter(this, event)" readonly="true" style="width:130px; "/>
	  </td>
      <td>ISSUE DATE </td>
      <td>&nbsp;</td>
      <td><input type="date"  min="2013-01-01" name="issuedate" id="issuedate" onKeyPress="return handleEnter(this, event)"  value="<?php echo date("Y-m-d"); ?>"/></td>
    </tr>
    <tr>
    <td width="93">      </td>
    <td width="5"></td>
    <td width="368"><input type="hidden" name="id" id="id" onKeyPress="return handleEnter(this, event)" value="<?php echo $reqf['id']; ?>" /></td>
    <td width="141">&nbsp;</td>
    <td width="4"></td>
    <td width="189"><label></label></td>
  </tr>
  </tr>
    <tr>
      <td>Employee ID</td>
      <td>:</td>
      <td><input type="text" name="empid" id="empid" onKeyPress="return handleEnter(this, event)" value="<?php echo $storef['empid']; ?>" /></td>
      <td>Employee Name </td>
      <td>:</td>
      <td><input type="text" name="ename" id="ename" onKeyPress="return handleEnter(this, event)" readonly="true"  value="<?php echo $storef['name']; ?>"/></td>
    </tr>
    <tr>
    <td width="93">Product ID</td>
    <td width="5">:</td>
    <td width="368"><input type="text" name="pid" id="pid" onKeyPress="return handleEnter(this, event)"  /></td>
    <td width="141">Product Name </td>
    <td width="4">:</td>
    <td width="189"><label>
    <input type="text" name="pame" id="pname" onkeypress="return handleEnter(this, event)" value="<?php echo $storef['name']; ?>" readonly="true" />
    </label></td>
  </tr>
  
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>Qty</td>
      <td>:</td>
      <td><input type="text" name="qty" id="qty" onkeypress="return handleEnter(this, event)" value="<?php echo $storef['name']; ?>" style="width:40px;" /></td>
    </tr>
    <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td><input type="button" name="save" id="save" value="ADD ISSUE" style=" margin:5px;font-family:Verdana, Arial, Helvetica, sans-serif; font-size:12px;border:1px solid #00CCFF; background-color:#D1EBEF; width:130px; height:30px;" /></td>
    <td>      <input type="button" id="addu2" name="addu2" value="Print View" style=" margin:5px;font-family:Verdana, Arial, Helvetica, sans-serif; font-size:12px;border:1px solid #00CCFF; background-color:#D1EBEF; width:130px; height:30px;" /></td>
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