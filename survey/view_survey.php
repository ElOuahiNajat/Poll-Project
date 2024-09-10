<?php include 'db_connect.php'; ?>

<?php 
// Fetch survey details from the database based on the survey ID provided in the GET request
$qry = $conn->query("SELECT * FROM survey_set WHERE id = ".$_GET['id'])->fetch_array();

// Dynamically assign survey details to variables
foreach($qry as $k => $v){

    if($k == 'title')
        $k = 'stitle'; // Rename 'title' to 'stitle' for clarity
    $$k = $v; // Dynamically create variables with survey details
}

// Count the number of unique users who have answered the survey
$answers = $conn->query("SELECT DISTINCT(user_id) FROM answers WHERE survey_id = {$id}")->num_rows;
?>

<!-- Survey details and questionnaire UI -->
<div class="container my-5">
    <div class="row">
        <!-- Survey Details Card -->
        <div class="col-md-4 mb-4">
            <div class="card shadow-lg border-light rounded">
                <div class="card-header bg-primary text-white">
                    <h3 class="card-title">Poll Details</h3>
                </div>
                <div class="card-body">
                    <p class="font-weight-bold">Title: <span class="text-primary"><?php echo $stitle ?></span></p>
                    <p class="font-weight-bold mb-1">Description:</p>
                    <p class="text-secondary"><?php echo $description; ?></p>
                    <p class="font-weight-bold">Start: <span class="text-success"><?php echo date("M d, Y", strtotime($start_date)) ?></span></p>
                    <p class="font-weight-bold">End: <span class="text-danger"><?php echo date("M d, Y", strtotime($end_date)) ?></span></p>
                    <p class="font-weight-bold">Have Taken: <span class="text-info"><?php echo number_format($answers) ?></span></p>
                </div>
            </div>
        </div>

        <!-- Survey Questionnaire Card -->
        <div class="col-md-8 mb-4" >
            <div class="card shadow-lg border-light rounded" >
                <div class="card-header  text-white d-flex justify-content-between align-items-center" style="background-color: #013220;">
                    <h3 class="card-title mb-0">Poll Questionnaire</h3>
                    <!-- Button to add a new question -->
                    <button class="btn btn-outline-light btn-sm rounded-circle" type="button" title="Add New Question">
                        <i class="fa fa-plus"></i>
                    </button>
                </div>
                <!-- Form for managing and sorting questions -->




                
                <form action="" id="manage-sort">
                    <div class="card-body">
                        <?php 
                        // Fetch all questions for the current survey, ordered by 'order_by' and 'id'
                        $question = $conn->query("SELECT * FROM questions WHERE survey_id = $id ORDER BY ABS(order_by) ASC, ABS(id) ASC");
                        while($row = $question->fetch_assoc()):    
                        ?>
                        <div class="mb-3 p-4 border rounded-lg bg-light">
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <h5><?php echo $row['question'] ?></h5>
                                <!-- Dropdown menu for editing and deleting questions -->
                                <div class="dropdown">
                                    <a class="text-dark" href="javascript:void(0)" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i class="fa fa-cog"></i>
                                    </a>
                                    <div class="dropdown-menu">
                                        <!-- Edit question link -->
                                        <a class="dropdown-item edit_question" href="javascript:void(0)" data-id="<?php echo $row['id'] ?>">Edit</a>
                                        <div class="dropdown-divider"></div>
                                        <!-- Delete question link -->
                                        <a class="dropdown-item delete_question" href="javascript:void(0)" data-id="<?php echo $row['id'] ?>">Delete</a>
                                    </div>
                                </div>
                            </div>
                            <div>
                                <!-- Hidden input to store the question ID -->
                                <input type="hidden" name="qid[]" value="<?php echo $row['id'] ?>">    
                                
                                <?php
                                // Display the appropriate input type based on the question type
                                if($row['type'] == 'radio_opt'):
                                    // For radio button options
                                    foreach(json_decode($row['frm_option']) as $k => $v):
                                ?>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" id="option_<?php echo $k ?>" name="answer[<?php echo $row['id'] ?>]" value="<?php echo $k ?>" checked="">
                                    <label class="form-check-label" for="option_<?php echo $k ?>"><?php echo $v ?></label>
                                </div>
                                <?php endforeach; ?>
                                <?php elseif($row['type'] == 'check_opt'): 
                                    // For checkbox options
                                    foreach(json_decode($row['frm_option']) as $k => $v):
                                ?>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="option_<?php echo $k ?>" name="answer[<?php echo $row['id'] ?>][]" value="<?php echo $k ?>">
                                    <label class="form-check-label" for="option_<?php echo $k ?>"><?php echo $v ?></label>
                                </div>
                                <?php endforeach; ?>
                                <?php else: ?>
                                <!-- For text area -->
                                <div class="form-group">
                                    <textarea name="answer[<?php echo $row['id'] ?>]" cols="30" rows="4" class="form-control" placeholder="Write Something Here..."></textarea>
                                </div>
                                <?php endif; ?>
                            </div>    
                        </div>
                        <?php endwhile; ?>
                    </div>
                </form>









            </div>
        </div>
    </div>
