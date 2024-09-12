<?php
$currentTime = date("H:i");

$morningStart = "06:00";
$morningEnd = "12:00";
$afternoonStart = "12:00";
$afternoonEnd = "18:00";
$eveningStart = "18:00";
$eveningEnd = "23:59";
$nightStart = "00:00";
$nightEnd = "05:59";

if ($currentTime >= $morningStart && $currentTime <= $morningEnd) {
    echo "It's morning.";
} elseif ($currentTime >= $afternoonStart && $currentTime <= $afternoonEnd) {
    echo "It's afternoon.";
} elseif ($currentTime >= $eveningStart && $currentTime <= $eveningEnd) {
    echo "It's evening.";
} else {
    echo "It's night.";
}
?>
