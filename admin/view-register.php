<?php
include('authentication.php');
include('includes/header.php');
?>
<div class="container-fluid px-4">
    <h1 class="mt-4">User</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item active">Dashboard</li>
        <li class="breadcrumb-item ">Users</li>
    </ol>
    <div class="row">
        <div class="col-md-12">

            <?php include('message.php'); ?>

            <div class="card">
                <div class="card-header">
                    <h4>Registered User</h4>
                    <a href="register-add.php" class="btn btn-primary float-end">Add Admin</a>
                </div>
                <div class="card-body">
                    <table class="table table-borderd">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>First Name</th>
                                <th>Last Name</th>
                                <th>Email</th>
                                <th>Roles</th>
                                <th>Edit</th>
                                <th>Delete</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $query = "SELECT * FROM users";
                            $query_run = mysqli_query($con, $query);

                            if (mysqli_num_rows($query_run) > 0) {
                                foreach ($query_run as $row) {
                            ?>
                                    <tr>
                                        <td><?= $row['id']; ?></td>
                                        <td><?= $row['fname']; ?></td>
                                        <td><?= $row['lname']; ?></td>
                                        <td><?= $row['email']; ?></td>
                                        <td>
                                            <?php
                                            if ($row['role_as'] == '1') {
                                                echo 'Admin';
                                            } else {
                                                echo 'User';
                                            }
                                            ?>
                                        </td>
                                        <td><a href="register-edit.php?id=<?= $row['id']; ?>" class="btn btn-sm btn-outline-primary py-0">Edit</a></td>

                                        <td>
                                            <form action="code.php" method="POST">
                                                <!-- <input type="hidden" name="id" value="<?= $user['id']; ?>"> -->
                                                <button type="submit" name="user_delete" value="<?= $row['id']; ?>" class="btn btn-sm btn-outline-danger py-0">Delete</a>
                                            </form>

                                        </td>

                                    </tr>
                                <?php
                                }
                            } else {
                                ?>
                                <tr>
                                    <td colspan="6">No Record Found</td>
                                </tr>
                            <?php
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>



    <?php
    include('includes/footer.php');
    include('includes/scripts.php');
    ?>

