<?php

declare(strict_types= 1);

function divide(float $dividend, float $divisor): float {
    return $dividend / $divisor;
}


$quotient = divide(89,11);
echo $quotient;
// divide("89", "11"); // throws error because 89 and "89" are of different types


// Nullable return types
function findID(string $username): ?int { // same as int | null
    if ($username === "Tomi123") {
        return 1;
    }
    return null;
}
$id1 = findID("Tomi123");  // returns 1
$id2 = findID("Tomi456");  // returns null


// Union return types
function findUsername(int | string $id): string | null {   // same as ?string
    if ($id === 1) {
        return "Tomi123";
    }
    return null;
}
$username1 = findUsername(1);   // returns Tomi123
$username2 = findUsername(2);   // returns null


//void vs never
function printUsername(string $username): void { 
    echo "Username: $username\n";
}

function throwEmailException(string $email): never {
    throw new Exception("Invalid email: $email");
}


function greetUser(string $username, string $greeting = "Hello"): void { // default params
    echo "$greeting $username\n";
}
greetUser("tomi123");
greetUser("tomi123", "good evening");


function login(string $username, string $email): void {
    echo "$username with $email has logged in\n";
}
login(email: "tomi@me.com", username: "tomi");   //named arguments


function sumNumbers(int | float ...$numbers): int | float {
    return array_sum($numbers);
}
$result = sumNumbers(1, 2, 3, 4);
echo $result;


$checkEmail = fn(string $email): bool => str_contains($email, "@");
var_dump($checkEmail("tomi@me.com"));
var_dump($checkEmail(""));


$counter = 1;

// passed by value
$byValue = function () use ($counter) {
    $counter++; // only increases the local copy
};
$byValue();
echo $counter; // outputs: 1(unchanged)

// passed by reference
$byReference = function () use (&$counter) {
    $counter++; // increases the actual parent variable
};
$byReference();
echo $counter; // Outputs: 2(changed)
