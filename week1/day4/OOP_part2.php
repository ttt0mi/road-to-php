<?php

// inheritance
class Animal {
    public function eat(): void {
        echo "eating";
    }
}
class Dog extends Animal {
    public function bark(): void {
        echo "woof";
    }

    public function eat(): void {   //overriding parent method
        parent::eat();              //calling parent implementation of the method
        echo " meat and plants\n";
    }
}

$dog = new Dog();
$dog->eat();
$dog->bark();


// composition
class DatabaseConnection {
    public function connect(string $databaseName): void {
        echo "connected to $databaseName\n";
    }
}

class Repository {
    public function __construct(private DatabaseConnection $connection) {
    }

    public function connect(string $databaseName): void {
        $this->connection->connect($databaseName);
    }
}

$connection = new DatabaseConnection();
$repository = new Repository($connection);
$repository->connect("postgresql");


// abstract classes
abstract class Logger {
    protected string $fileName;

    public function __construct(string $fileName) {
        $this->fileName = $fileName;
    }

    abstract public function log(string $message): void;
    // every concrete child class must provide its own log() implementation
}

class FileLogger extends Logger {
    public function log(string $message): void {
        echo "writing {$message} to {$this->fileName}\n";
    }
}

class TerminalLogger extends Logger {
    public function log(string $message): void {
        echo "$message\n";
    }
}

$logger = new FileLogger("log.txt");
$logger->log("hello world");


// interfaces
interface Exportable {
    public const MAX_EXPORT_LIMIT = 5000;

    public function exportData(): string;
    // methods have no body, just signature. they must also be public
}

interface Loggable {
    public function logMessage(string $message): void;
}

class CSVReportGenerator implements Exportable, Loggable {
    public function exportData(): string {
        return "CSV Data\n";
    }

    public function logMessage(string $message): void {
        echo "Log: $message\n";
    }
}

$report = new CSVReportGenerator();
$report->logMessage("hello world");
echo $report->exportData();


// check whether an object belongs to a class or implements an interface
var_dump($dog instanceof Dog);
var_dump($dog instanceof Animal);
var_dump($report instanceof CSVReportGenerator);
var_dump($report instanceof Loggable);
var_dump($report instanceof Exportable);



// traits
trait HasTimestamps {
    private DateTimeImmutable $createdAt;
    private DateTimeImmutable $updatedAt;

    public function initTimestamps(): void {    // for date instantiation
        $now = new DateTimeImmutable("now");
        $this->createdAt = $now;
        $this->updatedAt = $now;
    }

    public function getCreatedAt(): DateTimeImmutable {
        return $this->createdAt;
    }

    public function getUpdatedAt(): DateTimeImmutable {
        return $this->updatedAt;
    }

    public function update(): void {
        $this->updatedAt = new DateTimeImmutable("now");
    }
}

class Customer {
    use HasTimestamps;

    public function __construct() {
        $this->initTimestamps();
    }
}
class Product {
    use HasTimestamps;

    public function __construct() {
        $this->initTimestamps();
    }
}