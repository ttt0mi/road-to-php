<?php

$lineCount = 0;
$lineLimit = 10;
$fileName = "../utilities/sales_data_sample_new.csv";

if (($file = fopen($fileName, "r")) !== FALSE) {

    $header = fgetcsv($file, escape: "\\");
    $data = [];

    while (($line = fgetcsv($file, escape:"\\")) !== false) {
        $salesData[] = array_combine($header, $line);

        $lineCount++;
        if ($lineCount > $lineLimit) break;
    }
}

fclose($file);

foreach ($salesData as $columnName => $row) {
    $salesData[$columnName]["TOTAL"] = $row["QUANTITYORDERED"] * $row["PRICEEACH"];    //not working
}

//for($i = 0; $i < count($salesData); $i++) {
//    $salesData[$i]["TOTAL"] = $salesData[$i]["QUANTITYORDERED"] * $salesData[$i]["PRICEEACH"];
//}
// i'm dumb

$totals = array_column($salesData, "TOTAL");
print_r($totals);

$totalSales = array_sum($totals);

//$csvSalesReport = <<<EOT
//    $totalSales
//EOT;
//echo $csvSalesReport;

$csvSalesReport = "";

foreach ($totals as $i => $total) {
    $quantity = $salesData[$i]['QUANTITYORDERED'];
    $price = $salesData[$i]['PRICEEACH'];
    $csvSalesReport .= sprintf("%-5s x %8.2f = %10.2f\n", $quantity, $price, $total);

}

$csvSalesReport .= "\nTotal Sales: {$totalSales}";
echo $csvSalesReport;
