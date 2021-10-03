<?php session_start();

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

	color: #FFFFFF;

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

        <td width="9%" bgcolor="#FFFFFF"><img src="../images/specer.gif" width="225" height="1"></td>

        <td width="91%" bgcolor="#FFFFFF"><img src="../images/spacer.gif" width="1" height="1"></td>

      </tr>

      <tr valign="top">

        <td background="../images/bg.gif"><?php include("left.php"); ?></td>

        <td bgcolor="#FFFFFF"><div align="center">

          <table width="100%"  border="0" cellspacing="0" cellpadding="0">

            <tr>

              <td width="50%"><span class="style1"><font face="Verdana, Arial, Helvetica, sans-serif" size="2" color="#FF0000"><?php if (isset($_GET['msg'])){ echo $_GET['msg'] ;} ?></font></span></td>

              <td width="50%"><div align="right">

                  <input name="Button" type="button" onClick="MM_goToURL('parent','Javascript:history.back();');return document.MM_returnValue" value="BACK">

              </div></td>

            </tr>

          </table>

          <span class="style1"></span>

          </div>

          <hr size="1">

          <form name="form1" method="post" action="">

            <table width="781" border="0" align="center" cellpadding="0" cellspacing="2" class="Vlink">

              <tr bgcolor="#F8F8F8">

                <td height="23"><strong><font face="Verdana" size="2">View Menu </font></strong></td>

                </tr>

              <tr>

                <td><hr></td>

              </tr>

              <tr>

                <td><table width="100%"  border="1" cellpadding="1" cellspacing="0" bordercolor="#000000" class="Vlink">

                  <tr bgcolor="#0066CC">

                    <td width="7%" height="30"><div align="center" class="style2"><font face="Verdana" size="2">Sr.</font></div></td>

                    <td width="36%" height="30"><div align="left" class="style2"><font face="Verdana" size="2">Menu Name</font></div></td>

                    <td width="28%"><span class="style2"><font face="Verdana" size="2">Section</font></span></td>
                    <td width="14%" height="30"><div align="center" class="style2"><font face="Verdana" size="2">Status</font></div></td>

                    <td width="15%" height="30"><div align="center" class="style2"><font face="Verdana" size="2">Action</font></div></td>

                  </tr>

				  <!-- Start loop -->



				<?php

					

					$cat=mysql_query("select*from tbl_menucat ORDER BY id") or die(mysql_error());

					//$cat=mysql_query("select*from cat order by rating  desc ") or die(mysql_error());
					$i=0;

					$count=0;

					while($catfetch=mysql_fetch_array($cat)){ $i++ ;

					if(($count%2)==0){

					$bgcolor="#ffffff";

					

				?>

                  <tr bgcolor="<?php echo $bgcolor ;?>">

                    <td width="7%" height="24"><div align="center"><font face="Verdana" size="1"><?php  echo $i ?></font></div></td>

                    <td width="36%" height="24"><div align="left"><font face="Verdana" size="1"><?php echo $catfetch['name']; ?></font></div></td>

                    <td width="28%"><font face="Verdana" size="1"><?php echo $catfetch['section']; ?></font></td>
                    <td width="14%" height="24"><div align="center"><font face="Verdana" size="1"><?php echo $catfetch['status']; ?></font></div></td>

                    <td width="15%" height="24"><div align="center"><font face="Verdana" size="1"><a href="edit_cat.php?id=<?php echo $catfetch['id']; ?>">EDIT</a> - <a href="del_cat.php?id=<?php echo $catfetch['id']; ?>" onClick="return confirm('Are you sure you want to delete?')">DELETE</a></font></div></td>

                  </tr>

				<?php }else{

				$bgcolor="#F0F0FF";

				?>

                  <tr bgcolor="<?php echo $bgcolor ;?>">

                    <td width="7%" height="24"><div align="center"><font face="Verdana" size="1"><?php  echo $i ?></font></div></td>

                    <td width="36%" height="24"><div align="left"><font face="Verdana" size="1"><?php echo $catfetch['name']; ?></font></div></td>

                    <td width="28%"><font face="Verdana" size="1"><?php echo $catfetch['section']; ?></font></td>
                    <td width="14%" height="24"><div align="center"><font face="Verdana" size="1"><?php echo $catfetch['status']; ?></font></div></td>

                    <td width="15%" height="24"><div align="center"><font face="Verdana" size="1"><a href="edit_cat.php?id=<?php echo $catfetch['id']; ?>">EDIT</a> - <a href="del_cat.php?id=<?php echo $catfetch['id']; ?>" onClick="return confirm('Are you sure you want to delete?')">DELETE</a></font></div></td>

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

            </table>

          </form>

          <p><br>          

              <br>

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