<?php
try {
    // Establish database connection
    $db = new PDO("mysql:host=localhost;dbname=users", "root", "");
} catch (PDOException $e) {
    die("Error!: " . $e->getMessage());
}

// Fetch all grades
$query = $db->prepare("SELECT * FROM grades");
$query->execute();
$grades = $query->fetchAll(PDO::FETCH_ASSOC);

// Fetch the maximum grade
$maxGradeQuery = $db->prepare("SELECT MAX(grade) as max_grade FROM grades");
$maxGradeQuery->execute();
$maxGrade = $maxGradeQuery->fetch(PDO::FETCH_ASSOC)['max_grade'];

// Fetch the minimum grade
$minGradeQuery = $db->prepare("SELECT MIN(grade) as min_grade FROM grades");
$minGradeQuery->execute();
$minGrade = $minGradeQuery->fetch(PDO::FETCH_ASSOC)['min_grade'];

// Fetch the average grade
$avgGradeQuery = $db->prepare("SELECT AVG(grade) as avg_grade FROM grades");
$avgGradeQuery->execute();
$avgGrade = $avgGradeQuery->fetch(PDO::FETCH_ASSOC)['avg_grade'];
?>


<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Grades Table</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
            crossorigin="anonymous"></script>
</head>
<body>
<div class="container">
    <h1 class="mt-4">Student Grades</h1>
    <table class="table table-bordered">
        <thead>
        <tr>
            <th>Name</th>
            <th>Grade</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($grades as $grade) : ?>
            <tr>
                <td><?= htmlspecialchars($grade['student']) ?></td>
                <td><?= htmlspecialchars($grade['grade']) ?></td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>

    <div class="mt-3">
        <p><strong>Average Grade:</strong> <?= number_format($avgGrade, 2) ?></p>
        <p><strong>Highest Grade:</strong> <?= htmlspecialchars($maxGrade) ?></p>
        <p><strong>Lowest Grade:</strong> <?= htmlspecialchars($minGrade) ?></p>
    </div>
</div>
</body>
</html>
