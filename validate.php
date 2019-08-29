<?php
$team_name = $team_leader = $email = $phone_no = $no_of_members = "";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
	
	if(isset($_POST["team_name"])!='' && isset($_POST["team_name"])!='' && isset($_POST["team_name"])!='' && isset($_POST["team_name"])!='')
	{
		
	}
    $team_name=isset($_POST["team_name"])?$_POST["team_name"]:""; 
    $team_leader=$_POST["team_leader"];
    $phone_no=$_POST["phone_no"];
    $no_of_members=$_POST["no_of_members"];
    $email=$_POST["email"];
	
	
	
	

    echo "rahul";
}

?>