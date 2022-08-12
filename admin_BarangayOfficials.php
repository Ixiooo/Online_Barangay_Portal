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
        <link rel="stylesheet" href="stylesheets/admin_BarangayOfficials.css" >

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

                            <li class="nav-item pl-3 pr-3 ">
                                <a class="nav-link" href="admin_Residents.php">Residents</a>
                            </li>
                            <li class="nav-item pl-3 pr-3">
                                <a class="nav-link" href="admin_Documents.php">Documents</a>
                            </li>
                            <li class="nav-item pl-3 pr-3 active">
                                <a class="nav-link" href="admin_BarangayOfficials.php">Barangay Officials</a>
                            </li>
                            <li class="nav-item pl-3 pr-3">
                                <a class="nav-link" href="admin_Announcements.php">Announcements</a>
                            </li>
                            
                        </ul>
                    </div>

                    <a href="admin_BarangayOfficials.php?logout=true">
                        <button style="font-family: 'Montserrat', sans-serif !important;" class="btn btn-outline-danger logout-btn  mr-md-5" type="button"  id="logout-btn">Logout</button>
                    </a>
                </nav>
            </div>

            <div class="container-fluid ">
                
                <div class="row justify-content-around pb-4 mb-2 add-container">

                    <div class="col-md-10 text-right mt-2 mb-2">
                        <button class="btn btn-danger add-btn" type="button" data-toggle="modal" data-target="#add-official-modal">
                            + Add Barangay Official
                        </button>
                    </div>

                </div>

            
                
                <div>
                    <?php

                        // PHP Code for Notification Alert

                        if(isset($_GET['officialAdded']))
                        {
                            echo 
                            '<div style="text-align:center" class = "alert alert-success alert-dismissible fade show" role="alert">
                                Barangay Official Added Successfully.
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>                               
                            </div>';
                        };

                        if(isset($_GET['officialUpdated']))
                        {
                            echo 
                            '<div style="text-align:center" class = "alert alert-success alert-dismissible fade show" role="alert">
                                Barangay Official Edited Successfully
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>                               
                            </div>';
                        };

                        if(isset($_GET['officialDeleted']))
                        {
                            echo 
                            '<div style="text-align:center" class = "alert alert-success alert-dismissible fade show" role="alert">
                                Barangay Official Deleted Successfully
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>                               
                            </div>';
                        };

                        if(isset($_GET['officialUsernameTaken']))
                        {
                            echo 
                            '<div style="text-align:center" class = "alert alert-danger alert-dismissible fade show" role="alert">
                                Barangay Official Edit Failed. Username is Already Taken, Please Choose Another Username
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>                               
                            </div>';
                        };

                    ?>
                </div>

                <div class="row justify-content-center">

                    <div class="col-md-10">

                        <div class="officials-table-container">
                            <div class="table-responsive w-auto text-nowrap officials-table-div">

                                <table class="table table-borderless table-hover officials-table " >
                                    <thead>

                                        <th class="officials-table-heading"></th>
                                        <th class="officials-table-heading"></th>
                                        <th class="officials-table-heading">Barangay Official ID</th>
                                        <th class="officials-table-heading">Barangay Official Position</th>
                                        <th class="officials-table-heading">Barangay Official Name</th>
                                        <th class="officials-table-heading">Sex</th>
                                        <th class="officials-table-heading">Contact Number</th>
                                        <th class="officials-table-heading">Username</th>
                                        <th class="officials-table-heading">Password</th>
                                    
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

                                            <td>
                                                <a class="table-btn-anchor" href="#delete-official-modal" data-toggle="modal" data-official_id="<?php print($rowUser['official_id']) ?>" >
                                                    <button type="button" class="btn btn-danger officials-table-btn">
                                                        <span> <i class="fas fa-trash-alt"></i></span>
                                                    </button>
                                                </a>
                                            </td> 

                                            <td>
                                                <a class="table-btn-anchor" href="#edit-official-modal" data-toggle="modal" data-official_id="<?php print($rowUser['official_id']) ?>" >
                                                    <button type="button" class="btn btn-danger  officials-table-btn">
                                                        <span> <i class="fas fa-edit"></i></span>
                                                    </button>
                                                </a>
                                            </td>

                                            <td><?php print($rowUser['official_id']) ?></td>

                                            <td><?php print($rowUser['official_position']) ?></td>

                                            <td><?php print($rowUser['official_first_name'] . " " . $rowUser['official_middle_name']. " " . $rowUser['official_last_name']) ?></td>

                                            <td><?php print($rowUser['official_sex']) ?></td>

                                            <td><?php print($rowUser['official_contact_info']) ?></td>

                                            <td><?php print($rowUser['official_username']) ?></td>

                                            <td><?php print($rowUser['official_password']) ?></td>

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





                <!-- Markup for Modal Dialogs -->

                <!-- Markup for Add Official Modal -->
                <div class="modal fade" id="add-official-modal" tabindex="-1" role="dialog" aria-labelledby="add-official-modal" aria-hidden="true">
                
                    <div class="modal-dialog modal-lg" role="document">

                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title add-official-heading" id="add-official-heading">Add Barangay Official</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>

                            <div class="modal-body">
                                <form action="admin_Actions.php" method="post">

                                    <div class="form-row">

                                        <div class="col-md-6 form-group ">
                                            <label for="first_name_field" class="add-official-form-label" >First Name</label>
                                            <input type="text" class="form-control add-official-form-field" placeholder="Given Name" id="first_name_field" name="first_name_field" required>
                                        </div>

                                        <div class="col-md-6 form-group">
                                            <label for="middle_name_field" class="add-official-form-label" >Middle Name</label>
                                            <input type="text" class="form-control add-official-form-field" placeholder="Given Name" id="middle_name_field" name="middle_name_field" required>
                                        </div>
                                            
                                    </div>

                                    <div class="form-row">

                                        <div class="col-md-6 form-group">
                                            <label for="last_name_field" class="add-official-form-label" >Last Name</label>
                                            <input type="text" class="form-control add-official-form-field" placeholder="Given Name" id="last_name_field" name="last_name_field" required>
                                        </div>

                                        <div class="col-md-6 form-group">
                                            <label for="sex_field" class="add-official-form-label" >Sex</label>
                                            <select class="form-control add-official-form-field" id="sex_field" placeholder="Sex" name="sex_field" required>
                                                <option></option>
                                                <option>Male</option>
                                                <option>Female</option>
                                            </select>
                                        </div>

                                        
                                        
                                    </div>

                                    <div class="form-row">

                                        <div class="col-md-6 form-group">
                                            <label for="position_field" class="add-official-form-label" >Position</label>
                                            <select class="form-control add-official-form-field" id="position_field" placeholder="Position" name="position_field" required>
                                                <option></option>
                                                <option>Barangay Chairman/Chairwoman</option>
                                                <option>Kagawad</option>
                                                <option>SK Chairman/Chairwoman</option>
                                                <option>Secretary</option>
                                                <option>Treasurer</option>
                                            </select>
                                        </div>

                                        <div class="col-md-6 form-group">
                                            <label for="mobile_no_field" class="add-official-form-label" >Mobile Number</label>
                                            <input type="text" class="form-control add-official-form-field" id="mobile_no_field" placeholder="09XXXXXXXXX" name="mobile_no_field" required>
                                        </div>

                                    </div>

                                    <div class="row"  id="username_check" >
                                    
                                    
                                    </div>

                                    <div class="form-row">
                                        <div class="col-md-6 form-group ">
                                            <label for="username_field" class="add-official-form-label" >Username</label>
                                            <input type="text" class="form-control add-official-form-field" placeholder="Username" id="username_field" name="username_field" required>
                                        </div>

                                        <div class="col-md-6 form-group">
                                            <label for="password_field" class="add-official-form-label" >Password</label>
                                            <input type="text" class="form-control add-official-form-field" placeholder="Password" id="password_field" name="password_field" required>
                                        </div>
                                    </div>

                                    <div class="row justify-content-center">

                                        <div class="col text-right mt-2 mb-2">
                                            <button type="submit" class="btn btn-danger add-official-btn" id="btn_add_official" name="btn_add_official">Add Barangay Official</button>                                   
                                        </div>
                                        <div class="col text-left mt-2 mb-2">
                                            <button type="button" class="btn btn-danger add-official-btn" data-dismiss="modal">Cancel</button>                            
                                        </div>
                                        
                                    </div>
                                    
                                </form>

                            </div>

                            
                                
                        </div>
                    </div>
                </div>

                <!-- Markup for Edit Official Modal -->
                <div class="modal fade" id="edit-official-modal" tabindex="-1" role="dialog" aria-labelledby="edit-official-modal" aria-hidden="true">
                
                    <div class="modal-dialog modal-lg" role="document">

                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title edit-official-heading" id="edit-official-heading">Edit Barangay Official</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>

                            <div class="modal-body">
                                <form action="admin_Actions.php" method="post">

                                    <div class="form-row justify-content-center text-center">

                                        <div class="col-md-6 form-group">
                                            <label for="edit_official_id_field" class="edit-official-form-label" >Barangay Official ID</label>
                                            <input readonly style="text-align: center;" type="text" class="form-control edit-official-form-field" placeholder="ID" id="edit_official_id_field" name="edit_official_id_field" required>
                                        </div>
                                        
                                    </div>

                                    <div class="form-row">

                                        <div class="col-md-6 form-group ">
                                            <label for="edit_official_first_name_field" class="edit-official-form-label" >First Name</label>
                                            <input type="text" class="form-control edit-official-form-field" placeholder="Given Name" id="edit_official_first_name_field" name="edit_official_first_name_field" required>
                                        </div>

                                        <div class="col-md-6 form-group">
                                            <label for="edit_official_middle_name_field" class="edit-official-form-label" >Middle Name</label>
                                            <input type="text" class="form-control edit-official-form-field" placeholder="Given Name" id="edit_official_middle_name_field" name="edit_official_middle_name_field" required>
                                        </div>
                                            
                                    </div>

                                    <div class="form-row">

                                        <div class="col-md-6 form-group">
                                            <label for="edit_official_last_name_field" class="edit-official-form-label" >Last Name</label>
                                            <input type="text" class="form-control edit-official-form-field" placeholder="Given Name" id="edit_official_last_name_field" name="edit_official_last_name_field" required>
                                        </div>

                                        <div class="col-md-6 form-group">
                                            <label for="edit_official_sex_field" class="edit-official-form-label" >Sex</label>
                                            <select class="form-control edit-official-form-field" id="edit_official_sex_field" placeholder="Sex" name="edit_official_sex_field" required>
                                                <option></option>
                                                <option>Male</option>
                                                <option>Female</option>
                                            </select>
                                        </div>

                                        
                                        
                                    </div>

                                    <div class="form-row">

                                        <div class="col-md-6 form-group">
                                            <label for="edit_official_position_field" class="edit-official-form-label" >Position</label>
                                            <select class="form-control edit-official-form-field" id="edit_official_position_field" placeholder="Position" name="edit_official_position_field" required>
                                                <option></option>
                                                <option>Barangay Chairman/Chairwoman</option>
                                                <option>Kagawad</option>
                                                <option>SK Chairman/Chairwoman</option>
                                                <option>Secretary</option>
                                                <option>Treasurer</option>
                                            </select>
                                        </div>

                                        <div class="col-md-6 form-group">
                                            <label for="edit_official_mobile_no_field" class="edit-official-form-label" >Mobile Number</label>
                                            <input type="text" class="form-control edit-official-form-field" id="edit_official_mobile_no_field" placeholder="09XXXXXXXXX" name="edit_official_mobile_no_field" required>
                                        </div>

                                    </div>

                                    <div class="form-row">
                                        <div class="col-md-6 form-group ">
                                            <label for="edit_official_username_field" class="edit-official-form-label" >Username</label>
                                            <input type="text" class="form-control edit-official-form-field" placeholder="Username" id="edit_official_username_field" name="edit_official_username_field" required>
                                        </div>

                                        <div class="col-md-6 form-group">
                                            <label for="edit_official_password_field" class="edit-official-form-label" >Password</label>
                                            <input type="text" class="form-control edit-official-form-field" placeholder="Password" id="edit_official_password_field" name="edit_official_password_field" required>
                                        </div>
                                    </div>

                                    <div class="row justify-content-center">

                                        <div class="col text-right mt-2 mb-2">
                                            <button type="submit" class="btn btn-danger edit-official-btn" id="btn_edit_official" name="btn_edit_official">Edit Barangay Official</button>                                   
                                        </div>
                                        <div class="col text-left mt-2 mb-2">
                                            <button type="button" class="btn btn-danger edit-official-btn" data-dismiss="modal">Cancel</button>                            
                                        </div>
                                        
                                    </div>
                                    
                                </form>

                            </div>

                            
                                
                        </div>
                    </div>
                </div>

                <!-- Markup for Delete Resident Modal -->
                <div class="modal fade" id="delete-official-modal" tabindex="-1" role="dialog" aria-labelledby="delete-official-modal" aria-hidden="true">
                
                    <div class="modal-dialog modal-md" role="document">

                        <div class="modal-content">

                            <div class="modal-header pb-2 mb-3">
                                <h5 class="modal-title delete-official-heading" id="delete-official-heading">Delete Resident</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>

                            <div class="modal-body">

                                <form action="admin_Actions.php" method="post">

                                    <div class="form-row justify-content-center text-center pt-2 mt-5">

                                        <div class="col-md-6 form-group">
                                            <label for="delete_official_id_field" class="delete-official-form-label" >Barangay Official ID</label>
                                            <input readonly style="text-align: center;" type="text" class="form-control delete-resident-form-field" placeholder="ID" id="delete_official_id_field" name="delete_official_id_field" required>
                                        </div>
                                        
                                    </div>

                                    <div class="row">
                                        <div class="col-md-12 justify-content-center"> 
                                            <p class="delete-official-name-field"></p>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-12 justify-content-center"> 
                                            <p class="delete-official-prompt">Are you sure you want to delete this Barangay Official?</p>
                                        </div>
                                    </div>

                                
                            </div>

                            <div class="modal-footer">
                                        <div class="row justify-content-around">

                                        <div class="col text-right mt-2 mb-2">
                                            <button type="submit" class="btn btn-danger delete-official-btn" id="btn_delete_official" name="btn_delete_official">Delete</button>                                   
                                        </div>
                                        <div class="col text-left mt-2 mb-2">
                                            <button type="button" class="btn btn-danger delete-official-btn" data-dismiss="modal">Cancel</button>                            
                                        </div>
                                        
                                    </div>
                                    
                                </form>
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
            
            //Pass Data from anchored edit official button to edit official modal form
            function load_official_to_edit_modal()
            {
                $('#edit-official-modal').on('show.bs.modal', function (e) {

                    var official_id = $(e.relatedTarget).data('official_id');
                    
                    
                    $.ajax({
                        type : 'post',
                        url : 'admin_Actions.php',
                        data : {edit_load_official_info:official_id},
                        dataType: 'json',
                        success : function(data)
                        {

                            var len = data.length;

                            for(var i = 0; i<len; i++)
                                {

                                    var position = data[0]['official_position'];
                                    var first_name = data[0]['official_first_name'];
                                    var middle_name = data[0]['official_middle_name'];
                                    var last_name = data[0]['official_last_name'];
                                    var sex = data[0]['official_sex'];
                                    var contact_info = data[0]['official_contact_info'];
                                    var username = data[0]['official_username'];
                                    var password = data[0]['official_password'];
                                    

                                    document.getElementById('edit_official_id_field').value= official_id;

                                    document.getElementById('edit_official_first_name_field').value= first_name;
                                    document.getElementById('edit_official_middle_name_field').value= middle_name;
                                    document.getElementById('edit_official_last_name_field').value= last_name;
                                    document.getElementById('edit_official_sex_field').value= sex;
                                    document.getElementById('edit_official_mobile_no_field').value= contact_info;
                                    document.getElementById('edit_official_username_field').value= username;
                                    document.getElementById('edit_official_password_field').value= password;
                                    document.getElementById('edit_official_position_field').value= position;

                                    // console.log(official_id);

                                    // console.log(position);
                                    // console.log(first_name);
                                    // console.log(middle_name);
                                    // console.log(last_name);
                                    // console.log(sex);
                                    // console.log(contact_info);
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
            //Pass Data from anchored delete official button to delete official modal form       
            function load_official_to_delete_modal()
            {
                $('#delete-official-modal').on('show.bs.modal', function (e) {

                    var official_id = $(e.relatedTarget).data('official_id');
                    
                    $.ajax({
                        type : 'post',
                        url : 'admin_Actions.php',
                        data : {delete_load_official_info:official_id},
                        dataType: 'json',
                        success : function(data)
                        {

                            var len = data.length;

                            for(var i = 0; i<len; i++)
                                {
                                    var first_name = data[0]['official_first_name'];
                                    var middle_name = data[0]['official_middle_name'];
                                    var last_name = data[0]['official_last_name'];
                                        
                                    $('.delete-official-name-field').text(first_name + ' ' + middle_name + ' ' + last_name);
                                    document.getElementById('delete_official_id_field').value= official_id;

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
                            data: {username_verify_official: username},
                            success: function(response)
                            {                               
                                    $("#username_check").html(response);
                            }
                        });

                        $.ajax({
                            url: 'admin_Actions.php',
                            type: 'post',
                            data: {username_verify_official_button: username},
                            success: function(response)
                            {                               
                                if(response == 0)
                                {
                                    document.getElementById("btn_add_official").disabled = false;
                                }

                                if(response == 1)
                                {
                                    document.getElementById("btn_add_official").disabled = true;
                                }
                            }
                        });
                    }

                });
            }

            $(document).ready(function(){

                load_official_to_edit_modal();
                load_official_to_delete_modal();
                check_username();
            });





        </script>
    </body>
    
</html>