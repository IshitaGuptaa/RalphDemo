<?php session_start();
if(isset($_POST['delete'])){

		$servername = "localhost";
		$username = "root";
		$password = "";
		try
			{ $pro_id=$_SESSION['pro_id']=$_POST['pro_id'];

	 		$conn = new PDO("mysql:host=$servername;dbname = dba",$username,$password);
  			$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); 
			
			$cust_id=$_SESSION['mail_id'];





			//$cust_id=$_SESSION['mail_id'];
			//$num=$_SESSION['num'];
                       
                        //$stmt = $conn->prepare("select invoice_id from dba.invoice where cust_id='$cust_id' AND num='$num'");
			 //$stmt->execute();
			//$row = $stmt->fetch();				
			//$_SESSION['invoice_id']=$row['invoice_id'];








			





			$stmt = $conn->prepare("DELETE FROM dba.wishlist WHERE pro_id='$pro_id' AND cust_id='$cust_id'");
			$stmt->execute();
			




header("Location:wishlist.php");exit();
}


		
		catch(PDOException $e)
    			{
  			// echo $e->getMessage();

			header("Location:wishlist.php");exit();

    			}

		$conn = null; 


}

?>
