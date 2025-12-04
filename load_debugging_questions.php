<?php
include 'db.php';

// Get selected language and difficulty (optional)
$language = $_GET['language'] ?? 'Python';
$difficulty = $_GET['difficulty'] ?? 'Beginner';

$sql = "SELECT * FROM debugging_questions 
        WHERE language = '$language' AND difficulty = '$difficulty'
        ORDER BY level ASC";

$result = mysqli_query($conn, $sql);

$questions = [];

while ($row = mysqli_fetch_assoc($result)) {
    $questions[] = $row;
}

// Send JSON to the JS frontend
header('Content-Type: application/json');
echo json_encode($questions);
?>
