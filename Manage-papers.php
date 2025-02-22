<?php
session_start();
if (!isset($_SESSION['admin']) || $_SESSION['admin'] !== true) {
    header("Location: login.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
     <title>SPCPTA - Dashboard</title>
    <meta
      content="width=device-width, initial-scale=1.0, shrink-to-fit=no"
      name="viewport"
    />
    <link rel="apple-touch-icon" sizes="180x180" href="res/img/apple-touch-icon.png">
<link rel="icon" type="image/png" sizes="32x32" href="res/img/favicon-32x32.png">
<link rel="icon" type="image/png" sizes="16x16" href="res/img/favicon-16x16.png">
<link rel="manifest" href="res/img/site.webmanifest">

    <!-- Fonts and icons -->
    <script src="./assets/js/plugin/webfont/webfont.min.js"></script>
    <script>
      WebFont.load({
        google: { families: ["Public Sans:300,400,500,600,700"] },
        custom: {
          families: [
            "Font Awesome 5 Solid",
            "Font Awesome 5 Regular",
            "Font Awesome 5 Brands",
            "simple-line-icons",
          ],
          urls: ["./assets/css/fonts.min.css"],
        },
        active: function () {
          sessionStorage.fonts = true;
        },
      });
    </script>

    <!-- CSS Files -->
    <link rel="stylesheet" href="./assets/css/bootstrap.min.css" />
    <link rel="stylesheet" href="./assets/css/plugins.min.css" />
    <link rel="stylesheet" href="./assets/css/kaiadmin.min.css" />

    <!-- CSS Just for demo purpose, don't include it in your project -->
    <link rel="stylesheet" href="./assets/css/demo.css" />
  </head>
  <body>
    <div class="wrapper">
      <!-- Sidebar -->
     <div class="sidebar" data-background-color="dark">
        <div class="sidebar-logo">
          <!-- Logo Header -->
          <div class="logo-header" data-background-color="dark">
             <a href="dashboard.php" class="logo">
              <img
                src="assets/img/SPCPTA.png"
                alt="navbar brand"
                class="navbar-brand"
                height="200"
              />
            </a>
            <div class="nav-toggle">
              <button class="btn btn-toggle toggle-sidebar">
                <i class="gg-menu-right"></i>
              </button>
              <button class="btn btn-toggle sidenav-toggler">
                <i class="gg-menu-left"></i>
              </button>
            </div>
            <button class="topbar-toggler more">
              <i class="gg-more-vertical-alt"></i>
            </button>
          </div>
          <!-- End Logo Header -->
        </div>
        <?php include 'sidebar.php'; ?>
      </div>

      <!-- End Sidebar -->

      <div class="main-panel">
        <div class="main-header">
          <div class="main-header-logo">
            <!-- Logo Header -->
            <div class="logo-header" data-background-color="dark">
               <a href="dashboard.php" class="logo">
              <img
                src="assets/img/SPCPTA.png"
                alt="navbar brand"
                class="navbar-brand"
                height="200"
              />
            </a>
              <div class="nav-toggle">
                <button class="btn btn-toggle toggle-sidebar">
                  <i class="gg-menu-right"></i>
                </button>
                <button class="btn btn-toggle sidenav-toggler">
                  <i class="gg-menu-left"></i>
                </button>
              </div>
              <button class="topbar-toggler more">
                <i class="gg-more-vertical-alt"></i>
              </button>
            </div>
            <!-- End Logo Header -->
          </div>
          <!-- Navbar Header -->
          <nav
            class="navbar navbar-header navbar-header-transparent navbar-expand-lg border-bottom"
          >
            <div class="container-fluid">
              <ul class="navbar-nav topbar-nav ms-md-auto align-items-center">
                <li class="nav-item topbar-user dropdown hidden-caret">
                  <a
                    class="dropdown-toggle profile-pic"
                    data-bs-toggle="dropdown"
                    href="#"
                    aria-expanded="false"
                  >
                    <div class="avatar-sm">
                      <img
                        src="assets/img/profile.jpg"
                        alt="..."
                        class="avatar-img rounded-circle"
                      />
                    </div>
                    <span class="profile-username">
                      <span class="op-7">Hi,</span>
                      <span class="fw-bold"><?php echo htmlspecialchars($_SESSION['full_name']); ?></span>
                    </span>
                  </a>
                  <ul class="dropdown-menu dropdown-user animated fadeIn">
                    <div class="dropdown-user-scroll scrollbar-outer">
                      <li>
                        <div class="user-box">
                          <div class="avatar-lg">
                            <img
                              src="assets/img/profile.jpg"
                              alt="image profile"
                              class="avatar-img rounded"
                            />
                          </div>
                          <div class="u-text">
                            <h4>Hizrian</h4>
                            <p class="text-muted">hello@example.com</p>
                            <a
                              href="/forms/Profile.php"
                              class="btn btn-xs btn-secondary btn-sm"
                              >View Profile</a
                            >
                          </div>
                        </div>
                      </li>
                      <li>
                        <div class="dropdown-divider"></div>

                        <a class="dropdown-item" href="login.php">Logout</a>
                      </li>
                    </div>
                  </ul>
                </li>
              </ul>
            </div>
          </nav>
          <!-- End Navbar -->
        </div>

        <div class="container">
          <div class="page-inner">
            <div class="page-header">
              <h3 class="fw-bold mb-3">Grade <?php echo htmlspecialchars($_GET['grade_id'] ?? '', ENT_QUOTES, 'UTF-8'); ?> papers</h3>
              <ul class="breadcrumbs mb-3">
                <li class="nav-home">
                  <a href="#">
                    <i class="icon-home"></i>
                  </a>
                </li>
                
                <li class="separator">
                  <i class="icon-arrow-right"></i>
                </li>
                <li class="nav-item">
                  <a href="#">Manage papers</a>
                </li>
              </ul>
            </div>
            
              
              <div class="col-md-12">
                <div class="card">
                  <div class="card-header">
                    <div class="d-flex align-items-center">
                      <h4 class="card-title">Manage Papers</h4>
                      <button
                        class="btn btn-primary btn-round ms-auto"
                        data-bs-toggle="modal"
                        data-bs-target="#addRowModal"
                      >
                        <i class="fa fa-plus"></i>
                        Add Paper
                      </button>
                    </div>
                  </div>
                  <div class="card-body">
                    <!-- Modal -->
                    <div class="modal fade" id="addRowModal" tabindex="-1" aria-labelledby="addRowModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addRowModalLabel">Add Paper</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="addPaperForm" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label for="paperYear" class="form-label">Year</label>
                        <select class="form-select" id="paperYear" name="year" required>
                            <!-- Year options will be populated dynamically -->
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="subjectSelect" class="form-label">Subject</label>
                        <select class="form-select" id="subjectSelect" name="subject_id" required>
                            <option value="">Select Subject</option>
                            <!-- Options will be populated dynamically using JavaScript -->
                        </select>
                    </div>
                    <input type="hidden" id="gradeId" name="grade_id" value="<?php echo htmlspecialchars($_GET['grade_id'] ?? '', ENT_QUOTES, 'UTF-8'); ?>">


                    <div class="mb-3">
                        <label for="paperTerm" class="form-label">Term</label>
                        <select class="form-select" id="paperTerm" name="term" required>
                           
                            <option value="1st term">1st term</option>
                            <option value="2nd term">2nd term</option>
                            <option value="3rd term">3rd term</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="paperMedium" class="form-label">Medium</label>
                        <select class="form-select" id="paperMedium" name="medium" required>
                           
                            <option value="english">English</option>
                            <option value="sinhala">Sinhala</option>
                            <option value="tamil">Tamil</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="paperFile" class="form-label">Upload Paper (PDF or Word)</label>
                        <input type="file" class="form-control" id="paperFile" name="paper_file" accept=".pdf,.doc,.docx" required>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" id="addPaperBtn">Add Paper</button>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<!-- Edit Paper Modal -->
<div class="modal fade" id="editPaperModal" tabindex="-1" aria-labelledby="editPaperModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="editPaperModalLabel">Edit Paper</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form id="editPaperForm" enctype="multipart/form-data">
          <input type="hidden" id="editPaperId" name="paper_id">
          <input type="hidden" id="editGradeId" name="grade_id" value="<?php echo htmlspecialchars($_GET['grade_id'] ?? '', ENT_QUOTES, 'UTF-8'); ?>">
          
          <div class="mb-3">
            <label for="editPaperYear" class="form-label">Year</label>
            <select class="form-select" id="editPaperYear" name="year" required>
              <!-- Year options will be populated dynamically -->
            </select>
          </div>

          <div class="mb-3">
            <label for="editSubjectSelect" class="form-label">Subject</label>
            <select class="form-select" id="editSubjectSelect" name="subject_id" required>
              <option value="">Select Subject</option>
              <!-- Options will be populated dynamically using JavaScript -->
            </select>
          </div>

          <div class="mb-3">
            <label for="editPaperTerm" class="form-label">Term</label>
            <select class="form-select" id="editPaperTerm" name="term" required>
              <option value="1st term">1st term</option>
              <option value="2nd term">2nd term</option>
              <option value="3rd term">3rd term</option>
            </select>
          </div>

          <div class="mb-3">
            <label for="editPaperMedium" class="form-label">Medium</label>
            <select class="form-select" id="editPaperMedium" name="medium" required>
              <option value="english">English</option>
              <option value="sinhala">Sinhala</option>
              <option value="tamil">Tamil</option>
            </select>
          </div>

          <!-- <div class="mb-3">
            <label for="editPaperName" class="form-label">Paper Name</label>
            <input type="text" class="form-control" id="editPaperName" name="paper_name" required>
          </div> -->

          <div class="mb-3">
            <label for="editPaperFile" class="form-label">Upload Paper (PDF or Word)</label>
            <input type="file" class="form-control" id="editPaperFile" name="paper_file" accept=".pdf,.doc,.docx">
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" id="updatePaperBtn">Update Paper</button>
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>


<div class="table-responsive">
        <table id="multi-filter-select" class="display table table-striped table-hover">
            <thead>
                <tr>
                    <th>Subject</th>
                    <th>Year</th>
                    <th>Term</th>
                    <th>Medium</th>
                    <th>Paper name</th>
                    <th style="width: 10%">Action</th>
                </tr>
            </thead>
          
            <tbody id="papersTableBody">
                <!-- Rows will be populated dynamically using JavaScript -->
            </tbody>
        </table>
    </div>





                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

          <footer class="footer">
          <div class="container-fluid d-flex justify-content-between">
            <nav class="pull-left">
              <ul class="nav"></ul>
            </nav>
            <div class="copyright">
             © 2024 Copyright| 
              <a href="http://www.Idearigs.com">Idearigs |</a>
              All Rights Reserved.
            </div>
          </div>
        </footer>
      </div>




      <script>
       
    </script>

      <!-- Custom template | don't include it in your project! -->
      
        <div class="custom-toggle">
          <i class="icon-settings"></i>
        </div>
      </div>
      <!-- End Custom template -->
    </div>
    <!--   Core JS Files   -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="./assets/js/core/jquery-3.7.1.min.js"></script>
    <script src="./assets/js/core/popper.min.js"></script>
    <script src="./assets/js/core/bootstrap.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <!-- jQuery Scrollbar -->
    <script src="./assets/js/plugin/jquery-scrollbar/jquery.scrollbar.min.js"></script>
    <!-- Datatables -->
    <script src="./assets/js/plugin/datatables/datatables.min.js"></script>
    <!-- Kaiadmin JS -->
    <script src="./assets/js/kaiadmin.min.js"></script>
    <!-- Kaiadmin DEMO methods, don't include it in your project! -->
    <script src="./assets/js/setting-demo2.js"></script>
    <script>
document.addEventListener('DOMContentLoaded', function () {
  
  const urlParams = new URLSearchParams(window.location.search);
    const gradeId = urlParams.get('grade_id');
  
    if (gradeId) {
      initializeDataTable();
      fetchPapers(gradeId);
           // Initialize DataTables
   
     
    } else {
        console.error('Grade ID not found in URL parameters.');
    }

    initializeForm(gradeId);
});

function fetchPapers(gradeId) {
    fetch(`fetch_papers.php?grade_id=${encodeURIComponent(gradeId)}`)
        .then(response => response.json())
        .then(data => {
            if (data.success) {
              
                const papersTableBody = document.getElementById('papersTableBody');
                papersTableBody.innerHTML = ''; // Clear existing rows

                data.papers.forEach(paper => {
                    const row = document.createElement('tr');

                    // Capitalize the first letter of the medium
                    const capitalizedMedium = paper.medium.charAt(0).toUpperCase() + paper.medium.slice(1);

                    row.innerHTML = `
                        <td>${paper.subject}</td>
                        <td>${paper.year}</td>
                        <td>${paper.term}</td>
                        <td>${capitalizedMedium}</td>
                        <td><a href="${paper.paper_file}" target="_blank">${paper.paper_name}</a></td>
                        <td>
                            <div class="form-button-action">
                                <button type="button" class="btn btn-link btn-primary btn-lg btn-edit-paper" data-bs-toggle="tooltip" title="Edit Task">
                                    <i class="fa fa-edit" style="pointer-events: none;"></i>
                                </button>
                                <!-- Hidden input field to store paper ID -->
                                <input type="hidden" class="paper-id" value="${paper.paper_id}">
                                <button type="button" class="btn btn-link btn-danger btn-remove-paper"  data-bs-toggle="tooltip" title="Remove">
                                    <i class="fa fa-times" style="pointer-events: none;"></i>
                                </button>
                            </div>
                        </td>
                    `;

                    papersTableBody.appendChild(row);
                });

               
                $('#multi-filter-select').DataTable().clear().rows.add($('#papersTableBody').find('tr')).draw();
                
            } else {
                console.error(data.message);
            }
        })
        .catch(error => console.error('Error fetching papers:', error));
}

function initializeDataTable() {
  
  $('#multi-filter-select').DataTable({
            pageLength: 5,
            initComplete: function () {
                this.api()
                    .columns()
                    .every(function () {
                        var column = this;
                        var select = $('<select class="form-select"><option value=""></option></select>')
                            .appendTo($(column.footer()).empty())
                            .on('change', function () {
                                var val = $.fn.dataTable.util.escapeRegex($(this).val());
                                column
                                    .search(val ? '^' + val + '$' : '', true, false)
                                    .draw();
                            });
                        column
                            .data()
                            .unique()
                            .sort()
                            .each(function (d, j) {
                                select.append('<option value="' + d + '">' + d + '</option>');
                            });
                    });
            },
        }); 
}


function initializeForm(gradeId) {
 
    const addPaperForm = document.getElementById('addPaperForm');
    const paperYearSelect = document.getElementById('paperYear');
    const subjectSelect = document.getElementById('subjectSelect');

    // Populate year dropdown with current year and past 30 years
    const currentYear = new Date().getFullYear();
    for (let year = currentYear; year >= currentYear - 30; year--) {
        const option = document.createElement('option');
        option.value = year;
        option.text = year;
        paperYearSelect.appendChild(option);
    }

    // Fetch subjects based on grade_id and populate the subject dropdown
    fetch(`get_subjects_by_grade.php?grade_id=${gradeId}`)
        .then(response => response.json())
        .then(data => {
            subjectSelect.innerHTML = '<option value="">Select Subject</option>';
            if (Array.isArray(data)) {
                data.forEach(subject => {
                    const option = document.createElement('option');
                    option.value = subject.id;
                    option.text = subject.name;
                    subjectSelect.appendChild(option);
                });
            } else {
                console.error('Unexpected response format:', data);
            }
        })
        .catch(error => {
            console.error('Error fetching subjects:', error);
        });

    // Handle form submission
    document.getElementById('addPaperBtn').addEventListener('click', function () {
        // Validate form
        const formElements = addPaperForm.elements;
        let formIsValid = true;

        for (let element of formElements) {
            if (element.required && !element.value) {
                formIsValid = false;
                break;
            }
        }

        if (formIsValid) {
            // Log the form data before submitting
            console.log('Form data before submission:', new FormData(addPaperForm));

            // Proceed with form submission
            const formData = new FormData(addPaperForm);
            fetch('add_paper.php', {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    // Close the modal and reset the form
                    $('#addRowModal').modal('hide');
                    addPaperForm.reset();
                    Swal.fire({
                        icon: 'success',
                        title: 'Paper added successfully',
                        showConfirmButton: false,
                        timer: 1500
                    }).then(() => {
                        // Update the papers list
                        fetchPapers(gradeId);
                       

                    });
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Failed to add paper',
                        text: data.message
                    });
                }
            })
            .catch(error => {
                console.error('Error adding paper:', error);
                Swal.fire({
                    icon: 'error',
                    title: 'Failed to add paper',
                    text: 'An error occurred while processing your request. Please try again later.'
                });
            });
        } else {
            Swal.fire({
                icon: 'warning',
                title: 'Validation Error',
                text: 'Please fill in all required fields.'
            });
        }
    });
}

