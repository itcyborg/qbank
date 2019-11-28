<?php
    /**
     * Class Initialize
     * THis class is used to setup the platform
     * 1. Create the .config file
     * 2. Setup the initial values for the platform and save it to the config.ini
     * 3. Connect to the database and setup the migrations(tables and views)
     * 4. Create the default user
     */

    class Initialize
    {
        private static $install_log='system/install.json';
        private static $config='system/config.ini';
        public static function init()
        {
            $result=false;
            //check if install.json file exists
            if (file_exists(self::$install_log)){
                $file_contents=file_get_contents(self::$install_log);
                $result=$file_contents;
            }else{
                $config=self::initConfig();
                return json_decode(json_encode(
                    $config));
            }
            return $result;
        }
        
        private static function initConfig(){
            //check if the config file exists
            if (file_exists(self::$config)){
                $file_contents=parse_ini_file(self::$config);
                $result=$file_contents;
                return $result;
            }else{
                $myfile=fopen(self::$config,'w') or die('Unable to create the configuration file');
                $filecontents="[app]\nname = 'Integrated Learning System'\nurl = http://localhost\n\n
[database]
driver = mysql
host = 127.0.0.1
port = 3306
username = root
database = ils
password =
";
                fwrite($myfile, $filecontents);
                fclose($myfile);
            }
        }

        private static function migrate()
        {
            //check if the migration file exists
            //check if the database connection exists
            //check if the database connection works
            //run the migration
            //verify if the migrations have been successfully created
        }

        private static function seed()
        {
            //check if the default user exists
            //create a default user if there is none that exists
        }
    }