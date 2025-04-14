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
</head>
<body id="top">
<!-- ################################################################################################ -->
<!-- ################################################################################################ -->
<!-- ################################################################################################ -->
<?php include("header.php"); ?>
<!-- ################################################################################################ -->
<!-- ################################################################################################ -->
<!-- ################################################################################################ -->
<div class="wrapper bgded overlay" style="background-image:url('images/bg.jpg');">
    <div id="pageintro" class="hoc clear">
        <!-- ################################################################################################ -->
        <article>
            <h2 class="heading">SCINA: Automatic Cell Type Detection and Assignment for Single Cell RNA-Seq (ScRNA-seq)
                and Cytof/FACS Data</h2>
            <p></p>
            <footer><a class="btn" href="analysis.php">Online Analysis</a></footer>
        </article>
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
        <div class="group btmspace-80">
            <div>
                <p><a href="images/intro.jpg"><img src="images/intro.jpg"
                                                   style="float:left; width: 100%; padding: 15px;" alt="intro"/></a>Single cell
                    profiling techniques such as single cell sequencing and cytometry are powerful for comprehensive and
                    high-resolution characterization of the cellular heterogeneities observed in tumors, brain, and
                    other tissues. The identification and assignment of cell types from the pool of profiled cells is
                    the first step of data analysis involving scRNA-seq or cytometry data. To achieve this goal, we
                    developed the SCINA algorithm, short for Semi-supervised category identification and assignment.
                    SCINA is originally designed to assign cell types based on single cell RNA-seq data. However, SCINA
                    is also general and can be applied in other scenarios when data of similar format are available,
                    such as patient bulk tumor RNA-seq data. SCINA can be used online using this webserver and an
                    offline R package is also available (please see our download page).</p>
            </div>
        </div>
        <div class="group">
            <article class="one_third first"><i class="block btmspace-15 fa fa-4x fa-gears"></i>
                <p>SCINA leverages prior reference information and simultaneously performs cell type detection and
                    assignment for known cell types. </p>
            </article>
            <article class="one_third"><i class="block btmspace-15 fa fa-4x fa-search"></i>
                <p>SCINA is able to define novel unknown cell types, whose exact identities can be determined in
                    follow-up studies. </p>
            </article>
            <article class="one_third"><i class="block btmspace-15 fa fa-4x fa-chain"></i>
                <p>SCINA represents a “signature-to-category” approach, which is complementary to traditional
                    “category-to-signature” approaches like t-SNE and unsupervised clustering. </p>
            </article>
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
<script>
    $(document).ready(function () {
        $("#navhome").addClass("active");
    });
</script>
</body>
</html>