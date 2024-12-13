<?php
// Include necessary files
require_once "../Controller/articlesController.php";
require_once "../Controller/commentaireController.php"; // Include the Comment Controller

// Initialize the controllers
$articleController = new ArticlesController();
$commentaireController = new CommentaireController();

// Get the search term from the URL parameter if set
$searchTerm = isset($_GET['search']) ? $_GET['search'] : '';

// Fetch the list of articles based on the search term
$articleList = $articleController->searchArticles($searchTerm); // Assume a searchArticles() method exists in the controller
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>Articles - PhotoFolio Bootstrap Template</title>

  <!-- Favicons -->
  <link href="assets/img/favicon.png" rel="icon">
  <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Fonts -->
  <link href="https://fonts.googleapis.com" rel="preconnect">
  <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;700&family=Inter:wght@400;700&display=swap" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/vendor/aos/aos.css" rel="stylesheet">
  <link href="assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
  <link href="assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

  <!-- Main CSS File -->
  <link href="assets/css/main.css" rel="stylesheet">

  <style>
    /* Styling for dark comment section */
    .comment-form {
      margin-top: 20px;
    }

    .comment-form textarea {
      width: 100%;
      padding: 10px;
      background-color: black;
      color: white;
      border: 1px solid #ccc;
      border-radius: 4px;
    }

    .comment-form textarea::placeholder {
      color: #aaa;
    }

    .comment-form button {
      background-color: #28a745;
      /* Green background */
      color: white;
      border: 1px solid #28a745;
      /* Border color matches the button */
      border-radius: 4px;
      padding: 5px 10px;
      width: 100%;
      cursor: pointer;
      /* Pointer cursor on hover */
      transition: background-color 0.3s, border-color 0.3s;
      /* Smooth transition */
    }

    .comment-form button:hover {
      background-color: #218838;
      /* Darker green for hover */
      border-color: #218838;
      /* Matches the hover background */
      color: white;
    }

    .card {
      background-color: black;
      color: white;
      border: 1px solid #444;
    }

    .card-title {
      color: #f5f5f5;
    }

    .card-text {
      color: #bbb;
    }

    .author-info {
      color: white;
      /* Set both author name and date color to white */
    }

    .search-bar {
      margin-bottom: 20px;
    }

    .search-bar input {
      width: 100%;
      padding: 10px;
      border: 1px solid #ccc;
      border-radius: 4px;
    }

    .search-message {
      margin-bottom: 20px;
      color: #f5f5f5;
      text-align: center;
    }
    .pagination {
    margin-top: 20px;
  }

  .pagination .btn {
    margin: 0 5px;
    padding: 10px 15px;
    border: none;
    border-radius: 4px;
    cursor: pointer;
  }

  .pagination .btn-primary {
    background-color: #007bff;
    color: white;
  }

  .pagination .btn-secondary {
    background-color: #f1f1f1;
    color: #333;
  }

  .pagination .btn:hover {
    background-color: #0056b3;
    color: white;
  }
  </style>
</head>

<body class="Articles-page">
  <header id="header" class="header d-flex align-items-center sticky-top">
    <div class="container-fluid position-relative d-flex align-items-center justify-content-between">
      <a href="index.html" class="logo d-flex align-items-center me-auto me-xl-0">
        <i class="bi bi-camera"></i>
        <h1 class="sitename">Heritage Tunisie</h1>
      </a>
      <nav id="navmenu" class="navmenu">
        <ul>
          <li><a href="index.html">Home<br></a></li>
          <li><a href="about.html">About</a></li>
          <li><a href="services.html">Services</a></li>
          <li><a href="contact.html" class="active">Articles</a></li>
        </ul>
        <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
      </nav>
    </div>
  </header>

  <main class="main">
    <div class="page-title" data-aos="fade">
      <div class="heading">
        <div class="container">
          <div class="row d-flex justify-content-center text-center">
            <div class="col-lg-8">
              <h1>Articles</h1>
              <p class="mb-0">Welcome.</p>
            </div>
          </div>
        </div>
      </div>
      <nav class="breadcrumbs">
        <div class="container">
          <ol>
            <li><a href="index.html">Home</a></li>
            <li class="current">Articles</li>
          </ol>
        </div>
      </nav>
    </div>
    <?php
// Include necessary files
require_once "../Controller/articlesController.php";
require_once "../Controller/commentaireController.php"; // Include the Comment Controller

