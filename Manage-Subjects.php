<!DOCTYPE html>
<?php
session_start();
if (!isset($_SESSION['admin']) || $_SESSION['admin'] !== true) {
    header("Location: login.php");
    exit();
}

// include './db/connection.php';

// $grades = array();

// $result = $conn->query("SELECT * FROM grades");
// while ($row = $result->fetch_assoc()) {
//     $grades[] = $row;
// }

// echo json_encode($grades);

// $conn->close();
?>

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
              <a href="./dashboard.php" class="logo">
                <img
                  src="./assets/img/kaiadmin/logo_light.svg"
                  alt="navbar brand"
                  class="navbar-brand"
                  height="20"
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
                  </a>
                  <ul class="dropdown-menu dropdown-user animated fadeIn">
                    <div class="dropdown-user-scroll scrollbar-outer">
                      <li>
                        <div class="user-box">
                          <div class="avatar-lg">
                            <imgd
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

                        <a class="dropdown-item" href="logout.php">Logout</a>
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
              <h3 class="fw-bold mb-3">Subjects</h3>
              <ul class="breadcrumbs mb-3">
                <li class="nav-home">
                  <a href="dashboard.php">
                    <i class="icon-home"></i>
                  </a>
                </li>
              
                
                <li class="separator">
                  <i class="icon-arrow-right"></i>
                </li>
                <li class="nav-item">
                  <a href="#">Manage Subjects</a>
                </li>
              </ul>
            </div>
            
              
              <div class="col-md-12">
                <div class="card">
                  <div class="card-header">
                    <div class="d-flex align-items-center">
                      <h4 class="card-title">Manage Subjects</h4>
                      <button
                        class="btn btn-primary btn-round ms-auto"
                        data-bs-toggle="modal"
                        data-bs-target="#addRowModal"
                      >
                        <i class="fa fa-plus"></i>
                        Add Subject
                      </button>
                    </div>
                  </div>
                  <div class="card-body">
                  
                  <div class="table-responsive">
                      <table id="multi-filter-select" class="display table table-striped table-hover">
                          <thead>
                              <tr>
                                  <th>Grade</th>
                                  <th>Subject</th>
                                  <th>Papers</th>
                                  <th style="width: 10%">Action</th>
                              </tr>
                          </thead>
                        
                          <tbody id="subjectTableBody">
                              <!-- Table rows will be dynamically generated here -->
                          </tbody>
                      </table>
                  </div>

                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>


      </div>

      <!-- Custom template | don't include it in your project! -->

<!-- Modal -->
<div class="modal fade" id="addRowModal" tabindex="-1" aria-labelledby="addRowModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addRowModalLabel">Add Subject</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="addSubjectForm">
                    <div class="mb-3">
                        <label for="gradeSelect" class="form-label">Grade</label>
                        <select class="form-select" id="gradeSelect" name="grade_id" required>
                            <!-- Options will be populated dynamically using JavaScript -->
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="subjectName" class="form-label">Subject Name</label>
                        <input type="text" class="form-control" id="subjectName" name="subject_name" required>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
            <button type="button" class="btn btn-primary" id="addSubjectBtn">Add</button>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
               
            </div>
        </div>
    </div>
</div>

<!-- Edit Subject Modal -->
<div class="modal fade" id="editSubjectModal" tabindex="-1" aria-labelledby="editSubjectModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editSubjectModalLabel">Edit Subject</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="editSubjectForm">
                    <input type="hidden" id="editSubjectId">
                    <div class="mb-3">
                        <label for="editSubjectName" class="form-label">Subject Name</label>
                        <input type="text" class="form-control" id="editSubjectName" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </form>
            </div>
        </div>
    </div>
