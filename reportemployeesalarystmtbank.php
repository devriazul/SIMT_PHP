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
  	$vs="SELECT es.*,sf.bankaccno as BankAccNo  FROM tbl_employeesalary es inner join vw_allstaff sf on es.empid=sf.StaffID WHERE es.monthname='$smonth' and es.yearname='$syear' and sf.bankaccno<>'' and sf.bankaccno not like 'cash%'";
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
    <td colspan="2" align="center"><div align="left">
      <table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td width="25%">Date : </td>
          <td width="25%">&nbsp;</td>
          <td width="25%">&nbsp;</td>
          <td width="25%">&nbsp;</td>
        </tr>
        <tr>
          <td>The Manager </td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <td>AB Bank Ltd. </td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <td>Dear Sir, </td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <td colspan="4">Salary Advice from <span style="font-weight:bold; "> SIMT A/C # 4022-792721-000</span> for the month of <span style="font-weight:bold; "><?php echo $_POST['smonth']?>, <?php echo $_POST['syear']?></span>. Please make the pay transfer from above A/C no to the below mentioned A/C no towards employee salaries:</td>
          </tr>
        <tr>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
        </tr>
      </table>
    </div></td>
  </tr>
  <tr>
    <td colspan="2" align="left">
	
	<table width="100%" cellpadding="2" cellspacing="1" bgcolor="#F5F5F5">
      <tr bgcolor="#F4F4FF">
        <th width="9%" height="26"><div align="left" class="style5 style6">SL No. </div></th>
        <th width="41%"><div align="left" class="style8">Name of the Employee(s) </div></th>
        <th width="31%"><div align="left" class="style8">Bank Account No</div></th>
        <th width="19%"><div align="right" class="style8">Amount (Tk.) </div></th>
      </tr>
  	<?php 
		$i=0;
		$show="SELECT es.*,sf.bankaccno as BankAccNo  FROM tbl_employeesalary es inner join vw_allstaff sf on es.empid=sf.StaffID WHERE es.monthname='$smonth' and es.yearname='$syear' and sf.bankaccno<>'' and sf.bankaccno not like 'cash%'";
  		$qry=$myDb->select($show);
		while($dt=$myDb->get_row($qry,'MYSQL_ASSOC')){
		?>
      <tr bgcolor="#FFFFFF">
        <td ><div align="left" class="style8"><span style="text-align:left; " ><?php echo $i=$i+1; ?></span></div></td>
        <td ><div align="left" class="style8"><?php echo $dt['empname']; ?></div></td>
        <td ><div align="left" class="style8"><?php echo $dt['BankAccNo']; ?></div></td>
        <td ><div align="right" class="style8"><?php echo number_format($dt['netpay'],2); ?></div></td>
      </tr>
      <?php } ?>
    </table>	
	
	<table width="100%" cellpadding="2" cellspacing="1" bgcolor="#F5F5F5">
      <tr bgcolor="#FFFFFF">
        <td width="9%" ><div align="left"></div></td>
        <td width="41%" ><div align="left"></div></td>
        <td width="31%" ><div align="left"><strong>Total : </strong></div></td>
        <td width="19%" ><div align="right"><span style="font-weight:bold; ">
            <?php $nw="Select ifnull(sum(es.netpay),0) as totalamount FROM tbl_employeesalary es inner join vw_allstaff sf on es.empid=sf.StaffID WHERE es.monthname='$smonth' and es.yearname='$syear' and sf.bankaccno<>'' and sf.bankaccno not like 'cash%'";
				$nwfetch=$myDb->select($nw);
  				$rowt=$myDb->get_row($nwfetch,'MYSQL_ASSOC'); 
				echo number_format($rowt['totalamount'],2);
				?>
        </span></div></td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td colspan="2" align="center"><div align="left" class="style5 style6"><span style="font-weight:bold; ">In Words: </span><?php echo convert_number($rowt['totalamount']); ?></div></td>
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
    <td colspan="2" align="center"><div align="left">Sincerely Yours </div></td>
  </tr>
  <tr>
    <td colspan="2" align="center">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="2" align="center">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="2" align="center"><span style="font:Calibri; font-size:12px; color:#CCCCCC; ">Powered By: <a href="https://riaz.fastitbd.com">(Web Developer) </a><a href="https://www.saicgroupbd.com">Saic Group</a>. 12, Kawran Bazar. BDBL Bhaban (6th Floor). Dhaka-1215. Cell: +88 01823015681</span></td>
  </tr>
</table>
</div>
</body>
</html>
<?php 

}else{
  header("Location:index.php");
}
}  
?>
