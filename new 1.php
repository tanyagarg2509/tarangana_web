<?php
// !preg_match(@"^[0-9]{10}$",$phone_number)

include 'config.php';

$fname=$_POST["fname"];
$lname=$_POST["lname"];
$email=$_POST["email"];
$dob=$_POST['dob'];
$maritalstatus=$_POST["maritalstatus"];
$religion=$_POST["religion"];
$city=$_POST["city"];
$sex=$_POST['sex'];
$mobile=$_POST["phoneno"];
$pass=$_POST["password"];
$occupation=$_POST["occupation"];
$image =$_FILES['image']['name'];

if (empty($fname) ||empty($email) ||empty($sex) || empty($mobile) || empty($pass) || empty($dob) ||empty($maritalstatus) ||empty($religion) ||empty($city)) {
    header("Location: login.php?signup=empty");
    exit();
}
else
{
    //check if inputs characters are valid
    if (!preg_match("/^[a-zA-Z]*$/", $fname) || !preg_match("/^[a-zA-Z]*$/", $lname)) {
        header("Location: login.php?signup=invalid");
        exit();
    }
    else
    {
        //check if email is valid
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            header("Location: login.php?signup=email");
            exit();
        }
        else
        {
            $sql = "select * from users where email ='$email'";
            $result=mysqli_query($conn,$sql);
            $resultCheck=mysqli_num_rows($result);

            if ($resultCheck>0) {
                header("Location: login.php?signup=usertaken");
                exit();
            }
            else
            {
                $target = "images/".basename($image);
                $sql = "Insert into users (firstname,lastname, email, password, mobile, sex, maritalstatus, occupation, dob, city, religion,image) values ('$fname', '$lname', '$email', '$pass', '$mobile' ,'$sex','$maritalstatus','$occupation','$dob','$city','$religion','$image');";
                $result=mysqli_query($conn, $sql);
                if (move_uploaded_file($_FILES['image']['tmp_name'], $target)) {
                    $msg = "Image uploaded successfully";
                }else{
                    $msg = "Failed to upload image";
                }
                header("Location: login.php?signup=success");
                exit();
            }
        }
    }
}

?>