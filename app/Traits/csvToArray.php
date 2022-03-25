<?php

namespace App\Traits;

trait CsvToArray
{

    /**
     * Converts the  CSV DATA to an Array with uploaded files
     *
     * @param string $filename
     * @param string $delimiter
     * @return array
     */
    public function csvToArray(string $filename = '', string $delimiter = ',')
    {
        if (!file_exists($filename) || !is_readable($filename)) {
            return false;
        }

        $header = null;
        $data = [];
        if (($handle = fopen($filename, 'r')) !== false) {
            while (($row = fgetcsv(
                $handle,
                1000,
                $delimiter
            )) !== false) {
                if (!$header)
                    $header = $row;
                else
                    $data[] = array_combine($header, $row);
            }
            fclose($handle);
        }
        return $data;
    }
}
