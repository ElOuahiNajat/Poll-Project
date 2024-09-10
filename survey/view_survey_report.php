<?php include 'db_connect.php'; ?>

<?php 
// Fetch survey details based on the provided ID from the GET request
$qry = $conn->query("SELECT * FROM survey_set WHERE id = ".$_GET['id'])->fetch_array();

// Assign the survey details to variables
foreach($qry as $k => $v){
    if($k == 'title')
        $k = 'stitle'; // Rename 'title' to 'stitle' for better clarity
    $$k = $v; // Dynamically assign values to variables
}

// Get the number of unique users who have taken the survey
$taken = $conn->query("SELECT DISTINCT(user_id) FROM answers WHERE survey_id = {$id}")->num_rows;

// Fetch all answers and their associated questions
$answers = $conn->query("SELECT a.*, q.type FROM answers a INNER JOIN questions q ON q.id = a.question_id WHERE a.survey_id = {$id}");
$ans = array(); // Initialize an array to store answers

// Process each answer based on the question type
while($row = $answers->fetch_assoc()){
    if($row['type'] == 'radio_opt'){
        // For single-choice questions (radio options)
        $ans[$row['question_id']][$row['answer']][] = 1;
    }
    if($row['type'] == 'check_opt'){
        // For multiple-choice questions (checkboxes)
        foreach(explode(",", str_replace(array("[","]"), '', $row['answer'])) as $v){
            $ans[$row['question_id']][$v][] = 1;
        }
    }
    if($row['type'] == 'textfield_s'){
        // For text fields
        $ans[$row['question_id']][] = $row['answer'];
    }
}
?>

