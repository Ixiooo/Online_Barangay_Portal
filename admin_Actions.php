<?php  

//This is where the form action is headed

use function PHPSTORM_META\map;

require_once ('dbConfig.php');
require_once ('functions.php');

$userObj = new User();
$database = new Database();
$db = $database->dbConnection();

//Add Resident Data to Database when add button on the modal is pressed
if(isset($_POST['btn_add_resident']))
{
    $first_name = $_POST['first_name_field'];
    $middle_name = $_POST['middle_name_field'];
    $last_name = $_POST['last_name_field'];
    $suffix = $_POST['suffix_field'];
    $birthday = $_POST['birthday_field'];
    $alias = $_POST['alias_field'];
    $sex = $_POST['sex_field'];
    $civil_stat = $_POST['civil_stat_field'];
    $mobile_no = $_POST['mobile_no_field'];
    $email = $_POST['email_field'];
    $religion = $_POST['religion_field'];
    $voter_stat = $_POST['voter_stat_field'];
    $username = $_POST['username_field'];
    $password = $_POST['password_field'];


    if($userObj->add_resident($first_name, $middle_name, $last_name, $suffix , $birthday , $alias , $sex , $civil_stat , $mobile_no , $email , $religion , $voter_stat, $username, $password))
        {
            // echo "Successfully Added";
            $userObj->redirect('admin_Residents.php?residentAdded');
        }
    else
    {
        echo "Error";
    }
}

//Add Official Data to Database when add button on the modal is pressed
if(isset($_POST['btn_add_official']))
{
    $position = $_POST['position_field'];
    $first_name = $_POST['first_name_field'];
    $middle_name = $_POST['middle_name_field'];
    $last_name = $_POST['last_name_field'];
    $sex = $_POST['sex_field'];
    $contact_info = $_POST['mobile_no_field'];
    $username = $_POST['username_field'];
    $password = $_POST['password_field'];


    if($userObj->add_official($position,$first_name,$middle_name,$last_name,$sex,$contact_info,$username,$password))
        {
            // echo "Successfully Added";
            $userObj->redirect('admin_BarangayOfficials.php?officialAdded');
        }
    else
    {
        echo "Error";
    }
}

//Add Post to Database when add button on the modal is pressed
if(isset($_POST['btn_create_post']))
{
    $post_title = $_POST['post_title_field'];
    $post_body = $_POST['post_body_field'];
    $post_date_time = $_POST['post_date_time_field'];


    if($userObj->add_post($post_title, $post_body, $post_date_time))
        {
            // echo "Successfully Added";
            $userObj->redirect('admin_Announcements.php?postCreated');
        }
    else
    {
        echo "Error";
    }
}

//Edit Resident Data on Database when edit button on the modal is pressed
if(isset($_POST['btn_edit_resident']))
{
    $resident_id = $_POST['edit_resident_id_field'];
    $first_name = $_POST['edit_first_name_field'];
    $middle_name = $_POST['edit_middle_name_field'];
    $last_name = $_POST['edit_last_name_field'];
    $suffix = $_POST['edit_suffix_field'];
    $birthday = $_POST['edit_birthday_field'];
    $alias = $_POST['edit_alias_field'];
    $sex = $_POST['edit_sex_field'];
    $civil_stat = $_POST['edit_civil_stat_field'];
    $mobile_no = $_POST['edit_mobile_no_field'];
    $email = $_POST['edit_email_field'];
    $religion = $_POST['edit_religion_field'];
    $voter_stat = $_POST['edit_voter_stat_field'];
    $username = $_POST['edit_username_field'];
    $password = $_POST['edit_password_field'];


    if($userObj->edit_resident($resident_id, $first_name, $middle_name, $last_name, $suffix , $birthday , $alias , $sex , $civil_stat , $mobile_no , $email , $religion , $voter_stat, $username, $password))
    {
        // echo "Successfully Added";
        $userObj->redirect('admin_Residents.php?residentUpdated');
    }
    else
    {
        $userObj->redirect('admin_Residents.php?usernameTaken');
    }
}

