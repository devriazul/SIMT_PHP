<?  
function upload($tmp_name, $name){  
    // do not forget to control file type and size  
    copy($tmp_name, "uploads/" . $name);  
}  
include("PHPLiveX.php");  
$ajax = new PHPLiveX("upload");  
?>