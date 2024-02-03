<?php
    require("vendor/autoload.php");
    
    use PhpOffice\PhpSpreadsheet\Reader\Xlsx;
    use PhpOffice\PhpSpreadsheet\Reader\Xml\Style\Alignment;


    $file = 'files/datas.xlsx';

    $reader = new Xlsx();
    
    try {
        $sheets = $reader->load($file);
    } catch (\PhpOffice\PhpSpreadsheet\Reader\Exception $e) {
        die("DIE");
    }

    $sheet = $sheets->getSheet(0);

    $heightRow = $sheet->getHighestRow();
    $heightColumn = $sheet->getHighestColumn();

    for ($row = 1; $row <= $heightRow; $row++) { 
        $rowData = $sheet->rangeToArray('A'.$row.':'.$heightColumn.$row, null, true, false);
        var_dump($rowData);
    }
