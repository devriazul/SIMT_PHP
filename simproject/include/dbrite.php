<?php include_once 'config.php';

class Dbwrite
{
   public $last_error;
   public function __construct(){
     $db= new DB_Class();
   }
    private function tableExists($table)    
        {    
            $tableInDb = @mysql_query('SHOW TABLES FROM '.$db->DB_DATABASE.' LIKE "'.$table.'"');    
            if($tableInDb)    
            {    
                if(mysql_num_rows($tableInDb)==1)    
                {    
                    return true;    
                }    
                else    
                {    
                    return false;    
                }    
            }    
        }      
public function insert($table,$values)  // $values stores the values to be inserted into the database.
    {  
        if($this->tableExists($table))  
        {  
		  
		   $values=implode(',',$values);
           $insert_query=mysql_query("INSERT INTO $table VALUES('.$values.')") or die(mysql_error());
		   if($insert_query){
		     return true;
		   }else{
		     return false;
		   }	 	 
        }  
    }  
   	 
}   
?> 