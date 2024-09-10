<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Styled Navbar with Animation</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <style>
        /* Navbar styles */
        .navbar {
            background-color: #2d6a4f; /* Deep green background */
            border-bottom: 3px solid #1e4d40; /* Darker green border at the bottom */
            padding: 0.75rem 1.5rem;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1); /* Enhanced shadow for depth */
            transition: background-color 0.3s ease; /* Smooth transition for background color */
            align-items: center; /* Vertically center items in the navbar */
        }
        .navbar:hover {
            background-color: #245a43; /* Darker green on hover */
        }
        .navbar .navbar-nav {
            align-items: center; /* Center items vertically in the navbar */
        }
        .navbar .nav-link img {
            max-height: 40px; /* Adjust thسis value to fit your navbar height */
            width: auto; /* Maintain aspect ratio */
            border-radius: 50%; /* Makes the logo circular */
            border: 2px solid #ffffff; /* Optional: Adds a border around the logo */
            transition: transform 0.3s ease; /* Smooth transition for logo scaling */
        }
        .navbar .nav-link img:hover {
            transform: scale(1.1); /* Slightly scale up the logo on hover */
        }
        .navbar .nav-link {
            color: #ffffff; /* White text color for links */
            font-size: 1rem; /* Consistent font size */
            margin-right: 1rem; /* Space between links */
            display: flex; /* Ensure the logo is centered */
            align-items: center; /* Vertically center the logo */
            transition: color 0.3s ease; /* Smooth transition for link color */
        }
        .navbar .nav-link:hover {
            color: #d1e0e0; /* Light gray color on hover */
        }
        .navbar .navbar-toggler {
            border: none; /* Remove default border */
            background: transparent; /* Ensure background is transparent */
            z-index: 1030; /* Make sure the toggler is above other content */
            transition: transform 0.3s ease; /* Smooth transition for toggler animation */
        }
        .navbar .navbar-toggler-icon {
            background-image: url('data:image/svg+xml,%3Csvg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"%3E%3Cpath fill="none" stroke="%23ffffff" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7" /%3E%3C/svg%3E');
            background-size: 1.5rem 1.5rem; /* Adjust icon size */
            background-repeat: no-repeat;
            background-position: center; /* Center the icon */
        }
        .navbar .navbar-toggler:hover {
            transform: rotate(90deg); /* Rotate the toggler on hover */
        }
        .fullscreen-icon {
            color: #ffffff; /* White color for fullscreen icon */
            transition: color 0.3s ease; /* Smooth transition for icon color */
        }
        .fullscreen-icon:hover {
            color: #d1e0e0; /* Light gray color on hover */
        }
    </style>
</head>
<body>
    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand navbar-dark">
        <!-- Left navbar links -->
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" data-widget="pushmenu" href="#" role="button">
                    <i class="fas fa-bars"></i>
                </a>
            </li>
            <!-- Logo -->
            <li class="nav-item">
                <a class="nav-link" href="./" role="button">
                    <!-- Replace 'logoRE.png' with your actual image file name or URL -->
                    <img src="logoRE.png" alt="Online Survey System Logo">
                </a>
            </li>
        </ul>

        <!-- Right navbar links -->
        <ul class="navbar-nav ml-auto">
            <li class="nav-item">
                <a class="nav-link fullscreen-icon" data-widget="fullscreen" href="#" role="button">
                    <i class="fas fa-expand-arrows-alt"></i>
                </a>
            </li>
        </ul>
    </nav>
    <!-- /.navbar -->

    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
