<?php
	include_once('eventer-config.php');
	include_once('session-check.php');
?>
<?php
	if (isset($_GET['imageID'])) {
		$imageID = $_GET['imageID'];
		
		$query = "DELETE FROM eventer_images WHERE id='$imageID'";
		$status = mysql_query($query);
	}
?>
<?php
	include_once('header.php');
	include_once('menu.php');
?>
<?php
	$query = "SELECT * FROM eventer_images ORDER BY id";
	$recset = mysql_query($query);
?>
	
	<div id="content">
        <div class="content-header">
            <div class="add-new-item"><a href="images-add.php" class="header-action">Upload Images</a></div>
        </div>
        <ul class="grid">
        	<?php
				while ($row = mysql_fetch_assoc($recset)) {
					$imageID = $row['id'];
			?>
        		<li class="grid-item">
                	<div class="image-wrapper"><img src="timthumb.php?src=../images/<?php echo $row['path']; ?>&w=220&h=140" /></div>
                    <div class="panel">
                    	<?php
                        	if (strlen($row['name']) == 0) {
						?>
                        	<a href="images-edit.php?imageID=<?php echo $imageID; ?>">Click to Add Image Title</a>
                        <?php
							}
							else {
						?>
                        <p class="image-name"><?php echo $row['name']; ?></p>
                        <?php
							}
						?>
						<div class="buttons"><a href="images.php?imageID=<?php echo $imageID; ?>" onclick="return confirmDelete('Image')"><img src="" />Delete</a> <a href="#"><img src="" /><!--Download--></a></div>
					</div>
				</li>
			<?php
				}
			?>
        </ul>
    </div>

<?php
	include_once('footer.php');
?>