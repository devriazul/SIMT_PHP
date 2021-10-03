<?php 
ob_start();
session_start();
require_once('dbClass.php');
include_once("config.php"); // the connection to the database 
if($myDb->connect($host,$user,$pwd,$db,true))
{
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

<script language="JavaScript" type="text/JavaScript">
function checkstd(){
	 if(document.getElementById("marks").value==""){
         alert('Please Enter a Marks.');
	     document.getElementById("marks").focus();
	     return false;
     }
}
</script>

<style type="text/css">
<!--
.style1 {
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size: 12px;
	color: #000000;
border-bottom:1px solid #CCCCCC;
}
-->
</style>

<div style="overflow:hidden; margin:1em;">
<table width="97%"  border="0" cellspacing="0" cellpadding="0" id="stdtbl">
  <tr>
    <td><h1 class="style1">Student Final Marks Entry </h1>
      <?php if(isset($_GET['submitted'])) { 
	
	$query="UPDATE   tbl_examinitionsettings set examstatus='1' Where id='$_POST[examid]'";
	$op=$myDb->update_sql($query);
	$NR = count($_POST['stdid']);
	for($i=0;$i<$NR;$i++)
	{
		$opdate=date("Y-m-d");
		$examid=$_POST['examid'];
		$stdid=$_POST['stdid'][$i];
		$marks=$_POST['marks'][$i];
		$opby=$_SESSION['userid'];

		$newCategory = mysql_query("INSERT INTO tbl_marksentryprimary (examid, stdid, marks, opby, opdate, storedstatus) 
					VALUES ('$examid','$stdid','$marks','$opby','$opdate','I')") or die(mysql_error());
								
		
	}
	

	?>
      <script type="text/javascript">	
		$(document).ready(function(){
			$.nyroModalRemove();
		});
	  </script>
      <?php
	
} else { 

// extract the max order number: the new category will have this order number + 1
/*$csession=date("y").date("y")+1;


$rsCategoryName = mysql_query("SELECT * FROM tbl_stdinfo WHERE deptname ='$_GET[id]' and session='$csession'") or die(mysql_error());
$results = mysql_fetch_array($rsCategoryName);
$categoryName = $results[0];
*/

?>
    	
		<form action="<?php echo $_SERVER["PHP_SELF"]."?submitted=true" ?>" method="POST" name="add_new" class="nyroModal" id="add_new" onSubmit="Javascript:return checkstd();">     
   		<label for="category_name"></label>
        <table width="89%"  border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td width="52%"><table width="510" border="0" cellspacing="0" cellpadding="0" id="stdtbl">
              <tr bgcolor="#DFF4FF">
                <td width="237" height="25" class="style15">Student Name</td>
                <td width="144" height="25" class="style15">Student ID </td>
                <td width="144" class="style15">Final Marks</td>
              </tr>
              <?php
			      //$csession=date("y").date("y")+1;
				  $csession=$_GET['session'];
				  $std="SELECT * FROM tbl_stdinfo WHERE deptname ='$_GET[id]' and session='$csession'";
			      $stdq=$myDb->select($std);
				  $count=0;
				  while($stdr=$myDb->get_row($stdq,'MYSQL_ASSOC')){
				  //if($count%2==0){
				  $bgcolor="#F7FCFF";
				  ?>
              <tr bgcolor="<?php echo $bgcolor; ?>">
                <td height="25" class="style4"><?php echo $stdr['stdname']; ?>
                    <input type='hidden' name='examid' id='examid' value="<?php echo $_GET['examid'];?>"  ></td>
                <td height="25" class="style4"><input type='textbox' name='stdid[]' id='stdid[]' value="<?php echo $stdr['stdid'];?>" readonly="true" ></td>
                <td class="style4"><input name='marks[]' type='textbox' id='marks[]' maxlength="3" class="numbersOnly"  onKeyPress="return handleEnter(this, event)" ></td>
              </tr>
              <?php
			  $count++;
			 // }
			    } 
			?>
            </table></td>
            <td width="12%"><table width="114" border="0" cellspacing="0" cellpadding="0" id="stdtbl">
              <tr bgcolor="#DFF4FF">
                <td width="110" height="25" class="style15"><div align="center">ClassTest1Marks</div></td>
              </tr>
              <?php
			      //$csession=date("y").date("y")+1;
				  $csession=$_GET['session'];
				  $std="Select marks as ClassTest1 FROM `tbl_marksentryprimary` m inner join tbl_examinitionsettings e on e.id=m.examid WHERE e.deptid='$_GET[id]' and e.session='$csession' and e.id='1'";
			      $stdq=$myDb->select($std);
				  $count=0;
				  while($stdr=$myDb->get_row($stdq,'MYSQL_ASSOC')){
				  //if($count%2==0){
				  $bgcolor="#F7FCFF";
				  ?>
              <tr bgcolor="<?php echo $bgcolor; ?>">
                <td height="25" class="style4"><div align="center">
                    <input name='marks1st' type='textbox' id='marks1st2' width="60px" maxlength="3" class="numbersOnly"  value="<?php echo $stdr['ClassTest1'];?>" onKeyPress="return handleEnter(this, event)" >
                </div></td>
              </tr>
              <?php
			  $count++;
			 // }
			    } 
			?>
            </table></td>
            <td width="12%"><table width="114" border="0" cellspacing="0" cellpadding="0" id="stdtbl">
              <tr bgcolor="#DFF4FF">
                <td width="110" height="25" class="style15"><div align="center">ClassTest1Marks</div></td>
              </tr>
              <?php
			      //$csession=date("y").date("y")+1;
				  $csession=$_GET['session'];
				  $std="Select marks as ClassTest1 FROM `tbl_marksentryprimary` m inner join tbl_examinitionsettings e on e.id=m.examid WHERE e.deptid='$_GET[id]' and e.session='$csession' and e.id='1'";
			      $stdq=$myDb->select($std);
				  $count=0;
				  while($stdr=$myDb->get_row($stdq,'MYSQL_ASSOC')){
				  //if($count%2==0){
				  $bgcolor="#F7FCFF";
				  ?>
              <tr bgcolor="<?php echo $bgcolor; ?>">
                <td height="25" class="style4"><div align="center">
                    <input name='marks1st2' type='textbox' id='marks1st3' width="80px" maxlength="3" class="numbersOnly"  value="<?php echo $stdr['ClassTest1'];?>" onKeyPress="return handleEnter(this, event)" >
                </div></td>
              </tr>
              <?php
			  $count++;
			 // }
			    } 
			?>
            </table></td>
            <td width="24%"><table width="118" border="0" cellspacing="0" cellpadding="0" id="stdtbl">
              <tr bgcolor="#DFF4FF">
                <td width="110" height="25" class="style15"><div align="center">ClassTest1Marks</div></td>
              </tr>
              <?php
			      //$csession=date("y").date("y")+1;
				  $csession=$_GET['session'];
				  $std="Select marks as ClassTest1 FROM `tbl_marksentryprimary` m inner join tbl_examinitionsettings e on e.id=m.examid WHERE e.deptid='$_GET[id]' and e.session='$csession' and e.id='1'";
			      $stdq=$myDb->select($std);
				  $count=0;
				  while($stdr=$myDb->get_row($stdq,'MYSQL_ASSOC')){
				  //if($count%2==0){
				  $bgcolor="#F7FCFF";
				  ?>
              <tr bgcolor="<?php echo $bgcolor; ?>">
                <td height="25" class="style4"><div align="center">
                    <input name='marks1st3' type='textbox' id='marks1st4' width="80px" maxlength="3" class="numbersOnly"  value="<?php echo $stdr['ClassTest1'];?>" onKeyPress="return handleEnter(this, event)" >
                </div></td>
              </tr>
              <?php
			  $count++;
			 // }
			    } 
			?>
            </table></td>
            </tr>
        </table>
        <input type="hidden" value="<?php echo $_GET['category_id'] ?>" name="category_id" id="category_id" />
        <span class="style4"><span class="style2">
        <input type="submit" name="submit" id="submit" value="Submit Marks" style="color: #999999; font-size: 8pt; font-family: Verdana; border: 1px solid #C0C0C0; background-color: #D9F0FB" />
        </span></span>
      </form>
<script type="text/javascript">	
	$(document).ready(function(){
		$("#form_submit").click(function(e){
			e.preventDefault();
			if ( $("#category_name").val() != "" ) $("#add_new").submit();
			else alert("Please insert the name of the new Account.");
		});
	});
</script>	 
      <?php }} ?></td>
  </tr>
</table>

</div>
