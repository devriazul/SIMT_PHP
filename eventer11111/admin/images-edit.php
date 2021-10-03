<?php
	include_once('eventer-config.php');
	include_once('session-check.php');
?>
<?php
	if (isset($_POST['id'])) {
		$imageID = $_POST['id'];
		$title = $_POST['title'];
		
		$query = "UPDATE eventer_images SET name='$title' WHERE id='$imageID'";
		$status = mysql_query($query);
		
		if ($status) {
			header("Location: images.php");
		}
	}
?>
<?php
	include_once('header.php');
	include_once('menu.php');
?>
<?php
	$imageID = $_GET['imageID'];
	$query = "SELECT * FROM eventer_images WHERE id='$imageID'";
	$recset = mysql_query($query);
	$row = mysql_fetch_assoc($recset);
?>
    
	<div id="content">
        <div class="content-header">
        	<h1 class="title">You are editing - <span style="color:#CF3B06"><?php echo $row['path']; ?></span></h1>
            <div class="add-new-item"><a href="images-add.php" class="header-action">Upload Images</a></div>
        </div>
        <form action="images-edit.php" method="post" enctype="multipart/form-data">
            <table class="rows">
                <tbody>
                    <tr class="row">
                        <td width="200">Title</td>
                        <td><input type="text" name="title" value="<?php echo $row['name']; ?>" class="textfield" /></td>
                    </tr>
                    <tr class="row">
                        <td>Thumbnail Preview</td>
                        <td class="topalign"><img src="timthumb.php?src=../images/<?php echo $row['path']; ?>&w=220&h=140" /></td>
                    </tr>
                    <tr class="row">
                        <td><input type="hidden" name="id" value="<?php echo $imageID; ?>" /></td>
                        <td><input type="submit" name="submit" value="Edit" class="button" /></td>
                    </tr>
                </tbody>
            </table>
        </form>
    </div>

<?php
	include_once('footer.php');
?>