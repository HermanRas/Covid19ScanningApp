<?php
////////////////////////////////////////////////////////////////
//CN check history ?
////////////////////////////////////////////////////////////////





////////////////////////////////////////////////////////////////
// Save data
////////////////////////////////////////////////////////////////
if (isset($_GET['CN'])&&isset($_POST['Saved'])){
    // set save values;
    $CompanyNumber = '';
    $Temperature = '';
    $TemperatureRange = '';
    $HistoryOfFever = '';
    $SoreThroat = '';
    $Cough = '';
    $DifficultyInBreathing = '';
    $Diarrhea = '';

    // set save values;
    $CompanyNumber = $_GET['CN'];
    $Temperature = $_POST['Temperature'];
    $TemperatureRange = $_POST['TemperatureRange'];
    $HistoryOfFever = $_POST['HistoryOfFever'];
    $SoreThroat = $_POST['SoreThroat'];
    $Cough = $_POST['Cough'];
    $DifficultyInBreathing = $_POST['DifficultyInBreathing'];
    $Diarrhea = $_POST['Diarrhea'];


    // insert SQL
$sql = "INSERT INTO [Covid19ScanResults]
           ([CompanyNumber]
           ,[Temperature]
           ,[TemperatureRange]
           ,[HistoryOfFever]
           ,[SoreThroat]
           ,[Cough]
           ,[DifficultyInBreathing]
           ,[Diarrhea])
     VALUES
           ('$CompanyNumber'
           ,'$Temperature'
           ,'$TemperatureRange'
           ,'$HistoryOfFever'
           ,'$SoreThroat'
           ,'$Cough'
           ,'$DifficultyInBreathing'
           ,'$Diarrhea');";

$sqlargs = array();
require_once 'config/db_query.php'; 
$AddScan =  sqlQuery($sql,$sqlargs);

echo "<script> document.location.href='index.php' </script>";
die;
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

        <!-- Notification -->
        <div class="card">
            <div class="card-header bg-danger text-white">
                Last Scan 9 days ago / Positive Symptom on last scan
            </div>
        </div>


        <!-- Main Content Start-->
        <!-- form start-->
        <div class="card">
            <div class="card-header bg-dark text-white">
                Scan Now !
            </div>
            <div class="card-body">
                <form method="POST">

                    <div class="form-row">
                        <div class="form-group col-md-3">
                            <label for="Temperature">Temperature</label>
                            <input type="number" class="form-control" id="Temperature" name="Temperature" required>
                        </div>
                        <div class="form-group col-md-3">
                            <label for="TemperatureRange">Temperature Normal Range</label>
                            <select type="text" class="form-control" id="TemperatureRange" name="TemperatureRange"
                                required>
                                <option value="">Select </option>
                                <option value="1">YES </option>
                                <option value="0">NO </option>
                            </select>
                        </div>
                        <div class="form-group col-md-3">
                            <label for="HistoryOfFever">History of Fever</label>
                            <select type="text" class="form-control" id="HistoryOfFever" name="HistoryOfFever" required>
                                <option value="">Select </option>
                                <option value="1">YES </option>
                                <option value="0">NO </option>
                            </select>
                        </div>
                        <div class="form-group col-md-3">
                            <label for="SoreThroat">Sore Throat</label>
                            <select type="text" class="form-control" id="SoreThroat" name="SoreThroat" required>
                                <option value="">Select </option>
                                <option value="1">YES </option>
                                <option value="0">NO </option>
                            </select>
                        </div>
                        <div class="form-group col-md-3">
                            <label for="Cough">Cough</label>
                            <select type="text" class="form-control" id="Cough" name="Cough" required>
                                <option value="">Select </option>
                                <option value="1">YES </option>
                                <option value="0">NO </option>
                            </select>
                        </div>
                        <div class="form-group col-md-3">
                            <label for="DifficultyInBreathing">Difficulty in Breathing</label>
                            <select type="text" class="form-control" id="DifficultyInBreathing"
                                name="DifficultyInBreathing" required>
                                <option value="">Select </option>
                                <option value="1">YES </option>
                                <option value="0">NO </option>
                            </select>
                        </div>
                        <div class="form-group col-md-3">
                            <label for="Diarrhea">Diarrhea</label>
                            <select type="text" class="form-control" id="Diarrhea" name="Diarrhea" required>
                                <option value="">Select </option>
                                <option value="1">YES </option>
                                <option value="0">NO </option>
                            </select>
                        </div>
                    </div>

                    <div class="row my-3">
                        <button class="btn btn-outline-success btn-lg form-control" name="Saved">Save</button>
                        <br><br>
                        <button class="btn btn-outline-danger btn-lg form-control"
                            onclick="document.location.href='index.php'">Cancel</button>
                    </div>
                </form>
            </div>
        </div>
        <!-- form end -->
        <br><br>
        <!-- Main Content Start-->


    </div>
    <!-- Page End -->

    <!-- Start of Bootstrap JS -->
    <script src="js/jquery-3.3.1.slim.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <!-- end of Bootstrap JS -->

    <!-- Page Specific JS -->
    <script>
    function filterEquipment(eqtId) {
        var select = document.getElementById("Equipment");
        var length = select.options.length;
        for (i = length - 1; i >= 0; i--) {
            select.options[i] = null;
        }
        var opt = document.createElement("option");
        opt.value = "";
        opt.text = "Select Equipment ";
        select.add(opt, null);

        Equipment[0].forEach(element => {
            if (element.EquipmentTypeId == eqtId.value) {
                opt = document.createElement("option");
                opt.value = element.EquipmentId;
                opt.text = element.EquipmentDescription;
                select.add(opt, null);
            };
        });
    }
    </script>
</body>

</html>