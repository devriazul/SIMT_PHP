<?php ob_start();
session_start();
require_once('dbClass.php');
include("config.php"); 
if($myDb->connectDefaultServer())
{ 
  if($_SESSION['userid']){
  $chka="SELECT*FROM  tbl_accdtl WHERE flname='book_entry.php' AND userid='$_SESSION[userid]'";
  $caq=$myDb->select($chka);
  $car=$myDb->get_row($caq,'MYSQL_ASSOC');
  if($car['ins']=="y"){
  
  $bq=$myDb->select("SELECT*FROM tbl_bookentry WHERE bookid='$_GET[rowid]'");
  $bqf=$myDb->get_row($bq,'MYSQL_ASSOC');
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Untitled Document</title>

<script type="text/javascript" src="jquery.dateentry.js"></script>

<script type="text/javascript">
$(document).ready(function(){	 

  $('#stdid1<?php echo $_GET['rowid']; ?>').blur('live',function(){
     var stdid=$('#stdid1<?php echo $_GET['rowid']; ?>').val();
     $.get('check_return.php?stdid='+stdid,function(data){
	   $('#chkbook<?php echo $_GET['rowid']; ?>').hide().html(data).fadeIn();
	    
	 });
  });
  
  $('#bookentry1<?php echo $_GET['rowid']; ?>').click(function(){
  
      if($('#deptid1<?php echo $_GET['rowid']; ?>').val()==""){
	     alert('Department ID can not left empty');
		 $('#deptid1<?php echo $_GET['rowid']; ?>').focus();
		 return flase;
	  }	 
	  if($('#stdid<?php echo $_GET['rowid']; ?>').val()==""){
	     alert('Student ID can not left empty');
		 $('#stdid<?php echo $_GET['rowid']; ?>').focus();
		 return flase;
	  }	 
	  if($('#semesterid<?php echo $_GET['rowid']; ?>').val()==""){
	     alert('Semester ID can not left empty');
		 $('#semesterid<?php echo $_GET['rowid']; ?>').focus();
		 return flase;
	  }  
	  if($('#session<?php echo $_GET['rowid']; ?>').val()==""){
	     alert('Session can not left empty');
		 $('#session<?php echo $_GET['rowid']; ?>').focus();
		 return flase;
	  }      
	  if($('#issuee<?php echo $_GET['rowid']; ?>').val()==""){
	     alert('Issue date can not left empty');
		 $('#issuee<?php echo $_GET['rowid']; ?>').focus();
		 return flase;
	  }  
	  var arr=$('#bisu1<?php echo $_GET['rowid']; ?>').serializeArray();
	  $.post('issue_return.php',arr,function(data){
	    $('#chkbook<?php echo $_GET['rowid']; ?>').fadeOut();
		$('#insb<?php echo $_GET['rowid']; ?>').css({'color':'#F7F7F7','padding':'4px','padding-left':'5px','background-color':'#999999'});
	    $('#insb<?php echo $_GET['rowid']; ?>').hide().html(data).fadeIn();
		$('#cls<?php echo $_GET['rowid']; ?>').show();
	  });
  });


  $('#deptid1<?php echo $_GET['rowid']; ?>').change(function(){
     var arr=$('#bisu1<?php echo $_GET['rowid']; ?>').serializeArray();
	 $.post('department_student_return.php?rowid=<?php echo $_GET['rowid']; ?>',arr,function(data){
	   $('#sid1<?php echo $_GET['rowid']; ?>').html(data);
	 });
  });
  
  
});
$(function () { var rid=$('#rid').val();

	$('#issuee1<?php echo $_GET['rowid']; ?>').dateEntry({spinnerImage: 'img/spinnerDefault.png'});

});
</script>
<script language="javascript">
$(document).ready(function(){
    $('#cls<?php echo $_GET['rowid']; ?>').click(function(e){
	 e.preventDefault();
     $('#insb<?php echo $_GET['rowid']; ?>').fadeOut();
	 $('#cls<?php echo $_GET['rowid']; ?>').fadeOut();
    });	 

});
</script>
<script type="text/javascript" src="jquery.js"></script>


<script type='text/javascript' src='jquery.autocomplete.js'></script>
<link rel="stylesheet" type="text/css" href="jquery.autocomplete.css" />

<script language="javascript">
$().ready(function() {
		$("stdid<?php echo $_GET['rowid']; ?>").autocomplete("search_student.php", {
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

</head>

<body>
<div id="isubook<?php echo $_GET['rowid']; ?>" style="margin-left:50px;font-family:Verdana, Arial, Helvetica, sans-serif; font-size:10px; width:500px">
<form id="bisu1<?php echo $_GET['rowid']; ?>" method="post">
<table width="600" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td width="100">Department ID<span style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:9px; color:#FF0000" >*</span></td>
    <td width="267"><select name="deptid" id="deptid1<?php echo $_GET['rowid']; ?>" style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:12px;">
      <option value="">Select ID</option>
      <?php $dep=$myDb->select("select*from tbl_department order by name asc");
	   while($depf=$myDb->get_row($dep,'MYSQL_ASSOC')){
	   ?>
      <option value="<?php echo $depf['id']; ?>"><?php echo $depf['name']; ?></option>
      <?php } ?>
    </select>
      <input type="hidden" name="rid" id="rid" value="<?php echo $_GET['rowid']; ?>" /></td>
    <td width="233" rowspan="6" valign="top"><div id="chkbook1<?php echo $_GET['rowid']; ?>"></div></td>
  <div id="sid1<?php echo $_GET['rowid']; ?>">  </div>	
  </tr>
  <tr>
    <td>Semester<span style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:9px; color:#FF0000" >*</span><input type="hidden" name="bookid" id="bookid<?php echo $bqf['bookid']; ?>" value="<?php echo $bqf['bookid']; ?>" />
	<input type="hidden" name="courseid" id="courseid<?php echo $bqf['courseid']; ?>" value="<?php echo $bqf['courseid']; ?>"/></td>
    <td><select name="semesterid" id="semesterid<?php echo $_GET['rowid']; ?>" style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:12px;">
      <option value="">Select Semester</option>
      <?php $sem=$myDb->select("select*from tbl_semester order by name asc");
	while($semf=$myDb->get_row($sem,'MYSQL_ASSOC')){
	?>
      <option value="<?php echo $semf['id']; ?>"><?php echo $semf['name']; ?></option>
      <?php } ?>
    </select></td>
    </tr>
  <tr>
    <td>Session<span style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:9px; color:#FF0000" >*</span></td>
    <td><select name="session" class="style4" id="session<?php echo $_GET['rowid']; ?>" style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size: 12px;" onkeypress="return handleEnter(this, event)">
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
    </select></td>
    </tr>
  <tr>
    <td>Return Date<span style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:9px; color:#FF0000" >*</span></td>
    <td><input name="issue" type="text" class="style4" id="issuee1<?php echo $_GET['rowid']; ?>" size="30" onkeypress="return handleEnter(this, event)" />
      [YYYY-MM-DD]</td>
    </tr>
  
  <tr>
    <td height="30">Fine</td>
    <td><label>
      <input type="text" name="fine" id="fine<?php echo $_GET['rowid']; ?>" />
    </label></td>
  </tr>
  <tr>
    <td height="30">&nbsp;</td>
    <td><input name="button" type="button" id="bookentry1<?php echo $_GET['rowid']; ?>" style="border:1px solid #999999;font-size:12px;" value="Submit" /></td>
    </tr>
</table>
</form>
</div>
<a href="#" id="cls<?php echo $_GET['rowid']; ?>" style="margin-left:650px;display:none;"><img src="images/closebox.png" width="20" height="20" border="0" /></a>
<div id="insb<?php echo $_GET['rowid']; ?>" style="margin-top:-10px;width:655px;font-family:Verdana, Arial, Helvetica, sans-serif;font-size:12px;display:none;"></div>


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
