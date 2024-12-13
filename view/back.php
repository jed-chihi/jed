<?php
include "../Controller/ArticlesController.php";

// Initialize the controller
$articleC = new ArticlesController();

// Fetch the list of articles
$list = $articleC->articleList(); // This will now return an array of results

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $articleId = $_POST['id'];

  try {
      // Database connection
      $pdo = new PDO('mysql:host=localhost;dbname=jed', 'username', 'password');
      $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

      // Delete related comments
      $deleteCommentsQuery = $pdo->prepare("DELETE FROM commentaires WHERE article = :articleId");
      $deleteCommentsQuery->bindParam(':articleId', $articleId, PDO::PARAM_INT);
      $deleteCommentsQuery->execute();

      // Delete the article
      $deleteArticleQuery = $pdo->prepare("DELETE FROM articles WHERE id = :articleId");
      $deleteArticleQuery->bindParam(':articleId', $articleId, PDO::PARAM_INT);
      $deleteArticleQuery->execute();

      echo "Article and its comments deleted successfully.";
  } catch (PDOException $e) {
      echo "Error: " . $e->getMessage();
  }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Heritage Tunisie Admin Dashboard</title>
  <style>
    /* General Reset */
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
      font-family: Arial, sans-serif;
    }

    body {
      display: flex;
      min-height: 100vh;
      background-color: #000;
      /* Black background */
      color: #fff;
      /* White text for readability */
    }

    /* Sidebar */
    .sidebar {
      width: 250px;
      background-color: #121212;
      /* Dark black for sidebar */
      display: flex;
      flex-direction: column;
      padding: 20px 0;
    }

    .sidebar h2 {
      text-align: center;
      margin-bottom: 20px;
      font-size: 18px;
      color: #fff;
      /* White text for the title */
    }

    .sidebar a {
      color: #fff;
      text-decoration: none;
      padding: 10px 20px;
      border-radius: 5px;
      margin: 5px 10px;
      display: block;
      transition: background-color 0.3s;
    }

    .sidebar a:hover {
      background-color: #333;
      /* Slightly lighter black for hover */
    }

    .sidebar a.active {
      background-color: #16a085;
      /* Green for the active link */
      color: #fff;
      /* White text for contrast */
    }

    /* Main Content */
    .main-content {
      flex: 1;
      padding: 20px;
      display: flex;
      flex-direction: column;
      justify-content: space-between;
      background-color: #000;
      /* Match main content background with body */
    }

    .main-header {
      margin-bottom: 20px;
    }

    .main-header h1 {
      font-size: 24px;
      color: #16a085;
      /* Green for header text */
    }

    .main-section {
      flex: 1;
      background-color: #121212;
      /* Dark black for the content box */
      padding: 20px;
      border-radius: 8px;
      box-shadow: 0 2px 4px rgba(0, 0, 0, 0.5);
      /* Subtle shadow for the content */
    }

    .main-section h2 {
      margin-bottom: 10px;
      color: #16a085;
      /* Green for section headings */
    }
    /* Articles Table Styling */
.table {
  border-collapse: collapse;
  background-color: #121212; /* Matches the sidebar and main section */
  color: #fff; /* White text for readability */
}

.table-hover tbody tr:hover {
  background-color: #1e1e1e; /* Slightly lighter black on hover */
}

.table-bordered th, .table-bordered td {
  border: 1px solid #333; /* Subtle border to match dark theme */
}

.table-primary {
  background-color: #16a085; /* Matches the green theme of headers */
  color: #fff;
  font-weight: bold;
}

.table-responsive {
  margin-top: 20px;
  padding: 10px;
  background-color: #000; /* Matches dark background */
  border-radius: 8px;
  box-shadow: 0 2px 4px rgba(0, 0, 0, 0.6); /* Subtle shadow */
}

/* Buttons in Table */
.btn-sm {
  font-size: 0.8rem;
  padding: 5px 10px;
  margin: 2px;
}

.btn-info {
  background-color: #17a2b8;
  border-color: #17a2b8;
}

.btn-danger {
  background-color: #dc3545;
  border-color: #dc3545;
}

.btn:hover {
  opacity: 0.9;
  transform: scale(1.05);
  transition: 0.2s ease;
}
/* Ensure the table takes the full width */
.wide-table {
  width: 100%; /* Stretch to full container width */
  table-layout: auto; /* Allow columns to adjust based on content */
}

/* Adjust specific column widths for better spacing */
.wide-table th, .wide-table td {
  white-space: nowrap; /* Prevent text wrapping for cleaner rows */
  padding: 10px;
}

