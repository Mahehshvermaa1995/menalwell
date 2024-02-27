<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Doctor Search</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <style>
        /* Added styles for the suggestion box */
        #suggestionBox {
            display: none;
            width: 50%;
            left: 20%;
            position: absolute;
            background-color: #fff;
            border: 1px solid #ced4da;
            border-top: none;
            z-index: 9999;
            /* Set z-index to ensure it appears above other elements */
        }

        #suggestionBox .list-group-item {
            cursor: pointer;

        }
    </style>
</head>
<?php include 'header.php'; ?>

<body>

    <div class="container" style="background-color: rgb(243 244 244); height: 50vh; margin-top: 100px; ">
        <div class="justify-content-center d-flex">
            <div class="row  w-50">
                <div class=" col-3 mt-5 mb-5">
                    <div class="card border border-0 rounded-circle p-3" style=" background-color: rgb(24 205 205); width:100px; height:100px;">
                        <img src="./Image/hospitalnav.png" class="card-img-top w-75 ms-2" alt="...">
                        <p class="text-center text-white " style="font-size: 10px;">Find Hospitals</p>
                    </div>
                </div>
                <div class=" col-3 mt-5 mb-5">
                    <div class="card border border-0 rounded-circle p-3" style=" background-color: rgb(24 205 205); width:100px; height:100px;">
                        <img src="./Image/navIocn6.png" class="card-img-top w-75 ms-2" alt="...">
                        <p class="text-center text-white " style="font-size: 10px;">Find Doctors</p>
                    </div>
                </div>
                <div class=" col-3 mt-5 mb-5">
                    <div class="card border border-0 rounded-circle p-3" style=" background-color: rgb(24 205 205); width:100px; height:100px;">
                        <img src="./Image/navIocn7.png" class="card-img-top w-75 ms-2" alt="...">
                        <p class="text-center text-white " style="font-size: 10px;">Find Clinics</p>
                    </div>
                </div>
                <div class=" col-3 mt-5 mb-5">
                    <div class="card border border-0 rounded-circle p-2" style=" background-color: rgb(24 205 205); width:100px; height:100px;">
                        <img src="./Image/navIocn8.png" class="card-img-top w-75 ms-2" alt="...">
                        <p class="text-center text-white " style="font-size: 10px;">Medical Records</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="row ">
            <div class="col-12">
                <form role="search" action="doctor_list.php" method="post" onsubmit="return validateSearchInput();">
                    <div class="d-flex justify-content-center">

                        <div class="input-group w-75" style="height: 50px;">
                            <!-- Input for search -->
                            <input type="text" class="form-control" id="searchBar" name="searchBar" placeholder="Search by Specialization" aria-label="Search" style="height: 50px;" required>
                            <!-- Search button -->
                            <button type="submit" class="btn btn-primary" style="background-color: rgb(24 205 205); height: 50px; width:100px;">
                                <i class="fas fa-search"></i>
                            </button>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="d-flex justify-content-center">
                            <!-- Suggestions dropdown -->
                            <div id="suggestionBox" class="mt-2"></div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="justify-content-center d-flex">
            <div class="row mt-4 justify-content-center w-50 ">
                <div class="col-sm-6 col-md-3 boder-1 bg-white rounded">
                    <a href="" class="text-decoration-none d-flex justify-content-center ">
                        <div>
                            <img src="./Image/gp.png" width="40px" alt="...">
                            <br>
                            <p class="text-center">General Physician</p>
                        </div>
                    </a>
                </div>

                <div class="col-sm-6 col-md-3 boder-1 bg-white rounded">
                    <a href="" class="text-decoration-none d-flex justify-content-center ">
                        <div>
                            <img src="./Image/pediatrician.png" width="40px" alt="...">
                            <br>
                            <p class="text-center">Pediatrician </p>
                        </div>
                    </a>
                </div>
                <div class="col-sm-6 col-md-3 boder-1 bg-white rounded">
                    <a href="" class="text-decoration-none d-flex justify-content-center ">
                        <div>
                            <img src="./Image/therapist.png" width="40px" alt="...">
                            <br>
                            <p class="text-center">General practitioner </p>
                        </div>
                    </a>
                </div>

                <div class="col-sm-6 col-md-3 boder-1 bg-white rounded">
                    <a href="" class="text-decoration-none d-flex justify-content-center ">
                        <div>
                            <img src="./Image/dermatologist.png" width="40px" alt="...">
                            <br>
                            <p class="text-center">Dermatologist</p>
                        </div>
                    </a>
                </div>
            </div>
        </div>
        <div class="justify-content-center d-flex">
            <div class="row justify-content-center w-50 ">
                <div class="col-sm-6 col-md-3 boder-1 bg-white rounded">
                    <a href="" class="text-decoration-none d-flex justify-content-center ">
                        <div>
                            <img src="./Image/optometrist.png" width="40px" alt="...">
                            <br>
                            <p class="text-center">Ophthalmology
                            </p>
                        </div>
                    </a>
                </div>

                <div class="col-sm-6 col-md-3 boder-1 bg-white rounded">
                    <a href="" class="text-decoration-none d-flex justify-content-center ">
                        <div>
                            <img src="./Image/surgeon.png" width="40px" alt="...">
                            <br>
                            <p class="text-center">Surgeon
                            </p>
                        </div>
                    </a>
                </div>
                <div class="col-sm-6 col-md-3 boder-1 bg-white rounded">
                    <a href="" class="text-decoration-none d-flex justify-content-center ">
                        <div>
                            <img src="./Image/urology.png" width="40px" alt="...">
                            <br>
                            <p class="text-center">Urologist
                            </p>
                        </div>
                    </a>
                </div>

                <div class="col-sm-6 col-md-3 boder-1 bg-white rounded">
                    <a href="" class="text-decoration-none d-flex justify-content-center ">
                        <div>
                            <img src="./Image/ultrasound.png" width="40px" alt="...">
                            <br>
                            <p class="text-center">Ultrasound Centre</p>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>
    <div class="container mt-3 d-flex justify-content-center">
        <div class="row">
            <div class="col-12">
                <button id="showMoreBtn" class="btn btn-secondary bg-1">Show More</button>
            </div>

            <div class="col-12">
                <ul id="itemList" class="list-unstyled d-none">
                    <li><a class="text-decoration-none" href="#">Plastic Surgery</a></li>
                    <li><a class="text-decoration-none" href="#">General Medicine</a></li>
                    <li><a class="text-decoration-none" href="#">Cardiologist</a></li>
                </ul>
            </div>
        </div>
    </div>

    <div class="container-fluid mt-5">
        <div class="container">
            <h4 class="text-1">Featured of Services</h4>
            <div class="row  ">

                <div class="col-lg-4 mt-4 mb-5 ">
                    <div class="card p-3 " id="border-1" style="background-color: rgb(243 244 244);">

                        <h5 class="card-title text-uppercase text-center text-1 ">Talk to Doctor</h5>
                        <div class="col-12 d-flex justify-content-center ">
                            <img src="./Image/TALK TO DOCTOR.jpg" class="w-50" alt="...">
                        </div>
                        <a href="#" class="card-link text-center text-1 mt-3 text-decoration-none"><button type="button" class="btn btn-info text-white fs-5">Talk To Us</button></a>
                    </div>
                </div>

                <div class="col-lg-4 mt-4 mb-5 ">
                    <div class="card p-3 " id="border-1" style="background-color: rgb(243 244 244);">

                        <h5 class="card-title text-uppercase text-center text-1 "> Chat's With Doctor</h5>
                        <div class="col-12 d-flex justify-content-center ">
                            <img src="./Image/text chat with doctor.jpg" class="w-50" alt="...">
                        </div>
                        <a href="#" class="card-link text-center text-1 mt-3 text-decoration-none"><button type="button" class="btn btn-info text-white fs-5">CHAT'S To Us</button></a>
                    </div>
                </div>

                <div class="col-lg-4 mt-4 mb-5 ">
                    <div class="card p-2 pt-3 " id="border-1" style="background-color: rgb(243 244 244);">

                        <h5 class="card-title text-uppercase fs-5 text-center text-1 ">Video Consultation to Doctor</h5>
                        <div class="col-12 d-flex justify-content-center ">
                            <img src="./Image/chat with doctor.jpg" class="w-50" alt="...">
                        </div>
                        <a href="#" class="card-link text-center text-1 mt-3 text-decoration-none"><button type="button" class="btn btn-info text-white fs-5">video Chat's With Us</button></a>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <div class="container-fluid p-3 " style="background-color: rgb(243 244 244);">
        <div class="container mt-2">
            <div class="row">
                <div class="col-lg-6">
                    <img style="width: 100%;" class="img-fluid p-3" src="./Image/about.jpg" alt="">
                </div>
                <div class="col-lg-6 p-2">
                    <h1 class="text-center"> About Us</h1>
                    <h5> Welcome to menalwell technologies pvt ltd</h5>
                    <p> At menalwell technologies pvt ltd we are passionate about [briefly describe the core mission or purpose of your company]. Founded in [year of establishment], we have been on a journey to [mention any significant milestones or achievements].</p>

                    <h5> What Sets Us Apart</h5>
                    <ul>
                        <li>Innovation: [Highlight any innovative approaches, technologies, or solutions your company employs.]</li>
                        <li> Customer-Centric: [Emphasize your commitment to providing excellent customer service and meeting the needs of your clients.]</li>
                        <li> Quality Assurance: [If applicable, discuss any quality standards or practices that set your products or services apart.]</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <?php include 'footer.php' ?>
    <!-- Bootstrap JS (optional, if needed) -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <!-- jQuery (required for AJAX) -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#searchBar').keyup(function() {
                var query = $(this).val();
                if (query !== '') {
                    $.ajax({
                        url: "suggest_doctors.php",
                        method: "POST",
                        data: {
                            query: query
                        },
                        success: function(data) {
                            $('#suggestionBox').fadeIn();
                            $('#suggestionBox').html(data);
                        }
                    });
                } else {
                    // If the search bar is empty, hide the suggestion box
                    $('#suggestionBox').fadeOut();
                }
            });

            // Hide the suggestion box when clicking outside of it
            $(document).on('click', function(e) {
                if (!$(e.target).closest('#suggestionBox').length && !$(e.target).closest('#searchBar').length) {
                    $('#suggestionBox').fadeOut();
                }
            });

            // Fill the search bar with clicked suggestion and hide the suggestion box
            $(document).on('click', '#suggestionBox .list-group-item', function() {
                $('#searchBar').val($(this).text());
                $('#suggestionBox').fadeOut();
            });
        });
    </script>
</body>

</html>