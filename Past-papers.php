<?php
include 'db/connection.php';

// Initialize variables
$subjectName = '';
$medium = '';

// Check if subject_id is set in the URL parameters
if (isset($_GET['subject_id'])) {
    $subjectId = $_GET['subject_id'];

    // Prepare and execute SQL query to fetch subject name
    $sql = "SELECT name FROM subjects WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('i', $subjectId);
    $stmt->execute();
    $stmt->bind_result($subjectName);
    $stmt->fetch();
    $stmt->close();

    // Check if subject name was fetched successfully
    if (!$subjectName) {
        $subjectName = 'Subject not found'; // Default message if subject name is not found
    }
} else {
    $subjectName = 'Subject ID not provided'; // Default message if subject_id is not set in URL
}

// Get medium from URL parameter
if (isset($_GET['medium'])) {
    $medium = $_GET['medium'];
} else {
    $medium = ''; // Default to empty if medium is not set in URL
}
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="./style/index.css">
    <link rel="stylesheet" href="./style/select_text.css">
    <link rel="stylesheet" href="./style/pastpapers.css">
    <link rel="apple-touch-icon" sizes="180x180" href="res/img/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="res/img/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="res/img/favicon-16x16.png">
    <link rel="manifest" href="res/img/site.webmanifest">
    <title>stpc.lk</title>
</head>
<body>

<!-- bootstrap navbar  -->
<?php include 'navbar.php'; ?>

<div class="container-fluid mb-5 services" id="services">
    <div class="text-center mt-5">
        <h1>Grade<?php echo htmlspecialchars($_GET['grade_id'] ?? '', ENT_QUOTES, 'UTF-8'); ?></h1>
        <h1><?php echo htmlspecialchars($subjectName, ENT_QUOTES, 'UTF-8'); ?></h1>
        <center>
            <hr size="6">
        </center>
    </div>

    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <div class="filters" style="margin-bottom: 20px; position:relative; top:20px;">
                    <!-- Removed medium filter dropdown -->
                    <div class="filter-group d-flex align-items-center">
                        <label for="showEntries" class="me-2">Show entries</label>
                        <select id="showEntries" class="form-select me-2">
                            <option value="10">10</option>
                            <option value="25">25</option>
                            <option value="50">50</option>
                            <option value="100">100</option>
                        </select>
                    </div>
                    
                    <div class="filter-group d-flex align-items-center">
                        <label for="yearFilter" class="me-2">Year:</label>
                        <select id="yearFilter" class="form-select me-2">
                            <option value="">All</option>
                            <?php 
                                $sqlYears = "SELECT DISTINCT year FROM papers WHERE subject_id = ? ORDER BY year DESC";
                                $stmtYears = $conn->prepare($sqlYears);
                                $stmtYears->bind_param('i', $subjectId);
                                $stmtYears->execute();
                                $resultYears = $stmtYears->get_result();

                                while ($row = $resultYears->fetch_assoc()) {
                                    echo "<option value='{$row['year']}'>{$row['year']}</option>";
                                }

                                $stmtYears->close();


                                ?>
                            <!-- Populate options dynamically with JavaScript -->
                        </select>
                    </div>
                    <div class="filter-group d-flex align-items-center">
                        <label for="termFilter" class="me-2">Term:</label>
                        <select id="termFilter" class="form-select me-2">
                            <option value="">All</option>
                            <?php 
                                $sqlTerm = "SELECT DISTINCT term FROM papers WHERE subject_id = ? ORDER BY term DESC";
                                $stmtTerm= $conn->prepare($sqlTerm);
                                $stmtTerm->bind_param('i', $subjectId);
                                $stmtTerm->execute();
                                $resultTerm = $stmtTerm->get_result();

                                while ($row = $resultTerm->fetch_assoc()) {
                                    echo "<option value='{$row['term']}'>{$row['term']}</option>";
                                }

                                $stmtTerm->close();


                                ?>
                        </select>
                    </div>
                </div>

                <table id="contentTable" class="content-table">
                    <thead>
                        <tr>
                            <th>Year</th>
                            <th>Term</th>
                            <th>Medium</th>
                            <th>Paper Name</th>
                            <th style="text-align: center;">Action</th>
                        </tr>
                    </thead>
                    <tbody id="paperlist">
                        <?php
                        // Fetch past papers based on the medium and other parameters
                        $sql = "SELECT * FROM papers WHERE subject_id = ? AND medium = ?";
                        $stmt = $conn->prepare($sql);
                        $stmt->bind_param('is', $subjectId, $medium);
                        $stmt->execute();
                        $result = $stmt->get_result();

                        while ($row = $result->fetch_assoc()) {
                            $paperPath = 'papers/' . $row['paper_name'];
                            echo "<tr>
                                    <td>{$row['year']}</td>
                                    <td>{$row['term']}</td>
                                    <td>{$row['medium']}</td>
                                    <td>{$row['paper_name']}</td>
                                    <td style='text-align: center;'>
                                        <a href='$paperPath' class='btn btn-primary' download>Download</a>
                                        <a href='$paperPath' class='btn btn-success' target='_blank'>View</a>
                                    </td>
                                </tr>";
                        }

                        $stmt->close();
                        ?>
                    </tbody>

                </table>
            </div>
        </div>
    </div>
</div>


<script>
document.getElementById('yearFilter').addEventListener('change', filterTable);
document.getElementById('termFilter').addEventListener('change', filterTable);

function filterTable() {
    let selectedYear = document.getElementById('yearFilter').value;
    let selectedTerm = document.getElementById('termFilter').value;
    let rows = document.querySelectorAll('#paperlist tr');

    rows.forEach(row => {
        let rowYear = row.cells[0].innerText;
        let rowTerm = row.cells[1].innerText;
        
        let yearMatch = (selectedYear === "" || rowYear === selectedYear);
        let termMatch = (selectedTerm === "" || rowTerm === selectedTerm);
        
        if (yearMatch && termMatch) {
            row.style.display = ''; // Show the row
        } else {
            row.style.display = 'none'; // Hide the row
        }
    });
}
</script>


<script>
document.getElementById('yearFilter').addEventListener('change', function() {
    filterTable();
});

function filterTable() {
    let selectedYear = document.getElementById('yearFilter').value;
    let rows = document.querySelectorAll('#paperlist tr');

    rows.forEach(row => {
        let rowYear = row.cells[0].innerText;
        if (selectedYear === "" || rowYear === selectedYear) {
            row.style.display = ''; // Show the row
        } else {
            row.style.display = 'none'; // Hide the row
        }
    });
}
</script>




<?php include 'footer.php'; ?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</body>
</html>
