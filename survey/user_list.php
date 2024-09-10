<?php include 'db_connect.php'; ?>

<div class="col-lg-12">
    <div class="card card-outline card-success">
        <!-- Card Header -->
        <div class="card-header d-flex justify-content-between align-items-center">
            <h4 class="card-title mb-0">User List</h4>
            <!-- Add New User Button -->
            <a class="btn btn-custom btn-sm" href="./index.php?page=new_user">
                <i class="fa fa-plus"></i> Add New User
            </a>
        </div>
        <!-- Card Body -->
        <div class="card-body">
            <!-- Search Bar -->
            <div class="search-container">
                <input type="text" id="searchInput" placeholder="Search users...">
                <button type="button" id="searchBtn"><i class="fa fa-search"></i></button>
            </div>
            <br/>
            <!-- Table displaying user information -->
            <table class="table table-hover table-bordered" id="list">
                <thead>
                    <tr>
                        <th class="text-center">#</th>
                        <th>Name</th>
                        <th>Contact #</th>
                        <th>Role</th>
                        <th>Email</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    // Initialize counter
                    $i = 1;
                    // Define user roles
                    $type = array('', "Admin", "Staff", "Subscriber");
                    // Query to get user data from the database
                    $qry = $conn->query("SELECT *, CONCAT(lastname, ', ', firstname, ' ', middlename) AS name FROM users ORDER BY name ASC");
                    
                    // Loop through each row in the query result
                    while ($row = $qry->fetch_assoc()):
                    ?>
                    <tr>
                        <!-- Display row number -->
                        <th class="text-center"><?php echo $i++ ?></th>
                        <!-- Display user full name -->
                        <td><b><?php echo ucwords($row['name']) ?></b></td>
                        <!-- Display user contact number -->
                        <td><b><?php echo $row['contact'] ?></b></td>
                        <!-- Display user role -->
                        <td><b><?php echo $type[$row['type']] ?></b></td>
                        <!-- Display user email -->
                        <td><b><?php echo $row['email'] ?></b></td>
                        <td class="text-center">
                            <!-- Dropdown menu for actions -->
                            <div class="btn-group">
                                <button type="button" class="btn btn-action btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="fa fa-cog"></i> Action
                                </button>
                                <div class="dropdown-menu dropdown-menu-right">
                                    <!-- View user details -->
                                    <a class="dropdown-item view_user" href="javascript:void(0)" data-id="<?php echo $row['id'] ?>">
                                        <i class="fa fa-eye"></i> View
                                    </a>
                                    <div class="dropdown-divider"></div>
                                    <!-- Edit user details -->
                                    <a class="dropdown-item" href="./index.php?page=edit_user&id=<?php echo $row['id'] ?>">
                                        <i class="fa fa-pencil-alt"></i> Edit
                                    </a>
                                    <div class="dropdown-divider"></div>
                                    <!-- Delete user -->
                                    <a class="dropdown-item delete_user" href="javascript:void(0)" data-id="<?php echo $row['id'] ?>">
                                        <i class="fa fa-trash-alt"></i> Delete
                                    </a>
                                </div>
                            </div>
                        </td>
                    </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- CSS to style the table, buttons, and search bar -->
