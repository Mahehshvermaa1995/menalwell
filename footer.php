<!doctype html>
<html lang="en" data-bs-theme="auto">

<head>
    <script src="../assets/js/color-modes.js"></script>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.118.2">
    <title></title>

    <link rel="canonical" href="https://getbootstrap.com/docs/5.3/examples/footers/">



    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@docsearch/css@3">

    <link href="./Vender/bootstrap-5.3.2-dist/css/bootstrap.min.css"  rel="stylesheet">

    <style>
        .bd-placeholder-img {
            font-size: 1.125rem;
            text-anchor: middle;
            -webkit-user-select: none;
            -moz-user-select: none;
            user-select: none;
        }

        @media (min-width: 768px) {
            .bd-placeholder-img-lg {
                font-size: 3.5rem;
            }
        }

        .b-example-divider {
            width: 100%;
            height: 3rem;
            background-color: rgba(0, 0, 0, .1);
            border: solid rgba(0, 0, 0, .15);
            border-width: 1px 0;
            box-shadow: inset 0 .5em 1.5em rgba(0, 0, 0, .1), inset 0 .125em .5em rgba(0, 0, 0, .15);
        }

        .b-example-vr {
            flex-shrink: 0;
            width: 1.5rem;
            height: 100vh;
        }

        .bi {
            vertical-align: -.125em;
            fill: currentColor;
        }

        .nav-scroller {
            position: relative;
            z-index: 2;
            height: 2.75rem;
            overflow-y: hidden;
        }

        .nav-scroller .nav {
            display: flex;
            flex-wrap: nowrap;
            padding-bottom: 1rem;
            margin-top: -1px;
            overflow-x: auto;
            text-align: center;
            white-space: nowrap;
            -webkit-overflow-scrolling: touch;
        }

        .btn-bd-primary {
            --bd-violet-bg: #712cf9;
            --bd-violet-rgb: 112.520718, 44.062154, 249.437846;

            --bs-btn-font-weight: 600;
            --bs-btn-color: var(--bs-white);
            --bs-btn-bg: var(--bd-violet-bg);
            --bs-btn-border-color: var(--bd-violet-bg);
            --bs-btn-hover-color: var(--bs-white);
            --bs-btn-hover-bg: #6528e0;
            --bs-btn-hover-border-color: #6528e0;
            --bs-btn-focus-shadow-rgb: var(--bd-violet-rgb);
            --bs-btn-active-color: var(--bs-btn-hover-color);
            --bs-btn-active-bg: #5a23c8;
            --bs-btn-active-border-color: #5a23c8;
        }

        .bd-mode-toggle {
            z-index: 1500;
        }

        .bd-mode-toggle .dropdown-menu .active .bi {
            display: block !important;
        }
    </style>


</head>

<body>
<div class="container-fluid bg-body-tertiary">
<div class="container">
  <footer class="py-5">
    <div class="row">
      <div class="col-6 col-md-3 mb-3">
        <h5>General Links</h5>
        <ul class="nav flex-column">
          <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-body-secondary">Home</a></li>
          <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-body-secondary">About Us</a></li>
          <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-body-secondary">Contact Us</a></li>
          <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-body-secondary">Privacy Policy</a></li>
          <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-body-secondary">Terms & Conditions</a></li>
          <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-body-secondary">Careers</a></li><li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-body-secondary">Blog</a></li>
        </ul>
      </div>

      <div class="col-6 col-md-3 mb-3">
        <h5>For Doctors</h5>
        <ul class="nav flex-column">
          <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-body-secondary">Doctors Profile</a></li>
          <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-body-secondary">Schedule Appointments</a></li>
          <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-body-secondary">Diagnostic Assistant</a></li>
          <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-body-secondary">Patient Alerts</a></li>
          <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-body-secondary">E-Prescriptions</a></li>
          <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-body-secondary">Earn from Phone</a></li>
          <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-body-secondary">ROI</a></li>
        </ul>
      </div>

      <div class="col-6 col-md-3 mb-3">
        <h5>For Patient</h5>
        <ul class="nav flex-column">
          <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-body-secondary">Find Doctors</a></li>
          <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-body-secondary">Find Clinics</a></li>
          <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-body-secondary">Online Consultation</a></li>
          <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-body-secondary">Home Visit Consultation</a></li>
          <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-body-secondary">Emergency Hospitals</a></li>
          <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-body-secondary">Emergency Ambulance</a></li>
          <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-body-secondary">Medicine Details</a></li>
        </ul>
      </div>

      <div class="col-6 col-md-3 mb-3">
        <h5>For Clinics</h5>
        <ul class="nav flex-column">
          <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-body-secondary">Clinic Profile</a></li>
          <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-body-secondary">Manage Staff</a></li>
          <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-body-secondary">Health Packages & Plans</a></li>
          <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-body-secondary">Sponsored Listing</a></li>
          <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-body-secondary">Patient Relationship Management</a></li>
          <li class="nav-item mb-2"><img src="./Image/payumoney.png" alt=""></li>
          
        </ul>
      </div>
    </div>

    <div class="d-flex flex-column flex-sm-row justify-content-between py-4 my-4 border-top">
      <p>&copy; Copyright © 2019, Menalwell. All rights reserved.</p>
      <ul class="list-unstyled d-flex">
       <li><a class="text-decoration-none" href="http://menalwell.com/">Menalwell Technologies Pvt. Ltd.</a></li>
      </ul>
    </div>
  </footer>
</div>
</div>
<script src="./Vender/bootstrap-5.3.2-dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>