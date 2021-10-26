<? session_start();
if(!$_SESSION[bpaddsesid]){
				include("adminlogin.php");
				}else{
				include("../config.php");
    $target = basename( $_FILES['uploaded']['name']) ; 
	//copy ($_FILES['uploaded']['tmp_name'], "../upload/".$target);
	
	$ok=1; 

//This is our size condition 
if ($uploaded_size > 3500000) 
{ 
echo "Your file is too large.<br>"; 
$ok=0; 
} 

//This is our limit file type condition 
if ($uploaded_type =="text/php") 
{ 
echo "No PHP files<br>"; 
$ok=0; 
} 

//Here we check that $ok was not set to 0 by an error 
if ($ok==0) 
{ 
Echo "Sorry your file was not uploaded"; 
} 

//If everything is ok we try to upload it 
else 
{ 
$TrackDir=opendir("upload/"); 
while ($file = readdir($TrackDir)) { 

if ($file == "." || $file == "..") { } 
else {

	 
      //unlink('upload/'.$file);  
	  print "Another file uploaded";
      //print "<option value='$file'>$file</option>";
     
 }
 }
 
	copy ($_FILES['uploaded']['tmp_name'], "upload/".$target);
	
}
?>
<script language="Javascript">
	alert ("Your file Successfully uploaded.. ")
</script>


<meta HTTP-EQUIV="REFRESH" content="0 url=upload_csv.php">

<? 
}
?>
