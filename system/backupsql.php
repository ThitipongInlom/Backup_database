<?php

class BackupSql 
{
    public function Connect_mysql($config)
    {
        $conn = mysqli_connect($config['host'],$config['user'],$config['pass']);
        if (mysqli_connect_errno()) {
            echo 'Error';
        }else {
            $db_list = $conn->query('SHOW DATABASES');
            while( $row = mysqli_fetch_object($db_list)) {
                $New_config[] = array(
                                    'host' => $config['host'],
                                    'user' => $config['user'],
                                    'pass' => $config['pass'],
                                    'db'   => $row->Database
                                );
            }
            return $New_config;
        }
    }

    public function Backup_sql($config, $name_sql)
    {
        include_once(dirname(__DIR__).'../plugin/mysqldump-php/src/Ifsnop/Mysqldump/Mysqldump.php');
        $host = $config['host'];  
        $db   = $config['db'];
        $user = $config['user'];
        $pass = $config['pass'];
        $dump = new Ifsnop\Mysqldump\Mysqldump("mysql:host=$host;dbname=$db", "$user", "$pass");
        $dump->start("../flie_database/$name_sql.sql");
        return;
    }

    public function Backup_zip($name_sql, $name_zip)
    {
        $files_list = scandir('../flie_database');
        $zip = new ZipArchive();
        $zip->open("../flie_database/$name_zip.zip", ZipArchive::CREATE);
        foreach ($files_list as $file) {
            if ($file != '.' && $file != '..') {
                $path = dirname(__FILE__)."/flie_database/$file";
                $extension = pathinfo($path, PATHINFO_EXTENSION); 
                if ($extension == 'sql') {
                    $zip->addFile("../flie_database/$file", "$name_sql.sql");
                }
            }
        }
        $zip->close();
        return;
    }

    public function Backup_delete($name_sql)
    {
        unlink("../flie_database/$name_sql.sql");
        return;
    }

}