<style>
    .card {
        border-radius: 10px; /* Rounded corners for the card */
        overflow: hidden; /* Ensure rounded corners are visible */
        transition: transform 0.3s ease, box-shadow 0.3s ease; /* Smooth transition for hover effects */
    }

    .card-header {
        background-color: #2d6a4f; /* Deep green background for the header */
        color: #ffffff; /* White text color */
        border-bottom: 2px solid #1e4d40; /* Darker green border at the bottom */
    }

    .card-body {
        padding: 1.5rem; /* Increased padding for better spacing */
    }

    .search-container {
        display: flex;
        justify-content: center;
        align-items: center;
        width: 100%;
        max-width: 600px;
        margin-bottom: 15px; /* Space between search bar and table */
    }

    .search-container input {
        width: calc(100% - 50px); /* Adjust width to account for button */
        padding: 15px;
        border: 2px solid #2d6a4f;
        border-radius: 25px 0 0 25px;
        outline: none;
        font-size: 1.2em;
        transition: border-color 0.3s ease;
    }

    .search-container input:focus {
        border-color: #4caf50; /* Bright green on focus */
    }

    .search-container button {
        padding: 15px;
        background-color: #4caf50; /* Bright green background for the button */
        border: 2px solid #4caf50; /* Same green border color */
        border-radius: 0 25px 25px 0;
        color: #ffffff; /* White text color */
        cursor: pointer;
        font-size: 1.2em;
        transition: background-color 0.3s ease;
    }

    .search-container button:hover {
        background-color: #388e3c; /* Darker green on button hover */
        border-color: #388e3c; /* Darker green border on hover */
    }

    .table {
        border-radius: 10px; /* Rounded corners for the table */
        overflow: hidden; /* Ensure rounded corners are visible */
    }

    .table thead th {
        background-color: #2d6a4f; /* Deep green background for table headers */
        color: #ffffff; /* White text color */
        font-weight: bold; /* Bold text for headers */
        position: relative; /* Position headers to manage pseudo-elements */
    }

    .table tbody tr {
        transition: background-color 0.3s ease; /* Smooth transition for row hover effect */
    }

    .table tbody tr:hover {
        background-color: #e9f5f0; /* Light green background on row hover */
    }

    .dropdown-menu {
        border-radius: 5px; /* Rounded corners for the dropdown menu */
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2); /* Soft shadow for the dropdown menu */
        min-width: 150px; /* Minimum width for the dropdown menu */
    }

    .dropdown-item {
        transition: background-color 0.3s ease; /* Smooth transition for item hover effect */
    }

    .dropdown-item:hover {
        background-color: #e9f5f0; /* Light green background on item hover */
    }

    .btn-action {
        background-color: #4CAF50; /* Bright green background for the Action button */
        border-color: #388E3C; /* Darker green border color */
        color: #ffffff; /* White text color */
    }

    .btn-action:hover {
        background-color: #388E3C; /* Darker green on button hover */
        border-color: #2C6B2F; /* Even darker green border on hover */
    }

    .btn-custom {
        background-color: #4CAF50; /* Bright green background for the Add New User button */
        border-color: #388E3C; /* Darker green border color */
        color: #ffffff; /* White text color */
    }

    .btn-custom:hover {
        background-color: #388E3C; /* Darker green on button hover */
        border-color: #2C6B2F; /* Even darker green border on hover */
    }

    /* Hide the default DataTables search bar */
    .dataTables_filter {
        display: none; /* Hide the default search bar */
    }

    /* Hide the pagination control if you want */
    .dataTables_wrapper .dataTables_paginate {
        display: none; /* Hide the pagination controls */
    }
</style>

<!-- Ensure that jQuery and Bootstrap JavaScript are included -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js"></script>

<!-- DataTables JavaScript library -->
<script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.11.3/js/dataTables.bootstrap4.min.js"></script>

<!-- Initialize DataTable and handle the search functionality -->
<script>
$(document).ready(function() {
    // Initialize DataTable
    var table = $('#list').DataTable({
        // Disable the default search bar
        searching: true,
        // Enable sorting
        ordering: true,
        // Define the number of items per page
        pageLength: 10
    });

    // Search functionality
    $('#searchInput').on('keyup', function() {
        table.search(this.value).draw();
    });

    // View user details
    $('.view_user').click(function(){
        var userId = $(this).data('id');
        uni_modal("<i class='fa fa-id-card'></i> User Details", "view_user.php?id=" + userId);
    });

    // Delete user
    $('.delete_user').click(function(){
        var userId = $(this).data('id');
        if(confirm('Are you sure you want to delete this user?')){
            $.ajax({
                url: 'delete_user.php',
                method: 'POST',
                data: {id: userId},
                success: function(response){
                    if(response == 1){
                        alert("User deleted successfully!");
                        location.reload();
                    } else {
                        alert("Failed to delete user.");
                    }
                }
            });
        }
    });
});
</script>
