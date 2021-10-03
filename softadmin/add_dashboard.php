<?php session_start();
require_once('dbClass.php');

if(!$_SESSION['emagasesid']){
   include("logout.php");
}else{
   include("config.php");
?>  
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title> !@#$%^&*!@#$%^&*!@#$%^&*!@#$%^&*!@#$%^&*!@#$%^&*!@#$%^&*!@#$%^&*!@#$%^&* </title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link href="links.css" rel="stylesheet" type="text/css">



<style type="text/css">
<!--
body {
	background-color: #CCCCCC;
	margin-left: 5px;
	margin-top: 5px;
	margin-right: 5px;
	margin-bottom: 5px;
}
.style1 {font-weight: bold}
.style2 {
	color:#000000;

	font-weight: bold;
}
-->
</style>
<script language="JavaScript" type="text/JavaScript">
<!--
function MM_goToURL() { //v3.0
  var i, args=MM_goToURL.arguments; document.MM_returnValue = false;
  for (i=0; i<(args.length-1); i+=2) eval(args[i]+".location='"+args[i+1]+"'");
}
//-->
</script>
</head>

<body>
<table width="100%"  border="0" cellpadding="0" cellspacing="0" >
  <tr bgcolor="#FFFFFF">
    <td><?php include("top.php"); ?></td>

  </tr>
  <tr>
    <td><table width="100%"  border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td  bgcolor="#FFFFFF"><img src="../images/specer.gif" width="225" height="1"></td>
        <td  bgcolor="#FFFFFF"><img src="../images/spacer.gif" width="1" height="1"></td>
      </tr>
      <tr valign="top">
        <td background="../images/bg.gif"><?php include("left.php"); ?></td>
        <td width="100%" bgcolor="#FFFFFF"><div align="center">
          <table width="100%"  border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td width="50%" ><div align="left"></div></td>
              <td width="50%" ><div align="right">
                  <input name="Button" type="button" onClick="MM_goToURL('parent','Javascript:history.back();');return document.MM_returnValue" value="BACK">
              </div></td>
            </tr>
          </table>
          <span class="style1"></span>
          </div>
          <hr size="1">
          <form name="MyForm" autocomplete="off" action="ins_system_level.php" method="post" enctype="multipart/form-data" >
          <div align="center"><br />
          <table width="70%" border="0" align="center" cellpadding="0" cellspacing="3" id="stdtbl">

            <tr>
              <td height="39" colspan="3" bgcolor="#F8F8F8" class="style2"><strong><font face="Verdana" size="2">Add Dashboard </font></strong></td>
              </tr>
            <tr>
              <td width="29%" height="20" class="style2"><div align="left"><strong>Access Type</strong></div></td>
              <td width="3%"><div align="center"><span class="style2"><strong>:</strong></span></div></td>
              <td width="68%" height="20"><label>
                <input name="accname" type="text" id="accname" onkeypress="return handleEnter(this, event)" />
              </label></td>
            </tr>
            <tr>
              <td height="20" class="style2"><div align="left"><strong>Description</strong></div></td>
              <td><div align="center"><span class="style2"><strong>:</strong></span></div></td>
              <td height="20"><textarea name="description" cols="60" id="description" style="font-family: Verdana; font-size: 8pt; border: 1px solid #3399FF" onkeypress="return handleEnter(this, event)"></textarea></td>
            </tr>
            <tr>
              <td class="style12"><strong>Image</strong></td>
              <td align="center" class="style12"><strong>:</strong></td>
              <td><input name="img" type="file" class="style4" id="img" onkeypress="return handleEnter(this, event)"/></td>
            </tr>
            <tr>
              <td><span class="style12"><strong>Order</strong></span></td>
              <td align="center"><span class="style12"><strong>:</strong></span></td>
              <td>
			  <select name="orderid" id="orderid">
			    <option value=""></option>
				<option value="1">1</option>
				<option value="2">2</option>
				<option value="3">3</option>
				<option value="4">4</option>
				<option value="5">5</option>
				<option value="6">6</option>
				<option value="7">7</option>
				<option value="8">8</option>
				<option value="9">9</option>
				<option value="10">10</option>
				<option value="11">11</option>
				<option value="12">12</option>
				<option value="13">13</option>
				<option value="14">14</option>
				<option value="15">15</option>
				<option value="16">16</option>
				<option value="17">17</option>
				<option value="18">18</option>
				<option value="19">19</option>
				<option value="20">20</option>
			  </select></td>
            </tr>
            <tr>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
              <td><input type="submit" value="Submit" name="B1" style="color: #999999; font-size: 8pt; font-family: Verdana; border: 1px solid #C0C0C0; background-color: #D9F0FB"> <input type="reset" name="Submit2" value="Reset" style="color: #999999; font-size: 8pt; font-family: Verdana; border: 1px solid #C0C0C0; background-color: #D9F0FB"/></td>
            </tr>
          </table>          
          <p>&nbsp;</p>
          </div>

            </form>
          <table width="98%" border="0" align="center" cellpadding="0" cellspacing="2" class="Vlink">
            <tr bgcolor="#F8F8F8">
              <td height="23"><strong><font face="Verdana" size="2">View Dashboard </font></strong></td>
            </tr>
            <tr>
              <td><hr></td>
            </tr>
            <tr>
              <td><table width="100%"  border="1" cellpadding="2" cellspacing="0" bordercolor="#000000" class="Vlink">
                  <tr bgcolor="#0066CC">
                    <td width="5%" height="30"><div align="center" style="color:#FFFFFF; font-weight:bold; " ><font size="2" face="Verdana">ID</font></div></td>
                    <td width="29%" height="30"><div align="left" style="color:#FFFFFF; font-weight:bold; " ><font face="Verdana" size="2">Access Name</font></div></td>
                    <td width="31%"><span style="color:#FFFFFF; font-weight:bold; " ><font face="Verdana" size="2">Description</font></span></td>
                    <td width="9%"><div align="center" style="color:#FFFFFF; font-weight:bold; "><span ><font face="Verdana" size="2">Image</font></span></div></td>
                    <td width="15%" height="30"><div align="center" style="color:#FFFFFF; font-weight:bold; " ><font face="Verdana" size="2">Order ID </font></div></td>
                    <td width="11%" height="30"><div align="center" style="color:#FFFFFF; font-weight:bold; " ><font face="Verdana" size="2">Action</font></div></td>
                  </tr>
                  <!-- Start loop -->
                  <?php

					

					$cat=mysql_query("select * from tbl_access order by id desc") or die(mysql_error());

					//$cat=mysql_query("select*from cat order by rating  desc ") or die(mysql_error());
					$i=0;

					$count=0;

					while($catfetch=mysql_fetch_array($cat)){ $i++ ;

					if(($count%2)==0){

					$bgcolor="#ffffff";

					

				?>
                  <tr bgcolor="<?php echo $bgcolor ;?>">
                    <td width="5%" height="24"><div align="center"><font face="Verdana" size="1">
                        <?php  echo $catfetch['id']; ?>
                    </font></div></td>
                    <td width="29%" height="24"><div align="left"><font face="Verdana" size="1"><?php echo $catfetch['accname']; ?></font></div></td>
                    <td width="31%"><font face="Verdana" size="1"><?php echo $catfetch['description']; ?></font></td>
                    <td width="9%"><div align="center"><img src="dashboardimg/<?php echo $catfetch['img']; ?>" width="50" height="50"></img></div></td>
                    <td width="15%" height="24"><div align="center"><font face="Verdana" size="1"><?php echo $catfetch['orderid']; ?></font></div></td>
                    <td width="11%" height="24"><div align="center"><font face="Verdana" size="1"><a href="edit_dashboard.php?id=<?php echo $catfetch['id']; ?>">EDIT</a> - <a href="del_access_level.php?id=<?php echo $catfetch['id']; ?>" onClick="return confirm('Are you sure you want to delete?')">DELETE</a></font></div></td>
                  </tr>
                  <?php }else{

				$bgcolor="#F0F0FF";

				?>
                  <tr bgcolor="<?php echo $bgcolor ;?>">
                    <td width="5%" height="24"><div align="center"><font face="Verdana" size="1">
                        <?php  echo $i ?>
                    </font></div></td>
                    <td width="29%" height="24"><div align="left"><font face="Verdana" size="1"><?php echo $catfetch['accname']; ?></font></div></td>
                    <td width="31%"><font face="Verdana" size="1"><?php echo $catfetch['description']; ?></font></td>
                    <td width="9%"><div align="center"><img src="dashboardimg/<?php echo $catfetch['img']; ?>" width="50" height="50"></img></div></td>
                    <td width="15%" height="24"><div align="center"><font face="Verdana" size="1"><?php echo $catfetch['orderid']; ?></font></div></td>
                    <td width="11%" height="24"><div align="center"><font face="Verdana" size="1"><a href="edit_dashboard.php?id=<?php echo $catfetch['id']; ?>">EDIT</a> - <a href="del_access_level.php?id=<?php echo $catfetch['id']; ?>" onClick="return confirm('Are you sure you want to delete?')">DELETE</a></font></div></td>
                  </tr>
                  <?php 

					}

					$count++;

					}

				?>
                  <!-- End loop -->
              </table></td>
            </tr>
            <tr>
              <td><hr></td>
            </tr>
            <tr>
              <td>&nbsp;</td>
            </tr>
          </table>          <p>              <br>
          </p></td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td bgcolor="#0099CC"><img src="../images/spacer.gif" width="1" height="5"></td>
  </tr>
  <tr>
    <td bgcolor="#FFFFFF">&nbsp;</td>
  </tr>
</table>
</body>
</html>
<?php } ?>