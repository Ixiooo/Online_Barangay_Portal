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
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Montseratt Font -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,400;0,500;0,800;1,500&display=swap" rel="stylesheet">
    
    <!-- Local CSS -->
    <link rel="stylesheet" href="stylesheets/home.css">

    <!-- Bootstrap -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css">

    <!-- Link for Bootstrap Icons -->
    <script src="https://kit.fontawesome.com/4aee20adf0.js" crossorigin="anonymous"></script>

    <script type="text/javascript">
(function(d, eId) {
	var js, gjs = d.getElementById(eId);
	js = d.createElement('script'); js.id = 'gwt-pst-jsdk';
	js.src = "//gwhs.i.gov.ph/pst/gwtpst.js?"+new Date().getTime();
	gjs.parentNode.insertBefore(js, gjs);
}(document, 'pst-container'));

var gwtpstReady = function(){
	new gwtpstTime('pst-time');
}
</script>

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

                    <li class="nav-item pl-3 pr-3 ">
                        <a class="nav-link" href="index.php">Home</a>
                    </li>

                    <li class="nav-item pl-3 pr-3 ">
                        <a class="nav-link" href="index_BarangayOfficials.php">Barangay Officials</a>
                    </li>
                    
                </ul>
            </div>

            <button class="btn btn-outline-danger login-btn mr-md-5" type="button" id="login-btn" data-toggle="modal" data-target="#login-modal"> Login </button>

        </nav>
    </div>
    <br><br>

    <div class="container-fluid"> 

    <div id="pst-container">
<div>Philippine Standard Time:</div>
<div id="pst-time"></div>
<div><a href="https://gwhs.i.gov.ph/pst/" id="pst-source" target="_blank">PST Source</a></div>
</div>


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

        <!-- Footer -->
        <div class="row m-0 p-0">
            <div class="col-12 text-center text-muted">
                <p class="m-0 pb-3 mt-md-2 mt-sm-2">Brgy. San Antonio, Copyright ©️ 2020 </p>
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

    </div>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.js" integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
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