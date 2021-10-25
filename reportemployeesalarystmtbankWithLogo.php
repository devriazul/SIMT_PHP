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
  	$vs="SELECT es.*,sf.bankaccno as BankAccNo  FROM tbl_employeesalary es inner join vw_allstaff sf on es.empid=sf.StaffID WHERE es.monthname='$smonth' and es.yearname='$syear' and sf.bankaccno<>''";
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
.style4 {font-family: Arial, Helvetica, sans-serif; font-size:18px;}
</style>
</head>

<body>
<div style="margin-left:50px;padding-left:100px; width:70%">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td height="30" colspan="2" align="center" id="td-line-bottom"><table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td><img src="logo.png" width="100" height="88" /></td>
        <td><p align="center"><span id="header"><span class="style4">SAIC INSTITUTE OF MANAGEMENT & TECHNOLOGY (SIMT)</span></span> </p>
          <p align="center"><span id="sub-header">Road#2, House #1, Block -B, Section-6,<span id="sub-header">Mirpur, Dhaka -1216</span><br />
  Phone: 8033034, 8055586; E-Mail :simt140@gmail.com</span></p></td>
      </tr>
    </table>    </tr>
  <tr>
    <td height="30" colspan="2" align="center" id="td-line-bottom"><strong>SALARY ADVICE</strong>    
  </tr>
  <tr>
    <td colspan="2" align="center"><div align="left">
      <table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td width="17%">Date : </td>
          <td width="33%">&nbsp;</td>
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
          <td>IFIC Bank Ltd. </td>
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
          <td colspan="4">Salary Advice from <span style="font-weight:bold; "> SIMT A/C # 01013472198001</span> for the month of <span style="font-weight:bold; "><?php echo $_POST['smonth']?>, <?php echo $_POST['syear']?></span>. Please make the pay transfer from above A/C no to the below mentioned A/C no towards employee salaries:</td>
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
        <th width="9%" height="26"><div align="left"><span >SL No. </span></div></th>
        <th width="41%"><div align="left"><span >Name of the Employee(s) </span></div></th>
        <th width="31%"><div align="left"><span >Bank Account No</span></div></th>
        <th width="19%"><div align="right"><span >Amount (Tk.) </span></div></th>
      </tr>
  	<?php 
		$i=0;
		$show="SELECT es.*,sf.bankaccno as BankAccNo  FROM tbl_employeesalary es inner join vw_allstaff sf on es.empid=sf.StaffID WHERE es.monthname='$smonth' and es.yearname='$syear' and sf.bankaccno<>''";
  		$qry=$myDb->select($show);
		while($dt=$myDb->get_row($qry,'MYSQL_ASSOC')){
		?>
      <tr bgcolor="#FFFFFF">
        <td ><div align="left"><span style="text-align:left; " ><?php echo $i+1; ?></span></div></td>
        <td ><div align="left"><span ><?php echo $dt['empname']; ?></span></div></td>
        <td ><div align="left"><span ><?php echo $dt['BankAccNo']; ?></span></div></td>
        <td ><div align="right"><span ><?php echo number_format($dt['netpay'],2); ?></span></div></td>
      </tr>
      <?php } ?>
    </table>	
	
	<table width="100%" cellpadding="2" cellspacing="1" bgcolor="#F5F5F5">
      <tr bgcolor="#FFFFFF">
        <td width="9%" ><div align="left"></div></td>
        <td width="41%" ><div align="left"></div></td>
        <td width="31%" ><div align="left"><strong>Total : </strong></div></td>
        <td width="19%" ><div align="right"><span style="font-weight:bold; ">
            <?php $nw="Select ifnull(sum(es.netpay),0) as totalamount FROM tbl_employeesalary es inner join vw_allstaff sf on es.empid=sf.StaffID WHERE es.monthname='$smonth' and es.yearname='$syear' and sf.bankaccno<>''";
				$nwfetch=$myDb->select($nw);
  				$rowt=$myDb->get_row($nwfetch,'MYSQL_ASSOC'); 
				echo number_format($rowt['totalamount'],2);
				?>
        </span></div></td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td colspan="2" align="center"><div align="left"><span style="font-weight:bold; ">In Words: </span><?php echo convert_number($rowt['totalamount']); ?></div></td>
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
    <td colspan="2" align="center"><span style="font:Calibri; font-size:12px; color:#CCCCCC; ">Powered By: DesktopBD. 12, Kawran Bazar. BDBL Bhaban (6th Floor). Dhaka-1215. Cell: +88 01823015681</span></td>
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