// Initialize the controllers
$articleController = new ArticlesController();
$commentaireController = new CommentaireController();

// Get the search term from the URL parameter if set
$searchTerm = isset($_GET['search']) ? $_GET['search'] : '';

// Fetch the list of articles based on the search term
$articleList = $articleController->searchArticles($searchTerm); // Assume a searchArticles() method exists in the controller
?>
<section id="Articles" class="section">
  <div class="container">
    <!-- Search Form -->
    <form method="GET" action="articlesList.php" class="mb-4">
      <div class="input-group">
        <input type="text" class="form-control" id="searchInput" name="search" placeholder="Search articles..." value="<?= htmlspecialchars($searchTerm) ?>">
        
      </div>
    </form>

    <!-- Display Search Message -->
    <?php if ($searchTerm): ?>
      <div class="search-message">
        <p>Showing results for: <strong><?= htmlspecialchars($searchTerm); ?></strong></p>
        <?php if (empty($articleList)): ?>
          <p>No articles found matching your search.</p>
        <?php endif; ?>
      </div>
    <?php endif; ?>

    <div class="row" id="articleContainer" data-aos="fade-up" data-aos-delay="300">
  <?php if (!empty($articleList)) : ?>
    <?php foreach ($articleList as $article) : ?>
      <div class="col-md-6 col-lg-4 mb-4 article-card" data-title="<?= htmlspecialchars(strtolower($article['titre_art'])); ?>">
        <div class="card h-100">
          <div class="card-body d-flex flex-column">
            <h5 class="card-title"><?= htmlspecialchars($article['titre_art']); ?></h5>
            <p class="card-text text-muted">
              <small class="author-info">
                Author: <?= htmlspecialchars($article['nom_user']); ?> |
                <?= (new DateTime($article['date']))->format('d-m-Y'); ?>
              </small>
            </p>
            <p class="card-text"><?= nl2br(htmlspecialchars($article['contenu'])); ?></p>
            <div class="mt-auto">
              <!-- Comment Form -->
              <form action="addCommentaire.php" method="POST" class="comment-form">
                <input type="hidden" name="article" value="<?= htmlspecialchars($article['id']); ?>" />
                <textarea name="contenu" rows="2" placeholder="Write your comment..."></textarea>
                <button type="submit" class="btn">Submit Comment</button>
              </form>
              <!-- Button to view comments -->
              <a href="commentaireList.php?article_id=<?= htmlspecialchars($article['id']); ?>" class="btn btn-info mt-2">View Comments</a>
              <!-- Update Article Button -->
              <a href="UpdatesArticles.php?id=<?= htmlspecialchars($article['id']); ?>" class="btn btn-warning mt-2">Update Article</a>
            </div>
          </div>
        </div>
      </div>
    <?php endforeach; ?>
  <?php else : ?>
    <div class="col-12">
      <p class="text-center">No articles found.</p>
    </div>
  <?php endif; ?>
</div>

    <p id="noArticlesMessage" style="display: none; color: red; text-align: center;">
  No articles found matching your search.
</p>

  </div>
</section>
 
  </main>

  <footer id="footer" class="footer">
    <div class="container">
      <div class="copyright text-center">
      </div>
    </div>
  </footer>

  <a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <div id="preloader">
    <div class="line"></div>
  </div>

  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/aos/aos.js"></script>
  <script src="assets/vendor/glightbox/js/glightbox.min.js"></script>
  <script src="assets/vendor/swiper/swiper-bundle.min.js"></script>
  <script src="assets/js/main.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@tensorflow/tfjs"></script>
  <script src="https://cdn.jsdelivr.net/npm/@tensorflow-models/toxicity"></script>

 

 
  

  <script>
  document.addEventListener('DOMContentLoaded', function () {
    const searchInput = document.getElementById('searchInput');
    const articleContainer = document.getElementById('articleContainer');
    const articles = articleContainer.querySelectorAll('.article-card');
    const noArticlesMessage = document.getElementById('noArticlesMessage'); // Message container

    searchInput.addEventListener('input', function () {
      const filter = searchInput.value.toLowerCase().trim();
      let articlesFound = false; // Track if any articles match

      if (filter === '') {
        // Show all articles and hide the "no articles found" message
        articles.forEach(article => {
          article.style.display = '';
        });
        noArticlesMessage.style.display = 'none';
        return;
      }

      // Filter articles
      articles.forEach(article => {
        const title = article.getAttribute('data-title');
        if (title.includes(filter)) {
          article.style.display = '';
          articlesFound = true; // At least one article matches
        } else {
          article.style.display = 'none';
        }
      });

      // Show "no articles found" message if no matches are found
      noArticlesMessage.style.display = articlesFound ? 'none' : 'block';
    });
  });
