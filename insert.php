<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$username = '';
$password = '';
$host = 'localhost';
$dbname = 'miles_database';

?>
<!DOCTYPE html>
<html>
    <head>
        <title>PHP MySQL Query Data Demo</title>
    </head>
    <body>
		<p>
			<?php 
				echo "Inserting New Doctor:" . $_POST["Email"] . " " . $_POST["Doctor_ID"] . " " . $_POST["First_Name"] . " " . $_POST["Last_Name"] . " " . $_POST["Phone_Number"] . " " . $_POST["Specialization"] . "..."; 
				$sql = 'INSERT INTO doctor_info (Email, Doctor_ID, First_Name, Last_Name, Phone_Number, Specialization) ';
				$sql = $sql . 'VALUES ("'.$_POST["Email"] . '","'.$_POST["Doctor_ID"] . '","'.$_POST["First_Name"] . '","'.$_POST["Last_Name"] . '","' . $_POST["Phone_Number"] . '","' . $_POST["Specialization"] . '")';
				try {
					$conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
					$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
					$conn->exec($sql);
					echo "New record created successfully";
			?>
				<p>You will be redirected in 3 seconds</p>
				<script>
					var timer = setTimeout(function() {
						window.location='start.php'
					}, 3000);
				</script>
			<?php
				} catch(PDOException $e) {
					echo $sql . "<br>" . $e->getMessage();
				}
				$conn = null;
			?>
		</p>
    </body>
</div>
</html>
