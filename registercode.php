<?php
session_start();
    include('admin/config/dbcon.php');

    IF(isset($_POST['register_btn'])){
        $fname = mysqli_real_escape_string($con,$_POST['fname']);
        $lname = mysqli_real_escape_string($con,$_POST['lname']);
        $email = mysqli_real_escape_string($con,$_POST['email']);
        $password = mysqli_real_escape_string($con,$_POST['password']);
        $confirm_password = mysqli_real_escape_string($con,$_POST['cpassword']);
        
        if($password == $confirm_password){

            $checkemail = "SELECT email FROM users WHERE email= '$email'";
            $checkemail_run = mysqli_query($con,$checkemail);

            if(mysqli_num_rows($checkemail_run) > 0){
                //Already email exists
                $_SESSION['message'] = "Already Email Exists";
                header("Location: register.php");
                exit(0);
            }else{
                $user_query = "INSERT INTO users (fname,lname,email,password) VALUE('$fname','$lname','$email','$password')";
                $user_query_run = mysqli_query($con,$user_query);

                if($user_query_run){
                    $_SESSION['message'] = "Register Successfully";
                    header("Location: login.php");
                    exit(0);
                }else{
                    $_SESSION['message'] = "Somthing went wrong !";
                    header("Location: register.php");
                    exit(0);
                }
            }
        }else{
            $_SESSION['message'] = "Password and Confirm Password does not math";
            header("Location: register.php");
        }

    }else{
        header("Location: register.php");
        exit(0);

    }
