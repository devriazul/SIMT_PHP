<?php ob_start();
session_start();
require_once('dbClass.php');
include("config.php"); 
include('inwordfinal.php');

if($myDb->connectDefaultServer())
{ 
  if($_SESSION['userid']){
	
	$syear=$_POST['syear'];
	$smonth=$_POST['smonth'];
  	$vs="SELECT es.*,sf.bankaccno as BankAccNo  FROM tbl_employeesalary es inner join vw_allstaff sf on es.empid=sf.StaffID WHERE es.monthname='$smonth' and es.yearname='$syear' and sf.bankaccno like 'cash%'";
  	$r=$myDb->select($vs);
  	$row=$myDb->get_row($r,'MYSQL_ASSOC'); 



?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title><?php include("title.php");?></title>
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
.style5 {font-family: "Times New Roman", Times, serif}
.style6 {font-size: 12px}
.style8 {font-family: "Times New Roman", Times, serif; font-size: 12px; }
</style>
</head>

<body>
<div style="margin-left:50px;padding-left:100px; width:70%">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td height="30" colspan="2" align="center" >  
  </tr>
  <tr>
    <td height="30" colspan="2" align="center" >  
  </tr>
  <tr>
    <td height="30" colspan="2" align="center" >  
  </tr>
  <tr>
    <td height="30" colspan="2" align="center" >  
  </tr>
  <tr>
    <td height="30" colspan="2" align="center" >  
  </tr>
  <tr>
    <td height="30" colspan="2" align="center" >  
  </tr>
  <tr>
    <td height="30" colspan="2" align="center" ><strong>Employee Salary
    </strong></tr>
  <tr>
    <td height="30" colspan="2" align="center" >For the Month of: <?php echo $_POST['smonth'].", ".$_POST['syear'];?>  
  </tr>
  <tr>
    <td height="30" colspan="2" align="center" >  
      <div align="right"><strong>Date:</strong><?php echo date("d.m.Y");?></div>
    </tr>
  <tr>
    <td colspan="2" align="center"><div align="left">
      </div></td>
  </tr>
  <tr>
    <td colspan="2" align="left">
	<table width="100%" cellpadding="2" cellspacing="1" bgcolor="#000000">
      <tr bgcolor="#F4F4FF">
        <th width="7%" height="26"><div align="left" class="style5 style6">SL No. </div></th>
        <th width="28%"><div align="left"><span class="style8">Name of the Employee(s) </span></div></th>
        <th width="18%"><div align="left" class="style8">Desigantion</div></th>
        <th width="17%"><div align="left" class="style8">
            <div align="right">Amount (Tk.) </div>
        </div></th>
        <th width="17%"><span class="style8">Signature</span></th>
        <th width="13%"><div align="right" class="style8">Remarks</div></th>
      </tr>
      <?php 
		$i=0;
		$show="SELECT es.*,sf.bankaccno as BankAccNo, d.name as designationname  FROM tbl_employeesalary es inner join vw_allstaff sf on es.empid=sf.StaffID inner join tbl_designation d on sf.DesigId=d.id WHERE es.monthname='$smonth' and es.yearname='$syear' and sf.bankaccno like 'cash%'";
  		$qry=$myDb->select($show);
		while($dt=$myDb->get_row($qry,'MYSQL_ASSOC')){
		?>
      <tr bgcolor="#FFFFFF">
        <td ><div align="left" class="style8"><span style="text-align:left; " ><?php echo $i=$i+1; ?></span></div></td>
        <td ><div align="left" class="style8"><?php echo $dt['empname']; ?></div></td>
        <td ><div align="left" class="style8"><?php echo $dt['designationname'];?></div></td>
        <td ><div align="right" class="style8"><?php echo number_format($dt['netpay'],2); ?></div></td>
        <td >&nbsp;</td>
        <td ><div align="right" class="style8"></div></td>
      </tr>
      <?php } ?>
    </table>
	<table width="100%" cellpadding="2" cellspacing="1" bgcolor="#000000">
      <tr bgcolor="#FFFFFF">
        <td width="7%" ><div align="left"></div></td>
        <td width="28%" ><div align="left"></div></td>
        <td width="18%" ><div align="left"><strong>Total : </strong></div></td>
        <td width="17%" ><div align="right"><span style="font-weight:bold; ">
            <?php $nw="Select ifnull(sum(es.netpay),0) as totalamount FROM tbl_employeesalary es inner join vw_allstaff sf on es.empid=sf.StaffID WHERE es.monthname='$smonth' and es.yearname='$syear' and sf.bankaccno like 'cash%'";
				$nwfetch=$myDb->select($nw);
  				$rowt=$myDb->get_row($nwfetch,'MYSQL_ASSOC'); 
				echo number_format($rowt['totalamount'],2);
				?>
        </span></div></td>
        <td width="17%" >&nbsp;</td>
        <td width="13%" ><div align="right"><span style="font-weight:bold; ">
        </span></div></td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td colspan="2" align="center"><div align="left" class="style5 style6"><span style="font-weight:bold; ">In Words: </span><?php echo convert_number($rowt['totalamount'])." Taka only."; ?></div></td>
  </tr>
  <tr>
    <td colspan="2" align="center">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="2" align="center">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="2" align="center">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="2" align="center"><div align="left">
      <table width="100%"  border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td><strong>Prepared By:</strong></td>
          <td><div align="right"><strong>Approved By:</strong></div></td>
        </tr>
        <tr>
          <td>Sabina Banu</td>
          <td><div align="right">Mrs. Shohaly Easmin </div></td>
        </tr>
        <tr>
          <td><em>Admin Officer</br>            
            </em></td>
          <td><div align="right"><em>Director</em></div></td>
        </tr>
      </table>
    </div></td>
  </tr>
  <tr>
    <td colspan="2" align="center">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="2" align="center">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="2" align="center">&nbsp;</td>
  </tr>
</table>
</div>
</body>
</html>
<?php 

}else{
  header("Location:login.php");
}
}  
?>
