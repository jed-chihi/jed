<?php
include "../Controller/commentaireController.php";
include "../Controller/articlesController.php";

// Initialize the controller
$commentaireController = new CommentaireController();

// Check if the comment ID is provided for editing
if (isset($_GET['comment_id']) && !empty($_GET['comment_id'])) {
    $commentId = (int)$_GET['comment_id'];

    // Fetch the comment details
    $comment = $commentaireController->getCommentaireById($commentId);

    if (!$comment) {
        die("Comment not found!");
    }
} else {
    die("No comment ID provided!");
}

// Check if the form is submitted to update the comment
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $updatedContent = $_POST['contenu'] ?? '';

    // Validate input
    if (trim($updatedContent) === '') {
        echo "Comment content cannot be empty!";
    } else {
        // Update the comment
        $commentaireController->updateComment($commentId, $updatedContent);

        // Redirect back to the article comments list after updating
        header("Location: commentaireList.php?article_id=" . $comment['article']);
        exit;
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Comment</title>
    <link href="assets/css/main.css" rel="stylesheet">
</head>

<body>

    <header>
        <h1>Update Comment</h1>
    </header>

    <main>
        <form method="POST" action="">
            <label for="contenu">Comment:</label>
            <textarea name="contenu" id="contenu" rows="4"><?= htmlspecialchars($comment['contenu']); ?></textarea>
            <button type="submit">Update Comment</button>
        </form>
        <a href="commentaireList.php?article_id=<?= htmlspecialchars($comment['article']); ?>">Back to Comments</a>
    </main>

</body>

</html>
