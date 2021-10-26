<?php ob_start();
session_start();
include("../config.php"); 
if($myDb->connectDefaultServer())
{ 
  if($_SESSION['userid']){
  $chka="SELECT*FROM  tbl_accdtl WHERE flname='product_list.php' AND userid='$_SESSION[userid]'";
  $caq=$myDb->select($chka);
  $car=$myDb->get_row($caq,'MYSQL_ASSOC');
  if($car['ins']=="y"){
?>
<style type="text/css">
@import url("main.css");
</style>
<div align="center">
<h2>SAIC GROUP OF INSTITUTIONS<br />
<h4>House-1,Road-2,Block-B,Section-6</h4>
<h4>Mirpur,Dhaka-1216</h4>
Product List Report<br />

</h2>
</div>
<?php 
     $prdtype=mysql_real_escape_string($_GET['prdtype']);
	 if(!empty($prdtype)){
     echo "&nbsp;&nbsp;Product Type: ".$prdtype."<br/><br/>";
     $sdq="SELECT id,pname 'Product Name',packsize 'Pack Size',qty 'OB Qty', prtype 'Product Type' FROM tbl_product where prtype='$prdtype' order by id desc";
	 $sdep=$myDb->dump_query($sdq,'edit_product.php','del_product.php','','');
     }else{
	 
		  $prtq=$myDb->select("SELECT distinct prtype FROM tbl_product");
		  while($prtf=$myDb->get_row($prtq,'MYSQL_ASSOC')){
				 echo "<br/>";
				 echo "&nbsp;&nbsp;Product Type: ".$prtf['prtype']."<br/><br/>";

				 $sdq="SELECT id,pname 'Product Name',packsize 'Pack Size',qty 'OB Qty', prtype 'Product Type' FROM tbl_product where prtype='$prtf[prtype]' order by id desc";
				 $sdep=$myDb->dump_query($sdq,'edit_product.php','del_product.php','','');
		  }
	 
	 }
  
   }else{
     $msg="Sorry,you are not authorized to access this page";
	 header("Location:home.php?msg=$msg");
   }	 

}else{
  header("Location:login.php");
}
}  
?>