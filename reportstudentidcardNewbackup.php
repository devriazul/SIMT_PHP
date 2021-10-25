<?php ob_start();
session_start();
require_once('dbClass.php');
include("config.php"); 
if($myDb->connectDefaultServer())
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
.style15 {font-size: 28px; font-weight: bold; color: #000000; font-family: "Free 3 of 9"; }
</style>
</head>

<body>
<div style=" width:340px; hieght:210px;"; ></div>
  <table width="340" height="210"  border="0" cellpadding="0" cellspacing="0" background="images/BG.jpg">
    <tr>
      <td width="87" height="45" align="left" valign="top">&nbsp;</td>
      <td width="253">&nbsp;</td>
    </tr>
    <tr>
      <td  colspan="2" align="left" valign="top"><div align="center">
        <table width="100%"  border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td width="19%">&nbsp;</td>
            <td width="81%"><div align="center"><span style="font-size:12px; font-weight:bold; color: #FFFFFF;"><?php echo $row['stdname'];?></span></div></td>
          </tr>
        </table>
        </div></td>
    </tr>
    <tr>
      <td align="left" valign="top"><?php if($row['img']=="")
		{
			if($row['sexstatus']=="Male") 
			{ ?>
        <img src="uploads/male.jpg" width="85" height="100" border="1" />
        <?php }else if($row['sexstatus']=="Female") {?>
        <img src="uploads/female.jpg" width="85" height="100" border="1" />
        <?php 
			}
		}else{?>
        <img src="uploads/<?php echo $row['img']; ?>" width="85" height="100" border="1" />
        <?php }?>
        		
		</td>
		
      <td align="left" valign="top"><table width="100%" border="0" cellpadding="0" cellspacing="1">
        <tr>
          <td width="63"><span class="style11">Department</span></td>
          <td width="182"><span class="style10">:</span> <span class="style9"><?php echo substr($row['department'],3);?></span></td>
        </tr>
        <tr>
          <td><span class="style11">Roll No</span></td>
          <td><span class="style10">:</span> <span class="style9"><?php echo $row['stdid'];?></span></td>
        </tr>
        <tr>
          <td><span class="style11">Session</span></td>
          <td><span class="style10">:</span> <span class="style9"><?php echo $row['session'];?></span></td>
        </tr>
       
      </table>
      </td>
    </tr>
	<tr>
      	<td colspan="2" height="auto"  align="left" valign="top"><span class="style15"><?php echo "*".$row['stdid']."*";?></span></td>
   	  </tr>
  </table>
  
</body>
</html>
<?php 

}else{
  header("Location:index.php");
}
}