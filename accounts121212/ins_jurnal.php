<htm>
<head>
<script type="text/javascript" src="jquery-1.3.2.min.js"></script> 
<script type="text/javascript">$(document).ready(function()
{$('table#delTable td a.delete').click(function()
{if(confirm("Are you sure you want to delete this row?"))
{
var id=$(this).parent().parent().attr('id');
var data='id='+id;var parent=$(this).parent().parent();
$.ajax({type:"POST",
url:"delete_jurnal.php",data:data,cache:false,success:function()
{parent.fadeOut('slow',function(){$(this).remove();});$('table#delTable tr:odd').css('background',' #FFFFFF');}});}});$('table#delTable tr:odd').css('background',' #FFFFFF');});</script> 
</head>
<body>
<?php @session_start();
@ob_start();
//connect to database

$dbhost = 'localhost';
$dbuser = 'root';
$dbpass = '';
$dbname = 'simtdb';

$conn = mysql_connect($dbhost, $dbuser, $dbpass);
mysql_select_db($dbname);


//NOTE: MAKE SURE YOU DO YOUR OWN APPROPRIATE SERVERSIDE ERROR CHECKING HERE!!!
if(!empty($_POST) && isset($_POST))
{
	//make variables safe to insert
  //$name = mysql_real_escape_string($_POST['name']);
 // $surname = mysql_real_escape_string($_POST['surname']);

	//query to insert data into table
	$acn=mysql_query("SELECT*FROM  tbl_accchart WHERE accname='$_POST[accname]'") or die(mysql_error());
	$acf=mysql_fetch_array($acn);
	
	//$mx=mysql_query("SELECT voucherid FROM tbl_masterjournal where id=(select max(id) from tbl_masterjournal)") or die(mysql_error());
	//$mxf=mysql_fetch_array($mx);
	//$voucherid=$mxf['voucherid'];
	
	
	if($_POST['acctype']=="DR"){
	$sql2=mysql_query("INSERT INTO tbl_tmpjurnal(accname,accno,amountdr,storedstatus,opby,vouchertype) VALUES('$acf[accname]','$acf[id]','$_POST[amount]','I','$_SESSION[userid]','$_POST[vouchertype]')") or die(mysql_error());
	}
	if($_POST['acctype']=="CR"){
	   $maccno=mysql_query("SELECT id FROM tbl_tmpjurnal WHERE opby='$_SESSION[userid]' and amountcr=0") or die(mysql_error());
	   $macf=mysql_fetch_array($maccno);
	   $sql2=mysql_query("INSERT INTO tbl_tmpjurnal(accname,accno,amountcr,masteraccno,storedstatus,opby,vouchertype) VALUES('$acf[accname]','$acf[id]','$_POST[amount]','$macf[id]','I','$_SESSION[userid]','$_POST[vouchertype]')") or die(mysql_error());
	}
	if(!($sql2))
	{
		echo "Failed to insert record";
	}
	else
	{
		echo "Record inserted successfully";
	}
}


?>
<table align="center" cellpadding="5" cellspacing="0" width="30%" id="delTable" bgcolor="#f6f6f6" style="border:1px solid #cccccc;">
	<tr>
		<td><b>AccNo</b></td>
		<td><b>Acc Name</b></td>
		<td><b>Debit</b></td>
		<td><b>Credit</b></td>
		<td><b>Master Head</b></td>
		<td><b>Action</b></td>
	</tr>
	<?
	//show data from tables
	$sql = "SELECT * FROM tbl_tmpjurnal ORDER BY id ASC LIMIT 20";
	$result = mysql_query($sql);
	$i=1;
	while($row = mysql_fetch_array($result))
	{
	//print data
	
	?>
		<tr id="<?php echo $row['id']; ?>">
		<td><? echo $row['accno']; ?></td>
		<td><? echo $row['accname']; ?></td>
		<td><? echo $row['amountdr']; ?></td>
		<td><?php echo $row['amountcr']; ?></td>
		<td><?php echo $row['masteraccno']; ?></td>
        <td><a href="#" class="delete" style="color:#FF0000;"><img alt="" align="absmiddle" border="0" src="img/delete.png" /></a></td>
			</tr>
	<?
	$i++;
	}
	?>
</table>
  
  	          
  </div>       
<p></p>
</td>
      </tr>
	        <tr>
        <td height="60" colspan="2" valign="middle" bgcolor="#D3F3FE"><?php include("bot.php"); ?></td>
        </tr>

    </table></td>
  </tr>
</table>
</body>
</html>