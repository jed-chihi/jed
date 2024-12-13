<?php
include "../Controller/commentaireController.php";
include "../Controller/articlesController.php";
include "../models/commentaire.php";

// Initialize the controllers
$commentaireController = new CommentaireController();
$articleC = new ArticlesController();

// Get the article ID from the URL parameter
$articleId = isset($_GET['article_id']) ? (int)$_GET['article_id'] : 0;

// Get the article details to display the title and author
$article = $articleC->getArticleById($articleId); // Ensure this method exists in your ArticlesController

// Get the comments for the article
$comments = $commentaireController->getCommentsByArticleId($articleId);
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>Comments - Article Details</title>
  <link href="assets/css/main.css" rel="stylesheet">
</head>

<body>

  <header>
    <h1>Comments for Article: <?= htmlspecialchars($article['titre_art']); ?></h1>
    <p>Author: <?= htmlspecialchars($article['nom_user']); ?> | Date: <?= (new DateTime($article['date']))->format('d-m-Y'); ?></p>
  </header>

  <section class="comment-section">
    <?php if (!empty($comments)) : ?>
      <h2>Comments:</h2>
      <ul>
        <?php foreach ($comments as $comment) : ?>
          <li class="comment">
            <strong><?= htmlspecialchars($comment['date']); ?>:</strong> 
            <?= nl2br(htmlspecialchars($comment['contenu'])); ?>
            <div class="comment-buttons">
              <!-- Update Button -->
              <form action="UpdateCommentaire.php" method="GET" style="display:inline-block;">
                <input type="hidden" name="comment_id" value="<?= htmlspecialchars($comment['id']); ?>">
                <button type="submit" class="btn btn-primary">Update</button>
              </form>
              <!-- Optionally, you can add more buttons like Delete here -->
            </div>
          </li>
        <?php endforeach; ?>
      </ul>
    <?php else : ?>
      <p>No comments found for this article.</p>
    <?php endif; ?>
  </section>


  <footer>
    <a href="articleList.php">Back to Articles</a>
  </footer>

</body>
</html>
