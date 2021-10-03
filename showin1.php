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

<script type="text/javascript" src="jquery-latest.js"></script>
  <script type="text/javascript" src="jquery.form.js"></script>
  <script type="text/javascript">
  $(document).ready(function() {
    $('#myForm0').ajaxForm({
      target: '#showdata0',
      success: function() {
	    $('#ani0').show('slow');
	    $('#ani0').html('<img src="loader.gif" align="absmiddle">');
        $('#showdata0').show(100);		
		$('#ani0').hide();

      }
    });
  });
  $(document).ready(function() {
    $('#myForm1').ajaxForm({
      target: '#showdata1',
      success: function() {
	    $('#ani1').show('slow');
	    $('#ani1').html('<img src="loader.gif" align="absmiddle">');
        $('#showdata1').show(100);	
		$('#ani1').hide();
	

      }
    });
  });
  $(document).ready(function() {
    $('#myForm2').ajaxForm({
      target: '#showdata2',
      success: function() {
	    $('#ani2').show('slow');
	    $('#ani2').html('<img src="loader.gif" align="absmiddle">');
        $('#showdata2').show(100);		
				$('#ani2').hide();


      }
    });
  });
  
  </script>
  <script language="JavaScript" type="text/javascript">
<!--

function showSelected1()
{
	var selObj = document.getElementById('session1');
	var inVal;
	var selIndex = selObj.selectedIndex;
	inVal=selIndex;
	switch(selObj.options[selIndex].text){
	  case '2005-2006':
	     document.getElementById('year1').value='2005';
		 break;
      case '2006-2007':
	     document.getElementById('year1').value='2006';
	     break;	 
      case '2007-2008':
	     document.getElementById('year1').value='2007';
	     break;	  
      case '2008-2009':
	     document.getElementById('year1').value='2008';
	     break;	
      case '2009-2010':
	     document.getElementById('year1').value='2009';
	     break;
      case '2010-2011':
	     document.getElementById('year1').value='2010';
	     break;	  
      case '2011-2012':
	     document.getElementById('year1').value='2011';
	     break;	  
      case '2012-2013':
	     document.getElementById('year1').value='2012';
	     break;	  
      case '2013-2014':
	     document.getElementById('year1').value='2013';
	     break;	
      case '2014-2015':
	     document.getElementById('year1').value='2014';
	     break;
      case '2015-2016':
	     document.getElementById('year1').value='2015';
	     break;	 
      case '2016-2017':
	     document.getElementById('year1').value='2016';
	     break;	  
      case '2017-2018':
	     document.getElementById('year1').value='2017';
	     break;	  
      case '2018-2019':
	     document.getElementById('year1').value='2018';
	     break;	  
      case '2019-2020':
	     document.getElementById('year1').value='2019';
	     break;	  
      case '2020-2021':
	     document.getElementById('year1').value='2020';
	     break;	  
      case '2021-2022':
	     document.getElementById('year1').value='2021';
	     break;	  
      case '2022-2023':
	     document.getElementById('year1').value='2022';
	     break;	  
      case '2023-2024':
	     document.getElementById('year1').value='2023';
	     break;	  
      case '2024-2025':
	     document.getElementById('year1').value='2024';
	     break;	  
      
	  default:
	     document.getElementById('year1').value='<?php echo date("Y"); ?>';
	}	 
}


//-->
</script>
<table width="90%" border="0" align="center" cellpadding="0" cellspacing="0" id="stdtbl">
           <tr>
             <td width="40%" height="30" bgcolor="#D9F0FB" class="style15">DEPARTMENT</td>
             <td width="23%" height="30" bgcolor="#D9F0FB" class="style15">YEAR</td>
             <td height="30" colspan="2" bgcolor="#D9F0FB" class="style15">SESSION</td>
           </tr>
  <form id="myForm<?php echo $count; ?>" action="data.php" method="post">
           <tr>
             <td><label><input type="hidden" name="semester" id="semester" value="<?php echo $stdr['id']; ?>" />
               <select name="department" id="department" style="font-family: Verdana; font-size: 8pt;padding:3px; border: 1px solid #3399FF" onkeypress="return handleEnter(this, event)">
                <option value="-1" selected="selected">Select Department</option>
                <?php 
			  	$cat=mysql_query("select id, name from tbl_department") or die(mysql_error());
	 			while($cfetch=mysql_fetch_array($cat)){
	 			?>
                <option value="<?php echo $cfetch['id']; ?>"><?php echo $cfetch['name']; ?></option>
                <?php } ?>
              </select>
             </label></td>
             <td><label>
               <input name="year" type="text" id="year0" size="15" style="font-family: Verdana; font-size: 8pt; border: 1px solid #3399FF" value="<?php echo date("Y"); ?>" onkeypress="return handleEnter(this, event)" readonly="true" />
             </label></td>
             <td width="15%"><label>
               <select name="session" id="session0" style="font-family: Verdana; font-size: 8pt; border: 1px solid #3399FF" onkeypress="return handleEnter(this, event)" onchange="showSelected0();">
                <option value="">Select session</option>
				<option value="0506">2005-2006</option>
				<option value="0607">2006-2007</option>
				<option value="0708">2007-2008</option>
				<option value="0809">2008-2009</option>
				<option value="0910">2009-2010</option>
				<option value="1011">2010-2011</option>
				<option value="1112">2011-2012</option>
				<option value="1213">2012-2013</option>
				<option value="1314">2013-2014</option>
				<option value="1415">2014-2015</option>
				<option value="1516">2015-2016</option>
				<option value="1617">2016-2017</option>
				<option value="1718">2017-2018</option>
				<option value="1819">2018-2019</option>
				<option value="1920">2019-2020</option>
				<option value="2021">2020-2021</option>
				<option value="2122">2021-2022</option>
				<option value="2223">2022-2023</option>
				<option value="2324">2023-2024</option>
				<option value="2425">2024-2025</option>
              </select>
             </label></td>
             <td width="22%"><label>
               <input type="submit" name="submit1"  value="Next" style="color: #999999; font-size: 8pt; font-family: Verdana; border: 1px solid #C0C0C0; background-color: #D9F0FB">
             </label></td>
           </tr>
           <tr>
             <td colspan="4"> 
<div id="ani<?php echo $count; ?>"></div>
			 <div id="showdata<?php echo $count; ?>">
    <?php include("data.php");?>
  </div></td>
           </tr>		   </form>

         </table>
