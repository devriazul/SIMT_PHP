<?php ob_start();
session_start();
require_once('dbClass.php');
include("config.php"); 
if($myDb->connectDefaultServer())
{ 
  if($_SESSION['userid']){
  $chka="SELECT*FROM  tbl_accdtl WHERE flname='manageallocatehostel.php' AND userid='$_SESSION[userid]'";
  $caq=$myDb->select($chka);
  $car=$myDb->get_row($caq,'MYSQL_ASSOC');
  if(($car['ins']=="y")||($_SESSION['userid']=="administrator")){
  $id='';
  if(!empty($_GET['id'])){
    $id=mysql_real_escape_string($_GET['id']);
  }
  $qrystd=$myDb->select("SELECT*FROM tbl_stdinfo WHERE id='$id'");
  $qstdf=$myDb->get_row($qrystd,'MYSQL_ASSOC');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title><?php include("title.php");?></title>
	<link type="text/css" href="css/jquery-ui-1.8.5.custom.css" rel="Stylesheet" />

<style type="text/css">
@import url("main.css");
.style15 {
	font-size: 12px;
	font-family: Verdana, Arial, Helvetica, sans-serif;
}

</style>
<script type="text/javascript" src="jquery.js"></script>
<script type='text/javascript' src='jquery.autocomplete.js'></script>
<link rel="stylesheet" type="text/css" href="jquery.autocomplete.css" />

<script type="text/javascript">
$().ready(function() {
	$("#searchid").autocomplete("search_std.php", {
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
.style17 {color: #000033}
.style18 {color: #FFFFFF}
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


        <script type="text/javascript">
            $(document).ready(function(){				   
                function loading_show(){
                    $('#loading').html("<img src='images/load.gif'/>").fadeIn('fast');
                }
                function loading_hide(){
                    $('#loading').fadeOut('fast');
                }                
                function loadData(page){
                    loading_show();                    
					var qstid='<?php echo $qstdf["stdid"]; ?>';
					var searchid=$('#searchid').val();
					$.get("student_paginationfh.php?page="+page+"&stdidsrch="+qstid+"&searchid="+searchid,function(msg){
                                loading_hide();
                                $("#container").html(msg);
					});             
                }
                loadData(1);  // For first time page load default results
                $('#container .pagination li.active').live('click',function(){
                    var page = $(this).attr('p');
					//var catp=$("#catp").val();
                    loadData(page);
                    
                });  
				$('#searchid').keyup(function(){
				   var arr=$('#stdsearch').serializeArray();
					var qstid='<?php echo $qstdf["stdid"]; ?>';
				   $.post("student_paginationfh.php?page=1&stdidsrch="+qstid,arr,function(r){
				     $('#container').html(r);
				   });
				   //$('#container').hide();
				   //$('#sstd').load("search_student_paginationfh.php?stdid="+sstd);
				});  
				$('#stdname').keyup(function(){
				   var arr=$('#stdsearch').serializeArray();
					var qstid='<?php echo $qstdf["stdid"]; ?>';
				   $.post("student_paginationfh.php?page=1&stdidsrch="+qstid,arr,function(r){
				     $('#container').html(r);
				   });
				   //$('#container').hide();
				   //$('#sstd').load("search_student_paginationfh.php?stdid="+sstd);
				});         
				       
            });
        </script>

        <style type="text/css">
            #loading{
                width: 100%;
                position: absolute;
                top: 75px;
                left: 500px;
				margin-top:200px;
            }
            #container .pagination ul li.inactive,
            #container .pagination ul li.inactive:hover{
                background-color:#ededed;
                color:#bababa;
                border:1px solid #bababa;
                cursor: default;
            }
            .data{
			  margin-top:-15px;
			}  
			 
			#container .data ul li{
                list-style: none;
                font-family: verdana;
                margin: 1px 0 1px 0;
                color: #000;
                font-size: 13px;
            }

            #container .pagination{
                width: 800px;
                height: 25px;
            }
            #container .pagination ul li{
                list-style: none;
                float: left;
                border: 1px solid #006699;
                padding: 2px 6px 2px 6px;
                margin: 5px 3px 0 3px;
                font-family: arial;
                font-size: 14px;
                color: #006699;
                font-weight: bold;
                background-color: #f2f2f2;
            }
            #container .pagination ul li:hover{
                color: #fff;
                background-color: #006699;
                cursor: pointer;
            }
			.go_button
			{
			background-color:#f2f2f2;border:1px solid #006699;color:#cc0000;padding:2px 6px 2px 6px;cursor:pointer;position:absolute;margin-top:-1px;
			}
			.total
			{
			float:right;font-family:arial;color:#999;
			}

        </style>



</head>

<body>

<table width="1047" border="0" align="center" cellpadding="0" cellspacing="0" id="table-width">
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
		   <label>Alocate Student Hostel </label>
		   <div class="input">
		   <form method="post" id="stdsearch" name="stdsearch" autocomplete="off" action="">
		     <label>Search Form</label>
			 <label><input type="text" id="stdname" name="stdname" placeholder="Search by student name" /></label>
			 <label><input type="text" id="searchid" name="searchid" placeholder="Search by studentID" /></label>
			 <label><input type="submit" name="subs" id="submit-btn" value="Search" /></label>
		   </form>
		   </div>
		   
		</div>
		</div>	<br />
			 <div id="loading"></div>
        <div id="container">
		<div class="pagination"></div>
            <div class="data"></div>
           
        </div>

		  <div align="center">
		   <div id="sstd"></div>
		  </div>
		

 
			</Td></tr></table>
	</div>		       
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