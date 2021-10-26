<?php 
ob_start();
session_start();
include("../config.php"); 
if($myDb->connectDefaultServer())
{ 
  if($_SESSION['userid']){
/*  $chka="SELECT*FROM  tbl_accdtl WHERE flname='submitstudentmarksec.php' AND userid='$_SESSION[userid]'";
  $caq=$myDb->select($chka);
  $car=$myDb->get_row($caq,'MYSQL_ASSOC');
  if($car['ins']=="y"){
$per_page = 20;

if(isset($_GET['page']))
    $page = $_GET['page'];
$start = ($page-1)*$per_page;
*/
$t=0;
?>
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

	jQuery('.numbersOnly').keyup(function () { 
    this.value = this.value.replace(/[^0-9\.]/g,'');
	});
</script>



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
                var examid=$(this).attr('alt');//alert(categoryId);
       			var count=$('#count').val();
				var session=$('#session').val(); //alert(categoryId);
				var deptid=$('#deptid').val();
				var courseid=$('#courseid').val();
				var semesterid=$('#semester').val();
				var eyear=$('#year').val();

				$.nyroModalManual({
					url: 'addstudentsmarks.php?id='+categoryId +'&session='+session +'&examid='+examid +'&deptid='+deptid +'&courseid='+courseid +'&semesterid='+semesterid +'&eyear='+eyear,
					width: 1050, // default Width If null, will be calculate automatically
					height: 690, // default Height If null, will be calculate automatically
					minWidth: null, // Minimum width
					minHeight: null, // Minimum height
					endRemove: function() {/*window.location.reload()*/}
				});
			});
			
			
		});
</script>







<style type="text/css">
<!--
.style15 {	font-size: 10px; color:#666666;
	font-family: Verdana, Arial, Helvetica, sans-serif;
}
-->
</style>

<form name="MyForm" id="frm" autocomplete="off" method="post" class="nyroModal">           
			<table width="100%" border="0" align="left" cellpadding="0" cellspacing="2" id="stdtbl">
             <tr>
               <td width="47%" height="20" class="style2"><table width="95%" border="0" align="center" cellpadding="0" cellspacing="2" id="stdtbl">
                 <tr>
                   <td height="20" colspan="4" class="style2" style="padding:3px; border-bottom:1px solid #CCCCCC;">Lists of Examinition </td>
                 </tr>
                 <tr>
                   <td height="20" colspan="4" class="style2"><table width="900" border="0" cellspacing="0" cellpadding="0" id="stdtbl">
                       <tr bgcolor="#DFF4FF">
                         <td height="25" class="style15">ID</td>
                         <td height="25" class="style15">Examinition Name </td>
                         <td class="style15"><div align="center">Marks(%)</div></td>
                         <td height="25" class="style15"><div align="center">Last Date of Taken Exam</div></td>
                         <td height="25" colspan="2" align="center" class="style15 style18">Action</td>
                       </tr>
                       <?php
			      if(isset($_POST['deptid']) && isset($_POST['session']) && isset($_POST['semester'])){
				  $std="SELECT * from tbl_examinitionsettings WHERE deptid ='".$_POST['deptid']."' and courseid='".$_GET['courseid']."' and session='".$_POST['session']."' and semesterid='".$_POST['semester']."' and storedstatus<>'D' order by id asc ";
			      $stdq=$myDb->select($std);
				  $count=0;
				  while($stdr=$myDb->get_row($stdq,'MYSQL_ASSOC')){
				  if($count%2==0){
				  $bgcolor="#FFFFFF";
				  ?>
                       <tr bgcolor="<?php echo $bgcolor; ?>">
                         <td height="25" class="style4"><?php echo $stdr['id']; ?>
                             <input type="hidden" value="<?php echo $stdr['session']; ?>" name="session" id="session" /><input type="hidden" value="<?php echo $stdr['semesterid']; ?>" name="semester" id="semester" /></td>
                         <td height="25" class="style4"><?php echo $stdr['examname']; ?></td>
                         <td height="25" class="style4" align="center"><?php echo $stdr['exammarksper']; ?></td>
                         <td height="25" class="style4" align="center"><?php echo $stdr['lastdate']; ?></td>
                         <?php if($stdr['examstatus']==0){?>
                         <td height="25" align="center"><a alt="<?php echo $stdr['id']; ?>" class="add_category" id="<?php echo $stdr['deptid'];?>" ><span style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:10px; color:#FF0000; " >Click to Enter Marks</span></a></td>
                         <?php } else {?>
                         <td height="25" align="center"><span style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:10px; color:#009900; " >Marks Already Entered</span></td>
                         <?php }?>
                       </tr>
                       <tr bgcolor="" id="tbl">
                         <td colspan="8"><div id="myDiv<?php echo $count; ?>" style="width:800px;" align="center"></div></td>
                       </tr>
                       <?php }else{ $bgcolor="#F7FCFF"; ?>
                       <tr bgcolor="<?php echo $bgcolor; ?>">
                         <td height="25" class="style4"><?php echo $stdr['id']; ?>
                             <input type="hidden" value="<?php echo $stdr['session']; ?>" name="session2" id="session" /></td>
                         <td height="25" class="style4"><?php echo $stdr['examname']; ?></td>
                         <td height="25" class="style4" align="center"><?php echo $stdr['exammarksper']; ?></td>
                         <td height="25" class="style4" align="center"><?php echo $stdr['lastdate']; ?></td>
                         <?php if($stdr['examstatus']==0){?>
                         <td height="25" align="center"><a alt="<?php echo $stdr['id']; ?>" class="add_category" id="<?php echo $stdr['deptid'];?>" ><span style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:10px; color:#FF0000; " >Click to Enter Marks</span></a></td>
                         <?php } else {?>
                         <td height="25" align="center"><span style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:10px; color:#009900; " >Marks Already Entered</span></td>
                         <?php }?>
                       </tr>
                       <tr bgcolor="" id="tbl">
                         <td colspan="8"><div id="myDiv<?php echo $count; ?>" style="width:800px;" align="center"></div></td>
                       </tr>
                       <?php }
			  $count++;
			  ?>
                       <?php }}
			     
			?>
                   </table></td>
                 </tr>
                 <tr>
                   <td width="23%" height="20" class="style2">&nbsp; </td>
                   <td width="31%" height="20">&nbsp;</td>
                   <td width="18%">&nbsp;</td>
                   <td width="28%">&nbsp;</td>
                 </tr>
               </table></td>
              </tr>
             <tr>
               <td height="20" class="style2"><span class="nyroModal"><span class="style4">
               </span></span></td>
              </tr>
  </table>
</form>

		  	          
<?php 
/*   }else{
     $msg="Sorry,you are not authorized to access this page";
	 header("Location:home.php?msg=$msg");
   }	 
*/
}else{
  header("Location:index.php");
}
}  
?>