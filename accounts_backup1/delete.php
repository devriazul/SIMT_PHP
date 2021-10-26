<?php include_once("config.php"); // the connection to the database 
if($myDb->connect($host,$user,$pwd,$db,true))
{ 
if(!isset($_GET['submitted'])) { ?>
	<div style="overflow:hidden; margin:1em;">
		<h2>Are you sure that you want to delete "<?php if(isset($_GET['category_name'])) {echo $_GET['category_name'];} ?>" from your account chart?</h2>
		<a href="delete.php?id=<?php if(isset($_GET['category_id'])) {echo $_GET['category_id'];} ?>&category_name=<?php if(isset($_GET['category_name'])) {echo $_GET['category_name'];} ?>&submitted=true" class="nyroModal">[ <?php echo "YES"; ?> ]</a>
		<a href="#" onclick="$.nyroModalRemove();">[ <?php echo "NO"; ?> ]</a>
	</div>
<?php } else { 
	// recursive delete function
	function cascadeDelete($category_id) 
	{
		$chkph=mysql_query("SELECT * FROM  `tbl_accchart` WHERE parentid='$category_id' OR id in(select accno from tbl_seconderyjournal) ") or die(mysql_error()) ;
		
		$carph=mysql_fetch_array($chkph);
//		echo $category_id;
		$nrow=mysql_num_rows($chkph);
		if($nrow==0)
		{
			mysql_query("UPDATE tbl_accchart set storedstatus='D' WHERE id = '$category_id'") or die(mysql_error());
		}
		else
		{?>
			<div style="overflow:hidden; margin:1em;">
			<h1>Can't Delete "<?php  if(isset($_GET['category_name'])) {echo $_GET['category_name'];}?>" .Either is it a Parent Head OR this account has transaction</h1>
			<a href="#" onclick="$.nyroModalRemove();">Close</a>
			</div>
		<?php exit; }
		$relatedCategory =  mysql_query("SELECT id FROM tbl_accchart WHERE parentid = '$category_id'") or die(mysql_error());
		while ($row = mysql_fetch_assoc($relatedCategory)) 
		{
			$this_id =  $row["id"];
			cascadeDelete($this_id);
			$relatedCategory->MoveNext();
		}
	}
	cascadeDelete($_GET['id']);
	?>
	<div style="overflow:hidden; margin:1em;">
		<h1>Account Deleted! </h1>
		<a href="#" onclick="$.nyroModalRemove();">Close</a>
	</div>
<?php 
}
} ?>