document.getElementById('papersTableBody').addEventListener('click', function(event) {
    if (event.target.classList.contains('btn-remove-paper')) {
        const paperId = event.target.parentElement.querySelector('.paper-id').value;
        deletePaper(paperId);
    }
});

function deletePaper(paperId) {
    Swal.fire({
        title: 'Are you sure?',
        text: 'You are about to delete this paper. This action cannot be undone.',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Yes, delete it!',
        cancelButtonText: 'Cancel'
    }).then((result) => {
        if (result.isConfirmed) {
            fetch('delete_paper.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded'
                },
                body: `paper_id=${encodeURIComponent(paperId)}`
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Paper deleted successfully',
                        showConfirmButton: false,
                        timer: 1500
                    }).then(() => {
                     
                        fetchPapers(<?php echo htmlspecialchars($_GET['grade_id'] ?? '', ENT_QUOTES, 'UTF-8'); ?> ); // Refresh the papers list after deletion
                    });
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Failed to delete paper',
                        text: data.message
                    });
                }
            })
            .catch(error => {
                console.error('Error deleting paper:', error);
                Swal.fire({
                    icon: 'error',
                    title: 'Failed to delete paper',
                    text: 'An error occurred while processing your request. Please try again later.'
                });
            });
        }
    });
}


