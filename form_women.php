<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") 
	 {if (empty($_POST['username'])||empty($_POST['password'])||empty($_POST['mail_id'])) 
		{
                header("Location:oops_log_in_women.html");
		exit; 	
		}

	else {
		session_start();

		$servername = "localhost";
		$username = "root";
		$password = "";

		try
			{
			$name= test_input($_POST['username']);
			if(preg_match("/^[a-zA-Z ]*$/",$name))
				{$_SESSION['name']=$name; }
			else
				{ 
				header("Location:oops_log_in_women.html"); exit;
				}
			
			$mail_id= test_input($_POST['mail_id']);
			
			if(!filter_var($mail_id, FILTER_VALIDATE_EMAIL))
				{
				header("Location:oops_log_in_women.html");
				exit;
				}

			else
				{
				 $_SESSION['cust_id']=$_SESSION['mail_id']=$mail_id;
				}
	
  			$conn = new PDO("mysql:host=$servername;dbname = dba",$username,$password);
  			$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); 

   			if ($_SERVER["REQUEST_METHOD"] == "POST") {
     			$stmt = $conn->prepare("INSERT INTO dba.customer (username,mail_id,password) VALUES (:username,:mail_id,:password)");
     			$stmt->bindParam(':username',$username);
    		 	$stmt->bindParam(':mail_id',$mail_id);
     			$stmt->bindParam(':password',$password);
     			$username = $_SESSION['name'];
     			$password = test_input($_POST['password']);
     			$mail_id =$_SESSION['mail_id'];
		        if(isset($_POST['mail_id'])) 
     			{$mail_id = $_POST['mail_id']; }
     			$stmt->execute();

$stmt=$conn->prepare("SELECT num FROM dba.customer WHERE mail_id='$mail_id' ");
			$stmt->execute();
			$data=$stmt->fetch();
			$_SESSION['num']=$data['num'];
   			
	

header("Location:women_product_1.php");
			exit;}		
			
    		}


		
		catch(PDOException $e)
    			{header("Location:oops_log_in_women.html");
			exit; 
  			 
    			}

		$conn = null; 

}
}

function test_input($data){

echo "hello";
$data=trim($data);
$data=stripslashes($data);
$data=htmlspecialchars($data);
return $data;
}

	
?>