//Edit Barangay Official Data on Database when edit button on the modal is pressed
if(isset($_POST['btn_edit_official']))
{
    $official_id = $_POST['edit_official_id_field'];
    $position = $_POST['edit_official_position_field'];
    $first_name = $_POST['edit_official_first_name_field'];
    $middle_name = $_POST['edit_official_middle_name_field'];
    $last_name = $_POST['edit_official_last_name_field'];
    $sex = $_POST['edit_official_sex_field'];
    $contact_info = $_POST['edit_official_mobile_no_field'];
    $username = $_POST['edit_official_username_field'];
    $password = $_POST['edit_official_password_field'];

    if($userObj->edit_official($official_id,$position,$first_name,$middle_name,$last_name,$sex,$contact_info,$username,$password))
    {
        // echo "Successfully Added";
        $userObj->redirect('admin_BarangayOfficials.php?officialUpdated');
    }
    else
    {
        $userObj->redirect('admin_BarangayOfficials.php?officialUsernameTaken');
    }
}

//Edit Post Data on Database when edit button on the modal is pressed
if(isset($_POST['btn_edit_post']))
{
    $post_id = $_POST['edit_post_id_field'];
    $post_title = $_POST['edit_post_title_field'];
    $post_body = $_POST['edit_post_body_field'];
    $post_date_time = $_POST['edit_post_date_time_field'];
    

    if($userObj->edit_post($post_id, $post_title, $post_body, $post_date_time))
    {
        // echo "Successfully Added";
        $userObj->redirect('admin_Announcements.php?postUpdated');
    }
    else
    {
        echo "Error";
    }
}

//Delete Resident Data on Database when add button on the modal is pressed
if(isset($_POST['btn_delete_resident']))
{
    $resident_id = $_POST['delete_resident_id_field'];

    if($userObj->delete_resident($resident_id))
    {
        $userObj->redirect('admin_Residents.php?residentDeleted');
    }
    else
    {
        echo "Error";
    }
}

//Delete Barangay Official Data on Database when add button on the modal is pressed
if(isset($_POST['btn_delete_official']))
{
    $official_id = $_POST['delete_official_id_field'];

    if($userObj->delete_official($official_id))
    {
        $userObj->redirect('admin_BarangayOfficials.php?officialDeleted');
    }
    else
    {
        echo "Error";
    }
}

//Delete Post Data on Database when Delete button on the modal is pressed
if(isset($_POST['btn_delete_post']))
{
    $post_id = $_POST['delete_post_id_field'];
    

    if($userObj->delete_post($post_id))
    {
        // echo "Successfully Added";
        $userObj->redirect('admin_Announcements.php?postDeleted');
    }
    else
    {
        echo "Error";
    }
}

//Upload Document to DB
if(isset($_POST['btn_upload']))
{
    
    $description = $_POST['description_field'];
    $date_time = $_POST['document_date_time_field'];

    // Name of the uploaded file
    $filename = $_FILES['myfile']['name'];
    $directory = 'documents/';
    // destination of the file on the server
    $destination = 'documents/' . $filename;

    // get the file extension
    $extension = pathinfo($filename, PATHINFO_EXTENSION);

    // the physical file on a temporary uploads directory on the server
    $file = $_FILES['myfile']['tmp_name'];
    $size = $_FILES['myfile']['size'];
 
    $userObj->upload_documents($file, $destination, $filename,  $description, $date_time, $directory);

}

//Delete Document Data on Database when Delete button on the modal is pressed
if(isset($_POST['btn_delete_document']))
{
    $id = $_POST['delete_document_id_field'];
    $filename = $_POST['delete_document_title_field'];

    if($userObj->delete_document($id) && $userObj->delete_document_file($filename))
    {
        $userObj->redirect('admin_Documents.php?documentDeleted');
    }
    else
    {
        $userObj->redirect('admin_Documents.php?documentDeleteError');
    }
}

//Ajax Calls