</script>


<script>
  document.addEventListener('DOMContentLoaded', function () {
    const forms = document.querySelectorAll('.comment-form'); // Select all comment forms
    const threshold = 0.1; // Confidence threshold for toxicity detection

    // Load the Toxicity model
    toxicity.load(threshold).then(model => {
      forms.forEach(form => {
        form.addEventListener('submit', async function (event) {
          const textarea = form.querySelector('textarea');
          const comment = textarea.value.trim();

          // Check if the comment is empty
          if (comment === '') {
            alert('Comment cannot be empty.');
            event.preventDefault();
            return;
          }

          event.preventDefault(); // Prevent form submission initially
          
          try {
            // Classify the comment for toxicity
            const predictions = await model.classify(comment);
            let isToxic = false;

            // Check for any toxic results with a confidence above the threshold
            predictions.forEach(prediction => {
              if (prediction.results[0].match) {
                isToxic = true;
              }
            });

            if (isToxic) {
              alert('inappropriate  language detected.');
            } else {
              // If not toxic, manually submit the form
              form.submit();
            }
          } catch (error) {
            console.error('Error classifying the comment:', error);
            alert('There was an issue processing your comment. Please try again.');
          }
        });
      });
    }).catch(error => {
      console.error('Error loading the toxicity model:', error);
      alert('Comment moderation is temporarily unavailable. Please try again later.');
    });
  });
</script>
<script>
  document.addEventListener('DOMContentLoaded', function () {
    const articlesPerPage = 6; // Number of articles per page
    const articleContainer = document.getElementById('articleContainer');
    const paginationContainer = document.createElement('div'); // Pagination container
    paginationContainer.className = 'pagination text-center';
    articleContainer.insertAdjacentElement('afterend', paginationContainer);

    // Get all articles
    const articles = Array.from(articleContainer.querySelectorAll('.article-card'));
    let filteredArticles = articles; // Start with all articles
    let currentPage = 1;

    // Function to display a specific page of filtered articles
    function displayPage(page) {
      const startIndex = (page - 1) * articlesPerPage;
      const endIndex = startIndex + articlesPerPage;

      // Show only the filtered articles in the current page range
      filteredArticles.forEach((article, index) => {
        article.style.display = index >= startIndex && index < endIndex ? '' : 'none';
      });

      // Update the pagination UI
      updatePagination(page);
    }

    // Function to create and update pagination buttons
    function updatePagination(activePage) {
      const totalPages = Math.ceil(filteredArticles.length / articlesPerPage);
      paginationContainer.innerHTML = ''; // Clear existing pagination buttons

      for (let i = 1; i <= totalPages; i++) {
        const pageButton = document.createElement('button');
        pageButton.textContent = i;
        pageButton.className = 'page-btn btn';
        if (i === activePage) {
          pageButton.classList.add('btn-primary');
        } else {
          pageButton.classList.add('btn-secondary');
        }
        pageButton.addEventListener('click', () => {
          currentPage = i;
          displayPage(i);
        });
        paginationContainer.appendChild(pageButton);
      }

      // Show no articles message if no articles match
      const noArticlesMessage = document.getElementById('noArticlesMessage');
      noArticlesMessage.style.display = filteredArticles.length === 0 ? 'block' : 'none';
    }

    // Function to filter articles based on search input
    function filterArticles(searchTerm) {
      const filter = searchTerm.toLowerCase().trim();
      filteredArticles = articles.filter(article => {
        const title = article.getAttribute('data-title');
        return title.includes(filter);
      });

      // Reset to page 1 after filtering and display updated articles
      currentPage = 1;
      displayPage(currentPage);
    }

    // Event listener for search input
    const searchInput = document.getElementById('searchInput');
    searchInput.addEventListener('input', function () {
      filterArticles(searchInput.value);
    });

    // Initialize the first page with all articles
    displayPage(1);
  });
</script>




</body>
</html>











