<?php ob_start();
session_start();
include("../config.php"); 
require_once('class/ReturnStatus.class.php');

if($myDb->connectDefaultServer())
{ 
 if($_SESSION['userid']){
  $chka="SELECT*FROM  tbl_accdtl WHERE flname='book_entry.php' AND userid='$_SESSION[userid]'";
  $caq=$myDb->select($chka);
  $car=$myDb->get_row($caq,'MYSQL_ASSOC');
  if(($car['ins']=="y")||($_SESSION['userid']=="administrator")){
    $prs=new ReturnStatus();

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title><?php include("title.php");?></title>
<style type="text/css">
@import url("main.css");
.style12 {font-size: 10px}
.style15 {
	font-size: 12px;
	font-family: Verdana, Arial, Helvetica, sans-serif;
}
.style16 {font-size: 12px}

</style>
<?php $q=$myDb->select("select*from tbl_libsetting");
$rf=$myDb->get_row($q,'MYSQL_ASSOC');
if($rf['id']==""){
?>
<script type="text/javascript" src="js/jquery-latest.pack.js"></script>
<script>

$(document).ready(function() {	
	//select all the a tag with name equal to modal

	$(window).load(function(e) {
		//Cancel the link behavior
       
		e.preventDefault();
		//Get the A tag
		//var id = $('#a').attr('id');
				var id = $('#hr').attr('href');

		//alert(id);
		//Get the screen height and width
		var maskHeight = $(document).height();
		var maskWidth = $(window).width();
			    $('#table_wrapper').load('add_settings.php');
       
		//Set heigth and width to mask to fill up the whole screen
		$('#mask').css({'width':maskWidth,'height':maskHeight});
		
		//transition effect		
		$('#mask').fadeIn(300);
		$('#mask').fadeTo("slow",0.8);	
	
		//Get the window height and width
		var winH = $(window).height();
		var winW = $(window).width();
              
		//Set the popup window to center
		$(id).css('top',  winH/2-$(id).height()/2);
		$(id).css('left', winW/2-$(id).width()/2);
	
		//transition effect
		$(id).fadeIn(300); 
	
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
<?php } ?>
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
  width:430px; 
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

<script src="js/jquery-1.6.2.min.js" type="text/javascript"></script>

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
		
<script type="text/javascript" src="jquery.js"></script>
<script language="javascript" type="text/javascript">
$(document).ready(function(){

  $('#submit-btn').click(function(){
    var deptsearch=$('#deptsearch').val();
	var fdate=$('#fdate').val();
	var tdate=$('#tdate').val();
	$.get("tobereturnDateWise_search.php?deptsearch="+deptsearch+"&fdate="+fdate+"&tdate="+tdate+"&page=1",function(r){
	  $('#container').html(r);
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
</head>

<body id="a">
<?php if(empty($rf['id'])){ ?>

<a id="hr" href="#dialog" name="modal"></a>
 <div id="error"></div>
	<div id="boxes">

       <div id="dialog" class="window">
        
       <a href="#"class="close" style="margin-left:420px;"/>X</a>

       <div id="table_wrapper"></div>


     </div>
    </div>
  <div id="mask"></div>
<?php } ?>  
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
        <td background="images/leftbg.jpg">&nbsp;</td>
        <td><div align="center"><font face="Arial, Helvetica, sans-serif" size="2"><?php if(isset($_GET['t'])==0){ ?><span style="color:#FF6600; font-weight:bold;"><?php if(isset($_GET['msg'])){ echo $_GET['msg']; }?></span><?php } ?></font></div></td>
      </tr>
      <tr>
        <td width="21%" valign="top" background="images/leftbg.jpg"><?php include("left.php");?><br />
          <p>&nbsp;</p>
          <p>&nbsp;</p></td><td width="79%" valign="top">
		   <label></label>
		   <div class="search-form" id="top-search-div">
		   <form method="post" id="srs">
		     <label>Search Form</label>
             <label>
			 <input type="text" id="deptsearch" name="deptsearch" placeholder="Search By Department">
			 </label>			 
             <label>From Date:<input type="date" name="fdate" id="fdate" size="30" value="<?php echo date("Y-m-d"); ?>" onkeypress="return handleEnter(this, event)" ></label>
			 <label>To Date:<input type="date" name="tdate" id="tdate" size="30" value="<?php echo date("Y-m-d"); ?>" onkeypress="return handleEnter(this, event)"></label>

			 <label><input type="button" name="subs" id="submit-btn" value="Search" /></label>
			
		   </form>
		   </div>
		<br/>
		<br/>
		 <div id="shwprt" style="display:none; color:#333333; "></div>

	 <div id="searchdept"></div>

		  		  <div id="loading"></div>
        <div id="container">
		<div class="pagination"></div>
            <div class="data"></div>
            
        </div>
		<p>&nbsp;</p>
		  
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