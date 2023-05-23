<?php

    class Config {
        private $HOST = "localhost";
        private $USERNAME = "root";
        private $PASSWORD = "";
        private $DB_NAME = "demo";
        private $STUDENTS_TABLE = "students";
        private $USERS_TABLE = "users";
        private $CATEGORIES_TABLE = "categories";
        private $SUBCATEGORIES_TABLE = "subcategories";
        public $conn;

        public function connect() {
            $this->conn = mysqli_connect($this->HOST, $this->USERNAME, $this->PASSWORD, $this->DB_NAME);  

            return $this->conn; // bool
        }

        public function insert_student($name, $age, $course, $image) {
            $this->connect();

            $query = "INSERT INTO $this->STUDENTS_TABLE(name, age, course, image) VALUES('$name', $age, '$course', '$image');";

            $res = mysqli_query($this->conn, $query);  

            return $res;  // bool
        }

        public function fetch_all_students(){
            $this->connect();

            $query = "SELECT * FROM $this->STUDENTS_TABLE;";

            $res = mysqli_query($this->conn, $query);

            return $res;   // object of mysqli_result class
        }

        public function delete_student($id) {
            $this->connect();

            $qs = "SELECT * FROM $this->STUDENTS_TABLE WHERE id=$id;";

            $obj = mysqli_query($this->conn, $qs);

            $fetched_record = mysqli_fetch_assoc($obj);

            $isFileRemoved = unlink('uploads/' . $fetched_record['image']);   // returns bool

            $query = "DELETE FROM $this->STUDENTS_TABLE WHERE id=$id;";

            if($isFileRemoved) {
                $res = mysqli_query($this->conn, $query);
            } else {
                return false;
            }

            return $res;  // total no. of deleted records
        }

        public function fetch_single_student($id) {
            $this->connect();

            $query = "SELECT * FROM $this->STUDENTS_TABLE WHERE id=$id;";

            $res = mysqli_query($this->conn, $query);

            return $res;
        }

        public function update_student($name, $age, $course, $id) {
            $this->connect();

            $query = "UPDATE $this->STUDENTS_TABLE SET name='$name', age=$age, course='$course' WHERE id=$id;";

            $res = mysqli_query($this->conn, $query);

            return $res;  // total no. of updated records
        }

        public function signup_user($username, $email, $password) {
            $this->connect();

            // password_hash(raw_password, algo);     algo => PASSWORD_DEFAULT

            $hashed_password = password_hash($password, PASSWORD_DEFAULT);

            $query = "INSERT INTO $this->USERS_TABLE(username, email, password) VALUES('$username', '$email', '$hashed_password');";
        
            $res = mysqli_query($this->conn, $query);

            return $res;        
        }

        public function signin_user($username, $password) {
            $this->connect();

            $query = "SELECT * FROM $this->USERS_TABLE WHERE username='$username';";

            $res = mysqli_query($this->conn, $query);  // obj of mysqli_result class

            $record = mysqli_fetch_assoc($res);

            if($record) {

                // password_verify(raw_password, hashed_password);   => return bool

                $isVerified = password_verify($password, $record['password']);

                return $isVerified;  // true or false

            } else {
                return false;
            }
        }

        public function add_category($name) {
            $this->connect();

            $query = "INSERT INTO $this->CATEGORIES_TABLE(name) VALUES('$name');";

            $res = mysqli_query($this->conn, $query);

            return $res;
        }

        public function add_subcategory($name, $cat_id) {
            $this->connect();

            $qs = "SELECT * FROM $this->CATEGORIES_TABLE WHERE id=$cat_id";

            $obj = mysqli_query($this->conn, $qs);

            $record = mysqli_fetch_assoc($obj);

            if($record) {
                $query = "INSERT INTO $this->SUBCATEGORIES_TABLE(name, cat_id) VALUES('$name', $cat_id);";

                $res = mysqli_query($this->conn, $query);

                return $res;        
            } else {
                return false;
            }
            
        }

    }

?>