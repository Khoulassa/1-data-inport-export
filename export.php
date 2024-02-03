<?php

    require("vendor/autoload.php");
        
    use PhpOffice\PhpSpreadsheet\Spreadsheet;
    use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
    use \PhpOffice\PhpSpreadsheet\Cell\Coordinate;

    $datas = [];

    for( $i = 10; $i <= 60; $i++ ){
        $datas[] = [ 
            'ID' => $i * 8954,
            'Firstname' => 'Firstname '.$i,
            'Lastname' => 'Lastname '.$i,
            'Age' => $i,
            'Date' => '2024/02/12',
            'State' => $i % 10 == 0 ? 'ON' : 'OFF'
        ];
    }

    //var_dump( $datas );

    $spreadsheet = new Spreadsheet();
    $sheet = $spreadsheet->getActiveSheet();

    $i = 1;

    foreach ($datas as $rowkey => $rowData) {
        $c = 'A';
        foreach ($rowData as $columnKey => $value) {
            $X = $c;
            $Y = $i;
            $Cell = $X.$Y;
            $sheet->setCellValue($Cell, $columnKey);
            $c++;
        }
        break;
    }
    foreach ($datas as $rowkey => $rowData) {
        $c = 'A';
        $i++;
        foreach ($rowData as $columnKey => $value) {
            $X = $c;
            $Y = $i;
            $Cell = $X.$Y;
            $sheet->setCellValue($Cell, $value);
            $c++;
        }
    }

    $spreadsheet->getProperties()->setCreator('DK')->setTitle('Customers');
    
    $filename = 'exportedfile.xlsx';

    $writer = new Xlsx($spreadsheet);
    $writer->save($filename);

    header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheet.sheet');
    header('Content-Disposition: attachment;filename="' . urlencode($filename) .'"');
    readfile($filename);
    exit();
