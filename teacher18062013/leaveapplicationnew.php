<?php 
ob_start();
session_start();
require_once('dbClass.php');
include("config.php"); 
if($myDb->connectDefaultServer())
{ 
  if($_SESSION['userid']){
	
    if(isset($_GET['msg'])){ $msg=$_GET['msg']; }
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title><?php include("title.php");?></title>



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


<link rel="stylesheet" href="js/nyroModal-1.3.0/styles/nyroModal.css" type="text/css" media="screen" />



<script type="text/javascript" src="JQdtp/jquery.min.js"></script>
<script type="text/javascript" src="JQdtp/jquery-ui.min.js"></script>
<script type="text/javascript" src="JQdtp/jquery-ui-i18n.min.js"></script>
<link rel="stylesheet" type="text/css" href="JQdtp/jquery-ui.css">

	<script type="text/javascript">
		/*
		 * jQuery UI Datepicker: Internationalization and Localization
		 * http://salman-w.blogspot.com/2013/01/jquery-ui-datepicker-examples.html
		 */
		$(function() {
			$("#fdate").datepicker($.datepicker);

			$("#tdate").datepicker($.extend({}, $.datepicker, {
				showWeek: true
			}));
			//$("#datepicker-3").datepicker($.datepicker.regional["de"]).datepicker("option", {
			//	changeMonth: true,
			//	changeYear: true
			//});
		});
	</script>


<script language="javascript">


 $(document).ready(function(){
   $('.sbmt').click(function(){
     var arr=$('#frm').serializeArray();
	 
	 $.post('insleaveapplication.php',arr,function(result){
	    $('#shw').html(result);
	 });
	 $('#shw').hide().fadeIn('slow');
   });
 });
</script>
<script language="javascript">
 $(document).ready(function(){
     $('#applyfor').change(function(){
         var applyfor=$('#applyfor').val();
         var arr=$('#frm').serializeArray();
        $.post('dayscount.php?dayscount='+applyfor,arr,function(rec){
           $('#td').val(rec);
        });
     });
  });

</script>

<script type="text/javascript" language="javascript"> 
window.onload=function() {
document.forms[0][0].focus();
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
        <td height="28" colspan="2" bgcolor="#0C6ED1"><div align="center" class="style1">SAIC INSTITUTE OF MANAGEMENT TECHNOLOGY</div></td>
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
<p align="center" ><font face="Arial, Helvetica, sans-serif" size="2"><?php if(isset($_GET['t'])==1){ if(isset($msg)){ echo "<span style='color:#00CC00; font-weight:bold;'>$msg</span>";} ?><?php } if(isset($_GET['t'])==0){ if(isset($msg)){ echo "<span style='color:#FF9900; font-weight:bold;'>$msg</span>"; } } ?></font></p>
<table width="100" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td><div align="center">
      <form name="MyForm" id="frm" autocomplete="off"  method="post" >
        <table width="80%" border="0" align="center" cellpadding="0" cellspacing="2" id="stdtbl">
          <tr>
            <td height="20" bgcolor="#FFE8F3" class="style2" style="padding:3px; border-bottom:1px solid #CCCCCC;">Balance Leave </td>
          </tr>
          <?php //$empid=$_GET['empid'];
  				$vs="SELECT f.*, d.name as Designation FROM tbl_faculty f inner join tbl_designation d on f.designationid=d.id WHERE f.facultyid='$_SESSION[userid]' and f.storedstatus<>'D'";
  				$r=$myDb->select($vs);
  				$row=$myDb->get_row($r,'MYSQL_ASSOC'); //echo $row['Designation']; exit;
				if(($row['clstatus']==1) || ($row['slstatus']==1) || ($row['alstatus']==1))
				{
				?>
          <tr>
            <td height="32" class="style2" style="padding:3px; border-bottom:1px solid #CCCCCC;">
              <table width="90%" align="center"  border="0" cellpadding="0" cellspacing="1" bgcolor="#FFFFFF">
                <tr bgcolor="#DFF4FF">
                  <td width="25%" height="23">
                    <?php 
				if($row['clstatus']==1)
				{
	  				$rvs="SELECT * FROM tbl_leave WHERE Code='CL' and storedstatus<>'D'";
	  				$rr=$myDb->select($rvs);
  					$rrow=$myDb->get_row($rr,'MYSQL_ASSOC'); 
	  				$rvp="SELECT * FROM tbl_leavedetails WHERE ltype='CL' and efid='$_SESSION[userid]' and storedstatus<>'D'";
	  				$rp=$myDb->select($rvp);
  					$rowp=$myDb->get_row($rp,'MYSQL_ASSOC'); 
					$reaminigdays=$rrow['dayscount']-$rowp['spenddays']; ?>
                    <span style=" font:Arial; font-weight:normal; font-size:12px;">Your Casual Leave left </span><span style="font-size:12px; color:#FF0000 "><?php echo $reaminigdays;?></span><span style="font-size:12px; font-weight:normal;"> days out of </span> <span style="font-size:12px; color:#FF0000 "><?php echo $rrow['dayscount'];?></span><span style="font-size:12px; font-weight:normal; "> days. </span>
                    <?php }else{  ?>
                    <span style=" font-size:12px; color:#FF0000 "> <?php echo "Sorry! your Casual Leave is not assigned yet"; }?></span> </td>
                </tr>
                <tr bgcolor="#DFF4FF">
                  <td width="25%" height="23">
                    <?php 
				if($row['slstatus']==1)
				{
	  				$rvs="SELECT * FROM tbl_leave WHERE Code='SL' and storedstatus<>'D'";
	  				$rr=$myDb->select($rvs);
  					$rrow=$myDb->get_row($rr,'MYSQL_ASSOC'); 
	  				$rvp="SELECT * FROM tbl_leavedetails WHERE ltype='SL' and efid='$_SESSION[userid]' and storedstatus<>'D'";
	  				$rp=$myDb->select($rvp);
  					$rowp=$myDb->get_row($rp,'MYSQL_ASSOC'); 
					$reaminigdays=$rrow['dayscount']-$rowp['spenddays']; ?>
                    <span style="font-size:12px;">Your Sick Leave left </span><span style="font-size:12px; color:#FF0000 "><?php echo $reaminigdays;?></span><span style="font-size:12px;"> days out of </span> <span style="font-size:12px; color:#FF0000 "><?php echo $rrow['dayscount'];?></span> days;
                    <?php }else{ ?>
                    <span style="font-size:12px;  color:#FF0000 "> <?php echo "Sorry! your Sick Leave is not assigned yet."; }?></span> </td>
                </tr>
                <tr bgcolor="#DFF4FF">
                  <td width="25%" height="23">
                    <?php 
				if($row['alstatus']==1)
				{
	  				$rvs="SELECT * FROM tbl_leave WHERE Code='AL' and storedstatus<>'D'";
	  				$rr=$myDb->select($rvs);
  					$rrow=$myDb->get_row($rr,'MYSQL_ASSOC'); 

	  				$rvp="SELECT * FROM tbl_leavedetails WHERE ltype='AL' and efid='$_SESSION[userid]' and storedstatus<>'D'";
	  				$rp=$myDb->select($rvp);
  					$rowp=$myDb->get_row($rp,'MYSQL_ASSOC'); 
					$reaminigdays=$rrow['dayscount']-$rowp['spenddays']; ?>
                    <span style="font-size:12px;">Your Annual Leave left </span><span style="font-size:12px; color:#FF0000 "><?php echo $reaminigdays;?></span><span style="font-size:12px;"> days out of </span> <span style="font-size:12px; color:#FF0000 "><?php echo $rrow['dayscount'];?></span> days;
                    <?php }else{ ?>
                    <span style="font-size:12px; color:#FF0000 "> <?php echo "Sorry! your Annual Leave is not assigned yet."; }?></span> </td>
                </tr>
            </table></td>
          </tr>
          <tr>
            <td width="47%" align="center" height="20" class="style2"><table width="80%" border="0" align="center" cellpadding="0" cellspacing="0" id="stdtbl">
                <tr bgcolor="#F3F3F3">
                  <td height="29" colspan="6" class="style2">General Information</td>
                </tr>
                <tr>
                  <td width="13%" height="20" class="style2">Faculty ID</td>
                  <td width="3%" class="style2"><div align="center">: </div></td>
                  <td width="33%" class="style2"><span style="font-weight:normal; font-size:12px; "><?php echo $row['facultyid'];?></span>
                      <input type="hidden" value="<?php echo $row['facultyid']; ?>" name="empid" id="empid" /></td>
                  <td width="11%" class="style2"> Name </td>
                  <td width="1%" class="style2">: </td>
                  <td width="39%" height="20"><span style="font-weight:normal; font-size:12px; "><?php echo $row['name'];?></span>
                      <input type="hidden" value="<?php echo $row['name']; ?>" name="empname" id="empname" /></td>
                </tr>
                <tr>
                  <td height="20" class="style2">Designation </td>
                  <td class="style2"><div align="center">:</div></td>
                  <td class="style2"><span style="font-weight:normal; font-size:12px; "><?php echo $row['Designation'];?></span>
                      <input type="hidden" value="<?php echo $row['Designation']; ?>" name="desig" id="desig" /></td>
                  <td class="style2">Apply For</td>
                  <td class="style2">:</td>
                  <td height="20"><select name="applyfor" id="applyfor" onkeypress="return handleEnter(this, event)">
                      <option>Select Leave Type</option>
                      <?php $hq=$myDb->select("select name, code from tbl_leave Where storedstatus<>'D'");
				   while($hrow=$myDb->get_row($hq,'MYSQL_ASSOC')){
				   ?>
                      <option value="<?php echo $hrow['code']; ?>"><?php echo $hrow['name']; ?></option>
                      <?php } ?>
                    </select>
                      <input type="hidden" id="td" name="td" style="width: 80px" /></td>
                </tr>
                <tr bgcolor="#F5F5F5">
                  <td height="32" colspan="6" bgcolor="#F5F5F5" class="style2">Leave Period </td>
                </tr>
                <tr>
                  <td height="20" class="style2">From</td>
                  <td class="style2">:</td>
                  <td class="style2"><input type="text" id="fdate" name="fdate" style="width: 80px" value="<?php echo date('Y-m-d');?>" /></td>
                  <td class="style2">To</td>
                  <td class="style2">:</td>
                  <td height="20"><input type="text" id="tdate" name="tdate" style="width: 80px" value="<?php echo date('Y-m-d');?>"/></td>
                </tr>
                <tr>
                  <td height="20" class="style2">Reason </td>
                  <td class="style2">&nbsp;</td>
                  <td height="20" colspan="4" class="style2"><select name="reason" id="reason" onkeypress="return handleEnter(this, event)">
                      <option value="Select Reason" selected="selected">Select Reason</option>
                      <option value="Personal Problem">Personal Problem</option>
                      <option value="I will go home">I will go home</option>
                  </select></td>
                </tr>
                <tr bgcolor="#F5F5F5">
                  <td height="30" colspan="6" class="style2">During this period my classse has been arranged as follows: </td>
                </tr>
                <tr>
                  <td height="20" class="style2">Remarks</td>
                  <td class="style2">:</td>
                  <td  colspan="4" ><textarea name="remarks" cols="30"  id="remarks" style="font-family: Verdana; width:500px; font-size: 8pt; border: 1px solid #3399FF" ></textarea></td>
                </tr>
                <tr>
                  <td height="20" class="style2">&nbsp;</td>
                  <td class="style2">&nbsp;</td>
                  <td class="style2">&nbsp;</td>
                  <td class="style2">&nbsp;</td>
                  <td class="style2">&nbsp;</td>
                  <td height="20">&nbsp;</td>
                </tr>
                <tr>
                  <td>&nbsp;</td>
                  <td>&nbsp;</td>
                  <td><input name="button" type="button" class="sbmt" style="color: #999999; font-size: 8pt; font-family: Verdana; border: 1px solid #C0C0C0; background-color: #D9F0FB" value="Apply For Leave" /></td>
                  <td>&nbsp;</td>
                  <td>&nbsp;</td>
                  <td>&nbsp; </td>
                </tr>
                <?php }else{
					?>
                <span style="color:#FF0000; font-size:12px;" ><?php echo "No Leave is assigned to this ID."; ?></span>
                <?php 
					exit;
				  
				} ?>
            </table></td>
          </tr>
          <tr>
            <td height="20" class="style2"><span class="style4"> </span>
                <div id="shw"></div></td>
          </tr>
        </table>
      </form>
    </div></td>
  </tr>
</table><p align="center" >&nbsp;</p></td>
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
  header("Location:index.php");
}
}  
?>