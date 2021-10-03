<?php ob_start();
session_start();
require_once('dbClass.php');
include("config.php"); 
if($myDb->connect($host,$user,$pwd,$db,true))
{ 
	if($_SESSION['userid'])
	{
		/*$chka="SELECT*FROM  tbl_accdtl WHERE flname='manage_leaveapplication.php' AND userid='$_SESSION[userid]'";
  		$caq=$myDb->select($chka);
  		$car=$myDb->get_row($caq,'MYSQL_ASSOC');
        if($car['ins']=="y"){*/
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
	<head>
		<title><?php include("title.php");?></title>
	
		<link rel="stylesheet" href="js/nyroModal-1.3.0/styles/nyroModal.css" type="text/css" media="screen" />

		<script type="text/javascript" src="js/jquery-1.2.6.pack.js"></script>
		<script src="js/nyroModal-1.3.0/js/jquery.nyroModal-1.3.0.pack.js"></script>   
		<script type="text/javascript" src="js/jquery.simple.tree.js"></script>
		<script type="text/javascript">
		var simpleTreeCollection;	
		$(document).ready(function(){
			
			simpleTreeCollection = $('.simpleTree').simpleTree({
				
				autoclose: false,
				docToFolderConvert: false,
				
				afterClick:function(node){
					// nothing to do for now...
				},
				
				afterDblClick:function(node){
					categoryId = $('span:first',node).parent("li").attr("id");
					parentId = $('span:first',node).parent("li").parent("ul").parent("li").attr("id");

					$.nyroModalManual({
						url: 'update.php?category_id='+categoryId,
						width: 450, // default Width If null, will be calculate automatically
						height: 280, // default Height If null, will be calculate automatically
						minWidth: null, // Minimum width
						minHeight: null, // Minimum height
						endRemove: function() {window.location.reload()}
					});		
	
					return false;
		
				},
				afterMove:function(){	
					var serialStr = "";
					var order = "";
					$("ul.simpleTree li span").each(function(){			
						parentId = $(this).parent("li").parent("ul").parent("li").attr("id");
						if (parentId == undefined) parentId = "root";
						order = (($(this).parent("li").prevAll("li").size()+1))/2; 
						if ( parentId != "root") serialStr += ""+parentId+":"+$(this).parent("li").attr("id")+":"+order+"|";
					});
					$.ajax({
					   type: "POST",
					   url: "saveData.php",
					   data: "serialized="+serialStr,
					   success: function(msg){
					   	 $("#serializedList").html(msg);
					   }
					 });
			
					return false;
					
				},
				docToFolderConvert: false,
				afterAjax:function()
				{
					//alert('Loaded');
				},
				animate:true
			});	
			
			$(".add_category").click(function(){
				categoryId = $(this).attr("id");
                var empid=$(this).attr('alt'); //alert(categoryId);

				$.nyroModalManual({
					//url: 'add.php?category_id='+categoryId,
					url: 'leaveapplication_finalop.php?id='+categoryId+'&empid='+empid,
					width: 650, // default Width If null, will be calculate automatically
					height: 580, // default Height If null, will be calculate automatically
					minWidth: null, // Minimum width
					minHeight: null, // Minimum height
					endRemove: function() {window.location.reload()}
				});
			});
			
			$(".delete_category").click(function(){
				parentId = $(this).parent("li").attr("id");
				category_name = $(this).siblings("span").text();
				$.nyroModalManual({
					url: 'delete.php?category_id='+parentId+'&category_name='+category_name,
					endRemove: function() {window.location.reload()},
					width: 450, // default Width If null, will be calculate automatically
					height: 150, // default Height If null, will be calculate automatically
					minWidth: null, // Minimum width
					minHeight: null, // Minimum height
					resizeable: false, // Indicate if the content is resizable. Will be set to false for swf
					autoSizable: false, // Indicate if the content is auto sizable. If not, the min size will be used
					padding: 0 // padding for the max modal size	
				});
			});			
			
		});
		</script>
		<script type="text/javascript">	
	$(document).ready(function(){
		$("#form_submit").click(function(e){
			e.preventDefault();
			alert($('#accname').val());
			if($("#accname").val()!=""){ 
			   $("#add_new").submit();
			}else{ 
			  alert("Please insert the name of the new Account."); 
			  $('#accname').focus();
			  //return false;
			}  
		});
	});
</script>	 

	    <style type="text/css">
<!--
@import url("main.css");
.style1 {font-family: Calibri; font-size:12px;}
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
        <td width="21%" valign="top" background="images/leftbg.jpg"><?php include("left.php"); ?>
                   <br />
          
          <p>&nbsp;</p>
          <p>&nbsp;</p></td>
        <td width="79%" valign="top">
<p align="center" ><font face="Arial, Helvetica, sans-serif" size="2"><?php if(isset($_GET['msg'])){echo $_GET['msg'];}?></font></p>
<div id="content">
<form autocomplete="off" action="manage_leaveapplicationnew.php">
  <table width="90%" border="0" align="center" cellpadding="0" cellspacing="0">
    <tr>
      <td valign="top">

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr>
              <td height="20" colspan="2" align="center" valign="top" class="style2" style="padding:3px; border-bottom:1px solid #CCCCCC;">
                <div align="left">LEAVE APPLICATIONS </div></td>
              <td width="80%" height="20" class="style2" style="padding:3px; border-bottom:1px solid #CCCCCC;"><div align="center"></div></td>
            </tr>  
  <tr>
    <td width="5%">&nbsp;</td>
    <td width="91%">&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td colspan="3"><div align="center"><table width="100%" border="0" cellpadding="0" cellspacing="1" bgcolor="#CCCCCC" class="tbl_repeat">
			
				<tr bgcolor="#F4F4FF">
					<th width="14%" height="27" ><div align="left"><span style="font:Verdana, Arial, Helvetica, sans-serif; font-size:x-small; font-weight:bold; ">Leave Type</span></div></th>
					<th width="16%" ><div align="left"><span style="font:Verdana, Arial, Helvetica, sans-serif; font-size:x-small; font-weight:bold; ">From Date</span></div></th>
					<th width="15%" ><div align="left"><span style="font:Verdana, Arial, Helvetica, sans-serif; font-size:x-small; font-weight:bold; ">To Date</span></div></th>
					<th width="38%" ><div align="left"><span style="font:Verdana, Arial, Helvetica, sans-serif; font-size:x-small; font-weight:bold; ">Reason</span></div></th>
					<th width="17%" ><div align="left"><span style="font:Verdana, Arial, Helvetica, sans-serif; font-size:x-small; font-weight:bold; ">Status</span></div></th>
					</tr>
				
				<?php 
				$uac=$myDb->select("Select id ,empid ,name as Name,designation as Designation,applyfor as ApplyFor,applydate as ApplyDate,frmdate as FromDate,todate as ToDate,reason as Reason,status as Status from tbl_leaveapplication Where empid='$_SESSION[userid]' and storedstatus<>'D' order by id desc");
				while($uacf=$myDb->get_row($uac,'MYSQL_ASSOC')){
				?>
									
					<tr bgcolor="#FFFFFF">
						<td height="21" ><span style="font:Verdana, Arial, Helvetica, sans-serif; font-size:x-small; "><?php echo $uacf['ApplyFor']; ?></span></td>
						<td ><span style="font:Verdana, Arial, Helvetica, sans-serif; font-size:x-small; "><?php echo $uacf['FromDate']; ?></span></td>
						<td ><span style="font:Verdana, Arial, Helvetica, sans-serif; font-size:x-small; "><?php echo $uacf['ToDate']; ?></span></td>
						<td ><span style="font:Verdana, Arial, Helvetica, sans-serif; font-size:x-small; "><?php echo $uacf['Reason']; ?></span></td>
						<td ><span style="font:Verdana, Arial, Helvetica, sans-serif; font-size:x-small; "><?php if ($uacf['Status']=="Accepted"){ ?> <span style="font:Verdana, Arial, Helvetica, sans-serif; font-size:9px; font-weight:bold; color:#009966; text-align:center; "><?php echo $uacf['Status']; ?></span><?php }else if ($uacf['Status']=="Rejected"){?><span style="font:Verdana, Arial, Helvetica, sans-serif; font-size:9px; font-weight:bold; color:#FF0000; text-align:center;"><?php echo $uacf['Status']; ?></span><?php }else{?><span style="font:Verdana, Arial, Helvetica, sans-serif; font-size:9px; font-weight:bold; color:#000000; text-align:center;"><?php echo $uacf['Status']; ?></span><?php }?></span></td>
						<!---<a href="#" class="remove" rel="">
								Preview
							</a>-->								
						
					</tr>
					
				<?php } ?>
</table>
    </div></td>
    </tr>
  <tr>
    <td colspan="3">&nbsp;</td>
  </tr>
</table>


	</td>
    </tr>
  </table>
</form>	
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
 /*  }else{
     $msg="Sorry,you are not authorized to access this page";
	 header("Location:acchome.php?msg=$msg");
   }	 
*/
}else{
  header("Location:login.php");
}
}  
?>