<?php
// Include necessary files
include "../models/articles.php";
include "../controller/articlesController.php";

// Check if the form was submitted
if (isset($_POST["titre_art"]) && isset($_POST["contenu"])) {
    if (!empty($_POST["titre_art"]) && !empty($_POST["contenu"])) {
        // Create a new article object
        $article = new Articles(null, $_POST["titre_art"], $_POST["contenu"], null);

        // Initialize the controller and add the article
        $articleC = new ArticlesController();
        $articleC->addArticle($article);

        // Redirect to article list page (or any desired page)
        header("Location: articleList.php");
        exit;
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Article</title>
</head>

<body>
    <form method="post" action="">
        <label for="titre_art">Title:</label>
        <input type="text" name="titre_art" required>
        
        <label for="contenu">Content:</label>
        <textarea name="contenu" rows="4" required></textarea>
        
        <input type="submit" value="Save">
    </form>
</body>

</html>
