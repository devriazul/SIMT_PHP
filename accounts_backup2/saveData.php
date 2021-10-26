<?php 
include_once("../config.php"); // the connection to the database

if($myDb->connect($host,$user,$pwd,$db,true))
{
if ($_POST['serialized']) {
	
	// create an array from the string $_POST['serialized'] 
	// with the group category_id:parent_id:orderby for each array member 
	// i strip the last pipe, so i will not have an array with a empty member at the end
	$categories = explode("|", substr($_POST['serialized'],0,-1));
	$error =  false;

 	// loop through each array member
	foreach ($categories as $category) {
		// split the group by the colon and put the three value is separated variable
 		@list($parentId, $categoryId, $order) = split(":", $category);
		//$parentId=$category['parent_id'];
		//$categoryId=$category['id'];
		//$order=$category['orderby'];
		// update the database
 		
 		if ( (int)$parentId == $parentId && (int)$order == $order && (int)$categoryId == $categoryId )
 			$result = mysql_query("UPDATE tbl_accchart SET parentid = ".$parentId.", orderby = ".$order." 
 						    WHERE id = ".$categoryId ) or die(mysql_error());
 		
 	}	

	echo "Tree updated.";

}
}
echo "<br />".$_POST['serialized'];
?>
