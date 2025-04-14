<!DOCTYPE html>
<html lang="en">
<head>
    <title>SCINA: Semi-supervised Category Identification and Assignment | single cell r package | cell clustering tools
        | deconvolution software</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <meta name="keywords"
          content="cell typing, single cell r, cell clustering tools, deconvolution software, single cell pepline, biomarkers, raw count tools, cell dissection, cell profiling, cell type assignment"/>
    <meta name="description"
          content="cell typing, single cell r, cell clustering tools, deconvolution software, single cell pepline, biomarkers, raw count tools, cell dissection, cell profiling, cell type assignment"/>
    <meta name="google"
          content="cell typing, single cell r, cell clustering tools, deconvolution software, single cell pepline, biomarkers, raw count tools, cell dissection, cell profiling, cell type assignment"/>
    <link href="css/style.css" rel="stylesheet" type="text/css" media="all">
    <!-- JAVASCRIPTS -->
    <script src="js/jquery.min.js"></script>
    <script src="js/jquery.backtotop.js"></script>
    <script src="js/jquery.mobilemenu.js"></script>
    <script>
        $(document).ready(function () {
            $("#navanalysis").addClass("active");
        });
    </script>
</head>
<body id="top">
<?php
include("testInput.inc");

$jobid = "";
$maxiteration = "";
$convergence = "";
$convergencerate = "";
$sensitivitycutoff = "";
$rmoverlap = "";
$allowunknown = "";
$status = "";

if (isset($_GET['jobid'])) {
    $jobid = testInput::escape($_GET["jobid"]);
}

if (!empty($jobid)) {
    include "/var/www/dbincloc/scina.inc";
    // open the database connection
    $db = new mysqli($hostname, $usr, $pwd, $dbname);
    if ($db->connect_error) {
        die('Unable to connect to database: ' . $db->connect_error);
    }

    if ($result = $db->prepare("SELECT MaxIteration, Convergence, ConvergenceRate, SensitivityCutoff, RMOverlap, AllowUnknown FROM SCINAParameters WHERE JOBID = ?;")) {
        $result->bind_param("s", $jobid);
        $result->execute();
        $result->store_result();
        $result->bind_result($maxiteration, $convergence, $convergencerate, $sensitivitycutoff, $rmoverlap, $allowunknown);
        $result->fetch();

        $result->close();
    } else {
        echo "<script>location.href='./error.php?errorid=3'</script>";   //error 3: Database connection failed
    }

    if ($result = $db->prepare("SELECT Status FROM Jobs WHERE JobID = ?;")) {
        $result->bind_param("s", $jobid);
        $result->execute();
        $result->store_result();
        $result->bind_result($status);
        $result->fetch();

        if ($result->num_rows == 0) {
            echo "<body id=\"top\">\n";
            echo "<script>location.href='./error.php?errorid=2'</script>";  //error 2: Job ID is not found
        }

        $result->close();
    } else {
        echo "<body>\n";
        echo "<script>location.href='./error.php?errorid=3'</script>";      //error 3: Database connection failed
    }
    
    $db->close();
} else {
    echo "<script>location.href='./error.php?errorid=1'</script>";  //error 1: Jobid empty
}
?>
<!-- ################################################################################################ -->
<!-- ################################################################################################ -->
<!-- ################################################################################################ -->
<?php include("header.php"); ?>
<!-- ################################################################################################ -->
<!-- ################################################################################################ -->
<!-- ################################################################################################ -->
<div class="wrapper row2">
    <div id="breadcrumb" class="hoc clear">
        <!-- ################################################################################################ -->
        <ul>
            <li><a href="index.php">Home</a></li>
            <li><a href="analysis.php">Analysis</a></li>
            <li><a href="#">Results</a></li>
        </ul>
        <!-- ##################################Signatures############################################################## -->
    </div>
