<? session_start();
if(!$_SESSION[bpaddsesid]){
				include("adminlogin.php");
				}else{
				include("../config.php");
				
?>
 
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<title>###</title>
<link href="bpdc.css" rel="stylesheet" type="text/css">
<style type="text/css">
<!--
.style1 {color: #CC3300}
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
<table width="850"  border="0" cellspacing="0" cellpadding="00">
        <tr>
          <td colspan="2"><div align="center">
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
          <td colspan="2"><div align="center">
                </div></td>
        </tr>
        <tr>
          <td colspan="2"><div align="center"></div></td>
        </tr>
        <tr>	<form enctype="multipart/form-data" action="upload.php" method="POST">
          <td width="591"><div align="center"> 
              
      <strong>Enter Your File: </strong>: 
        <input name="uploaded" type="file" size="50" height="14" style="width:350px; border:1px solid #e1e1e1; " />
              	

          </div></td> 
          <td width="259"><input name="submit" type="submit" value="Upload" style="width:150px; border:1px solid #e1e1e1; " /></td> </form> 
        </tr> 
        <tr>
          <td colspan="2">&nbsp;</td>
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
<? } ?>