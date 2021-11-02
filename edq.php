<?php ob_start();
session_start();
include("config.php"); 
if($myDb->connectDefaultServer())
{ 
  if($_SESSION['userid']){
  $chka="SELECT*FROM  tbl_accdtl WHERE flname='manage_student.php' AND userid='$_SESSION[userid]'";
  $caq=$myDb->select($chka);
  $car=$myDb->get_row($caq,'MYSQL_ASSOC');
  if(($car['ins']=="y")||($_SESSION['userid']=="administrator")){ 
?>
<script language="javascript" type="text/javascript" src="jquery.js"></script>
<script language="javascript" type="text/javascript">
 $(document).ready(function(){
   $('#group1').change(function(){
      if($('#group1').val()=='others'){
	    $('#othername').show();
	  
	  }else{
	    $('#othername').hide();
	  }
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
<script language="javascript">
function checkedq(){
     if(document.getElementById("nexemination").value==""){
         alert('Exemination name can not left empty!');
	     document.getElementById("nexemination").focus();
	     return false;
     }
     if(document.getElementById("group1").value==""){
         alert('Group name can not left empty!');
	     document.getElementById("group1").focus();
	     return false;
     }
     if(document.getElementById("board").value==""){
         alert('Board name can not left empty!');
	     document.getElementById("board").focus();
	     return false;
     }
     if(document.getElementById("passyear").value==""){
         alert('Pass year can not left empty!');
	     document.getElementById("passyear").focus();
	     return false;
     }
     /*if(document.getElementById("gcsubject").value==""){
         alert('Special subject can not left empty!');
	     document.getElementById("gcsubject").focus();
	     return false;
     }
     if(document.getElementById("cgpas").value==""){
         alert('Special subject CGPA can not left empty!');
	     document.getElementById("cgpas").focus();
	     return false;
     }
	 */
     if(document.getElementById("tcgpa").value==""){
         alert('CGPA can not left empty!');
	     document.getElementById("tcgpa").focus();
	     return false;
     }
  }	 	

</script>


<form name="MyForm1" action="insert_edu.php" method="post" onsubmit="Javascript:return checkedq();">

<table width="650" border="0" align="center" cellpadding="0" cellspacing="0" id="stdtbl">
  
  <tr>
    <td width="196" height="30"style="padding:3px; border-bottom:1px solid #CCCCCC;"><span class="style11">EDUCATIONAL QUALIFICATION</span></td>
    <td width="18" height="30"style="padding:3px; border-bottom:1px solid #CCCCCC;">&nbsp;</td>
    <td width="315"style="padding:3px; border-bottom:1px solid #CCCCCC;">&nbsp;</td>
  </tr>
  <tr>
    <td height="5" class="style2">&nbsp;</td>
    <td height="5" class="style2">&nbsp;</td>
    <td height="5">&nbsp;</td>
  </tr>
  <tr>
    <td height="30" class="style2">Name of Exemination<span class="stars">*</span> </td>
    <td height="30" class="style2">:</td>
    <td><select name="nexemination" id="nexemination" style="font-family: Verdana; font-size: 8pt; border: 1px solid #3399FF" onkeypress="return handleEnter(this, event)" >
	      <option value=""></option>
		  <option value="S.S.C">S.S.C</option>
		  <option value="Vocational">Vocational</option>
		  <option value="Madrasah">Madrasah</option>
		  <option value="1st Semester">1st Semester</option>
		  <option value="2nd Semester">2nd Semester</option>
		  <option value="3rd Semester">3rd Semester</option>
		  <option value="4th Semester">4th Semester</option>
		  <option value="5th Semester">5th Semester</option>
		  <option value="6th Semester">6th Semester</option>
		  <option value="7th Semester">7th Semester</option>
		  <option value="8th Semester">8th Semester</option>
		  
	</select>	</td>
    </tr>
  <tr>
    <td height="30" class="style2">Group/Trade<span class="stars">*</span></td>
    <td height="30" class="style2">:</td>
    <td>
	  <select name="group1" id="group1" onkeypress="return handleEnter(this, event)" class="style4">
	     <option value="">Select Group</option>
		 <option value="Science">Science</option>
		 <option value="Arts">Arts</option>
		 <option value="Commerce">Commerce</option>
         <option value="others">Other's</option>
	  </select>
	</td>
  </tr>
  <tr>
    <td height="30" class="style2">&nbsp;</td>
    <td height="30" class="style2">&nbsp;</td>
    <td><div id="othername" style="display:none; "><input type="text" name="othtrade" id="othtrade"></div></td>
  </tr>
  <tr>
    <td height="30" class="style2">Board<span class="stars">*</span></td>
    <td height="30" class="style2">:</td>
    <td>
	<select name="board" id="board" class="style4" onkeypress="return handleEnter(this, event)">
	  <option value="">Select Board</option>
	  <option value="Dhaka">Dhaka</option>
	  <option value="Rajshahi">Rajshahi</option>
	  <option value="Comilla">Comilla</option>
	  <option value="Jessore">Jessore</option>
	  <option value="Chittagong">Chittagong</option>
	  <option value="Barisal">Barisal</option>
	  <option value="Sylhet">Sylhet</option>
	  <option value="Dinajpur">Dinajpur</option>
	  <option value="Madrasah">Madrasah</option>
	  <option value="BTEB">Bangladesh Technical Education Board</option>
	</select>	</td>
  </tr>
  <tr>
    <td height="30" class="style2">Pass Year<span class="stars">*</span> </td>
    <td height="30" class="style2">:</td>
    <td><input name="passyear" id="passyear" type="text" class="style4" size="20" onkeypress="return handleEnter(this, event)" /></td>
  </tr>
  <tr>
    <td height="30" class="style2">Special Subject Name</td>
    <td height="30" class="style2">:</td>
    <td><label>
      <select name="gcsubject" id="gcsubject" onkeypress="return handleEnter(this, event)">
        <option value="">Select</option>
        <option value="GM">General Math</option>
        <option value="HM">Higher Math</option>
        <option value="GS">General Science</option>
            </select>
    </label></td>
  </tr>
  <tr>
    <td height="30" class="style2">Got CGPA(GM/HM/SC)</td>
    <td height="30" class="style2">:</td>
    <td><input name="cgpas" id="cgpas" type="text" class="style4" onkeypress="return handleEnter(this, event)" /></td>
  </tr>
  <tr>
    <td height="30" class="style2">Total CGPA<span class="stars">* </span></td>
    <td height="30" class="style2">:</td>
    <td><input name="tcgpa" id="tcgpa" type="text" class="style4" onkeypress="return handleEnter(this, event)" /></td>
  </tr>
  <tr>
    <td></td>
    <td>&nbsp;</td>
    <td><input type="submit" name="Submit" value="Submit" style="color: #999999; font-size: 8pt; font-family: Verdana; border: 1px solid #C0C0C0; background-color: #D9F0FB" />
<input type="text" name="id" id="id" value="<?php echo mysql_real_escape_string($_GET['id']); ?>" /></td>
    </tr>
</table>
</form>
<?php
        }else{
             $msg="Sorry,you are not authorized to access this page";
         }	 

    }else{
      header("Location:index.php");
    }
}