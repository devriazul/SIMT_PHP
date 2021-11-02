<?php ob_start();
session_start();
include("config.php"); 
if($myDb->connectDefaultServer())
{ 
	if($_SESSION['userid'])
	{
		$chka="SELECT*FROM  tbl_accdtl WHERE flname='view_chart_ofacc.php' AND userid='$_SESSION[userid]'";
  		$caq=$myDb->select($chka);
  		$car=$myDb->get_row($caq,'MYSQL_ASSOC');
        if($car['ins']=="y"){
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
	<head>
		<title><?php include("title.php");?></title>
	
		<link rel="stylesheet" media="screen" type="text/css" href="style.css" />
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
				categoryId = $(this).parent("li").attr("id");
				$.nyroModalManual({
					url: 'add.php?category_id='+categoryId,
					width: 450, // default Width If null, will be calculate automatically
					height: 280, // default Height If null, will be calculate automatically
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
.style3 {font-family: Calibri; font-size: 14px; font-weight: bold; }
-->
        </style>
			<link href="css/core.css" rel="stylesheet" type="text/css" />

	</head>
<body>

<p align="center" ><font face="Arial, Helvetica, sans-serif" size="2"><?php if(isset($_GET['msg'])){echo $_GET['msg'];}?></font></p>
<div id="content"><form autocomplete="off" action="view_chart_ofacc.php">
  <table width="90%" border="0" align="center" cellpadding="0" cellspacing="0">
    <tr>
      <td valign="top"><?php 
// database connection

//include_once("connection.php");
$totac=mysql_query("select count(*) tac from tbl_accchart where id not in(select parentid from tbl_accchart) and groupname!=0") or die(mysql_error());
$totacf=mysql_fetch_array($totac);
echo "Total Accounts Head ".$totacf['tac']."<br/>";
$rsCategories = mysql_query("SELECT * FROM tbl_accchart Where storedstatus<>'D' ORDER BY parentid, orderby");

$arrayCategories = array();

while($row = mysql_fetch_assoc($rsCategories)){ 
	$arrayCategories[$row['id']] = array("parent_id" => $row['parentid'], "name" => $row['accname']);	
} 

function createTree($array, $currentParent, $currLevel = 0, $prevLevel = -1) {
		
	foreach ($array as $categoryId => $category) {
		
		if ($currentParent == $category['parent_id']) {						
			
			if ($currLevel > $prevLevel) echo " <ul> \n"; 
			
			if ($currLevel == $prevLevel) echo " </li> \n";
			
			echo '<li id="'.$categoryId.'"><span>'.$category['name'].'</span>';
						
			if ($currLevel > $prevLevel) { $prevLevel = $currLevel; }
			
			$currLevel++; 

		 	createTree ($array, $categoryId, $currLevel, $prevLevel);
		 	
		 	$currLevel--;	 		 	

		}	

	}
	
	if ($currLevel == $prevLevel) echo "\n </li> \n </ul> \n";

}	
?>




	<ul class="simpleTree">
		<li id="0" class="root">
			<?php createTree($arrayCategories, 0); ?>
		</li>
	</ul>	</td>
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
   }else{
     $msg="Sorry,you are not authorized to access this page";
	 header("Location:acchome.php?msg=$msg");
   }	 

}else{
  header("Location:login.php");
}
}  
?>