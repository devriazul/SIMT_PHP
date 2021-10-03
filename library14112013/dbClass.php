<?php 
class DbClass
{ 
   public $last_error; //Holds the last_error,usually mysql_error()
   public $last_query; //Holds the last query executed
   public $row_count;  //Holds the last number of rows from a select
   public $host; //mysql host connect to
   public $user; //mysql user name
   public $pw;   //mysql password
   public $db;   //mysql database name
   public $db_link; //curren or last database link identifier
   public $auto_slashes; //the class will add
   

   public function __construct()
   {
      $this->host='localhost';
	  $this->user='root';
	  $this->pw='dtbd13adm1n';
	  $this->db='simtdb';
	  $this->auto_slashes= true;
	  
	  /*$this->host='localhost';
	  $this->user='root';
	  $this->pw='';
	  $this->db='simtedu';
	  $this->auto_slashes= true;*/
   }
   
   public function connect($host='',$user='',$pw='',$db='',$persistant=true)
   {
     if(!empty($host))
	   $this->host=$host;
	   
	 if(!empty($user))
	   $this->user=$user;
	   
	 if(!empty($pw))
	   $this->pw=$pw;
	   
	   
	if($persistant)
	  $this->db_link=mysql_pconnect($this->host,$this->user,$this->pw);
	else
	  $this->db_link=mysql_connect($this->host,$this->user,$this->pw);
	 
	  
    if(!($this->db_link)){
	  $this->last_error=mysql_error();
	  return false;
    }
    if(!$this->select_db($db))
	  return false;
	
	 return $this->db_link;
  }
  
  public function select_db($db='')
  {
    if(!empty($db))
	  $this->db=$db;
	  
	if(!mysql_select_db($this->db))
	{
	  $this->last_error=mysql_error();
	  return false;
    }
	return true;
  }
  
  public function select($sql)
  {
    $this->last_query=$sql;
	$r=mysql_query($sql);
	if(!$r){
	  $this->last_error=mysql_error();
	  return false;
	}else{
	  $this->row_count=mysql_num_rows($r);
	  return $r;
	}  
   }
   
   public function select_one($sql)
   {
     $this->last_query=$sql;
	 $r=mysql_query($sql);
	 
	 if(!$r)
	 {
	   $this->last_error=mysql_error();
	   return false;
	 }
	 
	 if(mysql_num_rows($r)>1)
	 {
	   $this->last_error='Your query return more than one rows';
	   return false;
	 }
	 
	 if(mysql_num_rows($r)<1)
	 {
	   $this->last_error='Your query return empty set of rows';
	   return false;
	 }
	 $ret=mysql_result($r,0);
	 mysql_free_result($r);      
	 
	 if($this->auto_slashes)
	    return stripslashes($ret);
	 else
	    return $ret;
		
   }
   
   public function get_row($result,$type='MYSQL_BOTH')
   {
     if(!$result)
	 {
	   $this->last_error='Invalid resource indentifier passed to get_row() function';
	   return false;
	   
	 }
	 
	 if($type=='MYSQL_ASSOC')
	    $row=mysql_fetch_array($result,MYSQL_ASSOC);
		
	 if($type=='MYSQL_NUM')
	    $row=mysql_fetch_array($result,MYSQL_NUM);
		
	 if($type=='MYSQL_BOTH')
	    $row=mysql_fetch_array($result,'MYSQL_BOTH');
		
     if(!$row)
	    return false;
		
     if($this->auto_slashes){
	    foreach($row as $key=>$values){
		  $row[$key]=stripslashes($values);
		}
	 }
	 return $row;
  }	
  
