<?php

include './db/connection.php';
//loading parameters
$sql = "
    SELECT grades.id, grades.name, COUNT(papers.id) as paper_count
    FROM grades
    LEFT JOIN subjects ON grades.id = subjects.grade_id
    LEFT JOIN papers ON subjects.id = papers.subject_id
    GROUP BY grades.id, grades.name
    ORDER BY grades.id";

$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.0/jquery.min.js"
        integrity="sha256-xNzN2a4ltkB44Mc/Jz3pT4iU1cmeR0FkXs4pru/JxaQ=" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
    <link rel="stylesheet" href="./style/index.css">
    <link rel="stylesheet" href="./style/select_text.css">
    <link rel="apple-touch-icon" sizes="180x180" href="res/img/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="res/img/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="res/img/favicon-16x16.png">
    <link rel="manifest" href="res/img/site.webmanifest">
    <link rel="stylesheet" href="./style/homeindex.css">
    <title>SPCPTA | St . Peters college Past Papers store</title>
    <meta name="description" content="Project by St.Peter's College Parent Teacher Association">
    <script language='JavaScript'>
        var products = [];
        var product = [];
    </script>

</head>

<body>

    <!-- bootstrap navbar  -->

    <?php include 'navbar.php'; ?>
    <main>
        <div class="banner" id="banner">



            <div class="content">
                <h1 class="" style="font-weight:bold;">Project by St.Peter's College Parent Teacher Association
                </h1>
                <p class="" style="max-width:800px;">Online Store for Past papers</p>

            </div>
            <div class="image-container">
                <div class="image-overlay"></div>
                <img src="https://www.stpeterscollege.lk/wp-content/uploads/2020/09/SPC_Web-Crest_New.png">
            </div>

        </div>


    </main>


    <div class="container-fluid mb-5 services" id="services">
        <div class="text-center mt-5">
            <h1>Choose the Grade </h1>
            <center>
                <hr size="6">
            </center>
        </div>
        <div class="row justify-content-center">
            <?php 
    $counter = 0; 
    while ($row = $result->fetch_assoc()) { 
        if ($row['id'] == 14) {
            continue; // Skip the grade with ID 14
        }
        if ($counter % 3 == 0 && $counter != 0) {
            echo '</div><div class="row justify-content-center">';
        }
        ?>
            <div class="col-md-3">
                <div class="box">
                    <a href="Subject-selection.php?grade_id=<?php echo $row['id']; ?>" class="text-decoration-none">
                        <div class="our-services settings custom-border" style="padding-top:80px;">
                            <h4 style="font-weight:bold; font-size:36px;"><?php echo $row['name']; ?></h4>
                        </div>
                    </a>
                </div>
            </div>
            <?php 
        $counter++;
    } 
    ?>
        </div>

    </div>


    <?php include 'footer.php'; ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="./js/addToCart.js"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>



</body>

</html>
