<?php 
ob_start();
session_start();
require_once('dbClass.php');
include("config1.php"); 
if($myDb->connectDefaultServer())
{ 

if($_SESSION[bpaddsesid]){
include("config1.php");
$per_page = 20;

if(isset($_GET['page']))
    $page = $_GET['page'];
$start = ($page-1)*$per_page;
?>
<div class="indent1 unline" >
<?php 	  $a='"';	  
		  $sdq="SELECT `col1` as Date , `col11` as MobileNo, FROM_UNIXTIME(`col6`) AS StartDate, FROM_UNIXTIME(`col7`) AS EndDate,TIMEDIFF(FROM_UNIXTIME(`col7`),FROM_UNIXTIME(`col6`) ) AS Duration FROM expun WHERE DATE(replace(col1,'$a','')) between '$_SESSION[fdate]' and '$_SESSION[tdate]' and `col6` <>0 limit $start,$per_page";
			    $sdep=$myDb->dump_query($sdq,'','','','');
		  ?>	
</div>		  	          
<?php 
 	 
}else{
  header("Location:login.php");
}
}  
?>