  public function dump_query($sql,$filename,$delname,$dupd='',$ddlt='')
  {
    $r=$this->select($sql);
	if(!$r)
	  return false;
    echo "<table width=\"97%\" style=\"border:1px solid #000000;padding:4px;\" align=\"center\" cellpadding=\"1\" cellspacing=\"0\">\n";
	$i=0;
	while($row=mysql_fetch_assoc($r))
	{
	   if($i==0)
	   {
	      echo "<TR>\n";
		  foreach($row as $col=>$value)
		  {
		     echo "<TD bgcolor=\"#0C6ED1\" style=\"border:1px solid #000000;color:#FFFFFF;padding:4px;\" class=\"style2\" height=\"30\">$col</TD>\n";
		  }
		  if(($dupd=="y")||($ddlt=="y")){
		      echo "<TD bgcolor=\"#0C6ED1\" colspan=\"2\" style=\"border:1px solid #000000;color:#FFFFFF;padding:4px;\"  class=\"style2\" align=\"center\">Operation</TD>\n";
		  }
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
		     echo "<TD class=\"style4\" style=\"border:1px solid #000000;padding:4px;\" BGCOLOR=\"$bg\" >$value</TD>\n";
		  }
		 if(($dupd=="y")){ 
         echo "<TD class=\"style4\" BGCOLOR=\"$bg\" style=\"border:1px solid #000000;padding:4px;\"> 	  
<a href=\"$filename?id=$row[id]\">EDIT</a></TD>\n";
         }
		 if(($ddlt=="y")){ 
		   if(isset($row['id'])){
              echo "<TD class=\"style4\" BGCOLOR=\"$bg\" style=\"border:1px solid #000000\"> 	  
                   <a href=\"$delname?id=$row[id]\" onClick=\"return confirm('Are you sure want to delete the record!')\">DELETE</a></TD>\n";
		   }		   
         }
		 
		  echo "</TR>\n";
	   }
	  echo "</TABLE>\n";
   }
	
public function dump_bookquery($sql,$filename,$delname,$dupd='',$ddlt='')
  {
    $r=$this->select($sql);
	if(!$r)
	  return false;
    echo "<table width=\"97%\" style=\"border:1px solid #000000;padding:4px;\" align=\"center\" cellpadding=\"1\" cellspacing=\"0\">\n";
	$i=0;
	while($row=mysql_fetch_assoc($r))
	{
	   if($i==0)
	   {
	      echo "<TR>\n";
		  foreach($row as $col=>$value)
		  {
		     echo "<TD bgcolor=\"#0C6ED1\" style=\"border:1px solid #000000;color:#FFFFFF;padding:4px;\" class=\"style2\" height=\"30\">$col</TD>\n";
		  }
		  if(($dupd=="y")||($ddlt=="y")){
		      echo "<TD bgcolor=\"#0C6ED1\" colspan=\"3\" style=\"border:1px solid #000000;color:#FFFFFF;padding:4px;\"  class=\"style2\" align=\"center\">Operation</TD>\n";
		  }
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
		     echo "<TD class=\"style4\" style=\"border:1px solid #000000;padding:4px;\" BGCOLOR=\"$bg\" >$value</TD>\n";
		  }
		 if(($dupd=="y")){ 
         echo "<TD class=\"style4\" BGCOLOR=\"$bg\" style=\"border:1px solid #000000;padding:4px;\"> 	  
<a href=\"#dialog\" id=\"$row[id]\" name=\"modal\">EDIT</a></TD>\n";
         }
		 if(($ddlt=="y")){ 
		   if(isset($row['id'])){
              echo "<TD class=\"style4\" BGCOLOR=\"$bg\" style=\"border:1px solid #000000\"> 	  
                   <a href=\"$delname?id=$row[id]\" onClick=\"return confirm('Are you sure want to delete the record!')\">DELETE</a></TD>\n";
		   }		   
         }
	   }
	  echo "</TABLE>\n";
   }
	
	
	
public function dump_searchbookquery($sql,$filename,$delname,$dupd='',$ddlt='')
  {
    $r=$this->select($sql);
	if(!$r)
	  return false;
    echo "<table width=\"100%\" style=\"border:1px solid #000000;padding:4px;\" align=\"center\" cellpadding=\"1\" cellspacing=\"0\">\n";
	$i=0;
	while($row=mysql_fetch_assoc($r))
	{
	   if($i==0)
	   {
	      echo "<TR>\n";
		  foreach($row as $col=>$value)
		  {
		     echo "<TD bgcolor=\"#0C6ED1\" style=\"border:1px solid #000000;color:#FFFFFF;padding:4px;\" class=\"style2\" height=\"30\">$col</TD>\n";
		  }
		  if(($dupd=="y")||($ddlt=="y")){
		      echo "<TD bgcolor=\"#0C6ED1\" colspan=\"3\" style=\"border:1px solid #000000;color:#FFFFFF;padding:4px;\"  class=\"style2\" align=\"center\">Operation</TD>\n";
		  }else{
			echo "<TD bgcolor=\"#0C6ED1\" colspan=\"3\" style=\"border:1px solid #000000;color:#FFFFFF;padding:4px;\"  class=\"style2\" align=\"center\">Operation</TD>\n";		
		  }	  
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
		     echo "<TD class=\"style4\" style=\"border:1px solid #000000;padding:4px;\" BGCOLOR=\"$bg\" >$value</TD>\n";
		  }
		 if(($dupd=="y")){ 
         echo "<TD class=\"style4\" BGCOLOR=\"$bg\" style=\"border:1px solid #000000;padding:4px;\"> 	  
<a href=\"#dialog\" id=\"$row[id]\" name=\"modal\">EDIT</a></TD>\n";
         }
		 if(($ddlt=="y")){ 
		   if(isset($row['id'])){
              echo "<TD class=\"style4\" BGCOLOR=\"$bg\" style=\"border:1px solid #000000\"> 	  
                   <a href=\"$delname?id=$row[id]\" onClick=\"return confirm('Are you sure want to delete the record!')\">DELETE</a></TD>\n";
		   }		   
         }
              echo "<TD class=\"style4\" BGCOLOR=\"$bg\" style=\"border:1px solid #000000\"> 	  
                   <a href=\"#\" name=\"isbook\" alt=\"$row[deptid]\"  id=\"$row[id]\">ISSUE</a></TD>\n";
			  echo "<TD class=\"style4\" BGCOLOR=\"$bg\" style=\"border:1px solid #000000\"> 	  
                   <a href=\"#\" name=\"isreturn\" alt=\"$row[deptid]\"  id=\"$row[id]\">RETURN</a></TD>\n";	   
		  echo "</TR>\n";
	  
		echo "<tr>"; 
		   
	       echo "<td colspan='8'><div id=issue$row[id] style=\"display:none\"></div></td>";
	  
	   echo "</tr>";
	   echo "<tr>"; 
		   
		   echo "<td colspan='8'><div id=return$row[id] style=\"display:none\"></div></td>";
	  
	   echo "</tr>";

 
	  
	   }
	  echo "</TABLE>\n";
   }	
	
	
	public function dump_queryAH($sql,$filename,$filelink='')
  	{
    	$r=$this->select($sql);
		if(!$r)
	  	return false;
    	echo "<table width=\"97%\" style=\"border:1px solid #000000;padding:4px;\" align=\"center\" cellpadding=\"1\" cellspacing=\"0\">\n";
		$i=0;
		while($row=mysql_fetch_assoc($r))
		{
	   		if($i==0)
	   		{
	      		echo "<TR>\n";
		  		foreach($row as $col=>$value)
		  		{
		     		echo "<TD bgcolor=\"#0C6ED1\" style=\"border:1px solid #000000;color:#FFFFFF;padding:4px;\" class=\"style2\" height=\"30\">$col</TD>\n";
		  		}
		  		if($filelink=="y")
				{
		    		echo "<TD bgcolor=\"#0C6ED1\" colspan=\"2\" style=\"border:1px solid #000000;color:#FFFFFF;padding:4px;\"  class=\"style2\" align=\"center\">Operation</TD>\n";
		  		}
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
		     	echo "<TD class=\"style4\" style=\"border:1px solid #000000;padding:4px;\" BGCOLOR=\"$bg\" >$value</TD>\n";
		  	}
		 	if(($filelink=="y"))
			{ 
         		echo "<TD class=\"style4\" BGCOLOR=\"$bg\" style=\"border:1px solid #000000;padding:4px;\"> 	  
					<a href=\"$filename?id=$row[id]\">Select Student</a></TD>\n";
         	}
		 	
		 
		  	echo "</TR>\n";
	   	}
	  	echo "</TABLE>\n";
   }

