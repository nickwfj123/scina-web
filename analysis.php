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
    <script src="js/jquery-1.7.1.min.js"></script>
    <script src="js/jquery.backtotop.js"></script>
    <script src="js/jquery.mobilemenu.js"></script>

    <!-- JAVASCRIPTS -->
    <script src="js/jquery.modal.js"></script>
    <link href="css/jquery.modal.css" rel="stylesheet" type="text/css">
    <script>
        $(document).ready(function () {
            $("#navanalysis").addClass("active");

            $("#convergence").attr({
                "max": $("#max_iter").val()
            });
        });

        function changeconvmax() {
            $("#convergence").attr({
                "max": $("#max_iter").val()
            });
        }
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
        <div class="content two_third first">
            <!-- ################################################################################################ -->
            <h1>SCINA on the cloud</h1>
            <p>SCINA is regarded as semi-supervised, as the prior knowledge of signature genes is built into the
                unsupervised estimation process. SCINA accepts a list of signature gene sets for a variety of cell
                types, and an expression matrix, which is assumed to have been pre-processed by the user with logarithm
                transformation and/or any appropriate method of normalization if needed. For each cell type, the
                signature can have one or more genes. The signature genes, by default, should be highly expressed in one
                particular cell type compared to all other cell types. Expression of genes that are characteristically
                lowly expressed in one cell type compared to the other cell types can be inverted so that the pseudo
                expression of this gene is high in that cell type. Overlap in gene signature between cell types is
                allowed but should be kept to a minimum. After SCINA analyzation, the group of cells without high
                expression of any of the signature genes will be designated as an “unknown” class of cells (default
                mode), and the group of cells with high or low expression level of signature genes will be assigned a
                ‘cell label’ denoted by the names of the signature gene lists. SCINA also implements a switch that turns
                off the searching of “unknown” cells. Please find more technical details of SCINA from <a
                    href="https://github.com/jcao89757/SCINA" target="_blank">the
                    manual of SCINA R package</a>.
            </p>
            <div id="comments">
                <form action="sendanalysis.php" method="post" enctype="multipart/form-data">
                    <hr class="style14"/>
                    <h2>Your Information (Optional)</h2>
                    <div class="block clear">
                        <label for="youname">Your Name</label>
                        <input type="text" name="youname" id="youname"/>
                    </div>
                    <div class="block clear">
                        <label for="organization">Your Organization</label>
                        <input type="text" name="organization" id="organization"/>
                    </div>
                    <div class="block clear">
                        <label for="youremail">Your Email</label>
                        <input type="email" name="youremail" id="youremail"/>
                    </div>
                    <hr class="style14"/>
                    <h2>Input Your Parameters</h2>
                    <div class="block clear">
                        <label for="expre_matrix">Expression Matrix (<a href="#modal_expressionmatrix" rel="modal:open">Example</a>)
                            <span>*</span></label>
                        <input type="file" name="expre_matrix" id="expre_matrix" required>
                    </div>
                    <div class="block clear">
                        <label for="signatures">Signatures (<a href="#modal_signatures" rel="modal:open">Example</a>)
                            <span>*</span></label>
                        <input type="file" name="signatures" id="signatures" required>
                    </div>
                    <div class="block clear">
                        <label for="max_iter">Maximum Iteration (0 <= input) (<a href="#modal_maxiteration"
                                                                                 rel="modal:open">Why limited to 10000
                                on
                                this website?</a>)<span>*</span></label>
                        <input type="number" name="max_iter" id="max_iter" min="0" value="100" max="10000"
                               onchange="changeconvmax()" required>
                    </div>
                    <div class="block clear">
                        <label for="convergence">Convergence (0 <= input <= maximum iteration) <span>*</span></label>
                        <input type="number" name="convergence" id="convergence" min="0" value="10" required>
                    </div>
                    <div class="block clear">
                        <label for="convergence_rate">Convergence Rate (0 <= inpuit <= 1) <span>*</span></label>
                        <input type="number" name="convergence_rate" id="convergence_rate" min="0" max="1" value="1"
                               step="0.00001" required>
                    </div>
                    <div class="block clear">
                        <label for="sensitivity_cutoff">Sensitivity Cutoff (0 <= inpuit <= 1) <span>*</span></label>
                        <input type="number" name="sensitivity_cutoff" id="sensitivity_cutoff" min="0" max="1" value="1"
                               step="0.00001" required>
                    </div>
                    <div class="block clear">
                        <label for="overlap">Remove Overlap <span>*</span></label>
                        <select name="overlap" id="overlap">
                            <option value="1" selected>True</option>
                            <option value="0">False</option>
                        </select>
                    </div>
                    <div class="block clear">
                        <label for="allowunknown">Allow Unknown <span>*</span></label>
                        <select name="allowunknown" id="overlap">
                            <option value="1" selected>Yes</option>
                            <option value="0">No</option>
                        </select>
                    </div>
                    <div>
                        <input type="submit" name="submit" value="Submit">
                        &nbsp;
                        <input type="reset" name="reset" value="Reset">
                    </div>
                </form>
            </div>
            <!-- ################################################################################################ -->
        </div>
        <!-- ################################################################################################ -->
        <!-- ################################################################################################ -->
        <div class="sidebar one_third">
            <!-- ################################################################################################ -->
            <div class="sdb_holder">
                <h6>Expression Matrix</h6>
                <p>
                    A normalized matrix representing the gene expression levels. Columns correspond to cells, rows
                    correspond to genes or protein symbols. For efficiency of data transfer and computation, the user is
                    encouraged to upload the subset of the gene expression matrix that contains only the genes that
                    appeared in the signature list.
                    <br><br>See <a href="#modal_expressionmatrix" rel="modal:open">Example</a>
                </p>
            </div>
            <hr class="style13"/>
            <div class="sdb_holder">
                <h6>Signatures</h6>
                <p>
                    A .csv file containing multiple signature vectors. Each column contains one signature vector (genes
                    or protein symbols), and its column name should be the name of the cell type. The signature vectors
                    do not need to have the same length.
                    <br><br>See <a href="#modal_signatures" rel="modal:open">Example</a>
                </p>
            </div>
            <hr class="style13"/>
            <div class="sdb_holder">
                <h6>Maximum Iteration</h6>
                <p>
                    Max iterations allowed for the EM algorithm.
                    <br>Input: integer >= 0
                </p>
            </div>
            <hr class="style13"/>
            <div class="sdb_holder">
                <h6>Convergence</h6>
                <p>
                    Stop the EM algorithm if during the last n rounds of iterations, cell type assignment keeps steady
                    above the convergence rate.
                    <br>Input: integer between 0 and maximum iteration
                </p>
            </div>
            <hr class="style13"/>
            <div class="sdb_holder">
                <h6>Convergence Rate</h6>
                <p>
                    Percentage of cells for which the type assignment remains stable for the last n rounds.
                    <br>Input: float between 0 and 1
                </p>
            </div>
            <hr class="style13"/>
            <div class="sdb_holder">
                <h6>Sensitivity Cutoff</h6>
                <p>
                    The cutoff to remove signatures whose cells types are deemed as non-existent at all in the data by
                    the SCINA algorithm. Small sensitivity_cutoff leads to more signatures to be removed, and 1 denotes
                    that no signature is removed.
                    <br>Input: float between 0 and 1
                </p>
            </div>
            <hr class="style13"/>
            <div class="sdb_holder">
                <h6>Remove Overlap</h6>
                <p>
                    A binary value, default 1 (TRUE) denotes that shared symbols between signature lists will be
                    removed. If 0 (FALSE) then allows different cell types to share the same identifiers.
                </p>
            </div>
            <hr class="style13"/>
            <div class="sdb_holder">
                <h6>Allow Unknown</h6>
                <p>
                    A binary value, default 1 (TRUE). If 0 (FALSE) then no cell will be assigned to the 'unknown'
                    category.
                </p>
            </div>
            <!-- ################################################################################################ -->
        </div>
        <!-- ################################################################################################ -->
        <!-- / main body -->
        <div class="clear"></div>
    </main>

    <div id="modal_expressionmatrix" class="modal">
        <h2 style="color: #000000;"><strong>Format:</strong> Expression Matrix Input File</h2>
        <hr/>
        <p style="color:#000000;">CSV file is required</p>
        <br>
        <p>
            <img src="images/exp_example_format.jpg" style="width:100%" alt=""/><br><br>

            <a class="btn" href="examples/example_expmat.csv">Download Example</a>
        </p>
    </div>
    <div id="modal_signatures" class="modal">
        <h2 style="color: #000000;"><strong>Format:</strong> Signatures Input File</h2>
        <hr/>
        <p style="color:#000000;">CSV file is required</p>
        <br>
        <p>
            <img src="images/exp_signature_format.jpg" style="width:100%" alt=""/><br><br>

            <a class="btn" href="examples/example_signatures.csv">Download Example</a>
        </p>
    </div>
    <div id="modal_maxiteration" class="modal">
        <h2 style="color: #000000;">Why max iteration is limited to 10000 on this website? </h2>
        <hr/>
        <p style="color:#000000;">Maximum iteration is closely related to execution time on our server. Due to our
            server load status, we have to limit the maximum iteration by 10000 for each job. If you want to run the
            analysis by maximum iteration > 10000, we suggest that you download SCINA package and run the
            analysis on your local machine. Any question please contact to <a href="mailto:Tao.Wang@utsouthwestern.edu">Tao.Wang@utsouthwestern.edu</a>
        </p>
        <br>
    </div>
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