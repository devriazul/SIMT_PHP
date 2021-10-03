<?php
	
	if (isset($_POST['step'])) {
		$step = $_POST['step'];
		
		if ($step == 'step1') {
			if (isset($_POST['dbserver']) && isset($_POST['dbname']) && isset($_POST['dbusername']) or isset($_POST['dbpassword'])) {
				
				$config_filename = 'eventer-config.php';
				
				if ($fh = fopen($config_filename, 'w')) {
					$fileData = "<?php\n";
					$fileData .= '$server_link = mysql_connect("'.$_POST['dbserver'].'", "'.$_POST['dbusername'].'", "'.$_POST['dbpassword'].'") or die(mysql_error());';
					$fileData .= "\n";
					$fileData .= '$db_link = mysql_select_db("'.$_POST['dbname'].'") or die(mysql_error());';
					$fileData .= "\n?>";
					fwrite($fh, $fileData);
					fclose($fh);
					
					if (!copy($config_filename, '../'.$config_filename)) {
						
					}
					
					$server_link = mysql_connect($_POST['dbserver'], $_POST['dbusername'], $_POST['dbpassword']) or die(mysql_error());
					$db_link = mysql_select_db($_POST['dbname']) or die(mysql_error());
					
					$ems_admin_table_result = mysql_query("CREATE TABLE IF NOT EXISTS `eventer_admin` (
												  `id` int(11) NOT NULL auto_increment,
												  `username` varchar(50) NOT NULL,
												  `password` varchar(50) NOT NULL,
												  `email` varchar(100) NOT NULL,
												  `events_per_page` int(11) NOT NULL default '10',
												  `status` tinyint(4) NOT NULL default '1',
												  PRIMARY KEY  (`id`)
												)") or die(mysql_error());
					
					$ems_events_table_result = mysql_query("CREATE TABLE IF NOT EXISTS `eventer_events` (
														  `id` int(11) NOT NULL auto_increment,
														  `start_date` varchar(10) NOT NULL,
														  `end_date` varchar(10) NOT NULL,
														  `start_time` varchar(25) NOT NULL,
														  `end_time` varchar(25) NOT NULL,
														  `title` varchar(255) NOT NULL,
														  `description` text,
														  `venue` varchar(100) NOT NULL,
														  `link` varchar(255) NOT NULL,
														  `icon` varchar(100) NOT NULL,
														  `image` varchar(100) NOT NULL,
														  `image_alignment` varchar(6) NOT NULL default 'left',
														  `status` tinyint(4) NOT NULL default '1',
														  PRIMARY KEY  (`id`)
														)") or die(mysql_error());
					
					$ems_images_table_result = mysql_query("CREATE TABLE IF NOT EXISTS `eventer_images` (
														  `id` int(11) NOT NULL auto_increment,
														  `path` varchar(255) NOT NULL,
														  `name` varchar(100) NOT NULL,
														  PRIMARY KEY  (`id`)
														)") or die(mysql_error());
					
					$ems_options_table_result = mysql_query("CREATE TABLE IF NOT EXISTS `eventer_options` (
														  `id` int(11) NOT NULL auto_increment,
														  `display_mode` varchar(11) NOT NULL default 'interactive',
														  `tech_mode` varchar(4) NOT NULL default 'ajax',
														  `color_theme` varchar(5) NOT NULL default 'Light',
														  `date_box_width` int(11) NOT NULL default '136',
														  `date_box_height` int(11) NOT NULL default '91',
														  `date_box_horizontal_space` int(3) NOT NULL default '1',
														  `date_box_vertical_space` int(3) NOT NULL default '1',
														  `date_box_corner_radius` int(3) NOT NULL default '5',
														  `date_box_bg_color` varchar(6) NOT NULL default 'FFFFFF',
														  `empty_date_box_alpha` int(3) NOT NULL default '50',
														  `today_date_box_bg_color` varchar(6) NOT NULL default 'FFFFFF',
														  `date_format` varchar(3) NOT NULL default 'USA',
														  `starting_week_day` int(1) NOT NULL default '0',
														  `week_day_names_short` varchar(255) NOT NULL default 'Mon,Tue,Wed,Thu,Fri,Sat,Sun',
														  `week_day_names_long` varchar(255) NOT NULL default 'Monday,Tuesday,Wednesday,Thursday,Friday,Saturday,Sunday',
														  `week_day_names_format` varchar(5) NOT NULL default 'short',
														  `month_names_short` varchar(255) NOT NULL default 'Jan,Feb,Mar,Apr,May,Jun,Jul,Aug,Sep,Oct,Nov,Dec',
														  `month_names_long` varchar(255) NOT NULL default 'January,February,March,April,May,June,July,August,September,October,November,December',
														  `month_names_format` varchar(5) NOT NULL default 'long',
														  `show_months_navigation` tinyint(4) NOT NULL default '1',
														  `calendar_padding` int(3) NOT NULL default '10',
														  `calendar_background_width` varchar(5) NOT NULL default '100%',
														  `repeat_events` tinyint(4) NOT NULL default '1',
														  PRIMARY KEY  (`id`)
														)") or die(mysql_error());
					
					$options_insert_result = mysql_query("INSERT INTO `eventer_options` (`id`, `display_mode`, `tech_mode`, `color_theme`, `date_box_width`, `date_box_height`, `date_box_horizontal_space`, `date_box_vertical_space`, `date_box_corner_radius`, `date_box_bg_color`, `empty_date_box_alpha`, `today_date_box_bg_color`, `date_format`, `starting_week_day`, `week_day_names_short`, `week_day_names_long`, `week_day_names_format`, `month_names_short`, `month_names_long`, `month_names_format`, `show_months_navigation`, `calendar_padding`, `calendar_background_width`, `repeat_events`) VALUES (1, 'interactive', 'ajax', 'Dark', 136, 91, 1, 1, 5, 'FFFFFF', 50, 'FFFFFF', 'USA', 0, 'Mon,Tue,Wed,Thu,Fri,Sat,Sun', 'Monday,Tuesday,Wednesday,Thursday,Friday,Saturday,Sunday', 'long', 'Jan,Feb,Mar,Apr,May,Jun,Jul,Aug,Sep,Oct,Nov,Dec', 'January,February,March,April,May,June,July,August,September,October,November,December', 'short', 1, 10, '100%', 0)");
					
					if ($ems_admin_table_result && $ems_events_table_result && $ems_images_table_result && $ems_options_table_result) {
						$step = 'step2';
						$msg = 'Congratulations! database tables have been successfully created.';
					}
					else {
						$msg = 'Either one or all of the tables creation failed. Please make sure you have set the correct values in the config.php file and there are no existing tables with names eventer_admin, eventer_events, eventer_images and eventer_options.';
					}
				}
				else {
					$msg = '';
				}
			}
			else {
				$msg = 'Please fill out the form with the right values.';
			}
		}
		else {
			require_once('eventer-config.php');
			if (isset($_POST['username']) && isset($_POST['password'])) {
				$username = $_POST['username'];
				$password = crypt($_POST['password']);
				$result = mysql_query("INSERT INTO eventer_admin(`username`, `password`) VALUES('$username', '$password')");
				
				if ($result) {
					$step = 'step3';
					$msg = "Admin user $username has been successfully added. You should delete the install.php file from the admin folder asap.";
				}
				else {
					$msg = 'Something went wrong while adding admin user $username. Please try again.';
				}
			}
			else {
				$msg = 'Please fill out the form.';
			}
		}
	}
	else {
		$step = 'step1';
	}
