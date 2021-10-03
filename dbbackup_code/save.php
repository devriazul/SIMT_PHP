	<?php
		include('db_backup_library.php');
		$dbbackup = new db_backup;
		$dbbackup->connect("localhost","root","root","simtdb");
		$dbbackup->backup();
		if($dbbackup->save("backup_database/")){
			echo "Backup Saved Successfully";
			header('Refresh:2; url= ../submitstudentmarksec.php');
		}
		
		
	?>
	