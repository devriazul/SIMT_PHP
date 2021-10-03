	<?php
		include('db_backup_library.php');
		$dbbackup = new db_backup;
		$dbbackup->connect("localhost","root","root","simtdb");
		$dbbackup->backup();
		$dbbackup->download();
	?>
	