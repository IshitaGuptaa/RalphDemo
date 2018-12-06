<?php session_start();
if(isset($_POST['delete'])){
$servername = "localhost";
		$username = "root";
		$password = "";
		try
			{$pro_id= $_SESSION['pro_id']=$_POST['pro_id'];
                        
			$cust_id=$_SESSION['mail_id'];
			$num=$_SESSION['num'];
                       
			$conn = new PDO("mysql:host=$servername;dbname = dba",$username,$password);
  			$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); 

                        $stmt = $conn->prepare("select invoice_id from dba.invoice where cust_id='$cust_id' AND num='$num'");
			 $stmt->execute();
			$row = $stmt->fetch();				
			$invoice_id = $row['invoice_id'];



$stmt = $conn->prepare("select count(count) from dba.invoice_product where invoice_id='$invoice_id' AND pro_id='$pro_id'");
$stmt->execute();
$row = $stmt->fetch();				
$quan=$row['count(count)'];

echo $quan;
 $stmt = $conn->prepare("DELETE FROM dba.invoice_product WHERE invoice_id='$invoice_id' AND pro_id='$pro_id' and count='$quan'");
			 $stmt->execute();


$quan--;




			$stmt = $conn->prepare("update dba.final_invoice_prod set quantity='$quan' where invoice_id='$invoice_id' AND pro_id='$pro_id' ");
			 $stmt->execute();




if ($quan==0){

 $stmt = $conn->prepare("DELETE FROM dba.final_invoice_prod WHERE invoice_id='$invoice_id' AND pro_id='$pro_id'");
			 $stmt->execute();


}


















     	




























header("Location:final_order.php");
exit();

			
}
		catch(PDOException $e)
    			{
  			 echo $e->getMessage();
//header("Location:final_order.php");
//exit();
		}

		$conn = null; 
}