</div>




      
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

    <!-- jQuery Scrollbar -->
    <script src="./assets/js/plugin/jquery-scrollbar/jquery.scrollbar.min.js"></script>
    <!-- Datatables -->
    <script src="./assets/js/plugin/datatables/datatables.min.js"></script>
    <!-- Kaiadmin JS -->
    <script src="./assets/js/kaiadmin.min.js"></script>
    <!-- Kaiadmin DEMO methods, don't include it in your project! -->
    <script src="./assets/js/setting-demo2.js"></script>
    <script>
    

      // $(document).ready(function () {
      //  

      //   $("#multi-filter-select").DataTable({
      //     pageLength: 5,
      //     initComplete: function () {
      //       this.api()
      //         .columns()
      //         .every(function () {
      //           var column = this;
      //           var select = $(
      //             '<select class="form-select"><option value=""></option></select>'
      //           )
      //             .appendTo($(column.footer()).empty())
      //             .on("change", function () {
      //               var val = $.fn.dataTable.util.escapeRegex($(this).val());

      //               column
      //                 .search(val ? "^" + val + "$" : "", true, false)
      //                 .draw();
      //             });

      //           column
      //             .data()
      //             .unique()
      //             .sort()
      //             .each(function (d, j) {
      //               select.append(
      //                 '<option value="' + d + '">' + d + "</option>"
      //               );
      //             });
      //         });
      //     },
      //   });

      //   // Add Row
      
      // });


      document.addEventListener('DOMContentLoaded', function () {
    // Fetch grades directly from PHP
    const grades = <?php
        include 'db/connection.php';
        $grades = array();
        $result = $conn->query("SELECT * FROM grades");
        while ($row = $result->fetch_assoc()) {
            $grades[] = $row;
        }
        $conn->close();
        echo json_encode($grades);
    ?>;

    // Populate grade options
    const gradeSelect = document.getElementById('gradeSelect');
    grades.forEach(grade => {
        const option = document.createElement('option');
        option.value = grade.id;
        option.text = grade.name;
        gradeSelect.appendChild(option);
    });

    // Initialize DataTables
    initializeDataTable();

    // Fetch subject data initially
    fetchSubjectData();

    // Handle form submission for adding subjects
    document.getElementById('addSubjectBtn').addEventListener('click', function () {
        const formData = new FormData(document.getElementById('addSubjectForm'));
        fetch('add_subject.php', {
            method: 'POST',
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                // Close the modal and reset the form
                closeAddSubjectModal();
                Swal.fire({
                    icon: 'success',
                    title: 'Subject added successfully',
                    showConfirmButton: false,
                    timer: 1500
                }).then(() => {
                    // Re-fetch the subject data to update the table
                    fetchSubjectData();
                });
            } else {
                closeAddSubjectModal();
                Swal.fire({
                    icon: 'error',
                    title: 'Failed to add subject',
                    text: data.message
                });
            }
        });
    });

    // Handle form submission for editing subjects
    document.getElementById('editSubjectForm').addEventListener('submit', function (event) {
        event.preventDefault();
        const subjectId = document.getElementById('editSubjectId').value;
        const subjectName = document.getElementById('editSubjectName').value;
        const formData = new FormData();
        formData.append('id', subjectId);
        formData.append('name', subjectName);

        fetch('edit_subject.php', {
            method: 'POST',
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                // Close the modal and reset the form
                closeEditSubjectModal();
                Swal.fire({
                    icon: 'success',
                    title: 'Subject updated successfully',
                    showConfirmButton: false,
                    timer: 1500
                }).then(() => {
                    // Re-fetch the subject data to update the table
                    fetchSubjectData();
                });
            } else {
                Swal.fire({
                    icon: 'error',
                    title: 'Failed to update subject',
                    text: data.message
                });
            }
        });
    });

    // Event listener for removing a subject
    document.getElementById('subjectTableBody').addEventListener('click', function (event) {
        if (event.target.classList.contains('btn-remove-subject')) {
            const subjectId = event.target.parentElement.querySelector('.subject-id').value;
            if (!isNaN(parseInt(subjectId))) {
                // Subject ID is a valid integer
                // Proceed with your code here
                removeSubject(parseInt(subjectId));
            } else {
                // Subject ID is not a valid integer
                // Handle the error or display a message to the user
                console.error('Invalid subject ID:', subjectId);
            }
        } else if (event.target.classList.contains('btn-edit-subject')) {
            const subjectId = event.target.closest('.form-button-action').querySelector('.subject-id').value;
            const subjectName = event.target.closest('tr').querySelector('td:nth-child(2)').innerText;
            openEditSubjectModal(subjectId, subjectName);
        }
    });

    function removeSubject(subjectId) {
        Swal.fire({
            title: 'Are you sure?',
            text: 'You are about to remove this subject. This action cannot be undone.',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Yes, remove it!',
            cancelButtonText: 'Cancel'
        }).then((result) => {
            if (result.isConfirmed) {
                // User confirmed, proceed with removing the subject
                fetch('remove_subject.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded' // Ensure the correct content type
                    },
                    body: `id=${encodeURIComponent(subjectId)}` // Send the ID as a URL-encoded string
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        Swal.fire({
                            icon: 'success',
                            title: `Subject removed successfully (ID: ${data.id})`,
                            showConfirmButton: false,
                            timer: 1500
                        }).then(() => {
                            // Re-fetch subject data to update the table
                            fetchSubjectData();
                        });
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Failed to remove subject',
                            text: data.message
                        });
                    }
                })
                .catch(error => {
                    console.error('Error removing subject:', error);
                    Swal.fire({
                        icon: 'error',
                        title: 'Failed to remove subject',
                        text: 'An error occurred while processing your request. Please try again later.'
                    });
                });
            }
        });
    }

    function fetchSubjectData() {
        fetch('get_subjects.php')
            .then(response => response.json())
            .then(data => {
                const subjectTableBody = document.getElementById('subjectTableBody');
                subjectTableBody.innerHTML = ''; // Clear existing rows
                data.forEach(subject => {
                    const row = document.createElement('tr');
                    row.innerHTML = `
                        <td>${subject.grade}</td>
                        <td>${subject.subject}</td>
                        <td>${subject.papers}</td>
                        <td>
                            <div class="form-button-action">
                                <button type="button" class="btn btn-link btn-primary btn-lg btn-edit-subject" data-bs-toggle="tooltip" title="Edit Task">
                                    <i class="fa fa-edit" style="pointer-events: none;"></i>
                                </button>
                                <!-- Hidden input field to store subject ID -->
                                <input type="hidden" class="subject-id" value="${subject.id}">
                                <button type="button" class="btn btn-link btn-danger btn-remove-subject" data-bs-toggle="tooltip" title="Remove">
                                    <i class="fa fa-times" style="pointer-events: none;"></i>
                                </button>
                            </div>
                        </td>
                    `;
                    subjectTableBody.appendChild(row);
                });

                // Clear and re-populate DataTables
                $('#multi-filter-select').DataTable().clear().rows.add($('#subjectTableBody').find('tr')).draw();
            })
            .catch(error => {
                console.error('Error fetching subject data:', error);
            });
    }

    // Function to close the add subject modal and reset form
    function closeAddSubjectModal() {
        const addRowModal = document.getElementById('addRowModal');
        addRowModal.classList.remove('show');
        addRowModal.setAttribute('aria-hidden', 'true');
        addRowModal.setAttribute('style', 'display: none');
        document.querySelector('.modal-backdrop').remove();
        document.getElementById('addSubjectForm').reset();
    }

    // Function to open the edit subject modal and populate with current data
    function openEditSubjectModal(subjectId, subjectName) {
        document.getElementById('editSubjectId').value = subjectId;
        document.getElementById('editSubjectName').value = subjectName;
        const editSubjectModal = new bootstrap.Modal(document.getElementById('editSubjectModal'));
        editSubjectModal.show();
    }

    // Function to close the edit subject modal and reset form
    function closeEditSubjectModal() {
        const editSubjectModal = document.getElementById('editSubjectModal');
        editSubjectModal.classList.remove('show');
        editSubjectModal.setAttribute('aria-hidden', 'true');
        editSubjectModal.setAttribute('style', 'display: none');
        document.querySelector('.modal-backdrop').remove();
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
});
    </script>
  </body>
</html>
