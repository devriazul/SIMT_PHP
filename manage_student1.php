<?php ob_start();
session_start();
require_once('dbClass.php');
include("config.php"); 
if($myDb->connectDefaultServer())
{ 
  if($_SESSION['userid']){
  $chka="SELECT*FROM  tbl_accdtl WHERE flname='manage_student.php' AND userid='$_SESSION[userid]'";
  $caq=$myDb->select($chka);
  $car=$myDb->get_row($caq,'MYSQL_ASSOC');
  if(($car['ins']=="y")||($_SESSION['userid']=="administrator")){
   
  
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title><?php include("title.php");?></title>
	<link type="text/css" href="css/jquery-ui-1.8.5.custom.css" rel="Stylesheet" />

<style type="text/css">
<!--
@import url("main.css");
.style15 {
	font-size: 12px;
	font-family: Verdana, Arial, Helvetica, sans-serif;
}

-->
</style>

<script type="text/javascript" src="jquery.js"></script>

<script>

$(document).ready(function() {	
	//select all the a tag with name equal to modal

	$('a[name=modal]').click(function(e) {
		//Cancel the link behavior
       
		e.preventDefault();
		//Get the A tag
		var id = $(this).attr('href');
		var tid=$(this).attr('id');
		//Get the screen height and width
		var maskHeight = $(document).height();
		var maskWidth = $(window).width();
			    $('#table_wrapper').load('edq.php?id='+tid);
       
		//Set heigth and width to mask to fill up the whole screen
		$('#mask').css({'width':maskWidth,'height':maskHeight});
		
		//transition effect		
		$('#mask').fadeIn(1000);
		$('#mask').fadeTo("slow",0.8);	
	
		//Get the window height and width
		var winH = $(window).height();
		var winW = $(window).width();
              
		//Set the popup window to center
		$(id).css('top',  winH/2-$(id).height()/2);
		$(id).css('left', winW/2-$(id).width()/2);
	
		//transition effect
		$(id).fadeIn(2000); 
	
	});
	
	//if close button is clicked
	$('.window .close').click(function (e) {
		//Cancel the link behavior
		e.preventDefault();
		
		
		
        // or opener.location.href = opener.location.href;
       // window.close(); // or self.close();
		$('#mask').hide();
		$('.window').hide();
		window.location.reload();
	});		
	
	//if mask is clicked
	$('#mask').click(function () {
		$(this).hide();
		$('.window').hide();
	});			

	$(window).resize(function () {
	 
 		var box = $('#boxes .window');
 
        //Get the screen height and width
        var maskHeight = $(document).height();
        var maskWidth = $(window).width();
      
        //Set height and width to mask to fill up the whole screen
        $('#mask').css({'width':maskWidth,'height':maskHeight});
               
        //Get the window height and width
        var winH = $(window).height();
        var winW = $(window).width();

        //Set the popup window to center
        box.css('top',  winH/2 - box.height()/2);
        box.css('left', winW/2 - box.width()/2);
	 
	});
	
});

</script>
<style>
body {
font-family:verdana;
font-size:15px;
}

a {color:#333; text-decoration:none}
a:hover {color:#ccc; text-decoration:none}

#mask {
  position:absolute;
  left:0;
  top:0;
  z-index:9000;
  background-color:#000;
  display:none;
  
}
  
#boxes .window {
  position:absolute;
  left:0;
  top:0;
  width:auto;
  height:auto;
  display:none;
  z-index:9999;
  padding:20px;

}

#boxes #dialog {
  width:auto; 
  height:auto;
  padding:10px;
  background-color:#ffffff;

}

#boxes #dialog1 {
  width:375px; 
  height:203px;
}

#dialog1 .d-header {
  background:url(images/login-header.png) no-repeat 0 0 transparent; 
  width:375px; 
  height:150px;
}
#dialog1 .d-header input {
  position:relative;
  top:60px;
  left:100px;
  border:3px solid #cccccc;
  height:22px;
  width:200px;
  font-size:15px;
  padding:5px;
  margin-top:4px;
}

#dialog1 .d-blank {
  float:left;
  background:url(images/login-blank.png) no-repeat 0 0 transparent; 
  width:267px; 
  height:53px;
}

