<?php

// Define base directory
$baseDir = __DIR__ . '/../';

// Include necessary files
require_once $baseDir . 'controllers/messageController.php';

// Define routes
$routes = [
    'set-key' => $baseDir . 'views/set_key.html',
    'send-message' => $baseDir . 'views/send_message.html',
    'read-messages' => $baseDir . 'views/show_message.html',
    'read-message' => $baseDir . 'controllers/messageController.php',
    'checkrecipient' => $baseDir . 'controllers/messageController.php',
    'home' => $baseDir . 'index.php',
];

// Get the requested route
if (isset($_GET['page'])) {
    $path = $_GET['page'];
} else {
    // Handle case where 'page' parameter is missing
    echo "404 Not Found";
    exit; // Stop further execution
}

// Route the request
if (array_key_exists($path, $routes)) {
    $page = $routes[$path];
    include("$page");
} else {
    echo "404 Not Found";
}

?>
