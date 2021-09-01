<?php

namespace classes;

class GeoApi
{

    public $data;

    public function __construct($data)
    {
        $this->data = $data;
    }

    public function getContinent()
    {
        $continent = '';
        $codes = explode("\n", file_get_contents('codes.txt'));
        $code_result = [];

        foreach ($codes as $code) {
            $res_line = explode(",", $code);
            $code_result[] = [
                '#ISO' => $res_line[0], 'ISO3' => $res_line[1], 'ISO-Numeric' => $res_line[2],
                'fips' => $res_line[3], 'Country' => $res_line[4], 'Capital' => $res_line[5],
                'Area(in sq km)' => $res_line[6], 'Population' => $res_line[7],
                'Continent' => $res_line[8], 'tld' => $res_line[9], 'CurrencyCode' => $res_line[10],
                'CurrencyName' => $res_line[11], 'Phone' => $res_line[12], 'Postal Code Format' => $res_line[13],
                'Postal Code Regex' => $res_line[14], 'Languages' => $res_line[15], 'geonameid' => $res_line[16],
                'neighbours' => $res_line[17], 'EquivalentFipsCode' => $res_line[18],
            ];
        }

        $phone = substr($this->data, 0, 3);
        $phone2 = substr($this->data, 0, 2);

        foreach ($code_result as $code) {

            if ($code['Phone'] == $phone) {
                $continent = $code['Continent'];

            } elseif ($code['Phone'] == $phone2) {
                $continent = $code['Continent'];
            }

        }

        return $continent;
    }

}
