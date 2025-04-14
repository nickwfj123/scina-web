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
      <li><a href="#">Error</a></li>
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
      <h3>Opps: Something Wrong with Job Execution</h3>
    <!-- ################################################################################################ -->
    <hr />
    <p style="color:#ff0000;">
        <?php
            include "testInput.inc";

            $errorid = "";
            if(isset($_GET["errorid"]))
            {
                $errorid = testInput::escape($_GET["errorid"]);
            }

            switch($errorid)
            {
                case "1":
                    echo "Empty Job ID. Please re-submit your job.";
                    break;
                case "2":
                    echo "Your Job ID is not found in our server. Please re-submit your job.";
                    break;
                case "3":
                    echo "Database connection failed. Please re-submit your job later.";
                    break;
                default:
                    echo "Unexpected error. Please re-submit your job";
            }
        ?>
    </p>
    <!-- ################################################################################################ -->
    <!-- / main body -->
    <div class="clear"></div>
    <div><a class="btn" href="analysis.php">Resubmit Your Job</a></div>
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