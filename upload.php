<?php

use classes\UploadeCSV;
use classes\CallFilter;
use classes\Ipstack;
use classes\GeoApi;


function autoloder($class)
{
    $class = str_replace("\\", '/', $class);
    $file = __DIR__ . "/{$class}.php";
    if (file_exists($file)) {
        require_once $file;
    }
}

spl_autoload_register('autoloder');

$upload= new UploadeCSV($_FILES['filename']['tmp_name']);
$csv=$upload->getCsv();

$object = new ArrayObject($csv);

$data = [];
$temp = [];
foreach ($csv as $item) {
    if (!in_array($item['id'], $temp)) {

        $sumDuration = 0;
        $coun = 0;
        $countSameContinent = 0;
        $continent;
        $sumDurSameContinent = 0;


        $iterator = new CallFilter($object->getIterator(), $item['id']);
        $temp[] = $item['id'];

        foreach ($iterator as $result) {
            $ipCheck = new Ipstack($result['ip']);
            $ipCheckRes = $ipCheck->getContinent();

            $phone = $result['phone'];
            //echo $phone."<br>";

            $continent = new GeoApi($phone);
            $cont = $continent->getContinent();
           

            if ($ipCheckRes == $cont) {
                $countSameContinent++;
                $sumDurSameContinent += $result['duration'];
            }

            $sumDuration += $result['duration'];
            $coun++;
        }

        $data[] = ['id' => $item['id'], 'sumDurSameContinent' => $sumDurSameContinent, 'duration' => $sumDuration, 'CallInSameContinent' => $countSameContinent, 'allCall' => $coun,];
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous">
    <title>Document</title>
</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col-10 offset-1">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Total duration of customer's<br> calls within same continent</th>
                            <th>Total duration of all customer's calls</th>
                            <th>Number of customer's calls<br> within same continent</th>
                            <th>Number of all customer's calls</th>
                        </tr>
                    </thead>
                    <tbody style="text-align:center;">
                        <?php
                        foreach ($data as $r) {
                            echo "<tr>";
                            echo "<td>" . $r['id'] . "</td>" .
                               "<td>" . $r['sumDurSameContinent'] . "</td>" .
                               "<td>" . $r['duration'] . "</td>" .
                               "<td>" . $r['CallInSameContinent'] . "</td>" . 
                               "<td>" . $r['allCall'] . "</td>";
                            echo "</tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>

</html>