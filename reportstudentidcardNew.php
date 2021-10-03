<?php ob_start();
session_start();
require_once('dbClass.php');
include("config.php"); 
if($myDb->connect($host,$user,$pwd,$db,true))
{ 
  if($_SESSION['userid']){
	$sid=$_GET['sid'];
  	$vs="SELECT s.*,  d.name as department, b.batchname as batchname, h.name as hostelname, sm.name as SemesterName FROM `tbl_stdinfo` s inner join tbl_department d on s.deptname=d.id inner join tbl_batch b on s.batch=b.id inner join tbl_hostel h on s.hostelid=h.id inner join tbl_semester sm on s.semester=sm.id WHERE s.storedstatus<>'D' AND stdid='$sid'";
  	$r=$myDb->select($vs);
  	$row=$myDb->get_row($r,'MYSQL_ASSOC'); 

  	$vsm="SELECT sm.name as CurrentSemesterName FROM `tbl_stdinfo` s inner join tbl_semester sm on s.stdcursemester=sm.id WHERE s.storedstatus<>'D' AND stdid='$sid'";
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

body {
	margin-top: 0px;
	margin-bottom: 0px;
	margin-left: 0px;
	margin-right: 0px;
}
.style8 {
	font-size: 14px;
	font-weight: bold;
}
.style9 {font-size: 12px; color: #000000}
.style10 {font-size: 12px; color: #000000; }
.style11 {font-size: 12px; font-weight: bold; color: #000000; }
.style15 {font-size: 30px; font-weight: bold; color: #000000; font-family: "Free 3 of 9"; margin-left:2px; }
</style>
</head>

<body>
<div style=" width:340px; hieght:210px;"; ></div>
  <table width="340" height="210"  border="0" cellpadding="0" cellspacing="0" background="images/BG.jpg">
    <tr>
      <td height="45" colspan="2" align="left" valign="top">&nbsp;</td>
    </tr>
    <tr>
      <td  colspan="2" align="left" valign="top"><div align="center">
        </div></td>
    </tr>
    <tr>
      <td width="253" align="left" valign="top"><table width="98%" border="0" align="center" cellpadding="0" cellspacing="0">
        <tr>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <td><span class="style11">Name</span></td>
          <td><span class="style10">:</span> <span class="style10"><span style="font-size:12px; font-weight:bold; color: #000000;"><?php echo $row['stdname'];?></span></span></td>
        </tr>
        <tr>
          <td width="63"><span class="style11">Department</span></td>
          <td width="187"><span class="style10">:</span> <span class="style10"><?php echo substr($row['department'],3);?></span></td>
        </tr>
        <tr>
          <td><span class="style11">ID No</span></td>
          <td><span class="style10">:</span> <span class="style10"><?php echo $row['stdid'];?></span></td>
        </tr>
        <tr>
          <td><span class="style11">Session</span></td>
          <td><span class="style10">:</span> <span class="style10"><?php echo "20".substr($row['session'],0,2)."-"."20".substr($row['session'],-2,4);?></span></td>
        </tr>
		<tr>
          <td><span class="style11">BloodGroup</span></td>
          <td><span class="style10">:</span> <span class="style10"><?php echo $row['bgroup'];?></span></td>
        </tr>
      </table></td>
		
      <td width="87" align="left" valign="top"><div align="right">
        <?php if($row['img']=="")
		{
			if($row['sexstatus']=="Male") 
			{ ?>
        <img src="uploads/male.jpg" width="85" height="100" hspace="6" vspace="5" border="1" />
        <?php }else if($row['sexstatus']=="Female") {?>
        <img src="uploads/female.jpg" width="85" height="100" hspace="6" vspace="5" border="1" />
        <?php 
			}
		}else{?>
        <img src="uploads/<?php echo $row['img']; ?>" width="85" height="100" hspace="6" vspace="5" border="1" />        <?php }?>
</div></td>
    </tr>
	<tr>
      	<td colspan="2" height="auto"  align="left" valign="top"><span class="style15"><?php echo "*".$row['stdid']."*";?></span></td>
    </tr>
  </table>
  
  <blockquote>&nbsp;</blockquote>
</body>
</html>
<?php 

}else{
  header("Location:index.php");
}
}