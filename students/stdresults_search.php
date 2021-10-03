<?php 
ob_start();
session_start();
require_once('dbClass.php');
include("config.php"); 
if($myDb->connect($host,$user,$pwd,$db,true))
{ 
  	if($_SESSION['userid'])
	{
	  	//$vs="SELECT mef.stdid, mef.courseid, mef.session, mef.year, d.id as deptid, d.name as Department, sm.id as semesterid, sm.name as Semester FROM `tbl_marksentryfinal` mef inner join tbl_department d on mef.deptid=d.id inner join tbl_semester sm on mef.semesterid=sm.id WHERE mef.storedstatus<>'D' and mef.stdid='$_SESSION[userid]'";
  		//$r=$myDb->select($vs);
  		//$rowinitial=$myDb->get_row($r,'MYSQL_ASSOC');

		$t=0;
$count=1;
$ht=0;
$sn=1;
$c=1;
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
						width: 290, // default Width If null, will be calculate automatically
						height: 150, // default Height If null, will be calculate automatically
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
			
			
			
			$(".add_categoryfm").click(function(){
				categoryId = $(this).attr("id");
				courseid = $(this).attr("alt");

                //var examname=$(this).attr('alt');
       			//var count=$('#count').val();
				//var session=$('#sessionnew').val();
				//var deptid=$('#deptid').val();
				//var courseid=$('#courseid').val();
				//alert(courseid);
				//var eyear=$('#eyear').val();
				//var semesterid=$('#semesterid').val();

				$.nyroModalManual({
					url: 'stdresultsdetailspop.php?id='+categoryId +'&courseid='+courseid,
					width: 550, // default Width If null, will be calculate automatically
					height: 500, // default Height If null, will be calculate automatically
					minWidth: null, // Minimum width
					minHeight: null, // Minimum height
					//endRemove: function() {window.location.reload()}

				});
			});
			
			
			
		});
		</script>




<form name="MyForm" id="frm" autocomplete="off"  method="post" >           
			<table width="98%" border="0" align="center" cellpadding="0" cellspacing="2" >
             <tr>
               <td width="47%" height="20" class="style2" style="padding:3px; border-bottom:1px solid #CCCCCC;">Student Marks </td>
             </tr>
  </table>

