<?php session_start();
mysql_connect("localhost","root","");
mysql_select_db("simtdb");

//$accname = $_GET['accname'];
//$query = "SELECT accname FROM  tbl_tmpjurnal WHERE accname='Prime Bank Ltd'";
$res = mysql_query("SELECT sum(amountdr)amountdr,
						 (SELECT sum( amountcr ) amountcr 
						  FROM tbl_tmpjurnal 
						  WHERE opby = '$_SESSION[userid]'
						  and vdate='$_SESSION[sdate]' 
						 
						 )amountcr

					from  tbl_tmpjurnal
					where opby='$_SESSION[userid]'
					and vdate='$_SESSION[sdate]'") or die(mysql_error());
echo "<table width='30%' class='sumacc'>";
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