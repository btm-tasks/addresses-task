<?php

namespace App\Helpers;

class CsvHelper
{

    public static function csvConverted($fileName, $delimiter, $class = null)
    {
        if (!file_exists($fileName) || !is_readable($fileName)) {
            return false;
        }

        $header = null;
        $data = array();
        if (($handle = fopen($fileName, 'r')) !== false) {
            while (($row = fgetcsv($handle, 1000, $delimiter)) !== false) {
                if (!$header) {
                    $header = $row;
                } else {
                    if ($class != null){
                        $data[] = new $class(array_combine($header, $row));
                    }
                    else{
                        $data[] = array_combine($header, $row);
                    }
                }
            }
            fclose($handle);
        }
        return $data;
    }

    public static function arrayToCsv($fileName, $array, $headers)
    {
        $f = fopen($fileName, 'w');

        foreach ($array as $key=>$item) {
            if (is_object($item)) {
                $item = (array)$item;
            }

            if ($key == 0) {
                fputcsv($f, $headers, '-');
            }

            fputcsv($f, $item, "-");
        }

        fclose($f);

        return true;
    }

}
