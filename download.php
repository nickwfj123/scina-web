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
            $("#navdownload").addClass("active");
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
            <li><a href="download.php">Download</a></li>
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
        <div class="content three_quarter first">
            <!-- ################################################################################################ -->
            <h1 id="description">Description</h1>
            <p>An automatic cell type detection and assignment algorithm for single cell RNA-Seq (scRNA-seq) and
                Cytof/FACS data. SCINA is capable of assigning cell type identities to a pool of cells profiled by
                scRNA-Seq or Cytof/FACS data with prior knowledge of signatures, such as genes and protein symbols that
                are highly or lowly expressed in each cell type. </p>
            <!-- ################################################################################################ -->
            <hr class="style14"/>
            <h1 id="usage">Usage</h1>
            <div class="code">
                <p>
                    install.packages(“SCINA”)<br>
                    load(system.file('extdata','example_expmat.RData', package = "SCINA"))<br>
                    load(system.file('extdata','example_signatures.RData', package = "SCINA"))<br>
                    exp=exp_test$exp_data<br>
                    results=SCINA(exp,signatures,max_iter=100,convergence_n=10,convergence_rate=0.99,sensitivity_cutoff=0.9)<br>
                    plotheat.SCINA(exp,results,signatures)
                </p>
            </div>
            <!-- ################################################################################################ -->
            <hr class="style14"/>
            <h1 id="arguments">Arguments</h1>
            <div>
                <table id="noborder">
                    <tbody>
                    <tr class="first">
                        <td>exp</td>
                        <td>A normalized expression matrix. Columns correspond to cells or samples, rows correspond to
                            genes or protein symbols.
                        </td>
                    </tr>
                    <tr class="second">
                        <td>signature</td>
                        <td>A list contains multiple signature vectors. Each signature vector represents prior knowledge
                            for one cell type, containing gene names or protein symbols.
                        </td>
                    </tr>
                    <tr class="first">
                        <td>max_iter</td>
                        <td>An integer > 0. Default is 100. Max iterations allowed for the EM algorithm.</td>
                    </tr>
                    <tr class="second">
                        <td>covergence_n</td>
                        <td>An integer > 0. Default is 10. Stop the EM algorithm if during the last n rounds of
                            iterations, cell type assignment keeps steady above the convergence_rate.
                        </td>
                    </tr>
                    <tr class="first">
                        <td>convergence_rate</td>
                        <td>A float between 0 and 1. Default is 0.99. Percentage of cells for which the type assignment
                            remains stable for the last n rounds.
                        </td>
                    </tr>
                    <tr class="second">
                        <td>sensitivity_cutoff</td>
                        <td>A float between 0 and 1. Default is 1. The cutoff to remove signatures whose cells types are
                            deemed as non-existent at all in the data by the SCINA algorithm.
                        </td>
                    </tr>
                    <tr class="first">
                        <td>rm_overlap</td>
                        <td>A binary value, default 1 (TRUE), denotes that shared symbols between signature lists will
                            be removed. If 0 (FALSE) then allows different cell types to share the same signatures.
                        </td>
                    </tr>
                    <tr class="second">
                        <td>allow_unknown</td>
                        <td>A binary value, default 1 (TRUE). If 0 (FALSE) then no cell will be assigned to the
                            'unknown' category.
                        </td>
                    </tr>
                    <tr class="first">
                        <td>results</td>
                        <td>An output object returned from SCINA.</td>
                    </tr>
                    </tbody>
                </table>
            </div>
            <!-- ################################################################################################ -->
            <hr class="style14"/>
            <h1 id="details">Details</h1>
            <p>
                For efficiency of data transfer and computation, the user is encouraged to upload the subset of the gene
                expression matrix that contains only the genes that appeared in the signature list.
            </p>
            <p>
                For any signature symbols, if the category is identified with symbol X's low expression level, please
                specify the symbol as 'low_X'.
            </p>
            <p>
                Details for 'low_X' (take scRNA-Seqs as an example):
            </p>
            <ul>
                <li>There are 4 cell types, the first one highly express one gene A, and the other three lowly
                    express the same gene. Then it is better to specify A as the high marker for cell type 1, but it is
                    not a good idea to specify A as the low expression marker for cell type 2,3,4.
                </li>
                <li>There are 4 cell types, the first one lowly express one gene A, and the other three highly
                    express the same gene. Then is it better to specify A as the low marker for cell type 1, but it is
                    not a good idea to specify A as the high expression marker for cell type 2,3,4.
                </li>
                <li>There are 4 cell types, the first one lowly express one gene A, the second and third one
                    moderately express gene A, and the last one highly express gene A. Then is it better to specify A as
                    the low marker for cell type 1, and as the high expression marker for cell type 4.
                </li>
                <li>
                    The same specification can be applied to protein markers in CyTOF data.
                </li>
            </ul>
            <p>Small sensitivity_cutoff leads to more signatures to be removed, and 1 denotes that no signature is
                removed.</p>
            <!-- ################################################################################################ -->
        </div>
        <!-- ################################################################################################ -->
        <!-- ################################################################################################ -->
        <div class="sidebar one_quarter">
            <!-- ################################################################################################ -->
            <h6>User Guide</h6>
            <nav class="sdb_holder">
                <ul>
                    <li><a href="#description">Description</a></li>
                    <li><a href="#usage">Usage</a></li>
                    <li><a href="#arguments">Arguments</a></li>
                    <li><a href="#details">Details</a></li>
                </ul>
            </nav>
            <!-- ################################################################################################ -->
            <br><br>
            <h6>Signatures used in <a href="#" target="_blank">paper</a></h6>
            <nav>
                <a href="download/signatures/Fig1b_kidney_signatures.csv" style="color: #4d8f03;">Fig. 1b: Immune cells in RCC patients</a>
                <a href="download/signatures/Fig1c_crimmunecells_signatures.csv" style="color: #4d8f03;">Fig. 1c: B cells, monocytes and NK cells</a>
                <a href="download/signatures/Fig1de_micelarcrimal_signatures.csv" style="color: #4d8f03;">Fig. 1d and e: Injured mouse lacrimal gland immune cells</a>
                <a href="download/signatures/Fig2_brain_signatures.csv" style="color: #4d8f03;">Fig. 2: Non-neuronal cells in human brain</a>
            </nav>
            <!-- ################################################################################################ -->
            <br><br>
            <div><a href="https://github.com/jcao89757/SCINA" target="_blank" class="btn"
                    style="width: 100%; text-align: center;">Link to Github</a></div>
            <br/>
            <div><a href="download/SCINA_1.0.0.tar.gz" class="btn" style="width: 100%; text-align: center;">Download
                    Package</a></div>
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