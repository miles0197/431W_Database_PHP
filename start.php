<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$username = '';
$password = '';
$host = 'localhost';
$dbname = 'miles_database';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $sql = 'SELECT Email, Doctor_ID, First_Name, Last_Name, Phone_Number, Specialization FROM doctor_info';
    $q = $pdo->query($sql);
    $q->setFetchMode(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    die("Could not connect to the database $dbname :" . $e->getMessage());
}
?>
<!DOCTYPE html>
<html>
    <head>
        <title></title>
    </head>
    <body>
        <div id="container">
            <h2>Current List of Doctors and Information</h2>
            <table border=1 cellspacing=5 cellpadding=5>
                <thead>
                    <tr>
                        <th>Email</th>
                        <th>Doctor ID</th>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>Phone Number</th>
                        <th>Specialization</th>
                        <th>Remove</th>
                        <th>Update</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = $q->fetch()): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($row['Email']); ?></td>
                            <td><?php echo htmlspecialchars($row['Doctor_ID']); ?></td>
                            <td><?php echo htmlspecialchars($row['First_Name']); ?></td>
                            <td><?php echo htmlspecialchars($row['Last_Name']); ?></td>
                            <td><?php echo htmlspecialchars($row['Phone_Number']); ?></td>
                            <td><?php echo htmlspecialchars($row['Specialization']); ?></td>
                            <td><?php echo '<form action="delete.php" method="post"><input type="submit" value="Remove"><input type="hidden" name="Doctor_ID" value="' . htmlspecialchars($row['Doctor_ID']) . '"></form>'; ?></td>
                            <td><?php echo '<form action="update1.php" method="post"><input type="submit" value="update"><input type="hidden" name="Doctor_ID" value="' . htmlspecialchars($row['Doctor_ID']) . '"></form>'; ?></td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
		<br><h2>Insert a new user:</h2>
		<form action="insert.php" method="post">
			<table>
                <tr><td>Email:</td><td><input type="text" id="Email" name="Email" value="?"></td></tr>
                <tr><td>Doctor ID:</td><td><input type="text" id="Doctor_ID" name="Doctor_ID" value="?"></td></tr>
				<tr><td>First Name:</td><td><input type="text" id="First_Name" name="First_Name" value="?"></td></tr>
				<tr><td>Last Name:</td><td><input type="text" id="Last_Name" name="Last_Name" value="?"></td></tr>
				<tr><td>Phone Number:</td><td><input type="text" id="Phone_Number" name="Phone_Number" value="?"></td></tr>
                <tr><td>Specialization:</td><td><input type="text" id="Specialization" name="Specialization" value="?"></td></tr>
			</table>
			<input type="submit" value="INSERT">
		</form>
		<br>
		<br><br><br>
    </body>
</div>
</html>
