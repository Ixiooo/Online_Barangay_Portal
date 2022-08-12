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

        <title> Residents </title>

        <!-- Montseratt Font -->
        <link rel="preconnect" href="https://fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,400;0,500;0,800;1,500&display=swap" rel="stylesheet">
    
        <!-- Link for Bootstrap CSS -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <!-- Link for Bootstrap Icons -->
        <script src="https://kit.fontawesome.com/4aee20adf0.js" crossorigin="anonymous"></script>
        <!-- Link for Local CSS -->
        <link rel="stylesheet" href="stylesheets/admin_Residents.css" >

    </head>

    <body>
        <div>

            <!-- Markup for Navbar -->
            <div>
                <nav class="navbar navbar-expand-lg mb-5">

                    <button class="navbar-toggler navbar-light" type="button" data-toggle="collapse" data-target="#navbar1">
                        <span class="navbar-toggler-icon"></span>
                    </button>

                    <img src="img/Logo.png" alt="logo" id="nav-img" class="ml-md-5">

                    <div class="navbar-collapse collapse  justify-content-center" id="navbar1">
                        <ul class="navbar-nav">

                            <li class="nav-item pl-3 pr-3 ">
                                <a class="nav-item nav-link" href="admin_Home.php">Home</a>
                            </li>

                            <li class="nav-item pl-3 pr-3 active">
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

                    <a href="admin_Residents.php?logout=true">
                    <button style="font-family: 'Montserrat', sans-serif !important;" class="btn btn-outline-danger logout-btn  mr-md-5" type="button"  id="logout-btn">Logout</button>
                    </a>
                </nav>
            </div>

            <div class="container-fluid ">
                <!-- Markup for Search Bar and Add Resident Button -->
                <div class="row justify-content-around pb-4 mb-2 search-add-container">

                    <div class="col-md-4 mt-2 mb-2 ">
                        <div class="input-group">
                            <input type="text" class="form-control" placeholder="Search Residents" id="search_field" name="search_field">
                            <div class="input-group-append">
                            <button class="btn btn-danger search-btn" type="button">
                                <i class="fa fa-search"></i>
                            </button>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4 text-right mt-2 mb-2">
                        <button class="btn btn-danger add-btn" type="button" data-toggle="modal" data-target="#add-resident-modal">
                            + Add Resident
                        </button>
                    </div>

                </div>

                <div>
                    <!-- // PHP Code for Notification Alert -->
                    <?php

                       

                        if(isset($_GET['residentAdded']))
                        {
                            echo 
                            '<div style="text-align:center" class = "alert alert-success alert-dismissible fade show" role="alert">
                                Resident Added Successfully.
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>                               
                            </div>';
                        };

                        if(isset($_GET['residentUpdated']))
                        {
                            echo 
                            '<div style="text-align:center" class = "alert alert-success alert-dismissible fade show" role="alert">
                                Resident Edited Successfully
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>                               
                            </div>';
                        };

                        if(isset($_GET['residentDeleted']))
                        {
                            echo 
                            '<div style="text-align:center" class = "alert alert-success alert-dismissible fade show" role="alert">
                                Resident Deleted Successfully
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>                               
                            </div>';
                        };

                        if(isset($_GET['usernameTaken']))
                        {
                            echo 
                            '<div style="text-align:center" class = "alert alert-danger alert-dismissible fade show" role="alert">
                                Resident Edit Failed. Username is Already Taken, Please Choose Another Username
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>                               
                            </div>';
                        };

                    ?>
                </div>

                <!-- Markup for Resident Table -->
                <div class="row">

                    <div class="col-md-10 offset-md-1">

                        <div class="resident-table-container">

                            <div class="table-responsive w-auto text-nowrap resident-table-div" id="residents_table">

                                <table class="table table-borderless table-hover resident-table " >
                                    <thead>

                                        <th class="resident-table-heading"></th>
                                        <th class="resident-table-heading"></th>
                                        <th class="resident-table-heading">Resident ID</th>
                                        <th class="resident-table-heading">First Name</th>
                                        <th class="resident-table-heading">Middle Name</th>
                                        <th class="resident-table-heading">Last Name</th>
                                        <th class="resident-table-heading">Suffix</th>
                                        <th class="resident-table-heading">Alias/Nickname</th>
                                        <th class="resident-table-heading">Sex</th>
                                        <th class="resident-table-heading">Birth Date</th>
                                        <th class="resident-table-heading">Phone Number</th>
                                        <th class="resident-table-heading">Email Address</th>
                                        <th class="resident-table-heading">Religion</th>
                                        <th class="resident-table-heading">Civil Status</th>
                                        <th class="resident-table-heading">Voter Status</th>
                                        <th class="resident-table-heading">Username</th>
                                        <th class="resident-table-heading">Password</th>

                                    </thead>
                                    
                                    <?php
                                       $qry = "SELECT * FROM resident_info ORDER BY first_name ASC";
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

                                            <td>
                                                <a class="table-btn-anchor" href="#delete-resident-modal" data-toggle="modal" data-resident_id="<?php print($rowUser['resident_id']) ?>" >
                                                    <button type="button" class="btn btn-danger table-btn">
                                                        <span> <i class="fas fa-trash-alt"></i></span>
                                                    </button>
                                                </a>
                                            </td> 

                                            <td>
                                                <a class="table-btn-anchor" href="#edit-resident-modal" data-toggle="modal" data-resident_id="<?php print($rowUser['resident_id']) ?>" >
                                                    <button type="button" class="btn btn-danger table-btn">
                                                        <span> <i class="fas fa-edit"></i></span>
                                                    </button>
                                                </a>
                                            </td>

                                            <td><?php print($rowUser['resident_id']) ?></td>

                                            <td><?php print($rowUser['first_name']) ?></td>

                                            <td><?php print($rowUser['middle_name']) ?></td>

                                            <td><?php print($rowUser['last_name']) ?></td>

                                            <td><?php print($rowUser['suffix']) ?></td>

                                            <td><?php print($rowUser['alias']) ?></td>

                                            <td><?php print($rowUser['sex']) ?></td>

                                            <td><?php print($rowUser['birthday']) ?></td>

                                            <td><?php print($rowUser['mobile_no']) ?></td>

                                            <td><?php print($rowUser['email']) ?></td>

                                            <td><?php print($rowUser['religion']) ?></td>

                                            <td><?php print($rowUser['civil_stat']) ?></td>

                                            <td><?php print($rowUser['voter_stat']) ?></td>

                                            <td><?php print($rowUser['username']) ?></td>

                                            <td><?php print($rowUser['password']) ?></td>

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

                <!-- Footer Markup -->
                <div style="font-family: 'Montserrat', sans-serif !important;" class="row m-0 pt-3">
                    <div class="col-12 text-center text-muted">
                        <p class="m-0 pb-3 mt-md-2 mt-sm-2">Brgy. San Antonio, Copyright ©️ 2020 </p>
                    </div>
                </div>
            </div>

            <!-- Markup for Modal Dialogs -->

            <!-- Markup for Add Resident Modal -->
            <div class="modal fade" id="add-resident-modal" tabindex="-1" role="dialog" aria-labelledby="add-resident-modal" aria-hidden="true">
               
                <div class="modal-dialog modal-lg" role="document">

                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title add-resident-heading" id="add-resident-heading">Add Resident</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>

                        <div class="modal-body">
                            <form action="admin_Actions.php" method="post">

                                <div class="form-row">

                                    <div class="col-md-6 form-group ">
                                        <label for="first_name_field" class="add-resident-form-label" >First Name</label>
                                        <input type="text" class="form-control add-resident-form-field" placeholder="Given Name" id="first_name_field" name="first_name_field" required>
                                    </div>

                                    <div class="col-md-6 form-group">
                                        <label for="middle_name_field" class="add-resident-form-label" >Middle Name</label>
                                        <input type="text" class="form-control add-resident-form-field" placeholder="Given Name" id="middle_name_field" name="middle_name_field" required>
                                    </div>
                                       
                                </div>

                                <div class="form-row">

                                    <div class="col-md-6 form-group">
                                        <label for="last_name_field" class="add-resident-form-label" >Last Name</label>
                                        <input type="text" class="form-control add-resident-form-field" placeholder="Given Name" id="last_name_field" name="last_name_field" required>
                                    </div>

                                    <div class="col-md-3 form-group">
                                        <label for="suffix_field" class="add-resident-form-label" >Suffix</label>
                                        <input type="text" class="form-control add-resident-form-field" placeholder="(e.g. Jr.)" id="suffix_field" name="suffix_field" >
                                    </div>

                                    <div class="col-md-3 form-group">
                                        <label for="birthday_field" class="add-resident-form-label" >Date of Birth</label>
                                        <input type="date" class="form-control add-resident-form-field" id="birthday_field" name="birthday_field"  required>
                                        
                                    </div>
                                    
                                </div>

                                <div class="form-row">

                                    <div class="col-md-4 form-group">
                                        <label for="alias_field" class="add-resident-form-label" >Alias/Nickname</label>
                                        <input type="text" class="form-control add-resident-form-field" placeholder="Given Name" id="alias_field" name="alias_field" required>
                                    </div>

                                    <div class="col-md-4 form-group">
                                        <label for="sex_field" class="add-resident-form-label" >Sex</label>
                                        <select class="form-control add-resident-form-field" id="sex_field" placeholder="Sex" name="sex_field" required>
                                            <option></option>
                                            <option>Male</option>
                                            <option>Female</option>
                                        </select>
                                    
                                    </div>

                                    <div class="col-md-4 form-group">
                                        <label for="civil_stat_field" class="add-resident-form-label" >Civil Status</label>
                                        <select class="form-control add-resident-form-field" id="civil_stat_field"  placeholder="Civil Status" name="civil_stat_field" required>
                                            <option></option>
                                            <option>Single</option> 
                                            <option>Married</option>
                                            <option>Widowed</option>
                                            <option>Seperated</option>
                                            <option>Divorced</option>
                                        </select>
                                    </div>
                                    
                                </div>

                                <div class="form-row">

                                    <div class="col-md-6 form-group">
                                        <label for="mobile_no_field" class="add-resident-form-label" >Mobile Number</label>
                                        <input type="text" class="form-control add-resident-form-field" id="mobile_no_field" placeholder="09XXXXXXXXX" name="mobile_no_field" required>
                                    </div>

                                    <div class="col-md-6 form-group">
                                        <label for="email_field" class="add-resident-form-label" >E-Mail Address</label>
                                        <input type="text" class="form-control add-resident-form-field" id="email_field" placeholder="example123@domain.com" name="email_field" required>
                                    </div>

                                </div>

                                <div class="form-row">

                                    <div class="col-md-6 form-group">
                                        <label for="religion_field" class="add-resident-form-label" >Religion</label>
                                        <input type="text" class="form-control add-resident-form-field" placeholder="Religion" id="religion_field" name="religion_field" required>
                                    </div>

                                    <div class="col-md-6 form-group">
                                        <label for="voter_stat_field" class="add-resident-form-label" >Voter Status</label>
                                        <select class="form-control add-resident-form-field" id="voter_stat_field" placeholder="Voter Status" name="voter_stat_field" required>
                                            
                                            <option></option>
                                            <option>Registered</option>
                                            <option>Unregistered</option>
                                        
                                        </select>
                                    </div>
                                    

                                </div>

                                <div class="row"  id="username_check" >
                                    
                                    
                                </div>

                                <div class="form-row">
                                    <div class="col-md-6 form-group ">
                                        <label for="username_field" class="add-resident-form-label" >Username</label>
                                        <input type="text" class="form-control add-resident-form-field" placeholder="Username" id="username_field" name="username_field" required>
                                    </div>

                                    <div class="col-md-6 form-group">
                                        <label for="password_field" class="add-resident-form-label" >Password</label>
                                        <input type="text" class="form-control add-resident-form-field" placeholder="Password" id="password_field" name="password_field" required>
                                    </div>
                                </div>

                                <div class="row justify-content-center">

                                    <div class="col text-right mt-2 mb-2">
                                        <button type="submit" class="btn btn-danger add-resident-btn" id="btn_add_resident" name="btn_add_resident">Add Resident</button>                                   
                                    </div>
                                    <div class="col text-left mt-2 mb-2">
                                        <button type="button" class="btn btn-danger add-resident-btn" data-dismiss="modal">Cancel</button>                            
                                    </div>
                                    
                                </div>
                                
                            </form>
                        </div>

                        
                            
                    </div>
                </div>
            </div>

            <!-- Markup for Edit Resident Modal -->
            <div class="modal fade" id="edit-resident-modal" tabindex="-1" role="dialog" aria-labelledby="edit-resident-modal" aria-hidden="true">
               
                <div class="modal-dialog modal-lg" role="document">

                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title edit-resident-heading" id="edit-resident-heading">Edit Resident</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>

                        <div class="modal-body">
                            <form action="admin_Actions.php" method="post">

                                <div class="form-row justify-content-center text-center">

                                    <div class="col-md-6 form-group">
                                        <label for="edit_resident_id_field" class="add-resident-form-label" >Resident ID</label>
                                        <input readonly style="text-align: center;" type="text" class="form-control add-resident-form-field" placeholder="ID" id="edit_resident_id_field" name="edit_resident_id_field" required>
                                    </div>
                                    
                                </div>

                                <div class="form-row">

                                    <div class="col-md-6 form-group ">
                                        <label for="edit_first_name_field" class="add-resident-form-label" >First Name</label>
                                        <input type="text" class="form-control add-resident-form-field" placeholder="Given Name" id="edit_first_name_field" name="edit_first_name_field" required>
                                    </div>

                                    <div class="col-md-6 form-group">
                                        <label for="edit_middle_name_field" class="add-resident-form-label" >Middle Name</label>
                                        <input type="text" class="form-control add-resident-form-field" placeholder="Given Name" id="edit_middle_name_field" name="edit_middle_name_field" required>
                                    </div>
                                       
                                </div>

                                <div class="form-row">

                                    <div class="col-md-6 form-group">
                                        <label for="edit_last_name_field" class="add-resident-form-label" >Last Name</label>
                                        <input type="text" class="form-control add-resident-form-field" placeholder="Given Name" id="edit_last_name_field" name="edit_last_name_field" required>
                                    </div>

                                    <div class="col-md-3 form-group">
                                        <label for="edit_suffix_field" class="add-resident-form-label" >Suffix</label>
                                        <input type="text" class="form-control add-resident-form-field" placeholder="(e.g. Jr.)" id="edit_suffix_field" name="edit_suffix_field" >
                                    </div>

                                    <div class="col-md-3 form-group">
                                        <label for="edit_birthday_field" class="add-resident-form-label" >Date of Birth</label>
                                        <input type="date" class="form-control add-resident-form-field" id="edit_birthday_field" name="edit_birthday_field" required>
                                        
                                    </div>
                                    
                                </div>

                                <div class="form-row">

                                    <div class="col-md-4 form-group">
                                        <label for="edit_alias_field" class="add-resident-form-label" >Alias/Nickname</label>
                                        <input type="text" class="form-control add-resident-form-field" placeholder="Given Name" id="edit_alias_field" name="edit_alias_field" required>
                                    </div>

                                    <div class="col-md-4 form-group">
                                        <label for="edit_sex_field" class="add-resident-form-label" >Sex</label>
                                        <select class="form-control add-resident-form-field" id="edit_sex_field" placeholder="Sex" name="edit_sex_field" required>
                                            <option></option>
                                            <option>Male</option>
                                            <option>Female</option>
                                        </select>
                                    
                                    </div>

                                    <div class="col-md-4 form-group">
                                        <label for="edit_civil_stat_field" class="add-resident-form-label" >Civil Status</label>
                                        <select class="form-control add-resident-form-field" id="edit_civil_stat_field"  placeholder="Civil Status" name="edit_civil_stat_field" value="<?php print($rowUser['civil_stat']) ?>" required>
                                            <option></option>
                                            <option>Single</option> 
                                            <option>Married</option>
                                            <option>Widowed</option>
                                            <option>Seperated</option>
                                            <option>Divorced</option>
                                        </select>
                                    </div>
                                    
                                </div>

                                <div class="form-row">

                                    <div class="col-md-6 form-group">
                                        <label for="edit_mobile_no_field" class="add-resident-form-label" >Mobile Number</label>
                                        <input type="text" class="form-control add-resident-form-field" id="edit_mobile_no_field" placeholder="09XXXXXXXXX" name="edit_mobile_no_field" required>
                                    </div>

                                    <div class="col-md-6 form-group">
                                        <label for="edit_email_field" class="add-resident-form-label" >E-Mail Address</label>
                                        <input type="text" class="form-control add-resident-form-field" id="edit_email_field" placeholder="example123@domain.com" name="edit_email_field" required>
                                    </div>

                                </div>

                                <div class="form-row">
                                    <div class="col-md-6 form-group">
                                        <label for="edit_religion_field" class="add-resident-form-label" >Religion</label>
                                        <input type="text" class="form-control add-resident-form-field" placeholder="Religion" id="edit_religion_field" name="edit_religion_field" required>
                                    </div>

                                    <div class="col-md-6 form-group">
                                        <label for="edit_voter_stat_field" class="add-resident-form-label" >Voter Status</label>
                                        <select class="form-control add-resident-form-field" id="edit_voter_stat_field" placeholder="Voter Status" name="edit_voter_stat_field" required>
                                            
                                            <option></option>
                                            <option>Registered</option>
                                            <option>Unregistered</option>
                                        
                                        </select>
                                    </div>
                                </div>

                                <div class="form-row">
                                    <div class="col-md-6 form-group ">
                                        <label for="edit_username_field" class="add-resident-form-label" >Username</label>
                                        <input type="text" class="form-control add-resident-form-field" placeholder="Username" id="edit_username_field" name="edit_username_field" required>
                                    </div>

                                    <div class="col-md-6 form-group">
                                        <label for="edit_password_field" class="add-resident-form-label" >Password</label>
                                        <input type="text" class="form-control add-resident-form-field" placeholder="Password" id="edit_password_field" name="edit_password_field" required>
                                    </div>
                                </div>

                                <div class="row justify-content-center">

                                    <div class="col text-right mt-2 mb-2">
                                        <button type="submit" class="btn btn-danger edit-resident-btn" id="btn_edit_resident" name="btn_edit_resident">Edit Resident</button>                                   
                                    </div>
                                    <div class="col text-left mt-2 mb-2">
                                        <button type="button" class="btn btn-danger edit-resident-btn" data-dismiss="modal">Cancel</button>                            
                                    </div>
                                    
                                </div>
                                
                            </form>
                        </div>

                        
                            
                    </div>
                </div>
            </div>

            <!-- Markup for Delete Resident Modal -->
            <div class="modal fade" id="delete-resident-modal" tabindex="-1" role="dialog" aria-labelledby="delete-resident-modal" aria-hidden="true">
               
                <div class="modal-dialog modal-md" role="document">

                    <div class="modal-content">

                        <div class="modal-header pb-2 mb-3">
                            <h5 class="modal-title delete-resident-heading" id="delete-resident-heading">Delete Resident</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>

                        <div class="modal-body">

                            <form action="admin_Actions.php" method="post">

                                <div class="form-row justify-content-center text-center pt-2 mt-5">

                                    <div class="col-md-6 form-group">
                                        <label for="delete_resident_id_field" class="delete-resident-form-label" >Resident ID</label>
                                        <input readonly style="text-align: center;" type="text" class="form-control delete-resident-form-field" placeholder="ID" id="delete_resident_id_field" name="delete_resident_id_field" required>
                                    </div>
                                    
                                </div>

                                <div class="row">
                                    <div class="col-md-12 justify-content-center"> 
                                        <p class="delete-resident-name-field"></p>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12 justify-content-center"> 
                                        <p class="delete-resident-prompt">Are you sure you want to delete this resident?</p>
                                    </div>
                                </div>

                            
                        </div>

                        <div class="modal-footer">
                                 <div class="row justify-content-around">

                                    <div class="col text-right mt-2 mb-2">
                                        <button type="submit" class="btn btn-danger delete-resident-btn" id="btn_delete_resident" name="btn_delete_resident">Delete</button>                                   
                                    </div>
                                    <div class="col text-left mt-2 mb-2">
                                        <button type="button" class="btn btn-danger delete-resident-btn" data-dismiss="modal">Cancel</button>                            
                                    </div>
                                    
                                </div>
                                
                            </form>
                        </div>

                        
                            
                    </div>
                </div>
            </div>


        </div>   

        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
        <script src="https://code.jquery.com/jquery-3.5.1.js" integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc=" crossorigin="anonymous"></script>
        <script type="text/javascript" src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"> </script>
    
        <script>

            // Clear Add Modal Form when Closing
            function clear_modal()
            {
                $('#add-resident-modal').on('hidden.bs.modal', function (e) {
                $(this)
                    .find("input,textarea,select")
                    .val('')
                    .end()
                    .find("input[type=checkbox], input[type=radio]")
                    .prop("checked", "")
                    .end();
                })
            }
            
            //Pass Data from anchored edit resident button to edit resident modal form
            function load_resident_to_edit_modal()
            {
                $('#edit-resident-modal').on('show.bs.modal', function (e) {

                    var resident_id = $(e.relatedTarget).data('resident_id');
                    
                    
                    $.ajax({
                        type : 'post',
                        url : 'admin_Actions.php',
                        data : {edit_load_resident_info:resident_id},
                        dataType: 'json',
                        success : function(data)
                        {

                            var len = data.length;

                            for(var i = 0; i<len; i++)
                                {
                                    var first_name = data[0]['first_name'];
                                    var middle_name = data[0]['middle_name'];
                                    var last_name = data[0]['last_name'];
                                    var suffix = data[0]['suffix'];
                                    var birthday = data[0]['birthday'];
                                    var alias = data[0]['alias'];
                                    var sex = data[0]['sex'];
                                    var civil_stat = data[0]['civil_stat'];
                                    var mobile_no = data[0]['mobile_no'];
                                    var email = data[0]['email'];
                                    var religion = data[0]['religion'];
                                    var voter_stat = data[0]['voter_stat'];
                                    var username = data[0]['username'];
                                    var password = data[0]['password'];
                                    

                                    document.getElementById('edit_resident_id_field').value= resident_id;
                                    document.getElementById('edit_first_name_field').value= first_name;
                                    document.getElementById('edit_middle_name_field').value= middle_name;
                                    document.getElementById('edit_last_name_field').value= last_name;
                                    document.getElementById('edit_suffix_field').value= suffix;
                                    document.getElementById('edit_birthday_field').value= birthday;
                                    document.getElementById('edit_alias_field').value= alias;
                                    document.getElementById('edit_sex_field').value= sex;
                                    document.getElementById('edit_civil_stat_field').value= civil_stat;
                                    document.getElementById('edit_mobile_no_field').value= mobile_no;
                                    document.getElementById('edit_email_field').value= email;
                                    document.getElementById('edit_religion_field').value= religion;
                                    document.getElementById('edit_voter_stat_field').value= voter_stat;
                                    document.getElementById('edit_username_field').value= username;
                                    document.getElementById('edit_password_field').value= password;

                                    // console.log(birthday);

                                    // console.log(name);
                                    // console.log(username);
                                    // console.log(password);
                                }  
                        },

                        error:function(data)
                        {
                            errormsg = JSON.stringify(data);
                            alert(errormsg);
                        }


                    });
                });
            }
            
            //Pass Data from anchored delete resident button to delete resident modal form       
            function load_resident_to_delete_modal()
            {
                $('#delete-resident-modal').on('show.bs.modal', function (e) {

                    var resident_id = $(e.relatedTarget).data('resident_id');
                    
                    $.ajax({
                        type : 'post',
                        url : 'admin_Actions.php',
                        data : {delete_load_resident_info:resident_id},
                        dataType: 'json',
                        success : function(data)
                        {

                            var len = data.length;

                            for(var i = 0; i<len; i++)
                                {
                                    var first_name = data[0]['first_name'];
                                    var middle_name = data[0]['middle_name'];
                                    var last_name = data[0]['last_name'];
                                        
                                    $('.delete-resident-name-field').text(first_name + ' ' + middle_name + ' ' + last_name);
                                    document.getElementById('delete_resident_id_field').value= resident_id;

                                    // console.log(birthday);

                                    // console.log(name);
                                    // console.log(username);
                                    // console.log(password);
                                }  
                        },

                        error:function(data)
                        {
                            errormsg = JSON.stringify(data);
                            alert(errormsg);
                        }


                    });
                });
            }

            //Search Records of Existing Residents
            function search_residents()
            {
                $('#search_field').keyup(function()
                {
                    var search=jQuery('#search_field').val();

                    jQuery.ajax({
                        method:'post',
                        url:'admin_Actions.php',
                        data:'search='+search,
                        success:function(data)
                        {
                            jQuery('#residents_table').html(data);
                            // console.log(data);
                        }
                    });	
                });
            }

            //Check if Username Already Exists and Disable Button if it exists already ( Add and Edit Modal)
            function check_username()
            {
               $("#username_field").keyup(function(){

                    var username = $(this).val().trim();

                    if(username != '')
                    {
                        $.ajax({
                            url: 'admin_Actions.php',
                            type: 'post',
                            data: {username_verify: username},
                            success: function(response)
                            {                               
                                $("#username_check").html(response);
                            }
                        });

                        $.ajax({
                            url: 'admin_Actions.php',
                            type: 'post',
                            data: {username_verify_button: username},
                            success: function(response)
                            {                               
                                if(response == 0)
                                {
                                    document.getElementById("btn_add_resident").disabled = false;
                                }

                                if(response == 1)
                                {
                                    document.getElementById("btn_add_resident").disabled = true;
                                }
                            }
                        });
                    }

                });
            }

            $(document).ready(function(){

                clear_modal();
                load_resident_to_edit_modal();
                load_resident_to_delete_modal();
                search_residents();
                check_username();

            });


        </script>
    </body>
    
</html>