//Function for ajax call from edit modal to fetch resident information from database
if(isset($_POST['edit_load_resident_info']))
{
    $resident_id = $_POST['edit_load_resident_info'];

    $resident_arr = array();

    $qry = "SELECT * from resident_info WHERE resident_id ='$resident_id'";
        $stmt = $userObj->runQuery($qry);
        $result = $stmt->execute(); 

        while( $row=$stmt->fetch(PDO::FETCH_ASSOC))
        {
            
            $resident_id = $row['resident_id'];
            $first_name = $row['first_name'];
            $middle_name = $row['middle_name'];
            $suffix = $row['suffix'];
            
            $last_name = $row['last_name'];
            $birthday = $row['birthday'];
            $alias = $row['alias'];

            $sex = $row['sex'];
            $civil_stat = $row['civil_stat'];
            $mobile_no = $row['mobile_no'];

            $email = $row['email'];
            $religion = $row['religion'];
            $voter_stat = $row['voter_stat'];
            
            $username = $row['username'];
            $password = $row['password'];

            $resident_arr[] = array
                                (
                                    "resident_id" => $resident_id, "first_name" => $first_name, "middle_name" => $middle_name, "suffix" => $suffix, 
                                    "last_name" => $last_name, "birthday" => $birthday, "alias" => $alias, 
                                    "sex" => $sex, "civil_stat" => $civil_stat, "mobile_no" => $mobile_no, 
                                    "email" => $email, "religion" => $religion, "voter_stat" => $voter_stat, 
                                    "username" => $username, "password" => $password
                                );
            
        }

        echo json_encode($resident_arr);
    
}

//Function for ajax call from delete modal to fetch resident information from database
if(isset($_POST['delete_load_resident_info']))
{
    $resident_id = $_POST['delete_load_resident_info'];

    $resident_arr = array();

    $qry = "SELECT * from resident_info WHERE resident_id ='$resident_id'";
        $stmt = $userObj->runQuery($qry);
        $result = $stmt->execute(); 

        while( $row=$stmt->fetch(PDO::FETCH_ASSOC))
        {
            
            $resident_id = $row['resident_id'];

            $first_name = $row['first_name'];
            $middle_name = $row['middle_name'];
            $last_name = $row['last_name'];

            $resident_arr[] = array
                                (
                                    "resident_id" => $resident_id, "first_name" => $first_name, "middle_name" => $middle_name,
                                    "last_name" => $last_name
                                );
            
        }

        echo json_encode($resident_arr);
    
}

//Function for ajax call from official edit modal to fetch barangay official information from database
if(isset($_POST['edit_load_official_info']))
{
    $official_id = $_POST['edit_load_official_info'];

    $official_arr = array();

    $qry = "SELECT * from official_info WHERE official_id ='$official_id'";

        $stmt = $userObj->runQuery($qry);
        $result = $stmt->execute(); 

        while( $row=$stmt->fetch(PDO::FETCH_ASSOC))
        {
            
            $official_first_name = $row['official_first_name'];
            $official_middle_name = $row['official_middle_name'];
            $official_last_name = $row['official_last_name'];
            $official_position = $row['official_position'];
            $official_sex = $row['official_sex'];
            $official_contact_info = $row['official_contact_info'];
            $official_username = $row['official_username'];
            $official_password = $row['official_password'];

            $official_arr[] = array
                                (
                                    "official_first_name" => $official_first_name, "official_middle_name" => $official_middle_name, "official_last_name" => $official_last_name, "official_position" => $official_position, 
                                    "official_sex" => $official_sex, "official_contact_info" => $official_contact_info, "official_username" => $official_username, 
                                    "official_password" => $official_password
                                );
            
        }

        echo json_encode($official_arr);
    
}

//Function for ajax call from delete modal to fetch barangay official information from database
if(isset($_POST['delete_load_official_info']))
{
    $official_id = $_POST['delete_load_official_info'];

    $official_arr = array();

    $qry = "SELECT * from official_info WHERE official_id ='$official_id'";
        $stmt = $userObj->runQuery($qry);
        $result = $stmt->execute(); 

        while( $row=$stmt->fetch(PDO::FETCH_ASSOC))
        {
            $official_first_name = $row['official_first_name'];
            $official_middle_name = $row['official_middle_name'];
            $official_last_name = $row['official_last_name'];

            $official_arr[] = array
                                (
                                    "official_id" => $official_id, "official_first_name" => $official_first_name, "official_middle_name" => $official_middle_name,
                                    "official_last_name" => $official_last_name
                                );
            
        }

        echo json_encode($official_arr);
    
}

//Function for ajax call from post edit modal to fetch post information from database
if(isset($_POST['edit_load_post_info']))
{
    $post_id = $_POST['edit_load_post_info'];

    $post_arr = array();

    $qry = "SELECT * from announcement_post WHERE post_id ='$post_id'";

        $stmt = $userObj->runQuery($qry);
        $result = $stmt->execute(); 

        while( $row=$stmt->fetch(PDO::FETCH_ASSOC))
        {
            
            $post_title = $row['post_title'];
            $post_body = $row['post_body'];
            $post_date_time = $row['post_date_time'];

            $post_arr[] = array
                                (
                                    "post_title" => $post_title, "post_body" => $post_body, "post_date_time" => $post_date_time
                                );
            
        }

        echo json_encode($post_arr);
    
}

