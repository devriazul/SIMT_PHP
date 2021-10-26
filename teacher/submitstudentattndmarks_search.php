<?php 
ob_start();
session_start();
include("../config.php"); 
if($myDb->connectDefaultServer())
{ 
  if($_SESSION['userid']){
/*  $chka="SELECT*FROM  tbl_accdtl WHERE flname='semesterwisesubject_search.php' AND userid='$_SESSION[userid]'";
  $caq=$myDb->select($chka);
  $car=$myDb->get_row($caq,'MYSQL_ASSOC');
  if($car['ins']=="y"){*/
/*$per_page = 20;

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

<script language="javascript">
 $(document).ready(function(){
   $('.sbmt').click(function(){
     var arr=$('#frm').serializeArray();
	 
	 $.post('inssubmitstdattndmarks.php',arr,function(result){
	    $('#shw').html(result);
	 });
	 $('#shw').hide().fadeIn('slow');
   });
 });
</script>
<form name="MyForm" id="frm" autocomplete="off"  method="post" >           
			<table width="98%" border="0" align="left" cellpadding="0" cellspacing="2" id="stdtbl">
             <tr>
               <td height="20" class="style2" style="padding:3px; border-bottom:1px solid #CCCCCC;">Student <?php echo $_POST['examtype'];?> Marks</td>
             </tr>
             <tr>
               <td width="47%" height="20" class="style2"><table width="100%" border="0" cellspacing="0" cellpadding="0" class="gridTbl">
                 <?php
			      //if($_POST['examtype']=="Attendance Theory Cont")
				  //{
  				  		$crs="SELECT * FROM tbl_attndexaminitiontrace WHERE deptid='$_POST[deptid]' and courseid= '$_GET[courseid]' and semesterid='$_POST[semester]' and session='$_POST[session]'  and section='$_POST[section]' and examname='$_POST[examtype]' and year='$_POST[year]'"; 
  				  		$crq=$myDb->select($crs);
  				  		$crsr=$myDb->get_row($crq,'MYSQL_ASSOC'); 
				  //}else if($_POST['examtype']=="Attendance Practical Cont")
				  //{
  				  //		$crs="SELECT * FROM tbl_attndexaminitiontrace WHERE deptid='$_POST[deptid]' and courseid= '$_GET[courseid]' and semesterid='$_POST[semester]' and session='$_POST[session]' and year='$_POST[year]' and attendancemarksprac<>'0'";
  				  //		$crq=$myDb->select($crs);
  				  //		$crsr=$myDb->get_row($crq,'MYSQL_ASSOC'); 
				  //}
				  if($crsr==0)
				  { 
				  ?>
                
				  <tr bgcolor="#DFF4FF">
                   <td width="192" height="25" class="gridTblHead style2">Student ID </td>
                   <td width="355" height="25" class="gridTblHead style2"><div align="left">Student Name</div></td>
                   <td width="166" class="gridTblHead style2"><div align="center">Total Working Days </div></td>
                   <td width="105" class="gridTblHead style2"><div align="center">Attended Days </div></td>
                   <td width="109" height="25" class="gridTblHead style2"><div align="center">Marks (In %) </div></td>
                   <td width="106" class="gridTblHead style2"><div align="center">Obtained Marks</div></td>
				  </tr>
				  <?php
				  //$std="SELECT m.id, m.stdid, m.marks , e.examname, e.examtype, s.stdname FROM `tbl_marksentryprimary` m inner join tbl_examinitionsettings e on e.id=m.examid inner join tbl_stdinfo s on m.stdid=s.stdid WHERE e.deptid='$_POST[deptid]' and e.session='$_POST[session]' and e.courseid='$_GET[courseid]' and e.semesterid='$_POST[semester]' and e.examtype='$_POST[examtype]' ";
				  $std="SELECT * FROM tbl_stdinfo WHERE deptname='$_POST[deptid]' and session='$_POST[session]' and section='$_POST[section]'";	
			      $stdq=$myDb->select($std);
				  $count=0;
				  while($stdr=$myDb->get_row($stdq,'MYSQL_ASSOC')){
				  if($count%2==0){
				  $bgcolor="#FFFFFF";
				  ?>
                 <tr bgcolor="<?php echo $bgcolor; ?>">
                   <td height="25" class="gridTblValue"><?php echo $stdr['stdid']." (".$stdr['boardrollno'].")"; ?>
                   <input type="hidden" value="<?php echo $stdr['stdid']; ?>" name="stdid[]" id="stdid" />
					<input type="hidden" value="<?php echo $stdr['session']; ?>" name="session" id="session" />
					<input type="hidden" value="<?php echo $_POST['section']; ?>" name="section" id="section" />
					<input type="hidden" value="<?php echo $_POST['deptid']; ?>" name="deptid" id="deptid" />
					<input type="hidden" value="<?php echo $_GET['courseid']; ?>" name="courseid" id="courseid" />
					<input type="hidden" value="<?php echo $_POST['semester']; ?>" name="semesterid" id="semesterid" />
					<input type="hidden" value="<?php echo $_POST['examtype']; ?>" name="examtype" id="examtype" />
					<input type="hidden" value="<?php echo $_POST['year']; ?>" name="year" id="year" />
					<input type="hidden" value="<?php echo $_POST['bm']; ?>" name="bm" id="bm<?php echo $count; ?>" />
				   </td>
                   <td height="25" class="gridTblValue" ><?php echo $stdr['stdname']; ?></td>
                   <td class="gridTblValue" align="center"><input name="tnd[]" type="text" class="numbersOnly" id="tnd<?php echo $count; ?>" value="<?php echo $_POST['twork']; ?>" style="width:90px; height:12px; text-align:center;" onKeyPress="return handleEnter(this, event);" maxlength="3" /></td>
				   <td class="gridTblValue" align="center"><input name="ad[]" type="text" class="numbersOnly" id="ad<?php echo $count; ?>" style="width:90px; height:12px; text-align:center;" onKeyPress="return handleEnter(this, event);" maxlength="3" /></td>
                   <td height="25" class="gridTblValue" align="center"><input name="mp[]" type="text" class="numbersOnly" id="mp<?php echo $count; ?>" style="width:90px; height:12px; text-align:center;" onKeyPress="return handleEnter(this, event);" maxlength="3" readonly="true" /></td>

                   <td class="gridTblValue" align="center"><input name="fmarks[]" type="text" class="numbersOnly" id="fmarks<?php echo $count; ?>" style="width:90px; height:12px; text-align:center; background-color:#F5F5F5; color:#333333;" onKeyPress="return handleEnter(this, event);" maxlength="3"  readonly="true"/></td>
                 </tr>
		<script language="javascript">
		$(function () {
        	
		$('#ad<?php echo $count; ?>').keyup(function () {
        	if(parseInt($('#tnd<?php echo $count; ?>').val())<parseInt($('#ad<?php echo $count; ?>').val())){
                    alert("Attendanc days can not bigger then total attendanc days");
                    $('#ad<?php echo $count; ?>').focus();
					$('#ad<?php echo $count; ?>').val(0);
					$('#mp<?php echo $count; ?>').val(0);
					$('.sbmt').hide();
                    return false;
            }else{
			  $('.sbmt').show();
			}  

			var TxtBox = document.getElementById("mp<?php echo $count; ?>");
			
            TxtBox.value = parseInt(($(this).val()/$("#tnd<?php echo $count; ?>").val())*100);
            
        	});
    	});

		$(document).ready(function(){
  		$('#mp<?php echo $count; ?>').focus(function(){
   	        if(parseInt($('#bm<?php echo $count; ?>').val())==2)
			{
				if(parseInt($('#mp<?php echo $count; ?>').val())>90){
					$('#fmarks<?php echo $count; ?>').val(2);
				}else if((parseInt($('#mp<?php echo $count; ?>').val())>=80)&& (parseInt($('#mp<?php echo $count; ?>').val())<=90)){
					$('#fmarks<?php echo $count; ?>').val(1.5);
				}else if((parseInt($('#mp<?php echo $count; ?>').val())>=70)&& (parseInt($('#mp<?php echo $count; ?>').val())<=79)){
					$('#fmarks<?php echo $count; ?>').val(1);
				}else if((parseInt($('#mp<?php echo $count; ?>').val())<70)){
					$('#fmarks<?php echo $count; ?>').val(0);
				}
			}  
   	        else if(parseInt($('#bm<?php echo $count; ?>').val())==4)
			{
				if(parseInt($('#mp<?php echo $count; ?>').val())>90){
					$('#fmarks<?php echo $count; ?>').val(4);
				}else if((parseInt($('#mp<?php echo $count; ?>').val())>=80)&& (parseInt($('#mp<?php echo $count; ?>').val())<=90)){
					$('#fmarks<?php echo $count; ?>').val(3);
				}else if((parseInt($('#mp<?php echo $count; ?>').val())>=70)&& (parseInt($('#mp<?php echo $count; ?>').val())<=79)){
					$('#fmarks<?php echo $count; ?>').val(2);
				}else if((parseInt($('#mp<?php echo $count; ?>').val())<70)){
					$('#fmarks<?php echo $count; ?>').val(0);
				}
			}  
			else if(parseInt($('#bm<?php echo $count; ?>').val())==6)
			{
				if(parseInt($('#mp<?php echo $count; ?>').val())>90){
					$('#fmarks<?php echo $count; ?>').val(6);
				}else if((parseInt($('#mp<?php echo $count; ?>').val())>=80)&& (parseInt($('#mp<?php echo $count; ?>').val())<=90)){
					$('#fmarks<?php echo $count; ?>').val(4);
				}else if((parseInt($('#mp<?php echo $count; ?>').val())>=70)&& (parseInt($('#mp<?php echo $count; ?>').val())<=79)){
					$('#fmarks<?php echo $count; ?>').val(2);
				}else if((parseInt($('#mp<?php echo $count; ?>').val())<70)){
					$('#fmarks<?php echo $count; ?>').val(0);
				}
			} 

			else if(parseInt($('#bm<?php echo $count; ?>').val())==8)
			{
				if(parseInt($('#mp<?php echo $count; ?>').val())>90){
					$('#fmarks<?php echo $count; ?>').val(8);
				}else if((parseInt($('#mp<?php echo $count; ?>').val())>=80)&& (parseInt($('#mp<?php echo $count; ?>').val())<=90)){
					$('#fmarks<?php echo $count; ?>').val(6);
				}else if((parseInt($('#mp<?php echo $count; ?>').val())>=70)&& (parseInt($('#mp<?php echo $count; ?>').val())<=79)){
					$('#fmarks<?php echo $count; ?>').val(4);
				}else if((parseInt($('#mp<?php echo $count; ?>').val())<70)){
					$('#fmarks<?php echo $count; ?>').val(0);
				}
			} 
			else if(parseInt($('#bm<?php echo $count; ?>').val())==10)
			{
				if(parseInt($('#mp<?php echo $count; ?>').val())>90){
					$('#fmarks<?php echo $count; ?>').val(10);
				}else if((parseInt($('#mp<?php echo $count; ?>').val())>=80)&& (parseInt($('#mp<?php echo $count; ?>').val())<=90)){
					$('#fmarks<?php echo $count; ?>').val(8);
				}else if((parseInt($('#mp<?php echo $count; ?>').val())>=70)&& (parseInt($('#mp<?php echo $count; ?>').val())<=79)){
					$('#fmarks<?php echo $count; ?>').val(6);
				}else if((parseInt($('#mp<?php echo $count; ?>').val())<70)){
					$('#fmarks<?php echo $count; ?>').val(0);
				}
			}   
  		});
	});
	</script>
                 <tr bgcolor="" id="tbl">
                   <td colspan="10"></td>
                 </tr>
                 <?php }else{ $bgcolor="#F7FCFF"; ?>
                 <tr bgcolor="<?php echo $bgcolor; ?>">
                   <td height="25" class="gridTblValue"><?php echo $stdr['stdid']." (".$stdr['boardrollno'].")"; ?>
                   <input type="hidden" value="<?php echo $stdr['stdid']; ?>" name="stdid[]" id="stdid" />
					<input type="hidden" value="<?php echo $stdr['session']; ?>" name="session" id="session" />
					<input type="hidden" value="<?php echo $_POST['section']; ?>" name="section" id="section" />
					<input type="hidden" value="<?php echo $_POST['deptid']; ?>" name="deptid" id="deptid" />
					<input type="hidden" value="<?php echo $_GET['courseid']; ?>" name="courseid" id="courseid" />
					<input type="hidden" value="<?php echo $_POST['semester']; ?>" name="semesterid" id="semesterid" />
					<input type="hidden" value="<?php echo $_POST['examtype']; ?>" name="examtype" id="examtype" />
					<input type="hidden" value="<?php echo $_POST['year']; ?>" name="year" id="year" />
					<input type="hidden" value="<?php echo $_POST['bm']; ?>" name="bm" id="bm<?php echo $count; ?>" />
			   </td>
                   <td height="25" class="gridTblValue" ><?php echo $stdr['stdname']; ?></td>
                   <td class="gridTblValue" align="center"><input name="tnd[]" type="text" class="numbersOnly" id="tnd<?php echo $count; ?>" value="<?php echo $_POST['twork']; ?>" style="width:90px; height:12px; text-align:center;" onKeyPress="return handleEnter(this, event);" maxlength="3" /></td>
                   <td class="gridTblValue" align="center"><input name="ad[]" type="text" class="numbersOnly" id="ad<?php echo $count; ?>" style="width:90px; height:12px; text-align:center;" onKeyPress="return handleEnter(this, event);" maxlength="3" /></td>
                   <td height="25" class="gridTblValue" align="center"><input name="mp[]" type="text" class="numbersOnly" id="mp<?php echo $count; ?>" style="width:90px; height:12px; text-align:center;" onKeyPress="return handleEnter(this, event);"  maxlength="3" readonly="true" /></td>
                   <td class="gridTblValue" align="center"><input name="fmarks[]" type="text" class="numbersOnly" id="fmarks<?php echo $count; ?>" style="width:90px; height:12px; text-align:center; background-color:#F5F5F5; color:#333333;" onKeyPress="return handleEnter(this, event);" maxlength="3"  readonly="true"/></td>
                 </tr>
        <script language="javascript">

		$(function () {
       	$('#ad<?php echo $count; ?>').keyup(function () {
        	if(parseInt($('#tnd<?php echo $count; ?>').val())<parseInt($('#ad<?php echo $count; ?>').val())){
                    alert("Attendanc days can not bigger then total attendanc days");
                    $('#ad<?php echo $count; ?>').focus();
					$('#ad<?php echo $count; ?>').val(0);
					$('#mp<?php echo $count; ?>').val(0);
					$('.sbmt').hide();
                    return false;
            }else{
			  $('.sbmt').show();
			}  

			var TxtBox = document.getElementById("mp<?php echo $count; ?>");
			
            TxtBox.value = parseInt(($(this).val()/$("#tnd<?php echo $count; ?>").val())*100);
            
        	});
    	});

	$(document).ready(function(){
  	$('#mp<?php echo $count; ?>').focus(function(){
           	        if(parseInt($('#bm<?php echo $count; ?>').val())==2)
			{
				if(parseInt($('#mp<?php echo $count; ?>').val())>90){
					$('#fmarks<?php echo $count; ?>').val(2);
				}else if((parseInt($('#mp<?php echo $count; ?>').val())>=80)&& (parseInt($('#mp<?php echo $count; ?>').val())<=90)){
					$('#fmarks<?php echo $count; ?>').val(1.5);
				}else if((parseInt($('#mp<?php echo $count; ?>').val())>=70)&& (parseInt($('#mp<?php echo $count; ?>').val())<=79)){
					$('#fmarks<?php echo $count; ?>').val(1);
				}else if((parseInt($('#mp<?php echo $count; ?>').val())<70)){
					$('#fmarks<?php echo $count; ?>').val(0);
				}
			}  
   	        else if(parseInt($('#bm<?php echo $count; ?>').val())==4)
			{
				if(parseInt($('#mp<?php echo $count; ?>').val())>90){
					$('#fmarks<?php echo $count; ?>').val(4);
				}else if((parseInt($('#mp<?php echo $count; ?>').val())>=80)&& (parseInt($('#mp<?php echo $count; ?>').val())<=90)){
					$('#fmarks<?php echo $count; ?>').val(3);
				}else if((parseInt($('#mp<?php echo $count; ?>').val())>=70)&& (parseInt($('#mp<?php echo $count; ?>').val())<=79)){
					$('#fmarks<?php echo $count; ?>').val(2);
				}else if((parseInt($('#mp<?php echo $count; ?>').val())<70)){
					$('#fmarks<?php echo $count; ?>').val(0);
				}
			}  
			else if(parseInt($('#bm<?php echo $count; ?>').val())==6)
			{
				if(parseInt($('#mp<?php echo $count; ?>').val())>90){
					$('#fmarks<?php echo $count; ?>').val(6);
				}else if((parseInt($('#mp<?php echo $count; ?>').val())>=80)&& (parseInt($('#mp<?php echo $count; ?>').val())<=90)){
					$('#fmarks<?php echo $count; ?>').val(4);
				}else if((parseInt($('#mp<?php echo $count; ?>').val())>=70)&& (parseInt($('#mp<?php echo $count; ?>').val())<=79)){
					$('#fmarks<?php echo $count; ?>').val(2);
				}else if((parseInt($('#mp<?php echo $count; ?>').val())<70)){
					$('#fmarks<?php echo $count; ?>').val(0);
				}
			} 
			else if(parseInt($('#bm<?php echo $count; ?>').val())==8)
			{
				if(parseInt($('#mp<?php echo $count; ?>').val())>90){
					$('#fmarks<?php echo $count; ?>').val(8);
				}else if((parseInt($('#mp<?php echo $count; ?>').val())>=80)&& (parseInt($('#mp<?php echo $count; ?>').val())<=90)){
					$('#fmarks<?php echo $count; ?>').val(6);
				}else if((parseInt($('#mp<?php echo $count; ?>').val())>=70)&& (parseInt($('#mp<?php echo $count; ?>').val())<=79)){
					$('#fmarks<?php echo $count; ?>').val(4);
				}else if((parseInt($('#mp<?php echo $count; ?>').val())<70)){
					$('#fmarks<?php echo $count; ?>').val(0);
				}
			} 
			else if(parseInt($('#bm<?php echo $count; ?>').val())==10)
			{
				if(parseInt($('#mp<?php echo $count; ?>').val())>90){
					$('#fmarks<?php echo $count; ?>').val(10);
				}else if((parseInt($('#mp<?php echo $count; ?>').val())>=80)&& (parseInt($('#mp<?php echo $count; ?>').val())<=90)){
					$('#fmarks<?php echo $count; ?>').val(8);
				}else if((parseInt($('#mp<?php echo $count; ?>').val())>=70)&& (parseInt($('#mp<?php echo $count; ?>').val())<=79)){
					$('#fmarks<?php echo $count; ?>').val(6);
				}else if((parseInt($('#mp<?php echo $count; ?>').val())<70)){
					$('#fmarks<?php echo $count; ?>').val(0);
				}
			}   

  });
});
</script>
                  <?php }
			  	 	$count++;
			     	}
				}else{
					?><span style="color:#FF0000"><?php echo "Selected Options Marks Already Submited. Please try another combination."; ?></span> <?php 
					exit;
				  
				}
				
			?>
               </table></td>
              </tr>
             <tr>
               <td height="20" class="style2"><span class="nyroModal"><span class="style4">
                 <input type="button" class="sbmt" value="Submit Marks" style="color: #999999; font-size: 8pt; font-family: Verdana; border: 1px solid #C0C0C0; background-color: #D9F0FB" />
               </span></span></td>
              </tr>
             <tr>
               <td height="20" class="style2"><div id="shw"></div></td>
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
  header("Location:login.php");
}
}  
?>