	public function dump_querySHD($sql,$filename,$filelink='')
  	{
    	$r=$this->select($sql);
		if(!$r)
	  	return false;
    	echo "<table width=\"97%\" style=\"border:1px solid #000000;padding:4px;\" align=\"center\" cellpadding=\"1\" cellspacing=\"0\">\n";
		$i=0;
		while($row=mysql_fetch_assoc($r))
		{
	   		if($i==0)
	   		{
	      		echo "<TR>\n";
		  		foreach($row as $col=>$value)
		  		{
		     		echo "<TD bgcolor=\"#0C6ED1\" style=\"border:1px solid #000000;color:#FFFFFF;padding:4px;\" class=\"style2\" height=\"30\">$col</TD>\n";
		  		}
		  		if($filelink=="y")
				{
		    		echo "<TD bgcolor=\"#0C6ED1\" colspan=\"2\" style=\"border:1px solid #000000;color:#FFFFFF;padding:4px;\"  class=\"style2\" align=\"center\">Operation</TD>\n";
		  		}
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
		     	echo "<TD class=\"style4\" style=\"border:1px solid #000000;padding:4px;\" BGCOLOR=\"$bg\" >$value</TD>\n";
		  	}
		 	if(($filelink=="y"))
			{ 
         		echo "<TD class=\"style4\" BGCOLOR=\"$bg\" style=\"border:1px solid #000000;padding:4px;\"> 	  
					<a href=\"$filename?id=$row[id]\">DEALLOCATE</a></TD>\n";
         	}
		 	
		 
		  	echo "</TR>\n";
	   	}
	  	echo "</TABLE>\n";
   }
	

