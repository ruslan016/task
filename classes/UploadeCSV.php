<?php

namespace classes;

class UploadeCSV{

    private $file;

    function __construct($file)
    {
        $this->file = $file;
    }

    function getCsv()
    {
        $handle = fopen($this->file, "r");
        $res = [];

        while (list($id, $time, $duration, $phone, $ip) =
            fgetcsv($handle, 1024, ",")
        ) {
            $res[] = ['id' => $id, 'time' => $time, 'duration' => $duration, 'phone' => $phone, 'ip' => $ip];
        }

        return $res;
    }


}