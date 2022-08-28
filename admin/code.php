

<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.4.10/dist/sweetalert2.min.css">

<?php
include('authentication.php');
require 'functions.php';

if (isset($_POST['device_update'])) {
    $device_id = $_POST['id'];
    $device_name = $_POST['device_name'];
    $device_type = $_POST['device_type'];
    $device_io = $_POST['device_io'];
    $device_status = $_POST['device_status']; 
    $device_location = $_POST['device_location'];
    $node_id = $_POST['node_id'];
    $node_pin = $_POST['node_pin'];

    $query = "UPDATE tc_device SET device_name='$device_name',device_type='$device_type',device_io='$device_io',device_status='$device_status',device_location='$device_location',node_id='$node_id',node_pin='$node_pin' WHERE id='$device_id' ";
    $query_run = mysqli_query($con, $query);
    if ($query_run) {
        $_SESSION['message'] = "Edite Device Successfully";
        header('Location: device-edit.php');
        exit(0);
    } else {
        $_SESSION['message'] = "Someting went wrong.!";
        header('Location: device-edit.php');
        exit(0);
    }
}

//=======================================================================


if (isset($_POST['device_delete_btn'])) {

    $device_id = $_POST['device_delete_btn'];

    $check_query = "SELECT * FROM tc_device WHERE id='$device_id' AND device_status= 0 ";
    $check_query_run = mysqli_query($con,$check_query);

    $res_data = mysqli_fetch_array($check_query_run);
    $table_name = $res_data['table_name'];

//====
    if(mysqli_num_rows($check_query_run) > 0 ){

        $result = mysqli_query($con, "DROP TABLE $table_name");
        // if (!$result) echo "Table $table_name deletion unsuccessfully<br> ";  


    $query = "DELETE FROM tc_device WHERE id='$device_id' LIMIT 1";
    $query_run = mysqli_query($con, $query);

    if ($query_run) {



        $_SESSION['message'] = "Device Deleted Successfully";
        header("Location: device-view.php");
        exit(0);
    } else {
        $_SESSION['message'] = "Someting went wrong.!";
        header("Location: device-view.php");
        exit(0);
    }


    }
    else
    {
        $_SESSION['message'] = "Device status still Enabled.!";
        header("Location: device-view.php");
        exit(0);



  }
}

//=======================================================================

if (isset($_POST['device_add'])) {
    $node_id = $_POST['node_id'];
    $node_pin = $_POST['node_pin'];
    $device_type = $_POST['device_type'];
    $device_io = $_POST['device_io'];
    $device_name = $_POST['device_name'];
    $device_location = $_POST['device_location'];

    $itemp = $device_io == '1' ? 'input' : 'output';
    $table_name = "data_" . $device_name . "_" . $itemp;
    $table_name = str_replace(' ', '', $table_name);

    $check_query = "SELECT device_name FROM tc_device WHERE device_name='$device_name' ";
    $check_query_run = mysqli_query($con,$check_query);

//====
    if(mysqli_num_rows($check_query_run) > 0 ){
        $_SESSION['message'] = "Device Name already in used .Please try another name.!";
        header("Location: device-add.php");
        exit(0);
    }else{

    $query = "INSERT INTO tc_device (device_name,device_type,device_io,device_location,node_id,node_pin,table_name) 
             VALUES ('$device_name','$device_type','$device_io','$device_location','$node_id','$node_pin','$table_name')";

    $query_run = mysqli_query($con, $query);
    if ($query_run) {

        // Create Teble 

        $itemp = $device_io == '1' ? 'input' : 'output';
        $table_name = "data_" . $device_name . "_" . $itemp;
        $table_name = str_replace(' ', '', $table_name);

        // Attempt create table query execution
        $sql = "CREATE TABLE $table_name(
            id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
            val1 VARCHAR(200) NOT NULL,
            val2 VARCHAR(200) NOT NULL,
            val3 VARCHAR(30) NOT NULL,
            val4 VARCHAR(30) NOT NULL,
            val5 VARCHAR(30) NOT NULL,
            val6 VARCHAR(30) NOT NULL,
            val7 VARCHAR(30) NOT NULL,
            val8 VARCHAR(30) NOT NULL,
            val9 VARCHAR(70) NOT NULL
        )";

        if (mysqli_query($con, $sql)) {
            echo "Table created successfully.";
        } else {
            echo "ERROR: Could not able to execute $sql. " . mysqli_error($con);
        }


        $_SESSION['message'] = "Add Device Successfully";
        header('Location: device-add.php');
        exit(0);
    } else {
        $_SESSION['message'] = "Someting went wrong.!";
        header('Location: device-add.php');
        exit(0);
    }
  }
}


