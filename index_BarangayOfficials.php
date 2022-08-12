<?php

require_once ('dbConfig.php');
require_once ('functions.php');

$userObj = new User();
$database = new Database();
$db = $database->dbConnection();

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
        <link rel="stylesheet" href="stylesheets/index_BarangayOfficials.css" >

    </head>

    <body>
        <div>

            <!--Navbar Markup  -->
            <div>
                <nav class="navbar navbar-expand-lg mb-5">

                    <button class="navbar-toggler navbar-light" type="button" data-toggle="collapse" data-target="#navbar1">
                        <span class="navbar-toggler-icon"></span>
                    </button>

                    <img src="img/Logo.png" alt="logo" id="nav-img" class="ml-md-5">

                    <div class="navbar-collapse collapse  justify-content-center" id="navbar1">
                        <ul class="navbar-nav">

                            <li class="nav-item pl-3 pr-3 ">
                                <a class="nav-link" href="index.php">Home</a>
                            </li>
                            <li class="nav-item pl-3 pr-3 active">
                                <a class="nav-link" href="index_BarangayOfficials.php">Barangay Officials</a>
                            </li>                       
                        </ul>
                    </div>

                    <button class="btn btn-outline-danger login-btn mr-md-5" type="button" id="login-btn" data-toggle="modal" data-target="#login-modal"> Login </button>


                </nav>
            </div>

            <div class="container-fluid ">
                
                <div > 
                    <!-- Table Markuo -->
                    <div>
                        
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

                

            <!-- Markup for Login Modal -->
            <div class="modal fade" id="login-modal" tabindex="-1" role="dialog" aria-labelledby="login-modal" aria-hidden="true">
                <div class="modal-dialog modal-md" role="document">

                    <div class="modal-content">

                        <div class="modal-header">
                            <h1 class="modal-title login-modal-heading" id="login-modal-heading">Login</h1>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>

                        <div class="modal-body">
                            <div class="form-container">
                                <form>

                                    <div class="form-row">
                                        <div class="col-md-12 form-group ">
                                            <div class="input-group mb-2">
                                                <div class="input-group-append">
                                                    <span class="input-group-text"><i class="fas fa-user"> </i> </span>
                                                </div>
                                                <input type="text" name="username_field" id="username_field" class="form-control login-modal-field" placeholder="Enter Username" required>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-row">
                                        <div class="col-md-12 form-group ">
                                            <div class="input-group mb-3">
                                                <div class="input-group-append">
                                                    <span class="input-group-text"><i class="fas fa-key"> </i> </span>
                                                </div>
                                                <input type="password" name="password_field" id="password_field" class="form-control login-modal-field" placeholder="Enter Password" required>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row justify-content-center">
                                        <div class="col form-group text-right  pr-2 mr-2">
                                            <button type="submit" class="btn login-modal-btn" id="btn_login" name="btn_login">Sign in</button>                                   
                                        </div>
                                        <div class="col form-group text-left pl-2 ml-2">
                                            <button type="button" data-dismiss="modal" class="btn login-modal-btn" id="btn_cancel" name="btn_cancel">Cancel</button>                                   
                                        </div>
                                    </div>
                                    
                                    
                                </form>
                            </div>
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

        </div>   

        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
        <script src="https://code.jquery.com/jquery-3.5.1.js" integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc=" crossorigin="anonymous"></script>
        <script type="text/javascript" src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"> </script>
    
        <script>

        // Clear Modal Form when Closing
        function clear_modal()
        {
            $('#login-modal').on('hidden.bs.modal', function (e) {
            $(this)
                .find("input,textarea,select")
                .val('')
                .end()
                .find("input[type=checkbox], input[type=radio]")
                .prop("checked", "")
                .end();
            })
        }

        //Login Button Function
        function login()
        {
            $('#btn_login').click(function(e){

                var valid = this.form.checkValidity();
                
                if(valid)
                {

                    var username = $('#username_field').val();
                    var password = $('#password_field').val();

                    e.preventDefault();

                    $.ajax({
                        type: 'POST',
                        url: 'admin_Actions.php',
                        data: {current_username: username, current_password: password},
                        success: function(data){
                            
                            if($.trim(data) ==="0")
                            {
                                Swal.fire
                                ({
                                    title: 'Login Success',
                                    text: 'Official Login',
                                    icon: 'success'
                                })

                                setTimeout('window.location.href = "admin_Home.php"',2000);

                            }

                            else if($.trim(data) ==="1")
                            {
                                Swal.fire
                                ({
                                    title: 'Login Success',
                                    text: 'Resident Login',
                                    icon: 'success'
                                })

                                setTimeout('window.location.href = "user_Home.php"',2000);

                            }

                            else
                            {
                                Swal.fire
                                ({
                                    title: 'Failed',
                                    text: data,
                                    icon: 'error'
                                })
                            }
                        },

                        error: function(data){
                            Swal.fire
                                ({
                                title: 'Failed',
                                text: 'Login Failed',
                                icon: 'error'
                                })
                        }

                    });
                };

                $('#login-modal')
                .find("input,textarea,select")
                .val('')
                .end()
                .find("input[type=checkbox], input[type=radio]")
                .prop("checked", "")
                .end();

            });

        }

        $(document).ready(function(){
            clear_modal();
            login();
        });

    </script>
    </body>
    
</html>