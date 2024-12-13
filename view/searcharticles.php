<?php
include "../Controller/articlesController.php";

// Initialize the controller
$articleC = new ArticlesController();

// Get the search term from the GET parameter
$searchTerm = isset($_GET['search']) ? $_GET['search'] : '';

// Fetch search results
$list = $articleC->searchArticles($searchTerm);

// Generate the HTML for the search results
foreach ($list as $article): ?>
  <div class="col-md-6 col-lg-4 mb-4 article-card">
    <div class="card h-100">
      <div class="card-body d-flex flex-column">
        <h5 class="card-title"><?= htmlspecialchars($article['titre_art']); ?></h5>
        <p class="card-text text-muted">
          <small>
            Author: <?= htmlspecialchars($article['nom_user']); ?> |
            <?= (new DateTime($article['date']))->format('d-m-Y'); ?>
          </small>
        </p>
        <p class="card-text"><?= nl2br(htmlspecialchars($article['contenu'])); ?></p>
      </div>
    </div>
  </div>
<?php endforeach; ?>

