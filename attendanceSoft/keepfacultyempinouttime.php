<?php include("../config.php");
if($myDb->connect($host,$user,$pwd,$db,true))
{ 
mysql_query("TRUNCATE TABLE readdevicefile") or die(mysql_error());
$filename = !empty($_POST['filename'])?mysql_real_escape_string($_POST['filename']):'';
$filenameformet = substr($filename,0,strpos($filename,date("Y")));
if($filenameformet !== "MSG" ){
  echo "File name formet have to like this: "."MSG".date("Y").date("m").date("d").".txt";
  exit;
}
$fname = substr($filename,0,strpos($filename,"."));
$datenum = substr($fname,3,strlen($fname));
$y = substr($datenum,0,4);
$m = substr($datenum,4,2);
$d = substr($datenum,6,2);
$attdate = $y."-".$m."-".$d;
$file = fopen("C:/Program Files (x86)/701Client/$filename","r");
$line_1 = array();
$c = 0;
while(! feof($file))
{
		 $pollfieldsrec = array();
		 $line_1 = explode(',',fgets($file));
		 $contentkeycount = count($line_1);
		 if($c == 0 ){
			 if( 1 === $contentkeycount ){
			   echo $msg = "May be broken file please check file content";
			   exit;
			 }
			 $c = 1;
		 }
		 foreach($line_1 as $key=>$pollfieldsrec){
				   if($key==1){
						$_SESSION['inouttime'] = $key;
						$_SESSION['pollfieldsrec'] = $pollfieldsrec;
				   } 
				   if($key==3){
						$_SESSION['enum'] = $key;
						$_SESSION['pollfieldsrec'] = $pollfieldsrec;
				   } 
		  }
		  if( $_SESSION['pollfieldsrec'][0] == "1" ){
			$eid = (int)substr($_SESSION['pollfieldsrec'],1,strlen($_SESSION['pollfieldsrec']));
			if( strlen($eid) == 4 && $eid!=0 ){
				$emp = "EMP ".$eid;
				@mysql_query("insert into readdevicefile(inouttime,fempid,attdate)values('".$line_1[$_SESSION['inouttime']]."','".$emp."','$attdate')") or die(mysql_error());

			}else if( strlen($eid) == 3 && $eid!=0 ){
				$emp = "EMP 0".$eid;
				@mysql_query("insert into readdevicefile(inouttime,fempid,attdate)values('".$line_1[$_SESSION['inouttime']]."','".$emp."','$attdate')") or die(mysql_error());
			}else if( strlen($eid) == 2 && $eid!=0 ){
				$emp = "EMP 00".$eid;
				@mysql_query("insert into readdevicefile(inouttime,fempid,attdate)values('".$line_1[$_SESSION['inouttime']]."','".$emp."','$attdate')") or die(mysql_error());
			}else if( strlen($eid) === 1 && $eid!=0 ){
				$emp = "EMP 000".$eid;
				@mysql_query("insert into readdevicefile(inouttime,fempid,attdate)values('".$line_1[$_SESSION['inouttime']]."','".$emp."','$attdate')") or die(mysql_error());
			}
		  }else if( $_SESSION['pollfieldsrec'][0] == "2" ){
			$fid = (int)substr($_SESSION['pollfieldsrec'],1,strlen($_SESSION['pollfieldsrec']));
			if( strlen($fid) == 3 && $fid!=0 ){
				$fc = "F ".$fid;
				@mysql_query("insert into readdevicefile(inouttime,fempid,attdate)values('".$line_1[$_SESSION['inouttime']]."','".$fc."','$attdate')") or die(mysql_error());
			}else if( strlen($fid) == 2 && $fid!=0 ){
				$fc = "F 0".$fid;
				@mysql_query("insert into readdevicefile(inouttime,fempid,attdate)values('".$line_1[$_SESSION['inouttime']]."','".$fc."','$attdate')") or die(mysql_error());
			}else if( strlen($fid) == 1 && $fid!=0 ){
				$fc = "F 00".$fid;
				@mysql_query("insert into readdevicefile(inouttime,fempid,attdate)values('".$line_1[$_SESSION['inouttime']]."','".$fc."','$attdate')") or die(mysql_error());
			}
		  }
}		  
echo $msg = "Attendance data imported";
fclose($file);
}