<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title>Untitled Document</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<script language="javascript" src="../jquery.js"></script>
<style type="text/css" media="screen">
 .box{
  position:absolute;
  left:0;
  top:0;
  z-index:9000;
  background-color:#000;
  display:none;
 }

</style>
<script language="javascript">
 $(document).ready(function(){
        var maskHeight = $(document).height();
        var maskWidth = $(window).width();
      
        //Set height and width to mask to fill up the whole screen
        $('.box').css({'width':maskWidth,'height':maskHeight});
		$('.box').fadeIn(1000);
		$('.box').fadeTo("slow",0.3);	
 });

</script>
</head>
<body>
 <div class="box"></div>
 fdsaf sad fas fsd afsdfa
</body>
</html>
