<?php
// Set timezone to Europe/Amsterdam
date_default_timezone_set('Europe/Amsterdam');

// Get current day and time
$currentDay = date("l"); // Returns the full name of the day (e.g., "Monday")
$currentTime = date("H:i");
$currentDate = date("l j F Y");

// Store opening hours for each day
$openingHours = [
    "Monday" => ["start" => "closed", "end" => "closed"],
    "Tuesday" => ["start" => "11:00", "end" => "22:00"],
    "Wednesday" => ["start" => "11:00", "end" => "22:00"],
    "Thursday" => ["start" => "15:00", "end" => "22:00"],
    "Friday" => ["start" => "15:00", "end" => "22:00"],
    "Saturday" => ["start" => "15:00", "end" => "22:00"],
    "Sunday" => ["start" => "closed", "end" => "closed"]
];

// Determine if the store is open or closed
$todayHours = $openingHours[$currentDay];

$storeStatus = "stored";

// Determine the time of day
$timeOfDay = "";

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

if ($todayHours['start'] === "closed") {
    $storeStatus = "The store is closed today.";
} else {
    if ($currentTime >= $todayHours['start'] && $currentTime <= $todayHours['end']) {
        $storeStatus = "The store is open.";
    } else {
        $storeStatus = "The store is closed.";
    }
}
?>
