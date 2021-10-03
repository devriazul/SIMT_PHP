<?php 
ob_start();
session_start();
require_once('dbClass.php');
include("config.php"); 
if($myDb->connect($host,$user,$pwd,$db,true))
{ 
  	if($_SESSION['userid'])
	{
		//--------------Serach Previous Lid------------------//
		$chsid="SELECT COUNT(id) as mid FROM `tbl_leaveapplication` WHERE storedstatus<>'D'";
  		$caqs=$myDb->select($chsid);
  		$cars=$myDb->get_row($caqs,'MYSQL_ASSOC');
		$autoid=$cars['mid'] + 1;
			
    	if(isset($_GET['msg'])){ $msg=$_GET['msg']; }
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title><?php include("title.php");?></title>
<style type="text/css">
<!--
@import url("main.css");

div.transbox
  {
  background-color:#ffffff;

  opacity:0.9;
  filter:alpha(opacity=60); /* For IE8 and earlier */
  
  }

-->
</style>



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


 $(document).ready(function(event){
   $('.sbmt').click(function(){
     var arr=$('#frm').serializeArray();
	 /*
	 if($('#fdate').val()<'<?php echo date("Y-m-d"); ?>'){
	   alert("You can not select From Date lower than current date");
	   $('#fdate').focus();
	   $('.ui-state-default').css({'visibility':'collapse'});
	   return false;
	 }
	 
	 if($('#tdate').val()<'<?php echo date("Y-m-d"); ?>'){
	   alert("You can not select To Date lower than current date");
	   $('#tdate').focus();
	   $('.ui-state-default').css({'visibility':'collapse'});
	   return false;
	 }
	 */
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

<script language="javascript">
$(document).keyup(function(e) {
  if(e.keyCode==45){
    $('#bothead').show();
  }
  if(e.keyCode==27){
    $('#bothead').hide();
  }
});
</script>


<script>  
    /* 
    This script is identical to the above JavaScript function. 
    */  
function add_feed()
{
	var div1 = document.createElement('div');
 
	// Get template data
	div1.innerHTML = document.getElementById('newlinktpl').innerHTML;
 
	// append to our form, so that template data
	//become part of form
	document.getElementById('newlink').appendChild(div1);
 
}
 
var ct = 0;
 
function new_link()
{
	ct++;
	var div1 = document.createElement('div');
	div1.id = ct;
 
	// link to delete extended form elements
	var delLink = '<div style="margin-left:-80px;padding:10px;width:250px;text-align:center; font-size:13px; background-color:#666666 height:20px;"><a href="javascript:delIt('+ ct +')"><input type="button" value="Delete" style="border:1px solid #999999;  width:45px; height:28px; font-family:verdana;font-size:10px;padding:10px;"/></a></div>';
 
	div1.innerHTML = document.getElementById('newlinktpl').innerHTML + delLink;
 
	document.getElementById('newlink').appendChild(div1);
 
}
// function to delete the newly added set of elements
function delIt(eleId)
{
	d = document;
 
	var ele = d.getElementById(eleId);
 
	var parentEle = d.getElementById('newlink');
 
	parentEle.removeChild(ele);
 
}
</script>  



<script type="text/javascript" language="javascript"> 
window.onload=function() {
document.forms[0][0].focus();
}
</script>

<style type="text/css">
<!--
.style17 {font-weight: bold}
-->
</style>
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
<div class="transbox"><div id="bothead" style=" position:absolute;  background-color:#666666;   padding:10px; color:#FFFFFF; left:400px;float:right;width:700px; height:auto; display:none; font-family:Verdana, Arial, Helvetica, sans-serif; font-size:12px;">
   
   HOW APPLY FOR A LEAVE:<br/>
  -----------------------------------------<br/><br/>
   <label>* There is a field name "Apply For". Select Leave Type from corresponding combo.</label><br/> 
   <label>* Select From Date and To Date(How many days you want to leave).</label><br/> 
   <label>* Select Reason from "Reason" field.</label><br/> 
   <label>* Then fill up "During this period my classse has been arranged as follows"</label><br/> 

	     
</div></div>

<p align="center" ><font face="Arial, Helvetica, sans-serif" size="2"><?php if(isset($_GET['t'])==1){ if(isset($msg)){ echo "<span style='color:#00CC00; font-weight:bold;'>$msg</span>";} ?><?php } if(isset($_GET['t'])==0){ if(isset($msg)){ echo "<span style='color:#FF9900; font-weight:bold;'>$msg</span>"; } } ?></font></p>
<table width="100" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td><div align="center">
      <form name="MyForm" id="frm" autocomplete="off"  method="post" >
        <table width="80%" border="0" align="center" cellpadding="0" cellspacing="2" id="stdtbl">
          <tr>
            <td height="20" bgcolor="#FFE8F3" class="style2" style="padding:3px; border-bottom:1px solid #CCCCCC; font-weight: bold;">Balance Leave </td>
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
              <table width="90%" align="center"  border="0" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF" class="gridTbl">
                <tr bgcolor="#DFF4FF">
                  <td width="25%" height="23" class="gridTblValue">
                    <?php 
				if($row['clstatus']==1)
				{
	  				$rvs="SELECT * FROM tbl_leave WHERE Code='CL' and storedstatus<>'D'";
	  				$rr=$myDb->select($rvs);
  					$rrow=$myDb->get_row($rr,'MYSQL_ASSOC'); 
	  				$rvp="SELECT * FROM tbl_leavedetails WHERE ltype='CL' and efid='$_SESSION[userid]' and storedstatus<>'D' and yearname='".date("Y")."'";
	  				$rp=$myDb->select($rvp);
  					$rowp=$myDb->get_row($rp,'MYSQL_ASSOC'); 
					$reaminigdays=$rrow['dayscount']-$rowp['spenddays']; ?>
                    <span style=" font-size:12px; font-weight:normal; font:Georgia, 'Times New Roman', Times, serif; font-style:italic;">Your Casual Leave left </span><span style="font-size:12px; color:#FF0000 "><?php echo $reaminigdays;?></span><span style=" font-size:12px; font-weight:normal; font:Georgia, 'Times New Roman', Times, serif; font-style:italic;"> days out of </span> <span style="font-size:12px; color:#FF0000 "><?php echo $rrow['dayscount'];?></span><span style=" font:Arial; font-size:12px; font-weight:normal; font:Georgia, 'Times New Roman', Times, serif; font-style:italic;"> days. </span>
                    <?php }else{  ?>
                    <span style=" font-size:12px; color:#FF0000 "> <?php echo "Sorry! your Casual Leave is not assigned yet"; }?></span> </td>
                </tr>
                <tr bgcolor="#DFF4FF">
                  <td width="25%" height="23" class="gridTblValue">
                    <?php 
				if($row['slstatus']==1)
				{
	  				$rvs="SELECT * FROM tbl_leave WHERE Code='SL' and storedstatus<>'D'";
	  				$rr=$myDb->select($rvs);
  					$rrow=$myDb->get_row($rr,'MYSQL_ASSOC'); 
	  				$rvp="SELECT * FROM tbl_leavedetails WHERE ltype='SL' and efid='$_SESSION[userid]' and storedstatus<>'D' and yearname='".date("Y")."'";
	  				$rp=$myDb->select($rvp);
  					$rowp=$myDb->get_row($rp,'MYSQL_ASSOC'); 
					$reaminigdays=$rrow['dayscount']-$rowp['spenddays']; ?>
                    <span style="font-size:12px;">Your Sick Leave left </span><span style="font-size:12px; color:#FF0000 "><?php echo $reaminigdays;?></span><span style="font-size:12px;"> days out of </span> <span style="font-size:12px; color:#FF0000 "><?php echo $rrow['dayscount'];?></span> days;
                    <?php }else{ ?>
                    <span style="font-size:12px;  color:#FF0000 "> <?php echo "Sorry! your Sick Leave is not assigned yet."; }?></span> </td>
                </tr>
                <tr bgcolor="#DFF4FF">
                  <td width="25%" height="23" class="gridTblValue">
                    <?php 
				if($row['alstatus']==1)
				{
	  				$rvs="SELECT * FROM tbl_leave WHERE Code='AL' and storedstatus<>'D'";
	  				$rr=$myDb->select($rvs);
  					$rrow=$myDb->get_row($rr,'MYSQL_ASSOC'); 

	  				$rvp="SELECT * FROM tbl_leavedetails WHERE ltype='AL' and efid='$_SESSION[userid]' and storedstatus<>'D' and yearname='".date("Y")."'";
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
            <td width="47%" align="center" height="20" class="style2"><table width="80%" border="0" align="center" cellpadding="0" cellspacing="0" id="tblleft">
                <tr bgcolor="#F3F3F3">
                  <td height="29" colspan="6" class="style2"><span style="font-weight:bold; font-size:12px; ">General Information</span>
:                    </td>
                </tr>
                <tr>
                  <td height="20" class="style2"><strong>Trac No.</strong></td>
                  <td class="style2"><div align="center">:</div></td>
                  <td class="style2"><input type="text" id="lid" name="lid" style="width: 80px" value="<?php echo "L".$autoid;?>" /></td>
                  <td class="style2">&nbsp;</td>
                  <td class="style2">&nbsp;</td>
                  <td height="20">&nbsp;</td>
                </tr>
                <tr>
                  <td width="13%" height="20" class="style2"><strong>Faculty ID</strong></td>
                  <td width="3%" class="style2"><div align="center">: </div></td>
                  <td width="33%" class="style2"><span style="font-weight:normal; font-size:12px; "><?php echo $row['facultyid'];?></span>
                      <input type="hidden" value="<?php echo $row['facultyid']; ?>" name="empid" id="empid" /></td>
                  <td width="11%" class="style2"><strong> Name </strong></td>
                  <td width="1%" class="style2">: </td>
                  <td width="39%" height="20"><span style="font-weight:normal; font-size:12px; "><?php echo $row['name'];?></span>
                      <input type="hidden" value="<?php echo $row['name']; ?>" name="empname" id="empname" /></td>
                </tr>
                <tr>
                  <td height="20" class="style2"><strong>Designation </strong></td>
                  <td class="style2"><div align="center">:</div></td>
                  <td class="style2"><span style="font-weight:normal; font-size:12px; "><?php echo $row['Designation'];?></span>
                      <input type="hidden" value="<?php echo $row['Designation']; ?>" name="desig" id="desig" /></td>
                  <td class="style2"><strong>Apply For</strong></td>
                  <td class="style2">:</td>
                  <td height="20"><select name="applyfor" id="applyfor" onkeypress="return handleEnter(this, event)">

                      <?php $hq=$myDb->select("select name, code from tbl_leave Where storedstatus<>'D' Order By Id desc");
				   while($hrow=$myDb->get_row($hq,'MYSQL_ASSOC')){
				   ?>
                      <option value="<?php echo $hrow['code']; ?>"><?php echo $hrow['name']; ?></option>
                      <?php } ?>
                    </select>
                      <input name="td" type="hidden" id="td" style="width: 80px" value="12" /></td>
                </tr>
                <tr bgcolor="#F5F5F5">
                  <td height="32" colspan="6" bgcolor="#F5F5F5" class="style2"><span style="font-weight:bold; font-size:12px; ">Leave Period : </span></td>
                </tr>
                <tr>
                  <td height="20" class="style2"><strong>From</strong></td>
                  <td class="style2"><div align="center">:</div></td>
                  <td class="style2"><input type="text" id="fdate" name="fdate" style="width: 80px" value="<?php echo date('Y-m-d');?>" /></td>
                  <td class="style2"><strong>To</strong></td>
                  <td class="style2">:</td>
                  <td height="20"><input type="text" id="tdate" name="tdate" style="width: 80px" value="<?php echo date('Y-m-d');?>"/></td>
                </tr>
                <tr>
                  <td height="20" class="style2"><strong>Reason </strong></td>
                  <td class="style2"><div align="center">:</div></td>
                  <td height="20" colspan="4" class="style2"><select name="reason" id="select" onkeypress="return handleEnter(this, event)">
                    <option value="Personal Problem">Personal Problem</option>
                    <option value="Select Reason">Select Reason</option>
                    <option value="I will go home">I will go home</option>
                  </select></td>
                </tr>
                <tr>
                  <td height="20" class="style2"><strong>Attention To </strong></td>
                  <td class="style2"><div align="center">:</div></td>
                  <td height="20" colspan="4"  class="style2" ><span>
                    <select name="attnto" id="attnto" style="width:320px;"   onkeypress="return handleEnter(this, event)">
                      <option>Select Attn to</option>
                      <?php $hq=$myDb->select("select s.id,s.name, d.name as dname from tbl_staffinfo s inner join tbl_designation d on s.designationid=d.id Where s.designationid in(3,7) and s.storedstatus<>'D' and s.jobstatus='Active'");
				   while($hrow=$myDb->get_row($hq,'MYSQL_ASSOC')){
				   ?>
                      <option value="<?php echo $hrow['name']; ?>"><?php echo $hrow['name'].' ('.$hrow['dname'].')'; ?></option>
                      <?php } ?>
                    </select>
                  </span></td>
                </tr>
                <tr bgcolor="#F5F5F5">
                  <td height="30" colspan="6" class="style2"><span style="font-weight:bold; font-size:12px; ">During this period my classes has been arranged as follows: </span></td>
                </tr>
                <tr>
                  <td height="20" colspan="6" class="style2"><p>
  

  
<span id="tblhead" style="padding:5px;">Clcik Add to new row : <a href="javascript:new_link()" class="style17"><span style="font-weight:bold; font-size:12px; text-decoration:underline;">Add New </span></a></span>
                    <div id="newlink" style="border-top:1px solid #CCCCCC;">
  <div class="feed">
  <table width="650" border="0" align="center" cellpadding="0" cellspacing="0" class="gridTbl">
    <tr bgcolor="#DDF0FB">
      <td width="196" height="30" class="gridTblHead style2">Date<span class="stars">*</span></td>
      <td width="18" height="30" class="gridTblHead style2">Time<span class="stars">*</span></td>
      <td width="315" class="gridTblHead style2">Faculty Name <span class="stars">*</span></td>
      <td width="315" class="gridTblHead style2">Description<span class="stars">*</span> </td>
      </tr>
    <tr>
      <td height="30" class="gridTblValue"><input name="pdate[]" id="pdate[]" style="width: 80px" type="text"  value="<?php echo date('Y-m-d');?>" class="style4" onkeypress="return handleEnter(this, event)" /></td>
      <td height="30" class="gridTblValue"><input name="ptime[]" type="text" class="gridTblValue" id="ptime[]" style="width: 120px" onkeypress="return handleEnter(this, event)"   value="<?php echo "10:00AM-11:00AM"; ?>" /></td>
      <td class="gridTblValue"><select name="facultyid[]" id="facultyid[]"  onkeypress="return handleEnter(this, event)">
        <option>Select Faculty</option>
        <?php $hq=$myDb->select("select id,name from tbl_faculty Where storedstatus<>'D'");
				   while($hrow=$myDb->get_row($hq,'MYSQL_ASSOC')){
				   ?>
        <option value="<?php echo $hrow['name']; ?>"><?php echo $hrow['name']; ?></option>
        <?php } ?>
      </select></td>
      <td class="gridTblValue"><input name="desc[]" id="desc[]" type="text"  size="20" onkeypress="return handleEnter(this, event)" /></td>
      </tr>
  </table>
  </div>
                      </div>                    
                    <div id="newlinktpl" style="display:none; border-top:1px solid #999999;"><div class="feed">
                      <table width="650" border="0" align="center" cellpadding="0" cellspacing="0" class="gridTbl">
    <tr bgcolor="#DDF0FB">
      <td width="196" height="30" class="gridTblHead style2">Date<span class="stars">*</span></td>
      <td width="18" height="30" class="gridTblHead style2">Time<span class="stars">*</span></td>
      <td width="315" class="gridTblHead style2">Faculty Name <span class="stars">*</span></td>
      <td width="315" class="gridTblHead style2">Description<span class="stars">*</span> </td>
      </tr>
    <tr>
      <td height="30" class="gridTblValue"><input name="pdate[]" id="pdate[]" style="width: 80px" type="text"  value="<?php echo date('Y-m-d');?>" class="style4" onkeypress="return handleEnter(this, event)" /></td>
      <td height="30" class="gridTblValue"><input name="ptime[]" id="ptime[]" style="width: 120px" type="text" class="gridTblValue" value="<?php echo "10:00AM-11:00AM"; ?>" onkeypress="return handleEnter(this, event)" /></td>
      <td class="gridTblValue"><select name="facultyid[]" id="facultyid[]"  onkeypress="return handleEnter(this, event)">
        <option>Select Faculty</option>
        <?php $hq=$myDb->select("select id,name from tbl_faculty Where storedstatus<>'D'");
				   while($hrow=$myDb->get_row($hq,'MYSQL_ASSOC')){
				   ?>
        <option value="<?php echo $hrow['name']; ?>"><?php echo $hrow['name']; ?></option>
        <?php } ?>
      </select>      	</td>
      <td class="gridTblValue"><input name="desc[]" id="desc[]" type="text" class="gridTblValue" size="20" onkeypress="return handleEnter(this, event)" /></td>
      </tr>
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td></td>
      <td></td>
      </tr>
  </table>
  </div>
                      </div>
                    </td>
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