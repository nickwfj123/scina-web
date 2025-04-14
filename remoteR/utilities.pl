################################################################################
## Common functions for RemoteR
## Should be included in runremoter.pl and all other pm files
## Author: Shin-yi Lin, Danni Luo, Bo Yao
## Date: 09/18/2017

## Caution: Any change history of script should be recorded here.
################################################################################


#! /usr/bin/perl -w

use warnings;
use DBI;
use strict;

# get word directory
my $path = $ENV{'remoter_path'};
# get db config
my $db_host = $ENV{'remoter_host'};
my $db_username = $ENV{'remoter_usr'};
my $db_password = $ENV{'remoter_passwd'};
my $db_dbname = $ENV{'remoter_db'};


# check whether the number of R script processes running reaches the maximum number

# Change the job/process running status in database
sub changestatus
{
    my($jobid,$status)=@_;

    # connect to database
    my $dbh = DBI->connect('DBI:mysql:' . $db_dbname . ';host=' . $db_host, $db_username, $db_password)
			or die "Can't connect: " . DBI->errstr();
			
    if(!$dbh){
           die "failed to connect to MySQL database DBI->errstr()";
    }else{
           print("status changed successfully!\n");
    }

    my $sth = $dbh->prepare("UPDATE Jobs SET Status=".$status." WHERE JOBID='".$jobid."'")
    			or die("Prepare of SQL failed" . $dbh->errstr());
    			
    $sth->execute();
    $sth->finish();
    $dbh->disconnect();
}

# Remove whitespace from the start and end of the string
sub trim($)
{
	my $string = shift;
	$string =~ s/^\s+//;
	$string =~ s/\s+$//;
	return $string;
}

#changestatus('610c26ffbca893.44377442', 0);

return 1;
