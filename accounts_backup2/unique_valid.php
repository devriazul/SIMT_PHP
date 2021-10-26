<?php session_start();
include("conn.php");
//--------------------------------Total Sum of debit and credit--------------------------------------------------------------// 
$res = mysql_query("SELECT sum(amountdr)amountdr,
						 (SELECT sum( amountcr ) amountcr 
						  FROM tbl_tmpjurnal 
						  WHERE opby = '$_SESSION[userid]'
						  and vdate='$_SESSION[vdate]' 
						 
						 )amountcr

					from  tbl_tmpjurnal
					where opby='$_SESSION[userid]'
					and vdate='$_SESSION[vdate]'
	") or die(mysql_error());


	
echo "<table width='30%' class='sumacc' align='right' style='font-weight:bold;'>";
while($racf=mysql_fetch_array($res)){   

echo "<tr>";
echo "<td>Amountdr</td>";
echo "<td>Amountcr</td>";
echo "<tr>";
   
echo   "<tr>
	    <td>".$racf['amountdr']."</td>";
echo "<td>".$racf['amountcr']."</td>";
echo "</tr>";

 } 
echo "</table>";		
?>