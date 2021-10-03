<?php ob_start();
session_start();
require_once('dbClass.php');
include("config.php"); 
if($myDb->connect($host,$user,$pwd,$db,true))
{ 
  if($_SESSION['userid']){
  $chka="SELECT*FROM  tbl_accdtl WHERE flname='manage_voucher.php' AND userid='$_SESSION[userid]'";
  $caq=$myDb->select($chka);
  $car=$myDb->get_row($caq,'MYSQL_ASSOC');
  if($car['ins']=="y"){
    $fdate=mysql_real_escape_string($_POST['fdate']);
  $tdate=mysql_real_escape_string($_POST['tdate']);

  echo "The from date is:".$fdate;
  echo "The To date is:".$tdate;
  echo "The date is '$fdate' and '$tdate'";
  
  
?>
<table width="803" border="0" cellspacing="0" cellpadding="0" class="rep-table">
  <tr>    <td width="40" bgcolor="#CCCCCC"><div align="left"><strong><span class="style8"> Name</span></strong></div></td>

    <td width="96" bgcolor="#CCCCCC" class="style8"><div align="center"><strong><span class="style8">Written Down <br />
      Value at the<br /> 
      Begining of <br />
    The Year </span></strong></div></td>
    <td width="113" bgcolor="#CCCCCC"><div align="center"><strong><span class="style8">Addition <br />
      During <br />
    The year </span></strong></div></td>
    <td width="140" bgcolor="#CCCCCC"><div align="center"><strong><span class="style8">Balance As<br /> 
      on During the year<br />
    The year </span></strong></div></td>
    <td width="67" bgcolor="#CCCCCC"><div align="center"><strong><span class="style8">Rate</span></strong></div></td>
    <td width="43" bgcolor="#CCCCCC"><div align="center"><strong><span class="style8">Balance As on During the year </span></strong></div></td>
    <td width="103" bgcolor="#CCCCCC"><div align="center"><strong><span class="style8">Charged during <br />
    the year </span></strong></div></td>
    <td width="103" bgcolor="#CCCCCC"><div align="center"><strong><span class="style8">Balance<br />
      as on<br />
        during <br />
        the year
        <br />
      <br /> 
     </span></strong></div></td>
    <td width="98" bgcolor="#CCCCCC" class="style8"><div align="center"><strong><span class="style8">Written Down <br />
      Value end<br /> 
      Of the Year <br />
    The Year </span></strong></div></td>
  </tr>
  <?php $tmp=$myDb->select("select distinct groupname from tbl_2ndjournal where groupname
							  IN (SELECT id
								  FROM tbl_accchart
								  WHERE parentid IN (SELECT id
													 FROM tbl_accchart
													 
													 WHERE accname = 'Fixed Assets'
								))
						  ");
	  while($tmpf=$myDb->get_row($tmp,'MYSQL_ASSOC')){
      $bg=$myDb->select("SELECT (select ifnull(sum(amountcr),0)+(select ifnull(sum(amountcr),0)
											FROM tbl_2ndjournal
											WHERE groupname='$tmpf[groupname]'
											and vdate between '$fdate' and '$tdate'
											) 
								 		
									   )'Total',(select ifnull(sum(amountcr),0)
	                                                           from tbl_2ndjournal
															   where YEAR(vdate)<(YEAR(curdate()))
															   AND groupname='$tmpf[groupname]'
															   ) 'Previous year',year('$tdate') tyear,
								
								(select accname from tbl_accchart where id='$tmpf[groupname]') 'Account Name',(select ifnull(sum(amountcr),0)
											FROM tbl_2ndjournal
											WHERE groupname='$tmpf[groupname]'
											and YEAR(vdate)=YEAR('$tdate')
											) Addition,(SELECT drate FROM fixed_dep WHERE accno='$tmpf[groupname]' and methodtype='Diminishing') rate
											FROM tbl_2ndjournal
											WHERE groupname='$tmpf[groupname]'
											AND vdate<'$fdate'
		");
$bgf=$myDb->get_row($bg,'MYSQL_ASSOC');	  
	  
	  
	
  ?>				  		
  <tr>   <?php echo "The year is:".$bgf['tyear']; ?> 
    <td height="30"><div align="left" class="style10"><?php echo $bgf['Account Name']; ?></div></td>
    <td height="30"><div align="center" class="style10"><?php echo ($bgf['Total']); //(($bgf['Total']*$bgf['Rate'])/100); ?></div></td>
    <td height="30"><div align="center" class="style10"><?php echo $bgf['Addition']; ?></div></td>
    <td height="30"><div align="center" class="style10"><?php echo $calcharge=($bgf['Total']+$bgf['Addition']); ?></div></td>
    <td height="30"><div align="center" class="style10"><?php echo $bgf['rate']; ?></div></td>
    <td height="30"><div align="center" class="style10"><?php echo $bgf['Previous year']; ?></div></td>
	<td><div align="center" class="style10"><?php $calcua=(($bgf['Addition']*$bgf['rate'])/100)/2; 
	                                              $calcub=(($calcharge*$bgf['rate'])/100);
	                                              echo $charge=($calcub-$calcua); ?></div></td>
	<td height="30"><div align="center" class="style10"><?php echo $fval=$bgf['Previous year']+$charge; ?></div></td>
    <td height="30"><div align="center" class="style10"><?php echo $calcharge-$fval; ?></div></td>
  </tr>
  <?php } ?>
</table>
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