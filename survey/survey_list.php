<?php include 'db_connect.php'; ?>

<div class="col-lg-12">
    <div class="card card-outline card-success">
        <!-- Card Header -->
        <div class="card-header d-flex justify-content-between align-items-center">
            <h4 class="card-title mb-0">Poll List</h4>
            <!-- Add New Survey Button -->
            <a class="btn btn-custom btn-sm" href="./index.php?page=new_survey" style="background-color: #4caf50;">
                <i class="fa fa-plus"></i> Add New Poll
            </a>
        </div>
        <!-- Card Body -->
        <div class="card-body">
            <!-- Search Bar -->
            <div class="search-container">
                <input type="text" id="searchInput" placeholder="Search Poll...">
                <button type="button" id="searchBtn"><i class="fa fa-search"></i></button>
            </div>
            <br/>
            <!-- Table to display the list of surveys -->
            <table class="table table-hover table-bordered" id="list">
                <colgroup>
                    <col width="5%">
                    <col width="20%">
                    <col width="20%">
                    <col width="20%">
                    <col width="20%">
                    <col width="15%">
                </colgroup>
                <thead>
                    <tr>
                        <th class="text-center">Id</th>
                        <th>Title</th>
                        <th>Description</th>
                        <th>Start</th>
                        <th>End</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $i = 1; // Initialize row number
                    $qry = $conn->query("SELECT * FROM survey_set ORDER BY date(start_date) ASC, date(end_date) ASC");
                    while ($row = $qry->fetch_assoc()): // Loop through each row
                    ?>
                    <tr>
                        <th class="text-center"><?php echo $i++ ?></th>
                        <td><b><?php echo ucwords($row['title']) ?></b></td>
                        <td><b class="truncate"><?php echo $row['description'] ?></b></td>
                        <td><b><?php echo date("M d, Y", strtotime($row['start_date'])) ?></b></td>
                        <td><b><?php echo date("M d, Y", strtotime($row['end_date'])) ?></b></td>
                        <td class="text-center">
                            <!-- Action buttons for each survey -->
                            <div class="btn-group">
                                <a href="./index.php?page=edit_survey&id=<?php echo $row['id'] ?>" class="btn btn-primary btn-flat">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <a href="./index.php?page=view_survey&id=<?php echo $row['id'] ?>" class="btn btn-info btn-flat">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <button type="button" class="btn btn-danger btn-flat delete_survey" data-id="<?php echo $row['id'] ?>">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </div>
                        </td>
                    </tr>    
                    <?php endwhile; // End of while loop ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
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

    .btn-primary {
        background-color: #4caf50 ; /* Blue background for Edit button */
        border-color: #007bff; /* Blue border color */
        color: #ffffff; /* White text color */
    }

    .btn-primary:hover {
        background-color: #0056b3; /* Darker blue on button hover */
        border-color: #004b9b; /* Darker blue border on hover */
    }

    .btn-info {
        background-color: #17a2b8; /* Teal background for View button */
        border-color: #17a2b8; /* Teal border color */
        color: #ffffff; /* White text color */
    }

    .btn-info:hover {
        background-color: #138496; /* Darker teal on button hover */
        border-color: #117a8b; /* Darker teal border on hover */
    }

    .btn-danger {
        background-color: #dc3545; /* Red background for Delete button */
        border-color: #dc3545; /* Red border color */
        color: #ffffff; /* White text color */
    }

    .btn-danger:hover {
        background-color: #c82333; /* Darker red on button hover */
        border-color: #bd2130; /* Darker red border on hover */
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
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js"></script>

<!-- DataTables JavaScript library -->
<script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.11.3/js/dataTables.bootstrap4.min.js"></script>

<script>
$(document).ready(function() {
    // Initialize DataTable for the surveys list
    var table = $('#list').DataTable({
        // Define DataTable options if needed
        ordering: true,
        pageLength: 10
    });

    // Search functionality
    $('#searchInput').on('keyup', function() {
        table.search(this.value).draw();
    });

    // Delete survey functionality
    $('.delete_survey').click(function() {
        var surveyId = $(this).data('id');
        if (confirm("Are you sure to delete this survey?")) {
            $.ajax({
                url: 'ajax.php?action=delete_survey', // URL for the AJAX request
                method: 'POST',
                data: { id: surveyId },
                success: function(response) {
                    // Optionally handle the response, e.g., reload the table data
                    location.reload(); // Reload the page to reflect changes
                },
                error: function() {
                    alert('An error occurred while deleting the survey.');
                }
            });
        }
    });
});
</script>
