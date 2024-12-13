<?php
include "../Controller/CommentaireController.php";

// Initialize the CommentaireController
$commentaireController = new CommentaireController();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $articleId = isset($_POST['article']) ? trim($_POST['article']) : '';
    $contenu = isset($_POST['contenu']) ? trim($_POST['contenu']) : '';

    if (empty($articleId) || empty($contenu)) {
        // Redirect back with an error message if data is missing
        header('Location: addCommentaire.php?error=Please fill all fields');
        exit();
    }

    try {
        // Call the addComment method from the controller
        $commentaireController->addComment($contenu, $articleId);

        // Redirect back with a success message
        header('Location: articleList.php');
    } catch (Exception $e) {
        // Redirect back with an error message
        header('Location: addCommentaire.php?error=' . urlencode($e->getMessage()));
    }
}
?>
