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
  $rowid=mysql_real_escape_string($_GET['rowid']);  

?>

<script type="text/javascript" src="jquery.js"></script>


<script type='text/javascript' src='jquery.autocomplete.js'></script>
<link rel="stylesheet" type="text/css" href="jquery.autocomplete.css" />

<script language="javascript">
$().ready(function() {
        
		$("#stdid1<?php echo $_GET['rowid']; ?>").autocomplete("search_student.php?deptid="+<?php echo $_POST['deptid']; ?>, {
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
<script>
$("#stdid1<?php echo $_GET['rowid']; ?>").blur(function() {
	
     var stdid=$('#stdid1<?php echo $_GET['rowid']; ?>').val();
	 var stdid=encodeURIComponent(stdid);
     $.get('check_return.php?stdid='+stdid+'&rowid=<?php echo $rowid; ?>',function(data){
		   $('#bchk<?php echo $_GET['rowid']; ?>').val(data);
			 
		 $('#chkbook<?php echo $_GET['rowid']; ?>').html('<img src=bigLoader.gif>');
		 $('#chkbook<?php echo $_GET['rowid']; ?>').fadeIn('slow');
		 $('#chkbook<?php echo $_GET['rowid']; ?>').load('check_return.php?stdid='+stdid+'&rowid=<?php echo $rowid; ?>');
	 });
	 
     $.get('search_student_semester.php?stdid='+stdid,function(data){
	   $( "#semesterid<?php echo $_GET['rowid']; ?> option:selected" ).text($.trim(data));
	    
	 });
     $.get('search_student_semester_val.php?stdid='+stdid,function(data){
	   $( "#semesterid<?php echo $_GET['rowid']; ?> option:selected" ).val($.trim(data));
	    
	 });
	 
     $.get('search_student_session.php?stdid='+stdid,function(data){
	   $( "#session<?php echo $_GET['rowid']; ?> option:selected" ).text($.trim(data));
	    
	 });
     $.get('search_student_session_val.php?stdid='+stdid,function(data){
	   $( "#session<?php echo $_GET['rowid']; ?> option:selected" ).val($.trim(data));
	    
	 });
	 $("#issuee<?php echo $_GET['rowid']; ?>").focus();
	 
  }).trigger( "change" );
</script>

  <tr>
    <td width="35%"><span style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:9px; color:#FF0000" ><label>Student/Faculty ID*</label></span> </td>
    <td><label>
	  <input type="text" name="stdid" id="stdid1<?php echo $_GET['rowid']; ?>" onkeypress="return handleEnter(this, event)" style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:12px;"/>
	  <input type="hidden" name="bchk" id="bchk<?php echo $_GET['rowid']; ?>" onkeypress="return handleEnter(this, event)" />
    </label></td>
    </tr>
<?php 


   }else{
     $msg="Sorry,you are not authorized to access this page";
	 header("Location:home.php?msg=$msg");
   }	 

}else{
  header("Location:index.php");
}
}