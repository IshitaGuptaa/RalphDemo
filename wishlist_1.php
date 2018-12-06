<?php session_start();
if(isset($_POST['wishlist'])){

		$servername = "localhost";
		$username = "root";
		$password = "";
		try
			{ $pro_id=$_SESSION['pro_id'];

	 		$conn = new PDO("mysql:host=$servername;dbname = dba",$username,$password);
  			$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); 
			$stmt = $conn->prepare("INSERT INTO dba.wishlist(pro_id,cust_id) VALUES (:pro_id,:cust_id)");
			
			$stmt->bindParam(':pro_id',$pro_id);
			$stmt->bindParam(':cust_id',$cust_id);
			
			$pro_id=$_SESSION['pro_id'];
			$cust_id=$_SESSION['mail_id'];
			 $stmt->execute();
header("Location:cart.php");exit();
}


		
		catch(PDOException $e)
    			{
  			 echo $e->getMessage();

header("Location:cart.php");exit();

    			}

		$conn = null; 


}

?>
