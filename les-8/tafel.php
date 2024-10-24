<?php
$tafel = 3;
$som = 0;
$optelsom = "";  // Deze string zal de optelsom opslaan

// Start de HTML-tabel
echo "<table border='1' cellpadding='5' cellspacing='0'>";
echo "<tr><th>Tafel van $tafel</th><th>Resultaat</th></tr>";

// Loop door de tafel en bereken de producten
for ($i = 1; $i <= 10; $i++) {
    $result = $tafel * $i;
    echo "<tr><td>$tafel x $i</td><td>$result</td></tr>";

    // Bouw de optelsom string op
    if ($i == 1) {
        $optelsom .= "$result";  // Eerste getal zonder plus ervoor
    } else {
        $optelsom .= " + $result";  // Voeg getallen toe met plus ervoor
    }

    $som += $result;  // Tel op bij de som
}

// Voeg een laatste rij toe met de optelsom
echo "<tr><td><strong>Optelsom</strong></td><td><strong>$optelsom = $som</strong></td></tr>";

// Sluit de tabel
echo "</table>";
?>