?>

<!DOCTYPE HTML>
<html>
<head>
<meta charset="UTF-8">
<title>Eventer - Installation</title>

<link rel="stylesheet" href="style.css">

<script type="text/javascript" src="js/jquery-1.7.1.min.js"></script>
<script type="text/javascript" src="js/jquery.placeholder.min.js"></script>

<script type="text/javascript">
	
	$(document).ready(function() {
		$('input').placeholder();
		
		$('#install-btn').click(function(e) {
			e.preventDefault();
			$('#installation-form').submit();
        });
		
		$('#installation-form').submit(function(e) {
			isValid = true;
			
			if ($("#dbserver").val() == '' || $("#dbserver").val() == 'Database Server') {
				isValid = false;
				$("p.dbserver-error").text('please enter database server value');
				$("p.dbserver-error").slideDown(500);
			}
			else {
				$("p.dbserver-error").slideUp(500);
			}
			
			if ($("#dbname").val() == '' || $("#dbname").val() == 'Database Name') {
				isValid = false;
				$("p.dbname-error").text('please enter a database name');
				$("p.dbname-error").slideDown(500);
			}
			else {
				$("p.dbname-error").slideUp(500);
			}
			
			if ($("#dbusername").val() == '' || $("#dbusername").val() == 'Database Username') {
				isValid = false;
				$("p.dbusername-error").text('please enter a database username');
				$("p.dbusername-error").slideDown(500);
			}
			else {
				$("p.dbusername-error").slideUp(500);
			}
			
			/*if ($("#dbpassword").val() == '' || $("#dbpassword").val() == 'Database Password') {
				isValid = false;
				$("p.dbpassword-error").text('please enter a database password');
				$("p.dbpassword-error").slideDown(500);
			}
			else {
				$("p.dbpassword-error").slideUp(500);
			}*/
			
			/*if (isValid) {
				$("p.msg").slideUp(500);
			}*/
			
			return isValid;
        });
		
		$('#add-user-btn').click(function(e) {
			e.preventDefault();
			$('#admin-user-form').submit();
        });
		
		$('#admin-user-form').submit(function(e) {
			isValid = true;
			
			if ($("#username").val() == '' || $("#username").val() == 'Admin Username') {
				isValid = false;
				$("p.username-error").text('please enter a username');
				$("p.username-error").slideDown(500);
			}
			else {
				$("p.username-error").slideUp(500);
			}
			
			if ($("#password").val() == '' || $("#password").val() == 'Admin Password') {
				isValid = false;
				$("p.password-error").text('please enter a password');
				$("p.password-error").slideDown(500);
			}
			else {
				$("p.password-error").slideUp(500);
			}
			
			/*if (isValid) {
				$("p.msg").slideUp(500);
			}*/
			
			return isValid;
        });
		
	});
	
