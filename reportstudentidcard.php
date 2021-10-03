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
.style5 {
	font-size: 18px;
	font-weight: bold;
}

body {
	margin-top: 0px;
	margin-bottom: 0px;
}
.style6 {font-size: 18px}
.style8 {
	font-size: 14px;
	font-weight: bold;
}
</style>
</head>

<body>
<div style=" width:340px; hieght:210px;"; >
  <table width="100%" border="0" cellspacing="0" cellpadding="0">
    <tr>
      <td rowspan="2" align="center" valign="top" id="td-line-bottom"><img src="images/ID%20Card%20Logo-1.jpg" height="285px" /></td>
      <td rowspan="2" align="center" valign="top" id="td-line-bottom"><img src="images/ID%20CArd%20Logo.jpg" height="285px"/></td>
      <td height="30" colspan="2" align="center" id="td-line-bottom"><img src="images/ID%20Card-4.jpg" width="100%" height="32" />
        <table width="100%"  border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td><img src="images/SimT%20Logo.jpg" height="64px"; width="72px"; /></td>
            <td><td align="center"><span style="font-size:18px; font-weight:bold; color:#FF0000;">SAIC INSTITUTE OF MANAGEMENT & TECHNOLOGY (SIMT)</span></td></td>
          </tr>
        </table> </td>
    </tr>
    <tr>
      <td colspan="2" align="center"><table width="100%" border="0" cellspacing="0" cellpadding="0">
        
        <tr>
          <td width="247" valign="top">
            <?php if($row['img']=="")
		{
			if($row['sexstatus']=="Male") 
			{ ?>
            <img src="uploads/male.jpg" width="92" height="100" border="1" />
            <?php }else if($row['sexstatus']=="Female") {?>
            <img src="uploads/female.jpg" width="92" height="100" border="1" />
            <?php 
			}
		}else{?>
            <img src="uploads/<?php echo $row['img']; ?>" width="92" height="100" border="1" />
            <?php }?>
          </td>
          <td width="441" colspan="2" valign="top">
            <table width="300" border="0" cellspacing="4" cellpadding="0">
              <tr>
                <td width="97" class="style8">Name</td>
                <td width="231"><span class="style6">:</span> <span style="font-size:16px;"><?php echo $row['stdname'];?></span></td>
              </tr>
              <tr>
                <td><span class="style8">Department</span></td>
                <td><span class="style6">:</span> <?php echo $row['department'];?></td>
              </tr>
              <tr>
                <td><span class="style8">Roll No</span></td>
                <td><span class="style6">:</span> <?php echo $row['stdid'];?></td>
              </tr>
              <tr>
                <td><span class="style8">Session</span></td>
                <td><span class="style6">:</span> <?php echo $row['session'];?></td>
              </tr>
          </table>
            <div align="right"><img src="images/md-sign.png" width="130" height="52" /></div></td>
        </tr>
        <tr>
          <td height="33" colspan="3" class="style5"><img src="images/ID%20Card-5.jpg" width="100%" height="32" /></td>
        </tr>
        <tr>
          <td colspan="3"><div align="left"></div></td>
        </tr>
      </table> </td>
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