<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* Your additional styles go here */
        .dropdown {
            position: relative;
            display: inline-block;
        }

        .dropbtn {
            background-color: #3498db;
            color: white;
            padding: 10px;
            font-size: 16px;
            border: none;
            cursor: pointer;
        }

        .dropdown-content {
            display: none;
            position: absolute;
            background-color: #f9f9f9;
            min-width: 160px;
            box-shadow: 0px 8px 16px 0px rgba(0, 0, 0, 0.2);
            z-index: 1;
        }

        .dropdown-content a {
            color: black;
            width: 60px;
            text-decoration: none;
            display: block;
        }

        .dropdown-content a:hover {
            background-color: #f1f1f1;
        }

        .dropdown:hover .dropdown-content {
            display: block;
        }

        #button-search {
            background-color: rgb(24 205 205);
            width: 200px;
        }
    </style>
</head>

<body>
    <nav class="navbar navbar-expand-lg bg-body-tertiary fixed-top">
        <div class="container-fluid">
            <div class="ms-5">
                <a href="/" class="d-inline-flex link-body-emphasis text-decoration-none">
                    <img width="50%" src="./Image/logo.png" alt="">
                </a>
            </div>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <div class="ms-5">
                    <ul class="nav ms-5">
                        <li class="ms-5"><a href="#" class="nav-link px-2 ms-5">List your practice, it's free</a></li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Help</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Policy</a>
                        </li>
                    </ul>
                </div>

            </div>
            <div class="me-5 mt-2 dropdown">
                <button id="button-search" class="dropbtn btn btn-primary dropbtn">Login</button>
                <div class="dropdown-content p-2">
                    <span class="d-flex mt-2">
                        <span>Doctor</span>
                        <a href="Doctor_login.php">Login</a>
                        <a href="Doctor_Sign_up.php">Sign up</a>
                    </span>

                </div>
            </div>
        </div>
    </nav>

    <!-- Bootstrap Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
