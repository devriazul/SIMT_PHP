<?php ob_start();
session_start();

include('../config.php');  
if($myDb->connectDefaultServer())
{ 
  if($_SESSION['userid']){
  $chka="SELECT*FROM  tbl_accdtl WHERE flname='add_schedule_map.php' AND userid='$_SESSION[userid]'";
  $caq=$myDb->select($chka);
  $car=$myDb->get_row($caq,'MYSQL_ASSOC');
  if(($car['ins']=="y")||($_SESSION['userid']=="administrator")){
  $yrpart=!empty($_GET['yrpart'])?mysql_real_escape_string($_GET['yrpart']):'';
?>
				<span class="style2">From :<span class="stars">*</span></span>
				<select style="width:130px;" name="frmtime" id="frmtime" onkeypress="return handleEnter(this, event)">
                      <option value="">From Time</option>
                      <?php $fq=$myDb->select("select id,intervalName from tbl_time_interval where yrpart='$yrpart' order by orderid");
				while($fqf=$myDb->get_row($fq,'MYSQL_ASSOC')){ ?>
                      <option value="<?php echo $fqf['id']; ?>"><?php echo $fqf['intervalName']; ?></option>
                      <?php } ?>
                      </select>				<span class="style2">To :<span class="stars">*
                        <select style="width:130px;" name="totime" id="totime" onkeypress="return handleEnter(this, event)">
                          <option value="">To Time</option>
                          <?php $tq=$myDb->select("select id,intervalName from tbl_time_interval where yrpart='$yrpart' order by orderid");
				while($tqf=$myDb->get_row($tq,'MYSQL_ASSOC')){ ?>
                          <option value="<?php echo $tqf['id']; ?>"><?php echo $tqf['intervalName']; ?></option>
                          <?php } ?>
                        </select> </span></span>
<?php 
   }else{
     $msg="Sorry,you are not authorized to access this page";
	 header("Location:home.php?msg=$msg");
   }	 

}else{
  header("Location:index.php");
}
}						