//=======================================================================

if (isset($_POST['node_delete_btn'])) {
    $node_id = $_POST['node_delete_btn'];

    $check_query = "SELECT * FROM tc_device WHERE node_id='$node_id' ";
    $check_query_run = mysqli_query($con,$check_query);

//====
    if(mysqli_num_rows($check_query_run) > 0 ){
        $_SESSION['message'] = "Node still coonect to some device.!";
        header("Location: node-view.php");
        exit(0);
    }
    else
    {

        $query = "DELETE FROM tc_node WHERE id='$node_id' LIMIT 1";
        $query_run = mysqli_query($con, $query);

        if ($query_run) {

            $_SESSION['message'] = "Node Deleted Successfully";
            header("Location: node-view.php");
            exit(0);
        } else {
            $_SESSION['message'] = "Someting went wrong.!";
            header("Location: node-view.php");
            exit(0);
        }
    }
}

//=======================================================================

if (isset($_POST['node_update'])) {
    $myid = $_POST['id'];
    $node_id = $_POST['node_id'];
    $node_name = $_POST['node_name'];
    $node_type = $_POST['node_type'];
    $node_location = $_POST['node_location'];
    $node_ip = "0.0.0.0";
    $node_mac = "0.0.0.0";

    $query = "UPDATE tc_node SET node_name='$node_name',node_location='$node_location' WHERE id='$myid' ";
    $query_run = mysqli_query($con, $query);

    if ($query_run) {
        $_SESSION['message'] = "Update Node MCU Successfully";
        header('Location: node-view.php');
        exit(0);
    }
}

//=======================================================================

if (isset($_POST['node_add'])) {
    $node_id = $_POST['node_id'];
    $node_name = $_POST['node_name'];
    $node_type = $_POST['mymodelname'];
    $node_location = $_POST['node_location'];
    $node_ip = "0.0.0.0";
    $node_mac = "0.0.0.0";


    $check_query = "SELECT node_name FROM tc_node WHERE node_name='$node_name' ";
    $check_query_run = mysqli_query($con,$check_query);

//====
    if(mysqli_num_rows($check_query_run) > 0 ){
        $_SESSION['message'] = "This name already in used .Please try another name.!";
        header("Location: node-add.php");
        exit(0);
    }else{


    $query = "INSERT INTO tc_node (node_name,node_id,node_type,node_location,node_ip,node_mac) 
             VALUES ('$node_name','$node_id','$node_type','$node_location','$node_ip','$node_mac')";

    $query_run = mysqli_query($con, $query);
    if ($query_run) {
        $_SESSION['message'] = "Add Node MCU Successfully";
        header('Location: node-add.php');
        exit(0);
    } else {
        $_SESSION['message'] = "Someting went wrong.!";
        header('Location: node-add.php');
        exit(0);
    }
   }  
}

//=======================================================================

if (isset($_POST['post_delete_btn'])) {
    $post_id = $_POST['post_delete_btn'];

    $check_img_query = "SELECT * FROM posts WHERE id='$post_id' LIMIT 1";
    $img_res = mysqli_query($con, $check_img_query);
    $res_data = mysqli_fetch_array($img_res);
    $image = $res_data['image'];

    $query = "DELETE FROM posts WHERE id='$post_id' LIMIT 1";
    $query_run = mysqli_query($con, $query);

    if ($query_run) {
        if (file_exists('../uploads/posts/' . $image)) {
            unlink("../uploads/posts/" . $image);
        }

        $_SESSION['message'] = "Post Deleted Successfully";
        header("Location: post-view.php");
        exit(0);
    } else {
        $_SESSION['message'] = "Someting went wrong.!";
        header("Location: post-view.php");
        exit(0);
    }
}

//=======================================================================

