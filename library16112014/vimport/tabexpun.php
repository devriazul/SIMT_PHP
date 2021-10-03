<?php ob_start();
session_start();
if(!$_SESSION[bpaddsesid]){
				include("adminlogin.php");
				}else{
				include("config.php");
				
?>		
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Untitled Document</title>
</head>

<body>
<?php 
$delp="DELETE FROM exptab WHERE col2 IN('BEG','UPD')";
mysql_query($delp);


$a='"';
$insp="INSERT INTO `expun` (
`col1` ,
`col2` ,
`col3` ,
`col4` ,
`col5` ,
`col6` ,
`col7` ,
`col8` ,
`col9` ,
`col10` ,
`col11` ,
`col12` ,
`col13` ,
`col14` ,
`col15` ,
`col16` ,
`col17` ,
`col18` ,
`col19` ,
`col20` ,
`col21` ,
`col22`
)
SELECT replace(col1,'$a','') as col1, `col2` , `col3` , `col4` , `col5` , `col6` , `col7` , `col8` , `col9` , `col10` , `col11` , `col12` , `col13` , `col14` , `col15` , `col16` , `col17` , `col18` , `col19` , `col20` , `col21` , `col22`
FROM exptab
WHERE  `col12` LIKE '%SS7%'
AND `col9` NOT LIKE '%SS7%'
";
mysql_query($insp);



header("Location:home.php?msg=Data import process complite"); 
?>
</body>
</html>
<?php
}
?>