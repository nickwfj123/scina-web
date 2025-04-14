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
        function timedRefresh(timeoutPeriod) {
            setTimeout("location.reload(true);", timeoutPeriod);
        }

        $(document).ready(function () {
            $("#navanalysis").addClass("active");
        });
    </script>
</head>
<?php
    include("testInput.inc");

    $jobid = "";
    $maxiteration = "";
    $convergence = "";
    $convergencerate = "";
    $sensitivitycutoff = "";
    $rmoverlap = "";
    $allowunknown = "";

    if (isset($_GET['jobid'])) {
        $jobid = testInput::escape($_GET["jobid"]);
    }

    if(!empty($jobid))
    {
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
        }

        if ($result = $db->prepare("SELECT Status FROM Jobs WHERE JobID = ?;")) {
            $result->bind_param("s", $jobid);
            $result->execute();
            $result->store_result();
            $result->bind_result($status);
            $result->fetch();

            if ($result->num_rows > 0) {
                if ($status == "1" || $status == "9") {
                    echo "<script>location.href='result.php?jobid=" . $jobid . "'</script>";
                } else {
                    echo "<body id=\"top\" onload='timedRefresh(5000);'>\n";
                }
            } else {
                echo "<body id=\"top\">\n";
                echo "<script>location.href='./error.php?errorid=2'</script>";  //error 2: Job ID is not found
            }

            $result->close();
        } else {
            echo "<body>\n";
            echo "<script>location.href='./error.php?errorid=3'</script>";      //error 3: Database connection failed
        }

        $db->close();
    }
    else
    {
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
    <!-- ################################################################################################ -->
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
            <tr style="border: none;"><td style="border: none;">Expression Matrix</td><td style="border: none;"><a href="downloadexpmat.php?jobid=<?php echo $jobid;?>">View</a><br></tr>
            <tr style="border: none;"><td style="border: none;">Signatures</td><td style="border: none;"><a href="downloadsign.php?jobid=<?php echo $jobid;?>">View</a><br></tr>
            <tr style="border: none;"><td style="border: none;">Max Iteration</td><td style="border: none;"><?php echo $maxiteration;?></td></tr>
            <tr style="border: none;"><td style="border: none;">Convergence</td><td style="border: none;"><?php echo $convergence;?></td></tr>
            <tr style="border: none;"><td style="border: none;">Convergence Rate</td><td style="border: none;"><?php echo $convergencerate;?></td></tr>
            <tr style="border: none;"><td style="border: none;">Sensitivity Cutoff</td><td style="border: none;"><?php echo $sensitivitycutoff;?></td></tr>
            <tr style="border: none;"><td style="border: none;">RM Overlap</td><td style="border: none;"><?php echo ($rmoverlap == "1")?"True":"False";?></td></tr>
            <tr style="border: none;"><td style="border: none;">Allow Unknown</td><td style="border: none;"><?php echo ($allowunknown == "1")?"Yes":"No";?></td></tr>
          </table>
        <br>
        </address>
      </div>
      <!-- ################################################################################################ -->
    </div>
    <!-- ################################################################################################ -->
    <!-- ################################################################################################ -->
    <div class="content three_quarter"> 
      <!-- ################################################################################################ -->
      <h1>Your job is running now!</h1>
      <hr class="style14" />
      <div class="center"><img src="images/waiting.gif" /></div>
      <br><br>
        <p>Your job has been put into our job list. Usually your job execution needs <mark>1 - 10 minutes</mark>.</p>
        <p>If you provide the correct email address, you may go to your email to find the link below which helps you to get the result later.<br>
        <a href="http://lce.biohpc.swmed.edu/scina/waiting.php?jobid=<?php echo $jobid;?>">http://lce.biohpc.swmed.edu/scina/waiting.php?jobid=<?php echo $jobid;?></a>
        </p>
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