<?php
$iphone = 1000;
$savings = 1000;

$shortfall = $iphone - $savings;

if ($shortfall > 250) {
    echo "Je hebt meer dan 250 euro tekort.";
} elseif ($shortfall > 0 && $shortfall <= 250) {
    echo "Het lukt bijna!";
} elseif ($shortfall <= 0) {
    echo "Je hebt genoeg geld om de iPhone te kopen!";
}
?>
