<?php
	include_once('eventer-config.php');
	include_once('session-check.php');
?>
<?php
	if (isset($_GET['eventID'])) {
		$eventID = $_GET['eventID'];
		
		$query = "DELETE FROM eventer_events WHERE id='$eventID'";
		$status = mysql_query($query);
	}
?>
<?php
	include_once('header.php');
	include_once('menu.php');
?>
<?php
	if (isset($_GET['page'])) {
		$currentPage = $_GET['page'] - 1;
	}
	else {
		$currentPage = 0;
	}
	
	$recset = mysql_query("SELECT events_per_page FROM eventer_admin");
	
	$row = mysql_fetch_assoc($recset);
	$perPageLimit = $row['events_per_page'];
	
	$offset = $currentPage * $perPageLimit;
	
	$recset = mysql_query("SELECT count(id) as eventsCount FROM eventer_events");
	$row = mysql_fetch_assoc($recset);
	$numPages = ceil($row['eventsCount'] / $perPageLimit);
	
	if ($currentPage < 0 || $currentPage > $numPages - 1) {
		$numPages = 0;
	}
	
	$query = "SELECT id, title FROM eventer_events ORDER BY id ASC LIMIT $offset, $perPageLimit";
	$recset = mysql_query($query);
	
	$currentPage++;
?>
    
	<div id="content">
        <div class="content-header">
        	<h1 class="title">Events</h1>
            <div class="add-new-item"><a href="event-add.php" class="header-action add-action">Add Event</a></div>
        </div>
        <table class="rows">
            <thead>
                <tr class="row table-header">
                    <td>Title</td>
                    <td class="action_column center" width="50">Details</td>
                    <td class="action_column center" width="50">Edit</td>
                    <td class="action_column center" width="50">Delete</td>
                </tr>
            </thead>
            <tbody>
            	<?php $counter=0;
					while ($row = mysql_fetch_assoc($recset)) {
						$eventID = $row['id'];
				?>
                <tr class="row">
                    <td class="cell"><?php echo $row['title']; ?></td>
                    <td class="action_column center"><a href="#" id="<?php echo $eventID; ?>" class="view-details-btn"><img src="images/details_icon.png" width="16" height="16" alt="" border="0" /></a></td>
                    <td class="cell center"><a href="event-edit.php?eventID=<?php echo $eventID; ?>"><img src="images/edit_icon.png" width="16" height="16" alt="" border="0" /></a></td>
                    <td class="cell center"><a href="events.php?eventID=<?php echo $eventID; ?>"  onclick="return confirmDelete('Event')"><img src="images/trash_icon.png" width="16" height="16" alt="" border="0" /></a></td>
                </tr>
                <?php
						$counter++;
					}
				?>
            </tbody>
            <tfoot>
            	<tr class="row">
                    <td colspan="4">
                    	<span>Page <?php echo $currentPage; ?> of <?php echo $numPages; ?></span>
						<?php
                        	if ($currentPage > 1) {
						?>
                        <span><a href="events.php?page=<?php echo $currentPage - 1; ?>">Previous Page</a></span>
                        <?php
							}
						?>
                        <?php
                        	if ($currentPage < $numPages) {
						?>
                        <span style="border-right: 0pt none; margin-right: 0pt; padding-right: 0pt;"><a href="events.php?page=<?php echo $currentPage + 1; ?>">Next Page</a></span>
                        <?php
							}
						?>
					</td>
                </tr>
            </tfoot>
        </table>
    </div>

<?php
	include_once('footer.php');
?>