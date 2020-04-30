<?php
// set default popup false
$pop = 0;


if(isset($_POST['CompanyNumber'])){
    // setting defaults
    $CN = '';

    // update post Value
    $CN = $_POST['CompanyNumber'];


    // get DB Data
    $sql = "SELECT TOP 1 *,
            DATEDIFF(day, DateTimeStamp, getdate() ) AS DateDiff
            FROM Covid19ScanResults
            WHERE CompanyNumber = :CN
            ORDER BY
            id DESC";
    $sqlargs = array('CN'=>$CN);
    require_once 'config/db_query.php'; 
    $LastScan =  sqlQuery($sql,$sqlargs);

    $DateDiff = $LastScan[0][0]['DateDiff'];
    if(isset($DateDiff)){
        if ($LastScan[0][0]['DateDiff'] > 0){
            $Days = $LastScan[0][0]['DateDiff'];
            echo "<script> document.location.href='scan.php?CN=$CN&Days=$Days'</script>";
            die;
        }else{
            $pop = 1;
        }
    }else{
            echo "<script> document.location.href='scan.php?CN=$CN&Days=$Days'</script>";
            die;
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Mine Scanning Station</title>

    <!-- Chrome/android APP settings -->
    <meta name="theme-color" content="#4287f5">
    <link rel="icon" href="img/icon.png" sizes="192x192">
    <!-- end of Chrome/Android App Settings  -->

    <!-- Bootstrap // you can use hosted CDN here-->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/bootstrap.css" rel="stylesheet">
    <link href="css/app.css" rel="stylesheet">
    <!-- end of bootstrap -->

</head>

<body class="bg-primary">
    <!-- Page Start -->
    <div class="pt-5 container bg-white rounded">

        <!-- NAV START -->
        <nav class="navbar navbar-dark bg-dark rounded">
            <a class="navbar-brand" href="index.php">
                <img src="img/icon.png" width="30" height="30" class="d-inline-block align-top  bg-white rounded"
                    alt="Logo">
                Mine Scanning Station
            </a>
        </nav>
        <!-- NAV END -->

        <section>
            <div class="row bg-white">
                <div class="col-12 bg-white text-center">
                    <div class="bg-dark p-1 my-1 rounded" style="margin: auto;">
                        <img src="img/Logo.jpg" class="img-fluid rounded" style="height: 200px; width: 600px;"
                            alt="Header">
                    </div>
                </div>
            </div>

            <!-- form start-->
            <div class="card">
                <div class="card-header bg-dark text-white">
                    New Scan
                </div>
                <div class="card-body">
                    <form method="POST" name="form">

                        <div class="form-group">
                            <label for="CompanyNumber">Company Number#</label>
                            <input type="text" class="form-control" id="CompanyNumber" name="CompanyNumber" autofocus
                                placeholder="Company Number here..." maxlength="8" minlength="8" required>
                        </div>

                        <button class="btn btn-outline-success btn-lg form-control" id="save">Scan</button>
                    </form>
                </div>
            </div>
            <br><br>
            <button class="btn btn-outline-primary btn-lg form-control mb-1"
                onclick="document.location.href='codes.html'">Scan
                Codes</button>
            <button class="btn btn-outline-primary btn-lg form-control"
                onclick="document.location.href='dash.php'">Dash</button>
            <!-- form end -->
            <br><br>
            <!-- Main Content Start-->
        </section>


    </div>
    <!-- Page End -->

    <!-- Start of Bootstrap JS -->
    <script src="js/jquery-3.5.0.slim.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/sweetalert2.all.min.js"></script>
    <!-- end of Bootstrap JS -->

    <!-- check popup -->
    <?php
    if($pop){
        echo '<script src="js/popup.js"></script>';
    }
    ?>
    <!-- add form actions. -->
    <script src="js/Activity.js"></script>
</body>

</html>