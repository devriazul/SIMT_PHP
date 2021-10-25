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

 $(document).ready(function(e){
 	  $('#addu2').click(function(){
	    var reqid=$('#searchid').val();
		
		    var thePopup = window.open('reports/RqListRpt.php?reqid='+reqid,"Requisition Information","location=0,titlebar=0,menubar=0,addressbar=no,height=700,width=900","fullscreen=yes" );
			    //$('#popup-content').clone().appendTo( thePopup.document.body );
			thePopup.print();
	  });
	  
	  $('#sbt').click(function(){
	    
		//alert(id);
		var reqid='<?php echo $reqid; ?>';
		$('input[name="id"]').each(function(i){
		  var id=$('#id'+i).val();
		  var aqty=$('#aqty'+i).val();
		  var appdate=$('#appdate').val();
		  //alert(aqty);
			$.get("update_approveProduct.php?id="+id+"&aqty="+aqty+"&reqid="+reqid+"&appdate="+appdate,function(r){
			  $('#Result').html(r);
			});
		});

	  });
   
});
</script>	

<form name="appr" id="appr">
<?php 	   
		     echo '<div align="left" style="margin-left:30px"><input type="button" id="addu2" name="addu2" value="Print View" class="button-class-big">
			 <label>Approve Date: </label>
			 <input type="date"  min="'.date("Y").'"-01-01" name="appdate" id="appdate" onKeyPress="return handleEnter(this, event)"  value="'.date("Y-m-d").'"/>
			 </div>';
			 echo "</br>";
			 $sdq="
			 
			 SELECT c.id id,p.pname 'Product Name',c.rqty 'Requisition Qty',c.aqty 'ApproveQty'
				   FROM tbl_buyproduct c
				   INNER JOIN tbl_product p
				   ON p.id=c.pid
				   where c.reqid='$reqid'
				   and c.pstatus='R'
				   order by c.id desc";
			 $sdep=$myDb->dump_forApproveProduct($sdq,'edit_requisition.php','del_requisition.php',$car['upd'],$car['delt'],'add_approve.php','add_purchase.php');
		     echo "</br>";
			 echo '<div align="center"><input type="button" id="sbt" name="sbt" value="Save" class="button-class-big" ></div>';
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