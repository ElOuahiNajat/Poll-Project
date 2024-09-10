<?php include 'db_connect.php'; // Include the database connection file ?>

<?php 
// Query to fetch unique survey IDs where the current user (based on session ID) has provided answers
$answers = $conn->query("SELECT DISTINCT(survey_id) FROM answers WHERE user_id = {$_SESSION['login_id']}");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Survey Dashboard</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/5.3.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        body {
            background-color: #004d00; /* Dark green background */
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            color: #fff;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 1200px;
            padding: 2rem;
        }
        .search-container {
            display: flex;
            flex-direction: column;
            align-items: center;
            margin-bottom: 2rem;
        }
        .search-container label {
            margin-bottom: 0.5rem;
            font-size: 1.2rem;
            color: #b3e6b3; /* Light green for label */
            font-weight: bold;
        }
        .input-group {
            max-width: 700px;
            border-radius: 30px;
            overflow: hidden;
        }
        .input-group input {
            border: 2px solid #b3e6b3; /* Border color matching the label */
            padding: 0.5rem 1rem;
            font-size: 1rem;
            color: #333; /* Dark text for readability */
            background-color: #fff; /* White background for input */
            transition: border-color 0.3s ease, box-shadow 0.3s ease;
        }
        .input-group input:focus {
            border-color: #4caf50; /* Lighter green on focus */
            box-shadow: 0 0 8px rgba(0, 255, 0, 0.3); /* Enhanced green shadow */
        }
        .input-group button {
            background-color: #4caf50; /* Lighter green background */
            border: none;
            color: #fff;
            padding: 0.5rem 1.5rem;
            font-size: 1rem;
            border-radius: 0 30px 30px 0;
            transition: background-color 0.3s ease, transform 0.3s ease;
        }
        .input-group button:hover {
            background-color: #388e3c; /* Darker green on hover */
            transform: translateY(-2px); /* Subtle lift effect */
        }
        .no-result {
            text-align: center;
            font-size: 1.3rem;
            color: #b3e6b3; /* Light green text for no result */
            font-weight: bold;
        }
        .card {
            border-radius: 12px;
            border: none;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            margin-bottom: 1.5rem;
            background-color: #fff; /* White background for cards */
            transition: box-shadow 0.3s ease;
        }
        .card:hover {
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.3); /* Larger shadow on hover */
        }
        .card-header {
            background-color: #004d00; /* Dark green background */
            color: #fff;
            padding: 1rem;
            border-bottom: 2px solid #004d00; /* Bottom border for emphasis */
        }
        .card-body {
            background-color: #fff; /* White background for card body */
            color: #333; /* Dark text for readability */
            padding: 1.5rem;
            border-top: 2px solid #004d00; /* Top border for emphasis */
        }
        .card-title {
            font-size: 1.5rem;
            margin: 0;
            font-weight: bold;
        }
        .btn-primary {
            background-color: #4caf50; /* Lighter green background for buttons */
            border-color: #4caf50; /* Border color matching the button background */
            border-radius: 20px;
            padding: 0.5rem 1.5rem;
            font-size: 1rem;
            font-weight: bold;
            transition: background-color 0.3s ease, transform 0.3s ease;
        }
        .btn-primary:hover {
            background-color: #388e3c; /* Darker green on hover */
            border-color: #388e3c; /* Border color matching the hover state */
            transform: translateY(-2px); /* Subtle lift effect */
        }
        .survey-item {
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }
        .survey-item:hover {
            transform: scale(1.02);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.3);
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="search-container">
            <!-- Search bar for finding surveys -->
            <label for="filter" style="color: green;">Find Survey</label>
            <div class="input-group">
                <input type="text" class="form-control" id="filter" placeholder="Enter keyword..."> <!-- Input for search filter -->
                <button type="button" class="btn btn-primary" id="search">
                    <i class="fas fa-search"></i> Search
                </button> <!-- Button to trigger search -->
            </div>
        </div>
        <!-- Message displayed when no survey matches the search criteria -->
        <div class="no-result" id='ns' style="display: none;"><b>No Result.</b></div>
        <div class="row">
            <?php 
            // Query to fetch all surveys and display them in random order
            $survey = $conn->query("SELECT * FROM survey_set ORDER BY RAND()");
            while ($row = $survey->fetch_assoc()): // Loop through each survey
            ?>
            <div class="col-md-4 py-2 survey-item">
                <!-- Survey card -->
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title"><?php echo ucwords($row['title']); ?></h3> <!-- Display survey title -->
                    </div>
                    <div class="card-body">
                        <?php echo $row['description']; ?> <!-- Display survey description -->
                        <div class="d-flex justify-content-center mt-3">
                            <a href="index.php?page=view_survey_report&id=<?php echo $row['id']; ?>" class="btn btn-sm btn-primary">
                                <i style="color:black"></i> View Report
                            </a> <!-- Button to view survey report -->
                        </div>
                    </div>
                </div>
            </div>
            <?php endwhile; // End of while loop ?>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/5.3.0/js/bootstrap.min.js"></script>
    <script>
        // Function to filter surveys based on the search input
        function find_survey() {
            var filter = $('#filter').val(); // Get the value from the filter input
            filter = filter.toLowerCase(); // Convert filter value to lowercase

            // Loop through each survey item and check if it matches the filter criteria
            $('.survey-item').each(function() {
                var txt = $(this).text(); // Get the text content of the survey item
                if ((txt.toLowerCase()).includes(filter)) { // Check if the text includes the filter keyword
                    $(this).show(); // Show matching survey item
                } else {
                    $(this).hide(); // Hide non-matching survey item
                }

                // Show "No Result" message if no survey items are visible
                if ($('.survey-item:visible').length <= 0) {
                    $('#ns').show(); // Show no result message
                } else {
                    $('#ns').hide(); // Hide no result message
                }
            });
        }

        // Bind click event to the search button
        $('#search').click(function() {
            find_survey(); // Call the find_survey function
        });

        // Bind keypress event to the filter input to trigger search on Enter key
        $('#filter').keypress(function(e) {
            if (e.which == 13) { // Check if Enter key (key code 13) is pressed
                find_survey(); // Call the find_survey function
                return false; // Prevent default action
            }
        });
    </script>
</body>
</html>
