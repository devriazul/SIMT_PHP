<?php ob_start();
session_start();
include("../config.php"); 
if($myDb->connectDefaultServer())
{ 
  if($_SESSION['userid']){
	$id=$_GET['id'];
  	$vs="SELECT *, DATEDIFF(todate,frmdate) as tdays FROM `tbl_leaveapplication` WHERE storedstatus<>'D' AND lid='$id'";
  	$r=$myDb->select($vs);
  	$row=$myDb->get_row($r,'MYSQL_ASSOC'); 

  	$dvs="SELECT * FROM `tbl_leavemakeuphistory` WHERE storedstatus<>'D' AND lid='$row[lid]'";
  	$rd=$myDb->select($dvs);
  	$rowd=$myDb->get_row($rd,'MYSQL_ASSOC'); 


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

body {
	margin-top: 0px;
	margin-bottom: 0px;
	margin-left: 0px;
	margin-right: 0px;
}
</style>
</head>

<body>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td height="30" colspan="2" align="center" id="td-line-bottom"><table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td width="13%"><div align="right"><img src="logo.png" width="100" height="88" /></div></td>
        <td width="87%"><p align="center"><?php include("rptheader.php");?></p>
          </td>
      </tr>
    </table>    </tr>
  <tr>
    <td colspan="2" align="center"><table width="80%" border="0" cellspacing="0" cellpadding="3">
      <tr>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td>To,</td>
      </tr>
      <tr>
        <td>The <?php 
					$attn="Select d.name from tbl_leaveapplication la inner join tbl_staffinfo s on la.attnto=s.name inner join tbl_designation d on s.designationid=d.id";
					$attnq=$myDb->select($attn);
					$attnrow=$myDb->get_row($attnq, 'MYSQL_ASSOC');
					echo $attnrow['name'];
		?> </td>
      </tr>
      <tr>
        <td>SAIC Institute of Management &amp; Technology</td>
      </tr>
      <tr>
        <td>Mirpur, Dhaka </td>
      </tr>
      <tr>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td><strong>Subject: Prayer for 
            <?php if($row['applyfor']=="AL") {echo "Annual Leave";}elseif($row['applyfor']=="SL") {echo "Sick Leave";}elseif($row['applyfor']=="CL") {echo "Casual Leave";} ?> 
          from/on ' <?php echo date("d M Y",strtotime($row['frmdate']));?>' to' <?php echo date("d M Y",strtotime($row['todate']));?>' . </strong></td>
      </tr>
      <tr>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td>Sir,</td>
      </tr>
      <tr>
        <td>I have the honor to state that I need <?php echo $row['tdays']+1;?> day(s) <?php if($row['applyfor']=="AL") {echo "Annual";}elseif($row['applyfor']=="SL") {echo "Sick";}elseif($row['applyfor']=="CL") {echo "Casual";} ?> leave on account of '<strong><?php echo date("d M Y",strtotime($row['frmdate']));?></strong>' from/on '<strong><?php echo date("d M Y",strtotime($row['todate']));?></strong>'</td>
      </tr>
    </table>
      <table width="80%" height="108" border="1" cellpadding="0" cellspacing="0" bordercolor="#E9E9E9">
        <tr>
          <td height="36" colspan="3"><div align="center"><strong>My Classes during that period has been arranged as follows: </strong></div></td>
        </tr>
        <tr>
          <td height="25" colspan="3"><div align="center"><strong>[Class and Teacher responsible to conduct that class]</strong></div></td>
        </tr>
        <tr>
          <td width="16%" height="25"><strong>Date</strong></td>
          <td width="38%"><strong>Time</strong></td>
          <td width="46%"><strong>Faculty Name </strong></td>
        </tr>
        <?php 


  				  $crs="SELECT * FROM `tbl_leavemakeuphistory` WHERE storedstatus<>'D' AND lid='$id'";
				  $crq=$myDb->select($crs); 
				  $count=0;
  				  while($crsr=$myDb->get_row($crq,'MYSQL_ASSOC')){

					?>
        <tr>
          <td height="20"><?php echo date("d M Y",strtotime($crsr['cdate']));?></td>
          <td><?php echo $crsr['ctime'];?></td>
          <td><?php echo $crsr['fname'];?></td>
        </tr>
        <?php }?>
      </table>      
      <table width="80%"  border="0" cellspacing="0" cellpadding="4">
        <tr>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <td>I, therefore pray and hope that would be kind enough to grant my <strong>
            <?php if($row['applyfor']=="AL") {echo "Annual Leave";}elseif($row['applyfor']=="SL") {echo "Sick Leave";}elseif($row['applyfor']=="CL") {echo "Casual Leave";} ?></strong>, and oblige thereby. </td>
        </tr>
        <tr>
          <td height="29">&nbsp;</td>
        </tr>
        <tr>
          <td>Sincerely Yours, </td>
        </tr>
        <tr>
          <td><strong>Name: </strong><?php echo $row['name'];?></td>
        </tr>
        <tr>
          <td><strong>Designation:</strong><?php echo $row['designation'];?></td>
        </tr>
        <tr>
          <td><strong>Signature:</strong></td>
        </tr>
      </table></td>
  </tr>
  <tr>
    <td colspan="2" align="center">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="2" align="center"><?php include("rptbot.php");?></td>
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
