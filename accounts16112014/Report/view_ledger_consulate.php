<?php ob_start();
session_start();
require_once('../dbClass.php');
include("../config.php"); 
include('../inword2.php');

if($myDb->connect($host,$user,$pwd,$db,true))
{ 
  if($_SESSION['userid']){
  $chka="SELECT*FROM  tbl_accdtl WHERE flname='voucherEntry.php' AND userid='$_SESSION[userid]'";
  $caq=$myDb->select($chka);
  $car=$myDb->get_row($caq,'MYSQL_ASSOC');
  if($car['ins']=="y"){
  
  if(!empty($_POST['accno'])){
	    $posi=strpos($_POST['accno'],'->');
		$getacc=substr($_POST['accno'],0,$posi);
		$_SESSION['getacc']=$getacc;
		//$getacc=$_SESSION['getacc'];
  }else{
	    $posi=strpos($_GET['accno'],'->');
		if(!empty($posi)){
		  $getacc=substr($_GET['accno'],0,$posi);
		}else{
		  $getacc=$_GET['accno'];
		}
		$_SESSION['getacc']=$getacc;
		//$getacc=$_SESSION['getacc'];
  }
  
  if(!empty($_POST['fdate'])){
    $fdate=$_POST['fdate'];
	$_SESSION['fdate']=$fdate;
	//$fdate=$_SESSION['fdate'];
  }else{
    $fdate=$_GET['fdate'];
	$_SESSION['fdate']=$fdate;
	//$fdate=$_SESSION['fdate'];
  }
  if(!empty($_POST['tdate'])){
    $tdate=$_POST['tdate'];
	$_SESSION['tdate']=$tdate;
	//$tdate=$_SESSION['tdate'];
  
  }else{
    $tdate=$_GET['tdate'];
	$_SESSION['tdate']=$tdate;
	//$tdate=$_SESSION['tdate'];
  
  }
?>  
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title><?php include('title.php'); ?></title>
<style type="text/css">
<!--
@import url("../main.css");

-->
</style>
	<link href="../css/core.css" rel="stylesheet" type="text/css" />
<style type="text/css">
  #header{
        font-family:"Courier New", Courier, monospace,Verdana;
		font-size:25px;
		font-weight:bold;
  }	
  #sub-header{
        font-family:"Courier New", Courier, monospace,Verdana;
		font-size:15px;
		font-weight:bold;
  }
  #td-line-top{
      border-top:1px dashed #CCCCCC;
  }	
  #td-line-bottom{
      border-bottom:1px dashed #CCCCCC;
  }
  #td-line-left{
        border-top:1px dashed #CCCCCC;

      border-left:1px dashed #CCCCCC;
  }
  #sub-header,#align-right{
     font-family:"Courier New", Courier, monospace,Verdana;
	 font-size:15px;
	 font-weight:bold;

     padding-left:5px;
  }
  #right-most{
     font-family:"Courier New", Courier, monospace,Verdana;
	 font-size:13px;

     padding-left:15px;
  }
  .heading{
     font-family:"Courier New", Courier, monospace,Verdana;
	 font-size:15px;
   }
   .logo{
    background-image:url(logo.png);
	background-position:right;
	background-repeat:no-repeat;
	height:70px;
	width:100px;
	height:88px;
	top:120px;
	left:100px;
	position:relative;
}	
  table td{
      padding:5px;
  }
	 
	
.style17 {color: #333333}
.style20 {color: #FFFFFF; font-style: italic; }
</style>
<script language="javascript" src="../jquery.js"></script>
<script language="javascript">
 $(document).ready(function(){			

		var auto_refresh = setInterval(function () {
			$('.view').fadeOut('slow', function() {

				$(this).load("view_ledger_consulate_duplicate.php", function() {			
				//$('.view').html('<img src="../loader.gif" />');
				//$('.view').load("view_ledger_consulate_duplicate.php", function() {			     		
					//$(this).show('first');				
					$(this).fadeIn("slow");
				});
			});
		}, 120000);
	$('.view').html('<img src="../loader.gif" />');
	$('.view').load("view_ledger_consulate_duplicate.php");
 });
</script>
</head>
<body>
<div style="width:700px;margin:0 auto; " class="view"></div>

</body>
</html>


<?php 
   }else{
     $msg="Sorry,you are not authorized to access this page";
	 header("Location:acchome.php?msg=$msg");
   }	 

}else{
  header("Location:login.php");
}
}  
?>