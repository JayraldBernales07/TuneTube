<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

include('../security.php');  // Adjust the path if necessary start session

$requestBody = file_get_contents('php://input');
$data = json_decode($requestBody, true);

if (!$data || !isset($data['songId']) || !is_numeric($data['songId'])) {
    echo json_encode(['success' => false, 'message' => 'Invalid data received']);
    exit;
}

$songId = (int) $data['songId'];
$userId = $_SESSION['user_id']; // Ensure user ID is retrieved from session

// Check if the user is logged in 
if (!isset($_SESSION['user_id'])) { 
    echo json_encode(['success' => false, 'message' => 'User not logged in.']); 
    exit;
}

$checkQuery = "SELECT * FROM favorites WHERE UserID = ? AND SongID = ?";
$stmt = $connection->prepare($checkQuery);

if ($stmt === false) {
    echo json_encode(['success' => false, 'message' => 'Failed to prepare statement']);
    exit;
}

$stmt->bind_param("ii", $userId, $songId);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    echo json_encode(['success' => false, 'message' => 'Song is already in favorites.']);
} else {
    $insertQuery = "INSERT INTO favorites (UserID, SongID) VALUES (?, ?)";
    $stmt = $connection->prepare($insertQuery);
    
    if ($stmt === false) {
        echo json_encode(['success' => false, 'message' => 'Failed to prepare insert statement']);
        exit;
    }

    $stmt->bind_param("ii", $userId, $songId);
    
    if ($stmt->execute()) {
        echo json_encode(['success' => true, 'message' => 'Song added to favorites.']);
    } else {
        echo json_encode(['success' => false, 'message' => 'Failed to add song to favorites.']);
    }
}

$stmt->close();
mysqli_close($connection);
?>