</div>

<!-- Include jQuery, Bootstrap, and jQuery UI -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>

<script>
$(document).ready(function(){
    // Enable sorting functionality for questions
    $('#manage-sort').sortable({
        placeholder: "ui-state-highlight",
        update: function() {
            alert_toast("Saving question sort order.", "info");
            $.ajax({
                url: "ajax.php?action=action_update_qsort",
                method: 'POST',
                data: $('#manage-sort').serialize(),
                success: function(resp) {
                    if(resp == 1){
                        alert_toast("Question order sort successfully saved.", "success");
                    }
                }
            });
        }
    });

    // Open modal to add a new question
    $('.btn-outline-light').click(function(){
        uni_modal("New Question", "manage_question.php?sid=<?php echo $id ?>", "large");
    });

    // Open modal to edit an existing question
    $(document).on('click', '.edit_question', function(){
        uni_modal("Edit Question", "manage_question.php?sid=<?php echo $id ?>&id=" + $(this).attr('data-id'), "large");
    });
    
    // Confirm and handle question deletion
    $(document).on('click', '.delete_question', function(){
        _conf("Are you sure to delete this question?", "delete_question", [$(this).attr('data-id')]);
    });
});

// Function to handle question deletion
function delete_question($id){
    start_load();
    $.ajax({
        url: 'ajax.php?action=delete_question',
        method: 'POST',
        data: {id: $id},
        success: function(resp){
            if(resp == 1){
                alert_toast("Data successfully deleted", 'success');
                setTimeout(function(){
                    location.reload();
                }, 1500);
            }
        }
    });
}

function uni_modal(title, url, size){
    $('#uni_modal').modal('show');
    $('#uni_modal .modal-title').html(title);
    $('#uni_modal .modal-body').load(url);
}

function alert_toast(message, type) {
    // Example function to show toast notifications
    $.toast({
        heading: 'Notification',
        text: message,
        position: 'top-right',
        loaderBg: '#ff6849',
        icon: type,
        hideAfter: 3500,
        stack: 6
    });
}

function _conf(message, func, params) {
    if (confirm(message)) {
        window[func].apply(null, params);
    }
}

function start_load(){
    // Example function to show a loading spinner or overlay
    console.log('Loading...');
}
</script>

<style>
/* Custom Styles */
body {
    background-color: #e9ecef;
    color: #495057;
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
}

.card {
    border-radius: 12px;
    border: 1px solid #dee2e6;
}

.card-header {
    border-bottom: 1px solid #28a745;
}

.card-title {
    font-size: 1.5rem;
    margin-bottom: 0;
}

.card-body {
    background-color: #ffffff;
}

.btn-light {
    background-color: #ffffff;
    color: #007bff;
    border: 1px solid #007bff;
}

.btn-light:hover {
    background-color: #e9ecef;
    color: #0056b3;
}

.form-check-label {
    font-size: 1rem;
}

.ui-state-highlight {
    background: #f8f9fa;
    border: 1px dashed #007bff;
}

.text-primary {
    color: #0056b3 !important;
}

.text-success {
    color: #28a745 !important;
}

.text-danger {
    color: #dc3545 !important;
}

.text-info {
    color: #17a2b8 !important;
}
</style>
