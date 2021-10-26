<?php ob_start();
session_start();
include("../config.php"); 
if($myDb->connectDefaultServer())
{ 
  if($_SESSION['userid']){
  $chka="SELECT*FROM  tbl_accdtl WHERE flname='book_entry.php' AND userid='$_SESSION[userid]'";
  $caq=$myDb->select($chka);
  $car=$myDb->get_row($caq,'MYSQL_ASSOC');
  if(($car['ins']=="y")||($_SESSION['userid']=="administrator")){
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><head>
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
<script language="javascript">
  $(document).ready(function(){	
  
  
  
   $('#chk').click(function(){
   
	 /* $('input[name=caqty]').each(function(){
			  if($(this).val()<=0){
				 alert("Approve Qty can not Zero");
				 return false;
			  }else{	 
    */ 
   
				   $("input[type=checkbox]:checked").each ( function() {	
				     var tid=$(this).val();
			
					  $('#stksuc').load('update_stock.php?id='+ tid);
					  $('#stksuc').hide().fadeIn('slow');
					});
			  //}	

	  // });	
	});
	
  });
</script>

<script type='text/javascript' src='jquery.autocomplete.js'></script>
<link rel="stylesheet" type="text/css" href="jquery.autocomplete.css" />

<script type="text/javascript">
$().ready(function() {
	$("#searchid").autocomplete("search_book_deptid.php", {
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
            $(document).ready(function(){				   
                function loading_show(){
                    $('#loading').html("<img src='images/loader.gif'/>").fadeIn('fast');
                }
                function loading_hide(){
                    $('#loading').fadeOut('fast');
                }                
                function loadData(page){
				    var searchid=$('#searchid').val();
                    loading_show();                    
                    $.ajax
                    ({
                        type: "GET",
                        url: "book_followers_list.php?searchid="+searchid,
                        data: "page="+page,
					  //  data:$("form").serialize(),
                        success: function(msg)
                        {
                            $("#container").ajaxComplete(function(event, request, settings)
                            {
                                loading_hide();
                                $("#container").html(msg);
                            });
                        }
                    });
                }
                loadData(1);  // For first time page load default results
                $('#container .pagination li.active').live('click',function(){
                    var page = $(this).attr('p');
					//var catp=$("#catp").val();
                    loadData(page);
                    
                });    
				
				$('#searchid').keypress(function(){
				  var searchid=$('#searchid').val();
				  $.get("book_followers_list.php?searchid="+searchid+"&page=1",function(data){
				    $("#container").html(data);
				  });
				}); 
				
				$('#searchid').keyup(function(){
				  var searchid=$('#searchid').val();
				  $.get("book_followers_list.php?searchid="+searchid+"&page=1",function(data){
				    $("#container").html(data);
				  });
				}); 
				
				$('#submit-btn').click(function(){
				  var searchid=$('#searchid').val();
				  $.get("book_followers_list.php?searchid="+searchid+"&page=1",function(data){
				    $("#container").html(data);
				  });
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

<script language="javascript" type="text/javascript">
 $(document).ready(function(){
 	  $('input[name=addu2]').click(function(){
	    var searchid=$('#searchid').val();
		
		    var thePopup = window.open( 'reports/bookRgstRpt.php?searchid='+searchid,"Stock Status","location=0,titlebar=0,menubar=0,addressbar=no,height=700,width=900","fullscreen=yes" );
			    //$('#popup-content').clone().appendTo( thePopup.document.body );
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
		   <form method="post" autocomplete="off" action="">
             		 
             <label><input type="text" id="searchid" name="searchid" placeholder="Search by book name" /></label>
			 <label><input type="button" name="subs" id="submit-btn" value="Search" /></label>
			 <label><input type="button"  name="addu2" value="Print View" id="submit-btn" /></label>
		   </form> <div id="stksuc"></div>
		</div>	
		
		 <br />
		
		 <div id="error"></div>
		
		<form name="stk" id="stk" method="post">
			 <div id="loading"></div>
        <div id="container">
		<div class="pagination"></div>
            <div class="data"></div>
            
        </div>
        </form>
		  <div align="center">
		  
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