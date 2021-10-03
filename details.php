<?php session_start();
include("config.php");
 $id=mysql_real_escape_string($_GET['id']);
 $bn=mysql_query("select*from binodonnews where id='$id'") or die(mysql_error());
							  $bnfetch=mysql_fetch_array($bn);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">

<head>

<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />

<title><?php include("title.php");?></title>

<meta itemprop="name" content="http://www.binodon.timesworld24.com/details.php?id=<?php echo $_GET['id']; ?>&cid=<?php echo $_GET['cid']; ?>">



<meta itemprop="description" content="<?php echo $bnfetch[sdescription]; ?>">







<meta itemprop="image" content="http://www.timesworld24.com/binodonnews_image/<?php echo $bnfetch[img];?>">







<meta name="keywords" content="<?php echo $ckfetch[keyword]; ?>">



<meta property="og:title" content="<?php echo $bnfetch[headline]; ?>" />



<meta property="og:type" content="<?php echo substr($ncfetch[ndescription],1,100); ?>" />



<meta property="og:url" content="http://www.binodon.timesworld24.com/details.php?id=<?php echo $_GET['id']; ?>" />



<meta property="og:image" content="http://www.timesworld24.com/binodonnews_image/<?php echo $bnfetch[img];?>" />



<meta property="og:site_name" content="timesworld24" />



<meta property="fb:app_id" content="4394847456390" />


<style type="text/css">

<!--

body {

	margin-top: 0px;

	margin-bottom: 0px;

}

-->

</style>



<link href="css.css" rel="stylesheet" type="text/css" />

<style type="text/css">

<!--

.style4 {

	font-family: SolaimanLipi;

	font-size: 24px;

	color: #0000FF;

}

.style5 {

	font-family: SolaimanLipi;

	font-size: 15px;

	color:#666666;

}

-->

</style>

<style>



<!--





div.imgpl



{



float:left;



margin:0 10px 10px 15px;



padding:15px;



border:1px solid black;



text-align:center;



}

.style16 {

	font-family: SolaimanLipi;

	font-size: 24px;

}

.style17 {

	font-family: SolaimanLipi;

	font-size: 16px;

}

.style18 {	font-family: SolaimanLipi;

	font-size: 24px;

	color: #CC0000;

}



-->



</style>

</head>



<body>
<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/en_US/all.js#xfbml=1";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>
<table width="100" border="0" align="center" cellpadding="1" cellspacing="0" bgcolor="#CCCCCC">

  <tr>

    <td><table width="100%" border="0" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">

      <tr>

        <td><table width="100" border="0" align="center" cellpadding="0" cellspacing="0">

          <tr>

            <td colspan="2"><img src="images/top.jpg" width="1000" height="98" /></td>
          </tr>

          <tr>

            <td colspan="2"><img src="images/spacer.gif" width="1" height="1" /></td>
          </tr>

          <tr>

            <td colspan="2" background="images/topbarbg.jpg"><table width="100%" border="0" cellpadding="0" cellspacing="0" class="Jlink">

                <tr >

                  <td><?php include("topnav.php"); ?></td>
                </tr>

            </table></td>
          </tr>

          <tr>

            <td colspan="2"><img src="images/spacer.gif" width="1" height="1" /></td>
          </tr>

          <tr>

            <td colspan="2"><img src="images/spacer.gif" width="1" height="5" /></td>
          </tr>

          <tr>

            <td colspan="2"><table width="100%" border="0" align="center" cellpadding="0" cellspacing="4">

                <tr>

                  <td width="59%" valign="top"><table width="100" border="0" align="center" cellpadding="0" cellspacing="0" class="Mlink">

                    <tr>

                      <td><img src="images/lid-1.jpg" width="572" height="9" /></td>
                    </tr>

                    <tr>

                      <td background="images/lid-bg.jpg"><table width="572" border="0" cellspacing="0" cellpadding="0">

                          <tr>

                            <td height="35">&nbsp;</td>

                            <td><div align="center"><span class="style18"><?php echo $bnfetch['headline']; ?></span></div></td>

                            <td>&nbsp;</td>
                          </tr>

                          <tr>

                            <td>&nbsp;</td>

                            <td><hr /></td>

                            <td>&nbsp;</td>
                          </tr>

                          <tr>

                            <td width="10">&nbsp;</td>

                            <td width="550"><div class="imgpl">

	<?php 

if(!$bnfetch['img']){

?>



<?php

}else{

?>

<img src="http://timesworld24.com/binodonnews_image/<?php echo $bnfetch['img']; ?>" width="200" height="200" /><br />

<?php } ?>

	</div>

<?php echo  $bnfetch['ndescription'];?></div></td>

                            <td width="12">&nbsp;</td>
                          </tr>

                      </table></td>
                    </tr>

                    <tr>

                      <td><img src="images/lid-2.jpg" width="572" height="7" /></td>
                    </tr>

                  </table></td>

                  <td width="41%" valign="top"><table width="100" border="0" align="center" cellpadding="0" cellspacing="0" class="Vlink">

                    <tr>

                      <td><img src="images/s-1.gif" width="392" height="8" /></td>
                    </tr>

                    <tr>

                      <td background="images/s-bg.gif"><table width="392" border="0" cellspacing="0" cellpadding="0">

                          <tr>

                            <td width="10">&nbsp;</td>

                            <td width="372"><?php include("right.php"); ?></td>

                            <td width="10">&nbsp;</td>
                          </tr>

                      </table></td>
                    </tr>

                    <tr>

                      <td><img src="images/s2.gif" width="392" height="7" /></td>
                    </tr>

                  </table>                    </td>
                </tr>

            </table></td>
          </tr>

          <tr>

            <td colspan="2">&nbsp;</td>
          </tr>

          <tr>

            <td colspan="2"><hr /></td>
          </tr>

          <tr>

            <td colspan="2"><img src="images/spacer.gif" width="1" height="5" /></td>
          </tr>

          <tr>
            <td width="21">&nbsp;</td>
            <td width="979"> <a name="fb_share"></a> 

<script src="http://static.ak.fbcdn.net/connect.php/js/FB.Share" 

        type="text/javascript">

</script></td>
          </tr>
          <tr>

            <td colspan="2"><iframe src="//www.facebook.com/plugins/likebox.php?href=http://www.facebook.com/TheTimeOfWorld&id=<?php echo $cns; ?>&amp;width=600&amp;height=200&amp;colorscheme=light&amp;show_faces=true&amp;border_color&amp;stream=no&amp;header=true" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:600px; height:200px;" allowTransparency="true"></iframe></td>
          </tr>

          <tr>

            <td colspan="2">&nbsp;</td>
          </tr>

          <tr>

            <td colspan="2"><?php include("bot.php"); ?></td>
          </tr>

        </table></td>

      </tr>

    </table></td>

  </tr>

</table>

</body>

</html>

