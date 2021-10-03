<?php session_start();
mysql_connect("localhost","root","");
mysql_select_db("simtdb");
//--------------------------------Total Sum of debit and credit--------------------------------------------------------------// 
$res = mysql_query("SELECT sum(amountdr)amountdr,
						 (SELECT sum( amountcr ) amountcr 
						  FROM tbl_tmpjurnal 
						  WHERE opby = '$_SESSION[userid]'
						  and vdate='$_SESSION[sdate]' 
						 
						 )amountcr

					from  tbl_tmpjurnal
					where opby='$_SESSION[userid]'
					and vdate='$_SESSION[sdate]'
	") or die(mysql_error());

//------------------------------- Query use next time--------------------------------------------------------------------------//
//$accname = $_GET['accname'];
//$query = "SELECT accname FROM  tbl_tmpjurnal WHERE accname='Prime Bank Ltd'";
/*$res = mysql_query("SELECT id,sum(amountdr)amountdr,
						 (SELECT sum( amountcr ) amountcr 
						  FROM tbl_tmpjurnal 
						  WHERE opby = '$_SESSION[userid]' 
						  AND masteraccno in(SELECT masteraccno FROM tbl_tmpjurnal 
											 WHERE id=(select max(id)id from tbl_tmpjurnal 
													   where amountdr=0 and opby='$_SESSION[userid]'
													  ) 
											 and amountdr =0 AND opby = '$_SESSION[userid]'
											 
										    ) 
						 )amountcr

					from  tbl_tmpjurnal
					where id=(select max(id)id from tbl_tmpjurnal where amountcr=0 and opby='$_SESSION[userid]') 
					AND opby='$_SESSION[userid]'
					AND amountcr=0
					GROUP BY id
	") or die(mysql_error());
	
	

$rescr = mysql_query("SELECT id,sum(amountcr)amountcr,
						 (SELECT sum( amountdr ) amountdr 
						  FROM tbl_tmpjurnal 
						  WHERE opby = '$_SESSION[userid]' 
						  AND masteraccno in(SELECT masteraccno FROM tbl_tmpjurnal 
											 WHERE id=(select max(id)id from tbl_tmpjurnal 
													   where amountcr=0 and opby='$_SESSION[userid]' AND masteraccno!=0
													  ) 
											 and amountcr =0 AND opby = '$_SESSION[userid]'
											 and masteraccno!=0
										    ) 
						 )amountdr

					from  tbl_tmpjurnal
					where id=(select max(id)id from tbl_tmpjurnal where amountdr=0 and opby='$_SESSION[userid]' AND masteraccno=0) 
					AND opby='$_SESSION[userid]'
					AND amountdr=0
					AND masteraccno=0
					GROUP BY id
") or die(mysql_error());
*/	
	
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