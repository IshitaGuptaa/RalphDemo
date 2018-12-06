<?php 

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "dba";

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $stmt = $conn->prepare("SELECT * FROM dba.product"); 
    $stmt->execute();
  
     while($row = $stmt->fetch())          
    {
    	 echo "<div id='wom'><a href='#'><img src='".$row['image_name']."'></a>";

        echo "<br/><div style='text-align:center;margin-top:15px;margin-bottom:10px;'>".$row['pro_name']."<br/>".$row['pro_desc']."<br/>".$row['pro_price']."<br/>".$row['stock']."</div>";
        echo "<div style='padding-top:10px;'><a href='#' id='a' style='margin-left:25px;text-decoration:none;border:1px solid black;padding:3px 5px;' onclick='openNav()'>Wishlist</a>";
	echo "<a href='#' id='a' style='margin-left:30px;text-decoration:none;border:1px solid black;padding:3px;' onclick='openNav()'>AddtoCart</a></div><div></div></div>";    }
}
catch(PDOException $e) {
    echo "Error: " . $e->getMessage();
}
$conn = null;


?>