<?php

namespace Tests\Helpers;

use App\Helpers\CsvHelper;
use Tests\TestCase;

class CsvHelperTest extends TestCase
{

    public function test_arrayToCsv(): void
    {
        $headers = [
            "name", "age", "experience_years"
        ];

        $data = [
            ["testname","28","7"],
            ["testname2","28","8"],
            ["testname3","28","10"],
        ];

        $filePath = storage_path("csv_files/test/test_csv_arrayToCsv.csv");

        $res = CsvHelper::arrayToCsv($filePath, $data, $headers);

        $this->assertTrue($res);
        $this->assertFileExists($filePath);
    }

    public function test_csvConverted(): void
    {
        $filePath = storage_path("csv_files/test/test_csv_arrayToCsv.csv");

        $res = CsvHelper::csvConverted($filePath, '-');

        $this->assertNotEmpty($res);
        $this->assertCount(3, $res[0]);
    }



}
