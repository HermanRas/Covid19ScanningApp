<?php
// Get Total Year Stat
$sql = "SELECT count(id) as Total from [Covid19ScanResults]
        WHERE  substr(DATE(DateTimeStamp),1,4) = substr(DATE('now'),1,4)";
$sqlargs = array();
require_once 'config/db_query.php'; 
$YResult =  sqlQuery($sql,$sqlargs);
$YearTotal = $YResult[0][0]['Total'];

// Get Total Month Stat
$sql = "SELECT count(id) as Total from [Covid19ScanResults]
        WHERE (substr(DATE(DateTimeStamp),1,4) = substr(DATE('now'),1,4) AND
               substr(DATE(DateTimeStamp),6,2) = substr(DATE('now'),6,2));";
$sqlargs = array();
require_once 'config/db_query.php'; 
$MResult =  sqlQuery($sql,$sqlargs);
$MonthTotal = $MResult[0][0]['Total'];


// Get Total Daily Stat
$sql = "SELECT count(id) as Total from [Covid19ScanResults]
        WHERE (substr(DATE(DateTimeStamp),1,4) = substr(DATE('now'),1,4) AND
               substr(DATE(DateTimeStamp),6,2) = substr(DATE('now'),6,2) AND
               substr(DATE(DateTimeStamp),9,2) = substr(DATE('now'),9,2));";
$sqlargs = array();
require_once 'config/db_query.php'; 
$DResult =  sqlQuery($sql,$sqlargs);
$DayTotal = $DResult[0][0]['Total'];


// Pos Results
$sql = 'SELECT ((select * from vPosResults)*100 / count(id)) as PosPers from "Covid19ScanResults" limit 1000';
$sqlargs = array();
require_once 'config/db_query.php'; 
$PosResult =  sqlQuery($sql,$sqlargs);
$PosTotal = $PosResult[0][0]['PosPers'];

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
        $sql = "SELECT * 
                from Covid19ScanResults
                Order by DateTimeStamp
                LIMIT 1000;";
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
                    <a class="btn btn-secondary btn-sm toggle-vis" data-column="1">IDNumber</a>
                    <a class="btn btn-secondary btn-sm toggle-vis" data-column="2">Temp#</a>
                    <a class="btn btn-secondary btn-sm toggle-vis" data-column="3">TempNormal</a>
                    <a class="btn btn-secondary btn-sm toggle-vis" data-column="4">HistoryOfFever</a>
                    <a class="btn btn-secondary btn-sm toggle-vis" data-column="5">SoreThroat</a>
                    <a class="btn btn-secondary btn-sm toggle-vis" data-column="6">Cough</a>
                    <a class="btn btn-secondary btn-sm toggle-vis" data-column="7">DifficultyInBreathing</a>
                    <a class="btn btn-secondary btn-sm toggle-vis" data-column="8">Diarrhea</a>
                    <a class="btn btn-secondary btn-sm toggle-vis" data-column="9">Date</a>
                </div>
                <!-- Table Start -->
                <table id="example" class="table table-striped table-bordered" style="width:100%">
                    <thead>
                        <tr>
                            <th>#ID</th>
                            <th>IDNumber#</th>
                            <th>Temp#</th>
                            <th>TempNormal</th>
                            <th>HistoryOfFever</th>
                            <th>SoreThroat</th>
                            <th>Cough</th>
                            <th>DifficultyInBreathing</th>
                            <th>Diarrhea</th>
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
                            <td><?php echo $Rec['IDNumber']; ?></td>
                            <td><?php echo $Rec['Temperature']; ?></td>
                            <td><?php echo $Rec['TemperatureRange']; ?></td>
                            <td><?php echo $Rec['HistoryOfFever']; ?></td>
                            <td><?php echo $Rec['SoreThroat']; ?></td>
                            <td><?php echo $Rec['Cough']; ?></td>
                            <td><?php echo $Rec['DifficultyInBreathing']; ?></td>
                            <td><?php echo $Rec['Diarrhea']; ?></td>
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
    <script src="js/jquery-3.5.0.slim.min.js"></script>
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