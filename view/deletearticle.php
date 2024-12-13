<?php
include "../Controller/ArticlesController.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id'])) {
    // Sanitize the input ID
    $id = intval($_POST['id']); // Ensure it's an integer

    // Initialize the controller
    $articleC = new ArticlesController();

    try {
        // Call the deleteArticle function
        $articleC->deleteArticle($id);
        
        header('back.php') ;// Send success message back
    } catch (Exception $e) {
        // Return an error message if something goes wrong
        http_response_code(500); // Internal server error
        echo "Error: " . $e->getMessage();
    }
} else {
    // If the request is not a POST or ID is not set, return an error
    http_response_code(400); // Bad request
    echo "Invalid request";
}
