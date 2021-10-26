<?php 
ob_start();
session_start();
include("../config.php"); 
if($myDb->connectDefaultServer())
{ 
  if($_SESSION['userid']){
  $chka="SELECT*FROM  tbl_accdtl WHERE flname='semesterwisesubject_search.php' AND userid='$_SESSION[userid]'";
  $caq=$myDb->select($chka);
  $car=$myDb->get_row($caq,'MYSQL_ASSOC');
  if($car['ins']=="y"){
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
.style15 {
	font-size: 12px;
	font-family: Verdana, Arial, Helvetica, sans-serif;
}
.style16 {font-size: 12px}

-->
</style>
<script language="javascript" src="sub_catagory.js"></script>
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
<script type="text/javascript" language="javascript"> 
window.onload=function() {
document.forms[0][0].focus();
}
</script>

 <link rel="stylesheet" href="libs/style.css"/>
 <script src='libs/jquery.js' type="text/javascript"></script>
 
  <script language="JavaScript" type="text/javascript">
<!--

/*function copy<?php //echo $count; ?>() {
   var sel = document.getElementById("session<?php //echo $count; ?>");
   var text = sel.options[sel.selectedIndex].text;
   document.getElementById("year<?php //echo $count; ?>").value=text;
   //var out = document.getElementById("output");
   //out.value += text+"\n";
}*/

function showSelected()
{
    var selObj = document.getElementById('session');
	var inVal;
	var selIndex = selObj.selectedIndex;
	inVal=selIndex;
	var value=selObj.options[selIndex].text;
	
	if(selObj.options[selIndex].text){
		var inValue=value.substring(0,4);
	    document.getElementById('year').value=inValue;
	}
	
}


//-->
</script>

<script language="javascript">
 $(document).ready(function(){
   $('#sbt').click(function(){
     var arr=$('#MyForm').serializeArray();	 
	 $.post('semesterassignedsub_search.php',arr,function(result){
		 $('#MyResult').hide().html(result).fadeIn('slow');
		 	     

		 
	 });
	 
	 //$("#MyResult").html("<img src='bigLoader.gif' />");

   });
 
 });
</script>

<script src="depsub_mark_distribution.js" type="text/javascript"></script>

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
 <div class="search-background1">
			<label><img src="load.gif" alt="" /></label>
	</div>
	
	
	<table width="99%" border="0" align="center" cellpadding="0" cellspacing="0" id="stdtbl" >
           <tr class="style4">
             <td width="25%" height="30" bgcolor="#D9F0FB" style="font-family:Verdana, Arial, Helvetica, sans-serif;
	font-size:12px;	">Department</td>
             <td width="8%" height="30" bgcolor="#D9F0FB" style="font-family:Verdana, Arial, Helvetica, sans-serif;
	font-size:12px;	">Year</td>
             <td width="25%" height="30" bgcolor="#D9F0FB" style="font-family:Verdana, Arial, Helvetica, sans-serif;
	font-size:12px;	">Session</td>
             <td width="25%" bgcolor="#D9F0FB" style="font-family:Verdana, Arial, Helvetica, sans-serif;
	font-size:12px;	">Semester</td>
             <td height="30" bgcolor="#D9F0FB" style="font-family:Verdana, Arial, Helvetica, sans-serif;
	font-size:12px;	">&nbsp;</td>
           </tr>
				<form name="MyForm" id="MyForm" autocomplete="off"  method="post" >
           <tr>
             <td><label>
               <select name="department" id="department" style="font-family: Verdana; font-size: 8pt;padding:3px; border: 1px solid #3399FF" onkeypress="return handleEnter(this, event)">
                <option value="-1" selected="selected">Select Department</option>
                <?php 
			  	$cat=mysql_query("select id, name from tbl_department") or die(mysql_error());
				while($cfetch=mysql_fetch_array($cat)){
	 			?>
                <option value="<?php echo $cfetch['id']; ?>"><?php echo $cfetch['name']; ?></option>
                <?php } ?>
              </select>
             </label></td>
             <td><label>
               <input name="year" type="text" id="year" size="15" style="font-family: Verdana; font-size: 8pt;padding:3px; border: 1px solid #3399FF;width:50px;" value="<?php echo date("Y"); ?>" onkeypress="return handleEnter(this, event)" readonly="true" />
             </label></td>
             <td><label>
               <select name="session" id="session" style="font-family: Verdana; font-size: 8pt;padding:3px; border: 1px solid #3399FF" onkeypress="return handleEnter(this, event)" onchange="showSelected();">
                <option value="">Select session</option>
				<option value="0506">2005-2006</option>
				<option value="0607">2006-2007</option>
				<option value="0708">2007-2008</option>
				<option value="0809">2008-2009</option>
				<option value="0910">2009-2010</option>
				<option value="1011">2010-2011</option>
				<option value="1112">2011-2012</option>
				<option value="1213">2012-2013</option>
				<option value="1314">2013-2014</option>
				<option value="1415">2014-2015</option>
				<option value="1516">2015-2016</option>
				<option value="1617">2016-2017</option>
				<option value="1718">2017-2018</option>
				<option value="1819">2018-2019</option>
				<option value="1920">2019-2020</option>
				<option value="2021">2020-2021</option>
				<option value="2122">2021-2022</option>
				<option value="2223">2022-2023</option>
				<option value="2324">2023-2024</option>
				<option value="2425">2024-2025</option>
              </select>
             </label></td>
             <td><label>
               <select name="semester" id="semester" style="font-family: Verdana; font-size: 8pt;padding:3px; border: 1px solid #3399FF">
                  <option value="-1" selected="selected">Select semester</option>
                   <?php $std="SELECT id,name,description FROM tbl_semester WHERE storedstatus<>'D' order by id asc";
			      $stdq=$myDb->select($std);
				  while($stdr=$myDb->get_row($stdq,'MYSQL_ASSOC')){
				  ?>
                  <option value="<?php echo $stdr['id']; ?>"><?php echo $stdr['name']; ?></option>
                <?php } ?>               </select>
             </label></td>
             <td width="17%"><label>
               <input type="button" name="submit1" id="sbt"  value="Next" style="color: #999999; font-size: 8pt; font-family: Verdana; border: 1px solid #C0C0C0; background-color: #D9F0FB">
             </label></td>
           </tr>
           <tr>
             <td colspan="5">&nbsp;</td>
           </tr>
           <tr>
             <td colspan="5"> 
			 </td>
           </tr>		   </form>
         </table>
	
 <div id="MyResult" align="center">	
 </div>
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