</div>
<!-- ################################################################################################ -->
<!-- ################################################################################################ -->
<!-- ################################################################################################ -->
<div class="wrapper row3">
    <main class="hoc container clear">
        <!-- main body -->
        <!-- ################################################################################################ -->
        <div class="sidebar one_quarter first">
            <!-- ################################################################################################ -->
            <div class="sdb_holder">
                <h6>Your Inputs</h6>
                <address>
                    <table style="border: none; border-spacing: 0; border-collapse: collapse;">
                        <tr style="border: none;">
                            <td style="border: none;">Expression Matrix</td>
                            <td style="border: none;"><a
                                    href="downloadexpmat.php?jobid=<?php echo $jobid; ?>">View</a><br>
                        </tr>
                        <tr style="border: none;">
                            <td style="border: none;">Signatures</td>
                            <td style="border: none;"><a
                                    href="downloadsign.php?jobid=<?php echo $jobid; ?>">View</a><br>
                        </tr>
                        <tr style="border: none;">
                            <td style="border: none;">Max Iteration</td>
                            <td style="border: none;"><?php echo $maxiteration; ?></td>
                        </tr>
                        <tr style="border: none;">
                            <td style="border: none;">Convergence</td>
                            <td style="border: none;"><?php echo $convergence; ?></td>
                        </tr>
                        <tr style="border: none;">
                            <td style="border: none;">Convergence Rate</td>
                            <td style="border: none;"><?php echo $convergencerate; ?></td>
                        </tr>
                        <tr style="border: none;">
                            <td style="border: none;">Sensitivity Cutoff</td>
                            <td style="border: none;"><?php echo $sensitivitycutoff; ?></td>
                        </tr>
                        <tr style="border: none;">
                            <td style="border: none;">RM Overlap</td>
                            <td style="border: none;"><?php echo ($rmoverlap == "1") ? "True" : "False"; ?></td>
                        </tr>
                        <tr style="border: none;">
                            <td style="border: none;">Allow Unknown</td>
                            <td style="border: none;"><?php echo ($allowunknown == "1") ? "Yes" : "No"; ?></td>
                        </tr>
                    </table>
                    <br>
                </address>
            </div>
            <div class="sdb_holder">
                <article>
                    <h6>Download Results</h6>
                    <?php
                    if ($status == "1") {
                        echo "<p class=\"more\"><a href=\"downloadrdata.php?jobid=$jobid\">Results.RData</a></p>";
                    } else {
                        echo "<p class=\"more\">No Result</p>";
                    }
                    ?>
                </article>
            </div>
            <br>
            <div class="sdb_holder">
                <article>
                    <h6>Execution Log</h6>
                    <p class="more"><a href="viewlog.php?jobid=<?php echo $jobid; ?>">View Log</a></p>
                </article>
            </div>
            <!-- ################################################################################################ -->
        </div>
        <!-- ################################################################################################ -->
        <!-- ################################################################################################ -->
        <div class="content three_quarter">
            <!-- ################################################################################################ -->
            <?php
            if ($status == "1") {
                echo "<h1>Success: Your Job is Completed</h1>";
            } else {
                echo "<h1>Job Failed: please read the log or re-submit your job</h1>";
            }
            ?>
            <hr class="style14"/>
            <strong>Result</strong>
            <br>
            <p>If the uploaded expression matrix has over 500 cells, the figure will not be displayed. Please refer to the .RData output for the full result. </p>
            <br><br>
            <?php
            if ($status == "1") {
                echo "<a href=\"showheatmap.php?jobid=$jobid\" target=\"_blank\"><img class=\"imgr borderedbox inspace-5\" src=\"showheatmap.php?jobid=$jobid\" alt=\"\"></a>";
            }
            ?>
            <!-- ################################################################################################ -->
        </div>
        <!-- ################################################################################################ -->
        <!-- / main body -->
        <div class="clear"></div>
    </main>
</div>
<!-- ################################################################################################ -->
<!-- ################################################################################################ -->
<!-- ################################################################################################ -->
<?php include("footer.php"); ?>
<!-- ################################################################################################ -->
<!-- ################################################################################################ -->
<!-- ################################################################################################ -->
<a id="backtotop" href="#top"><i class="fa fa-chevron-up"></i></a>
</body>
</html>