if (isset($_POST['post_update'])) {
    $post_id = $_POST['post_id'];

    $category_id = $_POST['category_id'];
    $name = $_POST['name'];
    $slug = $_POST['slug'];
    $description = $_POST['description'];

    $meta_title = $_POST['meta_title'];
    $meta_description = $_POST['meta_description'];
    $meta_keyword = $_POST['meta_keyword'];

    $navbar_status = $_POST['navbar_status'] == true ? '1' : '0';
    $status = $_POST['status'] == true ? '1' : '0';


    $old_filename = $_POST['old_image'];
    $image = $_FILES['image']['name'];

    $update_filename = NULL;
    if ($image != NULL) {
        //rename this Image
        $image_extension = pathinfo($image, PATHINFO_EXTENSION);
        $filename = time() . '.' . $image_extension;
        $update_filename = $filename;
    } else {
        $update_filename = $old_filename;
    }

    $status = $_POST['status'] == true ? '1' : '0';


    $query = "UPDATE posts SET category_id='$category_id',name='$name',slug='$slug',description='$description',image='$update_filename',
                    meta_title='$meta_title',meta_description='$meta_description',meta_keyword='$meta_keyword',
                    status='$status' WHERE id='$post_id' ";

    $query_run = mysqli_query($con, $query);

    if ($query_run) {
        if ($image != NULL) {
            if (file_exists('../uploads/posts/' . $old_filename)) {
                unlink("../uploads/posts/" . $old_filename);
            }
            move_uploaded_file($_FILES['image']['tmp_name'], '../uploads/posts/' . $update_filename);
        }

        $_SESSION['message'] = "Post Updated Successfully";
        header('Location: post-edit.php?id=' . $post_id);
        exit(0);
    } else {
        $_SESSION['message'] = "Someting went wrong.!";
        header('Location: post-edit.php?id=' . $post_id);
        exit(0);
    }
}

//=======================================================================

if (isset($_POST['post_add'])) {
    $category_id = $_POST['category_id'];
    $name = $_POST['name'];
    $slug = $_POST['slug'];
    $description = $_POST['description'];

    $meta_title = $_POST['meta_title'];
    $meta_description = $_POST['meta_description'];
    $meta_keyword = $_POST['meta_keyword'];

    $navbar_status = $_POST['navbar_status'] == true ? '1' : '0';
    $status = $_POST['status'] == true ? '1' : '0';

    $image = $_FILES['image']['name'];
    //rename this Image
    $image_extension = pathinfo($image, PATHINFO_EXTENSION);
    $filename = time() . '.' . $image_extension;

    $status = $_POST['status'] == true ? '1' : '0';

    $query = "INSERT INTO posts (category_id,name,slug,description,image,meta_title,meta_description,meta_keyword,status) 
             VALUES ('$category_id','$name','$slug','$description','$filename','$meta_title','$meta_description','$meta_keyword','$status')";

    $query_run = mysqli_query($con, $query);
    if ($query_run) {
        move_uploaded_file($_FILES['image']['tmp_name'], '../uploads/posts/' . $filename);

        $_SESSION['message'] = "Post Created Successfully";
        header('Location: post-add.php');
        exit(0);
    } else {
        $_SESSION['message'] = "Someting went wrong.!";
        header('Location: post-add.php');
        exit(0);
    }
}

//=======================================================================

if (isset($_POST['category_delete'])) {
    $category_id = $_POST['category_delete'];
    $query = "UPDATE categories SET status='2' WHERE id='$category_id' LIMIT 1";
    $query_run = mysqli_query($con, $query);

    if ($query_run) {
        $_SESSION['message'] = "Category Deleted Successfully";
        header("Location: category-view.php");
        exit(0);
    } else {
        $_SESSION['message'] = "Someting went wrong.!";
        header("Location: category-view.php");
        exit(0);
    }
}

//=======================================================================

if (isset($_POST['category_update'])) {
    $category_id = $_POST['category_id'];
    $name = $_POST['name'];
    $slug = $_POST['slug'];
    $description = $_POST['description'];

    $meta_title = $_POST['meta_title'];
    $meta_description = $_POST['meta_description'];
    $meta_keyword = $_POST['meta_keyword'];

    $navbar_status = $_POST['navbar_status'] == true ? '1' : '0';
    $status = $_POST['status'] == true ? '1' : '0';

    $query = "UPDATE categories SET name='$name',slug='$slug',description='$description',meta_title='$meta_title',
               meta_description='$meta_description',meta_keyword='$meta_keyword',navbar_status='$navbar_status',
               status='$status' WHERE id='$category_id' ";

    $query_run = mysqli_query($con, $query);

    if ($query_run) {
        $_SESSION['message'] = "Category Updated Successfully";
        header('Location: category-edit.php?id=' . $category_id);
        exit(0);
    } else {
        $_SESSION['message'] = "Someting went wrong.!";
        header('Location: category-edit.php?id=' . $category_id);
        exit(0);
    }
}

