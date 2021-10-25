<?php require_once('dbClass.php');
include("config.php");
if($myDb->connectDefaultServer())
{
/*$query="select*from tbl_login";
  $r=$myDb->select($query);

echo "<table width=\"55%\" border=\"1\" align=\"center\" cellpadding=\"2\" cellspacing=\"0\" bordercolor=\"#000000\">\n";
	 
	//"<TABLE CELLPADDING=\"3\" CELLSPACING=\"1\" BORDER=\"0\" WIDTH=\"100%\">\n";
	
	$i=0;
	while($row=mysql_fetch_assoc($r))
	{
	   if($i==0)
	   {
	      echo "<TR>\n";
		  foreach($row as $col=>$value)
		  {
		     echo "<TD bgcolor=\"#D9D5FF\" class=\"style2\">$col</TD>\n";
		  }
		     //echo "<TD bgcolor=\"#D9D5FF\" class=\"style2\">Action</TD>\n";
		  echo "</TR>\n";
		}  
		  $i++;
		  if(($i%2)==0)
		     $bg='#FFFFFF';
		  else
		     $bg='#F3F3F3';
			 
		  echo "<TR>\n";
		  foreach($row as $value)
		  {
		     echo "<TD class=\"style4\" BGCOLOR=\"$bg\">$value</TD>\n";
		  }
		     //echo "<TD class=\"style4\" BGCOLOR=\"$bg\">EDIT|DELETE</TD>\n";
		  echo "</TR>\n";    }

	  echo "</TABLE>\n";
*/
  $query="select*from tbl_login";
  $r=$myDb->select($query);
  $res=$myDb->dump_query($query);
  //$r=$myDb->select($query);
  //while($row=$myDb->get_row($r,'MYSQL_ASSOC')){
    //echo $row['userid'];
  //}*/	
}
?>  
