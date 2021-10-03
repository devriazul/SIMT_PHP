<?php ob_start();
session_start();
require_once('dbClass.php');
include("config.php"); 
if($myDb->connect($host,$user,$pwd,$db,true))
{ 
	if($_SESSION['userid']){
	

?>

<script language="javascript">
 $(document).ready(function(){
   $('.sbmt').click(function(){
     var arr=$('#frm').serializeArray();
	 
	 $.post('insauth.php',arr,function(result){
	    $('#shw').html(result);
	 });
	 $('#shw').hide().fadeIn('slow');
   });
 });
</script>


<form name="MyForm" id="frm" autocomplete="off"  method="post" >           

<table width="96%" border="1px solid" align="center" cellpadding="1" cellspacing="0" bordercolor="#000000" >
            <!--DWLayoutTable-->
            
            <?php 

	$vuser=mysql_query("SELECT distinct m.name as 'MainMenuName', m.section  FROM `tbl_menuscat` ms inner join tbl_menucat m on m.id=ms.cid inner join tbl_access a on m.section=a.accname WHERE m.section='$_GET[q]' ORDER BY ms.`cid` ASC") or die(mysql_error());
  while($ufetch=mysql_fetch_array($vuser)){
  ?>
            <tr bgcolor="#F3F3F3">
              <td width="966" height="30" colspan="7" valign="middle" style="border-bottom:1px solid #000000; "><span style="font-family: Verdana; font-size: 10pt; font-weight:bold;">&nbsp; <span style="font-family: Verdana; font-size: 10pt; color:#000000; font-weight:bold;"><?php echo $ufetch['MainMenuName']; ?></span></span></td>
  </tr>
            <tr>
              <td height="19" colspan="7"><table width="99%" border="1" align="center" cellpadding="1" cellspacing="0" bordercolor="#000000" >
                  <!--DWLayoutTable-->
<tr valign="middle" bordercolor="#E6F2FF" bgcolor="#0066CC">
                    <td><span style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size: 7pt; font-weight:bold; color:#FFFFFF; padding:4px;">Id</span></td>
                    <td height="21"><span style="font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 7pt; font-weight:bold; color:#FFFFFF; padding:4px;">Menu</span></td>
                    <td height="21"><span style="font-family: Verdana;  font-weight:bold; color:#FFFFFF; font-size: 7pt; padding:4px;">URL</span></td>
                    <td align="center"><span style="font-family: Verdana;   font-weight:bold; font-size: 7pt; color:#FFFFFF; padding:4px;">Menu Order</span></td>
                    <td align="center"><span style="font-family: Verdana;  font-weight:bold; font-size: 7pt; color:#FFFFFF; padding:4px;">Insert</span></td>
                    <td align="center"><span style="font-family: Verdana;  font-weight:bold; font-size: 7pt; color:#FFFFFF; padding:4px;">Edit</span></td>
                    <td align="center"><span style="font-family: Verdana;  font-weight:bold; font-size: 7pt; color:#FFFFFF; padding:4px;">Delete</span></td>
                </tr>
                  <?php 
	$scat=mysql_query("
					SELECT ms.id, ms.name AS Menu, ms.url, ms.morder, ac.ins, ac.upd, ac.delt
					FROM  `tbl_menuscat` ms
					INNER JOIN tbl_menucat m ON m.id = ms.cid
					INNER JOIN tbl_access a ON m.section = a.accname
					INNER JOIN tbl_accdtl ac ON ms.url = ac.flname
					WHERE m.name =  '$ufetch[MainMenuName]'
					AND m.section =  '$_GET[q]'
					AND ac.userid =  '$_GET[u]'
					UNION 
					SELECT ms.id, ms.name AS Menu, ms.url, ms.morder,  '' AS ins,  '' AS upd,  '' AS delt
					FROM  `tbl_menuscat` ms
					INNER JOIN tbl_menucat m ON m.id = ms.cid
					INNER JOIN tbl_access a ON m.section = a.accname
					WHERE m.name =  '$ufetch[MainMenuName]'
					AND m.section =  '$ufetch[section]'
					AND ( ms.id, ms.name, ms.url, ms.morder	) 
					NOT IN (SELECT ms.id, ms.name, ms.url, ms.morder FROM  `tbl_menuscat` ms INNER JOIN tbl_menucat m ON m.id = ms.cid INNER JOIN tbl_access a ON m.section = a.accname INNER JOIN tbl_accdtl ac ON ms.url = ac.flname WHERE m.section =  '$_GET[q]' AND ac.userid =  '$_GET[u]')"
					)or die(mysql_error());


	//SELECT ms.id, ms.name as Menu,ms.url, ms.morder  FROM `tbl_menuscat` ms inner join tbl_menucat m on m.id=ms.cid inner join tbl_access a on m.section=a.accname WHERE m.name='$ufetch[MainMenuName]' and m.section='$ufetch[section]' 
	//ORDER BY ms.morder ASC"
	while($sfetch=mysql_fetch_array($scat)){


	?>
                  
                  <tr valign="middle" bordercolor="#E6F2FF">
                    <td width="80"><span style="font-family: Verdana; font-size: 7pt; padding:4px;">
                      <input name="aid[]" type="checkbox" id="aid" value="<?php echo $sfetch['url']; ?>" style="font-family: Verdana; font-size: 8pt; border: 1px solid #3399FF" onkeypress="return handleEnter(this, event)" />
                      <input type="hidden" name="id[]" id="id" value="<?php echo $sfetch['url']; ?>"></span></td>
                    <td width="312" height="21"><span style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size: 7pt; padding:4px;"><?php echo $sfetch['Menu']; ?></span></td>

                    <td width="236" height="21"><span style="font-family: Verdana; font-size: 7pt; padding:4px;"><?php echo $sfetch['url']; ?><input type="hidden" value="<?php echo $sfetch['url']; ?>" name="fname[]" id="fname[]" /><input type="hidden" value="<?php echo $_POST['userid'];?>" name="userid" id="userid" /></span></td>
                    <td width="118" align="center"><span style="font-family: Verdana; font-size: 7pt; padding:4px; "><?php echo $sfetch['morder']; ?></span></td>
        
<?php 
//$fo=mysql_query("SELECT ac.* FROM `tbl_menuscat` ms inner join tbl_menucat m on m.id=ms.cid inner join tbl_access a on m.section=a.accname inner join tbl_accdtl_new ac on ms.url=ac.flname WHERE m.section='$_GET[q]' and ac.userid='$_GET[u]' ORDER BY ms.morder ASC")or die(mysql_error());
//	while($qf=mysql_fetch_array($fo))
	//{
?>

            <td width="74" align="center">
                	<?php if($sfetch['ins']=="y"){?>
						<select name="insm[]" style="width:70px; font:Verdana, Arial, Helvetica, sans-serif; font-size:x-small; text-align:center; background-color:#009966; color:#FFFFFF;  ">
		          	<?php }else if($sfetch['ins']=="n"){?>
						<select name="insm[]" style="width:70px; font:Verdana, Arial, Helvetica, sans-serif; font-size:x-small; text-align:center; background-color:#FF0000; color:#FFFFFF;">
		          	<?php }else{?>
						<select name="insm[]" style="width:70px; font:Verdana, Arial, Helvetica, sans-serif; font-size:x-small; text-align:center;">
					<?php }?>

							<?php echo $sfetch['ins']; ?>	<?php if($sfetch['ins']=="y"){ ?>
        		        	<option value="<?php echo $sfetch['ins']; ?>">Yes</option>
                			<?php }else if($sfetch['ins']=="n"){ ?>
                  			<option value="<?php echo $sfetch['ins']; ?>">No</option>
                  			<?php }?>
                            <option value="" ></option>
                            <option value="y" >Yes</option>
                            <option value="n" >No</option>
                      </select>
                    </td>
                    <td width="68" align="center">                    
                	<?php if($sfetch['upd']=="y"){?>
						<select name="updm[]" style="width:70px; font:Verdana, Arial, Helvetica, sans-serif; font-size:x-small; text-align:center; background-color:#009966; color:#FFFFFF;  ">
		          	<?php }else if($sfetch['ins']=="n"){?>
						<select name="updm[]" style="width:70px; font:Verdana, Arial, Helvetica, sans-serif; font-size:x-small; text-align:center; background-color:#FF0000; color:#FFFFFF;">
					<?php }else{?>
						<select name="updm[]" style="width:70px; font:Verdana, Arial, Helvetica, sans-serif; font-size:x-small; text-align:center;">
					<?php }?>
		                <?php echo $sfetch['upd']; ?>	<?php if($sfetch['upd']=="y"){ ?>
        		        	<option value="<?php echo $sfetch['upd']; ?>"  >Yes</option>
                			<?php }else if($sfetch['upd']=="n"){ ?>
                  			<option value="<?php echo $sfetch['upd']; ?>">No</option>
                  			<?php }?>
                            <option value="" ></option>
                            <option value="y" >Yes</option>
                            <option value="n" >No</option>
                    </select>
                    </td>
                    <td width="62" align="center">                    
                	<?php if($sfetch['delt']=="y"){?>
						<select name="deltm[]" style="width:70px; font:Verdana, Arial, Helvetica, sans-serif; font-size:x-small; text-align:center; background-color:#009966; color:#FFFFFF;  ">
		          	<?php }else if($sfetch['delt']=="n"){?>
						<select name="deltm[]" style="width:70px; font:Verdana, Arial, Helvetica, sans-serif; font-size:x-small; text-align:center; background-color:#FF0000; color:#FFFFFF;">
					<?php }else{?>
						<select name="deltm[]" style="width:70px; font:Verdana, Arial, Helvetica, sans-serif; font-size:x-small; text-align:center;">
					<?php }?>
		                <?php echo $sfetch['delt']; ?>	<?php if($sfetch['delt']=="y"){ ?>
        		        	<option value="<?php echo $sfetch['delt']; ?>" >Yes</option>
                			<?php }else if($sfetch['delt']=="n"){ ?>
                  			<option value="<?php echo $sfetch['delt']; ?>">No</option>
                  			<?php }?>
                            <option value="" ></option>
                            <option value="y" >Yes</option>
                            <option value="n" >No</option>
                      </select>
                    </td>
					</tr>
                  <?php } ?>
              </table></td>
            </tr>
            <?php } ?>
</table><div id="shw" align="center"></div></br> <div align="center"><input type="button" class="sbmt" align="middle" value="Save Authentication" style="color: #999999; font-size: 8pt; font-family: Verdana; border: 1px solid #C0C0C0; background-color: #D9F0FB" /></div>
    
</form>

<?php }
}
?>