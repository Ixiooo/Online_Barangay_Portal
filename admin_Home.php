<?php

session_start();

if(!isset($_SESSION['session_login']))
{
    header("Location: index.php");
}

if(isset($_GET['logout']))
{
    session_destroy();
    unset($_SESSION);
    header("Location: index.php");
}

?>


<!DOCTYPE html>
<html>
<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">


    <!-- Montseratt Font -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,400;0,500;0,800;1,500&display=swap" rel="stylesheet">
    
    <!-- Local CSS -->
    <link rel="stylesheet" href="stylesheets/user_Home.css">

    <!-- Bootstrap -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css">
    <title>Home</title>
</head>

<body> 

    <!-- Navbar Markup -->
    <div>
        <nav class="navbar navbar-expand-lg mb-5">

            <button class="navbar-toggler navbar-light" type="button" data-toggle="collapse" data-target="#navbar1">
                <span class="navbar-toggler-icon"></span>
            </button>

            <img src="img/Logo.png" alt="logo" id="nav-img" class="ml-md-5">

            <div class="navbar-collapse collapse  justify-content-center" id="navbar1">
                <ul class="navbar-nav">

                    <li class="nav-item pl-3 pr-3 active">
                        <a class="nav-item nav-link" href="admin_Home.php">Home</a>
                    </li>

                    <li class="nav-item pl-3 pr-3 ">
                        <a class="nav-link" href="admin_Residents.php">Residents</a>
                    </li>
                    <li class="nav-item pl-3 pr-3">
                        <a class="nav-link" href="admin_Documents.php">Documents</a>
                    </li>
                    <li class="nav-item pl-3 pr-3">
                        <a class="nav-link" href="admin_BarangayOfficials.php">Barangay Officials</a>
                    </li>
                    <li class="nav-item pl-3 pr-3">
                        <a class="nav-link" href="admin_Announcements.php">Announcements</a>
                    </li>
                    
                </ul>
            </div>
            
            <a href="admin_Home.php?logout=true">
                <button class="btn btn-outline-danger logout-btn  mr-md-5" type="button"  id="logout-btn">Logout</button>
            </a>
        </nav>
    </div>

    <br><br>

    <div class="container-fluid ">

        <!-- Hero Area -->
        <div class="row align-items-center justify-content-center m-0" id="heroarea">
            <div class="col-md-8 col-sm-10">
                <h1 class="mt-5 mb-3">Barangay San Antonio</h1>
                <p class="pt-3 pb-2">Barangay San Antonio is a continuously growing barangay that has more than one thousand residents. </p>
                <button id="viewmore-btn" class="btn mt-3 mb-5"><a class="text-light" href="#mission-vision">VIEW MORE</a></button>
                <br><br><br>
            </div>
        </div>

        <!-- Mission / Vision -->
        <div class="row align-items-center justify-content-around bg-danger text-light m-0" id="mission-vision"> 
            <div class="col-md-5 text-center py-md-5 px-md-0 p-sm-5" id="mission">
                <h4 class="py-2">MISSION</h4>
                <p class="py-2">Barangay San Antonio will continuously work in achieving unity and cooperation within the whole barangay to attain of peace, harmony, and progress, together with improving and enhancing the delivery of basic social services and infrastructure facilities. The people’s capacity to manage resources and organizations is strengthened together with coordination and association with several agencies of the government and the private sector.”</p>
            </div>
            <div class="col-md-5 text-center py-md-5 px-md-0 p-sm-5" id="vision">
                <h4 class="py-2">VISION</h4>
                <p class="py-2"> Barangay San Antonio is a barangay that is peaceful, prosperous, and united. The barangay residents are god-fearing, healthy, industrious, happy, and well-off citezens that are united together for a common purpose of achieving food sufficiency, barangay productivity, barangay efficiency, and clean invironment under a a democratic system of management. Fair and human leadership that shall ultimately result in a better quality of life of the people.”</p>
            </div>
        </div>
       
        <!-- Contact -->
        <div class="row m-0 justify-content-center" id="contact">
            <div class="col-12 text-center p-5 pb-lg-5 pb-md-0 pb-sm-0">
                <h4>CONTACT</h4>
            </div>
            <div class="col-lg-4 align-items-center col-sm-10 p-5 clearfix" >
                <h5 class="pb-3 pt-sm-0">Get In Touch</h5>
                <p class="pt-4" id="b-top">brgysanantonio@gmail.com</p>
                <img src="./img/telephone-icon.png" alt="phone-icon">
                <ul class="d-inline-block m-0 p-0 pl-3 clearfix">
                    <li>+ 63 97 5832 1123</li>
                    <li>+ 63 97 5832 1123</li>
                </ul>
                <p class="pt-3" id="b-bot">(02)7576-4567</p>
                <img src="./img/fb-icon.png" class="pr-1" alt="fb-icon">
                <img src="./img/email-icon.png" alt="email-icon">
            </div>
            <div class="col-lg-5 col-md-10 col-sm-10 align-items-center pl-5 pt-lg-5 mb-lg-5 mb-md-0 mb-sm-0" id="b-left">
                <h6 class="pb-3">San Antonio, San Pascual, Batangas</h6> 
                <img src="./img/map.png " alt="location" class="mb-lg-5 mb-sm-0 mb-md-0 img-fluid"> 
            </div>
        </div>
    </div>

    <!-- Footer -->
    <div class="row m-0 pt-3 footer-div">
        <div class="col-12 text-center text-muted">
            <p class="m-0 pb-3 mt-md-2 mt-sm-2">Brgy. San Antonio, Copyright ©️ 2020 </p>
        </div>
    </div>


    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    

    <script>

    </script>

</body>
</html>