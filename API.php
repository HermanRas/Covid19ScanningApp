<?php
if ($_GET['Key']  !== "KGUPnX-KNqQDPzK4YMkp0YD234oJ3khrn5bV6ZEcE4t") {
    header("Location: index.php");
    die;
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
<h1>Live Scan Results:</h1>

<table id="example" class="table table-striped table-bordered" style="width:100%">
    <thead>
        <tr>
            <th>REC</th>
            <th>IDNumber</th>
            <th>Temp</th>
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
</table>
<!-- Table End -->
<!-- http://localhost/web_dev/projects/Covid19Scanning/api.php?Key=KGUPnX-KNqQDPzK4YMkp0YD234oJ3khrn5bV6ZEcE4t -->