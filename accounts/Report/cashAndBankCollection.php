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

     echo "<table>";
	 echo "<tr>";
	 echo "<td>Date</td>";
	 echo "<td>Voucherid</td>";
	 echo "<td>Account</td>";
	 echo "<td>Dr</td>";
	 echo "</tr>";
	 $pls = 0;
	 $min = 0;
	 $vtype = '';
	 $allq = $myDb->select("SELECT*FROM tbl_2ndjournal where accno='1885'");
	 while($allqf = $myDb->get_row($allq,'MYSQL_ASSOC')){
	      $vsq = $myDb->select("SELECT distinct c.vdate 'Date',c.voucherid Voucherid, 
		  						 c.accname Account, SUM( p.amountdr ) Dr,c.vouchertype
								FROM tbl_2ndjournal c
								INNER JOIN tbl_2ndjournal p ON c.voucherid = p.voucherid
								where c.voucherid='$allqf[voucherid]'
								and c.accno!='$allqf[accno]'
								GROUP BY c.voucherid"
								);
		 while($vsqf = $myDb->get_row($vsq,'MYSQL_ASSOC')){
		    $vtype = $vsqf['vouchertype'];
		    echo "<tr>";
			echo "<td>".$vsqf['Date']."</td>";
			echo "<td>".$vsqf['Voucherid']."</td>";
			echo "<td>".$vsqf['Account']."</td>";
			echo "<td>".$vsqf['Dr']."</td>";
			echo "</tr>";
		    if($vsqf['vouchertype'] == "R"){
			  $pls +=$vsqf['Dr'];
			}
			if($vsqf['vouchertype'] == "P"){
			  $min +=$vsqf['Dr'];
			}


		 }						
	 }
	 
	 echo "<tr>";
	 echo   "<td colspan=3>Grand Total</td>";
	 
	 echo   "<td>".($pls-$min)."</td>";
	 echo "</tr>";
	 echo "</table>";

   }else{
     $msg="Sorry,you are not authorized to access this page";
	 header("Location:acchome.php?msg=$msg");
   }	 

}else{
  header("Location:login.html");
}
}  
?>