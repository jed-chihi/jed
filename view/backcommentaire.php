<?php
// Include necessary files
include "../Controller/ArticlesController.php";

// Fetch the article ID from the URL
$articleId = isset($_GET['id']) ? $_GET['id'] : null;

if (!$articleId) {
  echo "Invalid article ID.";
  exit;
}

try {
    // Database connection
    $pdo = new PDO('mysql:host=localhost;dbname=jed', 'root', '');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Fetch comments for the article
    $stmt = $pdo->prepare("SELECT * FROM commentaires WHERE article = :articleId");
    $stmt->bindParam(':articleId', $articleId, PDO::PARAM_INT);
    $stmt->execute();
    $comments = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Heritage Tunisie Admin - Comments</title>
  <style>
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
    <a href="../view/back.php" data-target="articles">Articles & Resources</a>
    <a href="#purchases" data-target="purchases">Purchases</a>
  </div>

  <!-- Main Content -->
  <div class="main-content">
    <!-- Header -->
    <div class="main-header">
      <h1>Comments for Article</h1>
    </div>

    <!-- Section -->
    <div class="main-section" id="content">
      <h2>Comments</h2>

      <!-- Comments Table -->
      <div class="table-responsive">
  <table class="table table-dark table-hover table-bordered text-center align-middle wide-table">
    <thead class="table-primary">
      <tr>
        <th>ID</th>
        <th>Content</th>
        <th>Date</th>
        <th>Actions</th> <!-- New column for actions (Delete) -->
      </tr>
    </thead>
    <tbody>
      <?php if (!empty($comments)) : ?>
        <?php foreach ($comments as $comment) : ?>
          <tr>
            <td><?= htmlspecialchars($comment['id']); ?></td>
            <td><?= htmlspecialchars(substr($comment['contenu'], 0, 50)); ?></td> <!-- Added ellipsis to truncate content -->
            <td>
              <?php
              $formattedDate = (new DateTime($comment['date']))->format('d-m-Y');
              echo htmlspecialchars($formattedDate);
              ?>
            </td>
            <td>
              <!-- Add Delete Button with the comment ID -->
              <form action="deletecommentaire.php" method="POST" style="display:inline;">
    <input type="hidden" name="id" value="<?= htmlspecialchars($comment['id']); ?>">
    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this comment?')">Delete</button>
</form>

            </td>
          </tr>
        <?php endforeach; ?>
      <?php else : ?>
        <tr>
          <td colspan="4" class="text-warning">No comments found for this article.</td>
        </tr>
      <?php endif; ?>
    </tbody>
  </table>
</div>


    <!-- Footer -->
    <footer class="footer">
      © 2024 Heritage Tunisie. Preserving Tunisia's Legacy.
    </footer>
  </div>

</body>

</html>
