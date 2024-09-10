<?php include 'db_connect.php'; ?>

<?php
// Check if 'id' is provided in the GET request
if (isset($_GET['id'])) {
    // Define user roles as an array
    $type_arr = array('', "Admin", "Staff", "Subscriber");

    // Query to fetch user details from the database based on the provided ID
    $qry = $conn->query("SELECT *, CONCAT(lastname, ', ', firstname, ' ', middlename) AS name FROM users WHERE id = " . $_GET['id'])->fetch_array();

    // Dynamically assign database fields to variables
    foreach ($qry as $k => $v) {
        $$k = $v;
    }
}
?>

<!-- Display user details in a table format -->
<div class="container mt-4">
    <div class="card">
        <div class="card-header bg-dark-green text-white">
            <h4>User Details</h4>
        </div>
        <div class="card-body">
            <table class="table table-bordered table-striped">
                <tr>
                    <th>Name:</th>
                    <td><b><?php echo ucwords($name); ?></b></td>
                </tr>
                <tr>
                    <th>Email:</th>
                    <td><b><?php echo $email; ?></b></td>
                </tr>
                <tr>
                    <th>Contact:</th>
                    <td><b><?php echo $contact; ?></b></td>
                </tr>
                <tr>
                    <th>Address:</th>
                    <td><b><?php echo $address; ?></b></td>
                </tr>
                <tr>
                    <th>User Role:</th>
                    <td><b><?php echo $type_arr[$type]; ?></b></td>
                </tr>
            </table>
        </div>
        <!-- Modal footer with a save button -->
        <div class="card-footer text-right">
        <button type="button" class="btn" style="background-color: #004d00; color: white; border: 1px solid #003300;">Save</button>
        <button type="button" class="btn btn-secondary ml-2" data-dismiss="modal">Close</button>
        </div>
    </div>
</div>

<!-- CSS to control the display of the modal footer -->
<style>
    .container {
        max-width: 800px;
    }
    .card-header {
        border-bottom: 1px solid #dee2e6;
        background-color: #004d00; /* Darker green */
    }
    .card-footer {
        border-top: 1px solid #dee2e6;
    }
    .table th, .table td {
        vertical-align: middle;
    }
    .btn-dark-green {
        background-color: #004d00; /* Darker green */
        border-color: #003300; /* Even darker green */
        color: white;
    }
    .btn-dark-green:hover {
        background-color: #003300; /* Even darker green */
        border-color: #002200; /* Darker shade on hover */
    }
    .btn-secondary {
        background-color: #6c757d;
        border-color: #6c757d;
    }
    .btn-secondary:hover {
        background-color: #5a6268;
        border-color: #545b62;
    }
    .ml-2 {
        margin-left: 0.5rem; /* Space between buttons */
    }
</style>