//Function for ajax call from post edit modal to fetch post information from database
if(isset($_POST['delete_load_post_info']))
{
    $post_id = $_POST['delete_load_post_info'];

    $post_arr = array();

    $qry = "SELECT * from announcement_post WHERE post_id ='$post_id'";

        $stmt = $userObj->runQuery($qry);
        $result = $stmt->execute(); 

        while( $row=$stmt->fetch(PDO::FETCH_ASSOC))
        {
            
            $post_title = $row['post_title'];
            $post_body = $row['post_body'];
            $post_date_time = $row['post_date_time'];

            $post_arr[] = array
                                (
                                    "post_title" => $post_title, "post_body" => $post_body, "post_date_time" => $post_date_time
                                );
            
        }

        echo json_encode($post_arr);
    
}

//Ajax Call for Resident Table Search
if(isset($_POST['search']))
{
    $search=$_POST['search'];
    $sql="SELECT * FROM resident_info "; 
    if($search!='')
    {
        $sql.=" WHERE   resident_id  like '%$search%' or first_name like '%$search%' or middle_name like '%$search%'
                        or last_name like '%$search%' or suffix like '%$search%' or alias like '%$search%'
                        or sex like '%$search%' or mobile_no like '%$search%' or email like '%$search%'
                        or religion like '%$search%' or civil_stat like '%$search%' or voter_stat like '%$search%'
                        or username like '%$search%' or password like '%$search%' 
                
                        ";
    }
    $sql.="ORDER BY first_name ASC";
    $stmt=$userObj->runQuery($sql);
    $stmt->execute();
    $data=$stmt->fetchAll(PDO::FETCH_ASSOC);

    if(isset($data['0'])){
        $html='

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
        
        ';
        foreach($data as $list){
            $html.='
            
            <tr>

                <td>
                    <a class="table-btn-anchor" href="#delete-resident-modal" data-toggle="modal" data-resident_id="'.$list['resident_id'].'" >
                        <button type="button" class="btn btn-danger table-btn">
                            <span> <i class="fas fa-trash-alt"></i></span>
                        </button>
                    </a>
                </td> 

                <td>
                    <a class="table-btn-anchor" href="#edit-resident-modal" data-toggle="modal" data-resident_id="'.$list['resident_id'].'" >
                        <button type="button" class="btn btn-danger table-btn">
                            <span> <i class="fas fa-edit"></i></span>
                        </button>
                    </a>
                </td>

                <td>'.$list['resident_id'].'</td>

                <td>'.$list['first_name'].'</td>

                <td>'.$list['middle_name'].'</td>

                <td>'.$list['last_name'].'</td>

                <td>'.$list['suffix'].'</td>

                <td>'.$list['alias'].'</td>

                <td>'.$list['sex'].'</td>

                <td>'.$list['birthday'].'</td>

                <td>'.$list['mobile_no'].'</td>

                <td>'.$list['email'].'</td>

                <td>'.$list['religion'].'</td>

                <td>'.$list['civil_stat'].'</td>

                <td>'.$list['voter_stat'].'</td>

                <td>'.$list['username'].'</td>

                <td>'.$list['password'].'</td>

            </tr>
            ';
        }	
        $html.='</table>';
        
        echo $html;	
    }
    else
    {
        echo 
        '
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

                <tr>
                    <td></td> 
                    <td></td> 
                    <td> No Record Found </td> 
                    <td> No Record Found </td> 
                    <td> No Record Found </td> 
                    <td> No Record Found </td> 
                    <td> No Record Found </td> 
                    <td> No Record Found </td> 
                    <td> No Record Found </td> 
                    <td> No Record Found </td> 
                    <td> No Record Found </td> 
                    <td> No Record Found </td> 
                    <td> No Record Found </td> 
                    <td> No Record Found </td> 
                    <td> No Record Found </td> 
                    <td> No Record Found </td> 
                    <td> No Record Found </td> 

                </tr>
            
        </table>  
        ';
    }

}