//=======================================================================

if (isset($_POST['category_add'])) {
    $name = $_POST['name'];
    $slug = $_POST['slug'];
    $description = $_POST['description'];

    $meta_title = $_POST['meta_title'];
    $meta_description = $_POST['meta_description'];
    $meta_keyword = $_POST['meta_keyword'];

    $navbar_status = $_POST['navbar_status'] == true ? '1' : '0';
    $status = $_POST['status'] == true ? '1' : '0';

    $check_query = "SELECT node_name FROM categories WHERE name='$name' ";
    $check_query_run = mysqli_query($con,$check_query);

//====
    // if(mysqli_num_rows($check_query_run) > 0 ){
    //     $_SESSION['message'] = "This name already created.Please try another name.!";
    //     header("Location: category-add.php");
    //     exit(0);
    // }else{

        $query = "INSERT INTO categories (name,slug,description,meta_title,meta_description,meta_keyword,navbar_status,status) VALUES 
        ('$name','$slug','$description','$meta_title','$meta_description','$meta_keyword','$navbar_status','$status')";

        $query_run = mysqli_query($con, $query);

        if ($query_run) {
        $_SESSION['message'] = "Category Added Successfully";
        header("Location: category-add.php");
        exit(0);
        } else {
        $_SESSION['message'] = "Someting went wrong.!";
        header("Location: category-add.php");
        exit(0);
        }


    // }



//=====


}
//=======================================================================

if (isset($_POST['user_delete'])) {

    $user_id = $_POST['user_delete'];
    $check_query = "SELECT * FROM users WHERE id='$user_id' AND status= 0 ";
    $check_query_run = mysqli_query($con,$check_query);

//====
    if(mysqli_num_rows($check_query_run) > 0 ){



        
    // <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    // <script>
    //     Swal.fire('Any fool can use a computer')
    // </script>



        echo "<script>";
        echo "Swal.fire('Any fool can use a computer')";
        echo "</script>";

        // $query = "DELETE FROM users WHERE id='$user_id' ";
        // $query_run = mysqli_query($con, $query);
    
        // if ($query_run) {
    
            $_SESSION['message'] = "User/Admin Deleted Successfully";
            header("Location: view-register.php");
            exit(0);
        // } else {
        //     $_SESSION['message'] = "Someting went wrong.!";
        //     header("Location: view-register.php");
        //     exit(0);
        // }





    }
    else
    {


        echo "<script>";
        echo "Swal.fire('Any fool can use a computer')";
        echo "</script>";



        $_SESSION['message'] = "User still in activated.!";
        header("Location: view-register.php");
        exit(0);

   }
}

//=======================================================================

if (isset($_POST['add_user'])) {
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $role_as = $_POST['role_as'];
    $status = $_POST['status'] == true ? '1' : '0';

    $query = "INSERT INTO users (fname,lname,email,password,role_as,status) VALUE ('$fname','$lname','$email','$password','$role_as','$status')";
    $query_run = mysqli_query($con, $query);

    if ($query_run) {
        $_SESSION['message'] = "Admin/User Added Successfully";
        header("Location: view-register.php");
        exit(0);
    } else {
        $_SESSION['message'] = "Someting went wrong.!";
        header("Location: view-register.php");
        exit(0);
    }
}

//=======================================================================

if (isset($_POST['update_user'])) {

    $user_id = $_POST['user_id'];
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $role_as = $_POST['role_as'];
    $status = $_POST['status'] ;

    $query = "UPDATE users SET fname='$fname',lname='$lname',email='$email',password='$password',role_as='$role_as',status='$status'
         WHERE id='$user_id'  ";
    $query_run = mysqli_query($con, $query);

    if ($query_run) {

        $_SESSION['message'] = "Updated successfully";
        header("Location: view-register.php");
        exit(0);

    }
}



