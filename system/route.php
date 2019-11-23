<?php
include 'backupsql.php';
include 'server/settingpath.php';

if ($_GET['action'] == 'path_file_zip') {
    echo SettingPath::Path_File_Zip();
}

if ($_GET['action'] == 'backup') {
    $config = array('host' => $_POST['host'], 'user' => $_POST['username'], 'pass' => $_POST['password']);
    $New_config = BackupSql::Connect_mysql($config);
    foreach ($New_config as $key => $row) {
        $db = $row['db'];
        $host = $row['host'];
        $name_sql = date('d-m-Y')."_$db";
        $name_zip = date('d-m-Y')."_BackUP_".$host;
        BackupSql::Backup_sql($row, $name_sql);
        BackupSql::Backup_zip($name_sql, $name_zip);
        BackupSql::Backup_delete($name_sql);
    }

    echo json_encode(array('status' => 'success'));
    
}