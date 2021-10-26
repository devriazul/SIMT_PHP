    <? 
	function upload($tmp_name, $name){  
    // do not forget to control file type and size  
    copy($tmp_name, "uploads/" . $name);  
}  
include("PHPLiveX.php");  
$ajax = new PHPLiveX("upload");  

	$ajax->Run(); ?>  
    <div style="float:left;"><input type="file" id="photo" name="photo"></div>  
    <div id="percent" style="float:left;">% 0</div>  


    <script type="text/javascript">  
    PLX.AjaxifyUpload("photo", {  
        tmp_dir: "tmp",  
        cgi_path: "upload.cgi",  
        onProgress: function(progress){  
            document.getElementById("percent").innerHTML = "% " + progress.percent;  
            if(progress.completed)  
                upload(progress.file_tmp_name, progress.file_name, {});  
        }  
    });  
    </script>  