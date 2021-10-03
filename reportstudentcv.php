<?php ob_start();
session_start();
require_once('dbClass.php');
include("config.php"); 
if($myDb->connect($host,$user,$pwd,$db,true))
{ 
  if($_SESSION['userid']){
	$stdid=$_GET['stdid'];
  	$vs="SELECT * FROM tbl_stdcv WHERE storedstatus <>'D' AND stdid='$stdid'";
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
.style5 {
	font-size: 18px;
	font-weight: bold;
}
.style6 {
	font-family: Arial;
	font-size: 12px;
	font-weight: bold;
}
.style7 {
	font-family: Arial;
	font-size: 12px;
}

body {
	margin-left: 0px;
	margin-top: 0px;
	margin-right: 0px;
	margin-bottom: 0px;
}
</style>
</head>

<body>
<div style="padding-left:10px; width:100%">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td height="30" colspan="2" align="center" id="td-line-bottom"><table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td width="11%"><img src="logo.png" width="100" height="88" /></td>
        <td width="89%"><p align="center"><?php include("rptheader.php");?></p>          </td>
      </tr>
    </table>    </tr>
  <tr>
    <td height="30" colspan="2" align="center" id="td-line-bottom"><strong>CURRICULUM VITAE </strong>    </tr>
  <tr>
    <td height="34" colspan="2" align="center" bgcolor="#F4F4FF"><div align="left" class="style5">Personal Information </div></td>
  </tr>
  <tr>
    <td colspan="2" align="center">
	
	<table width="100%" border="0" cellspacing="4" cellpadding="0">
      <tr>
        <td colspan="3" valign="top">
          <table width="100%"  border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td><img src="uploads/<?php echo $row['img']; ?>" width="144" height="152" /></td>
              <td><table width="371" border="0" cellspacing="4" cellpadding="0">
                <tr>
                  <td><span style="font-size:24px; font-weight:bold; "><?php echo $row['stdname'];?></span></td>
                </tr>
                <tr>
                  <td>Phone: <?php echo $row['cellno'];?></td>
                </tr>
                <tr>
                  <td>E-mail: <?php echo $row['email'];?></td>
                </tr>
              </table></td>
            </tr>
          </table></td>
        </tr>
      <tr>
        <td width="262"><strong>Name (As Per S.S.C) </strong></td>
        <td width="16"><strong>:</strong></td>
        <td width="408"><?php echo $row['stdname'];?></td>
      </tr>
      <tr>
        <td><strong>Father's Name </strong></td>
        <td><strong>:</strong></td>
        <td><?php echo $row['fname'];?></td>
      </tr>
      <tr>
        <td><strong>Mother's Name </strong></td>
        <td><strong>:</strong></td>
        <td><?php echo $row['mname'];?></td>
      </tr>
      <tr>
        <td><strong>Present Address</strong></td>
        <td><strong>:</strong></td>
        <td><?php echo $row['paddress'];?></td>
      </tr>
      <tr>
        <td><strong>Permanent Address </strong></td>
        <td><strong>:</strong></td>
        <td><?php echo $row['peraddress'];?></td>
      </tr>
      <tr>
        <td><strong>Date of Birth </strong></td>
        <td><strong>:</strong></td>
        <td><?php echo $row['dob'];?></td>
      </tr>
      <tr bgcolor="#F4F4FF">
        <td height="34" colspan="3" class="style5"><strong>Academic  Information</strong></td>
        </tr>
      <tr>
        <td><strong>Department</strong></td>
        <td><strong>:</strong></td>
        <td><?php echo $row['department'];?></td>
      </tr>
      <tr>
        <td><strong>Session</strong></td>
        <td><strong>:</strong></td>
        <td><?php echo $row['session'];?></td>
      </tr>
      <tr>
        <td><strong>Passing Year </strong></td>
        <td><strong>:</strong></td>
        <td><?php echo $row['passingyear'];?></td>
      </tr>
      <tr>
        <td><strong>CGPA</strong></td>
        <td><strong>:</strong></td>
        <td><?php echo $row['cgpa'];?></td>
      </tr>
      <tr bgcolor="#F4F4FF">
        <td height="28" colspan="3"><span class="style5"><strong>Edicational Information </strong></span>(My previous education inforamtions are given below:) </td>
        </tr>
      <tr>
        <td height="66" colspan="3"><div align="center">
          <table width="95%" cellpadding="2" cellspacing="1" bgcolor="#F5F5F5">
            <tr bgcolor="#B7E8FF">
              <th width="18%"><span class="style6">Examinition Name</span></th>
              <th width="15%"><span class="style6">Group</span></th>
              <th width="14%"><span class="style6">Board</span></th>
              <th width="15%"><span class="style6">Passing Year</span></th>
              <th width="18%"><span class="style6">CGPA</span></th>
            </tr>
            <?php $show="SELECT * From tbl_educationalq WHERE stdid='$stdid'";
		   				$qry=$myDb->select($show);
		   			while($dt=$myDb->get_row($qry,'MYSQL_ASSOC')){
		  		?>
            <tr>
              <td style="padding-left:40px;"><span class="style7"><?php echo $dt['nexemination']; ?></span></td>
              <td style="padding-left:40px;"><span class="style7"><?php echo $dt['group1']; ?></span></td>
              <td style="padding-left:40px;"><span class="style7"><?php echo $dt['board']; ?></span></td>
              <td style="padding-left:40px;"><span class="style7"><?php echo $dt['passyear']; ?></span></td>
              <td style="padding-left:40px;"><span class="style7"><?php echo $dt['tcgpa']; ?></span></td>
            </tr>
            <?php } ?>
          </table>
        </div></td>
      </tr>
      <tr>
        <td><strong>Higher Study (If any) </strong></td>
        <td><strong>:</strong></td>
        <td><?php echo $row['higherstudy'];?></td>
      </tr>
      <tr>
        <td><strong>Organization/Institute Name </strong></td>
        <td><strong>:</strong></td>
        <td><?php echo $row['hsorgname'];?></td>
      </tr>
      <tr>
        <td><div align="left"></div></td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
      <tr bgcolor="#F4F4FF">
        <td height="26" colspan="3"><span class="style5"><strong>Working Experience </strong></span></td>
        </tr>
      <tr>
        <td><strong>Organization Name &amp; Address </strong></td>
        <td><strong>:</strong></td>
        <td><?php echo $row['wonameaddress'];?></td>
      </tr>
      <tr>
        <td><strong>Designation</strong></td>
        <td><strong>:</strong></td>
        <td><?php echo $row['designation'];?></td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td colspan="3"><div align="left"><em><span style="font:'Times New Roman', Times, serif; font-size:12px; ">N.B. If u want to know any further information please call: +88 02 8033034, +88 02 8055586 </span></em></div></td>
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
