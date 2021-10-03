<?php
	include_once('eventer-config.php');
	include_once('session-check.php');
?>
<?php
	if (isset($_POST['id'])) {
		$userID = $_POST['id'];
		$username = $_POST['username'];
		$email = $_POST['email'];
		$events_per_page = $_POST['events_per_page'];
		
		if (isset($_POST['password']) && !empty($_POST['password'])) {
			$password = crypt($_POST['password']);
			$query = "UPDATE eventer_admin SET username='$username', password='$password', email='$email', events_per_page='$events_per_page' WHERE id='$userID'";
		}
		else {
			$query = "UPDATE eventer_admin SET username='$username', email='$email', events_per_page='$events_per_page' WHERE id='$userID'";
		}
		
		$status = mysql_query($query) or die(mysql_error());
		
		if ($status) {
			//header("Location: pages.php");
		}
	}
?>
<?php
	include_once('header.php');
	include_once('menu.php');
?>
<?php
	$query = "SELECT * FROM eventer_admin LIMIT 1";
	$recset = mysql_query($query);
	$row = mysql_fetch_assoc($recset);
?>

	<div id="content">
    	<div class="content-header">
        	<h1 class="title">Admin Info</h1>
        </div>
        <form action="admin.php" method="post" enctype="multipart/form-data">
            <table class="rows">
                <tbody>
                    <tr class="row">
                        <td width="10%">Username</td>
                        <td width="90%"><input type="text" name="username" value="<?php echo $row['username']; ?>" /></td>
                    </tr>
                    <tr class="row">
                        <td>Password</td>
                        <td><input type="password" name="password" value="" /></td>
                    </tr>
                    <tr class="row">
                        <td>Email</td>
                        <td><input type="text" name="email" value="<?php echo $row['email']; ?>" /></td>
                    </tr>
                    <tr class="row">
                        <td>Events Per Page</td>
                        <td><input type="text" name="events_per_page" value="<?php echo $row['events_per_page']; ?>" /></td>
                    </tr>
                    <tr class="row">
                        <td><input type="hidden" name="id" value="<?php echo $row['id']; ?>" /></td>
                        <td><input type="submit" name="submit" value="Update" class="button" /></td>
                    </tr>
                </tbody>
            </table>
        </form>
    </div>

<?php
	include_once('footer.php');
?>