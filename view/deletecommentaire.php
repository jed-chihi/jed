<?php
require_once "../Controller/CommentaireController.php";

// Create an instance of CommentaireController
$commentaireController = new CommentaireController();

// Check if an ID is provided via POST
if (isset($_POST['id']) && !empty($_POST['id'])) {
    $id = (int)$_POST['id']; // Cast to integer for validation

    try {
        // Call the delete method
        $commentaireController->deleteComment($id);

        // Redirect with a success message to backcommentaire.php
        header("Location: back.php");
        exit();
    } catch (Exception $e) {
        // Redirect with an error message if there is an issue
        header("Location: backcommentaire.php?id=" . urlencode($id) . "&message=" . urlencode("Error: " . $e->getMessage()));
        exit();
    }
} else {
    // Redirect with an error if no ID is provided
    header("Location: backcommentaire.php?message=" . urlencode("Error: No comment ID provided"));
    exit();
}
?>
