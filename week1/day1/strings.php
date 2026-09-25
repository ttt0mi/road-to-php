<?php
echo "STRING INTERPOLATION\n";
$firstName = "tomi";
$lastName = "omolokun";
$fullName = "$firstName $lastName";  // simple syntax string interpolation
echo $fullName . "\n";     // string concatenation

$withBraces = "this is {$fullName}";
$withPeriod = "this is " . $fullName;
echo "$withBraces\n";
echo "$withPeriod\n";


echo "\nSTRING FORMATTING WITH STRINGF()\n";
$formattedString = sprintf("my first name is %s and my last name is %s", $firstName, $lastName);
echo "$formattedString\n";


echo "\nHEREDOC and NOWDOC\n";
$heredocMessage = <<<EOT
helllo guys, i am $fullName.
it is nice to meet you\n
EOT;
echo $heredocMessage;

$nowdocMessage = <<<'EOT'
helllo guys, i am $fullName.
it is nice to meet you\n
EOT;
echo "$nowdocMessage\n";



echo "\nSTRING FUNCTIONS\n";


$email = "tomi@example.com";
var_dump(str_contains($email, "@"));

$names = "john,mark,anthony";
$result = explode(",", $names);
print_r($result);

$courses = ["PHP", "Python", "JavaScript"];
$result = implode(", ", $courses);
echo "$result\n";

$name = "   Tomi   ";
echo trim($name);
