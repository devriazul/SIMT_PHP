<?php ob_start();
session_start();
require_once('dbClass.php');
include("config.php");
require_once('class/ReturnStatus.class.php');
require_once('class/PagingPage.class.php');

if($myDb->connect($host,$user,$pwd,$db,true))
{ 
  if($_SESSION['userid']){
  $chka="SELECT*FROM  tbl_accdtl WHERE flname='book_entry.php' AND userid='$_SESSION[userid]'";
  $caq=$myDb->select($chka);
  $car=$myDb->get_row($caq,'MYSQL_ASSOC');
  if(($car['ins']=="y")||($_SESSION['userid']=="administrator")){
  $prs=new ReturnStatus();
  
  
  $pg=new PagingPage();

?>  
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title><?php include("title.php");?></title>
<style type="text/css">

@import url("library.css");
@import url("main.css");
.style12 {font-size: 10px}
.style15 {
	font-size: 12px;
	font-family: Verdana, Arial, Helvetica, sans-serif;
}
.style16 {font-size: 12px}
.irstatus{
 box-shadow: 10px 10px 5px #888888;
} 
</style>


<script src="jquery.js" type="text/javascript"></script>

<script type="text/javascript">
            $(document).ready(function(){				   
                function loading_show(){
                    //$('#loading').hide().show().html("<img src='load.gif'/>").fadeOut();
                }
                function loading_hide(){
                    $('#loading').fadeOut('fast');
                }                
                function loadData(page){
                    loading_show();                    
                    
					var deptsearch=$('#deptsearch').val();
					var fdate=$('#fdate').val();
					var tdate=$('#tdate').val();
					$.get("tobereturnDateWise_search.php?deptsearch="+deptsearch+"&fdate="+fdate+"&tdate="+tdate+"&page="+page,function(msg){
                                loading_hide();
                                $("#container").css({'margin':'0px auto','width':'750px'}).html(msg);
					});
                }
                loadData(1);  // For first time page load default results
                $('#container .pagination li.active').live('click',function(){
                    var page = $(this).attr('p');
					//var catp=$("#catp").val();
                    loadData(page);
                    
                });           
            });
        </script>

        <style type="text/css">
            #loading{
                width: 100%;
                position: absolute;
                top: 200px;
                left: 500px;
				margin-top:50px;
            }
			#container{
			   width:600px;
			}   
            #container .pagination ul li.inactive,
            #container .pagination ul li.inactive:hover{
                background-color:#ededed;
                color:#bababa;
                border:1px solid #bababa;
                cursor: default;
            }
            .data{
			  margin-top:15px;
			}  
			 
			#container .data ul li{
                list-style: none;
                font-family: verdana;
                margin: 1px 0 1px 0;
                color: #000;
                font-size: 13px;
            }

            #container .pagination{
                width: 600px;
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

<script language="javascript" type="text/javascript">
$(document).ready(function(){

  $('#submit-btn').click(function(){
    var deptsearch=$('#deptsearch').val();
	var fdate=$('#fdate').val();
	var tdate=$('#tdate').val();
	$.get("tobereturnDateWise_search.php?deptsearch="+deptsearch+"&fdate="+fdate+"&tdate="+tdate+"&page=1",function(r){
	  $('#container').html(r).slideDown();
	});
	
  
  });
  
  
  $('#deptsearch').keyup(function(){
    $('#container').show().slideDown("slow");
    $('#searchdept').slideUp();
    //$('#container').load("tobereturnDateWise.php?page=1");
  
  });
  
  
  

});


</script>

<script type='text/javascript' src='jquery.autocomplete.js'></script>
<link rel="stylesheet" type="text/css" href="jquery.autocomplete.css" />

<script language="javascript" type="text/javascript">
$().ready(function() {
		$("#deptsearch").autocomplete("search_department.php", {
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

<script language="javascript">
  $(document).ready(function(){
	 $('#dptprt').click(function(){
	    var name=$('#deptsearch').val();
		var fdate=$('#fdate').val();
		var tdate=$('#tdate').val();
		var thePopup = window.open("reports/deptwisebookreturn.php?name="+name+"&fdate="+fdate+"&tdate="+tdate,"Book Issue & Return Information","location=0,titlebar=0,menubar=0,addressbar=no,height=700,width=900","fullscreen=yes" );
		  
		});
 });


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
        <td background="images/leftbg.jpg">&nbsp;</td>
        <td><div align="center"><font face="Arial, Helvetica, sans-serif" size="2"><?php if(isset($_GET['t'])==0){ ?><span style="color:#FF6600; font-weight:bold;"><?php if(isset($_GET['msg'])){ echo $_GET['msg']; }?></span><?php } ?></font></div></td>
      </tr>
      <tr>
        <td width="21%" valign="top" background="images/leftbg.jpg"><?php include("left.php");?>         <br />
         </td><td width="79%" valign="top">

		
		  
		   <div id="top-search-div" >
		   <form method="post" id="srs">
             <label>
			 <input type="text" id="deptsearch" name="deptsearch" placeholder="Search By Department" class="input_small" size="40">
			 </label>			 
             <label>From Date:<input type="date" name="fdate" id="fdate" size="20"  onkeypress="return handleEnter(this, event)" ></label>
			 <label>To Date:<input type="date" name="tdate" id="tdate" size="20"  onkeypress="return handleEnter(this, event)"></label>

			 <label><input type="button" name="subs" id="submit-btn" value="Search" /></label>
			 <label><input type="button" name="subs" id="dptprt" value="Print" class="button-class" /></label>
		   </form>
		   </div>
<div style="padding-left:20px;width:700px;" id="search-list"></div>
<div style="padding-left:20px;width:700px;" id="book-list"> 
</div>			
 <div id="shwprt" style="display:none; color:#333333; "></div>
      <div id="searchdept">
	  
	  </div>
		  <div id="loading"></div>
        <div id="container">
		<div class="pagination"></div>
            <div class="data"></div>
            
        </div>
		<p>&nbsp;</p>
		 <!--<div id="rtstatus"></div> -->
        
		  
		  </td></tr>
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