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

        <title> Announcements </title>

        <!-- Montseratt Font -->
        <link rel="preconnect" href="https://fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,400;0,500;0,800;1,500&display=swap" rel="stylesheet">
    


        <!-- Link for Bootstrap CSS -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        
        <!-- Link for Bootstrap Fontawesome Icons -->
        <script src="https://kit.fontawesome.com/4aee20adf0.js" crossorigin="anonymous"></script>
        
        <!-- Link for Local bootstrap Datetimepicker CSS -->
        <link rel="stylesheet" href="css/bootstrap-datetimepicker.min.css">

        <!-- Link for Local CSS -->
        <link rel="stylesheet" href="stylesheets/admin_Announcements.css" >

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
                            <li class="nav-item pl-3 pr-3">
                                <a class="nav-link" href="admin_BarangayOfficials.php">Barangay Officials</a>
                            </li>
                            <li class="nav-item pl-3 pr-3 active">
                                <a class="nav-link" href="admin_Announcements.php">Announcements</a>
                            </li>
                            
                        </ul>
                    </div>

                    <a href="admin_Announcements.php?logout=true">
                    <button style="font-family: 'Montserrat', sans-serif !important;" class="btn btn-outline-danger logout-btn  mr-md-5" type="button"  id="logout-btn">Logout</button>
                    </a>
                </nav>
            </div>

            <div class="container-fluid">
                <div class="page-container">

                    <!-- Search Bar and Create Post Markup -->
                    <div class="row justify-content-around pb-4 mb-2 add-container">

                        <div class="col-md-4 mt-2 mb-2 ">
                            <div class="input-group">
                                <input type="text" class="form-control" placeholder="Search Posts" id="search_post_field" name="search_field">
                                <div class="input-group-append">
                                <button class="btn btn-danger search-btn" type="button">
                                    <i class="fa fa-search"></i>
                                </button>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4 text-right mt-2 mb-2">
                            <button class="btn btn-danger create-btn" type="button" data-toggle="modal" data-target="#create-post-modal">
                                + Create New Post
                            </button>
                        </div>
                    </div>

                    <!-- PHP Code for Notifications -->
                    <div>        
                        <?php
                            // PHP Code for Notification Alert

                            if(isset($_GET['postCreated']))
                            {
                                echo 
                                '<div style="text-align:center" class = "alert alert-success alert-dismissible fade show" role="alert">
                                    Announcement Posted Successfully.
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>                               
                                </div>';
                            };

                            if(isset($_GET['postUpdated']))
                            {
                                echo 
                                '<div style="text-align:center" class = "alert alert-success alert-dismissible fade show" role="alert">
                                    Announcement Edited Successfully
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>                               
                                </div>';
                            };

                            if(isset($_GET['postDeleted']))
                            {
                                echo 
                                '<div style="text-align:center" class = "alert alert-success alert-dismissible fade show" role="alert">
                                    Announcement Deleted Successfully
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>                               
                                </div>';
                            };

                        ?>
                    </div>

                    <!-- Posts Table Markup -->
                    <div class="row justify-content-center">

                        <div class="col-md-10">

                            <div class="posts-container" id="card_container">

                                <?php
                                    $qry = "SELECT * FROM announcement_post ORDER BY post_id DESC";
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
                                                <?php print($rowUser['post_title']) ?>
                                            </div>

                                            <div class="col text-right">

                                                <a class="post-btn-anchor" href="#edit-post-modal" data-toggle="modal" data-post_id="<?php print($rowUser['post_id']) ?>" >
                                                    <button type="button" class="btn btn-danger  post-card-btn">
                                                        <span> <i class="fas fa-edit"></i></span>
                                                    </button>
                                                </a>

                                                <a class="post-btn-anchor" href="#delete-post-modal" data-toggle="modal" data-post_id="<?php print($rowUser['post_id']) ?>" >
                                                    <button type="button" class="btn btn-danger  post-card-btn">
                                                        <span> <i class="fas fa-trash-alt"></i></span>
                                                    </button>
                                                </a>
                                            </div>

                                        </div>
                                    </div>

                                    <div class="card-body">
                                        <h6 class="card-title post-title">Post written on <?php print($rowUser['post_date_time']) ?></h5>
                                        <p class="card-text post-body"><?php print($rowUser['post_body']) ?></p>
                                    </div>
                                </div>


                                <?php
                                            } };
                                    ?>
                            </div>

                            <div class="row">

                            </div>

                        </div>
                        

                        
                    
                    </div>

                    <!-- Markup for Modal Dialogs -->

                    <!-- Markup for Create New Post Modal -->
                    <div class="modal fade" id="create-post-modal" tabindex="-1" role="dialog" aria-labelledby="create-post-modal" aria-hidden="true">
                    
                        <div class="modal-dialog modal-lg" role="document">

                            <div class="modal-content">

                                <div class="modal-header">
                                    <h5 class="modal-title create-post-heading" id="create-post-heading">Create New Post</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>

                                <div class="modal-body">
                                    <form action="admin_Actions.php" method="post">

                                        <div class="form-row justify-content-center">

                                            <div class="col-md-12 form-group ">
                                                <label for="post_title_field" class="create-post-form-label" >Announcement Title</label>
                                                <input type="text" class="form-control create-post-form-field" placeholder="Title of the Announcement" id="post_title_field" name="post_title_field" required>
                                            </div>
                                                
                                        </div>

                                        <div class="form-row justify-content-center">

                                            <div class="col-md-12 form-group ">
                                                <label for="post_body_field" class="create-post-form-label" >Announcement Body</label>
                                                <textarea class="form-control create-post-form-field" placeholder="Information about the Announcement" id="post_body_field" name="post_body_field" rows="9" required></textarea>
                                            </div>
                                                
                                        </div>

                                        <div class="form-row justify-content-center">
                                            

                                            <div class="col-md-6 form-group text-center">
                                                <label for="post_date_time_field" class="create-post-form-label " >Date and Time of Announcement Creation</label>
                                                <div class="input-group date" id="datetimepicker">
                                                    <input type="text" class="form-control"  id="post_date_time_field" name="post_date_time_field" required readonly>
                                                    <div class="input-group-addon input-group-prepend">
                                                        <span class="input-group-text"><i class="fas fa-calendar"></i></span>
                                                    </div>
                                                </div>

                                            </div>
                                                
                                        </div>

                                        <div class="row justify-content-center">

                                            <div class="col text-right mt-2 mb-2">
                                                <button type="submit" class="btn btn-danger create-post-btn" id="btn_create_post" name="btn_create_post">Publish Post</button>                                   
                                            </div>
                                            <div class="col text-left mt-2 mb-2">
                                                <button type="button" class="btn btn-danger create-post-btn" data-dismiss="modal">Cancel</button>                            
                                            </div>
                                            
                                        </div>
                                        
                                    </form>

                                </div>

                                
                                    
                            </div>
                        </div>
                    </div>

                    <!-- Markup for Edit Post Modal -->
                    <div class="modal fade" id="edit-post-modal" tabindex="-1" role="dialog" aria-labelledby="edit-post-modal" aria-hidden="true">
                    
                        <div class="modal-dialog modal-lg" role="document">

                            <div class="modal-content">

                                <div class="modal-header">
                                    <h5 class="modal-title edit-post-heading" id="edit-post-heading">Edit Post</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>

                                <div class="modal-body">
                                    <form action="admin_Actions.php" method="post">

                                        <div class="form-row justify-content-center text-center">

                                            <div class="col-md-6 form-group">
                                                <label for="edit_post_id_field" class="edit-post-form-label" >Post ID</label>
                                                <input readonly style="text-align: center;" type="text" class="form-control edit-post-form-field" placeholder="ID" id="edit_post_id_field" name="edit_post_id_field" required>
                                            </div>
                                            
                                        </div>

                                        <div class="form-row justify-content-center">

                                            <div class="col-md-12 form-group ">
                                                <label for="edit_post_title_field" class="edit-post-form-label" >Announcement Title</label>
                                                <input type="text" class="form-control edit-post-form-field" placeholder="Title of the Announcement" id="edit_post_title_field" name="edit_post_title_field" required>
                                            </div>
                                                
                                        </div>

                                        <div class="form-row justify-content-center">

                                            <div class="col-md-12 form-group ">
                                                <label for="edit_post_body_field" class="edit-post-form-label" >Announcement Body</label>
                                                <textarea class="form-control edit-post-form-field" placeholder="Information about the Announcement" id="edit_post_body_field" name="edit_post_body_field" rows="9" required></textarea>
                                            </div>
                                                
                                        </div>

                                        <div class="form-row justify-content-center">
                                            

                                            <div class="col-md-6 form-group text-center">
                                                <label for="edit_post_date_time_field" class="edit-post-form-label " >Date and Time of Announcement Creation</label>
                                                <div class="input-group date" id="datetimepicker">
                                                    <input type="text" class="form-control"  id="edit_post_date_time_field" name="edit_post_date_time_field" required readonly>
                                                    <div class="input-group-addon input-group-prepend">
                                                        <span class="input-group-text"><i class="fas fa-calendar"></i></span>
                                                    </div>
                                                </div>

                                            </div>
                                                
                                        </div>

                                        <div class="row justify-content-center">

                                            <div class="col text-right mt-2 mb-2">
                                                <button type="submit" class="btn btn-danger edit-post-btn" id="btn_edit_post" name="btn_edit_post">Edit Post</button>                                   
                                            </div>
                                            <div class="col text-left mt-2 mb-2">
                                                <button type="button" class="btn btn-danger edit-post-btn" data-dismiss="modal">Cancel</button>                            
                                            </div>
                                            
                                        </div>
                                        
                                    </form>

                                </div>

                                
                                    
                            </div>
                        </div>
                    </div>

                    <!-- Markup for Delete Post Modal -->
                    <div class="modal fade" id="delete-post-modal" tabindex="-1" role="dialog" aria-labelledby="delete-post-modal" aria-hidden="true">
                    
                        <div class="modal-dialog modal-lg" role="document">

                            <div class="modal-content">

                                <div class="modal-header">
                                    <h5 class="modal-title delete-post-heading" id="delete-post-heading">Delete Post</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>

                                <div class="modal-body">
                                    <form action="admin_Actions.php" method="post">

                                        <div class="form-row justify-content-center text-center">

                                            <div class="col-md-6 form-group">
                                                <label for="delete_post_id_field" class="delete-post-form-label" >Post ID</label>
                                                <input readonly style="text-align: center;" type="text" class="form-control delete-post-form-field" placeholder="ID" id="delete_post_id_field" name="delete_post_id_field" required>
                                            </div>
                                            
                                        </div>

                                        <div class="form-row justify-content-center">

                                            <div class="col-md-12 form-group ">
                                                <label for="delete_post_title_field" class="delete-post-form-label" >Announcement Title</label>
                                                <input readonly type="text" class="form-control delete-post-form-field" placeholder="Title of the Announcement" id="delete_post_title_field" name="delete_post_title_field" required>
                                            </div>
                                                
                                        </div>

                                        <div class="form-row justify-content-center">

                                            <div class="col-md-12 form-group ">
                                                <label for="delete_post_body_field" class="delete-post-form-label" >Announcement Body</label>
                                                <textarea readonly class="form-control delete-post-form-field" placeholder="Information about the Announcement" id="delete_post_body_field" name="delete_post_body_field" rows="9" required></textarea>
                                            </div>
                                                
                                        </div>

                                        <div class="form-row justify-content-center">
                                            

                                            <div class="col-md-6 form-group text-center">
                                                <label for="delete_post_date_time_field" class="delete-post-form-label " >Date and Time of Announcement Creation</label>
                                                <div class="input-group date" id="datetimepicker">
                                                    <input readonly type="text" class="form-control "  id="delete_post_date_time_field" name="delete_post_date_time_field" required readonly>
                                                    <div class="input-group-addon input-group-prepend">
                                                        <span class="input-group-text"><i class="fas fa-calendar"></i></span>
                                                    </div>
                                                </div>

                                            </div>
                                                
                                        </div>

                                        <div class="row justify-content-center">

                                            <div class="col text-right mt-2 mb-2">
                                                <button type="submit" class="btn btn-danger delete-post-btn" id="btn_delete_post" name="btn_delete_post">Delete Post</button>                                   
                                            </div>
                                            <div class="col text-left mt-2 mb-2">
                                                <button type="button" class="btn btn-danger delete-post-btn" data-dismiss="modal">Cancel</button>                            
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

        <!-- Sweetalert JS -->
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

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
            
            //Clear modal when closed
            function clear_modal()
            {
                $('#create-post-modal').on('hidden.bs.modal', function (e) {

                    document.getElementById('post_title_field').value= "";
                    document.getElementById('post_body_field').value= "";

                })
            }
            //Datepicker function

            function load_date_picker_to_modal()
            {
                
                $('#create-post-modal').on('show.bs.modal', function (e) {
                    date_time_picker_defaults(); 
                    open_date_picker();
                });
            }

            function date_time_picker_defaults()
            {
                $.extend(true, $.fn.datetimepicker.defaults, {
                    icons: {
                        time: 'far fa-clock',
                        date: 'far fa-calendar',
                        up: 'fas fa-arrow-up',
                        down: 'fas fa-arrow-down',
                        previous: 'fas fa-chevron-left',
                        next: 'fas fa-chevron-right',
                        today: 'far fa-calendar-check-o',
                        clear: 'far fa-trash',
                        close: 'far fa-times'
                    }
                });
            }

            function open_date_picker()
            {
                
                $('#datetimepicker').datetimepicker({
                    ignoreReadonly:true,
                    minDate: moment(),    
                    defaultDate: moment()

                });
   
            }

            //Pass Data from anchored edit post button to edit post modal form
            function load_post_to_edit_modal()
            {
                $('#edit-post-modal').on('show.bs.modal', function (e) {

                    var post_id = $(e.relatedTarget).data('post_id');
                    // console.log(post_id);
                    
                    $.ajax({
                        type : 'post',
                        url : 'admin_Actions.php',
                        data : {edit_load_post_info:post_id},
                        dataType: 'json',
                        success : function(data)
                        {

                            var len = data.length;

                            for(var i = 0; i<len; i++)
                                {

                                    var post_title = data[0]['post_title'];
                                    var post_body = data[0]['post_body'];
                                    var post_date_time = data[0]['post_date_time'];

                                    document.getElementById('edit_post_id_field').value= post_id;

                                    document.getElementById('edit_post_title_field').value= post_title;
                                    document.getElementById('edit_post_body_field').value= post_body;
                                    document.getElementById('edit_post_date_time_field').value= post_date_time;
                                    
                                    // console.log(post_id);

                                    // console.log(post_title);
                                    // console.log(post_body);
                                    // console.log(post_date_time);
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

            //Pass Data from anchored delete post button to delete post modal form
            function load_post_to_delete_modal()
            {
                $('#delete-post-modal').on('show.bs.modal', function (e) {

                    var post_id = $(e.relatedTarget).data('post_id');
                    // console.log(post_id);
                    
                    $.ajax({
                        type : 'post',
                        url : 'admin_Actions.php',
                        data : {delete_load_post_info:post_id},
                        dataType: 'json',
                        success : function(data)
                        {

                            var len = data.length;

                            for(var i = 0; i<len; i++)
                                {

                                    var post_title = data[0]['post_title'];
                                    var post_body = data[0]['post_body'];
                                    var post_date_time = data[0]['post_date_time'];

                                    document.getElementById('delete_post_id_field').value= post_id;

                                    document.getElementById('delete_post_title_field').value= post_title;
                                    document.getElementById('delete_post_body_field').value= post_body;
                                    document.getElementById('delete_post_date_time_field').value= post_date_time;
                                    
                                    // console.log(post_id);

                                    // console.log(post_title);
                                    // console.log(post_body);
                                    // console.log(post_date_time);
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

            //Function to Search posts
            function search_post()
            {
                $('#search_post_field').keyup(function()
                {
                    var search_load_post=jQuery('#search_post_field').val();

                    jQuery.ajax({
                        method:'post',
                        url:'admin_Actions.php',
                        // data : {search_load_post:search},
                        // data:'search='+search,
                        data:'search_load_post='+search_load_post,
                        success:function(data)
                        {
                            jQuery('#card_container').html(data);
                            // console.log(data);
                        }
                    });	
                });
            }


            $(document).ready(function(){

                load_date_picker_to_modal();   
                clear_modal();
                load_post_to_edit_modal();
                load_post_to_delete_modal();
                search_post();
                        
            });

        </script>



    </body>
    
</html>