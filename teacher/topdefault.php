
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<style type="text/css">
.clockStyle {
	background-color: transparent;
	
	padding:6px;
	color:#FFFFFF;
	font-family:Calibri;
    font-size:12px;
	font-weight:bold;
    display:inline;    
	
}

.top {
	padding:6px;
	color:#F4F4F4;
	font-family:Calibri;
    font-size:11px;
	font-weight:bold;
    /*display:inline;    */
	
	
}

.bckcontent {
display: block;
width: 130px;
height: 15px;
padding: 5px;
text-align: center;
/*background: transparent url(/sites/all/themes/mjq/images/fieldset_legend.png) top left repeat-x;
border: 1px solid #F4F4FF;*/
text-shadow: 1px 1px 1px #666;
font-size: 10pt;
line-height: 18pt;
color: #fff;
text-transform: uppercase;
border-radius: 5px;
-o-border-radius: 5px;
-moz-border-radius: 5px;
-webkit-border-radius: 5px;
-moz-box-shadow: 0px 15px 10px -10px #656565;
-webkit-box-shadow: 0px 15px 10px -10px #656565;
-o-box-shadow: 0px 15px 10px -10px #656565;
box-shadow: 0px 15px 10px -10px #656565;
filter: progid:DXImageTransform.Microsoft.Shadow(color=#656565,Direction=180,Strength=10);
}

</style>
<style type="text/css">
<!--
@import url("main.css");
-->
</style>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
</head>

<body>
<table width="100%"  border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="90%"><span class="clockStyle">Institute Management System, Version:2.0</span></td>
    <td width="10%"><div class="bckcontent"><div align="right"><span class="clockStyle"><a href="acchome.php"><span class="top">Home</span></a>| <a href="logout.php"><span class="top">Logout </span></a></span></div></div></td>
  </tr>
</table>
<span class="clockStyle"><?php echo date("D, F d Y",time()); ?>
    </span>
<br>
<div  id="clockDisplay" class="clockStyle"></div>
<script type="text/javascript" language="javascript">
function renderTime() {
	var currentTime = new Date();
	var diem = "AM";
	var h = currentTime.getHours();
	var m = currentTime.getMinutes();
    var s = currentTime.getSeconds();
	setTimeout('renderTime()',1000);
    if (h == 0) {
		h = 12;
	} else if (h >= 12) { 
		h = h - 12;
		diem="PM";
	}
	if (h < 10) {
		h = "0" + h;
	}
	if (m < 10) {
		m = "0" + m;
	}
	if (s < 10) {
		s = "0" + s;
	}
    var myClock = document.getElementById('clockDisplay');
	myClock.textContent = h + ":" + m + ":" + s + " " + diem;
	myClock.innerText = h + ":" + m + ":" + s + " " + diem;
}
renderTime();
</script>


</body>
</html>
