<?php



define('DB_HOST', 'localhost');

define('DB_USER', 'root');

define('DB_PASS', '');

define('DB_NAME', 'clearnce');
define('BACKUP_DIR', 'backup');

$date = date('Y-m-d_H-i-s');
$backup_file = BACKUP_DIR . '/' . DB_NAME . '-' . $date . '.sql';
$command = "mysqldump --user=".DB_USER." --password=".DB_PASS." ".DB_NAME." > ".$backup_file;

system($command);
?>