#dialog1 .d-login {
  float:left;
  width:108px; 
  height:53px;
}

#boxes #dialog2 {
  background:url(images/notice.png) no-repeat 0 0 transparent; 
  width:326px; 
  height:229px;
  padding:50px 0 20px 25px;
}
</style>
<script type='text/javascript' src='jquery.autocomplete.js'></script>
<link rel="stylesheet" type="text/css" href="jquery.autocomplete.css" />

<script type="text/javascript">
$().ready(function() {
	$("#stdid").autocomplete("search_std.php", {
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

<script type="text/javascript" language="javascript"> 
window.onload=function() {
document.forms[0][0].focus();
}
</script>

<style type="text/css">
<!--
.style17 {color: #000033}
.style18 {color: #FFFFFF}
-->
</style>
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
xmlhttp.open("GET","education.php?id="+p+"&count="+r,true);

xmlhttp.send();
}

</script>
<script type="text/javascript">
function toggleAndChangeText(r) {
     $('#myDiv'+r).toggle('slow');
     if ($('#myDiv'+r).css('display') == 'none') {
	     $('#aTag'+r).html('EDUCATION &#9658');
     }
     else {                    
	 
	     $('#aTag'+r).html('EDUCATION &#9660');

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
<p align="center" id="msgerr" ><font face="Arial, Helvetica, sans-serif" size="2"><?php if(isset($_GET['msg'])){ echo $_GET['msg']; }?></font></p>
<div id="top-search-div"> 
           <div id="content">
		   <label>Student Information</label>
		   <div class="input">
		   <form method="post" autocomplete="off" action="manage_student1.php">
		     <label>Search Form</label>
			 <label><input type="text" id="stdid" name="stdid" placeholder="Search by Student ID" /></label>
			 <label><input type="submit" name="subs" id="submit-btn" value="Search" /></label>
			 <label><a href="stdinfo.php"><input type="button" name="addbtn" id="submit-btn" value="Add New" /></a></label>
		   </form>
		   </div>
		</div>
		</div>	<br />
          
		  
		<table width="800" border="0" cellspacing="0" cellpadding="0" class="gridTbl">
            <tr>
              <td width="51" height="25" bgcolor="#0C6ED1" class="style15 style18 gridTblHead">ID</td>
              <td width="78" height="25" bgcolor="#0C6ED1" class="style15 style18 gridTblHead">Student ID </td>
              <td width="33" height="25" bgcolor="#0C6ED1" class="style15 style18 gridTblHead"></td>
              <td width="67" height="25" bgcolor="#0C6ED1" class="style15 style18 gridTblHead">Student Name </td>
              <td width="61" height="25" bgcolor="#0C6ED1" class="style15 style18 gridTblHead">Hostel</td>
              <td width="88" height="25" bgcolor="#0C6ED1" class="style15 style18 gridTblHead">Parents</td>
              <td height="25" colspan="4" align="center" bgcolor="#0C6ED1" class="style15 style18 gridTblHead">Action</td>
            </tr>
			<?php $stdid=mysql_real_escape_string($_POST['stdid']);
			      if(!empty($stdid)){
					  $std="SELECT id,stdid,stdname,hostel,concat(fname,' / ',mname) parents,img FROM tbl_stdinfo WHERE stdid like '%".$stdid."%' and storedstatus<>'D' order by id asc";
			      }else{
					  $std="SELECT id,stdid,stdname,hostel,concat(fname,' / ',mname) parents,img FROM tbl_stdinfo WHERE stdid like '%".$stdid."%' and storedstatus<>'D' order by id asc limit 30";
				  }
				  $stdq=$myDb->select($std);
				  $count=0;
				  while($stdr=$myDb->get_row($stdq,'MYSQL_ASSOC')){
				  if($count%2==0){
				  $bgcolor="#FFFFFF";
				  ?>
                        <tr bgcolor="<?php echo $bgcolor; ?>">
              <td height="30" class="style4 gridTblValue"><?php echo $stdr['id']; ?></td>
              <td height="30" class="style4 gridTblValue"><?php echo $stdr['stdid']; ?></td>
               <td height="30" class="style4 gridTblValue"><img src="uploads/<?php echo $stdr['img']; ?>" width="20" height="20" /></td>
			  <td height="30" class="style4 gridTblValue"><?php echo $stdr['stdname']; ?></td>
              <td height="30" class="style4 gridTblValue"><?php echo $stdr['hostel']; ?></td>
              <td height="30" class="style4 gridTblValue"><?php echo $stdr['parents']; ?></td>
              <td width="55" height="30" align="center" class="style4 gridTblValue"><a href="std_accupdate.php?id=<?php echo $stdr['id']; ?>">EDIT</a></td>
              <td width="70" height="30" align="center" class="style4 gridTblValue"><a href="del_std.php?id=<?php echo $stdr['id']; ?>" onClick="javascript:return confirm('Do you really want to delete this record')">DELETE</a></td>
              <td width="148" height="30" align="center" class="style4 gridTblValue"><a onClick="loadXMLDoc('<?php echo $stdr['id']; ?>','<?php echo $count; ?>')" id="aTag<?php echo $count; ?>" href="javascript:toggleAndChangeText(<?php echo $count; ?>);" >EDUCATION &#9658</a> </td>
              <td width="149" height="30" align="center" class="style4 gridTblValue"><a href="#dialog" name="modal" id="<?php echo $stdr['id']; ?>">ADD EDUCATION</a> </td>
            </tr>
      <tr bgcolor="" id="tbl">
       <td colspan="13" ><div id="myDiv<?php echo $count; ?>" style="width:800px;" align="center"></div></td>
      </tr>			<?php }else{ $bgcolor="#F7FCFF"; ?>
            <tr bgcolor="<?php echo $bgcolor; ?>">
              <td height="30" class="style4 gridTblValue"><?php echo $stdr['id']; ?></td>
              <td height="30" class="style4 gridTblValue" ><?php echo $stdr['stdid']; ?></td>
              <td height="30" class="style4 gridTblValue"><img src="uploads/<?php echo $stdr['img']; ?>" width="20" height="20" /></td>
			  <td height="30" class="style4 gridTblValue"><?php echo $stdr['stdname']; ?></td>
              <td height="30" class="style4 gridTblValue"><?php echo $stdr['hostel']; ?></td>
              <td height="30" class="style4 gridTblValue"><?php echo $stdr['parents']; ?></td>
              <td height="30" align="center " class="style4 gridTblValue"><a href="std_accupdate.php?id=<?php echo $stdr['id']; ?>">EDIT</a></td>
              <td height="30" align="center " class="style4 gridTblValue"><a href="del_std.php?id=<?php echo $stdr['id']; ?>" onClick="javascript:return confirm('Do you really want to delete this record')">DELETE</a></td>
              <td height="30" align="center " class="style4 gridTblValue"><a onClick="loadXMLDoc('<?php echo $stdr['id']; ?>','<?php echo $count; ?>')" id="aTag<?php echo $count; ?>" href="javascript:toggleAndChangeText(<?php echo $count; ?>);" >EDUCATION &#9658</a></td>
              <td height="30" align="center " class="style4 gridTblValue"><a href="#dialog" name="modal" id="<?php echo $stdr['id']; ?>">ADD EDUCATION</a></td>
            </tr>
      <tr bgcolor="" id="tbl">
       <td colspan="13" ><div id="myDiv<?php echo $count; ?>" style="width:800px;" align="center"></div></td>

      </tr>			<?php }
			  $count++;
			  ?>
			<?php }
			      
			?>
          </table>    
          <p align="center">&nbsp;
            </p>
<p></p>
</td>
      </tr>
	        <tr>
        <td height="60" colspan="2" valign="middle" bgcolor="#D3F3FE"><?php include("bot.php"); ?></td>
        </tr>

    </table></td>
  </tr>
</table>
<div id="boxes">

       <div id="dialog" class="window">
        
       <a href="#" class="close" style="margin-left:650px;">X</a>

       <div id="table_wrapper"></div>


     </div>
    </div>
  <div id="mask"></div>

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
?>
