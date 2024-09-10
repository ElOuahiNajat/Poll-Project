<?php include 'db_connect.php'; // Include the database connection file ?>

<div class="col-lg-12">
    <!-- Card displaying the list of tickets -->
    <div class="card card-outline card-info">
        <div class="card-body">
            <table class="table table-hover table-bordered" id="list">
                <!-- Define column widths for the table -->
                <colgroup>
                    <col width="5%">
                    <col width="15%">
                    <col width="20%">
                    <col width="15%">
                    <col width="25%">
                    <col width="10%">
                    <col width="10%">
                </colgroup>
                <thead>
                    <tr>
                        <th>#</th> <!-- Serial Number -->
                        <th>Date Created</th> <!-- Date when the ticket was created -->
                        <th>Ticket</th> <!-- Customer name -->
                        <th>Subject</th> <!-- Ticket subject -->
                        <th>Description</th> <!-- Ticket description -->
                        <th>Status</th> <!-- Status of the ticket -->
                        <th>Action</th> <!-- Actions like view, edit, delete -->
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $i = 1; // Initialize counter for row numbering
                    $where = ''; // Initialize condition for SQL query
                    
                    // Apply filters based on user type
                    if ($_SESSION['login_type'] == 2) {
                        $where .= " WHERE t.department_id = {$_SESSION['login_department_id']} "; // Filter by department for support staff
                    }
                    if ($_SESSION['login_type'] == 3) {
                        $where .= " WHERE t.customer_id = {$_SESSION['login_id']} "; // Filter by customer for regular users
                    }

                    // Query to fetch tickets, joining with customers table
                    $qry = $conn->query("SELECT t.*, CONCAT(c.lastname, ', ', c.firstname, ' ', c.middlename) AS cname 
                                          FROM tickets t 
                                          INNER JOIN customers c ON c.id = t.customer_id 
                                          $where 
                                          ORDER BY UNIX_TIMESTAMP(t.date_created) DESC");

                    // Iterate through the fetched tickets
                    while ($row = $qry->fetch_assoc()):
                        // Sanitize and format description
                        $trans = get_html_translation_table(HTML_ENTITIES, ENT_QUOTES);
                        unset($trans["\""], $trans["<"], $trans[">"], $trans["<h2"]);
                        $desc = strtr(html_entity_decode($row['description']), $trans);
                        $desc = str_replace(array("<li>", "</li>"), array("", ", "), $desc);
                    ?>
                    <tr>
                        <th class="text-center"><?php echo $i++; ?></th> <!-- Display row number -->
                        <td><b><?php echo date("M d, Y", strtotime($row['date_created'])); ?></b></td> <!-- Display creation date -->
                        <td><b><?php echo ucwords($row['cname']); ?></b></td> <!-- Display customer name -->
                        <td><b><?php echo $row['subject']; ?></b></td> <!-- Display ticket subject -->
                        <td><b class="truncate"><?php echo strip_tags($desc); ?></b></td> <!-- Display ticket description -->
                        <td>
                            <!-- Display status with appropriate badge color -->
                            <?php if ($row['status'] == 0): ?>
                                <span class="badge badge-primary">Pending/Open</span>
                            <?php elseif ($row['status'] == 1): ?>
                                <span class="badge badge-info">Processing</span>
                            <?php elseif ($row['status'] == 2): ?>
                                <span class="badge badge-success">Done</span>
                            <?php else: ?>
                                <span class="badge badge-secondary">Closed</span>
                            <?php endif; ?>
                        </td>
                        <td class="text-center">
                            <!-- Dropdown for action buttons -->
                            <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-expanded="true">
                                Action
                            </button>
                            <div class="dropdown-menu">
                                <a class="dropdown-item view_ticket" href="./index.php?page=view_ticket&id=<?php echo $row['id']; ?>" data-id="<?php echo $row['id']; ?>">View</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="./index.php?page=edit_ticket&id=<?php echo $row['id']; ?>">Edit</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item delete_ticket" href="javascript:void(0)" data-id="<?php echo $row['id']; ?>">Delete</a>
                            </div>
                        </td>
                    </tr>
                    <?php endwhile; // End of while loop ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        $('#list').dataTable(); // Initialize DataTable plugin for the table

        // Bind click event to delete buttons
        $('.delete_ticket').click(function() {
            _conf("Are you sure you want to delete this ticket?", "delete_ticket", [$(this).attr('data-id')]);
        });
    });

    // Function to delete a ticket
    function delete_ticket($id) {
        start_load(); // Start loading animation or indicator

        $.ajax({
            url: 'ajax.php?action=delete_ticket',
            method: 'POST',
            data: { id: $id },
            success: function(resp) {
                if (resp == 1) {
                    alert_toast("Data successfully deleted", 'success'); // Show success message
                    setTimeout(function() {
                        location.reload(); // Reload the page to reflect changes
                    }, 1500);
                }
            }
        });
    }
</script>
