<?php
$milesToKmConversionFactor = 1.60934;

$startMiles = 1;
$endMiles = 10;

echo "<table border='1' cellpadding='5' cellspacing='0'>";
echo "<tr><th>Miles</th><th>Kilometers</th></tr>";

for ($miles = $startMiles; $miles <= $endMiles; $miles++) {
    $km = $miles * $milesToKmConversionFactor;
    echo "<tr><td>$miles</td><td>" . number_format($km, 2) . "</td></tr>";
}

echo "</table>";
?>
