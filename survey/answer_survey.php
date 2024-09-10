<?php include 'db_connect.php'; ?>
<?php 
// Fetch survey details from the database using the ID passed in the URL
$qry = $conn->query("SELECT * FROM survey_set WHERE id = " . $_GET['id'])->fetch_array();

// Create variables for each survey field
foreach ($qry as $k => $v) {
    if ($k == 'title')
        $k = 'stitle'; // Rename 'title' to 'stitle'
    $$k = $v; // Create dynamic variable for each field
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Survey Details</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            background: linear-gradient(135deg, #e8f5e9, #a5d6a7); /* Smooth green gradient background */
            font-family: 'Poppins', sans-serif;
            color: #333;
        }
        .container {
            margin-top: 50px;
        }
        .card {
            border: none;
            border-radius: 20px;
            box-shadow: 0 12px 24px rgba(0, 0, 0, 0.2);
            overflow: hidden;
            margin-bottom: 30px;
            transition: transform 0.3s ease-in-out;
        }
        .card:hover {
            transform: scale(1.02);
        }
        .card-header {
            background: linear-gradient(90deg, #66bb6a, #43a047); /* Green gradient header */
            color: #fff;
            border-bottom: none;
            padding: 20px;
        }
        .card-title {
            font-size: 2rem;
            font-weight: 600;
            text-shadow: 1px 1px 4px rgba(0, 0, 0, 0.3);
        }
        .card-body {
            background: #fff;
            padding: 25px;
        }
        .card-body p {
            font-size: 1.2rem;
            margin-bottom: 20px;
        }
        .card-footer {
            background: #f5f7fa;
            padding: 20px;
            border-top: 1px solid #e0e0e0;
            border-radius: 0 0 20px 20px;
        }
        .btn-custom {
            background-color: #43a047;
            color: #fff;
            border: none;
            border-radius: 30px;
            font-size: 1.1rem;
            padding: 12px 30px;
            transition: background-color 0.3s, transform 0.2s;
        }
        .btn-custom:hover {
            background-color: #388e3c;
            transform: scale(1.05);
        }
        .btn-secondary {
            background-color: #a5d6a7;
            color: #fff;
            border: none;
            border-radius: 30px;
            font-size: 1.1rem;
            padding: 12px 30px;
            transition: background-color 0.3s, transform 0.2s;
        }
        .btn-secondary:hover {
            background-color: #81c784;
            transform: scale(1.05);
        }
        .form-control {
            border-radius: 30px;
            border: 2px solid #43a047;
            box-shadow: inset 0 2px 5px rgba(0, 0, 0, 0.1);
            transition: border-color 0.3s, box-shadow 0.3s;
        }
        .form-control:focus {
            border-color: #388e3c;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .icheck-primary {
            margin-bottom: 12px;
        }
        .callout {
            border-left: 6px solid #43a047; /* Green border */
            background: #e8f5e9; /* Light green background */
            padding: 20px;
            margin-bottom: 20px;
            border-radius: 12px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        .callout h5 {
            font-size: 1.3rem;
            margin-bottom: 10px;
        }
        .callout input[type="radio"], 
        .callout input[type="checkbox"] {
            margin-right: 10px;
        }
    </style>
</head>
<body>
<div class="container">
    <div class="row">
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title"><b>Survey Details</b></h3>
                </div>
                <div class="card-body">
                    <p>Title: <b><?php echo $stitle ?></b></p>
                    <p class="mb-0">Description:</p>
                    <small><?php echo $description; ?></small>
                    <p>Start: <b><?php echo date("M d, Y", strtotime($start_date)) ?></b></p>
                    <p>End: <b><?php echo date("M d, Y", strtotime($end_date)) ?></b></p>
                </div>
            </div>
        </div>
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title"><b>Survey Questionnaire</b></h3>
                </div>
                <form action="" id="manage-survey">
                    <input type="hidden" name="survey_id" value="<?php echo $id ?>">
                    <div class="card-body">
                        <?php 
                        // Fetch questions from the database
                        $question = $conn->query("SELECT * FROM questions WHERE survey_id = $id ORDER BY ABS(order_by) ASC, ABS(id) ASC");
                        while ($row = $question->fetch_assoc()):    
                        ?>
                        <div class="callout">
                            <h5><?php echo $row['question'] ?></h5>
                            <div class="col-md-12">
                                <input type="hidden" name="qid[<?php echo $row['id'] ?>]" value="<?php echo $row['id'] ?>">
                                <input type="hidden" name="type[<?php echo $row['id'] ?>]" value="<?php echo $row['type'] ?>">
                                <?php
                                    // Display options based on the type of question
                                    if ($row['type'] == 'radio_opt'):
                                        foreach (json_decode($row['frm_option']) as $k => $v):
                                ?>
                                <div class="icheck-primary">
                                    <input type="radio" id="option_<?php echo $k ?>" name="answer[<?php echo $row['id'] ?>]" value="<?php echo $k ?>" checked="">
                                    <label for="option_<?php echo $k ?>"><?php echo $v ?></label>
                                </div>
                                <?php endforeach; ?>
                            <?php elseif ($row['type'] == 'check_opt'): 
                                        foreach (json_decode($row['frm_option']) as $k => $v):
                                ?>
                                <div class="icheck-primary">
                                    <input type="checkbox" id="option_<?php echo $k ?>" name="answer[<?php echo $row['id'] ?>][]" value="<?php echo $k ?>" >
                                    <label for="option_<?php echo $k ?>"><?php echo $v ?></label>
                                </div>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <div class="form-group">
                                    <textarea name="answer[<?php echo $row['id'] ?>]" cols="30" rows="4" class="form-control" placeholder="Write Something Here..."></textarea>
                                </div>
                            <?php endif; ?>
                            </div>    
                        </div>
                        <?php endwhile; ?>
                    </div>
                </form>
                <div class="card-footer">
                    <div class="d-flex justify-content-center">
                        <button class="btn btn-custom" form="manage-survey">Submit Answer</button>
                        <button class="btn btn-secondary mx-2" type="button" onclick="location.href = 'index.php?page=survey_widget'">Cancel</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
<script>
    $('#manage-survey').submit(function(e) {
        e.preventDefault();
        start_load();
        $.ajax({
            url: 'ajax.php?action=save_answer',
            method: 'POST',
            data: $(this).serialize(),
            success: function(resp) {
                if (resp == 1) {
                    alert_toast("Thank You.", 'success');
                    setTimeout(function() {
                        location.href = 'index.php?page=survey_widget';
                    }, 2000);
                }
            }
        });
    });
</script>
</body>
</html>
