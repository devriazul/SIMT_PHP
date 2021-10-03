<?php 
require_once('../dbClass.php');
include("../config.php"); 

$cq=$myDb->select("Select * from tbl_company");
$cqf=$myDb->get_row($cq,'MYSQL_ASSOC');
?>


<span style="font-size:24px; font:Arial, Helvetica, sans-serif; font-weight:bold; "><?php echo $cqf['name']; ?></span>
</br><?php echo $cqf['address'].". Phone: ".$cqf['phone'];?>
</br><?php echo "E-mail: ".$cqf['email'];?>