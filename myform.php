<?php
$error=array();
$team_name = $team_leader = $email = $phone_no = $no_of_members = "";
if ($_SERVER["REQUEST_METHOD"] == "POST") 
{
	if(isset($_POST["team_name"])!='' && isset($_POST["email"])!='' && isset($_POST["phone_no"])!='' && isset($_POST["no_of_members"])!='' && isset($_POST["team_leader"])!='')
	{
        $team_name=$_POST["team_name"]; 
        $team_leader=$_POST["team_leader"];
        $phone_no=$_POST["phone_no"];
        $no_of_members=$_POST["no_of_members"];
        $email=$_POST["email"];

        if (!preg_match("/^[a-zA-Z ]*$/",$team_name)) 
        {
            array_push($error,"Only letters and white space allowed");   
            $team_name=""; 
        }
        if (!preg_match("/^[a-zA-Z ]*$/",$team_leader)) 
        {
            array_push($error,"Only letters and white space allowed");   
            $team_leader=""; 
        }
        if(!filter_var($email, FILTER_VALIDATE_EMAIL))
        {
            array_push($error,"Invalid email format"); 
            $email="";   
        }
        if(!preg_match("/^[0-9]{10}$/",$phone_no))
        {
            array_push($error,"enter the valid phone number"); 
            $phone_no="";   
        }
        if(count($error)==0){

            include 'connect.php';
            $sql = "select * from tarangana where team_name ='$team_name'";
            $result=mysqli_query($conn, $sql);
            $resultCheck=mysqli_num_rows($result);
            if ($resultCheck > 0) {
                array_push($error,'Team Name already Registered');
            }

            else{
                $sql = "INSERT INTO `tarangana` (`team_name`, `team_leader`, `no_of_members`, `email`, `phone_no`) VALUES ('$team_name', '$team_leader','$no_of_members', '$email','$phone_no')";
                $result=mysqli_query($conn, $sql);
				if(!$result)
				{
                   array_push($error,"Something Went Wrong try again after sometime");
                }
            }
        }
    }
    else{
        array_push($error,"All Fields are mandatory");
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
    <script>
        $(document).ready(function(){
            $(".close").click(function(){
                $("#myAlert").alert("close");
            });
        });
    </script>
    <style>
        header {
        color: white;
        background-color:#0C1446;
        padding:20px;
        text-align: center;
        font-weight: bolder;
        border-bottom: 2px solid black;
        }
        body{
            color:white;
            /* background-color:#DBF5F0; */
        }
        .myformContainer{
            display:flex;
            justify-content: center;
            align-items: center;
            border-radius:10px;
        }
        form{
            margin:20px;
            border-radius:10px;
            background-color:#0C1446;
            box-shadow: 0 4px 8px 0 #175873;
            padding:30px 20px;
            width:50%;
        }
        label{
            font-size:18px;
        }
        .form-control{
            height:40px;
        }
        .radio{
            margin-left:10px;
        }
        .radio label
        {
            font-size:15px;
        }
        input[type=submit]
        {
            display:block;
            text-transform:uppercase;
            padding:5px 20px;
            margin:auto;
        }
        .myalert{
            margin-top:10px;
        }
        @media screen and (max-width: 750px) {
            form{
            width:100%;
            }
        }
        .alert{
            animation: shake 0.5s;
            animation-iteration-count: 1;
        }
        @keyframes shake {
            0% { transform: translate(1px, 1px) rotate(0deg); }
            10% { transform: translate(-1px, -2px) rotate(-1deg); }
            20% { transform: translate(-3px, 0px) rotate(1deg); }
            30% { transform: translate(3px, 2px) rotate(0deg); }
            40% { transform: translate(1px, -1px) rotate(1deg); }
            50% { transform: translate(-1px, 2px) rotate(-1deg); }
            60% { transform: translate(-3px, 1px) rotate(0deg); }
            70% { transform: translate(3px, 1px) rotate(-1deg); }
            80% { transform: translate(-1px, -1px) rotate(1deg); }
            90% { transform: translate(1px, 2px) rotate(0deg); }
            100% { transform: translate(1px, -2px) rotate(-1deg); }
        }
    </style>
    <title>TAARANGANA</title>
    
</head>
<body>
    <header class="container-fluid">
    <h1>TAARANGANA REGISTRATION FORM</h1>
    </header>

    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        echo '<div class="myalert">';
        if(count($error)>0)
        {
                foreach($error as $err)
                {
                    echo '<div class="container">
                            <div class="alert alert-danger alert-dismissible" id="myAlert">
                                <a href="#" class="close">&times;</a>
                                <strong>error! </strong>'.$err.'
                            </div>
                        </div>';
                }
        }
        else{
            echo '<div class="container">
                    <div class="alert alert-success alert-dismissible" id="myAlert">
                        <a href="#" class="close">&times;</a>
                        <strong>success! </strong>Registered Successfully!!
                    </div>
                </div>';
        } 
        echo '</div>';  
    }    
    ?>
    <div class="container">
        <div class="myformContainer">
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST">
        <div class="form-group">
            <label id="team_name" for="team_name">Team Name</label>
            <input type="text" name="team_name" class="form-control" value="<?php if(count($error)>0){ echo $team_name;}?>" placeholder="Enter Team name" required>
        </div>
        <div class="form-group">
            <label id="team_leader" for="team_leader">Team Leader Name</label>
            <input type="text" name="team_leader" required class="form-control" value="<?php if(count($error)>0){ echo $team_leader;}?>" placeholder="Enter Team Leader name">
        </div>  

        <div class="form-group">
            <label id="email" for="email">Email</label>
            <input type="email" name="email" required class="form-control" value="<?php if(count($error)>0){ echo $email;}?>"  placeholder="Enter email">
        </div>

        <div class="form-group">
            <label id="phone_no" for="phone_no">Phone Number</label>
            <input type="text" name="phone_no"  required class="form-control" <?php if(count($error)>0){ echo $phone_no;}?> placeholder="Enter phone number">
        </div>  
        
        <div class="form-group">
            <label id="no_of_members" for="no_of_members">Number of Members</label>
            <div class="radio">
            <label><input type="radio" name="no_of_members"  value="1">1</label>
            </div>
            <div class="radio">
            <label><input type="radio" name="no_of_members"  value="2">2</label>
            </div>
            <div class="radio">
            <label><input type="radio" name="no_of_members"  value="3">3</label>
            </div>
            <div class="radio">
            <label><input type="radio" name="no_of_members"  value="4">4</label>
            </div>
        </div>
        
        <input type="submit" name="Submit" class="btn btn-default" value="submit">
        
    </form>
        </div> 
    </div>
</body>
</html>