<?php ob_start();
session_start();
include("config.php"); 
if($myDb->connectDefaultServer())
{ 
  if($_SESSION['userid']){
	  if($_SERVER['REQUEST_METHOD']=="POST"){
		   @$_SESSION['sessiontype']=$_POST['sessiontype'];
		   @$_SESSION['pytype']=$_POST['pytype'];
		   @$_SESSION['drcrtype']=$_POST['drcrtype'];
	  }
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
</head>

<body>
<table width="1047" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td width="1047" height="152" valign="top" background="images/1.jpg"><span class="style17"><?php include("topdefault.php");?>    </span></span></td>
  </tr>
  <tr>
    <td><table width="100%" border="0" cellspacing="0" cellpadding="0" id="tblleft">
      <tr>
        <td height="28" colspan="2" bgcolor="#0C6ED1"><div align="center" class="style1">SAIC INSTITUTE OF MANAGEMENT TECHNOLOGY</div></td>
        </tr>
      <tr>
        <td background="images/leftbg.jpg">&nbsp;</td>
        <td><div align="center"><font face="Arial, Helvetica, sans-serif" size="2"><?php if(isset($_GET['msg'])) {echo $_GET['msg'];}?></font></div></td>
      </tr>
      <tr>
        <td width="21%" valign="top" background="images/leftbg.jpg"><?php include("left.php");?><br />
          <p>&nbsp;</p>
          <p>&nbsp;</p></td><td width="79%" height="300" valign="top"><blockquote>
          <p><span class="style4">Some text goes here..Some text goes here..Some text goes here..Some text goes here..Some text goes here..Some text goes here..Some text goes here..Some text goes here..Some text goes here..Some text goes here..Some text goes here..Some text goes here..Some text goes here..Some text goes here..Some text goes here..Some text goes here..Some text goes here..Some text goes here..Some text goes here..Some text goes here..Some text goes here..Some text goes here..</span></p>
        </blockquote>
		  <div class="appset" style="width:500px;margin:0 auto;">
            <form name="form1" id="form1" method="post" action="" >
              Voucher Type:
			  <select name="sessiontype">
                <option value="">Select Voucher type</option>
				<option selected value="<?php echo @$_SESSION['sessiontype']; ?>">
				  <?php if(@$_SESSION['sessiontype']=="R"){ echo "Receive";
				  
				  }else if(@$_SESSION['sessiontype']=="P"){
				    echo "Payment";
				  }else if(@$_SESSION['sessiontype']=="J"){
				    echo "Journal";
				  }else if(@$_SESSION['sessiontype']=="C"){
				    echo "Contra";
				  }
				  ?>
				</option>
                <option value="R">Receive</option>
                <option value="P">Payment</option>
                <option value="J">Journal</option>
                <option value="C">Contra</option>
              </select>
			  <br/>
			  Account's Head Mode:
			  <select name="drcrtype" id="drcrtype">
			    <option value="">Select options type</option>
				<option selected value="<?php echo @$_SESSION['drcrtype']; ?>">
				  <?php if(@$_SESSION['drcrtype']=="sdmcscmd"){ echo "Single Debit Multi Credit/Single Credit Multi Debit"; 
				  
				  }else if(@$_SESSION['drcrtype']=="mcmd"){
				    echo "Multi Debit/Multi Credit";
				  }
				  ?>
				
				</option>
				<option value="sdmcscmd">Single Debit Multi Credit/Single Credit Multi Debit</option>
				<option value="mcmd">Multi Debit/Multi Credit</option>
			  </select>
			  <br/>
			Transaction Mode:  
			<select name="pytype" id="pytype" class="field field_medium"
			placeholder="Pay Type"  onkeypress="return handleEnter(this, event)">
                <option value="">Select Pay type</option>
				<option selected value="<?php echo @$_SESSION['pytype']; ?>"><?php echo @$_SESSION['pytype']; ?></option>
                <option value="cash">Cash</option>
                <option value="bank">Bank</option>
                
              </select>			  
			  <br/>
			  <input type="submit" name="submit" value="submit">
            </form>            
			</div><p>&nbsp;</p></td></tr>
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
  header("Location:login.php");
}
}  
?>
