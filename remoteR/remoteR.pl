#######################################################################################
## RemoteR framework
##  	a) Check new job in db; 
## 	b) read new job parameter from db; 
## 	c) call R analysis script; 
## 	d) save calculation results in db
## Author: Bo Yao, Shin-yi Lin, Danni Luo
## Date: 09/18/2017
##
## Record change history of this script here
## 1. add BepiTBR, Fangjiang Wu, 09/24/2021
## 2. add pMTnet, Fangjiang Wu, 10/22/2021
## 3. add dishet, Fangjiang Wu, 11/07/2022
## 4. add scina, Fangjiang Wu, 11/07/2022
#######################################################################################

#! /usr/bin/perl -w

use warnings;
use DBI;
use strict;


require "./utilities.pl";

my $STATUS_NEWJOB = 0;
my $STATUS_SUCCESS = 1;
my $STATUS_PROCESSING = 2;
my $STATUS_FAIL = 9;

# set the max number of R script processes in memory
# default value: 2

# get word directory
my $path = $ENV{'remoter_path'};
# get db config
my $db_host = $ENV{'remoter_host'};
my $db_username = $ENV{'remoter_usr'};
my $db_password = $ENV{'remoter_passwd'};
my $db_dbname = $ENV{'remoter_db'};

# connect to database
my $dbh = DBI->connect('DBI:mysql:' . $db_dbname . ';host=' . $db_host, $db_username, $db_password)
	           or die "Can't connect: " . DBI->errstr();

    if(!$dbh){
           die "failed to connect to MySQL database DBI->errstr()";
    }else{
           print("Connected to MySQL server successfully.\n");
    }

# Get jobid which has not been dealt with
my $sth1 = $dbh->prepare("SELECT JOBID, Analysis, Software FROM Jobs where status = ". $STATUS_NEWJOB ." order by CreateTime desc limit 1")
			or die("Prepare of SQL failed" . $dbh->errstr());
$sth1->execute();
my @result1 = $sth1->fetchrow_array();

$sth1->finish();
$dbh->disconnect();

# if no available job id is found in database, the perl code will stop
if($#result1 eq -1)
{
	exit;
}

my $jobid = $result1[0];
my $analysis = $result1[1];
my $software = $result1[2];
#print $software;

# software: BepiTBR -- start ----
if($software eq "bepi") {

    require "/home/dbai/html/bepitbr/bepi.pl";
    bepi($jobid);

}
# software: BepiTBR --- end ---


# software: pMTnet -- start ----
if($software eq "pMTnet") {

    require "/home/dbai/html/pmtnet/pMTnet.pl";
    pMTnet($jobid);

}
# software: pMTnet --- end ---


# software: dishet -- start ----
if($software eq "dishet" && $analysis eq "dishet") {

    require "/home/dbai/remoteR/dishet/dishet.pl";
    dishet($jobid);

}
# software: dishet --- end ---


# software: scina -- start ----
if($software eq "scina") {

    require "/home/dbai/remoteR/scina/scina.pl";
    scina($jobid);

}
# software: scina --- end ---
