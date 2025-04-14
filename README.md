# SCINA: Semi-supervised Category Identification and Assignment

This document describes the required software and package to deploy the website, and details to modify the file paths and the database configuration file.

## Project Directory Structure
```
1. remoteR setting and related model
/home/user/remoteR
├── remoteR.pl
├── utility.pl
├── perl.log
├── scina
├── other models
└── ......

2. web portal folder
/home/user/html/scina


3. database setting folder
/var/www/dbincloc/scina.inc
```

## Model Installation
You can download model and check out required dependencies at https://github.com/jcao89757/SCINA.

### R Package Version:
The followings are required R package.
1. library("gplots")
2. library("MASS")
3. library("preprocessCore")

## Website Installation:
The followings are the steps to install the website.

### File Copy and Movement
1. Copy ``scina/`` folder into  ``/var/www/html``. Remove 'README.md', 'db_config_file(to_be_deleted)', 'db_script(be_be_deleted)'
2. Move ``db_config_file(to_be_deleted)/dbdishet.inc`` into ``/var/www/dbincloc/``.

### Database Configuration
+ Change database configuration file ``dbincloc/scina.inc``. The explanation of the database connection parameters are as following:
    ```
    $hostname: database ip address
    $usr: database user account
    $pwd: database user password
    $dbname: website database name
    ```

### Data Import
 Import `db_script(be_be_deleted)/scina.sql.txt` into database RemoteR.

## remoteR Settings
1. open 'remoteR' folder and check the file 'remoteR.pl' to confirm if 'scina' is added and path is correct.
if not, add the following codes at the end of file:
```
if($software eq "scina") {
    require "your_path_to_scina.pl";
    pMTnet($jobid);
}
```

2. Open crontab edit file with the command.
```
crontab -e
```

3. Add the following codes at the end of file, which means ``remoteR.pl`` will be executed every 3 seconds.

```
remoter_path=your_path_to_remoteR_folder //example: /home/hostname/remoteR
remoter_host=your_db_ip_address 
remoter_usr=your_db_username
remoter_passwd=your_db_password
remoter_db=your_db_name

* * * * * cd $remoter_path; perl remoteR.pl
* * * * * sleep 3; cd $remoter_path; perl remoteR.pl
* * * * * sleep 6; cd $remoter_path; perl remoteR.pl
* * * * * sleep 9; cd $remoter_path; perl remoteR.pl
* * * * * sleep 12; cd $remoter_path; perl remoteR.pl
* * * * * sleep 15; cd $remoter_path; perl remoteR.pl
* * * * * sleep 18; cd $remoter_path; perl remoteR.pl
* * * * * sleep 21; cd $remoter_path; perl remoteR.pl
* * * * * sleep 24; cd $remoter_path; perl remoteR.pl
* * * * * sleep 27; cd $remoter_path; perl remoteR.pl
* * * * * sleep 30; cd $remoter_path; perl remoteR.pl
* * * * * sleep 33; cd $remoter_path; perl remoteR.pl
* * * * * sleep 36; cd $remoter_path; perl remoteR.pl
* * * * * sleep 39; cd $remoter_path; perl remoteR.pl
* * * * * sleep 42; cd $remoter_path; perl remoteR.pl
* * * * * sleep 45; cd $remoter_path; perl remoteR.pl
* * * * * sleep 48; cd $remoter_path; perl remoteR.pl
* * * * * sleep 51; cd $remoter_path; perl remoteR.pl
* * * * * sleep 54; cd $remoter_path; perl remoteR.pl
* * * * * sleep 57; cd $remoter_path; perl remoteR.pl
```