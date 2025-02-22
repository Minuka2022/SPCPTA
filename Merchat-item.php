<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.0/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fancyapps/ui@4.0.24/dist/fancybox.css">
    <script src="https://cdn.jsdelivr.net/npm/@fancyapps/ui@4.0.24/dist/fancybox.umd.js"></script>
    <link rel="stylesheet" href="./style/index.css">
    <link rel="stylesheet" href="./style/select_text.css">
    <link rel="apple-touch-icon" sizes="180x180" href="res/img/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="res/img/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="res/img/favicon-16x16.png">
    <link rel="manifest" href="res/img/site.webmanifest">
    <title>stpc.lk</title>
    <style>
        body {
            background-color: rgba(255, 255, 255, 0.95);
            height: 100vh;
            position: relative;
        }

        main .banner {
            position: relative;
            background: url('https://www.stpeterscollege.lk/wp-content/uploads/2021/03/SPC-16-scaled.jpg') no-repeat center center;
            background-size: cover;
            display: flex;
        }

        main .banner::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(1, 32, 78, 0.8);
            z-index: 1;
            border-radius: 20px;
        }

        main .banner .content {
            position: relative;
            z-index: 2;
            color: white;
        }

        main .banner .image-container {
            max-height: 500px;
            margin-right: 0;
            margin-left: auto;
            position: relative;
            z-index: 2;
        }

        @media all and (max-width: 1024px) {
            main .banner .image-container {
                display: none;
            }
        }

        @media all and (min-width: 1024px) {
            main .banner {
                max-height: 500px;
                display: flex;
            }

            main .banner .content .actionbtn {
                margin-bottom: 0;
                margin-top: auto;
                position: absolute;
                bottom: 0;
            }

            main .banner .image-container {
                display: block;
            }

            main .banner .image-container img {
                height: 395px;
            }
        }

        .carousel-container {
            padding: 20px;
        }

        .carousel-item img {
            max-height: 400px;
            max-width: 100%;
            margin: 0 auto;
            display: block;
        }

        @media (max-width: 576px) {
            .carousel-item img {
                max-height: 300px;
            }
        }

        footer {
            position: absolute;
            bottom: 0;
            width: 100%;
            text-align: center;
            padding: 10px;
            background-color: #f8f9fa;
        }

        /* Custom styles for carousel controls */
        .carousel-control-prev-icon,
        .carousel-control-next-icon {
            background-color: black; /* Change this to the desired color */
            border-radius: 50%;
        }
    </style>
</head>
<body>

<!-- Bootstrap navbar  -->
<?php include 'navbar.php'; ?>

<div class="carousel-container">
    <!-- Carousel for past papers -->
    <div id="pastPapersCarousel" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-inner" id="carouselViewport"></div>
        <button class="carousel-control-prev" type="button" data-bs-target="#pastPapersCarousel" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#pastPapersCarousel" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>
</div>

<!-- Footer -->
<footer>
    <p>&copy; 2024 Your Website. All rights reserved.</p>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
<script>
    $(document).ready(function() {
        const urlParams = new URLSearchParams(window.location.search);
        const gradeId = urlParams.get('grade_id');
        const subjectId = urlParams.get('subject_id');

        if (gradeId && subjectId) {
            fetchPapers(gradeId, subjectId);
        } else {
            console.error('Grade ID or Subject ID not found in URL parameters.');
        }
    });

    function fetchPapers(gradeId, subjectId) {
        fetch(`subject-papers.php?grade_id=${encodeURIComponent(gradeId)}&subject_id=${encodeURIComponent(subjectId)}`)
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    const carouselViewport = $('#carouselViewport');
                    carouselViewport.empty();

                    data.papers.forEach((paper, index) => {
                        const isActive = index === 0 ? 'active' : '';
                        const slideElement = `
                            <div class="carousel-item ${isActive}">
                                <a href="${paper.paper_file}" data-fancybox="gallery">
                                    <img src="${paper.paper_file}" class="d-block" alt="${paper.paper_name}">
                                </a>
                            </div>`;
                        carouselViewport.append(slideElement);
                    });

                    // Initialize Fancybox
                    Fancybox.bind('[data-fancybox="gallery"]', {
                        Toolbar: {
                            display: ['zoom', 'close', 'prev', 'next']
                        }
                    });
                } else {
                    console.error(data.message);
                }
            })
            .catch(error => console.error('Error fetching papers:', error));
    }
</script>
<?php include 'footer.php' ?>
</body>
</html>
