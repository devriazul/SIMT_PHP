<?php
function convert_number($number)
{
		if (($number < 0) || ($number > 999999999999))
		{
			throw new Exception("Number is out of range");
		}
		
		$string = $fraction = null;
		
		if (strpos($number, '.') !== false) {
			list($number, $fraction) = explode('.', $number);
		}
		
		$Bl = floor($number / 1000000000);  /* Billion */
		$number -= $Bl * 1000000000;
		$Cn = floor($number / 10000000);  /* Crore */
		$number -= $Cn * 10000000;
		
		
		
		$Gn = floor($number / 100000);  /* Millions (giga) */
		$number -= $Gn * 100000;
		$kn = floor($number / 1000);     /* Thousands (kilo) */
		$number -= $kn * 1000;
		$Hn = floor($number / 100);      /* Hundreds (hecto) */
		$number -= $Hn * 100;
		$Dn = floor($number / 10);       /* Tens (deca) */
		$n = $number % 10;               /* Ones */
		
		
		
		$res = "";
		if ($Bl)
		{
			$res .= (empty($res) ? "" : " ") .
			convert_number($Bl) . " Billion ";
		}
		
		
		if ($Cn)
		{
			$res .= (empty($res) ? "" : " ") .
			convert_number($Cn) . " Crore ";
		}
		
		
		
		if ($Gn)
		{
			$res .= convert_number($Gn) . " Lacs ";
		}
		
		if ($kn)
		{
			$res .= (empty($res) ? "" : " ") .
			convert_number($kn) . " Thousand ";
		}
		
		if ($Hn)
		{
			$res .= (empty($res) ? "" : " ") .
			convert_number($Hn) . " Hundred";
		}
		
		$ones = array("", "One", "Two", "Three", "Four", "Five", "Six",
						"Seven", "Eight", "Nine", "Ten", "Eleven", "Twelve", "Thirteen",
						"Fourteen", "Fifteen", "Sixteen", "Seventeen", "Eightteen",
						"Nineteen"
					 );
		$tens = array("", "", "Twenty", "Thirty", "Fourty", "Fifty", "Sixty",
						"Seventy", "Eigthy", "Ninety"
					 );
		
		if ($Dn || $n)
		{
			if (!empty($res))
			{
				$res .= " and ";
			}
			
			if ($Dn < 2)
			{
				$res .= $ones[$Dn * 10 + $n];
			}else{
				$res .= $tens[$Dn];
			
				if ($n)
				{
				$res .= "-" . $ones[$n];
				}
			}
		 }
		
		
		if (empty($res))
		{
			$res = "zero";
		}
		if($fraction){
			$res.=" Taka , ".convert_number($fraction)." Poisa";
		}
return $res;
}
?>