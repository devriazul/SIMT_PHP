<?php ob_start();
session_start();
require_once('dbClass.php');
include("config.php"); 
if($myDb->connect($host,$user,$pwd,$db,true))
{ 
  if($_SESSION['userid']){
	$sid=$_GET['sid'];
  	$vs="SELECT s.*, dg.name as designation, p.basicpay as basicpay, p.name as payscale FROM `tbl_staffinfo` s inner join tbl_designation dg on s.designationid=dg.id inner join tbl_payscale p on s.payscaleid=p.id WHERE s.storedstatus<>'D' AND sid='$sid'";
  	$r=$myDb->select($vs);
  	$row=$myDb->get_row($r,'MYSQL_ASSOC'); 


  	$vsm="SELECT ifnull(SUM(securitymoney),0) as SecurityMoney, ifnull(SUM(pfundamount),0) as PFundAmount FROM `tbl_employeesalary` WHERE storedstatus<>'D' AND empid='$sid'";
  	$rm=$myDb->select($vsm);
  	$rowm=$myDb->get_row($rm,'MYSQL_ASSOC'); 


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
      border-top:1px solid #CCCCCC;
  }	
  #td-line-bottom{
      border-bottom:1px solid #CCCCCC;
  }
  #td-line-left{
        border-top:1px solid #CCCCCC;

      border-left:1px solid #CCCCCC;
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
.style5 {
	font-size: 18px;
	font-weight: bold;
}

body {
	margin-top: 0px;
	margin-bottom: 0px;
	margin-left: 0px;
	margin-right: 0px;
}
</style>
</head>

<body>
<div style="margin-left:50px;padding-left:100px; width:70%">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td height="30" colspan="2" align="center" id="td-line-bottom"><table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td width="14%"><img src="logo.png" width="100" height="88" /></td>
        <td width="86%"><p align="center"><?php include("rptheader.php");?></p>
          </td>
      </tr>
    </table>  
    <td>  </tr>
  <tr>
    <td height="32" colspan="2" align="center" bgcolor="#F4F4FF"><div align="left" class="style5">Personal Information </div></td>
  </tr>
  <tr>
    <td colspan="2" align="center">
	
	<table width="100%" border="0" cellspacing="4" cellpadding="0">
      <tr>
        <td width="264">
		<?php if($row['img']=="")
		{
			if($row['sex']=="Male") 
			{ ?>
        <img src="teacher/uploads/male.jpg" width="138" height="156" border="1" />        <?php }else if($row['sex']=="Female") {?>
				<img src="teacher/uploads/female.jpg" width="148" height="156" border="1" />
			<?php 
			}
		}else{?>
			<img src="teacher/uploads/<?php echo $row['img']; ?>" width="148" height="156" border="1" />
		<?php }?>
		</td>
        <td colspan="2">
          <table width="371" border="0" cellspacing="4" cellpadding="0">
            <tr>
              <td><span style="font-size:24px; font-weight:bold; "><?php echo $row['name'];?></span></td>
            </tr>
            <tr>
              <td><em>ID :</em> <?php echo $row['sid'];?></td>
            </tr>
            <tr>
              <td><em>Phone :</em> <?php echo $row['cellno'];?></td>
            </tr>
            <tr>
              <td><em>Date of Birth :</em> <?php echo $row['dob'];?></td>
            </tr>
            <tr>
              <td><em>Marital Status :</em> <?php echo $row['maritalstatus'];?></td>
            </tr>
            <tr>
              <td><em>Blood Group :</em> <?php echo $row['bloodgroup'];?></td>
            </tr>
          </table>          </td>
        </tr>
      <tr>
        <td><strong>Father's Name </strong></td>
        <td width="14"><strong>:</strong></td>
        <td width="410"><?php echo $row['fname'];?></td>
      </tr>
      <tr>
        <td><strong>Mother's Name </strong></td>
        <td><strong>:</strong></td>
        <td><?php echo $row['mname'];?></td>
      </tr>
      <tr>
        <td><strong>Address</strong></td>
        <td><strong>:</strong></td>
        <td><?php echo $row['paddress'];?></td>
      </tr>
      <tr>
        <td><strong>Sex</strong></td>
        <td><strong>:</strong></td>
        <td><?php echo $row['sex'];?></td>
      </tr>
      <tr bgcolor="#F4F4FF">
        <td height="33" colspan="3" class="style5"><strong>Academic  Information</strong></td>
        </tr>
      
      <tr>
        <td><strong>Joining Date </strong></td>
        <td><strong>:</strong></td>
        <td><?php echo $row['joindate'];?></td>
      </tr>
      <tr>
        <td><strong>Designation</strong></td>
        <td><strong>:</strong></td>
        <td><?php echo $row['designation'];?></td>
      </tr>
      <tr>
        <td><strong>Baisc Salary </strong></td>
        <td><strong>:</strong></td>
        <td><?php echo $row['basicpay']." BDT";?></td>
      </tr>
      <tr>
        <td><strong>Bank Account No </strong></td>
        <td><strong>:</strong></td>
        <td><?php echo $row['bankaccno'];?></td>
      </tr>
      <tr>
        <td><strong>Employeement Type </strong></td>
        <td><strong>:</strong></td>
        <td><?php echo $row['etype'];?></td>
      </tr>
      <tr bgcolor="#F4F4FF">
        <td height="34" colspan="3"><span class="style5"><strong>Financial Information </strong></span></td>
        </tr>
      <tr>
        <td><strong>Security Money (Paid so far) </strong></td>
        <td><strong>:</strong></td>
        <td><?php echo $rowm['SecurityMoney']." BDT";?></td>
      </tr>
      <tr>
        <td><strong>Provident Fund  (In Account so far) </strong></td>
        <td><strong>:</strong></td>
        <td><?php echo $rowm['PFundAmount']." BDT";?></td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td colspan="3"><div align="left"><span style="font:'Times New Roman', Times, serif; font-size:12px; ">N.B. If u want to know any further information please call: +88 02 8033034, +88 02 8055586 </span></div></td>
        </tr>
    </table>
	</td>
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
