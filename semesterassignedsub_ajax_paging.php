<?php 
ob_start();
session_start();
require_once('dbClass.php');
include("config.php"); 
if($myDb->connectDefaultServer())
{ 
  if($_SESSION['userid']){
  $chka="SELECT*FROM  tbl_accdtl WHERE flname='semesterwisesubject.php' AND userid='$_SESSION[userid]'";
  $caq=$myDb->select($chka);
  $car=$myDb->get_row($caq,'MYSQL_ASSOC');
  if($car['ins']=="y"){
?>  
 <link rel="stylesheet" href="libs/style.css"/>
 <script src='libs/jquery.js' type="text/javascript"></script>

<div id="news" class="tabcon">
	<h2 class="c2title">SEMESTER WISE ASSIGNED SUBJECT</h2><br/>
	
	<div id="resn"></div>
	<?php
	$sql1="select * from tbl_semesterwisesubj LIMIT 20";
	$result1=$myDb->select($sql1);
	?>
	
	<div id="pagesn">

		<?php
		 $query="select count(*) as tot from tbl_semesterwisesubj";
		  $countset=$myDb->select($query);
		  $count=$myDb->get_row($countset,'MYSQL_ASSOC');
		  $tot=$count['tot'];
		  $page=1;
		  $ipp=20;//items per page
		  $totalpages=ceil($tot/$ipp);
		  echo"<ul class='pages'>";
		  for($i=1;$i<=$totalpages; $i++)
		  {
			  echo"<li class='$i'>$i</li>";
		  }
		  echo"</ul>";
		?>


          <p align="center"><script type="text/javascript" src="ajax1.js"></script>

</p>
<p></p>	
</div>
</div>
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