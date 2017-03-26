<?php
$servername = "localhost";
$username = "root";
$password = "";
$db="codes";

// Create connection
$conn = new mysqli($servername, $username, $password,$db);

// Check connection
if ($conn->connect_error) 
{
   die("Connection failed: " . $conn->connect_error);
} 
//echo "Connected successfully<br>";

if($_POST['submit'])
{

	$s=$_POST['crime'];
	$p=explode(" ",$s);
	//echo "$p[0]<br>";

	$n=count($p);
	//echo $n."<br>";
	$sql = "SELECT * FROM codes WHERE";
	$sql = $sql." CODE LIKE '%".$p[0]."%'";
	for($i=1;$i<$n;$i++)
	{
		$sql = $sql." AND CODE LIKE '%".$p[$i]."%'";
		//$result = $conn->query($sql);
		
	}
	//echo $sql;
	$result = $conn->query($sql);

	if ($result->num_rows > 0) {
	    // output data of each row
	    while($row = $result->fetch_assoc()) 
	    {
		echo "<br>";
		$r=$row["IPC"];
		echo "<h1>";
		highlight_string($r);
		echo "</h1  >";
		echo "<br>";
		//echo $row["CODE"];
		$m=$row["CODE"];
		$m1=explode(" ",$m);
		$s=count($m1);
		highlight_string($m);
		}
	} else {
	    //echo "<br> 0 results";
	    echo "
	    <!DOCTYPE html>
	    <html>
	    	<head>
	    		<title>Search Result.</title>
	    		<style>
	    			body{
    					font-family: arial; 
    					font-size: 80%; 
    					line-height: 1.2em; 
    					width: 100%; 
    					margin: 0; 
    					background: #eee;
					}
					fieldset{
						background: white;
						margin: 10% 20%;
					;
					}
	    		</style>
	    	</head>
	    	<body>
	    		<center>
	    			<fieldset>
	    				<h3>0 results</h3>
	    			</fieldset>
	    		</center>
	    	</body>
	    </html>";
	}
	$conn->close();

}

?>
