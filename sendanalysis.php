<?php

function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

$expmatrixname = "";
$signname = "";
$acceptedFileType = array("text/csv", "txt/csv", "text/plain", "txt/plain", "application/vnd.ms-excel");       //plain text file
$fileSizeLimit = 10000000;               // file size no larger than 10M


// --------------------------------- expression matrix file --------------------------------- //
if ($_FILES["expre_matrix"]["size"] > 0) {
    $expmatrixname = $_FILES['expre_matrix']['tmp_name'];
    $fileSize = $_FILES['expre_matrix']['size'];
    $fileType = $_FILES['expre_matrix']['type'];

    $isFileSizeNotGood = 0;
    $isFileTypeNotGood = 0;

    // check sample data file type
    if (!in_array($fileType, $acceptedFileType)) {
        $isFileTypeNotGood = 1;
    }
    //check file size
    if ($fileSize > $fileSizeLimit) {
        $isFileSizeNotGood = 1;
    }
    if ($isFileSizeNotGood == 1 || $isFileTypeNotGood == 1) {
        echo "<script>location.href='analysis.php?isFileTypeNotGood=$isFileTypeNotGood&isFileSizeNotGood=$isFileSizeNotGood'</script>";
    }
}


// --------------------------------- signatures file ---------------------------------- //
if ($_FILES["signatures"]["size"] > 0) {
    $signname = $_FILES['signatures']['tmp_name'];
    $signFileType = $_FILES['signatures']['type'];
    $signSize = $_FILES['signatures']['size'];

    // check dose data file type
    $isDoseFileTypeNotGood = 0;
    if (!in_array($signFileType, $acceptedFileType)) {
        $isDoseFileTypeNotGood = 1;
    }
    // check file size
    if ($signSize > $fileSizeLimit) {
        $isDoseFileSizeNotGood = 1;
    }

    if ($isDoseFileSizeNotGood == 1 || $isDoseFileTypeNotGood == 1) {
        echo "<script>location.href='analysis.php?isDoseFileTypeNotGood=$isDoseFileTypeNotGood&isDoseFileSizeNotGood=$isDoseFileSizeNotGood'</script>";
    }
}


// --------------------------------- user information ---------------------------------- //
// Check name organization and email
$isWrongName = 0;
$isWrongOrganization = 0;
$isWrongEmail = 0;

$username = "";
if ($_POST['youname'] != "") {
    $username = test_input($_POST['youname']);
    if (!preg_match("/^[a-zA-Z ]*$/",$username)) {
        $isWrongName = 1;
    }
}

$organization = "";
if ($_POST['organization'] != "") {
    $organization = test_input($_POST['organization']);
    if (!preg_match("/^[a-zA-Z0-9 ]*$/",$organization)) {
        $isWrongOrganization = 1;
    }
}

$email = "";
if ($_POST['youremail'] != "") {
    $email = test_input($_POST['youremail']);
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $isWrongEmail = 1;
    }
}

if ($isWrongName == 1 || $isWrongOrganization == 1 || $isWrongEmail == 1) {
    echo "<script>location.href='analysis.php?isWrongName=$isWrongName&isWrongOrganization=$isWrongOrganization&isWrongEmail=$isWrongEmail'</script>";
}


// --------------------------------- get user parameters ---------------------------------- //
$expressionInputs = "";
if($expmatrixname != "")$expressionInputs = file_get_contents($expmatrixname);

$convInputs = "";
if($signname != "")$convInputs = file_get_contents($signname);

$maxiteration = $_POST["max_iter"];
$convergence = $_POST["convergence"];
$convergence_rate = $_POST["convergence_rate"];
$sensitivity_cutoff = $_POST["sensitivity_cutoff"];
$rmoverlap = $_POST["overlap"];
$allowunknown = $_POST["allowunknown"];


// --------------------------------- insert to database ---------------------------------- //
include "/var/www/dbincloc/scina.inc";
// open the database connection
$db = new mysqli($hostname, $usr, $pwd, $dbname);
if ($db->connect_error) {
    die('Unable to connect to database: ' . $db->connect_error);
}

// read data
$jobid = uniqid("", TRUE);

$software = "scina";
$analysis = "scina";

$null = NULL;

// set job status as 0. 0 means new job, 1 means job success, 2 means job processing, 9 means job failed.
if ($result1 = $db->prepare("INSERT INTO Jobs (JobID, Status, Software, Analysis, CreateTime) VALUES (?, 0, ?, ?, now());")) {
    $result1->bind_param("sss", $jobid, $software, $analysis);
    $result1->execute();
    $result1->close();
}

if ($result2 = $db->prepare("INSERT INTO SCINAParameters(JobID, UserName, Organization, Email, ExpressionMatrix, Signatures, MaxIteration, Convergence, ConvergenceRate, SensitivityCutoff, RMOverlap, AllowUnknown) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?);")) {
    $result2->bind_param("ssssbbssssss", $jobid, $username, $organization, $email, $null, $null, $maxiteration, $convergence, $convergence_rate, $sensitivity_cutoff, $rmoverlap, $allowunknown);
    $result2 -> send_long_data(4, $expressionInputs);
    $result2 -> send_long_data(5, $convInputs);
    $result2->execute();
    $result2->close();
}

$db->close();
echo "<script>location.href='./waiting.php?jobid=" . $jobid . "'</script>";
?>
