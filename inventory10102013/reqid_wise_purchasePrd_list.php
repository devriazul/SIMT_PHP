<?php ob_start();
session_start();
require_once('dbClass.php');
include("config.php"); 
if($myDb->connectDefaultServer())
{ 
  if($_SESSION['userid']){
  $chka="SELECT*FROM  tbl_accdtl WHERE flname='requisition_list.php' AND userid='$_SESSION[userid]'";
  $caq=$myDb->select($chka);
  $car=$myDb->get_row($caq,'MYSQL_ASSOC');
	   if($car['ins']=="y"){
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
		
		    var thePopup = window.open( 'printRequisition.php?reqid='+reqid,"Requisition Information","location=0,titlebar=0,menubar=0,addressbar=no,height=700,width=900","fullscreen=yes" );
			    //$('#popup-content').clone().appendTo( thePopup.document.body );
			thePopup.print();
	  });
	  
	  $('#sbt').click(function(){
	    
		//alert(id);
		var reqid='<?php echo $reqid; ?>';
		$('input[name="id"]').each(function(i){
		  var id=$('#id'+i).val();
		  var pqty=$('#PurchaseQty'+i).val();
		  var pprice=$('#ProductPrice'+i).val();
		  //alert(aqty);
			$.get("update_purchaseProduct.php?id="+id+"&pqty="+pqty+"&pprice="+pprice+"&reqid="+reqid,function(r){
			  $('#Result').html(r);
			});
		});

	  });		
		  

 
 });


</script>	 
<form name="appr" id="appr">
<?php 	   
			 
			 $sdq="
			 
			 SELECT c.id id,p.pname 'Product Name',c.rqty 'Requisition Qty',c.aqty 'ApproveQty',c.pqty 'PurchaseQty',c.pprice 'ProductPrice'
				   FROM tbl_buyproduct c
				   INNER JOIN tbl_product p
				   ON p.id=c.pid
				   where c.reqid='$reqid'
				   order by c.id desc";
			 $sdep=$myDb->dump_forPurchaseProduct($sdq,'edit_requisition.php','del_requisition.php',$car['upd'],$car['delt'],'add_approve.php','add_purchase.php');
		     echo '<div align="center"><input type="button" id="sbt" name="sbt" value="Save" style="color: #999999; font-size: 8pt; font-family: Verdana; border: 1px solid #C0C0C0; background-color: #D9F0FB"><input type="button" id="addu2" name="addu2" value="Print View" style="color: #999999; font-size: 8pt; font-family: Verdana; border: 1px solid #C0C0C0; background-color: #D9F0FB"></div>';
?>
</form>
<?php 		
		} 
   }else{
     $msg="Sorry,you are not authorized to access this page";
	 header("Location:home.php?msg=$msg");
   }	 

}else{
  header("Location:login.php");
}
?>