</script>

<style>
	
	div.header img {
		display:block;
		margin:50px auto;
	}
	
	#installation-form-wrapper {
		border-radius:5px;
		width:400px;
		margin:0 auto;
		padding:20px;
		overflow:hidden;
	}
	
	p {
		text-align:center;	
	}
	
	a {
		color:#cf3b06;
		text-decoration:none;
	}
	
	a:hover {
		text-decoration:underline;
	}
	
	h1 {
		font-size:36px;
		font-weight:bold;
		line-height:60px;
		text-align:center;
		color:#CF3B06;
		margin:15px 0 0 10px;
		text-shadow:1px 1px 1px #fff;
	}
	
	h2 {
		font-size:24px;
		line-height:60px;
		text-align:center;
		color:#636363;
		margin:15px 0 0 10px;
		text-shadow:1px 1px 1px #fff;
	}
	
	#installation-form {
		
	}
	
	p {
		margin:20px 0 0 0;
	}
	
	p.msg {
		margin:35px 0;
		padding:0 0 0 10px;
		color:#CF3B06;
		text-align:center;
	}
	
	p.error {
		display:none;
		margin:5px 0 0 0;
		padding:0 0 0 10px;
		color:#CF3B06;
	}
	
</style>
</head>

<body>
	<div id="installation-form-wrapper">
        <div class="header"><img src="images/eventer_installation.png" width="232" height="38" alt=""/></div>
        <?php
			if ($msg != '') {
		?>
        <p class="msg"><?php echo $msg; ?></p>
        <?php	
			}
		?>
		<?php
            if ($step == 'step1') {
        ?>
        <form id="installation-form" action="" method="post">
        	<p>
                <input type="text" name="dbserver" id="dbserver" value="" placeholder="Database Server" class="textfield" />
            </p>
            <p class="error dbserver-error"></p>
            <p>
                <input type="text" name="dbname" id="dbname" value="" placeholder="Database Name" class="textfield" />
            </p>
            <p class="error dbname-error"></p>
            <p>
                <input type="text" name="dbusername" id="dbusername" value="" placeholder="Database Username" class="textfield" />
            </p>
            <p class="error dbusername-error"></p>
            <p>
                <input type="text" id="dbpassword" name="dbpassword" value=""  class="textfield" />
            </p>
            <p class="error dbpassword-error"></p>
            <p>
            	<input type="hidden" name="step" value="step1" />
                <input type="submit" name="install-btn" id="install-btn" value="Install" class="btn" />
            </p>
        </form>
		<?php
            }
            else if ($step == 'step2') {
        ?>
        <p>In order to user the Eventer Admin panel you need login access. Fill out the following form to add an admin user.</p>
    	<form id="admin-user-form" action="" method="post">
        	<p>
                <input type="text" name="username" id="username" value="" placeholder="Admin Username" class="textfield" />
            </p>
            <p class="error username-error"></p>
            <p>
                <input type="text" name="password" id="password" value="" placeholder="Admin Password" class="textfield" />
            </p>
            <p class="error password-error"></p>
            <p>
            	<input type="hidden" name="step" value="step2" />
                <input type="submit" name="add-user-btn" id="add-user-btn" value="Add User" class="btn" />
            </p>
        </form>
		<?php
            }
            else if ($step == 'step3') {
        ?>
        <p><a href="index.php">Click here</a> to start adding events using Eventer Admin.</p>
		<?php
            }
        ?>
	</div>

</body>
</html>