/* Maximize container space for the table */
.table-responsive {
  width: 100%;
  margin: 0 auto; /* Center the table container */
  padding: 10px;
}

/* Optional: Add horizontal scrolling for small screens */
@media (max-width: 768px) {
  .table-responsive {
    overflow-x: auto;
  }
}



    

    /* Footer */
    .footer {
      text-align: center;
      padding: 10px;
      background-color: #121212;
      /* Footer matches sidebar and content */
      color: #fff;
      border-radius: 8px;
    }
  </style>
</head>

<body>
  <!-- Sidebar -->
  <div class="sidebar">
    <h2>Heritage Tunisie</h2>
    <a href="#dashboard" class="active" data-target="dashboard">Dashboard</a>
    <a href="#community" data-target="community">Community Management</a>
    <a href="#sites" data-target="sites">Heritage Sites</a>
    <a href="#events" data-target="events">Cultural Events</a>
    <a href="#articles" data-target="articles">Articles & Resources</a>
    <a href="#purchases" data-target="purchases">Purchases</a>
  </div>

  <!-- Main Content -->
  <div class="main-content">
    <!-- Header -->
    <div class="main-header">
      <h1>Welcome to Heritage Tunisie</h1>
    </div>

    <!-- Section -->
    <div class="main-section" id="content">
      <h2>Dashboard Overview</h2>
      <p>Welcome to the Heritage Tunisie admin dashboard. Select a section to begin managing data.</p>
    </div>

    

    <!-- Footer -->
    <footer class="footer">
      © 2024 Heritage Tunisie. Preserving Tunisia's Legacy.
    </footer>
  </div>

  <script>
    // Get all navigation links
    const navLinks = document.querySelectorAll('.sidebar a');
    const content = document.getElementById('content');

    // Content for each section
    const sections = {
      dashboard: `
        <h2>Dashboard Overview</h2>
        <p>Welcome to the Heritage Tunisie admin dashboard. Select a section to begin managing data.</p>
      `,
      community: `
        <h2>Community Management</h2>
        <p>Manage users and contributors involved in heritage preservation projects.</p>
      `,
      sites: `
        <h2>Heritage Sites</h2>
        <p>Maintain and update information about Tunisian historical sites and landmarks.</p>
      `,
      events: `
        <h2>Cultural Events</h2>
        <p>Manage cultural event schedules and details to engage the community.</p>
      `,
      articles: `
    <h2>Articles & Resources</h2>
   <div class="table-responsive">
  <table class="table table-dark table-hover table-bordered text-center align-middle wide-table">
    <thead class="table-primary">
      <tr>
        <th>ID</th>
        <th>Title</th>
        <th>Content</th>
        <th>Author</th>
        <th>Date</th>
        <th>Actions</th>
      </tr>
    </thead>
    <tbody>
      <?php if (!empty($list)) : ?>
        <?php foreach ($list as $article) : ?>
          <tr>
            <td><?= htmlspecialchars($article['id']); ?></td>
            <td><?= htmlspecialchars($article['titre_art']); ?></td>
            <td><?= htmlspecialchars(substr($article['contenu'], 0, 50)); ?></td>
            <td><?= htmlspecialchars($article['nom_user']); ?></td>
            <td>
              <?php
              $formattedDate = (new DateTime($article['date']))->format('d-m-Y');
              echo htmlspecialchars($formattedDate);
              ?>
            </td>
            <td>
              <a href="backcommentaire.php?id=<?= htmlspecialchars($article['id']); ?>" class="btn btn-info btn-sm">Read Comments</a>
              <form action="deletearticle.php" method="POST" onsubmit="return confirm('Are you sure you want to delete this article?');" style="display:inline;">
                <input type="hidden" name="id" value="<?= htmlspecialchars($article['id']); ?>" />
                <button type="submit" class="btn btn-danger btn-sm">Delete</button>
              </form>
            </td>
          </tr>
        <?php endforeach; ?>
      <?php else : ?>
        <tr>
          <td colspan="6" class="text-warning">No articles found.</td>
        </tr>
      <?php endif; ?>
    </tbody>
  </table>
</div>

  `,
      purchases: `
        <h2>Purchases</h2>
        <p>Track and manage user purchases or orders related to cultural products.</p>
      `
    };

    // Add event listener to each link
    navLinks.forEach(link => {
      link.addEventListener('click', function (e) {
        e.preventDefault();

        // Remove active class from all links
        navLinks.forEach(nav => nav.classList.remove('active'));

        // Add active class to clicked link
        this.classList.add('active');

        // Load the content for the selected section
        const target = this.getAttribute('data-target');
        content.innerHTML = sections[target];
      });
    });
  </script>
</body>

</html>
