<?php  
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "dba";

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $stmt = $conn->prepare("SELECT * FROM dba.product order by pro_id;"); 
    $stmt->execute();
  
     while($row = $stmt->fetch())          
    { 
    	 echo "<div id='wom'><a href='#'><img src='".$row['image_name']."'></a>";

        echo "<br/><div style='text-align:center;margin-top:15px;margin-bottom:10px;'>".$row['pro_name']."<br/>".$row['pro_desc']."<br/>".$row['pro_price']."<br/>".$row['stock']."</div>";
        echo "<div style='padding-top:10px;'><form id='in' action='as.php' method='post'><input type='hidden' name='pro_id' value='".$row['pro_id']."'><input type='submit' name='wishlist' value='Wishlist' class='a' >";
	echo "<input type='submit' name='AddtoCart' value='AddtoCart' class='a' ></form></div><div></div></div>";    
}



}
catch(PDOException $e) {
    echo "Error: " . $e->getMessage();
}
$conn = null;


?>