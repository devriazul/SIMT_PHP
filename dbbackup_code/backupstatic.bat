cd "E:\xampp\mysql\bin"

mysqldump -hlocalhost -uroot -proot simtdb > "D:\xampp\htdocs\simt\dbbackup_code\backup_database\AutoBackUp\simtdb_Backup%date:~-4,4%%date:~-10,2%%date:~-7,2%_%time:~0,2%%time:~3,2%%time:~6,2%.sql"