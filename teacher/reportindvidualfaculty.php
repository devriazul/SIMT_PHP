<?php ob_start();
session_start();
require_once('dbClass.php');
include("config.php"); 
if($myDb->connect($host,$user,$pwd,$db,true))
{ 
  if($_SESSION['userid']){
	//$fid=$_GET['facultyid'];
  	$vs="SELECT f.*, d.name as department, dg.name as designation, p.basicpay as basicpay, p.name as payscale FROM `tbl_faculty` f inner join tbl_department d on f.deptid=d.id inner join tbl_designation dg on f.designationid=dg.id inner join tbl_payscale p on f.payscaleid=p.id WHERE f.storedstatus<>'D' AND facultyid='$_SESSION[userid]'";
  	$r=$myDb->select($vs);
  	$row=$myDb->get_row($r,'MYSQL_ASSOC'); 

  	$vsm="SELECT ifnull(SUM(securitymoney),0) as SecurityMoney, ifnull(SUM(pfundamount),0) as PFundAmount FROM `tbl_employeesalary` WHERE storedstatus<>'D' AND empid='$_SESSION[userid]'";
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
.style5 {
	font-family:Arial, Helvetica, sans-serif;
	font-size: 16px;
	font-weight: bold;
}

.hfont {
	font-family:Calibri;
	font-size: 14px;
	font-weight: bold;
}

.bfont {
	font-family:Calibri;
	font-size: 12px;
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
<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" id="tblleft">  
  <tr>
    <td height="30" colspan="2" align="center" id="td-line-bottom"><table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td width="14%"><img src="logo.png" width="100" height="88" /></td>
        <td width="86%"><p align="center"><?php include("rptheader.php");?></p>
          </td>
      </tr>
    </table>    </tr>
  <tr>
    <td height="14" colspan="2" align="center" id="td-line-bottom">    </tr>
  <tr>
    <td id="td-line-bottom" height="32" colspan="2" align="center" bgcolor="#F4F4FF"><div align="left" class="style5">Personal Information </div></td>
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
              <td class="style5"><span style="font-size:24px; font-weight:bold; "><?php echo $row['name'];?></span></td>
            </tr>
            <tr>
              <td class="hfont"><em>ID :</em> <?php echo $row['facultyid'];?></td>
            </tr>
            <tr>
              <td class="hfont"><em>Phone :</em> <?php echo $row['contactno'];?></td>
            </tr>
            <tr>
              <td class="hfont"><em>Date of Birth :</em> <?php echo $row['dob'];?></td>
            </tr>
            <tr>
              <td class="hfont"><em>Marital Status :</em> <?php echo $row['mstatus'];?></td>
            </tr>
            <tr>
              <td class="hfont"><em>Sex :</em> <?php echo $row['sex'];?></td>
            </tr>
            <tr>
              <td class="hfont"><em>Blood Group :</em> <?php echo $row['bloodgroup'];?></td>
            </tr>
          </table>          </td>
        </tr>
      <tr>
        <td><strong class="hfont">Father's Name </strong></td>
        <td width="14"><strong>:</strong></td>
        <td width="410" class="bfont"><?php echo $row['fname'];?></td>
      </tr>
      <tr>
        <td><strong class="hfont">Mother's Name </strong></td>
        <td><strong>:</strong></td>
        <td class="bfont"><?php echo $row['mname'];?></td>
      </tr>
      <tr>
        <td><strong class="hfont">Address</strong></td>
        <td><strong>:</strong></td>
        <td class="bfont"><?php echo $row['address'];?></td>
      </tr>
      <tr bgcolor="#F4F4FF" id="td-line-bottom">

        <td id="td-line-bottom" height="33" colspan="3" class="style5"><strong>Academic  Information</strong></td>
        </tr>
      <tr>
        <td><strong class="hfont">Department</strong></td>
        <td><strong>:</strong></td>
        <td class="bfont"><?php echo $row['department'];?></td>
      </tr>
      <tr>
        <td><strong class="hfont">Joining Date </strong></td>
        <td><strong>:</strong></td>
        <td class="bfont"><?php echo $row['joiningdate'];?></td>
      </tr>
      <tr>
        <td class="hfont"><strong>Designation</strong></td>
        <td><strong>:</strong></td>
        <td class="bfont"><?php echo $row['designation'];?></td>
      </tr>
      <tr>
        <td class="hfont"><strong>Baisc Salary </strong></td>
        <td><strong>:</strong></td>
        <td class="bfont"><?php echo $row['basicpay']." BDT";?></td>
      </tr>
      <tr>
        <td class="hfont"><strong>Bank Account No </strong></td>
        <td><strong>:</strong></td>
        <td class="bfont"><?php echo $row['bankaccno'];?></td>
      </tr>
      <tr>
        <td class="hfont"><strong>Employeement Type </strong></td>
        <td><strong>:</strong></td>
        <td class="bfont"><?php echo $row['type'];?></td>
      </tr>
      <tr>
        <td class="hfont"><strong>Security Money (Paid so far) </strong></td>
        <td><strong>:</strong></td>
        <td class="bfont"><?php echo $rowm['SecurityMoney']." BDT";?></td>
      </tr>
      <tr>
        <td class="hfont"><strong>Provident Fund (In Account so far) </strong></td>
        <td><strong>:</strong></td>
        <td class="bfont"><?php echo $rowm['PFundAmount']." BDT";?></td>
      </tr>
      <tr bgcolor="#F4F4FF">
        <td id="td-line-bottom" height="34" colspan="3"><span class="style5"><strong>Edicational Information</strong></span></td>
        </tr>
      <tr>
        <td height="21" colspan="3"><em>My previous education inforamtions are given below: </em></td>
      </tr>
      <tr>
        <td height="22" colspan="3">
          <div align="left" class="bfont"><?php echo $row['eduqualification'];?></div></td>
      </tr>
      <tr bgcolor="#F4F4FF">
        <td id="td-line-bottom" height="34" colspan="3"><span class="style5"><strong>Working Experience </strong></span></td>
        </tr>
      <tr>
        <td class="hfont"><strong>Experience</strong></td>
        <td><strong>:</strong></td>
        <td class="bfont"><?php echo $row['expyear']." Years ".$row['expmonth']." Months" ;?></td>
      </tr>
      <tr>
        <td class="hfont"><strong>Expert (In Course) </strong></td>
        <td><strong>:</strong></td>
        <td class="bfont"><?php echo $row['expartincourse'];?></td>
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
</body>
</html>
<?php 

}else{
  header("Location:login.php");
}
}  
?>
