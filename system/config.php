<?php
include 'backupsql.php';

$host = "localhost";
$user = "root";
$pass = "";
$db   = "vocher";

BackUp_DB($host, $user, $pass, $db);
BackUp_DB($host, $user, $pass, 'lost_and_found');
BackUp_DB($host, $user, $pass, 'fitness');

function BackUp_DB($host, $user, $pass, $db)
{
    $config = array('host' => $host, 'user' => $user, 'pass' => $pass, 'db'   => $db);
    $name_sql = date('d-m-Y')."_$db";
    $name_zip = date('d-m-Y')."_BackUP";
    BackupSql::Backup_sql($config, $name_sql);
    BackupSql::Backup_zip($name_sql, $name_zip);
    BackupSql::Backup_delete($name_sql);
}