
<?php
include "../Models/articles.php";  // Include the Articles class
include "../Controller/articlesController.php";  // Include the ArticlesController

$article = null;
$error = "";
$showForm = false;

// Create an instance of the controller
$articleController = new ArticlesController();

// Handle the form to fetch article by ID
if (isset($_POST['fetch_id'])) {
    if (!empty($_POST['fetch_id'])) {
        $article = $articleController->getArticleById($_POST['fetch_id']);
        if ($article) {
            $showForm = true;  // Show the update form if the article is found
        } else {
            $error = "Article not found for ID: " . htmlspecialchars($_POST['fetch_id']);
        }
    } else {
        $error = "Please enter a valid article ID.";
    }
}

// Handle the form to update the article
if (
    isset($_POST["titre_art"]) && isset($_POST["contenu"]) && isset($_POST["nom_user"]) && isset($_POST["id"])
) {
    if (
        !empty($_POST["titre_art"]) && !empty($_POST["contenu"]) && !empty($_POST["nom_user"]) && !empty($_POST["id"])
    ) {
        $article = new Articles(
            null,
            $_POST['titre_art'],
            $_POST['contenu'],
            $_POST['nom_user']
        );

        // Call the updateArticle method
        $articleController->updateArticle($article, $_POST['id']);

        // Redirect to the article list page
        header('Location: articleList.php');
        exit(); // Ensure no further code is executed
    } else {
        $error = "Missing information to update the article.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Article</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
<div class="container mt-5">
    <h1>Update Article</h1>

    <?php if ($error): ?>
        <div class="alert alert-danger">
            <?= htmlspecialchars($error); ?>
        </div>
    <?php endif; ?>

    <?php if (!$showForm): ?>
        <!-- Step 1: Fetch Article by ID -->
        <form method="POST" action="">
            <div class="form-group">
                <label for="fetch_id">Enter Article ID to Update:</label>
                <input class="form-control" type="number" id="fetch_id" name="fetch_id" required>
            </div>
            <button type="submit" class="btn btn-primary">Fetch Article</button>
        </form>
    <?php else: ?>
        <!-- Step 2: Update Form -->
        <form method="POST" action="">
            <div class="form-group">
                <label for="id">Article ID:</label>
                <input class="form-control" type="text" id="id" name="id" readonly value="<?= htmlspecialchars($article['id']); ?>">
            </div>

            <div class="form-group">
                <label for="titre_art">Title:</label>
                <input class="form-control" type="text" id="titre_art" name="titre_art" value="<?= htmlspecialchars($article['titre_art']); ?>" required>
            </div>

            <div class="form-group">
                <label for="contenu">Content:</label>
                <textarea class="form-control" id="contenu" name="contenu" rows="5" required><?= htmlspecialchars($article['contenu']); ?></textarea>
            </div>

            <div class="form-group">
                <label for="nom_user">Author Name:</label>
                <input class="form-control" type="text" id="nom_user" name="nom_user" value="<?= htmlspecialchars($article['nom_user']); ?>" required>
            </div>

            <button type="submit" class="btn btn-success">Update Article</button>
        </form>
    <?php endif; ?>

    <a href="articleList.php" class="btn btn-secondary mt-3">Back to Article List</a>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
