<?php
class mysql {
    public $dbname, $dbuser, $dbpass, $dbhost, $dbcon;
    public $auto_slashes;
    public $sql_error;
    public $row_count;
    public function __construct($dbn, $dbh, $dbu, $dbp) {
        $this->dbhost=$dbh;
        $this->dbname=$dbn;
        $this->dbpass=$dbp;
        $this->dbuser=$dbu;
        $this->auto_slashes = true;
        $this->doconnect();
          }
        public function doconnect()
        {
        $this->dbcon=mysql_connect($this->dbhost,$this->dbuser, $this->dbpass);
        mysql_select_db($this->dbname);
        }
    public  function runquery($sql)
        {
         $result=mysql_query($sql);   
         return $result;


        }
        
    public function select($sql) {
      
      // Performs an SQL query and returns the result pointer or false
      // if there is an error.
 
      $this->last_query = $sql;
      
      $r = mysql_query($sql);
      if (!$r) {
         $this->sql_error = mysql_error();
         return false;
      }
      $this->row_count = mysql_num_rows($r);
      return $r;
   }
   
   function get_row($result, $type='MYSQL_BOTH') {
 
      
      
      if (!$result) {
         $this->last_error = "Invalid resource identifier passed to get_row() function.";
         return false;  
      }
      
      if ($type == 'MYSQL_ASSOC') $row = mysql_fetch_array($result, MYSQL_ASSOC);
      if ($type == 'MYSQL_NUM') $row = mysql_fetch_array($result, MYSQL_NUM);
      if ($type == 'MYSQL_BOTH') $row = mysql_fetch_array($result, MYSQL_BOTH); 
      
      if (!$row) return false;
      if ($this->auto_slashes) {
         // strip all slashes out of row...
         foreach ($row as $key => $value) {
            $row[$key] = stripslashes($value);
         }
      }
      return $row;
   }
   function insert_sql($sql) {
       
      // Inserts data in the database via SQL query.
      // Returns the id of the insert or true if there is not auto_increment
      // column in the table.  Returns false if there is an error.      
 
      $this->last_query = $sql;
      
      $r = mysql_query($sql);
      if (!$r) {
         $this->last_error = mysql_error();
         return false;
      }
      
      $id = mysql_insert_id();
      if ($id == 0) return true;
      else return $id; 
   }
}
?>
