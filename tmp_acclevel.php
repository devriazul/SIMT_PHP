<?php 
  $chka="SELECT*FROM  tbl_accdtl WHERE flname='macclevel.php' AND userid='$_SESSION[userid]'";
  $caq=$myDb->select($chka);
  $car=$myDb->get_row($caq,'MYSQL_ASSOC');
  if($car['ins']=="y"){
    $per_page = 9; 

    if($_GET)
    {
       if(isset($_GET['page'])){ $page=$_GET['page']; }
    }



    //get table contents
    $start = ($page-1)*$per_page;
    //$sql = "select * from tbl_courses order by id limit $start,$per_page";
   // $rsd = mysql_query($sql);
  
     $sdq="select id,userid as 'User ID',flname as 'File Name',ins as 'Insert',upd as 'Update',delt as 'Delete' from tbl_accdtl order by id desc limit $start,$per_page";
	 $sdep=$myDb->dump_query($sdq,'edit_macclevel.php','delmacclevel.php',$car['upd'],$car['delt']);
		  
   }else{
     $msg="Sorry,you are not authorized to access this page";
	 header("Location:home.php?msg=$msg");
   }	 

?>
