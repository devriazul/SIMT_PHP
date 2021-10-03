<?php
include_once 'config.php';
class User
{
   //Database connect 
   public function __construct()
   {
       $db = new DB_Class();
   }
   //Registration process 
   public function register_user($username,$userid, $password, $email)
   {
       $password = md5($password);
       $sql = mysql_query("SELECT userid from tbl_login WHERE userid = '$userid' or emailid = '$email'");
       $no_rows = mysql_num_rows($sql);
       if ($no_rows == 0)
       {
           $result = mysql_query("INSERT INTO users(username, password, name, email) values ('$username','$userid', '$password','$email')") or die(mysql_error());
           return $result;
       }else{
           return FALSE;
       }
    }
   // Login process
   public function check_login($emailusername, $password)
   {
      $password = md5($password);
      $result = mysql_query("SELECT userid from tbl_login WHERE emailid = '$emailusername' or username='$emailusername' and password = '$password'");
      $user_data = mysql_fetch_array($result);
      $no_rows = mysql_num_rows($result);
      if ($no_rows == 1)
      {
         $_SESSION['login'] = true;
         $_SESSION['uid'] = $user_data['userid'];
         return TRUE;
      }else{
         return FALSE;
      }
    }
    // Getting name
    public function get_fullname($uid)
    {
        $result = mysql_query("SELECT username FROM tbl_login WHERE userid = $uid");
        $user_data = mysql_fetch_array($result);
        echo $user_data['username'];
    }
    // Getting session 
    public function get_session()
    {
       return $_SESSION['login'];
    }
    // Logout 
    public function user_logout()
    {
       $_SESSION['login'] = FALSE;
       session_destroy();
    }

}
?>