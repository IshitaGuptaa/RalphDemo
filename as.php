<?php session_start();
if(isset($_POST['AddtoCart'])){
$servername = "localhost";
		$username = "root";
		$password = "";
		try
			{ $_SESSION['pro_id']=$_POST['pro_id'];
                        $conn = new PDO("mysql:host=$servername;dbname = dba",$username,$password);
  			$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); 
     			$stmt = $conn->prepare("INSERT INTO dba.invoice(cust_id,num) VALUES (:cust_id,:num)");     			    		 	
			$stmt->bindParam(':cust_id',$cust_id);
			$stmt->bindParam(':num',$num);
                        $cust_id=$_SESSION['mail_id'];
			$num=$_SESSION['num'];
                        $stmt->execute();
                  
                        $stmt = $conn->prepare("select invoice_id from dba.invoice where cust_id='$cust_id' AND num='$num'");
			 $stmt->execute();
			$row = $stmt->fetch();				
			$invoice_id=$_SESSION['invoice_id']=$row['invoice_id'];
			$pro_id=$_SESSION['pro_id'];

			$stmt = $conn->prepare("select count(quantity) from dba.invoice_product where invoice_id='$invoice_id' AND pro_id='$pro_id'");
			 $stmt->execute();
			$row = $stmt->fetch();		
			$quan=$row['count(quantity)'];$_SESSION['quantity']=$quan++;


			$stmt = $conn->prepare("INSERT INTO dba.invoice_product(invoice_id,pro_id,count) VALUES (:invoice_id,:pro_id,:count)");
			$stmt->bindParam(':invoice_id',$invoice_id);
			$stmt->bindParam(':pro_id',$pro_id);
			$stmt->bindParam(':count',$count);
			$invoice_id=$_SESSION['invoice_id'];
			$pro_id=$_SESSION['pro_id'];
			$count=$quan;
			 $stmt->execute();





$stmt = $conn->prepare("Insert into dba.final_invoice_prod(invoice_id,pro_id) select distinct invoice_id,pro_id From dba.invoice_product where pro_id='$pro_id' and invoice_id='$invoice_id'"); 

 $stmt->execute();

$stmt = $conn->prepare("update dba.final_invoice_prod set quantity='$quan' where pro_id='$pro_id' and invoice_id='$invoice_id'"); 

$stmt->execute();




$num= $_SESSION['num'];




$stmt = $conn->prepare("select * from dba.invoice where invoice_id='$invoice_id' AND cust_id='$cust_id' AND num='$num'");
			 $stmt->execute();
			$row = $stmt->fetch();		
			$q=$_SESSION['invoice_id']=$row['invoice_id'];
			$qa=$_SESSION['cust_id']=$row['cust_id'];
			$time=$row['date'];






















































$stmt = $conn->prepare("select * from dba.invoice where cust_id='$cust_id' AND num='$num'");
			 $stmt->execute();
			$row = $stmt->fetch();		
                    
$invoice_id=$row['invoice_id'];



$stmt = $conn->prepare("delete from dba.invoice where cust_id='$cust_id' AND num='$num' AND invoice_id !='$invoice_id'");
			 $stmt->execute();


































header("Location:women_product_1.php");
exit();

			
}
		catch(PDOException $e)
    			{
  			 echo $e->getMessage();
header("Location:women_product_1.php");
exit();
		}

		$conn = null; 
}






if(isset($_POST['wishlist'])){

		$servername = "localhost";
		$username = "root";
		$password = "";
		try
			{ $_SESSION['pro_id']=$_POST['pro_id'];

	 		$conn = new PDO("mysql:host=$servername;dbname = dba",$username,$password);
  			$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); 
			$stmt = $conn->prepare("INSERT INTO dba.wishlist(pro_id,cust_id) VALUES (:pro_id,:cust_id)");
			
			$stmt->bindParam(':pro_id',$pro_id);
			$stmt->bindParam(':cust_id',$cust_id);
			
			$pro_id=$_SESSION['pro_id'];
			$cust_id=$_SESSION['mail_id'];
			 $stmt->execute();
			
header("Location:women_product_1.php");
exit();
}


		
		catch(PDOException $e)
    			{
  			 echo $e->getMessage();
header("Location:women_product_1.php");
exit();

    			}

		$conn = null; 


}
















?>


