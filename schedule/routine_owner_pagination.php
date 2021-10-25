<?php ob_start();
session_start();
require_once('dbClass.php');
include("config.php"); 
if($myDb->connectDefaultServer())
{ 
  if($_SESSION['userid']){
  $chka="SELECT*FROM  tbl_accdtl WHERE flname='manage_routine_for.php' AND userid='$_SESSION[userid]'";
  $caq=$myDb->select($chka);
  $car=$myDb->get_row($caq,'MYSQL_ASSOC');
  if(($car['ins']=="y")||($_SESSION['userid']=="administrator")){
?>
				<?php 
				   $sdq="SELECT f.id,d.name 'Department Name',d.id 'DepartmentID',f.alias 'Alias',f.orderid 'OrderID'
				   		 FROM tbl_routine_for f
						 INNER JOIN tbl_department d
						 on f.deptid=d.id 
						 ORDER BY f.alias ASC";
   				   $sdep=$myDb->dump_query($sdq,'','delroutinefor.php','y','y');
   
                ?>
<script language="javascript">
$(document).ready(function(){
  $('a[name="dlt"]').unbind().click(function(e){
    e.preventDefault();
	var id=$(this).attr('alt');
	var trigger = $(this);
	var rows=$('.dmpquery tr').length;
	var checkstr =  confirm('are you sure you want to delete this?');
	if(checkstr == true){	
		$.get("delroutinefor.php?id="+id,function(r){
		
			if(rows>1){
		
				trigger.closest('tr').fadeOut(300, function() {
							$(this).remove();			
				});	
			}
			$('#shw').html(r);
			//$('.data').load("macclevel_pagination?page=1");

		});
	}else{
	  return false;
	}	
  
  });
  $('a[name="edt"]').click(function(e){
    e.preventDefault();
    var id=$(this).attr('alt');
	var deptid=$(this).attr('deptid');
	var alias=$(this).attr('alias');
	var dorder=$(this).attr('dorder');
	$('#deptid').val(deptid);
	$('#alias').val(alias);
	$('#orderid').val(dorder);
	$('#id').val(id);

  });
});

</script>
<?php 
   }else{
     $msg="Sorry,you are not authorized to access this page";
	 header("Location:home.php?msg=$msg");
   }	 

}else{
  header("Location:index.php");
}
}