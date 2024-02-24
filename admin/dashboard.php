<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin Dashboard</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
  <style>
    body {
      font-family: Arial, sans-serif;
      background-color: #f4f4f4;
      margin: 0;
      padding: 0;
    }

    .container {
      max-width: 800px;
      margin: 0 auto;
      padding: 20px;
    }

    h2 {
      color: #333;
    }

    p {
      color: #555;
    }

    a {
      color: #007BFF;
      text-decoration: none;
      display: inline-block;
      margin-top: 10px;
    }

    a:hover {
      color: #0056b3;
    }
  </style>
</head>

<body>

  <?php
  session_start();

  // Check if the user is not logged in, redirect to login page
  if (!isset($_SESSION['username'])) {
    header("Location: index.php");
    exit();
  }
  ?>

  <nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">
      <a class="navbar-brand" href="#">
        <h2 class="text-center">Welcome, <?php echo $_SESSION['username']; ?>!</h2>
      </a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse justify-content-center" id="navbarNav">
        <ul class="navbar-nav">
          <li class="nav-item active">
            <a class="nav-link" href="#">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">Features</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">About</a>
          </li>
        </ul>
      </div>
      <div class="collapse navbar-collapse justify-content-end">
        <ul class="navbar-nav">
          <li class="nav-item">
            <a class="nav-link" href="logout.php">Logout</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>

  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">

      </div>
    </div>

    <div class="row">
      <div class="col-md-3">
        <!-- Navigation Links -->
        <ul class="list-group">
          <li class="list-group-item"><a href="#" onclick="loadPage('Add_Doctor.php')">Add Doctor</a></li>
          <li class="list-group-item"><a href="#" onclick="loadPage('Manage_Doctor.php')">Manage Doctor</a></li>
          <li class="list-group-item"><a href="#" onclick="loadPage('Add_Specialization.php')">Add Specialization</a></li>
          <li class="list-group-item"><a href="#" onclick="loadPage('Add_Sub_Specialization.php')">Add Sub_Specialization</a></li>
          <li class="list-group-item"><a href="#" onclick="loadPage('Add_Clinic.php')">Add Clinic</a></li>
          <li class="list-group-item"><a href="#" onclick="loadPage('Manage_Clinic.php')">Manage Clinic</a></li>
          <li class="list-group-item"><a href="#" onclick="loadPage('Today_Appointment_List.php')">Today Appointment List</a></li>
          <li class="list-group-item"><a href="#" onclick="loadPage('Manage_Appointment_List.php')">Manage Appointment List</a></li>
          <li class="list-group-item"><a href="#" onclick="loadPage('Employee_Detail.php')">Employee Detail</a></li>
          <li class="list-group-item"><a href="#" onclick="loadPage('Add_Employee.php')">Add_Employee</a></li>
          <li class="list-group-item"><a href="#" onclick="loadPage('Other.php')">Other</a></li>
        </ul>
      </div>

      <div class="col-md-9" id="main-content">
        <!-- Placeholder for dynamic content -->
      </div>
    </div>
  </div>

  <!-- Add Bootstrap JS and Popper.js scripts here -->
  <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"></script>

  <script>
    function loadPage(page) {
      $.ajax({
        url: page,
        type: 'GET',
        success: function(data) {
          $('#main-content').html(data);
        },
        error: function() {
          alert('Error loading the page.');
        }
      });
    }
  </script>
<script>
    $(document).ready(function () {
        // Load the initial content (you can replace 'initial_content.php' with the initial content you want to load)
        loadPage('initial_content.php');

        // Function to load content dynamically
        function loadPage(page) {
            $.ajax({
                url: page,
                type: 'GET',
                success: function (data) {
                    $('#main-content').html(data);
                },
                error: function () {
                    alert('Error loading the page.');
                }
            });
        }

        // Function to load edit_doctor.php when a link is clicked
        $('#loadEditDoctor').click(function (e) {
            e.preventDefault();
            loadPage('edit_doctor.php');
        });
    });
</script>
</body>

</html>
