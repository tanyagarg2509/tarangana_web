<?php

$nameErr=$numberErr=$emailErr="";
$team_name = $team_leader = $email = $phone_no = $no_of_members = "";
if ($_SERVER["REQUEST_METHOD"] == "POST") 
{
	
	if(isset($_POST["team_name"]) && isset($_POST["team_name"]) && isset($_POST["team_name"]) && isset($_POST["team_name"]))
	{
        $team_name=$_POST["team_name"]; 
        $team_leader=$_POST["team_leader"];
        $phone_no=$_POST["phone_no"];
        $no_of_members=$_POST["no_of_members"];
        $email=$_POST["email"];

        if (!preg_match("/^[a-zA-Z]*$/",$team_name)||!filter_var($email, FILTER_VALIDATE_EMAIL)) 
        {
            $nameErr = "Only letters and white space allowed"; 
            $emailErr = "Invalid email format"; 
            // $phoneErr= "Invalid Phone Number";
        }

        else{
            include 'connect.php';

            $sql1 = "select * from users where team_name =$team_name";
            $result=mysqli_query($conn, $sql1gg);
            if ($result->num_rows > 0) {
                echo 'Team Name already Registered';
            }

            else{
                $sql = "INSERT INTO tarangana(team_name,team_leader,no_of_members,email,phone_no)
       VALUES ($team_name, $team_leader, $no_of_members,$email,$phone_no)";



            if ($conn->query($sql) === TRUE) 
            {
                echo "New record created successfully";
            } 
            else 
            {
                 echo "Error: " . $sql . "<br>" . $conn->error;
            }
            }
        }

         

    }
    else{
        echo('Enter Correct details');
        echo '<script type="text/javascript"> alert("Welcome at c-sharpcorner.com.")</script>';
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
    <title>TAARANGANA</title>
    <style>
    .error {color: #FF0000;}
    header{
        width:100%;
        height:auto;
        padding:10px;
       background-color:red;
        text-align:center;
        font-size:20px;
    }
    form{
        margin:auto;
    }
    </style>
</head>
<body>
    <header class="container">
    TAARANGANA WEBSITE REGISTRATION FORM
    </header>
    
    <div class="container">
    <form class="flex-container" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST">
    <label for="team_name">1. Enter The Team Name</label>
    <br>
    <input type="text" name="team_name"  required id="1">
    <br>
    <label for="team_leader">2. Enter the Name of Team Leader</label>
    <br>
    <input type="text" name="team_leader" required id="2"><span class="error"> * <?php echo $nameErr;?></span>
    <br>
    <label for="email">3. Enter the Email Id</label>
    <br>
    <input type="email" name="email" required  id="3"><span class="error"> * <?php echo $emailErr;?></span>
    <br>
    <label for="phone_no">4. Enter your Phone Number</label>
    <br>
    <input type="text" name="phone_no"  required  id="4"> <span class="error"> * <?php echo $numberErr;?></span>
    <br>
    <label for="no_of_members">Enter the Number of Members in your Team.</label>
    <br>
    <input type="radio" name="no_of_members" checked value="1">&nbsp1
    <br>
    <input type="radio" name="no_of_members" value="2">&nbsp2 
    <br>
    <input type="radio" name="no_of_members" value="3">&nbsp3
    <br>
    <input type="radio" name="no_of_members" value="4">&nbsp4 
    <br>   

    <input type="submit" name="Submit" value="submit">
   

    </form>
     
    </div>
</body>
</html>