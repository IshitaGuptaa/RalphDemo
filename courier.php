<?php session_start();
if ($_SERVER["REQUEST_METHOD"] == "POST") 
	 {if (empty($_POST['recipient_name'])||empty($_POST['phone_no'])||empty($_POST['house_no'])||empty($_POST['area'])||empty($_POST['landmark'])||empty($_POST['city'])||empty($_POST['state'])||empty($_POST['pincode'])) 
		{
              header("Location:oops_log_in_1.html");
		exit; 	
		}

	else {
		

		$servername = "localhost";
		$username = "root";
		$password = "";

		try
			{
			
					$name= test_input($_POST['recipient_name']);
					if(preg_match("/^[a-zA-Z ]*$/",$name))
						{$_SESSION['recipient_name']=$name; }
					else
					{ 
						 header("Location:oops_log_in_1.html"); exit;
					}

			

				$namea= test_input($_POST['house_no']);
				if(preg_match("/^[a-zA-Z0-9_.-]*$/",$namea))
					{$_SESSION['house_no']=$namea; }
				else
				{ 
				 header("Location:oops_log_in_1.html"); exit;
				}



			$nameb= test_input($_POST['area']);
			if(preg_match("/^[a-zA-Z ]*$/",$nameb))
				{$_SESSION['area']=$nameb; }
			else
				{ 
				 header("Location:oops_log_in_1.html"); exit;
				}




		$namec= test_input($_POST['landmark']);
			if(preg_match("/^[a-zA-Z ]*$/",$namec))
				{$_SESSION['landmark']=$namec; }
			else
				{ 
				   header("Location:oops_log_in_1.html"); exit;
				}




		$named= test_input($_POST['city']);
			if(preg_match("/^[a-zA-Z ]*$/",$named))
				{$_SESSION['city']=$named; }
			else
				{ 
				   header("Location:oops_log_in_1.html"); exit;
				}

		$namee= test_input($_POST['state']);
			if(preg_match("/^[a-zA-Z ]*$/",$namee))
				{$_SESSION['state']=$namee; }
			else
				{ 
				header("Location:oops_log_in_1.html"); exit;
				}



		$namef= test_input($_POST['phone_no']);
			if(preg_match("/[7-9]{1}[0-9]{9}/",$namef))
				{$_SESSION['phone_no']=$namef; }
			else
				{ 
				   header("Location:oops_log_in_1.html"); exit;
				}





			$namef= test_input($_POST['pincode']);
			if(preg_match("/[0-9]{6}$/",$namef))
				{$_SESSION['pincode']=$namef; }
			else
				{ 
				   header("Location:oops_log_in_1.html"); exit;
				}





  			$conn = new PDO("mysql:host=$servername;dbname = db",$username,$password);
  			$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); 

   			if ($_SERVER["REQUEST_METHOD"] == "POST") {
     			



$stmt = $conn->prepare("INSERT INTO dba.courier(recipient_name,phone_no,house_no,area,landmark,city,state,pincode,mail_id) VALUES (:recipient_name,:phone_no,:house_no,:area,:landmark,:city,:state,:pincode,:mail_id)");
     			$stmt->bindParam(':recipient_name',$recipient_name);
    		 	$stmt->bindParam(':phone_no',$phone_no);
     			$stmt->bindParam(':house_no',$house_no);
     			
			$stmt->bindParam(':area',$area);
    		 	$stmt->bindParam(':landmark',$landmark);
     			$stmt->bindParam(':city',$city);
			
			$stmt->bindParam(':state',$state);
    		 	$stmt->bindParam(':pincode',$pincode);
     			$stmt->bindParam(':mail_id',$mail_id);


			$recipient_name = $_SESSION['recipient_name'];
			$phone_no = $_SESSION['phone_no'];
			$house_no = $_SESSION['house_no'];
			$area = $_SESSION['area'];
     			
			$landmark = $_SESSION['landmark'];
			$city = $_SESSION['city'];
			$state = $_SESSION['state'];
			$pincode = $_SESSION['pincode'];
     			$mail_id=$_SESSION['mail_id'];


     			$stmt->execute();
   			
	
header("Location:final_order.php"); exit;
                         }		
			
    		}


		























		catch(PDOException $e)
    			{ echo "<h1 style='font-size:45px;text-align:center;margin-top:300px;'>This Address Already Exists</h1>";
		exit; 	
  			 
    			}

		$conn = null; 

}
















}













function test_input($data){

$data=trim($data);
$data=stripslashes($data);
$data=htmlspecialchars($data);
return $data;
}

	
?>