//Ajax Call for Post Search
if(isset($_POST['search_load_post']))
{
    $search=$_POST['search_load_post'];
    $sql="SELECT * FROM announcement_post "; 
    if($search!='')
    {
        $sql.=" WHERE   post_id  like '%$search%' or post_title like '%$search%' or post_body like '%$search%'
                        or post_date_time like '%$search%'
                
                        ";
    }
    $sql.="ORDER BY post_id DESC";
    
    $stmt=$userObj->runQuery($sql);
    $stmt->execute();
    $result=$stmt->fetchAll(PDO::FETCH_ASSOC);

    if($stmt->rowCount()>0)
    {

        foreach($result as $row)
        { 
            $html='

            <div class="card pb-2  mt-5 ml-3 mr-3 post-card" >

                <div class="card-header post-header"> 
                    <div class="row">

                        <div class="col text-left">
                            '.$row['post_title'].'
                        </div>

                        <div class="col text-right">

                            <a class="post-btn-anchor" href="#edit-post-modal" data-toggle="modal" data-post_id='.$row['post_id'].' >
                                <button type="button" class="btn btn-danger  post-card-btn">
                                    <span> <i class="fas fa-edit"></i></span>
                                </button>
                            </a>

                            <a class="post-btn-anchor" href="#delete-post-modal" data-toggle="modal" data-post_id='.$row['post_id'].' >
                                <button type="button" class="btn btn-danger  post-card-btn">
                                    <span> <i class="fas fa-trash-alt"></i></span>
                                </button>
                            </a>
                        </div>

                    </div>
                </div>

                <div class="card-body">
                    <h6 class="card-title post-title">Post written on '.$row['post_date_time'].'</h5>
                    <p class="card-text post-body">'.$row['post_body'].'</p>
                </div>
            </div>

            ';

            echo $html;	
        }	
        
       
    }
    else
    {
        echo 
        '  <div class="card pb-2  mt-5 ml-3 mr-3 post-card" >

                <div class="card-header post-header"> 
                    <div class="row">

                        <div class="col text-left">
                            No Result Found
                        </div>

                    </div>
                </div>

                <div class="card-body">
                    <h6 class="card-title post-title">No Result Found</h5>
                    <p class="card-text post-body">No Result Found</p>
                </div>
            </div>
        ';
    }

}

//Ajax Call for Post Search for User Page
if(isset($_POST['search_announcements']))
{
    $search=$_POST['search_announcements'];
    $sql="SELECT * FROM announcement_post "; 
    if($search!='')
    {
        $sql.=" WHERE   post_id  like '%$search%' or post_title like '%$search%' or post_body like '%$search%'
                        or post_date_time like '%$search%'
                
                        ";
    }
    $sql.="ORDER BY post_id DESC";
    
    $stmt=$userObj->runQuery($sql);
    $stmt->execute();
    $result=$stmt->fetchAll(PDO::FETCH_ASSOC);

    if($stmt->rowCount()>0)
    {

        foreach($result as $row)
        { 
            $html='

            <div class="card pb-2  mt-5 ml-3 mr-3 post-card" >

                <div class="card-header post-header"> 
                    <div class="row">

                        <div class="col text-left">
                            '.$row['post_title'].'
                        </div>

                    </div>
                </div>

                <div class="card-body">
                    <h6 class="card-title post-title">Post written on '.$row['post_date_time'].'</h5>
                    <p class="card-text post-body">'.$row['post_body'].'</p>
                </div>
            </div>

            ';

            echo $html;	
        }	
        
       
    }
    else
    {
        echo 
        '  <div class="card pb-2  mt-5 ml-3 mr-3 post-card" >

                <div class="card-header post-header"> 
                    <div class="row">

                        <div class="col text-left">
                            No Result Found
                        </div>

                    </div>
                </div>

                <div class="card-body">
                    <h6 class="card-title post-title">No Result Found</h5>
                    <p class="card-text post-body">No Result Found</p>
                </div>
            </div>
        ';
    }

}

//Ajax Call for Checking IF Resident Username Already Exists 
if(isset($_POST['username_verify']))
{

    $username = $_POST['username_verify'];
 
    $query = "SELECT * FROM resident_info WHERE username='".$username."'";
    
    $stmt=$userObj->runQuery($query);
    $stmt->execute();
    $result=$stmt->fetchAll(PDO::FETCH_ASSOC);

    $response = '<div style="text-align:center" class = "alert alert-success alert-dismissible fade show col-md-6 offset-md-3" role="alert">
                    Username is Available
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>                               
                </div>';

    if($stmt->rowCount()>0)
    {
        $response ='<div style="text-align:center" class = "alert alert-danger alert-dismissible fade show col-md-6 offset-md-3" role="alert">
                        Username Already Taken
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>                               
                    </div>';
    }
 
    echo $response;
    die;
}