<table width="98%" height="45" border="1" align="left" cellpadding="1" cellspacing="0" bordercolor="#666666" id="stdtbl">
              <tr bgcolor="#F4F4FF">
                <td width="50" height="23" class="style2"><div align="center"><strong>SLNo. </strong></div></td>
                <td width="112" height="23" class="style2"><div align="center"><strong>Subject Code </strong></div></td>
                <td width="313" height="23" class="style2"><div align="left"><strong>Name of Subject </strong></div></td>
                <td width="118" height="23" class="style2"><div align="center"><strong>Full Marks </strong></div></td>
                <td width="142" height="23" class="style2"><div align="center"><strong>Obtained Marks </strong></div></td>
                <td width="128" height="23" class="style2"><div align="center"><strong>Letter Geade</strong></div></td>
                <td width="160" height="23" class="style2"><div align="center"><strong>Grade Point(GP) </strong></div></td>
    </tr>
              <?php 
			$crs="SELECT mef.stdid, mef.courseid, mef.session, mef.year, d.id as deptid, d.name as Department, sm.id as semesterid, sm.name as Semester FROM `tbl_marksentryfinal` mef inner join tbl_department d on mef.deptid=d.id inner join tbl_semester sm on mef.semesterid=sm.id WHERE mef.storedstatus<>'D' and mef.stdid='$_SESSION[userid]' and mef.semesterid='$_POST[semester]'";
			$crq=$myDb->select($crs); 			
			$tcredit=0; $g=0; 
			$tcgp=0;
			while($crsr=$myDb->get_row($crq,'MYSQL_ASSOC'))
			{
					$query="SELECT distinct m.stdid, c.credit, right(c.coursecode,4) as coursecode, c.coursename, m.examname, m.session, m.deptid, m.courseid, m.year, m.semesterid, (c.cont_assess_t+c.f_exam_t+c.cont_assess_p+c.f_exam_p) as TotalMarks,
						ifnull((select ifnull(classtestmarks,0) as classtestmarks from tbl_marksentryfinal WHERE deptid='$crsr[deptid]' and courseid= '$crsr[courseid]' and semesterid='$_POST[semester]' and session='$crsr[session]' and year='$crsr[year]'  and stdid='$_SESSION[userid]') +
						(select ifnull(quiztestmarks,0) as quiztestmarks from tbl_marksentryfinal WHERE deptid='$crsr[deptid]' and courseid= '$crsr[courseid]' and semesterid='$_POST[semester]' and session='$crsr[session]' and year='$crsr[year]'  and stdid='$_SESSION[userid]') +
						(select ifnull(`hwmarks`,0) as hwmarks from tbl_marksentryfinal WHERE deptid='$crsr[deptid]' and courseid= '$crsr[courseid]' and semesterid='$_POST[semester]' and session='$crsr[session]' and year='$crsr[year]'  and stdid='$_SESSION[userid]') +
						(select ifnull(`jobexpr`,0) as jobexpr from tbl_marksentryfinal WHERE deptid='$crsr[deptid]' and courseid= '$crsr[courseid]' and semesterid='$_POST[semester]' and session='$crsr[session]' and year='$crsr[year]'  and stdid='$_SESSION[userid]') +
						(select ifnull(`jobexprfinal`,0) as jobexprfinal from tbl_marksentryfinal WHERE deptid='$crsr[deptid]' and courseid= '$crsr[courseid]' and semesterid='$_POST[semester]' and session='$crsr[session]' and year='$crsr[year]'  and stdid='$_SESSION[userid]') +
						(select ifnull(`jobexprreport`,0) as jobexprreport from tbl_marksentryfinal WHERE deptid='$crsr[deptid]' and courseid= '$crsr[courseid]' and semesterid='$_POST[semester]' and session='$crsr[session]' and year='$crsr[year]'  and stdid='$_SESSION[userid]') +
						(select ifnull(`jobexprreportfinal`,0) as jobexprreportfinal from tbl_marksentryfinal WHERE deptid='$crsr[deptid]' and courseid= '$crsr[courseid]' and semesterid='$_POST[semester]' and session='$crsr[session]' and year='$crsr[year]'  and stdid='$_SESSION[userid]') +
						(select ifnull(`jobexprviva`,0) as jobexprviva from tbl_marksentryfinal WHERE deptid='$crsr[deptid]' and courseid= '$crsr[courseid]' and semesterid='$_POST[semester]' and session='$crsr[session]' and year='$crsr[year]'  and stdid='$_SESSION[userid]') +
						(select ifnull(`jobexprvivafinal`,0) as jobexprvivafinal from tbl_marksentryfinal WHERE deptid='$crsr[deptid]' and courseid= '$crsr[courseid]' and semesterid='$_POST[semester]' and session='$crsr[session]' and year='$crsr[year]'  and stdid='$_SESSION[userid]') +
						(select ifnull(`attendancemarks`,0) as attendancemarks from tbl_marksentryfinal WHERE deptid='$crsr[deptid]' and courseid= '$crsr[courseid]' and semesterid='$_POST[semester]' and session='$crsr[session]' and year='$crsr[year]'  and stdid='$_SESSION[userid]') +
						(select ifnull(`attendancemarksprac`,0) as attendancemarksprac from tbl_marksentryfinal WHERE deptid='$crsr[deptid]' and courseid= '$crsr[courseid]' and semesterid='$_POST[semester]' and session='$crsr[session]' and year='$crsr[year]'  and stdid='$_SESSION[userid]') +
						(select ifnull(`behaviormarks`,0) as behaviormarks from tbl_marksentryfinal WHERE deptid='$crsr[deptid]' and courseid= '$crsr[courseid]' and semesterid='$_POST[semester]' and session='$crsr[session]' and year='$crsr[year]'  and stdid='$_SESSION[userid]') +
						(select ifnull(`finalexamprac`,0) as finalexamprac from tbl_marksentryfinal WHERE deptid='$crsr[deptid]' and courseid= '$crsr[courseid]' and semesterid='$_POST[semester]' and session='$crsr[session]' and year='$crsr[year]'  and stdid='$_SESSION[userid]') +
						(select ifnull(`finalexammarks`,0) as finalexammarks from tbl_marksentryfinal WHERE deptid='$crsr[deptid]' and courseid= '$crsr[courseid]' and semesterid='$_POST[semester]' and session='$crsr[session]' and year='$crsr[year]'  and stdid='$_SESSION[userid]'),0) as obtainedmarks 
						FROM `tbl_marksentryfinal` m inner join tbl_courses c on m.courseid=c.id WHERE m.deptid='$crsr[deptid]' and m.courseid= '$crsr[courseid]' and m.semesterid='$_POST[semester]' and m.session='$crsr[session]' and m.year='$crsr[year]' and m.stdid='$_SESSION[userid]'";	
				$result = mysql_query($query) or die(mysql_error());
			while($row=$myDb->get_row($result,'MYSQL_ASSOC'))
			{

				$mp= ($row['obtainedmarks']/$row['TotalMarks'])*100;
				if($mp>=80)
				{
					$grade = "A+";
					$gp = "4.00";
				}
				else if(($mp>=75) && ($mp<80))
				{
					$grade = "A";
					$gp = "3.75";
				}
				else if(($mp>=70) && ($mp<75))
				{
					$grade = "A-";
					$gp = "3.00";
				}
				else if(($mp>=65) && ($mp<70))
				{
					$grade = "B+";
					$gp = "3.25";
				}
				else if(($mp>=60) && ($mp<65))
				{
					$grade = "B";
					$gp = "3.00";
				}
				else if(($mp>=55) && ($mp<60))
				{
					$grade = "B-";
					$gp = "2.75";
				}
				else if(($mp>=50) && ($mp<55))
				{
					$grade = "C+";
					$gp = "2.50";
				}
				else if(($mp>=45) && ($mp<50))
				{
					$grade = "C";
					$gp = "2.25";
				}
				else if(($mp>=40) && ($mp<45))
				{
					$grade = "D";
					$gp = "2.00";
				}
				else if($mp<40)
				{
					$grade = "F";
					$gp = "0.00";
				}
				$gp = $gp;
    			$grade = $grade;
    			$cgp = $row['credit']*$gp;
				$credit=$row['credit']; 
			?>
              <tr>
                <td height="18" class="style4" align="center"><?php echo $sn++;?></td>
                <td height="18" bgcolor="#FFFFFF" class="style4" align="center"><?php echo $row['coursecode'];?></td>
                <td height="18" class="style4" ><a alt="<?php echo $crsr['courseid'];?>" class="add_categoryfm"><span style="font-family:Verdana, Arial, Helvetica, sans-serif; color:#6699FF;  font-size:10px;" ><?php echo $row['coursename'];?>
                   	  <input type="hidden" value="<?php echo $crsr['courseid']; ?>" name="courseid" id="courseid" />
               	</span></a></td>
                <td height="18" bgcolor="#FFFFFF" class="style4" align="center"><?php echo $row['TotalMarks'];?></td>
                <td height="18" class="style4" align="center"><?php echo $row['obtainedmarks'];?></td>
                <td height="18" class="style4" align="center"><?php echo $gp; ?></td>
                <td height="18" class="style4" align="center"><?php echo $grade; ?>
                  <input type="hidden" value="<?php echo $credit; ?>" name="credit" id="credit" />
                  <input type="hidden" value="<?php echo $cgp; ?>" name="cgp" id="cgp" /></td>
              <?php 	$count++; if($grade=="F"){$g+=$c; $c++;} 
			  		$tcredit +=$credit; $tcgp +=$cgp;
                 	}
					
        			$ht +=21;

			  	} if(!empty($_POST['stdid'])) {$gpav=round($tcgp/$tcredit,2);
			  	if(($gpav < 2.00) && ($gpav >= 0))
				{
					$fgrade="F";
				}
			  	else if(($gpav < 2.25) && ($gpav >= 2.00))
				{
					$fgrade="D";
				}
			  	else if(($gpav < 2.50) && ($gpav >= 2.25))
				{
					$fgrade="C";
				}
			  	else if(($gpav < 2.75) && ($gpav >= 2.50))
				{
					$fgrade="C+";
				}
			  	else if(($gpav < 3.00) && ($gpav >= 2.75))
				{
					$fgrade="B-";
				}
			  	else if(($gpav < 3.25) && ($gpav >= 3.00))
				{
					$fgrade="B";
				}
			  	else if(($gpav < 3.50) && ($gpav >= 3.25))
				{
					$fgrade="B+";
				}
			  	else if(($gpav < 3.75) && ($gpav >= 3.50))
				{
					$fgrade="A-";
				}
			  	else if(($gpav < 4.00) && ($gpav >= 3.75))
				{
					$fgrade="A";
				}
			  	else if($gpav = 4.00)
				{
					$fgrade="A+";
				}
				$fg=$fgrade;
			?>
    </tr>
  </table>

			<td height="249"  valign="top" bgcolor="#CCCCCC">
			<table width="100%" height="249"   border="0" cellpadding="0" cellspacing="0" bordercolor="#666666" id="stdtbl" >
              <tr>
                <td height="38" bgcolor="#CCCCCC"><span class="style2"><strong>Grade Point Average (GPA) </strong></span></td>
              </tr>
              <tr>
                <td bgcolor="#CCCCCC" height="<?php echo $ht; ?>" ><?php if($g>0){echo "F"; }else{echo $gpav; ?></br><?php echo " ".$fg; }}?></td>
              </tr>
			</table>
			</td>


</form>

		  	          
<?php 

}else{
  header("Location:login.php");
}
}  
?>