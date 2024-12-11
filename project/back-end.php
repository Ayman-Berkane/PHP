<?php
try {
    // verbinding met de MySQL-database
    $db = new PDO("mysql:host=localhost;dbname=tech-one", "root", "");
} catch (PDOException $e) {
    // Stop de scriptuitvoering bij een fout
    die("Error!: " . $e->getMessage());
}

// Stel de tijdzone in op Europa/Amsterdam
date_default_timezone_set('Europe/Amsterdam');

// de huidige dag en tijd
$currentDay = date("l");
$currentTime = date("H:i");
$currentDate = date("l j F Y");

// Opslaan van openingstijden voor elke dag
$openingHours = [
    "Monday" => ["start" => "07:00", "end" => "20:00"],
    "Tuesday" => ["start" => "08:00", "end" => "20:00"],
    "Wednesday" => ["start" => "07:00", "end" => "20:00"],
    "Thursday" => ["start" => "08:00", "end" => "20:00"],
    "Friday" => ["start" => "07:00", "end" => "20:30"],
    "Saturday" => ["start" => "08:00", "end" => "13:00"],
    "Sunday" => ["start" => "08:00", "end" => "13:00"]
];

// Bepaal de openingstijden voor vandaag
$todayHours = $openingHours[$currentDay];

// Beginstatus van de winkel
$storeStatus = "stored";

// Bepaal het tijdstip van de dag
$timeOfDay = "";

// Indeling van de dag in tijdstippen
if ($currentTime >= "05:00" && $currentTime < "12:00") {
    $timeOfDay = "morning";
} elseif ($currentTime >= "12:00" && $currentTime < "15:00") {
    $timeOfDay = "noon";
} elseif ($currentTime >= "15:00" && $currentTime < "18:00") {
    $timeOfDay = "afternoon";
} elseif ($currentTime >= "18:00" && $currentTime < "21:00") {
    $timeOfDay = "evening";
} else {
    $timeOfDay = "night";
}

// Controleer of de winkel open of gesloten is
if ($todayHours['start'] === "closed") {
    $storeStatus = "The store is closed today.";
} else {
    // Vergelijk de huidige tijd met de openingstijden
    if ($currentTime >= $todayHours['start'] && $currentTime <= $todayHours['end']) {
        $storeStatus = "The store is open";
    } else {
        $storeStatus = "The store is closed";
    }
}
?>
