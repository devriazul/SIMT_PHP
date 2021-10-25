<?php ob_start();
session_start();
require_once('dbClass.php');
include("config.php"); 
if($myDb->connectDefaultServer())
{ 
  if($_SESSION['userid']){
  $empid=mysql_real_escape_string($_POST['empid']);
  $pid=mysql_real_escape_string($_POST['pid']);
  $qty=mysql_real_escape_string($_POST['qty']);
  $issuedate=mysql_real_escape_string($_POST['issuedate']);
  $storeid=mysql_real_escape_string($_POST['storeid']);
  $iprice=mysql_real_escape_string($_POST['uprice']);
  $isuid=mysql_real_escape_string($_POST['isuid']);
	$sql = "SELECT p . * , SUM( b.pqty ) 
				FROM tbl_product p
				INNER JOIN tbl_buyproduct b ON p.id = b.pid
				WHERE p.id='$pid'
				AND b.storeid='$storeid'
				AND b.pqty >0
				AND b.pstatus =  'P'
				AND b.storeid<>''
				GROUP BY pid";
	$rsd = $myDb->select($sql);
	$rsdf=$myDb->get_row($rsd,'MYSQL_ASSOC');
	$chkst='';
	if($_SESSION['userid']=="inventory"){
		$chkst = "select*from tbl_store  where storeid='$storeid'";
	}else{
		$chkst = "select*from tbl_store  where maintainby='$_SESSION[userid]' and storeid='$storeid'";
	}
	$chs = $myDb->select($chkst);
	$chkstf=$myDb->get_row($chs,'MYSQL_ASSOC');
	
    if(!empty($rsdf['id'])&&!empty($chkstf['storeid'])){	
    
		  $pro=$myDb->select("SELECT*FROM tbl_product WHERE id='$pid'");
		  $prof=$myDb->get_row($pro,'MYSQL_ASSOC');
		  $chk_pr=$myDb->select("SELECT (select ifnull(sum(pqty),0) from tbl_buyproduct where pid='$pid' AND pqty >0 AND pstatus =  'P')pqty,
										(select ifnull(sum(iqty),0) from tbl_issue where pid='$pid') iqty 
					FROM tbl_buyproduct
					WHERE pid='$pid'
					AND pqty >0
					AND pstatus =  'P'
					");
		  $chkprf=$myDb->get_row($chk_pr,'MYSQL_ASSOC');
		  $cpr=(intval($chkprf['pqty'])-intval($chkprf['iqty']));
		
		  if($cpr>=$qty){
		  if($myDb->insert_sql("INSERT INTO tbl_issue(empid,pid,iqty,issue_date,storeid,isuid,iprice)VALUES('$empid','$pid','$qty','$issuedate','$storeid','$isuid','$iprice')")){
		  
		  
		  
		  /*
  //----------Start Auto Hit to accounts-------------
			//echo "Select * from tbl_issue where isuid='$isuid' and issue_date='$issuedate' and pid='$pid' and accposting='0'";
			$chkst=$myDb->select("Select * from tbl_issue where isuid='$isuid' and issue_date='$issuedate' and pid='$pid' and accposting='0'");
			$chkstf=$myDb->get_row($chkst,'MYSQL_ASSOC');
			
			
			if(!empty($chkstf['id']))
			{
						//-------------Select Re-agent Head-------------					
						$raacc=$myDb->select("Select * from tbl_accchart Where accname='Reagent'");
						$raaccf=$myDb->get_row($raacc,'MYSQL_ASSOC');
						if($raaccf['groupname']==0)
						{
							$groupnameA=$raaccf['parentid'];
						}
						else
						{
							$groupnameA=$raaccf['groupname'];
						}


						//-------------Select Product Consumed Head-------------					
	
						$conacc=$myDb->select("Select * from tbl_accchart Where accname='Consumed'");
						$conaccf=$myDb->get_row($conacc,'MYSQL_ASSOC');
						if($conaccf['groupname']==0)
						{
							$groupnameB=$conaccf['parentid'];
						}
						else
						{
							$groupnameB=$conaccf['groupname'];
						}

							
						//----------------------For Purchase-------------------------
						$vid=$myDb->select("SELECT ifnull(count(id),0) mvid FROM tbl_masterjournal WHERE vouchertype='J'");
						$vidf=$myDb->get_row($vid,'MYSQL_ASSOC');
						$maxvid=$vidf['mvid']+1;
						$opdate=date("Y-m-d");
						$voucherid="JV/-".$opdate."-"."0".$maxvid;													 
						$vexpl="Product Consumed by : ".$empid;
						$vgroup=substr($raaccf['accname'],0,7);

						$myDb->insert_sql("INSERT INTO tbl_masterjournal(voucherid,voucherdate,vouchertype,preparedby, paytype,opby,opdate,storedstatus,accountno,voucherexpl, multi_single,voucher_group) VALUES('$voucherid','$opdate','J','$_SESSION[userid]','Cash','$_SESSION[userid]','$opdate','I','$conaccf[id]','$vexpl','single','$vgroup')");
						$camount=$qty*$iprice;
						if($camount>0)
						{
							//--------------Start Debit Entry----------------
							$myDb->insert_sql("INSERT INTO tbl_2ndjournal(accno,groupname, accname,amountdr,amountcr,voucherid, vouchertype,paytype,vdate,parentid, masteraccno, storedstatus,opby,multi_single,voucher_group) VALUES('$conaccf[id]','$groupnameB','$conaccf[accname]','$camount','0','$voucherid','J','Cash','$opdate','$conaccf[parentid]','0','I','$_SESSION[userid]','single','$vgroup')");
							//--------------Start Credit Entry----------------
							$myDb->insert_sql("INSERT INTO tbl_2ndjournal(accno,groupname, accname,amountdr,amountcr,voucherid, vouchertype,paytype,vdate,parentid, masteraccno, storedstatus,opby,multi_single,voucher_group) VALUES('$raaccf[id]','$groupnameA','$raaccf[accname]','0','$camount','$voucherid','J','Cash','$opdate','$raaccf[parentid]','$conaccf[id]','I','$_SESSION[userid]','single','$vgroup')");
						}
						
						$updst="UPDATE tbl_issue SET accposting='1' WHERE isuid='$isuid' and issue_date='$issuedate' and pid='$pid'";
						$myDb->update_sql($updst);
						
			}
             
//-----------------End of Auto Hit--------------
		  
		  */
		  
		  
		?>
		<style type="text/css">
		@import url("main.css");
		.style5 {color: #FFFFFF; font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 12px; }
		.style8 {font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 10px; }
		</style>
		
		<table width="80%" border="0" cellspacing="0" cellpadding="0" class="gridTbl" >
		  <tr>
			<td bgcolor="#3366FF" class="gridTblHead"><span class="style5">Employee Name</span></td>
			<td bgcolor="#3366FF" class="gridTblHead"><span class="style5">Product ID </span></td>
			<td height="30" bgcolor="#3366FF" class="gridTblHead"><span class="style5">Product Name</span></td>
			<td height="30" bgcolor="#3366FF" class="gridTblHead"><span class="style5">Issue Qty</span></td>
			<td height="30" bgcolor="#3366FF" class="gridTblHead"><span class="style5">Issue Date</span></td>
		  </tr>
		
		  <?php 
		  $empstring=substr($empid,0,3);
		  $fltstring=substr($empid,0,1);
		  
		  $chkstring=!empty($empstring)?$empstring:$ftlstring;
		
		  if($chkstring=='EMP'){
			  $issql="select p.id 'Product ID',p.pname 'Product Name',e.name 'Employee Name',i.issue_date 'Issue Date',i.iqty 'Issue Qty'
					from tbl_product p ";
		  }else{
			  $issql="select p.id 'Product ID',p.pname 'Product Name',f.name 'Employee Name',i.issue_date 'Issue Date',i.iqty 'Issue Qty'
					from tbl_product p ";
		  
		  }			
				
		  $issql.="inner join tbl_issue i
				on p.id=i.pid ";
		  if($chkstring=='EMP'){
		   $instf="inner join tbl_staffinfo e
				on e.sid=i.empid ";
		   $issql.=$instf;		
		  }else{		
		   $inflt="inner join tbl_faculty f
				on f.facultyid=i.empid ";
		   $issql.=$inflt;
		  }		
		  $cond="where i.empid='$empid'
				and i.issue_date='$issuedate' ";
		  $issql.=$cond;
		  
		  
		  //echo $issql;
		  //exit;
		  $bpr=mysql_query($issql) or die(mysql_error());
		  while($bprf=mysql_fetch_array($bpr)){ 
		  ?>
		
		  <tr>
			<td class="gridTblValue"><span class="style8"><?php echo $bprf["Employee Name"]; ?></span></td>
			<td class="gridTblValue"><span class="style8"><?php echo $bprf["Product ID"]; ?></span></td>
			<td height="30" class="gridTblValue"><span class="style8"><?php echo $bprf["Product Name"]; ?></span></td>
			<td height="30" class="gridTblValue"><span class="style8"><?php echo $bprf["Issue Qty"]; ?></span></td>
			<td height="30" class="gridTblValue"><span class="style8"><?php echo $bprf["Issue Date"]; ?></span></td>
		  </tr>
		  <?php } ?>
		</table>
		
		<?php 							   
			 echo "<div style='width:400px; height:20px; padding:5px;background-color:#999999; color:#ffffff; margin:10px; font-size:10px; '>Product issue successfull</div>";
		  }else{
			 echo $myDb->last_error;
		  }	 	 
		}else{
		  echo "Stock insufficient";
		}  
	}else{
	  echo "<div style='width:400px; height:20px; padding:5px;background-color:#999999; color:#ffffff; margin:10px; font-size:10px; '>Product not found in this stock</div>";
	}
?>


<?php 
}else{
  header("Location:index.php");
}
}  
?>
