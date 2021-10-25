<?php 
ob_start();
session_start();
require_once('dbClass.php');
include("config.php"); 
if($myDb->connectDefaultServer())
{ 
  if($_SESSION['userid']){
	$iv="SELECT distinct exammarksper FROM tbl_examinitionsettings WHERE deptid='$_POST[deptid]' and courseid= '$_GET[courseid]' and semesterid='$_POST[semester]' and session='$_POST[session]' and year='$_POST[year]' and examtype='$_POST[examtype]'";
  	$ivq=$myDb->select($iv);
  	$ivrs=$myDb->get_row($ivq,'MYSQL_ASSOC');
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
	 
	 $.post('inssubmitstdfinalmarks.php',arr,function(result){
	    $('#shw').html(result);
	 });
	 $('#shw').hide().fadeIn('slow');
   });
 });
</script>
<form name="MyForm" id="frm" autocomplete="off"  method="post" >           
			<table width="100%" border="0" align="left" cellpadding="0" cellspacing="2" id="stdtbl">
             <tr>
               <td height="20" colspan="2" class="style2" style="padding:3px; border-bottom:1px solid #CCCCCC;"><span style="font:Verdana, Arial, Helvetica, sans-serif; font-weight:bold; font-size:14px; color:#666666;">Student <?php echo $_POST['examtype'];?> Marks.<span style="font:Verdana, Arial, Helvetica, sans-serif; font-weight:bold; font-size:14px; color:#00CCFF"> [Base Marks: <?php echo $ivrs['exammarksper'];?>]</span></span> </td>
             </tr>
             <tr>
               <td width="47%" height="20" class="style2"><table width="474" border="0" cellspacing="0" cellpadding="0" id="stdtbl">
                 
                 <?php
			      if(isset($_POST['deptid']) && isset($_POST['session']) && isset($_POST['semester'])){
  				  $crs="SELECT distinct examstatus, resultstatus FROM tbl_examinitionsettings WHERE deptid='$_POST[deptid]' and courseid= '$_GET[courseid]' and semesterid='$_POST[semester]' and session='$_POST[session]' and year='$_POST[year]' and examtype='$_POST[examtype]'";
  				  $crq=$myDb->select($crs);
  				  while($crsr=$myDb->get_row($crq,'MYSQL_ASSOC')){
				  if(($crsr['resultstatus']=="1") && ($crsr['examstatus']=="1"))
				  {
					?><span style="color:#FF0000"><?php echo "SORRY!!! Selected Options Marks Already Submited. Please try different combination."; ?></span> <?php 
					exit;
				  }else if(($crsr['resultstatus']=="0") && ($crsr['examstatus']=="0"))
				  { ?><span style="color:#FF0000"><?php echo "You are not yet taken all the ".$_POST['examtype'].". Please take the ".$_POST['examtype']." First, then try to Submit Final Marks of ". $_POST['examtype']; ?></span> <?php 
					exit;
				  }else { ?>
				  <tr bgcolor="#DFF4FF">
                   <td width="157" height="25" class="style15">Student ID </td>
                   <td width="216" height="25" class="style15"><div align="left">Student Name</div></td>
                   <td width="101" height="25" class="style15"><div align="center">Final Marks</div></td>
                  </tr>
				  <?php
				  if(($_POST['examtype']!="Class Test") && ($_POST['examtype']!="Quiz Test")) 
				  {
				  		$std="SELECT distinct m.id, m.stdid, m.marks , s.session, e.examname, e.examtype, s.stdname FROM `tbl_marksentryprimary` m inner join tbl_examinitionsettings e on e.id=m.examid inner join tbl_stdinfo s on m.stdid=s.stdid WHERE e.deptid='$_POST[deptid]' and e.session='$_POST[session]' and e.courseid='$_GET[courseid]' and e.semesterid='$_POST[semester]' and e.examtype='$_POST[examtype]' order by m.id";
				  } else {
				  		$std="SELECT * FROM tbl_stdinfo WHERE deptname='$_POST[deptid]' and session='$_POST[session]'";	
			      }
				  $stdq=$myDb->select($std);
				  $count=0;
				  while($stdr=$myDb->get_row($stdq,'MYSQL_ASSOC')){
				  if($count%2==0){
				  $bgcolor="#FFFFFF";
				  ?>
                 <tr bgcolor="<?php echo $bgcolor; ?>">
                   <td height="25" class="style4"><?php echo $stdr['stdid']; ?>
                   <input type="hidden" value="<?php echo $stdr['stdid']; ?>" name="stdid[]" id="stdid" />
					<input type="hidden" value="<?php echo $stdr['session']; ?>" name="sess" id="sess" />
					<input type="hidden" value="<?php echo $_POST['deptid']; ?>" name="deptid" id="deptid" />
					<input type="hidden" value="<?php echo $_GET['courseid']; ?>" name="courseid" id="courseid" />
                    <input type="hidden" value="<?php echo $_POST['semester']; ?>" name="semesterid2" id="semesterid2" />					
                    <input type="hidden" value="<?php echo $_POST['examtype']; ?>" name="examtype" id="examtype" />
					<input type="hidden" value="<?php echo $_POST['year']; ?>" name="year" id="year" />
				   </td>
                   <td height="25" class="style4" ><?php echo $stdr['stdname']; ?></td>
					<?php if(($_POST['examtype']!="Class Test") && ($_POST['examtype']!="Quiz Test")) {?>
                   <td height="25" class="style4" align="center"><input name="fmarks[]" type="text" class="numbersOnly" id="fmarks" value="<?php echo $stdr['marks']; ?>" style="width:90px; height:12px; text-align:center;" onKeyPress="return handleEnter(this, event);" maxlength="3" /></td>
                	<?php } else {?>
                   <td height="25" class="style4" align="center"><input name="fmarks[]" type="text" class="numbersOnly" id="fmarks"  style="width:90px; height:12px; text-align:center;" onKeyPress="return handleEnter(this, event);" maxlength="3" /></td>
					<?php }?> 
				</tr>
                 <tr bgcolor="" id="tbl">
                   <td colspan="7"></td>
                 </tr>
                 <?php }else{ $bgcolor="#F7FCFF"; ?>
                 <tr bgcolor="<?php echo $bgcolor; ?>">
                   <td height="25" class="style4"><?php echo $stdr['stdid']; ?>
                   <input type="hidden" value="<?php echo $stdr['stdid']; ?>" name="stdid[]" id="stdid" />
					<input type="hidden" value="<?php echo $stdr['session']; ?>" name="sess" id="sess" />
					<input type="hidden" value="<?php echo $_POST['deptid']; ?>" name="deptid" id="deptid" />
					<input type="hidden" value="<?php echo $_GET['courseid']; ?>" name="courseid" id="courseid" />
					<input type="hidden" value="<?php echo $_POST['semester']; ?>" name="semesterid" id="semesterid" />
					<input type="hidden" value="<?php echo $_POST['examtype']; ?>" name="examtype" id="examtype" />
					<input type="hidden" value="<?php echo $_POST['year']; ?>" name="year" id="year" />
					</td>
                   <td height="25" class="style4" ><?php echo $stdr['stdname']; ?></td>
					<?php if(($_POST['examtype']!="Class Test") && ($_POST['examtype']!="Quiz Test")) {?>
                   <td height="25" class="style4" align="center"><input name="fmarks[]" type="text" class="numbersOnly" id="fmarks" value="<?php echo $stdr['marks']; ?>" style="width:90px; height:12px; text-align:center;" onKeyPress="return handleEnter(this, event);" maxlength="3" /></td>
                	<?php } else {?>
                   <td height="25" class="style4" align="center"><input name="fmarks[]" type="text" class="numbersOnly" id="fmarks"  style="width:90px; height:12px; text-align:center;" onKeyPress="return handleEnter(this, event);" maxlength="3" /></td>
					<?php }?> 
                 </tr>
                 <?php }
			  	 	$count++;
			     	}
				 }
				}
			  }  

			?>
               </table></td>
               <td width="53%" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                 <?php $stdte="SELECT id,examname, (Select COUNT(e.examname) FROM tbl_examinitionsettings e WHERE e.deptid='$_POST[deptid]' and e.session='$_POST[session]' and e.courseid='$_GET[courseid]' and e.semesterid='$_POST[semester]' and e.examtype='$_POST[examtype]') as TE From  tbl_examinitionsettings WHERE deptid='$_POST[deptid]' and session='$_POST[session]' and courseid='$_GET[courseid]' and semesterid='$_POST[semester]' and examtype='$_POST[examtype]'";
			      	$opte=$myDb->select($stdte);
                    $nrow=4;
					while($gval=$myDb->get_row($opte,'MYSQL_ASSOC'))
					{ 
                  if($t==$nrow){
					?>
                 <tr>
                   <td>
                     <table width="114" border="0" cellspacing="2" cellpadding="0" id="stdtbl">
                       <tr bgcolor="#DFF4FF">
                         <td width="110" height="25" class="style15"><div align="center"><?php echo $gval['examname'];?></div></td>
                       </tr>
                       <?php 
							$stdx="SELECT m.marks FROM `tbl_marksentryprimary` m inner join tbl_examinitionsettings e on e.id=m.examid WHERE e.deptid='$_POST[deptid]' and e.session='$_POST[session]' and e.courseid='$_GET[courseid]' and e.semesterid='$_POST[semester]' and e.id='$gval[id]' order by m.id asc";
			      			$stdqx=$myDb->select($stdx);
				  			$count=0;
				  			while($stdrx=$myDb->get_row($stdqx,'MYSQL_ASSOC')){ 
				  			if($count%2==0){
							?>
                       <tr bgcolor="<?php echo $bgcolor; ?>">
                         <td height="25" class="style15"><div align="center" >
                             <?php echo $stdrx['marks'];?>
                         </div></td>
                       </tr>
                       <?php }else{ ?>
                       <tr bgcolor="<?php echo $bgcolor; ?>">
                         <td height="25" class="style15"><div align="center" ><?php echo $stdrx['marks'];?>
                         </div></td>
                       </tr>
                       <?php 
								$count++;
							}
						}
					?>
                   </table></td>
                   <?php $t=1; }else{ ?>
                   <td>
                     <table width="114" border="0" cellspacing="2" cellpadding="0" id="stdtbl">
                       <tr bgcolor="#DFF4FF">
                         <td width="110" height="25" class="style15"><div align="center"><?php echo $gval['examname'];?></div></td>
                       </tr>
                       <?php 
							$stdx="SELECT m.marks FROM `tbl_marksentryprimary` m inner join tbl_examinitionsettings e on e.id=m.examid WHERE e.deptid='$_POST[deptid]' and e.session='$_POST[session]' and e.courseid='$_GET[courseid]' and e.semesterid='$_POST[semester]' and e.id='$gval[id]' order by m.id asc";
			      			$stdqx=$myDb->select($stdx);
				  			$count=0;
				  			while($stdrx=$myDb->get_row($stdqx,'MYSQL_ASSOC')){ 
				  			if($count%2==0){
							?>
                       <tr bgcolor="<?php echo $bgcolor; ?>">
                         <td height="25" class="style15"><div align="center">
                           <?php echo $stdrx['marks'];?> </div></td>
                       </tr>
                       <?php }else{ ?>
                       <tr bgcolor="<?php echo $bgcolor; ?>">
                         <td height="25" class="style15"><div align="center">
                           <?php echo $stdrx['marks'];?> </div></td>
                       </tr>
                       <?php 
								$count++;
							}
						}
					?>
                   </table></td>
                   <?php 
					$t++;
						}
					}
				?>
                 </tr>
               </table></td>
             </tr>
             <tr>
               <td height="20" class="style2"><span class="nyroModal"><span class="style4">
                 <input type="button" class="sbmt" value="Submit Marks" style="color: #999999; font-size: 8pt; font-family: Verdana; border: 1px solid #C0C0C0; background-color: #D9F0FB" />
               </span></span></td>
               <td valign="top">&nbsp;</td>
             </tr>
             <tr>
               <td height="20" colspan="2" class="style2"><div id="shw"></div></td>
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