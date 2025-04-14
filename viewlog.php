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

//Retrive Plot 1 picture
if (!empty($jobid) && $result = $db->prepare("select Log from SCINAResults where JobID = ?")) {
    $result->bind_param("s", $jobid);
    $result->execute();
    $result->store_result();
    $result->bind_result($resultgene);
    $result->fetch();
    if ($resultgene) {
        header('Content-Type: text/plain');
        header("Content-Disposition: attachment; filename=log.txt");
        header("Content-length: " . strlen($resultgene) . "\"");
        echo $resultgene;
    } else {
        header("location:error.php");
        exit;
    }

    $result->close();
}else{
    header("location:error.php");
    exit;
}

$db->close();
?>