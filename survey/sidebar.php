<!-- Main Sidebar -->
<aside class="main-sidebar sidebar-dark-green elevation-4">
  
  <!-- User Info Dropdown -->
  <div class="dropdown">
    <!-- Brand link with user initials and name -->
    <a href="javascript:void(0)" class="brand-link dropdown-toggle" data-toggle="dropdown" aria-expanded="true">
      <!-- Display user initials in a circle -->
      <span class="brand-image img-circle elevation-3 d-flex justify-content-center align-items-center bg-dark-green text-white font-weight-500" style="width: 38px; height:50px">
        <?php echo strtoupper(substr($_SESSION['login_firstname'], 0,1) . substr($_SESSION['login_lastname'], 0,1)) ?>
      </span>
      <!-- Display full user name -->
      <span class="brand-text font-weight-light"><?php echo ucwords($_SESSION['login_firstname'] . ' ' . $_SESSION['login_lastname']) ?></span>
    </a>
    <!-- Dropdown menu -->
    <div class="dropdown-menu">
      <!-- Manage account link -->
      <a class="dropdown-item manage_account" href="javascript:void(0)" data-id="<?php echo $_SESSION['login_id'] ?>">Manage Account</a>
      <!-- Divider between items -->
      <div class="dropdown-divider"></div>
      <!-- Logout link -->
      <a class="dropdown-item" href="ajax.php?action=logout">Logout</a>
    </div>
  </div>
  
  <!-- Sidebar Menu -->
  <div class="sidebar">
    <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column nav-flat" data-widget="treeview" role="menu" data-accordion="false">
        
        <!-- Dashboard Link -->
        <li class="nav-item dropdown">
          <a href="./" class="nav-link nav-home">
            <i class="nav-icon fas fa-tachometer-alt"></i>
            <p>Dashboard</p>
          </a>
        </li>    

        <!-- Check user type -->
        <?php if($_SESSION['login_type'] == 1): ?>
          <!-- Users Management -->
          <li class="nav-item">
            <a href="#" class="nav-link nav-edit_user">
              <i class="nav-icon fas fa-users"></i>
              <p>Users<i class="right fas fa-angle-left"></i></p>
            </a>
            <ul class="nav nav-treeview">
              <!-- Add New User -->
              <li class="nav-item">
                <a href="./index.php?page=new_user" class="nav-link nav-new_user tree-item">
                  <i class="fas fa-angle-right nav-icon"></i>
                  <p>Add New</p>
                </a>
              </li>
              <!-- User List -->
              <li class="nav-item">
                <a href="./index.php?page=user_list" class="nav-link nav-user_list tree-item">
                  <i class="fas fa-angle-right nav-icon"></i>
                  <p>List</p>
                </a>
              </li>
            </ul>
          </li>
          
          <!-- Survey Management -->
          <li class="nav-item">
            <a href="#" class="nav-link nav-is-tree nav-edit_survey nav-view_survey">
              <i class="nav-icon fa fa-poll-h"></i>
              <p>Survey<i class="right fas fa-angle-left"></i></p>
            </a>
            <ul class="nav nav-treeview">
              <!-- Add New Survey -->
              <li class="nav-item">
                <a href="./index.php?page=new_survey" class="nav-link nav-new_survey tree-item">
                  <i class="fas fa-angle-right nav-icon"></i>
                  <p>Add New</p>
                </a>
              </li>
              <!-- Survey List -->
              <li class="nav-item">
                <a href="./index.php?page=survey_list" class="nav-link nav-survey_list tree-item">
                  <i class="fas fa-angle-right nav-icon"></i>
                  <p>List</p>
                </a>
              </li>
            </ul>
          </li>
          
          <!-- Survey Report -->
          <li class="nav-item">
            <a href="./index.php?page=survey_report" class="nav-link nav-survey_report">
              <i class="nav-icon fas fa-poll"></i>
              <p>Poll Report</p>
            </a>
          </li>
        <?php else: ?>
          <!-- Survey List (For other users) -->
          <li class="nav-item">
            <a href="./index.php?page=survey_widget" class="nav-link nav-survey_widget nav-answer_survey">
              <i class="nav-icon fas fa-poll-h"></i>
              <p>Poll List</p>
            </a>
          </li>  
        <?php endif; ?>
        
      </ul>
    </nav>
  </div>
</aside>

<script>
  $(document).ready(function() {
    // Get the current page from the URL
    var page = '<?php echo isset($_GET['page']) ? $_GET['page'] : 'home' ?>';
    
    // Add 'active' class to the corresponding nav link
    if ($('.nav-link.nav-' + page).length > 0) {
      $('.nav-link.nav-' + page).addClass('active');
      
      // If the link is part of a tree view, open the parent menu
      if ($('.nav-link.nav-' + page).hasClass('tree-item')) {
        $('.nav-link.nav-' + page).closest('.nav-treeview').siblings('a').addClass('active');
        $('.nav-link.nav-' + page).closest('.nav-treeview').parent().addClass('menu-open');
      }
      
      // If the link is a tree view itself, open the menu
      if ($('.nav-link.nav-' + page).hasClass('nav-is-tree')) {
        $('.nav-link.nav-' + page).parent().addClass('menu-open');
      }
    }
    
    // Handle click event for 'Manage Account' link
    $('.manage_account').click(function() {
      // Open a modal to manage the account
      uni_modal('Manage Account', 'manage_user.php?id=' + $(this).attr('data-id'));
    });
  });
</script>
<style>
  /* Sidebar Background */
.main-sidebar {
    background-color: black; /* Dark green background for the sidebar */
}

/* Sidebar Brand */
.sidebar-dark-green .brand-link {
    background-color: #245a43; /* Darker green for brand link background */
}

.sidebar-dark-green .brand-image {
    background-color: #81CC93; /* Matching background color for the brand image */
}

.sidebar-dark-green .brand-text {
    color: white; /* Light green text for brand name */
}

/* Sidebar Links */
.sidebar-dark-green .nav-link {
    color: #ffffff; /* Light green text color for sidebar links */
}

.sidebar-dark-green .nav-link.active {
    background-color: #004d00; /* Dark green background for active link */
    color: #ffffff; /* White text for active link */
}

.sidebar-dark-green .nav-link:hover {
    background-color: #00796b; /* Teal background for hover effect */
    color: #ffffff; /* White text for hover effect */
}

/* Sidebar Treeview */
.sidebar-dark-green .nav-treeview .nav-link {
    color: white; /* Slightly lighter green for treeview items */
}

.sidebar-dark-green .nav-treeview .nav-link.active {
    background-color: #004d00; /* Dark green for active treeview link */
    color: #ffffff; /* White text for active treeview link */
}

.sidebar-dark-green .nav-treeview .nav-link:hover {
    background-color: #00796b; /* Teal background for hover effect */
    color: #ffffff; /* White text for hover effect */
}

/* Dropdown Menu */
.sidebar-dark-green .dropdown-menu {
    background-color: #ffffff; /* Dark green background for dropdown */
    color: #00796b; /* Light green text for dropdown items */
}

.sidebar-dark-green .dropdown-menu .dropdown-item {
    color: #004d00; /* Light green text for dropdown items */
}

.sidebar-dark-green .dropdown-menu .dropdown-item:hover {
    background-color: green; /* Teal background for dropdown item hover */
    color: #ffffff; /* White text for hover effect */
}

/* Icon Colors */
.nav-icon {
    color: whitesmoke; /* Light green icon color */
}

.nav-icon.active {
    color: grey; /* White icon color for active link */
}

</style>