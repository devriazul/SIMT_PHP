<?php session_start();
require_once('dbClass.php');
include("config.php"); 
if($myDb->connect($host,$user,$pwd,$db,true))
{ 
  	if($_SESSION['userid']){
  	$id=mysql_real_escape_string($_GET['id']);
  	//$vs="SELECT*FROM tbl_leave WHERE id='$id'";
  	$vs="Select s.id as sid, s.stdid as StudentId, s.stdname as StudentName, h.id as hid, h.name as HostelName from `tbl_stdinfo` s inner join `tbl_hostel` h on s.hostelid=h.id Where s.stdid<>'' and s.id='$id' UNION Select s.id as sid, s.exstid as StudentId, s.stdname as StudentName, h.id as hid, h.name as HostelName from `tbl_stdinfo` s inner join `tbl_hostel` h on s.hostelid=h.id Where s.exstid<>'' and s.id='$id'";
  	$r=$myDb->select($vs);
  	$row=$myDb->get_row($r,'MYSQL_ASSOC');
  	//echo $row['hid'];
  	$chka="SELECT*FROM  tbl_accdtl WHERE flname='manageallocatehostel.php' AND userid='$_SESSION[userid]'";
  	$caq=$myDb->select($chka);
  	$car=$myDb->get_row($caq,'MYSQL_ASSOC');
    if(($car['ins']=="y")||($_SESSION['userid']=="administrator")){
  
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title><?php include("title.php");?></title>

<style type="text/css">
<!--
@import url("main.css");
.style12 {font-size: 10px}
.style15 {
	font-size: 12px;
	font-family: Verdana, Arial, Helvetica, sans-serif;
}
.style16 {font-size: 12px}

-->
</style>
<script type="text/javascript" src="jquery.js"></script>
<script type='text/javascript' src='jquery.autocomplete.js'></script>
<link rel="stylesheet" type="text/css" href="jquery.autocomplete.css" />

<script type="text/javascript">
$().ready(function() {
	$("#searchid").autocomplete("search_studentbyid.php", {
		width: 260,
		matchContains: true,
		//mustMatch: true,
		//minChars: 0,
		//multiple: true,
		//highlight: false,
		//multipleSeparator: ",",
		selectFirst: false
	});
});
</script>
<script language type="text/javascript"> 
function handleEnter (field, event) {
		var keyCode = event.keyCode ? event.keyCode : event.which ? event.which : event.charCode;
		if (keyCode == 13) {
			var i;
			for (i = 0; i < field.form.elements.length; i++)
				if (field == field.form.elements[i])
					break;
			i = (i + 1) % field.form.elements.length;
			field.form.elements[i].focus();
			return false;
		} 
		else
		return true;
	}      
</script>
<script src="#" type="text/javascript"></script>
<script type="text/javascript" language="javascript"> 
window.onload=function() {
document.forms[0][0].focus();
}
</script>

<script type="text/javascript">
function loadXMLDoc(p,r)
{
var xmlhttp;
if (window.XMLHttpRequest)
  {// code for IE7+, Firefox, Chrome, Opera, Safari
  xmlhttp=new XMLHttpRequest();
  }
else
  {// code for IE6, IE5
  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
xmlhttp.onreadystatechange=function()
  {	
    if(xmlhttp.readyState == 3)  // Loading Request
	{
	document.getElementById("myDiv"+r).innerHTML = '<img src="loader.gif" align="center" />';
	}  
  if (xmlhttp.readyState==4 && xmlhttp.status==200)
    {
      document.getElementById("myDiv"+r).innerHTML=xmlhttp.responseText;
	//document.getElementById("tr"+r).style.display="none"; 
    //document.getElementById("pid").focus();	
	}
  }
xmlhttp.open("GET","roomwisehostelseatdetails.php?id="+p+"&count="+r,true);

xmlhttp.send();
}

</script>
<script type="text/javascript">
function toggleAndChangeText(r) {
     $('#myDiv'+r).toggle('slow');
     if ($('#myDiv'+r).css('display') == 'none') {
	     $('#aTag'+r).html('CLOSE SEAT DETAILS &#9658');
     }
     else {                    
	 
	     $('#aTag'+r).html('VIEW SEAT DETAILS &#9660');

     }
}
</script>



</head>

<body>
<table width="1047" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td width="1047" height="152" valign="top" background="images/1.jpg"><span class="style17"><?php include("topdefault.php");?>    </span></span></td>
  </tr>
  <tr>
    <td><table width="100%" border="0" cellspacing="0" cellpadding="0" id="tblleft">
      <tr>
        <td height="28" colspan="2" bgcolor="#0C6ED1"><div align="center" class="style1"><?php include("company.php"); ?></div></td>
        </tr>
      <tr>
        <td background="images/leftbg.jpg"><img src="images/leftbg.jpg" width="252" height="3" /></td>
        <td><img src="images/spaer.gif" width="1" height="1" /></td>
      </tr>
      <tr>
        <td width="21%" valign="top" background="images/leftbg.jpg"><?php include("left.php"); ?>
                   <br />
          
          <p>&nbsp;</p>
          <p>&nbsp;</p></td>
        <td width="79%" valign="top">
<p align="center" ><font face="Arial, Helvetica, sans-serif" size="2"><?php if(isset($_GET['msg'])){ echo $_GET['msg'];  }?></font></p>


<div id="top-search-div"> 
           <div id="content">
		   <label>Hostelseat Information </label>
		   <div class="input">
		   <form method="post" autocomplete="off" action="manageallocatehostel1.php">
		     <label>Search Form</label>
			 <label><input type="text" id="searchid" name="searchid" placeholder="Search by student ID" /></label>
			 <label><input type="submit" name="subs" id="submit-btn" value="Search" /></label>
			 <label><a href="add_hostelseatdetails.php"><input type="button" name="addbtn" id="submit-btn" value="Add New" /></a></label>
			  
		   </form>
		   </div>
		</div>
		</div>
		<br />
		
          <div align="center"><br />
          <table width="61%" border="0" align="center" cellpadding="0" cellspacing="5" id="stdtbl">

            <tr>
              <td height="20" colspan="2" class="style2" style="padding:3px; border-bottom:1px solid #CCCCCC;"> HOSTEL SEAT DISTRIBUTION INFORMATION</td>
              </tr>
            <tr>
              <td width="31%" height="20" class="style2">Student ID  :</td>
              <td width="69%" height="20"><input name="studentid" type="text" id="studentid" readonly="true" style="font-family: Verdana; font-size: 8pt; border: 1px solid #3399FF"  size="29" value="<?php echo $_SESSION['Studentid']=$row['StudentId']; ?>" /></td>
            </tr>
            <tr>
              <td height="20" class="style2">Student Name  :</td>
              <td height="20"><input name="studentname" type="text" id="studentname" readonly="true" style="font-family: Verdana; font-size: 8pt; border: 1px solid #3399FF"  size="29" value="<?php echo $row['StudentName']; ?>" /></td>
            </tr>
            <tr>
              <td height="20" class="style2">Hostel Name:</td>
              <td height="20"><input name="hostelname" type="text" id="hostelname" readonly="true" style="font-family: Verdana; font-size: 8pt; border: 1px solid #3399FF"  size="29" value="<?php echo $row['HostelName']; ?>" /></td>
            </tr>
            <tr>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
            </tr>
            <tr>
              <td colspan="2">
				<?php 
				$qs="Select s.id as sid, s.stdid as StudentId, s.stdname as StudentName, h.seatno as SeatNo, r.roomno as RoomNo, h.price as Price, h.status as Status from `tbl_stdinfo` s inner join `tbl_hostelseatdetails` h on s.stdid=h.stdid inner join `tbl_hostelseat` r on h.roomid=r.id Where s.stdid<>'' and s.id='$id'  UNION Select s.id as sid, s.exstid as StudentId, s.stdname as StudentName, h.seatno as SeatNo, r.roomno as RoomNo, h.price as Price, h.status as Status from `tbl_stdinfo` s inner join `tbl_hostelseatdetails` h on s.exstid=h.stdid inner join `tbl_hostelseat` r on h.roomid=r.id Where s.exstid<>'' and s.id='$id' ";
			  	$qr=$myDb->select($qs);
  				$qrow=$myDb->get_row($qr,'MYSQL_ASSOC');
				if($qrow['Status']=="1")
				{	
					echo "Selected Student Room No: ".$qrow['RoomNo']. ", Seat No: ".$qrow['SeatNo'].", Rent: ". $qrow['Price']."." ; 
				}
				else
				{
				?>
				

				<table width="97%" border="0" align="left" cellpadding="0" cellspacing="0" class="style2" id="stdtbl">
                <tr>
                  <td width="33%" height="25" bgcolor="#F3F3F3" class="style15">Room No </td>
                  <td width="30%" height="25" bgcolor="#F3F3F3" class="style15">Students Per Room </td>
                  <td height="25" align="center" bgcolor="#F3F3F3" class="style15">Action</td>
                </tr>
                <?php
			      $hid=$row['hid'];
				  //if(isset($_POST['stdid'])){
				  $std="SELECT `id`,`roomno`,`noofstudent` FROM `tbl_hostelseat` WHERE hostelid='$hid' and storedstatus<>'D' order by id asc ";
			      $stdq=$myDb->select($std);
				  $count=0;
				  while($stdr=$myDb->get_row($stdq,'MYSQL_ASSOC'))
				  {
				  	if($count%2==0)
					{
				  		$bgcolor="#FFFFFF";
				  		?>
                <tr bgcolor="<?php echo $bgcolor; ?>">
                  <td height="25" class="style4"><?php echo $stdr['roomno']; ?></td>
                  <td height="25" align="center" class="style4"><?php echo $stdr['noofstudent']; ?></td>
                  <td width="37%" align="center" class="style4"><a onclick="loadXMLDoc('<?php echo $stdr['id']; ?>','<?php echo $count; ?>')" id="aTag<?php echo $count; ?>" href="javascript:toggleAndChangeText(<?php echo $count; ?>);" >CLOSE SEAT DETAILS &#9658</a> </td>
                </tr>
                <tr bgcolor="" id="tbl">
                  <td colspan="7"><div id="myDiv<?php echo $count; ?>" style="width:400px;" align="center"></div></td>
                </tr>
                <?php 
					}
					else
					{ 
						$bgcolor="#F7FCFF"; ?>
                <tr bgcolor="<?php echo $bgcolor; ?>">
                  <td height="25" class="style4"><?php echo $stdr['roomno']; ?></td>
                  <td height="25" align="center" class="style4"><?php echo $stdr['noofstudent']; ?></td>
                  <td height="25" align="center" class="style4"><a onclick="loadXMLDoc('<?php echo $stdr['id']; ?>','<?php echo $count; ?>')" id="aTag<?php echo $count; ?>" href="javascript:toggleAndChangeText(<?php echo $count; ?>);" >CLOSE SEAT DETAILS &#9658</a></td>
                </tr>
                <tr bgcolor="" id="tbl">
                  <td colspan="7"><div id="myDiv<?php echo $count; ?>" style="width:400px;" align="center"></div></td>
                </tr>
                <?php 
					}
			  		$count++;
			  		
                 
				}?>
			      
				
			
				  
			
              </table>
<?php }?>
			    </td>
            </tr>
            <tr>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
            </tr>
            <tr>
              <td>&nbsp;</td>
              <td></td>
            </tr>
          </table>          
          </div>

           
           <br />
          		<div id="MyResult" align="center"></div> 
          		          
<p></p>
</td>
      </tr>
	        <tr>
        <td height="60" colspan="2" valign="middle" bgcolor="#D3F3FE"><?php include("bot.php"); ?></td>
        </tr>

    </table></td>
  </tr>
</table>
</body>
</html>
<?php 
   }else{
     $msg="Sorry,you are not authorized to access this page";
	 header("Location:home.php?msg=$msg");
   }	 

}else{
  header("Location:index.php");
}
}