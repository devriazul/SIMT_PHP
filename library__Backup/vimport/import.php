<?php session_start();
if(!$_SESSION[bpaddsesid]){
				include("adminlogin.php");
				}else{
				include("../config.php");
				
?>				

				
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<title>####</title>
<link href="bpdc.css" rel="stylesheet" type="text/css">
<style type="text/css">
<!--
.style2 {
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size: 12px;
}
-->
</style>
</head>

<body>

<div align="center" > 
<? include("top.php")?>  <table width="100%"  border="0" cellspacing="0" cellpadding="0">
    <tr>
      <td width="24%" valign="top"><? include("left.php")?></td>
      <td width="2%">&nbsp;</td>
      <td width="74%" valign="top">
<table width="700"  border="0" cellspacing="0" cellpadding="00">
        <tr>
          <td><div align="center">
                <table width="100%" border="0" cellspacing="1" cellpadding="1">
                  <tr> 
                    <td bgcolor="#FFFFFF"><div align="center"><strong><font color="#006699" size="4">Add Your CSV file</font></strong></div></td>
                  </tr>
                  <tr> 
                    <td bgcolor="#FFFFFF"> <div align="center"><font color="#000000"><br>
                        </font></div></td>
                  </tr>
                </table>
              </div></td>
        </tr>
        <tr>
          <td><div align="center">
                </div></td>
        </tr>
        <tr>
          <td><div align="center">
		  <? 

if(isset($_POST['submit']))
   {
     mysql_query("truncate table exptab");
	 $filename="upload/";
	 $filename=$filename.$_POST['filename'];
     $handle = fopen("$filename", "r");   
     $row = 1;
     while ($data = fgetcsv ($handle,100000,",",",")) {
          $num = count ($row);
          $result=mysql_query("select max(id) from exptab");
          $row2=mysql_fetch_array($result);
          $dd=$row2 ["max(id)"];
          $maxid=$dd+ 1;
         // $import="INSERT into member(id,email,status) values('".$maxid."','".$data[0]."','NOT SEND')";
		  $import="INSERT INTO exptab(id,col1,col2,col3,col4,col5,col6,col7,col8,col9,col10,col11,col12,col13,col14,col15,col16,col17,col18,col19,col20,col21,col22)
		           VALUES('".$maxid."','".$data[0]."','".$data[1]."','".$data[2]."','".$data[3]."','".$data[4]."','".$data[5]."','".$data[6]."','".$data[7]."','".$data[8]."','".$data[9]."','".$data[10]."','".$data[11]."','".$data[12]."','".$data[13]."','".$data[14]."','".$data[15]."','".$data[16]."','".$data[17]."','".$data[18]."','".$data[19]."','".$data[20]."','".$data[21]."')";
          $sqldone = mysql_query($import);//or die("Could not insert because of:".mysql_error());

	      if(!$sqldone){
	      $up_mem=mysql_query("select id from exptab where col3='".$data[2]."'");
	      $up_fetch=mysql_fetch_array($up_mem);
	      mysql_query("UPDATE exptab set id='".$up_fetch['id']."',
	                               col3='".$data[2]."' where col3='".$data[2]."'");
	      mysql_error(); 
	      }
	      $row++;
}
    fclose ($handle);
    //print "Import done";
    //print "<a href='add_admin.php'>ADMIN || </a>";
?>	<form name="form1" method="post" action="tabexpun.php">
          <table width="99%" border="0" cellspacing="0" cellpadding="0" style="border:1px solid #CCCCCC;">
            <tr>
              <td width="44%"><span class="style2">Complite import process </span></td>
              <td width="56%">
                <label>
                  <input type="submit" name="Submit" value="Complite process">
                  </label>
              
              </td>
            </tr>
          </table></form>

<?php 
}else{
 	 print "<a href='home.php'>ADMIN || </a>";
     print "<form action='import.php' method='post' enctype='multipart/form-data'>";
     print "Type file name to import:";
?>
<?php 
     $TrackDir=opendir("upload/"); 
     print "<select name='filename'>";
     while ($file = readdir($TrackDir)) { 

         if ($file == "." || $file == "..") { } 
         else {
             unlink($file);  
             print "<option value='$file'>$file</option>";
     
 }
 }
 print "</select>";  
 print "<input type='submit' name='submit' value='Next' style='width:100px; border:1px solid #e1e1e1; '></form>";
 
}    //SELECT `col1` , `col11` , `col8` AS EndTime, `col6` AS StartTime, col8 - col6 AS duration FROM expun WHERE `col6` <>0


?>

		  </div></td>
        </tr>
        <tr>
          <td><div align="center">
              	 

          </div></td>
        </tr>
        <tr>
          <td>&nbsp;</td>
        </tr>
      </table></td>
    </tr>
  </table>
  <? include("bottom.php")?>
  <div align="left">  
    <div align="center">      </div>
  </div>
  <p align="left">&nbsp;    </p>
</div>
</body>
</html>
<?php
}
?>