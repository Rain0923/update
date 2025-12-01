<?php
header("Content-Type: application/json");

// Direct database connection to avoid output from db.php
$host = "localhost";
$user = "root";
$pass = "";
$db   = "gamification_db";

// Connect to MySQL
$conn = new mysqli($host, $user, $pass, $db);

// Check connection
if ($conn->connect_error) {
    echo json_encode(['error' => 'Connection failed: ' . $conn->connect_error]);
    exit;
}

// Set charset to UTF-8
$conn->set_charset("utf8");

// Get parameters from query string
$level = isset($_GET['level']) ? intval($_GET['level']) : null;
$difficulty = isset($_GET['difficulty']) ? $_GET['difficulty'] : null;

// Build query based on parameters
$sql = "SELECT * FROM quiz_questions WHERE 1=1";
$params = [];
$types = "";

if ($level !== null && $level > 0) {
    $sql .= " AND level = ?";
    $params[] = $level;
    $types .= "i";
}

if ($difficulty !== null && $difficulty !== '') {
    $sql .= " AND difficulty = ?";
    $params[] = $difficulty;
    $types .= "s";
}

$sql .= " ORDER BY RAND()";

// Prepare and execute query
if (!empty($params)) {
    // Use prepared statement when parameters are provided
    $stmt = $conn->prepare($sql);
    if ($stmt) {
        $stmt->bind_param($types, ...$params);
        $stmt->execute();
        $result = $stmt->get_result();
        $stmt->close();
    } else {
        // Fallback to simple query if prepare fails
        $result = $conn->query($sql);
    }
} else {
    // No parameters, use simple query
    $result = $conn->query($sql);
}

$questions = [];

// Check for query errors
if (!$result) {
    $error = ['error' => 'Query failed: ' . $conn->error];
    echo json_encode($error);
    $conn->close();
    exit;
}

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $questions[] = $row;
    }
}

// Close connection
$conn->close();

// Return questions array (empty if none found)
echo json_encode($questions);
?>

