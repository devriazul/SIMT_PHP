
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
</style>
<style type="text/css">
<!--
@import url("main.css");
-->
</style>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
</head>

<body>
<span class="style5">Institute Management System, Version:2.0 <br/><span class="style5"><?php echo date("D, F d Y",time()); ?>
    </span></span>
<br><div  id="clockDisplay" class="style5"></div>
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
