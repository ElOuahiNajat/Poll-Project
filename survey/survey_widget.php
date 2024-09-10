<?php include 'db_connect.php'; // Include the database connection file ?>

<?php 
// Fetch distinct survey IDs where the current user (based on session ID) has provided answers
$answers = $conn->query("SELECT DISTINCT(survey_id) FROM answers WHERE user_id = {$_SESSION['login_id']}");
$ans = array(); // Initialize an array to store survey IDs
while ($row = $answers->fetch_assoc()) {
    $ans[$row['survey_id']] = 1; // Mark surveys as answered
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Survey List</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
        body {
            background: green; /* Very light green background */
            font-family: 'Roboto', sans-serif;
        }
        .container {
            margin-top: 30px;
        }
        .search-container {
            margin-bottom: 20px;
            padding: 20px;
            background: whitesmoke;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        }
        .search-container label {
            font-size: 1.1rem;
            color: #388e3c;
            margin-right: 10px;
        }
        .input-group-sm .form-control {
            border-radius: 25px;
            border: 2px solid green;
            box-shadow: inset 0 1px 3px rgba(0,0,0,0.1);
        }
        .input-group-sm .btn {
            border-radius: 25px;
            background: green;
            color: #fff;
            border: none;
            font-size: 0.875rem;
            padding: 10px 20px;
            transition: background 0.3s ease;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }
        .input-group-sm .btn:hover {
            background: green;
        }
        .no-result {
            display: none;
            color: #388e3c;
            font-weight: bold;
            text-align: center;
            margin-top: 20px;
        }
        .card {
            border: none;
            border-radius: 15px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.15);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            margin-bottom: 20px;
        }
        .card:hover {
            transform: translateY(-10px);
            box-shadow: 0 8px 16px rgba(0,0,0,0.2);
        }
        .card-header {
            background: linear-gradient(90deg, #43a047, #333);
            color: #fff;
            border-radius: 15px 15px 0 0;
            padding: 15px;
        }
        .card-header .card-title {
            font-size: 1.5rem;
            font-weight: 600;
        }
        .card-body {
            background: whitesmoke;
            border-radius: 0 0 15px 15px;
            padding: 20px;
        }
        .card-body p {
            font-size: 1rem;
            color: green;
        }
        .card-body .btn {
            background: #43a047;
            color: #fff;
            border: none;
            border-radius: 25px;
            font-size: 0.875rem;
            padding: 10px 20px;
            transition: background 0.3s ease;
        }
        .card-body .btn:hover {
            background: #388e3c;
        }
        .card-body .text-primary {
            color: #388e3c;
            font-weight: bold;
        }
        .card-tools .btn-tool {
            color: #388e3c;
        }
        .card-tools .btn-tool i {
            font-size: 1.25rem;
        }
    </style>
</head>
<body>
<div class="container">
    <div class="search-container d-flex justify-content-center align-items-center">
        <label for="filter" style="color: #388e3c;">Find Survey:</label>
        <div class="input-group input-group-sm col-sm-8 col-md-6">
            <input type="text" class="form-control" id="filter" placeholder="Type to search...">
            <div class="input-group-append">
                <button type="button" class="btn" id="search">Search</button>
            </div>
        </div>
    </div>
    <div class="no-result" id='ns'><b>No Result.</b></div>
    <div class="row">
        <?php 
        // Query to fetch surveys that are active (current date is between start and end date)
        $survey = $conn->query("SELECT * FROM survey_set WHERE '".date('Y-m-d')."' BETWEEN date(start_date) AND date(end_date) ORDER BY RAND()");
        while ($row = $survey->fetch_assoc()): // Loop through each survey
        ?>
        <div class="col-md-4 col-lg-3 survey-item">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title"><?php echo ucwords($row['title']); ?></h3>
                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                            <i class="fas fa-minus"></i>
                        </button>
                    </div>
                </div>
                <div class="card-body">
                    <p><?php echo $row['description']; ?></p>
                    <div class="text-center">
                        <?php if (!isset($ans[$row['id']])): ?>
                            <a href="index.php?page=answer_survey&id=<?php echo $row['id']; ?>" class="btn">
                                <i class="fa fa-pencil-alt"></i> Take Survey
                            </a>
                        <?php else: ?>
                            <p  style="color: #388e3c; font-weight: bold; font-size: 1.2rem; text-align: center; margin: 0; padding: 10px; background-color: #e8f5e9; border-radius: 5px;">Done</p>

                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
        <?php endwhile; ?>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
<script>
    function find_survey() {
        var filter = $('#filter').val().toLowerCase();
        $('.survey-item').each(function() {
            var txt = $(this).text().toLowerCase();
            if (txt.includes(filter)) {
                $(this).show();
            } else {
                $(this).hide();
            }
        });
        if ($('.survey-item:visible').length <= 0) {
            $('#ns').show();
        } else {
            $('#ns').hide();
        }
    }

    $('#search').click(function() {
        find_survey();
    });

    $('#filter').keypress(function(e) {
        if (e.which == 13) {
            find_survey();
            return false;
        }
    });
</script>
</body>
</html>
