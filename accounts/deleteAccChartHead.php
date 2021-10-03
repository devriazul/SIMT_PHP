<?php ob_start();
session_start();
require_once('dbClass.php');
include("config.php"); 
if($myDb->connect($host,$user,$pwd,$db,true))
{ 
  if($_SESSION['userid']){
  $chka="SELECT*FROM  tbl_accdtl WHERE flname='manage_accheadnew.php' AND userid='$_SESSION[userid]'";
  $caq=$myDb->select($chka);
  $car=$myDb->get_row($caq,'MYSQL_ASSOC');
  if(($car['ins']=="y")||($_SESSION['userid']=="administrator")){
     $accid = !empty($_GET['id']) ? mysql_real_escape_string($_GET['id']) : '';
	 if( !empty($accid) ) {
	 ?>
	 <style>
	   .acctble{
	   		border:1px solid #ddd;
			margin:0 auto;
			padding:0;
	   }
	   .acctble td{
	   		padding:5px;
			border-top:1px solid #ddd;
	   }
	 </style>
	 <script type="text/javascript" src="jquery.js"></script>
	 <div id="accrcd">
<p align="center" ><font face="Arial, Helvetica, sans-serif" size="2">
  <?php if(isset($_GET['t'])==1){ ?>
  <span style="color:#66CC66; font-weight:bold;"><?php if(isset($_GET['msg'])){ echo $_GET['msg']; }?></span>
  <?php }else{ ?>
  <span style="color:#FF0000; font-weight:bold;"><?php if(isset($_GET['msg'])){ echo $_GET['msg']; }?></span>
  <?php } ?>
</font></p>
	 <?php
	 	 $chkc = $myDb->select("select count(g.accno) totalr,g.accname accname, g.voucherid,g.amountdr,g.amountcr,gh.accname grouphead,gp.accname parenthead
								from tbl_accchart p 
								inner join tbl_2ndjournal g 
								on p.id = g.accno
								inner join tbl_accchart gh
								on p.groupname = gh.id
								inner join tbl_accchart gp
								on p.parentid = gp.id 
								where g.accno='$accid'
								group by g.accname");
		$chkcf = $myDb->get_row($chkc,'MYSQL_ASSOC');					
		if( $chkcf['totalr']>0){						
	?>
	 <table class="acctble">
	 	<tr>
			<th>Ac/Head</th>
			<th>Voucherid</th>
			<th>Dr</th>
			<th>Cr</th>
			<th>Group</th>
			<th>Parent</th>
			<th>Action</th>
		</tr>
	 <?php
			$chkjq = $myDb->select("select g.accname accname, g.voucherid,g.amountdr,g.amountcr,gh.accname grouphead,gp.accname parenthead
									from tbl_accchart p 
									inner join tbl_2ndjournal g 
									on p.id = g.accno
									inner join tbl_accchart gh
									on p.groupname = gh.id
									inner join tbl_accchart gp
									on p.parentid = gp.id 
									where g.accno='$accid'");
			while($chkf = $myDb->get_row($chkjq,'MYSQL_ASSOC')){?>
			<tr>
				<td><?php echo $chkf['accname']; ?></td>
				<td><?php echo $chkf['voucherid']; ?></td>
				<td><?php echo $chkf['amountdr']; ?></td>
				<td><?php echo $chkf['amountcr']; ?></td>
				<td><?php echo $chkf['grouphead']; ?></td>
				<td><?php echo $chkf['parenthead']; ?></td>
				<td><a href="#" voucherid="<?php echo $chkf['voucherid']; ?>" name="accrcd<?php echo $chkf['voucherid']; ?>">DELETE</a></td>
			</tr>
				<script language="javascript">
				  $(document).ready(function(){
					 $('a[name="accrcd<?php echo $chkf['voucherid']; ?>"]').click(function(e){
					 	e.preventDefault();
						var accid='<?php echo $accid; ?>';
						var msg = "Ac/head deleted successfully";
						$.get("deleteJournalVoucher.php?voucherid=<?php echo $chkf['voucherid']; ?>",function(r){
							$('#container').load("deleteAccChartHead.php?accid="+accid+"&msg="+msg);
						});
					 });
				  });
				</script>

			<?php } ?>
		</table>
		</div>
	<?php }else{ 
		$chkroot = $myDb->select("select*from tbl_accchart where id='$accid' and id not in(select parentid from tbl_accchart)");
		$ckhrf = $myDb->get_row($chkroot,'MYSQL_ASSOC');
		if(!empty($ckhrf['id'])){
		    $chkaccname = $ckhrf["accname"];
			?>
				<script language="javascript">
				  $(document).ready(function(){
				    var searchid = "Ac/head deleted successfully";//'<?php echo $chkaccname; ?>';
					//$.get("acchead_pagination.php?page=1&searchid="+searchid,function(r){
					$.get("acchead_pagination.php?page=1&msg="+searchid,function(r){
						$('#container').html(r);
					});
				  	
				  });
				</script>			
			<?php
			   $myDb->update_sql("delete from tbl_accchart where id='$accid'");
		}
	
	 } ?>

		<?php
		
		
		
	 }
?>

<?php 
   }else{
     $msg="Sorry,you are not authorized to access this page";
	 header("Location:home.php?msg=$msg");
   }	 

}else{
  header("Location:index.php");
}
}