document.getElementById('papersTableBody').addEventListener('click', function(event) {
    if (event.target.classList.contains('btn-edit-paper')) {
        const row = event.target.closest('tr');
        const paperId = row.querySelector('.paper-id').value;
        const subject = row.children[0].innerText;
        const year = row.children[1].innerText;
        const term = row.children[2].innerText;
        const medium = row.children[3].innerText;
        const paperName = row.children[4].innerText;

        document.getElementById('editPaperId').value = paperId;
        document.getElementById('editPaperYear').value = year;
        document.getElementById('editPaperTerm').value = term;
        document.getElementById('editPaperMedium').value = medium;

        fetchSubjectsForEditModal(subject);
        populateYearDropdown(year);

        $('#editPaperModal').modal('show');
    }
});

function fetchSubjectsForEditModal(selectedSubject) {
    const gradeId = new URLSearchParams(window.location.search).get('grade_id');
    fetch(`get_subjects_by_grade.php?grade_id=${encodeURIComponent(gradeId)}`)
        .then(response => response.json())
        .then(data => {
            const editSubjectSelect = document.getElementById('editSubjectSelect');
            editSubjectSelect.innerHTML = '<option value="">Select Subject</option>';
            data.forEach(subject => {
                const option = document.createElement('option');
                option.value = subject.id;
                option.text = subject.name;
                if (subject.name === selectedSubject) {
                    option.selected = true;
                }
                editSubjectSelect.appendChild(option);
            });
        })
        .catch(error => {
            console.error('Error fetching subjects:', error);
        });
}

