<?php session_start();
require_once('dbClass.php');
include("config.php"); 
if($myDb->connect($host,$user,$pwd,$db,true))
{ 
  if($_SESSION['userid']){
     $id=mysql_real_escape_string($_GET['id']);
	 $edq="SELECT*FROM tbl_accdtl WHERE id='$id'";
	 $rq=$myDb->select($edq);
	 $rf=$myDb->get_row($rq,'MYSQL_ASSOC');
	 
	 $chka="SELECT*FROM  tbl_accdtl WHERE flname='macclevel.php' AND userid='$_SESSION[userid]'";
     $caq=$myDb->select($chka);
     $car=$myDb->get_row($caq,'MYSQL_ASSOC');
     if(($car['ins']=="y")||($_SESSION['userid']=="administrator")){

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title><?php include("title.php");?></title>
<style type="text/css">
<!--
@import url("main.css");
.style12 {font-size: 10px}
.style15 {
	font-size: 12px;
	font-family: Verdana, Arial, Helvetica, sans-serif;
}
.style16 {font-size: 12px}

-->
</style>
<script type="text/javascript" src="jquery.js"></script>
<script type='text/javascript' src='jquery.autocomplete.js'></script>
<link rel="stylesheet" type="text/css" href="jquery.autocomplete.css" />

<script type="text/javascript">
$().ready(function() {
	$("#searchid").autocomplete("search_accdtl.php", {
		width: 260,
		matchContains: true,
		//mustMatch: true,
		//minChars: 0,
		//multiple: true,
		//highlight: false,
		//multipleSeparator: ",",
		selectFirst: false
	});
});
</script>
<script language type="text/javascript"> 
function handleEnter (field, event) {
		var keyCode = event.keyCode ? event.keyCode : event.which ? event.which : event.charCode;
		if (keyCode == 13) {
			var i;
			for (i = 0; i < field.form.elements.length; i++)
				if (field == field.form.elements[i])
					break;
			i = (i + 1) % field.form.elements.length;
			field.form.elements[i].focus();
			return false;
		} 
		else
		return true;
	}      
 
 
 
</script>
<script type="text/javascript" language="javascript"> 
window.onload=function() {
document.forms[0][0].focus();
}
</script>

</head>

<body>
<table width="1047" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td width="1047" height="152" valign="top" background="images/1.jpg"><span class="style17"><?php include("topdefault.php");?>    </span></span></td>
  </tr>
  <tr>
    <td><table width="100%" border="0" cellspacing="0" cellpadding="0" id="tblleft">
      <tr>
        <td height="28" colspan="2" bgcolor="#0C6ED1"><div align="center" class="style1"><?php include("company.php"); ?></div></td>
        </tr>
      <tr>
        <td background="images/leftbg.jpg"><img src="images/leftbg.jpg" width="252" height="3" /></td>
        <td><img src="images/spaer.gif" width="1" height="1" /></td>
      </tr>
      <tr>
        <td width="21%" valign="top" background="images/leftbg.jpg"><?php include("left.php"); ?>
                   <br />
          
          <p>&nbsp;</p>
          <p>&nbsp;</p></td>
        <td width="79%" valign="top">
<p align="center" ><font face="Arial, Helvetica, sans-serif" size="2"><?php if(isset($_GET['msg'])){ echo $_GET['msg']; }?></font></p>
<div id="top-search-div"> 
           <div id="content">
		   <label>Edit Authentication</label>
		   <div class="input">
		   <form method="post" autocomplete="off" action="macclevel_search.php">
		     <label>Search Form</label>
			 <label><input type="text" id="searchid" name="searchid" placeholder="Search by file name" /></label>
			 <label><input type="submit" name="subs" id="submit-btn" value="Search" /></label>
			 <label><a href="add_macclevel.html"><input type="button" name="addbtn" id="submit-btn" value="Add New" /></a></label>
		   </form>
		   </div>
		</div>
		</div>		<form id="form1" name="form1" method="post" action="edmacclevel.php?id=<?php echo $id; ?>">
          <div align="center"><br />
          <table width="80%" border="0" align="center" cellpadding="0" cellspacing="5" id="stdtbl">

            <tr>
              <td width="31%" height="20" class="style2">&nbsp;</td>
              <td height="20">
                <label><span class="style2">User ID: </span></label></td>
              <td height="20"><select name="userid" id="userid" style="font-family: Verdana; font-size: 8pt; border: 1px solid #3399FF" onkeypress="return handleEnter(this, event)">
                <option selected="selected" value="<?php echo $rf['userid']; ?>"><?php echo $rf['userid']; ?></option>
                <?php $us="SELECT*FROM tbl_login";
				        $r=$myDb->select($us);
						while($row=$myDb->get_row($r,'MYSQL_ASSOC')){
						?>
                <option value="<?php echo $row['userid']; ?>"><?php echo $row['userid']; ?></option>
                <?php } ?>
              </select></td>
              <td height="20">&nbsp;</td>
            </tr>
            <tr>
              <td height="20" class="style2">&nbsp;</td>
              <td height="20">
                <label><span class="style2">Access to File Name:</span></label></td>
              <td height="20"><select name="flname" style="font-family: Verdana; font-size: 8pt; border: 1px solid #3399FF" onkeypress="return handleEnter(this, event)">
                <?php $fl="SELECT s.url AS url, s.name AS name
FROM tbl_menuscat s, tbl_accdtl a
WHERE a.flname = s.url
AND a.id = '$id'
AND a.flname = '$rf[flname]'
";
				        $fq=$myDb->select($fl);
						$fr=$myDb->get_row($fq,'MYSQL_ASSOC');
				  ?>
                <option selected="selected" value="<?php echo $fr['url']; ?>"><?php echo $fr['name']; ?></option>
                <?php $usc="SELECT*FROM tbl_menuscat";
				        $scr=$myDb->select($usc);
						while($srow=$myDb->get_row($scr,'MYSQL_ASSOC')){
						?>
                <option value="<?php echo $srow['url']; ?>"><?php echo $srow['name']; ?></option>
                <?php } ?>
              </select></td>
              <td height="20">&nbsp;</td>
            </tr>
            
            <tr>
              <td height="20" class="style2">&nbsp;</td>
              <td height="20" colspan="3"><div align="center" style="border-bottom:1px solid #CCCCCC;"><span class="style2">Access Name :</span></div></td>
              </tr>
            <tr>
              <td height="20" class="style2">&nbsp;</td>
              <td width="14%" height="20"><span class="style2">INSERT</span></td>
              <td width="11%"><span class="style2">UPDATE</span></td>
              <td width="44%"><span class="style2">DELETE</span></td>
            </tr>
            <tr>
              <td height="20" class="style2">&nbsp;</td>
              <td height="20"><label>
                <select name="ins">
				  <?php if($rf['ins']=="y"){ ?><option selected="selected" value="<?php echo $rf['ins']; ?>">Yes</option>
				  <?php }else{ ?>
				  <option selected="selected" value="<?php echo $rf['ins']; ?>">No</option>
				  <?php } ?>
                  <option value="y">Yes</option>
                  <option value="n">No</option>
                </select>
              </label></td>
              <td><label>
                <select name="upd">
				  <?php if($rf['upd']=="y"){ ?><option selected="selected" value="<?php echo $rf['upd']; ?>">Yes</option>
				  <?php }else{ ?>
				 <option selected="selected" value="<?php echo $rf['upd']; ?>">No</option>
				  <?php } ?>
                  <option value="y">Yes</option>
                  <option value="n">No</option>
                </select>
              </label></td>
              <td><label>
                <select name="delt">
				  <?php if($rf['delt']=="y"){ ?><option selected="selected" value="<?php echo $rf['delt']; ?>">Yes</option>
				  <?php }else{ ?>
				  <option selected="selected" value="<?php echo $rf['delt']; ?>">No</option>
				  <?php } ?>
                  <option value="y">Yes</option>
                  <option value="n">No</option>
                </select>
              </label></td>
            </tr>
            <tr>
              <td>&nbsp;</td>
              <td colspan="3">&nbsp;</td>
            </tr>
            <tr>
              <td>&nbsp;</td>
              <td colspan="3"><div align="center">
                <input type="submit" value="Submit" name="B1" style="color: #999999; font-size: 8pt; font-family: Verdana; border: 1px solid #C0C0C0; background-color: #D9F0FB"> 
                <input type="reset" name="Submit2" value="Reset" style="color: #999999; font-size: 8pt; font-family: Verdana; border: 1px solid #C0C0C0; background-color: #D9F0FB"/>
              </div></td>
            </tr>
          </table>          
          </div>

                </form>
          <br />
          <p></p>
</td>
      </tr>
	        <tr>
        <td height="60" colspan="2" valign="middle" bgcolor="#D3F3FE"><?php include("bot.php"); ?></td>
        </tr>

    </table></td>
  </tr>
</table>
</body>
</html>
<?php 
   }else{
     $msg="Sorry,you are not authorized to access this page";
	 header("Location:home.php?msg=$msg");
   }	 

}else{
  header("Location:index.php");
}
}