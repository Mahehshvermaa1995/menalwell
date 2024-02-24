<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>menalwell technologies pvt ltd</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
        .bg-1 {
            background-color: rgb(24 205 205);
        }

        .text-1 {
            color: rgb(24 205 205);

        }

        .boder-1 {
            border: 1px solid rgb(24, 205, 205);
        }

        #boder-1 {
            border: 1px solid rgb(24, 205, 205);
        }
    </style>
</head>


<?php
include_once 'sql_connection.php';
include_once 'get_suggestions.php'
?>

<body>
    <?php
    include 'header.php';
    ?>
    <div class="container-fluid d-flex justify-content-center align-items-center" style="background-color: rgb(243 244 244); height: 50vh; ">
        <div class="container">
            <div class="row  ">
                <div class="col-12">

                    <div class="container">
                        <h1 class="text-center mb-5"></h1>
                        <div class="row justify-content-center">
                            <div class="col-2 mb-3">
                                <div class="card border border-0 rounded-circle p-3" style=" background-color: rgb(24 205 205); width:100px; height:100px;">
                                    <img src="./Image/hospitalnav.png" class="card-img-top w-75 ms-2" alt="...">
                                    
                                        <p class="text-center text-white " style="font-size: 10px;" >Find Hospitals</p>
                                    
                                </div>
                            </div>
                            <div class="col-2 mb-3">
                                <div class="card border border-0 rounded-circle p-3" style=" background-color: rgb(24 205 205); width:100px; height:100px;">
                                    <img src="./Image/navIocn6.png" class="card-img-top w-75 ms-2" alt="...">
                                    
                                        <p class="text-center text-white " style="font-size: 10px;" >Find Doctors</p>
                                    
                                </div>
                            </div>
                            <div class="col-2 mb-3">
                                <div class="card border border-0 rounded-circle p-3" style=" background-color: rgb(24 205 205); width:100px; height:100px;">
                                    <img src="./Image/navIocn7.png" class="card-img-top w-75 ms-2" alt="...">
                                    
                                        <p class="text-center text-white " style="font-size: 10px;" >Find Clinics</p>
                                    
                                </div>
                            </div>
                            <div class="col-2 mb-3">
                                <div class="card border border-0 rounded-circle p-2" style=" background-color: rgb(24 205 205); width:100px; height:100px;">
                                    <img src="./Image/navIocn8.png" class="card-img-top w-75 ms-2" alt="...">
                                    
                                        <p class="text-center text-white " style="font-size: 10px;" >Medical Records
                                        </p>
                                   
                                </div>
                            </div>
                        </div>
                        <form class="d-flex justify-content-center" role="search" action="doctor_list.php" method="post" onsubmit="return validateSearchInput();">
                            <!-- Your existing form elements -->
                            <div class="input-group w-75" style="height: 50px;">
                                <input type="text" class="form-control" id="searchBar" name="searchBar" placeholder="Search by Specialization" aria-label="Search" style="height: 50px;" required>
                                <button type="submit" class="btn btn-primary" style="background-color: rgb(24 205 205); height: 50px; width:100px;">
                                    <i class="fas fa-search"></i>
                                </button>
                            </div>
                        </form>

                    </div>

                </div>
            </div>
        </div>
    </div>


    <div class="row mt-4 justify-content-center ">
        <div class="col-sm-2 boder-1 bg-white rounded" style="width: 130px; height:100px;">
            <a href="" class="text-decoration-none ">
                <img src="./Image/gp.png" class="card-img-top ms-5 mt-3 mb-1 " style="width: 30%;" alt="...">
                <br>
                <p class="text-center">General Physician</p>
            </a>
        </div>

        <div class="col-sm-2 boder-1 bg-white rounded" style="width: 130px; height:100px;">
            <a href="" class="text-decoration-none ">
                <img src="./Image/pediatrician.png" class="card-img-top ms-5 mt-3 mb-1 " style="width: 30%;" alt="...">
                <br>
                <p class="text-center">Pediatrician </p>
            </a>
        </div>
        <div class="col-sm-2 boder-1 bg-white rounded" style="width: 130px; height:100px;">
            <a href="" class="text-decoration-none ">
                <img src="./Image/therapist.png" class="card-img-top ms-5 mt-3 mb-1 " style="width: 30%;" alt="...">
                <br>
                <p class="text-center">General practitioner </p>
            </a>
        </div>

        <div class="col-sm-2 boder-1 bg-white rounded" style="width: 130px; height:100px;">
            <a href="" class="text-decoration-none ">
                <img src="./Image/dermatologist.png" class="card-img-top ms-5 mt-3 mb-1 " style="width: 30%;" alt="...">
                <br>
                <p class="text-center">Dermatologist</p>
            </a>
        </div>
    </div>
    <div class="row justify-content-center ">
        <div class="col-sm-2 boder-1 bg-white rounded" style="width: 130px; height:100px;">
            <a href="" class="text-decoration-none ">
                <img src="./Image/optometrist.png" class="card-img-top ms-5 mt-3 mb-1 " style="width: 30%;" alt="...">
                <br>
                <p class="text-center">Ophthalmology
                </p>
            </a>
        </div>

        <div class="col-sm-2 boder-1 bg-white rounded" style="width: 130px; height:100px;">
            <a href="" class="text-decoration-none ">
                <img src="./Image/surgeon.png" class="card-img-top ms-5 mt-3 mb-1 " style="width: 30%;" alt="...">
                <br>
                <p class="text-center">Surgeon
                </p>
            </a>
        </div>
        <div class="col-sm-2 boder-1 bg-white rounded" style="width: 130px; height:100px;">
            <a href="" class="text-decoration-none ">
                <img src="./Image/urology.png" class="card-img-top ms-5 mt-3 mb-1 " style="width: 30%;" alt="...">
                <br>
                <p class="text-center">Urologist
                </p>
            </a>
        </div>

        <div class="col-sm-2 boder-1 bg-white rounded" style="width: 130px; height:100px;">
            <a href="" class="text-decoration-none ">
                <img src="./Image/ultrasound.png" class="card-img-top ms-5 mt-3 mb-1 " style="width: 30%;" alt="...">
                <br>
                <p class="text-center">Ultrasound Centre</p>
            </a>
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


    </div>
    </div>



    <div class="container-fluid mt-5">
        <div class="container">
            <div class="row  ">
                <h4 class="text-1">Featured of Services</h4>
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
                    <h5> Welcome tomenalwell technologies pvt ltd</h5>
                    <p> Atmenalwell technologies pvt ltd we are passionate about [briefly describe the core mission or purpose of your company]. Founded in [year of establishment], we have been on a journey to [mention any significant milestones or achievements].</p>

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
    <?php
    include 'footer.php';
    ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <script>
        // Function to validate the input length before form submission
        function validateSearchForm() {
            var searchBar = document.getElementById('searchBar');

            if (searchBar.value.length < 6) {
                alert('Please enter at least 6 characters for search.');
                return false; // Prevent form submission
            }

            return true; // Allow form submission
        }
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var showMoreBtn = document.getElementById('showMoreBtn');
            var itemList = document.getElementById('itemList');

            showMoreBtn.addEventListener('click', function() {
                itemList.classList.toggle('d-none');
            });

            // Add click event listeners to all anchor tags within the list
            var anchorTags = itemList.querySelectorAll('a');
            anchorTags.forEach(function(anchorTag) {
                anchorTag.addEventListener('click', function(event) {
                    // Prevent the default behavior of the anchor tag
                    event.preventDefault();

                    // Hide the item list
                    itemList.classList.add('d-none');
                });
            });
        });
    </script>
    <script>
        $(document).ready(function() {
            $('#searchBar').on('input', function() {
                var searchQuery = $(this).val();

                $.ajax({
                    url: 'get_suggestions.php',
                    type: 'GET',
                    data: {
                        query: searchQuery
                    },
                    dataType: 'json',
                    success: function(data) {
                        updateSuggestions(data);
                    },
                    error: function() {
                        $('#suggestionList').html('<li>Error fetching suggestions</li>');
                    }
                });
            });

            function updateSuggestions(suggestions) {
                var suggestionList = $('#suggestionList');
                suggestionList.empty();

                if (suggestions.length > 0) {
                    $.each(suggestions, function(index, suggestion) {
                        suggestionList.append('<li>' + suggestion + '</li>');
                    });
                } else {
                    suggestionList.append('<li>No records found</li>');
                }
            }
        });

        function validateSearchInput() {
            var searchBar = document.getElementById('searchBar');
            var searchInput = searchBar.value;

            if (searchInput.length < 6) {
                // Display tooltip below the input
                $(searchBar).tooltip({
                    title: 'Please enter at correct specialization for search.',
                    placement: 'bottom',
                    trigger: 'manual' // Show tooltip manually
                });

                // Show tooltip
                $(searchBar).tooltip('show');

                // Hide tooltip after 5 seconds
                setTimeout(function() {
                    $(searchBar).tooltip('hide');
                }, 5000);

                // Prevent form submission
                return false;
            }

            return true; // Allow form submission
        }

        function validateSearchInput() {
            var searchBar = document.getElementById('searchBar');
            var searchInput = searchBar.value;

            if (searchInput.length < 6) {
                // Display tooltip below the input
                $(searchBar).tooltip({
                    title: 'Please enter at least 6 characters for search.',
                    placement: 'bottom',
                    trigger: 'manual' // Show tooltip manually
                });

                // Show tooltip
                $(searchBar).tooltip('show');

                // Hide tooltip after 5 seconds
                setTimeout(function() {
                    $(searchBar).tooltip('hide');
                }, 5000);

                // Prevent form submission
                return false;
            }

            // Fetch suggestions if some matches are found
            // Modify the URL accordingly based on your server-side script
            $.get("suggestion_script.php", {
                query: searchInput
            }, function(data) {
                if (data.length > 0) {
                    // Display a suggestion message
                    alert("Did you mean: " + data.join(', '));
                }
            });

            return true; // Allow form submission
        }
    </script>
</body>

</html>