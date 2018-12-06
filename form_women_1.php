<?php session_start(); 
if ($_SERVER["REQUEST_METHOD"] == "POST"){
	if(empty($_POST['mail_id']) || empty($_POST['password']))
	{	
        header("Location: oops_log_in_women.html" );
	}

	else
	{	$mail_id=$_POST['mail_id'];
		$pass=$_POST['password'];

		$servername='localhost';
		$username='root';
		$password='';

		try{


			$conn = new PDO("mysql:host=$servername;dbname=dba", $username, $password);
			$conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
			$stmt=$conn->prepare("SELECT username,mail_id,password,num FROM dba.customer WHERE mail_id='$mail_id' and password='$pass' ");
			$stmt->setFetchMode(PDO::FETCH_ASSOC);
			$stmt->execute();
			$data=$stmt->fetch();

			if(($data['mail_id']==$mail_id) && ($data['password']==$pass)){
				$_SESSION['cust_id']=$_SESSION['mail_id']=$mail_id;
				$_SESSION['username']=$data['username'];

				$num=$data['num'];

				$num++;

				$_SESSION['num']=$num;
				$stmt=$conn->prepare("update dba.customer set num ='$num' where mail_id='$mail_id' ");
				$stmt->execute();
				header("Location: women_product_1.php" );
				exit();
			}
			else{ 
		header("Location: women_product.php" );
			exit();
    			}
		}

		catch(PDOException $e)
			{
			echo $e->getMessage();
			
			}
		$conn=null;
	}
}




?>



