<?php ob_start();
session_start();
include("config.php"); 
if($myDb->connectDefaultServer())
{ 
  if($_SESSION['userid']){
  $chka="SELECT*FROM  tbl_accdtl WHERE flname='manage_admissionfees.php' AND userid='$_SESSION[userid]'";
  $caq=$myDb->select($chka);
  $car=$myDb->get_row($caq,'MYSQL_ASSOC');
  if($car['ins']=="y"){
    $per_page = 9; 

    if($_GET)
    {
       $page=$_GET['page'];
    }



    //get table contents
    $start = ($page-1)*$per_page;
    //$sql = "select * from tbl_courses order by id limit $start,$per_page";
   // $rsd = mysql_query($sql);
  // str_replace (' ', '', $string)
	 $sdq="SELECT f.id,f.stdid as 'Student ID',s.stdname as 'Student Name',
       case frommonth when '01' then '&#2460;&#2494;&#2472;&#2497;&#2527;&#2494;&#2480;&#2495;'
            when '02' then '&#2475;&#2503;&#2476;&#2509;&#2480;&#2497;&#2527;&#2494;&#2480;&#2495;'
            when '03' then '&#2478;&#2494;&#2480;&#2509;&#2458;'
            when '04' then '&#2447;&#2474;&#2509;&#2480;&#2495;&#2482;'
            when '05' then '&#2478;&#2503;'
            when '06' then '&#2460;&#2497;&#2472;'
            when '07' then '&#2460;&#2497;&#2482;&#2494;&#2439;'
            when '08' then '&#2437;&#2455;&#2494;&#2488;&#2509;&#2463;'
            when '09' then '&#2488;&#2503;&#2474;&#2509;&#2463;&#2503;&#2478;&#2509;&#2476;&#2480;'
            when '10' then '&#2437;&#2453;&#2509;&#2463;&#2507;&#2476;&#2480;'
            when '11' then '&#2472;&#2477;&#2503;&#2478;&#2509;&#2476;&#2480;'
            when '12' then '&#2465;&#2495;&#2488;&#2503;&#2478;&#2509;&#2476;&#2480;'
       else
            '&#2460;&#2494;&#2472;&#2497;&#2527;&#2494;&#2480;&#2495;'
       end as 'From Month',
       
	   case tomonth when '01' then '&#2460;&#2494;&#2472;&#2497;&#2527;&#2494;&#2480;&#2495;'
            when '02' then '&#2475;&#2503;&#2476;&#2509;&#2480;&#2497;&#2527;&#2494;&#2480;&#2495;'
            when '03' then '&#2478;&#2494;&#2480;&#2509;&#2458;'
            when '04' then '&#2447;&#2474;&#2509;&#2480;&#2495;&#2482;'
            when '05' then '&#2478;&#2503;'
            when '06' then '&#2460;&#2497;&#2472;'
            when '07' then '&#2460;&#2497;&#2482;&#2494;&#2439;'
            when '08' then '&#2437;&#2455;&#2494;&#2488;&#2509;&#2463;'
            when '09' then '&#2488;&#2503;&#2474;&#2509;&#2463;&#2503;&#2478;&#2509;&#2476;&#2480;'
            when '10' then '&#2437;&#2453;&#2509;&#2463;&#2507;&#2476;&#2480;'
            when '11' then '&#2472;&#2477;&#2503;&#2478;&#2509;&#2476;&#2480;'
            when '12' then '&#2465;&#2495;&#2488;&#2503;&#2478;&#2509;&#2476;&#2480;'
       else
            '&#2460;&#2494;&#2472;&#2497;&#2527;&#2494;&#2480;&#2495;'
       end as 'To Month',f.edate as 'Entry Date',(SUM(f.tuitionfee)+SUM(f.admissionfee)+SUM(f.latefee)+SUM(f.semesterfee)+SUM(f.registrationfee)+SUM(f.formfillupfee)+SUM(f.fieldtrainingfee)+SUM(f.idcardfee)+SUM(f.libraryfee)+SUM(f.admissionform)+SUM(f.testimonialfee)+SUM(f.midtremtestfee)+SUM(f.marksheetfee)+SUM(f.labfee)+SUM(f.others)) as 'Total Amout' 
	FROM  tbl_feescollection f
	INNER JOIN tbl_stdinfo s
	ON f.stdid=s.stdid
    WHERE f.storedstatus<>'D' and s.storedstatus<>'D'	
	GROUP BY f.id,f.stdid,s.stdname,f.edate,f.frommonth,f.tomonth limit $start,$per_page";
	$sdep=$myDb->dump_query($sdq,'edit_admissionfees.html','del_admissionfees.html',$car['upd'],$car['delt']);
  
   }else{
     $msg="Sorry,you are not authorized to access this page";
	 header("Location:home.html?msg=$msg");
   }	 

}else{
  header("Location:login.html");
}
}  
?>
