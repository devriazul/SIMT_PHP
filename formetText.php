<?php $prtype=mysql_real_escape_string($_GET['prtype']);
  switch($_GET['equip']){
    case "1":
        $dspace=strpos($prtype," ");
		$spacefirst=strpos($prtype," ");
		if($spacefirst==0){
			$respace=str_replace(" ","",$prtype);
			echo strtoupper($respace);
		}else{
			$respace=str_replace(" ","",$prtype);
			echo strtoupper($respace);
		}
	  break;
	case "2":   
        $dspace=strpos($prtype," ");
		$spacefirst=strpos($prtype," ");
		if($spacefirst==0){
			$respace=str_replace(" ","",$prtype);
			echo strtoupper($respace);
		}else{
			$respace=str_replace(" ","",$prtype);
			echo strtoupper($respace);
		}
	  break;
	case "3":   
        $dspace=strpos($prtype," ");
		$spacefirst=strpos($prtype," ");
		if($spacefirst==0){
			$respace=str_replace(" ","",$prtype);
			echo strtoupper($respace);
		}else{
			$respace=str_replace(" ","",$prtype);
			echo strtoupper($respace);
		}
	  break;
	  
	  
	  
  }
?>