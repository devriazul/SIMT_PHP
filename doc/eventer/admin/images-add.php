<?php
	include_once('eventer-config.php');
	include_once('session-check.php');
?>
<?php
	if (isset($_POST['title'])) {
		$parentID = $_POST['parent_page'];
		$title = $_POST['title'];
		$description = $_POST['description'];
		$imageIDs = $_POST['images'];
		$images;
		
		$imgCounter = 0;
		foreach($imageIDs as $key => $imageID) {
			if (++$imgCounter < count($imageIDs)) {
				$images .= $imageID . ",";
			}
			else {
				$images .= $imageID;
			}
		}
		
		$query = "INSERT INTO eventer_images(`parent_id`, `title`, `description`, `images`) VALUES('$parentID', '$title', '$description', '$images')";
		$status = mysql_query($query);
		
		if ($status) {
			header("Location: images.php");
			exit();
		}
	}
?>
<?php
	include_once('header.php');
	include_once('menu.php');
?>
    
	<div id="content">
        <div class="content-header">
            <h1 class="title">Upload Images</h1>
        </div>
        <table class="rows">
            <tbody>
                <tr class="row">
                    <td width="100%">
                        <div id="swfupload-control">
                            <p>Upload upto 10 image files(jpg, png, gif), each having maximum size of 2MB(Use Ctrl/Shift to select multiple files)</p>
                            <input type="button" id="button" />
                            <p id="queuestatus" ></p>
                            <ol id="log"></ol>
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>

<?php
	include_once('footer.php');
?>