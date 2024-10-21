<?php

include_once'horizonStudents.php';

$host = 'localhost';
$dbname = 'restful';
$username = 'root';
$password = '';

$db = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$studentApi = new horizonStudents($db);


$method = $_SERVER['REQUEST_METHOD'];

switch ($method) {
    case 'GET':
        // Get all students or a specific student by ID
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            $response = $studentApi->getStudent($id);
        } else {
            $response = $studentApi->getAllStudents();
        }
        break;

    case 'POST':
        // Add a new student
        $data = json_decode(file_get_contents('php://input'), true);
        $response = $studentApi->addStudent($data);
        break;

    case 'PUT':
        // Update a student by ID
        $data = json_decode(file_get_contents('php://input'), true);
        $id = $data['IndexNo'];
        $response = $studentApi->updateStudent($id, $data);
        break;

    case 'DELETE':
            // Delete a student by ID
            parse_str(file_get_contents('php://input'), $deleteData);
            $id = $deleteData['IndexNo'] ?? null; // Use null if 'IndexNo' is not set
            if ($id !== null) {
                $response = $studentApi->deleteStudent($id);
            } else {
                $response = array('message' => 'No student ID provided for deletion.');
            }
            break;
        
        

    default:
        $response = array('message' => 'Invalid HTTP method.');
        break;
}


header('Content-Type: application/json');
echo json_encode($response);    
?>
