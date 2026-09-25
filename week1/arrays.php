<?php

echo "INDEXED ARRAY\n";

$myInfoList = [
    "tomi",
    "omolokun",
    23
];
echo <<<EOT
$myInfoList[0], $myInfoList[1], $myInfoList[2];
EOT;


echo "\nASSOCIATIVE ARRAY\n";

$myInfoMap = [
    "first_name" => "tomi",
    "last_name" => "omolokun",
    "age" => 23
];
echo <<<EOF
{$myInfoMap["first_name"]}, {$myInfoMap["last_name"]}, {$myInfoMap["age"]}; 
EOF;


echo "\ARRAY FUNCTIONS\n";

//array_map
$prices = [10_000, 20_000, 30_000];
$withDiscount = array_map(
    function ($price) {
        return $price - $price * 0.1;
    },
    $prices
);
print_r($withDiscount);


//array_filter
$tooExpensive = array_filter(
    $prices,
    function ($price) {
        return $price < 30000;
    },
);
print_r($tooExpensive);


//array_column

$students = [
    [
        "name" => "Tomi",
        "score" => 85
    ],
    [
        "name" => "Sarah",
        "score" => 92
    ],
    [
        "name" => "John",
        "score" => 78
    ]
];
$names = array_column($students, "name");
print_r($names);


//array_sum

$sales = [1000, 2500, 3500];
$total = array_sum($sales);
echo "$total\n";


//usort
$numbers = [5, 2, 9, 1, 3];
usort($numbers, function ($a, $b) {
    return $a <=> $b;
});
// spaceship operator(<=>)
// $a <=> $b sorts in ascending order
// $b <=> $a sorts in descending order
print_r($numbers);

echo json_encode($numbers);