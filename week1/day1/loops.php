<?php

echo "FOREACH LOOP FOR INDEXED ARRAY\n";
$myInfoList = [
    "tomi",
    "omolokun",
    23
];

foreach ($myInfoList as $info) {
    echo "$info\n";
}

echo "\nFOREACH LOOP FOR ASSOCIATIVE ARRAY\n";
$myInfoMap = [
    "first_name" => "tomi",
    "last_name" => "omolokun",
    "age" => 23
];
foreach ($myInfoMap as $id => $info) {
    echo "$id: $info\n";
}


echo "\nFOR LOOP\n";
for ($i = 0; $i < 5; $i++) echo "$i\n";

echo "\nFOR LOOP WITH ARRAY\n";
for ($i = 0; $i < count($myInfoList); $i++) {
    echo "$myInfoList[$i]\n";
}


echo "\nWHILE LOOP\n";
$count = 0;
while ($count < 5) {
    echo "$count\n";
    $count++;
}

echo "\nWHILE LOOP WITH ARRAY\n";
$count1 = 0;
while ($myInfoList[$count1] !== 23) {
    echo "$myInfoList[$count1]\n";
    $count1++;
}
