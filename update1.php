<?php

include_once("config.php");

if(isset($_POST['update']))
{
	$Email = $_POST['Email'];
	$Doctor_ID = $_POST['Doctor_ID'];
	$First_Name = $_POST['First_Name'];
	$Last_Name = $_POST['Last_Name'];
	$Phone_Number = $_POST['Phone_Number'];
	$Specialization = $_POST['Specialization'];

	if(empty($Doctor_ID) || empty($Email) || empty($First_Name) || empty($Last_Name) || empty($Phone_Number) || empty($Specialization)){
		if(empty($Email)){
			echo "<font color ='red'>Email field is empty.</font><br/>";
		}
		if(empty($Doctor_ID)){
			echo "<font color ='red'>Doctor ID field is empty.</font><br/>";}
		if(empty($First_Name)){
			echo "<font color ='red'>First Name field is empty.</font><br/>";}
		if(empty($Last_Name)){
			echo "<font color ='red'>Last Name field is empty.</font><br/>";}
		if(empty($Phone_Number)){
			echo "<font color ='red'>Phone Number field is empty.</font><br/>";}
		if(empty($Specialization)){
			echo "<font color ='red'>Specialization field is empty.</font><br/>";}
		}
	else{
		//updating the table
		$sql = "UPDATE doctor_info SET Email=:Email, Doctor_ID=:Doctor_ID, First_Name=:First_Name, Last_Name=:Last_Name, Phone_Number=:Phone_Number, Specialization=:Specialization WHERE Doctor_ID=:Doctor_ID";
		$query = $dbconn->prepare($sql);
		$query->bindparam(':Email',$Email);
		$query->bindparam(':Doctor_ID',$Doctor_ID);
		$query->bindparam(':First_Name',$First_Name);
		$query->bindparam(':Last_Name',$Last_Name);
		$query->bindparam(':Phone_Number',$Phone_Number);
		$query->bindparam(':Specialization',$Specialization);
		$query->execute();

		header("Location: start.php");
	}
}

?>



<?php
$Doctor_ID = $_REQUEST['Doctor_ID'];

$sql = "SELECT * FROM doctor_info WHERE Doctor_ID=:Doctor_ID";

$query = $dbconn->prepare($sql);
$query->execute(array(':Doctor_ID'=>$Doctor_ID));

while($row= $query->fetch(PDO::FETCH_ASSOC))
{
	$Email = $row['Email'];
	$Doctor_ID = $row['Doctor_ID'];
	$First_Name = $row['First_Name'];
	$Last_Name = $row['Last_Name'];
	$Phone_Number = $row['Phone_Number'];
	$Specialization = $row['Specialization'];
}
?>

<html>
<head>
	<title> Update Selected Information</title>
</head>

<body>
    <br/><br/>
    <a href = "start.php"><medium> Go back to "List of Doctors and Information" page </medium></a>
    <br/><br/>
    <h4> Edit Selected Doctor Information </h4>


    <form name="form1" method="post" action="update1.php">
        <table border="0" cellpadding="0" align="left">
            <tr>
            	
                <td>Email</td>
                <td><input type="text" name="Email" readonly ="true" value="<?php echo $Email;?>"><small> -> Email information is not allowed to be modified!</small><br></td>
            </tr>
            <tr>
            	
                <td>Doctor ID</td>
                <td><input type="text" name="Doctor_ID" readonly="true" value="<?php echo $Doctor_ID;?>"><small> -> Doctor ID information is not allowed to be modified!</small><br></td>
            </tr>
            <tr>
                <td>First Name</td>
                <td><input type="text" name="First_Name" value="<?php echo $First_Name;?>"><br></td>
            </tr>
            <tr>
                <td>Last Name</td>
                <td><input type="text" name="Last_Name" value="<?php echo $Last_Name;?>"><br></td>
            </tr>
            <tr>
                <td>Phone Number</td>
                <td><input type="text" name="Phone_Number" value="<?php echo $Phone_Number;?>"><br></td>
            </tr>
            <tr>
                <td>Specialization</td>
                <td><input type="text" name="Specialization" value="<?php echo $Specialization;?>"><br></td>
            </tr>
            	<td><br><input type="submit" name="update" value="update"></td>
        </table>
    </form>
</body>
</html>

