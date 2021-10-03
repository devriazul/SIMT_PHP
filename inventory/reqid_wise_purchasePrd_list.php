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
  if(($car['ins']=="y")||($_SESSION['userid']=="administrator")){
	   $reqid=mysql_real_escape_string($_GET['reqid']);

?>
<script language type="text/javascript"> 
function handleEnter (field, event) {
		var keyCode = event.keyCode ? event.keyCode : event.which ? event.which : event.charCode;
		if (keyCode == 13) {
			var i;
			for (i = 0; i < field.form.elements.length; i++)
				if (field == field.form.elements[i])
					break;
			i = (i + 2) % field.form.elements.length;
			field.form.elements[i].focus();
			field.form.elements[i].select();
			return false;
		} 
		else
		return true;
	}      
 
 
 
</script>

<script language="javascript" type="text/javascript">
 $(document).ready(function(){
 	  $('#addu2').click(function(){
	    var reqid=$('#searchid').val();
		
		    var thePopup = window.open('reports/RqListRpt.php?reqid='+reqid,"Requisition Information","location=0,titlebar=0,menubar=0,addressbar=no,height=700,width=900","fullscreen=yes" );
			    //$('#popup-content').clone().appendTo( thePopup.document.body );
			thePopup.print();
	  });
	  
	  $('#sbt').click(function(){
	    
		//alert(id);
		var reqid='<?php echo $reqid; ?>';
		if($('#supid').val()==""){
		  alert("Supplier ID can not left empty");
		  $('#supid').focus();
		  return false;
		}
		if($('#storeid').val()==""){
		  alert("Store ID can not left empty");
		  $('#storeid').focus();
		  return false;
		}

		if($('#pamount').val()==""){
		  alert("Paid Amount can not left empty");
		  $('#pamount').focus();
		  return false;
		}

		
		$('input[name="id"]').each(function(i){
		  var id=$('#id'+i).val();
		  var pqty=$('#PurchaseQty'+i).val();
		  var pprice=$('#ProductPrice'+i).val();
		  var supid=$('#supid').val();
		  var sname=$('#sname').val();
		  var storeid=$('#storeid').val();
		  var pdate=$('#pdate').val();
		  var accid=$('#accid').val();
		  var pamount=$('#pamount').val();
		  //alert(aqty);
			$.get("update_purchaseProduct.php?id="+id+"&pqty="+pqty+"&pprice="+pprice+"&reqid="+reqid+"&supid="+supid+"&sname="+sname+"&storeid="+storeid+"&pdate="+pdate+"&accid="+accid+"&pamount="+pamount,function(r){
			  $('#Result').html(r);
			});
		});
		  var supid=$('#supid').val();
		  var sname=$('#sname').val();
		  var accid=$('#accid').val();
		  var pamount=$('#pamount').val();
			  setTimeout(function(){
					$.get("aproveProductAccheat.php?supid="+supid+"&sname="+sname+"&accid="+accid+"&pamount="+pamount+"&reqid="+reqid,function(j){
					  $('#Result').html(j);
					});
			  
			   }, 3000);
			$('#pamount').val('0');
			$('#supid').val('');
			$('#sname').val('');
			
	  });		
		  

	   $('#storeid').keyup(function(){
	      var p=$('#storeid').val();
	      $.get('pick_store_purchase2.php?p='+p,function(rec){
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
		
		
	   $('#supid').keyup(function(){
	      var p=$('#supid').val();
	      $.get('pick_supplier_purchase.php?p='+p,function(rec){
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
		
		
 });


</script>	
<div id="top-search-div"> 
		   <label></label>
		   <form method="post" autocomplete="off" action="">
		     <label>Supplier ID</label>
             		 
             <label><input type="text" name="supid" id="supid" onKeyPress="return handleEnter(this, event)" style="width:30px; " /></label>
			 <label><input type="text" name="sname" placeholder="Supplier Name" id="sname" onKeyPress="return handleEnter(this, event)" readonly="true" style="width:100px; "/></label>
			 
		     <label></label><label></label>
             <label></label>
             <label>             </label>
			 <label>Purchase Date:</label>
			 <label><input type="date"  min="<?php echo date("Y-m-d"); ?>" name="pdate" style="width:130px; " id="pdate" onKeyPress="return handleEnter(this, event)"  value="<?php echo date("Y-m-d"); ?>" /></label>
             <label>Paid From:</label>
             <label>
			<select name="accid" id="accid" onkeypress="return handleEnter(this, event)">
                <option>Select Account Head</option>
                <?php $hq=$myDb->select("Select * From tbl_accchart Where parentid in('1879','1884')");
				   while($hrow=$myDb->get_row($hq,'MYSQL_ASSOC')){
				   ?>
                <option value="<?php echo $hrow['accname']; ?>"><?php echo $hrow['accname']; ?></option>
                <?php } ?>
              </select>             
			  <input type="text" name="pamount" placeholder="Paid Amount" id="pamount" onKeyPress="return handleEnter(this, event)" style="width:80px; "/>
			  </label>
           </form> <div id="stksuc"></div>
		   
</div>	 
<form name="appr" id="appr">
<?php 	   
		     echo '<div align="left" style="margin-left:30px"><input type="button" id="addu2" name="addu2" value="Print View" class="button-class-big">';
			 $sdq="
			 
			 SELECT c.id id,p.pname 'Product Name',c.rqty 'Requisition Qty',c.aqty 'ApproveQty',c.pqty 'PurchaseQty',c.pprice 'ProductPrice'
				   FROM tbl_buyproduct c
				   INNER JOIN tbl_product p
				   ON p.id=c.pid
				   where c.reqid='$reqid'
				   and pstatus='A'
				   order by c.id desc";
			 $sdep=$myDb->dump_forPurchaseProduct($sdq,'edit_requisition.php','del_requisition.php',$car['upd'],$car['delt'],'add_approve.php','add_purchase.php');
		     echo "</br>";
			 echo '<div align="center"><input type="button" id="sbt" name="sbt" value="Save" class="button-class-big"></div>';
?>
</form>
<?php 		
		} 
   }else{
     $msg="Sorry,you are not authorized to access this page";
	 header("Location:home.php?msg=$msg");
   }	 

}else{
  header("Location:index.php");
}