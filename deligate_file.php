<?php ob_start();
session_start();
require_once('dbClass.php');
include("config.php"); 
if($myDb->connect($host,$user,$pwd,$db,true))
{ 
  if($_SESSION['userid']){
  $chka="SELECT*FROM  tbl_accdtl WHERE flname='macclevel.php' AND userid='$_SESSION[userid]'";
  $caq=$myDb->select($chka);
  $car=$myDb->get_row($caq,'MYSQL_ASSOC');
  if(($car['ins']=="y")||($_SESSION['userid']=="administrator")){
  
 
?>
<script language="javascript" src="jquery.js"></script>
<script language="javascript">
$(function () {
    $("#checkAll").click(function () {
        if ($("#checkAll").is(':checked')) {
            $(".book").attr("checked", true);
        } else {
            $(".book").attr("checked", false);
        }
    });
});
</script>
<table width="100%"  border="0" cellpadding="0" cellspacing="0" class="gridTbl">
                <tr>
                  <td class="gridTblHead style2"><input type="checkbox" name="checkAll" id="checkAll"></td>
                  <td class="gridTblHead style2">ID</td>
                  <td class="gridTblHead style2">CatID</td>
                  <td class="gridTblHead style2">Name</td>
                  <td class="gridTblHead style2">Url</td>
                  <td class="gridTblHead style2">Order</td>
                  <td class="gridTblHead style2">Insert</td>
                  <td class="gridTblHead style2">Update</td>
                  <td class="gridTblHead style2">Delete</td>
                </tr>
				<?php 
				$catid=!empty($_POST['catid'])?$_POST['catid']:'';
				$accname=!empty($_POST['accname'])?$_POST['accname']:'';
				$apaq=$myDb->select("SELECT*FROM tbl_applicationauth 
										WHERE catid='$catid'
										AND accid='$accname'");
				$aqf=$myDb->get_row($apaq,'MYSQL_ASSOC');
				if(empty($aqf['id'])){						
				  $deligate=$myDb->select("SELECT c.id,concat(p.name,'/',p.section) Section,c.name 'Link Name',
										   c.url,c.morder
											FROM tbl_menucat p
											INNER JOIN tbl_menuscat c
											on p.id=c.cid
											WHERE c.cid='$catid'
											AND c.id NOT IN(SELECT scatid FROM tbl_applicationauth WHERE accid='$accname')");
				  while($dfetch=$myDb->get_row($deligate,'MYSQL_ASSOC')){
				  ?>							
				
                <tr>
                  <td class="gridTblValue style2"><input type="checkbox" name="id_chk" class="book" value="<?php echo $dfetch['id']; ?>">
				  <input type="hidden" name="id[]" class="book" value="<?php echo $dfetch['id']; ?>">
				  </td>
                  <td class="gridTblValue style2"><?php echo $dfetch['id']; ?></td>
                  <td class="gridTblValue style2"><?php echo $dfetch['Section']; ?></td>
                  <td class="gridTblValue style2"><?php echo $dfetch['Link Name']; ?></td>
                  <td class="gridTblValue style2"><?php echo $dfetch['url']; ?></td>
                  <td class="gridTblValue style2"><?php echo $dfetch['morder']; ?></td>
                  <td class="gridTblValue style2"><select name="ins[]" style="width:50px; ">
                    <option value=""></option>
                    <option value="y">y</option>
                    <option value="n">n</option>
                  </select></td>
                  <td class="gridTblValue style2"><select name="upd[]" style="width:50px; ">
                    <option value=""></option>
                    <option value="y">y</option>
                    <option value="n">n</option>
                  </select></td>
                  <td class="gridTblValue style2"><select name="delt[]" style="width:50px; ">
                    <option value=""></option>
                    <option value="y">y</option>
                    <option value="n">n</option>
                  </select></td>
                </tr>
				<?php 
				  } 
				}else{
				?>
				 <?php  $deligate=$myDb->select("SELECT c.id,concat(p.name,'/',p.section) Section,c.name 'Link Name',
										   c.url,c.morder,ap.ins,ap.upd,ap.delt
											FROM tbl_menucat p
											INNER JOIN tbl_menuscat c
											on p.id=c.cid
											INNER JOIN tbl_applicationauth ap
											on c.id=ap.scatid
											WHERE c.cid='$catid'
											AND ap.accid='$accname'
											
											UNION ALL
											
											SELECT c.id,concat(p.name,'/',p.section) Section,c.name 'Link Name',
										    c.url,c.morder,'' ins,'' upd,'' delt
											FROM tbl_menucat p
											INNER JOIN tbl_menuscat c
											on p.id=c.cid
											WHERE c.cid='$catid'
											AND c.id NOT IN(SELECT scatid FROM tbl_applicationauth WHERE accid='$accname')");
				  while($dfetch=$myDb->get_row($deligate,'MYSQL_ASSOC')){
				  ?>							
				
                <tr>
                  <td class="gridTblValue style2"><input type="checkbox" name="id_chk" class="book" value="<?php echo $dfetch['id']; ?>">
				  <input type="hidden" name="id[]" class="book" value="<?php echo $dfetch['id']; ?>">
				  </td>
                  <td class="gridTblValue style2"><?php echo $dfetch['id']; ?></td>
                  <td class="gridTblValue style2"><?php echo $dfetch['Section']; ?></td>
                  <td class="gridTblValue style2"><?php echo $dfetch['Link Name']; ?></td>
                  <td class="gridTblValue style2"><?php echo $dfetch['url']; ?></td>
                  <td class="gridTblValue style2"><?php echo $dfetch['morder']; ?></td>
                  <td class="gridTblValue style2"><select name="ins[]" style="width:50px; ">
                    <option value=""></option>
                    <option selected value="<?php echo $dfetch['ins']; ?>"><?php echo $dfetch['ins']; ?></option>
					<option value="y">y</option>
                    <option value="n">n</option>
                  </select></td>
                  <td class="gridTblValue style2"><select name="upd[]" style="width:50px; ">
                    <option value=""></option>
                    <option selected value="<?php echo $dfetch['upd']; ?>"><?php echo $dfetch['upd']; ?></option>
                    <option value="y">y</option>
                    <option value="n">n</option>
                  </select></td>
                  <td class="gridTblValue style2"><select name="delt[]" style="width:50px; ">
                    <option value=""></option>
                    <option selected value="<?php echo $dfetch['delt']; ?>"><?php echo $dfetch['delt']; ?></option>
                    <option value="y">y</option>
                    <option value="n">n</option>
                  </select></td>
                </tr>
				<?php 
				  }
				}
				?>  				
</table>
<?php  
   }else{
     $msg="Sorry,you are not authorized to access this page";
	 header("Location:index.php?msg=$msg");
   }	 

}else{
  header("Location:index.php");
}
}			  