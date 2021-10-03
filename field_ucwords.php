<?php 
$para=mysql_real_escape_string($_GET['para']);
echo ucwords($para);