//Ajax Call for Disabling Submit button when Resident Username Already Exists
if(isset($_POST['username_verify_button']))
{

    $username = $_POST['username_verify_button'];
 
    $query = "SELECT * FROM resident_info WHERE username='".$username."'";
    
    $stmt=$userObj->runQuery($query);
    $stmt->execute();
    $result=$stmt->fetchAll(PDO::FETCH_ASSOC);

    $response = 0;

    if($stmt->rowCount()>0)
    {
        $response = 1;
    }
 
    echo $response;
    die;
}

//Ajax Call for Checking IF Resident Username Already Exists 
if(isset($_POST['username_verify_official']))
{

    $username = $_POST['username_verify_official'];
 
    $query = "SELECT * FROM official_info WHERE official_username='".$username."'";
    
    $stmt=$userObj->runQuery($query);
    $stmt->execute();
    $result=$stmt->fetchAll(PDO::FETCH_ASSOC);

    $response = '<div style="text-align:center" class = "alert alert-success alert-dismissible fade show col-md-6 offset-md-3" role="alert">
                    Username is Available
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>                               
                </div>';

    if($stmt->rowCount()>0)
    {
        $response ='<div style="text-align:center" class = "alert alert-danger alert-dismissible fade show col-md-6 offset-md-3" role="alert">
                        Username Already Taken
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>                               
                    </div>';
    }
 
    echo $response;
    die;
}

//Ajax Call for Disabling Submit button when Resident Username Already Exists
if(isset($_POST['username_verify_official_button']))
{

    $username = $_POST['username_verify_official_button'];
 
    $query = "SELECT * FROM official_info WHERE official_username='".$username."'";
    
    $stmt=$userObj->runQuery($query);
    $stmt->execute();
    $result=$stmt->fetchAll(PDO::FETCH_ASSOC);

    $response = 0;

    if($stmt->rowCount()>0)
    {
        $response = 1;
    }
 
    echo $response;
    die;
}

//Ajax Call for Login
if(isset($_POST['current_username']) && isset($_POST['current_password']))
{
    session_start();

    $username = $_POST['current_username'];
    $password = $_POST['current_password'];

    $admin_query = "SELECT * FROM official_info WHERE official_username = '$username' and official_password = '$password' ";
    $admin_stmt = $userObj->runQuery($admin_query);
    $admin_result = $admin_stmt->execute();
    
    $user_query = "SELECT * FROM resident_info WHERE username = '$username' and password = '$password' ";
    $user_stmt = $userObj->runQuery($user_query);
    $user_result = $user_stmt->execute();

    if($admin_result and $user_result)
    {
        
        if ($admin_stmt->rowCount() == 1)
        {
            $user = $admin_stmt->fetch(PDO::FETCH_ASSOC);
            $_SESSION['session_login'] = $user;

            echo '0';
        }

        elseif ($user_stmt->rowCount() == 1)
        {
            $user = $user_stmt->fetch(PDO::FETCH_ASSOC);
            $_SESSION['session_login'] = $user;

            echo '1';
        }

        else
        {
            echo 'Account Not Found';
        }
        
    }

    else
    {
        echo 'Error';
    }
    

}

//Function for ajax call from documents delete modal to fetch documents information from database
if(isset($_POST['delete_load_document']))
{
    $id = $_POST['delete_load_document'];

    $document_arr = array();

    $qry = "SELECT * from documents WHERE id ='$id'";

        $stmt = $userObj->runQuery($qry);
        $result = $stmt->execute(); 

        while( $row=$stmt->fetch(PDO::FETCH_ASSOC))
        {
            
            $document_title = $row['name'];
            $document_body = $row['description'];
            $document_date_time = $row['upload_date_time'];

            $document_arr[] = array
                                (
                                    "document_title" => $document_title, "document_body" => $document_body, "document_date_time" => $document_date_time
                                );
            
        }

        echo json_encode($document_arr);
    
}


// End of Ajax Calls






?>

