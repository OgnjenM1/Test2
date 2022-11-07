<html>
<body>
<?php
$name = $email = $sname  = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $name = test_input($_POST["name"]);
  $email = test_input($_POST["email"]);
  $sname = test_input($_POST["sname"]);
}

function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "test1";

// Create connection
$conn = mysqli_connect($servername, $username, $password,$dbname);

// Check connection
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}
echo "Connected successfully";

  
  $sql = "INSERT INTO MyGuests (firstname, lastname, email) VALUES ('$name', '$sname', '$email')";

if ($conn->query($sql) === TRUE) {
  echo "New record created successfully";
} else {
  echo "Error: " . $sql . "<br>" . $conn->error;
}
$sql = "SELECT id, firstname, lastname,email FROM MyGuests";
echo"<br><br>";

$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        echo "<br>  ". $row["id"]. " Ime: ". $row["firstname"]. " " . $row["lastname"] . " " . $row["email"] ."<br>";
    }
} else {
    echo "0 results";
}

$conn->close();

?>


<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">  
Name: <input type="text" name="name"><br>
Prezime: <input type="text" name="sname"><br>
E-mail: <input type="text" name="email"><br>
<input type="submit">
</form>

</body>
</html>