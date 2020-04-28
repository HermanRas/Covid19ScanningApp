<?php
// Get Total Year Stat
$sql = "SELECT count(id) as Total from [Covid19ScanResults]
        WHERE Year(DateTimeStamp) = Year(GetDate())";
$sqlargs = array();
require_once 'config/db_query.php'; 
$YResult =  sqlQuery($sql,$sqlargs);
$YearTotal = $YResult[0][0]['Total'];

// Get Total Month Stat
$sql = "SELECT count(id) as Total from [Covid19ScanResults]
        WHERE (Year(DateTimeStamp) = Year(GetDate()) AND
               Month(DateTimeStamp) = Month(GetDate()))";
$sqlargs = array();
require_once 'config/db_query.php'; 
$MResult =  sqlQuery($sql,$sqlargs);
$MonthTotal = $MResult[0][0]['Total'];


// Get Total Daily Stat
$sql = "SELECT count(id) as Total from [Covid19ScanResults]
        WHERE (Year(DateTimeStamp) = Year(GetDate()) AND
               Month(DateTimeStamp) = Month(GetDate()) AND
               Day(DateTimeStamp) = Day(GetDate()))";
$sqlargs = array();
require_once 'config/db_query.php'; 
$DResult =  sqlQuery($sql,$sqlargs);
$DayTotal = $DResult[0][0]['Total'];


// Pos Results
$sql = "SELECT [PercentagePostive]
        FROM [vPercentragePosDaily]";
$sqlargs = array();
require_once 'config/db_query.php'; 
$PosResult =  sqlQuery($sql,$sqlargs);
$PosTotal = $PosResult[0][0]['PercentagePostive'];

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
    <link href="css/dataTables.bootstrap4.min.css" rel="stylesheet">
    <!-- end of bootstrap -->

</head>

<body class="bg-primary">
    <!-- Page Start -->
    <div class="pt-5 container bg-white rounded">

        <!-- NAV START -->
        <nav class="navbar navbar-dark bg-dark rounded">
            <a class="navbar-brand" href="index.php">
                <img src="img/icon.png" width="30" height="30" class="d-inline-block align-top bg-white rounded" alt="">
                Mine Scanning Station Summary
            </a>
        </nav>
        <!-- NAV END -->

        <!-- Stats Start -->
        <div class="row mt-3">

            <!-- Earnings (Annual) Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-primary shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Total
                                    (Annual)</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $YearTotal?></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-success shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Total
                                    (Monthly)
                                </div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $MonthTotal?></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Pending Requests Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-warning shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">Total
                                    (Daily)
                                </div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $DayTotal?></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-warning shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Positive Symptoms
                                </div>
                                <div class="row no-gutters align-items-center">
                                    <div class="col-auto">
                                        <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800"><?php echo $PosTotal?>%
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="progress progress-sm mr-2">
                                            <div class="progress-bar bg-warning" role="progressbar"
                                                style="width: <?php echo $DayTotal?>%" aria-valuenow="50"
                                                aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


        </div>

        <!-- Stats End -->

        <!-- Main Content Start-->
        <?php
        $SelectDate = date('Y-m-d');
        
        if(isset($_GET['SelectDate'])){
            $SelectDate = $_GET['SelectDate'];
        }

        #SQL Connect
        $sql = "SELECT top 1000 [Covid19ScanResults].* 
                from [Covid19ScanResults]
                Order by DateTimeStamp;";
        $sqlargs = array();
        require_once 'config/db_query.php'; 
        $Results =  sqlQuery($sql,$sqlargs);
        ?>


        <!-- Form Summary -->
        <div class="card my-3">
            <div class="card-header bg-dark text-white">
                Live Scan Results:
            </div>
            <div class="card-body bg-light">
                <!-- Filters -->
                <div>
                    <b>Toggle column:</b>
                    <a class="toggle-vis" data-column="1">CN</a> |
                    <a class="toggle-vis" data-column="2">Date</a>
                </div>
                <!-- Table Start -->
                <table id="example" class="table table-striped table-bordered" style="width:100%">
                    <thead>
                        <tr>
                            <th>#ID</th>
                            <th>Company#</th>
                            <th>Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                    $i = 0;
                    foreach ($Results[0] as $Rec) {
                    ?>
                        <tr>
                            <td><?php echo $Rec['id'] ?></td>
                            <td><?php echo $Rec['CompanyNumber']; ?></td>
                            <td><?php echo $Rec['DateTimeStamp']; ?></td>
                        </tr>
                        <?php
                        }
                        ?>
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>#ID</th>
                            <th>Company#</th>
                            <th>Date</th>
                        </tr>
                    </tfoot>
                </table>
                <!-- Table End -->
            </div>
        </div>
        <button class="btn btn-outline-primary btn-lg form-control"
            onclick="document.location.href='index.php'">Home</button>
        <!-- Form Summary -->
        <br><br>
        <!-- Main Content Start-->

    </div>
    <!-- Page End -->

    <!-- Start of Bootstrap JS -->
    <script src="js/jquery-3.3.1.slim.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/jquery.dataTables.min.js"></script>
    <script src="js/dataTables.bootstrap4.min.js"></script>
    <!-- end of Bootstrap JS -->

    <!-- Page Level JS -->
    <script>
    $(document).ready(function() {
        var table = $('#example').DataTable({
            "scrollX": true,
            "order": [
                [2, "desc"]
            ]
        });

        $('a.toggle-vis').on('click', function(e) {
            e.preventDefault();

            // Get the column API object
            var column = table.column($(this).attr('data-column'));

            // Toggle the visibility
            column.visible(!column.visible());
        });
    });
    </script>

</body>

</html>