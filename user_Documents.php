<?php

require_once ('dbConfig.php');
require_once ('functions.php');

$userObj = new User();
$database = new Database();
$db = $database->dbConnection();

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
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Documents</title>
    
    <!-- Montseratt Font -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,400;0,500;0,800;1,500&display=swap" rel="stylesheet">
    
    <!-- Local CSS -->
    <link rel="stylesheet" href="stylesheets/user_Documents.css">

    <!-- Link for Bootstrap Icons -->
    <script src="https://kit.fontawesome.com/4aee20adf0.js" crossorigin="anonymous"></script>
        
    <!-- Link for Local bootstrap Datetimepicker CSS -->
    <link rel="stylesheet" href="css/bootstrap-datetimepicker.min.css">

    <!-- Link for Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    
    
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

                        <li class="nav-item pl-3 pr-3 ">
                            <a class="nav-item nav-link" href="user_Home.php">Home</a>
                        </li>

                        <li class="nav-item pl-3 pr-3 ">
                            <a class="nav-link" href="user_PersonalInfo.php">Personal Info</a>
                        </li>
                        <li class="nav-item pl-3 pr-3 active">
                            <a class="nav-link" href="user_Documents.php">Documents</a>
                        </li>
                        <li class="nav-item pl-3 pr-3">
                            <a class="nav-link" href="user_BarangayOfficials.php">Barangay Officials</a>
                        </li>
                        <li class="nav-item pl-3 pr-3">
                            <a class="nav-link" href="user_Announcements.php">Announcements</a>
                        </li>
                        
                    </ul>
                </div>
                
                <a href="user_Documents.php?logout=true">
                    <button class="btn btn-outline-danger logout-btn  mr-md-5" type="button"  id="logout-btn">Logout</button>
                </a>
            </nav>
        </div>

    <br><br>
    
    
    <div class="container-fluid">
        <div class="page-container">

            <!-- Documents Card Markup -->
            <div class="document-container">

                <div>

                </div>
                
                <div class="row justify-content-center">

                    <div class="col-md-10">

                        <div class="posts-container" id="card_container">

                            <?php
                                $qry = "SELECT * FROM documents ORDER BY id DESC";
                                    $stmt = $userObj->runQuery($qry);
                                    $stmt->execute();

                                    if($stmt->rowCount()>0)
                                        {
                                            while($rowUser = $stmt->fetch(PDO::FETCH_ASSOC)){ 
                        
                            ?>
                                            
                            <div class="card pb-2  mt-5 ml-3 mr-3 post-card" >

                                <div class="card-header post-header"> 
                                    <div class="row">

                                        <div class="col text-left">
                                            <?php print($rowUser['name']) ?>
                                        </div>

                                    </div>
                                </div>

                                <div class="card-body">
                                    
                                    <h6 class="card-title post-title">Document Uploaded on <?php print($rowUser['upload_date_time']) ?></h5>
                                    <p class="card-text post-body"><?php print($rowUser['description']) ?></p>

                                    <a href='documents/<?php print($rowUser['name']) ?>' class="btn btn-primary download-btn">Download</a>
                                </div>
                            </div>


                            <?php
                                }; };
                            ?>
                        </div>

                        <div class="row">

                        </div>

                    </div>
                    

                    
                
                </div>
            </div>

        </div>
    </div>
    

    <!-- Footer -->
    <div class="row m-0">
        <div class="col-12 text-center text-muted">
            <p class="m-0 pb-3 mt-md-2 mt-sm-2">Brgy. San Antonio, Copyright ©️ 2020 </p>
        </div>
    </div>

    <!-- JQuery JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.js" integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc=" crossorigin="anonymous"></script>
    
    <!-- Popper JS -->
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>

    <!-- Bootstrap JS -->
    <script type="text/javascript" src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"> </script>

    <!-- Moment Js for datetimepicker -->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.0/moment.min.js"></script>
    
    <!-- Datetimepicker bootstrap JS -->
    <script src="js/bootstrap-datetimepicker.min.js"></script>
        
    <script>

    </script>
</body>
</html>