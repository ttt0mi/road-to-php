<?php

declare(strict_types=1);

$filePath = "../../utilities/sales_data_sample_new.csv";

function readCSV(string $filePath, int $rowLimit = 10): array {

    $file = fopen($filePath, "r");

    if ($file === false) {
        return [];
    }

    $rowCount = 0;
    $salesData = [];

    $header = fgetcsv($file, escape: "\\");

    while (($row = fgetcsv($file, escape: "\\")) !== false) {
        $salesData[] = array_combine($header, $row);

        $rowCount++;
        if ($rowCount > $rowLimit) break;
    }

    fclose($file);

    return $salesData;
}

function calculateTotalFromSales(array $salesData): array {
    foreach ($salesData as $columnName => &$row) {
        $salesData[$columnName]["TOTAL"] = $row["QUANTITYORDERED"] * $row["PRICEEACH"];
    }

    unset($row);
    return $salesData;
}

function calculateTotal(array $salesData): float{
    $totals = array_column($salesData, "TOTAL");
    return array_sum($totals);
}

function generateReport(array $salesData, float $totalSales): string {
    $csvSalesReport = "";

    foreach ($salesData as $columnName => $row) {
        $quantity = $row['QUANTITYORDERED'];
        $price = $row['PRICEEACH'];
        $total = $row['TOTAL'];
        $csvSalesReport .= sprintf("%-3s x %7.2f = %7.2f\n", $quantity, $price, $total);
    }

    $csvSalesReport .= "\nTotal Sales: {$totalSales}";

    return $csvSalesReport;
}


$salesData = readCSV($filePath, 10);
$updatedSalesData = calculateTotalFromSales($salesData);
$salesGrandTotal = calculateTotal($updatedSalesData);
$csvSalesReport = generateReport($updatedSalesData, $salesGrandTotal);
echo $csvSalesReport;