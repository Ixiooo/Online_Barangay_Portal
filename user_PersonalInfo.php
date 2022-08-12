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
    <!-- Montseratt Font -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,400;0,500;0,800;1,500&display=swap" rel="stylesheet">
    
    <!-- Local CSS -->
    <link rel="stylesheet" href="stylesheets/user_PersonalInfo.css">

    <!-- Bootstrap -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <title>Document</title>
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

                    <li class="nav-item pl-3 pr-3 active">
                        <a class="nav-link" href="user_PersonalInfo.php">Personal Info</a>
                    </li>
                    <li class="nav-item pl-3 pr-3">
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
            
            <a href="user_PersonalInfo.php?logout=true">
                <button style="font-family: 'Montserrat', sans-serif !important;" class="btn btn-outline-danger logout-btn  mr-md-5" type="button"  id="logout-btn">Logout</button>
            </a>
        </nav>
    </div>

    <?php
        $resident_id = $_SESSION['session_login']['resident_id'];

        $sql="SELECT * FROM resident_info WHERE resident_id = $resident_id ";
        $stmt=$userObj->runQuery($sql);
        $stmt->execute();
        
        if($stmt->rowCount()>0)
        {
            while($rowUser = $stmt->fetch(PDO::FETCH_ASSOC)){ 
    ?>
    
    <br><br>
    <div class="row mb-5">
        <div class="col-6 offset-3 justify-content-center" style="height:120px; border: 1px solid #ef6969;">
            <div class="row align-items-center justify-content-around">
                <div class="col-2" >
                    <img src="./img/Logo.png" width="70px" height="70px" class="m-4" alt="icon">
                </div>
                <div class="col-8">
                    <h5 class="p-0 m-0"> Name: <?php print($rowUser['first_name'] . " " . $rowUser['middle_name']. " " . $rowUser['last_name'])  ?></h5>
                    <p class="p-0 pt-2 m-0">Resident ID: <?php print($rowUser['resident_id']) ?> </p>
                </div>
            </div>
        </div> 
               
    </div>
    <div class="row m-0">

        <div class="col-4 pl-3 offset-2 align-items-left text-right">
            <p>First Name</p>
            <p>Middle Name</p>
            <p>Last Name</p>
            <p>Suffix</p>
            <p>Birthdate</p>
            <p>Alias</p>
            <p>Sex</p>
            <p>Civil Status</p>
            <p>Mobile Number</p>
            <p>Email</p>
            <p>Religion</p>
            <p>Voter Status</p>
        </div>
                    
        <div class="col-4 pr-3 offsetr-2 align-items-right text-left">
            <p><?php print($rowUser['first_name'])?></p>
            <p><?php print($rowUser['middle_name']) ?></p>
            <p><?php print($rowUser['last_name']) ?></p>
            <p><?php print($rowUser['suffix']) ?></p>
            <p><?php print($rowUser['birthday']) ?></p>
            <p><?php print($rowUser['alias']) ?></p>
            <p><?php print($rowUser['sex']) ?></p>
            <p><?php print($rowUser['civil_stat']) ?></p>
            <p><?php print($rowUser['mobile_no']) ?></p>
            <p><?php print($rowUser['email']) ?></p>
            <p><?php print($rowUser['religion']) ?></p>
            <p><?php print($rowUser['voter_stat']) ?></p>
        </div>
    </div>
    
    <?php
        };  };
    ?>


    <!-- Footer -->
    <div class="row m-0 mt-3">
        <div class="col-12 text-center text-muted">
            <p class="m-0 pb-3 mt-md-2 mt-sm-2">Brgy. San Antonio, Copyright ©️ 2020 </p>
        </div>
    </div>
</body>
</html>