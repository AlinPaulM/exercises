<?php

// Sum all values of a CSV file
class DataParser {
    const CSV = <<<CSV
Value1,Value2,Value3,Value4,Value5,Value6
5,67,8,5,33,88
7,23,99,100,42,0
5,62,19,73,46,2
CSV;

    public function sumCSVRows(): int {
        $sum = 0;

        $fp = fopen('data:://text/plain,' . self::CSV, 'r');
        $stringData = fread($fp, strlen(self::CSV));
        $arrayData = explode(PHP_EOL, $stringData);
        array_shift($arrayData); // remove the 1st row (Value1,Value2,Value3,Value4,Value5,Value6)
        foreach($arrayData as $val) {
            $rowArr = explode(',', $val);
            $sum += array_sum($rowArr);            
        }

        fclose($fp);

        return $sum;
    }
}

echo (new DataParser())->sumCSVRows();