<?php

    require_once ('dbConfig.php');

    class User
    {
        private $conn;

        //Function to construct database
        public function __construct()
        {
            $database = new Database();
            $db = $database->dbConnection();
            $this->conn = $db;
        }
    
        //Run query that is passed on parameter
        public function runQuery($sql)
        {
            $stmt = $this->conn->prepare($sql);
            return $stmt;
        }

        //Redirect to url that is passed on parameter
        public function redirect($url)
        {
            header("Location: $url");
        }   

        //Function to add resident info supplied from parameter
        public function add_resident($first_name, $middle_name, $last_name, $suffix , $birthday , $alias , $sex , $civil_stat , $mobile_no , $email , $religion , $voter_stat, $username, $password)
        {
            try
            {
                $stmt = $this->conn->prepare
                                    (
                                        "INSERT INTO resident_info (first_name, middle_name, last_name, suffix, birthday, alias, sex, civil_stat, mobile_no, email, religion, voter_stat, username, password) 
                                        VALUES (:first_name, :middle_name, :last_name, :suffix, :birthday, :alias, :sex, :civil_stat, :mobile_no, :email, :religion, :voter_stat, :username, :password)"
                                    );
                $stmt->bindParam(":first_name", $first_name);
                $stmt->bindParam(":middle_name", $middle_name);
                $stmt->bindParam(":last_name", $last_name);
                $stmt->bindParam(":suffix", $suffix);
                $stmt->bindParam(":birthday", $birthday);
                $stmt->bindParam(":alias", $alias);
                $stmt->bindParam(":sex", $sex);
                $stmt->bindParam(":civil_stat", $civil_stat);
                $stmt->bindParam(":mobile_no", $mobile_no);
                $stmt->bindParam(":email", $email);
                $stmt->bindParam(":religion", $religion);
                $stmt->bindParam(":voter_stat", $voter_stat);
                $stmt->bindParam(":username", $username);
                $stmt->bindParam(":password", $password);
                $stmt->execute();
                
                return $stmt;
            }
            catch (PDOException $e)
            {
                echo $e->getMessage();
            }
        }

        //Function to add official info supplied from parameter
        public function add_official($official_position,$official_first_name,$official_middle_name,$official_last_name,$official_sex,$official_contact_info,$official_username,$official_password)
        {
            try
            {
                $stmt = $this->conn->prepare
                                    (
                                        "INSERT INTO official_info (official_position, official_first_name, official_middle_name, official_last_name, official_sex, official_contact_info, official_username, official_password) 
                                        VALUES (:official_position, :official_first_name, :official_middle_name, :official_last_name, :official_sex, :official_contact_info, :official_username, :official_password)"
                                    );
                $stmt->bindParam(":official_position", $official_position);
                $stmt->bindParam(":official_first_name", $official_first_name);
                $stmt->bindParam(":official_middle_name", $official_middle_name);
                $stmt->bindParam(":official_last_name", $official_last_name);
                $stmt->bindParam(":official_sex", $official_sex);
                $stmt->bindParam(":official_contact_info", $official_contact_info);
                $stmt->bindParam(":official_username", $official_username);
                $stmt->bindParam(":official_password", $official_password);
                $stmt->execute();
                
                return $stmt;
            }
            catch (PDOException $e)
            {
                echo $e->getMessage();
            }
        }

        //Function to add post to database from info supplied from parameter
        public function add_post($post_title,$post_body,$post_date_time)
        {
            try
            {
                $stmt = $this->conn->prepare
                                    (
                                        "INSERT INTO announcement_post ( post_title, post_body, post_date_time) 
                                        VALUES (:post_title, :post_body, :post_date_time)"
                                    );
                
                $stmt->bindParam(":post_title", $post_title);
                $stmt->bindParam(":post_body", $post_body);
                $stmt->bindParam(":post_date_time", $post_date_time);

                $stmt->execute();
                
                return $stmt;
            }
            catch (PDOException $e)
            {
                echo $e->getMessage();
            }
        }

        //Function to edit resident info supplied from parameter
        public function edit_resident($resident_id,$first_name, $middle_name, $last_name, $suffix , $birthday , $alias , $sex , $civil_stat , $mobile_no , $email , $religion , $voter_stat, $username, $password)
        {

            try
            {
                $stmt = $this->conn->prepare
                                    (
                                        "UPDATE resident_info 
                                        SET first_name = :first_name, middle_name = :middle_name, last_name = :last_name,
                                            suffix = :suffix, birthday = :birthday, alias = :alias,
                                            sex = :sex, civil_stat = :civil_stat, mobile_no = :mobile_no,
                                            email = :email, religion = :religion, voter_stat = :voter_stat,
                                            username = :username, password = :password
                                        WHERE resident_id = :resident_id"
                                    );
                
                $stmt->bindParam(":resident_id", $resident_id);

                $stmt->bindParam(":first_name", $first_name);
                $stmt->bindParam(":middle_name", $middle_name);
                $stmt->bindParam(":last_name", $last_name);
                $stmt->bindParam(":suffix", $suffix);
                $stmt->bindParam(":birthday", $birthday);
                $stmt->bindParam(":alias", $alias);
                $stmt->bindParam(":sex", $sex);
                $stmt->bindParam(":civil_stat", $civil_stat);
                $stmt->bindParam(":mobile_no", $mobile_no);
                $stmt->bindParam(":email", $email);
                $stmt->bindParam(":religion", $religion);
                $stmt->bindParam(":voter_stat", $voter_stat);
                $stmt->bindParam(":username", $username);
                $stmt->bindParam(":password", $password);
                $stmt->execute();
                return $stmt;
            }
            catch(PDOException $e)
            {
                echo $e->getMessage();
            }
        }

        //Function to edit offical info supplied from parameter
        public function edit_official($official_id,$official_position,$official_first_name, $official_middle_name, $official_last_name, $official_sex , $official_contact_info , $official_username , $official_password )
        {
            try
            {
                $stmt = $this->conn->prepare
                                    (
                                        "   UPDATE  official_info 
                                            SET     official_position = :official_position, official_first_name = :official_first_name, official_middle_name = :official_middle_name,
                                                    official_last_name = :official_last_name, official_sex = :official_sex, official_contact_info = :official_contact_info,
                                                    official_username = :official_username, official_password = :official_password
                                            WHERE   official_id = :official_id"
                                    );
                $stmt->bindParam(":official_id", $official_id);
                $stmt->bindParam(":official_position", $official_position);
                $stmt->bindParam(":official_first_name", $official_first_name);
                $stmt->bindParam(":official_middle_name", $official_middle_name);
                $stmt->bindParam(":official_last_name", $official_last_name);
                $stmt->bindParam(":official_sex", $official_sex);
                $stmt->bindParam(":official_contact_info", $official_contact_info);
                $stmt->bindParam(":official_username", $official_username);
                $stmt->bindParam(":official_password", $official_password);
                
                $stmt->execute();
                return $stmt;
            }
            catch(PDOException $e)
            {
                echo $e->getMessage();
            }
        }

        //Function to edit post info supplied from parameter
        public function edit_post($post_id,$post_title,$post_body, $post_date_time)
        {
            try
            {
                $stmt = $this->conn->prepare
                                    (
                                        "   UPDATE  announcement_post 
                                            SET     post_title = :post_title, post_body = :post_body, post_date_time = :post_date_time
                                            WHERE   post_id = :post_id
                                        "
                                    );
                $stmt->bindParam(":post_id", $post_id);
                $stmt->bindParam(":post_title", $post_title);
                $stmt->bindParam(":post_body", $post_body);
                $stmt->bindParam(":post_date_time", $post_date_time);
                $stmt->execute();
                return $stmt;
            }
            catch(PDOException $e)
            {
                echo $e->getMessage();
            }
        }

        //Function to delete resident info supplied from parameter
        public function delete_resident($resident_id)
        {
            try
            {
                $stmt = $this->conn->prepare("DELETE FROM resident_info WHERE resident_id = :resident_id");
                $stmt->bindparam(":resident_id", $resident_id);
                $stmt->execute();
                return $stmt;

            }
            catch(PDOException $e)
            {
                  echo $e->getMessage();
            }
        }

        //Function to delete official info supplied from parameter
        public function delete_official($official_id)
        {
            try
            {
                $stmt = $this->conn->prepare("DELETE FROM official_info WHERE official_id = :official_id");
                $stmt->bindparam(":official_id", $official_id);
                $stmt->execute();
                return $stmt;

            }
            catch(PDOException $e)
            {
                  echo $e->getMessage();
            }
        }

        //Function to delete post info supplied from parameter
        public function delete_post($post_id)
        {
            try
            {
                $stmt = $this->conn->prepare
                                    (
                                        "DELETE FROM announcement_post WHERE post_id = :post_id"
                                    );
                $stmt->bindParam(":post_id", $post_id);
                $stmt->execute();
                return $stmt;
            }
            catch(PDOException $e)
            {
                echo $e->getMessage();
            }
        }

        //Function to delete document info supplied from parameter
        public function delete_document($id)
        {
            try
            {
                $stmt = $this->conn->prepare
                                    (
                                        "DELETE FROM documents WHERE id = :id"
                                    );
                $stmt->bindParam(":id", $id);
                $stmt->execute();
                return $stmt;
            }
            catch(PDOException $e)
            {
                echo $e->getMessage();
            }
        }

        //Function to delete document file from directory info supplied from parameter
        public function delete_document_file($filename)
        {
            $path = 'documents/'.$filename;
            if(unlink($path))
            {
                return true;
            }
            else
            {
                return false;
            }
           
            
        }

        //Function to upload documents
        public function upload_documents($file, $destination, $filename,  $description, $date_time, $directory)
        {
            try
            {
                if (move_uploaded_file($file, $destination)) 
                {
                    $stmt = $this->conn->prepare("INSERT INTO documents 
                                                        VALUES ('', ?, ?, ?, ? )");
                    $stmt->bindParam(1, $filename);
                    $stmt->bindParam(2, $description);
                    $stmt->bindParam(3, $date_time);
                    $stmt->bindParam(4, $directory);
                    $stmt->execute();
                    $this->redirect('admin_Documents.php?documentUploaded'); 
                } 
                else 
                {
                    $this->redirect('admin_Documents.php?documentUploadFailed'); 
                }
            }
            catch(PDOException $e)
            {
                echo $e->getMessage();
            }
        }

        
        



    }


?>