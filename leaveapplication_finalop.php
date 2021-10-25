<?php 
ob_start();
session_start();
require_once('dbClass.php');
include("config.php"); 
if($myDb->connectDefaultServer())
{ 
  if($_SESSION['userid']){
  $chka="SELECT*FROM  tbl_accdtl WHERE flname='manage_leaveapplication.php' AND userid='$_SESSION[userid]'";
  $caq=$myDb->select($chka);
  $car=$myDb->get_row($caq,'MYSQL_ASSOC');
  if(($car['ins']=="y")||($_SESSION['userid']=="administrator")){

//echo $_GET['id'];
?>

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
			$("#fdate").datepicker($.datepicker.regional["fr"]);
			$("#tdate").datepicker($.extend({}, $.datepicker.regional["es"], {
				showWeek: true
			}));
			//$("#datepicker-3").datepicker($.datepicker.regional["de"]).datepicker("option", {
			//	changeMonth: true,
			//	changeYear: true
			//});
		});
	</script>
<script language="javascript">
/* $(document).ready(function(){
    var id=$('#tid').val(); alert(id);
	$('.sbmt').click(function(){
     var arr=$('#frm').serializeArray();
	 
	 $.post('insapproveleaveapplication.php?id='+id,arr,function(result){
	    $('#shw').html(result);
	 });
	 $('#shw').hide().fadeIn('slow');
   });
 });*/
</script>


      <?php if(isset($_GET['submitted'])) { 
	
			$opdate=date("Y-m-d");
			$empid=$_POST['empid'];
			$empname=$_POST['empname'];
			$designation=$_POST['desig'];
			$applyfor=$_POST['applyfor'];
			$fdate=$_POST['fdate'];
			$tdate=$_POST['tdate'];
			$reason=$_POST['reason'];
			$opby=$_SESSION['userid'];

			$days = floor(strtotime($tdate) - strtotime($fdate)) / (60 * 60 * 24);
			$accepteddays=$days+1;
			$status=$_POST['status'];
			if($status=="Accepted")
			{
				$curmonth= date('F');
				$curyear= date('Y');
				$queryl="INSERT INTO `tbl_leaveassignedhistory` (`efid`, `acceptedfrom`, `acceptedto`, `accepteddays`, `opby`, `opdate`, `storedstatus`,`monthname`,`yearname`) VALUES ('$empid', '$fdate', '$tdate', '$accepteddays', '$opby', '$opdate', 'I', '','$curmonth','$curyear')";
				$myDb->insert_sql($queryl);

				$queryu="UPDATE `tbl_leaveapplication` Set `status`='$status', `opby`='$opby', `opdate`='$opdate', `storedstatus`='U' WHERE `id`='$_POST[tid]'";
				$myDb->update_sql($queryu);
				//----------load previous issued leave----------------
				$vs="SELECT * FROM tbl_leavedetails WHERE efid='$empid' and ltype='$applyfor' and yearname='".date("Y")."'";
				$ril=$myDb->select($vs);
  				$rowil=$myDb->get_row($ril,'MYSQL_ASSOC');
				$totaldays = $rowil['spenddays'] + $accepteddays; 
				$queryld="UPDATE `tbl_leavedetails` Set `spenddays`='$totaldays'  WHERE efid='$empid' and ltype='$applyfor' and yearname='".date("Y")."'";
				$myDb->update_sql($queryld);
			}
			else if($status=="Rejected")
			{
				$queryu="UPDATE `tbl_leaveapplication` Set `status`='$status', `opby`='$opby', `opdate`='$opdate', `storedstatus`='U' WHERE `id`='$_POST[tid]'";
				$myDb->update_sql($queryu);
				
			}

	?>
      <script type="text/javascript">	
		$(document).ready(function(){
			$.nyroModalRemove();
		});
	  </script>

</script>

      <?php
	
} else { 
?>




<form action="<?php echo $_SERVER["PHP_SELF"]."?submitted=true" ?>" method="POST" name="add_new" class="nyroModal" id="add_new" >     
	
<table width="90%" border="0" align="center" cellpadding="0" cellspacing="2" id="stdtbl">
      <tr>
        <td height="20" bgcolor="#FFE8F3" class="style2" style="padding:3px; border-bottom:1px solid #CCCCCC;">Accept/Cancel Leave Application </td>
      </tr>
      <?php //$id=$_POST['id']; exit;
  				$vs="SELECT *, DATEDIFF(todate,frmdate) AS DiffDate FROM tbl_leaveapplication l  WHERE l.id='$_GET[id]' and l.storedstatus<>'D'";
  				$r=$myDb->select($vs);
  				$row=$myDb->get_row($r,'MYSQL_ASSOC'); //echo $row['Designation']; exit;
				
				?>
      <tr>
        <td width="47%" align="center" height="20" class="style2">          <table width="95%" border="0" align="center" cellpadding="0" cellspacing="2" id="stdtbl">
              <tr bgcolor="#F3F3F3">
                <td height="29" colspan="6" class="style2">General Information</td>
              </tr>
              <tr>
                <td width="23%" height="20" bgcolor="#DFF4FF" class="style2">Employee/Faculty ID</td>
                <td width="1%" class="style2">:</td>
                <td width="34%" bgcolor="#DFF4FF" class="style2"><?php echo $row['empid'];?>
                <input type="hidden" value="<?php echo $row['empid']; ?>" name="empid" id="empid" /><input type="hidden" value="<?php echo $row['id']; ?>" name="tid" id="tid" /></td>
                <td width="14%" bgcolor="#DFF4FF" class="style2"> Name </td>
                <td width="1%" class="style2">:</td>
                <td width="27%" height="20" bgcolor="#DFF4FF"><?php echo $row['name'];?>
                    <input type="hidden" value="<?php echo $row['name']; ?>" name="empname" id="empname" /></td>
              </tr>
              <tr>
                <td height="20" bgcolor="#DFF4FF" class="style2">Designation </td>
                <td class="style2">:</td>
                <td bgcolor="#DFF4FF" class="style2"><?php echo $row['designation'];?>
                    <input type="hidden" value="<?php echo $row['designation']; ?>" name="desig" id="desig" /></td>
                <td bgcolor="#DFF4FF" class="style2">Apply For</td>
                <td class="style2">:</td>
                <td height="20" bgcolor="#DFF4FF"><select name="applyfor" id="applyfor" class="style2" onkeypress="return handleEnter(this, event)">
                  <option value="<?php echo $row['applyfor']; ?>" selected="selected"><?php echo $row['applyfor']; ?></option>
                  <?php 
			  	$cat=mysql_query("select name, code from tbl_leave Where storedstatus<>'D'") or die(mysql_error());
	 			while($cfetch=mysql_fetch_array($cat)){
	 			?>
                  <option value="<?php echo $cfetch['code']; ?>"><?php echo $cfetch['name']; ?></option>
                  <?php } ?>
                </select>            </tr>
              <tr bgcolor="#F5F5F5">
                <td height="32" colspan="6" class="style2">Leave Information 
			    <span style="font:'Trebuchet MS'; color:#FF0000; font-size:10px; "><?php $td=  $row['DiffDate']+1; echo "[Apply For: ". $td." day(s) Leave.]";?></span>			  </td>
              </tr>
              <tr>
                <td height="20" bgcolor="#DFF4FF" class="style2">From</td>
                <td class="style2">:</td>
                <td bgcolor="#DFF4FF" class="style2"><input type="text" id="fdate" name="fdate" style="width: 80px" value="<?php echo $row['frmdate'];?>" /></td>
                <td bgcolor="#DFF4FF" class="style2">To</td>
                <td bgcolor="#FFFFFF" class="style2">:</td>
                <td height="20" bgcolor="#DFF4FF"><input type="text" id="tdate" name="tdate" style="width: 80px" value="<?php echo $row['todate'];?>"/></td>
              </tr>
              <tr>
                <td height="20" bgcolor="#DFF4FF" class="style2">Reason </td>
                <td class="style2">:</td>
                <td height="20" colspan="4" bgcolor="#DFF4FF" class="style2"><input name="reason" type="text" id="reason" style="width: 96%" value="<?php echo $row['reason'];?>" readonly="true"/></td>
              </tr>
              <tr>
                <td height="20" bgcolor="#DFF4FF" class="style2">Remarks</td>
                <td class="style2">&nbsp;</td>
                <td height="20" colspan="4" bgcolor="#DFF4FF" class="style2"><textarea name="remarks"><?php echo $row['remarks'];?></textarea></td>
              </tr>
              <tr>
                <td height="20" bgcolor="#DFF4FF" class="style2">Status</td>
                <td class="style2">:</td>
                <td height="20" colspan="4" bgcolor="#DFF4FF" class="style2"><select name="status" id="status" onkeypress="return handleEnter(this, event)">
                  <?php if($row['status']=="Pending"){ ?>
                  <option value="<?php echo $row['status']; ?>" selected="selected">Pending</option>
                <?php } ?>
                  <option value="Pending">Pending</option>
                  <option value="Accepted">Accepted</option>
                  <option value="Rejected">Rejected</option>
                </select></td>
              </tr>
              <tr>
                <td height="36" class="style2">        <input type="hidden" value="<?php echo $_GET['category_id'] ?>" name="category_id" id="category_id" />

        <span class="style4"><span class="style2">
        <input type="submit" name="submit" id="submit" value="Update Leave Application" style="color: #999999; font-size: 8pt; font-family: Verdana; border: 1px solid #C0C0C0; background-color: #D9F0FB" />
        </span></span>
                <td class="style2">&nbsp;</td>
                <td class="style2">&nbsp;</td>
                <td class="style2">&nbsp;</td>
                <td class="style2">&nbsp;</td>
                <td height="36">&nbsp;</td>
              </tr>
        </table></td></tr>
    </table>
</form>

<?php 
   }
	}else{
     $msg="Sorry,you are not authorized to access this page";
	 header("Location:home.php?msg=$msg");
   }	 

}else{
  header("Location:index.php");
}
}