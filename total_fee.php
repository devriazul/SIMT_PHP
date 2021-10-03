<?php 

  $totalfee=(intval($_POST['admissionfee'])+intval($_POST['labfee'])+intval($_POST['libraryfee'])+intval($_POST['idcardfee'])+intval($_POST['regifee']));

   echo $totalfee;
?>