<!-- Add some CSS styling for text field area -->
<style>
    body {
        background: linear-gradient(135deg, #a8d0e6, #f0f9f4); /* Light blue-green gradient */
        font-family: 'Roboto', sans-serif;
        color: #333;
        margin: 0;
        padding: 0;
    }
    .container {
        max-width: 1200px;
        margin: 0 auto;
        padding: 2rem;
    }
    .card {
        border-radius: 15px;
        border: none;
        box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
        margin-bottom: 1.5rem;
        background: black; /* White background for cards */
        overflow: hidden;
    }
    .card-header {
        background: #2c6e49; /* Deep green background */
        color: #ffffff;
        padding: 1.5rem;
        border-bottom: 4px solid #1a4d2e; /* Darker green border for emphasis */
        font-size: 1.5rem;
        font-weight: bold;
        text-shadow: 1px 1px 3px rgba(0, 0, 0, 0.2); /* Subtle text shadow */
    }
    .card-body {
        padding: 1.5rem;
        background: #f9f9f9; /* Light gray background */
    }
    .card-title {
        font-size: 1.5rem;
        font-weight: bold;
    }
    .survey-details p {
        margin: 0.5rem 0;
        font-size: 1rem;
    }
    .survey-details p strong {
        color: #2c6e49; /* Deep green for labels */
    }
    .survey-details p.title {
        color: #1a4d2e; /* Darker green for title */
        font-size: 1.75rem;
        font-weight: bold;
    }
    .survey-details p.description {
        color: #1a4d2e; /* Darker green for description */
        font-size: 1rem;
    }
    .survey-details p.start-date,
    .survey-details p.end-date,
    .survey-details p.taken {
        color: #2c6e49; /* Deep green for date and taken */
        font-size: 1.1rem;
    }
    .callout-info {
        border-left: 6px solid #2c6e49; /* Deep green left border */
        padding: 1.5rem;
        margin-bottom: 1rem;
        background: #e0f2f1; /* Very light green background */
        border-radius: 8px;
    }
    .callout-info h5 {
        font-size: 1.25rem;
        margin-bottom: 0.5rem;
    }
    .progress {
        height: 1.5rem;
        border-radius: 8px;
    }
    .progress-bar {
        background: black; /* Deep green progress bar */
        border-radius: 8px;
    }
    .tfield-area {
        max-height: 30vh;
        overflow-y: auto;
        background: #e8f5e9; /* Light green for text area */
        padding: 1.5rem;
        border-radius: 8px;
        border: 1px solid #c8e6c9; /* Light border */
    }
    .btn-primary {
        background: #2c6e49; /* Deep green background */
        border: none;
        border-radius: 25px;
        padding: 0.5rem 1.5rem;
        font-size: 1rem;
        font-weight: bold;
        color: #ffffff;
        transition: background 0.3s ease, transform 0.3s ease;
    }
    .btn-primary:hover {
        background: #1a4d2e; /* Darker green on hover */
        transform: translateY(-2px); /* Subtle lift effect */
    }
    .list-unstyled li {
        padding: 0.5rem 0;
        border-bottom: 1px solid #e0e0e0;
    }
    .list-unstyled li:last-child {
        border-bottom: none;
    }
    blockquote {
        border-left: 4px solid #2c6e49; /* Deep green border for blockquote */
        padding-left: 1rem;
        margin: 0;
        font-style: italic;
        color: #555;
        background: #f0f9f4; /* Very light green background */
        border-radius: 8px;
    }
</style>

<div class="container">
    <div class="row">
        <!-- Survey Details Card -->
        <div class="col-md-4 mb-4">
            <div class="card">
                <div class="card-header">
                    Survey Details
                </div>
                <div class="card-body survey-details">
                    <p class="title"><strong>Title:</strong> <?php echo $stitle ?></p>
                    <p class="description"><strong>Description:</strong> <?php echo $description; ?></p>
                    <p class="start-date"><strong>Start:</strong> <?php echo date("M d, Y", strtotime($start_date)) ?></p>
                    <p class="end-date"><strong>End:</strong> <?php echo date("M d, Y", strtotime($end_date)) ?></p>
                    <p class="taken"><strong>Have Taken:</strong> <?php echo number_format($taken) ?></p>
                </div>
            </div>
        </div>

        <!-- Survey Report Card -->
        <div class="col-md-8">
            <div class="card">
                <div style="color: black;">
                    Survey Report
                </div>
                <div class="card-body">
                    <?php 
                    // Fetch all questions related to the survey
                    $question = $conn->query("SELECT * FROM questions WHERE survey_id = $id ORDER BY ABS(order_by) ASC, ABS(id) ASC");
                    while($row = $question->fetch_assoc()):    
                    ?>
                    <div class="callout-info">
                        <h5><?php echo $row['question'] ?></h5>
                        <div class="col-md-12">
                            <!-- Hidden inputs to store question ID and type -->
                            <input type="hidden" name="qid[<?php echo $row['id'] ?>]" value="<?php echo $row['id'] ?>">    
                            <input type="hidden" name="type[<?php echo $row['id'] ?>]" value="<?php echo $row['type'] ?>">    
                            
                            <?php if($row['type'] != 'textfield_s'): ?>
                                <!-- For questions with options (radio/check) -->
                                <ul class="list-unstyled">
                                <?php foreach(json_decode($row['frm_option']) as $k => $v): 
                                    // Calculate the percentage of responses for each option
                                    $prog = ((isset($ans[$row['id']][$k]) ? count($ans[$row['id']][$k]) : 0) / $taken) * 100;
                                    $prog = round($prog, 2);
                                    ?>
                                    <li>
                                        <div class="d-flex justify-content-between align-items-center">
                                            <strong><?php echo $v ?></strong>
                                            <span><?php echo isset($ans[$row['id']][$k]) ? count($ans[$row['id']][$k]) : 0 ?>/<?php echo $taken ?></span>
                                        </div>
                                        <div class="progress mt-2">
                                            <div class="progress-bar" role="progressbar" aria-valuenow="<?php echo $prog ?>" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo $prog ?>%">
                                                <span class="sr-only"><?php echo $prog ?>%</span>
                                            </div>
                                        </div>
                                        <span class="badge badge-info mt-2"><?php echo $prog ?>%</span>
                                    </li>
                                    <?php endforeach; ?>
                                    </ul>
                            <?php else: ?>
                                <!-- For text field responses -->
                                <div class="tfield-area">
                                    <?php if(isset($ans[$row['id']])): ?>
                                    <?php foreach($ans[$row['id']] as $val): ?>
                                    <blockquote><?php echo $val ?></blockquote>
                                    <?php endforeach; ?>
                                    <?php endif; ?>
                                </div>
                            <?php endif; ?>
                        </div>    
                    </div>
                    <?php endwhile; ?>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    // Handle form submission to save answers
    $('#manage-survey').submit(function(e){
        e.preventDefault(); // Prevent default form submission
        start_load(); // Start loading animation
        $.ajax({
            url: 'ajax.php?action=save_answer', // URL for the AJAX request
            method: 'POST', // HTTP method
            data: $(this).serialize(), // Serialize form data
            success: function(resp){
                if(resp == 1){
                    alert_toast("Thank You.", 'success'); // Show success message
                    setTimeout(function(){
                        location.href = 'index.php?page=survey_widget'; // Redirect to survey widget page
                    }, 2000);
                }
            }
        });
    });
</script>
