<?php

    include('config/config.php');

    $config = new Config();

    $fetched_students_obj = $config->fetch_all_students();

    if(isset($_REQUEST['btn_add'])) {
        $name = $_REQUEST['name'];
        $age = $_REQUEST['age'];
        $course = $_REQUEST['course'];

        $res = $config->insert_student($name, $age, $course);

        if($res) {
            header("Location: success.php");
        } else {
            echo "Student insertion failed...";
        }
    }

    if(isset($_REQUEST['delete_id'])) {
        $delete_id = $_REQUEST['delete_id'];
        
        $res = $config->delete_student($delete_id);

        if($res == 1) {
            echo "Deleted suucessfull...";
        } else {
            echo "Deletion failed...";
        }
        
    }

    $single_fetched_student = null;

    if(isset($_REQUEST['edit_id'])) {
        $edit_id = $_REQUEST['edit_id'];

        $obj = $config->fetch_single_student($edit_id);

        $single_fetched_student = mysqli_fetch_assoc($obj);

    }

     if(isset($_REQUEST['btn_update'])) {
        $name = $_REQUEST['name'];
        $age = $_REQUEST['age'];
        $course = $_REQUEST['course'];
        $edit_id = $_REQUEST['edit_id'];

        $res = $config->update_student($name, $age, $course, $edit_id);

        if($res) {
            echo "Student info updated...";
        } else {
            echo "Student info updation failed...";
        }
    }

?>


<html>
    <head>
        <title>Home Page</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">

    </head>
    <body>
    
        <div class="container mt-5">
            <div class="col col-4">
                <form action="" method="POST">
                    Name: <input class="form-control" name="name" type="text" value="<?php if($single_fetched_student!=null) { echo $single_fetched_student['name']; } ?>" /> <br />
                    Age: <input class="form-control" name="age" type="number" value="<?php if($single_fetched_student!=null) { echo $single_fetched_student['age']; } ?>" /> <br />
                    Course: <input class="form-control" name="course" type="text" value="<?php if($single_fetched_student!=null) { echo $single_fetched_student['course']; } ?>" /> <br />

                    <button class="btn <?php if(@$_REQUEST['edit_id']) { echo "btn-info"; } else { echo "btn-primary"; } ?>" name="<?php if(@$_REQUEST['edit_id']) { echo "btn_update"; } else { echo "btn_add"; } ?>">
                        <?php if(@$_REQUEST['edit_id']) { echo "UPDATE"; } else { echo "ADD"; } ?>
                    </button>
                </form> 
            </div>

            <div class="col col-6">
                <table class="table table-hover table-bordered">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Age</th>
                            <th>Course</th>
                            <th colspan="2">Action</th>
                        </tr>
                    </thead>
                    <tbody>

                    <?php while($record = mysqli_fetch_assoc($fetched_students_obj)) { ?>
                        <tr>
                            <td><?php echo $record['id']; ?></td>
                            <td><?php echo $record['name']; ?></td>
                            <td><?php echo $record['age']; ?></td>
                            <td><?php echo $record['course']; ?></td>
                            <td>
                                <a href="index.php?edit_id=<?php echo $record['id']; ?>">
                                    <button class="btn btn-warning">EDIT</button>
                                </a>
                            </td>
                            <td>
                                <a href="index.php?delete_id=<?php echo $record['id']; ?>">
                                    <button class="btn btn-danger">DELETE</button>
                                </a>
                            </td>
                        </tr>
                    <?php } ?>
                    
                    </tbody>
                </table>
            </div>
        </div>       

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>

    </body>
</html>