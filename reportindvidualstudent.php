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
</style>
</head>

<body>
<div style="margin-left:50px;padding-left:100px; width:70%">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td height="30" colspan="2" align="center" id="td-line-bottom"><table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td width="18%"><img src="logo.png" width="100" height="88" /></td>
        <td width="82%"><p align="center"><?php include("rptheader.php");?></p>
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
        <td width="247">
		<?php if($row['img']=="")
		{
			if($row['sexstatus']=="Male") 
			{ ?>
        <img src="uploads/male.jpg" width="138" height="156" border="1" />        <?php }else if($row['sexstatus']=="Female") {?>
				<img src="uploads/female.jpg" width="148" height="156" border="1" />
			<?php 
			}
		}else{?>
			<img src="uploads/<?php echo $row['img']; ?>" width="148" height="156" border="1" />
		<?php }?>
		</td>
        <td colspan="2">
          <table width="371" border="0" cellspacing="4" cellpadding="0">
            <tr>
              <td><span style="font-size:24px; font-weight:bold; "><?php echo $row['stdname'];?></span></td>
            </tr>
            <tr>
              <td>ID : <?php echo $row['stdid'];?></td>
            </tr>
            <tr>
              <td>Phone : <?php echo $row['phone'];?></td>
            </tr>
            <tr>
              <td>Date of Birth : <?php echo $row['dob'];?></td>
            </tr>
            <tr>
              <td>Religion : <?php echo $row['religion'];?></td>
            </tr>
            <tr>
              <td>Blood Group : <?php echo $row['bgroup'];?></td>
            </tr>
          </table>          </td>
        </tr>
      <tr>
        <td><strong>Father's Name </strong></td>
        <td width="11"><strong>:</strong></td>
        <td width="430"><?php echo $row['fname'];?></td>
      </tr>
      <tr>
        <td><strong>Mother's Name </strong></td>
        <td><strong>:</strong></td>
        <td><?php echo $row['mname'];?></td>
      </tr>
      <tr>
        <td><strong>Present Address</strong></td>
        <td><strong>:</strong></td>
        <td><?php echo $row['praddress'];?></td>
      </tr>
      <tr>
        <td><strong>Permanent Address</strong></td>
        <td><strong>:</strong></td>
        <td><?php echo $row['peraddress'];?></td>
      </tr>
      <tr>
        <td><strong>Sex</strong></td>
        <td><strong>:</strong></td>
        <td><?php echo $row['sexstatus'];?></td>
      </tr>
      <tr bgcolor="#F4F4FF">
        <td height="33" colspan="3" class="style5"><strong>Academic  Information</strong></td>
        </tr>
      <tr>
        <td><strong>Department</strong></td>
        <td><strong>:</strong></td>
        <td><?php echo $row['department'];?></td>
      </tr>
      <tr>
        <td><strong>Batch</strong></td>
        <td><strong>:</strong></td>
        <td><?php echo $row['batchname'];?></td>
      </tr>
      <tr>
        <td><strong>Session</strong></td>
        <td><strong>:</strong></td>
        <td><?php echo $row['session'];?></td>
      </tr>
      <tr>
        <td><strong>Admitted Semester</strong></td>
        <td><strong>:</strong></td>
        <td><?php echo $row['SemesterName'];?></td>
      </tr>
      <tr>
        <td><strong>Current Semester</strong></td>
        <td><strong>:</strong></td>
        <td><?php echo $rowm['CurrentSemesterName'];?></td>
      </tr>
      <tr>
        <td><strong>Board Registration No</strong></td>
        <td><strong>:</strong></td>
        <td><?php echo $row['boardregno'];?></td>
      </tr>
      <tr>
        <td><strong>Board Roll No </strong></td>
        <td><strong>:</strong></td>
        <td><?php echo $row['boardrollno'];?></td>
      </tr>
      <tr>
        <td><strong>Hostel Name </strong></td>
        <td><strong>:</strong></td>
        <td><?php echo $row['hostelname'];?></td>
      </tr>
      <tr>
        <td><strong>Seat No </strong></td>
        <td><strong>:</strong></td>
        <td><?php echo $row['seat'];?></td>
      </tr>
      <tr bgcolor="#F4F4FF">
        <td height="34" colspan="3"><span class="style5"><strong>Educational Information </strong></span></td>
        </tr>
      <tr>
        <td colspan="3"><div align="center">
		<table width="93%" height="54" border="0" cellpadding="0" cellspacing="2" bordercolor="#FFFFFF" bgcolor="#E6F2FF">
                  <tr bgcolor="#F4F4FF">
                    <td width="36%" height="25"><strong>Exam Name </strong></td>
                    <td width="19%"><strong>Board</strong></td>
                    <td width="17%"><strong>Group</strong></td>
                    <td width="16%"><strong>Passing Year </strong></td>
                    <td width="12%"><strong>CGPA</strong></td>
                  </tr>
					<?php 
  				  $crs="SELECT * FROM `tbl_educationalq` WHERE stdid='$sid'";
				  $crq=$myDb->select($crs); 
				  $count=0;
  				  while($crsr=$myDb->get_row($crq,'MYSQL_ASSOC')){

					?>
                  <tr bgcolor="#FFFFFF">
                    <td><?php echo $crsr['nexemination'];?></td>
                    <td><?php echo $crsr['board'];?></td>
                    <td><?php echo $crsr['group1'];?></td>
                    <td><?php echo $crsr['passyear'];?></td>
                    <!--td><?php //echo $crsr['cgpas'];?></td-->
					<td><?php echo $crsr['tcgpa'];?></td>
                  </tr>
                  <?php }?>
                </table>
		</div></td>
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
  header("Location:index.php");
}
}