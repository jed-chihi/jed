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
        <p>Create, edit, or manage articles, blogs, and other informational content.</p>
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
