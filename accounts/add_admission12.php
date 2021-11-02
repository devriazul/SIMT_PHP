<?php ob_start();
session_start();
include("../config.php"); 
if($myDb->connectDefaultServer())
{ 
  if($_SESSION['userid']){
  $chka="SELECT*FROM  tbl_accdtl WHERE flname='add_admission.php' AND userid='$_SESSION[userid]'";
  $caq=$myDb->select($chka);
  $car=$myDb->get_row($caq,'MYSQL_ASSOC');
  if($car['ins']=="y"){
  
  
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
<script type="text/javascript" src="datepickercontrol.js"></script>
  <script language="JavaScript">
  if (navigator.platform.toString().toLowerCase().indexOf("linux") != -1){
	 	document.write('<link type="text/css" rel="stylesheet" href="datepickercontrol_lnx.css">');
	 }
	 else{
	 	document.write('<link type="text/css" rel="stylesheet" href="datepickercontrol.css">');
	 }

</script>
<script src="rs.js" type="text/javascript"></script>

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
<p align="center" ><font face="Arial, Helvetica, sans-serif" size="2"><?php echo $_GET['msg'];?></font></p>
		<br />
		<p align="center"><form name="MyForm" action="add_admission.php" method="post" onsubmit="xmlhttpPost('insAdm.php', 'MyForm', 'MyResult', '<img src=\'loader.gif\'>'); return false;">
  <table width="800" border="0" align="center" cellpadding="0" cellspacing="0" id="stdtbl">
  <tr >
    <td width="76%" height="26" style="border-bottom:1px solid #DFF6FE;" ><div align="center">&#2476;&#2495;&#2476;&#2480;&#2472; </div></td>
    <td width="24%" style="border-bottom:1px solid #DFF6FE;" ><div align="left">&#2463;&#2494;&#2453;&#2494; </div></td>
  </tr>
  <tr>
    <td height="30" class="sttd"><table width="500" border="0" align="center" cellpadding="0" cellspacing="0">
      <tr>
        <td width="146" height="30" align="right"><div align="left">&#2468;&#2494;&#2480;&#2495;&#2454;</div></td>
        <td width="354" height="30"><label>
          <input name="edate" type="text" class="style15" id="DPC_edate_YYYY-MM-DD" onkeypress="return handleEnter(this, event)" />
        </label></td>
      </tr>
      <tr>
        <td height="30" align="right"><div align="left">&#2488;&#2509;&#2463;&#2497;&#2465;&#2503;&#2472;&#2509;&#2463; &#2438;&#2439;&#2465;&#2495; &#2470;&#2495;&#2472;</div></td>
        <td height="30"><label>
          <select name="select" onkeypress="return handleEnter(this, event)">
          </select>
        </label></td>
      </tr>
    </table></td>
    <td height="30" class="sttd">&nbsp;</td>
  </tr>
  <tr>
    <td height="30" class="sttd"><span class="style3">&#2534;&#2535;&#2404; &#2476;&#2503;&#2468;&#2472; 
        </span>
      
      <span class="style11">
      <select name="frommonth" class="style11" id="frommonth" onkeypress="return handleEnter(this, event)">
	    <option value="" selected="selected"></option>
        <option value="01">&#2460;&#2494;&#2472;&#2497;&#2527;&#2494;&#2480;&#2495;</option>
        <option value="02">&#2475;&#2503;&#2476;&#2509;&#2480;&#2497;&#2527;&#2494;&#2480;&#2495; </option>
        <option value="03">&#2478;&#2494;&#2480;&#2509;&#2458; </option>
        <option value="04">&#2447;&#2474;&#2509;&#2480;&#2495;&#2482; </option>
        <option value="05">&#2478;&#2503; </option>
        <option value="06">&#2460;&#2497;&#2472; </option>
        <option value="07">&#2460;&#2497;&#2482;&#2494;&#2439; </option>
        <option value="08">&#2437;&#2455;&#2494;&#2488;&#2509;&#2463; </option>
        <option value="09">&#2488;&#2503;&#2474;&#2509;&#2463;&#2503;&#2478;&#2509;&#2476;&#2480; </option>
        <option value="10">&#2437;&#2453;&#2509;&#2463;&#2507;&#2476;&#2480; </option>
        <option value="11">&#2472;&#2477;&#2503;&#2478;&#2509;&#2476;&#2480; </option>
        <option value="12">&#2465;&#2495;&#2488;&#2503;&#2478;&#2509;&#2476;&#2480; </option>
      </select>
      </span> <span class="style3">&nbsp;&#2469;&#2503;&#2453;&#2503; 
    &nbsp;</span><span class="style1">
    <select name="tomonth" class="style11" id="tomonth" onkeypress="return handleEnter(this, event)">
	    <option value="" selected="selected"></option>
        <option value="01">&#2460;&#2494;&#2472;&#2497;&#2527;&#2494;&#2480;&#2495;</option>
        <option value="02">&#2475;&#2503;&#2476;&#2509;&#2480;&#2497;&#2527;&#2494;&#2480;&#2495; </option>
        <option value="03">&#2478;&#2494;&#2480;&#2509;&#2458; </option>
        <option value="04">&#2447;&#2474;&#2509;&#2480;&#2495;&#2482; </option>
        <option value="05">&#2478;&#2503; </option>
        <option value="06">&#2460;&#2497;&#2472; </option>
        <option value="07">&#2460;&#2497;&#2482;&#2494;&#2439; </option>
        <option value="08">&#2437;&#2455;&#2494;&#2488;&#2509;&#2463; </option>
        <option value="09">&#2488;&#2503;&#2474;&#2509;&#2463;&#2503;&#2478;&#2509;&#2476;&#2480; </option>
        <option value="10">&#2437;&#2453;&#2509;&#2463;&#2507;&#2476;&#2480; </option>
        <option value="11">&#2472;&#2477;&#2503;&#2478;&#2509;&#2476;&#2480; </option>
        <option value="12">&#2465;&#2495;&#2488;&#2503;&#2478;&#2509;&#2476;&#2480; </option>
    </select>
&nbsp;
    <input name="eyear" type="text" class="style11" id="eyear" onkeypress="return handleEnter(this, event)" value="<?php echo date("Y"); ?>" size="&#2535;&#2534;" />
        </span></td>
    <td height="30" class="sttd"><label>
      <input name="tuitionfee" type="text" class="style11" id="tuitionfee" onkeypress="return handleEnter(this, event)" value="0" />
    </label></td>
  </tr>
  <tr>
    <td height="30" class="sttd">
      <span class="style3">&#2534;&#2536;&#2404; &#2477;&#2480;&#2509;&#2468;&#2495;/&#2474;&#2498;&#2472;&#2435; &#2477;&#2480;&#2509;&#2468;&#2495;/&#2459;&#2494;&#2524;&#2474;&#2468;&#2509;&#2480; &#2475;&#2495;      </span><span class="style1">
      <select name="admissionfeetext" class="style11" id="admissionfeetext" onkeypress="return handleEnter(this, event)">
        <option value="" ></option>
        <option value="Admission">&#2477;&#2480;&#2509;&#2468;&#2495;</option>
        <option value="Readmission">&#2474;&#2498;&#2472;&#2435; &#2477;&#2480;&#2509;&#2468;&#2495;</option>
        <option value="Testimonial">&#2459;&#2494;&#2524;&#2474;&#2468;&#2509;&#2480; &#2475;&#2495; </option>
      </select>
      </span></td>
    <td height="30" class="sttd"><label>
      <input name="admissionfee" type="text" class="style11" id="admissionfee" onkeypress="return handleEnter(this, event)" value="0" />
    </label></td>
  </tr>
  <tr>
    <td height="30" class="sttd"><span class="style3">&#2534;&#2537;&#2404; &#2476;&#2495;&#2482;&#2478;&#2509;&#2476; &#2475;&#2495; </span></td>
    <td height="30" class="sttd"><label>
      <input name="latefee" type="text" class="style11" id="latefee" onkeypress="return handleEnter(this, event)" value="0" />
    </label></td>
  </tr>
  <tr>
    <td height="30" class="sttd"><span class="style3">&#2534;&#2538;&#2404; &#2488;&#2503;&#2478;&#2495;&#2488;&#2509;&#2463;&#2494;&#2480; &#2475;&#2495; / &#2441;&#2472;&#2509;&#2472;&#2527;&#2472; &#2475;&#2495;</span><span class="style1"> 
        <select name="semesterfeetext" class="style11" id="semesterfeetext" onkeypress="return handleEnter(this, event)">
		  <option value=""></option>
          <option value="Semesterfee">&#2488;&#2503;&#2478;&#2495;&#2488;&#2509;&#2463;&#2494;&#2480; &#2475;&#2495;</option>
          <option value="Developmentfee">&#2441;&#2472;&#2509;&#2472;&#2527;&#2472; &#2475;&#2495; </option>
          </select>
    </span></td>
    <td height="30" class="sttd"><label>
      <input name="semesterfee" type="text" class="style11" id="semesterfee" onkeypress="return handleEnter(this, event)" value="0" />
    </label></td>
  </tr>
  <tr>
    <td height="30" class="sttd"><span class="style3">&#2534;&#2539;&#2404; &#2480;&#2503;&#2460;&#2495;&#2488;&#2509;&#2463;&#2509;&#2480;&#2503;&#2486;&#2494;&#2472; &#2475;&#2495; </span></td>
    <td height="30" class="sttd"><label>
      <input name="registrationfee" type="text" class="style11" id="registrationfee" onkeypress="return handleEnter(this, event)" value="0" />
    </label></td>
  </tr>
  <tr>
    <td height="30" class="sttd"><span class="style3">&#2534;&#2540;&#2404; &#2475;&#2480;&#2478; &#2475;&#2495;&#2482;&#2494;&#2474; &#2475;&#2495; </span></td>
    <td height="30" class="sttd"><label>
      <input name="formfillupfee" type="text" class="style11" id="formfillupfee" onkeypress="return handleEnter(this, event)" value="0" />
    </label></td>
  </tr>
  <tr>
    <td height="30" class="sttd"><span class="style3">&#2534;&#2541;&#2404; &#2475;&#2495;&#2482;&#2509;&#2465; &#2463;&#2509;&#2480;&#2503;&#2472;&#2495;&#2434; &#2475;&#2495; </span></td>
    <td height="30" class="sttd"><label>
      <input name="fieldtrainingfee" type="text" class="style11" id="fieldtrainingfee" onkeypress="return handleEnter(this, event)" value="0" />
    </label></td>
  </tr>
  <tr>
    <td height="30" class="sttd"><span class="style3">&#2534;&#2542;&#2404; &#2438;&#2439; &#2465;&#2495; &#2453;&#2494;&#2480;&#2509;&#2465; &#2475;&#2495; </span></td>
    <td height="30" class="sttd"><label>
      <input name="idcardfee" type="text" class="style11" id="idcardfee" onkeypress="return handleEnter(this, event)" value="0" />
    </label></td>
  </tr>
  <tr>
    <td height="30" class="sttd"><span class="style3">&#2534;&#2543;&#2404; &#2482;&#2494;&#2439;&#2476;&#2509;&#2480;&#2503;&#2480;&#2496; &#2475;&#2495; </span></td>
    <td height="30" class="sttd"><label>
      <input name="libraryfee" type="text" class="style11" id="libraryfee" onkeypress="return handleEnter(this, event)" value="0" />
    </label></td>
  </tr>
  <tr>
    <td height="30" class="sttd"><span class="style3">&#2535;&#2534;&#2404; &#2477;&#2480;&#2509;&#2468;&#2495; &#2475;&#2480;&#2478; </span></td>
    <td height="30" class="sttd"><label>
      <input name="admissionform" type="text" class="style11" id="admissionform" onkeypress="return handleEnter(this, event)" value="0" />
    </label></td>
  </tr>
  <tr>
    <td height="30" class="sttd"><span class="style3">&#2535;&#2535;&#2404; &#2474;&#2509;&#2480;&#2486;&#2434;&#2488;&#2494; &#2474;&#2468;&#2509;&#2480; / &#2474;&#2509;&#2480;&#2468;&#2509;&#2479;&#2527;&#2472; &#2474;&#2468;&#2509;&#2480; &#2475;&#2495;</span><span class="style1"> 
        <select name="testimonialtext" class="style11" id="testimonialtext" onkeypress="return handleEnter(this, event)">
        <option value="" ></option>
          <option value="testimonial free">&#2474;&#2509;&#2480;&#2486;&#2434;&#2488;&#2494; &#2474;&#2468;&#2509;&#2480;</option>
          <option value="joining fee">&#2474;&#2509;&#2480;&#2468;&#2509;&#2479;&#2527;&#2472; &#2474;&#2468;&#2509;&#2480; &#2475;&#2495; </option>
          </select>
    </span></td>
    <td height="30" class="sttd"><label>
      <input name="testimonialfee" type="text" class="style11" id="testimonialfee" onkeypress="return handleEnter(this, event)" value="0" />
    </label></td>
  </tr>
  <tr>
    <td height="30" class="sttd"><span class="style3">&#2535;&#2536;&#2404; &#2478;&#2471;&#2509;&#2479;&#2474;&#2480;&#2509;&#2476; / &#2463;&#2503;&#2488;&#2509;&#2463; &#2474;&#2480;&#2496;&#2453;&#2509;&#2487;&#2494;&#2480; &#2475;&#2495;</span><span class="style1"> 
        <select name="midtremtesttext" class="style11" id="midtremtesttext" onkeypress="return handleEnter(this, event)">
        <option value="" ></option>
          <option value="Midterm fee">&#2478;&#2471;&#2509;&#2479;&#2474;&#2480;&#2509;&#2476;</option>
          <option>&#2463;&#2503;&#2488;&#2509;&#2463; &#2474;&#2480;&#2496;&#2453;&#2509;&#2487;&#2494;&#2480; &#2475;&#2495;</option>
          </select>
    </span></td>
    <td height="30" class="sttd"><label>
      <input name="midtremtestfee" type="text" class="style11" id="midtremtestfee" onkeypress="return handleEnter(this, event)" value="0" />
    </label></td>
  </tr>
  <tr>
    <td height="30" class="sttd"><span class="style3">&#2535;&#2537;&#2404; &#2472;&#2478;&#2509;&#2476;&#2480; &#2474;&#2468;&#2509;&#2480; &#2475;&#2495; </span></td>
    <td height="30" class="sttd"><label>
      <input name="marksheetfee" type="text" class="style11" id="marksheetfee" onkeypress="return handleEnter(this, event)" value="0" />
    </label></td>
  </tr>
  <tr>
    <td height="30" class="sttd"><span class="style3">&#2535;&#2538;&#2404; &#2482;&#2509;&#2479;&#2494;&#2476; &#2475;&#2495; </span></td>
    <td height="30" class="sttd"><label>
      <input name="labfee" type="text" class="style11" id="labfee" onkeypress="return handleEnter(this, event)" value="0" />
    </label></td>
  </tr>
  <tr>
    <td height="30" class="sttd">&#2535;&#2539;&#2404;&#2476;&#2495;&#2476;&#2495;&#2471; </td>
    <td height="30" class="sttd"><input name="others" type="text" class="style11" id="others" onkeypress="return handleEnter(this, event)" value="0" /></td>
  </tr>
  <tr>
    <td height="30" colspan="2"><div align="center">
      <input type="submit" value="Submit" name="B1" style="color: #999999; font-size: 8pt; font-family: Verdana; border: 1px solid #C0C0C0; background-color: #D9F0FB">
    </div></td>
    </tr>
</table>
</form>
</p>
<p><div id="MyResult" align="center"></div>
</p>
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
  header("Location:login.php");
}
}  
?>