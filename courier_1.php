<?php session_start();

$mail_id=$_SESSION['mail_id'];
	
			$servername = "localhost";
			$username = "root";
			$password = "";

			try
			{
  				$conn = new PDO("mysql:host=$servername;dbname = db",$username,$password);
  				$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); 
	   			if ($_SERVER["REQUEST_METHOD"] == "POST")



				 {

					$mail_id=$_SESSION['mail_id'];
					$stmt = $conn->prepare("SELECT recipient_name,phone_no,house_no,area,landmark,city,state,pincode from dba.courier where mail_id='$mail_id'");
					$stmt->execute();
					

$row = $stmt->fetch();


echo "<p style='font-size:20px;'>Delivery Address <br/>".$row['recipient_name']."<br/>".$row['house_no'].", ".$row['area'].", ".$row['landmark'].", ".$row['city'].", ".$row['state'].", ".$row['pincode']."</p><br/><br/><br/>";








$_SESSION['recipient_name']=$row['recipient_name'];$_SESSION['house_no']=$row['house_no'];$_SESSION['area']=$row['area'];$_SESSION['landmark']=$row['landmark'];$_SESSION['city']=$row['city'];$_SESSION['state']=$row['state'];$_SESSION['pincode']=$row['pincode'];}	



header("Location:final_order.php"); exit;


















				}
			

			catch(PDOException $e)
    				{ echo $e->getMessage();
			
   				//header("Location:oops_log_in_1.html"); exit;			 
    				}

			$conn = null; 

		



?>