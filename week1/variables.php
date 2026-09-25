<?php

$name = "Tomi";
echo "Hello, $name";
echo "\n";

$number = 89;
$float = 22.7;
$bool = true;

// var_dump -> inspecting values and types of variables
var_dump($number);
var_dump($float);
var_dump($bool);
var_dump($name);
var_dump($name[0]);

// '==' v '===' comparison
var_dump($number == "89");
var_dump($number == 89);
var_dump($number === "89");
var_dump($number === 89);