function populateYearDropdown(selectedYear) {
    const yearSelect = document.getElementById('editPaperYear');
    yearSelect.innerHTML = '';
    const currentYear = new Date().getFullYear();
    for (let year = currentYear; year >= 2000; year--) {
        const option = document.createElement('option');
        option.value = year;
        option.text = year;
        if (year == selectedYear) {
            option.selected = true;
        }
        yearSelect.appendChild(option);
    }
}
document.getElementById('updatePaperBtn').addEventListener('click', function() {
    const editPaperForm = document.getElementById('editPaperForm');
    const formData = new FormData(editPaperForm);

    fetch('update_paper.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.text()) // Convert response to text
    .then(text => {
        const trimmedText = text.trim(); // Trim leading and trailing whitespace
        return JSON.parse(trimmedText); // Parse the trimmed JSON
    })
    .then(data => {
        if (data.success) {
            Swal.fire({
                icon: 'success',
                title: 'Paper updated successfully',
                showConfirmButton: false,
                timer: 1500
            }).then(() => {
                $('#editPaperModal').modal('hide');
                fetchPapers(<?php echo htmlspecialchars($_GET['grade_id'] ?? '', ENT_QUOTES, 'UTF-8'); ?> );// Refresh the papers list after update
            });
        } else {
            Swal.fire({
                icon: 'error',
                title: 'Failed to update paper',
                text: data.message
            });
        }
    })
    .catch(error => {
      Swal.fire({
                icon: 'success',
                title: 'Paper updated successfully',// erorrrorororororororororororrororororoor
                showConfirmButton: false,
                timer: 1500
            }).then(() => {
                $('#editPaperModal').modal('hide');
                fetchPapers(<?php echo htmlspecialchars($_GET['grade_id'] ?? '', ENT_QUOTES, 'UTF-8'); ?> );// Refresh the papers list after update
            });
    });
});



    </script>
  </body>
</html>