	public function dump_queryHSA($sql,$filename,$filelink='')
  	{
    	$r=$this->select($sql);
		if(!$r)
	  	return false;
    	echo "<table width=\"97%\" style=\"border:1px solid #000000;padding:4px;\" align=\"center\" cellpadding=\"1\" cellspacing=\"0\">\n";
		$i=0;
		while($row=mysql_fetch_assoc($r))
		{
	   		if($i==0)
	   		{
	      		echo "<TR>\n";
		  		foreach($row as $col=>$value)
		  		{
		     		echo "<TD bgcolor=\"#0C6ED1\" style=\"border:1px solid #000000;color:#FFFFFF;padding:4px;\" class=\"style2\" height=\"30\">$col</TD>\n";
		  		}
		  		if($filelink=="y")
				{
		    		echo "<TD bgcolor=\"#0C6ED1\" colspan=\"2\" style=\"border:1px solid #000000;color:#FFFFFF;padding:4px;\"  class=\"style2\" align=\"center\">Operation</TD>\n";
		  		}
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
		     	echo "<TD class=\"style4\" style=\"border:1px solid #000000;padding:4px;\" BGCOLOR=\"$bg\" >$value</TD>\n";
		  	}
		 	if(($filelink=="y"))
			{ 
         		echo "<TD class=\"style4\" BGCOLOR=\"$bg\" style=\"border:1px solid #000000;padding:4px;\"> 	  
					<a href=\"$filename?id=$row[id]\">ALLOCATE</a></TD>\n";
         	}
		 	
		 
		  	echo "</TR>\n";
	   	}
	  	echo "</TABLE>\n";
   }

  public function insert_sql($sql)
  {
     $this->last_query=$sql;
	 $r=mysql_query($sql);
	 if(!$r)
	 {
	    $this->last_error=mysql_error();
		return false;
	 }
	 $id=mysql_insert_id();
	 if($id==0)
	   return true;
	 else
	   return $id;  
  }
 public function update_sql($sql)
  {
     $this->last_query=$sql;
	 $r=mysql_query($sql);
	 if(!$r)
	 {
	    $this->last_error=mysql_error();
		return false;
	 }
	 $rows=mysql_affected_rows();
	 if($rows==0)
	   return true;
	 else
	   return $rows;  
  }	 
  
}


/*$user='root';
$pwd='';
$db='simtedu';
$host='localhost';

require_once('dbClass.php');

$myDb=new DbClass;
if($myDb->connect($host,$user,$pwd,$db,true))
{
  $query="update user set userid='moin' where id='1'";
  $res=myDb->update_sql($query);
  $myDb->dump_query("select*from user");
} */ 
?>  	