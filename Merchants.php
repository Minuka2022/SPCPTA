<?php

include './db/connection.php'; ?>

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
     <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.min.js"></script>
    <link rel="stylesheet" href="./style/index.css">
    <link rel="stylesheet" href="./style/select_text.css">
    <link rel="stylesheet" href="./style/merchant.css">
    <title>SPCPTA</title>
    <script language='JavaScript'>
        var products = [];
        var product = [];
    </script>
  

</head>
<body>

<!-- bootstrap navbar  -->

<?php include 'navbar.php'; ?>

<div class="container-fluid mb-5 services" id="services">
    <div class="text-center mt-5">
        <h1>Merchandise collection</h1>
        <center>
            <hr size="6">
        </center>
    </div>
    <div class="row justify-content-center" id="subjectsContainer"></div>
</div>

<script>document.addEventListener('DOMContentLoaded', function() {
    const urlParams = new URLSearchParams(window.location.search);
    const gradeId = urlParams.get('grade_id');
    
    if (gradeId) {
        fetchSubjects(gradeId);
    } else {
        console.error('Grade ID not found in URL parameters.');
    }
});

function fetchSubjects(gradeId) {
    fetch(`Subject-selection_b.php?grade_id=${encodeURIComponent(gradeId)}`)
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                const subjectsContainer = document.getElementById('subjectsContainer');
                subjectsContainer.innerHTML = ''; // Clear existing content

                let row = document.createElement('div');
                row.classList.add('row', 'justify-content-center');
                let counter = 0;

                data.subjects.forEach(subject => {
                    if (counter % 3 === 0 && counter !== 0) {
                        subjectsContainer.appendChild(row);
                        row = document.createElement('div');
                        row.classList.add('row', 'justify-content-center');
                    }

                    const subjectElement = document.createElement('div');
                    subjectElement.classList.add('col-md-3');
                    subjectElement.innerHTML = `
                        <div class="box">
                            <a href="Merchat-item.php?grade_id=${encodeURIComponent(gradeId)}&subject_id=${subject.id}" class="text-decoration-none">
                                <div class="our-services settings custom-border" style="padding-top:80px;">
                                    <h4 style="font-weight:bold; font-size:36px;">${subject.name}</h4>
                                </div>
                            </a>
                        </div>
                    `;

                    row.appendChild(subjectElement);
                    counter++;
                });

                if (row.children.length > 0) {
                    subjectsContainer.appendChild(row);
                }
            } else {
                console.error(data.message);
            }
        })
        .catch(error => console.error('Error fetching subjects:', error));
}

    </script>






<?php include 'footer.php' ?>
 
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="./js/addToCart.js"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>



</body>
</html>