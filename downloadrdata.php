<?php
include "/var/www/dbincloc/scina.inc";
include "testInput.inc";

//open the database connection
$db = new mysqli($hostname, $usr, $pwd, $dbname);
if ($db->connect_error) {
    die('Unable to connect to database: ' . $db->connect_error);
}

$jobid = "";
if (isset($_GET['jobid'])) {
    $jobid = testInput::escape($_GET["jobid"]);
}

header("Content-Disposition: attachment; filename=results.RData");

if (!empty($jobid) && $result = $db->prepare("select RData from SCINAResults where JobID = ?")) {
    $result->bind_param("s", $jobid);
    $result->execute();
    $result->store_result();
    $result->bind_result($resultFile);
    $result->fetch();
    echo $resultFile;
    $result->close();
}

$db->close();
?>