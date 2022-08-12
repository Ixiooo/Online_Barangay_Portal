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
    <link rel="stylesheet" href="stylesheets/admin_Documents.css">

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
                    <a class="nav-item nav-link" href="admin_Home.php">Home</a>
                </li>

                <li class="nav-item pl-3 pr-3 ">
                    <a class="nav-link" href="admin_Residents.php">Residents</a>
                </li>
                <li class="nav-item pl-3 pr-3 active">
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
            
            <a href="admin_Documents.php?logout=true">
                <button style="font-family: 'Montserrat', sans-serif !important;" class="btn btn-outline-danger logout-btn  mr-md-5" type="button"  id="logout-btn">Logout</button>
            </a>
        </nav>
    </div>
    
    <div class="container-fluid">
        <div class="page-container">

            <!-- Upload docu Markup -->
            <div class="row pb-4 mb-2 add-container">

                <div class="col-md-4 offset-md-7 text-right mt-2 mb-2">
                    
                    <button class="btn btn-danger upload-btn" type="button" data-toggle="modal" data-target="#upload-modal" id="upload-btn" name="upload-btn">
                        + Upload New Document
                    </button>
                </div>
            </div>

            <!-- // PHP Code for Notification Alert -->
            <?php
                if(isset($_GET['documentUploaded']))
                {
                    echo 
                    '<div style="text-align:center" class = "alert alert-success alert-dismissible fade show" role="alert">
                        Document Uploaded Successfully.
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>                               
                    </div>';
                };

                if(isset($_GET['documentDeleted']))
                {
                    echo 
                    '<div style="text-align:center" class = "alert alert-success alert-dismissible fade show" role="alert">
                        Document Deleted Successfully.
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>                               
                    </div>';
                };

                if(isset($_GET['documentUploadFailed']))
                {
                    echo 
                    '<div style="text-align:center" class = "alert alert-danger alert-dismissible fade show" role="alert">
                        Document Upload Failed.
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>                               
                    </div>';
                };

                if(isset($_GET['documentDeleteError']))
                {
                    echo 
                    '<div style="text-align:center" class = "alert alert-danger alert-dismissible fade show" role="alert">
                        Document Deletion Failed.
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>                               
                    </div>';
                };
            ?>

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

                                        <div class="col text-right">

                                            <a class="post-btn-anchor" href="#delete-document-modal" data-toggle="modal" data-id="<?php print($rowUser['id']) ?>" >
                                                <button type="button" class="btn btn-danger post-card-btn" >
                                                    <span> <i class="fas fa-trash-alt"></i></span>
                                                </button>
                                            </a>
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

            <!-- Markup for Modal Dialogs -->

            <!-- Markup for Upload Modal -->
            <div class="modal fade" id="upload-modal" tabindex="-1" role="dialog" aria-labelledby="upload-modal" aria-hidden="true">
            
                <div class="modal-dialog modal-md" role="document">

                    <div class="modal-content">

                        <div class="modal-header">
                            <h5 class="modal-title upload-form-heading" id="upload-form-heading">Upload New Document</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>

                        <div class="modal-body">
                            <form action="admin_Actions.php" method="post" enctype="multipart/form-data">
                                
                                <div class="form-row justify-content-center">

                                            <div class="col-md-12 form-group ">
                                                <label for="description_field" class="upload-form-label" >Document Description</label>
                                                <textarea class="form-control upload-form-field" placeholder="Information about the Document" id="description_field" name="description_field" rows="9" required></textarea>
                                            </div>
                                                
                                        </div>
                                <div class="form-row justify-content-center">

                                    <div class="col-md-12 form-group text-center">
                                        <input type="file" name="myfile" accept="application/pdf" id="input_file" required>
                                    </div>
                                        
                                </div>

                                <div class="form-row justify-content-center">                           
                                    <div class="col-md- form-group text-center">
                                        <label for="document_date_time_field" class="upload-form-label " >Date and Time of Document Upload</label>
                                        <div class="input-group date" id="datetimepicker">
                                            <input type="text" class="form-control"  id="document_date_time_field" name="document_date_time_field" required readonly>
                                            <div class="input-group-addon input-group-prepend">
                                                <span class="input-group-text"><i class="fas fa-calendar"></i></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row justify-content-center">
                                        <div class="col form-group text-right  pr-2 mr-2">
                                            <button type="submit" class="btn upload-form-btn" id="btn_upload" name="btn_upload">Upload</button>                                   
                                        </div>
                                        <div class="col form-group text-left pl-2 ml-2">
                                            <button type="button" data-dismiss="modal" class="btn upload-form-btn" id="btn_cancel" name="btn_cancel">Cancel</button>                                   
                                        </div>
                                </div>
                            
                            </form>

                        </div>

                        
                            
                    </div>
                </div>
            </div>

            <!-- Markup for Delete Document Modal -->
            <div class="modal fade" id="delete-document-modal" tabindex="-1" role="dialog" aria-labelledby="delete-document-modal" aria-hidden="true">
            
                <div class="modal-dialog modal-md" role="document">

                    <div class="modal-content">

                        <div class="modal-header">
                            <h5 class="modal-title delete-document-heading" id="delete-document-heading">Delete Document</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>

                        <div class="modal-body">
                            <form action="admin_Actions.php" method="post">

                                <div class="form-row justify-content-center text-center">

                                    <div class="col-md-6 form-group">
                                        <label for="delete_document_id_field" class="delete-document-form-label" >Document ID</label>
                                        <input readonly style="text-align: center;" type="text" class="form-control delete-document-form-field" placeholder="ID" id="delete_document_id_field" name="delete_document_id_field" required>
                                    </div>
                                    
                                </div>

                                <div class="form-row justify-content-center">

                                    <div class="col-md-12 form-group ">
                                        <label for="delete_document_title_field" class="delete-document-form-label" >Document Name</label>
                                        <input readonly type="text" class="form-control delete-document-form-field" placeholder="Document Name" id="delete_document_title_field" name="delete_document_title_field" required>
                                    </div>
                                        
                                </div>

                                <div class="form-row justify-content-center">

                                    <div class="col-md-12 form-group ">
                                        <label for="delete_document_body_field" class="delete-document-form-label" >Document Description</label>
                                        <textarea readonly class="form-control delete-document-form-field" placeholder="Document Description" id="delete_document_body_field" name="delete_document_body_field" rows="9" required></textarea>
                                    </div>
                                        
                                </div>

                                <div class="form-row justify-content-center">
                                    

                                    <div class="col-md-6 form-group text-center">
                                        <label for="delete_document_date_time_field" class="delete-post-document-label " >Document Uploaded on</label>
                                        <div class="input-group date" id="datetimepicker">
                                            <input readonly type="text" class="form-control "  id="delete_document_date_time_field" name="delete_document_date_time_field" required readonly>
                                            <div class="input-group-addon input-group-prepend">
                                                <span class="input-group-text"><i class="fas fa-calendar"></i></span>
                                            </div>
                                        </div>

                                    </div>
                                        
                                </div>

                                <div class="row justify-content-center">

                                    <div class="col text-right mt-2 mb-2">
                                        <button type="submit" class="btn btn-danger delete-post-btn" id="btn_delete_document" name="btn_delete_document">Delete Document</button>                                   
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

    //Datepicker function

    function load_date_picker_to_modal()
    {
        
        $('#upload-modal').on('show.bs.modal', function (e) {
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

    //Clear modal when closed
    function clear_modal()
    {
        $('#upload-modal').on('hidden.bs.modal', function (e) {

            document.getElementById('description_field').value= "";
            document.getElementById('input_file').value= "";
        });
    }

    //Pass Data from anchored delete post button to delete post modal form
    function load_post_to_delete_modal()
    {
        $('#delete-document-modal').on('show.bs.modal', function (e) {

            var id = $(e.relatedTarget).data('id');
            // console.log(id);
            
            $.ajax({
                type : 'post',
                url : 'admin_Actions.php',
                data : {delete_load_document:id},
                dataType: 'json',
                success : function(data)
                {

                    var len = data.length;

                    for(var i = 0; i<len; i++)
                        {

                            var document_title = data[0]['document_title'];
                            var document_body = data[0]['document_body'];
                            var document_date_time = data[0]['document_date_time'];

                            document.getElementById('delete_document_id_field').value= id;

                            document.getElementById('delete_document_title_field').value= document_title;
                            document.getElementById('delete_document_body_field').value= document_body;
                            document.getElementById('delete_document_date_time_field').value= document_date_time;
                        }  
                },

                error:function(data)
                {
                    errormsg = JSON.stringify(data);
                    // alert(errormsg);
                    
                    
                }


            });
        });
    }


    $(document).ready(function(){

        load_date_picker_to_modal();
        load_post_to_delete_modal();   
        clear_modal();
    });
        
    </script>



</body>
</html>