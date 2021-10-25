<?php ob_start();
session_start();
require_once('dbClass.php');
include("config.php"); 
if($myDb->connectDefaultServer())
{ 
  if($_SESSION['userid']){
  $chka="SELECT*FROM  tbl_accdtl WHERE flname='manage_venue.php' AND userid='$_SESSION[userid]'";
  $caq=$myDb->select($chka);
  $car=$myDb->get_row($caq,'MYSQL_ASSOC');
  if(($car['ins']=="y")||($_SESSION['userid']=="administrator")){
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
		$.get("delvenue.php?id="+id,function(r){
		
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
	var venuname=$(this).attr('venuname');
	var dorder=$(this).attr('dorder');
	var roomno=$(this).attr('roomno');
	$('#venuname').val(venuname);
	$('#orderid').val(dorder);
	$('#roomno').val(roomno);
	$('#id').val(id);

  });
});

</script>
				<?php 
				   $sdq="SELECT*FROM tbl_venue ORDER BY id desc";
   				   $sdep=$myDb->dump_query($sdq,'','delvenue.php','y','y');
   
                ?>

<?php 
   }else{
     $msg="Sorry,you are not authorized to access this page";
	 header("Location:home.php?msg=$msg");
   }	 

}else{
  header("Location:index.php");
}
}