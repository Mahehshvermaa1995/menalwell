<?php

// Helper function to read data from the storage file
function readData()
{
    $dataFile = 'data.json';
    $data = [];

    if (file_exists($dataFile)) {
        $jsonData = file_get_contents($dataFile);
        $data = json_decode($jsonData, true);
    }

    return $data;
}

// Helper function to write data to the storage file
function writeData($data)
{
    $dataFile = 'data.json';
    $jsonData = json_encode($data, JSON_PRETTY_PRINT);
    file_put_contents($dataFile, $jsonData);
}

// Handle different types of requests
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    // Read data
    $data = readData();

    header('Content-Type: application/json');
    echo json_encode($data);
} elseif ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Add data
    $rawData = file_get_contents('php://input');
    $postData = json_decode($rawData, true);

    $data = readData();

    // Generate a new ID (assuming you want to use a simple incremental ID)
    $newId = count($data) + 1;

    // Add the new data with the generated ID
    $data[$newId] = $postData;

    // Save the updated data back to data.json
    writeData($data);

    header('Content-Type: application/json');
    echo json_encode(['status' => 'success', 'id' => $newId]);
} elseif ($_SERVER['REQUEST_METHOD'] === 'PUT') {
    // Edit data
    $jsonData = file_get_contents('php://input');
    $editedData = json_decode($jsonData, true);

    $data = readData();
    $dataId = $editedData['data_id'];

    if (isset($data[$dataId])) {
        $data[$dataId] = $editedData;
        writeData($data);

        http_response_code(200);
        echo json_encode(['message' => 'Data edited successfully']);
    } else {
        http_response_code(404);
        echo json_encode(['error' => 'Data not found']);
    }
} else {
    // Send an error response for unsupported request method
    http_response_code(405);
    echo json_encode(['status' => 'error', 'message' => 'Method Not Allowed']);
}

?>
ds