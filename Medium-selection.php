<?php
include './db/connection.php';

$gradeId = '';
$subjectId = '';
$mediums = [];

// Check if grade_id and subject_id are set in the URL parameters
if (isset($_GET['grade_id'])) {
    $gradeId = $_GET['grade_id'];
}

if (isset($_GET['subject_id'])) {
    $subjectId = $_GET['subject_id'];
}

// Fetch the list of mediums if grade_id and subject_id are provided
if ($gradeId && $subjectId) {
    $sql = "SELECT DISTINCT medium FROM papers WHERE subject_id = ? ORDER BY medium";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('i', $subjectId);
    $stmt->execute();
    $result = $stmt->get_result();

    while ($row = $result->fetch_assoc()) {
        $mediums[] = $row['medium'];
    }

    $stmt->close();
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="apple-touch-icon" sizes="180x180" href="res/img/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="res/img/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="res/img/favicon-16x16.png">
    <link rel="manifest" href="res/img/site.webmanifest">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.0/jquery.min.js"
        integrity="sha256-xNzN2a4ltkB44Mc/Jz3pT4iU1cmeR0FkXs4pru/JxaQ=" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
    <link rel="stylesheet" href="./style/index.css">
    <link rel="stylesheet" href="./style/select_text.css">
    <link rel="stylesheet" href="./style/subjectselection.css">
    <title>SPCPTA - Select Medium</title>
</head>

<body>

    <!-- Bootstrap navbar -->
    <?php include 'navbar.php'; ?>

    <div class="container-fluid mb-5 services" id="services">
        <div class="text-center mt-5">
            <h1>Choose the Medium</h1>
            <center>
                <hr size="6">
            </center>
        </div>
        <div class="row justify-content-center" id="mediumsContainer">
            <!-- Mediums will be dynamically inserted here -->
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const mediums = <?php echo json_encode($mediums); ?>;
            const gradeId = <?php echo json_encode($gradeId); ?>;
            const subjectId = <?php echo json_encode($subjectId); ?>;

            if (mediums.length > 0) {
                const mediumsContainer = document.getElementById('mediumsContainer');
                mediumsContainer.innerHTML = ''; // Clear existing content

                let row = document.createElement('div');
                row.classList.add('row', 'justify-content-center');
                let counter = 0;

                mediums.forEach(medium => {
                    if (counter % 3 === 0 && counter !== 0) {
                        mediumsContainer.appendChild(row);
                        row = document.createElement('div');
                        row.classList.add('row', 'justify-content-center');
                    }

                    const mediumElement = document.createElement('div');
                    mediumElement.classList.add('col-md-3');
                    mediumElement.innerHTML = `
                        <div class="box">
                            <a href="Past-papers.php?grade_id=${encodeURIComponent(gradeId)}&subject_id=${encodeURIComponent(subjectId)}&medium=${encodeURIComponent(medium)}" class="text-decoration-none">
                                <div class="our-services settings custom-border" style="padding-top:80px;">
                                    <h4 style="font-weight:bold; font-size:36px;">${medium}</h4>
                                </div>
                            </a>
                        </div>
                    `;

                    row.appendChild(mediumElement);
                    counter++;
                });

                if (row.children.length > 0) {
                    mediumsContainer.appendChild(row);
                }
            } else {
                console.error('No mediums available.');
            }
        });
    </script>

    <?php include 'footer.php'; ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
