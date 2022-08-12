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

        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="">
        <meta name="author" content="">

        <title> Barangay Officials </title>

        <!-- Montseratt Font -->
        <link rel="preconnect" href="https://fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,400;0,500;0,800;1,500&display=swap" rel="stylesheet">
    

        <!-- Link for Bootstrap CSS -->
        <!-- <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css"> -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <!-- Link for Bootstrap Icons -->
        <script src="https://kit.fontawesome.com/4aee20adf0.js" crossorigin="anonymous"></script>
        <!-- Link for Local CSS -->
        <link rel="stylesheet" href="stylesheets/user_BarangayOfficials.css" >

    </head>

    <body>
        <div>

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
                            <li class="nav-item pl-3 pr-3">
                                <a class="nav-link" href="user_Documents.php">Documents</a>
                            </li>
                            <li class="nav-item pl-3 pr-3 active">
                                <a class="nav-link" href="user_BarangayOfficials.php">Barangay Officials</a>
                            </li>
                            <li class="nav-item pl-3 pr-3">
                                <a class="nav-link" href="user_Announcements.php">Announcements</a>
                            </li>
                            
                        </ul>
                    </div>
                    
                    <a href="user_BarangayOfficials.php?logout=true">
                        <button style="font-family: 'Montserrat', sans-serif !important;" class="btn btn-outline-danger logout-btn  mr-md-5" type="button"  id="logout-btn">Logout</button>
                    </a>
                </nav>
            </div>

            <div class="container-fluid ">
                
                <div > 

                    <div>
                        <!-- Table Markuo -->
                        <div class="row justify-content-center">
                            
                            <div class="col-md-10">

                                <div class="officials-table-container">
                                    <div class="table-responsive w-auto text-nowrap officials-table-div">

                                        <table class="table table-borderless table-hover officials-table " >

                                            <thead>
                                                <th class="officials-table-heading">Barangay Official Position</th>
                                                <th class="officials-table-heading">Barangay Official Name</th>
                                                <th class="officials-table-heading">Sex</th>
                                                <th class="officials-table-heading">Contact Number</th>
                                            
                                            </thead>
                                            
                                            <?php
                                            $qry = "SELECT * FROM official_info ORDER BY official_position ASC";
                                            $stmt = $userObj->runQuery($qry);
                                            $stmt->execute();
                                            ?>
                                            
                                            <tbody>
                                                <?php 
                                                    if($stmt->rowCount()>0)
                                                    {
                                                        while($rowUser = $stmt->fetch(PDO::FETCH_ASSOC)){ 
                                                ?>
                                                
                                                <tr>
                                                    
                                                    <td><?php print($rowUser['official_position']) ?></td>

                                                    <td><?php print($rowUser['official_first_name'] . " " . $rowUser['official_middle_name']. " " . $rowUser['official_last_name']) ?></td>

                                                    <td><?php print($rowUser['official_sex']) ?></td>

                                                    <td><?php print($rowUser['official_contact_info']) ?></td>

                                                </tr>              

                                            </tbody>
                                                <?php
                                                        } };
                                                ?>

                                        </table>

                                    </div>
                                </div>

                            </div>

                        </div>
                    </div>

                </div>

            </div>

        </div>   

        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
        <script src="https://code.jquery.com/jquery-3.5.1.js" integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc=" crossorigin="anonymous"></script>
        <script type="text/javascript" src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"> </script>
    
        <script>

            $(document).ready(function(){


            });





        </script>
    </body>
    
</html>